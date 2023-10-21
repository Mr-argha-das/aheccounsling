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
                </span>
            </div>
        </div>
    </div>
</div>


<?=Design::$filterStart?>
<?php
   
    if(empty($ttl))
    {
        $col = 4;
        ?>
        <?php 
    }else{
        $col = 6;
    }

    
 ?>

<div class="col-md-{{$col}} ">
    {{ Form::bsSelect('filter_year',$getYear,'GET_METHOD',['label'=>'Year']) }}
</div>
<div class="col-md-{{$col}} ">
    {{ Form::bsSelect('filter_month',$getMonth,'GET_METHOD',['label'=>'Month']) }}
</div>
<?php if(empty($ttl)){ ?>
<div class="col-md-{{$col}}">
    {{ Form::bsSelect('filter_user_id',$teamList,'GET_METHOD',['label'=>'Team Member']) }}
</div>
<?php  } ?>

<div class="col-md-12">
                <input class="btn btn-info" type="submit" value="Submit">
                <a class="btn btn-secondary ml-2" href="{{ url()->current()}} ">Reset</a>
             <!--    <input class="btn btn-primary" type="submit" formaction="{{ url()->current().'/getExcelDownload' }}"  value="export Excel"> -->
            </div>
        </div>
        </form></div></div></div>


<?=Design::tableSectionStart($title.' List')?>
<table class="table table-bordered table-striped">
 <tr><td colspan="2">Month</td><td>Task</td><td>Frequency</td><td>Monthly</td><td>Fortnightly</td><td>Weekly</td><td>Team Member</td></tr>
    <?php
                foreach($record as $sk)
                {
                   
                    if(strlen($sk['key']->op_month) > 1)
        {
            $str = $sk['key']->op_month;
        }else{
              $str = '0'.$sk['key']->op_month;
        }
                ?>
                 <tr><td colspan="2" ><span class="badge badge-alert badge-info p-2"><?=$getMonth[$str]?> / <?=$sk['key']->op_year?></span></td><td>{{$sk['key']->task_name}} </td><td><span class="badge badge-secondary p-2">{{ $numberrange[$sk['key']->task_frequency ] }}</span></td>
                    <?php $cols = count($sk['rows']);
                    $subs = 3 - $cols;

                    foreach($sk['rows'] as $rk)
                    {
                        ?><td>{{ $rk->op_desc }}</td><?php
                    }
                   
                    if(!empty($subs))
                    {
                        $std = range(1,$subs);
                        foreach($std as $dd )
                        {
                            ?><td></td><?php
                        }
                    }
                 ?>
                 <td>{{ $teamList[$rk->op_user_id] }}</td>
                </tr>


                <?php
               }
            
     ?>
   


    
</table>
<?=Design::tableSectionClose()?>



@endsection