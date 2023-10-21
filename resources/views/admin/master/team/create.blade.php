@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction,'files' => true)) }}
<script type="text/javascript" src="{{ asset('/js/fileupload.js') }} "></script>


<div class="row">

    <div class="col-md-12">

        <b>Personal Infomation</b>
        <hr />
    </div>

    <div class="col-md-6 ">
        {{ Form::bsText('team_name','',['label'=>$niceNames]) }}
    </div>
    <div class="col-md-6 ">
        {{ Form::bsText('team_email','',['label'=>$niceNames]) }}
    </div>
    <div class="col-md-6 ">
    
        {{ Form::bsSelect('team_type',$teamType,'',['label'=>$niceNames]) }}
    </div>
    <div class="col-md-6 ">
        {{ Form::bsText('team_password','',['label'=>$niceNames]) }}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <h5>Set Permission For access all functionally</h5>
    </div>
    <div class="col-md-12">

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
                   ?>
                <tr>
                    <td>{{ $dd->nv_name }}</td>
                    <td> <input type="checkbox" name="nv_id[<?=$dd->nv_id?>]"  style="    font-size: 20px;
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