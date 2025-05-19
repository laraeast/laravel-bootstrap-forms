<div class="form-group">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-2">
            {{ html()->submit($label)->attributes( $attributes + ['class' => "btn $className", 'name' => $name]) }}
        </div>
    </div>
</div>

