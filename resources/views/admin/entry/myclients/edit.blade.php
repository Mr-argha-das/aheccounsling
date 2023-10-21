@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])

 <?php 
 $rmidlist  = \App\Model\Entry\RegisterMember_model::makeArray();
 $countryCode = \App\Model\Country_model::pluck('phonecode','id');
 ?>
<meta name="csrf-token" content="{{ csrf_token() }}" />
   
  {{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
 
<div class="row">

        <div class="col-md-6">
           <label class="control-label">Name</label>
             <!-- <input type="text" class="form-control form-control-lg" name="modal_en_first_name" id="modal_en_first_name"  value="" placeholder="First Name"> -->
             <input type="text" name="modal_en_first_name" class="form-control form-control-lg" value="{{$row->user_name}}" id="modal_en_first_name"  placeholder="First Name">
        </div>
        
        <div class="col-md-6">
           <label class="control-label">Email</label>
            <input id="modal_en_email" class="form-control form-control-lg" name="modal_en_email" value="{{$row->user_email}}" type="text"  value="" placeholder="E-mail">
        </div>


         <div class="col-md-4">
             <label class="control-label">Mobile Number</label>
                <div class="row my-2 mx-0 border">
                    <div class="col-2 px-0">

                        <select  class="border-0" class="form-control form-control-lg" name="country_code"  id="country_code" >
                          @foreach($countryCode as $key =>$vs)
                         <option <?php if($vs==$row->phone_code ) echo 'selected' ?>  value="{{$vs }}">+{{ $vs}} </option>
                         @endforeach 
                         
                     </select>
                 </div>
                 <div class="col-10 pl-0">

                    <input type="number" class="border-0" class="form-control form-control-lg"  value="{{$row->mobile}}" id="modal_en_mobile" value="" name="modal_en_mobile"  placeholder="Mobile No." />
                </div>
            </div>
        </div>
      
       <div class="col-md-4">
           <label class="control-label">Univercity name</label>
           <input type="text" name="univercity_name" class="form-control form-control-lg" value="{{$row->univercity_name}}" id="univercity_name"  placeholder="univercity name">
        </div>
      <div class="col-md-4">
          <label class="control-label">RM ID</label>
          <select    name="rm_id" id="rm_id_select" class="form-control form-control-lg">
            <option value="">SELECT RM Id</option>
            @foreach($rmidlist as $rm_id => $rmusername)
            <option  <?php if($rm_id==$row->rm_id ) echo 'selected' ?> value="{{ $rm_id }}">{{ $rmusername }}</option>
            @endforeach
        </select>
      </div>
     

         

        {{ Form::bsSubmit() }}
 
{{ Form::close() }}

<script type="text/javascript"> 

   $(document).ready(function(){

 $('#country_code,#rm_id_select').select2();
  });
</script>
@endsection
