@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}

<div class="row">

      <div class="col-md-12 ">
           {{ Form::bsText('task_name','',['label'=>$niceNames]) }}
       </div>
       
        <div class="col-md-12 ">
           {{ Form::bsSelect('task_frequency',$taskFreq,'',['label'=>$niceNames]) }}
       </div>

</div>
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}@endsection