 @extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<meta name="csrf-token" content="{{ csrf_token() }}" />
  
    <script src="assets/js/dzupload.js" defer></script>
  <script>
    $(document).ready(function($) {
         CKEDITOR.replace( 'description', {  }  );
         // CKEDITOR.replace( 'menu_slider_text', { allowedContent: 'p' }  );
         
    });
                       
                </script>
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
  
<div class="row">


       <div class="col-md-12 ">
           {{ Form::bsText('title',$row->title,['label'=>'Title','class'=>'form-control']) }}
       </div>

        

        <div class="col-md-12 ">
           

           {{ Form::bsTextarea('description',$row->description,['label'=>'Description','class'=>'form-control ckeditor']) }}

       </div>

        <div class="col-md-12 ">
           {{ Form::bsSelect('status',$statusDropdown,$row->status,['label'=>'Status','class'=>'form-control']) }}
       </div>
      
       

  
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}
@endsection
