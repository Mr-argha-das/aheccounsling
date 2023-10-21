@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<meta name="csrf-token" content="{{ csrf_token() }}" />
   <script src="assets/js/dzupload.js" defer></script>
 <script>
    $(document).ready(function($) {
         CKEDITOR.replace( 'about_desc', { allowedContent: 'p' }  );
         
    });
                       
                </script>
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
<?php


$imgDataUpload = array(
                         'data-upload-folder'=>'assets/uploads/aboutus/',
                         'data-upload-url'=>route('ajaxuploadimage'),
                         'data-delete-url'=>route('deletefile'),
                         'data-inputname'=>'about_image',
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


         <div class="col-md-12 ">
           {{ Form::bsText('about_name',$row->about_name,['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
      <div class="col-md-12 ">
           {{ Form::bsTextarea('about_desc',$row->about_desc,['label'=>$niceNames,'class'=>'form-control ckeditor']) }}
       </div>

       <div class="col-md-12 ">
        <label>Service Image</label>
          <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$uploadDatanof?>  data-upload-filekey="userfile">
                    <div class="dz-message needsclick">
                        Drop files here or click to upload.<br>
                    </div>   
                    <?php 
                    $value = $row->about_image;
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
           {{ Form::bsSelect('about_status',$statusDropdown,$row->about_status,['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
      
       

  
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}
@endsection
