<div class="form-group eqheight">
    <?php
    $attributes['class']=empty($attributes['class'])?'form-control':$attributes['class'] .' form-control';
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
    {{ Form::label($name, $label, ['class' => 'control-label']) }}
    {{ Form::text($name, $value, $attributes) }}
</div>