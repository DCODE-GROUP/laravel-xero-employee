<?php

namespace Dcodegroup\LaravelXeroEmployee\Jobs;

use Dcodegroup\LaravelXeroEmployee\BaseXeroEmployeeService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncXeroEmployee implements ShouldQueue
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
        $service = resolve(BaseXeroEmployeeService::class);


    }
}
