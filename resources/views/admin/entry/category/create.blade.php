@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- <script src="assets/js/dzupload.js" defer></script> -->
    
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction,'enctype'=>'multipart/form-data')) }}
 
      <div class="row">

       <div class="col-md-12 ">
           {{ Form::bsText('name','',['label'=>'Name','class'=>'form-control']) }}
       </div>
        <div class="col-md-12 ">
           {{ Form::bsText('drop_box_api','',['label'=>'Drop Box Api','class'=>'form-control']) }}
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

       
       <div class="col-md-12 ">
        {{ Form::bsSubmit() }}
      </div>

{{ Form::close() }}
@endsection
