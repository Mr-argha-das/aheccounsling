@extends('layouts.'.config('backendLayout'))

@section('content')


<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $title }} </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Entry / {{ $title }} </h6>
            </div>
      
               <!--  <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary fancyboxajax" href="<?= $viewpPath ?>create"><i class="fa fa-plus mr-1"></i> Create New</a>
                    </span>
                </div> -->
    
        </div>
    </div>
</div>

<div class="block" style="border-radius:15px">
    <div class="table-vcenter table-responsive">
        <table class="table  table-hover">
            <thead>
                <tr>
                    <th><b>#</b></th>
                    <th><b>Date</b></th>
                    <th><b>Name</b></th>
                    <th><b>Email</b></th>
                    <th><b> Mobile</b></th>
                    <th><b> Service</b></th>
                    <th><b> Subject</b></th>
                    <th><b> Query</b></th>
                    <th> <b>RmId</b></th>
                    <th><b>Screenshot</b></th>
                    <th><b>Attached-1</b></th>
                    <th><b>Attached-2</b></th>
                    <th><b>Attached-3</b></th>
                    <th><b>Actions</b></th>
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
                        <td>{{ date('d-m-Y',strtotime($ob->en_created_at)) }}</td>
                        <td>{{ $ob->en_first_name }} {{ $ob->en_last_name }}</td>
                        <td>{{ $ob->en_email }}</td>
                        <td>+{{ $ob->phone_code.' '.$ob->en_mobile }}</td>
                        <td>{{ $ob->services_name }}</td>
                        <td>{{ $ob->en_subject }}</td>
                        <td>{{ $ob->en_query }}</td>
                        <td>{{ $ob->rm_id }}</td>
            <td>
                <?php if(!empty($ob->Screenshot)){
                    ?>
                    <a href="{{ asset('assets/uploads/enquiry/'.$ob->Screenshot) }}" target="_blank" class="btn btn-primary btn-sm px-3 py-2">View Screenshot </a>
                    <?php
                }
                ?>
              </td>
              <td>
                <?php if(!empty($ob->en_attachment)){
                    ?>
                    <a href="{{ asset('assets/uploads/enquiry/'.$ob->en_attachment) }}" target="_blank" class="btn btn-primary btn-sm">Download File</a>
                    <?php
                }
                ?>
              </td>
               <td>
                <?php if(!empty($ob->en_attachment_2)){
                    ?>
                    <a href="{{ asset('assets/uploads/enquiry/'.$ob->en_attachment_2) }}" target="_blank" class="btn btn-primary btn-sm">Download File</a>
                    <?php
                }
                ?>
              </td>
               <td>
                <?php if(!empty($ob->en_attachment_3)){
                    ?>
                    <a href="{{ asset('assets/uploads/enquiry/'.$ob->en_attachment_3) }}" target="_blank" class="btn btn-primary btn-sm">Download File</a>
                    <?php
                }
                ?>
              </td>
                      
            <td>
                <?= Design::$dmStart ?>
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