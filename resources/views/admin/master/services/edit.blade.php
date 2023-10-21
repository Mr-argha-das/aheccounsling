@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
<div class="row">

      <div class="col-md-12 ">
           {{ Form::bsText('service_name',$row->service_name,['label'=>$niceNames['service_name']]) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsSelect('service_status',$statusDropdown,$row->service_status,['label'=>$niceNames['service_status']]) }}
       </div>

 
      
</div>
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}
@endsection