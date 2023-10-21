  @extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])

<?PHP
$serviceArray  = \App\Model\Entry\Service_model::makeArray();
$rmidlist  = \App\Model\Entry\RegisterMember_model::makeArray();
$countryCode = \App\Model\Country_model::pluck('phonecode','id');
$currencyList = \App\Model\Entry\Currency_model::get();
  ?>
  <style type="text/css">
    .error{
  color:#f64a08eb !important;
}
  </style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="assets/js/dzupload.js" defer></script>
  
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction,'id'=>"msform-order")) }}
@method('PUT')
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
         <div class="col-md-6 d-none" >
           <label class="control-label">Client List</label>
           <select   id="client_list" name="user_email" class="form-control form-control-lg"> 
               <option value="">Select client</option>
               @foreach($client_list as  $client)
               <option  <?php if($client->user_email==$edit_data->en_email){ echo 'selected'; } ?> value="{{$client->user_email}}">{{$client->user_name}}  ({{$client->user_password}})</option>
               @endforeach
          </select>
       </div>

       <div class="col-md-6">
         <label class="control-label">Payment type</label>
          <select  name="payment_type" id="payment_type"  class="form-control form-control-lg"> 
                <option value="">Select payment type</option>
                <option <?php if($edit_data->payment_type=='Full payment'){ echo 'selected'; } ?> value="Full payment">Full payment</option>
                <option <?php if($edit_data->payment_type=='Partial payment'){ echo 'selected'; } ?> value="Partial payment">Partial payment</option>
                <option <?php if($edit_data->payment_type=='Remaining payment'){ echo 'selected'; } ?> value="Remaining payment">Remaining payment</option>
            </select> 
        </div>

        <div class="col-md-6">
               <label class="control-label">Service Type</label>
                <select  name="en_service" id="en_service"  class="form-control form-control-lg" required> 
                      <option value="">Service Type</option>
                        @foreach($serviceArray as $key =>$vs)
                        <option <?php if($edit_data->en_service==$key){ echo 'selected'; } ?> value="{{ $key }}">{{ $vs}} </option>
                        @endforeach
                   </select>
         </div>
        
         <div class="col-md-6">
           <label class="control-label">Module code</label>
           <input type="text" name="modal_en_subject" readonly value="<?php echo $edit_data->en_subject ?>" class="form-control form-control-lg" id="modal_en_subject"  placeholder="">
        </div>
        <div class="col-md-6">
           <label class="control-label">Module Name</label>
           <input type="text" name="modal_en_module_name" readonly value="<?php echo $edit_data->module_name ?>" class="form-control form-control-lg" id="modal_en_module_name"  placeholder="">
        </div>

      <!--  <div class="col-md-6">
          <label class="control-label">RM ID</label>
          <select    name="rm_id" id="rm_id_select2"  class="form-control form-control-lg" required>
            <option value="">SELECT RM Id</option>
            @foreach($rmidlist as $rm_id => $rmusername)
            <option <?php if($edit_data->rm_id==$rm_id){  echo 'selected'; } ?> value="{{ $rm_id }}">{{ $rmusername }}</option>
            @endforeach
        </select>
      </div> -->


      <div class="col-md-6">
           <label class="control-label">Deadline</label>
           <input type="text" name="deadline" class="form-control form-control-lg" id="deadline" readonly value ="<?php echo date('d-M-Y',strtotime($edit_data->deadline)) ?>"  placeholder="">
        </div>

       <div class="col-md-6">
           <label class="control-label">Word Count</label>
           <input type="text" name="word_count" class="form-control form-control-lg numbers" id="word_count"  value="<?php echo $edit_data->word_count ?>"  placeholder="">
        </div>

        <div class="col-md-6">
           <label class="control-label">Type</label>
           <input type="text" name="assignment_type" class="form-control form-control-lg" id="assignment_type"  value="<?php echo $edit_data->assignment_type ?>"  placeholder="Report/PPT">
        </div>

        <div class="col-md-6">
               <label class="control-label">Currency</label>
                <select  name="currency_type" id="currency_type"  class="form-control form-control-lg"> 
                      <option value="">Service Type</option>
                        @foreach($currencyList as $key =>$currency)
                        <option <?php if($edit_data->currency_type==$currency->currency_id){ echo 'selected'; } ?> value="{{ $currency->currency_id }}">{{$currency->currency_code}}({{$currency->currency_symbol}})</option>
                        @endforeach
                   </select>
         </div>

          <div class="col-md-6">
           <label class="control-label">Client Amount (Selected Currency)</label>
           <input type="text" name="client_amount" class="form-control form-control-lg" id="client_amount"  value="<?php echo $edit_data->client_amount ?>"  placeholder="Client amount">
        </div>

        <div class="col-md-6">
           <label class="control-label">INR Amout</label>
           <input type="text" name="inr_amount" class="form-control form-control-lg" id="inr_amount"  value="<?php echo $edit_data->inr_amount ?>"  placeholder="INR amount">
        </div>

        <div class="col-md-6">
           <label class="control-label">AUD Amout</label>
           <input type="text" name="aud_amount" class="form-control form-control-lg" id="aud_amount"  value="<?php echo $edit_data->aud_amount ?>"  placeholder="AUD amount">
        </div>

       <div class="col-md-12">
           <label class="control-label">Short Note</label>
         <textarea id="modal_en_query" class="form-control form-control-lg" name="modal_en_query" rows="5" placeholder=""><?php echo $edit_data->en_query ?></textarea>
     </div>

        <div class="col-md-12">
          <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$uploadDatanof?>  data-upload-filekey="userfile">
                    <div class="dz-message needsclick">
                        Drop files here or click to upload.<br>
                    </div>   
                    <?php 
                    $value = $edit_data->Screenshot;
                     $img =$imgDataUpload['data-upload-folder'] . $value;

                
                  if (!empty($value)) {

                        $img =  asset($img);
                      echo '<div class="dz-preview dz-processing dz-image-preview dz-complete">
                            <div class="dz-image">
                                <img data-dz-thumbnail="" alt="' .$value . '" src="' . $img. '">
                            </div>
                            <div class="dz-details">
                                <div class="dz-filename"><span data-dz-name="">' . $value . '</span></div>
                            </div>

                            <div class="dropzone-ajaxdata"><div class="dz-remove dz-deletefile" style="" title="Delete"><i class="fa fa-times"></i></div><input type="hidden" value="' . $value . '" class="dz-serveruploadfile" name="' . $imgDataUpload['data-inputname'] . '"></div>
                       </div>';
                  }
                     ?> 
                    <div class="fallback">
                      <input type="file" name="userfile">
                       </div>

                </div></div>
            
      <div class="col-md-12 ">
        {{ Form::bsSubmit() }}
      </div>

{{ Form::close() }}




  <script type="text/javascript"> 

 $(document).ready(function(){
   
    $("#deadline").datepicker({            
      
     });

   $('#client_list,#en_service,#currency_type').select2();
   
     $('#msform-order').validate({

        onfocusout: function(element) {$(element).valid()}
        , rules: {
        "modal_en_subject": {
          required: true,
      }, "modal_en_query": {
          required: true,
          maxlength: 200,
          minlength: 6,
      } ,"payment_type": {
          required: true,
      },"modal_en_module_name": {
          required: true,
      },"assignment_type": {
          required: true,
      },"word_count": {
          required: true,
      },"currency_type": {
          required: true,
      },"aud_amount": {
          required: true,
      },"client_amount": {
          required: true,
      },"inr_amount": {
          required: true,
      },"deadline": {
          required: true,
      },
  },
  messages: {
   "modal_en_module_name": {
      required: "Module name is required",
  },"payment_type": {
      required: "Payment type is required",
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

