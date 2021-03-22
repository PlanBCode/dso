<?php

namespace App\Http\Middleware;

use App\Models\Subject as SubjectModel;
use Closure;
use Illuminate\Http\Request;
use View;

class Subject
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
        $subjects = SubjectModel::all();
        $viewData = [
            'subjects' => $subjects,
        ];

        View::share($viewData);

        return $next($request);
    }
}
