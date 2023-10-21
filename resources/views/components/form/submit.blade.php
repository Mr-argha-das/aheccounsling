<div class="div">
   <?php
    $attributes['class']=empty($attributes['class'])?'btn btn-info':$attributes['class'] .' btn btn-info';
    $name=empty($name)?'Submit':$name;
    ?>
    {{ Form::submit($name, $attributes) }}
</div>