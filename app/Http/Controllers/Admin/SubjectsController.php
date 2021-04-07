<?php

namespace App\Http\Controllers\Admin;

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

class SubjectsController extends Controller
{
    public function show(Request $request, Subject $subject): View
    {
        $currentUser = Auth::user();
        $claimUser = $subject->lock_user_id ? User::find($subject->lock_user_id) : null;

        return view('admin.subjects.show', compact('subject', 'currentUser', 'claimUser'));
    }

    public function update(Request $request, Subject $subject): RedirectResponse
    {
        $image = $request->get('image');
        if ($image) {
            $file = FileModel::find($image);
            $subject->image = $file->file_path;
            $file->delete();
        }
        $subject->update($request->all());

        return back();
    }

    public function removeImage(Request $request, Subject $subject): RedirectResponse
    {
        File::delete($subject->getImagePath());
        $subject->image = '';
        $subject->save();

        return back();
    }

    public function claim(Request $request, Subject $subject): RedirectResponse
    {
        $subject->lock_user_id = Auth::user()->id;
        $subject->save();

        return back();
    }

    public function claimRelease(Request $request, Subject $subject): RedirectResponse
    {
        $subject->lock_user_id = null;
        $subject->save();

        return back();
    }
}
