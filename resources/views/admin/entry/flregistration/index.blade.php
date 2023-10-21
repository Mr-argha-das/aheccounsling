@extends('layouts.'.config('backendLayout'))

@section('content')


<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $title }} </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Entry / {{ $title }} </h6>
            </div>
      
                <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary fancyboxajax" href="<?= $viewpPath ?>create"><i class="fa fa-plus mr-1"></i> Create New</a>
                    </span>
                </div>
    
        </div>
    </div>
</div>

<div class="block p-3" style="border-radius:15px">
    <div class="table table-vcenter table-hover table-responsive">
        <table class="myTable">
            <thead>
                <tr>
                    <th><b> #</b></th>
                    <th><b> Name</b></th>
                    <th><b> Email</b></th>
                    <th><b> Mobile</b></th>
                    <th><b> Address</b></th>
                    <th><b> Bank Name</b></th>
                    <th><b> A/C No.</b></th>
                    <th><b> IFSC Code</b></th>
                    <th><b>Branch</b></th>
                    <th><b>AdharCard No</b></th>
                    <th><b>Pancard No</b></th>
                    <th><b>Action</b></th>
                     
                </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach ($records as $ob) {
                    $rowId = $ob->af_id;
                ?>
                    <tr>
                        <tD><?= $sr++ ?></tD>
                        <td>{{ $ob->af_name }}</td>
                        <td>{{ $ob->af_email }}</td>
                        <td>+{{ $ob->country_code.' '.$ob->af_mobile }}</td>
                        <td>{{ $ob->af_address }}</td>
                        <td>{{ $ob->bank_name }}</td>
                        <td>{{ $ob->bank_no }}</td>
                        <td>{{ $ob->bank_ifsc }}</td>
                        <td>{{ $ob->bank_branch }}</td>
                        <td>{{ $ob->aadhar_number }}</td>
                        <td>{{ $ob->pan_number }}</td>
                       <td>
                        <?= Design::$dmStart ?>
                        
                        <a class="fancyboxajax" href="{{url($viewFolder.$rowId.'/edit')}}">Edit</a>
                          <a class="delete" data-action-url="{{url($viewFolder.'delete/'.$rowId)}}" data-alert-title="Do You Want to Delete " data-alert-msg="Delete This Entry from this software">Delete</a>   
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