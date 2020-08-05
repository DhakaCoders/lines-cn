  <?php 
  $fttab = get_field('footertab', 'options');
  $logoObj = $fttab['logo'];
  if( is_array($logoObj) ){
    $logo_tag = '<img src="'.$logoObj['url'].'" alt="'.$logoObj['alt'].'" title="'.$logoObj['title'].'">';
  }else{
    $logo_tag = '';
  }
  $spacialArry = array(".", "/", "+", " ");$replaceArray = '';
  $continfo = get_field('contactinfo', 'options');
  $e_mailadres1 = $continfo['emailaddress_1'];
  $e_mailadres2 = $continfo['emailaddress_2'];
  $show_telefoon1 = $continfo['telephone_1'];
  $show_telefoon2 = $continfo['telephone_2'];
  $telefoon1 = trim(str_replace($spacialArry, $replaceArray, $show_telefoon1));
  $telefoon2 = trim(str_replace($spacialArry, $replaceArray, $show_telefoon2));
  $instagram = get_field('instagram_url', 'options');
  $facebook = get_field('facebook_url', 'options');
  $twitter = get_field('twitter_url', 'options');
  $copyright_text = get_field('copyright_text', 'options');
  $smedias = get_field('socialmedia', 'options');
?>
  <div class="contact-ctlr">
  <footer class="footer-wrp">
    <div class="footer-top-sec">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-12">
            <div class="ftr-col">
              <div class="ftr-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                  <?php echo $logo_tag; ?>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="ftr-col ftr-visit-col">
              <h5 class="ftr-col-title">VISIT OUR SHOP</h5>
              <p>For pick-up or deli
              very beer and merch, please visit our SHOP Please note we are only delivering beer to Phoenix and East Valley with a $30 minimum order!  </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="ftr-col">
              <h5 class="ftr-col-title">CONTACT US</h5>
              <p>
                <span>Gilbert Brewpub:</span> <a href="#">480-497-2739</a> 
                <?php if( !empty( $show_telefoon1 ) ) printf('<span>Gilbert Brewpub:</span><a href="tel:%s">%s</a>', $telefoon1, $show_telefoon1);  ?>
                <?php if( !empty( $show_telefoon2 ) ) printf('DTPHX: <a href="tel:%s">%s</a>', $telefoon2, $show_telefoon2);  ?>
                <?php if( !empty( $e_mailadres1 ) ) printf('For general inquiries: <a href="mailto:%s">%s</a>', $e_mailadres1, $e_mailadres1);  ?>
                <?php if( !empty( $e_mailadres2 ) ) printf('For keg inquiries: <a href="mailto:%s">%s</a>', $e_mailadres2, $e_mailadres2);  ?>
              </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="ftr-col">
              <h5 class="ftr-col-title">CURRENT INITIATIVES</h5>
              <p>In our efforts to become a more cognizant and sustainable business, we’ve partner with Recycled City who’s vision of “Farmland for the Future” is som
              ething we passionately support! </p>
              <p>100% of the food waste collected by Recycled City goes towards building local-fertile farmland.</p>
            </div>
          </div>
        </div>
      </div>
    </div> 

    <div class="footer-btm-con-wrap">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="footer-btm-con">
                <div class="ftr-socila">
                  <ul class="clearfix reset-list"> 
                    <?php if( !empty( $instagram ) ): ?>
                    <li>
                      <a class="ftr-social-instagram" href="<?php echo $instagram; ?>">
                        <i class="fab fa-instagram"></i>
                      </a>
                    </li>
                    <?php endif; if( !empty( $facebook ) ): ?>
                    <li>
                      <a class="ftr-social-facebook" href="<?php echo $facebook; ?>">
                        <i class="fab fa-facebook-square"></i>
                      </a>
                    </li>
                    <?php endif; if( !empty( $twitter ) ): ?>
                    <li>
                      <a class="ftr-social-twitter" href="<?php echo $twitter; ?>">
                        <i class="fab fa-twitter-square"></i>
                      </a>
                    </li>
                    <?php endif; ?>
                  </ul>
                </div>
                <div class="ftr-copyright-text">
                  <?php if( !empty( $copyright_text ) ) printf( '<span>%s</span>', $copyright_text); ?>  
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </footer>
  </div>
</div>
<?php wp_footer(); ?>
</body>
</html>