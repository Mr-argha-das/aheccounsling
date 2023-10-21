@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<meta name="csrf-token" content="{{ csrf_token() }}" />
          <script src="assets/js/dzupload.js" defer></script>
   
   <!--  <script>

        ClassicEditor
            .create(document.querySelector('#test_desc'), {
                placeholder: 'Type the content here!',
                toolbar: ["undo", "redo", "heading", "bold", "link", "italic", "blockQuote", '|', "indent", "outdent", "numberedList", "bulletedList", "mediaEmbed", "insertTable", ],
            });
        
    </script> -->
        <script>
    $(document).ready(function($) {
          CKEDITOR.replace( 'test_desc', {  }  );
         
    });
                       
                </script>
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
<?php


$imgDataUpload = array(
                         'data-upload-folder'=>'assets/uploads/testinomials/',
                         'data-upload-url'=>route('ajaxuploadimage'),
                         'data-delete-url'=>route('deletefile'),
                         'data-inputname'=>'test_image',
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
           {{ Form::bsText('test_name','',['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsTextarea('test_desc','',['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
           <div class="col-md-12 ">
           {{ Form::bsText('image_alt','',['label'=>"Imge Alt",'class'=>'form-control']) }}
       </div>
       <div class="col-md-12 ">
        <label>Client Image</label>
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
@endsection
