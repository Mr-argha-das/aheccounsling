@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}

<div class="row">

      <div class="col-md-12 ">
           {{ Form::bsText('route_title','',['label'=>$niceNames]) }}
       </div>
      
      <div class="col-md-12 ">
           {{ Form::bsText('route_key','',['label'=>$niceNames]) }}
       </div>
      
      <div class="col-md-12 ">
           {{ Form::bsText('route_value','',['label'=>$niceNames]) }}
       </div>
        <div class="col-md-12 ">
           {{ Form::bsSelect('route_type',[1=>'resource',2=>'get'],['label'=>'Route Type']) }}
       </div>
       
      
</div>
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}@endsection