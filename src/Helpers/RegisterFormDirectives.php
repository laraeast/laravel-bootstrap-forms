<?php

namespace Laraeast\LaravelBootstrapForms\Helpers;

use Illuminate\Support\Facades\Config;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Blade;

class RegisterFormDirectives
{
    /**
     * Register @bsMultilangualFormTabs directive.
     *
     * @return void
     */
    public function registerMultilangualFormTabs()
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
     *
     * @return void
     */
    public function registerEndMultilangualFormTabs()
    {
        Blade::directive('endBsMultilangualFormTabs', function () {
            return '<?php $__env->stopPush(); endforeach; BsForm::locale(null); $__env->popLoop(); $loop = $__env->getLastLoop(); echo $__env->renderComponent(); ?>';
        });
    }

    /**
     * Register @multilangualForm directive.
     *
     * @return void
     */
    public function registerMultilangualForm()
    {
        Blade::directive('multilangualForm', function () {
            $initLoop = "\$__currentLoopData = BsForm::getLocales(); \$__env->addLoop(\$__currentLoopData);";

            $iterateLoop = '$__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); BsForm::locale($locale);';

            return "<?php {$initLoop} foreach(\$__currentLoopData as \$locale): {$iterateLoop} ?>";
        });
    }

    /**
     * Register @endMultilangualForm directive.
     *
     * @return void
     */
    public function registerEndMultilangualForm()
    {
        Blade::directive('endMultilangualForm', function () {
            return '<?php endforeach; BsForm::locale(null); $__env->popLoop(); $loop = $__env->getLastLoop(); ?>';
        });
    }

    /**
     * Register @formpost directive.
     *
     * @return void
     */
    public function registerFormPost()
    {
        Blade::directive('formpost', function ($url, $attributes = []) {
            $attributes = json_encode($attributes);

            return "<?php echo BsForm::post($url, $attributes); ?>";
        });
    }

    /**
     * Register @formpost directive.
     *
     * @return void
     */
    public function registerEndFormPost()
    {
        return $this->setCloseFormDirective('endformpost');
    }

    /**
     * Register @formget directive.
     *
     * @return void
     */
    public function registerFormGet()
    {
        Blade::directive('formget', function ($url, $attributes = []) {
            $attributes = json_encode($attributes);

            return "<?php echo BsForm::get($url, $attributes); ?>";
        });
    }

    /**
     * Register @formget directive.
     *
     * @return void
     */
    public function registerEndFormGet()
    {
        return $this->setCloseFormDirective('endformget');
    }

    /**
     * Register @formput directive.
     *
     * @return void
     */
    public function registerFormPut()
    {
        Blade::directive('formput', function ($url, $attributes = []) {
            $attributes = json_encode($attributes);

            return "<?php echo BsForm::put($url, $attributes); ?>";
        });
    }

    /**
     * Register @formput directive.
     *
     * @return void
     */
    public function registerEndFormPut()
    {
        return $this->setCloseFormDirective('endformput');
    }

    /**
     * Register @form directive.
     *
     * @return void
     */
    public function registerForm()
    {
        Blade::directive('form', function ($url, $attributes = []) {
            $attributes = json_encode($attributes);

            return "<?php echo BsForm::open($url, $attributes); ?>";
        });
    }

    /**
     * Register @endform directive.
     *
     * @return void
     */
    public function registerEndForm()
    {
        return $this->setCloseFormDirective('endform');
    }

    /**
     * Register the given close form directive.
     *
     * @return void
     */
    private function setCloseFormDirective($directive)
    {
        Blade::directive($directive, function () {
            return "<?php echo BsForm::close(); ?>";
        });
    }
}