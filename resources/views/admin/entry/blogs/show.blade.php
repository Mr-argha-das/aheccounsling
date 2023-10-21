@extends('layouts.'.config('backendLayout'))
@section('content')


@include('blocks/panelHeading',['title'=>$title])
<div class="row">
 
       <div class="col-md-12 ">
           {{ Form::bsView('blog_name',$row->blog_name,['label'=>$niceNames['blog_name']]) }}
       </div>
       <div class="col-md-12 ">
          <label>Blog Description</label>
           {!! $row->blog_desc !!}
       </div>

       <div class="col-md-12 ">
           {{ Form::bsView('blog_status',$statusDropdown[$row->blog_status],['label'=>$niceNames['blog_status']]) }}
       </div>
       <div class="col-md-12 ">
           {{ Form::bsView('blog_comment',$statusDropdown[$row->blog_comment],['label'=>$niceNames['blog_comment']]) }}
       </div>
        <div class="col-md-12 ">
          <label for="">Media Image</label>
         <p><img src="<?=asset('assets/uploads/blogs/'.$row->blog_image)?>" width="100"></p>
       </div>
           
    
</div>


@endsection