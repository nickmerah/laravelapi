<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PreventDuplicateFormSubmission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $key = $this->makeCacheKey($request);

        if (Cache::has($key)) {
            abort(429, 'Too Many Requests');
        }

        Cache::put($key, true, 5);

        return $next($request);
    }

    private function makeCacheKey(Request $request): string
    {
        $user = $request->user();

        return md5($request->fullUrl() . '|' . ($user ? $user->id : 'guest'));
    }
}
