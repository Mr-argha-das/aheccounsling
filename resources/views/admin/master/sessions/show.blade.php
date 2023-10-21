@extends('layouts.frontend')

@section('content')


<h4>Edit Bank Infomation</h4><hr/>
<div class="row">
      <div class="col-md-6 ">
           {{ Form::bsText('bank_name',$row->bank_name,['label'=>'Bank Name']) }}
       </div>
       <div class="col-md-6 ">
           {{ Form::bsText('bank_branch',$row->bank_branch,['label'=>'Branch']) }}
       </div>
 </div>
  <div class="row">
        <div class="col-md-6 ">

          {{ Form::bsText('bank_acc_no',$row->bank_acc_no,['label'=>'Account  No.']) }}
       </div>
       <div class="col-md-6 ">
           {{ Form::bsText('bank_ifsc',$row->bank_ifsc,['label'=>'IFSC Code']) }}
          
        </div>
   </div>
   <div class="row">
        <div class="col-md-6 ">

          {{ Form::bsText('bank_open_bal',$row->bank_open_bal,['label'=>'Opening Bal']) }}
       </div>
      
   </div>



@endsection