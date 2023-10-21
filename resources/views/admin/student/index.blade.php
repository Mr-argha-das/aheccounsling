@extends('layouts.'.config('backendLayout'))

@section('content')


<div class="block">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">Students</h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">Dashboard / Student List</h6>
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
                    <th scope="col">Name</th>
                    <th scope="col">Class</th>
                    <th scope="col">Dob</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Update Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
    $sr = 1;
   foreach($records as $ob)
   {
       $rowId= $ob->student_id;
       //dd($ob->student_dob);
                ?>
                <tr>
                    <tD><?=$sr++?></tD>
                    <td><?=$ob->student_name?></td>
                    <td><?=$ob->student_class?></td>
                    <td><?=$timedate->dateFormat($ob->student_dob,'out')?></td>
                    <td>{{ $statusDropdown[$ob->student_status] }}</td>
                    <td>{{ $timedate->dateFormat($ob->student_creation_date,'timestampOut') }}</td>
                    <td>{{ $timedate->dateFormat($ob->student_last_update,'timestampOut') }}</td>
                    <td>
                        <?=Design::$dmStart?>
                        <a class="fancyboxajax" href="{{url($viewFolder.$rowId.'/edit')}}">Edit</a>
                        <a class="fancyboxajax" href="{{url($viewFolder.$rowId)}}">view</a>
                        <form action="{{url($viewFolder.$rowId)}}" method="post">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="waves-effect" type="submit">Delete</button>
                        </form>
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
