<?php

namespace App\Http\Controllers;

use App\Models\JenisObat;
use App\Models\KategoriObat;
use App\Models\Obat;
use App\Models\Poli;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class KategoriObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori_obat = KategoriObat::all();
        return view('page.admin.kategori.index', compact('kategori_obat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori_obat = KategoriObat::all();
        return view('page.admin.kategori.create', compact('kategori_obat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $create = KategoriObat::create($data);

        if ($create) {
            Alert::success('Pembuatan Berhasil', 'Data berhasil di buat');
            return redirect()->route('kategori.index');
        } else {
            Alert::error('Pembuatan gagal', 'Data gagal di buat');
            return redirect()->route('kategori.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori_obat = KategoriObat::where('id', $id)->first();
        return view('page.admin.kategori.edit', compact('kategori_obat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kategori_obat = KategoriObat::where('id', $id)->first();

        $update = $kategori_obat->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        if ($update) {
            Alert::success('Update Berhasil', 'Data berhasil di update');
            return redirect()->route('kategori.index');
        } else {
            Alert::error('Update gagal', 'Data gagal di update');
            return redirect()->route('kategori.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori_obat = KategoriObat::where('id', $id)->first();

        $delete = $kategori_obat->delete();

        if ($delete) {
            Alert::success('Hapus Berhasil', 'Data berhasil di hapus');
            return redirect()->route('kategori.index');
        } else {
            Alert::error('Hapus gagal', 'Data gagal di hapus');
            return redirect()->route('kategori.index');
        }

    }
}
