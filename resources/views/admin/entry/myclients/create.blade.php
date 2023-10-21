   @extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])

 <?php 
 $rmidlist  = \App\Model\Entry\RegisterMember_model::makeArray();
 $countryCode = \App\Model\Country_model::pluck('phonecode','id');
 ?>
  <style type="text/css">
    .error{
  color:#f64a08eb !important;
}
  </style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="assets/js/dzupload.js" defer></script>
  
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction,'id'=>"msform-order")) }}
 
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
                          @foreach($countryCode as $key =>$vs)
                         <option <?php if($vs==91) echo 'selected' ?>  value="{{$vs }}">+{{ $vs}} </option>
                         @endforeach 
                         
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
            @foreach($rmidlist as $rm_id => $rmusername)
            <option  <?php if($rm_id_selected==$rm_id) echo 'selected'; ?> value="{{ $rm_id }}">{{ $rmusername }}</option>
            @endforeach
        </select>
      </div>
     
         
      <div class="col-md-12 ">
        {{ Form::bsSubmit() }}
      </div>

 {{ Form::close() }}

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
            url: "{{route('varifyemail')}}",
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
            url: "{{route('varifyphone')}}",
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

@endsection

