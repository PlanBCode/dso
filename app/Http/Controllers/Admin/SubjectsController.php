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

class SubjectsController extends Controller
{
    public function index(Request $request): View
    {
        $subjects = Subject::all();

        return view('admin.subjects.index', compact($subjects));
    }

    public function show(Request $request, Subject $subject): View
    {
        $claimable = false;
        $claimed = false;
        $editable = true;

        if ($subject->state === 'draft') {
            $claimUser = $subject->lock_user_id ? User::find($subject->lock_user_id) : null;

            $claimable = !$claimUser instanceof User;
            $claimed = !$claimable && $claimUser->id === Auth::user()->id;
            $editable = $claimed;
        }

        return view('admin.subjects.show', compact('subject', 'editable', 'claimable', 'claimed'));
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

    public function accept(Request $request, Subject $subject): RedirectResponse
    {
        $mailSubject = $request->get('subject');
        $mailContent = $request->get('message');

        AcceptWithMail::dispatch($subject, true, $mailSubject, $mailContent);

        return back();
    }

    public function reject(Request $request, Subject $subject): RedirectResponse
    {
        $mailSubject = $request->get('subject');
        $mailContent = $request->get('message');

        AcceptWithMail::dispatch($subject, false, $mailSubject, $mailContent);

        return back();
    }

    public function claim(Request $request, Subject $subject): RedirectResponse
    {
        if (!$subject->lock_user_id) {
            $subject->lock_user_id = Auth::user()->id;
            $subject->save();
        }

        return back();
    }

    public function claimRelease(Request $request, Subject $subject): RedirectResponse
    {
        $subject->lock_user_id = null;
        $subject->save();

        return back();
    }
}
