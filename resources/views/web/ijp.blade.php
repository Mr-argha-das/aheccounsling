@include('layouts.frontend')

<?php 

use \App\Model\Entry\Blog_model as blogModel;

use \App\Model\Entry\Service_model as serviceModel;

$content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); 

$findBlogs = blogModel::where('blog_status',1)->where('blog_type',2)->orderBy('blog_id','desc')->get();

?>

<!--header end-->

<!--hero section start-->

<!--header end-->





<!--hero section start-->



<section class="position-relative">

  <div id="particles-js"></div>

  <div class="container">

    <div class="row  text-center">

      <div class="col">

        <h1><?=$content->menu_name?></h1>

        <nav aria-label="breadcrumb">

          <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">

            <li class="breadcrumb-item"><a class="text-dark" href="#">Home</a>

            </li>

            <li class="breadcrumb-item active text-primary" aria-current="page"><?=$content->menu_name?></li>

          </ol>

        </nav>

      </div>

    </div>

    <!-- / .row -->

  </div>

  <!-- / .container -->

</section>



<!--hero section end--> 





<!--body content start-->



<div class="page-content">



<!--blog start-->



<section>

  <div class="container">

    <div class="row">

     

<?php $srk = 1; ?>

    @foreach($findBlogs as $blog)



<?php  

 $firstStringCharacter = substr($blog->blog_date,5,2);

 ?>

 <div class="col-12 col-lg-4 mb-6 mb-lg-0">

        <!-- Blog Card -->

        <a href="<?=route('blogpage', str_replace(" ","-",$blog->blog_name))?>">

        <div class="card border-0 bg-transparent">

          <div class="position-absolute bg-white shadow-primary text-center p-2 rounded ml-3 mt-3"><?=$firstStringCharacter?>

            <br><?=date('D', strtotime($blog->blog_date))?></div>

          <img class="card-img-top shadow rounded" src="<?=asset('/assets/uploads/blogs/'.$blog->blog_image)?>" alt="Image">

          <div class="card-body pt-5"> <a class="d-inline-block text-muted mb-2" href="<?=route('blogpage', str_replace(" ","_",$blog->blog_name))?>"><?=$blog->blog_date?></a>

            <h2 class="h5 font-weight-medium">

                <a class="link-title" href="<?=route('blogpage', str_replace(" ","-",$blog->blog_name))?>">{{ $blog->blog_name }}</a>

              </h2>

            <p>{{ serviceModel::getDesc($blog->blog_desc,100) }}</p>

          </div>

          <div class="card-footer bg-transparent border-0 pt-0">

            <!--<ul class="list-inline mb-0">

              <li class="list-inline-item pr-4"> <a href="#" class="text-muted"><i class="ti-comments mr-1 text-primary"></i> 131</a>

              </li>

              <li class="list-inline-item pr-4"> <a href="#" class="text-muted"><i class="ti-eye mr-1 text-primary"></i> 255</a>

              </li>

              <li class="list-inline-item"> <a href="#" class="text-muted"><i class="ti-comments mr-1 text-primary"></i> 14</a>

              </li>

            </ul>-->

          </div>

          <div></div>

        </div>

</a>



        <!-- End Blog Card -->

</div>

    @endforeach

   



    <div class="row mt-11">
 <!-- <div class="col-12">

    <nav aria-label="...">

      <ul class="pagination">

        <li class="page-item mr-auto"> <a class="page-link" href="#">Previous</a>

        </li>

        <li class="page-item"><a class="page-link border-0 rounded text-dark" href="#">1</a>

        </li>

        <li class="page-item active" aria-current="page"> <a class="page-link border-0 rounded" href="#">2 <span class="sr-only">(current)</span></a>

        </li>

        <li class="page-item"><a class="page-link border-0 rounded text-dark" href="#">3</a>

        </li>

        <li class="page-item"><a class="page-link border-0 rounded text-dark" href="#">...</a>

        </li>

        <li class="page-item"><a class="page-link border-0 rounded text-dark" href="#">5</a>

        </li>

        <li class="page-item ml-auto"> <a class="page-link" href="#">Next</a>

        </li>

      </ul>

    </nav>

  </div>-->

</div>

  </div>

</section>



<!--blog end-->



</div>



<!--body content end--> 

  <!--body content end-->

<!-- footer start -->

@include('layouts.frontfooter')