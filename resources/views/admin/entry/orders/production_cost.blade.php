@extends('layouts.'.config('backendLayout'))
<?php 
$rmidlist  = \App\Model\Entry\RegisterMember_model::get();
 ?>
@section('content')
<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $title }} </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Orders / {{ $title }} </h6>
            </div>
      
              
    
        </div>
    </div>
</div>
<?=Design::$filterStart?>
<div class="col-md-6">
    {{ Form::bsText('start_date','GET_METHOD',['label'=>"Start Date"]) }}
</div>
 <div class="col-md-6">
    {{ Form::bsText('end_date','GET_METHOD',['label'=>"End Date"]) }}
</div>
<div class="col-md-4 ">

     <div class="form-group eqheight">
       <label for="rm_id" class="control-label">Rm  User</label>
        <select class="form-control form-control-sm" id="rm_id" name="rm_id">
            <option value="">Please select one option</option>
              @foreach($rmidlist as $key => $rmvalue)
                <option  value="{{$rmvalue->id}}">{{$rmvalue->rmid}} -({{$rmvalue->name}})</option>
               @endforeach
        </select>
    </div>
 </div>

        <div class="col-md-4 ">
          <div class="form-group eqheight">
            <label class="control-label">Select Writer </label>
               <select   id="write_id" name="write_id" class="form-control form-control-lg"> 
                  <option value="">Please select one option</option>
                   @foreach($writesList as  $id =>$name)
                   <option  value="{{$id}}">{{$name}}</option>
                   @endforeach
              </select> 
           </div>
        </div>

          <div class="col-md-4 ">
          <div class="form-group eqheight">
            <label class="control-label">Expence Type</label>
               <select   id="write_id" name="expence_type" class="form-control form-control-lg"> 
                    
                   <option  value="1">Include</option>
                   <option  value="2">Exclude</option>
                   
              </select> 
           </div>
        </div>
 <?=Design::$filterClose?>
 
<div class="block p-3" style="border-radius:15px">
    <div class="table-vcenter table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    
                    <th><b>Order Id</b></th>
                    
                    <th><b>BDE Name</b></th>
                    <th><b>BDE Cost</b></th>
                    
                    <th><b>Company Cost</b></th>
                    <th><b>Expence(%)</b></th>
                    <th><b>Total Cost</b></th>
                    <th><b>Action</b></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach ($records as $ob) {
                    $rowId = $ob->en_id;
                ?>
                    <tr>
                         <td><?php echo $ob->rmid.'-'.date('d-m-y',$ob->tranxid).'_'.sprintf("%02d", $ob->order_number); ?></td>
                        <td>{{ $ob->name }}</td>
                         <td>{{$ob->inr_amount}}</td>
                         <?php 
                           $word_count=$sum=$exp=0;
                              foreach($ob->productioncost as $cost_values){
                               $sum +=$cost_values->cost_value;
                               $exp =$cost_values->extra_charges;
                              
                              } ?>
                       
                        <td>{{$sum}}</td>
                        <td>{{$exp}}</td>
                        <td>{{(($sum*$exp)/100)+$sum}}</td>
                       <td>
                        <?= Design::$dmStart ?>
                        <a   href="{{route('admin.entry.orders.production-cost.add',$ob->tranxid)}}">Add</a>
                       </td>
                </tr>
                    <?php } ?>
             </tbody>
        </table>
        <hr>
        {{ $pagination->render() }}
      </div>
</div>

<script type="text/javascript"> 

   $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();  
      $("#start_date,#end_date").datepicker({            
      maxDate: new Date()
     }); 
    
      $(".send_mail").click(function(){
         if (confirm('are you sure you want to Resend mail')) {
             var id =$(this).data("id");
             $.ajax({
              'async': false,
              'global': false,
               url: "{{route('resendmail')}}",
               dataType: 'json',
               type: 'get',
               data: { id:id},
              success:function(data){
                location.reload();
              }
           });
         }
      });
   });
</script>
@endsection