@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
<div class="row">

      <div class="col-md-12 ">
           {{ Form::bsText('family_name',$row->family_name,['label'=>$niceNames['family_name']]) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsSelect('family_status',$statusDropdown,$row->family_status,['label'=>$niceNames['family_status']]) }}
       </div>

 
      
</div>
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}
@endsection