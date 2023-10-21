@extends('layouts.'.config('backendLayout'))
@section('content')


@include('blocks/panelHeading',['title'=>$title])
<div class="row">
      
         <div class="col-md-12 ">
           {{ Form::bsView('service_name',$row->service_name,['label'=>$niceNames['service_name']]) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsView('service_status',$statusDropdown[$row->service_status],['label'=>$niceNames['service_status']]) }}
       </div>
 </div>
 


@endsection