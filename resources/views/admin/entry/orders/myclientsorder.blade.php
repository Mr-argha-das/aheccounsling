@extends('layouts.'.config('backendLayout'))
<?php 
$rmidlist  = \App\Model\Entry\RegisterMember_model::makeArray();

?>
@section('content')


<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $title }} </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Orders / {{ $title }} </h6>
            </div>
      
              <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary fancyboxajax" href="<?= $viewpPath ?>create"><i class="fa fa-plus mr-1"></i> Create New</a>
                    </span>
                     <!--  <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a target="_blank" class="btn btn-primary" href="{{url('admin/entry/myclientorders/excelfile/'.$rm_id)}}"><i class="fa fa-download mr-1"></i>CSV file</a>
                    </span> -->
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
  
  <input type="hidden" value="{{$rm_id}}" name="rm_id">



<?=Design::$filterClose?>
<div class="block p-3" style="border-radius:15px">
    <div class="table-vcenter table-responsive">
        <table class="table  table-hover">
            <thead>
                <tr>
                    <th><b>#</b></th>
                    <th><b>Order ID</b></th>
                    <th><b>Order Date</b></th>
                    <th><b>Client Name</b></th>
                    <th><b>Client Email</b></th>
                    <!-- <th>Client Mobile</th> -->
                    <th><b> Service</b></th>
                    <!-- <th> Subject</th>
                    <th> Note</th> -->
                   
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
                        <!-- <td>+{{ $ob->phone_code.' '.$ob->en_mobile }}</td> -->
                        <td>{{ $ob->services_name }}</td>
                        <!--    <td>{{ $ob->en_subject }}</td>
                        <td>{{ $ob->en_query }}</td> -->
                        
            <td>
                <?php if(!empty($ob->Screenshot)){
                    ?>
                    <a href="{{ asset('assets/uploads/enquiry/'.$ob->Screenshot) }}" target="_blank" class="btn btn-primary btn-sm">View Screenshot </a>

                    <?php
                }
                ?>
              </td>

                 <td>
                  <?= Design::$dmStart ?>
                  <a class="fancyboxajax" href="{{url($viewFolder.$rowId.'/edit')}}">Edit</a>
                 
                  <a class="fancyboxajax" href="{{url('admin/entry/myclientorders/'.$rowId.'/edit')}}">Update Status</a>
                   @if($ob->order_type==1)
                  <a class="fancyboxajax" href="{{url('admin/entry/myclientorders/copyorder/'.$rowId)}}">Copy Order</a>
                   @endif
                  <a target="_blank" href="{{url('admin/entry/myclientorders/trackstatus/'.$ob->tranxid)}}">Track Status</a>
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
      $("#start_date,#end_date").datepicker({            
      maxDate: new Date()
     });

 });
</script>
@endsection