<?php

use Dcodegroup\LaravelXeroEmployee\Http\Controllers\SyncXeroEmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/{user}', SyncXeroEmployeeController::class)->name('sync');