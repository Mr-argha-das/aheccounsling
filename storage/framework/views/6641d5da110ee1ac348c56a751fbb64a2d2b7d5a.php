<?php 
$rmidlist  = \App\Model\Entry\RegisterMember_model::makeArray();
?>
<?php $__env->startSection('content'); ?>
<div class="block">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear"><?php echo e($title); ?> </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">Dashboard / Orders / <?php echo e($title); ?> </h6>
            </div>
        </div>
    </div>
</div>
  
<div class="block">
    <div class="table-vcenter table-responsive">
        <table class="table  table-hover" id="example">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Sr.No</th>
                    <th>Creation Date</th>
                    <th>Deadline</th>
                    <th>Hard Deadline</th>
                    <th>Time</th>
                    <th>Order Id</th>
                    <th>Subject Title</th>
                    <th>University Name</th>
                    <th>Order Status</th>
                    <th>Client Name</th>
                    <th>Reference By</th>
                    <th>Word Count</th>
                    <th>Type</th>
                    <th>Stream</th>
                    <th>Amount</th>
                    <th>Currency</th>
                     <th>Installment 1</th>
                    <th>Installment 2</th>
                    <th>Installment 3</th>
                    <th>Part/Full/No Payment</th>
                    <th>INR Conversion</th>
                    <th>AUD Conversion</th>
                    <th>Note</th>
                    <th>Date 1st Instalment</th>
                    <th>Date 2nd Instalment</th>
                    <th>Mode</th>
                 </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach ($records as $value) {

                  $order_number =$value->rmid.'-'.date('d-m-y',strtotime($value->en_created_at)).'_'.sprintf("%02d", $value->order_number);
                      
                ?>
                    <tr>
                        
                        <td><?php echo e(date('F',strtotime($value->en_created_at))); ?></td> 
                        <td></td>
                        <td><?php echo e(date('d-m-Y',strtotime($value->en_created_at))); ?></td>
                        <td><?php echo e(date('d-m-Y',strtotime($value->deadline))); ?></td>
                        <td></td>
                        <td></td>
                        <td><?php echo e($value->rmid.'-'.date('d-m-y',$value->tranxid).'_'.sprintf("%02d", $value->order_number)); ?></td>
                        <td><?php echo e($order_number.' | '.$value->symbol.$value->en_first_name.'_'.$value->en_subject.'_'.$value->module_name); ?></td>
                        <td></td>
                        <td></td>
                        
                        <td><?php echo e($value->en_first_name.' '.$value->en_last_name); ?></td>
                        <td></td>
                        <td><?php echo e($value->word_count); ?></td>
                        <td><?php echo e($value->assignment_type); ?></td>
                        <td><?php echo e($value->services_name); ?></td>

                        <td><?php echo e($value->client_amount); ?></td>
                        <td><?php echo e($value->currency_name); ?></td>
                        <td><?php echo e($value->inr_amount); ?></td>
                        <td></td>
                        <td></td>
                        <td><?php echo e($value->payment_type); ?></td>
                        <td><?php echo e($value->inr_amount); ?></td>
                        <td><?php echo e($value->aud_amount); ?></td>
                        <td><?php echo e($value->en_query); ?></td>
                         <td><?php echo e(date('d-m-Y',strtotime($value->en_created_at))); ?></td>
                        <td></td>
                        <td></td>
                          
                      
               <?php } ?>
          </tr>
          
            </tbody>
        </table>
    </div>
</div>


 

<script type="text/javascript">

  $(document).ready(function () {
    $('#example').DataTable({
        dom: 'Bfrtip',
      buttons: [
        {
            extend: 'copyHtml5',
            text: 'Copy row',
            header:false,
            exportOptions: {
                modifier: {
                    page: 'current'
                }
            }
        }
    ],
        language: {
            buttons: {
                copyTitle: '',
                copyKeys: 'Appuyez sur <i>ctrl</i> ou <i>\u2318</i> + <i>C</i> pour copier les données du tableau à votre presse-papiers. <br><br>Pour annuler, cliquez sur ce message ou appuyez sur Echap.',
                copySuccess: {
                    _: '%d line copy',
                    1: '1 ligne copiée'
                }
            }
        }
    });

     
});
 



   $(document).ready(function(){
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
<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/orders/copyCsvData.blade.php ENDPATH**/ ?>