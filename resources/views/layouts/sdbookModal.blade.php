 <?php
    $serviceArray  = \App\Model\Entry\Service_model::makeArray();
    $rmidlist  = \App\Model\Entry\RegisterMember_model::makeArray();
    $countryCode = \App\Model\Country_model::pluck('phonecode','id');
   ?>


  <style type="text/css">
    .card{
      border: none;
    }
    .secreenshot img{
     width: 100%; 
   }

  </style>
 <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog modal-lg" id="modle-css-sthe">
    <div class="modal-content" id="model-contant-style">
     <div class="text-right">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
     </div>
      <div class="modal-body" id="model-body-scs">
         <img src="webassets/images/logo.png" id="form_Style-logo">
        


        <div class="container-fluid">
    <div class="">
       
            <div class="card">
                
                <form id="msform" action="query/saveQueryModal" method="post" enctype="multipart/form-data">
                	 {{ csrf_field() }}
                    <!-- progressbar -->
                    
                    <fieldset>
                        <div class="form-card">
                            <div class="">
                                <div class="">
                                    <h2 class="fs-title">User Information:</h2>
                                </div>
                                <!-- <div class="col-5">
                                    <h2 class="steps">Step 1 - 4</h2>
                                </div> -->
                            </div>
                               
     <div class="row">

        <div class="col-lg-6 col-6">
         <select class="form-control form-control-sm" name="user_type" id="user_type" > 
                  <option value="">Select user type</option>
                  <option value="1">New user</option>
                  <option value="2">Existing user</option>
           </select>
        </div>

         <div class="col-lg-6 col-6">
         <select class="form-control form-control-sm" name="payment_type" id="payment_type" > 
                  <option value="">Select payment type</option>
                  <option value="Full payment">Full payment</option>
                  <option value="Partial payment">Partial payment</option>
                  <option value="Remaining payment">Remaining payment</option>
           </select>
        </div>

         <div class="col-lg-12 col-12">
           <input  name="last_en_email" id="last_en_email" type="text"  placeholder="Please Enter register(booking) e-mail address">
         </div>
         <div class="col-lg-12 col-12">
         <select class="form-control form-control-sm" name="pre_order_id" id="pre_order_id" > 
                 
                  <option value="">Select order id </option>
                 
                </select>
        </div>

       <div class="col-lg-6 col-6">
          <input id="modal_en_first_name" name="modal_en_first_name" type="text" placeholder="First Name" required="">
       </div>

       <div class="col-lg-6 col-6">
          <input id="modal_en_last_name" name="modal_en_last_name" type="text"  placeholder="Last Name"  data-error="Name is required." spellcheck="true" autocomplete="off" aria-invalid="true">
       </div>
       
       <div class="col-lg-12">
          <input id="modal_en_email" name="modal_en_email" type="text"  placeholder="E-mail"  data-error="Name is required." spellcheck="true" autocomplete="off" aria-invalid="true">
       </div>

       <div class="col-lg-3 col-3" id="padding-right-style">
          <select class="form-control form-control-sm" name="country_code"  id="country_code" >
             @foreach($countryCode as $key =>$vs)
             <option <?php if($vs==91) echo 'selected' ?> value="{{$vs }}">+{{ $vs}} </option>
           @endforeach 
          </select>
       </div>
       <div class="col-lg-9 col-9" id="padding-left-style">
          <input id="modal_en_mobile" name="modal_en_mobile" type="text" name="en_first_name" class="form-control form-control-sm error" placeholder="Number"  data-error="Name is required." spellcheck="true" autocomplete="off" aria-invalid="true">
       </div>

       <div class="col-lg-6 col-6">
         <select class="form-control form-control-sm" name="en_service" id="en_service" > 
                 @foreach($serviceArray as $key =>$vs)
                  <option value="{{ $key }}">{{ $vs}} </option>
                  @endforeach
                </select>
        </div>

       <div class="col-lg-6 col-6">
          <input type="text" name="modal_en_subject" id="modal_en_subject" name="" placeholder="Module code">
       </div>

       <div class="col-lg-12 col-12">
          <input type="text" name="modal_en_module_name" id="modal_en_module_name" name="" placeholder="Module Name">
       </div>

       <div class="col-lg-12">
          <textarea id="modal_en_query" name="modal_en_query" class="form-control form-control-sm" placeholder="Message" rows="4" data-error="Please,leave us a message."  spellcheck="true" autocomplete="off"></textarea>
       </div>

       <div class="col-lg-4 col-4">
      <label class="custom-file-upload">
	  <input type="file"/ class="file_chagne" data-id="file_name_1" id="my-file_1"   name="modal_en_queryen_attachment_1" >
	  <span class="select-file-name file_name" id="file_name_1">Select file 1</span> 
	</label>
  </div>

      <div class="col-lg-4 col-4">
       <label class="custom-file-upload">
        <input type="file"/ class="file_chagne" data-id="file_name_2" id="my-file_2"   name="modal_en_queryen_attachment_2" >
	  <span class="select-file-name file_name" id="file_name_2">Select file 2</span> 
      </label>
       </div>
       <div class="col-lg-4 col-4">
         <label class="custom-file-upload">
        <input type="file"/ class="file_chagne" data-id="file_name_3" id="my-file_3"   name="modal_en_queryen_attachment_3" >
	  <span class="select-file-name file_name" id="file_name_3">Select file 3</span>  
