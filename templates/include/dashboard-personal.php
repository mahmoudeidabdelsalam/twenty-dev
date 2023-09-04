<div class="loader">
  <div class="loading mt-5"></div>
</div>

<!-- Funding  -->
<section class="section-form mb-5">
  <div class="row">
    <div class="col-12 section-head mt-5">
      <h2> <a  class="text-dark mb-4" href="/dashboard"> <i class="fas fa-angle-right"></i> <span>بيانات المعرض</span></a></h2>
      <span>* كل الخانات أساسية</span>
      <hr>
    </div>
    <div class="col-md-6 col-12" id="DataCars">
      <div class="mb-5">
        <label for="authorName" class="form-label">* اسم المعرض</label>
        <input type="text" class="form-control" id="authorName" placeholder="اسم المعرض">
      </div>
      <div class="mb-5">
        <label for="address" class="form-label">* عنوان المعرض</label>
        <input type="number" class="form-control" id="address" placeholder="عنوان المعرض">
      </div>
      <div class="mb-5">
        <label for="phone" class="form-label">* هاتف المعرض</label>
        <input type="number" class="form-control" id="phone" placeholder="هاتف المعرض">
      </div>
      <div class="mb-5">
        <label for="whatsapp" class="form-label">* واتساب المعرض</label>
        <input type="number" class="form-control" id="whatsapp" placeholder="واتساب المعرض">
      </div>           
      <div class="mb-5">
        <form id="galleriesExterior" class="form" method="post" enctype="multipart/form-data">
          <label for="logo" class="form-label">* شعار المعرض</label>
          <div class="form-group">
            <svg width="105" height="45" viewBox="0 0 105 45" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M30.939 28.1196C30.939 28.5322 30.7761 28.9278 30.4863 29.2196C30.1965 29.5113 29.8034 29.6752 29.3935 29.6752H15.4844C15.0745 29.6752 14.6814 29.5113 14.3916 29.2196C14.1018 28.9278 13.939 28.5322 13.939 28.1196V19.5641C13.939 19.1515 14.1018 18.7558 14.3916 18.4641C14.6814 18.1724 15.0745 18.0085 15.4844 18.0085H18.5753L20.1208 15.6752H24.7571L26.3026 18.0085H29.3935C29.8034 18.0085 30.1965 18.1724 30.4863 18.4641C30.7761 18.7558 30.939 19.1515 30.939 19.5641V28.1196Z" stroke="#FFAA3F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M22.439 26.5641C24.146 26.5641 25.5299 25.1712 25.5299 23.4529C25.5299 21.7347 24.146 20.3418 22.439 20.3418C20.7319 20.3418 19.3481 21.7347 19.3481 23.4529C19.3481 25.1712 20.7319 26.5641 22.439 26.5641Z" stroke="#FFAA3F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M58.939 16.6752L46.939 28.6752" stroke="#E44343" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M46.939 16.6752L58.939 28.6752" stroke="#E44343" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M87.0428 15.3436C87.2547 15.1317 87.5063 14.9636 87.7832 14.8489C88.0601 14.7342 88.3569 14.6752 88.6566 14.6752C88.9564 14.6752 89.2531 14.7342 89.5301 14.8489C89.807 14.9636 90.0586 15.1317 90.2705 15.3436C90.4824 15.5556 90.6505 15.8072 90.7652 16.0841C90.8799 16.361 90.939 16.6578 90.939 16.9575C90.939 17.2572 90.8799 17.554 90.7652 17.8309C90.6505 18.1078 90.4824 18.3594 90.2705 18.5713L79.377 29.4648L74.939 30.6752L76.1493 26.2371L87.0428 15.3436Z" stroke="#0B80B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <input type="file" id="logo" name="logo" accept="image/*" class="form-control">
          </div>          
        </form>
      </div>
      <div class="mb-5">
        <form id="galleriesExterior" class="form" method="post" enctype="multipart/form-data">
          <label for="background" class="form-label">* غلاف المعرض gif  ( هيظهر لموظفين عشرين فقط )</label>
          <div class="form-group">
            <svg width="105" height="45" viewBox="0 0 105 45" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M30.939 28.1196C30.939 28.5322 30.7761 28.9278 30.4863 29.2196C30.1965 29.5113 29.8034 29.6752 29.3935 29.6752H15.4844C15.0745 29.6752 14.6814 29.5113 14.3916 29.2196C14.1018 28.9278 13.939 28.5322 13.939 28.1196V19.5641C13.939 19.1515 14.1018 18.7558 14.3916 18.4641C14.6814 18.1724 15.0745 18.0085 15.4844 18.0085H18.5753L20.1208 15.6752H24.7571L26.3026 18.0085H29.3935C29.8034 18.0085 30.1965 18.1724 30.4863 18.4641C30.7761 18.7558 30.939 19.1515 30.939 19.5641V28.1196Z" stroke="#FFAA3F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M22.439 26.5641C24.146 26.5641 25.5299 25.1712 25.5299 23.4529C25.5299 21.7347 24.146 20.3418 22.439 20.3418C20.7319 20.3418 19.3481 21.7347 19.3481 23.4529C19.3481 25.1712 20.7319 26.5641 22.439 26.5641Z" stroke="#FFAA3F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M58.939 16.6752L46.939 28.6752" stroke="#E44343" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M46.939 16.6752L58.939 28.6752" stroke="#E44343" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M87.0428 15.3436C87.2547 15.1317 87.5063 14.9636 87.7832 14.8489C88.0601 14.7342 88.3569 14.6752 88.6566 14.6752C88.9564 14.6752 89.2531 14.7342 89.5301 14.8489C89.807 14.9636 90.0586 15.1317 90.2705 15.3436C90.4824 15.5556 90.6505 15.8072 90.7652 16.0841C90.8799 16.361 90.939 16.6578 90.939 16.9575C90.939 17.2572 90.8799 17.554 90.7652 17.8309C90.6505 18.1078 90.4824 18.3594 90.2705 18.5713L79.377 29.4648L74.939 30.6752L76.1493 26.2371L87.0428 15.3436Z" stroke="#0B80B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <input type="file" id="logo" name="background" accept="image/*" class="form-control">
          </div>          
        </form>
      </div>
      <div class="mb-5">
        <label for="map" class="form-label">* خريطة المعرض</label>
        <textarea class="form-control" name="map" id="map" cols="2" rows="5"></textarea>
      </div>
      <a class="btn btn-primary btn-lg w-100" href="#">
        <span>تأكيد بيانات المعرض</span>
      </a>              
    </div>
  </div>
</section>