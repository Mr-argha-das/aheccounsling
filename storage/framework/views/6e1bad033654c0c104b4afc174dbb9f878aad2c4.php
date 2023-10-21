<?php $__env->startSection('content'); ?>
<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear"><?php echo e($title); ?> </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn mt-2" data-toggle="appear" data-timeout="250">Dashboard / Master / <?php echo e($title); ?> </h6>
            </div>
      
                <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary fancyboxajax" href="<?= $viewpPath ?>create"><i class="fa fa-plus mr-1"></i> Create New</a>
                    </span>
                </div>
         </div>
    </div>
</div>

    <?=Design::$filterStart?>
      <div class="col-md-6">
         <?php echo e(Form::bsText('blog_title','GET_METHOD',['label'=>"Blog Title"])); ?>

      </div>
      <?=Design::$filterClose?>
 <div class="block">
    <div class="block-content">
        <table class="table table-vcenter table-hover myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Image</th>
                    <th scope="col">Uploaded By</th>
                    <th scope="col"> Status</th>
                    <th scope="col">Actions</th>
                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach ($records as $ob) {
                    $rowId = $ob->blog_id;
                    $blogType = [1=>'Blog',2=>'IJP',3=>'Story Teller']
                ?>
                    <tr>
                        <tD><?= $sr++ ?></tD>

                        <td><?php echo e($ob->blog_name); ?></td>
                         <td><?php echo e($blogType[$ob->blog_type]); ?></td>
               
                        <td><?php if(!empty($ob->blog_image)){ ?>
                            <img src="<?php echo e(asset('assets/uploads/blogs/'.$ob->blog_image)); ?> " width="60" width="60">
                            <?php } ?></td>

                         
                         <td><?=($ob->blog_status == 1)?'Admin':$ob->user_name?></td>
                         <td><?php echo e($statusDropdown[$ob->blog_status]); ?></td>
       
                            <td>
                                <?= Design::$dmStart ?>
                                
                                    <a class="fancyboxajax" href="<?php echo e(url($viewFolder.$rowId.'/edit')); ?>">Edit</a>
                          
                                <a class="fancyboxajax" href="<?php echo e(url($viewFolder.$rowId)); ?>">view</a>
                                 <a class="delete" data-action-url="<?php echo e(url($viewFolder.'delete/'.$rowId)); ?>" data-alert-title="Do You Want to Delete " data-alert-msg="Delete This Entry from this software">Delete</a>   
                                <?= Design::$dmClose ?>
                               
                            </td>
                            <td>
                                 <a href="<?=route('blogpage', str_replace(" ","-",strtolower($ob->blog_name)))?>" target="_blank">
                                    Web
                                </a>
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
<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/blogs/index.blade.php ENDPATH**/ ?>