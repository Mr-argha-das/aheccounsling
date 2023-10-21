@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction,'files' => true)) }}
<script type="text/javascript" src="{{ asset('/js/fileupload.js') }} "></script>
<script type="text/javascript" src="{{ asset('/js/imageupload.js') }} "></script>
<?php 
$documentuploadInfo = array(
                         'data-upload-path'=>'assets/uploads/customer',
                         'data-upload-url'=>route('ajaxUploadFile'),
                         'data-delete-url'=>route('deletefile'),
                         'data-name'=>'multi_customer_doc_name',
                         'data-title'=>'multi_customer_doc_title',
                     );
$uploadData =NULL;
foreach($documentuploadInfo as $key =>$val)
{
    $uploadData.=$key.'='.$val.'  ' ;
}


$imgDataUpload = array(
                         'data-upload-path'=>'assets/uploads/customer',
                         'data-upload-url'=>route('ajaxuploadimage'),
                         'data-delete-url'=>route('deletefile'),
                         'data-name'=>'cus_upload_pic',
                         'data-type'=>2, /// 2 for image and picture upload  , 1 for document and iamges//
                     );
$uploadDatanof =NULL;
foreach($imgDataUpload as $key =>$val)
{
    $uploadDatanof.=$key.'='.$val.'  ' ;
}

?>

<div class="row">

    <div class="col-md-12">
        
        <b>Personal Infomation</b>
        <hr />
    </div>

    <div class="col-md-4 ">
        {{ Form::bsText('cus_name','',['label'=>$niceNames]) }}
    </div>
      <div class="col-md-4 ">
        {{ Form::bsSelect('cus_family',$FamilyList,'',['label'=>$niceNames]) }}
    </div>

  <div class="col-md-4 ">
        {{ Form::bsText('cus_mobile','',['label'=>$niceNames]) }}
    </div>

  <div class="col-md-4 ">
        {{ Form::bsText('cus_alt_mobile','',['label'=>$niceNames]) }}
    </div>
      <div class="col-md-8">
        {{ Form::bsTextarea('cus_address','',['label'=>$niceNames]) }}
    </div>

  <div class="col-md-4 ">
        {{ Form::bsText('cus_email','',['label'=>$niceNames]) }}
    </div>



  <div class="col-md-4 ">
        {{ Form::bsText('cus_dob','',['label'=>$niceNames,'class'=>'datepicker']) }}
    </div>

  <div class="col-md-4 ">
        {{ Form::bsText('cus_doa','',['label'=>$niceNames,'class'=>'datepicker']) }}
    </div>

  <div class="col-md-4 ">
        {{ Form::bsText('cus_pan','',['label'=>$niceNames]) }}
    </div>

  <div class="col-md-4 ">
        {{ Form::bsText('cus_addhar','',['label'=>$niceNames]) }}
    </div>


  <div class="col-md-4 ">
        {{ Form::bsText('cus_kyc_docs','',['label'=>$niceNames]) }}

    </div>
    <div class="col-md-4">
 
      {{ Form::bsSelect('cus_category',$categorylis,'',['label'=>$niceNames]) }}
  </div>
 <div class="col-md-4">
 
      {{ Form::bsSelect('cus_team_id',$teamList,'',['label'=>$niceNames]) }}
  </div>
    <div class="col-md-4 ">
        
        <label>Upload Profile Photo</label>
        <input type="file" class="form-control uploadimage " name="userfile" {{ $uploadDatanof }}><br/>
        
        <div class="imgupload">
        
        </div>
          <div class="progress def-progress mt-3 mb-2" style="display: none;">
                  <div class="progress-bar active  def-progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">60%</div>
                </div>
        <div class="imgupload-error"></div>
    </div>
</div>
<div class="container mt-3">
<div class="row alert alert-info atlifno">
  <div class="col-md-12 bg-rd"><strong>Bank Detials</strong></div><hr/>
  <div class="col-md-3 ">
        {{ Form::bsText('cus_first_bank_name','',['label'=>$niceNames]) }}
    </div>

  <div class="col-md-3 ">
        {{ Form::bsText('cus_first_bank_ifsc','',['label'=>$niceNames]) }}
    </div>

  <div class="col-md-3 ">
        {{ Form::bsText('cus_first_bank_branch','',['label'=>$niceNames]) }}
    </div>

  <div class="col-md-3 ">
        {{ Form::bsText('cus_first_bank_account','',['label'=>$niceNames]) }}
    </div>
</div>
<div class="row alert alert-info atlifno" >
  <div class="col-md-12 bg-rd" ><strong>Other Bank Detials</strong></div><hr/>
    <div class="col-md-3 ">
        {{ Form::bsText('cus_second_bank_name','',['label'=>$niceNames]) }}
    </div>

  <div class="col-md-3 ">
        {{ Form::bsText('cus_second_bank_ifsc','',['label'=>$niceNames]) }}
    </div>

  <div class="col-md-3 ">
        {{ Form::bsText('cus_second_bank_branch','',['label'=>$niceNames]) }}
    </div>
  <div class="col-md-3 ">
        {{ Form::bsText('cus_second_bank_account','',['label'=>$niceNames]) }}
    </div>


</div>
<div class="row docs">
  
            <div class="col-md-6">
                <label for="">Upload Document</label>
                <input type="file" name="userfile" class="form-control form-control-file uploadfile" {{ $uploadData }} multiple>
               <div class="progress mt-3 mb-2" style="display: none;">
                  <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">60%</div>
                </div>
            </div>
            <div class="col-md-6">
               <div class="preview" style="margin-top: 26px;" >
                   
               </div>
           </div>
      
</div>
</div>
<div class="row">
    <div class="col-md-12 mt-2">
        {{ Form::bsSubmit() }}
    </div>
</div>

{{ Form::close() }}
@endsection

<style type="text/css">

</style>