</label>
       </div>


     </div>
                        </div> 

                        <input type="button" name="next" class="next action-button" data-type="button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="">
                                <div class="">
                                    <h2 class="fs-title">Payment Details:</h2>
                                </div>
                               <!--  <div class="col-5">
                                    <h2 class="steps">Step 2 - 4</h2>
                                </div> -->


<div class="wrapper center-block">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading active" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Bank Details
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="account-details">
              <div class="table-account">
                <table>
  
  <tr>
    <td>Account Holder Name</td>
    <td>Account No</td>
    <td>IFSC</td>
    <td>Brance Name</td>
    <td>Swift</td>

  </tr>
  <tr>
    <td>Ashutosh Burman</td>
    <td>28381050002861</td>
    <td>HDFC0002838</td>
    <td>Bapu Nagar Jaipur 302015.</td>
    <td>HDFCINBB</td>

  </tr>
</table>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="table-account">
                <table>
  
  <tr>
    <td>Account Holder Name</td>
    <td>Account No</td>
    <td>IFSC</td>
    <td>Brance Name</td>
    <td>Swift</td>

  </tr>
  <tr>
    <td>Ankit Samant</td>
    <td>0514259321</td>
    <td>KKBK0003533 </td>
    <td>Nanak Plaza Raja Park, 26, Govind Marg Jaipur 302004.</td>
    <td>KKBKINBB</td>

  </tr>
</table>
              </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
           UPI Scanner
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
       <div class="row">
        <div class="col-lg-6 col-6">
          <div class="secreenshot">
            <img src="webassets/images/pay1.jpg" alt="paytm">
          </div>
        </div>
        <div class="col-lg-6 col-6" >
          <div class="secreenshot">
            <img src="webassets/images/pay2.jpg" alt="paytm">
          </div>
        </div>

        <div class="col-lg-6 col-6">
          <div class="secreenshot">
            <img src="webassets/images/pay3.jpg" alt="paytm">
          </div>
        </div>
        <div class="col-lg-6 col-6">
          <div class="secreenshot">
            <img src="webassets/images/pay4.jpg" alt="paytm">
          </div>
        </div>

      </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          UPI Id
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        <p>9214859550@hdfcbank</p>
        <p>8005779031@kotak</p>

      </div>
    </div>
  </div>
</div>
</div> 
       </div> 



                        </div> 


                        <input type="button" name="next" class="next action-button"  data-type="button" value="Next" />
                         <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>

                    <fieldset>
                        <div class="form-card">
                            <div class="" style="text-align: center;">
                                <div class="">
                                    <h2 class="fs-title">Screenshot:</h2>
                                    <p>upload your Screen Shot</p>
                                </div>
                                <!-- <div class="col-5">
                                    <h2 class="steps">Step 3 - 4</h2>
                                </div> -->
                            </div> 
                            
    <div class="Updoad-your-screen-schot">

   <label class="custom-file-upload">
    <!-- <input type="file"/> -->

       <input type="file" class="file_chagne" data-id="file_name_4" id="my-file_4" required   name="modal_en_queryen_attachment_4" >
	  <span class="select-file-name file_name" id="file_name_4">Select Screen Shot</span>  

	   
     
</label>
            <br>
         <label  id="screenshot_validatino" style="color:red">Screen Shot is required</label>



       <div class="">
          
             <select class="form-control form-control-sm"  name="rm_id" id="rm_id_check_value"  required > 
                 
                  <option value="0">SELECT RM Id</option>
                  @foreach($rmidlist as $rm_id => $rmusername)

                  <option value="{{ $rm_id }}">{{ $rmusername }}</option>
                 
                 @endforeach
               
               </select>
               
       </div>

       <label  id="rm_id_validatino" style="color:red">Rm Id is required</label>

    </div>
           </div>

                      <input type="button" name="next" class="next action-button" data-type="submit" value="Submit" /> 
                     <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>


                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <!-- <div class="col-7">
                                    <h2 class="fs-title">Finish:</h2>
                                </div> -->
                                <!-- <div class="col-5">
                                    <h2 class="steps">Step 4 - 4</h2>
                                </div> -->
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>Thank you.!</strong></h2> <br>
                            <div class="text-center">
                                <div class=""> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image" style="width: 100px;"> </div>
                            </div> <br><br>
                            <div class="text-center">
                                <div class=" text-center">
                                    <h5 class="purple-text text-center">Your details are under review.Please check your E-mail</h5>
                                </div>

                                
                            </div>
                        </div>


                         <!-- <input type="button" name="previous" class="previous action-button-previous" value="Back" /> -->
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
      </div>
    </div>
  </div>
