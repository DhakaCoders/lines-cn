<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<section class="single-product-sec" id="single-product">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="single-product-inner  clearfix"> 
	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>
        </div>
      </div>
    </div>
  </div>    
</section> 
<?php 
$terms = get_the_terms( get_the_ID(), 'product_cat' );
$termid = '';
if( !empty($terms) && !is_wp_error($terms) ){
	foreach( $terms  as $term ){
		$termid = $term->term_id;
	}
}
if( !empty($termid) ): 
$query = new WP_Query(array( 
	'post_type'=> 'product',
	'posts_per_page' => 3,
	'order'=> 'DESC',
	'tax_query' => array(
		array(
			'taxonomy' => 'product_cat',
			'field' => 'term_id',
			'terms' => $termid
			)
		)
	) 
);
if($query->have_posts()):
?>
<section class="fanshop-v1-post-sec-wrp">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="fanshop-catagory-head">
          <h2 class="fanshop-catagory-title">Related products</h2>
          <p>Et tellus quis mi id non facilisi ac nibh. In lectus etiam augue tristique turpis at. Eget sapien duis molestie in. Consectetur tincidunt arcu ac ornare a turpis fermentum. </p>
        </div>
        <div class="fanshop-post-grid-wrp">
          <div class="hmNewsSecSliderPrevNext">
            <span class="fl-prev">
              <i>
                <svg class="fl-prev-icon-xs-svg" width="27" height="14" viewBox="0 0 27 14" fill="#E8E8E8">
                  <use xlink:href="#fl-prev-icon-xs-svg"></use>
                </svg> 
              </i>
            </span>
            <span class="fl-next">
              <i>
                <svg class="fl-next-icon-xs-svg" width="27" height="14" viewBox="0 0 27 14" fill="#E8E8E8">
                  <use xlink:href="#fl-next-icon-xs-svg"></use>
                </svg> 
              </i>
            </span>
          </div>
          <div class="FanShopPostSlider">
			<?php 

			while($query->have_posts()): $query->the_post(); 
				global $product;
				$product_thumb = '';
				$thumb_id = get_post_thumbnail_id(get_the_ID());
			?>
            <div class="FanShopPostSlideItem">
              <div class="fanshop-post-grid-inr mHc clearfix">
                <div class="fanshop-post-grid-img-cntlr">
                  <a href="#" class="overlay-link"></a>
                  <div class="fanshop-post-grid-img" style="background: url(<?php echo THEME_URI; ?>/assets/images/fanshop-post-grid-img.png);">
                  </div>
                </div>
                <div class="fanshop-post-grid-dsc">
                    <strong>
                  	<?php 
                        if($product->is_type('variable')): 
                          echo wc_price($product->get_variation_regular_price( 'min' )); 
                        else:
                          echo $product->get_price_html();
                        endif;
                      ?>
                  
                    </strong>
                  <h3 class="fanshop-post-grid-title mHc1"> <a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                  <a href="<?php the_permalink();?>">
                    <i>  
                      <svg class="fanshop-post-arrows-icon-svg" width="27" height="14" viewBox="0 0 27 14" fill="#B4B4B4">
                        <use xlink:href="#fanshop-post-arrows-icon-svg"></use>
                      </svg>
                    </i>
                   meer info
                  </a>
                </div>
              </div>
            </div>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; wp_reset_postdata(); endif;?>
<?php get_template_part('templates/footer', 'top'); ?>
<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
