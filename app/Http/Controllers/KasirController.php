<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kasir = User::whereHas("roles", function($q){ $q->where("name", "kasir"); })->get();
        return view('page.admin.kasir.index', compact('kasir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $poli = Poli::all();
        return view('page.admin.kasir.create', compact('poli'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $defval = [
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];

        $userkasir = User::create(array_merge([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
        ], $defval));

        if ($userkasir) {
            $userkasir->assignRole('kasir');
            Alert::success('Berhasil', 'Data kasir berhasil di buat');
            return redirect()->route('kasir.index');
        } else {
            Alert::success('Gagal', 'Data kasir Gagal di buat');
            return redirect()->route('kasir.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kasir = User::where('id', $id)->first();
        $poli = Poli::all();

        return view('page.admin.kasir.edit', compact('kasir', 'poli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kasir = User::where('id', $id)->first();
        $defval = [
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];

        if ($request->password != null) {
            $userkasir = $kasir->update([
                'email' => $request->email,
                'nama' => $request->nama,
                'password' => bcrypt($request->password),
            ]);
        } else {
            $userkasir = $kasir->update([
                'email' => $request->email,
                'nama' => $request->nama,
            ]);
        }


        if ($userkasir) {
            Alert::success('Berhasil', 'Data kasir berhasil di ubah');
            return redirect()->route('kasir.index');
        } else {
            Alert::success('Gagal', 'Data kasir Gagal di ubah');
            return redirect()->route('kasir.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kasir = User::where('id', $id)->first();
        $delete = $kasir->delete();

        if ($delete) {
            Alert::success('Berhasil', 'Data kasir berhasil di hapus');
            return redirect()->route('kasir.index');
        } else {
            Alert::success('Gagal', 'Data kasir gagal di hapus');
            return redirect()->route('kasir.index');
        }

    }
}
