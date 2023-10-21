@extends('layouts.'.config('backendLayout'))
@section('content')


@include('blocks/panelHeading',['title'=>$title])
<div class="row">
      
         <div class="col-md-12 ">
           {{ Form::bsView('family_name',$row->family_name,['label'=>$niceNames['family_name']]) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsView('family_status',$statusDropdown[$row->family_status],['label'=>$niceNames['family_status']]) }}
       </div>
 </div>
 


@endsection