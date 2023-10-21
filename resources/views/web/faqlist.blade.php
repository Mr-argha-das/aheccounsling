@include('layouts.frontend')

<?php $faqcategory = \App\Model\Entry\FaqCategory_model::get(); ?>

<section class="position-relative">

  <div id="particles-js"></div>

  <div class="container">

    <div class="row  text-center">

      <div class="col">

        <h1></h1>

        <nav aria-label="breadcrumb">

          <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">

            <li class="breadcrumb-item"><a class="text-dark" href="#">Home</a>

            </li>

            <li class="breadcrumb-item active text-primary" aria-current="page"></li>

          </ol>

        </nav>

      </div>

    </div>

    <!-- / .row -->

  </div>

  <!-- / .container -->

</section>

<section class="pt-0">

  <div class="container">

  <div class="row align-items-center">
   @foreach ($faqcategory as $faqvalue)
     <div class="col-xl-4 col-lg-4 mb-8 mb-lg-0 bl-bdr">
        <div class="px-4 py-7 rounded hover-translate text-center shadow"> 
          <h5 class="mt-4 mb-3">
             <a href="<?=route('faqpages', str_replace(" ","-",$faqvalue->fal_slug))?>">
              {{ $faqvalue->title }}
             </a>
            </h5>
            <p>{{ serviceModel::getDesc($faqvalue->seo_description,100) }}</p>
          </div>
        </div>
     @endforeach
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