<?php

// dd(session()->get('userLg'));

use App\Model\Entry\Page_model as pageModel;

use \App\Model\Country_model as countryModel;

 

$serviceArray  = \App\Model\Entry\Service_model::makeArray();

$countryCode = countryModel::pluck('phonecode','id');

$categrorydropdown = \App\Model\Entry\ProjectCategory_model::withCount('project_list')->get();

 $offerDataText = \App\Model\Entry\Home_offere_model::whereRaw('(now() between start_date and end_date)')->where('type','text')->get();

 $offerDataImage = \App\Model\Entry\Home_offere_model::whereRaw('(now() between start_date and end_date)')->where('type','image')->first();

 

// $faqcategory = \App\Model\Entry\FaqCategory_model::get();

?>

<!DOCTYPE html>

<html lang="en">

<head>

   

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title -->

  <base href="<?=asset('/')?>">

  <title><?=$seoTitle?></title>

  <meta charset="UTF-8">

  <?php if(isset($og_tag)): ?>

  <?php echo $og_tag; ?>

  <?php endif; ?>

  <?php if(!empty($seoDesc)){ ?>

    <meta name="description" content="<?php echo \App\Model\Entry\Service_model::getDesc($seoDesc,300); ?>">

  <?php } ?>

  <meta name="keywords" content="<?=!empty($seoKeyword)?$seoKeyword:''?>">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link rel="shortcut icon" href="webassets/images/fav.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

  <link rel="stylesheet" type="text/css" href="webassets/css/res-dheeraj.css">

  <link href="webassets/css/toctoc.min.css" rel="stylesheet" />

  <link href="webassets/css/owl.theme.default.min.css" rel="stylesheet" />

  <link href="webassets/css/owl.carousel.min.css" rel="stylesheet" />

  <link href="webassets/css/ihover.min.css" rel="stylesheet" />

  <link href="webassets/css/theme-plugin.css" rel="stylesheet" />

  <link href="webassets/css/theme.min.css" rel="stylesheet" />

  <meta name="google-site-verification" content="32S6Tyt4hdzf6HU_1CNFt8gOc3wSTrwqtf2PMnsPdgI" />

  <?php if(isset($canonical)): ?>

  <link rel="canonical" href="<?php echo e($canonical); ?>">

  <?php endif; ?>

  <script async src="https://www.googletagmanager.com/gtag/js?id=G-2T0J5E9QM8"></script>

  <script>

    window.dataLayer = window.dataLayer || [];

    function gtag(){dataLayer.push(arguments);}

    gtag('js', new Date());

    gtag('config', 'G-2T0J5E9QM8');

  </script>

 <script src="webassets/js/jquery.min.js"></script>

 <script src="webassets/js/owl.carousel.min.js"></script>

   <script>

  </script>

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

fbq('init', '732182597830633');

fbq('track', 'PageView');

</script>

<noscript><img height="1" width="1" style="display:none"

src="https://www.facebook.com/tr?id=732182597830633&ev=PageView&noscript=1"

/></noscript>

<!-- End Meta Pixel Code -->



 <style>

  .ahec-details{

    margin-top: 9px;

  }

  @media  only screen and (min-width: 320px) and (max-width: 767px){

     .ahec-details{

    margin-top: 15px;

  }

  }

.ahec-select{

  margin-top: -10px;

}



@media  only screen and (min-width: 320px) and (max-width: 767px){

  .ahec-select{

  margin-top: -2px;

  

}

  }

 </style>

 



</head>

<body style="font-family: 'Poppins', sans-serif;">

   <?php if(isset($offerDataImage)): ?>

  <div class="modal fade wel-modal" id="modal-subscribe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <a target="_blank" href="<?php echo e($whatsAppLink); ?>"><img width="100%" src="<?php echo e(url($offerDataImage->value)); ?>"></a>

        </div>

    </div>

</div>

 <?php endif; ?>



<!-- page wrapper start -->

<div class="offer_strip_nwe alert">

    <div class="container">

        <div class="offr_strp">

            <span class="ribbon1">New</span>

            <marquee onMouseOver="this.stop()" onMouseOut="this.start()" behavior="scroll" direction="left">

              <div class="d-flex">

                 <?php $__currentLoopData = $offerDataText; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eachOffereText): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <p>

                  <?php echo $eachOffereText->value; ?>


                </p>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>

            </marquee>

            

        </div>

    </div>

</div>

