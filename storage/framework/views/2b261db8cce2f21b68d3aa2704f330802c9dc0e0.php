<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
$serviceArray  = \App\Model\Entry\Service_model::makeArray();
$rmidlist  = \App\Model\Entry\RegisterMember_model::makeArray();
$countryCode = \App\Model\Country_model::pluck('phonecode','id');
$first_name = $last_name =$user_email= $mobile =$phone_code= $rm_id ='';
$value = session()->get('userLg');
if(!empty($value)){
   $id = base64_decode(urldecode($value));
   $findUser =  DB::table('user_login')->where('user_id',$id)->first(); 
   $first_name = str_word_count($findUser->user_name, 1)[0];
   $last_name = substr(strstr($findUser->user_name," "), 1);
   $user_email = $findUser->user_email;
   $mobile = $findUser->mobile;
   $phone_code = $findUser->phone_code;
   $rm_id = $findUser->rm_id;
  } ?>
<style>
    .card{
        border: none!important;
    }
    *{
        font-family: 'Poppins', sans-serif;
    }
    .container-copy input {
        position: absolute!important;
        opacity: 1!important;
        z-index: 1!important;
        display: inline-block!important;
        width: 85%!important;
    }
.btns.hidden, #uploadImg:not(.hidden) + label {
   display: none;
}
.btns #file {
   display: none;
   margin: 0 auto;
}
.btns #upload {
   display: block;
   padding: 10px 25px;
   border: 0;
   margin: 0 auto;
   font-size: 15px;
   letter-spacing: 0.05em;
   cursor: pointer;
   background: #216e69;
   color: #fff;
   outline: none;
   transition: .3s ease-in-out;
}
.btns #upload:hover, #upload:focus {
   background: #1AA39A;
}
.btns #upload:active {
   background: #13D4C8;
   transition: .1s ease-in-out;
}
.btns img {
   display: block;
   margin: 0 auto 15px;
}
.btns .container-2{
    width: 200px;
    margin: 50px auto;
    font-family: sans-serif;
}
.error{
  color:#f64a08eb !important;
}
</style>
  
