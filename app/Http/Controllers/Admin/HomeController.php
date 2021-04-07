<?php

namespace App\Http\Controllers\Admin;

use App\Events\Subject\AcceptWithMail;
use App\Http\Controllers\Controller;
use App\Models\User;
use File;
use App\Models\File as FileModel;
use App\Models\Subject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function show(Request $request): View
    {
        return view('admin.main');
    }
}
