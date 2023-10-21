<?php $__env->startSection('content'); ?>
<?php echo $__env->make('blocks/panelHeading',['title'=>$title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
   <script src="assets/js/dzupload.js" defer></script>
   
   <!--  <script>

        ClassicEditor
            .create(document.querySelector('#test_desc'), {
                placeholder: 'Type the content here!',
                toolbar: ["undo", "redo", "heading", "bold", "link", "italic", "blockQuote", '|', "indent", "outdent", "numberedList", "bulletedList", "mediaEmbed", "insertTable", ],
            });
        
    </script> -->
     <script>
    $(document).ready(function($) {
          CKEDITOR.replace( 'test_desc', {  }  );
         
    });
                       
                </script>
<?php echo e(Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction))); ?>

<?php echo method_field('PUT'); ?>
<?php


$imgDataUpload = array(
                         'data-upload-folder'=>'assets/uploads/testinomials/',
                         'data-upload-url'=>route('ajaxuploadimage'),
                         'data-delete-url'=>route('deletefile'),
                         'data-inputname'=>'test_image',
                         'data-upload-type'=>'image',
                         'data-upload-maxfiles'=>1
                        
                     );
$uploadDatanof =NULL;
foreach($imgDataUpload as $key =>$val)
{
    $uploadDatanof.=$key.'='.$val.'  ' ;
}



?>
<div class="row">

         <div class="col-md-12 ">
           <?php echo e(Form::bsText('test_name',$row->test_name,['label'=>$niceNames,'class'=>'form-control'])); ?>

       </div>
       <div class="col-md-12 ">
           <?php echo e(Form::bsTextarea('test_desc',$row->test_desc,['label'=>$niceNames,'class'=>'form-control'])); ?>

       </div>
          <div class="col-md-12 ">
           <?php echo e(Form::bsText('image_alt',$row->image_alt,['label'=>"Imge Alt",'class'=>'form-control'])); ?>

       </div>

       <div class="col-md-12 ">
          <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$uploadDatanof?>  data-upload-filekey="userfile">
                    <div class="dz-message needsclick">
                        Drop files here or click to upload.<br>
                    </div>   
                    <?php 
                    $value = $row->test_image;
                     $img =$imgDataUpload['data-upload-folder'] . $value;

                
                  if (!empty($value)) {

                        $img =  asset($img);
                      echo '<div class="dz-preview dz-processing dz-image-preview dz-complete">
                            <div class="dz-image">
                                <img data-dz-thumbnail="" alt="' .$value . '" src="' . $img. '">
                            </div>
                            <div class="dz-details">
                                <div class="dz-filename"><span data-dz-name="">' . $value . '</span></div>
                            </div>

                            <div class="dropzone-ajaxdata"><div class="dz-remove dz-deletefile" style="" title="Delete"><i class="fa fa-times"></i></div><input type="hidden" value="' . $value . '" class="dz-serveruploadfile" name="' . $imgDataUpload['data-inputname'] . '"></div>
                       </div>';
                  }
                     ?> 
                    <div class="fallback">
                      <input type="file" name="userfile">
                       </div>

                </div></div> 

       

  
        <?php echo e(Form::bsSubmit()); ?>

 
<?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/testinomials/edit.blade.php ENDPATH**/ ?>