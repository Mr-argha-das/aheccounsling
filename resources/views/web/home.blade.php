@include('layouts.frontend')

<?php 

use \App\Model\Entry\Service_model as serviceModel;

use \App\Model\Entry\Test_model as testModel;

use \App\Model\Entry\Blog_model as blogModel;

use \App\Model\Country_model as countryModel;

use \App\Model\Entry\Project_model as projecjModal;


$countryCode = countryModel::pluck('phonecode','id');

$findService = serviceModel::where('services_status',1)->limit(3)->orderBy('services_id')->get();

$findTest = testModel::orderBy('test_id')->get();

$mostProject = projecjModal::latest()->with('category_list')->limit(6)->orderBy('id')->get();

$findBlogs = blogModel::where('blog_status',1)->limit(15)->orderBy('order_number')->get();

use \App\Model\Entry\Home_offere_model;
$bannerList = Home_offere_model::where('type','banner')->get();


$mobileList = Home_offere_model::where('type','mobile')->get();
?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<style>
  @media only screen and (max-width:767.99px){
    .banner-show-desk-mb{
  display:none;
}
  }
  @media only screen and (min-width:768px){
    .banner-for-mobile{
      display:none;
    }
  }

</style>

<!--header end-->

<!--hero section start-->

<section class="shadow py-0 banner-show-desk-mb" id="booking_form">

  <div class="">

    <div class="my-home-banner owl-carousel owl-theme">
  
    <!----------------------------Desktop View Banner------------------------------------------>
       @foreach($bannerList as $banners)
     
         <div class="item owl-sld-item mob">
          <img src="{{$banners->value}}" class="img-fluid img-carousal" alt="banner">
          <a target="_blank" href="{{$banners->link}}"><button class="owl-sld-btn"> Book Now </button></a>
        </div>
        
        @endforeach

        
     </div>
  </div>
 </section>


 <!----------------------------Mobile View Banner------------------------------------------>
  <section class="shadow py-0 banner-for-mobile" id="booking_form">

  <div class="">

    <div class="my-home-banner owl-carousel owl-theme">
  
    <!----------------------------Mobile View Banner------------------------------------------>
    @foreach($mobileList as $banners)
         <div class="item owl-sld-item mob ">
          <img src="{{$banners->value}}" class="img-fluid img-carousal" alt="banner">
          <a target="_blank" href="{{$banners->link}}"><button class="owl-sld-btn"> Book Now </button></a>
          <!-- <a target="_blank" href="{{$banners->link}}"><button class="owl-sld-btn1"> Book Now </button></a>
          <a target="_blank" href="{{$banners->link}}"><button class="owl-sld-btn2"> Book Now </button></a>
          <a target="_blank" href="{{$banners->link}}"><button class="owl-sld-btn3"> Book Now </button></a> -->
        </div>
        @endforeach
        
   <!----------------------------Mobile View Banner------------------------------------------>
       
      

        
     </div>
  </div>
 
</section>

 
<div class="page-content">
 
<style>

  .promotions-carousel{
    position: relative;
  }
  .promotions-carousel .owl-nav{
    display: block!important;
    position: absolute;
    top: 35%;
    width: 100%;
    left: 50%;
    height: 0px;
  }

  .promotions-carousel .owl-nav .owl-next span, .promotions-carousel .owl-nav .owl-prev span{
    display: none;
  }

  .promotions-carousel .owl-nav .owl-next{
    right: 0;
    float: right;
    margin-right: -70px;
  }

   .promotions-carousel .owl-nav .owl-prev{
    left: 0;
    float: left;
    margin-left: -70px;
  }

  .promotions-carousel .owl-nav .owl-next, .promotions-carousel .owl-nav .owl-prev{
    position: relative;
  }

  .promotions-carousel .owl-nav .owl-next::before {
    position: absolute;
    height: 10px;
    width: 10px;
    left: 20px;
    top: -2px;
    content: '\f105';
    font-family: FontAwesome;
}

  .promotions-carousel .owl-nav .owl-prev::before {
    position: absolute;
    height: 10px;
    width: 10px;
    left: 20px;
    top: -2px;
    content: '\f104';
    font-family: FontAwesome;
}

/*================================== disabled  ================================*/

 .promotions-carousel .owl-nav.disabled{
    display: block!important;
    position: absolute;
    top: 35%;
    width: 100%;
    left: 50%;
    height: 0px;
  }

  .promotions-carousel .owl-nav.disabled .owl-next span, .promotions-carousel .owl-nav.disabled .owl-prev span{
    display: none;
  }

  .promotions-carousel .owl-nav.disabled .owl-next{
    right: 0;
    float: right;
    margin-right: -70px;
  }

   .promotions-carousel .owl-nav.disabled .owl-prev{
    left: 0;
    float: left;
    margin-left: -70px;
  }

  .promotions-carousel .owl-nav.disabled .owl-next, .promotions-carousel .owl-nav.disabled .owl-prev{
    position: relative;
  }

  .promotions-carousel .owl-nav.disabled .owl-next::before {
    position: absolute;
    height: 10px;
    width: 10px;
    left: 20px;
    top: -2px;
    content: '\f105';
    font-family: FontAwesome;
}

  .promotions-carousel .owl-nav.disabled .owl-prev::before {
    position: absolute;
    height: 10px;
    width: 10px;
    left: 20px;
    top: -2px;
    content: '\f104';
    font-family: FontAwesome;
}


