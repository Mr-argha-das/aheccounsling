@extends('layouts.'.config('backendLayout'))

@section('content')

<div class="block">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $title }}</h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">Dashboard / Master / {{ $title }} </h6>
            </div>
            <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                    
                </span>
            </div>
        </div>
    </div>
</div>





<?=Design::tableSectionStart($title.' List')?>
        <table class="table table-vcenter table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Entry</th>
                    <th scope="col">Activity</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
    $sr = 1;
   foreach($records as $ob)
   {
       $rowId= $ob->vehicle_id;
       //dd($ob->student_dob);
                ?>
                <tr>
                    <tD><?=$sr++?></tD>

                    <td><?=$ob->name?></td>
                    <td ><?=$ob->log_title?></td>
                    <td><?=$logType[$ob->log_type]?></td>
                    <td >{{ $timedate->dateFormat($ob->log_timestamp,'timestampOut') }}</td>
                   
                    
                </tr>
                <?php
   }
                ?>
            </tbody>
        </table>
<hr>
{{ $pagination->render() }}

<?=Design::tableSectionClose()?>
@endsection
