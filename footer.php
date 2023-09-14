</main><!-- /#main -->
  <footer id="footer" class="bg-dark">
    <div class="container">
      <div class="row">
        <div class="col-md-2 col-12">
          <!-- logo -->
          <div class="navbar-brand">
            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
              <img class="img-fluid" src="<?=get_theme_file_uri().'/assets/img/logo-footer.svg' ?>"
                alt="<?=get_bloginfo('name', 'display') ?>" title="<?=get_bloginfo('name') ?>" />
            </a>
          </div>
        </div>
        <div class="col-md-7 col-12">
          <?php
            if ( has_nav_menu( 'footer-menu' ) ) : // See function register_nav_menus() in functions.php
              wp_nav_menu(
                array(
                  'container'       => 'nav',
                  'container_class' => '',
                  // 'fallback_cb'     => 'WP_Bootstrap4_Navwalker_Footer::fallback',
                  'walker'          => new WP_Bootstrap4_Navwalker_Footer(),
                  'theme_location'  => 'footer-menu',
                  'items_wrap'      => '<ul class="menu nav justify-content-between">%3$s</ul>',
                )
              );
            endif;
          ?>
        </div>
        <div class="col-md-3 col-12 social-media">
          <span class="text-white font-bold">تواصل معنا :</span>
            <ul class="social-icons d-flex">
              <?php
              if( have_rows('social_media', 'option') ):
                while( have_rows('social_media', 'option') ) : the_row();
              ?>
                <li class="m-2 border rounded-100">
                  <a class="text-white" href="<?= get_sub_field('link_social_media'); ?>"><i class="<?= get_sub_field('icon_social_media'); ?> fa-lg"></i></a>
                </li>
              <?php
                endwhile;
              endif;
              ?>
            </ul>          
        </div>        
      </div><!-- /.row -->
    </div><!-- /.container -->
  </footer><!-- /#footer -->
  <div class="copyright">
    <div class="container">
      <div class="row">  
        <div class="col-12">
          <?php 
            if(get_field('logo_footer', 'option')): 
              $image = get_field('logo_footer', 'option');
              $copy_right = get_field('copy_right', 'option');
          ?>
            <span><?= $copy_right; ?></span>
            <img src="<?= $image; ?>" alt="<?= $copy_right; ?>">
          <?php endif; ?>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container -->
  </div>


  <a href="https://wa.me/+966112091447" class="whatsapp-btn whatsapp" target="_blank">
    <img class="img-fluid" src="https://dev.twenty.sa/wp-content/themes/numbertwenty20/assets/img/whatsapp.png" alt="عشرين للسيارات" title="عشرين للسيارات">
  </a>
</div><!-- /#wrapper -->
<?php
  wp_footer();
?>
</body>
</html>