/*================================== disabled  ================================*/



 

.my-bl-carousel, .test-carousel, .bl-carousel{
    position: relative;
  }
  .my-bl-carousel .owl-nav,
  .my-bl-carousel .owl-nav,
  .my-bl-carousel .owl-nav{
    display: block!important;
    position: absolute;
    top: 35%;
    width: 100%;
    left: 50%;
    height: 0px;
  }

  .my-bl-carousel .owl-nav .owl-next span, .my-bl-carousel .owl-nav .owl-prev span,
  .test-carousel .owl-nav .owl-next span, .test-carousel .owl-nav .owl-prev span,
  .bl-carousel .owl-nav .owl-next span, .bl-carousel .owl-nav .owl-prev span{
    display: none;
  }

  .my-bl-carousel .owl-nav .owl-next,
  .test-carousel .owl-nav .owl-next,
  .bl-carousel .owl-nav .owl-next{
    right: 0;
    float: right;
    margin-right: -70px;
  }

   .my-bl-carousel .owl-nav .owl-prev,
   .test-carousel .owl-nav .owl-prev,
   .bl-carousel .owl-nav .owl-prev{
    left: 0;
    float: left;
    margin-left: -70px;
  }

  .my-bl-carousel .owl-nav .owl-next, .my-bl-carousel .owl-nav .owl-prev,
  .test-carousel .owl-nav .owl-next, .test-carousel .owl-nav .owl-prev,
  .bl-carousel .owl-nav .owl-next, .bl-carousel .owl-nav .owl-prev{
    position: relative;
  }

  .my-bl-carousel .owl-nav.disabled .owl-next::before,
  .test-carousel .owl-nav.disabled .owl-next::before ,
  .bl-carousel .owl-nav.disabled .owl-next::before {
    position: absolute;
    height: 10px;
    width: 10px;
    left: 20px;
    top: -2px;
    content: '\f105';
    font-family: FontAwesome;
}

  .my-bl-carousel .owl-nav .owl-prev::before,
  .test-carousel .owl-nav .owl-prev::before,
  .bl-carousel .owl-nav .owl-prev::before {
    position: absolute;
    height: 10px;
    width: 10px;
    left: 20px;
    top: -2px;
    content: '\f104';
    font-family: FontAwesome;
}

@media screen and (min-width:320px) and (max-width: 768px) { 

  .my-bl-carousel .owl-nav, .promotions-carousel .owl-nav {
    left: 42%!important;
    top: 30%;
  }

  .promotions-carousel .owl-nav .owl-next{
    margin-right: -30px!important;
  }

  .bl-carousel .owl-nav{
   left: 47%!important;
  }

  .promotions-carousel .owl-nav.disabled{
        left: 40%!important;
        top: 50%!important;
  }
  .bl-carousel .owl-nav .owl-next{
    margin-right: -20px!important;
  }

   .bl-carousel .owl-nav.disabled .owl-next{
    margin-right: -20px!important;
  }

  .bl-carousel .owl-nav .owl-next{
    right: 0;
    float: right;
    margin-right: -15px!important;
  }

.my-bl-carousel .owl-nav .owl-next{
    right: 0;
    float: right;
    margin-right: -40px!important;
  }

   .my-bl-carousel .owl-nav .owl-prev, .bl-carousel .owl-nav .owl-prev{
    left: 0;
    float: left;
    margin-left: 0px!important;
  }


}


.img-carousal{
  width: 100%;
}
@media only screen and (min-width: 300px) and (max-width: 767px){
  .img-carousal{
  width: 100%;


}
}
</style>
  <section class="text-center p-0 mt-3 mb-4" id="pages-connent-css">
    <h2 class="text-center mt-3 mb-3 font-w-6">Trending Services</h2>
    <div class="container">

      <div class="row mx-0 align-items-center promotions-carousel owl-carousel owl-theme btn-slider slide-1-owl">

        <div class="item">

          <div class="carousel-box-pt rounded hover-translate" id="service-tab-scc">

            <div class="min-Stye">
              <img src="webassets/images/contract.png">
            </div>

            <h5 class="mt-4 mb-3 wrt-fnt-szing">Writing & Proofreading Serv.</h5>

            <p class="mb-0 para-fnt-sz-wrt">AHEC helps you to get proofread your assignments.</p>

          </div>

        </div>

        <div class="item">

          <div class="carousel-box-pt rounded hover-translate" id="service-tab-scc">

            <div class="min-Stye">
              <img src="webassets/images/electric.png">
            </div>

            <h5 class="mt-4 mb-3 wrt-fnt-szing">Turnitin Services</h5>

            <p class="mb-0 para-fnt-sz-wrt">Share your solution file to Get the certified plagiarism report from Turnitin Application.</p>

          </div>

        </div>

        <div class="item">

          <div class="carousel-box-pt rounded hover-translate" id="service-tab-scc">
            <div class="min-Stye">
              <img src="webassets/images/businessman.png">
            </div>

            <h5 class="mt-4 mb-3 wrt-fnt-szing">Website Blogs and Content</h5>

            <p class="mb-0 para-fnt-sz-wrt">Hire us to write your website content or weekly blogs with Digital Marketing
            </p>

          </div>

        </div>

        <div class="item">

