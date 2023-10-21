 <!--footer start-->
   <footer class="py-11 bg-primary position-relative mobile-vw-footer-tp" data-bg-img="webassets/images/bg/03.png">

    <div class="shape-1 mobile-view-shape" style="height: 150px; overflow: hidden;">

      <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;" class="">

        <path d="M0.00,49.98 C150.00,150.00 271.49,-50.00 500.00,49.98 L500.00,0.00 L0.00,0.00 Z" style="stroke: none; fill: #fff;"></path>

      </svg>

    </div>

    <div class="container mt-11">

      <div class="row">

        <div class="col-12 col-lg-5 col-xl-4 mr-auto mb-6 mb-lg-0">

          <div class="subscribe-form bg-warning-soft p-5 rounded">

            <h5 class="mb-4 text-white">Raise Your Query</h5>

            <!-- <h6 class="text-light">Subscribe Our Newsletter</h6> -->

            <form id="mc-form" action="query/newsletter" method="post" class="group">

                {{ csrf_field() }}

                <input type="text" value="" name="" class="email form-control mt-2" id="" placeholder="Name" required="" style="height: 40px;">
              <input type="email" value="" name="" class="email form-control mt-2" id="" placeholder="Email Address" required="" style="height: 40px;">

              <input type="tel" value="" name="" class="email form-control mt-2" id="" placeholder="Phone Number" required="" style="height: 40px;">
              <textarea name="" id="" cols="10" rows="5" class="form-control mt-2 email" placeholder="Subject"></textarea>
              <!-- <input type="text" value="" name="" class="email form-control mt-2" id="" placeholder="Subject" required="" style="height: 100px;"> -->
              <input class="btn btn-outline-light btn-block mt-3 mb-2" type="submit" name="subscribe" value="Submit">

            </form>

          </div>

        </div>

        <div class="col-12 col-lg-6 col-xl-7">

          <div class="row">

            <div class="col-6 navbar-dark">

              <h5 class="mb-4 text-white">Pages</h5>

               <ul class="navbar-nav list-unstyled mb-0">

                 <li class="mb-3 nav-item"><a class="nav-link" href="about-us">About Us</a></li>

                 <li class="mb-3 nav-item"><a class="nav-link" href="affiliates-terms">Become an Affiliate</a></li>

                </li>
                <li class="mb-3 nav-item"><a class="nav-link" href="FL-Registration">FL Registration</a>

                </li>
                <li class="nav-item"><a class="nav-link" href="video-gallery">Video Gallery</a>
                </li>

              </ul>

            </div>

            <div class="col-12 mt-6 order-2 mt-sm-0 navbar-dark">
        <?php
         use \App\Model\Entry\Service_model as serviceModel;
         $findService = serviceModel::where('services_status',1)->orderBy('services_id','asc')->limit(4)->get();
         ?>

              <h5 class="mb-4 text-white mt-1">Service</h5>


              <div class="row">
              <div class="col-6">
              <ul class="navbar-nav list-unstyled mb-0">
                  @foreach($findService as $service)
                  <li class="mb-3 nav-item"><a class="nav-link" href="<?=route('servicespage', str_replace(" ","-",strtolower($service->services_name)))?>">{{ $service->services_name }}</a>
                  </li>
                @endforeach
               
              </ul>
              </div>

              <div class="col-6">
              <ul class="navbar-nav list-unstyled mb-0">
                 
                  <li class="mb-3 nav-item"><a class="nav-link" href="https://www.ahecounselling.com/services/thesis-writing-help"> Thesis Writing Help</a>
                  </li>
               
                <li class="mb-3 nav-item"> <a class="nav-link" href="https://www.ahecounselling.com/services/essay-writing-service">Essay Writing Help</a>
                  </li>
                  <li class="mb-3 nav-item"> <a class="nav-link" href="https://www.ahecounselling.com/services/online-dissertation-help">Dissertation Writing Help</a>
                  </li>

                  <li class="mb-3 nav-item"> <a class="nav-link" href="https://www.ahecounselling.com/services">View All</a>
                  </li>
              </ul>
              </div>
              </div>

             </div>

            <div class="col-6 navbar-dark">

              <h5 class="mb-4 text-white">Legal</h5>

              <ul class="navbar-nav list-unstyled mb-0">

                <li class="mb-3 nav-item"><a class="nav-link" href="https://ahecounselling.com/terms-conditions">Terms and Conditions</a>

                </li>

                <li class="mb-3 nav-item"><a class="nav-link" href="https://ahecounselling.com/privacy-policy">Privacy Policy</a>

                </li>

                <li class="nav-item"><a class="nav-link" href="https://ahecounselling.com/refund-return">Refund and Return</a>

                </li>

              </ul>

            </div>

          </div>

         

        </div>

         <div class="row w-100 mt-5">

            <div class="col-12 col-md-6 text-center">

              <a class="footer-logo text-white h2 mb-0" href="./">

                <img src="webassets/images/footer-logo.png" alt="" class="img-fluid" width="200">

              </a>

            </div>

            <div class="col-12 col-md-6 mt-6 mt-sm-0">

              <ul class="list-inline mb-0 ml-auto text-md-right text-center">

                <li class="list-inline-item"><a class="text-light ic-2x" target="_blank" href="https://www.facebook.com/AHECPVTLTD/"><i class="la la-facebook footer-social-icon"></i></a>

                </li>

                <li class="list-inline-item"><a target="_blank" class="text-light ic-2x" href="https://www.youtube.com/channel/UCFyb78NY7P-Rp5ApQHhXytg"><i class="la la-youtube"></i></a>

                </li>

                <li class="list-inline-item"><a target="_blank" class="text-light ic-2x" href="https://www.instagram.com/ahecounselling/"><i class="la la-instagram"></i></a>

                </li>

                <li class="list-inline-item"><a target="_blank" class="text-light ic-2x" href="https://twitter.com/Ahecounselling"><i class="la la-twitter"></i></a>

                </li>

                <li class="list-inline-item"><a  target="_blank" class="text-light ic-2x" href="https://www.linkedin.com/in/ahe-counselling/"><i class="la la-linkedin"></i></a>

                </li>

                 <li class="list-inline-item"><a  target="_blank" class="text-light ic-2x" href="https://in.pinterest.com/ahecpvtltd/"><i class="la la-pinterest" aria-hidden="true"></i></a>

                </li>

                  <li class="list-inline-item"><a class="text-light ic-2x" target="_blank"  href="https://www.reddit.com/user/ahecworld"><i class="la la-reddit"></i></a></li>
                  <li class="list-inline-item"><a class="text-light ic-2x" target="_blank"  href="https://ahecworld.tumblr.com"><i class="la la-tumblr"></i></a></li>

              </ul>

            </div>

            <div class="col-md-12">
              <div class="online-pay-bg">
               <a href="Javascript:void(0)"><img src="webassets/images/visa.png" alt="visa" class="img-fluid online-pay"></a>
               <a href="Javascript:void(0)"><img src="webassets/images/googlepay.png" alt="visa" class="img-fluid online-pay ms-3"></a>
               <a href="Javascript:void(0)"><img src="webassets/images/phonepe.png" alt="visa" class="img-fluid online-pay ms-3"></a>
               <a href="Javascript:void(0)"><img src="webassets/images/paytm.png" alt="visa" class="img-fluid online-pay ms-3"></a>
               <a href="Javascript:void(0)"><img src="webassets/images/upi.png" alt="visa" class="img-fluid online-pay ms-3"></a>
               <a href="Javascript:void(0)"><img src="webassets/images/creditcard.png" alt="visa" class="img-fluid online-pay ms-3"></a>
              </div>
            </div>

          </div>

      </div>

      <div class="row text-white text-center">

        <div class="col">

          <hr class="mb-8">	&#169; 2021-2023 AHEC | Powered by Academic Help & E-Counselling</div>

        </div>

      </div>

    </footer>

    <!--footer end-->

  </div>

  <!-- page wrapper end -->



  <!--back-to-top start-->

  <div class="scroll-top"><a class="smoothscroll" href="#top"><i class="las la-angle-up"></i></a></div>

  <!--back-to-top end-->

  <!-- inject js start -->


