<?php
/**
 * Template Name: Page (Default)
 * Description: Page template with Sidebar on the left side.
 *
 */

get_header();

the_post();

$banner           = get_the_post_thumbnail_url( get_the_ID(), 'full');
$headline_banneer = get_field('headline_banneer');
$content_banneer  = get_field('content_banneer');
?>

<section class="container-fluid position-relative">
  <div class="row">
    <?php if($banner): ?>
      <img class="img-fluid p-0" src="<?= $banner; ?>" alt="<?= the_title(); ?>">
      <div class="banneer-content position-absolute top-0 bottom-0 w-100 d-flex align-items-center">
        <div class="container">
          <div class="row">
             <h2><?= $headline_banneer; ?></h2>
             <?= $content_banneer; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<div class="container">
  <div class="row">
    <div class="col-md-8 order-md-2 col-sm-12 pt-5 pb-5 min-vh-100 the-content">
      <div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?>>
        <?php the_content(); ?>
      </div><!-- /#post-<?php the_ID(); ?> -->
      <div class="related-page">
        <ul class="d-flex flex-column flex-md-row">
          <?php
          if( have_rows('related_page') ):
            while( have_rows('related_page') ) : the_row();
            $link = get_sub_field('page_link');
            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            endif;
          ?>
            <li class="m-2">
              <a class="item-page-related" <?= $link_target; ?> href="<?= $link_url; ?>">
                <div class="img-page-related">
                  <img src="<?= get_sub_field('page_icon'); ?>" alt="<?= $link_title; ?>">
                </div>
                <div class="content-page-related">
                  <span><?= $link_title; ?></span>
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </div>
              </a>
            </li>
          <?php
            endwhile;
          endif;
          ?>
        </ul>         
      </div>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div>
<?php
get_footer();
