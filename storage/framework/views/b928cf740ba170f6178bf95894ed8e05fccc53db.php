<?php $__env->startSection('content'); ?>
<?php echo $__env->make('blocks/panelHeading',['title'=>$title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?PHP
$serviceArray  = \App\Model\Entry\Service_model::makeArray();
$rmidlist  = \App\Model\Entry\RegisterMember_model::makeArray();
$countryCode = \App\Model\Country_model::pluck('phonecode','id');
$currencyList = \App\Model\Entry\Currency_model::get();
  ?>

  <style type="text/css">
    .error{
  color:#f64a08eb !important;
}
  </style>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <script src="assets/js/dzupload.js" defer></script>
  
<?php echo e(Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction,'id'=>"msform-order"))); ?>

<?php

     $imgDataUpload = array(
                 'data-upload-folder'=>'assets/uploads/enquiry/',
                 'data-upload-url'=>route('ajaxuploadimage'),
                 'data-delete-url'=>route('deletefile'),
                 'data-inputname'=>'Screenshot',
                 'data-upload-type'=>'image',
                 'data-upload-maxfiles'=>1
              );
          $uploadDatanof =NULL;
        foreach($imgDataUpload as $key =>$val)
        {
            $uploadDatanof.=$key.'='.$val.'  ' ;
        }



