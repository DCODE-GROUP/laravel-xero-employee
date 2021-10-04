<?php

namespace Dcodegroup\LaravelXeroEmployee\Http\Controllers;

use App\Models\User;
use Dcodegroup\LaravelXeroEmployee\Jobs\SyncXeroEmployee;
use Illuminate\Http\Request;

class SyncXeroEmployeeController
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        SyncXeroEmployee::dispatch($user);

        return response(__('Job has been dispatched to sync the employee'));
    }
}