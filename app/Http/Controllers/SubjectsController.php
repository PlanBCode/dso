<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function show(Request $request, Subject $subject): View
    {
        // get previous user id
        $previous = Subject::where('id', '<', $subject->id)->where('state', '=', $subject->state)->max('id');

        // get next user id
        $next = Subject::where('id', '>', $subject->id)->where('state', '=', $subject->state)->min('id');

        return view('subjects.show', compact('subject', 'previous', 'next'));
    }

    public function store(Request $request): Response
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'short_description' => 'required',
            'description' => 'required',
        ]);

        Subject::create($data);

        return response()->make('content', 200);
    }
}
