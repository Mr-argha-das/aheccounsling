@extends('layouts.'.config('backendLayout'))

@section('content')


<div class="block">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">Testing</h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">Dashboard / Test List</h6>
            </div>
            <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                    <a class="btn btn-primary fancyboxajax" href="<?=$Addpath?>create"><i class="fa fa-plus mr-1"></i> Create New</a>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="block">
    <div class="block-content">
        <table class="table table-vcenter table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Test Name</th>
                    <th scope="col">Test Status</th>
                    <th scope="col">Date</th>
                  
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
    $sr = 1;
   foreach($records as $ob)
   {
       $rowId= $ob->test_id;
       //dd($ob->student_dob);
                ?>
                <tr>
                    <tD>{{ $sr++ }}</tD>
                    <td>{{ $ob->test_name }}</td>
          
                    <td>{{ $statusDropdown[$ob->test_status] }}</td>

                    <td>{{ $timedate->dateFormat($ob->test_date,'out') }}</td>
                   
                    <td>
                     
                        <?=Design::$dmStart?>
                        <a class="fancyboxajax" href="{{url($Editpath.$rowId.'/edit')}}">Edit</a>
                        <a class="fancyboxajax" href="{{url($Editpath.$rowId)}}">view</a>
                       <a href="{{$ActPath.$rowId}}">Activity</a>
                        <?=Design::$dmClose?>
                    </td>
                </tr>
                <?php
   }
                ?>
            </tbody>
        </table>

        <hr>
        {{ $pagination->render() }}



    </div>
</div>
@endsection
