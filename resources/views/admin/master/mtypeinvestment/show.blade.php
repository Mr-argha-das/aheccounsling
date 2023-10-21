@extends('layouts.'.config('backendLayout'))
@section('content')


@include('blocks/panelHeading',['title'=>$title])
<div class="row">
      
         <div class="col-md-12 ">
           {{ Form::bsView('m_name',$row->m_name,['label'=>$niceNames['m_name']]) }}
       </div>
      
 </div>
 


@endsection