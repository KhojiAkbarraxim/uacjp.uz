<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->cookie(config('i18n.cookie'));

        if (! array_key_exists($locale, config('i18n.locales'))) {
            $locale = config('i18n.default');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
