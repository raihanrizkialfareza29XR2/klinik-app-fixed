<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ApotekerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apoteker = User::whereHas("roles", function($q){ $q->where("name", "apoteker"); })->get();
        return view('page.admin.apoteker.index', compact('apoteker'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $poli = Poli::all();
        return view('page.admin.apoteker.create', compact('poli'));
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

        $userapoteker = User::create(array_merge([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
        ], $defval));

        if ($userapoteker) {
            $userapoteker->assignRole('apoteker');
            Alert::success('Berhasil', 'Data apoteker berhasil di buat');
            return redirect()->route('apoteker.index');
        } else {
            Alert::success('Gagal', 'Data apoteker Gagal di buat');
            return redirect()->route('apoteker.index');
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
        $apoteker = User::where('id', $id)->first();
        $poli = Poli::all();

        return view('page.admin.apoteker.edit', compact('apoteker', 'poli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $apoteker = User::where('id', $id)->first();
        $defval = [
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];

        if ($request->password != null) {
            $userapoteker = $apoteker->update([
                'email' => $request->email,
                'nama' => $request->nama,
                'password' => bcrypt($request->password),
            ]);
        } else {
            $userapoteker = $apoteker->update([
                'email' => $request->email,
                'nama' => $request->nama,
            ]);
        }


        if ($userapoteker) {
            Alert::success('Berhasil', 'Data apoteker berhasil di ubah');
            return redirect()->route('apoteker.index');
        } else {
            Alert::success('Gagal', 'Data apoteker Gagal di ubah');
            return redirect()->route('apoteker.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $apoteker = User::where('id', $id)->first();
        $delete = $apoteker->delete();

        if ($delete) {
            Alert::success('Berhasil', 'Data apoteker berhasil di hapus');
            return redirect()->route('apoteker.index');
        } else {
            Alert::success('Gagal', 'Data apoteker gagal di hapus');
            return redirect()->route('apoteker.index');
        }

    }
}
