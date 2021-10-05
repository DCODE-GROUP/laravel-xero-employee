<?php

namespace Dcodegroup\LaravelXeroEmployee\Traits;

use Illuminate\Database\Eloquent\Builder;

trait UsesXeroEmployee
{
    public function scopeHasEmptyEmployeeId(Builder $query): Builder
    {
        return $query->whereNull('xero_employee_id');
    }

    public function isValidXeroEmployee(): bool
    {
        return $this->xero_employee_id
            && $this->xero_default_earnings_rate_id
            && $this->xero_time_and_a_half_earnings_rate_id
            && $this->xero_double_time_earnings_rate_id;
    }
}