<div class="carousel-box-pt rounded hover-translate" id="service-tab-scc">

  <div class="min-Stye">
    <img src="webassets/images/cust1.png">
  </div>

  <h5 class="mt-4 mb-3 wrt-fnt-szing">Custom Paper Writing</h5>

  <p class="mb-0 para-fnt-sz-wrt">Professional custom paper writing service tailored to your academic needs and requirements.</p>

</div>

</div>

<div class="item">

<div class="carousel-box-pt rounded hover-translate" id="service-tab-scc">

  <div class="min-Stye">
    <img src="webassets/images/cust2.png">
  </div>

  <h5 class="mt-4 mb-3 wrt-fnt-szing">Resume/CV Writing Help</h5>

  <p class="mb-0 para-fnt-sz-wrt">Specialized resume/CV writing service for impactful career documents and job opportunities.</p>

</div>

</div>


<div class="item">

<div class="carousel-box-pt rounded hover-translate" id="service-tab-scc">

  <div class="min-Stye">
    <img src="webassets/images/cust3.png">
  </div>

  <h5 class="mt-4 mb-3 wrt-fnt-szing">Urgent Assignment Help</h5>

  <p class="mb-0 para-fnt-sz-wrt">Swift and reliable urgent assignment help, ensure timely submission and top grades.</p>

</div>

</div>

<div class="item">

<div class="carousel-box-pt rounded hover-translate" id="service-tab-scc">

  <div class="min-Stye">
    <img src="webassets/images/cust4.png">
  </div>

  <h5 class="mt-4 mb-3 wrt-fnt-szing">Reference Citation Help</h5>

  <p class="mb-0 para-fnt-sz-wrt">Accurate reference citation help for proper academic referencing and plagiarism-free content.</p>

</div>

</div>

        <div class="item">

          <div class="carousel-box-pt rounded hover-translate" id="service-tab-scc">

            <div>

             <div class="min-Stye">
              <img src="webassets/images/settings.png">
            </div>

            <h5 class="mt-4 mb-3 wrt-fnt-szing">Tutorial Classes</h5>

            <p class="mb-0 para-fnt-sz-wrt">Book your tutorial classes of our professional and experienced tutors</p>

          </div>

        </div>

      </div>

    </div>

  </section>

  <!--feature end-->

  <!--about start-->

  <section class="position-relative lesson-sec">

    <div id="particles-js"></div>

    <div class="container">

      <div class="row align-items-center justify-content-between">

        <div class="col-12 col-lg-6 col-md-6 mb-6 mb-lg-0 img-mobile-vw-display">

          <img src="webassets/images/gif-d.gif" alt="Image" class="img-fluid">

        </div>

        <div class="col-12 col-lg-6 col-md-6  col-xl-5">

<div> <span class="badge badge-primary-soft p-2"><!--

  <i class="la la-exclamation ic-3x rotation"></i> -->

  <img src="webassets/images/fav.png" class="rotation img-fluid" width="50" alt="">

</span>

<h2 class="mt-3">LESSON LEARNT & APPLIED</h2>

<p class="lead">What we have learnt through out our experiences, have tried to applied the same.</p>

</div>

<div class="d-flex flex-wrap justify-content-start">

  <div class="mb-3 mr-4 ml-lg-0 mr-lg-4">

    <div class="d-flex align-items-center">

      <div class="badge-primary-soft rounded p-1">

        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">

          <polyline points="20 6 9 17 4 12"></polyline>

        </svg>

      </div>

      <p class="mb-0 ml-3">Quality Content & On time Delivery</p>

    </div>

  </div>

  <div class="mb-3 mr-4 ml-lg-0 mr-lg-4">

    <div class="d-flex align-items-center">

      <div class="badge-primary-soft rounded p-1">

        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">

          <polyline points="20 6 9 17 4 12"></polyline>

        </svg>

      </div>

      <p class="mb-0 ml-3">Plagiarism Free & Original Content</p>

    </div>

  </div>

  <div class="mb-3 mr-4 ml-lg-0 mr-lg-4">

    <div class="d-flex align-items-center">

      <div class="badge-primary-soft rounded p-1">

        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">

          <polyline points="20 6 9 17 4 12"></polyline>

        </svg>

      </div>

      <p class="mb-0 ml-3">Available To Help With All Subjects</p>

    </div>

  </div>

  <div class="mb-3 mr-4 ml-lg-0 mr-lg-4">

<div class="d-flex align-items-center">

  <div class="badge-primary-soft rounded p-1">

    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">

      <polyline points="20 6 9 17 4 12"></polyline>

    </svg>

  </div>

  <p class="mb-0 ml-3">500K+ Finished Orders with 4.9/5 Rating</p>

</div>

</div>

  <div class="mb-3 mr-4 ml-lg-0 mr-lg-4">

    <div class="d-flex align-items-center">

      <div class="badge-primary-soft rounded p-1">

        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">

          <polyline points="20 6 9 17 4 12"></polyline>

        </svg>

      </div>

      <p class="mb-0 ml-3">Customized Assistance on Friendly Budget</p>

    </div>

  </div>

</div> <a href="https://ahecounselling.com/contact-us" class="btn btn-outline-primary mt-5 mb-4">

  Contact Us

</a>

</div>

</div>

</div>

</section>

<!--about end-->

