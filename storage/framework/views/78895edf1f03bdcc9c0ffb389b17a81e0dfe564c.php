<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php 
use \App\Model\Entry\Service_model as serviceModel;
use \App\Model\Entry\Test_model as testModel;
$content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); 
 $findTest = testModel::orderBy('test_id')->get();
?>

<div class="faq-bg">
    <div class="container">
        <h3 class="text-center">Testimonial</h3>
        <p class="det-tagline m-auto"></p>

        <div class="row mt-4">
             <?php $__currentLoopData = $findTest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$vk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mt-3">
              <div class="monial-card rounded">
                    <img  alt="<?php echo e($vk->image_alt); ?>" src="<?=asset('/assets/uploads/testinomials/'.$vk->test_image)?>" class="img-fluid test-person-img">
                    <div class="" style="margin-left:10px">
                        <h6 class="mt-2 mb-2"><?=$vk->test_name?></h6>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <p class="content-det-para"><?=$vk->test_desc?></p>
                    </div>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

         
        </div>
    </div>
</div>
 
<?php echo $__env->make('layouts.frontfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/web/testimonial.blade.php ENDPATH**/ ?>