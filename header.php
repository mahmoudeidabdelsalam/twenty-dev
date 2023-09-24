<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<?php 
	$navbar_scheme   = get_theme_mod( 'navbar_scheme', 'navbar-dark bg-dark' ); // Get custom meta-value.
	$navbar_position = get_theme_mod( 'navbar_position', 'static' ); // Get custom meta-value.
	$search_enabled  = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
  $page_car_hraj = get_field('page_car_hraj', 'option');
  $page_car_used = get_field('page_car_used', 'option');
  $bg_login = get_theme_file_uri().'/assets/img/bg-login.jpg';
  $logo_mobile = get_theme_file_uri().'/assets/img/logo-mobile.svg';
?>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta property="og:site_name" content="Snapchat" />
  <meta property="og:title" content="The fastest way to share a moment!" />

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
        
        <!-- download app in mobile -->
        <div class="app-mobile d-lg-none d-md-none d-flex">
          <span>حمل  تطبيق عشرين الأن</span>
          <a class="btn bg-dark border-0 rounded-0 text-white me-3">
            <span>حمل من متجر أبل</span>
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M17.331 20.3581C16.2972 21.2024 15.1685 21.0691 14.0819 20.6691C12.932 20.2603 11.8771 20.2425 10.664 20.6691C9.14489 21.2202 8.34316 21.0602 7.43593 20.3581C2.28794 15.8875 3.04748 9.07948 8.89172 8.83063C10.3159 8.89284 11.3075 9.48832 12.1409 9.54165C13.3857 9.32834 14.5777 8.71509 15.9069 8.79508C17.4998 8.90173 18.7024 9.435 19.4936 10.3949C16.2023 12.0569 16.9829 15.7098 20 16.7319C19.3987 18.065 18.618 19.3893 17.3205 20.367L17.331 20.3581ZM12.0354 8.7773C11.8771 6.79533 13.7865 5.15998 15.9808 5C16.2867 7.29304 13.5122 8.9995 12.0354 8.7773Z" fill="white"/>
            </svg>
          </a>
        </div>
        <hr class="d-lg-none d-md-none d-flex col-12">
        <!-- menu top-bar-mobile -->
        <div class="top-bar-mobile d-lg-none d-md-none d-flex justify-content-between align-items-center w-100">
          <a class="btn btn-outline-light" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
            <svg width="35" height="36" viewBox="0 0 35 36" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5.88714 8.5H15.3229C15.8234 8.5 16.3034 8.69882 16.6573 9.05273C17.0112 9.40664 17.21 9.88664 17.21 10.3871C17.21 10.8876 17.0112 11.3676 16.6573 11.7216C16.3034 12.0755 15.8234 12.2743 15.3229 12.2743H5.88714C5.38664 12.2743 4.90664 12.0755 4.55273 11.7216C4.19882 11.3676 4 10.8876 4 10.3871C4 9.88664 4.19882 9.40664 4.55273 9.05273C4.90664 8.69882 5.38664 8.5 5.88714 8.5ZM19.0971 23.5971H28.5329C29.0334 23.5971 29.5134 23.796 29.8673 24.1499C30.2212 24.5038 30.42 24.9838 30.42 25.4843C30.42 25.9848 30.2212 26.4648 29.8673 26.8187C29.5134 27.1726 29.0334 27.3714 28.5329 27.3714H19.0971C18.5966 27.3714 18.1166 27.1726 17.7627 26.8187C17.4088 26.4648 17.21 25.9848 17.21 25.4843C17.21 24.9838 17.4088 24.5038 17.7627 24.1499C18.1166 23.796 18.5966 23.5971 19.0971 23.5971ZM5.88714 16.0486H28.5329C29.0334 16.0486 29.5134 16.2474 29.8673 16.6013C30.2212 16.9552 30.42 17.4352 30.42 17.9357C30.42 18.4362 30.2212 18.9162 29.8673 19.2701C29.5134 19.624 29.0334 19.8229 28.5329 19.8229H5.88714C5.38664 19.8229 4.90664 19.624 4.55273 19.2701C4.19882 18.9162 4 18.4362 4 17.9357C4 17.4352 4.19882 16.9552 4.55273 16.6013C4.90664 16.2474 5.38664 16.0486 5.88714 16.0486Z" fill="#323232"/>
            </svg>
          </a>
          <a class="btn btn-primary py-3 px-2 text-white rounded-0" href="<?= $page_car_hraj; ?>">سيارات مفحوصة مضمونة</a>
          <a class="btn bg-blue py-3 px-2 text-white rounded-0" href="<?= $page_car_used; ?>">حراج السيارات المستعملة</a>
        </div>
        <!-- menu topbar dasktop-->
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
        </div><!-- /.social-media -->
			</div><!-- /.container -->
		</nav>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header bg-dark py-5 px-3 d-flex flex-column position-relative">
        <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
          <img class="img-fluid" src="<?=get_theme_file_uri().'/assets/img/logo-footer.svg' ?>" alt="<?=get_bloginfo('name', 'display') ?>" title="<?=get_bloginfo('name') ?>" />
        </a>
        <h3 class="mt-3 text-white">موقع عشرين للسيارات</h3>
        <button type="button" class="btn-close text-reset position-absolute end-0 m-3" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
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
      </div>
    </div><!-- /.menu top-bar-mobile -->
        
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

