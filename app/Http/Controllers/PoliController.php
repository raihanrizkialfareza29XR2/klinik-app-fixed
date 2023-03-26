<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poli = Poli::all();
        return view('page.admin.poli.index', compact('poli'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $poli = Poli::all();
        return view('page.admin.poli.create', compact('poli'));
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
        $create = Poli::create($data);

        if ($create) {
            Alert::success('Pembuatan Berhasil', 'Data berhasil di buat');
            return redirect()->route('poli.index');
        } else {
            Alert::error('Pembuatan gagal', 'Data gagal di buat');
            return redirect()->route('poli.index');
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
        $poli = Poli::where('id', $id)->first();
        return view('page.admin.poli.edit', compact('poli'));
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
        $poli = Poli::where('id', $id)->first();

        $update = $poli->update([
            'nama_poli' => $request->nama_poli,
        ]);

        if ($update) {
            Alert::success('Update Berhasil', 'Data berhasil di update');
            return redirect()->route('poli.index');
        } else {
            Alert::error('Update gagal', 'Data gagal di update');
            return redirect()->route('poli.index');
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
        $poli = Poli::where('id', $id)->first();

        $delete = $poli->delete();

        if ($delete) {
            Alert::success('Hapus Berhasil', 'Data berhasil di hapus');
            return redirect()->route('poli.index');
        } else {
            Alert::error('Hapus gagal', 'Data gagal di hapus');
            return redirect()->route('poli.index');
        }

    }
}
