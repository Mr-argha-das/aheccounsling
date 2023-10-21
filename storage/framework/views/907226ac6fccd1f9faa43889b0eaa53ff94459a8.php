<?php header("Location:https://www.ahecounselling.com/"); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div id="page-container" class="side-trans-enabled">

                <main id="main-container">



<div class="hero">

    <div class="hero-inner text-center">

        <div class="bg-white">

            <div class="content content-full overflow-hidden">

                <div class="py-4">

                    <h1 class="display-1 text-flat js-appear-enabled animated bounceIn" data-toggle="appear" data-class="animated bounceIn">404</h1>

                    <h2 class="h3 font-w300 text-muted mb-5 js-appear-enabled animated fadeInUp" data-toggle="appear" data-class="animated fadeInUp">We are sorry but This page is not available at this time</h2>

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

            <a class="link-fx" href="<?php echo e(url('/')); ?>">Go Back to Home</a>

        </div>

    </div>

</div>

    </main>

    </div>   

 

<?php echo $__env->make('layouts.frontfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/pagenotfound.blade.php ENDPATH**/ ?>