<div class="form-group eqheight">
   <?php
    $label=empty($attributes['label'])?null:$attributes['label'];unset($attributes['label']);
    ?>
    <?php echo e(Form::label($name, $label, ['class' => 'control-label d-block font-weight-bold mb-0'])); ?>

    <?php echo e($value); ?>

</div><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/components/form/view.blade.php ENDPATH**/ ?>