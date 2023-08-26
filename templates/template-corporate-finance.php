<?php
/* Template Name: Corporate finance */ 
/*
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#hom-page
 *
*/

get_header(); 
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
$banner = get_the_post_thumbnail_url( get_the_ID(), 'full');
?>

<section class="container-fluid">
  <div class="row">
    <?php if($banner): ?>
      <img class="img-fluid p-0" src="<?= $banner; ?>" alt="<?= the_title(); ?>">
    <?php endif; ?>
  </div>
</section>

<div class="container  mt-5 mb-5">
  <div class="row">
    <?php
    $counter = 0;
      if( have_rows('box_finance') ):
        while ( have_rows('box_finance') ) : the_row();
        $form_id = get_sub_field('id_form_box_finance');
        $counter++;
      ?>
      <div class="col-md-4 col-12 mb-5">
        <div class="box-finance">
          <div class="icon-box-finance" style="background-color:<?= the_sub_field('color_box_finance'); ?>">
            <img src="<?= the_sub_field('icon_box_finance'); ?>" alt="<?= the_sub_field('headline_box_finance'); ?>">
          </div>
          <div class="content-box-finance">
            <h3><?= the_sub_field('headline_box_finance'); ?></h3>
            <p><?= the_sub_field('content_box_finance'); ?></p>
          </div>
          <div class="action-box-finance">
            <!-- Button trigger modal -->
            <button type="button" class="btn text-white w-100" style="background-color:<?= the_sub_field('color_box_finance'); ?>" data-bs-toggle="modal" data-bs-target="#exampleModal-<?= $counter; ?>">
              <span>ملئ البيانات</span> <i class="fas fa-arrow-left"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade forms" id="exampleModal-<?= $counter; ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <?=  do_shortcode( '[gravityform id="'.(int)$form_id.'" title="false" description="false" ajax="true"]' ); ?>
                  </div>
                </div>
              </div>
            </div>            
          </div>
        </div>
      </div>

      <?php 
        endwhile;
      endif;
    ?>
  </div>
</div>

<?php
  endwhile;
endif;
get_footer();
?>