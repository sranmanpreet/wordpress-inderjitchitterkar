<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );
	// Load the stylesheet
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
	
}
add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );

function inderjitchitterkar_files(){


	wp_enqueue_style("inderjitchitterkar_main_styles", get_stylesheet_uri());
	wp_enqueue_style("inderjitchitterkar_front_page_template_styles", get_theme_file_uri('assets/css/style.css'));
	
	wp_enqueue_script("inderjitchitterkar-main", get_theme_file_uri('assets/js/main.js'), null, 1, true);

}

add_action('wp_enqueue_scripts', 'inderjitchitterkar_files');

function inderjitchitterkar_features() {
	add_theme_support("title-tag");
	add_theme_support('custom-background', array(
		'default-color' => '0000ff',
		'default-image' => get_theme_file_uri() . '/assets/img/bg.jpg',
		'default-position-x' => 'right',
		'default-position-y' => 'top',
		'default-repeat'     => 'no-repeat'
	));
}
add_action("after_setup_theme", 'inderjitchitterkar_features');

function inderjitchitterkar_sidebar_registration(){

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '',
		'after_title'   => '',
		'before_widget' => '',
		'after_widget'  => '',
	);

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Contact Us - Landing Page', 'inderjitchitterkar' ),
				'id'          => 'contact-us-landing-page',
				'description' => __( 'Widgets in this area will be displayed in the Contact us section on landing page.', 'inderjitchitterkar' ),
			)
		)
	);
	
}

add_action('widgets_init', 'inderjitchitterkar_sidebar_registration');

function add_last_nav_item($items) {
	if(is_user_logged_in()){
		$items .= '
			<li><a href="' . esc_url(site_url('/my-account')) . '" role="button" data-toggle="modal">My Account</a></li>
			';
	} else {
		$items .= '<li><a href="' . esc_url(site_url('/my-account')) . '" role="button" data-toggle="modal">Login</a></li>';
	}
	return $items;
}

add_filter('wp_nav_menu_items','add_last_nav_item');

/**
 * Exclude exclusive for you products from  shop page
 */
function custom_pre_get_posts_query( $q ) {

    $tax_query = (array) $q->get( 'tax_query' );

    $tax_query[] = array(
           'taxonomy' => 'product_cat',
           'field' => 'slug',
           'terms' => array( 'exclusives' ), 
           'operator' => 'NOT IN'
    );


    $q->set( 'tax_query', $tax_query );

}
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );

function custom_product_page( $atts ) {
	if ( empty( $atts ) ) {
		return '';
	}

	if ( ! isset( $atts['id'] ) && ! isset( $atts['sku'] ) ) {
		return '';
	}

	$args = array(
		'posts_per_page'      => 1,
		'post_type'           => 'product',
		'post_status'         => ( ! empty( $atts['status'] ) ) ? $atts['status'] : 'publish',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
	);

	if ( isset( $atts['sku'] ) ) {
		$args['meta_query'][] = array(
			'key'     => '_sku',
			'value'   => sanitize_text_field( $atts['sku'] ),
			'compare' => '=',
		);

		$args['post_type'] = array( 'product', 'product_variation' );
	}

	if ( isset( $atts['id'] ) ) {
		$args['p'] = absint( $atts['id'] );
	}

	// Don't render titles if desired.
	if ( isset( $atts['show_title'] ) && ! $atts['show_title'] ) {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	}

	// Change form action to avoid redirect.
	add_filter( 'woocommerce_add_to_cart_form_action', '__return_empty_string' );

	$single_product = new WP_Query( $args );

	$preselected_id = '0';

	// Check if sku is a variation.
	if ( isset( $atts['sku'] ) && $single_product->have_posts() && 'product_variation' === $single_product->post->post_type ) {

		$variation  = wc_get_product_object( 'variation', $single_product->post->ID );
		$attributes = $variation->get_attributes();

		// Set preselected id to be used by JS to provide context.
		$preselected_id = $single_product->post->ID;

		// Get the parent product object.
		$args = array(
			'posts_per_page'      => 1,
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'no_found_rows'       => 1,
			'p'                   => $single_product->post->post_parent,
		);

		$single_product = new WP_Query( $args );
		?>
		<script type="text/javascript">
			jQuery( document ).ready( function( $ ) {
				var $variations_form = $( '[data-product-page-preselected-id="<?php echo esc_attr( $preselected_id ); ?>"]' ).find( 'form.variations_form' );

				<?php foreach ( $attributes as $attr => $value ) { ?>
					$variations_form.find( 'select[name="<?php echo esc_attr( $attr ); ?>"]' ).val( '<?php echo esc_js( $value ); ?>' );
				<?php } ?>
			});
		</script>
		<?php
	}

	// For "is_single" to always make load comments_template() for reviews.
	$single_product->is_single = true;

	ob_start();

	global $wp_query;

	// Backup query object so following loops think this is a product page.
	$previous_wp_query = $wp_query;
	// @codingStandardsIgnoreStart
	$wp_query          = $single_product;
	// @codingStandardsIgnoreEnd

	wp_enqueue_script( 'wc-single-product' );

	while ( $single_product->have_posts() ) {
		$single_product->the_post()
		?>
		<div class="single-product" data-product-page-preselected-id="<?php echo esc_attr( $preselected_id ); ?>">
			<?php 
			if(421 == get_the_ID()){
				wc_get_template_part( 'content', 'exclusive-for-you-product' );

			} else {
				wc_get_template_part( 'content', 'single-product' );
			}
			?>
		</div>
		<?php
	}

	// Restore $previous_wp_query and reset post data.
	// @codingStandardsIgnoreStart
	$wp_query = $previous_wp_query;
	// @codingStandardsIgnoreEnd
	wp_reset_postdata();

	// Re-enable titles if they were removed.
	if ( isset( $atts['show_title'] ) && ! $atts['show_title'] ) {
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	}

	remove_filter( 'woocommerce_add_to_cart_form_action', '__return_empty_string' );

	return '<div class="woocommerce">' . ob_get_clean() . '</div>';
}

// Hook after `WC_Shortcodes::init()` is executed.
add_action( 'init', function(){
    // Remove the shortcode.
    remove_shortcode( 'product_page' );

    // Add it back, but using our callback.
    add_shortcode( 'product_page', 'custom_product_page' );
}, 11 );
