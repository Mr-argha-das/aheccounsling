@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')


<div class="row">

      <div class="col-md-12 ">
        {{ Form::bsText('session_name',$row->session_name,['label'=>$niceNames,'readonly'=>'true']) }}
       </div>
        <div class="col-md-12 ">
           {{ Form::bsText('op_cash_opening',$row->op_cash_opening,['label'=>'Cash Opening']) }}
       </div>
        <div class="col-md-12 ">
           {{ Form::bsText('op_pda_opening',$row->op_pda_opening,['label'=>'PDA Opening']) }}
       </div>
       
</div> 
        {{ Form::bsSubmit() }}

{{ Form::close() }}


@endsection

<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function()
{
    jQuery('#op_cash_opening, #op_pda_opening').keyup(function () { 
      
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
      jQuery('#session_name').keyup(function () { 
      
    this.value = this.value.replace(/[^0-9\-.]/g,'');
});
});
</script>