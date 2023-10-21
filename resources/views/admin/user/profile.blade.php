@extends('layouts.'.config('backendLayout'))

@section('content')
<div class="bg-image" style="background-image: url('assets/media/photos/photo8@2x.jpg');">
    <div class="bg-black-75">
        <div class="content content-full text-center">
            <div class="my-3">
                <img class="img-avatar img-avatar-thumb" src="assets/media/avatars/avatar13.jpg" alt="">
            </div>
            <h1 class="h2 text-white mb-0">Edit Account</h1>
            <h2 class="h4 font-w400 text-white-75">
                {{ $row['team_name'] }}
            </h2>
            <a class="btn btn-light" href="dashboard">
                <i class="fa fa-fw fa-arrow-left text-danger"></i> Back to dashboard
            </a>
       </div>
    </div>
</div>

    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Change Password</h3>
        </div>
        <div class="block-content">
          
         {{ Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction)) }}
                <div class="row push">
                
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="one-profile-edit-password">Current Password</label>
                            <input type="password" class="form-control" id="one-profile-edit-password" name="currentpassword" >
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="one-profile-edit-password-new">New Password</label>
                    <input type="password" class="form-control" id="one-profile-edit-password-new" name="newpassword" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="one-profile-edit-password-new-confirm">Confirm New Password</label>
                                <input type="password" class="form-control" id="one-profile-edit-password-new-confirm"  name="confirmpassword">
                            </div>
                        </div>
                {{ Form::bsSubmit() }}
                    </div>
                </div>
       {{ Form::close() }}
        </div>
    </div>
    @endsection