</div>

   @section('javascript')

<script type="text/javascript">


  const items = document.querySelectorAll(".item");

items.forEach((item) => {
  item.addEventListener("click", () => {
    item.classList.toggle("open");
  });
});

</script>
<script>$(document).ready(function(){


  $("#user_type").change(function(){

         if($(this).val()==2){

              
              $("#rm_id_check_value,#modal_en_module_name,#country_code,#modal_en_mobile,#modal_en_query,#modal_en_query,#modal_en_subject,#en_service,#modal_en_email,#modal_en_last_name,#modal_en_first_name").prop('readonly', true);
                $('#modal_en_email').val('test@gmail.com');
              $('#last_en_email').show();
              $('#modal_en_email ').hide();

             //  if (!$("#msform").valid()) {
             //     return false;
             // }

         }else{
             
               $("#rm_id_check_value,#modal_en_module_name,#country_code,#modal_en_mobile,#modal_en_query,#modal_en_query,#modal_en_subject,#en_service,#modal_en_email,#modal_en_last_name,#modal_en_first_name").removeAttr("readonly");
               
                $('#last_en_email').val('');
                $('#rm_id_check_value').val('0');
                // $('#country_code').val('');
                $('#modal_en_mobile').val('');
                $('#modal_en_query').val('');
                $('#modal_en_subject').val('');
                // $('#en_service').val('');
                $('#modal_en_email').val('');
                $('#modal_en_last_name').val('');
                $('#modal_en_first_name').val('');
                $('#modal_en_module_name').val('');
                $('#last_en_email').hide();
                $('#pre_order_id').hide();
                $('#modal_en_email ').show();

             //    if (!$("#msform").valid()) {
             //     return false;
             // }

         }

   });
  $("#pre_order_id").on("change", function(e) {

         var form = $('#msform')[0];
         var formdata = new FormData(form);
         $.ajax({
            type: 'POST',
            url: "{{ url('/') }}/query/searcholduserdetails",
            data: formdata,  
            processData: false,
               contentType: false,  
            success: function (data) {

                if(data=='false'){

                      // $('#last_en_email').val('');
                      $('#rm_id_check_value').val('0');
                      // $('#country_code').val('');
                      $('#modal_en_mobile').val('');
                      $('#modal_en_query').val('');
                      $('#modal_en_subject').val('');
                      // $('#en_service').val('');
                      $('#modal_en_email').val('');
                      $('#modal_en_last_name').val('');
                      $('#modal_en_first_name').val('');
                     
                   // if (!$("#msform").valid()) {
                   //     return false;
                   // } 

                }else{

                    
                     var data = JSON.parse(data);
                  
                   $("#rm_id_check_value,#country_code,#modal_en_module_name,#modal_en_mobile,#modal_en_query,#modal_en_query,#modal_en_subject,#en_service,#modal_en_email,#modal_en_last_name,#modal_en_first_name").removeAttr("readonly");

                      $('#rm_id_check_value').val(data.rm_id);
                      $('#country_code').val(data.phone_code);
                      $('#modal_en_mobile').val(data.en_mobile);
                      $('#modal_en_query').val(data.en_query);
                       $('#modal_en_subject').val(data.en_subject);
                      $('#en_service').val(data.en_service);
                      $('#modal_en_email').val(data.en_email);
                      $('#modal_en_last_name').val(data.en_last_name);
                      $('#modal_en_first_name').val(data.en_first_name);
                      $('#modal_en_module_name').val(data.module_name);

                      if (!$("#msform").valid()) {
                       return false;
                   } 

                } 

             },
        });

    });


  $("#last_en_email").on("keyup change", function(e) {


       
         var form = $('#msform')[0];
         var formdata = new FormData(form);
         $.ajax({
            type: 'POST',
            url: "{{ url('/') }}/query/searcholduser",
            data: formdata,  
            processData: false,
               contentType: false,  
            success: function (data) {

                if(data=='false'){

                      $('#pre_order_id').hide();

                      // $('#last_en_email').val('');
                      $('#rm_id_check_value').val('0');
                      // $('#country_code').val('');
                      $('#modal_en_mobile').val('');
                      $('#modal_en_query').val('');
                      $('#modal_en_subject').val('');
                      // $('#en_service').val('');
                      $('#modal_en_email').val('');
                      $('#modal_en_last_name').val('');
                      $('#modal_en_first_name').val('');
                     
                   // if (!$("#msform").valid()) {
                   //     return false;
                   // } 

                }else{
                     $('#pre_order_id').show();
                     $('#pre_order_id').html("");
                     var data = JSON.parse(data)
                     var div_data = '<option value="">Select order id</option>';
                     console.log(data);
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        div_data += "<option value=" + obj.id + " " + sel + ">" + obj.order_number + "</option>";
                    });
                    $('#pre_order_id').append(div_data);
                
                 } 

             },
        });

    });


	$('#screenshot_validatino').hide();
  
  $('#last_en_email').hide();
  $('#pre_order_id').hide();

	$('#rm_id_validatino').hide();

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;
var current = 1;
var steps = $("fieldset").length;

