   
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('blocks/panelHeading',['title'=>$title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<script src="assets/js/dzupload.js" defer></script>
<?php echo e(Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction))); ?>

<?php echo method_field('PUT'); ?>
  
     <div class="row">

        <div class="col-md-12 ">
           <?php echo e(Form::bsText('name',$row->name,['label'=>'Name','class'=>'form-control'])); ?>

        </div>
         <div class="col-md-12 ">
           <?php echo e(Form::bsText('emid',$row->emid,['label'=>'Emp-id','class'=>'form-control'])); ?>

        </div>

        <div class="col-md-12 ">
           <?php echo e(Form::bsText('rmid',$row->rmid,['label'=>'RMID','class'=>'form-control'])); ?>

       </div>

       <div class="col-md-12 ">
           <?php echo e(Form::bsText('email',$row->email,['label'=>'Email','class'=>'form-control'])); ?>

       </div>
      
       <div class="col-md-12 ">
           <?php echo e(Form::bsText('phone',$row->phone,['label'=>'Phone','class'=>'form-control'])); ?>

       </div>

       <div class="col-md-12 ">
           <?php echo e(Form::bsText('symbol',$row->symbol,['label'=>'Symbol','class'=>'form-control'])); ?>

       </div>

       <div class="col-md-12 ">
       <?php echo e(Form::bsSelect('emp_type',$venturesDropdown,$row->emp_type,['label'=>"VENTURES",'class'=>'form-control'])); ?>

       </div>

       <div class="col-md-12 ">
           <?php echo e(Form::bsSelect('status',$statusDropdown,$row->status,['label'=>"Status",'class'=>'form-control'])); ?>

       </div>

       <?php echo e(Form::bsSubmit()); ?>

 
       <?php echo e(Form::close()); ?>

      
      <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/rmiduser/edit.blade.php ENDPATH**/ ?>