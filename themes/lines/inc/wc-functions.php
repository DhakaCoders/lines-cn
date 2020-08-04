<?php
defined( 'ABSPATH' ) || exit;

/*Remove Archive Woocommerce Hooks & Filters are below*/

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/* Single product*/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


add_action('woocommerce_single_product_summary', 'add_custom_box_product_summary', 5);
if (!function_exists('add_custom_box_product_summary')) {
    function add_custom_box_product_summary() {
        global $product, $woocommerce, $post;
        $sh_desc = '';
        $page_url = get_permalink();
        if( !empty($sh_desc) ) $sh_desc = $sh_desc;
        $sh_desc = $product->get_description();
        $output = '<div class="single-product-des-top">';
          $output .= '<div class="single-product-des-top-innr"> ';
            $output .= '<h2 class="single-product-title">Enim lobortis faucibus neque vitae congue</h2>';
            $output .= '<div class="single-product-price">';
               $output .= '<strong>€ 58</strong>
             <strong>€ 48</strong>';
            $output .= '</div>';
            $output .= $sh_desc;
          $output .= '</div>';
        $output .= '</div>';
        echo  $output;
        woocommerce_template_single_add_to_cart();
        
    }
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text', 10, 2 );

function woo_custom_cart_button_text() {
return __('Bestellen', 'woocommerce');
}