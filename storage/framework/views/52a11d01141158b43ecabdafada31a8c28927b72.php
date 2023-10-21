<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo e($commonModel->pConfig->PanelName); ?></title>

    <base href="<?= asset('/admin/') ?>/">


    <meta name="theme-color" content="#f8b225">
    <link rel="manifest" href="<?= asset('/manifest.json') ?>">
    <link rel="mask-icon" href="<?= asset('fav.png') ?>" color="#f8b225">
    <meta name="apple-mobile-web-app-title" content="<?php echo e($commonModel->pConfig->PanelName); ?>">
    <meta name="application-name" content="<?php echo e($commonModel->pConfig->PanelName); ?>">
    <meta name="msapplication-TileColor" content="#242221">
    <meta name="msapplication-TileImage" content="<?= asset('fav.png') ?>">
    <link rel="shortcut icon" href="<?= asset('fav.png') ?>">


    <!--<script src="https://cdn.jsdelivr.net/combine/npm/jquery@3" defer></script>
<script src="assets/js/login-page.js" defer></script>-->

    <!--
<script src="assets/js/oneui.core.min-4.1.js" defer></script>
<script src="assets/js/oneui.app.min-4.1.js" defer></script>
<script src="assets/js/login-page.js" defer></script>-->

    <!--
<script src="assets/js/plugins/chart.js/Chart.bundle.min.js" defer></script>-->
    <!--    <script src="assets/js/pages/be_pages_dashboard.min.js" defer></script>-->

    <style>
        @media (max-width: 720px) {
            .bg-black-50 {
                background: #FFF !important;
            }
        }
    </style>




</head>

<body>
    <style>
        #page-loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #2c343f;
            text-align: center;
            z-index: 99999;
            color: #848484;
            display: flex;
            transition: all ease-in-out 400ms;
            overflow: hidden;
        }

        #page-loading>div {
            display: flex;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            width: 100%;
        }
    </style>
    <div id="page-loading">
        <div>
            <div>
                <img src="<?= asset('footer-logo.png') ?>" alt="RJ CRM">
            </div>
            <br>
           AHEC
        </div>
    </div>

    <div id="page-container" style="background-image: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);">
        <main id="main-container">
            <div class="bg-image" >
                <div class="hero-static bg-black-50 d-flex">
                    <div class="content d-flex" style="max-width:500px">
                        <div class="justify-content-center d-block mx-auto d-md-flex align-items-center w-100">
                            <div>
                                <div class="block block-themed mb-0">
                                    <?php /*
                                    <div class="block-header bg-primary">
                                        <h3 class="block-title">Admin Login</h3>
                                        <div class="block-options">
                                            <!--<a class="btn-block-option" href="op_auth_signin.html" data-toggle="tooltip" data-placement="left" title="Sign In with another account">
<i class="fa fa-sign-in-alt"></i>
</a>-->
                                        </div>
                                    </div>*/ ?>
                                    <div class="block-content" style="width:400px;">
                                        <div class="p-sm-3 px-lg-4 pb-lg-5 pt-lg-0 text-center">
                                            <img src="<?= asset('logo.png') ?>" alt="RJ CRM" class="mb-3" style="width: 70%">
                            

                                            <form method="POST" action="<?php echo e(route('wpanelCheckLogin')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php if(Session::has('errorFlash')): ?>

                                                <strong class="text-danger"><?php echo Session::get('errorFlash'); ?></strong>

                                                <?php endif; ?>
                                                <div class="form-group row mt-2">
                                                    <!--<label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>
-->
                                                    <!--   <div class="col-md-12">
                                                        <?php echo Form::select('session_nm', ['' => 'Select Session'] + $session, '', array('class' => 'form-control', 'required' => true)); ?><br />
                                                        <?php if($errors->has('email')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('session_nm')); ?></strong>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div> -->
                                                    <input type="hidden" value="1" name="session_nm">

                                                 <!--    <div class="col-md-12">
                                                        <?php echo Form::select('type', $loginType, '', array('class' => 'form-control', 'required' => true)); ?><br />
                                                        <?php if($errors->has('type')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('type')); ?></strong>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div> -->
                                                   
                                                    <div class="col-md-12">
                                                         <input type="hidden" name="type" value="1">
                                                        <input id="email" type="email" class="rounded-0 form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required placeholder="Username">

                                                        <?php if($errors->has('email')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <!--<label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>
-->
                                                    <div class="col-md-12">
                                                        <input id="password" type="password" class="rounded-0 form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required placeholder="Password">

                                                        <?php if($errors->has('password')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <!--<div class="form-group row">
<div class="col-md-12">
<div class="form-check">
<input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

<label class="form-check-label" for="remember">
<?php echo e(__('Remember Me')); ?>

</label>
</div>
</div>
</div>-->

                                                <div class="form-group row mb-0">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary my-3">
                                                            <?php echo e(__('Login')); ?>

                                                        </button>

                                                        <!--  <?php if(Route::has('password.request')): ?>
<a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
<?php echo e(__('Forgot Your Password?')); ?>

</a>
<?php endif; ?>-->
                                                    </div>
                                                </div>
                                            </form>

                                            <!--   <form class="js-validation-lock" action="be_pages_auth_all.html" method="POST">
<div class="form-group py-3">
<input type="password" class="form-control form-control-lg form-control-alt" id="lock-password" name="lock-password" placeholder="Password..">
</div>
<div class="form-group row justify-content-center">
<div class="col-md-6 col-xl-5">
<button type="submit" class="btn btn-block btn-light">
<i class="fa fa-fw fa-lock-open mr-1"></i> Unlock
</button>
</div>
</div>
</form>-->


                                        </div>
                                    </div>
                                </div>


                                <div class="content content-full font-size-sm text-white text-center d-none d-md-block">
                                    <!-- <strong>sPanel v1.0</strong> &copy; <span data-toggle="year-copy">2020</span> -->
                                </div>
                            </div>

                        </div>



                    </div>
                </div>
            </div>
        </main>
    </div>


    <!--
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" />
-->


    <link rel="stylesheet" id="css-main" href="assets/css/oneui.min-4.1.css">

    <script>
        window.onload = function() {
            var leftSpace = window.outerWidth - (window.outerWidth * 2);

            var element = document.getElementById("page-loading");
            element.style.left = leftSpace + 'px';
            //element.style.backgroundColor = 'rgb(255, 125, 115)';
            //element.classList.add("mystyle");
        }
        // ServiceWorker is a progressive technology. Ignore unsupported browsers
        if ('serviceWorker' in navigator) {
            console.log('CLIENT: service worker registration in progress.');
            navigator.serviceWorker.register('<?= asset(' / service - worker.js ') ?>').then(function() {
                console.log('CLIENT: service worker registration complete.');
            }, function() {
                console.log('CLIENT: service worker registration failure.');
            });
        } else {
            console.log('CLIENT: service worker is not supported.');
        }
    </script>


</body>

</html><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/user/login.blade.php ENDPATH**/ ?>