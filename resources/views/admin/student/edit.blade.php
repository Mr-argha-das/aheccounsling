@extends('layouts.'.config('backendLayout'))

@section('content')

{{ Form::open(array('url' => $formAction)) }}

@method('PUT')

<div class="row">
    <div class="col-md-6 offset-md-4">

        {{ Form::bsText('name',$row->student_name,['label'=>'Student Name']) }}

        {{ Form::bsText('st_class',$row->student_class,['label'=>'Student Class']) }}

        {{ Form::bsText('dob',$timedate->dateFormat($row->student_dob,'out'),['label'=>'Student DOB']) }}

        {{ Form::bsSelect('status',$statusDropdown,$row->student_status,['label'=>'Student Status']) }}

        {{ Form::bsSubmit() }}

    </div>
</div>

{{ Form::close() }}


@endsection