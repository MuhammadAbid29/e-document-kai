<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DivisiController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;

        $divisi = Divisi::when($search,function($query) use ($search){

            $query->where('nama_divisi','like',"%$search%");

        })->orderBy('id','desc')->get();


        return view('divisi.index',compact('divisi','search'));
    }


    public function store(Request $request)
{
    $request->validate([
        'nama_divisi' => 'required'
    ]);


    $nama = strtoupper($request->nama_divisi);


    // ambil singkatan
    $kata = explode(' ', $nama);

    if(count($kata) == 1)
    {
        $singkatan = substr($kata[0],0,3);
    }
    else
    {
        $singkatan = '';
        foreach($kata as $k)
        {
            $singkatan .= substr($k,0,1);
        }
    }


    // hitung jumlah divisi dengan singkatan sama
    $jumlah = Divisi::where('kode_divisi','like',"DIV-$singkatan-%")->count() + 1;


    $nomor = str_pad($jumlah,2,'0',STR_PAD_LEFT);


    $kode = "DIV-$singkatan-$nomor";


    Divisi::create([

        'kode_divisi' => $kode,

        'nama_divisi' => $request->nama_divisi,

        'deskripsi' => $request->deskripsi,

        'status' => $request->status ?? 'Aktif'

    ]);


    return back();
}



    public function update(Request $request,$id)
    {

        $divisi = Divisi::findOrFail($id);

        $divisi->update([

            'nama_divisi'=>$request->nama_divisi,

            'deskripsi'=>$request->deskripsi,

            'status'=>$request->status

        ]);


        return back();
    }

public function destroy($id)
{
    Divisi::findOrFail($id)->delete();

    return back()->with('success','Data berhasil dihapus');
}
}