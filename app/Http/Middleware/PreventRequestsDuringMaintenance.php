<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as BaseMiddleware;

class PreventRequestsDuringMaintenance extends BaseMiddleware
{
    public function handle($request, \Closure $next)
    {
        if (app()->isDownForMaintenance()) {
            $data = json_decode(file_get_contents(storage_path('framework/down')), true);

            return response()->view('errors.503', [
                'retryAfter' => $data['retry'] ?? 3600,
            ], 503);
        }

        return $next($request);
    }
}