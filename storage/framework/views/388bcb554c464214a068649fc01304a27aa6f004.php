 <?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php 

use \App\Model\Entry\Service_model as serviceModel;
$content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); 
 
?>
<!--header end-->
<!--hero section start-->
<!--header end-->


<!--hero section start-->

<div class="position-relative">
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
</div>

<!--hero section end--> 


<!-- about us dheeraj--->

<div class="page-content">



  <div class="container">
    <div class="col-md-12">
     

       <img src="https://ahecounselling.com/assets/uploads/aboutus/Untitled design (4).png" style="width: 100%;">

      
     </div>
    <div class="row">
      
        <div class="col-md-5">
          
          <div class="imges-about-sce">
            <img src="webassets/images/aboutus-png.png" style="width: 100%;">
          </div>
        </div>
        <div class="col-md-7">
          <div class="about_tabs-style" id="pagges-text-style">
          
            <p>
              AHEC is an acronym for academic help and e-counseling. Established in 2017, AHEC has by far assisted over 15000 students across 4-5 continents— including countries such as UK, USA, Australia, UAE— and helped them obtain excellent grades. We live in a fast-paced world these days, and as a student, you may often get caught up with more activities than you can efficiently deal with. All of these activities demand equal attention, which is nearly impossible to give. Now, you can just sit back and relax, because AHEC is always there to help you. You can focus on activities that need your presence and delegate some tasks which you never thought could be delegated.
              AHEC is an India-based platform that offers academic help and e-counseling for undergraduate as well as for postgraduate students. We have a team of professional writers and online counselors & tutors who are considered estimable in their respective fields. Professional writers deliver plagiarism-free content, and counselors and tutors address your queries and offer the best solution to your problems related to academics.</p>
              <p>
                We aim to build an integrated environment at AHEC so that experts from any academic field can partake to add value to students’ lives. Also, we aim to extend to our services to students of as many universities as we efficiently can, so that students from any corner of the world can turn to AHEC to enlist academic help. With a broad range of services— from proofreading your assignment to preparing dissertation reports to offer unstinting academic support and e-counseling— we have much to offer to students from national and international universities.
              </p>
            <p>
              AHEC team comprises of professional writers, and they are assigned the assignment on the basis of their skillset and prior experiences and knowledge. First, they carefully understand and thoroughly research the topic. Next, they compile data, facts, and figures. Then, they work on the presentation of your assignment so that it looks well-researched, informative, and compelling to the professor. AHEC ensures smooth transfer of knowledge and quick completion of the assignment. Not only does AHEC offer plagiarism-free, original, and authentic reports, but also, it intends to enrich your overall academic experience.
            </p>
            <p>AHEC lifts the burden off your shoulders by delivering the best academic content. Since 2017, we have been working diligently to help students make better decisions, obtain excellent grades, and focus more on areas that demand most of their attention. Once you are connected to AHEC, you can be certain that an entire team stands beside you to offer help and guidance.</p>
          </div>
        </div>

  
    </div>
  </div>
</div>

<style type="text/css">

  .our-vission-style {

    border-bottom: 2px solid #ff9022;
    padding-bottom: 22px;

  }
  .our-vission-style ul li{
    color: #a2a2a2;
  }

  .our-vission-style h3{

    font-size: 40px;
    font-weight: 600;
    color: #bcb7c2;

  }
</style>



<section class="">
  <div class="container">
    <div class="col-md-12">
      <div class="row">
        
        <div class="col-md-4">
          <div class="our-vission-style">
            <h3>01</h3>
            <h5>Our Vision</h5>
            <ul>
              <li>To have a customer first policy and deliver on-time results.</li>
              <li>Working as a team with the members and the clients</li>
              <li>Have a professional approach to all our projects.</li>
              <li>Bringing innovations constantly</li>
              <li>Follow the latest global standards in designing technology</li>
            </ul>
          </div>
        </div>
        <div class="col-md-4">
          <div class="our-vission-style">
            <h3>02</h3>
            <h5>Our Mission</h5>
            <ul>
              <li>To have a customer first policy and deliver on-time results.</li>
              <li>Working as a team with the members and the clients</li>
              <li>Have a professional approach to all our projects.</li>
              <li>Bringing innovations constantly</li>
              <li>Follow the latest global standards in designing technology</li>
            </ul>
          </div>
        </div>
        <div class="col-md-4">
          <div class="our-vission-style">
            <h3>03</h3>
            <h5>Grow Together</h5>
            <ul>
              <li>To have a customer first policy and deliver on-time results.</li>
              <li>Working as a team with the members and the clients</li>
              <li>Have a professional approach to all our projects.</li>
              <li>Bringing innovations constantly</li>
              <li>Follow the latest global standards in designing technology</li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>


<!-- End about us dheeraj--->






<!--body content start-->
<!--
<div class="page-content">

<!--blog start-->

 <!--
  <div class="container">
    <div class="row">

  <div class="col-md-12">
     

       <img src="<?=asset('/assets/uploads/aboutus/'.$aboutusmodel->about_image)?>" width='984' height="550">

      
     </div>

     
      <div class="col-md-12" style="text-align: justify;">
         <?php echo $aboutusmodel->about_desc; ?>

      </div>
  
   

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
 

<!--blog end-->

</div>

<!--body content end--> 
  <!--body content end-->
<!-- footer start -->
<?php echo $__env->make('layouts.frontfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/web/about-us.blade.php ENDPATH**/ ?>