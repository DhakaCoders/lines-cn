  <?php 
  get_header(); 
  while ( have_posts() ) :
  the_post();
  $cont = get_field('description', get_the_ID());
  $pageTitle = get_the_title(get_the_ID());
  $custom_page_title = get_field('custom_page_title', get_the_ID());
  if(!empty(str_replace(' ', '', $custom_page_title))){
    $pageTitle = $custom_page_title;
  }

  $pagebanner = get_field('bannerimage', get_the_ID());
  if( empty($pagebanner) ) $pagebanner = THEME_URI.'/assets/images/event-banner-slider.png';
  ?> 
  <section class="sl-pg-banner bg-position-btm df-page-bnr" style="background-image: url('<?php echo $pagebanner; ?>');">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          
        </div>
      </div>
    </div>
  </section>

  <section class="sl-pg-post-content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="sl-pg-post-content-inr">
            <h2 class="sl-pg-page-title">
              <?php echo $pageTitle; ?>
            </h2>
            <div class="default-page">
              <?php if( !empty($cont) ) echo wpautop($cont); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
  endwhile;
  get_footer(); 
  ?>