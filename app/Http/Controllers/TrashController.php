<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
class TrashController extends Controller
{

public function index()
{
    $files = Document::onlyTrashed()->with('folder')->get();

    return view('trash.index', compact('files'));
}

public function restore($id)
{
    $file = Document::onlyTrashed()->findOrFail($id);

    $file->restore();

    return back();
}

public function forceDelete($id)
{
    $file = Document::onlyTrashed()->findOrFail($id);

    Storage::disk('public')->delete($file->file_path);

    $file->forceDelete();

    return back();
}

}
