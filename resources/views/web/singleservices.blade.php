@include('layouts.frontend')

<?php 
use \App\Model\Entry\Service_model as Servicemodel;
$findBlogs = Servicemodel::limit(10)->inRandomOrder()->get();
$firstStringCharacter = '';
?>
<script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "@id": "{{$ListItem[2]['item']}}#webpage",
            "name": "{{ $seoTitle }}",
            "description": "{{ $seoDesc }}",
            "url" : "{{$ListItem[2]['item']}}",

             "datePublished": "<?php echo date("y-M-d H:i:s",strtotime("-2 month")).'T7:07:44+05:30' ?>",
             "dateModified": "<?php echo date("y-M-d H:i:s",strtotime("-1 month")).'T23:10:44+05:30' ?>",

             "isPartOf":{
              "@type": "WebSite",
              "@id": "{{url('/')}}#WebSite",
              "name": "AHECounselling: AHECounselling - Career Counselling | Career Guidance Program Online - ahecounselling.com",
              "description": "Free Global career counselling services offers the best career counselling courses/career guidance programme online. Register and become a certified career counsellor.  at Ahecounselling.",
             "url" : "{{url('/')}}"
            },

            "publisher": {
                "@type": "Organization",
                "name": "Ahecounselling",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{url('/')}}/webassets/images/logo.png",
                    "width": 240,
                    "height": 35
                }
            }
        } 
</script>
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Article",
    "mainEntityOfPage":{
      "@type":"WebPage",
      "@id":"{{$ListItem[2]['item']}}#Article"
    },
    "headline": "{{$seoTitle}}",
    "image": {
      "@type": "ImageObject",
      "url": "<?=asset('/assets/uploads/services/'.$row->services_image)?>",
      "width": 1200,
      "height": 810
    },
       "datePublished": "<?php echo date("Y-m-d H:i:s",strtotime("-2 month")).'T7:07:44+05:30' ?>",
       "dateModified": "<?php echo date("Y-m-d H:i:s",strtotime("-1 month")).'T23:10:44+05:30' ?>",

    "author": {
      "@type": "Organization",
      "name": "Ahecounselling",
       "url": "{{url('/')}}/about-us"
    },
    "publisher": {
                "@type": "Organization",
                "name": "Ahecounselling",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{url('/')}}/webassets/images/logo.png",
                    "width": 240,
                    "height": 35
                }
            },
    "keywords": ["{{ $seoKeyword }}"],
    "articleSection": "{{ $row->services_name }}",
    "description": "{{ $seoDesc }}"  }
  </script>

