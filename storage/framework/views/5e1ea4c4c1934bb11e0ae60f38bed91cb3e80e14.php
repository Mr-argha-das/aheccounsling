<?php $__env->startSection('content'); ?>


<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear"><?php echo e($title); ?> </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Master / <?php echo e($title); ?> </h6>
            </div>
      
                <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary fancyboxajax" href="<?= $viewpPath ?>create"><i class="fa fa-plus mr-1"></i> Create New</a>
                    </span>
                </div>
    
        </div>
    </div>
</div>

<div class="block" style="border-radius:15px">
    <div class="block-content">
        <table class="table table-vcenter table-hover">
            <thead>
                <tr>
                    <th scope="col"><b>#</b></th>
                    <th scope="col"><b>Title</b></th>
                    <th scope="col"><b>Image</b></th>
                     <th scope="col"><b>Price</b></th>
                     <th scope="col"><b>Type</b></th>
                    <th scope="col"><b> Status</b></th>
                   
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach ($records as $ob) {
                    $rowId = $ob->services_id;
                ?>
                    <tr>
                        <tD><?= $sr++ ?></tD>

                        <td><?php echo e($ob->services_name); ?></td>
               
                        <td><?php if(!empty($ob->services_image)){ ?>
                            <img src="<?php echo e(asset('assets/uploads/services/'.$ob->services_image)); ?> " width="60" width="60">
                            <?php } ?></td>
                         <td><?php echo e($ob->amount); ?> </td>
                         <td><?php echo e($ob->type); ?> </td>
                         <td><?php echo e($statusDropdown[$ob->services_status]); ?></td>
       
                            <td>
                                <?= Design::$dmStart ?>
                                
                                    <a class="fancyboxajax" href="<?php echo e(url($viewFolder.$rowId.'/edit')); ?>">Edit</a>
                          
                                <a class="fancyboxajax" href="<?php echo e(url($viewFolder.$rowId)); ?>">view</a>
                                 <a class="delete" data-action-url="<?php echo e(url($viewFolder.'delete/'.$rowId)); ?>" data-alert-title="Do You Want to Delete " data-alert-msg="Delete This Entry from this software">Delete</a>   
                                <?= Design::$dmClose ?>
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
<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/services/index.blade.php ENDPATH**/ ?>