<div class="header-top-se">

  <div class="container">

    <div class="row align-items-center">

      <div class="header-top-style col-md-8 col-8">

        <ul class="d-flex align-items-center pl-0 ss-btns justify-content-between mb-0">

          <li class="ahec-details dropdown">
           
            <a href="tel:918955009638" class="mx-2 dropdown-toggle" data-toggle="dropdown" style="color: #fff;"><i class="fa fa-phone"></i><!-- <span>India:</span> +91 8955009638 --></a>
            <ul class="dropdown-menu phn-dropmenu-list">

                          <li><a class="dropdown-item phn-droplist" href="https://join.skype.com/invite/tWgD413cR3DH"><i class="bi bi-skype"></i> Skype</a>  </li>

                          <li><a class="dropdown-item phn-droplist" href="https://meet.google.com/sxb-vuvm-ave"><i class="bi bi-camera-video-fill"></i> Google Meet</a> </li>

                          <li><a class="dropdown-item phn-droplist" href="tel:+918955009638"><i class="bi bi-telephone-fill"></i> Mobile Dialer</a>  
                          
                        </li>

                      </ul>
                    

            <a href="mailto:info@ahecounselling.com" class="mx-2" style="color: #fff;"><i class="fa fa-envelope"></i><!-- <span>Email:</span> info@ahecounselling.com --></a>

          </li>

            </ul>

          </div>

          <div class="col-md-4 col-4 text-right ahec-select">

            <div id="google_translate_element" class=""></div>

          </div>

        </div>

      </div>

    </div>



    <div class="page-wrapper">

      

      <header class="site-header shadow">

        <div id="header-wrap" class="shadow">

          <div class="container">

            <div class="row">

              <!--menu start-->

              <div class="col d-flex align-items-center justify-content-between">

                <a class="navbar-brand logo text-dark h2 mb-0" href="./">

                  <img src="webassets/images/logo.png" alt="" class="img-fluid" width="160">

                </a>

                <nav class="navbar navbar-expand-lg navbar-light ml-auto">

                  <button class="navbar-toggler p-0 border-0 navbar-toggle" type="button" data-toggle="collapse" data-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation"> 
                    <img src="https://img.icons8.com/ios-filled/30/f35c2c/sorting-options.png" class="" />

                  </button>

                  <div class="collapse navbar-collapse navbar-menu" id="navbarNav">

                    <ul class="navbar-nav ml-auto">

                      <li class="nav-item dropdown"><a class="nav-link" href="./">Home</a></li>

                      <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Sample Project</a>

                        <ul class="dropdown-menu">

                          <li class="dropdown-submenu"><a class="dropdown-item " href="/sample-project">All Projects</a>  </li>

                          <?php $__currentLoopData = $categrorydropdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                          <?php if($category->project_list_count==0){ continue; } ?>

                          <li class="dropdown-submenu"><a class="dropdown-item " href="/sample-project/<?php echo e($category->cat_slug); ?>"><?php echo e($category->name); ?></a>  </li>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>

                      </li>

                      <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Blogs</a>

                        <ul class="dropdown-menu">

                          <li class="dropdown-submenu"><a class="dropdown-item " href="blogs">Blogs</a></li>

                          <li class="dropdown-submenu"><a class="dropdown-item " href="ijp">IJP</a></li>

                          <li class="dropdown-submenu"><a class="dropdown-item" href="story-teller">Story Teller</a>  

                        </li>

                      </ul>

                    </li>

                    <!-- <li class="nav-item dropdown"> <a class="nav-link" href="/faqlist">FAQs</a></li> -->

                    
                    <li class="nav-item dropdown"><a class="nav-link" href="services">Services</a></li>

                    <li class="nav-item dropdown"><a class="nav-link" href="servicesbooking">Pricing</a></li>

                    <li class="nav-item dropdown"><a class="nav-link" href="contact-us">Contact Us</a></li>

                  

                </li>

              </ul>

            </div>

          </nav>

          <div class="my-search">

            <div class="dropdown">

              <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" 

              aria-expanded="false">

              <i class="fa fa-search" aria-hidden="true"></i>

              </button>

              <form  action="search/searchQuery" method="post" enctype="multipart/form-data">

                <?php echo e(csrf_field()); ?>


                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                  <input type="text" name='searchQuery' value="<?php echo e(old('searchQuery')); ?>">

                </div>

            </form>

            </div>

        </div>

        <div class="my-head-btn d-flex align-items-center">
         
          <?php if(!empty(session()->get('userLg'))){ ?>

            <a class="btn btn-primary ml-2 sign-out" href="query/logout" id="book-now-css">Sign Out</a>

         <?php }else{  ?>

          <a class="sign-in-btn" href="sign-in">

              <img src="https://img.icons8.com/windows/32/ffffff/user.png"/>
           
            </a>
         
          <?php } ?>
        
         
          <a class="btn btn-primary ml-2 d-lg-block order-button order-now" href="https://www.ahecounselling.com/paynow" data-target="#basicModal" id="book-now-css" style="margin-left:30px !important">
           Order  Now
          </a>

        </div>

    

      </div>

      <!--menu end-->

    </div>

  </div>

</div>

</header>



<script type="text/javascript">

  $('.panel-collapse').on('show.bs.collapse', function () {

    $(this).siblings('.panel-heading').addClass('active');

  });

  $('.panel-collapse').on('hide.bs.collapse', function () {

    $(this).siblings('.panel-heading').removeClass('active');

  });




  const navbarToggle = document.querySelector('.navbar-toggle');

