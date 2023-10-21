@include('layouts.frontend')

<?php  $serviceArray  = \App\Model\Entry\Service_model::makeArray(); ?>

<!--hero section start-->



<section class="position-relative">

  <div id="particles-js"></div>

  <div class="container">

    <div class="row  text-center">

      <div class="col">

        <h1>Contact Us</h1>

        <nav aria-label="breadcrumb">

          <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">

            <li class="breadcrumb-item"><a class="text-dark" href="#">Home</a>

            </li>

            <li class="breadcrumb-item active text-primary" aria-current="page">Contact Us</li>

          </ol>

        </nav>

      </div>

    </div>

    <!-- / .row -->

  </div>

  <!-- / .container -->

</section>



<!--hero section end--> 





<!--body content start-->



<div class="page-content">



<section>

  <div class="container">

    <div class="row text-center">

      <div class="col-lg-4 col-md-12">

        <div>

          <svg class="feather feather-map-pin" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#1360ef" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>

          <h4 class="mt-5">Address:</h4>
          
            <span class="text-black">3368 Wolf Pen Road, San Francisco, CA, 94107</span><br><br>

            <span class="text-black">86 Ocean Street, South Wales, SYDNEY(OZ). 2000</span><br><br>

            <span class="text-black">49 Kendell Streett, SHEFFIELD(UK). S1 8DS0</span><br><br>

            <!-- <span class="text-black">4680 Copperhead Road, Hartford, Connecticut(US). 06103</span> -->

        </div>

      </div>

      <div class="col-lg-4 col-md-6">

        <div>

          <svg class="feather feather-mail" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#1360ef" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>

          <h4 class="mt-5">Email Us</h4>

         <a href="mailto:info@ahecounselling.com"> info@ahecounselling.com</a>

        </div>

      </div>

      <div class="col-lg-4 col-md-6">

        <div>

          <svg class="feather feather-phone-call" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#1360ef" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>

          <h4 class="mt-5">Phone Number</h4>

         <a href="tel:+1-9178091207">+1-917 809 1207</a><br><br>

         <a href="tel:+91-8955009638">+91-89550 09638</a>

        </div>

      </div>

    </div>

  </div>

</section>



<section>





 

  <div class="container">

    <div class="row justify-content-center mb-5 text-center">

      <div class="col-12 col-lg-8">

        <div> <span class="badge badge-primary-soft p-2">

                 <img src="assets/images/fav.png" class="img-fluid rotation" width="50" alt="">

              </span>

          <h2 class="mt-4 mb-0">Drop A Line</h2>

          <p class="lead mb-0">Get in touch and let us know how we can help. Fill out the form and we’ll be in touch as soon as possible.</p>

        </div>

      </div>

    </div>

    <div class="row justify-content-center text-center">

      <div class="col-12 col-lg-10">

   <form id="contact-form" class="row" action="query/saveQuery" method="post" enctype="multipart/form-data">

            <div class="form-group col-md-12">

          {{ csrf_field() }}

          @if (Session::has('successFlash'))



                                                <strong class="text-success alert alert-success">{!! Session::get('successFlash') !!}</strong>



          @endif

           @if (Session::has('errorFlash'))



                                                <strong class="text-danger alert alert-danger">{!! Session::get('errorFlash') !!}</strong>



          @endif





</div>

            <div class="form-group col-md-6">

                <input id="form_name" type="text" name="en_first_name" class="form-control" placeholder="First Name"  required data-error="Name is required.">

                <div class="help-block with-errors"></div>

              </div>

              <div class="form-group col-md-6">

                <input id="form_name1" type="text" name="en_last_name" class="form-control" placeholder="Last Name"  data-error="Name is required." required>

                <div class="help-block with-errors"></div>

              </div>

              <div class="form-group col-md-12">

                <input id="form_email" type="text" name="en_email" class="form-control" placeholder="Email"  data-error="Valid email is required." required>

                <div class="help-block with-errors"></div>

              </div>

              <div class="form-group col-md-12">

                <input id="form_phone" type="tel" name="en_mobile" class="form-control" placeholder="Phone"  data-error="Phone is required" required>

                <div class="help-block with-errors"></div>

              </div>

              <div class="form-group col-md-6">



                <select class="form-control" name="en_service" required>

                  @foreach($serviceArray as $key =>$vs)

                  <option value="{{ $key }}">{{ $vs}} </option>

                  

                  @endforeach

                 

                </select>

              </div>

              <div class="form-group col-md-6">

                <input id="form_subject" type="tel" name="en_subject" class="form-control" placeholder="Subject"  data-error="Subject is required" required>

                <div class="help-block with-errors"></div>

              </div>

              <div class="form-group col-md-12">

                <textarea id="form_message" name="en_query" class="form-control" placeholder="Message" rows="4"  data-error="Please,leave us a message." required></textarea>

                <div class="help-block with-errors"></div>

              </div>

              <div class="col-md-6 text-left mt-4">

                <div class="input-file-container">  

                  <input class="input-file" id="my-file" type="file" name="en_attachment">

                  <label tabindex="0" for="my-file" class="input-file-trigger">Select a file...</label>

                </div>

              </div>

              <div class="col-md-6 text-right mt-4">

                <button class="btn btn-primary" type="submit"><span>Send Messages</span>

                </button>

              </div>

       </form>

    </div>

    </div>

    

  </div>

</section>







</div>



<!--body content end--> 



<!-- footer start -->

@include('layouts.frontfooter')