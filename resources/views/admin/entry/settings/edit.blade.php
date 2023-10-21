@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<meta name="csrf-token" content="{{ csrf_token() }}" />

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')

<div class="row">

         <div class="col-md-6 ">
           {{ Form::bsText('setting_var',$row->setting_var,['label'=>$niceNames,'class'=>'form-control','readonly'=>'true']) }}
        </div>
          <div class="col-md-6 ">
           {{ Form::bsText('setting_name',$row->setting_name,['label'=>$niceNames,'class'=>'form-control']) }}
        </div>
        <div class="col-md-12 ">

           {{ Form::bsText('setting_value',$row->setting_value,['label'=>$niceNames,'class'=>'form-control']) }}
        </div>
        <div class="col-md-12 ">
           {{ Form::bsSelect('setting_access',$loginUsers,$row->setting_access,['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsSelect('setting_sorting',$orderType,$row->setting_sorting,['label'=>$niceNames,'class'=>'form-control']) }}
       </div>

     </div>

  
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}
@endsection
