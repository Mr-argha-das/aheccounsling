@extends('layouts.'.config('backendLayout'))

@section('content')
<div class="block">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">Customer Name : {{ $row->cus_name }}</h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250"> </h6>
            </div>
            <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                   <!--  <a class="btn btn-primary fancyboxajax" href="<?=$viewpPath?>create"><i class="fa fa-plus mr-1"></i> Create New</a> -->
                </span>
            </div>
        </div>
    </div>
</div>



<div class="block">
        <div class="block-content text-center">
            <div class="py-4">
                <div class="mb-3">
                    <a href="<?=asset('assets/uploads/team/'.$row->cus_upload_pic)?>" data-fancybox="images" data-caption="My caption"><img class="img-avatar" src="<?=asset('assets/uploads/team/'.$row->cus_upload_pic)?>" alt=""></a>
                </div>
                <h1 class="font-size-lg mb-0">
                   {{ $row->cus_name }} 
                </h1>
                <p class="font-size-sm text-muted"> {{ $row->cus_email }} </p>
            </div>
        </div>
        <div class="block-content bg-body-light text-center">
            <div class="row items-push text-uppercase">
                <div class="col-6 col-md-3">
                    <a class="link-fx font-size-h3 text-primary" href="javascript:void(0)">Contact no.</a>
                    <div class="font-w600 text-dark mb-1"> <a href="javascript:;"><i class="fa fa-phone"></i> {{ $row->cus_mobile }}</a></div>
                    
                </div>
                <div class="col-6 col-md-3">
                    <a class="link-fx font-size-h3 text-primary" href="javascript:void(0)">Email Address</a>
                    <div class="font-w600 text-dark mb-1"> <a href="javascript:;"><i class="fa fa-envelope"></i>

                     {{ $row->cus_email }}</a></div>
                    
                </div>
                <div class="col-6 col-md-3">
                  
                    <a class="link-fx font-size-h3 text-primary" href="javascript:void(0)">Date Of Birth</a>
                      <div class="font-w600 text-dark mb-1"><a href="javascript:;"><?=$timedate->dateFormat($row->cus_dob,'out')?></a></div>
                </div>
                <div class="col-6 col-md-3">
                    <a class="link-fx font-size-h3 text-primary" href="javascript:void(0)">Date of anniversary</a>
                    <div class="font-w600 text-dark mb-1"><a href="javascript:;"><?=$timedate->dateFormat($row->cus_doa,'out')?></a></div>
                </div>
            </div>
        </div>
    </div>


<div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Basic Detials</h3>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-lg-6">
                    <div class="block block-bordered">
                        <div class="block-header border-bottom">
                            <h3 class="block-title">Basic Detials</h3>
                        </div>
                        <div class="block-content">
                            
                            <address class="font-size-sm"><strong>
                                <p> Addhar No. : {{ $row->cus_addhar}}</p>
                                <p> PAN No. : {{ $row->cus_pan}}</p>
                                <p> Alternet Mobile No : {{ $row->cus_alt_mobile}}</p>
                                <p> KYC Docs. : {{ $row->cus_kyc_docs}}</p>
                                <p> Address : {{ $row->cus_address}}</p>
                                <p> Account Created At : {{ $timedate->dateFormat($row->cus_create_date,'out') }}</p>
                               </strong>
                            </address>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="block block-bordered">
                        <div class="block-header border-bottom">
                            <h3 class="block-title">Bank Detials</h3>
                        </div>
                        <div class="block-content">
                            <div class="font-size-h4 mb-1">First Bank Detials</div>
                            <div class="row">
                                <div class="col-md-4">Bank Name</div><div class="col-md-8">{{ $row->cus_first_bank_name }}</div>
                                <div class="col-md-4">Bank IFSC</div><div class="col-md-8">{{ $row->cus_first_bank_ifsc }}</div>
                                <div class="col-md-4">Bank Account</div><div class="col-md-8">{{ $row->cus_first_bank_account }}</div>
                                <div class="col-md-4">Bank Branch</div><div class="col-md-8">{{ $row->cus_first_bank_branch }}</div>
                            </div>
                        <hr>
                           <div class="font-size-h4 mb-1">Other Bank Detials</div>
                            <div class="row">
                                <div class="col-md-4">Bank Name</div><div class="col-md-8">{{ $row->cus_second_bank_name }}</div>
                                <div class="col-md-4">Bank IFSC</div><div class="col-md-8">{{ $row->cus_second_bank_ifsc }}</div>
                                <div class="col-md-4">Bank Account</div><div class="col-md-8">{{ $row->cus_second_bank_account }}</div>
                                <div class="col-md-4">Bank Branch</div><div class="col-md-8">{{ $row->cus_second_bank_branch }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="block">
       
        <div class="block-content">

              <div class="block block-bordered">
                        <div class="block-header border-bottom">
                            <h3 class="block-title">Visits</h3>
                        </div>
              <div class="block-content">

                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Visit Discussion</th>
                            <th>Next Meating Due</th>
                        </tr>

                        <?php 
                        $srs = 1;
                        foreach($visitsGet as $rk){

                         ?>
                        <tr>
                            <td>{{ $srs++ }}</td>
                            <td>{{ $timedate->dateFormat($rk->visits_date,'out') }}</td>
                            <td>{{ $rk->visits_desc }}</td>
                            <td>{{ $rk->visits_next_due }} </td>
                        <?php } ?>
                        </tr>
                    </table>

               </div>
             </div>
               
        </div>
    </div>
 <div class="block-header border-bottom">
                            <h3 class="block-title">Uploaded Documents</h3>
                        </div>
   <div class="row">
       
    <?php if(!empty($multifiles)){
        foreach($multifiles as $files)
        {
             $ext = pathinfo($files->multi_customer_doc_name, PATHINFO_EXTENSION);  
             if($ext ==='jpg' || $ext ==='png' || $ext ==='jpeg'){
                ?>
                 <div class="col-4">
            <a class="block block-link-shadow text-center" href="<?=asset('assets/uploads/customer/'.$files->multi_customer_doc_name)?>">
                <div class="block-content block-content-full">
                    <img src="<?=asset('assets/uploads/customer/'.$files->multi_customer_doc_name)?>" width="150" height="150" alt="">
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="font-w600 font-size-sm text-muted mb-0">
                     <?=$files->multi_customer_doc_title?>
                </div>
            </a>
        </div><?php
             }else{
         ?>
           <div class="col-4">
            <a class="block block-link-shadow text-center" href="<?=asset('assets/uploads/customer/'.$files->multi_customer_doc_name)?>">
                <div class="block-content block-content-full">
                    <div class="font-size-h2 text-dark">
                        <i class="fa fa-file-pdf"></i>
                    </div>
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="font-w600 font-size-sm text-muted mb-0">
                     <?=$files->multi_customer_doc_title?>
                </div>
            </a>
        </div>

         <?php   } 
        }
    } ?>
      
       
    </div>
@endsection