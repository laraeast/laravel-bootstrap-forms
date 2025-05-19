<div class="form-group">
    {{ html()->submit($label)->attributes( $attributes + ['class' => "btn $className", 'name' => $name]) }}
</div>
