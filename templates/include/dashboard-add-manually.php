<div class="loader">
  <div class="loading mt-5"></div>
</div>
<!-- Manually Cars  -->
<section class="section-form mb-5" id="ManuallyCars" style="display:none;">
  <div class="row">
    <div class="col-md-7 col-12 mt-5">
      <div class="card bg-gray p-5">
        <h2 class="font-bold h4 mb-3">أضافة سيارة من خلال المعرض بشكل يدوي</h2>
        <p>في حالة عدم ايجاد السيارة في السيارات المقترحة</p>
        <p>يرجي أضافة السيارة من هنا</p>
        <a href="#AddManuallyCars" class="btn btn-dark text-white py-2 mt-4 font-bold">
          <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5.5 12H19.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12.5 5L19.5 12L12.5 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>        
          <span>أضافة سيارة للبيع بشكل يدوي</span>
        </a>
      </div>
    </div>    
  </div>
</section>

<!-- Add Manually Cars  -->
<section class="section-form mb-5" id="AddManuallyCars">
  <div class="row">
    <div class="col-12 section-head mt-5">
      <h3> <a  class="text-dark mb-4" href="#ManuallyCars"> <i class="fas fa-angle-right"></i> <span>أضافة صور</span></a></h3>
      <hr>
    </div>
    <div class="galleries" id="galleryExterior"></div>
    <div class="galleries" id="galleryInside"></div>
    <div class="col-md-6 col-12 mt-5">
      <div class="row">
        <div class="col-md-6 col-12">
          <form id="galleriesExterior" class="form" method="post" enctype="multipart/form-data">
            <label for="exterior" class="btn btn-outline-light d-flex bg-gray flex-column text-dark text-center px-3 py-5">
              <svg class="mx-auto mb-3" width="40" height="35" viewBox="0 0 40 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.9219 5H27.0781C28.1406 5 29.0859 5.67188 29.4375 6.67188L31.4766 12.5H8.52344L10.5625 6.67188C10.9141 5.67188 11.8594 5 12.9219 5ZM5.84375 5.02344L3.09375 12.875C1.28125 13.625 0 15.4141 0 17.5V23.75C0 25.6016 1.00781 27.2188 2.5 28.0781V32.5C2.5 33.8828 3.61719 35 5 35H7.5C8.88281 35 10 33.8828 10 32.5V28.75H30V32.5C30 33.8828 31.1172 35 32.5 35H35C36.3828 35 37.5 33.8828 37.5 32.5V28.0781C38.9922 27.2109 40 25.6016 40 23.75V17.5C40 15.4141 38.7188 13.625 36.9062 12.875L34.1562 5.02344C33.1016 2.01563 30.2656 0 27.0781 0H12.9219C9.73438 0 6.89844 2.01563 5.84375 5.02344ZM16.25 18.75H23.75C24.4375 18.75 25 19.3125 25 20V22.5C25 23.1875 24.4375 23.75 23.75 23.75H16.25C15.5625 23.75 15 23.1875 15 22.5V20C15 19.3125 15.5625 18.75 16.25 18.75ZM3.75 19.375C3.75 18.3359 4.58594 17.5 5.625 17.5H8.125C9.16406 17.5 10 18.3359 10 19.375C10 20.4141 9.16406 21.25 8.125 21.25H5.625C4.58594 21.25 3.75 20.4141 3.75 19.375ZM31.875 17.5H34.375C35.4141 17.5 36.25 18.3359 36.25 19.375C36.25 20.4141 35.4141 21.25 34.375 21.25H31.875C30.8359 21.25 30 20.4141 30 19.375C30 18.3359 30.8359 17.5 31.875 17.5Z" fill="#323232"/>
              </svg>
              <span>
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12.5 7V18M7 12.5H18" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <rect x="1" y="1" width="23" height="23" rx="11.5" stroke="#323232"/>
                </svg>
                <b>صور من الخارج للسيارة</b>
              </span>
            </label>
            <input type="file" id="exterior" name="exterior[]" accept="image/*" class="form-control hidden" multiple>
          </form>
        </div>
        <div class="col-md-6 col-12">
          <form id="galleriesInside" class="form" method="post" enctype="multipart/form-data">
            <label for="inside" class="btn btn-outline-light d-flex bg-gray flex-column text-dark text-center px-3 py-5">
              <svg class="mx-auto mb-3" width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.13102 0L4.13016 0.000859395C3.56469 -0.00773436 2.90555 0.06875 2.28078 0.207969C1.56664 0.366094 0.890312 0.611016 0.450312 0.857656C0.229453 0.981406 0.0704687 1.10688 0 1.18422L2.22234 8.965C2.84281 8.18297 3.54664 7.53844 4.26336 7.05719C5.09609 6.50375 5.9125 6.14023 6.66016 5.98555C6.66016 4.85633 6.63437 3.75805 6.50547 2.82648C6.34219 1.705 6.02422 0.847344 5.51719 0.342031C5.40547 0.226016 4.9775 0.0464063 4.36648 0.00859378C4.29 0.00859378 4.21094 0 4.13102 0ZM6.62578 7.91656C6.05 7.95094 5.40547 8.21734 4.8125 8.66422C3.63687 9.54937 2.74656 11.1306 2.72078 12.1189L6.65156 32.7697C7.30469 31.9533 8.30156 31.4205 9.41875 31.4205C10.407 31.4205 11.3094 31.8416 11.9539 32.5119C12.3922 32.4173 12.8562 32.3228 13.3633 32.2283C13.4922 32.2025 13.6297 32.1853 13.7672 32.1595C12.607 24.2103 10.7336 15.0064 8.16406 8.50094C7.71719 8.08844 7.27891 7.92516 6.82344 7.91656H6.62578ZM30.9461 11.3111L26.3398 25.697L27.818 26.1611L29.8805 19.7072L39.9438 22.9298L40.4078 21.4517L30.3531 18.2377L32.4242 11.7752L30.9461 11.3111ZM27.6203 32.3916C25.7727 32.4002 23.6414 32.5119 21.5187 32.7095C18.6828 32.9587 15.8469 33.3455 13.6469 33.7494C13.3461 33.8009 13.0625 33.8611 12.7875 33.9127C12.8906 34.2392 12.9422 34.583 12.9422 34.9439C12.9422 36.8775 11.3523 38.4673 9.41875 38.4673C8.9375 38.4673 8.47344 38.3642 8.05234 38.1923C7.78594 38.9572 7.58828 39.7048 7.47656 40.272H32.1922C32.6219 40.272 32.8539 40.1173 33.1117 39.722C33.3781 39.3181 33.5758 38.6564 33.6531 37.8744C33.8164 36.3189 33.4727 34.3337 32.8711 33.1392C32.8969 33.1822 32.6305 32.9244 31.9945 32.7611C31.3586 32.5978 30.4391 32.4775 29.3563 32.4259C28.8148 32.4002 28.2305 32.3916 27.6203 32.3916ZM9.41875 32.9673C8.31875 32.9673 7.44219 33.8439 7.44219 34.9439C7.44219 36.0439 8.31875 36.9205 9.41875 36.9205C10.5188 36.9205 11.3953 36.0439 11.3953 34.9439C11.3953 33.8439 10.5188 32.9673 9.41875 32.9673Z" fill="#323232"/>
              </svg>
              <span>
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12.5 7V18M7 12.5H18" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <rect x="1" y="1" width="23" height="23" rx="11.5" stroke="#323232"/>
                </svg>
                <b>صور من الداخل للسيارة</b>
              </span>
            </label>
            <input type="file" id="inside" name="inside[]" accept="image/*" class="form-control hidden" multiple>
          </form>
        </div>        
      </div>
      <a class="btn btn-primary btn-lg w-100 mt-5" href="#DataManuallyCars">
        <span>الخطوة التالية</span>
      </a>
    </div>
  </div>
