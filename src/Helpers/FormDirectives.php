<?php

namespace Laraeast\LaravelBootstrapForms\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Laraeast\LaravelBootstrapForms\Facades\BsForm;

class FormDirectives
{
    /**
     * Register all the form directives.
     */
    public static function register(): void
    {
        Blade::directive('multilingualFormTabs', function () {
            $uniqid = Str::ulid();

            $view = Config::get('laravel-bootstrap-forms.views').'.components.multilingual-tabs';

            $initLoop = "\$__env->startComponent('$view', ['uniqid' => '$uniqid']); \$__currentLoopData = BsForm::getLocales(); \$__env->addLoop(\$__currentLoopData);";

            $iterateLoop = "\$__env->startPush('$uniqid'.\$locale->getCode()); \$__env->incrementLoopIndices(); \$loop = \$__env->getLastLoop(); BsForm::locale(\$locale);";

            return "<?php {$initLoop} foreach(\$__currentLoopData as \$locale): {$iterateLoop} ?>";
        });

        Blade::directive('endMultilingualFormTabs', function () {
            return '<?php $__env->stopPush(); endforeach; BsForm::locale(null); $__env->popLoop(); $loop = $__env->getLastLoop(); echo $__env->renderComponent(); ?>';
        });

        Blade::directive('multilingualForm', function () {
            $initLoop = "\$__currentLoopData = BsForm::getLocales(); \$__env->addLoop(\$__currentLoopData);";

            $iterateLoop = '$__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); BsForm::locale($locale);';

            return "<?php {$initLoop} foreach(\$__currentLoopData as \$locale): {$iterateLoop} ?>";
        });

        Blade::directive('endMultilingualForm', function () {
            return '<?php endforeach; BsForm::locale(null); $__env->popLoop(); $loop = $__env->getLastLoop(); ?>';
        });
    }
}