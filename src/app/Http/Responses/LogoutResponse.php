<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract 
{
    /**
     * Create a new class instance.
     */
    public function toResponse($request)
    {
        return redirect('/login');
    }
}
