<?php

namespace App\Http\Controllers;

use App\Models\File as FileModel;
use File;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required', // |mimes:csv,txt,xlx,xls,pdf|max:2048
        ]);

        if (!$request->file()) {
            return response()->json([], 400);
        }

        $fileName = time() . '_' . $request->file->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

        $file = new FileModel;
        $file->name = $request->file->getClientOriginalName();
        $file->file_path = $filePath;
        $file->save();

        return response()->json(['id' => $file->id]);
    }

    public function destroy(FileModel $file): JsonResponse
    {
        File::delete($file->getFullPath());
        $file->delete();

        return response()->json(['id' => $file->id]);
    }
}
