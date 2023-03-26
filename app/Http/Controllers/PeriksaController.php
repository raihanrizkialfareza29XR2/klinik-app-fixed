<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Periksa;
use App\Models\Poli;
use App\Models\Resep;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendaftaran = Pendaftaran::all();
        return view('page.admin.periksa.index', compact('pendaftaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $ubah = Pendaftaran::where('id', $id)->first();
        $update = $ubah->update([
            'status_periksa' => 2,
        ]);
        $periksa = Periksa::all();
        $pendaftaran = Pendaftaran::where('id', $id)->first();
        $pasien = Pasien::where('id', $pendaftaran->id_pasien)->first();
        $nama_resep = $pasien->nama_pasien.' '. Carbon::now()->toDateString() .' '. $pendaftaran->id;
        $obat = Obat::all();
        return view('page.admin.periksa.create', compact('periksa', 'pendaftaran', 'obat', 'nama_resep'));
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
        // dd(count($request->id_obat));
        if ($request->id_obat[0] != null && empty($request->file('gambar'))) {
            $total = [];
            $id_obat = $request->id_obat;
            for ($i= 0; $i < count($id_obat); $i++) {
                $i - 1;
                $datasave = [
                    'data_obat' => $id_obat,
                ];
                $req = $request->all();
                $data = Obat::whereIn('id', $id_obat)->get();
                $total_harga = ['total_harga' => $data[$i]->harga_jual * $request->jumlah[$i]];
                // dd($data[$i]_jua;);
                array_push($total, $total_harga);
            }
            $value = array_sum(array_column($total,'total_harga'));
            // dd($value);
            $makeresep = Resep::create([
                'nama_resep' => $request->nama_resep,
                'id_pendaftaran' => $request->id_pendaftaran,
                'total_harga' => $value,
            ]);
            if ($makeresep) {
                $id_obat = $request->id_obat;
                $quantity = $request->jumlah;
                for ($i=0; $i < count($id_obat); $i++) {
                    $i - 1;
                    $datas = Obat::whereIn('id', $id_obat)->get();
                    $data = [
                        'id_resep' => $makeresep->id,
                        'id_obat' => $id_obat[$i],
                        'jumlah' => $quantity[$i],
                        'harga' => $datas[$i]->harga_jual,
                    ];
                    DB::table('detail_resep')->insert($data);
                }
            }
            // $data['id_pendaftaran'] = $request->id_pendaftaran;
            $data = $request->all();
            $data['id_resep'] = $makeresep->id;
            $create = Periksa::create($data);
            if ($create) {
                $ubah = Pendaftaran::where('id', $request->id_pendaftaran)->first();
                $update = $ubah->update([
                    'status_periksa' => 1,
                ]);
                Alert::success('Pembuatan Berhasil', 'Data berhasil di buat');
                return redirect()->route('pendaftaran.all');
            } else {
                Alert::error('Pembuatan gagal', 'Data gagal di buat');
                return redirect()->route('pendaftaran.all');
            }
        } elseif($request->id_obat[0] == null && !empty($request->file('gambar'))) {
            $makeresep = Resep::create([
                'nama_resep' => $request->nama_resep,
                'foto_resep' => $request->file('gambar')->store('uploads/resep'),
                'id_pendaftaran' => $request->id_pendaftaran,
            ]);
            $data = $request->all();
            $data['id_resep'] = $makeresep->id;
            $create = Periksa::create($data);
            if ($create) {
                $ubah = Pendaftaran::where('id', $request->id_pendaftaran)->first();
                $update = $ubah->update([
                    'status_periksa' => 1,
                ]);
                Alert::success('Pembuatan Berhasil', 'Data berhasil di buat');
                return redirect()->route('pendaftaran.all');
            } else {
                Alert::error('Pembuatan gagal', 'Data gagal di buat');
                return redirect()->route('pendaftaran.all');
            }
        } elseif ($request->id_obat[0] != null && !empty($request->file('gambar'))) {

            $total = [];
            $id_obat = $request->id_obat;
            for ($i= 0; $i < count($id_obat); $i++) {
                $i - 1;
                $datasave = [
                    'data_obat' => $id_obat,
                ];
                $req = $request->all();
                $data = Obat::whereIn('id', $id_obat)->get();
                $total_harga = ['total_harga' => $data[$i]->harga_jual * $request->jumlah[$i]];
                array_push($total, $total_harga);
            }
            $value = array_sum(array_column($total,'total_harga'));
            $makeresep = Resep::create([
                'nama_resep' => $request->nama_resep,
                'total_harga' => $value,
                'foto_resep' => $request->file('gambar')->store('uploads/resep'),
                'id_pendaftaran' => $request->id_pendaftaran,
            ]);
            if ($makeresep) {
                $id_obat = $request->id_obat;
                $quantity = $request->jumlah;
                for ($i=0; $i < count($id_obat); $i++) {
                    $i - 1;
                    $datas = Obat::whereIn('id', $id_obat)->get();
                    $data = [
                        'id_resep' => $makeresep->id,
                        'id_obat' => $id_obat[$i],
                        'jumlah' => $quantity[$i],
                        'harga' => $datas[$i]->harga_jual,
                    ];
                    DB::table('detail_resep')->insert($data);
                }
            }
            $data = $request->all();
            $data['id_resep'] = $makeresep->id;
            $create = Periksa::create($data);
            if ($create) {
                $ubah = Pendaftaran::where('id', $request->id_pendaftaran)->first();
                $update = $ubah->update([
                    'status_periksa' => 1,
                ]);
                Alert::success('Pembuatan Berhasil', 'Data berhasil di buat');
                return redirect()->route('pendaftaran.all');
            } else {
                Alert::error('Pembuatan gagal', 'Data gagal di buat');
                return redirect()->route('pendaftaran.all');
            }
        } else {
            Alert::error('Pembuatan gagal', 'Data gagal di buat');
            return redirect()->route('pendaftaran.all');
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
        $periksa = Periksa::where('id')->first();
        $pendaftaran = Pendaftaran::where('id', $periksa->id_pendaftaran);
        return view('page.admin.periksa.edit', compact('periksa', 'pendaftaran'));
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
        $periksa = Periksa::where('id', $id)->first();

        $update = $periksa->update([
            'keluhan' => $request->keluhan,
            'diagnosa' => $request->diagnosa,
        ]);

        if ($update) {
            Alert::success('Update Berhasil', 'Data berhasil di update');
            return redirect()->route('pendaftaran.all');
        } else {
            Alert::error('Update gagal', 'Data gagal di update');
            return redirect()->route('pendaftaran.all');
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
        $periksa = Periksa::where('id', $id)->first();

        $delete = $periksa->delete();

        if ($delete) {
            Alert::success('Hapus Berhasil', 'Data berhasil di hapus');
            return redirect()->route('periksa.index');
        } else {
            Alert::error('Hapus gagal', 'Data gagal di hapus');
            return redirect()->route('periksa.index');
        }

    }
}
