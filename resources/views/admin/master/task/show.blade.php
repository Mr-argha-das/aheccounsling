@extends('layouts.'.config('backendLayout'))
@section('content')


@include('blocks/panelHeading',['title'=>$title])
<div class="row">
      
         <div class="col-md-6">
           {{ Form::bsView('task_name',$row->task_name,['label'=>$niceNames['task_name']]) }}
       </div>
        <div class="col-md-6">
           {{ Form::bsView('task_frequency',$taskFreq[$row->task_frequency],['label'=>$niceNames['task_frequency']]) }}
       </div>
      
      
 </div>
 


@endsection