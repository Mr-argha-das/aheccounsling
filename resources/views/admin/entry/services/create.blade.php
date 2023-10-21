@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<meta name="csrf-token" content="{{ csrf_token() }}" />
  
    <script src="assets/js/dzupload.js" defer></script>
   <script>
    $(document).ready(function($) {
         CKEDITOR.replace( 'services_desc', {  }  );
         // CKEDITOR.replace( 'menu_slider_text', { allowedContent: 'p' }  );
         
    });
                       
                </script>
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
<?php


$imgDataUpload = array(
                         'data-upload-folder'=>'assets/uploads/services/',
                         'data-upload-url'=>route('ajaxuploadimage'),
                         'data-delete-url'=>route('deletefile'),
                         'data-inputname'=>'services_image',
                         'data-upload-type'=>'image',
                         'data-upload-maxfiles'=>1
                        
                     );
$uploadDatanof =NULL;
foreach($imgDataUpload as $key =>$val)
{
    $uploadDatanof.=$key.'='.$val.'  ' ;
}


$docDataUpload = array(
                         'data-upload-folder'=>'assets/uploads/services/',
                         'data-upload-url'=>route('ajaxuploadimage'),
                         'data-delete-url'=>route('deletefile'),
                         'data-inputname'=>'services_files',
                         'data-upload-type'=>'Document',
                         'data-upload-maxfiles'=>1
                        
                     );
$uploadDatanofDoc =NULL;
foreach($docDataUpload as $key =>$val){
  
    $uploadDatanofDoc.=$key.'='.$val.'  ' ;
}


?>
<div class="row">

      <div class="col-md-12 ">
           {{ Form::bsText('services_name','',['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsText('image_alt','',['label'=>'Img Alt','class'=>'form-control']) }}
       </div>

       <div class="col-md-12 ">
           {{ Form::bsText('amount','',['label'=>'Amount','class'=>'form-control']) }}
       </div>

       <div class="col-md-12 ">
           {{ Form::bsText('type','',['label'=>'Type','class'=>'form-control']) }}
       </div>

        <div class="col-md-12 ">
           {{ Form::bsText('title','',['label'=>'Seo Title','class'=>'form-control']) }}
       </div>


       <div class="col-md-12 ">
           {{ Form::bsText('keyword','',['label'=>'Seo Keyword','class'=>'form-control']) }}
       </div>

       

        <div class="col-md-12 ">
           {{ Form::bsTextarea('description','',['label'=>'Seo Description','class'=>'form-control']) }}
       </div>
      
       <div class="col-md-12 ">
           {{ Form::bsTextarea('services_desc','',['label'=>$niceNames,'class'=>'form-control ckeditor']) }}
       </div>
       <div class="col-md-12 ">
        <label>Service Image</label>
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
        <label>Service Document</label>
        <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$uploadDatanofDoc?>  data-upload-filekey="userfile">
                        <div class="dz-message needsclick">
                            Drop files here or click to upload.<br>
                        </div>     
                        <div class="fallback">
                          <input type="file" name="userfile">
                          </div>

            </div>
         </div>
           <div class="col-md-12 ">
           {{ Form::bsSelect('services_status',$statusDropdown,'',['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
   
        <div class="col-md-12 ">
        {{ Form::bsSubmit() }}
      </div>

{{ Form::close() }}
@endsection
