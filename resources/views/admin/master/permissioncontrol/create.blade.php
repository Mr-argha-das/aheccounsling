@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}

<div class="row">

     <?php 
       $count = count($permissionList);
     unset($teamType['']);
      // unset($teamType[1]);
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
           <input type="checkbox" name="pr_group_id[<?=$pr?>][<?=$valrow->route_id?>]" <?=$input?> style="    font-size: 20px;
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
        {{ Form::bsSubmit() }}
 
{{ Form::close() }}@endsection