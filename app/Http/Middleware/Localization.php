<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Localization
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
        $locale = Session::get('locale', 'vi');
        
        if (isset($request->lang)) {
            $locale = config('constants.languages.' . $request->lang , 'vi');
        }
        
        Session::put('locale', $locale);
        App::setLocale($locale);

        return $next($request);
    }
}