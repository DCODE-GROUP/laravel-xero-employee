<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddXeroEmployeeFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('password', function ($table) {
                $table->string('xero_employee_id', 50)->nullable();
                $table->string('xero_default_payroll_calendar_id', 50)->nullable();
                $table->string('xero_default_earnings_rate_id', 50)->nullable();
                $table->string('xero_time_and_a_half_earnings_rate_id', 50)->nullable();
                $table->string('xero_double_time_earnings_rate_id', 50)->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'xero_employee_id',
                'xero_default_earnings_rate_id',
                'xero_time_and_a_half_earnings_rate_id',
                'xero_double_time_earnings_rate_id',
            ]);
        });
    }
}
