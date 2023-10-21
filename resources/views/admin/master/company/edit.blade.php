@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
<div class="row">
      <div class="col-md-12 ">
           {{ Form::bsText('com_name',$row->com_name,['label'=>$niceNames['com_name']]) }}
       </div>
        <div class="col-md-12 ">
           {{ Form::bsText('com_person',$row->com_person,['label'=>$niceNames['com_person']]) }}
       </div>
        <div class="col-md-12 ">
           {{ Form::bsText('com_mob',$row->com_mob,['label'=>$niceNames['com_mob']]) }}
       </div>
        <div class="col-md-12 ">
           {{ Form::bsText('com_landline',$row->com_landline,['label'=>$niceNames['com_landline']]) }}
       </div>
        <div class="col-md-12 ">
           {{ Form::bsTextarea('com_address',$row->com_address,['label'=>$niceNames['com_address']]) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsSelect('com_status',$statusDropdown,$row->com_status,['label'=>$niceNames['com_status']]) }}
       </div>
 </div>
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}
@endsection