<?php 
$rmidlist  = \App\Model\Entry\RegisterMember_model::get();
 ?>
<?php $__env->startSection('content'); ?>
<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear"><?php echo e($title); ?> </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Orders / <?php echo e($title); ?> </h6>
            </div>
      
              
    
        </div>
    </div>
</div>

<?=Design::$filterStart?>
<div class="col-md-4 ">
    <?php echo e(Form::bsText('start_date','GET_METHOD',['label'=>"Start Date"])); ?>

</div>
 <div class="col-md-4 ">
    <?php echo e(Form::bsText('end_date','GET_METHOD',['label'=>"End Date"])); ?>

</div>
<div class="col-md-4 ">

     <div class="form-group eqheight">
       <label for="rm_id" class="control-label">Rm  User</label>
        <select class="form-control form-control-sm" id="rm_id" name="rm_id">
            <option value="">Please select one option</option>
              <?php $__currentLoopData = $rmidlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $rmvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option  value="<?php echo e($rmvalue->id); ?>"><?php echo e($rmvalue->rmid); ?> -(<?php echo e($rmvalue->name); ?>)</option>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
 </div>

<?=Design::$filterClose?>
<div class="block p-3" style="border-radius:15px">
    <div class="table-vcenter table-responsive">
        <table class="table  table-hover myTable">
            <thead>
                <tr>
                    <th><b>#</b></th>
                    <th><b>Order Id</b></th>
                    <th><b>Order Date</b></th>
                    <th><b>Client Name</b></th>
                    <th><b>Email</b></th>
                    <th><b> Service</b></th>
                    <th><b>BDE Name</b></th>
                    <th><b>Screenshot</b></th>
                    <th><b>Action</b></th>
                  
                </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach ($records as $ob) {
                    $rowId = $ob->en_id;
                ?>
                    <tr>
                        <td><?= $sr++ ?></td>
                        <td><?php echo $ob->rmid.'-'.date('d-m-y',$ob->tranxid).'_'.sprintf("%02d", $ob->order_number); ?></td>
                        <td><?php echo e(date('d-m-Y',strtotime($ob->en_created_at))); ?></td>
                        <td><?php echo e($ob->en_first_name); ?> <?php echo e($ob->en_last_name); ?></td>
                        <td><?php echo e($ob->en_email); ?></td>
                        <td>
                         <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="<?php echo e($ob->en_query); ?>"><?php echo e($ob->services_name); ?></a>
                       </td>
                        <td><?php echo e($ob->name); ?></td>
                        <td>
                            <?php if(!empty($ob->Screenshot)){
                                ?>
                                <a href="<?php echo e(asset('assets/uploads/enquiry/'.$ob->Screenshot)); ?>" target="_blank" class="btn btn-primary btn-sm px-2 py-1">View Screenshot </a>
                                <?php
                            }
                            ?>
                        </td>

                       <td>
                        <?= Design::$dmStart ?>
                        <a class="fancyboxajax" href="<?php echo e(url('admin/entry/myclientorders/'.$rowId.'/edit')); ?>">Update Status</a>
                        <a target="_blank" href="<?php echo e(url('admin/entry/myclientorders/trackstatus/'.$ob->tranxid)); ?>">Track Status</a>
                         <button class="send_mail px-3 py-2" data-id="<?php echo e($rowId); ?>">  Mail Resend </button>  
                         <a href="<?php echo e(route('admin.entry.client-work-status',$ob->tranxid)); ?>">Client work upload</a>
                      </td>
                  <?php } ?>
                </tr>
             </tbody>
        </table>
        <hr>
        <?php echo e($pagination->render()); ?>

      </div>
</div>

<script type="text/javascript"> 

   $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();  
      $("#start_date,#end_date").datepicker({            
      maxDate: new Date()
     }); 
    
      $(".send_mail").click(function(){
         if (confirm('are you sure you want to Resend mail')) {
             var id =$(this).data("id");
             $.ajax({
              'async': false,
              'global': false,
               url: "<?php echo e(route('resendmail')); ?>",
               dataType: 'json',
               type: 'get',
               data: { id:id},
              success:function(data){
                location.reload();
              }
           });
         }
      });
   });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/orders/index.blade.php ENDPATH**/ ?>