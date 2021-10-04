<?php

namespace Dcodegroup\LaravelXeroEmployee\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncAllXeroEmployees implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->queue = config('laravel-xero-employee.queue');
    }

    public function handle()
    {
        $xeroModelClass = config('laravel-xero-employee.employee_model');

        $models = $xeroModelClass::hasEmptyEmployeeId()->get();

        $models->each(function ($model) {
            SyncXeroEmployee::dispatch($model);
        });
    }

}
