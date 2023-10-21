<?php $__env->startSection('content'); ?>
<?php echo $__env->make('blocks/panelHeading',['title'=>$title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

 <?php 
 $rmidlist  = \App\Model\Entry\RegisterMember_model::makeArray();
 $countryCode = \App\Model\Country_model::pluck('phonecode','id');
 ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
   
  <?php echo e(Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction))); ?>

<?php echo method_field('PUT'); ?>
 
<div class="row">

        <div class="col-md-6">
           <label class="control-label">Name</label>
             <!-- <input type="text" class="form-control form-control-lg" name="modal_en_first_name" id="modal_en_first_name"  value="" placeholder="First Name"> -->
             <input type="text" name="modal_en_first_name" class="form-control form-control-lg" value="<?php echo e($row->user_name); ?>" id="modal_en_first_name"  placeholder="First Name">
        </div>
        
        <div class="col-md-6">
           <label class="control-label">Email</label>
            <input id="modal_en_email" class="form-control form-control-lg" name="modal_en_email" value="<?php echo e($row->user_email); ?>" type="text"  value="" placeholder="E-mail">
        </div>


         <div class="col-md-4">
             <label class="control-label">Mobile Number</label>
                <div class="row my-2 mx-0 border">
                    <div class="col-2 px-0">

                        <select  class="border-0" class="form-control form-control-lg" name="country_code"  id="country_code" >
                          <?php $__currentLoopData = $countryCode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option <?php if($vs==$row->phone_code ) echo 'selected' ?>  value="<?php echo e($vs); ?>">+<?php echo e($vs); ?> </option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                         
                     </select>
                 </div>
                 <div class="col-10 pl-0">

                    <input type="number" class="border-0" class="form-control form-control-lg"  value="<?php echo e($row->mobile); ?>" id="modal_en_mobile" value="" name="modal_en_mobile"  placeholder="Mobile No." />
                </div>
            </div>
        </div>
      
       <div class="col-md-4">
           <label class="control-label">Univercity name</label>
           <input type="text" name="univercity_name" class="form-control form-control-lg" value="<?php echo e($row->univercity_name); ?>" id="univercity_name"  placeholder="univercity name">
        </div>
      <div class="col-md-4">
          <label class="control-label">RM ID</label>
          <select    name="rm_id" id="rm_id_select" class="form-control form-control-lg">
            <option value="">SELECT RM Id</option>
            <?php $__currentLoopData = $rmidlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rm_id => $rmusername): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option  <?php if($rm_id==$row->rm_id ) echo 'selected' ?> value="<?php echo e($rm_id); ?>"><?php echo e($rmusername); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
     

         

        <?php echo e(Form::bsSubmit()); ?>

 
<?php echo e(Form::close()); ?>


<script type="text/javascript"> 

   $(document).ready(function(){

 $('#country_code,#rm_id_select').select2();
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/myclients/edit.blade.php ENDPATH**/ ?>