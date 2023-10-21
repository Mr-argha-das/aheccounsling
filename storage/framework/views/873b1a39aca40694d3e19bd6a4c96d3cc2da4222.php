<?php $__env->startSection('content'); ?>


<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear"><?php echo e($title); ?> </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Entry / <?php echo e($title); ?> </h6>
            </div>
      
                <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary fancyboxajax" href="<?= $viewpPath ?>create"><i class="fa fa-plus mr-1"></i> Create New</a>
                    </span>
                </div>
    
        </div>
    </div>
</div>

<div class="block p-3" style="border-radius:15px">
    <div class="table table-vcenter table-hover table-responsive">
        <table class="myTable">
            <thead>
                <tr>
                    <th><b> #</b></th>
                    <th><b> Name</b></th>
                    <th><b> Email</b></th>
                    <th><b> Mobile</b></th>
                    <th><b> Address</b></th>
                    <th><b> Bank Name</b></th>
                    <th><b> A/C No.</b></th>
                    <th><b> IFSC Code</b></th>
                    <th><b>Branch</b></th>
                    <th><b>AdharCard No</b></th>
                    <th><b>Pancard No</b></th>
                    <th><b>Action</b></th>
                     
                </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach ($records as $ob) {
                    $rowId = $ob->af_id;
                ?>
                    <tr>
                        <tD><?= $sr++ ?></tD>
                        <td><?php echo e($ob->af_name); ?></td>
                        <td><?php echo e($ob->af_email); ?></td>
                        <td>+<?php echo e($ob->country_code.' '.$ob->af_mobile); ?></td>
                        <td><?php echo e($ob->af_address); ?></td>
                        <td><?php echo e($ob->bank_name); ?></td>
                        <td><?php echo e($ob->bank_no); ?></td>
                        <td><?php echo e($ob->bank_ifsc); ?></td>
                        <td><?php echo e($ob->bank_branch); ?></td>
                        <td><?php echo e($ob->aadhar_number); ?></td>
                        <td><?php echo e($ob->pan_number); ?></td>
                       <td>
                        <?= Design::$dmStart ?>
                        
                        <a class="fancyboxajax" href="<?php echo e(url($viewFolder.$rowId.'/edit')); ?>">Edit</a>
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
<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/flregistration/index.blade.php ENDPATH**/ ?>