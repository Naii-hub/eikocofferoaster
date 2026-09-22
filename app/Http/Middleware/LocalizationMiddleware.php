<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', $request->cookie('locale'));

        if (in_array($locale, ['id', 'en'])) {
            app()->setLocale($locale);
        } else {
            app()->setLocale('id');
        }

        return $next($request);
    }
}