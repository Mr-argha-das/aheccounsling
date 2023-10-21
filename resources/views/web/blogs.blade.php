@include('layouts.frontend')

<?php

use \App\Model\Entry\Blog_model as blogModel;
use \App\Model\Entry\Service_model as serviceModel;

$content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); 
if(Session::has('search_val')){ 
    $searchValues = Session::get('search_val'); 
    $searchValuesArray = preg_split('/\s+/', $searchValues, -1, PREG_SPLIT_NO_EMPTY);
    array_unshift($searchValuesArray,$searchValues);
    $findBlogs = blogModel::where(function ($q) use ($searchValuesArray) {
              foreach ($searchValuesArray as $value) {
                $q->orWhere('blog_name', 'like', "%{$value}%");
              }
    })->where('blog_status',1)->where('blog_type',1)->orderBy('order_number')->paginate(15);
 }else{
  $findBlogs = blogModel::where('blog_status',1)->where('blog_type',1)->orderBy('order_number')->paginate(15);
 }
 ?>
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

<div class="page-content">



  <!--blog start-->

  <!-- <style>
    .search{
      position: absolute;
      top:50%;
      left:50%;
      transform: translate(-50% , -50%);
      background:black ;
      height: 40px;
      border-radius: 40px;
      padding: 10px;
    }

    .search:hover > .search-txt{
      width: 180px;
      padding: 0 10px;
      color: wheat;
      font-family: 'Pangolin', cursive;
    }
    .search:hover > .search-btn{
     background: white ;
   }
   .search-btn{
    color: red;
    float: right;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background:#ABB2B9 ;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .search-txt{
    border: none;
    background: none;
    outline: none;
    float: left;
    padding: 0;
    color:wheat ;
    font-size: 16px;
    transition: ease-in 0.4s;
    line-height: 40px;
    width: 0px;
    font-family: 'Pangolin', cursive;
  }
  .fas fa-search{
    font-weight: 200;
    font-size: 40px;
  }
</style>


 -->

<section class="">

  <div class="container">

   <!--  <div class="row">
     <div class="search d-flex">
       <input  class="search-txt" type="text" name="" placeholder="Type to search" style="margin-left:20px;height:40px;border-radius:10px">
       
       <a class="search-btn" href="#">
        <img src="../webassets/images/searchbar.png" class="img-fluid  ms-2 mt-1" alt="search bar" style="width:40px;height:30px">

       
      </a>
    </div>
  </div> -->

  <div class="row">
  <div class="col-md-12 mb-4 blog-flt-opt">

<div class="select-menu">

<div class="select-btn">

  <span class="sBtn-text">Filter</span>

  <svg role="img" viewBox="0 0 512 512">

  <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>

    </svg>

</div>

<ul class="options">

  <li class="option">

    <span class="option-text">Popular</span>

  </li>

  <li class="option">

    <span class="option-text">Old</span>

  </li>

  <li class="option">

    <span class="option-text">New</span>

  </li>


</ul>

</div>



</div>

    <?php $srk = 1; ?>

    @foreach($findBlogs as $blog)

    <?php $firstStringCharacter = substr($blog->blog_date,5,2); ?>


    <div class="col-12 col-lg-4 mb-6 mb-lg-0">

      <!-- Blog Card -->

      <a href="<?=route('blogpage', str_replace(" ","-",strtolower($blog->blog_name)))?>">

        <div class="card border-0 bg-transparent">

          <div class="position-absolute bg-white shadow-primary text-center p-2 rounded ml-3 mt-3"><?=$firstStringCharacter?>

          <br><?=date('D', strtotime($blog->blog_date))?></div>

          <img class="card-img-top shadow rounded" src="<?=asset('/assets/uploads/blogs/'.$blog->blog_image)?>" alt="{{$blog->image_alt}}">

          <div class="card-body pt-5"> <a class="d-inline-block text-muted mb-2" href="<?=route('blogpage', str_replace(" ","_",strtolower($blog->blog_name)))?>"><?=$blog->blog_date?></a>

            <h2 class="h5 font-weight-medium">

              <a class="link-title" href="<?=route('blogpage', str_replace(" ","-",strtolower($blog->blog_name)))?>">{{ $blog->blog_name }}</a>

            </h2>

            <p>{!! serviceModel::getDesc(strip_tags($blog->blog_desc),100) !!}</p>

          </div>

          <div class="card-footer bg-transparent border-0 pt-0">
           
          </div>

          <div></div>

        </div>
      </a>
      <!-- End Blog Card -->

    </div>

    @endforeach

    <div class="row">

     <div class="col-md-5">
     </div>
     <div class="col-md-7">

      <nav aria-label="...">

        <center>

          {{$findBlogs->links()}}

        </center>

      </nav>

    </div>

   </div>
 </div>
 </section>
 </div>


 </section>
   
<script>
  const optionMenu = document.querySelector(".select-menu"),

selectBtn = optionMenu.querySelector(".select-btn"),

options = optionMenu.querySelectorAll(".option"),

sBtn_text = optionMenu.querySelector(".sBtn-text");

selectBtn.addEventListener("click", () =>
optionMenu.classList.toggle("active")
);

options.forEach((option) => {

option.addEventListener("click", () => {

  let selectedOption = option.querySelector(".option-text").innerText;

  sBtn_text.innerText = selectedOption;

  optionMenu.classList.remove("active");

});

});
  </script>


@include('layouts.frontfooter')