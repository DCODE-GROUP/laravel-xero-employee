<?php

namespace Dcodegroup\LaravelXeroEmployee\Jobs;

use Dcodegroup\LaravelXeroEmployee\BaseXeroEmployeeService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncXeroEmployee implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected Model $model;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->queue = config('laravel-xero-employee.queue');
        $this->model = $model;
    }

    public function handle()
    {
        $service = resolve(BaseXeroEmployeeService::class);

        $service->syncXeroEmployee($this->model);
    }
}
