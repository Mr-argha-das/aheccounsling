<?php 
$rmidlist  = \App\Model\Entry\RegisterMember_model::get();
 ?>
<?php $__env->startSection('content'); ?>


<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear"><?php echo e($title); ?> </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">Dashboard / My Clients / <?php echo e($title); ?> </h6>
            </div>
          
                <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary" href="<?= $viewpPath ?>userData/<?php echo e($client_id); ?>?download=download"><i class="fa fa-download mr-1"></i>DownloadCSV</a>
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
                    <th><b>Name</b></th>
                    <th><b>Mobile</b></th>
                   </tr>
            </thead>
            <tbody>
                 <?php  foreach ($records as $key => $obj) {  ?>
                     <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($obj['name']); ?></td>
                        <td><?php echo e($obj['number']); ?></td>
                      </tr>
                        
                 <?php } ?>
            </tbody>
        </table>
   
    </div>
</div>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/myclients/userData.blade.php ENDPATH**/ ?>