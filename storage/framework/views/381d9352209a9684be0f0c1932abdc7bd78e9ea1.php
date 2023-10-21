<?php $__env->startSection('content'); ?>

 <?php $bannner =1; ?>
 <?php $bannners =1; ?>
<div class="block" style="border-radius:15px">
 
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left"  >
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear"><?php echo e($title); ?> </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Master / <?php echo e($title); ?> </h6>
            </div>
      
                 
    
        </div>
    </div>

</div>

   <div class="block" style="border-radius:20px">
    <div class="block-content">

      <?php $__currentLoopData = $editData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

       <?php if($data->type=='text'): ?>

    <form   action="<?php echo e(route('updatevalue')); ?>" method="post" enctype="multipart/form-data">
                     <?php echo e(csrf_field()); ?>

      <div class="row">
       <div class="col-md-6"> 
          <div class="form-group">
             <label for="menu_name" class="control-label mt-2" style="font-size:18px;font-weight:700"><?php echo e($data->name); ?></label>
             <textarea class="form-control form-control form-control mt-2" style="border-radius:8px" name="value"><?php echo e($data->value); ?></textarea>
          </div>
       </div>
    
      <div class="col-md-2">
        <div class="form-group">
           <label for="menu_name" class="control-label mt-3"><b>Start Date</b></label>
           <input class="form-control form-control form-control mt-3 start_date" style="border-radius:8px" name="start_date"  value="<?php echo e(date('d-m-Y',strtotime($data->start_date))); ?>"  type="text">
        </div>
      </div>

     <div class="col-md-2">
      <div class="form-group eqheight">
         <label for="menu_name" class="control-label mt-3"><b>End Date</b></label>
         <input class="form-control form-control form-control mt-3 end_date" style="border-radius:8px" name="end_date" value="<?php echo e(date('d-m-Y',strtotime($data->end_date))); ?>" type="text">
      </div>
    </div>

      
      <div class="col-md-2">
        <div class="form-group">
             <input type="hidden" name="edit_id" value="<?php echo e($data->id); ?>">
             <input type="hidden" name="type" value="<?php echo e($data->type); ?>">
            <button type="submit" class="btn btn-primary mt-5 px-4 py-2"> Update</button>
        </div>
    </div>
  </div>
   </form>
  <?php elseif($data->type=='image'): ?>
 
  <form  action="<?php echo e(route('updatevalue')); ?>" method="post" enctype="multipart/form-data">
                     <?php echo e(csrf_field()); ?>      
   <div class="row">
       <div class="col-md-3"> 
          <div class="form-group">
             <label for="menu_name" class="control-label mt-4"><b><?php echo e($data->name); ?></b></label>
            <input type="file" class="form-control form-control form-control mt-3" style="border-radius:8px" name="value">
          </div>
       </div>
       <div class="col-md-3">
        <img src="<?php echo e(url($data->value)); ?>" class="mt-5" width="50" height="50">
       </div> 
    
      <div class="col-md-2">
        <div class="form-group">
           <label for="menu_name" class="control-label mt-3">Start Date</label>
           <input class="form-control form-control form-control mt-3 start_date" style="border-radius:8px" name="start_date"  value="<?php echo e(date('d-m-Y',strtotime($data->start_date))); ?>"  type="text">
        </div>
      </div>

     <div class="col-md-2">
      <div class="form-group eqheight">
         <label for="menu_name" class="control-label mt-3">End Date</label>
         <input class="form-control form-control form-control mt-3 end_date" style="border-radius:8px" name="end_date" value="<?php echo e(date('d-m-Y',strtotime($data->end_date))); ?>"   type="text">
      </div>
    </div>

      
      <div class="col-md-2">
        <div class="form-group float-left">
             <input type="hidden" name="edit_id" value="<?php echo e($data->id); ?>">
              <input type="hidden" name="type" value="<?php echo e($data->type); ?>">
            <button type="submit" class="btn btn-primary mt-5 px-4 py-2"> Update</button>
        </div>
    </div>
  </div>
  </form>

   <?php elseif($data->type=='banner'): ?>
      <?php if($bannner==1): ?>
     <h2>Home1 Page Banner </h2>
     <?php endif; ?>
     <?php $bannner++; ?>
  <form  action="<?php echo e(route('updatevalue')); ?>" method="post" enctype="multipart/form-data">
                     <?php echo e(csrf_field()); ?>      
   <div class="row">
       <div class="col-md-3"> 
          <div class="form-group">
             <label for="menu_name" class="control-label mt-4"><b><?php echo e($data->name); ?></b></label>
            <input type="file" class="form-control form-control form-control mt-3" style="border-radius:8px" name="value">
          </div>
       </div>
       <div class="col-md-3">
        <img src="<?php echo e(url($data->value)); ?>" class="mt-5" width="50" height="50">
       </div> 

        <div class="col-md-3"> 
          <div class="form-group">
             <label for="menu_name" class="control-label mt-2" style="font-size:18px;font-weight:700">Link</label>
             <input type="text" class="form-control" name="link" value="<?php echo e($data->link); ?>">
          </div>
       </div>
       <div class="col-md-2">
        <div class="form-group float-left">
             <input type="hidden" name="edit_id" value="<?php echo e($data->id); ?>">
              <input type="hidden" name="type" value="<?php echo e($data->type); ?>">
            <button type="submit" class="btn btn-primary mt-5 px-4 py-2"> Update</button>
        </div>
    </div>
  </div>

  </form>

  <?php elseif($data->type=='mobile'): ?>
      <?php if($bannners==1): ?>
     <h2>Mobile Page Banner </h2>
     <?php endif; ?>
     <?php $bannners++; ?>
  <form  action="<?php echo e(route('updatevalue')); ?>" method="post" enctype="multipart/form-data">
                     <?php echo e(csrf_field()); ?>      
   <div class="row">
       <div class="col-md-3"> 
          <div class="form-group">
             <label for="menu_name" class="control-label mt-4"><b><?php echo e($data->name); ?></b></label>
            <input type="file" class="form-control form-control form-control mt-3" style="border-radius:8px" name="value">
          </div>
       </div>
       <div class="col-md-3">
        <img src="<?php echo e(url($data->value)); ?>" class="mt-5" width="50" height="50">
       </div> 

        <div class="col-md-3"> 
          <div class="form-group">
             <label for="menu_name" class="control-label mt-2" style="font-size:18px;font-weight:700">Link</label>
             <input type="text" class="form-control" name="link" value="<?php echo e($data->link); ?>">
          </div>
       </div>
       <div class="col-md-2">
        <div class="form-group float-left">
             <input type="hidden" name="edit_id" value="<?php echo e($data->id); ?>">
              <input type="hidden" name="type" value="<?php echo e($data->type); ?>">
            <button type="submit" class="btn btn-primary mt-5 px-4 py-2"> Update</button>
        </div>
    </div>
  </div>

  </form>

  



  <?php elseif($data->type=='whatsApp'): ?>
    <form   action="<?php echo e(route('updatevalue')); ?>" method="post" enctype="multipart/form-data">
                     <?php echo e(csrf_field()); ?>

      <div class="row">
       <div class="col-md-6"> 
          <div class="form-group">
             <label for="menu_name" class="control-label mt-2" style="font-size:18px;font-weight:700"><?php echo e($data->name); ?></label>
             <textarea class="form-control form-control form-control mt-2" style="border-radius:8px" name="value"><?php echo e($data->value); ?></textarea>
          </div>
       </div>
    
       <div class="col-md-2">
        <div class="form-group">
             <input type="hidden" name="edit_id" value="<?php echo e($data->id); ?>">
             <input type="hidden" name="type" value="<?php echo e($data->type); ?>">
            <button type="submit" class="btn btn-primary mt-5 px-4 py-2"> Update</button>
        </div>
    </div>
  </div>
   </form>

   <?php endif; ?>
  <hr>

   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

     <h3 class="text-primary text-center"><b>Payment key List</b></h3>
  
    <?php $__currentLoopData = $paymentKeyList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <form  action="<?php echo e(route('updatepaymentvalue')); ?>" method="post" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>      
   <div class="row mt-5">
       <div class="col-md-6"> 
          <div class="form-group">
             <h6 class="mt-2" style="font-size:14px;font-weight:600"><?php echo e($payment->merchant_name); ?></h6>
           </div>
       </div>

             <input type="hidden" name="edit_id" value="<?php echo e($payment->id); ?>">
       <?php if($payment->defalut==1): ?>
      
        
       <div class="col-md-2 text-end">
        <div class="form-group">
       <button class="btn btn-warning px-4 py-2" style="margin-left:0px">Default</button>
       </div>
      </div>
       <?php else: ?>
       <div class="col-md-2 text-end">
        <div class="form-group">
             <button type="submit" name="defalut" value="1" class="btn btn-primary px-3 py-2"> Mark Default</button>
        </div>
      </div>
       <?php endif; ?>

       
       <div class="col-md-2">
        <div class="form-group">
              
              <?php if($payment->status==0): ?>
                 <button type="submit" name="status" value="1" class="btn btn-danger px-3 py-2" style="margin-left:60px"> Inactive</button>
           <?php else: ?>
              <button type="submit" name="status" value="0" class="btn btn-success px-3 py-2" style="margin-left:60px"> Active</button>
           <?php endif; ?>
        </div>
     
  
        </div>
        
  </div>
  </form>
  <hr>

       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

     <script type="text/javascript">
         $(document).ready(function(){
             $(".start_date,.end_date").datepicker({            
             minDate: new Date()
            });
         });
        
     </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/homeoffere/index.blade.php ENDPATH**/ ?>