<script type="text/javascript">
    $ (window).ready (function () {
        setTimeout (function () {
            $ ('#modal-subscribe').modal ("show")
        }, 3000)
    })
</script>

  <script src="webassets/js/theme-plugin.js"></script>
  <script src="webassets/js/toctoc.min.js"></script>
  <script src="webassets/js/theme-script.js"></script>
  <script src="webassets/js/jquery.validate.min.js"></script>
  <script src="webassets/js/additional-methods.min.js"></script>
   <script src="admin/assets/js/adminspanelv5.js" defer></script>
  
   @yield('javascript')
 <script type="text/javascript">
        $(document).ready(function(){
            $.toctoc({
                 minimized: false,

            });
          });
    </script>
    <script>
      var QtyInput = (function () {
  var $qtyInputs = $(".qty-input");

  if (!$qtyInputs.length) {
    return;
  }

  var $inputs = $qtyInputs.find(".product-qty");
  var $countBtn = $qtyInputs.find(".qty-count");
  var qtyMin = parseInt($inputs.attr("min"));
  var qtyMax = parseInt($inputs.attr("max"));

  $inputs.change(function () {
    var $this = $(this);
    var $minusBtn = $this.siblings(".qty-count--minus");
    var $addBtn = $this.siblings(".qty-count--add");
    var qty = parseInt($this.val());

    if (isNaN(qty) || qty <= qtyMin) {
      $this.val(qtyMin);
      $minusBtn.attr("disabled", true);
    } else {
      $minusBtn.attr("disabled", false);

      if(qty >= qtyMax){
        $this.val(qtyMax);
        $addBtn.attr('disabled', true);
      } else {
        $this.val(qty);
        $addBtn.attr('disabled', false);
      }
    }
  });

  $countBtn.click(function () {
    var operator = this.dataset.action;
    var $this = $(this);
    var $input = $this.siblings(".product-qty");
    var qty = parseInt($input.val());

    if (operator == "add") {
      qty += 1;
      if (qty >= qtyMin + 1) {
        $this.siblings(".qty-count--minus").attr("disabled", false);
      }

      if (qty >= qtyMax) {
        $this.attr("disabled", true);
      }
    } else {
      qty = qty <= qtyMin ? qtyMin : (qty -= 1);

      if (qty == qtyMin) {
        $this.attr("disabled", true);
      }

      if (qty < qtyMax) {
        $this.siblings(".qty-count--add").attr("disabled", false);
       }
     }
     $input.val(qty);
    });
   })();

    </script>
    
  <script>
    $("input[type='file']").on("change", function () {
        var names = [];
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            names.push($(this).get(0).files[i].name);
         }
         $("#multi_file_attachment").text(names.toString());
      });

    $("input[type='file']").on("change", function () {
        var fileinput = $(this);
        value = fileinput.val().split(/[\\\/]/g).pop();
        fileinput.siblings("span").text(value);
    });

  </script>

  <script>

    $('.my-home-banner').owlCarousel({
      loop:true,
      margin:10,
      nav:false,
      dots:false,
      autoplay:true,
      responsive:{
        0:{
          items:1
        },
        600:{
          items:1
        },
        1000:{
          items:1
        }
      }
    });

    $('.bl-carousel').owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      dots:false,
      autoplay:true,
      responsive:{
        0:{
          items:1
        },
        600:{
          items:3
        },
        1000:{
          items:3
        }
      }
    });

$('.my-bl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});

$('.home-banner').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dots:false,
    autoplay:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

$('.services-carousel').owlCarousel({
    loop:true,
    margin:30,
    nav:false,
    dots:false,
    autoplay:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});

$('.promotions-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    autoplay:false,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:2
        },
        1000:{
            items:4
        }
    }
});

    $('.test-carousel').owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      autoplay:true,
      dots:false,
      responsive:{
        0:{
          items:1
        },
        600:{
          items:2
        },
        1000:{
          items:2
        }
      }
    });



 $(document).ready(function(){
   $("#basicModal").modal({
   show:false,
   backdrop:'static'
    });
   $("table").wrap('<div class="table-responsive table table-striped"></div>');
    $('table tr:first').addClass('table-info'); 
    $('table tr:last').addClass('table-info');
    $("table,tr,td").removeAttr("style");
   });
  </script>

  <script type="text/javascript">
    $('.file_chagne').on('change',function(){
      $('#'+$(this).data('id')).html($(this).val().replace(/.*(\/|\\)/, ''));
    });
</script>
 <script type="text/javascript">
 function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
 } 
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  </body>
 </html>