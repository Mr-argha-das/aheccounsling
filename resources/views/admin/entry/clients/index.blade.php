@extends('layouts.'.config('backendLayout'))

@section('content')


<div class="block">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $title }} </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">Dashboard / My Clients / {{ $title }} </h6>
            </div>
      
               <!--  <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary fancyboxajax" href="<?= $viewpPath ?>create"><i class="fa fa-plus mr-1"></i> Create New</a>
                    </span>
                </div> -->
    
        </div>
    </div>
</div>

<div class="block">
    <div class="table-vcenter table-responsive">
        <table class="table  table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Register Date</th>
                     
                  
                </tr>
            </thead>
            <tbody>
                <?php
                      $sr = 1;
                    foreach ($records as $ob) { ?>
                    <tr>
                        <td><?= $sr++ ?></td>
                        <td>{{ $ob->user_name }}</td>
                        <td>{{ $ob->user_email }}</td>
                        <td>+{{ $ob->phone_code.' '.$ob->mobile }}</td>
                        <td>{{ date('d-m-Y',strtotime($ob->user_created_at)) }}</td>
            
                 <?php } ?>
          </tr>
          
            </tbody>
        </table>

        <hr>
        {{ $pagination->render() }}



    </div>
</div>
@endsection