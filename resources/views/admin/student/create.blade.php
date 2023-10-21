@extends('layouts.'.config('backendLayout'))

@section('content')

{{ Form::open(array('url' => $formAction)) }}

<div class="row">
    <div class="col-md-12 ">

           {{ Form::bsText('name','',['label'=>'Student Name']) }}

           {{ Form::bsText('st_class','',['label'=>'Student Class']) }}


           {{ Form::bsText('dob','',['label'=>'Student DOB']) }}

           {{ Form::bsSelect('status',$statusDropdown,['label'=>'Student Status']) }}


        {{ Form::bsSubmit() }}

    </div>
</div>

{{ Form::close() }}


@endsection