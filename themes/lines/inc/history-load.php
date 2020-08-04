<?php
/*
 * initial posts dispaly
 */

function ajax_history_script_call(){
    wp_register_script('ajax-history-script', get_stylesheet_directory_uri(). '/assets/js/ajax-scripts.js', array('jquery') );
    wp_enqueue_script('ajax-history-script');

    wp_localize_script( 'ajax-history-script', 'ajax_history_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));
    // Enable the user with no privileges to run ajax_login() in AJAX
}

add_action('wp_enqueue_scripts', 'ajax_history_script_call');


/*
 * load more script call back
 */
function ajax_history_script_load_more() {
  //init ajax
  $ajax = false;
  //check ajax call or not
  if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $ajax = true;
  }
  //number of posts per page default
  $num = 2;
  if(isset($_POST['cat']) && !empty($_POST['cat'])){
      $cat = $_POST['cat'];
  }
  $query = new WP_Query(array( 
      'post_type'=> 'history',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'orderby' => 'date',
      'tax_query' => array(
          array(
              'taxonomy' => 'history_cat',
              'field'    => 'slug',
              'terms'    => $cat
          ),
      ),
    ) 
  );
  
  if($query->have_posts()){
  echo '<div class="eena-page-wrap">';
  echo '<ul class="reset-list">';
  while($query->have_posts()): $query->the_post();
    $thumb_id = get_post_thumbnail_id(get_the_ID());
    if(!empty($thumb_id)){
      $thumb = cbv_get_image_src($thumb_id, 'historygrid');
    } else {
      $thumb = THEME_URI.'/assets/images/dfhistorygrid.jpg';
    }
    $jaar = get_field('jaar', get_the_ID());
  ?>
  <li>
    <div class="time-line-img">
      <div class="time-line-img-inr inline-bg" style="background: url(<?php echo $thumb; ?>)"></div>
    </div>
    <div class="time-line-des"> 
      <?php if( !empty($jaar) ) printf('<strong class="time-line-des-hdng">#%s<span></span></strong>', $jaar); ?>
      <h3 class="time-line-des-title"><?php the_title(); ?></h3>
      <?php the_content(); ?>
    </div>
  </li>
  <?php
  $j++;
  endwhile;
  echo '</ul>';
  echo '</div>';
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
add_action('wp_ajax_nopriv_ajax_history_script_load_more', 'ajax_history_script_load_more');
add_action('wp_ajax_ajax_history_script_load_more', 'ajax_history_script_load_more');
