<?php

namespace App\Http\Controllers;

use App\Models\Assistant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssistantsController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'know_what_to_do' => 'required|in:0,1',
            'what_to_do' => '',
            'agree_to_terms' => 'accepted',
        ]);

        $data = $request->all();
        $data['agree_to_terms'] = true;
        $data['email_confirmation_code'] = (string)Str::uuid();

        $assistant = Assistant::create($data);

        return response()->json(['ok']);
    }

    public function confirmEmail(Request $request, Assistant $assistant): View
    {
        $code = $request->get('code');
        if ($assistant->email_confirmation_code !== $code) {
            abort(404);
        }

        if (!$assistant->email_confirmed) {
            $assistant->email_confirmed = true;
            $assistant->save();
        }

        return view('subject_suggestions.confirm-email');
    }
}