navbarToggle.addEventListener('click', () => {
  navbarToggle.classList.toggle('active');
});

window.addEventListener('scroll', () => {
  navbarToggle.classList.remove('active');
});


</script>

<script type="application/ld+json">

  {

    "@context": "https://schema.org",

    "@type": "Organization",

    "name": "Ahecounselling",

    "address": {

      "@type": "PostalAddress",

      "addressLocality": "Jaipur,Rajasthan",

      "postalCode": "302002",

      "addressRegion": "India",

      "streetAddress": "Ramguard Mod"

    },

    "alternateName": "Ahecounselling",

    "url": "<?php echo e(url('/')); ?>",

    "logo": "<?php echo e(url('/')); ?>/webassets/images/logo.png",

    "sameAs": [

    "https://www.facebook.com/AHECPVTLTD/",

    "https://twitter.com/Ahecounselling",

    "https://www.instagram.com/ahecounselling/",

    "https://www.youtube.com/channel/UCFyb78NY7P-Rp5ApQHhXytg",

    "https://in.pinterest.com/ahecpvtltd/"

    ]

  }

</script>

<script type="application/ld+json">

  {

    "@context": "https://schema.org",

    "@type": "WebSite",

    "name": "AHECounselling: AHECounselling - Career Counselling | Career Guidance Program Online - ahecounselling.com",

    "description": "Free Global career counselling services offers the best career counselling courses/career guidance programme online. Register and become a certified career counsellor.  at Ahecounselling.",

    "publisher": {

      "@type": "Organization",

      "name": "AHECounselling",

      "logo": {

        "@type": "ImageObject",

        "url": "<?php echo e(url('/')); ?>/webassets/images/logo.png",

        "width": 240,

        "height": 35

      }

    }

  }

</script>

<?php if(isset($ListItem)): ?>

<script type="application/ld+json">

  {

    "@context": "https://schema.org",

    "@type": "BreadcrumbList",

    "itemListElement":  <?php  echo json_encode($ListItem,JSON_UNESCAPED_SLASHES);  ?>

  }

</script>

<?php endif; ?>

<script type="application/ld+json">

  [{

    "@context": "http://schema.org",

    "@type": "SiteNavigationElement",

    "name": "Home",

    "url": "https://www.ahecounselling.com"

  },{

    "@context": "http://schema.org",

    "@type": "SiteNavigationElement",

    "name": "Sample Project",

    "url": "https://www.ahecounselling.com/sample-project"

  },{

    "@context": "http://schema.org",

    "@type": "SiteNavigationElement",

    "name": "Blogs",

    "url": "https://www.ahecounselling.com/blogs"

  },{

    "@context": "http://schema.org",

    "@type": "SiteNavigationElement",

    "name": "International Journal Publication",

    "url": "https://www.ahecounselling.com/IJP"

  },{

    "@context": "http://schema.org",

    "@type": "SiteNavigationElement",

    "name": "Story Teller",

    "url": "https://www.ahecounselling.com/story-teller"

  },{

    "@context": "http://schema.org",

    "@type": "SiteNavigationElement",

    "name": "Services",

    "url": "https://www.ahecounselling.com/services"

  },{

    "@context": "http://schema.org",

    "@type": "SiteNavigationElement",

    "name": "Video Gallery",

    "url": "https://www.ahecounselling.com/video-gallery"

  },{

    "@context": "http://schema.org",

    "@type": "SiteNavigationElement",

    "name": "FL Registration",

    "url": "https://www.ahecounselling.com/FL-Registration"

  },{

    "@context": "http://schema.org",

    "@type": "SiteNavigationElement",

    "name": "Affiliates Terms",

    "url": "https://www.ahecounselling.com/affiliates-terms"

  },{

    "@context": "http://schema.org",

    "@type": "SiteNavigationElement",

    "name": "About Us",

    "url": "https://www.ahecounselling.com/about-us"

  },{

    "@context": "http://schema.org",

    "@type": "SiteNavigationElement",

    "name": "Writing Proofreading Services",

    "url": "https://www.ahecounselling.com/writing-proofreading-services"

  },{

    "@context": "http://schema.org",

    "@type": "SiteNavigationElement",

    "name": "Terms Conditions",

    "url": "https://www.ahecounselling.com/terms-conditions"

  },{

    "@context": "http://schema.org",

    "@type": "SiteNavigationElement",

    "name": "Refund and Return",

    "url": "https://www.ahecounselling.com/refund-return"

  },{

    "@context": "http://schema.org",

    "@type": "SiteNavigationElement",

    "name": "Privacy Policy",

    "url": "https://www.ahecounselling.com/privacy-policy"

  }]

</script><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/layouts/frontend.blade.php ENDPATH**/ ?>