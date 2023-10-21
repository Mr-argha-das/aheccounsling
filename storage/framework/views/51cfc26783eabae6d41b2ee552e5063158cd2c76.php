<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
$content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); ?>
<!--hero section start-->

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
<section class="position-relative">
  <div id="particles-js"></div>
  <div class="container">
      <?php echo $content->menu_txt; ?>
      </div>
     </div>
</section>
<!--hero section end--> 


<!--body content start-->

<div class="page-content">

<section>


 
</section>



</div>

<!--body content end--> 

<!-- footer start -->
<?php echo $__env->make('layouts.frontfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/web/writing-proofreading-services.blade.php ENDPATH**/ ?>