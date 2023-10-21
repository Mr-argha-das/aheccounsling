@include('layouts.frontend')
<?php
  use \App\Model\Country_model as countryModel;
  $countryCode = countryModel::pluck('phonecode','id');
 ?>
<style type="text/css">
	.section{
		padding: 0px;
	}
   @media only screen and (min-width: 320px) and (max-width: 767px){
       #misn-style{
      display: none;
   }
   }
  
</style>  

<script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "@id": "{{$ListItem[2]['item']}}#webpage",
            "name": "{{ $seoTitle }}",
            "description": "{{ $seoDesc }}",
            "url" : "{{$ListItem[2]['item']}}",

             "datePublished": "<?php echo date('Y-m-d',strtotime($projectdata->created_at)).'T7:07:44+05:30' ?>",
             "dateModified": "<?php echo date('Y-m-d',strtotime($projectdata->created_at)).'T23:10:44+05:30' ?>",

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
      "@id":"{{$ListItem[2]['item']}}#{{$projectdata->category_list->cat_slug}}"
    },
    "headline": "{{$seoTitle}}",
    "image": {
      "@type": "ImageObject",
      "url": "{{asset('assets/uploads/projectdoc/'.$projectdata->img_1) }}",
      "width": 1200,
      "height": 810
    },
       "datePublished": "<?php echo date('Y-m-d',strtotime($projectdata->created_at)).'T7:07:44+05:30' ?>",
       "dateModified": "<?php echo date('Y-m-d',strtotime($projectdata->created_at)).'T23:10:44+05:30' ?>",

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
    "articleSection": "{{ $projectdata->category_list->cat_slug }}",
    "description": "{{ $seoDesc }}"  }
  </script>

