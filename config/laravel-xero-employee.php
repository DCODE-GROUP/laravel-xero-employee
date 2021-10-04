<?php

return [

    /*
     |
     | Specify the model which is being used to link Xero employees to the app.
     | Generally this will be the User model
     |
     */
    'employee_model' => env('LARAVEL_XERO_EMPLOYEE_MODEL', App\Models\User::class),

    /*
    |--------------------------------------------------------------------------
    | Laravel Xero Employee Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Laravel Xero Employee will be accessible from. Feel free
    | to change this path to anything you like.
    |
    */

    'path' => env('LARAVEL_XERO_EMPLOYEE_PATH', 'xero-employee'),

    /*
    |--------------------------------------------------------------------------
    | Laravel Xero Employee Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will get attached onto each Laravel Xero Employee route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => [
        'web',
        'auth',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Xero Payroll AU Job Queue
    |--------------------------------------------------------------------------
    |
    | This will allow you to configure queue to use for background jobs
    |
    */

    'queue' => env('LARAVEL_XERO_EMPLOYEE_QUEUE', 'default'),

];