<style type="text/css">
  .shadow {
    background: white!important;

  }

  .bl-bdr:hover {
    border: 1px solid #ffffff00!important;
    border-radius: 5px;
  }
</style>


<section class="service-desktop-view" style="background: #c7e1f6;" class="services">

  <div class="container">

    <div class="row justify-content-center text-center">

      <div class="col-12 col-md-12 col-md-6 col-lg-8 mb-8 mb-lg-0">

        <div class="mb-8"> <span class="badge badge-primary-soft p-2 font-w-6">

          Services

              </span>

        <h2 class="mt-3 font-w-6">Our Accountability & Subjects</h2>

        <p class="lead mb-0">We take whole accountability and satisfy our clients with the services we provide.</p>

      </div>

    </div>

  </div>

  <div class="row align-items-center justify-content-center">

    @foreach ($findService as $service)

    <div class="col-xl-4 col-lg-4 col-md-6 mb-8 mb-lg-0 ">

      <div class="px-4 py-7 rounded hover-translate border text-center shadow">

        <div>

          <div class="ih-item square effect6 from_top_and_bottom">
            <a href="https://www.ahecounselling.com/ordernow" target="_blank">

            <div class="img">
              <img src="<?=asset('/assets/uploads/services/'.$service->services_image)?>" alt="{{$service->image_alt}}">
            </div>

            <div class="info">

              <h3></h3>

              <p>
                <input class="btn btn-outline-light btn-block"  name="Book Now" value="Book Now">
              </p>

            </div>
          </a>
        </div>
     </div>
         <h5 class="mt-4 mb-3">{{ serviceModel::getDesc(strip_tags($service->services_name),15) }}</h5>

          <p>{{ serviceModel::getDesc(strip_tags($service->services_desc),55) }}...</p>

          <?php if(!empty($service->services_files)) { ?>
            <a class="btn btn-outline-light " href="<?=asset('public/assets/uploads/services/'.$service->services_files)?>" target="_blank">Sample Download</a>
          <?php } ?>

        </div>

      </div>
     @endforeach
       <div class="col-md-12 text-center">
        <a href="services" class="btn btn-outline-primary mt-5 mb-3 mx-auto">

        Learn More

      </a>
      </div>

    </div>

  </div>

</section>

<!----------------------------------------------------------Mobile View Part-------------------------------------------------------->

<section class="text-center p-0 mt-3 mobile-view-service" id="pages-connent-css" style="background: #c7e1f6;">

<div class="container">
<div class="row justify-content-center text-center">

<div class="col-12 col-md-12 col-md-6 col-lg-8 mb-8 mb-lg-0">

  <div class="mb-8"> <span class="badge badge-primary-soft p-2 font-w-6">

    Services

        </span>

  <h2 class="mt-3 font-w-6">Our Accountability & Services</h2>

  <p class="lead mb-0">We take whole accountability and satisfy our clients with the services we provide.</p>

</div>

</div>

</div>

  <div class="row mx-0 align-items-center owl-carousel my-bl-carousel owl-theme ">
  @foreach ($findService as $service)
<div class="col-xl-4 col-lg-4 col-md-6 mb-8 mb-lg-0 ">

      <div class="px-4 py-7 rounded hover-translate border text-center shadow">

        <div>

          <div class="ih-item square effect6 from_top_and_bottom">
            <a href="https://www.ahecounselling.com/ordernow" target="_blank">

            <div class="img">
              <img src="<?=asset('/assets/uploads/services/'.$service->services_image)?>" alt="{{$service->image_alt}}">
            </div>

            <div class="info">

              <h3></h3>

              <p>
                <input class="btn btn-outline-light btn-block"  name="Book Now" value="Book Now">
              </p>

            </div>
          </a>
        </div>
     </div>
         <h5 class="mt-4 mb-3">{{ serviceModel::getDesc(strip_tags($service->services_name),15) }}</h5>

          <p>{{ serviceModel::getDesc(strip_tags($service->services_desc),55) }}...</p>

          <?php if(!empty($service->services_files)) { ?>
            <a class="btn btn-outline-light " href="<?=asset('public/assets/uploads/services/'.$service->services_files)?>" target="_blank">Sample Download</a>
          <?php } ?>

        </div>

      </div>
    @endforeach
    <!-- <div class="item">

      <div class="px-4 py-7 rounded hover-translate" id="service-tab-scc">

        <div class="min-Stye">
          <img src="webassets/images/electric.png">
        </div>

        <h5 class="mt-4 mb-3">Turnitin <br> Services</h5>

        <p class="mb-0">Share your solution file to Get the certified plagiarism report from Turnitin Application.</p>

      </div>

    </div> -->

    <!-- <div class="item">

      <div class="px-4 py-7 rounded hover-translate" id="service-tab-scc">
        <div class="min-Stye">
          <img src="webassets/images/businessman.png">
        </div>

        <h5 class="mt-4 mb-3">Website Blogs and Content</h5>

        <p class="mb-0">Hire us to write your website content or weekly blogs with Digital Marketing
        </p>

      </div>

    </div> -->

    <!-- <div class="item">

      <div class="px-4 py-7 rounded hover-translate" id="service-tab-scc">

        <div>

         <div class="min-Stye">
          <img src="webassets/images/settings.png">
        </div>

        <h5 class="mt-4 mb-3">Tutorial Classes</h5>

        <p class="mb-0">Book your tutorial classes of our professional and experienced tutors</p>

      </div>

    </div>-->


  </div> 
  <div class="text-center">
        <a href="services" class="btn btn-outline-primary mt-3 mb-3 mx-auto">

        Learn More

      </a>
      </div>
