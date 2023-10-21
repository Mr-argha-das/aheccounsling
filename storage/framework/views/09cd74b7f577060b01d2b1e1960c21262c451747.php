<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
use \App\Model\Country_model as countryModel;
$countryCode = countryModel::pluck('phonecode','id');

$content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); ?>

<!--hero section start-->



<section class="position-relative">

  <div id="particles-js"></div>

  <div class="container">

    <div class="row  text-center">

      <div class="col">

        <h1><?=$content->menu_name?></h1>

        <nav aria-label="breadcrumb">

          <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">

            <li class="breadcrumb-item"><a class="text-dark" href="#">Home</a>

            </li>

            <li class="breadcrumb-item active text-primary" aria-current="page"><?=$content->menu_name?></li>

          </ol>

        </nav>

      </div>

    </div>

    <!-- / .row -->

  </div>

  <!-- / .container -->

</section>

<section>
 

  <div class="container">



    <div class="row justify-content-center text-center">

      <div class="col-12 col-lg-10">

            <form  class="row" action="query/flform" id="fl_registration"  method="post" enctype="multipart/form-data">

            <div class="form-group col-md-12">
            <?php echo e(csrf_field()); ?>

            <?php if(Session::has('successFlash')): ?>
              <strong class="text-success alert alert-success"><?php echo Session::get('successFlash'); ?></strong>
             <?php endif; ?>
            <?php if(Session::has('errorFlash')): ?>
            <strong class="text-danger alert alert-danger"><?php echo Session::get('errorFlash'); ?></strong>
            <?php endif; ?>
            </div>

            <div class="form-group col-md-6">

                <input id="fl_name" type="text" name="fl_name" class="form-control" placeholder="Full Name"  required data-error="Full Name is required.">

                <div class="help-block with-errors"></div>

              </div>

       

              <div class="form-group col-md-6">

                <input id="fl_email" type="text" name="fl_email" class="form-control" placeholder="Email"  data-error="Valid email is required." required>

                <div class="help-block with-errors"></div>

              </div>

              <div class="form-group col-md-2">

                  <select class="form-control" name="fl_country_code" required >
                   <?php $__currentLoopData = $countryCode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <option <?php if($vs==91) echo 'selected' ?> value="<?php echo e($vs); ?>">+<?php echo e($vs); ?> </option>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
              </div>
              <div class="form-group col-md-4">

                <input id="fl_mobile" type="number"  name="fl_mobile" minlength="10" maxlength="12" class="form-control" placeholder="Phone"  data-error="Phone number is required" required>
              </div>

               <div class="form-group col-md-6">

                <input  type="text"  name="fl_alternate_number"  class="form-control" placeholder="Alternate Contact Number" >

                
              </div>

              <div class="form-group col-md-6">

                <input id="aadhar_number" type="text"  name="aadhar_number" minlength="10" maxlength="12" class="form-control" placeholder="Aadhar Number"  data-error="Phone number is required" required>

                <div class="help-block with-errors"></div>

              </div>

               <div class="form-group col-md-6">

                <input  type="text"  name="pan_number"  class="form-control" placeholder="PAN Number">

                

              </div>

             

              <div class="form-group col-md-12">

                <input id="fl_address" type="text" name="fl_address" class="form-control" placeholder="Address"  data-error="Address is required" required>

                <div class="help-block with-errors"></div>

              </div>

              <div class="form-group col-md-6">

                <input id="bank_name" type="text" name="bank_name" class="form-control" placeholder="Bank Name"   >

                <div class="help-block with-errors"></div>

              </div>

                  <div class="form-group col-md-6">

                <input id="bank_no" type="number"  minlength="5" maxlength="35" name="bank_no" class="form-control" placeholder="Account Number"   >

                <div class="help-block with-errors"></div>

              </div>

                <div class="form-group col-md-6">

                <input id="bank_ifsc" type="text" name="bank_ifsc" class="form-control" placeholder="Bank IFSC Code"   >

                <div class="help-block with-errors"></div>

              </div>

                <div class="form-group col-md-6">

                <input id="bank_branch" type="text" name="bank_branch" class="form-control" placeholder="Bank Branch"   >

                <div class="help-block with-errors"></div>

              </div>

              <div class="col-md-6">

                <div class="input-file-container" style="width:100% !important;">  

                  <input class="input-file file_chagne" data-id="idproof" type="file" name="idproof">

                  <label tabindex="0" for="my-file" id="idproof" class="input-file-trigger file_name">Upload ID Address Proof</label>

                </div>

              </div>

               <div class="col-md-6">

                <div class="input-file-container" style="width:100% !important;">  

                  <input class="input-file file_chagne" data-id="pan_number_doc" type="file" name="pan_number_doc">

                  <label tabindex="0" for="my-file" id="pan_number_doc" class="input-file-trigger file_name">PAN Card</label>

                </div>

              </div>

              <div class="col-md-12  mt-12">

                <button class="btn btn-primary" type="submit"><span>Submit</span>

                </button>

              </div>

       </form>

    </div>

    </div>

    

  </div>

</section>







<!--hero section end--> 





<!--body content start-->



<div class="page-content">



<section>





 

</section>







</div>

 <?php $__env->startSection('javascript'); ?>
   <script type="text/javascript">
     
    $(document).ready(function(){
       $('#fl_registration').validate({

                   onfocusout: function(element) {$(element).valid()}
                         , rules: {

                     "fl_name": {
                         required: true,
                         pattern: /^[a-zA-Z'.\s]{1,40}$/,
                         maxlength: 30,
                         minlength: 2,
                     },"fl_email":{
                        required: true,
                        email: true,
                     },"fl_mobile": {
                         required: true,
                         number: true,
                         minlength: 10,
                         maxlength: 10,
                     },"bank_no": {
                         required: true,
                         number: true,
                      } ,"bank_ifsc": {
                         required: true,
                      },"bank_branch": {
                         required: true,
                     },"bank_name": {
                         required: true,
                      } ,"aadhar_number": {
                         required: true,
                         number: true,
                         minlength: 12,
                         maxlength: 12,
                     },
                  },
                  messages: {
                    "fl_name": {
                         required: "Full Name is required",
                         minlength: "Full Name must contain at least {4} characters",
                         maxlength: "Full Name must contain only {30} characters",
                         pattern: 'Only Characters are allowed',
                     },
                      "fl_email":{
                        required: 'Email Address is required',
                        email: 'Please Enter a Valid Email Address',
                     },"fl_mobile": {
                         required: "Phone No is required",
                         number: "Only number are allowed",
                         minlength: "Phone No must contain {10} digit Number",
                         maxlength: "Phone No must contain {10} digit Number",
                     },"bank_no": {
                           required: "A/c No is required",
                            number: "Only number are allowed",
                      } ,"bank_ifsc": {
                         required: "IFSC Code is required",
                      },"bank_branch": {
                         required: "Branch Name is required",
                     },"bank_name": {
                         required: "Bank Name is required",
                      },"aadhar_number": {
                         required: "Aadhar Number No is required",
                         number: "Only number are allowed",
                         minlength: "Aadhar Number must contain {12} digit Number",
                         maxlength: "Aadhar Number must contain {12} digit Number",
                     } 
                    
                  },
                 });
          });
   
   </script>
  <?php $__env->stopSection(); ?>


<!--body content end--> 



<!-- footer start -->

<?php echo $__env->make('layouts.frontfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/web/FL-Registration.blade.php ENDPATH**/ ?>