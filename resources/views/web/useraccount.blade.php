@include('layouts.frontend')

<?php
$serviceArray  = \App\Model\Entry\Service_model::makeArray();
$rmidlist  = \App\Model\Entry\RegisterMember_model::makeArray();
$countryCode = \App\Model\Country_model::pluck('phonecode','id');
?>

<style>
    .card{
        border: none!important;
    }
    *{
        font-family: 'Poppins', sans-serif;
    }
     .container-copy input {
    position: absolute!important;
    opacity: 1!important;
    z-index: 1!important;
    display: inline-block!important;
    width: 85%!important;
}
</style>

<section class="form mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h3 class="mb-0">Place Your Order</h3>
                <p>It's fast, secure, Confidential</p>
                <div class="discount">20% off all products of over Rs. 1000</div>
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3" style="border:none;">
                    <form id="msform-order"  action="query/saveQueryModal" method="post" enctype="multipart/form-data" style="position: relative;">
                       {{ csrf_field() }}
                       <fieldset class="btns">
                        <div class="form-card row mx-2">
                            <div class="col-md-6 my-2">

                               <select  name="user_type" id="user_type" > 
                                  <option value="">Select user type</option>
                                  <option value="1">New user</option>
                                  <option value="2">Existing user</option>
                              </select>

                          </div>
                          <div class="col-md-6 my-2">
                           <select  name="payment_type" id="payment_type" > 
                              <option value="">Select payment type</option>
                              <option value="Full payment">Full payment</option>
                              <option value="Partial payment">Partial payment</option>
                              <option value="Remaining payment">Remaining payment</option>
                          </select>
                      </div>
                      <div class="col-md-6 my-2">
                        <input  name="last_en_email" id="last_en_email" type="text"  placeholder="Please Enter register(booking) e-mail address">
                    </div>
                    <div class="col-md-6 my-2">
                        <select class="form-control form-control-sm" name="pre_order_id" id="pre_order_id" > 
                            <option value="">Select order id </option>
                        </select>
                    </div>

                    <div class="col-md-6 my-2">
                      <input id="modal_en_first_name" name="modal_en_first_name" type="text" placeholder="First Name" required="">
                  </div>
                  <div class="col-md-6 my-2">
                      <input id="modal_en_last_name" name="modal_en_last_name" type="text"  placeholder="Last Name"  data-error="Name is required." spellcheck="true" autocomplete="off" aria-invalid="true">
                  </div>
                  <div class="col-md-12 my-2">
                      <input id="modal_en_email" name="modal_en_email" type="text"  placeholder="E-mail"  data-error="Name is required." spellcheck="true" autocomplete="off" aria-invalid="true">
                  </div>
                  <div class="col-md-6">
                    <div class="row my-2 mx-0 border">
                        <div class="col-2 px-0">

                            <select  class="border-0" style="width: 60px;" name="country_code"  id="country_code" >
                               @foreach($countryCode as $key =>$vs)
                               <option <?php if($vs==91) echo 'selected' ?> value="{{$vs }}">+{{ $vs}} </option>
                               @endforeach 
                           </select>
                       </div>
                       <div class="col-10 pl-0">

                        <input type="number" class="border-0"  id="modal_en_mobile" name="modal_en_mobile"  placeholder="Mobile No." />
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-2">
                <select name="en_service" id="en_service" > 
                  @foreach($serviceArray as $key =>$vs)
                  <option value="{{ $key }}">{{ $vs}} </option>
                  @endforeach
              </select>
          </div>
          <div class="col-md-6 my-2">

            <input type="text" name="modal_en_subject" id="modal_en_subject"  placeholder="Module code">

        </div>
        <div class="col-md-6 my-2">
           <input type="text" name="modal_en_module_name" id="modal_en_module_name"  placeholder="Module Name">
       </div>
       <div class="col-md-12 my-2">
           <textarea id="modal_en_query" name="modal_en_query" rows="5" placeholder="Message"></textarea>
       </div>
   </div>
   <input type="button" name="next" class="next action-button" value="Next" />
</fieldset>
<fieldset class="btns">
    <div class="form-card row mx-2">
        <h3>Payment Details</h3>
        <div class="col-md-12 payment">
            <div class="tabs">
                <div class="tab">
                    <input type="checkbox" value="1" id="chck1">
                    <label class="tab-label" for="chck1" style="max-width: 100%;">BANK DETAILS</label>
                    <div class="tab-content table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td scope="col">Account Holder Name</td>
                                    <td scope="col">Account No</td>
                                    <td scope="col">IFSC</td>
                                    <td scope="col">Branch Name</td>
                                    <td scope="col">Swift</td>
                                </tr>
                                <tr>
                                    <td scope="row">A2G Ventures Private Limited</td>
                                    <td>96301478523695</td>
                                    <td>SBI025964</td>
                                    <td>Bapu Nagar, Jaipur, 302015</td>
                                    <td>SBI95652</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab">
                    <input type="checkbox" value="2" id="chck2">
                    <label class="tab-label" for="chck2" style="max-width: 100%;">UPI SCANNER</label>
                    <div class="tab-content">
                       <img src="webassets/images/sc-code.png" class="w-50 mx-auto" alt="upi-scane">

                   </div>
               </div>
               <div class="tab">
                <input type="checkbox" id="chck3" value="3">
                <label class="tab-label" for="chck3" style="max-width: 100%;">UPI ID</label>
                <div class="tab-content"> 
                   <p>Q069064858@ybl</p>
                   <i class="fa fa-link"></i>

                   <div class="container-copy">
                      <div id="inviteCode" class="invite-page">
                        <input id="link" value="hello" readonly>
                        <div id="copy">
                          <i class="fa fa-clipboard" aria-hidden="true" data-copytarget="#link"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
