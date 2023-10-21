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

<div class="block" style="border-radius:15px">
    <div class="block-content">
        <table class="table table-vcenter table-hover">
            <thead>
                <tr>
                    <th scope="col"><b>#</b></th>
                    <th scope="col"><b>Page Name</b></th>
                    <th scope="col"><b>Parent Category </b></th>
                    <th scope="col"><b>Alias</b></th>
                    <th scope="col"><b>Visibility</b></th>

                <th scope="col"><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach ($records as $ob) {
                    $rowId = $ob->menu_id;
                ?>
                    <tr>
                        <tD><?= $sr++ ?></tD>

                        <td>{{ $ob->menu_name }}</td>
                        <td><?=$catList[$ob->menu_parent]?></td>
                          <td>{{ $ob->menu_alias }}</td>
                       <td><?=!empty($ob->menu_show)?$status[$ob->menu_show]:''?></td>
                            <td>
                                <?= Design::$dmStart ?>
                                
                                    <a class="fancyboxajax" href="{{url($viewFolder.$rowId.'/edit')}}">Edit</a>
                          
                              <!--   <a class="fancyboxajax" href="{{url($viewFolder.$rowId)}}">view</a> -->

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