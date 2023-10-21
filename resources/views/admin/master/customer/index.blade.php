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
                    <a class="btn btn-primary fancyboxajax" href="<?=$viewpPath?>create"><i class="fa fa-plus mr-1"></i> Create New</a>
                </span>
            </div>
        </div>
    </div>
</div>

<?=Design::$filterStart?>
<div class="col-md-3 ">
    {{ Form::bsText('filter_cus_name','GET_METHOD',['label'=>$niceNames['cus_name']]) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsText('filter_cus_family','GET_METHOD',['label'=>$niceNames['cus_family']]) }}
</div>

<div class="col-md-3 ">
    {{ Form::bsText('filter_cus_email','GET_METHOD',['label'=>$niceNames['cus_email']]) }}
</div>
<?=Design::$filterClose?>



<?=Design::tableSectionStart($title.' List')?>
<table class="table table-vcenter table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th >Name</th>
            <th>Image</th>
            <th >Email</th>
            <th >Team</th>
            <th >Category</th>
            <th >Addhar No.</th>
            <th>Mobile No.</th>
            <th >DOB</th>
            <th>Date of Anniversary</th>
            <th >Actions</th>
            
        </tr>
    </thead>
    <tbody>
        <?php

    $sr = 1;
                       foreach($records as $ob)
                       {
                           $rowId= $ob->cus_id;
                           //dd($ob->student_dob);
        ?>
        <tr>
            <td><?=$sr++?></tD>
            <td><?=$ob->cus_name?></td>
            <td><a href="<?=asset('assets/uploads/customer/'.$ob->cus_upload_pic)?>" class="images" data-fancybox="images" data-caption="My caption"><img src="<?=asset('assets/uploads/customer/'.$ob->cus_upload_pic)?>" width="60" class="img img-thumbnail
                "></a></td>
            <td><?=$ob->cus_email?></td>
            <td><?php ?></td>
            <td><?=$categorylis[$ob->cus_category]?></td>
            
            <td><?=$ob->cus_addhar?></td>
            <td><?=$ob->cus_mobile?></td>
            <td><?=$timedate->dateFormat($ob->cus_dob,'out')?></td>
            <td><?=$timedate->dateFormat($ob->cus_doa,'out')?></td>
            

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

<?=Design::tableSectionClose()?>
@endsection