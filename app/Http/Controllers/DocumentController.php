<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Document;
use App\Models\Divisi;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /*
    =========================
    HALAMAN UTAMA DOKUMEN
    =========================
    */

public function index($divisi_id = null, $folder_id = null)
{
    $divisi = Divisi::all();

    $currentDivisi = $divisi_id
        ? Divisi::findOrFail($divisi_id)
        : null;

    $currentFolder = $folder_id
        ? Folder::with('children.documents')->findOrFail($folder_id)
        : null;

    
    $folders = Folder::whereNull('parent_id')
        ->when($divisi_id, fn($q) => $q->where('divisi_id', $divisi_id))
        ->with('children')
        ->get();

   
    $subfolders = $currentFolder
        ? $currentFolder->children
        : collect();

    $documents = collect();

if ($currentFolder) {
    $documents = $currentFolder->documents()
        ->when(request('search'), function ($q) {
            $q->where('name', 'like', '%' . request('search') . '%');
        })
        ->get();
}

    return view('dokumen.index', compact(
        'divisi',
        'currentDivisi',
        'currentFolder',
        'folders',
        'subfolders',
        'documents'
    ));
}

    /*
    =========================
    BUAT FOLDER
    =========================
    */
    public function storeFolder(Request $request)
{
    $request->validate([
        'name' => 'required',
        'divisi_id' => 'required'
    ]);


    $folder = Folder::create([
        'name' => $request->name,
        'divisi_id' => $request->divisi_id,
        'parent_id' => $request->parent_id,
        'created_by' => Auth::id()
    ]);

   
    return redirect()->route('dokumen.index', [
        'divisi_id' => $request->divisi_id,
        'folder_id' => $request->parent_id
    ]);
}


    /*
    =========================
    RENAME FOLDER
    =========================
    */
    public function renameFolder(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $folder = Folder::findOrFail($id);
        $folder->update([
            'name' => $request->name
        ]);

        return back();
    }


    /*
    =========================
    HAPUS FOLDER
    =========================
    */
    public function deleteFolder($id)
{
    $folder = Folder::findOrFail($id);

    $divisiId = $folder->divisi_id;

    AuditLog::create([
    'user_id' => auth()->id(),
    'action' => 'Delete Folder',
    'target' => $folder->name,
    'divisi_id' => $folder->divisi_id,
]);

    $folder->delete();

    return redirect()->route('dokumen.index', [
        'divisi_id' => $divisiId
    ]);
}


    /*
    =========================
    UPLOAD FILE
    =========================
    */
   public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|file|max:10240',
        'folder_id' => 'required'
    ]);

    $file = $request->file('file');

    $folder = Folder::findOrFail($request->folder_id);

    $path = $file->store('documents','public');

    $document = Document::create([
        'name' => $file->getClientOriginalName(),
        'file_path' => $path,
        'file_size' => round($file->getSize() / 1024 / 1024,2).' MB',
        'folder_id' => $folder->id,
        'uploaded_by' => Auth::id()
    ]);

    // ✅ Audit Log
    AuditLog::create([
        'user_id' => auth()->id(),
        'action' => 'Upload File',
        'target' => $document->name,
        'divisi_id' => $folder->divisi_id,
    ]);

    return back();
}


    /*
    =========================
    DELETE FILE
    =========================
    */
    public function deleteFile($id)
{
    $doc = Document::findOrFail($id);

    // audit log
    AuditLog::create([
        'user_id' => auth()->id(),
        'action' => 'Delete File',
        'target' => $doc->name,
        'divisi_id' => $doc->folder->divisi_id ?? null,
    ]);

    $doc->delete(); 

    return back();
}
    
}