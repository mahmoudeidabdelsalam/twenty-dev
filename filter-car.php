<?php
$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';

$brands = get_terms( array(
  'taxonomy' => 'basic-brand',
  'hide_empty' => false,
  'parent'   => 0
) );

$models = get_terms( array(
  'taxonomy' => 'products-model',
  'hide_empty' => false,
  'parent'   => 0
));

$structures = get_terms( array(
  'taxonomy' => 'structure-type',
  'hide_empty' => false,
  'parent'   => 0
));
?>
<div class="card filter py-4 px-3">
  <div class="head-filter d-flex flex-row">
    <span class="font-bold">فلترة النتائج</span>
    <a href="#" class="me-auto">
      <i class="fas fa-sync-alt"></i>
      <span>اعادة تعيين</span>            
    </a>
  </div>

  <div class="accordion mt-3" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          حالة السيارة
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
        <div id="tags" class="accordion-body">
          <div class="form-check form-switch">
            <input class="form-check-input" value="17" type="checkbox" id="tagNews">
            <label class="form-check-label" for="tagNews">جديدة</label>
          </div>
          <div class="form-check form-switch">
            <input class="form-check-input" value="1320" type="checkbox" id="tagUsed">
            <label class="form-check-label" for="tagUsed">مستعملة</label>
          </div>          
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          العلامة التجارية
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
        <div class="accordion-body">
          <div class="input-search mb-3">
            <i class="input-search-icon ti-search" aria-hidden="true" style="color: #1179EF"></i>
            <input type="search" class="form-control" placeholder="بحث عن العلامة التجارية" id="searchBrands">
          </div>
          <div id="brands" class="brands box-multiselect">
            <?php 
            if($brands):
              foreach ($brands as $brand): 
                $image = get_field('icon_term', $brand);
            ?>
              <div class="form-check form-switch <?= $brand->name; ?>">
                <input class="form-check-input" value="<?= $brand->term_id; ?>" type="checkbox" id="brand<?= $brand->term_id; ?>">
                <label class="form-check-label" for="brand<?= $brand->term_id; ?>">
                  <span><?= $brand->name; ?></span>
                  <span class="img-label"><img src="<?= ($image)? $image:$placeholder; ?>" width="26" alt="<?= $brand->name; ?>"></span>
                </label>
              </div>  
            <?php 
              endforeach;
            endif;
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          النوع
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
        <div class="accordion-body">
          <div id="types" class="brands box-multiselect">

          </div>
          <div class="loading loader-types"></div>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          الفئة
        </button>
      </h2>
      <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour">
        <div class="accordion-body">
          <div id="categories" class="brands box-multiselect"></div>
          <div class="loading loader-category"></div>
        </div>
      </div>
    </div> 
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingFive">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          الموديل
        </button>
      </h2>
      <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive">
        <div class="accordion-body">
          <div class="input-group mb-3">
            <label class="input-group-text" for="fromYear">من</label>
            <select class="form-select" id="fromYear">
              <option selected>السنة</option>
              <?php 
              if($models):
                foreach ($models as $model): 
              ?>
                <option value="<?= $model->term_id; ?>"><?= $model->name; ?></option>
              <?php 
                endforeach;
              endif;
              ?>              
            </select>
          </div> 
          <div class="input-group mb-3">
            <label class="input-group-text" for="toYear">الي</label>
            <select class="form-select" id="toYear">
              <option selected>السنة</option>
              <?php 
              if($models):
                foreach ($models as $model): 
              ?>
                <option value="<?= $model->term_id; ?>"><?= $model->name; ?></option>
              <?php 
                endforeach;
              endif;
              ?>              
            </select>
          </div>                    
        </div>
      </div>
    </div> 
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingSix">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
          السعر بالريال
        </button>
      </h2>
      <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix">
        <div class="accordion-body">
          <div class="input-group mb-3">
            <label class="input-group-text" for="fromPrice">من</label>
            <input type="number" id="fromPrice" class="form-control" placeholder="من">
          </div>  
          <div class="input-group mb-3">
            <label class="input-group-text" for="toPrice">الي</label>
            <input type="number" id="toPrice" class="form-control" placeholder="الي">
          </div>                     
        </div>
      </div>
    </div> 
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingSeven">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
          الشكل
        </button>
      </h2>
      <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven">
        <div class="accordion-body">
          <div id="structures" class="structures">
            <?php 
            if($brands):
              foreach ($structures as $structure): 
                $image = get_field('icon_term', $structure);
            ?>
              <div class="form-check structure">
                <input class="form-check-input" value="<?= $structure->term_id; ?>" type="checkbox" id="structure-<?= $structure->term_id; ?>">
                <label class="form-check-label" for="structure-<?= $structure->term_id; ?>">
                  <img src="<?= ($image)? $image:$placeholder; ?>" width="75" alt="<?= $structure->name; ?>">
                  <?= $structure->name; ?> 
                </label>
              </div>  
            <?php 
              endforeach;
            endif;
            ?>    
          </div>      
        </div>
      </div>
    </div>                
  </div> 
  <div class="action">
    <button id="getCars" class="btn btn-dark w-100 px-4 py-2 mt-5">أظهر النتائج</button>
  </div>    

