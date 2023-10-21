<div class="form-group eqheight">
   <?php
    $attributes['class']=empty($attributes['class'])?'form-control':$attributes['class'] .' form-control';
    $id=empty($attributes['id'])?$name:$attributes['id'];
    $label=empty($attributes['label'])?null:$attributes['label'];unset($attributes['label']);
    if(is_array($label))
    {
        $label = $label[$name];
    }
    if($value == "GET_METHOD")
    {
        $value = request()->query($name);
    }
    ?>
    <?php echo e(Form::label($id, $label, ['class' => 'control-label'])); ?>

    <?php echo e(Form::select($name, $options, $value, $attributes)); ?>

</div><?php /**PATH /home/agroupso/ahecounselling.com/resources/views/components/form/select.blade.php ENDPATH**/ ?>