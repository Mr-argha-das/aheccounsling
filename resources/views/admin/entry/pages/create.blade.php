@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<meta name="csrf-token" content="{{ csrf_token() }}" />
   
    <script src="assets/js/dzupload.js" defer></script>
 <script>
    $(document).ready(function($) {
         CKEDITOR.replace( 'menu_txt', { allowedContent: 'p' }  );
          CKEDITOR.replace( 'menu_slider_text', { allowedContent: 'p' }  );
     });
    </script>
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
<?php


$imgDataUpload = array(
                         'data-upload-folder'=>'assets/uploads/pages/image/',
                         'data-upload-url'=>route('ajaxuploadimage'),
                         'data-delete-url'=>route('deletefile'),
                         'data-inputname'=>'menu_img',
                         'data-upload-type'=>'image',
                         'data-upload-maxfiles'=>1
                        
                     );
$uploadDatanof =NULL;
foreach($imgDataUpload as $key =>$val)
{
    $uploadDatanof.=$key.'='.$val.'  ' ;
}

$imgDataUploadThumb = array(
                         'data-upload-folder'=>'assets/uploads/pages/thumbs/',
                         'data-upload-url'=>route('ajaxuploadimage'),
                         'data-delete-url'=>route('deletefile'),
                         'data-inputname'=>'menu_thumb',
                         'data-upload-type'=>'image',
                         'data-upload-maxfiles'=>1
                        
                     );
$thumbnailImage =NULL;
foreach($imgDataUploadThumb as $key =>$val)
{
    $thumbnailImage.=$key.'='.$val.'  ' ;
}


$imgDataUploadSlider = array(
                         'data-upload-folder'=>'assets/uploads/pages/slider/',
                         'data-upload-url'=>route('ajaxuploadimage'),
                         'data-delete-url'=>route('deletefile'),
                         'data-inputname'=>'menu_slider_img[]',
                         'data-upload-type'=>'image',
                         'data-upload-maxfiles'=>5
                        
                     );
