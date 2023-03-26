<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Obat;
use App\Models\Poli;
use App\Models\RiwayatJadwal;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = Jadwal::all();
        return view('page.admin.jadwal.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jadwal = Jadwal::all();
        $poli = Poli::all();
        $dokter = User::whereHas("roles", function($q){ $q->where("name", "dokter"); })->get();
        return view('page.admin.jadwal.create', compact('jadwal', 'poli', 'dokter'));
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
        $create = Jadwal::create($data);

        if ($create) {
            Alert::success('Pembuatan Berhasil', 'Data berhasil di buat');
            return redirect()->route('jadwal.index');
        } else {
            Alert::error('Pembuatan gagal', 'Data gagal di buat');
            return redirect()->route('jadwal.index');
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
        $jadwal = Jadwal::where('id')->first();
        $poli = Poli::all();
        $dokter = User::whereHas("roles", function($q){ $q->where("name", "dokter"); })->get();
        return view('page.admin.jadwal.edit', compact('jadwal', 'poli', 'dokter'));
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
        $jadwal = Jadwal::where('id', $id)->first();

        $update = $jadwal->update([
            'id_dokter' => $request->id_dokter,
            'id_poli' => $request->id_poli,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        if ($update) {
            Alert::success('Update Berhasil', 'Data berhasil di update');
            return redirect()->route('jadwal.index');
        } else {
            Alert::error('Update gagal', 'Data gagal di update');
            return redirect()->route('jadwal.index');
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
        $jadwal = Jadwal::where('id', $id)->first();

        $delete = $jadwal->delete();

        if ($delete) {
            Alert::success('Hapus Berhasil', 'Data berhasil di hapus');
            return redirect()->route('jadwal.index');
        } else {
            Alert::error('Hapus gagal', 'Data gagal di hapus');
            return redirect()->route('jadwal.index');
        }

    }
}