</div>

</section>





<!---------------------------------------------------------------------------------------------------------------------------------->

<style>


/* Center website */
#styles .main {
  max-width: 1000px;
  margin: auto;
}

#styles h1 {
  font-size: 50px;
  word-break: break-all;
}

#styles .row {
  margin: 10px -16px;
}

/* Add padding BETWEEN each column */
#styles.row,
.row > .column {
  padding: 8px;
}

/* Create three equal columns that floats next to each other */
#styles .column {
  float: left;
  width: 33.33%;
  display: none; /* Hide all elements by default */
}

/* Clear floats after rows */ 
#styles .row:after {
  content: "";
  display: table;
  clear: both;
}

/* Content */
#styles .content {
  background-color: white;
  padding: 10px;
}

/* The "show" class is added to the filtered elements */
#styles .show {
  display: block;
}

/* Style the buttons */
#styles .btn {
  border: none;
  outline: none;
  padding: 12px 16px;
  background-color: white;
  cursor: pointer;
}

#styles .btn:hover {
  background-color: #ddd;
}

#styles .btn.active {
  background-color: #666;
  color: white;
}




</style>

<!--
<section id="styles">
	
<div class="container">
<div id="myBtnContainer">
  <button class="btn active" onclick="filterSelection('all')"> Show all</button>
  <button class="btn" onclick="filterSelection('nature')"> Nature</button>
  <button class="btn" onclick="filterSelection('cars')"> Cars</button>
  <button class="btn" onclick="filterSelection('people')"> People</button>
</div>

 Portfolio Gallery Grid -->
<!--
<div class="row">
  <div class="column nature">
    <div class="content">
     <a data-title="Project 1">
    <img src="webassets/images/logo.png" alt="Car" style="width:100%">
      </a>
      
    </div>
  </div>
  <div class="column nature">
    <div class="content">
    <a data-title="Project 1">
    <img src="webassets/images/logo.png" alt="Car" style="width:100%">
      </a>
     
    </div>
  </div>
  <div class="column nature">
    <div class="content">
    <a data-title="Project 1">
    <img src="webassets/images/logo.png" alt="Car" style="width:100%">
      </a>
     
    </div>
  </div>
  
  <div class="column cars">
    <div class="content">
      <a data-title="Project 1">
    <img src="webassets/images/logo.png" alt="Car" style="width:100%">
      </a>
     
    </div>
  </div>
  <div class="column cars">
    <div class="content">
    <a data-title="Project 1">
    <img src="webassets/images/logo.png" alt="Car" style="width:100%">
      </a>
       
    </div>
  </div>
  <div class="column cars">
    <div class="content">
    <a data-title="Project 1">
    <img src="webassets/images/logo.png" alt="Car" style="width:100%">
      </a>
   
    </div>
  </div>

  <div class="column people">
    <div class="content">
      <a data-title="Project 1">
    <img src="webassets/images/logo.png" alt="Car" style="width:100%">
      </a>
    </div>
  </div>
  <div class="column people">
    <div class="content">
   <a data-title="Project 1">
    <img src="webassets/images/logo.png" alt="Car" style="width:100%">
      </a>
      
    </div>
  </div>
  <div class="column people">
    <div class="content">
    	 <a data-title="Project 1">
    <img src="webassets/images/logo.png" alt="Car" style="width:100%">
      </a>
   
    </div>
  </div>
</div>
 END GRID -->

</div>



</section>

<script>
  $('.home-banner').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    autoplay:true,
    responsive:{
      0:{
        items:1,
      },
      600:{
        items:1,
      },
      1000:{
        items:1
      }
    }
  })
</script>
<script>
  filterSelection("all")
  function filterSelection(c) {
    var x, i;
    x = document.getElementsByClassName("column");
    if (c == "all") c = "";
    for (i = 0; i < x.length; i++) {
      w3RemoveClass(x[i], "show");
      if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
    }
  }

  function w3AddClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
      if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
    }
  }

  function w3RemoveClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
      while (arr1.indexOf(arr2[i]) > -1) {
        arr1.splice(arr1.indexOf(arr2[i]), 1);     
      }
    }
    element.className = arr1.join(" ");
  }



</script>



<!---- DHEERAJ PORTFOLIO ---->


