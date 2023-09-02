<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<?php 
	$navbar_scheme   = get_theme_mod( 'navbar_scheme', 'navbar-dark bg-dark' ); // Get custom meta-value.
	$navbar_position = get_theme_mod( 'navbar_position', 'static' ); // Get custom meta-value.
	$search_enabled  = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
  $page_car_hraj = get_field('page_car_hraj', 'option');
  $bg_login = get_theme_file_uri().'/assets/img/bg-login.jpg';
  $logo_mobile = get_theme_file_uri().'/assets/img/logo-mobile.svg';
?>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

  <!--WordPress head-->
  <?php wp_head(); ?>

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/78fbadd4c2.js" crossorigin="anonymous"></script>

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-M435QTM9ES"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-M435QTM9ES');
  </script>

  <!-- Google Tag Manager -->
  <script>
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-K9C75P9');
  </script>
  <!-- End Google Tag Manager -->
  <!-- Meta Pixel Code -->
  <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '382207210761797');
      fbq('track', 'PageView');
  </script>
  <!-- End Meta Pixel Code -->
  <!-- Twitter conversion tracking base code -->
  <script>
      !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
      },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
      a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
      twq('config','oc7vh');
  </script>
  <!-- End Twitter conversion tracking base code -->
  <!-- Snap Pixel Code -->
  <script type='text/javascript'>
      (function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
      {a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
      a.queue=[];var s='script';r=t.createElement(s);r.async=!0;
      r.src=n;var u=t.getElementsByTagName(s)[0];
      u.parentNode.insertBefore(r,u);})(window,document,
      'https://sc-static.net/scevent.min.js');
      
      snaptr('init', 'f6e0d6f6-6dd5-4da9-8036-392fa48f05cf', {
      'user_email': '_INSERT_USER_EMAIL_'
      });
      
      snaptr('track', 'PAGE_VIEW');
  </script>
  <!-- End Snap Pixel Code -->
  <script>
  !function (w, d, t) {
    w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var i="https://analytics.tiktok.com/i18n/pixel/events.js";ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};var o=document.createElement("script");o.type="text/javascript",o.async=!0,o.src=i+"?sdkid="+e+"&lib="+t;var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(o,a)};
  
    ttq.load('CGGAQ4JC77U2RIRLI5GG');
    ttq.page();
  }(window, document, 'ttq');
  </script>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<a href="#main" class="visually-hidden-focusable"><?php esc_html_e( 'Skip to main content', 'twenty' ); ?></a>

