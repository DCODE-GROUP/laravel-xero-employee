<?php

namespace Dcodegroup\LaravelXeroEmployee;

use Dcodegroup\LaravelXeroEmployee\Commands\DefaultUserEarningRatesCommand;
use Dcodegroup\LaravelXeroEmployee\Commands\InstallCommand;
use Dcodegroup\LaravelXeroEmployee\Observers\XeroEmployeeObserver;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use XeroPHP\Application;

class LaravelXeroEmployeeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->offerPublishing();
        $this->registerCommands();

        $employeeClass = config('laravel-xero-employee.employee_model');
        $employeeClass::observe(new XeroEmployeeObserver());

        $this->registerRoutes();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-xero-employee.php', 'laravel-xero-employee');

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

    protected function registerRoutes()
    {
        Route::group([
                         'prefix' => config('laravel-xero-employee.path'),
                         'as' => Str::slug(config('laravel-xero-employee.path'), '_') . '.',
                         'middleware' => config('laravel-xero-employee.middleware', 'web'),
                     ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/laravel_xero_employee.php');
        });
    }
}
