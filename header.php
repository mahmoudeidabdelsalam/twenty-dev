<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<?php 
	$navbar_scheme   = get_theme_mod( 'navbar_scheme', 'navbar-dark bg-dark' ); // Get custom meta-value.
	$navbar_position = get_theme_mod( 'navbar_position', 'static' ); // Get custom meta-value.
	$search_enabled  = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
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
              <img class="img-fluid" src="<?= $image['url']; ?>"
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

        <div class="navbar-action">
          <a href="<?php echo esc_url(home_url('/dashboard')); ?>">
          <?php 
          if( is_user_logged_in() ): 
            $current_user = wp_get_current_user();
            $name_user = $current_user->display_name;
            ?>
            <img src="<?php echo esc_url( get_avatar_url( $current_user->ID, ['size' => '40'] ) ); ?>" alt="<?= $name_user; ?>">
            <span class="font-bold text-primary">الإحصائيات</span>
          <?php else: ?>
            <i class="fa fa-user"></i>
            <span>تسجيل الدخول</span>
          <?php endif; ?>
          </a>
        </div>
        <!-- btn menu  -->
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topbar" aria-controls="navbar" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'twenty' ); ?>">
					<span class="navbar-toggler-icon"></span>
				</button>
        <!-- menu -->
				<div id="topbar" class="collapse navbar-collapse">
					<?php
						// Loading WordPress Custom Menu (theme_location).
						wp_nav_menu(
							array(
								'menu_class'     => 'navbar-nav ml-auto',
								'container'      => '',
								'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
								'walker'         => new WP_Bootstrap_Navwalker(),
								'theme_location' => 'main-menu',
							)
						);
					?>
				</div><!-- /.navbar-collapse -->

        <div class="social-media">
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'twenty' ); ?>">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- menu -->
        <div id="navbar" class="collapse navbar-collapse">
          <?php
            // Loading WordPress Custom Menu (theme_location).
            wp_nav_menu(
              array(
                'menu_class'     => 'navbar-nav ml-auto',
                'container'      => '',
                'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
                'walker'         => new WP_Bootstrap_Navwalker(),
                'theme_location' => 'primary',
              )
            );
          ?>
        </div><!-- /.navbar-collapse -->
        <div class="navbar-action">
            <a class="btn-primary btn text-white" href="#">
              <i class="fas fa-shield-alt"></i>
              <span>سيارات مفحوصة مضمونة</span>
            </a>
        </div>
      </div><!-- /.container -->
    </nav>

	</header>

	<main id="main"  <?php if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : echo ' style="padding-top: 100px;"'; elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : echo ' style="padding-bottom: 100px;"'; endif; ?>>

