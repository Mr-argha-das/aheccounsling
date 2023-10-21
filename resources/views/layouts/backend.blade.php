<!DOCTYPE html>

<html lang="en">

<?php $session = session()->get('usersession');

$session = (object) $session;

$userId = $session->team_id;

$groupId = $session->team_type;



$Dropdata = DB::table('allot_user')->join('navigation','nv_id','=','allot_type_id')->groupby('nv_parent')->where('allot_user_id',$userId)->orderBy('nv_parent','asc')->get();



?>



<head>

    <!-- Required meta tags -->

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3234816981395206"

     crossorigin="anonymous"></script>

    <meta charset="utf-8">

    <meta name="description" content="">

    <meta name="author" content="">

    <title>{{ $title }} | AHEC</title>

    <base href="<?= asset('/admin/') ?>/">

    <link rel="shortcut icon" href="<?= asset('fav.png') ?>" type="image/x-icon">

    <link rel="apple-touch-icon" href="<?= asset('logo.png') ?>">

    <link rel="stylesheet" id="css-main" href="assets/css/oneui.min-4.1.css">

    <link rel="stylesheet" href="assets/css/appuser.css">

    <link rel="stylesheet" href="assets/css/spanelv5.css">

    <meta name="theme-color" content="#f8b225">

    <link rel="manifest" href="<?= asset('/manifest.json') ?>">

    <link rel="mask-icon" href="<?= asset('logo.png') ?>" color="#f8b225">

    <meta name="apple-mobile-web-app-title" content="AHEC">

    <meta name="application-name" content="CRM">

    <meta name="msapplication-TileColor" content="#242221">

    <meta name="msapplication-TileImage" content="<?= asset('logo.png') ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">

    <link rel="stylesheet" href="assets/css/geomanist/stylesheet.css">

    

    <script src="{{asset('webassets/js/jquery-3.5.1.js')}}"></script>

    <script src="{{asset('webassets/js/jquery.validate.min.js')}}"></script>

    <script src="{{ asset('admin/assets/ckeditor/ckeditor.js') }}"></script>



    <link rel="stylesheet" type="text/css" href="{{asset('webassets/css/dropzone.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('webassets/css/dropzone.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('webassets/css/jquery.dataTables.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('webassets/css/buttons.bootstrap4.min.css')}}">

     

     <script src="{{asset('webassets/js/jquery.dataTables.min.js')}}"></script>

     <script src="{{asset('webassets/js/dataTables.buttons.min.js')}}"></script>

     <script src="{{asset('webassets/js/jszip.min.js')}}"></script>

     <script src="{{asset('webassets/js/buttons.html5.min.js')}}"></script>

     

     <style type="text/css">

        .buttonload {

            background-color: #3e6ae6;

            border: none;

            color: white;

            padding: 7px 21px;

            font-size: 14px;

         }

       .sfa {

            margin-left: -12px;

            margin-right: 8px;

        }

  </style>

</head>



