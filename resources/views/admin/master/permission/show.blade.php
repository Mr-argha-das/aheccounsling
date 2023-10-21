@extends('layouts.'.config('backendLayout'))
@section('content')


@include('blocks/panelHeading',['title'=>$title])
<div class="row">
      
         <div class="col-md-12 ">
           {{ Form::bsView('route_title',$row->route_title,['label'=>$niceNames['route_title']]) }}
       </div>

         <div class="col-md-12 ">
           {{ Form::bsView('route_key',$row->route_key,['label'=>$niceNames['route_key']]) }}
       </div>

         <div class="col-md-12 ">
           {{ Form::bsView('route_value',$row->route_value,['label'=>$niceNames['route_value']]) }}
       </div>
  
    
 </div>
 


@endsection