<section>

  <div class="container">

    <div class="row">

      <div class="col-12">

        <!-- Blog Card -->

        <div class="card border-0 bg-transparent">

          <div class="position-absolute bg-white shadow-primary text-center p-2 rounded ml-3 mt-3"><?=$firstStringCharacter?>

            <br><?=date('D')?></div>

          <img class="card-img-top shadow rounded" src="<?=asset('/assets/uploads/services/'.$row->services_image)?>"  alt=" {{ $row->services_name }}">

          <div class="card-body pt-5 px-0" style="text-align: justify;">

            <ul class="list-inline">

              <li class="list-inline-item pr-4"> <a href="#" class="text-muted"><i class="ti-comments mr-1 text-primary"></i> 131</a>

              </li>

              <li class="list-inline-item pr-4"> <a href="#" class="text-muted"><i class="ti-eye mr-1 text-primary"></i> 255</a>

              </li>

              <li class="list-inline-item"> <a href="#" class="text-muted"><i class="ti-comments mr-1 text-primary"></i> 14</a>

              </li>

            </ul>

            
            <h2 class="font-weight-medium">

             {{ $row->services_name }}

              </h2>

         

            {!! $row->services_desc !!}

            <div class="">
                 
                <a class="btn btn-primary  d-lg-block" href="#" data-toggle="modal" id="book-now-css" data-target="#basicModal">Book Now</a>
              
            </div>

          </div>
          <a href="{{$whatsAppLink}}"><button class="w-100 bg-success text-white px-5 py-3 border-0 mb-2 mt-2">Click on Whatsapp</button></a>

                    <?php   if($row->questions!=null){    ?>

             <h2 class="mt-5">Frequently asked questions</h2> 

             <div id="accordion">
               <?php 

                   $questions = json_decode($row->questions,true);
                   $answers = json_decode($row->answers,true);

                   foreach ($questions as $key => $value) { 

                    $mainEntity[$key]['@type'] ='Question';
                    $mainEntity[$key]['name'] =$value.'?';
                    $mainEntity[$key]['acceptedAnswer']['@type'] ='Answer';
                    $mainEntity[$key]['acceptedAnswer']['text'] =$answers[$key].'.'; 
                    
                    ?>
                      
  <div class="card">
    <div class="card-header pointer" data-toggle="collapse" data-target="#collapse-{{$key}}">
          <h5 class="mb-0">{{$value}} ?</h5>
    </div>
    <div id="collapse-{{$key}}" class="collapse show" data-parent="#accordion">
      <div class="card-body">
        {!! $answers[$key] !!}
      </div>
    </div>
  </div>
   <?php  }  ?> 
</div> 
   <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity":@php  echo json_encode($mainEntity,JSON_UNESCAPED_SLASHES);  @endphp
    }
    </script>

            <?php  }  ?> 

        

          <div class="d-md-flex justify-content-between mt-5 mb-5">

            <div>

              <h6 class="mb-2">Share: </h6>

              <ul class="list-inline mb-0">

                <li class="list-inline-item"><a class="text-dark ic-2x" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=route('servicespage', str_replace(" ","-",strtolower($row->services_name)))?>"><i class="la la-facebook"></i></a>

                </li>

              

                <li class="list-inline-item"><a class="text-dark ic-2x" target="_blank" href="http://www.twitter.com/share?url=<?=route('servicespage', str_replace(" ","-",strtolower($row->services_name)))?>"><i class="la la-twitter"></i></a>

                </li>

                <li class="list-inline-item"><a class="text-dark ic-2x" target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?=route('servicespage', str_replace(" ","-",strtolower($row->services_name)))?>"><i class="la la-linkedin"></i></a>

                </li>

              </ul>

            </div>

          </div>

          <div class="owl-carousel no-pb" data-dots="false" data-items="2" data-sm-items="1" data-autoplay="true">



<?php $srk = 1; ?>

    @foreach($findBlogs as $blog)



