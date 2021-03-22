<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use File;
use App\Models\File as FileModel;
use App\Models\Subject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function show(Request $request, Subject $subject): View
    {
        return view('admin.subjects.show', compact('subject'));
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
}
