<?php

return [

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