</div>


<script type="text/javascript">
  jQuery(function ($) {
    // change parent brand
    $('#brands input[type=checkbox]').change(function() {
      var yourArray = [];
      $("#brands input[type=checkbox]:checked").each(function(){
          yourArray.push($(this).val());
      });
      var action = 'ajax_function_ids_brands';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          parent_id: yourArray,
        },
        beforeSend: function () {
          $('#types').html("");
          $('.loader-types').show();
          $('#headingThree button.collapsed').trigger( "click" );
        },
        success: function (response) {          
          $('#types').append(response);
          $('.loader-types').hide();
        },
        error: function(response) {
          $('.loader-types').hide();
        }
      });
    });  
    
    // change parent Types
     $('body').on('change', '#types input[type=checkbox]', function() {
      var yourArray = [];
      $("#types input[type=checkbox]:checked").each(function(){
          yourArray.push($(this).val());
      });
      var action = 'ajax_function_ids_types';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          parent_id: yourArray,
        },
        beforeSend: function () {
          $('#categories').html("");
          $('.loader-category').show();
          $('#headingFour button.collapsed').trigger( "click" );
        },
        success: function (response) {          
          $('#categories').append(response);
          $('.loader-category').hide();
        },
        error: function(response) {
          $('.loader-category').hide();
        }
      });
    });

    // change parent Types
     $('body').on('click', '#getCars', function() {

      var tagsArray = [];
      $("#tags input[type=checkbox]:checked").each(function(){
          tagsArray.push($(this).val());
      });

      var brandsArray = [];
      $("#brands input[type=checkbox]:checked").each(function(){
          brandsArray.push($(this).val());
      });

      var categoriesArray = [];
      $("#categories input[type=checkbox]:checked").each(function(){
          categoriesArray.push($(this).val());
      });

      var typesArray = [];
      $("#types input[type=checkbox]:checked").each(function(){
          typesArray.push($(this).val());
      });

      var fromYear = $('#fromYear').find(":selected").val();
      var toYear = $('#toYear').find(":selected").val();

      var fromPrice = $('#fromPrice').val();
      var toPrice = $('#toPrice').val();

      var structuresArray = [];
      $("#structures input[type=checkbox]:checked").each(function(){
          structuresArray.push($(this).val());
      });

      var action = 'ajax_function_get_cars';

      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          tags: tagsArray,
          brands: brandsArray,
          categories: categoriesArray,
          types: typesArray,
          from_year: fromYear,
          to_year: toYear,
          from_price: fromPrice,
          to_price: toPrice,
          structures:structuresArray
        },
        beforeSend: function () {
          $('.loader-cars').show();
        },
        success: function (response) {     
          $('#cars').html("");     
          $('.loader-cars').hide();
          $('#cars').append(response);
        },
        error: function(response) {
          $('.loader-cars').hide();
          $('#cars').append(response);
        }
      });



    });

  });
</script>