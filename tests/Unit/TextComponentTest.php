<?php

namespace Laraeast\LaravelBootstrapForms\Tests\Unit;

use Illuminate\Support\Str;
use Laraeast\LaravelBootstrapForms\Facades\BsForm;
use Laraeast\LaravelBootstrapForms\Tests\TestCase;

class TextComponentTest extends TestCase
{
    public function test_it_can_generate_an_input_field()
    {
        $textInput = BsForm::resource('')->text('body')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><input class="form-control" type="text" name="body" id="body"><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_required_input_field()
    {
        $textInput = BsForm::resource('')->text('body')->required()->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><input class="form-control" type="text" name="body" id="body" required="required"><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_an_input_field_with_max_length_attribute()
    {
        $textInput = BsForm::resource('')->text('body')->maxLength(2)->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><input class="form-control" type="text" name="body" id="body" maxlength="2"><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_an_input_field_with_autofocus_attribute()
    {
        $textInput = BsForm::resource('')->text('body')->autofocus()->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><input class="form-control" type="text" name="body" id="body" autofocus="autofocus"><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_an_input_field_with_value()
    {
        $textInput = BsForm::resource('')->text('body')->value('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><input class="form-control" type="text" name="body" id="body" value="foo"><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_an_input_field_with_custom_attribute()
    {
        $textInput = BsForm::resource('')->text('body')->attribute('foo', 'bar')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><input class="form-control" type="text" name="body" id="body" foo="bar"><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_an_input_field_with_resource()
    {
        $textInput = BsForm::resource('test::blogs')->text('body')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label class="content-label" for="body">Body</label><input class="form-control" type="text" name="body" id="body" placeholder="Write something"><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_an_input_field_with_custom_label()
    {
        $textInput = BsForm::resource('test::blogs')->text('body')->label('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label class="content-label" for="body">foo</label><input class="form-control" type="text" name="body" id="body" placeholder="Write something"><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_an_input_field_with_custom_placeholder()
    {
        $textInput = BsForm::resource('test::blogs')->text('body')->placeholder('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label class="content-label" for="body">Body</label><input class="form-control" type="text" name="body" id="body" placeholder="foo"><strong class="help-block"></strong></div>'
        );
    }

    public function test_it_can_generate_an_input_field_with_custom_note()
    {
        $textInput = BsForm::resource('test::blogs')->text('body')->note('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label class="content-label" for="body">Body</label><input class="form-control" type="text" name="body" id="body" placeholder="Write something"><strong class="help-block">foo</strong></div>'
        );
    }

    public function test_it_can_generate_multilingual_input_field()
    {
        $this->assertTrue(
            Str::contains(
                $this->minifyHtml(view('test::blogs')->render()),
                'class="nav nav-tabs"'
            )
        );
        $this->assertTrue(
            Str::contains(
                $this->minifyHtml(view('test::blogs')->render()),
                'name="body:en"'
            )
        );
    }
}
