<?php
/*
 * initial products dispaly
 */

function ajax_product_script_call(){
    wp_register_script('ajax-product-script', get_stylesheet_directory_uri(). '/assets/js/ajax-scripts.js', array('jquery') );
    wp_enqueue_script('ajax-product-script');

    wp_localize_script( 'ajax-product-script', 'ajax_product_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));
    // Enable the user with no privileges to run ajax_login() in AJAX
}

add_action('wp_enqueue_scripts', 'ajax_product_script_call');


/*
 * load more script call back
 */
function ajax_product_script_load_more() {
  //init ajax
  $ajax = false;
  //check ajax call or not
  if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $ajax = true;
  }
  //number of products per page default
  $num = 2;
  $divider = 2;
  if(isset($_POST['cat']) && !empty($_POST['cat'])){
      $cat = $_POST['cat'];
  }
  $query = new WP_Query(array( 
      'post_type'=> 'product',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'orderby' => 'date',
      'tax_query' => array(
          array(
              'taxonomy' => 'product_cat',
              'field'    => 'slug',
              'terms'    => $cat
          ),
      ),
    ) 
  );
  
  if($query->have_posts()){
  $thumb = $hide_class = '';
  $totalproduct = $query->found_posts;
  $totalPages = ceil($totalproduct/$num);
  $j = 1;
  $i = 0;
  echo '<div class="fanshop-post-grid-wrp btm-bdr-none eena-page-wrap">';
  echo '<div class="eena-pagination-page" data-page="'.$j.'">';
  echo '<ul class="reset-list productItems clearfix">';
  while($query->have_posts()): $query->the_post();
    global $product;
    $thumb_id = get_post_thumbnail_id(get_the_ID());
    if(!empty($thumb_id)){
      $thumb = cbv_get_image_src($thumb_id, 'artgrid');
    } else {
      $thumb = THEME_URI.'/assets/images/eena-grd-item-fea-img-1.jpg';
    }
  ?>
  <li>
    <div class="fanshop-post-grid-inr mHc clearfix">
      <div class="fanshop-post-grid-img-cntlr">
        <a href="<?php the_permalink();?>" class="overlay-link"></a>
        <div class="fanshop-post-grid-img" style="background: url(<?php echo $thumb; ?>);">
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
  </li>
  <?php
  if( $j == $divider ){ echo '</ul></div><div class="eena-pagination-page" data-page="'.$j.'"><ul class="reset-list productItems clearfix">'; $divider += $num; }

  $j++;
  endwhile;
  echo '</ul>';
  echo '</div>';
  if( $totalPages > 1):
  echo '<div class="eena-pagination-wrp"><div class="fl-pagi-ctlr">';
   echo '<ul class="page-numbers reset-list pgajax">';
        for( $i = 1; $i <= $totalPages; $i++ ){
          if( $i == 1 ){
            echo '<li><a href="#" class="page-numbers current" data-page="'.$i.'">'.$i.'</a></li>';
          }else{
            echo '<li><a href="#" class="page-numbers" data-page="'.$i.'">'.$i.'</a></li>';
          }
        }
  echo '</ul></div></div>';
  endif;
  }else{
    echo '<div class="no-results">Geen resultaten</div>';
  }  
  wp_reset_postdata();
  
  //check ajax call
  if($ajax) wp_die();
}

/*
 * load more script ajax hooks
 */
add_action('wp_ajax_nopriv_ajax_product_script_load_more', 'ajax_product_script_load_more');
add_action('wp_ajax_ajax_product_script_load_more', 'ajax_product_script_load_more');
