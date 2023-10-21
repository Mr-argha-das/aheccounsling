@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])

<?PHP
$serviceArray  = \App\Model\Entry\Service_model::makeArray();

  ?>

  <style type="text/css">
    .error{
  color:#f64a08eb !important;
}
  </style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
  
  {{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction,'id'=>"msform-order")) }}
 
<div class="row">

        <div class="col-md-6" >
           <label class="control-label">Client Name</label>
           <select   id="client_id" name="client_id" class="form-control form-control-lg"> 
               <option value="">Select client</option>
               @foreach($client_list as  $client)
               <option  value="{{$client->user_id}}">{{$client->user_name}}  ({{$client->user_password}})</option>
               @endforeach
          </select> 
       </div>
         <div class="col-md-6">
               <label class="control-label">Service Type</label>
                <select  name="service_id" id="service_id"  class="form-control form-control-lg"> 
                      <option value="">Service Type</option>
                        @foreach($serviceArray as $key =>$vs)
                        <option value="{{ $key }}">{{ $vs}} </option>
                        @endforeach
                   </select>
          </div>

           <div class="col-md-6">
               <label class="control-label">Payment Currency Type</label>
                <select  name="currenct_type" id="currenct_type"  class="form-control form-control-lg"> 
                      <option value="">Currency Type</option>
                        @foreach($paymentCurrencyList as $key =>$paymentCurrencyType)
                        <option value="{{ $paymentCurrencyType->id }}">{{ $paymentCurrencyType->type }} </option>
                        @endforeach
                   </select>
           </div>
        
         <div class="col-md-6">
           <label class="control-label">Amount</label>
           <input type="text" name="amount" class="form-control form-control-lg numbers" id="amount"  value=""  placeholder="Amount">
        </div>

        <div class="col-md-12 ">
        {{ Form::bsSubmit() }}
      </div>

    {{ Form::close() }}




  <script type="text/javascript"> 

   $(document).ready(function(){

    $('.numbers').keyup(function () { 
      this.value = this.value.replace(/[^0-9\.]/g,'');
  });
    
     $('#currenct_type,#client_id,#service_id').select2();

         $('#msform-order').validate({
            onfocusout: function(element) {$(element).valid()}
            , rules: {
           "client_id": {
              required: true,
           } ,"currenct_type": {
              required: true,
           }, "service_id": {
              required: true,
          }, "amount": {
              required: true,
          }, 
      },
     });
 });
</script>

@endsection

