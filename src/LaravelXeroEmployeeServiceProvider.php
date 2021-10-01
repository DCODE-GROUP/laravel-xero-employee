<?php

namespace Dcodegroup\LaravelXeroEmployee;

use Dcodegroup\LaravelXeroEmployee\Commands\DefaultUserEarningRatesCommand;
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
        $this->publishes([__DIR__ . '/../config/laravel-xero-employee.php' => config_path('laravel-xero-employee.php')], 'laravel-xero-employee-config');

        $this->app->bind(BaseXeroEmployeeService::class, function () {
            return new BaseXeroEmployeeService(resolve(Application::class));
        });
    }

    protected function offerPublishing()
    {
        $this->publishes([__DIR__ . '/../config/laravel-xero-employee.php' => config_path('laravel-xero-employee.php')], 'laravel-xero-employee-config');

        if (Schema::hasTable('users') &&
            ! Schema::hasColumns('users', [
                'xero_employee_id',
                'xero_default_payroll_calendar_id',
                'xero_default_earnings_rate_id',
                'xero_time_and_a_half_earnings_rate_id',
                'xero_double_time_earnings_rate_id',
            ])) {
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
                                DefaultUserEarningRatesCommand::class,
                            ]);
        }
    }
}
