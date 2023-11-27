<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRequest
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        app('log')->info("Request Captured", $request->all());

        return $response;
    }
}
