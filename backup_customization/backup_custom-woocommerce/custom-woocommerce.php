<?php

/*
Plugin Name: Custom Woocommerce Admin
Description: Customize Woocommerce Custom Product Types 
Version: 1.0
Author: Sran Manpreet
Author URI: https://www.sranmanpreet.com
*/

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

function register_exclusive_for_you_product_type() {
 
    class WC_Product_Exclusive_For_You extends WC_Product_Variable {
        
        public function __construct( $product ) {
            $this->product_type = 'exclusive_for_you';
            parent::__construct( $product );
        }

        public function get_type() {
            return 'exclusive_for_you';
        }
    
        public function get_variation_regular_price( $min_or_max = 'min', $for_display = false ) {
            $prices = $this->get_variation_prices( $for_display );
            $price  = 'min' === $min_or_max ? current( $prices['regular_price'] ) : end( $prices['regular_price'] );
    
            return apply_filters( 'woocommerce_get_variation_regular_price', $price, $this, $min_or_max, $for_display );
        }
    
        public function get_variation_sale_price( $min_or_max = 'min', $for_display = false ) {
            $prices = $this->get_variation_prices( $for_display );
            $price  = 'min' === $min_or_max ? current( $prices['sale_price'] ) : end( $prices['sale_price'] );
    
            return apply_filters( 'woocommerce_get_variation_sale_price', $price, $this, $min_or_max, $for_display );
        }
    
        public function get_variation_price( $min_or_max = 'min', $for_display = false ) {
            $prices = $this->get_variation_prices( $for_display );
            $price  = 'min' === $min_or_max ? current( $prices['price'] ) : end( $prices['price'] );
    
            return apply_filters( 'woocommerce_get_variation_price', $price, $this, $min_or_max, $for_display );
        }
    
        public function get_price_html( $price = '' ) {
            $prices = $this->get_variation_prices( true );
    
            if ( empty( $prices['price'] ) ) {
                $price = apply_filters( 'woocommerce_variable_empty_price_html', '', $this );
            } else {
                $min_price     = current( $prices['price'] );
                $max_price     = end( $prices['price'] );
                $min_reg_price = current( $prices['regular_price'] );
                $max_reg_price = end( $prices['regular_price'] );
    
                if ( $min_price !== $max_price ) {
                    $price = wc_format_price_range( $min_price, $max_price );
                } elseif ( $this->is_on_sale() && $min_reg_price === $max_reg_price ) {
                    $price = wc_format_sale_price( wc_price( $max_reg_price ), wc_price( $min_price ) );
                } else {
                    $price = wc_price( $min_price );
                }
    
                $price = apply_filters( 'woocommerce_variable_price_html', $price . $this->get_price_suffix(), $this );
            }
    
            return apply_filters( 'woocommerce_get_price_html', $price, $this );
        }
    
        /**
         * Return a products child ids.
         *
         * This is lazy loaded as it's not used often and does require several queries.
         *
         * @param bool|string $visible_only Visible only.
         * @return array Children ids
         */
        public function get_children( $visible_only = '' ) {
            if ( is_bool( $visible_only ) ) {
                wc_deprecated_argument( 'visible_only', '3.0', 'WC_Product_Exclusive_For_You::get_visible_children' );
    
                return $visible_only ? $this->get_visible_children() : $this->get_children();
            }
            

            if ( null === $this->children ) {
                $children = $this->data_store->read_children( $this );
                $this->set_children( $children['all'] );
                $this->set_visible_children( $children['visible'] );
            }
    
            return apply_filters( 'woocommerce_get_children', $this->children, $this, false );
        }
    
        public function get_visible_children() {
            if ( null === $this->visible_children ) {
                $children = $this->data_store->read_children( $this );
                $this->set_children( $children['all'] );
                $this->set_visible_children( $children['visible'] );
            }
            return apply_filters( 'woocommerce_get_children', $this->visible_children, $this, true );
        }
            
        /*
        |--------------------------------------------------------------------------
        | Setters
        |--------------------------------------------------------------------------
        */

        public function set_variation_attributes( $variation_attributes ) {
            $this->variation_attributes = $variation_attributes;
        }

        public function set_children( $children ) {
            $this->children = array_filter( wp_parse_id_list( (array) $children ) );
        }
    
        public function set_visible_children( $visible_children ) {
            $this->visible_children = array_filter( wp_parse_id_list( (array) $visible_children ) );
        }
    
        /*
        |--------------------------------------------------------------------------
        | Sync with child variations.
        |--------------------------------------------------------------------------
        */
    
        /**
         * Sync a variable product with it's children. These sync functions sync
         * upwards (from child to parent) when the variation is saved.
         *
         * @param WC_Product|int $product Product object or ID for which you wish to sync.
         * @param bool           $save If true, the product object will be saved to the DB before returning it.
         * @return WC_Product Synced product object.
         */
        public static function sync( $product, $save = true ) {
            if ( ! is_a( $product, 'WC_Product' ) ) {
                $product = wc_get_product( $product );
            }
            if ( is_a( $product, 'WC_Product_Exclusive_For_You' ) ) {
                $data_store = WC_Data_Store::load( 'product-' . $product->get_type() );
                $data_store->sync_price( $product );
                $data_store->sync_stock_status( $product );
                self::sync_attributes( $product ); // Legacy update of attributes.
    
                do_action( 'woocommerce_variable_product_sync_data', $product );
    
                if ( $save ) {
                    $product->save();
                }
    
                wc_do_deprecated_action(
                    'woocommerce_variable_product_sync',
                    array(
                        $product->get_id(),
                        $product->get_visible_children(),
                    ),
                    '3.0',
                    'woocommerce_variable_product_sync_data, woocommerce_new_product or woocommerce_update_product'
                );
            }
    
            return $product;
        }
    
        /**
         * Sync parent stock status with the status of all children and save.
         *
         * @param WC_Product|int $product Product object or ID for which you wish to sync.
         * @param bool           $save If true, the product object will be saved to the DB before returning it.
         * @return WC_Product Synced product object.
         */
        public static function sync_stock_status( $product, $save = true ) {
            if ( ! is_a( $product, 'WC_Product' ) ) {
                $product = wc_get_product( $product );
            }
            if ( is_a( $product, 'WC_Product_Exclusive_For_You' ) ) {
                $data_store = WC_Data_Store::load( 'product-' . $product->get_type() );
                $data_store->sync_stock_status( $product );
    
                if ( $save ) {
                    $product->save();
                }
            }
    
            return $product;
        }
    }
}
add_action( 'init', 'register_exclusive_for_you_product_type' );