<section class="form mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h3 class="mb-0 text-center">Place Your Order</h3>
                <p class="mb-0 text-center">It's Fast, Secure & Confidential</p>
                <div class="discount"> <a href="" class="text-dark" data-toggle="modal" data-target="#discount">March Intakes Offer. Flat 10% Off on all bookings.</a> </div>
                <div class="px-0 pt-4 pb-0 mt-3 mb-3 border border-success border-5 rounded" style="">
                    <form id="msform-order" class="my-orders"  action="query/saveQueryModal" method="post" enctype="multipart/form-data" style="position: relative;">
                     <?php echo e(csrf_field()); ?>

                     <fieldset class="btns">
                        <div class="form-card row mx-2">

                      <?php  if(empty($value)){ ?>
                          <div class="col-md-6 my-2">
                              <input type="hidden" name="order_type" value="1">
                             <select  name="user_type" id="user_type"  required> 
                              <option value="">Select user type</option>
                              <option selected value="1">New User</option>
                              <option value="2">Existing User</option>
                            </select>
                         </div>
                       <?php }else{ ?>
                         
                          <input type="hidden" name="user_type" value="2">

                         <div class="col-md-6 my-2">
                          
                             <select  name="order_type" id="order_type"  required> 
                              <option value="">Select Order type</option>
                              <option selected value="1">New Order</option>
                              <option value="2">Existing Order</option>
                            </select>
                         </div>


                      <?php } ?>

                      <div class="col-md-6 my-2">
                         <select  name="payment_type" id="payment_type"  required> 
                          <option value="">Select payment type</option>
                          <option value="Full payment">Full payment</option>
                          <option value="Partial payment">Partial payment</option>
                          <option value="Remaining payment">Remaining payment</option>
                      </select>
                    </div>
                  <!-- <div class="col-md-6 my-2">
                    <input  name="last_en_email" id="last_en_email" type="text" required placeholder="Please Enter register(booking) e-mail address">
                </div> -->
                <div class="col-md-12 my-2 pre_order_id">
                    <select class="form-control form-control-sm" name="pre_order_id" id="pre_order_id" > 
                        <option value="">Select order id </option>
                    </select>
                </div>

                <div class="col-md-6 my-2">
                    <div class="input-container">
                  <input id="modal_en_first_name" <?php if(!empty($first_name)) {?>readonly <?php } ?> value="<?php echo e($first_name); ?>" name="modal_en_first_name" type="text" required>
                  <span for="modal_en_first_name" class="d-inline-block">First Name</span>
              </div>
              </div>
              <div class="col-md-6 my-2">
                <div class="input-container">
                  <input id="modal_en_last_name" <?php if(!empty($last_name)) {?>readonly <?php } ?> name="modal_en_last_name" value="<?php echo e($last_name); ?>" type="text"  placeholder=""  data-error="Name is required." spellcheck="true" autocomplete="off" aria-invalid="true">
                  <span for="modal_en_last_name" class="d-inline-block">Last Name</span>
              </div>
          </div>
              <div class="col-md-12 my-2">
                <div class="input-container">
                  <input id="modal_en_email" <?php if(!empty($user_email)) {?>readonly <?php } ?> name="modal_en_email" type="text"  value="<?php echo e($user_email); ?>" placeholder=""  data-error="Name is required." spellcheck="true" autocomplete="off" aria-invalid="true" required>
                  <span for="modal_en_email" class="d-inline-block">E-mail</span>
              </div>
          </div>
              <div class="col-md-6">
                <div class="row my-2 mx-0 border">
                    <div class="col-2 px-0">

                        <select  class="border-0" style="width: 60px;" name="country_code"  <?php if(!empty($phone_code)) {?> readonly <?php } ?> id="country_code" >
                         <?php $__currentLoopData = $countryCode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option <?php if($vs==91 || $vs==$phone_code) echo 'selected' ?>  value="<?php echo e($vs); ?>">+<?php echo e($vs); ?> </option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                     </select>
                 </div>
                 <div class="col-10 pl-0">

                    <input type="number" class="border-0" <?php if(!empty($mobile)) {?>readonly <?php } ?>  id="modal_en_mobile" value="<?php echo e($mobile); ?>" name="modal_en_mobile"  placeholder="Mobile No." />
                </div>
            </div>
        </div>
        <div class="col-md-6 my-2">
            <select name="en_service" id="en_service" > 
              <?php $__currentLoopData = $serviceArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($key); ?>"><?php echo e($vs); ?> </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
      </div>
      <div class="col-md-6 my-2">
         <div class="input-container">
        <input type="text" name="modal_en_subject" id="modal_en_subject"  placeholder="">
        <span for="modal_en_subject" class="d-inline-block">Module code</span>
      </div>
    </div>
    <div class="col-md-6 my-2">
        <div class="input-container">
     <input type="text" name="modal_en_module_name" id="modal_en_module_name"  placeholder="">
     <span for="modal_en_module_name" class="d-inline-block">Module Name</span>
 </div>
 </div>
 <div class="col-md-12 my-2">
    <div class="input-container">
     <textarea id="modal_en_query" name="modal_en_query" rows="5" placeholder=""></textarea>
     <span for="modal_en_query" class="d-inline-block">Message</span>
 </div>
