<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
use \App\Model\Entry\Service_model as serviceModel;
$content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); ?>
<?php

$findService = serviceModel::where('services_status',1)->orderBy('services_id','asc')->get();

?>

<section class="position-relative">

  <div id="particles-js"></div>

  <div class="container">

    <div class="row  text-center">

      <div class="col">

        <h1><?=$content->menu_name?></h1>

        <nav aria-label="breadcrumb">

          <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">

            <li class="breadcrumb-item"><a class="text-dark" href="#">Home</a>

            </li>

            <li class="breadcrumb-item active text-primary" aria-current="page"><?=$content->menu_name?></li>

          </ol>

        </nav>

      </div>

    </div>

    <!-- / .row -->

  </div>

  <!-- / .container -->

</section>

<section class="pt-0">

  <div class="container">

   <div class="row align-items-center justify-content-center">

<?php $__currentLoopData = $findService; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div class="col-xl-4 col-lg-4 col-md-6 mb-8 mb-lg-0 bl-bdr">

      <div class="px-4 py-7 rounded hover-translate text-center shadow serv-contain">

        <div class="">
          <div class="ih-item square effect6 from_top_and_bottom"><a href="<?=route('servicespage', str_replace(" ","-",strtolower($service->services_name)))?>">

            <div class="img">
              <img src="<?=asset('/assets/uploads/services/'.$service->services_image)?>" alt="<?php echo e($service->image_alt); ?>" class="service-img">

          </div>

             </a>
          </div>

          </div>

          <h5 class="mt-4 mb-3">
           <a href="<?=route('servicespage', str_replace(" ","-",strtolower($service->services_name)))?>">
            <?php echo e($service->services_name); ?>

          </a>
        </h5>

          <p><?php echo serviceModel::getDesc(strip_tags($service->services_desc),55); ?></p>
 

           <div>
          <div class="overlay"></div>
              <div class="serv-button p-1">
                <a href="Javascript:void(0)" class="serv-hover-btn">$<?php echo e($service->amount); ?> </a>
                <a href="https://www.ahecounselling.com/contact-us" class="serv-hover-btn"> Book Now </a>
                <a href="<?php echo e($whatsAppLink); ?>" class="serv-hover-btn"> <img src="webassets/images/whatsapp.png" alt="Whatsapp" class="wp-icon-btn"/></a>
              </div>
              </div>
        </div>
      
      </div>



      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

     



        

        </div>

      </div>

    </section>



<!--hero section end--> 





<!--body content start-->


<!-- 
<div class="page-content">



<section>





 

</section>







</div> -->



<!--body content end--> 



<!-- footer start -->

<?php echo $__env->make('layouts.frontfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/web/services.blade.php ENDPATH**/ ?>