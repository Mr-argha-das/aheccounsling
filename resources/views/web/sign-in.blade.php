@include('layouts.frontend')

<?php

$content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); ?>

<!--hero section start-->

<style>
  @media only screen and (max-width:768px){
    .login-signup-mobvw{
margin-bottom:100px !important
}
  }

</style>


<section class="position-relative">

  <div id="particles-js"></div>

  <div class="container">

    <div class="row  text-center">

      <div class="col spacing">

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


  </div>

</section>

<section>





 

  <div class="container">



    <div class="row">
<div class="col-lg-6 mb-2">
  
  <div class="imesfs">
    <img src="webassets/images/sign-in.png" class="img-fluid">
  </div>
</div>
      <div class="col-lg-6">

   <!-- <form  class="row form-desing-css" action="query/blogerlogin" method="post" enctype="multipart/form-data">
       
             <div class="form-group col-md-12">
                <input id="form_email" type="email" name="email" class="form-control" placeholder="Email"  data-error="Valid email is required." required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group col-md-12">
                <input id="form_email" type="password" name="password" class="form-control" placeholder="Password"  data-error="Valid Password is required." required>
                <div class="help-block with-errors"></div>
              </div>

              <div class="col-md-12  mt-12">

                <button class="btn btn-primary" type="submit"><span>Login</span>

                </button>

                </div>

                <div class="col-md-12 mt-2" >

                <div class="row">

                            <a href="signup-blog-user" style="display: flex; margin: auto;  color: #696969;" class="ordernow">
                             <span class="text-dark">Don't have an account!</span> 
                             Create an account
                             </a>
               </div>



              </div>

       </form> -->


        <div class="bg-white box-bg mt-4 mb-4 login-signup-mobvw">
                <form class="mt-4" action="query/blogerlogin" method="post" enctype="multipart/form-data" autocomplete="on">

                
<div class="form-group col-md-12">
  {{ csrf_field() }}
  @if (Session::has('successFlash'))
   <strong class="text-success alert alert-success">{!! Session::get('successFlash') !!}</strong>
  @endif
  @if (Session::has('errorFlash'))
   <strong class="text-danger alert alert-danger">{!! Session::get('errorFlash') !!}</strong>
 @endif
</div>
                    <label for="email" class="form-label label-heading">Email</label>
                    <input type="email" class="form-control form-holder" id="email" placeholder="Enter your email address" required>
                    <label for="password" class="form-label mt-3 label-heading">Password</label>
                    <input type="password" class="form-control form-holder" id="password" placeholder="Must be atleast 8 characters" required>
                   
                <p class="term-text mt-3 text-muted">By signing in, you agree to our <a href="https://www.ahecounselling.com/terms-conditions"><span class="text-primary">Terms and Conditions</span></a>.</p>
                
                <button class="sign-button w-100 px-5 py-2 mt-2 mb-2" type="submit"><span>Login <i class="bi bi-arrow-right"></i></span></button>
                <h6 class="text-center mt-4 text-muted">Don't have an account!<a href="signup-blog-user"><span class="text-primary"> Create an account</span></a></h6>

                <div class=""><h6 class="hr-lines mt-4">Or</h6></div>

                <div class="d-flex justify-content-center">
                    <img src="webassets/images/google.png" alt="Google" class="img-fluid google-icon">
                    <img src="webassets/images/facebook.png" alt="facebook" class="img-fluid google-icon fb-icon-left">
                </div>
                </form>
            
        </div>

    </div>

    </div>

    

  </div>

</section>



@include('layouts.frontfooter')