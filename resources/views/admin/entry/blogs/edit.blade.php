@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="assets/js/dzupload.js" defer></script>
  <script>
    $(document).ready(function($) {
          CKEDITOR.replace( 'blog_desc', {  }  );
         
    });
                       
                </script>
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
<?php


$imgDataUpload = array(
                         'data-upload-folder'=>'assets/uploads/blogs/',
                         'data-upload-url'=>route('ajaxuploadimage'),
                         'data-delete-url'=>route('deletefile'),
                         'data-inputname'=>'blog_image',
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
           {{ Form::bsText('blog_name',$row->blog_name,['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsText('image_alt',$row->image_alt,['label'=>'Img Alt','class'=>'form-control']) }}
       </div>
        <div class="col-md-12 ">
           {{ Form::bsText('youTubeLink',$row->youTubeLink,['label'=>'youTubeLink ID','class'=>'form-control']) }}
       </div>
          <div class="col-md-12 ">
           {{ Form::bsText('order_number',$row->order_number,['label'=>'order Number','class'=>'form-control']) }}
       </div>
      <div class="col-md-12 ">
           {{ Form::bsTextarea('blog_desc',$row->blog_desc,['label'=>$niceNames,'class'=>'form-control ckeditor']) }}
       </div>

       <div class="col-md-12 ">
          <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$uploadDatanof?>  data-upload-filekey="userfile">
                    <div class="dz-message needsclick">
                        Drop files here or click to upload.<br>
                    </div>   
                    <?php 
                    $value = $row->blog_image;
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
           {{ Form::bsSelect('blog_status',$statusDropdown,$row->blog_status,['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
         <div class="col-md-12 ">
           {{ Form::bsSelect('blog_comment',$statusDropdown,$row->blog_comment,['label'=>$niceNames,'class'=>'form-control']) }}
       </div>

        <div class="col-md-12 ">
           {{ Form::bsText('seo_tilte',$row->seo_tilte,['label'=>'Seo tilte','class'=>'form-control']) }}
       </div>

        <div class="col-md-12 ">
           {{ Form::bsText('seo_keyword',$row->seo_keyword,['label'=>'Seo keyword','class'=>'form-control']) }}
       </div>

        <div class="col-md-12 ">
           {{ Form::bsText('seo_description',$row->seo_description,['label'=>"Seo description",'class'=>'form-control']) }}
       </div>
        
         <div class="col-md-12 ">
                     
                     <?php if($row->questions!=null){ 


                      $questions = implode(json_decode($row->questions,true),'__');

                      $answers = implode(json_decode($row->answers,true),'__');

                       }else{

                        $questions=$answers=''; 


                         
                         } ?>





                 
           {{ Form::bsTextarea('questions',$questions,['label'=>'Question(__)','class'=>'form-control']) }}
       </div>

        <div class="col-md-12 ">
           {{ Form::bsTextarea('answers',$answers,['label'=>'Answers(__)','class'=>'form-control']) }}
       </div>
       

  
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}
@endsection
