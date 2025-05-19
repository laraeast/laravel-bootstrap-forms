<div class="form-group row">
    <div class="col-sm-10 offset-sm-2">
        {{ html()->submit($label)->attributes( $attributes + ['class' => "btn $className", 'name' => $name]) }}
    </div>
</div>

