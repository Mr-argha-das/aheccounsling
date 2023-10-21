<div class="form-group eqheight">
   <?php
    $attributes['class']=empty($attributes['class'])?'form-control':$attributes['class'] .' form-control';
    $label=empty($attributes['label'])?null:$attributes['label'];unset($attributes['label']);
    $attributes['row']=empty($attributes['row'])?'auto':$attributes['row'];
    $attributes['col']=empty($attributes['col'])?'auto':$attributes['col'];
    if(is_array($label))
    {
        $label = $label[$name];
    }
    ?>
    {{ Form::label($name, $label, ['class' => 'control-label']) }}
    {{ Form::textarea($name, $value, $attributes) }}
</div>