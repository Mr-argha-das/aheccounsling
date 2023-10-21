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
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
  
<div class="row">

      


       <div class="col-md-12 ">
           {{ Form::bsText('name',$row->name,['label'=>'Name','class'=>'form-control']) }}
       </div>

       <div class="col-md-12 ">
           {{ Form::bsText('drop_box_api',$row->drop_box_api,['label'=>'Drop Box Api','class'=>'form-control']) }}
       </div>

        <div class="col-md-12 ">
           {{ Form::bsText('seo_keyword',$row->seo_keyword,['label'=>'Seo Keyword','class'=>'form-control']) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsText('seo_title',$row->seo_title,['label'=>'Seo title','class'=>'form-control']) }}
       </div>

        <div class="col-md-12 ">
           {{ Form::bsTextarea('seo_description',$row->seo_description,['label'=>'Seo Description','class'=>'form-control']) }}
       </div>

      <!--  <div class="col-md-12 ">
           {{ Form::bsSelect('services_status',$statusDropdown,$row->services_status,['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
       -->
       

  
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}
@endsection
