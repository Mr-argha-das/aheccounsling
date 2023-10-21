@include('layouts.frontend')

<?php

$content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); 

$list  = DB::table('youtube_link')->orderBy('y_id','desc')->get();; ?>

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

<section>







<div class="container">

    <div class="row">    

    <?php 

    if(!empty($list))

    {

        foreach($list as $key =>$vk)

        {

            $findID = $vk->y_url;

            $ID = explode('v=',$findID);

           

            if(!empty($ID[1]))

            {

              ?>



<style type="text/css">
  #video-sece{
    padding: 14px;
    margin-bottom: 16px;
  }

  .card-content{
    
    margin-top: 5%;
    text-align: center;
    color: #000;

  }
</style>
               <div class="col-md-4 ">

                   <a data-fancybox href="{{$findID}}">

                    <div class="card" id="video-sece">

                        <div class="card-image">

                            <div class="embed-responsive embed-responsive-16by9">

        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $ID[1] }}" frameborder="0" allowfullscreen></iframe>

        </div>

                            

                        </div><!-- card image -->

                        

                        <div class="card-content">

                            <span class="card-title"><?=$vk->y_title?></span>                    

                            

                        </div><!-- card content -->

                        

                        

                    </div>

                    </a>

                </div>

              <?php

                

            }

            

        }

    }

    ?>

               

               

    </div>

    </div>

</section>







<!--hero section end--> 





<!--body content start-->



<div class="page-content">



<section>





 

</section>







</div>



<!--body content end--> 



<!-- footer start -->

@include('layouts.frontfooter')