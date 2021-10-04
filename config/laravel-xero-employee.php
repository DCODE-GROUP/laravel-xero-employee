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
    | Laravel Xero Payroll AU Job Queue
    |--------------------------------------------------------------------------
    |
    | This will allow you to configure queue to use for background jobs
    |
    */
    'queue' => env('LARAVEL_XERO_EMPLOYEE_QUEUE', 'default'),


];