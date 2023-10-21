 
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('blocks/panelHeading',['title'=>$title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  
    <script src="assets/js/dzupload.js" defer></script>
  <script>
    $(document).ready(function($) {
         CKEDITOR.replace( 'description', {  }  );
         // CKEDITOR.replace( 'menu_slider_text', { allowedContent: 'p' }  );
         
    });
                       
                </script>
<?php echo e(Form::open(array('url' => $formAction,'data-ajaxAction'=>'../'.$formAction))); ?>

<?php echo method_field('PUT'); ?>
 <?php 

  $imgDataUpload = array(
             'data-upload-folder'=>'assets/uploads/projectthumb/',
             'data-upload-url'=>route('ajaxuploadimage'),
             'data-delete-url'=>route('deletefile'),
             'data-inputname'=>'thub_img',
             'data-upload-type'=>'image',
             'data-upload-maxfiles'=>1
            
         );
   $thub_img =NULL;

  foreach($imgDataUpload as $key =>$val){
      $thub_img.=$key.'='.$val.'  ' ;
  }

      $doc_1 = array(
                         'data-upload-folder'=>'assets/uploads/projectdoc/',
                         'data-upload-url'=>route('ajaxuploadimage'),
                         'data-delete-url'=>route('deletefile'),
                         'data-inputname'=>'img_1',
                         'data-upload-type'=>'Document',
                         'data-upload-maxfiles'=>1
                        
                     );
$img_1 =NULL;
foreach($doc_1 as $key =>$val){
  
    $img_1.=$key.'='.$val.'  ' ;
}

$doc_2 = array(
             'data-upload-folder'=>'assets/uploads/projectdoc/',
             'data-upload-url'=>route('ajaxuploadimage'),
             'data-delete-url'=>route('deletefile'),
             'data-inputname'=>'img_2',
             'data-upload-type'=>'Document',
             'data-upload-maxfiles'=>1
          );
$img_2 =NULL;
foreach($doc_2 as $key =>$val){
    $img_2.=$key.'='.$val.'  ' ;
}


?>
<div class="row">

       <div class="col-md-12 ">
       <?php echo e(Form::bsSelect('project_categroy_id',$category,$row->project_categroy_id,['label'=>'Project-Category','class'=>'form-control'])); ?>

       </div>

       <input type="hidden" name="project_categroy_id_old" value="<?php echo e($row->project_categroy_id); ?>">


       <div class="col-md-12 ">
           <?php echo e(Form::bsText('title',$row->title,['label'=>'Title','class'=>'form-control'])); ?>

       </div>

       <div class="col-md-12 ">
           <?php echo e(Form::bsText('no_of_page',$row->no_of_page,['label'=>'No of Page','class'=>'form-control'])); ?>

       </div>

       <div class="col-md-12 ">
           <?php echo e(Form::bsText('word_count',$row->word_count,['label'=>'Word Count','class'=>'form-control'])); ?>

       </div>

        <div class="col-md-12 ">
            

             <?php echo e(Form::bsTextarea('description',$row->description,['label'=>'Description','class'=>'form-control ckeditor'])); ?>

       </div>

       <div class="col-md-12 ">
           <?php echo e(Form::bsText('seo_keyword',$row->seo_keyword,['label'=>'Seo Keyword','class'=>'form-control'])); ?>

       </div>
       <div class="col-md-12 ">
           <?php echo e(Form::bsText('seo_title',$row->seo_title,['label'=>'Seo title','class'=>'form-control'])); ?>

       </div>

        <div class="col-md-12 ">
           <?php echo e(Form::bsTextarea('seo_description',$row->seo_description,['label'=>'Seo Description','class'=>'form-control'])); ?>

       </div>
       
     <div class="col-md-6">
     <label>Thumb Image</label>
       <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$thub_img?>  data-upload-filekey="userfile">
                    <div class="dz-message needsclick">
                        Drop files here or click to upload.<br>
                    </div>   
                    <?php 
                     $value = $row->thub_img;
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
                 <div class="col-md-6">
           <label>Demo Img-1</label>
          <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$img_1?>  data-upload-filekey="userfile">
                    <div class="dz-message needsclick">
                        Drop files here or click to upload.<br>
                    </div>   
                    <?php 
                    $value = $row->img_1;
                     $img =$doc_1['data-upload-folder'] . $value;

                
                  if (!empty($value)) {

                        $img =  asset($img);
                      echo '<div class="dz-preview dz-processing dz-image-preview dz-complete">
                            <div class="dz-image">
                                <img data-dz-thumbnail="" alt="' .$value . '" src="' . $img. '">
                            </div>
                            <div class="dz-details">
                                <div class="dz-filename"><span data-dz-name="">' . $value . '</span></div>
                            </div>

                            <div class="dropzone-ajaxdata"><div class="dz-remove dz-deletefile" style="" title="Delete"><i class="fa fa-times"></i></div><input type="hidden" value="' . $value . '" class="dz-serveruploadfile" name="' . $doc_1['data-inputname'] . '"></div>
                       </div>';
                  }
                     ?> 
                    <div class="fallback">
                      <input type="file" name="userfile">
                       </div>

                </div></div> 

                <div class="col-md-6">
           <label>Demo Img-2</label>
          <div class="dropzone upload-widget" data-max-width="3000" data-max-height="3000" <?=$img_2?>  data-upload-filekey="userfile">
                    <div class="dz-message needsclick">
                        Drop files here or click to upload.<br>
                    </div>   
                    <?php 
                    $value = $row->img_2;
                     $img =$doc_2['data-upload-folder'] . $value;

                
                  if (!empty($value)) {

                        $img =  asset($img);
                      echo '<div class="dz-preview dz-processing dz-image-preview dz-complete">
                            <div class="dz-image">
                                <img data-dz-thumbnail="" alt="' .$value . '" src="' . $img. '">
                            </div>
                            <div class="dz-details">
                                <div class="dz-filename"><span data-dz-name="">' . $value . '</span></div>
                            </div>

                            <div class="dropzone-ajaxdata"><div class="dz-remove dz-deletefile" style="" title="Delete"><i class="fa fa-times"></i></div><input type="hidden" value="' . $value . '" class="dz-serveruploadfile" name="' . $doc_2['data-inputname'] . '"></div>
                       </div>';
                  }
                     ?> 
                    <div class="fallback">
                      <input type="file" name="userfile">
                       </div>

                </div></div> 

                <div class="col-md-6">
                  <label>Full  demo file</label>
                  <input type="file"   name="full_project_file" class="form-control">
                  <label><a href="<?php echo e($row->url); ?>" download>Download Old file </a></label>
               </div>

        <div class="col-md-12 ">
                 <?php echo e(Form::bsSelect('services_status',$statusDropdown,$row->services_status,['label'=>$niceNames,'class'=>'form-control'])); ?>

             </div>
            
       

  
        <?php echo e(Form::bsSubmit()); ?>

 
<?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.'.config('backendLayout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/admin/entry/project/edit.blade.php ENDPATH**/ ?>