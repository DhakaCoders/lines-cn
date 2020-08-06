<?php 
get_header(); 
$shopID = get_option( 'woocommerce_shop_page_id' );

?>
  <div class="section-graphics-top"><img src="<?php echo THEME_URI; ?>/assets/images/section-graphics-top.png"></div>   
  <section class="page-bnr-shop df-page-bnr">
    <div class="page-bnr-shop-con bg-position-btm" style="background-image: url('<?php echo THEME_URI; ?>/assets/images/page-bnr-shop.png');">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="page-bnr-shop-inr">
              <h1 class="pbs-title">SHOP</h1>
              <div class="main-shop-bnr-menu">
                <ul class="reset-list">
                  <li class="active"><span>BEERS</span></li>
                  <li><span>MERCH</span></li>
                  <li><span>HOME DELIVERY</span></li>
                </ul>
              </div>
             <?php 
              $terms = get_terms( array(
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
                'parent' => 0
              ) );   
            ?>
              <div class="shop-filter-menu">
                <ul class="reset-list">
                  <li class="active"><a href="<?php echo get_the_permalink(get_option( 'woocommerce_shop_page_id' ));?>"><span>ALL BEERS</span></a></li>
                  <?php 
                  if( $terms ):
                  foreach( $terms as $term ):
                  if( $term->slug !='uncategorized' ):
                  ?>
                  <li><a href="<?php echo get_term_link($term); ?>"><span><?php echo $term->name; ?></span></a></li>
                  <?php endif; endforeach;?>
                  <?php endif; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php 
  $query = new WP_Query(array( 
      'post_type'=> 'product',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'orderby' => 'date'
    ) 
  );
?>
  <section class="shop-all-beers-sec">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        <?php if($query->have_posts()){ $totalproduct = $query->found_posts;?>
          <div class="shop-all-beers-sec-hdr">
            <h2 class="sabs-hdr-title">ALL BEERS</h2>
            <span>
              <?php if( $totalproduct <= 1 ): ?>
                <?php echo $totalproduct; ?> PRODUCT
              <?php elseif($totalproduct > 1): ?>
                <?php echo $totalproduct; ?> PRODUCTS
              <?php endif; ?>
            </span>
          </div>
          <div class="shop-all-beers-sec-grds">
            <ul class="reset-list clearfix">
              <?php 
                while($query->have_posts()): $query->the_post();
                global $product;
                $thumb_id = get_post_thumbnail_id(get_the_ID());
                if(!empty($thumb_id)){
                  $thumbtag = cbv_get_image_tag($thumb_id, 'artgrid');
                } else {
                  $thumbtag = '<img src="'.THEME_URI.'/assets/images/eena-grd-item-fea-img-1.jpg">';
                }
                $spacifi = get_field('right_col');
              ?>
              <li class="fls-pro-red">
                <div class="fls-product-item">
                  <div class="fls-product-item-fea-img-bx inline-bg" style="background: url(<?php echo THEME_URI; ?>/assets/images/product-img-bg.jpg);">
                    <a class="overlay-link" href="<?php the_permalink();?>"></a>
                    <div class="pro-img-angle">
                      <?php if( $spacifi ): ?>
                      <?php if( !empty($spacifi['abv']) ): ?><strong>ABV: &nbsp;<?php echo $spacifi['abv'];?>%</strong><?php endif; ?>
                      <?php endif; ?>
                    </div>
                    <div class="pro-img">
                      <?php echo $thumbtag; ?>
                    </div>
                  </div>
                  <div class="fls-product-item-des">
                    <h4 class="flspid-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
                    <div class="fls-price">
                      <?php echo $product->get_price_html(); ?>
                    </div>
                  </div>
                </div>
              </li>
              <?php endwhile; ?>
            </ul>
          </div>
        <?php } wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
  </section>

<?php get_template_part('templates/payment', 'process'); ?>
<?php get_footer(); ?>