@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
<div class="row">

      <div class="col-md-12 ">
           {{ Form::bsText('m_name',$row->m_name,['label'=>$niceNames['m_name']]) }}
       </div>
      

 
      
</div>
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}
@endsection