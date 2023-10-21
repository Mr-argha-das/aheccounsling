<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php

$content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); ?>
 
 <style type="text/css">
 	.error{
 		color:red;
 	}
 </style>
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



    <div class="row">


        <div class="col-lg-6">
  
  <div class="imesfs">
    <img src="webassets/images/singup.png" class="img-fluid">
  </div>
</div>


      <div class="col-lg-6">

   <!-- <form  class="row" id="bloger-form" action="query/blogerRegistration" method="post" enctype="multipart/form-data">

            <div class="form-group col-md-12">
		          <?php echo e(csrf_field()); ?>

		          <?php if(Session::has('successFlash')): ?>
		           <strong class="text-success alert alert-success"><?php echo Session::get('successFlash'); ?></strong>
		          <?php endif; ?>
		          <?php if(Session::has('errorFlash')): ?>
		           <strong class="text-danger alert alert-danger"><?php echo Session::get('errorFlash'); ?></strong>
		         <?php endif; ?>
            </div>

               <div class="form-group col-md-12">
                  <input id="name" type="text" name="name" class="form-control" placeholder="Full Name">
               </div>

               <div class="form-group col-md-12">
                  <input id="email" type="email" name="email" class="form-control" placeholder="Email">
               </div>

              <div class="form-group col-md-12">
                  <input id="password" type="password" name="password" class="form-control" placeholder="Password"  data-error="Valid Password is required." required>
               </div>

               <div class="col-md-12  mt-12">
                     <button class="btn btn-primary" type="submit"><span>Submit</span> </button>
               </div>

                <div class="col-md-12 mt-2" >
                   <div class="row">
                    <div class="col-md-6">
                        <a href="sign-in" class="float-left"><span class="text-dark">Already have an account!</span>Login</a>
                    </div>
                  </div>
              </div>
          </form> -->


          <style>
  @media  only screen and (max-width:768px){
    .login-signup-mobvw{
margin-bottom:100px !important
}
  }

</style>


          <div class="bg-white box-bg mt-4 mb-4 login-signup-mobvw">
            
          
          <form  class="row" id="bloger-form" action="query/blogerRegistration" method="post" enctype="multipart/form-data">

<div class="form-group col-md-12">
  <?php echo e(csrf_field()); ?>

  <?php if(Session::has('successFlash')): ?>
   <strong class="text-success alert alert-success"><?php echo Session::get('successFlash'); ?></strong>
  <?php endif; ?>
  <?php if(Session::has('errorFlash')): ?>
   <strong class="text-danger alert alert-danger"><?php echo Session::get('errorFlash'); ?></strong>
 <?php endif; ?>
</div>

   <div class="form-group col-md-12">
   <label for="name" class="form-label label-heading">Full Name</label>
      <input id="name" type="text" name="name" class="form-control form-holder" placeholder="Full Name">
   </div>

   <div class="form-group col-md-12">
   <label for="email" class="form-label label-heading">Email</label>
      <input id="email" type="email" name="email" class="form-control form-holder" placeholder="Email">
   </div>

  <div class="form-group col-md-12">
  <label for="password" class="form-label label-heading">Password</label>
      <input id="password" type="password" name="password" class="form-control form-holder" placeholder="Password"  data-error="Valid Password is required." required>
   </div>
   <p class="term-text mt-2 text-muted">By signing up, you agree to our <a href="https://www.ahecounselling.com/terms-conditions"><span class="text-primary">Terms and Conditions</span></a>.</p>
   <div class="col-md-12  mt-12">
         <button class="sign-button w-100 px-5 py-2 mt-2 mb-2" type="submit"><span>Submit <i class="bi bi-arrow-right"></i></span> </button>
         <h6 class="text-center mt-4 text-muted">Already have an account!<a href="sign-in"><span class="text-primary"> login</span></a></h6>
   </div>

    <!-- <div class="col-md-12 mt-4" >
       <div class="row">
        <div class="col-md-12">
        
           <a href="sign-in" class="text-center"><span class="text-dark">Already have an account!</span> Login</a>
        </div>
      </div>
  </div> -->
</form>             
        </div>














       </div>
   </div>
  </div>
 </section>

<?php $__env->startSection('javascript'); ?>
 <script type="text/javascript">
 
 $(document).ready(function(){

		   // $(".submit").click(function(){
		   //  return false;
		   // });

           $('#bloger-form').validate({

		        onfocusout: function(element) {$(element).valid()}
		        , rules: {

		          "name": {
		              required: true,
		              pattern: /^[a-zA-Z'.\s]{1,40}$/,
		              maxlength: 30,
		              minlength: 2,
		          },
		          "email":{
		           required: true,
		           email: true,
		           remote:{
		            url: `<?php echo e(route("blogerVarifyemail")); ?>`,
		            type: "get",
		            data: {
		             email: function() {
		                    return $( "#email" ).val(); //your email field
		                }
		            }
		        } 
		       },
		      
		  },
		  messages: {
		  "name": {
		      required: "Full name is required",
		      minlength: "Full name must contain at least {4} characters",
		      maxlength: "Full name must contain only {30} characters",
		      pattern: 'Only characters are allowed',
		  },
			  "email":{
			   required: 'Email address is required',
			   email: 'Please enter a Valid Email Address',
			   remote:"This email is already registered"
			 },
	     },
	   });
   });
 
  
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/web/signup-blog-user.blade.php ENDPATH**/ ?>