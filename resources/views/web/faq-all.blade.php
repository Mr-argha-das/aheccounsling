@include('layouts.frontend')
<?php 
use \App\Model\Entry\Service_model as serviceModel;
$content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); 
 
?>

<div class="faq-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mt-3">Frequently Asked Questions</h3>
                <p class="det-tagline"></p>
                <div class="accordion mt-4" id="accordionExample">
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                           <h6 class="text-dark text-decoration-none">Q. Why Should You Choose AHECounselling for Academic Writing Services?</h6>
                          </button>
                        </h2>
                      </div>
                  
                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                          <ul class="content-det-para">
                            <li>
                            	Writing Aids in Over 100 Subjects
                            </li>
                            <li>
                            PhD Experts with 2-8 years of writing experience are available at AHECounselling. 
                            </li>
                            <li>Assistance fees as low as possible</li>
                            <li>Amazing live help round the clock – highly qualified, professional, and cheerful customer service representatives</li>
                          </ul>
                          <p class="content-det-para">Try one of our services and watch your business grow.</p>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h6 class="text-dark text-decoration-none">Q. Can you assist me to paraphrasing my assignment?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">Yes, AHECounselling can assist you with paraphrasing assignments. We write fresh assignments and boost assignments by paraphrasing and proofreading student-prepared assignments. The material of an assignment is paraphrased based on the plagiarism report in a paraphrasing task. While paraphrasing a task, AHECounselling writers make sure to proofread the content before delivering it to the student. </p>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <h6 class="text-dark text-decoration-none">Q. Can I speak to your writer?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">Yes, you can interact with our experts in real-time if you have an issue.</p>
                        </div>
                      </div>
                    </div>
 
                    <div class="card">
                      <div class="card-header" id="heading5">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse6">
                            <h6 class="text-dark text-decoration-none">Q. What levels of academic assistance do you offer?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">We offer Assistance and help at all levels, including elementary, secondary, graduate, and postgraduate.</p>
                        </div>
                      </div>
                    </div>


                    <div class="card">
                      <div class="card-header" id="heading6">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                            <h6 class="text-dark text-decoration-none">Q. What are the areas or topics in which you offer your services?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">. We offer assignment assistance in all academic subjects, with particular expertise in Management, Law, Literature, English, Science, and Maths.</p>
                        </div>
                      </div>
                    </div>

                    
                    <div class="card">
                      <div class="card-header" id="heading7">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                            <h6 class="text-dark text-decoration-none">Q. What distinguishes the assistance service from others?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">Our assistance service stands out due to the following factors:</p>
                            <ul class="content-det-para">
                              <li><b>Expert Writers:</b> Highly qualified and experienced professionals in various disciplines.</li>
                              <li><b>Customized Approach:</b> Tailoring assignments to your unique requirements.</li>
                              <li><b>Originality and Plagiarism-Free Work:</b> Creating authentic content from scratch.</li>
                              <li><b>Timely Delivery:</b> Ensuring assignments are completed and delivered on time.</li>
                              <li><b>Quality Assurance:</b> Maintaining high standards of accuracy and clarity.</li>
                              <li><b>Confidentiality and Privacy:</b> Prioritizing the security of your personal information.</li>
                              <li><b>24/7 Customer Support:</b> Available round the clock for prompt assistance.</li>
                            </ul>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header" id="heading8">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                            <h6 class="text-dark text-decoration-none">Q. How can I put my money in your hands?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para"> When you make a payment, you are given an order confirmation number. We employ a firewall and numerous security measures to ensure that the most reliable and secure payment gateway is used. All payment details are supported by live help 24 hours a day, seven days a week.</p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header" id="heading9">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                            <h6 class="text-dark text-decoration-none">Q. How many subjects do you provide assistance in?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">We offer the best assignment help in all academic fields and a variety of other professions. </p>
                        </div>
                      </div>
                    </div>


                    <div class="card">
                      <div class="card-header" id="heading10">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                            <h6 class="text-dark text-decoration-none">Q. Can you help in low budget?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">We understand how difficult it is for students to find finances due to the high expense of education and other financial obligations. As a result, we have maintained our pricing as cheap as possible and among the most affordable in the segment, while still providing the highest quality services. We couldn't provide the service for free because we couldn't risk compromising the quality of your project. </p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header" id="heading11">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                            <h6 class="text-dark text-decoration-none">Q. Do you offer any specific services for exam preparation?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse11" class="collapse" aria-labelledby="heading11" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">Yes, we offer the best exam assistance available.</p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header" id="heading12">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                            <h6 class="text-dark text-decoration-none">Q. Are my personal information shared with other companies or your writers?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse12" class="collapse" aria-labelledby="heading12" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">No, your personal information is not disclosed to any third party or handed to any individual.</p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header" id="heading13">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                            <h6 class="text-dark text-decoration-none">Q. How would I obtain assignment help materials?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse13" class="collapse" aria-labelledby="heading13" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">Visit AHECounselling. Fill out the order form with the subject and other information, or you can contact our executives to Place your order. You would receive Assistance materials at the accepted time.</p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header" id="heading14">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
                            <h6 class="text-dark text-decoration-none">Q. How accurate is your plagiarism report?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse14" class="collapse" aria-labelledby="heading14" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">Our plagiarism reports are extremely accurate and trustworthy. We use modern plagiarism detection software, such as Turnitin (which is also used by many universities), which completely scans your document against a large database of sources, such as online publications, academic journals, and websites. This thorough examination ensures that even the smallest instance of similarity is recognised. We aim for accuracy and provide detailed reports that indicate any potential matches that are discovered. Because we are committed to accuracy, you can rely on our plagiarism reports to provide a thorough and trustworthy assessment of the originality of your work.</p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header" id="heading15">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
                            <h6 class="text-dark text-decoration-none">Q. How can I contact AHECounselling?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse15" class="collapse" aria-labelledby="heading15" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">Our support team is here to help you 24*7 via chat, WhatsApp, email, or phone. The contact number is +919214859550, and the mail address is info@ahecounselling.com.</p>
                        </div>
                      </div>
                    </div>


                    <div class="card">
                      <div class="card-header" id="heading16">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
                            <h6 class="text-dark text-decoration-none">Q. Can I ask for a refund I am not satisfied with the work?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse16" class="collapse" aria-labelledby="heading16" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">At AHEConselling, we guarantee that every customer will be completely satisfied with the service we provide. Our customer support team is ready to assist you discover the best solution, whether that's a free fresh edit or a refund for the service.</p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header" id="heading17">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse17" aria-expanded="false" aria-controls="collapse17">
                            <h6 class="text-dark text-decoration-none">Q. How long will it take to get my refund?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse17" class="collapse" aria-labelledby="heading17" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">Your refund will be processed within 6 business days. The refunded amount will be given to your original payment method within a few days after the refund is processed. The length of this process is determined by your payment type.</p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header" id="heading18">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse18" aria-expanded="false" aria-controls="collapse18">
                            <h6 class="text-dark text-decoration-none">Q. How fast can AHECounselling proofread my document?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse18" class="collapse" aria-labelledby="heading18" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">The quickest delivery is 24 hours.</p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header" id="heading19">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse19" aria-expanded="false" aria-controls="collapse19">
                            <h6 class="text-dark text-decoration-none">Q. What payment methods do you accept?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse19" class="collapse" aria-labelledby="heading19" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">We accept the following payment methods: 
                              <div>
                              <a href="Javascript:void(0)"><img src="webassets/images/visa.png" alt="visa" class="img-fluid online-pay"></a>
                              <a href="Javascript:void(0)"><img src="webassets/images/paypal.png" alt="visa" class="img-fluid online-pay ms-3"></a>
               <a href="Javascript:void(0)"><img src="webassets/images/googlepay.png" alt="visa" class="img-fluid online-pay ms-3"></a>
               <a href="Javascript:void(0)"><img src="webassets/images/phonepe.png" alt="visa" class="img-fluid online-pay ms-3"></a>
               <a href="Javascript:void(0)"><img src="webassets/images/paytm.png" alt="visa" class="img-fluid online-pay ms-3"></a>
               <a href="Javascript:void(0)"><img src="webassets/images/upi.png" alt="visa" class="img-fluid online-pay ms-3"></a>
               <a href="Javascript:void(0)"><img src="webassets/images/applepay.png" alt="visa" class="img-fluid online-pay ms-3"></a>
               <a href="Javascript:void(0)"><img src="webassets/images/mastercard.png" alt="visa" class="img-fluid online-pay ms-3"></a>
               <a href="Javascript:void(0)"><img src="webassets/images/amex.png" alt="visa" class="img-fluid online-pay ms-3"></a>
                              </div>
                                                 </p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header" id="heading20">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse20" aria-expanded="false" aria-controls="collapse20">
                            <h6 class="text-dark text-decoration-none">Q. Can I shorten my deadline?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse20" class="collapse" aria-labelledby="heading20" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">With a 24-hour order, it is not possible to shorten the deadline. It is possible to shorten the deadline if you contact us early enough. Please contact us directly to see if we can still shorten the deadline. We will determine this based on the quantity of words in your work and the availability of our editor.</p>
                        </div>
                      </div>
                    </div>


                    <div class="card">
                      <div class="card-header" id="heading21">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse21" aria-expanded="false" aria-controls="collapse21">
                            <h6 class="text-dark text-decoration-none">Q. Will my editor meet the deadline?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse21" class="collapse" aria-labelledby="heading21" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">Your editor will, without a sure, make the deadline. In your user profile, you can double-check the deadline and the status of your order. When your thesis is complete, you will be notified via text message and email. In the unlikely event that your order is delayed (for example, due to technical issues), we will immediately contact both you and the editor to find the best possible solution.</p>
                            <p class="content-det-para">In this instance, support can request that the editor cease editing. You must pay for the pages that the editor has edited thus far. The editor will not provide input.</p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header" id="heading22">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse22" aria-expanded="false" aria-controls="collapse22">
                            <h6 class="text-dark text-decoration-none">Q. Does AHECounselling consider all reference styles?</h6>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse22" class="collapse" aria-labelledby="heading22" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="content-det-para">Most reference styles, including university-specific style guides, can be verified. You would need to upload the manual during the uploading procedure for us to do this.</p>
                        </div>
                      </div>
                    </div>

                
                  </div>

                  <h3 class="mt-4">Query Submission</h3>
                  <p class="det-tagline"></p>
                  <div class="bg-white p-3 mt-4 shadow-sm rounded">
                  <form>
                    <label for="" class="mt-3"><b>Full Name</b></label>
                    <input type="text" value="" name="" class="email form-control" id="" placeholder="Name" required="">
                    <label for="" class="mt-3"><b>Email Address</b></label>
                    <input type="email" value="" name="" class="email form-control" id="" placeholder="Email Address" required="">
                    <label for="" class="mt-3"><b>Contact Number</b></label>
                    <input type="tel" value="" name="" class="email form-control" id="" placeholder="Phone Number" required="">
                    <label for="" class="mt-3"><b>Your Query</b></label>
                    <textarea name="" id="" cols="20" rows="6" class="form-control">Write something about your query...</textarea>
                    <button class="px-5 py-2 bg-primary text-white mt-5 border-0"><b>Submit</b></button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
 
@include('layouts.frontfooter')