<body>

    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed side-trans-enabled">

        <nav id="sidebar" aria-label="Main Navigation" data-simplebar="init">

            <div class="simplebar-track vertical" style="visibility: visible;">

                <div class="simplebar-scrollbar" style="visibility: visible; top: 0px; height: 147px;"></div>

            </div>

            <div class="simplebar-track horizontal" style="visibility: hidden;">

                <div class="simplebar-scrollbar"></div>

            </div>

            <div class="simplebar-scroll-content" style="padding-right: 17px; margin-bottom: -34px;">

                <div class="simplebar-content" style="padding-bottom: 17px; margin-right: -17px;">

                    <div class="content-header bg-white-5">

                        <a class="font-w600 text-dual">

                            <!--<i class="fa fa-circle-notch text-primary"></i>-->

                            <span class="smini-hide">

                               <img src="<?= asset('footer-logo.png') ?>" style="width: 100%;">

                            </span>

                        </a>

                        <div class="pr-4">

                            <div class="dropdown d-inline-block ml-3">

                                <span class="btn text-dual font-size-sm" id="sidebar-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    <i class="si si-drop"></i>

                                </span>

                                <div class="dropdown-menu dropdown-menu-right font-size-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform:translate3d(32px, 28px, 0px)" x-placement="bottom-end">

                                    <a class="dropdown-item d-flex align-items-center justify-content-between active" data-toggle="theme" data-theme="default">

                                        <span>Default</span>

                                        <i class="fa fa-circle text-default"></i>

                                    </a>

                                    <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="assets/css/themes/amethyst.min-4.1.css">

                                        <span>Amethyst</span>

                                        <i class="fa fa-circle text-amethyst"></i>

                                    </a>

                                    <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="assets/css/themes/city.min-4.1.css">

                                        <span>City</span>

                                        <i class="fa fa-circle text-city"></i>

                                    </a>

                                    <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="assets/css/themes/flat.min-4.1.css">

                                        <span>Flat</span>

                                        <i class="fa fa-circle text-flat"></i>

                                    </a>

                                    <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="assets/css/themes/modern.min-4.1.css">

                                        <span>Modern</span>

                                        <i class="fa fa-circle text-modern"></i>

                                    </a>

                                    <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="assets/css/themes/smooth.min-4.1.css">

                                        <span>Smooth</span>

                                        <i class="fa fa-circle text-smooth"></i>

                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" data-toggle="layout" data-action="sidebar_style_light">

                                        <span>Sidebar Light</span>

                                    </a>

                                    <a class="dropdown-item" data-toggle="layout" data-action="sidebar_style_dark">

                                        <span>Sidebar Dark</span>

                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" data-toggle="layout" data-action="header_style_light">

                                        <span>Header Light</span>

                                    </a>

                                    <a class="dropdown-item" data-toggle="layout" data-action="header_style_dark">

                                        <span>Header Dark</span>

                                    </a>

                                </div>

                            </div>

                            <a class="d-lg-none text-dual ml-3 font-size-h3 btn" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">

                                <i class="fa fa-times"></i>

                            </a>

                        </div>

                    </div>

                    <div class="content-side content-side-full">

                        <ul class="nav-main">

                            <li class="nav-main-item">

                                <a class="nav-main-link active" href="dashboard">

                                    <i class="nav-main-link-icon si si-speedometer"></i>

                                    <span class="nav-main-link-name">Dashboard</span>

                                </a>

                            </li>

                              <?php foreach ($Dropdata as $key => $value) {  ?>

                                <li class="nav-main-item">

                                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="javascript:;">

                                        <i class="nav-main-link-icon si si-energy"></i>

                                        <span class="nav-main-link-name"><?=$value->nv_parent_name?></span>

                                    </a>

                                    <?php 



                                   $drodlist = DB::table('allot_user')->join('navigation','nv_id','=','allot_type_id')->where('allot_parent_id',$value->allot_parent_id)->groupby('nv_id')->where('allot_user_id',$userId)->orderBy('nv_id','asc')->get();

                                   if(!empty($drodlist))

                                   {

                                    echo ' <ul class="nav-main-submenu">';

                                    foreach ($drodlist as $key => $ls) { ?>

                                   



                                        <li class="nav-main-item">

                                          

                                                <a class="nav-main-link" href="{{ $ls->nv_url }}">

                                                    <span class="nav-main-link-name">{{ $ls->nv_name }}</span>

                                                </a>

                                                

                                        </li>

                                      <?php  } echo '</ul>'; } ?>

                                    

                                </li>

                               <?php  } ?>

                                 

                                 <li class="nav-main-item">

                                    <a class="nav-main-link " href="user/logout">

                                       <i class="nav-main-link-icon si si-logout"></i>

                                        <span class="nav-main-link-name"> Logout</span>

                                    </a>

                                 </li>

                              </ul>

                            </li>

                          </li>

                        </ul>

                    </div>

                </div>

            </div>

        </nav>

        <header id="page-header">

            <div class="content-header">

                <div class="d-flex align-items-center">

                    <span class="mr-2 d-lg-none mr-auto">

                        <img src="<?= asset('/wpanel/') ?>/assets/img/logo.png" alt="KSV" height="32">

                    </span>

                    <span class="mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">

                        <!--<i class="fa fa-fw fa-bars fa-2x"></i>-->

                        <img src="https://img.icons8.com/windows/512/000000/menu.png" height="32">

                    </span>

                    <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">

                        <i class="fa fa-fw fa-ellipsis-v"></i>

                    </button>

                 </div>



                  <div class="d-flex align-items-center">

                    <div class="dropdown d-inline-block ml-2">

                        <button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <!-- <img class="rounded" src="assets/media/avatars/avatar10.jpg" alt="Header Avatar" style="width: 18px;"> -->

                            <span class="d-none d-sm-inline-block ml-1"><?= $session->team_name ?></span>

                            <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>

                        </button>

                        <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-user-dropdown">

                            <div class="p-3 text-center bg-primary">

                                <!-- <img class="img-avatar img-avatar48 img-avatar-thumb" src="assets/media/avatars/avatar10.jpg" alt=""> -->

                            </div>

                            <div class="p-2">

                                <h5 class="dropdown-header text-uppercase">User Options</h5>





                                <a class="dropdown-item-d-flex align-items-center justify-content-between" href="user/profile">

                                    <span>Edit Profile</span>

                                    <i class="si si-user ml-1"></i>

                                </a>

                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="user/logout">

                                    <span>Log Out</span>

                                    <i class="si si-logout ml-1"></i>

                                </a>

                            </div>

                        </div>

                    </div>



                </div>

                <div id="page-header-search" class="overlay-header bg-white">

                    <div class="content-header">

                        <form class="w-100" action="https://demo.pixelcave.com/oneui-remastered/be_pages_generic_search.html" method="POST">

                            <div class="input-group input-group-sm">

                                <div class="input-group-prepend">

                                    <button type="button" class="btn btn-danger" data-toggle="layout" data-action="header_search_off">

                                        <i class="fa fa-fw fa-times-circle"></i>

                                    </button>

                                </div>

                                <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">

                            </div>

                        </form>

                    </div>

                </div>

                <div id="page-header-loader" class="overlay-header bg-white">

                    <div class="content-header">

                        <div class="w-100 text-center">

                            <i class="fa fa-fw fa-circle-notch fa-spin"></i>

                        </div>

                    </div>

                </div>



        </header>

        <main id="main-container">

             <div id="dynamic_section" class="m-md-4 m-2 <?= empty($_GET['fancybox']) ? 'fancyboxdesign' : '' ?>" style="">

                <div>

                    <div id="error_notification">

                        <div class="flash-message">

                            @foreach (['s'=>'success', 'w'=>'warning', 'd'=>'danger', 'i'=>'info'] as $key=>$msg)

                            @if(Session::has($key))

                            <div class="alert alert-{{$msg}} alert-dismissible fade show" role="alert">

                                {{ Session::get($key) }}

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>

                                </button>

                            </div>

                            @endif

                            @endforeach

                        </div>

                        @if ($errors->any())

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            @foreach ($errors->all() as $error)

                            <p class="mb-1">{{ $error }}</p>

                            @endforeach

                        </div>

                        @endif

                    </div>

                    @yield('content')

                </div>

            </div>

        </main>

    </div>

    <!-- Coding End -->

    <script src="https://cdn.jsdelivr.net/combine/npm/@fancyapps/fancybox@3,npm/jquery-match-height@0.7.2,npm/jquery-validation@1,npm/popper.js@1.14.3,npm/bootstrap@4.1.3/dist/js/bootstrap.min.js,npm/select2@4.0.6-rc.1,npm/components-jqueryui@1.12.1/jquery-ui.min.js,npm/jquery-ui-month-picker@3.0.4/src/MonthPicker.min.js" defer></script>

    



    <script src="assets/js/oneui.core.min-4.1.js" defer></script>

    <script src="assets/js/oneui.app.min-4.1.js" defer></script>



    @yield('javascript')



    <script>

        function loadjscssfile(filename, filetype) {

            if (filetype == "js") { //if filename is a external JavaScript file

                var fileref = document.createElement('script')

                fileref.setAttribute("type", "text/javascript")

                fileref.setAttribute("defer", "defer")

                fileref.setAttribute("src", filename)

            } else if (filetype == "css") { //if filename is an external CSS file

                var fileref = document.createElement("link")

                fileref.setAttribute("rel", "stylesheet")

                fileref.setAttribute("type", "text/css")

                fileref.setAttribute("href", filename)

            }

            if (typeof fileref != "undefined") {

                document.getElementsByTagName("head")[0].appendChild(fileref);

            }

        }

        //loadjscssfile('themes/js/waves.js', 'js');

        $(window).on('load', function() {

            //$(".preloader").fadeOut();

            //loadjscssfile('assets/css/geomanist/stylesheet.css', 'css');

            loadjscssfile('https://use.fontawesome.com/releases/v5.13.0/css/all.css', 'css');

            //loadjscssfile('https://fonts.googleapis.com/css?family=Comfortaa', 'css');

            loadjscssfile('https://cdn.jsdelivr.net/combine/npm/@fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css,npm/select2@4.0.6-rc.1/dist/css/select2.min.css,npm/jquery-ui-month-picker@3.0.4/src/MonthPicker.min.css', 'css');



            //loadjscssfile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic|Montserrat:300,400,500,600,700', 'css');



            //loadjscssfile('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css', 'css');

            loadjscssfile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css', 'css');



            setTimeout(function() {

                $(window).resize();



                $('#sidebar-themes-dropdown').click();

            }, 10)

        });

    </script>

    <script>

    </script>

    <script src="assets/js/spanelv5.js" defer></script>

    <script src="assets/js/dropzone.js" defer></script>



    <style>

        .dropmenu {

            width: 20px;

            height: 20px;

            z-index: 20;

        }



        .dropmenu .dropmenu-container {

            position: absolute;

        }



        .dropmenu .dropmenu-container .dropmenu-clicker {

            padding: 4px 10px;

            width: inherit;

            display: block;

            text-align: center;

            cursor: pointer;

            line-height: 1;

        }



        .dropmenu .dropmenu-container .dropmenu-list {

            position: absolute;

            display: none;

            background: #FFF;

            z-index: 100;

            padding: 10px 0;

            right: 0;

            box-shadow: 2px 5px 6px rgba(0, 0, 0, 0.5);

        }



        .dropmenu :hover .dropmenu-clicker {

            background: #FFF;

            box-shadow: 2px 5px 6px rgba(0, 0, 0, 0.5);

        }



        .dropmenu :hover .dropmenu-list {

            display: block;

        }



        .dropmenu-list a,

        .dropmenu-list button {

            width: 100%;

            white-space: pre;

            color: rgba(0, 0, 0, 0.7);

            display: block;

            padding: 4px 10px;

            cursor: pointer;

            border: 0;

            background: none;

            text-decoration: none;

        }



        .dropmenu-list a:hover,

        .dropmenu-list button:hover {

            background: rgba(0, 0, 0, 0.1);

        }

    </style>

