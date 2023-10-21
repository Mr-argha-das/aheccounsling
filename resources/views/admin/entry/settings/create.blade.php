@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<meta name="csrf-token" content="{{ csrf_token() }}" />
    
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}

<div class="row">

         <div class="col-md-6 ">
           {{ Form::bsText('setting_var','',['label'=>$niceNames,'class'=>'form-control']) }}
        </div>
          <div class="col-md-6 ">
           {{ Form::bsText('setting_name','',['label'=>$niceNames,'class'=>'form-control']) }}
        </div>
        <div class="col-md-12 ">
           {{ Form::bsText('setting_value','',['label'=>$niceNames,'class'=>'form-control']) }}
        </div>
        <div class="col-md-12 ">
           {{ Form::bsSelect('setting_access',$statusDropdown,'',['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsSelect('setting_sorting',$orderType,'',['label'=>$niceNames,'class'=>'form-control']) }}
       </div>
   
   
              <div class="col-md-12 ">
        {{ Form::bsSubmit() }}
      </div>

{{ Form::close() }}
@endsection
