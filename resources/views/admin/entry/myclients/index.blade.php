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
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">Dashboard / My Clients / {{ $title }} </h6>
            </div>
      
                <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary fancyboxajax" href="<?= $viewpPath ?>create"><i class="fa fa-plus mr-1"></i> Add New Client</a>
                    </span>
                </div>
    
        </div>
    </div>
</div>
<?=Design::$filterStart?>
<div class="col-md-4">
    {{ Form::bsText('name','GET_METHOD',['label'=>'Name']) }}
</div>
<div class="col-md-4">
    {{ Form::bsText('email','GET_METHOD',['label'=>'Email']) }}
</div>

<div class="col-md-4">
    {{ Form::bsText('mobile','GET_METHOD',['label'=>'Mobile Number']) }}
</div>


<?=Design::$filterClose?>

<div class="block">
   <div class="block-header">
      <h3 class="block-title">Download </h3>
   </div>
   <div class="block-content p-md-4 p-2 pb-3">
      <div class="pb-3">
         <form method="POST" action="{{route('admin.entry.myclients.clientDataDownloadCSV',$rm_id)}}" accept-charset="UTF-8">
           {{ csrf_field() }}
            <div class="row">
               <div class="col-md-4 ">
                  {{ Form::bsText('start_date','GET_METHOD',['label'=>"Start Date"]) }}
              </div>
               <div class="col-md-4 ">
                  {{ Form::bsText('end_date','GET_METHOD',['label'=>"End Date"]) }}
              </div>

              @if($rm_id==0)
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
               @else
                 <input type="hidden" name="rm_id" value="{{$rm_id}}">
               @endif
               <div class="col-md-12">
                  <input class="btn btn-info" type="submit" value="Download CSV">
                 
               </div>
            </div>
         </form>
      </div>
   </div>
</div>



<div class="block p-3" style="border-radius:15px">
    <div class="table-vcenter table-responsive">
        <table class="table  table-hover">
            <thead>
                <tr>
                    <th><b>#</b></th>
                    <th><b>Name</b></th>
                    <th><b>Email</b></th>
                    <th><b>Mobile</b></th>
                    <th><b>Register Date</b></th>
                    <th scope="col"><b>Status</b></th>
                    <th scope="col"><b>RMID</b></th>
                    <th scope="col"><b>Actions</b></th>
                  
                </tr>
            </thead>
            <tbody>
                <?php
                      $sr = 1;
                    foreach ($records as $ob) { 
                         $rowId = $ob->user_id;

                         ?>
                    <tr>
                        <td><?= $sr++ ?></td>
                        <td>{{ $ob->user_name }}</td>
                        <td>{{ $ob->user_email }}</td>
                        <td>+{{ $ob->phone_code.' '.$ob->mobile }}</td>
                        <td>{{ date('d-m-Y',strtotime($ob->user_created_at)) }}</td>

                        <td>
                            @if($ob->is_multipal==0)
                            <button class="btn btn-success sm">Auto-Approved</button>

                            @elseif($ob->is_multipal==1 && $ob->is_approved==0)
                            <button class="btn btn-warning sm">Pending</button>
                            @elseif($ob->is_multipal==1 && $ob->is_approved==1)
                            <button class="btn btn-info sm">Admin-Approved</button>
                            @elseif($ob->is_multipal==1 && $ob->is_approved==2)
                            <button class="btn btn-danger sm">Admin-Rejected</button>
                             @endif


                        </td>
                         <td>
                             @if($ob->is_multipal==1 && $rm_id==0 && $ob->rmusers!=false)
                              @foreach($ob->rmusers as $value)
                                {{$value->rmid}}
                             @endforeach
                           @endif
                           </td>

                        <td>

                             <?= Design::$dmStart ?>
                              
                             <a class="fancyboxajax" href="{{url($viewFolder.$rowId.'/edit')}}">Edit</a>
                              @if($rm_id==0)
                                @if($ob->is_multipal==1 && $ob->is_approved==0)
                                <a data-action-url="{{route('admin.client.statusupdate',array($rowId,1))}}">Approved Status</a> 
                                <a data-action-url="{{route('admin.client.statusupdate',array($rowId,2))}}">Reject Status</a> 
                                @elseif($ob->is_multipal==1 && $ob->is_approved==1)
                                 <a data-action-url="{{route('admin.client.statusupdate',array($rowId,2))}}">Reject Status</a>
                                @elseif($ob->is_multipal==1 && $ob->is_approved==2)
                                <a data-action-url="{{route('admin.client.statusupdate',array($rowId,1))}}">Approved Status</a> 
                                 @endif
                                
                                  @if($ob->_token_id!=null)
                                 <a href="{{route('admin.entry.myclients.userData',array($rowId))}}">ClientData</a> 
                                 @endif
                                 

                             @endif
                            
                      
                           </td>
            
                 <?php } ?>
          </tr>
          
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
  });
</script>
@endsection