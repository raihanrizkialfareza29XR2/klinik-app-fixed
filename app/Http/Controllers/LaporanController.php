<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Laporan;
use App\Models\Obat;
use App\Models\Pendaftaran;
use App\Models\Poli;
use App\Models\RiwayatJadwal;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = Laporan::all();
        return view('page.admin.laporan.index', compact('laporan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $id)
    {
        $laporan = Laporan::all();
        $pendaftaran = Pendaftaran::where('id', $id)->first();
        $admin = Auth::id();
        return view('page.admin.laporan.create', compact('laporan', 'pendaftaran', 'admin'));
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
        $data['id_pendaftaran'] = $request->id_pendaftaran;
        $data['id_admin'] = Auth::id();
        $create = Laporan::create($data);

        if ($create) {
            Alert::success('Pembuatan Berhasil', 'Data berhasil di buat');
            return redirect()->route('laporan.index');
        } else {
            Alert::error('Pembuatan gagal', 'Data gagal di buat');
            return redirect()->route('laporan.index');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $laporan = Laporan::where('id')->first();
        $pendaftaran = Pendaftaran::all();
        $admin = User::whereHas("roles", function($q){ $q->where("name", "admin"); })->get();
        return view('page.admin.laporan.edit', compact('laporan', 'pendaftaran', 'admin'));
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
        $laporan = Laporan::where('id', $id)->first();

        $update = $laporan->update([
            'id_admin' => Auth::id(),
            'nama_laporan' => $request->nama_laporan,
            'keterangan' => $request->keterangan,
        ]);

        if ($update) {
            Alert::success('Update Berhasil', 'Data berhasil di update');
            return redirect()->route('laporan.index');
        } else {
            Alert::error('Update gagal', 'Data gagal di update');
            return redirect()->route('laporan.index');
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
        $laporan = Laporan::where('id', $id)->first();

        $delete = $laporan->delete();

        if ($delete) {
            Alert::success('Hapus Berhasil', 'Data berhasil di hapus');
            return redirect()->route('laporan.index');
        } else {
            Alert::error('Hapus gagal', 'Data gagal di hapus');
            return redirect()->route('laporan.index');
        }

    }
}
