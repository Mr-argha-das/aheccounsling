@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
<div class="row">

     
      <div class="col-md-12 ">
           {{ Form::bsText('route_title',$row->route_title,['label'=>$niceNames]) }}
       </div>
      
      <div class="col-md-12 ">
           {{ Form::bsText('route_key',$row->route_key,['label'=>$niceNames]) }}
       </div>
      
      <div class="col-md-12 ">
           {{ Form::bsText('route_value',$row->route_value,['label'=>$niceNames]) }}
       </div>
      
 
      
</div>
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}
@endsection