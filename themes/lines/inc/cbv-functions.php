<?php 
/**
* Get the image tag with alt/title tag
*/
function cbv_get_image_tag( $id, $size = 'full', $title = false ){
	if( isset( $id ) ){
		$output = '';
		$image_title = get_the_title($id);
		$image_alt = get_post_meta( $id, '_wp_attachment_image_alt', true);
    if( empty( $image_alt ) ){
      $image_alt = $image_title;
    }
		$image_src = wp_get_attachment_image_src( $id, $size, false );

		if( $title ){
			$output = '<img class="style-svg" src="'.$image_src[0].'" alt="'.$image_alt.'" title="'.$image_title.'">';
		}else{
			$output = '<img class="style-svg" src="'.$image_src[0].'" alt="'.$image_alt.'">';
		}

		return $output;
	}
	return false;
}

/**
* Get the image src url by attachement it
*/
function cbv_get_image_src( $id, $size = 'full' ){
  if( isset( $id ) ){
    $afbeelding = wp_get_attachment_image_src($id, $size, false );
    if( is_array( $afbeelding ) && isset( $afbeelding[0] ) ){
      return $afbeelding[0];
    }
  }
  return false;
}
/**
* Get the image tag with alt/title tag
*/
function cbv_get_image_alt( $url ){
  if( isset( $url ) ){
    $output = '';
    $id = attachment_url_to_postid($url);
    $image_title = get_the_title($id);
    $image_alt = get_post_meta( $id, '_wp_attachment_image_alt', true);
    if( empty( $image_alt ) ){
      $image_alt = $image_title;
    }
    $image_alt = str_replace('-', ' ', $image_alt);
    $output = $image_alt;

    return $output;
  }
  return false;
}

/*Allow Span tags in editor*/
function myextensionTinyMCE($init) {
    // Command separated string of extended elements
    $ext = 'span[id|name|class|style]';

    // Add to extended_valid_elements if it alreay exists
    if ( isset( $init['extended_valid_elements'] ) ) {
        $init['extended_valid_elements'] .= ',' . $ext;
    } else {
        $init['extended_valid_elements'] = $ext;
    }

    // Super important: return $init!
    return $init;
}

add_filter('tiny_mce_before_init', 'myextensionTinyMCE' );

// Changing excerpt more
 function new_excerpt_more($more) {
   global $post;
   return '… <a href="'. get_permalink($post->ID) . '">' . '....more >>' . '</a>';
 }
 add_filter('excerpt_more', 'new_excerpt_more');

// tn custom excerpt length
function tn_custom_excerpt_length( $length ) {
return 50;
}
add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );

function cbv_get_excerpt( $limit = 20 ){
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt);
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace("/<.*?>/", " ", $excerpt);
  return $excerpt;
}

function cbv_limit_excerpt( $limit = 52 ){
   global $post;
  $link = ' <a href="'. get_permalink($post->ID) . '">Continue Reading...</a>';

  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt);
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt .= $link;
  return $excerpt;
}

function cbv_table( $table){
  if ( ! empty ( $table ) ) {
    echo '<div class="dfp-tbl-wrap">
    <div class="table-dsc" data-aos="fade-up" data-aos-delay="200">
    <table>';
    if ( ! empty( $table['caption'] ) ) {
      echo '<caption>' . $table['caption'] . '</caption>';
    }
    if ( ! empty( $table['header'] ) ) {
      echo "<thead class='dfp-thead'>";
      echo '<tr>';
      foreach ( $table['header'] as $th ) {
        echo '<th><span class="mHc">';
        echo $th['c'];
        echo '</span></th>';
      }
      echo '</tr>';
      echo '</thead>';
    }
    echo '<tbody>';
    foreach ( $table['body'] as $tr ) {
      echo '<tr>';
      foreach ( $tr as $td ) {
        echo '<td><span class="mHc">';
        echo $td['c'];
        echo '</span></td>';
      }
      echo '</tr>';
    }
    echo '</tbody>';
    echo '</table></div>';
    echo '</div>';
  }  
}


function hex_to_rgb( $hex ){
  if( !empty($hex) ){
    $hex = str_replace('#', '', $hex);
    if(strlen($hex) > 3) $color = str_split($hex, 2);
    else $color = str_split($hex);
    return [hexdec($color[0]), hexdec($color[1]), hexdec($color[2])];
  }else{
    return false;
  }
}

function redirect_after_add_to_cart( $url ) {
    return esc_url( get_permalink( get_page_by_title( 'cart' ) ) );
}
add_filter( 'woocommerce_add_to_cart_redirect', 'redirect_after_add_to_cart', 99 );


add_action('wp_enqueue_scripts', 'postalcode_action_hooks');


function postalcode_action_hooks(){
    checkPostalcode_init();
    popupcheck_init();
}

function checkPostalcode_init(){
    wp_register_script('checkpostalcode-script', get_stylesheet_directory_uri(). '/assets/js/ajax-scripts.js', array('jquery') );
    wp_enqueue_script('checkpostalcode-script');

    wp_localize_script( 'checkpostalcode-script', 'checkpostalcode_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));
    // Enable the user with no privileges to run ajax_login() in AJAX
}
add_action('wp_ajax_nopriv_postalcode_check', 'checkPostalcode');
add_action('wp_ajax_postalcode_check', 'checkPostalcode');
function checkPostalcode(){
  $data = array();
  if (isset( $_POST["postalcode"] ) && wp_verify_nonce($_POST['user_postalcode_nonce'], 'user-postalcode-nonce')){
    global $wpdb; 
    $postcode = $_POST["postalcode"];
    if( isset($postcode) && !empty($postcode) ){
      $hdelivery = get_field('hdelivery', 'options');
      $postcodes = $hdelivery['postcodes'];
      //var_dump($userInfo);
      if( !empty($postcodes) ){
        $exCode = explode(', ', $postcodes);
        $codeArray = array();
        if( isset($exCode) ){
          foreach ($exCode as $val) {
            $codeArray[] = $val;
          }
        }
        if( in_array($postcode, $codeArray) ){
          $data['match'] = 'match';
        }else{
          $data['notmatch'] = 'notmatch';
        }
      }else{
          $data['notmatch'] = 'notmatch';
      }


    }else{
      $data['required'] = 'Field is required';
    }
  }else{
    $data['error'] = 'Something was wrong.';
  }
  echo json_encode($data);
  wp_die();
}


function popupcheck_init(){
    wp_register_script('popupcheck-script', get_stylesheet_directory_uri(). '/assets/js/ajax-scripts.js', array('jquery') );
    wp_enqueue_script('popupcheck-script');

    wp_localize_script( 'popupcheck-script', 'popupcheck_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));
    // Enable the user with no privileges to run ajax_login() in AJAX
}
add_action('wp_ajax_nopriv_popupcheckCode', 'popupcheckCode');
add_action('wp_ajax_popupcheckCode', 'popupcheckCode');
function popupcheckCode(){
  $data = array();
  if (isset( $_POST["check"] ) && $_POST["check"] == 1){
    if (!isset($_COOKIE['hpopup'])){
      $data['success'] = 'success';
    }else{
      $data['error'] = 'error';
    }
    echo json_encode($data);
    wp_die();
  }
}