<?php

namespace Laraeast\LaravelBootstrapForms\Tests\Unit;

use Laraeast\LaravelBootstrapForms\Facades\BsForm;
use Laraeast\LaravelBootstrapForms\Tests\TestCase;

class TextareaComponentTest extends TestCase
{
    public function test_it_can_generate_a_textarea_field()
    {
        $textInput = BsForm::resource('')->textarea('body')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><textarea class="form-control" name="body" id="body"></textarea><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_required_input_field()
    {
        $textInput = BsForm::resource('')->textarea('body')->required()->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><textarea class="form-control" name="body" id="body" required="required"></textarea><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_a_textarea_field_with_cols_attribute()
    {
        $textInput = BsForm::resource('')->textarea('body')->cols(2)->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><textarea class="form-control" name="body" id="body" cols="2"></textarea><strong class="help-block"></strong></div>'
        );
    }


    public function test_it_can_generate_a_textarea_field_with_rows_attribute()
    {
        $textInput = BsForm::resource('')->textarea('body')->rows(2)->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><textarea class="form-control" name="body" id="body" rows="2"></textarea><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_a_textarea_field_with_autofocus_attribute()
    {
        $textInput = BsForm::resource('')->textarea('body')->autofocus()->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><textarea class="form-control" name="body" id="body" autofocus="autofocus"></textarea><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_a_textarea_field_with_value()
    {
        $textInput = BsForm::resource('')->textarea('body')->value('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><textarea class="form-control" name="body" id="body">foo</textarea><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_a_textarea_field_with_custom_attribute()
    {
        $textInput = BsForm::resource('')->textarea('body')->attribute('foo', 'bar')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><textarea class="form-control" name="body" id="body" foo="bar"></textarea><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_a_textarea_field_with_resource()
    {
        $textInput = BsForm::resource('test::blogs')->textarea('body')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label class="content-label" for="body">Body</label><textarea class="form-control" name="body" id="body" placeholder="Write something"></textarea><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_a_textarea_field_with_custom_label()
    {
        $textInput = BsForm::resource('test::blogs')->textarea('body')->label('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label class="content-label" for="body">foo</label><textarea class="form-control" name="body" id="body" placeholder="Write something"></textarea><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_a_textarea_field_with_custom_placeholder()
    {
        $textInput = BsForm::resource('test::blogs')->textarea('body')->placeholder('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label class="content-label" for="body">Body</label><textarea class="form-control" name="body" id="body" placeholder="foo"></textarea><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_a_textarea_field_with_custom_note()
    {
        $textInput = BsForm::resource('test::blogs')->textarea('body')->note('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label class="content-label" for="body">Body</label><textarea class="form-control" name="body" id="body" placeholder="Write something"></textarea><strong class="help-block">foo</strong></div>'
        );
    }
}
