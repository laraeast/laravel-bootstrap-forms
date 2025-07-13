<?php

use Laraeast\LaravelBootstrapForms\Enums\Country;

return [
    /**
     * The path of form components views.
     *
     * - 'BsForm::bootstrap5'  - Bootstrap 5
     * - 'BsForm::bootstrap4'  - Bootstrap 4
     * - 'BsForm::bootstrap3'  - Bootstrap 3
     */
    'views' => 'BsForm::bootstrap5',

    /**
     * The default form style to be used.
     * Supported values: 'default', 'horizontal'
     */
    'default_style' => 'default',

    'checkboxes' => [
        /**
         * If the checkbox was unchecked will send default value with request.
         * The default value is "0" you can change it from "default($value = 0)" method
         */
        'hasDefaultValue' => true,
    ],

    'phone' => [
        /**
         * The list of supported countries that will be displayed in phone input.
         *
         * If you want to use all countries, You can use Country::all(),
         */
        'countries' => [
            Country::SA,
            Country::KW,
            Country::IQ,
            Country::AE,
            Country::BH,
            Country::EG,
        ],

        /**
         * The format of countries list.
         *
         * Examples:
         * "{FLAG} {COUNTRY_CODE} ({DEAL_CODE})" => "🇸🇦 SA (+966)"
         * "{FLAG} {COUNTRY_NAME} ({DEAL_CODE})" => "🇸🇦 Saudi Arabia (+966)"
         */
        'countries_list_format' => '{FLAG} {COUNTRY_CODE} ({DEAL_CODE})',
    ],

    'attachment' => [
        'icons' => [
            /**
             * The route of the icon preview.
             */
            'route' => '/laravel-bootstrap-forms/icon',

            /**
             * Customize mime types icons. Accepts URLs.
             *
             * Example: ['application/pdf' => '/images/icons/pdf.png']
             */
            'mime-types' => [],
        ],
    ],
];
