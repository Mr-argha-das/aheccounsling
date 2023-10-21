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
<div class="col-md-4 ">
    {{ Form::bsText('start_date','GET_METHOD',['label'=>"Start Date"]) }}
</div>
 <div class="col-md-4 ">
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

<?=Design::$filterClose?>
<div class="block p-3" style="border-radius:15px">
    <div class="table-vcenter table-responsive">
        <table class="table  table-hover myTable">
            <thead>
                <tr>
                    <th><b>#</b></th>
                    <th><b>Order Id</b></th>
                    <th><b>Order Date</b></th>
                    <th><b>Client Name</b></th>
                    <th><b>Email</b></th>
                    <th><b> Service</b></th>
                    <th><b>BDE Name</b></th>
                    <th><b>Screenshot</b></th>
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
                        <td><?= $sr++ ?></td>
                        <td><?php echo $ob->rmid.'-'.date('d-m-y',$ob->tranxid).'_'.sprintf("%02d", $ob->order_number); ?></td>
                        <td>{{ date('d-m-Y',strtotime($ob->en_created_at)) }}</td>
                        <td>{{ $ob->en_first_name }} {{ $ob->en_last_name }}</td>
                        <td>{{ $ob->en_email }}</td>
                        <td>
                         <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="{{ $ob->en_query }}">{{ $ob->services_name }}</a>
                       </td>
                        <td>{{ $ob->name }}</td>
                        <td>
                            <?php if(!empty($ob->Screenshot)){
                                ?>
                                <a href="{{ asset('assets/uploads/enquiry/'.$ob->Screenshot) }}" target="_blank" class="btn btn-primary btn-sm px-2 py-1">View Screenshot </a>
                                <?php
                            }
                            ?>
                        </td>

                       <td>
                        <?= Design::$dmStart ?>
                        <a class="fancyboxajax" href="{{url('admin/entry/myclientorders/'.$rowId.'/edit')}}">Update Status</a>
                        <a target="_blank" href="{{url('admin/entry/myclientorders/trackstatus/'.$ob->tranxid)}}">Track Status</a>
                         <button class="send_mail px-3 py-2" data-id="{{$rowId}}">  Mail Resend </button>  
                         <a href="{{route('admin.entry.client-work-status',$ob->tranxid)}}">Client work upload</a>
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