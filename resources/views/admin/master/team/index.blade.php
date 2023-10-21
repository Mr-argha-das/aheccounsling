@extends('layouts.'.config('backendLayout'))

@section('content')

<div class="block"  style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $title }}</h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Master / {{ $title }} </h6>
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
<div class="col-md-4 ">
    {{ Form::bsText('filter_team_name','GET_METHOD',['label'=>$niceNames['team_name']]) }}
</div>
<div class="col-md-4 ">
    {{ Form::bsText('filter_team_email','GET_METHOD',['label'=>$niceNames['team_email']]) }}
</div>
<div class="col-md-4 ">
    {{ Form::bsSelect('filter_team_type',$teamType,'GET_METHOD',['label'=>$niceNames['team_type']]) }}
</div>

<?=Design::$filterClose?>



<?=Design::tableSectionStart($title.' List')?>
<table class="table table-vcenter table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Change-status</th>
            <th>Actions</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
    $sr = 1;
                       foreach($records as $ob)
                       {
                           $rowId= $ob->team_id;
                           //dd($ob->student_dob);
        ?>
        <tr>
            <td><?=$sr++?></tD>
            <td><?=$ob->team_name?></td>
            <td><?=$ob->team_email?></td>
            <td><?=$teamType[$ob->team_type]?></td>
            <td>
              @if($ob->team_status==1)
                 <button type="button" class="btn btn-primary mt-5 px-4 py-2" ><a style="color: black;" href="https://www.ahecounselling.com/admin/master/team/status/{{$rowId}}/2">InActive</a> </button>
                @else
                  <button type="button" class="btn btn-warning mt-5 px-4 py-2"><a href="https://www.ahecounselling.com/admin/master/team/status/{{$rowId}}/1">Active</a> </button>
                @endif
              </td>
         
            <td>
                <?=Design::$dmStart?>
                <a class="fancyboxajax" href="{{url($viewFolder.$rowId.'/edit')}}">Edit</a>
                <a class="fancyboxajax" href="{{url($viewFolder.$rowId)}}">view</a>
                 <a class="delete" data-action-url="{{url($viewFolder.'delete/'.$rowId)}}" data-alert-title="Do You Want to Delete " data-alert-msg="Delete This Entry from this software">Delete</a>
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