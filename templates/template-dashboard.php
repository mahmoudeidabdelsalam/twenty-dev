<?php
/* Template Name: Dashboard */ 
/*
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#about-page
 *
*/

get_header();


$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'add';
$user_id = get_current_user_id();

$args = array(
  'post_type' => array( 'cars' ),
  'posts_per_page' => -1,
);

$query = new WP_Query( $args );

?>
<?php if ( is_user_logged_in() ): ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4 col-12 sidebar-dashboard">
      <ul class="main-menu list-unstyled p-0">
        <li class="head">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.92769 -0.0292629C9.89516 -0.0233884 9.86304 -0.0154232 9.83154 -0.00541671C9.65787 0.0335077 9.50308 0.131447 9.39353 0.271713C9.28398 0.411979 9.22646 0.585891 9.23077 0.763814V1.53304H2.30769C1.69565 1.53304 1.10868 1.77618 0.675907 2.20895C0.243131 2.64173 0 3.2287 0 3.84074L0 13.8407C0 15.1146 1.03385 16.1484 2.30769 16.1484H9.23077V16.4369L5.04769 18.5284C4.86286 18.6177 4.72105 18.7767 4.65346 18.9705C4.58588 19.1643 4.59805 19.3771 4.68731 19.5619C4.77656 19.7467 4.93559 19.8885 5.1294 19.9561C5.32321 20.0237 5.53593 20.0115 5.72077 19.9223L9.23077 18.1677V18.4561C9.23077 18.6601 9.31181 18.8558 9.45607 19C9.60033 19.1443 9.79599 19.2253 10 19.2253C10.204 19.2253 10.3997 19.1443 10.5439 19C10.6882 18.8558 10.7692 18.6601 10.7692 18.4561V18.1677L14.2792 19.9223C14.4641 20.0115 14.6768 20.0237 14.8706 19.9561C15.0644 19.8885 15.2234 19.7467 15.3127 19.5619C15.4019 19.3771 15.4141 19.1643 15.3465 18.9705C15.279 18.7767 15.1371 18.6177 14.9523 18.5284L10.7692 16.4369V16.1484H17.6923C18.9662 16.1484 20 15.1146 20 13.8407V3.84074C20 3.2287 19.7569 2.64173 19.3241 2.20895C18.8913 1.77618 18.3043 1.53304 17.6923 1.53304H10.7692V0.763814C10.7731 0.654428 10.7536 0.545472 10.712 0.444226C10.6704 0.342981 10.6077 0.251777 10.5281 0.176708C10.4484 0.101639 10.3536 0.0444337 10.2501 0.00891436C10.1466 -0.026605 10.0367 -0.0396206 9.92769 -0.0292629ZM1.53846 3.84074H18.4615V13.8407H1.53846V3.84074ZM16.0577 4.60997C15.8854 4.62849 15.7244 4.70466 15.6008 4.82612L13.0769 7.35074L11.3223 5.59458C11.2383 5.50836 11.1352 5.44307 11.0213 5.40395C10.9075 5.36484 10.786 5.353 10.6667 5.36939C10.5474 5.38578 10.4337 5.42993 10.3346 5.4983C10.2355 5.56668 10.1538 5.65735 10.0962 5.76304L7.81231 9.75381L6.87462 7.39766C6.82908 7.276 6.75348 7.16786 6.65486 7.08332C6.55625 6.99877 6.43783 6.94057 6.31065 6.91415C6.18346 6.88773 6.05166 6.89395 5.92753 6.93223C5.8034 6.9705 5.69099 7.03959 5.60077 7.13304L3.29308 9.44073C3.22035 9.51342 3.16264 9.59971 3.12326 9.6947C3.08388 9.78968 3.06359 9.89149 3.06355 9.99431C3.06352 10.0971 3.08374 10.199 3.12305 10.294C3.16237 10.389 3.22001 10.4753 3.29269 10.548C3.36537 10.6208 3.45167 10.6785 3.54665 10.7179C3.64163 10.7572 3.74344 10.7775 3.84627 10.7776C3.94909 10.7776 4.05091 10.7574 4.14592 10.7181C4.24093 10.6788 4.32727 10.6211 4.4 10.5484L5.86615 9.08227L6.97231 11.8223C7.02451 11.9597 7.115 12.0793 7.23306 12.1669C7.35112 12.2544 7.4918 12.3064 7.63845 12.3165C7.78511 12.3266 7.93159 12.2945 8.06055 12.2239C8.18952 12.1534 8.29557 12.0474 8.36615 11.9184L10.9385 7.42304L12.5246 9.00997C12.5963 9.08418 12.6823 9.14319 12.7773 9.1835C12.8723 9.2238 12.9745 9.24457 13.0777 9.24457C13.1809 9.24457 13.2831 9.2238 13.3781 9.1835C13.4731 9.14319 13.559 9.08418 13.6308 9.00997L16.7077 5.93304C16.8292 5.82055 16.9112 5.67185 16.9414 5.50904C16.9717 5.34623 16.9485 5.17801 16.8755 5.02939C16.8025 4.88076 16.6835 4.75967 16.5361 4.6841C16.3888 4.60854 16.221 4.58254 16.0577 4.60997Z" fill="#D97E00"/>
          </svg>          
          <span class="text-primary">احصائيات المعرض</span>
        </li>
        <!-- طلبات التمويل -->
        <li class="item">
          <a href="?tab=funding">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="28" height="28" rx="5.90292" fill="#0B80B2"/>
              <path d="M20.6509 9.17667L19.5359 10.2632C19.4272 10.3617 19.2849 10.4174 19.1365 10.4195C18.9881 10.4217 18.8441 10.3701 18.7325 10.2749C17.6526 9.38623 16.2851 8.89796 14.8716 8.89628C13.7086 8.89628 12.5455 9.27014 12.5455 10.3099C12.5455 11.3614 13.7925 11.7119 15.2313 12.2376C17.7493 13.0554 19.8356 14.0835 19.8356 16.4901C19.8356 19.1071 17.7493 20.9063 14.3441 21.1049L14.0323 22.5068C14.0047 22.6356 13.9325 22.7513 13.8276 22.8343C13.7228 22.9173 13.5918 22.9625 13.4568 22.9624H11.3105L11.2026 22.9508C11.049 22.9172 10.9151 22.8261 10.8298 22.6971C10.7446 22.5681 10.7148 22.4116 10.747 22.2615L11.0827 20.7778C9.79039 20.4621 8.60195 19.8308 7.62948 18.9435V18.9319C7.57583 18.8798 7.53325 18.8179 7.50421 18.7497C7.47516 18.6815 7.46021 18.6084 7.46021 18.5346C7.46021 18.4608 7.47516 18.3878 7.50421 18.3196C7.53325 18.2514 7.57583 18.1895 7.62948 18.1374L8.82851 17.0042C8.93739 16.9048 9.081 16.8495 9.23019 16.8495C9.37938 16.8495 9.52298 16.9048 9.63186 17.0042C10.723 18.0089 12.1858 18.5697 13.6966 18.5463C15.2553 18.5463 16.2985 17.9038 16.2985 16.8874C16.2985 15.8709 15.2433 15.6022 13.2529 14.8779C11.1426 14.1419 9.14026 13.1021 9.14026 10.6721C9.14026 7.84483 11.5503 6.46625 14.404 6.33774L14.7038 4.90075C14.7316 4.77304 14.8044 4.65881 14.9095 4.57777C15.0145 4.49672 15.1453 4.45394 15.2793 4.4568H17.4136L17.5335 4.46848C17.8452 4.53858 18.0491 4.83065 17.9771 5.13441L17.6534 6.73496C18.7325 7.08544 19.7517 7.63454 20.627 8.35887L20.6509 8.38224C20.8788 8.6159 20.8788 8.96638 20.6509 9.17667Z" fill="white"/>
            </svg>            
            <div class="info">
              <b>50</b>
              <span>طلبات التمويل</span>
            </div>
          </a>
        </li>
        <!--  طلبات الشراء اونلاين -->
        <li class="item">
          <a href="?tab=orders">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="28" height="28" rx="5.13433" fill="#EE6438"/>
              <path d="M9.50661 8.09705C8.87743 8.09705 8.27402 8.346 7.82912 8.78914C7.38422 9.23228 7.13428 9.83331 7.13428 10.46V11.2477H21.8955V10.46C21.8955 9.83331 21.6455 9.23228 21.2006 8.78914C20.7557 8.346 20.1523 8.09705 19.5231 8.09705H9.50661ZM7.13428 17.2863V12.2979H21.8955V17.2863C21.8955 17.913 21.6455 18.514 21.2006 18.9572C20.7557 19.4003 20.1523 19.6493 19.5231 19.6493H9.50661C8.87743 19.6493 8.27402 19.4003 7.82912 18.9572C7.38422 18.514 7.13428 17.913 7.13428 17.2863ZM17.1508 15.4485C17.011 15.4485 16.8769 15.5038 16.778 15.6023C16.6792 15.7007 16.6236 15.8343 16.6236 15.9736C16.6236 16.1128 16.6792 16.2464 16.778 16.3449C16.8769 16.4434 17.011 16.4987 17.1508 16.4987H18.7324C18.8722 16.4987 19.0063 16.4434 19.1051 16.3449C19.204 16.2464 19.2595 16.1128 19.2595 15.9736C19.2595 15.8343 19.204 15.7007 19.1051 15.6023C19.0063 15.5038 18.8722 15.4485 18.7324 15.4485H17.1508Z" fill="white"/>
            </svg>            
            <div class="info">
              <b>210</b>
              <span>طلبات التمويل</span>
            </div>
          </a>
        </li>
        <!-- السيارات المضافة -->
        <li class="item">
          <a href="?tab=cars">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="28" height="28" rx="5.13433" fill="#315AC3"/>
              <path d="M13.8884 6.40649C11.8287 6.37629 8.96757 6.42043 8.37856 8.00279L6.93125 11.399C6.86697 11.3257 6.78283 11.2725 6.68901 11.246L6.1063 11.0821C6.04223 11.0639 5.9752 11.0585 5.90906 11.0663C5.84292 11.0741 5.77897 11.0949 5.72088 11.1275C5.66279 11.1601 5.6117 11.2038 5.57056 11.2562C5.52942 11.3085 5.49902 11.3685 5.48112 11.4327L5.17716 12.5121C5.15898 12.5762 5.15364 12.6432 5.16144 12.7094C5.16924 12.7755 5.19004 12.8395 5.22263 12.8976C5.25522 12.9557 5.29897 13.0068 5.35136 13.0479C5.40375 13.089 5.46375 13.1194 5.52791 13.1373L6.11078 13.3012C6.13036 13.3067 6.14961 13.3085 6.16919 13.3115C6.05786 13.5891 5.98834 13.8944 5.98834 14.0761V18.0231C5.98834 18.2255 6.07295 18.3191 6.20801 18.3631V19.4147C6.20784 19.508 6.22609 19.6004 6.26173 19.6867C6.29736 19.7729 6.34968 19.8513 6.41567 19.9173C6.48167 19.9832 6.56004 20.0355 6.6463 20.0712C6.73255 20.1068 6.82499 20.125 6.91831 20.1248H8.82422C8.91752 20.125 9.00994 20.1067 9.09618 20.0711C9.18241 20.0355 9.26077 19.9832 9.32674 19.9172C9.39272 19.8512 9.44502 19.7729 9.48065 19.6866C9.51627 19.6004 9.53452 19.508 9.53435 19.4147V18.4016H18.4657V19.4147C18.4656 19.508 18.4839 19.6004 18.5195 19.6867C18.5552 19.7729 18.6075 19.8513 18.6735 19.9173C18.7395 19.9832 18.8179 20.0355 18.9042 20.0712C18.9904 20.1068 19.0829 20.125 19.1762 20.1248H21.0818C21.1751 20.125 21.2676 20.1068 21.3539 20.0712C21.4402 20.0356 21.5186 19.9833 21.5846 19.9173C21.6506 19.8513 21.703 19.773 21.7386 19.6867C21.7743 19.6005 21.7926 19.508 21.7924 19.4147V18.3631C21.9273 18.3191 22.0118 18.2254 22.0118 18.0229V14.0762C22.0118 13.8946 21.9422 13.5893 21.8309 13.3117C21.8505 13.3087 21.8697 13.3067 21.8893 13.3014L22.4723 13.1375C22.5365 13.1196 22.5965 13.0892 22.6488 13.048C22.7012 13.0069 22.7449 12.9558 22.7775 12.8977C22.8101 12.8396 22.8309 12.7757 22.8387 12.7095C22.8465 12.6434 22.8411 12.5764 22.8229 12.5123L22.5193 11.4328C22.5014 11.3687 22.4709 11.3087 22.4298 11.2563C22.3886 11.2039 22.3375 11.1602 22.2794 11.1276C22.2212 11.0951 22.1573 11.0743 22.0911 11.0665C22.0249 11.0587 21.9579 11.0641 21.8938 11.0822L21.3111 11.2462C21.2173 11.2727 21.1331 11.3258 21.0688 11.3991L19.6215 8.00296C18.9902 6.3967 15.9481 6.43702 13.8884 6.40682V6.40649ZM19.7875 11.6135C19.8216 11.7154 19.7191 11.7831 19.6117 11.7894C19.6117 11.7894 19.2608 11.8193 18.777 11.8582C18.4088 10.998 17.5532 10.3919 16.562 10.3919C15.4744 10.3919 14.5509 11.1222 14.2547 12.1167C14.1726 12.1179 14.0772 12.1212 14.0009 12.1212C12.1272 12.1212 8.38835 11.7894 8.38835 11.7894C8.281 11.7831 8.17846 11.7154 8.21264 11.6135C9.65265 7.22414 9.69545 7.55398 13.9202 7.60011C18.1452 7.64623 18.1697 7.33265 19.7875 11.6135ZM16.562 11.2214C16.8229 11.2205 17.0799 11.2846 17.3098 11.4078C17.5397 11.531 17.7354 11.7095 17.8791 11.9273C17.0329 11.99 16.0589 12.0542 15.1514 12.0915C15.2819 11.8294 15.4832 11.6089 15.7325 11.4552C15.9818 11.3014 16.2691 11.2205 16.562 11.2214ZM6.82158 12.646C6.83435 12.6648 6.8468 12.6837 6.8609 12.7021H6.80615L6.82158 12.646ZM7.75786 13.7484C8.12852 13.7422 10.1184 14.4121 10.1184 14.4121C10.3668 14.4819 10.5856 14.9518 10.5843 15.21C10.5806 16.0794 8.33675 15.7777 7.42602 15.7812C7.36479 15.7814 7.30413 15.7694 7.24752 15.7461C7.19092 15.7227 7.13949 15.6884 7.09618 15.6451C7.05287 15.6018 7.01854 15.5504 6.99517 15.4938C6.97179 15.4372 6.95982 15.3766 6.95995 15.3153V14.2145C6.95995 13.9563 7.38719 13.7545 7.75786 13.7484ZM20.2426 13.7484C20.6132 13.7545 21.0405 13.9563 21.0405 14.2145V15.3153C21.0406 15.3766 21.0286 15.4372 21.0053 15.4938C20.9819 15.5504 20.9475 15.6018 20.9042 15.6451C20.8609 15.6884 20.8095 15.7227 20.7529 15.7461C20.6963 15.7694 20.6356 15.7814 20.5744 15.7812C19.6635 15.7777 17.4198 16.0794 17.4161 15.21C17.4148 14.9518 17.6335 14.4819 17.882 14.4121C17.882 14.4121 19.8719 13.7422 20.2426 13.7484Z" fill="white"/>
            </svg>       
            <div class="info">
              <b>60</b>
              <span>السيارات المضافة</span>
            </div>
          </a>
        </li>
        <!-- السيارات الأكثر مشاهدة -->
        <li class="item">
          <a href="?tab=view">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="28" height="28" rx="5.13433" fill="#F19B9B"/>
              <path d="M18.3491 13.1216C18.3491 12.5781 16.5604 12.1377 14.3544 12.1377C12.1484 12.1377 10.36 12.5781 10.36 13.1216L9.25411 18.8999C9.24641 18.9209 9.24211 18.943 9.24136 18.9653V19.9492C9.2416 20.4921 11.5309 20.9328 14.3544 20.9328C17.1785 20.9328 19.4675 20.4921 19.4675 19.9492V18.9653C19.467 18.943 19.4628 18.9208 19.455 18.8999L18.3491 13.1216ZM16.4317 18.2322L14.7992 17.227L14.3544 19.0524L13.9097 17.2272L12.2772 18.2325L13.257 16.5572L11.4784 16.1008L13.257 15.6448L12.2772 13.969L13.9097 14.9747L14.3544 13.1493L14.7992 14.974L16.4317 13.9687L15.4521 15.6443L17.2305 16.1006L15.4521 16.5572L16.4317 18.2322ZM19.9669 8.62366L18.1794 11.3731L21.0838 9.74952L19.9669 8.62366ZM8.74245 8.62366L7.62525 9.74952L10.5297 11.3731L8.74245 8.62366ZM7.13428 12.1367V13.4539L9.8387 13.0665L7.13428 12.1367ZM18.8704 13.0665L21.5746 13.4539V12.1367L18.8704 13.0665ZM12.4808 7.4552L11.0252 7.68961L12.8432 10.9972L12.4808 7.4552ZM16.2283 7.4552L15.8658 10.9972L17.6839 7.68961L16.2283 7.4552Z" fill="white"/>
            </svg>
            <div class="info">
              <b>50</b>
              <span>السيارات الأكثر مشاهدة</span>
            </div>
          </a>
        </li>
        <!-- السيارات الأكثر مشاهدة -->
        <li class="item">
          <a href="?tab=call">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="28" height="28" rx="5.13433" fill="#1EB147"/>
              <path d="M15.717 17.1489C15.4909 16.6826 15.1986 16.3432 14.694 16.5502L13.6987 16.9199C12.9018 17.2896 12.5047 16.9199 12.1077 16.3653L10.3182 12.2874C10.0949 11.8211 10.2107 11.3824 10.7153 11.1755L12.1077 10.6209C12.6123 10.414 12.5323 9.97529 12.3062 9.50901L11.1123 7.2852C10.8862 6.81892 10.423 6.7058 9.91839 6.91273C8.90922 7.33211 8.07375 7.98325 7.53332 8.95168C6.87156 10.1353 7.20244 11.7797 7.33479 12.4723C7.46714 13.1648 7.93037 14.376 8.52871 15.6231C9.12704 16.8702 9.65093 17.8497 10.1197 18.4043C10.5884 18.9588 11.7106 20.4763 13.1031 20.8129C14.2446 21.0888 15.4744 20.8571 16.4835 20.4404C16.9881 20.2335 16.9909 19.7948 16.7648 19.3258L15.717 17.1489ZM18.535 10.0691H16.9054L19.0782 12.2432H14.1922V13.3303H19.0782L16.9082 15.5017H18.5377L21.2537 12.784L18.535 10.0691Z" fill="white"/>
            </svg>
            <div class="info">
              <b>50</b>
              <span>عدد الأتصالات</span>
            </div>
          </a>
        </li>        
      </ul>
      <hr>
      <ul class="main-menu list-unstyled p-0">
        <li class="head">
          <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 18V15.875L17.15 10.7L19.3 12.8L14.125 18H12ZM20.025 12.1L17.9 9.975L18.6 9.275C18.8 9.075 19.0417 8.975 19.325 8.975C19.6083 8.975 19.8417 9.075 20.025 9.275L20.725 10C20.9083 10.2 21 10.4377 21 10.713C21 10.9883 20.9083 11.2173 20.725 11.4L20.025 12.1ZM2 16C1.45 16 0.979002 15.804 0.587002 15.412C0.195002 15.02 -0.000664969 14.5493 1.69779e-06 14V2C1.69779e-06 1.45 0.196002 0.979002 0.588002 0.587002C0.980002 0.195002 1.45067 -0.000664969 2 1.69779e-06H8L10 2H18C18.55 2 19.021 2.196 19.413 2.588C19.805 2.98 20.0007 3.45067 20 4V6.925C19.4833 6.925 18.975 6.98767 18.475 7.113C17.975 7.23834 17.5417 7.484 17.175 7.85L9.075 16H2Z" fill="#D97E00"/>
          </svg>
          <span class="text-primary">التحكم</span>
        </li>
        <!--  طلبات الشراء اونلاين -->
        <li class="item">
          <a href="?tab=data">
            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
              <mask id="mask0_689_13444" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="20" height="19">
              <path d="M15.1256 10.9998V12.4998H12.1257V10.9998C12.1257 10.602 12.2837 10.2205 12.565 9.93921C12.8463 9.65791 13.2278 9.49988 13.6257 9.49988C14.0235 9.49988 14.405 9.65791 14.6863 9.93921C14.9676 10.2205 15.1256 10.602 15.1256 10.9998ZM10.2507 12.4998H17.0006V16.9997H10.2507V12.4998Z" fill="white" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M12.4998 2.74976H14.7497C15.1475 2.74976 15.5291 2.90779 15.8104 3.18909C16.0917 3.47038 16.2497 3.85191 16.2497 4.24972V6.49968M6.4999 16.2495H4.24995C3.85214 16.2495 3.47061 16.0914 3.18931 15.8101C2.90802 15.5288 2.74998 15.1473 2.74998 14.7495V12.4995M8.74986 3.49974V7.99964C8.74986 8.82838 7.23864 9.49961 5.37493 9.49961C3.51122 9.49961 2 8.82838 2 7.99964V3.49974" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M8.74986 5.74988C8.74986 6.57861 7.23864 7.24985 5.37493 7.24985C3.51122 7.24985 2 6.57861 2 5.74988" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M8.74986 3.49997C8.74986 4.3287 7.23864 4.99994 5.37493 4.99994C3.51122 4.99994 2 4.3287 2 3.49997C2 2.67124 3.51122 2 5.37493 2C7.23864 2 8.74986 2.67124 8.74986 3.49997Z" fill="white" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
              </mask>
              <g mask="url(#mask0_689_13444)">
              <path d="M0.499512 0.5H18.4991V18.4996H0.499512V0.5Z" fill="#323232"/>
              </g>
            </svg>   
            <div class="info">
              <span>بيانات المعرض</span>
            </div>
          </a>
        </li>
        <!--  طلبات الشراء اونلاين -->
        <li class="item">
          <a href="?tab=add">
            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="15" height="15" fill="#323232"/>
              <path d="M6.875 11.875V8.125H3.125V6.875H6.875V3.125H8.125V6.875H11.875V8.125H8.125V11.875H6.875Z" fill="white"/>
            </svg>
            <div class="info">
              <span>أضف سيارة للبيع</span>
            </div>
          </a>
        </li>        
      </ul>
    </div>

    <div class="col-md-8 col-12 main-dashboard">
      <?php 
        if ($tab == 'add'): ?>
        <section class="section-form mb-5">
          <div class="row">
            <div class="col-md-7 col-12 mt-5">
              <div class="card bg-gray p-5">
                <h2 class="font-bold">السيارات المقترحة</h2>
                <p>سيوفر عليك هذا الأختيار مرحلة ادخال بيانات وصور للسيارة لأنه مجرد ان تختار السيارة ستتم أضافة البيانات والصور الخاصة بالسيارة بشكل تلقائي</p>
                <a href="?tab=suggested" class="btn btn-dark text-white py-2 mt-4 font-bold">
                  <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.5 12H19.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.5 5L19.5 12L12.5 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>        
                  <span>أذهب الى السيارات المقترحة</span>
                </a>
              </div>
            </div>
            <div class="col-md-7 col-12 mt-5">
              <div class="card bg-gray p-5">
                <h2 class="font-bold">أضافة سيارة من خلال المعرض بشكل يدوي</h2>
                <p>في حالة عدم ايجاد السيارة في السيارات المقترحة يرجي أضافة السيارة من هنا</p>
                <a href="?tab=manually" class="btn btn-dark text-white py-2 mt-4 font-bold">
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
      <?php
        elseif ($tab == 'suggested'):
          get_template_part( 'templates/include/dashboard', 'add-suggested' );
        elseif ($tab == 'manually'):
          get_template_part( 'templates/include/dashboard', 'add-manually' );
        elseif ($tab == 'funding'):
          get_template_part( 'templates/include/dashboard', 'funding' );
        endif; 
      ?>
    </div>
  </div>
</div>
<?php else: ?>
  <div class="vh-100">
    <div class="container">
      <div class="row">
        <div class="login pt-5 m-auto col-auto">
          <a class="btn btn-primary btn-lg text-white" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa fa-user"></i>
            <span>تسجيل الدخول</span>
          </a>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php
get_footer();
?>