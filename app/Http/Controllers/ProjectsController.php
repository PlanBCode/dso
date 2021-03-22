<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(Request $request): View
    {
        $newSubjects = Subject::where('state', '=', 'new')->get();
        $selectedSubjects = Subject::where('state', 'selected')->get();

        return view('main', compact('newSubjects', 'selectedSubjects'));
    }
}
