@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<style type="text/css">
  .error{
    color: red;
  }
</style>
<?php 
use \App\Model\Country_model as countryModel;
$countryCode = countryModel::pluck('phonecode','id');
?>
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://www.ahecounselling.com/admin/assets/js/dzupload.js" defer></script>
  
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
<?php


        $imgDataUpload = array(
                         'data-upload-folder'=>'assets/uploads/flregistration/',
                         'data-upload-url'=>route('ajaxuploadimage'),
                         'data-delete-url'=>route('deletefile'),
                         'data-inputname'=>'idproof',
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
           {{ Form::bsText('fl_name',$row->af_name,['label'=>'Full Name','class'=>'form-control']) }}
       </div>
        <div class="col-md-6">
           {{ Form::bsText('fl_email',$row->af_email,['label'=>'Email','class'=>'form-control']) }}
       </div>

        <div class="col-md-6">
         <label class="control-label">Country Code</label>
          <select class="form-control form-control-lg" name="fl_country_code" required >
               @foreach($countryCode as $key =>$vs)
               <option <?php if($vs==$row->country_code) echo 'selected' ?> value="{{$vs }}">+{{ $vs}} </option>
               @endforeach
         </select>
       </div>

       <div class="col-md-6">
           {{ Form::bsText('fl_mobile',$row->af_mobile,['label'=>'Mobile','class'=>'form-control']) }}
       </div>

       <div class="col-md-6">
           {{ Form::bsText('fl_alternate_number',$row->fl_alternate_number,['label'=>'Alternate Contact Number','class'=>'form-control']) }}
       </div>

       <div class="col-md-6">
           {{ Form::bsText('aadhar_number',$row->aadhar_number,['label'=>'Aadhar Number','class'=>'form-control']) }}
       </div>

       <div class="col-md-6">
           {{ Form::bsText('pan_number',$row->pan_number,['label'=>'Pan Number','class'=>'form-control']) }}
       </div>

        <div class="col-md-6">
           {{ Form::bsText('fl_address',$row->af_address,['label'=>'Address','class'=>'form-control']) }}
       </div>

       <div class="col-md-6">
           {{ Form::bsText('bank_name',$row->bank_name,['label'=>'Bank Name','class'=>'form-control']) }}
       </div>

       <div class="col-md-6">
           {{ Form::bsText('bank_no',$row->bank_no,['label'=>'Account Number','class'=>'form-control']) }}
       </div>

       <div class="col-md-6">
           {{ Form::bsText('bank_ifsc',$row->bank_ifsc,['label'=>'Bank IFSC Code','class'=>'form-control']) }}
       </div>
       <div class="col-md-6">
           {{ Form::bsText('bank_branch',$row->bank_branch,['label'=>'Bank Branch','class'=>'form-control']) }}
       </div>
      <div class="col-md-12 ">
        {{ Form::bsSubmit() }}
      </div>

{{ Form::close() }}
  
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
@endsection
