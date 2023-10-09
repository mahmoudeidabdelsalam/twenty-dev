<?php
  $user_id = get_current_user_id();
  $query = new WP_Query( array( 'author' => $user_id, 'post_type' => 'cars' ) );
?>

<div class="loader">
  <div class="loading mt-5"></div>
</div>

<!-- Funding  -->
<section class="section-form mb-5">
  <div class="filter col-12 my-3">
    <div class="row g-5 m-0">
      <div class="col-md-6 col-12">
        <div class="input-group flex-nowrap">
          <span class="input-group-text" id="addon-wrapping">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#B3B3B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M21.0004 21L16.6504 16.65" stroke="#B3B3B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <input type="text" class="form-control" placeholder="بحث عن أسم">
        </div>
      </div>
      <div class="col-md-6 col-12">
        <div class="input-group flex-nowrap">
          <span class="input-group-text" id="addon-wrapping">
            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5.5 12L5.5 4" stroke="#B3B3B3" stroke-width="2" stroke-linecap="round"/>
              <path d="M19.5 20L19.5 18" stroke="#B3B3B3" stroke-width="2" stroke-linecap="round"/>
              <path d="M5.5 20L5.5 16" stroke="#B3B3B3" stroke-width="2" stroke-linecap="round"/>
              <path d="M19.5 12L19.5 4" stroke="#B3B3B3" stroke-width="2" stroke-linecap="round"/>
              <path d="M12.5 7L12.5 4" stroke="#B3B3B3" stroke-width="2" stroke-linecap="round"/>
              <path d="M12.5 20L12.5 12" stroke="#B3B3B3" stroke-width="2" stroke-linecap="round"/>
              <circle cx="5.5" cy="14" r="2" stroke="#B3B3B3" stroke-width="2" stroke-linecap="round"/>
              <circle cx="12.5" cy="9" r="2" stroke="#B3B3B3" stroke-width="2" stroke-linecap="round"/>
              <circle cx="19.5" cy="15" r="2" stroke="#B3B3B3" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </span>
          <select class="form-control" name="" id="">
            <option value="0">الكل</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
  <?php            
  if ( $query->have_posts() ):
    while ( $query->have_posts() ):
      $query->the_post();
      $img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
      $author_id = get_the_author_meta('ID');
      $avatar = get_field('user_logo', 'user_'. $author_id);
      $finance_price = get_field('finance_price');
  ?>
    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
      <div class="car-box car-offer">
        <div class="car-box-img position-relative">
          <a class="link-img" href="<?= get_permalink(); ?>"><img class="img-fluid" src="<?= ($img_url)? $img_url:$placeholder; ?>" alt="<?= get_the_title(); ?>"></a>
        </div>
        <div class="car-box-content position-relative p-4">
          <h4 class="text-uppercase"><?= get_the_title(); ?></h4>
          <div class="information">
            <p class="pricing">
              <span class="new-price d-block"><?= the_field('price'); ?> <?= the_field('currency_pricing', 'option'); ?></span>
              <span>شامل الضريبة</span>
            </p>
            <p>
              <span class="author">
                <a class="logo-author" href="#">
                  <img class="img-fluid" src="<?= ($avatar)? $avatar:$placeholder; ?>" alt="<?= the_author_meta( 'display_name', $author_id ); ?>">
                </a>
                <span><?= the_author_meta( 'display_name', $author_id ); ?></span>
                <svg width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M20.2588 8.03857H1.25879M1.25879 8.03857L8.25879 15.0386M1.25879 8.03857L8.25879 1.03857" stroke="#141414" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
            </p>
          </div>
        </div>
        <div class="car-box-footer bg-dark">
          <span>قسط يبدأ من</span>
          <span>|</span>
          <span><?= $finance_price; ?></span>
          <span>ريال/ شهريا</span>
        </div>
      </div>
    </div>
  <?php
    endwhile;
  endif;
  ?>      
  <?php wp_reset_postdata(); ?>    
  </div>
</section>  