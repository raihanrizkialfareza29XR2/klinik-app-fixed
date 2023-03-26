<?php

namespace App\Http\Controllers;

use App\Models\DetailResep;
use App\Models\Obat;
use App\Models\Pendaftaran;
use App\Models\Poli;
use App\Models\Resep;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendaftaran = Pendaftaran::where('status_bayar', 2)->get()->pluck('id')->toArray();
        // dd($pendaftaran['id']);
        $resep = Resep::whereIn('id_pendaftaran', $pendaftaran)->get();
        // for ($i=0; $i < count($pendaftaran); $i++) {
        //     // dd($pendaftaran['id']);
        // }
        return view('page.admin.resep.index', compact('resep'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $resep = Resep::all();
        $pendaftaran = Pendaftaran::where('id', $id)->first();
        $obat = Obat::all();
        return view('page.admin.resep.create', compact('resep', 'pendaftaran', 'obat'));
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
        $create = Resep::create($data);

        if ($create) {
            Alert::success('Pembuatan Berhasil', 'Data berhasil di buat');
            return redirect()->route('resep.show');
        } else {
            Alert::error('Pembuatan gagal', 'Data gagal di buat');
            return redirect()->route('resep.show');
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
        $resep = Resep::where('id', $id)->first();
        $detail_resep = DetailResep::where('id_resep', $id)->get();
        // dd($detail_resep->count());

        return view('page.admin.resep.show', compact('resep', 'detail_resep'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resep = Resep::where('id', $id)->first();
        $obat = Obat::all();
        $pendaftaran = Pendaftaran::where('id', $resep->id_pendaftaran)->first();
        return view('page.admin.resep.edit', compact('resep', 'obat', 'pendaftaran'));
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
        $resep = Resep::where('id', $id)->first();

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

        $update = $resep->update([
            'total_harga' => $value,
        ]);

        $id_obat = $request->id_obat;
        $quantity = $request->jumlah;
        for ($i=0; $i < count($id_obat); $i++) {
            $i - 1;
            $datas = Obat::whereIn('id', $id_obat)->get();
            $jumlah = $datas[$i]->stok;
            $update_obat = $datas[$i]->update([
                'stok' => $datas[$i]->stok - $quantity[$i],
            ]);
            $data = [
                'id_resep' => $id,
                'id_obat' => $id_obat[$i],
                'jumlah' => $quantity[$i],
                'harga' => $datas[$i]->harga_jual,
            ];
            DB::table('detail_resep')->insert($data);
        }

        if ($update) {
            Alert::success('Update Berhasil', 'Data berhasil di update');
            return redirect()->route('resep.show', $id);
        } else {
            Alert::error('Update gagal', 'Data gagal di update');
            return redirect()->route('resep.show', $id);
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
        $resep = Resep::where('id', $id)->first();

        $delete = $resep->delete();

        if ($delete) {
            Alert::success('Hapus Berhasil', 'Data berhasil di hapus');
            return redirect()->route('resep.show', $id);
        } else {
            Alert::error('Hapus gagal', 'Data gagal di hapus');
            return redirect()->route('resep.show', $id);
        }

    }
}