$thumbnailImageSlider =NULL;
foreach($imgDataUploadSlider as $key =>$val)
{
    $thumbnailImageSlider.=$key.'='.$val.'  ' ;
}
?>
<div class="row">

          <div class="col-md-6 ">
           {{ Form::bsSelect('menu_parent',$catList,'',['label'=>$niceNames]) }}
       </div>
           <div class="col-md-3 ">
           {{ Form::bsText('menu_name','',['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
        <div class="col-md-3 ">
           {{ Form::bsText('menu_alias','',['label'=>$niceNames,'class'=>'form-control']) }}
       </div>

</div>
   <hr/>
 <div class="row">

          <div class="col-md-12">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-page-tab" data-toggle="tab" href="#nav-page" role="tab" aria-controls="nav-page" aria-selected="true">Page Text</a>
                <a class="nav-item nav-link " id="nav-page_extra-tab" data-toggle="tab" href="#nav-page_extra" role="tab" aria-controls="nav-page_extra" aria-selected="true">Page Extra Text</a>

                <a class="nav-item nav-link" id="nav-images-tab" data-toggle="tab" href="#nav-images" role="tab" aria-controls="nav-images" aria-selected="false">Images</a>
                <a class="nav-item nav-link" id="nav-Seo-tab" data-toggle="tab" href="#nav-Seo" role="tab" aria-controls="nav-Seo" aria-selected="false">Seo Services</a>
                <a class="nav-item nav-link" id="nav-Slider-tab" data-toggle="tab" href="#nav-Slider" role="tab" aria-controls="nav-Slider" aria-selected="false">Slider</a>
                <a class="nav-item nav-link" id="nav-Advanced-tab" data-toggle="tab" href="#nav-Advanced" role="tab" aria-controls="nav-Advanced" aria-selected="false">Advanced Options</a>
              </div>
           </nav><hr/>
           <div class="tab-content" id="nav-tabContent">
             <div class="tab-pane fade show active" id="nav-page" role="tabpanel" aria-labelledby="nav-page-tab">
                <div class="row">
                    <div class="col-md-12" >
                      {{ Form::bsTextarea('menu_txt','',['label'=>$niceNames,'class'=>'ckeditor']) }}
                    </div>
                </div>
             </div>
              <div class="tab-pane fade show " id="nav-page_extra" role="tabpanel" aria-labelledby="nav-page_extra-tab">
                <div class="row">
                  <div class="col-md-12" >
                      {{ Form::bsTextarea('menu_slider_text','',['label'=>$niceNames,'class'=>'ckeditor']) }}
                    </div>
                </div>


             </div>
              <div class="tab-pane fade show " id="nav-images" role="tabpanel" aria-labelledby="nav-images-tab">
                <div class="row">
                  <div class="col-md-6">
                                  <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$uploadDatanof?>  data-upload-filekey="userfile">
                                  <div class="dz-message needsclick">
                                      Drop files here or click to upload.<br>
                                  </div>     
                                  <div class="fallback">
                                    <input type="file" name="userfile">
                                  </div>

                  </div>
                </div>
                   <div class="col-md-6">
                      <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$thumbnailImage?>  data-upload-filekey="userfile">
                      <div class="dz-message needsclick">
                          Drop files here or click to upload.<br>
                      </div>     
                        <div class="fallback">
                          <input type="file" name="userfile">
                        </div>
                       </div>
                   </div> 
                   
                </div>
             </div>
              <div class="tab-pane fade show " id="nav-Seo" role="tabpanel" aria-labelledby="nav-Seo-tab">
                <div class="row mt-2">
                  <div class="col-md-12 ">
                      {{ Form::bsText('menu_seo_title','',['label'=>$niceNames,'class'=>'form-control']) }}
                  </div>
                  <div class="col-md-12 ">
                      {{ Form::bsText('menu_seo_keyword','',['label'=>$niceNames,'class'=>'form-control']) }}
                  </div>
                  <div class="col-md-12 ">
                      {{ Form::bsText('menu_seo_des','',['label'=>$niceNames,'class'=>'form-control']) }}
                  </div>
                </div>
             </div>
              <div class="tab-pane fade show " id="nav-Slider" role="tabpanel" aria-labelledby="nav-Slider-tab">
                <div class="row mt-2">
                   <div class="col-md-12">
                      <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$thumbnailImageSlider?>  data-upload-filekey="userfile">
                        <div class="dz-message needsclick">
                            Drop files here or click to upload.<br>
                        </div>     
                        <div class="fallback">
                        <input type="file" name="userfile">
                        </div>
                      </div>
                  </div> 
             </div>
             </div>

              <div class="tab-pane fade show " id="nav-Advanced" role="tabpanel" aria-labelledby="nav-Advanced-tab">
                <div class="row mt-2">
                   <div class="col-md-4 ">
                       {{ Form::bsSelect('menu_cat_type',[''=>'Select Option']+$categoryType,'',['label'=>$niceNames]) }}
                   </div>
                    <div class="col-md-4 ">
                      {{ Form::bsText('menu_url','',['label'=>$niceNames,'class'=>'form-control']) }}
                  </div>
                   <div class="col-md-4 ">
                       {{ Form::bsSelect('menu_order',$orderType,'',['label'=>$niceNames]) }}
                   </div>
                    <div class="col-md-4 ">
                       {{ Form::bsSelect('sub_menu_status',$status,'',['label'=>$niceNames]) }}
                   </div>
                   
                    <div class="col-md-4 ">
                       {{ Form::bsSelect('menu_show',$status,'',['label'=>$niceNames]) }}
                   </div>
                    <div class="col-md-4 ">
                       {{ Form::bsSelect('menu_slider_status',$status,'',['label'=>$niceNames]) }}
                   </div>

                </div>
             </div>
   

</div><hr/>
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}
@endsection
