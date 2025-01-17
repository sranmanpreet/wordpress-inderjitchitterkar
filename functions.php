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
		'default-image' => get_theme_file_uri() . '/img/bg.jpg',
		'default-position-x' => 'right',
		'default-position-y' => 'top',
		'default-repeat'     => 'no-repeat'
	));
}
add_action("after_setup_theme", 'inderjitchitterkar_features');