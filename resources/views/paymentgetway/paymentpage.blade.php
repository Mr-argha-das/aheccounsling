 @include('layouts.frontend')
<?php 
$serviceArray  = \App\Model\Entry\Service_model::makeArray(); 
?>
 
 <style type="text/css">
   .error{
    color: red;
   }
 </style>
 <section class="position-relative">

  <div id="particles-js"></div>

  <div class="container">

    <div class="row  text-center">

      <div class="col-md-12">

        <h3 class="mb-0 text-center">Place Your Order</h3>
                <p class="mb-0 text-center">It's Fast, Secure & Confidential</p>

      </div>

         <div class="col-md-12">
            <div class="form-group col-md-12">
              @if (Session::has('successFlash'))
                  <strong class="text-success alert alert-success">{!! Session::get('successFlash') !!}</strong>
              @endif
            @if (Session::has('errorFlash'))
            <strong class="text-danger alert alert-danger">{!! Session::get('errorFlash') !!}</strong>
            @endif
         </div>
       </div>

    </div>

  </div>
 </section>

   <div class="container">

     <div class="row justify-content-center text-center">

      <div class="col-12 col-lg-10">

            <form  class="row" action="{{route('savePaymentDetails')}}" id="payment_details"  method="post" enctype="multipart/form-data">
               {{ csrf_field() }}
              <div class="form-group col-md-6">
                  <label class="text-right" for="firstname"><strong>First Name </strong> <spane class="text-danger">*</spane></label>
                 <input id="firstname" type="text" name="firstname" class="form-control"  placeholder="First Name">
                 @if ($errors->has('firstname'))
                    <span class="text-danger">{{ $errors->first('firstname') }}</span>
                @endif
              </div>

              <div class="form-group col-md-6">
                <label for="Lastname">Last Name</label>
                 <input id="Lastname" type="text" name="Lastname" class="form-control" placeholder="Last Name">
              </div>
              
              <div class="form-group col-md-6">
                <label for="email"><strong> Email </strong> <spane class="text-danger">*</spane></label>
                 <input id="email" type="text" name="email" class="form-control" placeholder="Email">
                   @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
              </div>

              <div class="form-group col-md-6">
                 <label for="phone"><strong>Mobile/Cell Number </strong><spane class="text-danger">*</spane></label>
                 <input id="phone" type="text" name="phone" class="form-control" placeholder="Mobile/Cell Number">
                 @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
              </div>

              <div class="form-group col-md-6 d-none">
                <label for="address1">Address1 </label>
                 <input id="address1" type="text" name="address1" value="address" class="form-control" placeholder="Address1">
              </div>

              <div class="form-group col-md-6 d-none">
                 <label for="address2">Address2</label>
                 <input id="address2" type="text" name="address2" class="form-control" placeholder="Address2">
              </div>

              <div class="form-group col-md-6 d-none">
                <label for="Zipcode">Zipcode</label>
                 <input id="Zipcode" type="text" name="Zipcode" value="" class="form-control" placeholder="Zipcode">
              </div>

              <div class="form-group col-md-6 d-none">
                <label for="city">City</label>
                 <input id="city" type="text" name="city" class="form-control" placeholder="city">
              </div>

               <div class="form-group col-md-6 d-none">
                <label for="state">State</label>
                 <input id="state" type="text" name="state" class="form-control" placeholder="state">
              </div>

               <div class="form-group col-md-6 d-none">
                 <label for="country">Country</label>
                 <input id="country" type="text" name="country" class="form-control" placeholder="country">
              </div>
              
               <div class="form-group col-md-6">
                  <label><strong> Payable  Amount {{$type}}</strong> <spane class="text-danger">*</spane></label>
                 <input type="text" name="payable_amount"  id="payable_amount" class="form-control" placeholder="Payable Amount">
                 @if ($errors->has('payable_amount'))
                    <span class="text-danger">{{ $errors->first('payable_amount') }}</span>
                @endif
              </div>

                <div class="col-md-6 d-none">
                  <label for="productinfo"><strong> Service Type</strong> <spane class="text-danger">*</spane></label>
                  <select name="productinfo" id="productinfo" > 
                    <option value="">Service Type</option>
                    @foreach($serviceArray as $key =>$vs)
                    <option selected value="{{ $key }}">{{ $vs}} </option>
                    @endforeach
                 </select>
                   @if ($errors->has('productinfo'))
                    <span class="text-danger">{{ $errors->first('productinfo') }}</span>
                @endif
              </div>
                
              <div class="col-md-12  mt-12">

               <button class="btn btn-primary" type="submit"><span>Submit</span>

              </button>

            </div>

       </form>

    </div>

    </div>

  </div>
 

 @section('javascript')

 
   <script type="text/javascript">
     
    $(document).ready(function(){
       $('#payment_details').validate({

                   onfocusout: function(element) {$(element).valid()}
                         , rules: {

                     "firstname": {
                         required: true,
                         pattern: /^[a-zA-Z'.\s]{1,40}$/,
                         maxlength: 30,
                         minlength: 2,
                     },"email":{
                        required: true,
                        email: true,
                     },"phone": {
                         required: true,
                         number: true,
                      },"payable_amount": {
                         required: true,
                         number: true,
                      },"productinfo": {
                         required: true,
                      },
                  },
                  messages: {
                    "firstname": {
                         required: "First Name is required",
                         minlength: "First Name must contain at least {2} characters",
                         maxlength: "First Name must contain only {30} characters",
                         pattern: 'Only Characters are allowed',
                     },
                      "email":{
                        required: 'Email Address is required',
                        email: 'Please Enter a Valid Email Address',
                     },"phone": {
                         required: "Phone No is required",
                         number: "Only number are allowed",
                      },"payable_amount": {
                         required: "Payable Amount  is required",
                         number: "Only number are allowed",
                      } 
                    
                  },
                 });
          });
   
   </script>
  @endsection


<!--body content end--> 



<!-- footer start -->

@include('layouts.frontfooter')