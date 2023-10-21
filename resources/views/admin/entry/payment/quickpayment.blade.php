@extends('layouts.'.config('backendLayout'))
@section('content')
<div class="block">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $title }} </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">Dashboard / Master / {{ $title }} </h6>
            </div>
            <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                    <a class="btn btn-primary fancyboxajax" href="entry/quickpayment/create"><i class="fa fa-plus mr-1"></i> Create Link</a>
                </span>
            </div>
          </div>
    </div>
</div>

<div class="block">
    <div class="block-content">
        <table class="table table-vcenter table-hover myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th><b>Txn-Id </b></th>
                    <th>Page-Load</th>
                    <th>Copy Link</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                  <?php  $n=1;
                     foreach ($records as $ob) {
                     $rowId = $ob->id;  ?>
                    <tr>
                         <td>{{ $n++ }}</td>
                         <td>{{ $ob->firstname }} {{ $ob->Lastname }}</td>
                         <td>{{ $ob->email }}</td>
                         <td>{{ $ob->symbol.' '.$ob->amount }}</td>
                         <td>{{ $ob->txnid }}  <i class="fa fa-copy mr-1 copytrax" data-tanxid='{{ $ob->txnid }}'></i></td>
                         <td>{{ $ob->clcik_count }}</td>
                         <td> @if($ob->payment_status=='pending') <button data-link="{{route('quickCheckout', ['id' => base64_encode($ob->id)])}}" type="button" class="btn btn-warning copyThis" ><span class="ui-button-text">Copy Link</span></button> @endif</td>
                         <td>{{ $ob->payment_status }}</td>
                         <td>
                            <?= Design::$dmStart ?>
                          @if($ob->payment_status=="success" || $ob->payment_status=="failure")
                            <?php if($ob->payment_status=="success"){ ?>
                              <a  target="_blank" href="{{route('success', ['id' => base64_encode($rowId)])}}">view</a>
                            <?php }else if($ob->payment_status=="failure"){ ?>
                               <a  target="_blank" href="{{route('failed', ['id' => base64_encode($rowId)])}}">view</a>
                          <?php } ?>
                          @else
                           <a class="fancyboxajax" href="{{url('admin/entry/quickpayment/'.$rowId.'/edit')}}">Edit</a>
                           <a class="delete" data-action-url="{{url('admin/entry/quickpayment/'.'delete/'.$rowId)}}" data-alert-title="Do You Want to Delete " data-alert-msg="Delete This Entry from this software">Delete</a>
                         @endif
                           
                         <?= Design::$dmClose ?>
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

      $(document).on('click','.copyThis',function(){
        
        var $temp = $("<input>");
        $("body").append($temp);
        var link = $(this).data("link");
        $temp.val(link).select();
        document.execCommand("copy");
        $temp.remove();
         $(this).data("link");
         $("span", this).text("Copied");
       });

      $(document).on('click','.copytrax',function(){
            var $temp = $("<input>");
            $("body").append($temp);
            var link = $(this).data("tanxid");
            $temp.val(link).select();
            document.execCommand("copy");
            $temp.remove();
         });
       });
   </script>
@endsection