<?php $__env->startSection('content'); ?>
<style>
  @import  url("https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700");

.timeline {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 32px;
}

.timeline::before{
    content: unset;
}

.title > h4,
.title > h3 {
  margin: 0;
}

h4 {
  opacity: 50%;
}

.events {
  position: relative;
  
  display: grid;
  grid-template-columns: 16px 1fr;
  row-gap: 16px;
  
  padding-top: 32px;
  width: 85%;
}

.event {
  display: grid;
  grid-template-columns: 16px 1fr;
  column-gap: 16px;
  grid-column: 1 / 3;
  margin: 20px 0;
}

.date > h6,
.description > p {
  margin: 0;
  color: #fff;
}

.box {
    background: #5d80d1;
    padding: 10px;
    border-radius: 10px;
    margin-top: -5px;
}

.knob {
  grid-column: 1 / 2;
  width: 100%;
  aspect-ratio: 1 / 1; 
  position: relative;
  z-index: 1;
  
  background: #4c4c4c;
  border-radius: 10px;
}

.date,
.description {
  grid-column: 2 / 3;
  align-self: center;
}

.line {
  position: absolute;
  
  grid-column: 1 / 2;
  justify-self: center;
  
  height: 100%;
  width: 4px;
  z-index: 0;
  
  background-color: rgba(0, 0, 0, .1);
}
.date {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.knob span {
    margin-left: -80px;
    position: absolute;
    font-size: 12px;
    font-weight: 500;
}

.description p {
    font-size: 12px;
}
</style>
<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear"><?php echo e($title); ?> </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Orders / Track Status </h6>
            </div>
      
                <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary fancyboxajax" href="<?php echo e(url('admin/entry/myclientorders/'.$workDetails->en_id.'/edit')); ?>"><i class="fa fa-plus mr-1"></i>Update Status</a>

                    </span>
                </div>
        </div>
    </div>
</div>

<div class="block p-3" style="border-radius:15px">
    <div class="table-vcenter table-responsive"> 
       
<div class="timeline">
    <h2><?php echo e($order_title); ?></h2>
  
  <div class="events">

    <?php $__currentLoopData = $workStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statusValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="event">
      <div class="knob"><span><?php echo e(date('d-M-Y',strtotime($statusValue->created_at))); ?></span></div>
      <div class="box">
          <div class="date border-bottom border-light p-2 mb-2">
        <h6><?php echo e($orderStatus[$statusValue->status]); ?> - <?php echo e($statusValue->user_type); ?></h6>

         <span class="text-light">
          <?php echo e(date('h:i:s a',strtotime($statusValue->created_at))); ?>

         </span>
       <!--  <span>
            <a href="" class="px-1"><img src="https://img.icons8.com/material-outlined/20/ffffff/pencil--v1.png"/></a>
            <a href="" class="px-1"><img src="https://img.icons8.com/fluency-systems-regular/20/ffffff/filled-trash.png"/></a>
        </span> -->
      </div>
      <div class="description">
        <p><?php echo e($statusValue->comment); ?></p>
      </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   
    
    <div class="line"></div>
  </div>
      
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/orders/trackstatus.blade.php ENDPATH**/ ?>