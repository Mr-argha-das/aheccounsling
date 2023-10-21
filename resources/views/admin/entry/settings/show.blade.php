@extends('layouts.'.config('backendLayout'))
@section('content')


@include('blocks/panelHeading',['title'=>$title])
<div class="row">
       <div class="col-md-12 ">
           {{ Form::bsView('about_name',$row->about_name,['label'=>$niceNames['about_name']]) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsView('about_desc',strip_tags($row->about_desc),['label'=>$niceNames['about_desc']]) }}
       </div>

       <div class="col-md-6">
           {{ Form::bsView('about_status',$statusDropdown[$row->about_status],['label'=>$niceNames['about_status']]) }}
       </div>
    
        <div class="col-md-6 ">
          <label for="">Media Image</label>
         <p><img src="<?=asset('assets/uploads/aboutus/'.$row->about_image)?>" width="100"></p>
       </div>
 </div>


@endsection