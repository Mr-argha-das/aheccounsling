@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<meta name="csrf-token" content="{{ csrf_token() }}" />

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}

<div class="row">







         <div class="col-md-12 ">
           {{ Form::bsText('y_title','',['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
       
      <div class="col-md-12 ">
           {{ Form::bsText('y_url','',['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
       
   
              <div class="col-md-12 ">
        {{ Form::bsSubmit() }}
      </div>

{{ Form::close() }}
@endsection