<!--
<section class="most-qusion-itme">
	<div class="container">

		<h1>Most viewed homework solutions</h1>
		<p>Check out the most popular and recent documents add by other students.</p>
		<div class="row">
			<div class="col-md-3">
				<div class="main_solucation">
					<img src="webassets/images/text1.jpg">
					<h5>Leadership Styles and Motivation in Toy…</h5>
					<div class="sins">
						<samp>14 Pages</samp>
						<samp>144 Words</samp>
						<samp>14 Views</samp>
						<samp>4 Downloads</samp>
						<p>MANAGING FINANCIAL RESOURCES AND DECISIONS Table of Cont…</p>
							<div class="bvv-button_style">
								<button>
									<a  href="">
										View Document
									</a>
								</button>
							</div>

					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="main_solucation">
					<img src="webassets/images/text1.jpg">
					<h5>Leadership Styles and Motivation in Toy…</h5>
					<div class="sins">
						<samp>14 Pages</samp>
						<samp>144 Words</samp>
						<samp>14 Views</samp>
						<samp>4 Downloads</samp>
						<p>MANAGING FINANCIAL RESOURCES AND DECISIONS Table of Cont…</p>
							<div class="bvv-button_style">
								<button>
									<a  href="">
										View Document
									</a>
								</button>
							</div>

					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="main_solucation">
					<img src="webassets/images/text1.jpg">
					<h5>Leadership Styles and Motivation in Toy…</h5>
					<div class="sins">
						<samp>14 Pages</samp>
						<samp>144 Words</samp>
						<samp>14 Views</samp>
						<samp>4 Downloads</samp>
						<p>MANAGING FINANCIAL RESOURCES AND DECISIONS Table of Cont…</p>
							<div class="bvv-button_style">
								<button>
									<a  href="">
										View Document
									</a>
								</button>
							</div>

					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="main_solucation">
					<img src="webassets/images/text1.jpg">
					<h5>Leadership Styles and Motivation in Toy…</h5>
					<div class="sins">
						<samp>14 Pages</samp>
						<samp>144 Words</samp>
						<samp>14 Views</samp>
						<samp>4 Downloads</samp>
						<p>MANAGING FINANCIAL RESOURCES AND DECISIONS Table of Cont…</p>
							<div class="bvv-button_style">
								<button>
									<a  href="">
										View Document
									</a>
								</button>
							</div>

					</div>
				</div>
			</div>


		</div>
	</div>
</section>-->

<!----- DHEERAJ PORTFOLIO--->



