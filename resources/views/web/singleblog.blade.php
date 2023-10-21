@include('layouts.frontend')

<?php 

use \App\Model\Entry\Blog_model as blogModel;

use \App\Model\Entry\Service_model as serviceModel;

$findBlogs = blogModel::where('blog_status',1)->limit(10)->orderBy('order_number')->get();

$firstStringCharacter = substr($row->blog_date,5,2);

?>

 <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "@id": "{{$ListItem[2]['item']}}#webpage",
            "name": "{{ $seoTitle }}",
            "description": "{{ $seoDesc }}",
            "url" : "{{$ListItem[2]['item']}}",

             "datePublished": "<?php echo date('Y-m-d',strtotime($row->blog_date)).'T7:07:44+05:30' ?>",
             "dateModified": "<?php echo date('Y-m-d',strtotime($row->blog_date)).'T23:10:44+05:30' ?>",

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
              "url": "{{asset('assets/uploads/projectdoc/'.$row->img_1) }}",
              "width": 1200,
              "height": 810
            },
               "datePublished": "<?php echo date('Y-m-d',strtotime($row->blog_date)).'T7:07:44+05:30' ?>",
               "dateModified": "<?php echo date('Y-m-d',strtotime($row->blog_date)).'T23:10:44+05:30' ?>",

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
            "articleSection": "{{ $row->blog_name }}",
            "description": "{{ $seoDesc }}"  }
          </script>


<section>

  <div class="container mt-5">

    <div class="row">

      <div class="col-12 my-single">

        <!-- Blog Card -->

        <div class="card border-0 bg-transparent">

          <div class="position-absolute bg-white shadow-primary text-center p-2 rounded ml-3 mt-3"><?=$firstStringCharacter?>

            <br><?=date('F', strtotime($row->blog_date))?></div>

          <img class="card-img-top shadow rounded single-blg-img" src="<?=asset('/assets/uploads/blogs/'.$row->blog_image)?>"  alt="{{ $row->image_alt }}">

          <div class="card-body pt-5 px-0" style="text-align: justify;">

            <ul class="list-inline">

              <li class="list-inline-item pr-4"> <a href="#" class="text-muted"><i class="ti-comments mr-1 text-primary"></i> 131</a>

              </li>

              <li class="list-inline-item pr-4"> <a href="#" class="text-muted"><i class="ti-eye mr-1 text-primary"></i> 255</a>

              </li>

              <li class="list-inline-item"> <a href="#" class="text-muted"><i class="ti-comments mr-1 text-primary"></i> 14</a>

              </li>

            </ul>
            <a href="{{$whatsAppLink}}"><button class="w-100 bg-success text-white px-5 py-3 border-0 mb-2 mt-2">Ask us on What's App</button></a>
            <h1 class="font-weight-medium">
                {{ $row->blog_name }}
              </h1>

               <div id="toctoc"></div>
               <div class="row column-view">
                <div class="col-md-8">
                <div class="content-area description">
                <article class="tag-text">
                 {!! $row->blog_desc !!}

               </article>
              </div>
                </div>
                  @if(isset($row->youTubeLink))

                   
                <div class="col-md-4">
                <iframe width="100%" height="280" src="https://www.youtube.com/embed/{{$row->youTubeLink}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                 @endif
               </div>
             

          </div>
            
          <?php   if($row->questions!=null) {    ?>

             <h2>Frequently asked questions</h2> 

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
    <div class="card-header pointer p-1" data-toggle="collapse" data-target="#collapse-{{$key}}">
          <h6 class="mb-0">{{$value}} ?</h6>
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

            <?php  } ?> 

        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center mt-2">
              <button type="button" class="px-5 py-2 border-0 shadow bg-primary text-white rounded">Book Your Assignment</button>
          </div>
        </div>

          <div class="d-md-flex justify-content-between mt-5 mb-5">

            <div>

              <h6 class="mb-2">Share: </h6>

              <ul class="list-inline mb-0">

                <li class="list-inline-item"><a class="text-dark ic-2x" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=route('blogpage', str_replace(" ","-",strtolower($row->blog_name)))?>"><i class="la la-facebook"></i></a>

                </li>

              

                <li class="list-inline-item"><a class="text-dark ic-2x" target="_blank" href="http://www.twitter.com/share?url=<?=route('blogpage', str_replace(" ","-",strtolower($row->blog_name)))?>"><i class="la la-twitter"></i></a>

                </li>

                <li class="list-inline-item"><a class="text-dark ic-2x" target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?=route('blogpage', str_replace(" ","-",strtolower($row->blog_name)))?>"><i class="la la-linkedin"></i></a>

                </li>

              </ul>

            </div>

          </div>

          <div class="owl-carousel no-pb" data-dots="false" data-items="2" data-sm-items="1" data-autoplay="true">



<?php $srk = 1; ?>

    @foreach($findBlogs as $blogss)

<?php $firstStringCharacter = substr($blogss->blog_date,5,2);

  ?>
  
         <div class="item">

              <div class="card border-0 bg-transparent m-4">

                <div class="position-absolute bg-white shadow-primary text-center p-2 rounded ml-3 mt-3">{{ $firstStringCharacter }}

                  <br><?=date('F', strtotime($blogss->blog_date))?></div>

               <a class="link-title" href="<?=route('blogpage', str_replace(" ","-",strtolower($blogss->blog_name)))?>"> 
                <img class="card-img-top shadow rounded" src="<?=asset('/assets/uploads/blogs/'.$blogss->blog_image)?>" alt="{{$blogss->image_alt}}"> </a>

                <div class="card-body pt-5"> <a class="d-inline-block text-muted mb-2" href="<?=route('blogpage', str_replace(" ","-",strtolower($blogss->blog_name)))?>"></a>

                  <h2 class="h5 font-weight-medium">

                <a class="link-title" href="<?=route('blogpage', str_replace(" ","-",strtolower($blogss->blog_name)))?>">{{ $blogss->blog_name }}</a>

              </h2>

               

                </div>

                <div></div>

              </div>

            </div>

    @endforeach



          

          </div>

        

      </div>

    </div>

  </div>

</section>
   

    
@include('layouts.frontfooter')