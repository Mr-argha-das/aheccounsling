<?php $__env->startSection('content'); ?>


<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear"><?php echo e($title); ?> </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Entry / <?php echo e($title); ?> </h6>
            </div>
      
               <!--  <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary fancyboxajax" href="<?= $viewpPath ?>create"><i class="fa fa-plus mr-1"></i> Create New</a>
                    </span>
                </div> -->
    
        </div>
    </div>
</div>

<div class="block p-3"  style="border-radius:15px">
    <div class="table table-vcenter table-hover table-responsive">
        <table class="myTable">
            <thead>
                <tr>
                    <th><b>#</b></th>
                    <th><b>Name</b></th>
                    <th><b>Email</b></th>
                    <th><b> Mobile</b></th>
                    <th><b> Address</b></th>
                    <th><b>Attached</b></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach ($records as $ob) {
                    $rowId = $ob->about_id;
                ?>
                    <tr>
                        <tD><?= $sr++ ?></tD>

                        <td><?php echo e($ob->af_name); ?> </td>
                       
                        <td><?php echo e($ob->af_email); ?></td>
                        <td><?php echo e($ob->af_mobile); ?></td>
                        <td><?php echo e($ob->af_address); ?></td>
            <td>
                    <?php if($ob->af_file!=''): ?>
                  <?php $__currentLoopData = json_decode($ob->af_file); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                   <a href="<?php echo e(asset($ob->folder_path.$file)); ?>" target="_blank" class="btn btn-primary btn-sm px-2 py-1 mb-2">Download File <?php echo e($key+1); ?></a>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                 
              </td>
                    
                         
                        <?php } ?>
                    </tr>
          
            </tbody>
        </table>

        <hr>
        <?php echo e($pagination->render()); ?>




    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/affilateform/index.blade.php ENDPATH**/ ?>