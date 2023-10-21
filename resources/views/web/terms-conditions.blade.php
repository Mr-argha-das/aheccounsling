@include('layouts.frontend')
<?php $content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); ?>
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
   </div>
 </section>
 <section class="position-relative">
 <div id="particles-js"></div>
  <div class="container">
      <?php echo $content->menu_txt; ?>
    </div>
  </div>
 </section>
@include('layouts.frontfooter')