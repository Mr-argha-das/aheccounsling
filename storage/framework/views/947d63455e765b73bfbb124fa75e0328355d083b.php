<?php $__env->startSection('content'); ?>
<?php echo $__env->make('blocks/panelHeading',['title'=>'Update status'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php 
$flUserList =  \App\Model\Website\FlModel::pluck('af_name','af_id');
?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<script src="assets/js/dzupload.js" defer></script>
<script src="assets/js/jquery-clock-timepicker.min.js" defer></script>
  
<?php echo e(Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction,'id'=>"msform-order"))); ?>

<?php echo method_field('PUT'); ?>
 
<div class="row">
     
      <div class="col-md-12 ">
           <?php echo e(Form::bsSelect('status',$orderStatus,'',['label'=>"Status",'class'=>'form-control'])); ?>

      </div>

       <div class="col-md-12 ">
           <?php echo e(Form::bsTextarea('comment','',['label'=>'Comment','class'=>'form-control ckeditor'])); ?>

       </div>
          
       <div class="col-md-12 <?php if($rm_id!=0): ?> d-none <?php endif; ?>">
           <label>Writers</label>
            <select class="form-control" name="writer_id"> 
               <option value="">Select Writer</option>
              
               <?php $__currentLoopData = $flUserList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fl_id => $fl_user_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              
                <option <?php if($writer_id==$fl_id){  echo 'selected'; } ?> value="<?php echo e($fl_id); ?>"><?php echo e($fl_user_name); ?></option>
              
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
           
       </div>
     <div class="col-md-12 ">
        <?php echo e(Form::bsSubmit()); ?>

      </div>

<?php echo e(Form::close()); ?>


 <?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/orders/statusUpdate.blade.php ENDPATH**/ ?>