<?php

namespace Laraeast\LaravelBootstrapForms\Tests\Unit;

use Laraeast\LaravelBootstrapForms\Facades\BsForm;
use Laraeast\LaravelBootstrapForms\Tests\TestCase;

class TextareaComponentTest extends TestCase
{
    /** @test */
    public function it_can_generate_a_textarea_field()
    {
        $textInput = BsForm::resource(null)->textarea('body')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><textarea class="form-control" style="resize: vertical" name="body" cols="50" rows="10"></textarea><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_required_input_field()
    {
        $textInput = BsForm::resource(null)->textarea('body')->required()->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><textarea class="form-control" style="resize: vertical" required="required" name="body" cols="50" rows="10"></textarea><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_a_textarea_field_with_cols_attribute()
    {
        $textInput = BsForm::resource(null)->textarea('body')->cols(2)->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><textarea class="form-control" style="resize: vertical" cols="2" name="body" rows="10"></textarea><small class="form-text text-muted"></small></div>'
        );
    }


    /** @test */
    public function it_can_generate_a_textarea_field_with_rows_attribute()
    {
        $textInput = BsForm::resource(null)->textarea('body')->rows(2)->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><textarea class="form-control" style="resize: vertical" rows="2" name="body" cols="50"></textarea><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_a_textarea_field_with_autofocus_attribute()
    {
        $textInput = BsForm::resource(null)->textarea('body')->autofocus()->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><textarea class="form-control" style="resize: vertical" autofocus="autofocus" name="body" cols="50" rows="10"></textarea><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_a_textarea_field_with_value()
    {
        $textInput = BsForm::resource(null)->textarea('body')->value('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><textarea class="form-control" style="resize: vertical" name="body" cols="50" rows="10">foo</textarea><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_a_textarea_field_with_custom_attribute()
    {
        $textInput = BsForm::resource(null)->textarea('body')->attribute('foo', 'bar')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><textarea class="form-control" style="resize: vertical" foo="bar" name="body" cols="50" rows="10"></textarea><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_a_textarea_field_with_resource()
    {
        $textInput = BsForm::resource('test::blogs')->textarea('body')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label for="body">Body</label><textarea class="form-control" style="resize: vertical" placeholder="Write something" name="body" cols="50" rows="10" id="body"></textarea><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_a_textarea_field_with_custom_label()
    {
        $textInput = BsForm::resource('test::blogs')->textarea('body')->label('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label for="body">foo</label><textarea class="form-control" style="resize: vertical" placeholder="Write something" name="body" cols="50" rows="10" id="body"></textarea><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_a_textarea_field_with_custom_placeholder()
    {
        $textInput = BsForm::resource('test::blogs')->textarea('body')->placeholder('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label for="body">Body</label><textarea class="form-control" style="resize: vertical" placeholder="foo" name="body" cols="50" rows="10" id="body"></textarea><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_a_textarea_field_with_custom_note()
    {
        $textInput = BsForm::resource('test::blogs')->textarea('body')->note('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label for="body">Body</label><textarea class="form-control" style="resize: vertical" placeholder="Write something" name="body" cols="50" rows="10" id="body"></textarea><small class="form-text text-muted">foo</small></div>'
        );
    }
}
