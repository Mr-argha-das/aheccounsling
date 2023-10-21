@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
<div class="row">

      <div class="col-md-12 ">
           {{ Form::bsText('task_name',$row->task_name,['label'=>$niceNames['task_name']]) }}
       </div>
        <div class="col-md-12 ">
           {{ Form::bsSelect('task_frequency',$taskFreq,$row->task_frequency,['label'=>$niceNames['task_frequency']]) }}
       </div>
       
      
</div>
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}
@endsection