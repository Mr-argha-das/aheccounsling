<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
$content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); 
use \App\Model\Country_model as countryModel;
$countryCode = countryModel::pluck('phonecode','id');
use \App\Model\Entry\Affiliates_data_model as affiliatesdata;
$affiliatesdata = affiliatesdata::all();
?>

<!--hero section start-->
<style>
  @media  only screen and (max-width:767.99px){
    .flx-dirtn{
    margin-bottom:100px;
  }
  }

</style>


<section class="position-relative">

  <div id="particles-js"></div>

  <div class="container">

    <div class="row text-center">

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
    <div class="">
      
      <div class="">

        <?php
         $n=1;
        ?>
        
  <?php $__currentLoopData = $affiliatesdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<button class="accordion d-flex justify-content-between" <?php if($n==1) echo 'active'; ?>><?php echo e($value->title); ?> 
<i class="bi bi-chevron-down"></i>
</button>
<div class="panel" style="display: <?php if($n==1) echo 'block';$n++;  ?>;">
  <p><?php echo $value->description; ?></p>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

 

      </div>
    </div>
  </div>
</section>




  <div class="container flx-dirtn">



    <div class="row justify-content-center text-center">

      <div class="col-12 col-lg-10">

   <form  class="row" action="query/attlicateform" id="al_registration" method="post" enctype="multipart/form-data">

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

                <input id="al_name" type="text" name="al_name" class="form-control" placeholder="Full Name">
             
             </div>

       
              <div class="form-group col-md-6">

                <input id="al_email" type="email" name="al_email" class="form-control" placeholder="Email">

                </div>


              <div class="form-group col-md-2">

                  <select class="form-control" name="fl_country_code" required >
                   <?php $__currentLoopData = $countryCode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <option <?php if($vs==91) echo 'selected' ?> value="<?php echo e($vs); ?>">+<?php echo e($vs); ?> </option>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
              </div>

              <div class="form-group col-md-4">

                <input id="al_mobile" type="number" minlength="10" maxlength="15"  name="al_mobile" class="form-control" placeholder="Phone" >
              </div>

             

              <div class="form-group col-md-6">

                <input id="form_subject" type="text" name="al_address" class="form-control" placeholder="Address" >

             </div>
  
             <div class="form-group col-md-12">
             <select class="form-control" name="" required >
                    <option value="">Upload Document</option>
                   <option value="adhar card">Adhar Card</option>
                   <option value="ID proof">ID Proof</option>
                 </select>
              </div>

             <div class="col-md-12 text-left mt-4">
             <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="" for="exampleCheck1">I agree with the terms and condition.</label>
             </div>
             </div>

              <div class="col-md-12 text-left mt-4">

                <div class="input-file-container" style="width:100% !important;">  

                  

                  <input  type="file" class="input-file" id="my-file" name="multi_file[]" placeholder="address" multiple>


                  <label tabindex="0" for="my-file" id="multi_file_attachment" class="input-file-trigger">Attachment</label>

                  Note:- For Attachment Multipal select with Ctrl+Click

                </div>

              </div>
              
              
              

              <div class="col-md-12 text-right mt-4">

                <button class="btn btn-primary" type="submit"><span>Submit</span>

                </button>

              </div>

       </form>

    </div>

    </div>

    

  </div>


  
  <?php $__env->startSection('javascript'); ?>
   <script type="text/javascript">
     
    $(document).ready(function(){
          
          $('#al_registration').validate({

                   onfocusout: function(element) {$(element).valid()}
                         , rules: {

                     "al_name": {
                         required: true,
                         pattern: /^[a-zA-Z'.\s]{1,40}$/,
                         maxlength: 30,
                         minlength: 2,
                     },"al_email":{
                        required: true,
                        email: true,
                     },"al_mobile": {
                         required: true,
                         number: true,
                         minlength: 10,
                         maxlength: 10,
                     } 
                  },
                  messages: {
                    "al_name": {
                         required: "Full Name is required",
                         minlength: "Full Name must contain at least {4} characters",
                         maxlength: "Full Name must contain only {30} characters",
                         pattern: 'Only Characters are allowed',
                     },
                      "al_email":{
                        required: 'Email Address is required',
                        email: 'Please Enter a Valid Email Address',
                     },"al_mobile": {
                         required: "Phone No is required",
                         number: "Only number are allowed",
                         minlength: "Phone No must contain {10} digit Number",
                         maxlength: "Phone No must contain {10} digit Number",
                     }
                    
                  },
                 });

         });
   
   </script>
  <?php $__env->stopSection(); ?>



<style type="text/css">
  
.accordion {
margin-bottom: 1%;
    background-color: #e2e2e2;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #ccc; 
}

.panel {
  padding: 0 18px;
  display: none;
  background-color: white;
  overflow: hidden;
}
</style>


 



<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>

 


<?php echo $__env->make('layouts.frontfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/web/affiliates-terms.blade.php ENDPATH**/ ?>