</div>

 <div class="row justify-content-between my-2 mx-1 w-100 d-none">
     <div class="col-md-4 col-12 py-1">
      <label class="custom-file-upload">
    <input type="file"/ class="file_chagne" data-id="file_name_1" id="my-file_1"   name="modal_en_queryen_attachment_1">
    <span class="text-white select-file-name file_name" id="file_name_1">Select file 1</span> 
  </label>
  </div>

      <div class="col-md-4 col-12 py-1">
       <label class="custom-file-upload">
        <input type="file"/ class="file_chagne" data-id="file_name_2" id="my-file_2"   name="modal_en_queryen_attachment_2">
    <span class="text-white select-file-name file_name" id="file_name_2">Select file 2</span> 
      </label>
       </div>
       <div class="col-md-4 col-12 py-1">
         <label class="custom-file-upload">
        <input type="file"/ class="file_chagne" data-id="file_name_3" id="my-file_3"   name="modal_en_queryen_attachment_3">
    <span class="text-white select-file-name file_name" id="file_name_3">Select file 3</span>  
</label>
       </div>
 </div>
</div>
<input type="button" name="next" class="next action-button" value="Next" />
</fieldset>
<fieldset class="btns">
    <div class="form-card row mx-2">
        <h3>Payment Details</h3>
          <center><h6 class="btn btn-info">While you are paying via "World Remit" Kindly select the correct purpose code while initiating the Payment. In case if you do not have the proper Reason Code, please mention the Reason Code P0802 - Software Consultancy Services in the comments</h6>
            </center>
        <div class="col-md-12 payment">
            <div class="tabs">
                <div class="tab">
                    <input type="checkbox" value="1" id="chck1">
                    <label class="tab-label" for="chck1" style="max-width: 100%;">BANK DETAILS</label>
                    <div class="tab-content table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td scope="col">Account Holder Name</td>
                                    <td scope="col">Account No</td>
                                    <td scope="col">IFSC</td>
                                    <td scope="col">Branch Name</td>
                                    <td scope="col">Swift</td>
                                </tr>
                                <tr>
                                    <td scope="row">A2G Ventures Private Limited</td>
                                    <td>50200062572701</td>
                                    <td>HDFC0002838</td>
                                    <td>Bapu Nagar, Jaipur, 302015</td>
                                    <td>HDFCINBB</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab">
                    <input type="checkbox" value="2" id="chck2">
                    <label class="tab-label" for="chck2" style="max-width: 100%;">UPI SCANNER</label>
                    <div class="tab-content">
                     <img src="webassets/images/ss-code.jpeg" class="w-50 mx-auto" alt="upi-scane">

                 </div>
             </div>
             <div class="tab">
                <input type="checkbox" id="chck3" value="3">
                <label class="tab-label" for="chck3" style="max-width: 100%;">UPI ID</label>
                <div class="tab-content"> 
                <div class="container-copy">
                  <div id="inviteCode" class="invite-page">
                    <input id="link" value="8005779031@ybl" readonly>
                    <div id="copy">
                      <i class="fa fa-clipboard" aria-hidden="true" data-copytarget="#link"></i>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
</div>
</div>

<input type="button" name="next" class="next action-button" value="Next" />
<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
</fieldset>
<fieldset class="btns">
    <div class="form-card mx-2 row">
        <h3 class="text-center w-100">Upload Your Screenshot</h3>
        <div class="col-md-12 my-2"> 
            <div class="container-2">
                <label class="label" for="input"></label>
                <div class="input">
                    <input name="input" id="file" type="file" name="modal_en_queryen_attachment_4" accept="image/*">
                </div>  
            </div> 
            <br>
             <label  id="screenshot_validatino" style="color:red">Screen Shot is required</label>                             
        </div>

        <div class="col-md-6 my-2">

                  <select    name="rm_id" id="rm_id_check_value"  required > 
               
                    <option value="0">SELECT RM Id</option>
                    <?php $__currentLoopData = $rmidlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rm_id => $rmusername): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option <?php if($rm_id!='') echo 'selected'; ?> value="<?php echo e($rm_id); ?>"><?php echo e($rmusername); ?></option>
                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </select>
                 <label  id="rm_id_validatino" style="color:red">Rm Id is required</label>

              </div>
    </div>
    <input type="submit" name="next" class="next action-button" data-type="submit" value="Submit" /> 
    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
