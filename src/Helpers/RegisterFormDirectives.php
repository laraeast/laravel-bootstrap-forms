<?php

namespace Laraeast\LaravelBootstrapForms\Helpers;

use Illuminate\Support\Facades\Config;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Blade;

class RegisterFormDirectives
{
    /**
     * Register @bsMultilangualFormTabs directive.
     */
    public function registerMultilangualFormTabs(): void
    {
        Blade::directive('bsMultilangualFormTabs', function () {
            $uniqid = Uuid::uuid1();

            $view = Config::get('laravel-bootstrap-forms.views').'.components.multilangual_form';

            $initLoop = "\$__env->startComponent('$view', ['uniqid' => '$uniqid']); \$__currentLoopData = BsForm::getLocales(); \$__env->addLoop(\$__currentLoopData);";

            $iterateLoop = "\$__env->startPush('$uniqid'.\$locale->code); \$__env->incrementLoopIndices(); \$loop = \$__env->getLastLoop(); BsForm::locale(\$locale);";

            return "<?php {$initLoop} foreach(\$__currentLoopData as \$locale): {$iterateLoop} ?>";
        });
    }

    /**
     * Register @endBsMultilangualFormTabs directive.
     */
    public function registerEndMultilangualFormTabs(): void
    {
        Blade::directive('endBsMultilangualFormTabs', function () {
            return '<?php $__env->stopPush(); endforeach; BsForm::locale(null); $__env->popLoop(); $loop = $__env->getLastLoop(); echo $__env->renderComponent(); ?>';
        });
    }

    /**
     * Register @multilangualForm directive.
     */
    public function registerMultilangualForm(): void
    {
        Blade::directive('multilangualForm', function () {
            $initLoop = "\$__currentLoopData = BsForm::getLocales(); \$__env->addLoop(\$__currentLoopData);";

            $iterateLoop = '$__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); BsForm::locale($locale);';

            return "<?php {$initLoop} foreach(\$__currentLoopData as \$locale): {$iterateLoop} ?>";
        });
    }

    /**
     * Register @endMultilangualForm directive.
     */
    public function registerEndMultilangualForm(): void
    {
        Blade::directive('endMultilangualForm', function () {
            return '<?php endforeach; BsForm::locale(null); $__env->popLoop(); $loop = $__env->getLastLoop(); ?>';
        });
    }

    /**
     * Register @formpost directive.
     */
    public function registerFormPost(): void
    {
        Blade::directive('formpost', function ($url, $attributes = []) {
            $attributes = json_encode($attributes);

            return "<?php echo BsForm::post($url, $attributes); ?>";
        });
    }

    /**
     * Register @formpost directive.
     */
    public function registerEndFormPost(): void
    {
        $this->setCloseFormDirective('endformpost');
    }

    /**
     * Register @formget directive.
     */
    public function registerFormGet(): void
    {
        Blade::directive('formget', function ($url, $attributes = []) {
            $attributes = json_encode($attributes);

            return "<?php echo BsForm::get($url, $attributes); ?>";
        });
    }

    /**
     * Register @formget directive.
     */
    public function registerEndFormGet(): void
    {
        $this->setCloseFormDirective('endformget');
    }

    /**
     * Register @formput directive.
     */
    public function registerFormPut(): void
    {
        Blade::directive('formput', function ($url, $attributes = []) {
            $attributes = json_encode($attributes);

            return "<?php echo BsForm::put($url, $attributes); ?>";
        });
    }

    /**
     * Register @formput directive.
     */
    public function registerEndFormPut(): void
    {
        $this->setCloseFormDirective('endformput');
    }

    /**
     * Register @form directive.
     */
    public function registerForm(): void
    {
        Blade::directive('form', function ($url, $attributes = []) {
            $attributes = json_encode($attributes);

            return "<?php echo BsForm::open($url, $attributes); ?>";
        });
    }

    /**
     * Register @endform directive.
     */
    public function registerEndForm(): void
    {
        $this->setCloseFormDirective('endform');
    }

    /**
     * Register the given close form directive.
     */
    private function setCloseFormDirective(string $directive): void
    {
        Blade::directive($directive, function () {
            return "<?php echo BsForm::close(); ?>";
        });
    }
}