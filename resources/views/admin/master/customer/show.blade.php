@extends('layouts.'.config('backendLayout'))
@section('content')
@include('blocks/panelHeading',['title'=>$title])
<div class="row">
<?php 
$documentuploadInfo = array(
                         'data-upload-path'=>'assets/uploads/customer',
                         'data-upload-url'=>route('ajaxUploadFile'),
                         'data-delete-url'=>route('deletefile'),
                         'data-name'=>'multi_customer_doc_name',
                         'data-title'=>'multi_customer_doc_title',
                     );
$uploadData =NULL;
foreach($documentuploadInfo as $key =>$val)
{
    $uploadData.=$key.'='.$val.'  ' ;
}


$imgDataUpload = array(
                         'data-upload-path'=>'assets/uploads/customer',
                         'data-upload-url'=>route('ajaxuploadimage'),
                         'data-delete-url'=>route('deletefile'),
                         'data-name'=>'cus_upload_pic',
                     );
$uploadDatanof =NULL;
foreach($imgDataUpload as $key =>$val)
{
    $uploadDatanof.=$key.'='.$val.'  ' ;
}

?>

<div class="row">

    <div class="col-md-12">
        
        <b>Personal Infomation</b>
        <hr />
    </div>

    <div class="col-md-4 ">
        {{ Form::bsView('cus_name',$row->cus_name,['label'=>$niceNames['cus_name']]) }}
    </div>
      <div class="col-md-4 ">
        {{ Form::bsView('cus_family',$FamilyList[$row->cus_family],['label'=>$niceNames['cus_family']]) }}
    </div>

  <div class="col-md-4 ">
        {{ Form::bsView('cus_mobile',$row->cus_mobile,['label'=>$niceNames['cus_mobile']]) }}
    </div>

  <div class="col-md-4 ">
        {{ Form::bsView('cus_alt_mobile',$row->cus_alt_mobile,['label'=>$niceNames['cus_alt_mobile']]) }}
    </div>
      <div class="col-md-8">
        {{ Form::bsView('cus_address',$row->cus_address,['label'=>$niceNames['cus_address']]) }}
    </div>

  <div class="col-md-4 ">
        {{ Form::bsView('cus_email',$row->cus_email,['label'=>$niceNames['cus_email']]) }}
    </div>



  <div class="col-md-4 ">
        {{ Form::bsView('cus_dob',$timedate->dateFormat($row->cus_dob,'out'),['label'=>$niceNames['cus_dob']]) }}
    </div>

  <div class="col-md-4 ">
        {{ Form::bsView('cus_doa',$timedate->dateFormat($row->cus_doa,'out'),['label'=>$niceNames['cus_doa']]) }}
    </div>

  <div class="col-md-4 ">
        {{ Form::bsView('cus_pan',$row->cus_pan,['label'=>$niceNames['cus_pan']]) }}
    </div>

  <div class="col-md-4 ">
        {{ Form::bsView('cus_addhar',$row->cus_addhar,['label'=>$niceNames['cus_addhar']]) }}
    </div>


  <div class="col-md-4 ">
        {{ Form::bsView('cus_kyc_docs',$row->cus_kyc_docs,['label'=>$niceNames['cus_kyc_docs']]) }}

    </div>
    <div class="col-md-4">
 
      {{ Form::bsView('cus_category',$categorylis[$row->cus_category],['label'=>$niceNames['cus_category']]) }}
  </div>
 <div class="col-md-4">
 
      {{ Form::bsView('cus_team_id',$teamList[$row->cus_team_id],['label'=>$niceNames['cus_team_id']]) }}
  </div>
    <div class="col-md-4 ">
        
        <label>Upload Profile Photo</label>
        
        <?php  $imglink = asset($imgDataUpload['data-upload-path'].'/'.$row->cus_upload_pic); ?>
        <div class="imgupload" style="display: block;">
            <?php if(!empty($row->cus_upload_pic)){ ?>
                <div id="<?=$row->cus_id?>">

        <img src="<?=$imglink?>" alt="<?=$row->cus_upload_pic?>" class="imgdesign img img-thumbnail" height="32">';
        
     
        </div>
    <?php } ?>
        </div>
         
    </div>
