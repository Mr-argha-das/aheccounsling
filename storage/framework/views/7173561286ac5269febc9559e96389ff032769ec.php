<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    use \App\Model\Entry\Service_model as serviceModel;
    $findService = serviceModel::where('services_status',1)->orderBy('services_id','desc')->get();
?>
<style>

   .pricing-button{
     
       border: none;
        padding-left: 15px;
        padding-right: 15px;
        padding-top: 10px;
        padding-bottom: 10px;
        border-radius: 10px;
    }
 .card-img{
        width: 130px;
        height: 130px;

    }
    @media  only screen and (min-width: 320px) and (max-width: 768px){
       .card-img{
        width: 80px;
        height: 80px;

    }  
    }
.price-table-box1 {
    padding: 20px;
    position: relative
}

.price-table-inner {
    background: #fff;
    padding: 30px 15px;
    box-shadow: 0 0 20px #d8d8d8;
    border-radius: 5px
}

.price_table_pages {
    margin-top: 70px;
    text-align: center;
    text-transform: uppercase
}

.price_report_writing {
    font-size: 17px;
    text-transform: uppercase;
    font-weight: 500;
    background: #3c3c3c;
    color: #fff;
    position: absolute;
    left: 0;
    width: 100%;
    text-align: center;
    padding: 10px 0
}

.price_table_pages h2 {
    font-weight: 500;
    word-break: break-all
}

.arrow_price_report:after {
    content: '';
    border-bottom: 30px solid #fdc80000;
    border-left: 20px solid #3c3c3c;
    border-right: 0 solid #000;
    border-top: 20px solid #d64a4a00;
    position: absolute;
    right: 0;
    background: 0 0;
    top: 75px
}

.arrow_price_report:before {
    content: '';
    border-bottom: 30px solid #fdc80000;
    border-left: 0 solid transparent;
    border-right: 20px solid #000;
    border-top: 20px solid #d64a4a00;
    position: absolute;
    left: 0;
    background: 0 0;
    top: 75px
}

.price-table1-area {
    padding: 15px 0 60px;
    background: #f5f5f5;
}

.price-table-service p {
    text-align: center;
    font-weight: 300;
    position: relative;
    padding-bottom: 10px
}

