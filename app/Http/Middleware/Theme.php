<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use View;

class Theme
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $dark = config('view.theme.dark');
        $viewData = [
            'dark' => $dark,
            'darkPrefix' => $dark ? 'dark' : '',
        ];

        View::share($viewData);

        return $next($request);
    }
}
