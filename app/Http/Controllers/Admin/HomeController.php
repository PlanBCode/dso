<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function show(Request $request): View
    {
        return view('admin.main');
    }

    public function updateApplication()
    {
        Artisan::call('application:update');

        return redirect()->route('admin-home');
    }
}
