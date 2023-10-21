 @extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<meta name="csrf-token" content="{{ csrf_token() }}" />
  
    <script src="assets/js/dzupload.js" defer></script>
  <script>
   
                       
                </script>
{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
  
<div class="row">
         

         <?php if($row->questions!=null){ 


                $questions = implode(json_decode($row->questions,true),'__');

                $answers = implode(json_decode($row->answers,true),'__');

                 }else{

                  $questions=$answers=''; 


                   
                   } ?>
      


       <div class="col-md-12 ">
           {{ Form::bsText('name',$row->name,['label'=>'Name','class'=>'form-control']) }}
       </div>

        <div class="col-md-12 ">
           {{ Form::bsText('title',$row->title,['label'=>'Title','class'=>'form-control']) }}
       </div>

         <div class="col-md-12 ">
            {{ Form::bsTextarea('questions',$questions,['label'=>'Question(__)','class'=>'form-control']) }}
         </div>

          <div class="col-md-12 ">
            {{ Form::bsTextarea('answers',$answers,['label'=>'Answers(__)','class'=>'form-control']) }}
        </div>


       <div class="col-md-12 ">
           {{ Form::bsText('seo_title',$row->seo_title,['label'=>'Seo title','class'=>'form-control']) }}
       </div>

        <div class="col-md-12 ">
           {{ Form::bsText('seo_keyword',$row->seo_keyword,['label'=>'Seo Keyword','class'=>'form-control']) }}
       </div>
      
       <div class="col-md-12 ">
           {{ Form::bsTextarea('seo_description',$row->seo_description,['label'=>'Seo Description','class'=>'form-control']) }}
       </div>

       {{ Form::bsSubmit() }}
 
{{ Form::close() }}
@endsection