<main class="height-100">
   <div class="pg_docsdetail">
      <section class="clsdsd">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb breadcrumb-transparent mb-0 rounded-0">
                        <li class="breadcrumb-item"><a class="" href="/">Home</a></li>
                        <li class="breadcrumb-item"><a class="" href="/sample-project">All Projects</a></li>
                        <li aria-current="page" class="breadcrumb-item active Roboto-Bold"><a class="" href="/sample-project/{{ $projectdata->category_list->name }}">{{ $projectdata->category_list->cat_slug }}</a> </li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </section>
      <section class="clsdsd">
         <div class="container">
            <div class="row pt-0">
               <article class="col-md-9">
                  <div class="row">
                     <div class="col-md-12 docs_title">
                        <h1 class="Roboto-Bold h3">{{ $projectdata->title }}</h1>
                        <p>Added on - <?php echo date('d M Y',strtotime($projectdata->created_at)) ?></p>
                     </div>
                     <div class="col-md-12">
                        <div class="dd_custom_description_box">
                           <h3 class="dd_custom_title blue-theme"></h3>
                           <p class="dd_custom_description mb-2"></p>


                           <p> @if (Session::has('successFlash_link'))

                            <strong class="text-success alert alert-success"><a id="trigger_click" href="{{ $projectdata->url }}">Click here to download
                             </a></strong>

                               @endif

                               @if (Session::has('errorFlash'))
                                <strong class="text-danger alert alert-danger">{!! Session::get('errorFlash') !!}</strong>
                               @endif

                          </p>
                        </div>
                     </div>
                     <div class="col-md-12 docs_count ">
                        <ul class="p-0 d-inline-block">
                           <li class="d-inline-block p-2 text-center border-right">
                              <p class="blue-theme font-weight-600 mb-1" style="color: #f44336;">{{ $projectdata->no_of_page }}</p>
                              <p class="Roboto-Medium mb-0">Pages</p>
                           </li>
                           <li class="d-inline-block p-2 text-center border-right">
                              <p class="blue-theme font-weight-600 mb-1" style="color: #19aff8;">{{ $projectdata->word_count }}</p>
                              <p class="Roboto-Medium mb-0">Words</p>
                           </li>
                           <li class="d-inline-block p-2 text-center border-right">
                              <p class="text_yellow font-weight-600 mb-1" style="color: #139a45;">{{ $projectdata->views }}</p>
                              <p class="Roboto-Medium mb-0">Views</p>
                           </li>
                           <li class="d-inline-block text-center p-2">
                              <p class="text_red font-weight-600 mb-1" style="color: #7279e3;">{{ $projectdata->download }}</p>
                              <p class="Roboto-Medium mb-0">Downloads</p>
                           </li>
                        </ul>
                     </div>
                     
                     <div class="col-md-12">
                        <a href="{{$whatsAppLink}}"><button class="smpl-wp-btn">Ask your query on Whats'app</button></a>
                     </div>

                  </div>
                  <div class="row docsdetaildwnld">
                     <div class="col-lg-6 d-none d-lg-block">
                     	<span class="d-inline-block d-sm-inline-block w-100 text-left text-md-left text-lg-left Roboto-Bold" style="    background: #bacae8;
    padding: 10px;">Trusted by +2 million users, <br> 1000+ happy students everyday</span></div>
                     <div class="col-lg-6 text-md-right">
                          
                           <a class="btn btn_common btn_blue Roboto-Bold" style="background-color: #f44336;" href="javascript:void(0)"  data-toggle="modal" data-target="#downloadmodal">
                     Download This Document</a></div>
                  </div>

                
          
                  <div class="row">
                     <div class="col-md-12">
                        <div class="documentViewer task_box" id="viewer">

                           
                           <div class="page" data-loaded="true" data-page-number="3">
                              <img src="{{  asset('assets/uploads/projectdoc/'.$projectdata->img_1) }}" alt="{{ $projectdata->title }}-1" class="page-image">
                              <div class="textLayer" style="width: 1019px; height: 1319px; transform: scale(0.809617); transform-origin: left top 0px;">
                                 
                                 <div class="endOfContent"></div>
                              </div>
                           </div>
                           <div class="page" data-loaded="true" data-page-number="4">
                              <img src="{{  asset('assets/uploads/projectdoc/'.$projectdata->img_2) }}" alt="{{ $projectdata->title }}-2" class="page-image">
                              <div class="textLayer" style="width: 1019px; height: 1319px; transform: scale(0.809617); transform-origin: left top 0px;">
                                                               </div>
                           </div>
                        </div>
                     </div>
                  </div>
                
                <div>
                       <div class="row mt-3" id="misn-style">
                <div class="col-lg-6">
                    <div class="mid-download-this">
                  <img src="webassets/images/logo.png">
                  <p>You’re reading a preview</p>

                  <img src="webassets/images/web-view-style.png">
                  
                  </div>

                 </div>

                  <div class="col-lg-6">
                  
                  <div class="mid-download-this">
                
                  <p>To View Complete Document</p>
                  <p>Click hear to download get tha download link on mail</p>

                      

                     <button class="mt-2"><a href="javascript:void(0)"  data-toggle="modal" data-target="#downloadmodal">Download This Document</a></button>
                      <button class="mt-2"><a href="/sample-project"> All Projects </a></button>
                  </div>

             </div>

            </div>
         </div>
         
  <section>
          <div class="container  mt-3">
              <button class="accordion"><h4>{{ $projectdata->title }}</h4></button>
                <div class="panel" style="display:block">
                  <p>{!! $projectdata->description !!}</p>
                </div> 
          </div>
        </section>

               </article>


                     <aside class="col-md-3">
                 
                     <div class="findatutor text-center">
                  
                        	<div class="img-se">
                        		<img src="webassets/images/img=1.png">
                        	</div>
                  		
                        <p class="mt-4">Ask your homework question, and get fast and reliable answers from online experts.</p>
                        <a href="javascript:(void)"><button class="btn btn_common btn_blue font-size-12 Roboto-Bold" data-toggle="modal" id="book-now-css" data-target="#basicModal">Book NOW</button></a>
                     </div>

                     <div class="student-relative-simple"> 
                     		<h4>Related samples</h4>
                     </div>
                
                  <section class="similar-resource ">
                     
                     
                     <div class="row">
                         

                         @foreach($lastestProject as $project)

                        <div class="col-md-12 col-lg-12 mb-3">
                           <div class="docslist">
                              <a class="text-decoration-none" href="/document/{{ $project->slug }}"></a>
                              <div class="main-div border-radius-5 shadow document-similar-height">
                                 <a class="text-decoration-none" href="/document/{{ $project->slug }}/">
                                  <img alt="{{ $project->title }}" class="card-img-top" height="360" loading="lazy" src="{{  asset('assets/uploads/projectthumb/'.$project->thub_img) }}" width="255"></a>
                                 <div class="card-body bg-light hover-div">
                                    <a class="text-decoration-none" href="/document/{{ $project->slug }}/">
                                       <h6 class="word-wrap blue-theme">{{ $project->title }}</h6>
                                    </a>
                                    <div class="btn-d-none">
                                       <a class="text-decoration-none" href="/document/{{ $project->slug }}/">
                                          <small class="text-muted">{{ $project->no_of_page }}</small>
                                           <small class="text-muted add-dash">pages | </small>
                                            <small class="text-muted">{{ $project->word_count }}</small>
                                             <small class="text-muted add-dash">words</small>
                                         
                                             
                                           </a>
                                           <a class="btn btn_common btn_blue mt-3 mb-3 w-100" href="/document/{{ $project->slug }}">View</a></div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        @endforeach

                     </div>
                  
                     <div class="row"></div>



                
                  </section>


                
               </aside>    
            </div>
            

         </div>
      </section>
              
                


   </div>
