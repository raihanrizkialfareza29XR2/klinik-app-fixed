<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokter = User::whereHas("roles", function($q){ $q->where("name", "dokter"); })->get();
        return view('page.admin.dokter.index', compact('dokter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $poli = Poli::all();
        return view('page.admin.dokter.create', compact('poli'));
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

        $userdokter = User::create(array_merge([
            'email' => $request->email,
            'nama' => $request->nama,
            'spesialis' => $request->spesialis,
            'id_poli' => $request->id_poli,
            'biaya_dokter' => $request->biaya_dokter,
            'password' => bcrypt($request->password),
        ], $defval));

        if ($userdokter) {
            $userdokter->assignRole('dokter');
            Alert::success('Berhasil', 'Data dokter berhasil di buat');
            return redirect()->route('dokter.index');
        } else {
            Alert::success('Gagal', 'Data dokter Gagal di buat');
            return redirect()->route('dokter.index');
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
        $dokter = User::where('id', $id)->first();
        $poli = Poli::all();
        return view('page.admin.dokter.edit', compact('dokter', 'poli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dokter = User::where('id', $id);
        $defval = [
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];

        if ($request->password != null) {
            $userdokter = $dokter->update([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'nama' => $request->nama,
                'id_poli' => $request->id_poli,
                'biaya_dokter' => $request->biaya_dokter,
                'spesialis' => $request->spesialis,
            ]);
        } else {
            $userdokter = $dokter->update([
                'email' => $request->email,
                'nama' => $request->nama,
                'id_poli' => $request->id_poli,
                'biaya_dokter' => $request->biaya_dokter,
                'spesialis' => $request->spesialis,
            ]);
        }


        if ($userdokter) {
            Alert::success('Berhasil', 'Data dokter berhasil di ubah');
            return redirect()->route('dokter.index');
        } else {
            Alert::success('Gagal', 'Data dokter Gagal di ubah');
            return redirect()->route('dokter.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dokter = User::where('id', $id)->first();
        $delete = $dokter->delete();

        if ($delete) {
            Alert::success('Berhasil', 'Data dokter berhasil di hapus');
            return redirect()->route('dokter.index');
        } else {
            Alert::success('Gagal', 'Data dokter gagal di hapus');
            return redirect()->route('dokter.index');
        }

    }
}
