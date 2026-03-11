<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Divisi;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
   public function index(Request $request)
{
    $query = AuditLog::with(['user','divisi']);

   
    if ($request->search) {
        $query->whereHas('divisi', function($q) use ($request){
            $q->where('nama_divisi','like','%'.$request->search.'%');
        });
    }

    $logs = $query->latest()->get();

    return view('audit.index', compact('logs'));
}
}