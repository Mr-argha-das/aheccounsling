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
       
<div class="row">

     <?php 


       $count = count($permissionList);
     unset($teamType['']);
     //  unset($teamType[1]);
        $inputData = [];
        foreach($records as $rec)
        {
            $inputData[$rec->pr_group_id][$rec->pr_parent_id] = 'checked';
        }
       
     ?>


     <table class="table table-bordered table-striped">
          <?php 
       $count = count($permissionList);
     foreach($teamType as $pr =>$vals)
     {
      if(!empty($vals)){
       ?>
        <tr> <th rowspan="{{ $count+1 }}"><span class="badge badge-primary" style="font-size: 18px;">{{ $vals }}</span></th><th>Name / Title</th><th>URL</th><th>Actions</th>
       <?php
       foreach($permissionList as $key =>$valrow)
       {
                $input ='';
                if(!empty($inputData[$pr][$valrow->route_id])){
                    $input = $inputData[$pr][$valrow->route_id];
                }
        ?>
         <tr><td>{{ $valrow->route_title }}</td><td><input type="text" value="{{ $valrow->route_key }}" readonly /></td><td>
           <input type="checkbox" name="pr_group_id[<?=$pr?>][<?=$valrow->route_id?>]" <?=$input?> disabled style="    font-size: 20px;
    height: 27px;
    width: 49%;" value="{{   $valrow->route_id }}">
         </td></tr>
        <?php
       }?>
       </tr><?php }
     } 
     ?>

     
       

     

     </table>
      
</div>
</div>
@endsection
