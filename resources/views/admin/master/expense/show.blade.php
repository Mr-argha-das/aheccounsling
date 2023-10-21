@extends('layouts.'.config('backendLayout'))
@section('content')


@include('blocks/panelHeading',['title'=>$title])
<div class="row">
      
         <div class="col-md-12 ">
           {{ Form::bsView('exp_name',$row->exp_name,['label'=>$niceNames['exp_name']]) }}
       </div>
     
 </div>
 


@endsection