</section>

<?php 
  $models = get_terms( array(
    'taxonomy' => 'products-model',
    'hide_empty' => false,
    'parent'   => 0
  ) );
?>
<!-- Data Manually Cars  -->
<section class="section-form mb-5" id="DataManuallyCars" style="display:none;">
  <div class="row">
    <div class="col-12 section-head mt-5">
      <h2> <a  class="text-dark mb-4" href="#ManuallyCars"> <i class="fas fa-angle-right"></i> <span>أضافة أسم السيارة والأسعار</span></a></h2>
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
      <div class="mb-5">
        <label for="tag_id" class="form-label">* حالة السيارة</label>
        <select class="form-select px-4 mb-3" id="tag_id" name="tag_id">
          <option value="17">جديدة</option>
          <option value="1320">مستعمل</option>
        </select>
      </div>  
      <div class="mb-5">
        <label for="parent_brand_id" class="form-label">* الموديل</label>
        <select class="form-select px-4 mb-3" id="model_id" name="model_id">
          <?php foreach ($models as $model): ?>
            <option value="<?= $model->term_id; ?>"><?= $model->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>               
      <a class="btn btn-primary btn-lg w-100" href="#basicSpecifications">
        <span>الخطوة التالية</span>
      </a>              
    </div>
  </div>
