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
@method('PUT')
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
foreach($docDataUpload as $key =>$val)
{
    $uploadDatanofDoc.=$key.'='.$val.'  ' ;
}



?>
<div class="row">


       <div class="col-md-12 ">
           {{ Form::bsText('services_name',$row->services_name,['label'=>$niceNames,'class'=>'form-control']) }}
       </div>

        <div class="col-md-12 ">
           {{ Form::bsText('amount',$row->amount,['label'=>'Amount','class'=>'form-control']) }}
       </div>

       <div class="col-md-12 ">
           {{ Form::bsText('type',$row->type,['label'=>'Type','class'=>'form-control']) }}
       </div>

         <div class="col-md-12 ">
           {{ Form::bsText('image_alt',$row->image_alt,['label'=>'Img Alt','class'=>'form-control']) }}
       </div>

       <div class="col-md-12 ">
           {{ Form::bsText('title',$row->title,['label'=>'Seo Title','class'=>'form-control']) }}
       </div>


       <div class="col-md-12 ">
           {{ Form::bsText('keyword',$row->keyword,['label'=>'Seo Keyword','class'=>'form-control']) }}
       </div>

       

        <div class="col-md-12 ">
           {{ Form::bsTextarea('description',$row->description,['label'=>'Seo Description','class'=>'form-control']) }}
       </div>
       
      <div class="col-md-12 ">
           {{ Form::bsTextarea('services_desc',$row->services_desc,['label'=>$niceNames,'class'=>'form-control ckeditor']) }}
       </div>

        <div class="col-md-12 ">
                     
           <?php if($row->questions!=null){ 


            $questions = implode(json_decode($row->questions,true),'__');

            $answers = implode(json_decode($row->answers,true),'__');

             }else{   $questions=$answers='';     } ?>
           {{ Form::bsTextarea('questions',$questions,['label'=>'Question(__)','class'=>'form-control']) }}
       </div>

        <div class="col-md-12 ">
           {{ Form::bsTextarea('answers',$answers,['label'=>'Answers(__)','class'=>'form-control']) }}
       </div>
       

       <div class="col-md-12 ">
        <label>Service Image</label>
          <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$uploadDatanof?>  data-upload-filekey="userfile">
                    <div class="dz-message needsclick">
                        Drop files here or click to upload.<br>
                    </div>   
                    <?php 
                    $value = $row->services_image;
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
        <label>Service Document</label>
          <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$uploadDatanofDoc?>  data-upload-filekey="userfile">
                    <div class="dz-message needsclick">
                        Drop files here or click to upload.<br>
                    </div>   
                    <?php 
                    $value = $row->services_files;
                     $img =$docDataUpload['data-upload-folder'] . $value;

                
                  if (!empty($value)) {

                        $img =  asset($img);
                      echo '<div class="dz-preview dz-processing dz-image-preview dz-complete">
                            <div class="dz-image">
                                <img data-dz-thumbnail="" alt="' .$value . '" src="' . $img. '">
                            </div>
                            <div class="dz-details">
                                <div class="dz-filename"><span data-dz-name="">' . $value . '</span></div>
                            </div>

                            <div class="dropzone-ajaxdata"><div class="dz-remove dz-deletefile" style="" title="Delete"><i class="fa fa-times"></i></div><input type="hidden" value="' . $value . '" class="dz-serveruploadfile" name="' . $docDataUpload['data-inputname'] . '"></div>
                       </div>';
                  }
                     ?> 
                    <div class="fallback">
                      <input type="file" name="userfile">
                       </div>

                </div></div> 
  <div class="col-md-12 ">
           {{ Form::bsSelect('services_status',$statusDropdown,$row->services_status,['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
      
       

  
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}
@endsection
