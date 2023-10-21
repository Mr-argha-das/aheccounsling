@extends('layouts.'.config('backendLayout'))
@section('content')


@include('blocks/panelHeading',['title'=>$title])
<div class="row">
 
       <div class="col-md-12 ">
           {{ Form::bsView('services_name',$row->services_name,['label'=>$niceNames['services_name']]) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsView('services_desc',strip_tags($row->services_desc),['label'=>$niceNames['services_desc']]) }}
       </div>

       <div class="col-md-6">
           {{ Form::bsView('services_status',$statusDropdown[$row->services_status],['label'=>$niceNames['services_status']]) }}
       </div>
    
        <div class="col-md-6 ">
          <label for="">Media Image</label>
         <p><img src="<?=asset('assets/uploads/service/'.$row->services_image)?>" width="100"></p>
       </div>
              <div class="col-md-6 ">
          <label for="">Download File</label>
         <p><a href="<?=asset('public/assets/uploads/service/'.$row->services_files)?>" width="100">Download File</a></p>
       </div>


</div>


@endsection