<?php  

 $firstStringCharacter = '';

 ?>

            <div class="item">

              <div class="card border-0 bg-transparent m-4">

                <div class="position-absolute bg-white shadow-primary text-center p-2 rounded ml-3 mt-3">{{ $firstStringCharacter }}

                  <br><?=date('D')?></div>
                  <a href="<?=route('servicespage', str_replace(" ","-",strtolower($blog->services_name)))?>">

                <img class="card-img-top shadow rounded" src="<?=asset('/assets/uploads/services/'.$blog->services_image)?>" alt="Image">

                  </a>

                <div class="card-body pt-5"> <a class="d-inline-block text-muted mb-2" href="<?=route('servicespage', str_replace(" ","-",strtolower($blog->services_name)))?>"></a>

                  <h2 class="h5 font-weight-medium">

                <a class="link-title" href="<?=route('servicespage', str_replace(" ","-",strtolower($blog->services_name)))?>">{{ $blog->services_name }}</a>

              </h2>

                  <p>{{ serviceModel::getDesc($blog->blog_desc,100) }}</p>

                </div>

                <div></div>

              </div>

            </div>

    @endforeach



          

          </div>

         <!-- <div class="mt-5">

            <div class="mb-8"> <span class="badge badge-primary-soft p-2">

                  <i class="la la-commenting ic-3x rotation"></i>

              </span>

              <h2 class="mt-3">All Comments</h2>

            </div>

            <div class="media d-block d-md-flex">

              <img class="img-fluid shadow rounded" alt="image" src="assets/images/thumbnail/01.jpg">

              <div class="media-body mx-0 mx-md-5 mx-lg-8 my-5 my-md-0">

                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">

                  <h6>Ben Miller</h6>  <small class="text-muted">5 Days Ago</small>

                </div>

                <p>Seuismod dissentiunt ne sit, ad eos iudico qualisque adversarium, tota falli et mei. Esse euismod urbanitas ut sed, et duo scaevola pericula splendide. Primis veritus contentiones nec ad, nec et tantas semper delicatissimi.</p>

              </div> <a class="align-items-center d-inline-block btn btn-primary align-self-center" href="#"><i class="ti-comments mr-2"></i> Reply</a>

            </div>

            <div class="media d-block d-md-flex mt-8 ml-5 ml-md-8 bg-primary-soft rounded shadow p-5">

              <img class="img-fluid shadow rounded" alt="image" src="assets/images/thumbnail/02.jpg">

              <div class="media-body mx-0 mx-md-5 mx-lg-8 my-5 my-md-0">

                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">

                  <h6>Sasha James</h6>  <small class="text-muted">1 Hours Ago</small>

                </div>

                <p>Seuismod dissentiunt ne sit, ad eos iudico qualisque adversarium, tota falli et mei. Esse euismod urbanitas ut sed, et duo scaevola pericula splendide. Primis veritus contentiones nec ad, nec et tantas semper delicatissimi.</p>

              </div> <a class="align-items-center d-inline-block btn btn-primary align-self-center" href="#"><i class="ti-comments mr-2"></i> Reply</a>

            </div>

            <div class="media d-block d-md-flex mt-8">

              <img class="img-fluid shadow rounded" alt="image" src="assets/images/thumbnail/03.jpg">

              <div class="media-body mx-0 mx-md-5 mx-lg-8 my-5 my-md-0">

                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">

                  <h6>Keron Jolie</h6>  <small class="text-muted">2 Week Ago</small>

                </div>

                <p>Seuismod dissentiunt ne sit, ad eos iudico qualisque adversarium, tota falli et mei. Esse euismod urbanitas ut sed, et duo scaevola pericula splendide. Primis veritus contentiones nec ad, nec et tantas semper delicatissimi.</p>

              </div> <a class="align-items-center d-inline-block btn btn-primary align-self-center" href="#"><i class="ti-comments mr-2"></i> Reply</a>

            </div>

          </div>

          <div class="post-comments mt-5">

            <div class="mb-8"> <span class="badge badge-primary-soft p-2">

                  <i class="la la-commenting ic-3x rotation"></i>

              </span>

              <h2 class="mt-3">Leave A Comment</h2>

            </div>

            <form id="contact-form" class="row" method="post" action="http://themeht.com/bootsland/html/contact.php">

              <div class="messages"></div>

              <div class="form-group col-sm-6">

                <input id="form_name" type="text" name="name" class="form-control border-0 bg-light" placeholder="Name" required="required" data-error="Name is required.">

                <div class="help-block with-errors"></div>

              </div>

              <div class="form-group col-sm-6">

                <input id="form_email" type="email" name="email" class="form-control border-0 bg-light" placeholder="Email" required="required" data-error="Valid email is required.">

                <div class="help-block with-errors"></div>

              </div>

              <div class="form-group mb-0 col-sm-12">

                <textarea id="form_message" name="message" class="form-control border-0 bg-light h-100" placeholder="Your Comment" rows="4" required="required" data-error="Please,leave us a message."></textarea>

                <div class="help-block with-errors"></div>

              </div>

              <div class="col-sm-12">

                <button class="btn btn-primary mt-5">Post Comment</button>

              </div>

            </form>

          </div>

          <div></div>

        </div>-->

        <!-- End Blog Card -->

      </div>

    </div>

  </div>

</section>

@include('layouts.frontfooter')