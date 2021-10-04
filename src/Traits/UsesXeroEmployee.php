<?php

namespace Dcodegroup\LaravelXeroEmployee\Traits;

use Illuminate\Database\Eloquent\Builder;

trait UsesXeroEmployee
{
    public function scopeHasEmptyEmployeeId(Builder $query): Builder
    {
        return $query->whereNull('xero_employee_id');
    }
}