.price-table-service p:after {
    content: '';
    background: linear-gradient(to right, #fff, #3c3c3c, #2f2f2f, #fff);
    background: -ms-linear-gradient(right, #fff, #3c3c3c, #2f2f2f, #fff);
    background: -o-linear-gradient(right, #fff, #3c3c3c, #2f2f2f, #fff);
    background: -webkit-linear-gradient(right, #fff, #3c3c3c, #2f2f2f, #fff);
    background: -moz-linear-gradient(right, #fff, #3c3c3c, #2f2f2f, #fff);
    width: 60%;
    height: 1px;
    position: absolute;
    left: 50%;
    bottom: 0;
    transform: translate(-50%)
}

.text-black {
    color: #000;
}

.price-table-service {
    margin: 15px 0;
}

.pricetable-btn a {
    color: #000;
    font-size: 18px;
    font-weight: 500;
}

.price_bgbox_2 .price_report_writing {
    background: #fdc800;
    color: #000;
}

.price_bgbox_2 .arrow_price_report:before {
    border-right-color: #e0b100;
}

.price_bgbox_2 .arrow_price_report:after {
    border-left-color: #e0b100;
}

.price_bgbox_3 .price_report_writing {
    background: #3c3c3c;
}

.price_bgbox_3 .arrow_price_report:before {
    border-right-color: #000
}

.price_bgbox_3 .arrow_price_report:after {
    border-left-color: #000;
}
.pricetable-btn {
    padding: 10px 0;
    text-align: center;
    color: #263238;
    height: 50px;
    width: 160px;
    background: #fdc800;
    text-transform: uppercase;
    font-size: 16px;
    font-weight: 500;
    margin: 0 auto;
    border: 2px solid #fdc800;
    -webkit-transition: all .3s ease-out;
    -moz-transition: all .3s ease-out;
    -ms-transition: all .3s ease-out;
    -o-transition: all .3s ease-out;
    transition: all .3s ease-out;
}
.pricetable-btn:hover {
    background: #193759;
    color: #fff;
    border-color: #193759;
}
.price_bgbox_1 .pricetable-btn {
    background: #3c3c3c;
    border-color: #3c3c3c;
    color: #fff;
    height: auto;
}


.price_bgbox_3 .pricetable-btn {
    background: #3c3c3c;
    border-color: #3c3c3c;
}
.price-text{
    font-size: 25px;
    font-weight: 500px;
}

</style>
 

        <div class="price-table1-area">
            <!-- <h4 class="text-center"><b>Price Servive</b></h4> -->
            <div class="container">
                <div class="row">

                    <?php $__currentLoopData = $findService; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 mt-3">
                    	 <?php if($loop->even){ ?>

                        <div class="price-table-box1  price_bgbox_1 pricing-card">

                    	 <?}else{ ?>

                        <div class="price-table-box1  price_bgbox_2 pricing-card">

                    	  <?php  } ?> 
                            <span class="arrow_price_report"></span>                        
                            <div class="price-table-inner">                             
                                <div class="price_report_writing"><?php echo e(Str::limit($service->services_name, 22)); ?></div>
                                <div class="price_table_pages">
                                    <img src="<?=asset('/assets/uploads/services/'.$service->services_image)?>" height="120" width="200" alt="<?php echo e($service->image_alt); ?>">
                                    <h6><i class="bi bi-currency-dollar"></i><span class="price-text"><?php echo e($service->amount.'/'.$service->type); ?></span></h6>
                                </div>
                                <div class="price-table-service">
                                    <p class="borderline">No Plagiarism</p>
                                     
                                    <p class="borderline">Unlimited Revisions</p>
                                     
                                    <p class="borderline">Done by Expert</p>
                                     
                                    <p class="borderline">Free Price Quote</p>
                                     
                                    <p class="borderline">24/7 Support</p>
                                </div>
                               <div class="text-center"> <a href="<?php echo e($whatsAppLink); ?>"><button class="bg-success text-white pricing-button mt-2">Enquiry Now</button></a></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    <div class="col-lg-4 col-md-6 col-sm-6 mt-3"><!-- 
                        <div class="price-table-box1 price_bgbox_2 pricing-card">
                            <span class="arrow_price_report"></span>                        
                            <div class="price-table-inner">                             
                                <div class="price_report_writing">Finance/Accounting</div>
                                <div class="price_table_pages">
                                    <img src="webassets/images/accountingimg.png" class="card-img">
                                    <h6><i class="bi bi-currency-dollar"></i><span class="price-text">150/QUESTION</span></h6>
                                </div>
                                <div class="price-table-service">
                                    <p class="borderline">No Plagiarism</p>
                                     
                                    <p class="borderline">Unlimited Revisions</p>
                                     
                                    <p class="borderline">Done by Expert</p>
                                     
                                    <p class="borderline">Free Price Quote</p>
                                     
                                    <p class="borderline">24/7 Support</p>
                                </div>
                                 <div class="text-center"> <a href="https://www.ahecounselling.com/paynow"><button class="bg-success text-white pricing-button mt-2">Order Now</button></a></div>
                            </div>
                        </div>
                     --></div>
                    <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3 mt-3"><!-- 
                        <div class="price-table-box1 price_bgbox_3 pricing-card">
                            <span class="arrow_price_report"></span>                        
                            <div class="price-table-inner">                             
                                <div class="price_report_writing">Programming</div>
                                <div class="price_table_pages">
                                    <img src="webassets/images/computerimg.png" class="card-img">
                                   <h6><i class="bi bi-currency-dollar"></i><span class="price-text">150/PROBLEM</span></h6>
                                </div>
                                <div class="price-table-service">
                                    <p class="borderline">No Plagiarism</p>
                                     
                                    <p class="borderline">Unlimited Revisions</p>
                                     
                                    <p class="borderline">Done by Expert</p>
                                     
                                    <p class="borderline">Free Price Quote</p>
                                     
                                    <p class="borderline">24/7 Support</p>
                                </div>
                                <div class="text-center"> <a href="https://www.ahecounselling.com/paynow"><button class="bg-success text-white pricing-button mt-2">Order Now</button></a></div>
                            </div>
                        </div>
                     --></div>
                </div>
            </div>
        </div>

  
<?php echo $__env->make('layouts.frontfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/web/servicesbooking.blade.php ENDPATH**/ ?>