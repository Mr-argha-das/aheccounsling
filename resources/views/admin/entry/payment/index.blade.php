@extends('layouts.'.config('backendLayout'))

@section('content')


<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $title }} </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Master / {{ $title }} </h6>
            </div>
         </div>
    </div>
</div>

 

<div class="block p-3" style="border-radius:15px">
    <div class="block-content">
        <table class="table table-vcenter table-hover">
            <thead>
                <tr>
                     
                    <th><b>RM</b></th>
                    <th><b>Full Name</b></th>
                    <th><b>Email</b></th>
                    <th><b>Amount</b></th>
                    <th><b>Txn-Id </b></th>
                    <th><b>Status</b></th>
                    <th><b>Created_at</b></th>
                    <th><b>updated_at</b></th>
                    <th><b>Actions</b></th>
                     
                </tr>
            </thead>
            <tbody>
                  <?php  
                     foreach ($records as $ob) {
                     $rowId = $ob->id;  

                     switch($ob->payment_status){ 
                     case "success":
                       $class ='btn btn-success btn-sm';break;
                     case "failure":
                       $class ='btn btn-danger btn-sm';break;
                     case "pending":
                       $class ='btn btn-info btn-sm';break;
                        default:
                         $class ='btn btn-info btn-sm';
                    }


                      ?>
                    <tr>
                         <td>{{ $ob->rm_user }}</td>
                         <td>{{ $ob->firstname }} {{ $ob->Lastname }}</td>
                         <td>{{ $ob->email }}</td>
                         <td>{{ $ob->symbol.' '.$ob->amount }}</td>
                         <td>{{ $ob->txnid }}</td>
                         <td class="{{$class}}">{{ $ob->payment_status }}</td>
                         <td>{{ date('d-M-y h:i:s a',strtotime($ob->created_at)) }}</td>
                         <td>{{ date('d-M-y h:i:s a',strtotime($ob->updated_at)) }}</td>
                          <td>
                            <?= Design::$dmStart ?>
                            <?php if($ob->payment_status=="success"){ ?>
                              <a  target="_blank" href="{{route('success', ['id' => base64_encode($rowId)])}}">view</a>
                            <?php }else if($ob->payment_status=="failure"){ ?>

                              <a  target="_blank" href="{{route('failed', ['id' => base64_encode($rowId)])}}">view</a>

                             <?php } ?>
                            
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
@endsection