</body>



</html>



<script>

    $(function() {

        // if (/Android|webOS|iPhone|iPad|iPod|Opera Mini/i.test(navigator.userAgent)) {

        if (window.matchMedia("(max-width: 768px)").matches) {

            $('html').addClass('android-device');

            <?php /*

            $(document).on('focus', 'input', function(e) {

                var elmMsg = $(this);

                var parentScrollElm = $('html, body');

                var parentScrollElmValue = $(window).scrollTop();

                if (elmMsg.closest('.fancybox-slide--current').length > 0) {

                    parentScrollElm = elmMsg.closest('.fancybox-slide--current');

                    parentScrollElmValue = parentScrollElm.scrollTop();

                }

                //                /console.log(parentScrollElmValue+'-'+elmMsg.offset().top);

                //if (parentScrollElmValue < elmMsg.offset().top - 20) {

                //$('html, body').animate({









                var windowHeight = $(window).height();

                console.log(parentScrollElmValue + '-' + windowHeight / 3 + '-' + elmMsg.offset().top);

                var scr = ((windowHeight / 3) + parentScrollElmValue);

                console.log(scr);

                if (scr < elmMsg.offset().top - 20) {

                    parentScrollElm.animate({

                        scrollTop: scr

                    });

                }



                //}

            })

            */ ?>



        }



    })

