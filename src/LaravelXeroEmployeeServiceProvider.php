<?php

namespace Dcodegroup\LaravelXeroEmployee;

use Dcodegroup\LaravelXeroEmployee\Commands\InstallCommand;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use XeroPHP\Application;

class LaravelXeroEmployeeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->offerPublishing();
        $this->registerCommands();
    }

    public function register()
    {
        $this->app->bind(BaseXeroEmployeeService::class, function () {
            return new BaseXeroEmployeeService(resolve(Application::class));
        });
    }

    protected function offerPublishing()
    {
        if (Schema::hasTable('users') && ! class_exists('AddXeroEmployeeFieldsToUsersTable')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                                 __DIR__ . '/../database/migrations/add_xero_employee_fields_to_users_table.stub.php' => database_path('migrations/' . $timestamp . '_add_xero_employee_fields_to_users_table.php'),
                             ], 'laravel-xero-employee-migrations');
        }
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                                InstallCommand::class,
                            ]);
        }
    }
}
