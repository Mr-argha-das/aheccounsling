@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>'Update status'])
<?php 
$flUserList =  \App\Model\Website\FlModel::pluck('af_name','af_id');
?>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="assets/js/dzupload.js" defer></script>
<script src="assets/js/jquery-clock-timepicker.min.js" defer></script>
  
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction,'id'=>"msform-order")) }}
@method('PUT')
 
<div class="row">
     
      <div class="col-md-12 ">
           {{ Form::bsSelect('status',$orderStatus,'',['label'=>"Status",'class'=>'form-control']) }}
      </div>

       <div class="col-md-12 ">
           {{ Form::bsTextarea('comment','',['label'=>'Comment','class'=>'form-control ckeditor']) }}
       </div>
          
       <div class="col-md-12 @if($rm_id!=0) d-none @endif">
           <label>Writers</label>
            <select class="form-control" name="writer_id"> 
               <option value="">Select Writer</option>
              
               @foreach($flUserList as $fl_id => $fl_user_name)
              
                <option <?php if($writer_id==$fl_id){  echo 'selected'; } ?> value="{{$fl_id}}">{{$fl_user_name}}</option>
              
               @endforeach
            </select>
           
       </div>
     <div class="col-md-12 ">
        {{ Form::bsSubmit() }}
      </div>

{{ Form::close() }}

 @endsection

