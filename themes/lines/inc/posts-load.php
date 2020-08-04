

<?php
/*
 * initial posts dispaly
 */

function post_script_load_more($args = array()) {
  $termID = '';
  $cterm = get_queried_object();
  if( !empty($cterm) && !is_wp_error($cterm) ){
    $termID = $cterm->term_id;
  }
  echo '<ul class="reset-list" id="post-content">';
      ajax_post_script_load_more($args, $termID);
  echo '</ul>';
 
  echo '<div class="post-more-btn">
  <div class="ajaxloading" id="ajxaloader" style="display:none"><img src="'.THEME_URI.'/assets/images/loading.gif" alt="loader"></div>
   <div class="lines-stories-button"><a href="#" id="loadMore"  data-page="1" data-url="'.admin_url("admin-ajax.php").'" >LOAD MORE</a></div>';
   echo '</div>';

}
/*
 * create short code.
 */
add_shortcode('ajax_posts', 'post_script_load_more');


/*
 * load more script call back
 */
function ajax_post_script_load_more($args, $termID = '') {
    //init ajax
    $ajax = false;
    //check ajax call or not
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $ajax = true;
    }
    //number of posts per page default
    $num =1;
    //page number
    $paged = 1;
    if(isset($_POST['catid']) && !empty($_POST['catid'])){
        $termID = $_POST['catid'];
    }
    
    if(isset($_POST['page']) && !empty($_POST['page'])){
        $paged = $_POST['page'] + $paged;
    }
     if(!empty($termID)){
        $query = new WP_Query(array( 
            'post_type'=> 'post',
            'post_status' => 'publish',
            'posts_per_page' =>$num,
            'paged'=>$paged,
            'orderby' => 'date',
            'order'=> 'DESC',
            'tax_query' => array(
              array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $termID
              )
            ),
          ) 
        );
     }else{
       $query = new WP_Query(array( 
            'post_type'=> 'post',
            'post_status' => 'publish',
            'posts_per_page' =>$num,
            'paged'=>$paged,
            'orderby' => 'date',
            'order'=> 'DESC'
          ) 
        );
     }

    if($query->have_posts()):

    while($query->have_posts()): $query->the_post();
      $thumb_id = get_post_thumbnail_id(get_the_ID());
      if(!empty($thumb_id)){
        $thumb = cbv_get_image_src($thumb_id, 'hbloggrid');
      } else {
        $thumb = THEME_URI.'/assets/images/hdflt-img.jpg';
      }
        ?>
        <li>
          <div class="lines-stories-items">
            <div class="lines-stories-items-img-cntlr">
              <div class="lines-stories-items-img inline-bg" style="background-image: url('<?php echo $thumb; ?>');">
              </div>
              <div class="lines-stories-items-img-dates inline-bg" style="background-image: url('<?php echo THEME_URI; ?>/assets/images/lines-sec-right-angle-img.png');">
                  <span><?php echo get_the_date('d.m.y'); ?></span>
              </div>
              <a class="overlay-link" href="<?php the_permalink();?>"></a>
            </div>
            <div class="lines-stories-items-hedding">
              <h4 class="lines-stories-items-title" ><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
            </div>
            <div class="lines-stories-items-desc">
              <?php the_excerpt(); ?>
            <div class="sl-pg-grid-btn">
              <a href="<?php the_permalink();?>"><?php _e('READ MORE', THEME_NAME); ?></a>
            </div>
          </div>
        </li>
        <?php
    endwhile; 
    endif;  
    
    wp_reset_postdata();
    //check ajax call
    if($ajax) wp_die();
}

/*
 * load more script ajax hooks
 */
add_action('wp_ajax_nopriv_ajax_post_script_load_more', 'ajax_post_script_load_more');
add_action('wp_ajax_ajax_post_script_load_more', 'ajax_post_script_load_more');