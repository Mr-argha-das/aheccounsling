@extends('layouts.'.config('backendLayout'))
 
@section('content')

<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $orderDetails->en_first_name }} {{ $orderDetails->en_last_name }} files </h3>
                <h6><?php echo $orderDetails->rmid.'-'.date('d-m-y',$orderDetails->tranxid).'_'.sprintf("%02d", $orderDetails->order_number); ?></h6>
               
            </div>
      
              <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary" href="{{route('admin.entry.client-work-status',$tran_id)}}"><i class="fa fa-plus mr-1"></i> List View</a>
                    </span>
                </div>
        </div>
    </div>
</div>
 <div class="block p-3" style="border-radius:15px"> 
    <form method="POST" action="{{route('admin.entry.client-work-status.store')}}" enctype="multipart/form-data">
 <div class="row">
   
     @csrf 
    <div class="col-md-6" >
           <label class="control-label">Status</label>
           <select   id="status" name="status" class="form-control form-control-lg"> 
               @foreach($clientOrderStatus as  $key =>$status)
               <option  value="{{$key}}">{{$status}}</option>
               @endforeach
          </select> 
       </div>
       <input type="hidden" name="transaction_id" value="{{$tran_id}}">
       <div class="col-md-6">
         <label class="control-label">File Upload</label>
          <input required type="file" name="drive_file" class="form-control form-control-lg">
       </div>
       <div class="col-md-6">
      </div>
           
        <div class="col-md-6">
            </br> </br>
           
               <input required class="form-contro btn btn-info" type="submit"  value="Submit">
          
       </div>
    </div>
   </form>
 </div>
 <script type="text/javascript"> 

   $(document).ready(function(){
    $('input[type=submit]').click(function() {
        $(this).attr('disabled', 'disabled');
        $(this).parents('form').submit();
    });
   });
</script>
@endsection