?>
<div class="row">

       

         <div class="col-md-6" >
           <label class="control-label">Client List</label>
           <select   id="client_list" name="user_email" class="form-control form-control-lg"> 
               <option value="">Select client</option>
               <?php $__currentLoopData = $client_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <option  value="<?php echo e($client->user_email); ?>"><?php echo e($client->user_name); ?>  (<?php echo e($client->user_password); ?>)</option>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select> 
       </div>

       <div class="col-md-6">
         <label class="control-label">Order type</label>
         <select  name="order_type" id="order_type"  class="form-control form-control-lg"> 
            <option value="">Select Order type</option>
            <option selected value="1">New Order</option>
            <option value="2">Existing Order</option>
          </select>
       </div>

        <div class="col-md-6 d-none" id="on_update_order_type">
          <label class="control-label">Order id</label>
            <select class="form-control form-control-lg" name="pre_order_id" id="pre_order_id" > 
                <option value="">Select order id </option>
            </select>
        </div>

       <div class="col-md-6">
         <label class="control-label">Payment type</label>
          <select  name="payment_type" id="payment_type"  class="form-control form-control-lg"> 
                <option value="">Select payment type</option>
                <option value="Full payment">Full payment</option>
                <option value="Partial payment">Partial payment</option>
                <option value="Remaining payment">Remaining payment</option>
            </select> 
        </div>

        <div class="col-md-6">
               <label class="control-label">Service Type</label>
                <select  name="en_service" id="en_service"  class="form-control form-control-lg"> 
                      <option value="">Service Type</option>
                        <?php $__currentLoopData = $serviceArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>"><?php echo e($vs); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </select>
         </div>
        
         <div class="col-md-6">
           <label class="control-label">Module code</label>
           <input type="text" name="modal_en_subject" class="form-control form-control-lg" id="modal_en_subject"  placeholder="">
        </div>
        <div class="col-md-6">
           <label class="control-label">Module Name</label>
           <input type="text" name="modal_en_module_name" class="form-control form-control-lg" id="modal_en_module_name"  placeholder="">
        </div>

        <div class="col-md-6">
           <label class="control-label">Deadline</label>
           <input type="text" name="deadline" class="form-control form-control-lg" id="deadline" readonly value ="<?php echo e(date('d-M-Y')); ?>"  placeholder="">
        </div>

        <div class="col-md-6">
           <label class="control-label">Word Count</label>
           <input type="text" name="word_count" class="form-control form-control-lg numbers" id="word_count"  value="0"  placeholder="">
        </div>

        <div class="col-md-6">
           <label class="control-label">Type</label>
           <input type="text" name="assignment_type" class="form-control form-control-lg" id="assignment_type"  value=""  placeholder="Report/PPT">
        </div>

        <div class="col-md-6">
               <label class="control-label">Currency</label>
                <select  name="currency_type" id="currency_type"  class="form-control form-control-lg"> 
                      <option value="">Service Type</option>
                        <?php $__currentLoopData = $currencyList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($currency->currency_id); ?>"><?php echo e($currency->currency_code); ?>(<?php echo e($currency->currency_symbol); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </select>
         </div>

          <div class="col-md-6">
           <label class="control-label">Client Amount (Selected Currency) </label>
           <input type="text" name="client_amount" class="form-control form-control-lg numbers" id="client_amount"  value=""  placeholder="Client amount">
        </div>

        <div class="col-md-6">
           <label class="control-label">INR Amount</label>
           <input type="text" name="inr_amount" class="form-control form-control-lg numbers" id="inr_amount"  value=""  placeholder="INR amount">
        </div>

        <div class="col-md-6">
           <label class="control-label">AUD Amount</label>
           <input type="text" name="aud_amount" class="form-control form-control-lg numbers" id="aud_amount"  value=""  placeholder="AUD amount">
        </div>



       <div class="col-md-6">
          <label class="control-label">RM ID</label>
          <select    name="rm_id" id="rm_id_select2"  class="form-control form-control-lg">
            <option value="">SELECT RM Id</option>
            <?php $__currentLoopData = $rmidlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rm_id => $rmusername): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option <?php if($rm_id_selected==$rm_id){  echo 'selected'; } ?> value="<?php echo e($rm_id); ?>"><?php echo e($rmusername); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

       <div class="col-md-12">
           <label class="control-label">Short Note</label>
         <textarea id="modal_en_query" class="form-control form-control-lg" name="modal_en_query" rows="5" placeholder=""></textarea>
     </div>
       </br>
       <div class="col-md-6 mt-2">
        <label class="control-label">Payment screenshot image</label>
         <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$uploadDatanof?>  data-upload-filekey="userfile">
                        <div class="dz-message needsclick">
                            Drop files here or click to upload.<br>
                        </div>     
                        <div class="fallback">
                          <input type="file" name="userfile">
                          </div>
             </div>
         </div>

          <div class="col-md-4 mt-2">
           <label class="control-label">Transaction id</label>
           <input type="text" name="transaction_id" class="form-control form-control-lg" id="transaction_id"  value=""  placeholder="Transaction id">
        </div>
        <div class="col-md-2"> 
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
    
     $("#deadline").datepicker({            
      minDate: new Date()
     });

    $('#client_list,#en_service,#rm_id_select2,#currency_type').select2();

      $("#client_list").change(function(){ 
         var client_email =$(this).val();
          $('#pre_order_id').html("");
        $.ajax({
            type: 'POST',
            url: "<?php echo e(url('/')); ?>/query/searcholduser",
             headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {"modal_en_email":client_email},  
             dataType: "json",
            success: function (data) { 
                  var div_data = '<option value="">Select Existing order id</option>';
                  $.each(data, function (i, obj){
                  var sel = "";
                  div_data += "<option value=" + obj.id + " " + sel + ">" + obj.order_number + "</option>";
                  });
                   
                  $('#pre_order_id').append(div_data);              
               },
               });
       });  

 $("#pre_order_id").on("change", function(e) {

  var pre_order_id =$(this).val();
  $.ajax({
    type: 'POST',
    url: "<?php echo e(url('/')); ?>/query/searcholduserdetails",
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
     data: {"pre_order_id":pre_order_id},  
     dataType: "json",
     success: function (data) {

        if(data=='false'){

                      $('#modal_en_module_name').val('');
                      $('#modal_en_query').val('');
                      $('#modal_en_subject').val('');
                      $('#en_service').val('');
                      $("#modal_en_subject,#en_service,#modal_en_module_name").removeAttr("readonly");
                 }else{

                       $('#modal_en_module_name').val(data.module_name);
                       $('#modal_en_query').val(data.en_query);
                       $('#modal_en_subject').val(data.en_subject);
                       $("#modal_en_subject,#en_service,#modal_en_module_name").prop('readonly', true);
                       $('#en_service').val(data.en_service).trigger('change');
               } 

         },
     });

});
    
     $("#order_type").change(function(){

        $('#modal_en_module_name').val('');
        $('#modal_en_query').val('');
        $('#modal_en_subject').val('');
        $('#en_service').val('');  
        $("#modal_en_subject,#en_service,#modal_en_module_name").removeAttr("readonly");

       if($(this).val()==2){
            $('#on_update_order_type').removeClass('d-none');
        }else{

         $('#on_update_order_type').addClass('d-none');
       }
   });
      
     $('#msform-order').validate({

        onfocusout: function(element) {$(element).valid()}
        , rules: {
        "user_email": {
          required: true,
      } ,"en_service": {
          required: true,
      }, "modal_en_subject": {
          required: true,
      }, "modal_en_query": {
          required: true,
          maxlength: 200,
          minlength: 6,
      } ,"payment_type": {
          required: true,
      },"modal_en_module_name": {
          required: true,
      },"assignment_type": {
          required: true,
      },"word_count": {
          required: true,
      },"currency_type": {
          required: true,
      },"aud_amount": {
          required: true,
      },"client_amount": {
          required: true,
      },"inr_amount": {
          required: true,
      },"deadline": {
          required: true,
      }, 
  },
  messages: {
   "modal_en_module_name": {
      required: "Module name is required",
  },"payment_type": {
      required: "Payment type is required",
  }, 
 "modal_en_subject": {
  required: "Module code is required",
  
}, 
"modal_en_query": {
  required: "Message  is required",
  minlength: "Message must contain at least {6} characters",
  maxlength: "Message must contain only {2000} characters",
}

},
});
 });
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/orders/create.blade.php ENDPATH**/ ?>