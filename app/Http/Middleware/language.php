<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $language = session()->get('language', config('app.locale'));
        switch ($language) {
            case 'en':
                $language = 'en';
                break;

            default:
                $language = 'vi';
                break;
        }
        App::setLocale($language);

        return $next($request);
    }
}
