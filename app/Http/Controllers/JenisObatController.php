<?php

namespace App\Http\Controllers;

use App\Models\JenisObat;
use App\Models\Obat;
use App\Models\Poli;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class JenisObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_obat = JenisObat::all();
        return view('page.admin.jenis.index', compact('jenis_obat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_obat = JenisObat::all();
        return view('page.admin.jenis.create', compact('jenis_obat'));
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
        $create = JenisObat::create($data);

        if ($create) {
            Alert::success('Pembuatan Berhasil', 'Data berhasil di buat');
            return redirect()->route('jenis.index');
        } else {
            Alert::error('Pembuatan gagal', 'Data gagal di buat');
            return redirect()->route('jenis.index');
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
        $jenis_obat = JenisObat::where('id', $id)->first();
        return view('page.admin.jenis.edit', compact('jenis_obat'));
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
        $jenis_obat = JenisObat::where('id', $id)->first();

        $update = $jenis_obat->update([
            'nama_jenis' => $request->nama_jenis,
        ]);

        if ($update) {
            Alert::success('Update Berhasil', 'Data berhasil di update');
            return redirect()->route('jenis.index');
        } else {
            Alert::error('Update gagal', 'Data gagal di update');
            return redirect()->route('jenis.index');
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
        $jenis_obat = JenisObat::where('id', $id)->first();

        $delete = $jenis_obat->delete();

        if ($delete) {
            Alert::success('Hapus Berhasil', 'Data berhasil di hapus');
            return redirect()->route('jenis.index');
        } else {
            Alert::error('Hapus gagal', 'Data gagal di hapus');
            return redirect()->route('jenis.index');
        }

    }
}
