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
                        <a class="btn btn-primary fancyboxajax" href="<?= $viewpPath ?>create"><i class="fa fa-plus mr-1"></i> Add New Client</a>
                    </span>
                </div>
    
        </div>
    </div>
</div>
<?=Design::$filterStart?>
<div class="col-md-4">
    <?php echo e(Form::bsText('name','GET_METHOD',['label'=>'Name'])); ?>

</div>
<div class="col-md-4">
    <?php echo e(Form::bsText('email','GET_METHOD',['label'=>'Email'])); ?>

</div>

<div class="col-md-4">
    <?php echo e(Form::bsText('mobile','GET_METHOD',['label'=>'Mobile Number'])); ?>

</div>


<?=Design::$filterClose?>

<div class="block">
   <div class="block-header">
      <h3 class="block-title">Download </h3>
   </div>
   <div class="block-content p-md-4 p-2 pb-3">
      <div class="pb-3">
         <form method="POST" action="<?php echo e(route('admin.entry.myclients.clientDataDownloadCSV',$rm_id)); ?>" accept-charset="UTF-8">
           <?php echo e(csrf_field()); ?>

            <div class="row">
               <div class="col-md-4 ">
                  <?php echo e(Form::bsText('start_date','GET_METHOD',['label'=>"Start Date"])); ?>

              </div>
               <div class="col-md-4 ">
                  <?php echo e(Form::bsText('end_date','GET_METHOD',['label'=>"End Date"])); ?>

              </div>

              <?php if($rm_id==0): ?>
              <div class="col-md-4 ">
                 <div class="form-group eqheight">
                     <label for="rm_id" class="control-label">Rm  User</label>
                      <select class="form-control form-control-sm" id="rm_id" name="rm_id">
                          <option value="">Please select one option</option>
                            <?php $__currentLoopData = $rmidlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $rmvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option  value="<?php echo e($rmvalue->id); ?>"><?php echo e($rmvalue->rmid); ?> -(<?php echo e($rmvalue->name); ?>)</option>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </div>
               </div>
               <?php else: ?>
                 <input type="hidden" name="rm_id" value="<?php echo e($rm_id); ?>">
               <?php endif; ?>
               <div class="col-md-12">
                  <input class="btn btn-info" type="submit" value="Download CSV">
                 
               </div>
            </div>
         </form>
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
                    <th><b>Email</b></th>
                    <th><b>Mobile</b></th>
                    <th><b>Register Date</b></th>
                    <th scope="col"><b>Status</b></th>
                    <th scope="col"><b>RMID</b></th>
                    <th scope="col"><b>Actions</b></th>
                  
                </tr>
            </thead>
            <tbody>
                <?php
                      $sr = 1;
                    foreach ($records as $ob) { 
                         $rowId = $ob->user_id;

                         ?>
                    <tr>
                        <td><?= $sr++ ?></td>
                        <td><?php echo e($ob->user_name); ?></td>
                        <td><?php echo e($ob->user_email); ?></td>
                        <td>+<?php echo e($ob->phone_code.' '.$ob->mobile); ?></td>
                        <td><?php echo e(date('d-m-Y',strtotime($ob->user_created_at))); ?></td>

                        <td>
                            <?php if($ob->is_multipal==0): ?>
                            <button class="btn btn-success sm">Auto-Approved</button>

                            <?php elseif($ob->is_multipal==1 && $ob->is_approved==0): ?>
                            <button class="btn btn-warning sm">Pending</button>
                            <?php elseif($ob->is_multipal==1 && $ob->is_approved==1): ?>
                            <button class="btn btn-info sm">Admin-Approved</button>
                            <?php elseif($ob->is_multipal==1 && $ob->is_approved==2): ?>
                            <button class="btn btn-danger sm">Admin-Rejected</button>
                             <?php endif; ?>


                        </td>
                         <td>
                             <?php if($ob->is_multipal==1 && $rm_id==0 && $ob->rmusers!=false): ?>
                              <?php $__currentLoopData = $ob->rmusers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($value->rmid); ?>

                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php endif; ?>
                           </td>

                        <td>

                             <?= Design::$dmStart ?>
                              
                             <a class="fancyboxajax" href="<?php echo e(url($viewFolder.$rowId.'/edit')); ?>">Edit</a>
                              <?php if($rm_id==0): ?>
                                <?php if($ob->is_multipal==1 && $ob->is_approved==0): ?>
                                <a data-action-url="<?php echo e(route('admin.client.statusupdate',array($rowId,1))); ?>">Approved Status</a> 
                                <a data-action-url="<?php echo e(route('admin.client.statusupdate',array($rowId,2))); ?>">Reject Status</a> 
                                <?php elseif($ob->is_multipal==1 && $ob->is_approved==1): ?>
                                 <a data-action-url="<?php echo e(route('admin.client.statusupdate',array($rowId,2))); ?>">Reject Status</a>
                                <?php elseif($ob->is_multipal==1 && $ob->is_approved==2): ?>
                                <a data-action-url="<?php echo e(route('admin.client.statusupdate',array($rowId,1))); ?>">Approved Status</a> 
                                 <?php endif; ?>
                                
                                  <?php if($ob->_token_id!=null): ?>
                                 <a href="<?php echo e(route('admin.entry.myclients.userData',array($rowId))); ?>">ClientData</a> 
                                 <?php endif; ?>
                                 

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
<script type="text/javascript"> 

   $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();  
      $("#start_date,#end_date").datepicker({            
      maxDate: new Date()
     }); 
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/myclients/index.blade.php ENDPATH**/ ?>