<section class="bg-homedocuments">
 <div class="container">
  <div class="row">
   <div class="col-md-12">
    <h1 class="text-center mt-4">
     Most popular sample projects
   </h1>
   <p class="text-center">Check out the most popular and recent documents add by other students.</p>
   <div class="main-content container" id="main0">

    <div class="my-bl-carousel owl-carousel owl-theme">
      @foreach($mostProject as $project)
      <div class="item p-2">
        <div class="main-div bg-white shadow border mt-4">

         <a class="h-350 d-inline-block w-100" href="/document/{{ $project->slug }}">
          
           <img alt="{{ $project->title }}" class="card-img-top" loading="lazy" src="{{  asset('assets/uploads/projectthumb/'.$project->thub_img) }}">
        </a> 

        <a class="text-decoration-none" href="/document/{{ $project->slug }}"></a>

        <div class="card-body">
          <a class="text-decoration-none" href="/document/{{ $project->slug }}">

           <h6 class="text-black font-weight-700">{!! Str::limit($project->title,25) !!}</h6>

           <small class="text-muted">{{ $project->no_of_page }}</small> <small class="text-muted add-dash">pages |</small>
           <small class="text-muted">{{ $project->word_count }}</small> <small class="text-muted add-dash">words |</small> 
           <small class="text-muted d-md-block d-lg-inline"><?php echo date('d-M-Y',strtotime($project->created_at)) ?></small> 
           <small class="text-muted btn-d-none pt-1"></small>
         </a>
         <p><a class="text-decoration-none" href="/document/{{ $project->slug }}">
          <!-- <small class="text-muted btn-d-none pt-1">{ Str::limit($project->description,10) !!}</small> -->
        </a>
        <br>
        <a class="btn btn_common btn_blue btn-d-none mt-1" href="/document/{{ $project->slug }}">View Document</a></p>
      </div>
    </div>
  </div>
  @endforeach


              </div> 
             </div> 
            </div>
           </div>
           
          <div class="mt-3">
          <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
          </div>
           <a href="/sample-project"><button class="show-all-btn mt-1">Show All Projects</button></a>
          </div>
         </div>
    </section>


    <div class="clearfix"></div>
    <section class="custom-pt-1 custom-pb-2 bg-dark position-relative" data-bg-img="webassets/images/bg/02.png">

      <div class="container">

        <div class="row">

          <div class="col-lg-4 col-md-6 mb-8 mb-lg-0 text-white">

            <div> <span class="badge badge-primary-soft p-2">

              <i class="la la-cubes ic-3x rotation"></i>

            </span>

            <h2 class="mt-3 mb-0">Frequently Asks Questions, Always With You</h2>

          </div>

        </div>

        <div class="col-lg-8 col-md-8 mt-6 mt-md-0">

         <ul class="pl-0">

           <li class="question" id="question"><div class="expand-bar"></div>Q1: What is the basic price of the assignments?</li>

           <li class="answer">Ans: The prices of the assignment, depends on the brief and the word count which is to be attempted. Hence it would be really nice to share the brief so that we can provide you the assignment cost on real time absis with accuracy.</li>

           <li class="question"><div class="expand-bar"></div>Q2: How log do you take to complete one assignment?</li>

           <li class="answer">Ans: Normally your assignments should take 24 hours to get completed however if you give the experts 48 hours of time window that helps.</li>

           <li class="question"><div class="expand-bar"></div>Q3: What is hieghest marks that your expert can guarantee?</li>

           <li class="answer">Ans: The assignment's result depends on individual performance as well as the quality of the assignment. We assure you the highest quality content with appropriate quality check by the Quality Team so that you can get better marks.</li>

           <li class="question" id="question"><div class="expand-bar"></div>Q4: Do you book Tests/Exams?</li>

           <li class="answer">Ans: Yes, we do. However you need to book the slots prior.</li>

           <li class="question"><div class="expand-bar"></div>Q5: How can I book the order?</li>

           <li class="answer">Ans: You just need to Click on Order Now and fill the details. Our support team will be in touch with you in no time to discuss everything further.</li>

           <li class="question"><div class="expand-bar"></div>Q6: What if I get failed?</li>

           <li class="answer">Ans: AHEC has worked on 95% of passed results so far hence be assured that you will get pass results. 
             <br>
             However individual performance does matter hence we will surely investigate your issue with our team and get back to you with the best possible solution.
           </li>

         </ul>

         <a href="https://www.ahecounselling.com/faq-all"><button class="show-all-btn mt-5">Show All Questions</button></a>
       </div>

     </div>

     <div class="shape-1 mobile-view-shape" style="height: 150px; overflow: hidden;">

      <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">

        <path d="M0.00,49.98 C150.00,150.00 271.49,-50.00 500.00,49.98 L500.00,0.00 L0.00,0.00 Z" style="stroke: none; fill: #fff;"></path>

      </svg>

    </div>

    <div class="shape-1 bottom layout-bg">

      <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">

        <path d="M0.00,49.98 C150.00,150.00 349.20,-50.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>

      </svg>

    </div>

  </section>

  <!--services end-->

  <!-- counter start -->

  <section class="pt-0 position-relative counter">

    <div id="particles-js"></div>

    <div class="container">

      <div class="row align-items-center text-center">

        <div class="col-6 col-sm-6 col-md-3 my-2">

          <div class="counter border rounded shadow p-5">

            <div class="counter-desc"> <span class="count-number display-4" data-to="15" data-speed="1000">15</span>

              <span class="display-4 text-primary">k</span>

              <h6 class="text-muted mb-0">Project</h6>

            </div>

          </div>

        </div>

        <div class="col-6 col-sm-6 col-md-3 my-2">

          <div class="counter border rounded shadow p-5">

            <div class="counter-desc"> <span class="count-number display-4" data-to="29" data-speed="1000">29</span>

              <span class="display-4 text-primary">k</span>

              <h6 class="text-muted mb-0">Member</h6>

            </div>

          </div>

        </div>

        <div class="col-6 col-sm-6 col-md-3 my-2">

          <div class="counter border rounded shadow p-5">

            <div class="counter-desc"> <span class="count-number display-4" data-to="44" data-speed="1000">44</span>

              <span class="display-4 text-primary">k</span>

              <h6 class="text-muted mb-0">Love Us</h6>

            </div>

          </div>

        </div>

        <div class="col-6 col-sm-6 col-md-3 my-2">

          <div class="counter border rounded shadow p-5">

            <div class="counter-desc"> <span class="count-number display-4" data-to="60" data-speed="1000">60</span>

              <span class="display-4 text-primary">k</span>

              <h6 class="text-muted mb-0">Happy Client</h6>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>

  <!--testimonial start-->

  <section class="position-relative testimonials">

    <div class="shape-2 transform-md-rotate" style="overflow: hidden;">

      <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">

        <path d="M208.09,0.00 C152.70,67.10 262.02,75.98 200.80,150.00 L0.00,150.00 L0.00,0.00 Z" style="stroke: none; fill: #1360ef;"></path>

      </svg>

    </div>

    <div class="container-fluid">

      <div class="row align-items-center">

        <div class="col-12 col-md-6 mx-md-auto col-lg-4 mb-6 mb-lg-0">

          <div> <span class="badge badge-light-soft p-2">

            <i class="la la-users ic-3x rotation"></i>

          </span>

          <h2 class="mt-4 text-white text-md-dark">Discover Our Client Feedback</h2>

          <p class="lead mb-0 text-white text-md-dark">The client feedback shows the accountibility. Discover the clients feedback on the services provided by us.</p>

          <span class="fa fa-star checked text-warning"></span>
          <span class="fa fa-star checked text-warning"></span>
          <span class="fa fa-star checked text-warning"></span>
          <span class="fa fa-star text-warning"></span>
          <span class="fa fa-star text-warning"></span>

        </div>

      </div>

      <div class="col-12 col-md-12 col-lg-8 mt-5 test-carousel owl-carousel owl-theme">



        <?php 

        if(!empty($findTest))

        {

          $count = 1;

          foreach($findTest as $key =>$vk){

            $count++;

            if($count % 3 == 1){

              ?>

              <div class="row item">

              <?php } ?>

              <div class="col-12">

                <div class="card p-4 shadow border-0  review-card-box">

                 <div class="d-flex mb-3"><div class="review-img-card">

                    <img  alt="{{$vk->image_alt}}" src="<?=asset('/assets/uploads/testinomials/'.$vk->test_image)?>" class="shadow-primary img-fluid rounded-circle d-inline">

                  </div>

                  <div style="margin-left:13px;">
                  <p><?=$vk->test_name?></p>

                <div style="margin-top:-10px"><i class="la la-star" style="color: #ebb314;"></i>
                 <i class="la la-star" style="color: #ebb314;"></i>
                 <i class="la la-star" style="color: #ebb314;"></i>
                <i class="la la-star" style="color: #ebb314;"></i>
                <i class="la la-star" style="color: #ebb314;"></i>
                </div> 
                  </div>
                  </div>
                  <div class="card-body p-0">

                    

                    <div>

                  <h5 class="text-primary d-inline"><?=$vk->test_desc?></h5><!--

                    <small class="text-muted font-italic">VIT</small>-->

                  </div>

                </div>

              </div>

            </div>

            <?php  if($count % 3 == 1){ ?>

            </div>

          <?php } ?>

          <?php  }  } ?>

    </div>
  
    <!-- / .row -->
    <div class="col-md-12 mt-3" style="text-align:center !important">
    <a href="https://www.ahecounselling.com/testimonial"><button class="comment-view-btn">View All <i class="bi bi-arrow-right"></i></button></a>
    </div>
  </div>

