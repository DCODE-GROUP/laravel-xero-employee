<?php

namespace Dcodegroup\LaravelXeroEmployee;

use Dcodegroup\LaravelXeroOauth\BaseXeroService;
use Dcodegroup\LaravelXeroPayrollAu\BaseXeroPayrollAuService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use XeroPHP\Application;
use XeroPHP\Models\PayrollAU\Employee;

class BaseXeroEmployeeService extends BaseXeroService
{
    protected BaseXeroPayrollAuService $payrollService;

    public function __construct(Application $xeroClient)
    {
        parent::__construct($xeroClient);
        $this->payrollService = resolve(BaseXeroPayrollAuService::class);
    }

    public function getEmployeeByEmail(string $email)
    {
        return $this->searchModel(Employee::class, [
            'Email' => urlencode($email),
        ]);
    }

    public function syncXeroEmployee(Model $user)
    {
        try {
            $employee = $this->getEmployeeByEmail($user->email);

            if ($employee instanceof Employee) {
                $user->xero_employee_id = $employee->getEmployeeID();
                $user->xero_default_earnings_rate_id = $employee->getOrdinaryEarningsRateID();
                $user->xero_default_payroll_calendar_id = $employee->getPayrollCalendarID();
                $user->save();
            } else {
                // not found so clear what is stored
                logger('employee not found with email: '.$user->email);
                $user->update([
                    'xero_employee_id' => null,
                ]);
            }
        } catch (\XeroPHP\Remote\Exception\NotFoundException $e) {
            if (! app()->isProduction()) {
                // not found so clear what is stored
                logger('employee not found with email: '.$user->email);
                $user->update([
                    'xero_employee_id' => null,
                ]);
            }

            return false;
        } catch (Exception $e) {
            Log::error('Employee not found in xero syncXeroEmployee error: '.$e->getMessage());
            report($e);

            return false;
        }

        return true;
    }
}
