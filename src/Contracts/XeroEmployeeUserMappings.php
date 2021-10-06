<?php

namespace Dcodegroup\LaravelXeroEmployee\Contracts;

interface XeroEmployeeUserMappings
{
    /**
     * This method must be implemented in order to have a consistent field to display the name of a user
     * the name may be a combination of fields or have different names between apps
     *
     * @return string
     */
    public function getXeroEmployeeNameAttribute(): string;
}
