@extends('layouts.'.config('backendLayout'))
@section('content')


@include('blocks/panelHeading',['title'=>$title])
<div class="row">
 
  <div class="col-md-4 ">
           {{ Form::bsView('event_name',$row->event_name,['label'=>$niceNames['event_name']]) }}
       </div>
      
       <div class="col-md-4 ">
           {{ Form::bsView('event_date',$timedate->dateFormat($row->event_date,'out'),['label'=>$niceNames['event_date']]) }}
       </div>

        <div class="col-md-4 ">
           <label>Event Status</label><br/>
          <?=$statusDropdown[$row->event_status]?>
       </div>

        <div class="col-md-12 ">
          <label for="">Event Image</label>
         <p><img src="<?=asset('assets/uploads/events/'.$row->event_image)?>" width="100"></p>
       </div>
           
       </div> <div class="col-md-12 ">
        <label>Description</label>
    <?=$row->event_desc?>
       </div>
   
</div>


@endsection