@extends('layouts.'.config('backendLayout'))
@section('content')

@include('blocks/panelHeading',['title'=>$title])

{{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
@method('PUT')
<script type="text/javascript" src="{{ asset('/js/fileupload.js') }} "></script>
<script type="text/javascript" src="{{ asset('/js/imageupload.js') }} "></script>
<?php
$documentuploadInfo = array(
    'data-upload-path' => 'assets/uploads/customer',
    'data-upload-url' => route('ajaxUploadFile'),
    'data-delete-url' => route('deletefile'),
    'data-name' => 'multi_customer_doc_name',
    'data-title' => 'multi_customer_doc_title',
);
$uploadData = NULL;
foreach ($documentuploadInfo as $key => $val) {
    $uploadData .= $key . '=' . $val . '  ';
}


$imgDataUpload = array(
    'data-upload-path' => 'assets/uploads/customer',
    'data-upload-url' => route('ajaxuploadimage'),
    'data-delete-url' => route('deletefile'),
    'data-name' => 'cus_upload_pic',
);
$uploadDatanof = NULL;
foreach ($imgDataUpload as $key => $val) {
    $uploadDatanof .= $key . '=' . $val . '  ';
}

?>

<div class="row">

    <div class="col-md-12">

        <b>Personal Infomation</b>
        <hr />
    </div>

    <div class="col-md-4 ">
        {{ Form::bsText('cus_name',$row->cus_name,['label'=>$niceNames]) }}
    </div>
    <div class="col-md-4 ">
        {{ Form::bsSelect('cus_family',$FamilyList,$row->cus_family,['label'=>$niceNames]) }}
    </div>

    <div class="col-md-4 ">
        {{ Form::bsText('cus_mobile',$row->cus_mobile,['label'=>$niceNames]) }}
    </div>

    <div class="col-md-4 ">
        {{ Form::bsText('cus_alt_mobile',$row->cus_alt_mobile,['label'=>$niceNames]) }}
    </div>
    <div class="col-md-8">
        {{ Form::bsTextarea('cus_address',$row->cus_address,['label'=>$niceNames]) }}
    </div>

    <div class="col-md-4 ">
        {{ Form::bsText('cus_email',$row->cus_email,['label'=>$niceNames]) }}
    </div>



    <div class="col-md-4 ">
        {{ Form::bsText('cus_dob',$timedate->dateFormat($row->cus_dob,'out'),['label'=>$niceNames,'class'=>'datepicker']) }}
    </div>

    <div class="col-md-4 ">
        {{ Form::bsText('cus_doa',$timedate->dateFormat($row->cus_doa,'out'),['label'=>$niceNames,'class'=>'datepicker']) }}
    </div>

    <div class="col-md-4 ">
        {{ Form::bsText('cus_pan',$row->cus_pan,['label'=>$niceNames]) }}
    </div>

    <div class="col-md-4 ">
        {{ Form::bsText('cus_addhar',$row->cus_addhar,['label'=>$niceNames]) }}
    </div>

    <div class="col-md-4 ">
        {{ Form::bsText('cus_kyc_docs',$row->cus_kyc_docs,['label'=>$niceNames]) }}

    </div>
    <div class="col-md-4">

        {{ Form::bsSelect('cus_category',$categorylis,$row->cus_category,['label'=>$niceNames]) }}
    </div>
    <div class="col-md-4">

        {{ Form::bsSelect('cus_team_id',$teamList,$row->cus_team_id,['label'=>$niceNames]) }}
    </div>
    <div class="col-md-4 ">

        <label>Upload Profile Photo</label>
        <input type="file" class="form-control uploadimage " name="userfile" {{ $uploadDatanof }}><br />
        <?php $imglink = asset($imgDataUpload['data-upload-path'] . '/' . $row->cus_upload_pic); ?>
        <div class="imgupload" style="display: block;">
            <?php if (!empty($row->cus_upload_pic)) { ?>
                <div id="<?= $row->cus_id ?>">

                    <img src="<?= $imglink ?>" alt="<?= $row->cus_upload_pic ?>" class="imgdesign img img-thumbnail" height="32">';
                    <input type="hidden" name="cus_upload_pic" value="<?= $row->cus_upload_pic ?>">
                    <a href="javascript:;" data-delete-imae-url="<?= route('deletefile') ?>?filename=<?= $row->cus_upload_pic ?>&fullpath=assets/uploads/customer/<?= $row->cus_upload_pic ?>" data-img-id="<?= $row->cus_id ?>" class="deleteigm"><i class="fas fa-times-circle"></i></a>
                </div>
            <?php } ?>
        </div>
        <div class="progress def-progress mt-3 mb-2" style="display: none;">
            <div class="progress-bar active  def-progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">60%</div>
        </div>
        <div class="imgupload-error"></div>
    </div>
</div>
<div class="container mt-3">
    <div class="row alert alert-info atlifno">
        <div class="col-md-12 bg-rd"><strong>Bank Detials</strong></div>
        <hr />
        <div class="col-md-3 ">
            {{ Form::bsText('cus_first_bank_name',$row->cus_first_bank_name,['label'=>$niceNames]) }}
        </div>

        <div class="col-md-3 ">
            {{ Form::bsText('cus_first_bank_ifsc',$row->cus_first_bank_ifsc,['label'=>$niceNames]) }}
        </div>

        <div class="col-md-3 ">
            {{ Form::bsText('cus_first_bank_branch',$row->cus_first_bank_branch,['label'=>$niceNames]) }}
        </div>

        <div class="col-md-3 ">
            {{ Form::bsText('cus_first_bank_account',$row->cus_first_bank_account,['label'=>$niceNames]) }}
        </div>
    </div>
    <div class="row alert alert-info atlifno">
        <div class="col-md-12 bg-rd"><strong>Other Bank Detials</strong></div>
        <hr />
        <div class="col-md-3 ">
            {{ Form::bsText('cus_second_bank_name',$row->cus_second_bank_name,['label'=>$niceNames]) }}
        </div>

        <div class="col-md-3 ">
            {{ Form::bsText('cus_second_bank_ifsc',$row->cus_second_bank_ifsc,['label'=>$niceNames]) }}
        </div>

        <div class="col-md-3 ">
            {{ Form::bsText('cus_second_bank_branch',$row->cus_second_bank_branch,['label'=>$niceNames]) }}
        </div>
        <div class="col-md-3 ">
            {{ Form::bsText('cus_second_bank_account',$row->cus_second_bank_account,['label'=>$niceNames]) }}
        </div>


    </div>
    <div class="row docs">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <label for="">Upload Document</label>
                    <input type="file" name="userfile" class="form-control form-control-file uploadfile" {{ $uploadData }} multiple>
                    <div class="progress mt-3 mb-2" style="display: none;">
                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">60%</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="preview" style="margin-top: 26px;">
                        <?php if (!empty($multifile)) {

                            foreach ($multifile as $obj) {
                                $imglink = asset($documentuploadInfo['data-upload-path'] . '/' . $obj->multi_customer_doc_name);
                                $ext = pathinfo($obj->multi_customer_doc_name, PATHINFO_EXTENSION);

                                $thml = null;
                                if ($ext === 'jpeg' || $ext === 'jpg' || $ext === 'png' || $ext === 'gif') {
                                    $thml = '<a href="' . $imglink . '" class="images" data-fancybox="images" data-caption="My caption">
                            <img src="' . $imglink . '" class="img img-fluid img-thumbnail imgshow" style="max-height: 70px; max-width: 166px;" title="image">
                             </a>';
                                } else {
                                    $thml = '<a target="_blank" href="' . $imglink . '" class="docs" ><img src="https://img.icons8.com/color/48/000000/google-docs.png"/></a>';
                                }
                        ?>

                                <div class="row alert alert-primary border-top-4 table table-bordered altms" id="<?= $obj->multi_cus_id ?>">
                                    <div class="col-md-3">
                                        <?= $thml ?>
                                    </div>
                                    <div class="col-md-8 textareafilename">
                                        <input type="hidden" name="multi_customer_doc_name[]" value="<?= $obj->multi_customer_doc_name ?>">
                                        <textarea class="form-control" name="multi_customer_doc_title[]"><?= $obj->multi_customer_doc_title ?></textarea>
                                    </div>
                                    <div class="col-md-1 deleteurl">
                                        <a href="javascript:;" data-delete-action-url="<?= route('deletefile') ?>?filename=<?= $obj->multi_customer_doc_name ?>&fullpath=assets/uploads/team/<?= $obj->multi_customer_doc_name ?>" data-del-id="<?= $obj->multi_cus_id ?>" class="delbtns"><i class="fas fa-times-circle"></i></a>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-2">
        {{ Form::bsSubmit() }}
    </div>
</div>





{{ Form::close() }}
@endsection

<style type="text/css">
    .uploadimage {
        display: none;
    }
</style>