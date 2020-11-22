<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Log;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $apiToken = $request->header('token');
            if (empty($apiToken)) {
                throw new \Exception('Failed to process request without token');
            }
            $user = User::where('api_token', $apiToken)->firstOrFail();
            $request->merge(['user' => $user]);
            $request->setUserResolver(function () use ($user) {
                return $user;
            });
        } catch (\Throwable $e) {
            Log::error($e);
            return response('Unauthorized', 401);
        }
        return $next($request);
    }
}
