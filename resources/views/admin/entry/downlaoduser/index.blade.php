@extends('layouts.'.config('backendLayout'))

@section('content')


<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $title }} </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Master / {{ $title }} </h6>
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
    <div class="block-content">
        <table class="table table-vcenter table-hover myTable">
            <thead>
                <tr>
                    <th scope="col"><b>#</b></th>
                    <th scope="col"><b>Name</b></th>
                    <th scope="col"><b>Email</b></th>
                    <th scope="col"><b>Phone no</b></th>
                    <th scope="col"><b>Project name</b></th>
                    <th scope="col"><b>Date</b></th>
                 </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach ($records as $ob) {
                    $rowId = $ob->id;
                ?>
                    <tr>
                        <tD><?= $sr++ ?></tD>

                        <td>{{ $ob->name }}</td>

                        <td>{{ $ob->email }}</td>

                        <td>+{{ $ob->code.' '.$ob->phone }}</td>

                        <td>{{ $ob->project_list->title }}</td>
                        <td>{{ date('d-m-Y',strtotime($ob->create_at)) }}</td>

                            <?php } ?>
                    </tr>
          
            </tbody>
        </table>

        <hr>
        {{ $pagination->render() }}



    </div>
</div>
@endsection