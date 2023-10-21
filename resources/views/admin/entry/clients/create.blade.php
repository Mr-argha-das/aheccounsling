@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])

<?PHP
$serviceArray  = \App\Model\Entry\Service_model::makeArray();
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

      <div class="col-md-6">
           <label class="control-label">User Type</label>
           <select  name="user_type" id="user_type" class="form-control form-control-lg"> 
               <option value="">Select user type</option>
               <option selected value="1">New User</option>
               <option value="2">Existing User</option>
          </select>
       </div>

         <div class="col-md-6 d-none client_list" >
           <label class="control-label">Client List</label>
           <select   id="client_list" class="form-control form-control-lg"> 
               <option value="">Select client</option>
               @foreach($client_list as  $client)
               <option  value="{{$client->user_email}}">{{$client->user_name}}</option>
               @endforeach
          </select>
       </div>
       <div class="col-md-6 d-none client_list">
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

         <div class="col-md-6 d-none">
           <label class="control-label">Payment type</label>
            <select  name="payment_type" id="payment_type"  class="form-control form-control-lg"> 
                  <option value="">Select payment type</option>
                  <option value="Full payment">Full payment</option>
                  <option value="Partial payment">Partial payment</option>
                  <option value="Remaining payment">Remaining payment</option>
              </select> 
          </div>

          


       <!-- <div class="col-md-6">
               <label class="control-label">Order type</label>
               <select  name="order_type" id="order_type"  class="form-control form-control-lg"> 
                  <option value="">Select Order type</option>
                  <option selected value="1">New Order</option>
                  <option value="2">Existing Order</option>
                </select>
       </div>
       <div class="col-md-6">
          <label class="control-label">Order id</label>
            <select class="form-control form-control-lg" name="pre_order_id" id="pre_order_id" > 
                <option value="">Select order id </option>
            </select>
        </div> -->
      
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

                    <input type="number" class="border-0" class="form-control form-control-lg"   id="modal_en_mobile" value="" name="modal_en_mobile"  placeholder="Mobile No." />
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
               <label class="control-label">Service Type</label>
                <select  name="en_service" id="en_service"  class="form-control form-control-lg"> 
                      <option value="">Service Type</option>
                        @foreach($serviceArray as $key =>$vs)
                        <option value="{{ $key }}">{{ $vs}} </option>
                        @endforeach
                   </select>
        </div>
        
         <div class="col-md-6">
           <label class="control-label">Module code</label>
           <input type="text" name="modal_en_subject" class="form-control form-control-lg" id="modal_en_subject"  placeholder="Module code">
        </div>
        <div class="col-md-6">
           <label class="control-label">Module Name</label>
           <input type="text" name="modal_en_module_name" class="form-control form-control-lg" id="modal_en_module_name"  placeholder="Module name">
        </div>

         <div class="col-md-6">
           <label class="control-label">Deadline</label>
           <input type="date" name="deadline" class="form-control form-control-lg" id="deadline"  placeholder="deadline">
        </div>

         <div class="col-md-6">
           <label class="control-label">Word Count</label>
           <input type="number" name="word_count" class="form-control form-control-lg" id="word_count"  placeholder="Word Count">
        </div>
        <div class="col-md-6">
           <label class="control-label">Univercity name</label>
           <input type="text" name="univercity_name" class="form-control form-control-lg" id="univercity_name"  placeholder="univercity name">
        </div>
        <div class="col-md-6">
          <label class="control-label">RM ID</label>
          <select    name="rm_id"  class="form-control form-control-lg">
            <option value="">SELECT RM Id</option>
            @foreach($rmidlist as $rm_id => $rmusername)
            <option  value="{{ $rm_id }}">{{ $rmusername }}</option>
            @endforeach
        </select>
      </div>
          <div class="col-md-12">
           <label class="control-label">Short Note</label>
         <textarea id="modal_en_query" class="form-control form-control-lg" name="modal_en_query" rows="5" placeholder="Message"></textarea>
     </div>
       <div class="col-md-12 ">
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
            
      <div class="col-md-12 ">
        {{ Form::bsSubmit() }}
      </div>

{{ Form::close() }}




  <script type="text/javascript"> 

   $(document).ready(function(){

      $("#user_type").change(function(){
         if($(this).val()==2){
             $("#modal_en_module_name,#country_code,#modal_en_mobile,#modal_en_query,#modal_en_query,#modal_en_subject,#en_service,#modal_en_email,#modal_en_last_name,#modal_en_first_name").prop('readonly', true);
           $('.client_list').removeClass('d-none');
          }else{
            $("#modal_en_module_name,#country_code,#modal_en_mobile,#modal_en_query,#modal_en_query,#modal_en_subject,#en_service,#modal_en_email,#modal_en_last_name,#modal_en_first_name").removeAttr("readonly");
            if (!$(".client_list").hasClass("d-none")) {
             $('.client_list').addClass('d-none');
           }
          }
       });

      $("#client_list").change(function(){ 
         var client_email =$(this).val();
          $('#pre_order_id').html("");
        $.ajax({
            type: 'POST',
            url: "{{ url('/') }}/query/searcholduser",
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
    url: "{{ url('/') }}/query/searcholduserdetails",
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
     data: {"pre_order_id":pre_order_id},  
     dataType: "json",
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

                   $('#rm_id_check_value').val(data.rm_id);
                   $('#modal_en_query').val(data.en_query);
                   $('#modal_en_subject').val(data.en_subject);
                   $('#en_service').val(data.en_service);
                   $('#modal_en_module_name').val(data.module_name);
                   $("#modal_en_query,#modal_en_subject,#en_service,#modal_en_module_name").prop('readonly', true);
                 
              } 

         },
     });

});
    
     $("#order_type").change(function(){
       if($(this).val()==2){
            $('#on_update_order_type').removeClass('d-none');
       }else{
           $('#on_update_order_type').addClass('d-none');
       }
   });
      
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
            url: "https://www.ahecounselling.com/query/varifyemail",
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
          minlength: 10,
          maxlength: 10,
          remote:{
            url: "https://www.ahecounselling.com/query/varifyphone",
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
      },"deadline": {
          required: true,
      },"word_count": {
          required: true,
      },"univercity_name": {
          required: true,
      },"en_service": {
          required: true,
      },"rm_id": {
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
      minlength: "Phone No must contain {10} digit Number",
      maxlength: "Phone No must contain {10} digit Number",
      remote:"This phone no. is already registered | Select user type existing user"
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
   remote:"This email is already registered | Select user type existing user"
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

@endsection

