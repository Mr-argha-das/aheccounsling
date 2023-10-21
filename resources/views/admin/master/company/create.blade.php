@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}

<div class="row">

      <div class="col-md-12 ">
           {{ Form::bsText('com_name','',['label'=>$niceNames]) }}
       </div>
       
        <div class="col-md-12 ">
           {{ Form::bsText('com_person','',['label'=>$niceNames]) }}
       </div>
        <div class="col-md-12 ">
           {{ Form::bsText('com_mob','',['label'=>$niceNames]) }}
       </div>
         <div class="col-md-12 ">
           {{ Form::bsText('com_landline','',['label'=>$niceNames]) }}
       </div>
        <div class="col-md-12 ">
           {{ Form::bsTextarea('com_address','',['label'=>$niceNames]) }}
       </div>
      
</div>
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}@endsection