<div id="wrapper">
	<header>
		<nav class="navbar navbar-expand-md top-bar">
			<div class="container">
        <!-- logo -->
        <?php 
        if(get_field('logo', 'option')): 
        $image = get_field('logo', 'option');
        ?>
          <div class="navbar-brand">
            <a href="<?php echo esc_url(home_url('/')); ?>"
              title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
              <img class="img-fluid d-none d-lg-block d-md-block" src="<?= $image['url']; ?>"
                alt="<?=get_bloginfo('name', 'display') ?>" title="<?=get_bloginfo('name') ?>" />
              <img class="img-fluid d-block d-lg-none d-md-none" style="width:43px;" src="<?= $logo_mobile; ?>"
                alt="<?=get_bloginfo('name', 'display') ?>" title="<?=get_bloginfo('name') ?>" />
            </a>
          </div>
        <?php else: ?>
          <div class="navbar-brand">
            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
              <img class="img-fluid" src="<?=get_theme_file_uri().'/assets/img/logo.png' ?>"
                alt="<?=get_bloginfo('name', 'display') ?>" title="<?=get_bloginfo('name') ?>" />
            </a>
          </div>
        <?php endif; ?>

        <div class="navbar-action d-lg-flex d-md-flex d-none">
          <?php 
          if( is_user_logged_in() ): 
            $current_user = wp_get_current_user();
            $name_user = $current_user->display_name;
            ?>
            <a href="<?php echo esc_url(home_url('/dashboard')); ?>">
              <img src="<?php echo esc_url( get_avatar_url( $current_user->ID, ['size' => '40'] ) ); ?>" alt="<?= $name_user; ?>">
              <span class="font-bold text-primary">الإحصائيات</span>
            </a>
          <?php else: ?>
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="fa fa-user"></i>
              <span>تسجيل الدخول</span>
            </a>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header position-absolute w-100 z-1 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body py-0">
                    <div class="row py-0">
                      <?php 
                      $login = array(
                        'echo'            => true,
                        'redirect'        => get_permalink( get_the_ID() ),
                        'remember'        => true,
                        'value_remember'  => true,
                      );
                      ?>                      
                      <div class="col-md-6 col-12 p-0">
                        <div class="login-header">
                          <h3>أنشاء حساب</h3>
                        </div>  
                        <div class="login-body">
                          <?php wp_login_form($login); ?>
                        </div>
                      </div>
                      <div class="col-md-6 col-12" style="background-image:url('<?= $bg_login; ?>');min-height:540px;"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>            
          <?php endif; ?>
        </div>

        <div class="app-mobile d-lg-none d-md-none d-flex">
          <span>حمل  تطبيق عشرين الأن</span>
        </div>

        <!-- menu -->
				<div id="topbar" class="collapse navbar-collapse">
					<?php
						// Loading WordPress Custom Menu (theme_location).
						wp_nav_menu(
							array(
								'menu_class'     => 'navbar-nav ml-auto p-0',
								'container'      => '',
								'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
								'walker'         => new WP_Bootstrap_Navwalker(),
								'theme_location' => 'main-menu',
							)
						);
					?>
				</div><!-- /.navbar-collapse -->

        <div class="social-media d-none d-lg-flex">
          <span>تواصل معنا :</span>
            <ul class="social-icons">
              <?php
              if( have_rows('social_media', 'option') ):
                while( have_rows('social_media', 'option') ) : the_row();
              ?>
                <li>
                  <a href="<?= get_sub_field('link_social_media'); ?>"><i class="<?= get_sub_field('icon_social_media'); ?> fa-lg"></i></a>
                </li>
              <?php
                endwhile;
              endif;
              ?>
            </ul>          
        </div>

			</div><!-- /.container -->
		</nav>

    <nav class="navbar navbar-expand-md <?php echo esc_attr( $navbar_scheme ); if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : echo ' fixed-top'; elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : echo ' fixed-bottom'; endif; if ( is_home() || is_front_page() ) : echo ' home'; endif; ?>">
      <div class="container">
        <!-- menu -->
        <div id="navbar" class="collapse navbar-collapse show">
          <?php
            // Loading WordPress Custom Menu (theme_location).
            wp_nav_menu(
              array(
                'menu_class'     => 'navbar-nav ml-auto p-0',
                'container'      => '',
                'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
                'walker'         => new WP_Bootstrap_Navwalker(),
                'theme_location' => 'primary',
              )
            );
          ?>
        </div><!-- /.navbar-collapse -->
        <div class="navbar-action d-none d-lg-block">
            <a class="btn-primary btn text-white" href="<?= $page_car_hraj; ?>">
              <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.764 3.17863L10.435 0.466174C9.51864 0.07345 8.48136 0.0734496 7.56501 0.466174L1.23596 3.17863C0.789482 3.36997 0.5 3.80898 0.5 4.29473V10.6732C0.5 13.0262 1.63632 15.2343 3.55098 16.6019L7.58842 19.4858C8.43283 20.0889 9.56717 20.0889 10.4116 19.4858L14.449 16.6019C16.3637 15.2343 17.5 13.0262 17.5 10.6732V4.29473C17.5 3.80898 17.2105 3.36997 16.764 3.17863ZM13.4236 7.76185C13.7686 7.33059 13.6987 6.70129 13.2674 6.35628C12.8362 6.01128 12.2069 6.0812 11.8619 6.51246L7.70269 11.7115L6.06414 10.0729C5.67362 9.68238 5.04045 9.68238 4.64993 10.0729C4.2594 10.4634 4.2594 11.0966 4.64993 11.4871L6.68349 13.5207C7.31565 14.1528 8.35696 14.0952 8.91545 13.3971L13.4236 7.76185Z" fill="white"/>
              </svg>
              <span>سيارات مفحوصة مضمونة</span>
            </a>
        </div>
      </div><!-- /.container -->
    </nav>

	</header>

	<main id="main"  <?php if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : echo ' style="padding-top: 100px;"'; elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : echo ' style="padding-bottom: 100px;"'; endif; ?>>

