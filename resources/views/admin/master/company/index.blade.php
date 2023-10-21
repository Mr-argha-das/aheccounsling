@extends('layouts.'.config('backendLayout'))

@section('content')


<div class="block">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $title }} </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">Dashboard / Master / {{ $title }}  </h6>
            </div>
            <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                    <a class="btn btn-primary fancyboxajax" href="<?=$viewpPath?>create"><i class="fa fa-plus mr-1"></i> Create New</a>
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
                    <th scope="col"> Company Name</th>
                    <th scope="col"> Contact Person</th>
                    <th scope="col"> Mobile Number</th>
                    <th scope="col"> Landline Number</th>
                    
                    <th scope="col">Address </th>
                    <th>Status</th>
                    
                 
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
    $sr = 1;
   foreach($records as $ob)
   {
       $rowId= $ob->com_id;
       //dd($ob->student_dob);
                ?>
                <tr>
                    <tD><?=$sr++?></tD>
                    <td><?=$ob->com_name?></td>
               
                    <td><?=$ob->com_person?></td>
                    <td><?=$ob->com_mob?></td>
                    <td><?=$ob->com_landline?></td>
                         <td><?=$ob->com_address?></td>
                    <td><?=$statusDropdown[$ob->com_status]?></td>

                 
                    <td>
                        <?=Design::$dmStart?>
                        <a class="fancyboxajax" href="{{url($viewFolder.$rowId.'/edit')}}">Edit</a>
                        <a class="fancyboxajax" href="{{url($viewFolder.$rowId)}}">view</a>
                       
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
