<?php

return [
    /**
     * The path of form components views.
     *
     * - 'BsForm::bootstrap5'  - Bootstrap 5
     * - 'BsForm::bootstrap4'  - Bootstrap 4
     * - 'BsForm::bootstrap3'  - Bootstrap 3
     */
    'views' => 'BsForm::bootstrap3',

    'checkboxes' => [
        /**
         * If the checkbox was unchecked will send default value with request.
         * The default value is "0" you can change it from "default($value = 0)" method
         */
        'hasDefaultValue' => true,
    ],
];