</div>

<input type="button" name="next" class="next action-button" value="Next" />
<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
</fieldset>
<fieldset class="btns">
    <div class="form-card mx-2 row">
        <h3 class="text-center w-100">Upload Your Screenshot</h3>
        <div class="col-md-12 my-2"> 
            <div class="container-2">
                <label class="label" for="input"></label>
                <div class="input">
                    <input name="input" id="file" type="file">
                </div>  
            </div>                              
        </div>
    </div>

    <input type="button" name="next" class="next action-button" value="Submit" />
    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
</fieldset>
<fieldset>
    <div class="form-card">
        <div class="row">
            <div class="col-7">
            </div>
            <div class="col-5">
            </div>
        </div>
        <br><br>
        <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2>
        <br>
        <div class="row justify-content-center">
            <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
        </div>
        <br><br>
        <div class="row justify-content-center">
            <div class="col-7 text-center">
                <h5 class="purple-text text-center">Your Order Successfully Submit</h5>
            </div>
        </div>
    </div>
</fieldset>
</form>
</div>
</div>
<div class="col-md-3 right-order">
    <div class="head">
        <h3>Last Day of The Offer</h3>
        <p>20% off + Get $35 + Free Quate</p>
    </div>
    <div class="wrapper mt-4">
        <ul class="StepProgress list-unstyled">
            <li class="StepProgress-item is-done">Flat 20% off</li>
            <li class="StepProgress-item is-done">Earn $20 for Signing up</li>
            <li class="StepProgress-item current">Earn $10 for Sharing</li>
            <li class="StepProgress-item">Receive Extra $5 for update Mobile Number</li>
        </ul>
    </div>
    <ul class="mt-4 border help p-3 list-unstyled">
        <li><p>75000+ <span>Completed Assignments</span></p></li>
        <li><p>1500+ <span>Phd Experts</span></p></li>
        <li><p>4.8/5 <span>Clients Rating</span></p></li>
    </ul>

    <ul class="mt-4 border help p-3 list-unstyled">
        <h3>Why Students Refer us</h3>
        <li class="d-flex align-items-center my-2"><i class="fa fa-bookmark mr-3"></i><p class="mb-0">Best Quality With Numbers</p></li>
        <li class="d-flex align-items-center my-2"><i class="fa fa-credit-card mr-3"></i><p class="mb-0">Best Price with Secure Payment</p></li>
        <li class="d-flex align-items-center my-2"><i class="fa fa-truck mr-3"></i><p class="mb-0">Timely Delivery</p></li>
        <li class="d-flex align-items-center my-2"><i class="fa fa-th-list mr-3"></i><p class="mb-0">100% Privacy</p></li>
    </ul>
</div>
</div>
</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script>
// functionality to copy text from inviteCode to clipboard

// trigger copy event on click
$('#copy').on('click', function(event) {
  console.log(event);
  copyToClipboard(event);
});

// event handler
function copyToClipboard(e) {
  // alert('this function was triggered');
  // find target element
  var
    t = e.target, 
    c = t.dataset.copytarget,
    inp = (c ? document.querySelector(c) : null);
  console.log(inp);
  // check if input element exist and if it's selectable
  if (inp && inp.select) {
    // select text
    inp.select();
    try {
      // copy text
      document.execCommand('copy');
      inp.blur();

      // copied animation
      t.classList.add('copied');
      setTimeout(function() {
        t.classList.remove('copied');
      }, 1500);
    } catch (err) {
      //fallback in case exexCommand doesnt work
      alert('please press Ctrl/Cmd+C to copy');
    }

  }

}
</script>
<script>
    $(function(){
        var container = $('.container-2'), inputFile = $('#file'), img, btn, txt = 'Browse', txtAfter = 'Browse another pic';

        if(!container.find('#upload').length){
            container.find('.input').append('<input type="button" value="'+txt+'" id="upload">');
            btn = $('#upload');
            container.prepend('<img src="" class="hidden" alt="Uploaded file" id="uploadImg" width="100">');
            img = $('#uploadImg');
        }

        btn.on('click', function(){
            img.animate({opacity: 0}, 300);
            inputFile.click();
        });

        inputFile.on('change', function(e){
            container.find('label').html( inputFile.val() );

            var i = 0;
            for(i; i < e.originalEvent.srcElement.files.length; i++) {
                var file = e.originalEvent.srcElement.files[i], 
                reader = new FileReader();

                reader.onloadend = function(){
                    img.attr('src', reader.result).animate({opacity: 1}, 700);
                }
                reader.readAsDataURL(file);
                img.removeClass('hidden');
            }

            btn.val( txtAfter );
        });
    });
</script>
<style>
   .btns label {
     display: block;
     max-width: 200px;
     margin: 0 auto 15px;
     text-align: center;
     word-wrap: break-word;
     color: #1a4756;
 }
 .btns.hidden, #uploadImg:not(.hidden) + label {
     display: none;
 }
 .btns #file {
     display: none;
     margin: 0 auto;
 }
 .btns #upload {
     display: block;
     padding: 10px 25px;
     border: 0;
     margin: 0 auto;
     font-size: 15px;
     letter-spacing: 0.05em;
     cursor: pointer;
     background: #216e69;
     color: #fff;
     outline: none;
     transition: .3s ease-in-out;
 }
 .btns #upload:hover, #upload:focus {
     background: #1AA39A;
 }
 .btns #upload:active {
     background: #13D4C8;
     transition: .1s ease-in-out;
 }
 .btns img {
     display: block;
     margin: 0 auto 15px;
 }
 .btns .container-2{
    width: 200px;
    margin: 50px auto;
    font-family: sans-serif;
}
</style>
@include('layouts.frontfooter')