function add_exclusive_for_you_product_type( $types ){
    $types[ 'exclusive_for_you' ] = __( 'Exclusive For You', 'exclusive_for_you' );
    
    return $types;	
}
add_filter( 'product_type_selector', 'add_exclusive_for_you_product_type' );
 
function exclusive_for_you_product_tabs( $tabs) {
		
    $tabs['exclusive_for_you'] = array(
      'label'	 => __( 'Exclusive For You', 'exclusive_for_you' ),
      'target' => 'exclusive_for_you_product_options',
      'class'  => 'show_if_exclusive_for_you',
     );

     $tabs['variations']['class'][] = 'show_if_exclusive_for_you';
    return $tabs;
}
add_filter( 'woocommerce_product_data_tabs', 'exclusive_for_you_product_tabs' );

function exclusive_for_you_product_tab_product_tab_content() {
 
    ?><div id='exclusive_for_you_product_options' class='panel woocommerce_options_panel'><?php
 ?><div class='options_group'><?php
 
 woocommerce_wp_text_input(
     array(
         'id' => 'exclusive_for_you_info',
	  'label' => __( 'Exclusive For You Product Spec', 'exclusive_for_you' ),
	  'placeholder' => '',
	  'desc_tip' => 'true',
	  'description' => __( 'Enter Exclusive For You Product Info.', 'exclusive_for_you' ),
	  'type' => 'file'
      )
    );
 ?></div>
 </div><?php
}
add_action( 'woocommerce_product_data_panels', 'exclusive_for_you_product_tab_product_tab_content' );


