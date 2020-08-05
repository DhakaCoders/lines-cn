  <?php 
  get_header(); 
  while ( have_posts() ) :
  the_post();
  $thumb_id = get_post_thumbnail_id(get_the_ID());
  if(!empty($thumb_id)){
    $thumb = cbv_get_image_src($thumb_id);
  } else {
    $thumb = THEME_URI.'/assets/images/hdflt-img.jpg';
  }
  ?>
  <div class="section-graphics-top"><img src="<?php echo THEME_URI; ?>/assets/images/section-graphics-top.png"></div> 
  <section class="sl-pg-banner bg-position-btm df-page-bnr" style="background-image: url('<?php echo $thumb; ?>');">
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
            <div class="sl-pg-post-content-top">
              <div class="sl-pg-post-content-top-left">
                <ul class="reset-list">
                  <li>BLOG</li>
                </ul>
              </div>
            </div>
            <h2 class="sl-pg-page-title">
              <?php the_title(); ?>
            </h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus est nisi, accumsan sit amet lectus ut, porttitor posuere purus. Vestibulum interdum tincidunt tortor sit amet posuere. Phasellus condimentum tellus nibh, quis varius purus tincidunt quis. </p>
            <div class="sl-pg-page-inr-desc-cntlr">
              <h3 class="sl-pg-page-inr-desc-title">Sed pretium varius metus</h3>
              <div class="sl-pg-page-inr-img">
                <img src="<?php echo THEME_URI; ?>/assets/images/sl-pg-desc-img-001.jpg" alt="">
              </div>
                <p>Ut vel massa hendrerit, lacinia eros eget, faucibus elit. Cras id dapibus ante. Nam molestie, nisi ut euismod sagittis, massa erat scelerisque nibh, non maximus lectus risus vel lectus. Mauris ac dui sodales, molestie lacus non, gravida tortor. Donec <a class="sl-pg-udr-ln" href="#">dictum quam est,</a> sit amet fringilla elit tincidunt at. Nullam semper turpis in feugiat sollicitudin. Sed quis fringilla lacus, eu sagittis nisl. In semper, tellus quis malesuada laoreet, ipsum nibh rhoncus diam, eu imperdiet sem massa sit amet elit. Curabitur vulputate velit non metus pretium maximus. Cras posuere, ex at porttitor tristique, sapien urna efficitur justo, ut posuere magna velit id massa. Quisque ornare pharetra arcu.</p>
                <p>Donec quis suscipit risus. Cras rutrum eget sapien nec ultrices. Sed ultricies vehicula diam sit amet mattis. Pellentesque auctor odio non metus vestibulum, nec pretium orci accumsan. Ut a arcu massa. Sed <a class="sl-pg-udr-ln" href="#">elementum mi fermentum</a> libero finibus, nec viverra elit pellentesque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;</p>
              <h4 class="sl-pg-page-inr-desc-title-an">Nullam pharetra arcu vitae</h4>
                <p>Fusce ligula massa, tincidunt in ornare quis, iaculis sit amet libero. Donec iaculis tempor massa, scelerisque auctor nisi rutrum at. Sed pretium varius metus, id ultrices erat finibus sed. Maecenas id facilisis ante, sit amet hendrerit sem. Donec gravida, nisl pharetra venenatis molestie, lacus elit pretium dolor, sit amet rutrum massa leo at ar<a class="sl-pg-udr-ln" href="#">cu. Aenean dignissim di</a>am ut ultrices sollicitudin. Cras nisi nisl, luctus hendrerit condimentum vitae, vehicula non dui. Suspendisse vel ligula vel metus blandit molestie.</p>
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