setProgressBar(current);

$(".next").click(function(){

	   if (!$("#msform").valid()) {
           return false;
       }
        if($(this).data("type")=="submit"){

  	       if ($('#my-file_4').get(0).files.length === 0) {
			     $('#screenshot_validatino').show();
			     return false;
			}else{

				$('#screenshot_validatino').hide();
			}
           
            if($("#rm_id_check_value").val()=="0") {
			
			   $('#rm_id_validatino').show();
			    return false;
			}else{

			   $('#rm_id_validatino').hide();
			}
        if( !confirm('Are you sure that you want to submit the form')){
             return false;
          } 

           // $(this).attr('disabled','disabled');
          var form = $('#msform')[0];
          var formdata = new FormData(form);
	       $.ajax({
		        type: 'POST',
		        url: "{{ url('/') }}/query/saveQueryModal",
		        data: formdata,  
		        processData: false,
               contentType: false,	
		        success: function (data) {

              setTimeout(function(){  location.reload(); }, 5000);
		        },
		    });
        
        // return false;
        
    }
  

           
 current_fs = $(this).parent();
 next_fs = $(this).parent().next();
 //Add Class Active

$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(++current);
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(--current);
});

function setProgressBar(curStep){
var percent = parseFloat(100 / steps) * curStep;
percent = percent.toFixed();
$(".progress-bar")
.css("width",percent+"%")
}

$(".submit").click(function(){
return false;
})

});

</script>


<script type="text/javascript">
        $(document).ready(function(){

          
           $('#msform').validate({

                    onfocusout: function(element) {$(element).valid()}
                          , rules: {

                      "modal_en_first_name": {
                          required: true,
                          pattern: /^[a-zA-Z'.\s]{1,40}$/,
                          maxlength: 30,
                          minlength: 2,
                      },"modal_en_last_name": {
                          required: true,
                          pattern: /^[a-zA-Z'.\s]{1,40}$/,
                          maxlength: 30,
                          minlength: 2,
                      },"modal_en_email":{
                         required: true,
                         email: true,
                      },"modal_en_mobile": {
                          required: true,
                          number: true,
                          minlength: 10,
                          maxlength: 10,
                      },"modal_en_subject": {
                          required: true,
                       }, "modal_en_query": {
                          required: true,
                          maxlength: 200,
                          minlength: 6,
                      },"user_type": {
                          required: true,
                       },"payment_type": {
                          required: true,
                       },"modal_en_module_name": {
                          required: true,
                       }, 
                   },
                   messages: {
                     "modal_en_module_name": {
                          required: "Module name is required",
                       },"payment_type": {
                          required: "Payment type is required",
                       }, "user_type": {
                          required: "User type is required",
                       },
                      "modal_en_mobile": {
                          required: "Phone no. is required",
                          number: "Only number are allowed",
                          minlength: "Phone No must contain {10} digit Number",
                          maxlength: "Phone No must contain {10} digit Number",
                      },
                      "modal_en_first_name": {
                          required: "First name is required",
                          minlength: "First name must contain at least {4} characters",
                          maxlength: "First name must contain only {30} characters",
                          pattern: 'Only characters are allowed',
                      },
                      "modal_en_last_name": {
                          required: "Last name is required",
                          minlength: "Last name must contain at least {2} characters",
                          maxlength: "Last name must contain only {30} characters",
                          pattern: 'Only characters are allowed',
                      },
                      "modal_en_email":{
                         required: 'Email address is required',
                         email: 'Please enter a Valid Email Address',
                      }, 
                     "modal_en_subject": {
                          required: "Module code is required",
                        
                       }, 
                     "modal_en_query": {
                          required: "Message  is required",
                          minlength: "Message must contain at least {6} characters",
                          maxlength: "Message must contain only {2000} characters",
                       }
                    
                   },
                  });
            });
    </script>


@endsection