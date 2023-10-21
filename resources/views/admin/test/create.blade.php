@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}




<div class="row">

      <div class="col-md-6 ">
           {{ Form::bsText('test_name','',['label'=>$niceNames]) }}
       </div>
       <div class="col-md-6 ">
           {{ Form::bsSelect('test_status',[''=>'Select']+$statusDropdown,['label'=>$niceNames]) }}
       </div>

 
        <div class="col-md-6 ">

          {{ Form::bsSelect('test_cus',[''=>'Select']+$customer,['label'=>$niceNames]) }}
       </div>
       <div class="col-md-6 ">
           {{ Form::bsText('test_date','',['label'=>$niceNames,'id'=>'test_date']) }}
          
        </div>
  
      
</div> 
        {{ Form::bsSubmit() }}

{{ Form::close() }}


@endsection
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#test_date").datepicker();
  } );
  </script>