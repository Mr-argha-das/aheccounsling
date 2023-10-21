@extends('layouts.'.config('backendLayout'))

@section('content')
<div class="block">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $title }}</h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">Dashboard / Report / {{ $title }} </h6>
            </div>
            <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                   <!--  <a class="btn btn-primary fancyboxajax" href="<?=$viewpPath?>create"><i class="fa fa-plus mr-1"></i> Create New</a> -->
                 <!--   <button type="button" formmethod="get" class="btn btn-sm btn-success">Export Excel</button> -->
                </span>
            </div>
        </div>
    </div>
</div>
<?=Design::$filterStart?>
<div class="col-md-3 ">
    {{ Form::bsSelect('filter_month',$arraydb->getMonth(),'GET_METHOD',['label'=>'Month Name']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsSelect('filter_year',$arraydb->getYear(),'GET_METHOD',['label'=>'Year']) }}
</div>



<?=Design::$filterClose?>


<?=Design::tableSectionStart($title.' List')?>
<h3>
<?=!empty($_GET['filter_month'])?$arraydb->getMonth()[$_GET['filter_month']].' - ':''?>
<?=!empty($_GET['filter_year'])?$arraydb->getYear()[$_GET['filter_year']]:''?>
</h3>
<div class="row">
    <div class="cold-md-4 ml-3">
        <span class="badge badge-secondary p-2">Hollyday</span>
        <span class="badge badge-info p-2">Sunday</span>
    </div>
    <div class="cold-md-8 ml-2">
        <div class="row ">
            <div class="col-md-4">
                <span class="badge badge-primary p-2">P</span> Present 
            </div>
              <div class="col-md-4">
                 <span class="badge badge-danger p-2">A</span> Absent
            </div>
              <div class="col-md-4">
                 <span class="badge badge-info p-2">H</span> Half Day
            </div>
        </div>
       
    </div>
</div>
<table class="table table-bordered table-sm mt-2">
  
<tr><th colspan="<?=!empty($record)?count($record)+1:2?>" class="text-center"><?=!empty($_GET['filter_month'])?$arraydb->getMonth()[$_GET['filter_month']].' - ':''?>
        <?=!empty($_GET['filter_year'])?$arraydb->getYear()[$_GET['filter_year']]:''?> ( Days ) </th></tr>
<tr><td>Employee List</td><?php if(!empty($record)){ foreach ($record as $as => $dt) {

    $findHO = '';
    if(!empty($dt['sunday']))
    {
        $findHO = 'bg-primary  text-white';
       
    }else if(!empty($dt['hollyday']))
    {
        $findHO = 'bg-secondary text-white';
        $colspan = !empty($Attendance)?count($Attendance):1;
    }else{
           $findHO = '';
           $colspan = 1;
    }

?><td class="<?=$findHO?>" ><?=$dt['day_name']?><br><?=$dt['day']?></td><?php }  } ?></tr>
<?php if(!empty($Attendance)){
    foreach ($Attendance as $key => $value) {
        $obj = $value;
        $team = (Object) $value['teams'];
     ?>
<tr><td><?=$team->team_name?></td><?php if(!empty($obj['montlyAttendance'])){ foreach ($obj['montlyAttendance'] as $as => $dts) {

  
 $symbol = '';
 $class = '';
    if(empty($dts['attendance_status']))
    {   
           $symbol = '';
           $class = '';

    }else if($dts['attendance_status'] == 1 )
    {
            $class = 'badge badge-primary text-white';
           $symbol = '<b class="text-white font-weight-bold">P</b>';
    }
    else if($dts['attendance_status'] == 2 )
    {
        $class = 'badge badge-danger text-white';
           $symbol = '<b class="text-white font-weight-bold">A</b>';
    }
    else if($dts['attendance_status'] == 3 )
    {
        $class = 'badge badge-info text-white';
           $symbol = '<b class="text-white font-weight-bold">H</b>';
    }else{
           $class = '';
           $symbol = '';
    }

$colspans = 1;
    $findHO = '';
    if(!empty($dts['sunday']))
    {   
        if(empty($dts['attendance_status'])) 
        {
           $findHO = 'bg-info text-info';
             $class = 'bg-info text-info';
             $symbol = '<b class="text-info font-weight-bold"></b>';
            $colspans = !empty($Attendance)?count($Attendance):1;

        }
    }else if(!empty($dts['hollyday']))
    {
        $findHO = 'bg-secondary text-secondary';
         $class = 'bg-secondary text-secondary';
           $symbol = '<b class="text-secondary font-weight-bold"></b>';
            $colspans = !empty($Attendance)?count($Attendance):1;
    }else{
        
    }

?><td class="<?=$findHO?>" ><?=!empty($symbol)?'<span class="'.$class.'">'.$symbol.'</span>':''?></td><?php }  } ?></tr>
<?php }  } ?>
 </table>

<?=Design::tableSectionClose()?>



@endsection