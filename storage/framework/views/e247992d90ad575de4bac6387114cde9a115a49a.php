<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 
  <section class="custom-pt-1 custom-pb-2 bg-dark position-relative" data-bg-img="webassets/images/bg/02.png">

      <div class="container">

        <div class="row">

          <div class="col-lg-4 col-md-6 mb-8 mb-lg-0 text-white">

            <div> <span class="badge badge-primary-soft p-2">

              <i class="la la-cubes ic-3x rotation"></i>

            </span>

            <h2 class="mt-3 mb-0">Frequently Asks Questions on <?php echo e($faqcategory->title); ?></h2>

          </div>

        </div>

        

        <div class="col-lg-8 col-md-8 mt-6 mt-md-0">

         <ul>

           <?php 

            $questions = json_decode($faqcategory->questions,true);
            $answers = json_decode($faqcategory->answers,true);

           foreach ($questions as $key => $value) { 

              $mainEntity[$key]['@type'] ='Question';
              $mainEntity[$key]['name'] =$value.'?';
              $mainEntity[$key]['acceptedAnswer']['@type'] ='Answer';
              $mainEntity[$key]['acceptedAnswer']['text'] =$answers[$key].'.'; 

                ?>

           <li class="question" id="question"><div class="expand-bar"></div>Q<?php echo e($key+1); ?>: <?php echo e($value); ?>?</li>

           <li class="answer">Ans: <?php echo e($answers[$key]); ?>.</li>

            <?php } ?>
               <!--  <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "FAQPage",
                      "mainEntity":<?php  echo json_encode($mainEntity,JSON_UNESCAPED_SLASHES);  ?>
                    }
                    </script> -->



         </ul>

       </div>

     </div>

     <div class="shape-1" style="height: 150px; overflow: hidden;">

      <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">

        <path d="M0.00,49.98 C150.00,150.00 271.49,-50.00 500.00,49.98 L500.00,0.00 L0.00,0.00 Z" style="stroke: none; fill: #fff;"></path>

      </svg>

    </div>

    <div class="shape-1 bottom" style="height: 200px; overflow: hidden;">

      <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">

        <path d="M0.00,49.98 C150.00,150.00 349.20,-50.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>

      </svg>

    </div>

  </section>
<?php echo $__env->make('layouts.frontfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php /**PATH /home/agroupso/ahecounselling.com/resources/views/web/faqpage.blade.php ENDPATH**/ ?>