</section>

<?php 
  // Brands
  $brands = get_terms( array(
    'taxonomy' => 'basic-brand',
    'hide_empty' => false,
    'parent'   => 0
  ));

  // fuel-type
  $fuels = get_terms( array(
    'taxonomy' => 'fuel-type',
    'hide_empty' => false,
    'parent'   => 0
  ));
  // fuel-type
  $engines = get_terms( array(
    'taxonomy' => 'engine-type',
    'hide_empty' => false,
    'parent'   => 0
  ));
  // fuel-type
  $cylinders = get_terms( array(
    'taxonomy' => 'cylinders-type',
    'hide_empty' => false,
    'parent'   => 0
  ));
  // fuel-type
  $pushs = get_terms( array(
    'taxonomy' => 'push-type',
    'hide_empty' => false,
    'parent'   => 0
  ));
  // fuel-type
  $gears = get_terms( array(
    'taxonomy' => 'gear-type',
    'hide_empty' => false,
    'parent'   => 0
  ));
  // fuel-type
  $colors = get_terms( array(
    'taxonomy' => 'color-type',
    'hide_empty' => false,
    'parent'   => 0
  ));          
?>
<!-- Adding basic specifications (Manually Cars)  -->
<section class="section-form mb-5" id="basicSpecifications" style="display:none;">
  <div class="row">
    <div class="col-12 section-head mt-5">
      <h2> <a  class="text-dark mb-4" href="#ManuallyCars"> <i class="fas fa-angle-right"></i> <span>أضافة المواصفات الأساسية</span></a></h2>
      <span>* كل الخانات أساسية</span>
      <hr>
    </div>
    <div class="col-md-6 col-12" id="DataCars">
      <div class="mb-5">
        <label for="parent_brand_id" class="form-label">* العلامة التجارية</label>
        <select class="form-select px-4 mb-3" id="parent_brand_id" name="parent_brand_id">
          <option value="0">العلامة تجاريه</option>
          <?php foreach ($brands as $brand): ?>
            <option value="<?= $brand->term_id; ?>"><?= $brand->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-5">
        <label for="child_brand_id" class="form-label">* الفئة</label>
        <select class="form-select px-4 mb-3" id="child_brand_id" name="child_brand_id">
          <option value="0">الفئة</option>
        </select>
      </div> 
      <div class="mb-5">
        <label for="fuel_id" class="form-label">* نوع الوقود</label>
        <select class="form-select px-4 mb-3" id="fuel_id" name="fuel_id">
          <?php foreach ($fuels as $fuel): ?>
            <option value="<?= $fuel->term_id; ?>"><?= $fuel->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-5">
        <label for="engine_id" class="form-label">* حجم المحرك</label>
        <select class="form-select px-4 mb-3" id="engine_id" name="engine_id">
          <?php foreach ($engines as $engine): ?>
            <option value="<?= $engine->term_id; ?>"><?= $engine->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>      
      <div class="mb-5">
        <label for="cylinder_id" class="form-label">* عدد السلندرات</label>
        <select class="form-select px-4 mb-3" id="cylinder_id" name="cylinder_id">
          <?php foreach ($cylinders as $cylinder): ?>
            <option value="<?= $cylinder->term_id; ?>"><?= $cylinder->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-5">
        <label for="push_id" class="form-label">* نوع الدفع</label>
        <select class="form-select px-4 mb-3" id="push_id" name="push_id">
          <?php foreach ($pushs as $push): ?>
            <option value="<?= $push->term_id; ?>"><?= $push->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-5">
        <label for="gear_id" class="form-label">* نوع القير</label>
        <select class="form-select px-4 mb-3" id="gear_id" name="gear_id">
          <?php foreach ($gears as $gear): ?>
            <option value="<?= $gear->term_id; ?>"><?= $gear->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-5">
        <label for="color_id" class="form-label">* اللون الخارجي</label>
        <select class="form-select px-4 mb-3" id="color_id" name="color_id">
          <?php foreach ($colors as $color): ?>
            <option value="<?= $color->term_id; ?>"><?= $color->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>      
      <a class="btn btn-primary btn-lg w-100" href="#basicSpecificationsRemainder">
        <span>الخطوة التالية</span>
      </a>              
    </div>
  </div>
