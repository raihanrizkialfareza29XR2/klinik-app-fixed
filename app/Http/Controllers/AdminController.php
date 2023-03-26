<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = User::whereHas("roles", function($q){ $q->where("name", "admin"); })->get();
        return view('page.admin.admin.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $poli = Poli::all();
        return view('page.admin.admin.create', compact('poli'));
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

        $useradmin = User::create(array_merge([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
        ], $defval));

        if ($useradmin) {
            $useradmin->assignRole('admin');
            Alert::success('Berhasil', 'Data admin berhasil di buat');
            return redirect()->route('admin.index');
        } else {
            Alert::success('Gagal', 'Data admin Gagal di buat');
            return redirect()->route('admin.index');
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
        $admin = User::where('id', $id)->first();
        $poli = Poli::all();

        return view('page.admin.admin.edit', compact('admin', 'poli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = User::where('id', $id)->first();
        $defval = [
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];

        if ($request->password != null) {
            $useradmin = $admin->update([
                'email' => $request->email,
                'nama' => $request->nama,
                'password' => bcrypt($request->password),
            ]);
        } else {
            $useradmin = $admin->update([
                'email' => $request->email,
                'nama' => $request->nama,
            ]);
        }


        if ($useradmin) {
            Alert::success('Berhasil', 'Data admin berhasil di ubah');
            return redirect()->route('admin.index');
        } else {
            Alert::success('Gagal', 'Data admin Gagal di ubah');
            return redirect()->route('admin.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::where('id', $id)->first();
        $delete = $admin->delete();

        if ($delete) {
            Alert::success('Berhasil', 'Data admin berhasil di hapus');
            return redirect()->route('admin.index');
        } else {
            Alert::success('Gagal', 'Data admin gagal di hapus');
            return redirect()->route('admin.index');
        }

    }
}