</fieldset>
<fieldset>
    <div class="form-card">
        <div class="row">
            <div class="col-7">
            </div>
            <div class="col-5">
            </div>
        </div>
        <br><br>
        <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2>
        <br>
        <div class="row justify-content-center">
            <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
        </div>
        <br><br>
        <div class="row justify-content-center">
            <div class="col-7 text-center">
                <h5 class="purple-text text-center">Your Order Successfully Submit. <br>Please check your mail</h5>
            </div>
        </div>
    </div>
</fieldset>
</form>
</div>
</div>
<div class="col-md-3 right-order">
    <div class="head" style="padding: 20px;margin-top: 85px;">
        <h3>On Bulk Booking get 12% Discount</h3>
        <p>Refer your friends and earn 5% off on booking.
        <br>T&C Apply</p>
    </div>
    <div class="wrapper mt-4 border border-success border-5 rounded">
        <ul class="StepProgress list-unstyled">
            <li class="StepProgress-item is-done">Order Request</li>
            <li class="StepProgress-item is-done">Get approval</li>
            <li class="StepProgress-item current">Work in progress</li>
            <li class="StepProgress-item">Delivered work on time</li>
        </ul>
    </div>
    <ul class="mt-4 border help p-3 list-unstyled border border-success border-5 rounded">
        <li><p>75000+ <span>Completed Assignments</span></p></li>
        <li><p>1500+ <span>Phd Experts</span></p></li>
        <li><p>4.8/5 <span>Clients Rating</span></p></li>
    </ul>

    <ul class="mt-4 border help p-3 list-unstyled border border-success border-5 rounded">
        <h3>Why Students Refer us</h3>
        <li class="d-flex align-items-center my-2"><i class="fa fa-bookmark mr-3"></i><p class="mb-0">Best Quality With Numbers</p></li>
        <li class="d-flex align-items-center my-2"><i class="fa fa-credit-card mr-3"></i><p class="mb-0">Best Price with Secure Payment</p></li>
        <li class="d-flex align-items-center my-2"><i class="fa fa-truck mr-3"></i><p class="mb-0">Timely Delivery</p></li>
        <li class="d-flex align-items-center my-2"><i class="fa fa-th-list mr-3"></i><p class="mb-0">100% Privacy</p></li>
    </ul>
</div>
</div>
</div>
</section>
<?php $__env->startSection('javascript'); ?>
 <script type="text/javascript">
$('#copy').on('click', function(event) {
  copyToClipboard(event);
});

