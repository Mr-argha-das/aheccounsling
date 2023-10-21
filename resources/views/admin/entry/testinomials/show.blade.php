@extends('layouts.'.config('backendLayout'))
@section('content')


@include('blocks/panelHeading',['title'=>$title])
<div class="row">
 
       <div class="col-md-12 ">
           {{ Form::bsView('test_name',$row->test_name,['label'=>$niceNames['test_name']]) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsView('test_desc',$row->test_desc,['label'=>$niceNames['test_desc']]) }}
       </div>

        <div class="col-md-12 ">
          <label for="">Media Image</label>
         <p><img src="<?=asset('assets/uploads/testinomials/'.$row->test_image)?>" width="100"></p>
       </div>
           
    
</div>


@endsection