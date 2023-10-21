<?php $__env->startSection('content'); ?>


<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear"><?php echo e($title); ?> </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Master / <?php echo e($title); ?> </h6>
            </div>
         </div>
    </div>
</div>

 

<div class="block p-3" style="border-radius:15px">
    <div class="block-content">
        <table class="table table-vcenter table-hover">
            <thead>
                <tr>
                     
                    <th><b>RM</b></th>
                    <th><b>Full Name</b></th>
                    <th><b>Email</b></th>
                    <th><b>Amount</b></th>
                    <th><b>Txn-Id </b></th>
                    <th><b>Status</b></th>
                    <th><b>Created_at</b></th>
                    <th><b>updated_at</b></th>
                    <th><b>Actions</b></th>
                     
                </tr>
            </thead>
            <tbody>
                  <?php  
                     foreach ($records as $ob) {
                     $rowId = $ob->id;  

                     switch($ob->payment_status){ 
                     case "success":
                       $class ='btn btn-success btn-sm';break;
                     case "failure":
                       $class ='btn btn-danger btn-sm';break;
                     case "pending":
                       $class ='btn btn-info btn-sm';break;
                        default:
                         $class ='btn btn-info btn-sm';
                    }


                      ?>
                    <tr>
                         <td><?php echo e($ob->rm_user); ?></td>
                         <td><?php echo e($ob->firstname); ?> <?php echo e($ob->Lastname); ?></td>
                         <td><?php echo e($ob->email); ?></td>
                         <td><?php echo e($ob->symbol.' '.$ob->amount); ?></td>
                         <td><?php echo e($ob->txnid); ?></td>
                         <td class="<?php echo e($class); ?>"><?php echo e($ob->payment_status); ?></td>
                         <td><?php echo e(date('d-M-y h:i:s a',strtotime($ob->created_at))); ?></td>
                         <td><?php echo e(date('d-M-y h:i:s a',strtotime($ob->updated_at))); ?></td>
                          <td>
                            <?= Design::$dmStart ?>
                            <?php if($ob->payment_status=="success"){ ?>
                              <a  target="_blank" href="<?php echo e(route('success', ['id' => base64_encode($rowId)])); ?>">view</a>
                            <?php }else if($ob->payment_status=="failure"){ ?>

                              <a  target="_blank" href="<?php echo e(route('failed', ['id' => base64_encode($rowId)])); ?>">view</a>

                             <?php } ?>
                            
                            <?= Design::$dmClose ?>
                         </td>
                             
                        <?php } ?>
                    </tr>
          
            </tbody>
        </table>

        <hr>
        <?php echo e($pagination->render()); ?>




    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/payment/index.blade.php ENDPATH**/ ?>