function copyToClipboard(e) {
 var
  t = e.target, 
  c = t.dataset.copytarget,
  inp = (c ? document.querySelector(c) : null);
  
   if (inp && inp.select) {
    
    inp.select();
    try {
 
      document.execCommand('copy');
      inp.blur();

       t.classList.add('copied');
      setTimeout(function() {
        t.classList.remove('copied');
    }, 1500);
  } catch (err) {
      
      alert('please press Ctrl/Cmd+C to copy');
  }

}

}
 
    $(function(){
        var container = $('.container-2'), inputFile = $('#file'), img, btn, txt = 'Browse', txtAfter = 'Browse another pic';

        if(!container.find('#upload').length){
            container.find('.input').append('<input type="button" value="'+txt+'" id="upload">');
            btn = $('#upload');
            container.prepend('<img src="" class="hidden" alt="Uploaded file" id="uploadImg" width="100">');
            img = $('#uploadImg');
        }

        btn.on('click', function(){
            img.animate({opacity: 0}, 300);
            inputFile.click();
        });

        inputFile.on('change', function(e){
            container.find('label').html( inputFile.val() );

            var i = 0;
            for(i; i < e.originalEvent.srcElement.files.length; i++) {
                var file = e.originalEvent.srcElement.files[i], 
                reader = new FileReader();

                reader.onloadend = function(){
                    img.attr('src', reader.result).animate({opacity: 1}, 700);
                }
                reader.readAsDataURL(file);
                img.removeClass('hidden');
            }

            btn.val( txtAfter );
        });
    });
 
  $(document).ready(function(){

    $("#user_type").change(function(){

      if($(this).val()==2){
           
         $("#rm_id_check_value,#modal_en_module_name,#country_code,#modal_en_mobile,#modal_en_query,#modal_en_query,#modal_en_subject,#en_service,#modal_en_email,#modal_en_last_name,#modal_en_first_name").prop('readonly', true);
         if (confirm('Kindly sign in to book your order')) {
               window.location.replace("https://www.ahecounselling.com/sign-in");

          } else {
                $("#rm_id_check_value,#modal_en_module_name,#country_code,#modal_en_mobile,#modal_en_query,#modal_en_query,#modal_en_subject,#en_service,#modal_en_email,#modal_en_last_name,#modal_en_first_name").removeAttr("readonly");
               $(this).val(1)
               return false;
           }
         }
       }); 
     
     $("#order_type").change(function(){
          if($(this).val()==2){
           var form = $('#msform-order')[0];
           var formdata = new FormData(form);
           $.ajax({
            type: 'POST',
            url: "<?php echo e(url('/')); ?>/query/searcholduser",
            data: formdata,  
            processData: false,
            contentType: false,  
            success: function (data) {
                    if(data=='false'){
                          $('.pre_order_id').hide();
                          $('#rm_id_check_value').val('0');
                          $('#modal_en_module_name').val('');
                          $('#modal_en_query').val('');
                          $('#modal_en_subject').val('');
                       }else{
                           $('.pre_order_id').show();
                           $('#pre_order_id').html("");
                           var data = JSON.parse(data)
                           var div_data = '<option value="">Select Existing order id</option>';
                           $.each(data, function (i, obj){
                            var sel = "";
                            div_data += "<option value=" + obj.id + " " + sel + ">" + obj.order_number + "</option>";
                        });
                           $('#pre_order_id').append(div_data);
                      } 
                    },
               });
           }else{
                $('.pre_order_id').hide();
                $('#rm_id_check_value').val('0');
                $('#modal_en_module_name').val('');
                $('#modal_en_query').val('');
                $('#modal_en_subject').val('');
           }

      });
  $("#pre_order_id").on("change", function(e) {

   var form = $('#msform-order')[0];
   var formdata = new FormData(form);
   $.ajax({
    type: 'POST',
    url: "<?php echo e(url('/')); ?>/query/searcholduserdetails",
    data: formdata,  
    processData: false,
    contentType: false,  
    success: function (data) {

        if(data=='false'){
                      $('#rm_id_check_value').val('0');
                      $('#modal_en_mobile').val('');
                      $('#modal_en_query').val('');
                      $('#modal_en_subject').val('');
                      $('#modal_en_email').val('');
                      $('#modal_en_last_name').val('');
                      $('#modal_en_first_name').val('');
              }else{
                    var data = JSON.parse(data);
                   $('#rm_id_check_value').val(data.rm_id);
                   $('#modal_en_query').val(data.en_query);
                   $('#modal_en_subject').val(data.en_subject);
                   $('#en_service').val(data.en_service);
                   $('#modal_en_module_name').val(data.module_name);
                   $("#modal_en_subject,#en_service,#modal_en_module_name").prop('readonly', true);
                   $("#modal_en_query").removeAttr("readonly");
                   if (!$("#msform-rder").valid()) {
                     return false;
                  } 
               } 
             },
         });
      });

  $('#screenshot_validatino').hide();
  $('#last_en_email').hide();
  $('.pre_order_id').hide();
  $('#rm_id_validatino').hide();

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;
var current = 1;
var steps = $("fieldset").length;

setProgressBar(current);

$(".next").click(function(){
        if (!$("#msform-order").valid()) {
         return false;
     }
   
  if($(this).data("type")=="submit"){

     if ($('#upload').val()=="Browse") {
         $('#screenshot_validatino').show();
         return false;
     }else{

        $('#screenshot_validatino').hide();
    }
    
    if($("#rm_id_check_value").val()=="0") {
      
       $('#rm_id_validatino').show();
       return false;
   }else{

       $('#rm_id_validatino').hide();
   }
   if( !confirm('Are you sure that you want to submit the form')){
       return false;
   }       
           // $("#msform-order").submit();
           $( "#msform-order" )[0].submit();       

        
			// var form = $('#msform-order')[0];
			// var formdata = new FormData(form);
			//      $.ajax({
			//       type: 'POST',
			//       url: "<?php echo e(url('/')); ?>/query/saveQueryModal",
			//       data: formdata,  
			//       processData: false,
			//       contentType: false,  
			//       success: function (data) {

			//           setTimeout(window.location.replace("https://www.ahecounselling.com/account"), 5000);

			//     },
			// });
    
       return false;
    }
    
      current_fs = $(this).parent();
      next_fs = $(this).parent().next();
      $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
      next_fs.show();
      current_fs.animate({opacity: 0}, {
      step: function(now) {
      // for making fielset appear animation
      opacity = 1 - now;

      current_fs.css({
      'display': 'none',
      'position': 'relative'
      });
      next_fs.css({'opacity': opacity});
      },
      duration: 500
      });
      setProgressBar(++current);
});

$(".previous").click(function(){

    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
    step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
    'display': 'none',
    'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(--current);
});

function setProgressBar(curStep){
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
    .css("width",percent+"%")
}

$(".submit").click(function(){
    return false;
})

});
 
    $(document).ready(function(){

      
     $('#msform-order').validate({

        onfocusout: function(element) {$(element).valid()}
        , rules: {

          "modal_en_first_name": {
              required: true,
              pattern: /^[a-zA-Z'.\s]{1,40}$/,
              maxlength: 30,
              minlength: 2,
          },"modal_en_last_name": {
              required: true,
              pattern: /^[a-zA-Z'.\s]{1,40}$/,
              maxlength: 30,
              minlength: 2,
          },"modal_en_email":{
           required: true,
           email: true,
           remote:{
            url: "<?php echo e(route("varifyemail")); ?>",
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
            url: "<?php echo e(route("varifyphone")); ?>",
            type: "get",
            data: {
             email: function() {
                    return $( "#modal_en_mobile" ).val(); //your email field
                }
            }
        } 
      },"modal_en_subject": {
          required: true,
      }, "modal_en_query": {
          required: true,
          maxlength: 200,
          minlength: 6,
      },"user_type": {
          required: true,
      },"payment_type": {
          required: true,
      },"modal_en_module_name": {
          required: true,
      }, 
  },
  messages: {
   "modal_en_module_name": {
      required: "Module name is required",
  },"payment_type": {
      required: "Payment type is required",
  }, "user_type": {
      required: "User type is required",
  },
  "modal_en_mobile": {
      required: "Phone no. is required",
      number: "Only number are allowed",
      remote:"This phone no. is already registered | Kindly sign in to book your order."
  },
  "modal_en_first_name": {
      required: "First name is required",
      minlength: "First name must contain at least {4} characters",
      maxlength: "First name must contain only {30} characters",
      pattern: 'Only characters are allowed',
  },
  "modal_en_last_name": {
      required: "Last name is required",
      minlength: "Last name must contain at least {2} characters",
      maxlength: "Last name must contain only {30} characters",
      pattern: 'Only characters are allowed',
  },
  "modal_en_email":{
   required: 'Email address is required',
   email: 'Please enter a Valid Email Address',
   remote:"This email is already registered | Kindly sign in to book your order."
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

<?php echo $__env->make('layouts.frontfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/web/ordernow.blade.php ENDPATH**/ ?>