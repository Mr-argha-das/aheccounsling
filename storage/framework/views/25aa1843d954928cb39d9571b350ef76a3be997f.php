<?php $__env->startSection('content'); ?>
<?php echo $__env->make('blocks/panelHeading',['title'=>$title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

<?php echo e(Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction))); ?>

<?php echo method_field('PUT'); ?>

<div class="row">

         <div class="col-md-6 ">
           <?php echo e(Form::bsText('setting_var',$row->setting_var,['label'=>$niceNames,'class'=>'form-control','readonly'=>'true'])); ?>

        </div>
          <div class="col-md-6 ">
           <?php echo e(Form::bsText('setting_name',$row->setting_name,['label'=>$niceNames,'class'=>'form-control'])); ?>

        </div>
        <div class="col-md-12 ">

           <?php echo e(Form::bsText('setting_value',$row->setting_value,['label'=>$niceNames,'class'=>'form-control'])); ?>

        </div>
        <div class="col-md-12 ">
           <?php echo e(Form::bsSelect('setting_access',$loginUsers,$row->setting_access,['label'=>$niceNames,'class'=>'form-control'])); ?>

       </div>
       <div class="col-md-12 ">
           <?php echo e(Form::bsSelect('setting_sorting',$orderType,$row->setting_sorting,['label'=>$niceNames,'class'=>'form-control'])); ?>

       </div>

     </div>

  
        <?php echo e(Form::bsSubmit()); ?>

 
<?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/settings/edit.blade.php ENDPATH**/ ?>