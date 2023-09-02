<?php 
$args = array(
  'post_type'        => array( 'cars' ),
  'posts_per_page' => -1,  
);

$query = new WP_Query( $args );
?>
<div class="loader">
  <div class="loading mt-5"></div>
</div>
<!-- Suggested Cars  -->
<section class="section-form mb-5" id="SuggestedCars" style="display:none;">
  <div class="row">
    <div class="col-md-7 col-12 mt-5">
      <div class="card bg-gray p-5">
        <h2 class="font-bold h4 mb-3">السيارات المقترحة</h2>
        <p>سيوفر عليك هذا الأختيار مرحلة ادخال بيانات وصور للسيارة لأنه مجرد ان تختار السيارة ستتم أضافة البيانات والصور الخاصة بالسيارة بشكل تلقائي</p>
        <a href="#AddSuggestedCars" class="btn btn-dark text-white py-2 mt-4 font-bold">
          <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5.5 12H19.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12.5 5L19.5 12L12.5 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>        
          <span>أذهب الى السيارات المقترحة</span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Add Suggested Cars  -->
<section class="section-form mb-5" id="AddSuggestedCars">
  <div class="row">
    <div class="col-12 section-head mt-5">
      <h2> <a  class="text-dark mb-4" href="#SuggestedCars"> <i class="fas fa-angle-right"></i> <span>اضافة سيارة من المقترحة</span></a></h2>
      <span>* كل الخانات أساسية</span>
      <hr>
    </div>
    <div class="col-md-6 col-12">
      <div class="mb-5">
        <label for="SelectSuggestedCars" class="form-label">* اسم السيارة</label>
        <select class="form-select form-select-lg mb-5" id="SelectSuggestedCars" aria-label="Large select example">
          <option selected>اختار السيارة</option>
          <?php
          if ( $query->have_posts() ):
            while ( $query->have_posts() ):
            $query->the_post();
          ?>
            <option value="<?= the_ID(); ?>"><?= the_title(); ?></option>
          <?php 
            endwhile;
          endif;
          ?>          
        </select>
      </div>
      <a class="btn btn-primary btn-lg w-100" href="#PhotoSuggestedCars">
        <span>الخطوة التالية</span>
      </a>
    </div>
  </div>
</section>

<!-- Photo Suggested Cars  -->
<section class="section-form mb-5" id="PhotoSuggestedCars" style="display:none;">
  <div class="row">
    <div class="col-12 section-head mt-5">
      <h2> <a  class="text-dark mb-4" href="#SuggestedCars"> <i class="fas fa-angle-right"></i> <span>اضافة سيارة من المقترحة</span></a></h2>
      <span>* كل الخانات أساسية</span>
      <hr>
    </div>
    <div class="col-12 section-head mt-5">
      <h2><span>الصور المقترحة التي تم أضافتها تلقائيا</span></h2>
    </div>
    <div class="col-md-6 col-12 mt-3 mb-5">
      <div class="mb-5">
        <label for="SelectSuggestedCars" class="form-label">* اسم السيارة</label>
        <input type="text" class="form-control" id="car_id" readonly>
      </div>
    </div>
    <div class="col-md-12 col-12" id="PhotoCars">
    </div>
    <div class="col-md-6 col-12">
      <a class="btn btn-primary btn-lg w-100 mt-3" href="#DataSuggestedCars">
        <span>الخطوة التالية</span>
      </a>
    </div>
  </div>
</section>

<!-- Data Suggested Cars  -->
<section class="section-form mb-5" id="DataSuggestedCars" style="display:none;">
  <div class="row">
    <div class="col-12 section-head mt-5">
      <h2> <a  class="text-dark mb-4" href="#SuggestedCars"> <i class="fas fa-angle-right"></i> <span>اضافة سيارة من المقترحة</span></a></h2>
      <span>* كل الخانات أساسية</span>
      <hr>
    </div>
    <div class="col-md-6 col-12" id="DataCars">
      <div class="mb-5">
        <label for="FormCarName" class="form-label">* اسم السيارة</label>
        <input type="text" class="form-control" id="FormCarName" placeholder="اسم السيارة">
      </div>
      <div class="mb-5">
        <label for="FormCarPrice" class="form-label">* السعر قبل الضريبة</label>
        <input type="number" class="form-control" id="FormCarPrice" placeholder="السعر قبل الضريبة">
      </div>
      <div class="mb-5">
        <label for="FormCarPriceAfter" class="form-label">* السعر بعد الضريبة</label>
        <input type="number" class="form-control" id="FormCarPriceAfter" placeholder="السعر بعد الضريبة">
      </div>
      <div class="mb-5">
        <label for="FormCarInstallment" class="form-label">* قسط يبدأ من ( تظهر لموظفين عشرين فقط )</label>
        <input type="number" class="form-control" id="FormCarInstallment" placeholder="">
      </div>    

      <a class="btn btn-primary btn-lg w-100" id="AddNewSuggestedCars">
        <span>الخطوة التالية</span>
      </a>              
    </div>
  </div>
</section>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header bg-primary">
      <strong class="ms-auto">موقع عشرين</strong>
      <button type="button" class="btn-close ms-0" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body"></div>
  </div>
</div>


<script>
  jQuery(function($) {
    // Steps sections add Suggested car
    $(".main-dashboard a[href^='#']").on('click', function(e) {
      e.preventDefault();
      var hash = this.hash;
      $('.section-form').hide();
      $(hash).show();
      console.log(hash);
      if (hash) {
        $('html, body').animate({
          scrollTop: $(hash).offset().top
          }, 500, function(){
          window.location.hash = hash;
        });
      }
    });

    // Get Photo Suggested Cars
    $('body').on('change', '#SelectSuggestedCars', function() {
      // var car_id = $(this).val();
      var car_id = $('#SelectSuggestedCars').find(":selected").val();
      var car_text = $('#SelectSuggestedCars').find(":selected").text();
      $('#car_id').val(car_text);
      $('#FormCarName').val(car_text);
      var action = 'ajax_function_photo_suggested';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          car_id: car_id,
        },
        beforeSend: function () {
          $('#PhotoCars').html("");
          $('.toast-body').html("");
          $('.loading').show();
        },
        success: function (response) {          
          $('#PhotoCars').append(response);
          $('.loading').hide();
          $('.toast-body').html("تم اضافة الصور بجاح");
          $('.toast').toast('show');
        },
        error: function(response) {
          $('.loading').hide();
        }
      });
    });

    // Add new car su
    $("#AddNewSuggestedCars").on('click', function(e) {
      e.preventDefault();
      var car_id          = $('#SelectSuggestedCars').find(":selected").val();
      var car_name        = $('#FormCarName').val();
      var car_price       = $('#FormCarPrice').val();
      var car_price_after = $('#FormCarPriceAfter').val();
      var car_installment = $('#FormCarInstallment').val();
      var action = 'set_function_add_new_suggested';

      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          car_id: car_id,
          car_name: car_name,
          car_price: car_price,
          car_price_after: car_price_after,
          car_installment: car_installment
        },
        beforeSend: function () {
          $('.toast-body').html("");
          $('.loading').show();
        },
        success: function (response) {
          $('.toast-body').html(JSON.parse(response).message);
          $('.toast').toast('show')
          $('.loading').hide();
          if(JSON.parse(response).success) {
            $('.section-form').hide();
            $('#SuggestedCars').show();
          }
        },
        error: function(response) {
          $('.loading').hide();
        }
      });
    });

  });
</script>