</section>

<section class="section-form mb-5" id="basicSpecificationsRemainder" style="display:none;">
  <div class="row">
    <div class="col-12 section-head mt-5">
      <h2> <a  class="text-dark mb-4" href="#ManuallyCars"> <i class="fas fa-angle-right"></i> <span>أضافة باقي المواصفات</span></a></h2>
      <hr>
    </div>
    <div class="col-md-6 col-12" id="DataCars">
      <div class="mb-5">
        <label class="form-label h2 font-bold text-dark">الأمان</label>
        <div class="form-check form-switch">
          <input class="form-check-input" value="وسائد هوائية" name="safety[]" type="checkbox" checked id="Safety-1">
          <label class="form-check-label" for="Safety-1">
            <span>وسائد هوائية</span>
          </label>
        </div>  
        <div class="form-check form-switch">
          <input class="form-check-input" value="فرامل ABS" name="safety[]" type="checkbox" checked id="Safety-2">
          <label class="form-check-label" for="Safety-2">
            <span>فرامل ABS</span>
          </label>
        </div>          
        <div class="form-check form-switch">
          <input class="form-check-input" value="سنتر لوك" name="safety[]" type="checkbox" checked id="Safety-3">
          <label class="form-check-label" for="Safety-3">
            <span>سنتر لوك</span>
          </label>
        </div>   
        <div class="form-check form-switch">
          <input class="form-check-input" value="أحزمة أمان" name="safety[]" type="checkbox" checked id="Safety-4">
          <label class="form-check-label" for="Safety-4">
            <span>أحزمة أمان</span>
          </label>
        </div>   
        <div class="form-check form-switch">
          <input class="form-check-input" value="مساعد الفرامل BA" name="safety[]" type="checkbox" checked id="Safety-5">
          <label class="form-check-label" for="Safety-5">
            <span>مساعد الفرامل BA</span>
          </label>
        </div>  
        <div class="form-check form-switch">
          <input class="form-check-input" value="EBD توزيع قوة الفرامل الكترونيا" name="safety[]" type="checkbox" checked id="Safety-6">
          <label class="form-check-label" for="Safety-6">
            <span>EBD توزيع قوة الفرامل الكترونيا</span>
          </label>
        </div>                                                             
      </div>
      
      <div class="mb-5">
        <label class="form-label h2 font-bold text-dark">الراحة</label>
        <div class="form-check form-switch">
          <input class="form-check-input" value="تحكم دريكسون" name="comforts[]" type="checkbox" checked id="comforts-1">
          <label class="form-check-label" for="comforts-1">
            <span>تحكم دريكسون</span>
          </label>
        </div>  
        <div class="form-check form-switch">
          <input class="form-check-input" value="مثبت سرعة" name="comforts[]" type="checkbox" checked id="comforts-2">
          <label class="form-check-label" for="comforts-2">
            <span>مثبت سرعة</span>
          </label>
        </div>          
        <div class="form-check form-switch">
          <input class="form-check-input" value="زجاج كهربائي" name="comforts[]" type="checkbox" checked id="comforts-3">
          <label class="form-check-label" for="comforts-3">
            <span>زجاج كهربائي</span>
          </label>
        </div>   
        <div class="form-check form-switch">
          <input class="form-check-input" value="تشغيل مفتاح" name="comforts[]" type="checkbox" checked id="comforts-4">
          <label class="form-check-label" for="comforts-4">
            <span>تشغيل مفتاح</span>
          </label>
        </div>   
        <div class="form-check form-switch">
          <input class="form-check-input" value="مكيف يدوي" name="comforts[]" type="checkbox" checked id="comforts-5">
          <label class="form-check-label" for="comforts-5">
            <span>مكيف يدوي</span>
          </label>
        </div>  
        <div class="form-check form-switch">
          <input class="form-check-input" value="تحكم مقاعد يدوى" name="comforts[]" type="checkbox" checked id="comforts-6">
          <label class="form-check-label" for="comforts-6">
            <span>تحكم مقاعد يدوى</span>
          </label>
        </div>  
        <div class="form-check form-switch">
          <input class="form-check-input" value="مقاعد قماش وجلد" name="comforts[]" type="checkbox" checked id="comforts-7">
          <label class="form-check-label" for="comforts-7">
            <span>مقاعد قماش وجلد</span>
          </label>
        </div>  
        <div class="form-check form-switch">
          <input class="form-check-input" value="فتح الابواب بالريموت" name="comforts[]" type="checkbox" checked id="comforts-7">
          <label class="form-check-label" for="comforts-7">
            <span>فتح الابواب بالريموت</span>
          </label>
        </div>                                                                             
      </div>
     
      <div class="mb-5">
        <label class="form-label h2 font-bold text-dark">تقنيات</label>
        <div class="form-check form-switch">
          <input class="form-check-input" value="بلوتوث" name="techniques[]" type="checkbox" checked id="techniques-1">
          <label class="form-check-label" for="techniques-1">
            <span>بلوتوث</span>
          </label>
        </div>  
        <div class="form-check form-switch">
          <input class="form-check-input" value="مدخل USB" name="techniques[]" type="checkbox" checked id="techniques-2">
          <label class="form-check-label" for="techniques-2">
            <span>مدخل USB</span>
          </label>
        </div>          
        <div class="form-check form-switch">
          <input class="form-check-input" value="كاميرا خلفية" name="comforts[]" type="checkbox" checked id="techniques-3">
          <label class="form-check-label" for="techniques-3">
            <span>كاميرا خلفية</span>
          </label>
        </div>   
        <div class="form-check form-switch">
          <input class="form-check-input" value="منافذ طاقة" name="techniques[]" type="checkbox" checked id="techniques-4">
          <label class="form-check-label" for="techniques-4">
            <span>منافذ طاقة</span>
          </label>
        </div>   
        <div class="form-check form-switch">
          <input class="form-check-input" value="شاشة وسائط" name="techniques[]" type="checkbox" checked id="techniques-5">
          <label class="form-check-label" for="techniques-5">
            <span>شاشة وسائط</span>
          </label>
        </div>  
        <div class="form-check form-switch">
          <input class="form-check-input" value="راديو" name="techniques[]" type="checkbox" checked id="techniques-6">
          <label class="form-check-label" for="techniques-6">
            <span>راديو</span>
          </label>
        </div> 
        <div class="form-check form-switch">
          <input class="form-check-input" value="أندرويد أوتو" name="techniques[]" type="checkbox" checked id="techniques-7">
          <label class="form-check-label" for="techniques-7">
            <span>أندرويد أوتو</span>
          </label>
        </div>                                                                             
      </div>  
      <div class="mb-5">
        <label class="form-label h2 font-bold text-dark">تجهيزات خارجية</label>
        <div class="form-check form-switch">
          <input class="form-check-input" value="مرايا تحكم كهربائي" name="external[]" type="checkbox" checked id="external-1">
          <label class="form-check-label" for="external-1">
            <span>مرايا تحكم كهربائي</span>
          </label>
        </div>  
        <div class="form-check form-switch">
          <input class="form-check-input" value="كشافات ضباب امامية" name="external[]" type="checkbox" checked id="external-2">
          <label class="form-check-label" for="external-2">
            <span>كشافات ضباب امامية</span>
          </label>
        </div>          
        <div class="form-check form-switch">
          <input class="form-check-input" value="جنوط" name="external[]" type="checkbox" checked id="external-3">
          <label class="form-check-label" for="external-3">
            <span>جنوط</span>
          </label>
        </div>   
        <div class="form-check form-switch">
          <input class="form-check-input" value="حساسات خلفية" name="external[]" type="checkbox" checked id="external-4">
          <label class="form-check-label" for="external-4">
            <span>حساسات خلفية</span>
          </label>
        </div>   
        <div class="form-check form-switch">
          <input class="form-check-input" value="اشارات بالمرايا" name="external[]" type="checkbox" checked id="external-5">
          <label class="form-check-label" for="external-5">
            <span>اشارات بالمرايا</span>
          </label>
        </div>  
        <div class="form-check form-switch">
          <input class="form-check-input" value="جناح خلفى" name="external[]" type="checkbox" checked id="external-6">
          <label class="form-check-label" for="external-6">
            <span>جناح خلفى</span>
          </label>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" value="مصابيح ليد" name="external[]" type="checkbox" checked id="external-7">
          <label class="form-check-label" for="external-7">
            <span>مصابيح ليد</span>
          </label>
        </div>  
        <div class="form-check form-switch">
          <input class="form-check-input" value="مصابيح ضباب خلفية" name="external[]" type="checkbox" checked id="external-8">
          <label class="form-check-label" for="external-8">
            <span>مصابيح ضباب خلفية</span>
          </label>
        </div>                
        <div class="form-check form-switch">
          <input class="form-check-input" value="أنوار نهارية LED" name="external[]" type="checkbox" checked id="external-9">
          <label class="form-check-label" for="external-9">
            <span>أنوار نهارية LED</span>
          </label>
        </div>  
        <div class="form-check form-switch">
          <input class="form-check-input" value="التحكم بارتفاع الأنوار الأمامية" name="external[]" type="checkbox" checked id="external-10">
          <label class="form-check-label" for="external-10">
            <span>التحكم بارتفاع الأنوار الأمامية</span>
          </label>
        </div>
      </div>

      <a class="btn btn-primary btn-lg w-100" id="AddNewManuallyCars">
        <span>اضافة سيارة جديدة</span>
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
    // Steps sections add Manually car
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

    // remove item from galleery
    $("body").on('click', '.remove[href^="#"]', function(e) {
      e.preventDefault();
      var hash = this.hash;
      $(hash).remove();
    });
    // add Manually images exterior
    $('body').on('change', '#exterior', function() {
      var galleries = $('#galleriesExterior');
      var galleriesData = new FormData(galleries[0]);
      galleriesData.append('action', 'exterior_upload_files');
      var files = $(this).val();
      $.ajax({
        type: "POST",
        data: galleriesData,
        dataType: "json",
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        cache: false,
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        beforeSend: function () {
          $('.loading').show();
          $('#galleryExterior').html("");
        },
        success: function(response) {
          $('.loading').hide();
          $('#galleryExterior').html(response.responseText);
          console.log(response);
        },
        error: function(response){
          console.log(response);
          $('.loading').hide();
          $('#galleryExterior').html(response.responseText);
        }
      });
    });

    // add Manually images Inside
    $('body').on('change', '#inside', function() {
      var galleries = $('#galleriesInside');
      var galleriesData = new FormData(galleries[0]);
      galleriesData.append('action', 'inside_upload_files');
      var files = $(this).val();
      $.ajax({
        type: "POST",
        data: galleriesData,
        dataType: "json",
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        cache: false,
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        beforeSend: function () {
          $('.loading').show();
          $('#galleryInside').html("");
        },
        success: function(response) {
          $('.loading').hide();
          $('#galleryInside').html(response.responseText);
          console.log(response);
        },
        error: function(response){
          console.log(response);
          $('.loading').hide();
          $('#galleryInside').html(response.responseText);
        }
      });
    });
    
    //  أضافة المواصفات الأساسية
    // change parent brand
    $('#parent_brand_id').on('change', function () {
      var parent_id = $('#parent_brand_id').find(":selected").val();
      var action = 'lvl_one_basic_brand';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          parent_id: parent_id,
        },
        beforeSend: function () {
          $('#child_brand_id').html("");
          $('.loading').show();
        },
        success: function (response) {          
          $('#child_brand_id').append(response);
          $('.loading').hide();
        },
        error: function(response) {
          $('.loading').hide();
        }
      });
    });

        // Add new car Manually
    $("#AddNewManuallyCars").on('click', function(e) {
      e.preventDefault();

      var parent_brand_id       = $('#parent_brand_id').find(":selected").val();
      var child_brand_id        = $('#child_brand_id').find(":selected").val();
      var fuel_id               = $('#fuel_id').find(":selected").val();
      var engine_id             = $('#engine_id').find(":selected").val();
      var cylinder_id           = $('#cylinder_id').find(":selected").val();
      var push_id               = $('#push_id').find(":selected").val();
      var gear_id               = $('#gear_id').find(":selected").val();
      var color_id              = $('#color_id').find(":selected").val();
      var safeties              = $("input[name='safety[]']").map(function(){return $(this).val();}).get();
      var comforts              = $("input[name='comforts[]']").map(function(){return $(this).val();}).get();
      var techniques            = $("input[name='techniques[]']").map(function(){return $(this).val();}).get();
      var external              = $("input[name='external[]']").map(function(){return $(this).val();}).get();
      var action                = 'set_function_add_new_Basic';
      var basic_name            = $('#parent_brand_id').find(":selected").text() + '-' + $('#child_brand_id').find(":selected").text() ;

      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          parent_brand_id: parent_brand_id,
          child_brand_id: child_brand_id,
          fuel_id: fuel_id,
          engine_id: engine_id,
          cylinder_id: cylinder_id,
          push_id: push_id,
          gear_id: gear_id,
          color_id: color_id,
          safeties: safeties,
          comforts: comforts,
          techniques: techniques,
          external: external,
          basic_name: basic_name
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
            addManuallyCar(JSON.parse(response).id_basic)
          }
        },
        error: function(response) {
          $('.loading').hide();
        }
      });
    });

    // Add new car su
    function addManuallyCar(id){
      var id_basic        = id;
      var car_name        = $('#FormCarName').val();
      var car_price       = $('#FormCarPrice').val();
      var car_price_after = $('#FormCarPriceAfter').val();
      var car_installment = $('#FormCarInstallment').val();
      var tag_id          = $('#tag_id').val();
      var model_id        = $('#model_id').val();
      var action          = 'set_function_add_new_Manually';
      var galleries       = $("input[name='gallery_ids[]']").map(function(){return $(this).val();}).get();
      var featured_img    = galleries[0];      

      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          id_basic: id_basic,
          car_name: car_name,
          car_price: car_price,
          car_price_after: car_price_after,
          car_installment: car_installment,
          tag_id:tag_id,
          model_id:model_id,
          galleries:galleries,
          featured_img:featured_img
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
            $('#ManuallyCars').show();
          }
        },
        error: function(response) {
          $('.loading').hide();
        }
      });
    };

  });
</script>
