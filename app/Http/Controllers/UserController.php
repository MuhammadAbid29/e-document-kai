<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // =========================
    // TAMPIL HALAMAN AKUN
    // =========================
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::with('divisi')
            ->where('role', 'user')
            ->when($search, function ($query) use ($search) {

                $query->where('nip', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhereHas('divisi', function ($q) use ($search) {

                        $q->where('nama_divisi', 'like', "%$search%");

                    });

            })
            ->get();

        $divisi = Divisi::all();

        return view('akun.index', compact('users', 'divisi', 'search'));
    }



    // =========================
    // SIMPAN AKUN BARU
    // =========================
    public function store(Request $request)
    {

        $request->validate([
            'nip' => 'required|unique:users,nip',
            'name' => 'required',
            'password' => 'required',
            'divisi_id' => 'required',
        ]);


        User::create([

            'nip' => $request->nip,

            'name' => $request->name,

            // email otomatis dari nip
            'email' => $request->nip . '@kai.local',

            'password' => Hash::make($request->password),

            'role' => 'user',

            'divisi_id' => $request->divisi_id,

        ]);


        return back()->with('success', 'Akun berhasil dibuat');

    }



    // =========================
    // UPDATE AKUN
    // =========================
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);


        $request->validate([
            'nip' => 'required|unique:users,nip,' . $id,
            'name' => 'required',
            'divisi_id' => 'required',
        ]);


        $user->update([

            'nip' => $request->nip,

            'name' => $request->name,

            // update email juga
            'email' => $request->nip . '@kai.local',

            'divisi_id' => $request->divisi_id,

        ]);


        if ($request->password) {

            $user->update([
                'password' => Hash::make($request->password)
            ]);

        }


        return back()->with('success', 'Akun berhasil diupdate');

    }



    // =========================
    // HAPUS AKUN
    // =========================
    public function destroy($id)
    {

        User::findOrFail($id)->delete();

        return back()->with('success', 'Akun berhasil dihapus');

    }

}