@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')

<style type="text/css">
    .altms {

        border-radius: 0%;
        background: #fff;
        box-sizing: border-box;
        box-shadow: 1px 2px 6px #555;
    }

    .delbtns {
        font-size: 27px;
        color: #776666;
    }
</style>
<div class="row">

    <div class="col-md-12">

        <b>Personal Infomation</b>
        <hr />
    </div>

    <div class="col-md-6 ">
        {{ Form::bsText('team_name',$row->team_name,['label'=>$niceNames]) }}
    </div>
    <div class="col-md-6 ">
        {{ Form::bsText('team_email',$row->team_email,['label'=>$niceNames,'disabled'=>true]) }}
    </div>

    {{ Form::hidden('team_type', $row->team_type) }}

    <div class="col-md-6 ">
       
        {{ Form::bsView('team_type',$teamType[$row->team_type],['label'=>$niceNames['team_type']]) }}
    </div>
  

    <div class="col-md-6 ">
        {{ Form::bsText('team_password',$row->team_password,['label'=>$niceNames]) }}
    </div>
   
</div>
<div class="row">
    <div class="col-md-12">
    <h5>Set Permission For access all functionally</h5>
    </div>
    <div class="col-md-12">
<?php 
$dtarray =[];
if(!empty($findlistdata))
{
    foreach ($findlistdata as $key => $value) {
        $dtarray[$value->allot_type_id] = $value->allot_type_id;
    }
}
?>
        <table class="table table-bordered table-striped table-sm">
            
            <?php  
                    foreach ($allotTypelist as $key => $value) {
                    $name = $value['title'];
                    $row = $value['rowdata'];
            ?>
           
                <tr class="bg-primary mt-3">
                    <th colspan="2" class="text-white">{{ $name }}</th>
                </tr>
          
                <?php if(!empty($row)){
                foreach ($row as $key => $dd) {
                    $checked ='';
                    if(!empty($dtarray[$dd->nv_id]))
                    {
                        $checked = 'checked';
                    }

                   ?>
                <tr>
                    <td>{{ $dd->nv_name }}</td>
                    <td> <input type="checkbox" name="nv_id[<?=$dd->nv_id?>]" <?=$checked?>  style="    font-size: 20px;
    height: 27px;
    width: 49%;" value="{{   $dd->nv_id }}"></td>
                </tr>
            <?php } } ?>
        

        <?php } ?>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        {{ Form::bsSubmit() }}
    </div>
</div>

{{ Form::close() }}
@endsection