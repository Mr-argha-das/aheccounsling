@extends('layouts.frontend')

@section('content')



<div class="row">
    <div class="col-md-6 offset-md-4">

           {{ Form::bsView('test_name',$row->test_name,['label'=>'Test Name']) }}
          
           {{ Form::bsView('test_date',$timedate->dateFormat($row->test_date,'out'),['label'=>'Test Date']) }}
           {{ Form::bsView('test_status',$row->test_status,['label'=>'Test Status']) }}


    </div>
</div>



@endsection