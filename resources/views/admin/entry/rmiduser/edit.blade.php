
   @extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="assets/js/dzupload.js" defer></script>
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
  
     <div class="row">

        <div class="col-md-12 ">
           {{ Form::bsText('name',$row->name,['label'=>'Name','class'=>'form-control']) }}
        </div>
         <div class="col-md-12 ">
           {{ Form::bsText('emid',$row->emid,['label'=>'Emp-id','class'=>'form-control']) }}
        </div>

        <div class="col-md-12 ">
           {{ Form::bsText('rmid',$row->rmid,['label'=>'RMID','class'=>'form-control']) }}
       </div>

       <div class="col-md-12 ">
           {{ Form::bsText('email',$row->email,['label'=>'Email','class'=>'form-control']) }}
       </div>
      
       <div class="col-md-12 ">
           {{ Form::bsText('phone',$row->phone,['label'=>'Phone','class'=>'form-control']) }}
       </div>

       <div class="col-md-12 ">
           {{ Form::bsText('symbol',$row->symbol,['label'=>'Symbol','class'=>'form-control']) }}
       </div>

       <div class="col-md-12 ">
       {{ Form::bsSelect('emp_type',$venturesDropdown,$row->emp_type,['label'=>"VENTURES",'class'=>'form-control']) }}
       </div>

       <div class="col-md-12 ">
           {{ Form::bsSelect('status',$statusDropdown,$row->status,['label'=>"Status",'class'=>'form-control']) }}
       </div>

       {{ Form::bsSubmit() }}
 
       {{ Form::close() }}
      
      @endsection
