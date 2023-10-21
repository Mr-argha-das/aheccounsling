<div class="form-group eqheight">
   <?php
    $label=empty($attributes['label'])?null:$attributes['label'];unset($attributes['label']);
    ?>
    {{ Form::label($name, $label, ['class' => 'control-label d-block font-weight-bold mb-0']) }}
    {{ $value }}
</div>