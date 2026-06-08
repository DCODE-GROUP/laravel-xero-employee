<?php

namespace Dcodegroup\LaravelXeroEmployee\Http\Controllers;

use App\Models\User;
use Dcodegroup\LaravelXeroEmployee\Jobs\SyncXeroEmployee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SyncXeroEmployeeController
{
    /**
     * @return Application|ResponseFactory|Response
     */
    public function __invoke(Request $request, User $user)
    {
        SyncXeroEmployee::dispatch($user);

        return response(__('Job has been dispatched to sync the employee'));
    }
}
