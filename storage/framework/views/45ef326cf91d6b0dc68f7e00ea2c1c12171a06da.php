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

<div class="block p-3"  style="border-radius:15px">
    <div class="block-content">
        <table class="table table-vcenter table-hover">
            <thead>
                <tr>
                    <th scope="col"><b>#</b></th>
                    <th scope="col"><b>Category</b></th>
                    <th scope="col"><b>Title</b></th>
                    <th scope="col"><b>No of Page</b></th>
                    <th scope="col"><b>Word Count</b></th>
                    <th scope="col"><b>View</b></th>
                    <th scope="col"><b>Download</b></th>
                    <th scope="col"><b>Thumb Img</b></th>
                    <th scope="col"><b>Demo file</b></th>
                    
                 <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach ($records as $ob) {
                    $rowId = $ob->id;
                ?>
                     <tr>
                        <tD><?= $sr++ ?></tD>
                        <td><?php echo e($ob->category_list->name); ?></td>
                        <td><?php echo e($ob->title); ?></td>
                        <td><?php echo e($ob->no_of_page); ?></td>
                        <td><?php echo e($ob->word_count); ?></td>
                        <td><?php echo e($ob->views - $ob->start_from_view); ?></td>
                        <td><?php echo e($ob->download - $ob->start_from_download); ?></td>
               
                        <td><?php if(!empty($ob->thub_img)){ ?>
                            <img src="<?php echo e(asset('assets/uploads/projectthumb/'.$ob->thub_img)); ?> " width="60" width="60">
                            <?php } ?></td>

                        <td><a href="<?php echo e($ob->url); ?>" download><b>Download file</b> </a></td>
                         <td>
                                <?= Design::$dmStart ?>
                                
                                    <a class="fancyboxajax" href="<?php echo e(url($viewFolder.$rowId.'/edit')); ?>">Edit</a>
                          
                                <a class="fancyboxajax" href="<?php echo e(url($viewFolder.$rowId)); ?>">view</a>
                                 <a class="delete" data-action-url="<?php echo e(url($viewFolder.'delete/'.$rowId)); ?>" data-alert-title="Do You Want to Delete " data-alert-msg="Delete This Entry from this software">Delete</a>   
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
<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/project/index.blade.php ENDPATH**/ ?>