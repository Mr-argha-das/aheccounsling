@include('layouts.frontend')

<?php

$content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); 
 
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

<div class="container">
 
  
  <h4 class="text-center mt-5">Blog Post</h4>

<label for="exampleInputTitle" class="form-label mt-5">Title</label>
  <input type="text" class="form-control" id="" aria-describedby="">
  <div class="row">
    <div class="col-md-6">
<label for="exampleInputBlog" class="form-label mt-3">Blog</label>
<textarea style="height:100px"></textarea>
 </div>
    <div class="col-md-6">
 <label for="exampleInputDetails" class="form-label mt-3">Other Details</label>
<textarea style="height:100px"></textarea>
</div>
</div>
<div class="row">
 <div class="col-md-6">
  <label for="exampleInputfile" class="form-label mt-3">Upload Your Photos</label>
  <input type="file" class="form-control" id="" aria-describedby="">
 </div>
  </div>
<button class="px-3 py-2 shadow rounded text-white bg-primary border-0 mt-5">Submit</button>
</form>
</div>

    
@include('layouts.frontfooter')