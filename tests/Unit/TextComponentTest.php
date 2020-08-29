<?php

namespace Laraeast\LaravelBootstrapForms\Tests\Unit;

use Illuminate\Support\Str;
use Laraeast\LaravelBootstrapForms\Facades\BsForm;
use Laraeast\LaravelBootstrapForms\Tests\TestCase;

class TextComponentTest extends TestCase
{
    /** @test */
    public function it_can_generate_an_input_field()
    {
        $textInput = BsForm::resource(null)->text('body')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><input class="form-control" name="body" type="text"><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_required_input_field()
    {
        $textInput = BsForm::resource(null)->text('body')->required()->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><input class="form-control" required="required" name="body" type="text"><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_an_input_field_with_max_length_attribute()
    {
        $textInput = BsForm::resource(null)->text('body')->maxLength(2)->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><input class="form-control" maxlength="2" name="body" type="text"><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_an_input_field_with_autofocus_attribute()
    {
        $textInput = BsForm::resource(null)->text('body')->autofocus()->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><input class="form-control" autofocus="autofocus" name="body" type="text"><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_an_input_field_with_value()
    {
        $textInput = BsForm::resource(null)->text('body')->value('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><input class="form-control" name="body" type="text" value="foo"><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_an_input_field_with_custom_attribute()
    {
        $textInput = BsForm::resource(null)->text('body')->attribute('foo', 'bar')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><input class="form-control" foo="bar" name="body" type="text"><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_an_input_field_with_resource()
    {
        $textInput = BsForm::resource('test::blogs')->text('body')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label for="body">Body</label><input class="form-control" placeholder="Write something" name="body" type="text" id="body"><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_an_input_field_with_custom_label()
    {
        $textInput = BsForm::resource('test::blogs')->text('body')->label('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label for="body">foo</label><input class="form-control" placeholder="Write something" name="body" type="text" id="body"><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_an_input_field_with_custom_placeholder()
    {
        $textInput = BsForm::resource('test::blogs')->text('body')->placeholder('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label for="body">Body</label><input class="form-control" placeholder="foo" name="body" type="text" id="body"><small class="form-text text-muted"></small></div>'
        );
    }

    /** @test */
    public function it_can_generate_an_input_field_with_custom_note()
    {
        $textInput = BsForm::resource('test::blogs')->text('body')->note('foo')->toHtml();

        $this->assertEquals(
            $this->minifyHtml($textInput),
            '<div class="form-group"><label for="body">Body</label><input class="form-control" placeholder="Write something" name="body" type="text" id="body"><small class="form-text text-muted">foo</small></div>'
        );
    }

    /** @test */
    public function it_can_generate_multilingual_input_field()
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
