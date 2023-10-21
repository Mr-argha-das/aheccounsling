   
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('blocks/panelHeading',['title'=>$title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

 <?php 
 $rmidlist  = \App\Model\Entry\RegisterMember_model::makeArray();
 $countryCode = \App\Model\Country_model::pluck('phonecode','id');
 ?>
  <style type="text/css">
    .error{
  color:#f64a08eb !important;
}
  </style>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <script src="assets/js/dzupload.js" defer></script>
  
<?php echo e(Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction,'id'=>"msform-order"))); ?>

 
<div class="row">

       <div class="col-md-6">
           <label class="control-label">First Name</label>
             <!-- <input type="text" class="form-control form-control-lg" name="modal_en_first_name" id="modal_en_first_name"  value="" placeholder="First Name"> -->
             <input type="text" name="modal_en_first_name" class="form-control form-control-lg" id="modal_en_first_name"  placeholder="First Name">
        </div>
        <div class="col-md-6">
            <label class="control-label">Last Name</label>
            <input  type="text"  id="modal_en_last_name" class="form-control form-control-lg" name="modal_en_last_name"  value="" placeholder="Last Name">
        </div>
        <div class="col-md-6">
           <label class="control-label">Email</label>
            <input id="modal_en_email" class="form-control form-control-lg" name="modal_en_email" type="text"  value="" placeholder="E-mail">
        </div>


         <div class="col-md-6">
             <label class="control-label">Mobile Number</label>
                <div class="row my-2 mx-0 border">
                    <div class="col-2 px-0">

                        <select  class="border-0" class="form-control form-control-lg" name="country_code"  id="country_code" >
                          <?php $__currentLoopData = $countryCode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option <?php if($vs==91) echo 'selected' ?>  value="<?php echo e($vs); ?>">+<?php echo e($vs); ?> </option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                         
                     </select>
                 </div>
                 <div class="col-10 pl-0">

                    <input type="text" class="border-0 numbers" class="form-control form-control-lg"   id="modal_en_mobile" value="" name="modal_en_mobile"  placeholder="Mobile No." />
                </div>
            </div>
        </div>
      
       <div class="col-md-6">
           <label class="control-label">Univercity name</label>
           <input type="text" name="univercity_name" class="form-control form-control-lg" id="univercity_name"  placeholder="univercity name">
        </div>

        

        <div class="col-md-6">
          <label class="control-label">RM ID</label>
          <select    name="rm_id" id="rm_id_select"   class="form-control form-control-lg">
            <option value="">SELECT RM Id</option>
            <?php $__currentLoopData = $rmidlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rm_id => $rmusername): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option  <?php if($rm_id_selected==$rm_id) echo 'selected'; ?> value="<?php echo e($rm_id); ?>"><?php echo e($rmusername); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
     
         
      <div class="col-md-12 ">
        <?php echo e(Form::bsSubmit()); ?>

      </div>

 <?php echo e(Form::close()); ?>


 <script type="text/javascript"> 

   $(document).ready(function(){

       $('.numbers').keyup(function () { 
      this.value = this.value.replace(/[^0-9\.]/g,'');
  });
     
      $('#country_code,#rm_id_select').select2();
     $('#msform-order').validate({

        onfocusout: function(element) {$(element).valid()}
        , rules: {
          "modal_en_first_name": {
              required: true,
               maxlength: 30,
              minlength: 2,
          },"modal_en_last_name": {
              required: true,
              maxlength: 30,
              minlength: 2,
          },"modal_en_email":{
           required: true,
           email: true,
           remote:{
            url: "<?php echo e(route('varifyemail')); ?>",
            type: "get",
            data: {
             email: function() {
                    return $( "#modal_en_email" ).val(); //your email field
                }
            }
        } 
       },"modal_en_mobile": {
          required: true,
          number: true,
          remote:{
            url: "<?php echo e(route('varifyphone')); ?>",
            type: "get",
            data: {
             email: function() {
                    return $( "#modal_en_mobile" ).val(); //your email field
                }
            }
        } 
      },"univercity_name": {
          required: true,
      },"rm_id": {
          required: true,
      }, 
  },
  messages: {
   "modal_en_mobile": {
      required: "Phone no. is required",
      number: "Only number are allowed",
      remote:"This phone no. is already registered "
  },
  "modal_en_first_name": {
      required: "First name is required",
      minlength: "First name must contain at least {4} characters",
      maxlength: "First name must contain only {30} characters",
       
  },
  "modal_en_last_name": {
      required: "Last name is required",
      minlength: "Last name must contain at least {2} characters",
      maxlength: "Last name must contain only {30} characters",
     
  },
  "modal_en_email":{
   required: 'Email address is required',
   email: 'Please enter a Valid Email Address',
   remote:"This email is already registered"
 }
},
});
 });
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/myclients/create.blade.php ENDPATH**/ ?>