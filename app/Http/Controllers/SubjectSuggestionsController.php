<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\SubjectSuggestion;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubjectSuggestionsController extends Controller
{
    public function create(Request $request): View
    {
        return view('subject_suggestions.create');
    }

    public function recreate(Request $request, SubjectSuggestion $subjectSuggestion): View
    {
        if ($request->get('email') !== $subjectSuggestion->email) {
            $subjectSuggestion = null;
        }
        return view('subject_suggestions.create', compact('subjectSuggestion'));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'importance' => 'required',
            'skills' => '',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|email|max:255',
            'agree_to_terms' => 'accepted',
            'files' => '',
        ]);

        $data = $request->all();
        $data['agree_to_terms'] = true;
        $data['email_confirmation_code'] = (string)Str::uuid();

        $subjectSuggestion = SubjectSuggestion::create($data);

        foreach (explode(',', $request->get('files', '')) as $fileId) {
            $file = File::find($fileId);
            if ($file) {
                $subjectSuggestion->files()->save($file);
            }
        }

        return response()->json(['ok']);
    }

    public function confirmEmail(Request $request, SubjectSuggestion $subjectSuggestion): View
    {
        $code = $request->get('code');
        if ($subjectSuggestion->email_confirmation_code !== $code) {
            abort(404);
        }

        if (!$subjectSuggestion->email_confirmed) {
            $subjectSuggestion->email_confirmed = true;
            $subjectSuggestion->save();
        }

        return view('subject_suggestions.confirm-email');
    }
}
