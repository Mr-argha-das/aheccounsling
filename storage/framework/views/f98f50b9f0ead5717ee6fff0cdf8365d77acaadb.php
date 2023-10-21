 
<?php $__env->startSection('content'); ?>

<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear"><?php echo e($orderDetails->en_first_name); ?> <?php echo e($orderDetails->en_last_name); ?> files </h3>
                <h6><?php echo $orderDetails->rmid.'-'.date('d-m-y',$orderDetails->tranxid).'_'.sprintf("%02d", $orderDetails->order_number); ?></h6>
               



            </div>
      
              <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary" href="<?php echo e(route('admin.entry.client-work-status.create',$tran_id)); ?>"><i class="fa fa-plus mr-1"></i>Upload New</a>
                    </span>
                </div>
        </div>
    </div>
</div>
   
 
<div class="block p-3" style="border-radius:15px">
    <div class="table-vcenter table-responsive">
        <table class="table  table-hover">
            <thead>
                <tr>
                    <th><b>#</b></th>
                    <th><b>Date</b></th>
                    <th><b>Status</b></th>
                    <th><b>fileName</b></th>
                    <th><b>file</b></th>
                   
                  
                </tr>
            </thead>
            <tbody>
                <?php
                 $sr = 1;
                foreach ($files_list as $ob) {   ?>
                    <tr>
                        <td><?= $sr++ ?></td>
                  
                        <td><?php echo e(date('d-m-Y',strtotime($ob->en_created_at))); ?></td>
                         <td><?php echo e($clientOrderStatus[$ob->c_status]); ?></td>
                         <td><?php echo e($ob->file_name); ?></td>
                        <td><a  href="<?php echo e($ob->file_link); ?>">download </a> </td>

             <?php } ?>
          </tr>
          
            </tbody>
        </table>

        <hr>
        
    </div>
</div>

 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/clientWorkStatus/index.blade.php ENDPATH**/ ?>