</div>
<div class="container mt-3">
<div class="row alert alert-info atlifno">
  <div class="col-md-12 bg-rd"><strong>Bank Detials</strong></div><hr/>
  <div class="col-md-3 ">
        {{ Form::bsView('cus_first_bank_name',$row->cus_first_bank_name,['label'=>$niceNames['cus_first_bank_name']]) }}
    </div>

  <div class="col-md-3 ">
        {{ Form::bsView('cus_first_bank_ifsc',$row->cus_first_bank_ifsc,['label'=>$niceNames['cus_first_bank_ifsc']]) }}
    </div>

  <div class="col-md-3 ">
        {{ Form::bsView('cus_first_bank_branch',$row->cus_first_bank_branch,['label'=>$niceNames['cus_first_bank_branch']]) }}
    </div>

  <div class="col-md-3 ">
        {{ Form::bsView('cus_first_bank_account',$row->cus_first_bank_account,['label'=>$niceNames['cus_first_bank_account']]) }}
    </div>
</div>
<div class="row alert alert-info atlifno" >
  <div class="col-md-12 bg-rd" ><strong>Other Bank Detials</strong></div><hr/>
    <div class="col-md-3 ">
        {{ Form::bsView('cus_second_bank_name',$row->cus_second_bank_name,['label'=>$niceNames['cus_second_bank_name']]) }}
    </div>

  <div class="col-md-3 ">
        {{ Form::bsView('cus_second_bank_ifsc',$row->cus_second_bank_ifsc,['label'=>$niceNames['cus_second_bank_ifsc']]) }}
    </div>

  <div class="col-md-3 ">
        {{ Form::bsView('cus_second_bank_branch',$row->cus_second_bank_branch,['label'=>$niceNames['cus_second_bank_branch']]) }}
    </div>
  <div class="col-md-3 ">
        {{ Form::bsView('cus_second_bank_account',$row->cus_second_bank_account,['label'=>$niceNames['cus_second_bank_account']]) }}
    </div>


</div>
<div class="row docs">
  <div class="col-md-12">
        <div class="row">
           
            <div class="col-md-12">
               <div class="preview" style="margin-top: 26px;" >
                <?php if(!empty($multifile)){

                foreach($multifile as $obj){ 
                     $imglink = asset($documentuploadInfo['data-upload-path'].'/'.$obj->multi_customer_doc_name);
                 $ext = pathinfo($obj->multi_customer_doc_name, PATHINFO_EXTENSION);

                 $thml = null;
                 if($ext === 'jpeg' || $ext ==='jpg' || $ext ==='png' || $ext ==='gif')
                 {
                     $thml = '<a href="'.$imglink.'" class="images" data-fancybox="images" data-caption="My caption">
                            <img src="'.$imglink.'" class="img img-fluid img-thumbnail imgshow" style="max-height: 70px; max-width: 166px;" title="image"> 
                             </a>';
                 }else{
                    $thml = '<a target="_blank" href="'.$imglink.'" class="docs" ><img src="https://img.icons8.com/color/48/000000/google-docs.png"/></a>';
                 }
                    ?>

                   <div class="row alert alert-primary border-top-4 table table-bordered altms" id="<?=$obj->multi_cus_id?>">
                        <div class="col-md-3">
                           <?=$thml?>
                        </div>
                        <div class="col-md-8 textareafilename">
                            <input type="hidden" name="multi_customer_doc_name[]" value="<?=$obj->multi_customer_doc_name?>">
                            <?=$obj->multi_customer_doc_title?>
                        </div>
                        <div class="col-md-1 deleteurl">
                           <!-- <a href="javascript:;" data-delete-action-url="<?=route('deletefile')?>?filename=<?=$obj->multi_customer_doc_name?>&fullpath=assets/uploads/team/<?=$obj->multi_customer_doc_name?>" data-del-id="<?=$obj->multi_cus_id?>" class="delbtns"><i class="fas fa-times-circle"></i></a> -->
                        </div>
                   </div>
               <?php } } ?>
               </div>
           </div>
       </div>
    </div>
</div>
</div>
   
</div>
@endsection