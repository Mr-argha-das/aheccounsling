 <?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<section class="mb-5 py-4 pay">
   <div class="container">
      <div class="row">
         

         <div class="col-md-12 mx-auto text-center">
            <div class="modalbs">
               <div id="success-icon">
                  <div></div>
               </div>
               <h3 class="mt-5 textheading"><strong>Payment Successfull</strong></h3>
               <?php if(Session::has('successFlash')): ?>
                   <h6 class="my-3 text-warning"><strong><?php echo Session::get('successFlash'); ?></strong></h6>
              <?php endif; ?>

              
               <hr>
              
               <div class="row">
                  <div class="col-md-6 text-left">
                     <p class="">Name</p>
                  </div>
                  <div class="col-md-6">
                     <p class="payment-1"><?php echo e($paymentdata->firstname); ?> <?php echo e($paymentdata->Lastname); ?></p>
                  </div>
               </div>
           
               <div class="row">
                  <div class="col-md-6 text-left">
                     <p class="mt-2">Email</p>
                  </div>
                  <div class="col-md-6">
                     <p class="payment-1"><?php echo e($paymentdata->email); ?></p>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 text-left">
                     <p>Mobile/Cell Number</p>
                  </div>
                  <div class="col-md-6">
                     <p class="payment-1"><?php echo e($paymentdata->phone); ?></p>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 text-left">
                     <p>Product Info</p>
                  </div>
                  <div class="col-md-6">
                     <p class="payment-1"><?php echo e($jsone->productinfo); ?></p>
                  </div>
               </div>
              
                <div class="row">
                  <div class="col-md-6 text-left">
                     <p>mihpayid</p>
                  </div>
                  <div class="col-md-6">
                     <p class="payment-1"><?php echo e($jsone->mihpayid); ?></p>
                  </div>
               </div>

                <div class="row">
                  <div class="col-md-6 text-left">
                     <p>Bank Ref Num</p>
                  </div>
                  <div class="col-md-6">
                     <p class="payment-1"><?php echo e($jsone->bank_ref_num); ?></p>
                  </div>
               </div>
                <div class="row">
                  <div class="col-md-6 text-left">
                     <p>Transaction Date</p>
                  </div>
                  <div class="col-md-6">
                     <p class="payment-1"><?php echo e(date('d-M-Y',strtotime($paymentdata->updated_at))); ?></p>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 text-left">
                     <p>Transaction ID</p>
                  </div>
                  <div class="col-md-6">
                     <p class="payment-1"><?php echo e($paymentdata->txnid); ?></p>
                  </div>
               </div>
                  
                <div class="row">
                  <div class="col-md-6 text-left">
                     <p><b>Payment Amount</b></p>
                  </div>
                  <div class="col-md-6">
                     <p class="payment-1"><b><?php echo e($paymentdata->symbol); ?> <?php echo e($paymentdata->amount); ?></b></p>
                  </div>
               </div>
               
               <hr>
            <!--    <div class="row">
                  <div class="col-md-6 mx-auto">
                     <div class="d-flex align-items-center">
                    <a class="outline-second-print" href="https://www.ahecounselling.com/sign-in">Login to dashboard</a>
                
                  </div>
                  </div>
               </div> -->
            </div>
         </div>
      </div>
   </div>
</section>
<script language="JavaScript">
  document.onkeypress=function(e){if(123==(e=e||window.event).keyCode)return alert("Error"),!1},document.onmousedown=function(e){if(123==(e=e||window.event).keyCode)return alert("Error"),!1},document.onkeydown=function(e){if(123==(e=e||window.event).keyCode)return alert("Error"),!1};var message="Error";function clickIE(){if(document.all)return!1}function clickNS(e){if((document.layers||document.getElementById&&!document.all)&&(2==e.which||3==e.which))return!1}function disableCtrlKeyCombination(e){var o,n,t=new Array("a","n","c","x","v","j","w","i");if(window.event?(o=window.event.keyCode,n=!!window.event.ctrlKey):(o=e.which,n=!!e.ctrlKey),n)for(i=0;i<t.length;i++)if(t[i].toLowerCase()==String.fromCharCode(o).toLowerCase())return alert("Error"),!1;return!0}document.layers?(document.captureEvents(Event.MOUSEDOWN),document.onmousedown=clickNS):(document.onmouseup=clickNS,document.oncontextmenu=clickIE),document.oncontextmenu=new Function("return false"),document.onkeydown=function(e){return!(e.ctrlKey&&86===e.keyCode||67===e.keyCode||85===e.keyCode||16===e.keyCode||117===e.keyCode)||(alert("Error"),!1)};
 </script>
<?php echo $__env->make('layouts.frontfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/paymentgetway/success.blade.php ENDPATH**/ ?>