</div>

<!-- / .row -->



</section>

<!--testimonial end-->

<!--blog start-->

<section class="blog">

  <div class="container">

    <div class="row align-items-end mb-5">

      <div class="col-12 col-md-12 col-lg-4">

        <div> <span class="badge badge-primary-soft p-2">

          <i class="la la-bold ic-3x rotation"></i>

        </span>

        <h2 class="mt-4 mb-0">From Our Blog List Latest Feed</h2>

      </div>

    </div>

    <div class="col-12 col-md-12 col-lg-6 ml-auto">

      <div>

        <p class="lead mb-0"></p>

      </div>

    </div>

  </div>

  <!-- / .row -->

  <div class="row bl-carousel owl-carousel owl-theme">

    <?php $srk = 1; ?>

    @foreach($findBlogs as $blog)



    <?php  

    $firstStringCharacter = substr($blog->blog_date,5,2);

    ?>

    <div class="mb-6 mb-lg-0 item">

      <!-- Blog Card -->

      <a href="<?=route('blogpage', str_replace(" ","-",strtolower($blog->blog_name)))?>">

        <div class="card bg-transparent blog-card-box" style="border:solid 1px rgb(218, 226, 245);border-radius:10px">

          <div class="position-absolute bg-white shadow-primary text-center p-2 rounded ml-3 mt-3"><?=$firstStringCharacter?>

          <br><?=date('D', strtotime($blog->blog_date))?></div>

          <div class="blog-card-box-img"><img class="shadow rounded" src="<?=asset('/assets/uploads/blogs/'.$blog->blog_image)?>" alt="{{$blog->image_alt}}">
          </div>
          <div class="card-body pt-5"> <a class="d-inline-block text-muted mb-2" href="#"></a>

            <h2 class="h5 font-weight-medium">

              <a class="link-title" href="<?=route('blogpage', str_replace(" ","-",strtolower($blog->blog_name)))?>">{{ Str::limit($blog->blog_name, 30) }}</a>

            </h2>

            <p>{!! serviceModel::getDesc(trim(strip_tags($blog->blog_desc)),100) !!}</p>

<!-- blog_desc

blog_image

blog_status

blog_comment -->

</div>

<div class="card-footer bg-transparent border-0 pt-0">

            <!--<ul class="list-inline mb-0">

              <li class="list-inline-item pr-4"> <a href="#" class="text-muted"><i class="ti-comments mr-1 text-primary"></i> 131</a>

              </li>

              <li class="list-inline-item pr-4"> <a href="#" class="text-muted"><i class="ti-eye mr-1 text-primary"></i> 255</a>

              </li>

              <li class="list-inline-item"> <a href="#" class="text-muted"><i class="ti-comments mr-1 text-primary"></i> 14</a>

              </li>

            </ul>-->

          </div>

          <div></div>

        </div>

      </a>

      <!-- End Blog Card -->

    </div>



    @endforeach



    <!-- End Blog Card -->

  </div>

</div>

</div>

</section>

<!--blog end-->

</div>

<!-------------------Whatsapp Icon----------------->
<div class="whatsapp-icon">

<a href="{{$whatsAppLink}}">

  <i class="la la-whatsapp" style="color:#fff"></i>

</a>

</div>


<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [{
      "@type": "Question",
      "name": "What is the basic price of the assignments?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ans: The prices of the assignment, depends on the brief and the word count which is to be attempted. Hence it would be really nice to share the brief so that we can provide you the assignment cost on real time absis with accuracy."
      }
    },{
      "@type": "Question",
      "name": "How log do you take to complete one assignment?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Normally your assignments should take 24 hours to get completed however if you give the experts 48 hours of time window that helps."
      }
    },{
      "@type": "Question",
      "name": "What is hieghest marks that your expert can guarantee?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "The assignment's result depends on individual performance as well as the quality of the assignment. We assure you the highest quality content with appropriate quality check by the Quality Team so that you can get better marks."
      }
    },{
      "@type": "Question",
      "name": "Do you book Tests/Exams?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, we do. However you need to book the slots prior."
      }
    },{
      "@type": "Question",
      "name": "How can I book the order?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "You just need to Click on Order Now and fill the details. Our support team will be in touch with you in no time to discuss everything further."
      }
    },{
      "@type": "Question",
      "name": "What if I get failed?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "AHEC has worked on 95% of passed results so far hence be assured that you will get pass results.
        However individual performance does matter hence we will surely investigate your issue with our team and get back to you with the best possible solution."
      }
    }]
  }
</script>

<!--body content end-->

<!-- footer start -->





@include('layouts.frontfooter')

