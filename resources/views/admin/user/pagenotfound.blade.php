<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Khanha Santi </title>

    <base href="<?=asset('/wpanel/')?>/">


    <meta name="theme-color" content="#f8b225">
    <link rel="manifest" href="<?=asset('/manifest.json')?>">
    <link rel="mask-icon" href="<?=asset('/assets/img/logo-icon-512.jpg')?>" color="#f8b225">
    <meta name="apple-mobile-web-app-title" content="{{ $commonModel->pConfig->PanelName }}">
    <meta name="application-name" content="RJ CRM">
    <meta name="msapplication-TileColor" content="#242221">
    <meta name="msapplication-TileImage" content="<?=asset('/assets/img/logo-icon-512.jpg')?>">
    <link rel="shortcut icon" href="<?=asset('/assets/img/logo-icon-512.jpg')?>">
 <link rel="stylesheet" id="css-main" href="assets/css/oneui.min-4.1.css">

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

<body><div id="page-container" class="side-trans-enabled">
                <main id="main-container">
<div class="hero">
    <div class="hero-inner text-center">
        <div class="bg-white">
            <div class="content content-full overflow-hidden">
                <div class="py-4">
                    <h1 class="display-1 text-flat js-appear-enabled animated bounceIn" data-toggle="appear" data-class="animated bounceIn">403</h1>
                    <h2 class="h3 font-w300 text-muted mb-5 js-appear-enabled animated fadeInUp" data-toggle="appear" data-class="animated fadeInUp">We are sorry but you do not have permission to access this page..</h2>
                    <form action="be_pages_generic_search.html" method="POST">
                        <div class="form-group row justify-content-center">
                            <div class="col-sm-6 col-xl-4">
                                <div class="input-group">
                                   <!--  <input class="form-control" type="text" placeholder="Search application..">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="content content-full font-size-sm text-muted">
            <p class="mb-1">
                Would you like to let us know about it?
            </p>
            <a class="link-fx" href="{{ url('wpanel/dashboard') }}">Go Back to Dashboard</a>
        </div>
    </div>
</div>
    </main>
    </div>   

    <script>

        window.onload = function () {
          var leftSpace = window.outerWidth - (window.outerWidth * 2);

            var element = document.getElementById("page-loading");
            element.style.left = leftSpace+'px';
        //element.style.backgroundColor = 'rgb(255, 125, 115)';
            //element.classList.add("mystyle");
        }
        // ServiceWorker is a progressive technology. Ignore unsupported browsers
        if ('serviceWorker' in navigator) {
            console.log('CLIENT: service worker registration in progress.');
            navigator.serviceWorker.register('<?=asset(' / service - worker.js ')?>').then(function() {
                console.log('CLIENT: service worker registration complete.');
            }, function() {
                console.log('CLIENT: service worker registration failure.');
            });
        } else {
            console.log('CLIENT: service worker is not supported.');
        }
    </script>


</body>

</html>
