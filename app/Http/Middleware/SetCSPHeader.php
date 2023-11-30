<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetCSPHeader
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
        $response = $next($request);
        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.google-analytics.com; style-src 'self' 'unsafe-inline'; img-src 'self' https://www.google-analytics.com; font-src 'self'; connect-src 'self' https://www.google-analytics.com; frame-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'self'; manifest-src 'self'; media-src 'self'; prefetch-src 'self'; worker-src 'self'; upgrade-insecure-requests; block-all-mixed-content; disown-opener; sandbox allow-forms allow-same-origin allow-scripts allow-popups allow-modals allow-downloads;"
        );
        return $next($request);
    }
}
