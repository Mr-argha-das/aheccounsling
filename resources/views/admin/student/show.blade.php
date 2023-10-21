@extends('layouts.frontend')

@section('content')



<div class="row">
    <div class="col-md-6 offset-md-4">

           {{ Form::bsView('name',$row->student_name,['label'=>'Student Name']) }}
           {{ Form::bsView('st_class',$row->st_class,['label'=>'Student Class']) }}
           {{ Form::bsView('dob',$timedate->dateFormat($row->student_dob,'out'),['label'=>'Student Dob']) }}
           {{ Form::bsView('status',$row->student_status,['label'=>'Student Status']) }}


    </div>
</div>



@endsection