</script>





<style>

    .android-device .fancybox-content {

        padding: 23px 10px !important;

    }



    .android-device .fancybox-slide {

        /* height: auto;*/

    }



    .android-device .nav-main-link {

        font-size: 1.4rem;

    }



    .s_android {

        height: 400px;

        display: none;

    }



    .android-device {

        font-size: .8rem;

    }



    /*.android-device body

    {

        font-weight: 300 ;

    }*/

    .android-device .fancybox-content {

        vertical-align: top !important;

    }



    .android-device .h_android {

        display: none !important;

    }



    .android-device .s_android {

        display: block;

    }



    .android-device .sidebar-dark #sidebar .nav-main-link {

        color: rgba(255, 255, 255, .7);

    }

</style>



<script>

    // ServiceWorker is a progressive technology. Ignore unsupported browsers

    if ('serviceWorker' in navigator) {

        console.log('CLIENT: service worker registration in progress.');

        navigator.serviceWorker.register('<?= asset('/service-worker.js') ?>').then(function() {

            console.log('CLIENT: service worker registration complete.');

        }, function() {

            console.log('CLIENT: service worker registration failure.');

        });

    } else {

        console.log('CLIENT: service worker is not supported.');

    }

</script>

<?php /*

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-touch-events/1.0.5/jquery.mobile-events.js"></script>

<script>

    $(function() {

        $('body').on('swiperight', function(e) {

            $('[data-action="sidebar_toggle"]').click();

        });

        $('#sidebar .simplebar-content').on('swipeleft', function(e) {

            $('[data-action="sidebar_close"]').click();

        });

    });

</script>

*/ ?>



<script type="text/javascript">

    

    $(document).ready( function () {

    $('.myTable').DataTable({

        dom: 'Bfrtip',



        buttons: [

        'copy', 'excel', 'pdf'

    ]

    });





 });

</script>