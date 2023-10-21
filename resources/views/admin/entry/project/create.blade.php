 @extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="assets/js/dzupload.js" defer></script>
<script>
   $(document).ready(function($) {
        CKEDITOR.replace( 'description', {  }  );
        // CKEDITOR.replace( 'menu_slider_text', { allowedContent: 'p' }  );
        
   });
                      
</script>
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction,'enctype'=>'multipart/form-data')) }}
<?php 
   $imgDataUpload = array(
              'data-upload-folder'=>'assets/uploads/projectthumb/',
              'data-upload-url'=>route('ajaxuploadimage'),
              'data-delete-url'=>route('deletefile'),
              'data-inputname'=>'thub_img',
              'data-upload-type'=>'image',
              'data-upload-maxfiles'=>1
             
          );
   $thub_img =NULL;
   
   foreach($imgDataUpload as $key =>$val)
   {
     $thub_img.=$key.'='.$val.'  ' ;
   }
   
   
   $imgDataUpload = array(
                          'data-upload-folder'=>'assets/uploads/projectdoc/',
                          'data-upload-url'=>route('ajaxuploadimage'),
                          'data-delete-url'=>route('deletefile'),
                          'data-inputname'=>'img_1',
                          'data-upload-type'=>'Document',
                          'data-upload-maxfiles'=>1
                         
                      );
   $img_1 =NULL;
   foreach($imgDataUpload as $key =>$val){
   
     $img_1.=$key.'='.$val.'  ' ;
   }
   
   $imgDataUpload = array(
              'data-upload-folder'=>'assets/uploads/projectdoc/',
              'data-upload-url'=>route('ajaxuploadimage'),
              'data-delete-url'=>route('deletefile'),
              'data-inputname'=>'img_2',
              'data-upload-type'=>'Document',
              'data-upload-maxfiles'=>1
           );
   $img_2 =NULL;
   foreach($imgDataUpload as $key =>$val){
     $img_2.=$key.'='.$val.'  ' ;
   }
   
   
   ?>
<div class="row">
   <div class="col-md-12 ">
      {{ Form::bsSelect('project_categroy_id',$category,'',['label'=>'Project-Category','class'=>'form-control']) }}
   </div>
   <div class="col-md-12 ">
      {{ Form::bsText('title','',['label'=>'Title','class'=>'form-control']) }}
   </div>
   <div class="col-md-12 ">
      {{ Form::bsText('no_of_page','',['label'=>'No of Page','class'=>'form-control']) }}
   </div>
   <div class="col-md-12 ">
      {{ Form::bsText('word_count','',['label'=>'Word Count','class'=>'form-control']) }}
   </div>
   <div class="col-md-12 ">
      {{ Form::bsTextarea('description','',['label'=>'Description','class'=>'form-control ckeditor']) }}
   </div>
   <div class="col-md-12 ">
      {{ Form::bsText('seo_keyword','',['label'=>'Seo Keyword','class'=>'form-control']) }}
   </div>
   <div class="col-md-12 ">
      {{ Form::bsText('seo_title','',['label'=>'Seo title','class'=>'form-control']) }}
   </div>
   <div class="col-md-12 ">
      {{ Form::bsTextarea('seo_description','',['label'=>'Seo Description','class'=>'form-control']) }}
   </div>
   <div class="col-md-6">
      <label>Thumb Image</label>
      <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$thub_img?>  data-upload-filekey="userfile">
         <div class="dz-message needsclick">
            Drop files here or click to upload.<br>
         </div>
         <div class="fallback">
            <input type="file" name="userfile">
         </div>
      </div>
   </div>
   <div class="col-md-6">
      <label>Demo Img-1</label>
      <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$img_1?>  data-upload-filekey="userfile">
         <div class="dz-message needsclick">
            Drop files here or click to upload.<br>
         </div>
         <div class="fallback">
            <input type="file" name="userfile">
         </div>
      </div>
   </div>
   <div class="col-md-6">
      <label>Demo Img-2</label>
      <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$img_2?>  data-upload-filekey="userfile">
         <div class="dz-message needsclick">
            Drop files here or click to upload.<br>
         </div>
         <div class="fallback">
            <input type="file" name="userfile">
         </div>
      </div>
   </div>
   <div class="col-md-6">
      <label>Full demo file</label>
      <input type="file"   name="full_project_file" class="form-control">
   </div>
</div>
<div class="col-md-12 ">
   {{ Form::bsSubmit() }}
</div>
{{ Form::close() }}
@endsection