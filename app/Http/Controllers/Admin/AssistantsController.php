<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assistant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssistantsController extends Controller
{
    public function index(Request $request): View
    {
        $assistants = Assistant::where('email_confirmed', '=', true)->get();

        return view('admin.assistants.index', compact('assistants'));
    }

    public function show(Request $request, Assistant $assistant): View
    {
        return view('admin.assistants.show', compact('assistant'));
    }
}
