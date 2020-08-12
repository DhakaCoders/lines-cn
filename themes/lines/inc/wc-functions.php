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
        $sh_desc = $product->get_short_description();
        $categories = get_the_terms( $product->get_id(), 'product_cat' );
        $randValue = '';
        if ( ! empty( $categories ) ) {
          $terms = json_decode(json_encode($categories), true);
          $randIndex = array_rand($terms, 1);
          $randarray[] = $terms[$randIndex];
          $randValue = $randarray[0]['name'];
        }

        $spacifi = get_field('right_col', $product->get_id());
        
        $output = '<h2 class="pp-des-title">';
        $output .= get_the_title();
        if(!empty($randValue)) $output .= '<strong>'.$randValue.'</strong>'; 
        $output .='</h2>';
        if( $spacifi ):
          $output .= '<span>';
          $output .= ( !empty($spacifi['style']) )? $spacifi['style']: '';$output .= ( !empty($spacifi['abv']) )? ' | '.$spacifi['abv'].'%': '';$output .= ( !empty($spacifi['capacity']) )? ' | '.$spacifi['capacity']: '';
          $output .= '</span>';
        endif;
            $output .= '<strong>'.$product->get_price_html().'</strong>';
            $output .= '<div class="pp-con">';
               $output .= '<p>'.$sh_desc.'... <a href="#">READ MORE</a></p>';
            $output .= '</div>';

            if ( ! empty( $categories ) ) {
            $output .= '<div class="pp-category">';
            $output .= '<label>CATEGORY:</label>';
            $output .= '<ul class="reset-list">';
              foreach( $categories as $category ) {
                $output .= '<li><a href="'.get_term_link($category).'">'.$category->name.'</a></li>';
              }
            $output .= '</ul>';
            $output .= '</div>';
            }
        $output .= '<div class="pp-social-medias">
                <label>SHARE PRODUCT:</label>
                <ul class="reset-list">
                  <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                  <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                </ul>
              </div>';
        echo  $output;
          woocommerce_template_single_add_to_cart();

        
    }
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text', 10, 2 );

function woo_custom_cart_button_text() {
return __('ADD TO BASKET', 'woocommerce');
}