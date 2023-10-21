@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- <script src="assets/js/dzupload.js" defer></script> -->
    
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction,'enctype'=>'multipart/form-data')) }}
 
      <div class="row">

        <div class="col-md-12 ">
           {{ Form::bsText('name','',['label'=>'Name','class'=>'form-control']) }}
        </div>

        <div class="col-md-12 ">
           {{ Form::bsText('emid','',['label'=>'Emp-id','class'=>'form-control']) }}
        </div>

        <div class="col-md-12 ">
           {{ Form::bsText('rmid','',['label'=>'RMID','class'=>'form-control']) }}
       </div>

       <div class="col-md-12 ">
           {{ Form::bsText('email','',['label'=>'Email','class'=>'form-control']) }}
       </div>
      
       <div class="col-md-12 ">
           {{ Form::bsText('phone','',['label'=>'Phone','class'=>'form-control']) }}
       </div>
        <div class="col-md-12 ">
           {{ Form::bsText('symbol','',['label'=>'Symbol','class'=>'form-control']) }}
       </div>

       <div class="col-md-12 ">
        {{ Form::bsSelect('emp_type',$venturesDropdown,'',['label'=>"VENTURES",'class'=>'form-control']) }}
       </div>
       <div class="col-md-12 ">
        {{ Form::bsSelect('status',$venturesDropdown,'',['label'=>"Status",'class'=>'form-control']) }}
       </div>
       
       <div class="col-md-12 ">
        {{ Form::bsSubmit() }}
      </div>

{{ Form::close() }}
@endsection
