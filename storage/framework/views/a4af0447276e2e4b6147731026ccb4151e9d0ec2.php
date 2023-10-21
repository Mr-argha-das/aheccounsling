<div class="div">
   <?php
    $attributes['class']=empty($attributes['class'])?'btn btn-info':$attributes['class'] .' btn btn-info';
    $name=empty($name)?'Submit':$name;
    ?>
    <?php echo e(Form::submit($name, $attributes)); ?>

</div><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/components/form/submit.blade.php ENDPATH**/ ?>