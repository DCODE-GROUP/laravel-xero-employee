**# Laravel Xero Timesheet Sync

This package provides the standard xero functionality for syncing Xero Employee ID with users and assigning pay rates to
users.

## Installation

You can install the package via composer:

```bash
composer require dcodegroup/laravel-xero-employee
```

Then run the install command.

```bash
php artsian laravel-xero-employee:install
```

This will publish the configuration and migrations file

Run the migrations

```bash
php artsian migrate
```

## Configuration

After running install the following fields will be added to the users table.

* xero_employee_id
* xero_default_earnings_rate_id
* xero_time_and_a_half_earnings_rate_id
* xero_double_time_earnings_rate_id

You will need to add these fields to your fillable array within the model

```php
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
                   'xero_employee_id',
                   'xero_default_payroll_calendar_id',
                   'xero_default_earnings_rate_id',
                   'xero_time_and_a_half_earnings_rate_id',
                   'xero_double_time_earnings_rate_id',
                   ...
    ];

```

The assumption is you have already synced the payroll details from the [dcodegroup/laravel-xero-payroll-au](https://github.com/dcodegroup/laravel-xero-payroll-au).

There is a second command you can use to automatically populate the fields added for earnings rate to default to those you have already configured within  [dcodegroup/laravel-xero-payroll-au](https://github.com/dcodegroup/laravel-xero-payroll-au). 
You can run this multiple times as you get new users as it will only update users that have no values.

You should add the following trait to the Users model.

```php
class User extends Authenticatable
{
    use UsesXeroEmployee;

```


