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

function cbv_get_excerpt( $text, $limit = 20 ){
  $excerpt = explode(' ', $text, $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt);
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
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