</main>

   

    <!-- preloader end -->
    <div class="modal fade" id="downloadmodal" tabindex="-1" role="dialog" aria-labelledby="downloadmodal" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content p-5">
     <div class="text-right">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
     </div>

      <div class="modal-header">
         
        <h4 class="modal-title">Submit the form to get the download link </h4>
      </div>

       


      <div class="modal-body">
        <form id="download_popup_form" class="row" action="query/senddownloadlink" method="post" enctype="multipart/form-data">
        <div class="form-group col-md-12">
          {{ csrf_field() }}
          

          </div>

             <div class="form-group col-md-6">
                <input id="download_first_name" type="text" name="download_first_name" class="form-control" placeholder="First Name"  required data-error="Name is required.">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group col-md-6">
                <input id="download_last_name" type="text" name="download_last_name" class="form-control" placeholder="Last Name"  data-error="Name is required." required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group col-md-12">
                <input id="download_email" type="text" name="download_email" class="form-control" placeholder="Email"  data-error="Valid email is required." required>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group col-md-3" style="padding-right: 0px;">

               

                 <select class="form-control" name="download_country_code" id="download_country_code" required>

                  @foreach($countryCode as $key =>$vs)

                  <option <?php if($vs==91) echo 'selected' ?> value="{{$vs }}">+{{ $vs}} </option>

                  

                  @endforeach

                 

                </select>

              </div>

              <div class="form-group col-md-9">
                <input id="form_phone" type="number" minlength="10" maxlength="15" name="download_mobile" id="download_mobile" class="form-control" placeholder="Phone"  required>

                  <input type="hidden" name="download_project_id" value="{{ $projectdata->id }}">

               
              </div>
               
               <div class="col-md-6">
                <button class="btn btn-primary" type="submit"><span>Get Link</span>
                </button>
              </div>
       </form>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
  
.accordion {
margin-bottom: 1%;
    background-color: #e2e2e2;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #ccc; 
}

.panel {
  padding: 0 18px;
  display: none;
  background-color: white;
  overflow: hidden;
}
</style>  
    
  
  @section('javascript')
   <script type="text/javascript">
     
   $(document).ready(function(){

        $('#download_popup_form').validate({

                   onfocusout: function(element) {$(element).valid()}
                         , rules: {

                     "download_first_name": {
                         required: true,
                         pattern: /^[a-zA-Z'.\s]{1,40}$/,
                         maxlength: 30,
                         minlength: 2,
                     },"download_last_name": {
                         required: true,
                         pattern: /^[a-zA-Z'.\s]{1,40}$/,
                         maxlength: 30,
                         minlength: 2,
                     },"download_email":{
                        required: true,
                        email: true,
                     },"download_mobile": {
                         required: true,
                         number: true,
                         minlength: 10,
                         maxlength: 10,
                     } 
                  },
                  messages: {
                    "download_mobile": {
                         required: "Phone No is required",
                         number: "Only number are allowed",
                         minlength: "Phone No must contain {10} digit Number",
                         maxlength: "Phone No must contain {10} digit Number",
                     },
                     "download_first_name": {
                         required: "First Name is required",
                         minlength: "First Name must contain at least {4} characters",
                         maxlength: "First Name must contain only {30} characters",
                         pattern: 'Only Characters are allowed',
                     },
                     "download_last_name": {
                         required: "Last Name is required",
                         minlength: "Last Name must contain at least {2} characters",
                         maxlength: "Last Name must contain only {30} characters",
                         pattern: 'Only Characters are allowed',
                     },
                     "download_email":{
                        required: 'Email Address is required',
                        email: 'Please Enter a Valid Email Address',
                     }, 
                   }, submitHandler: function (form) {
                        $('form').find(":submit").attr("disabled", true).attr("value","Submitting...");
                          form.submit();
                    },
                  });
            
             
             var acc = document.getElementsByClassName("accordion");
                var i;

                for (i = 0; i < acc.length; i++) {
                  acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.display === "block") {
                      panel.style.display = "none";
                    } else {
                      panel.style.display = "block";
                    }
                  });
                }

            });

   </script>
  @endsection

@include('layouts.frontfooter')

  