function exclusive_for_you_product_front () {
    global $product;    
    if ( 'exclusive_for_you' == $product->get_type() ) {  	
        /* echo( get_post_meta( $product->get_id(), 'exclusive_for_you_info' )[0] ); */
    }
}
add_action( 'woocommerce_single_product_summary', 'exclusive_for_you_product_front' );

add_action( 'admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script' );

function wpdocs_selectively_enqueue_admin_script( $hook ) {
    if ( 'post.php' != $hook ) {
        return;
    }
    wp_enqueue_script( 'custom_woocommerce_script', plugin_dir_url( __FILE__ ) . 'assets/js/custom-woocommerce-admin.js', array(), '1.0' );
}

add_action( 'woocommerce_exclusive_for_you_add_to_cart', 'woocommerce_exclusive_for_you_add_to_cart', 30 );

if ( ! function_exists( 'woocommerce_exclusive_for_you_add_to_cart' ) ) {

    // Output the variable product add to cart area.
    
	function woocommerce_exclusive_for_you_add_to_cart() {
		global $product;
		// Enqueue variation scripts.
		wp_enqueue_script( 'wc-add-to-cart-variation' );

		// Get Available variations?
		$get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

		// Load the template.
		wc_get_template(
			'single-product/add-to-cart/variable.php',
			array(
				'available_variations' => $get_variations ? $product->get_available_variations() : false,
				'attributes'           => $product->get_variation_attributes(),
				'selected_attributes'  => $product->get_default_attributes(),
			)
		);
	}
}

function woocommerce_data_stores ( $stores ) {  
    if(!class_exists("WC_Product_Exlusive_For_You_Data_Store_CPT")){
		include_once("class-wc-product-exlusive-for-you-data-store-cpt.php");
	}   
    $stores['product-exclusive_for_you'] = 'WC_Product_Exlusive_For_You_Data_Store_CPT';
    return $stores;
}
add_filter( 'woocommerce_data_stores', 'woocommerce_data_stores' );

//To display the ACF custom field 'shpng' below the product title on cart page
function show_variations_exclusive_for_you( $item_data, $cart_item ) {

	// Variation values are shown only if they are not found in the title as of 3.0.
	// This is because variation titles display the attributes.
	if ( $cart_item['data']->is_type( 'exclusive_for_you' ) && is_array( $cart_item['variation'] ) ) {
		echo ("I am exlusive for you");
		print_r($cart_item['variation']);
		foreach ( $cart_item['variation'] as $name => $value ) {
			echo ("In Loop <br>");
			$taxonomy = wc_attribute_taxonomy_name( str_replace( 'attribute_pa_', '', urldecode( $name ) ) );

			if ( taxonomy_exists( $taxonomy ) ) {
				// If this is a term slug, get the term's nice name.
				$term = get_term_by( 'slug', $value, $taxonomy );
				if ( ! is_wp_error( $term ) && $term && $term->name ) {
					$value = $term->name;
				}
				$label = wc_attribute_label( $taxonomy );
			} else {
				// If this is a custom option slug, get the options name.
				$value = apply_filters( 'woocommerce_variation_option_name', $value, null, $taxonomy, $cart_item['data'] );
				$label = wc_attribute_label( str_replace( 'attribute_', '', $name ), $cart_item['data'] );
			}

			// Check the nicename against the title.
			if ( '' === $value || wc_is_attribute_in_product_name( $value, $cart_item['data']->get_name() ) ) {
				continue;
			}

			$item_data[] = array(
				'key'   => $label,
				'value' => $value,
			);
		}
	}

	return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'show_variations_exclusive_for_you', 10, 2 );

/**
 * Handle adding variable products to the cart.
 *
 * @since 2.4.6 Split from add_to_cart_action.
 * @throws Exception If add to cart fails.
 * @param int $product_id Product ID to add to the cart.
 * @return bool success or not
 */
function add_to_cart_handler_exclusive_for_you( $product_id ) {    
    return 'variable';
}
add_filter( 'woocommerce_add_to_cart_handler', 'add_to_cart_handler_exclusive_for_you', 10, 2 ); 

?>