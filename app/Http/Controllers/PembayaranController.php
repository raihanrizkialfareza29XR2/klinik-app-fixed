<?php

namespace App\Http\Controllers;

use App\Models\DetailResep;
use App\Models\Klinik;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Support\Str;
use App\Models\Poli;
use App\Models\Resep;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $pembayaran = Pembayaran::where('id_pendaftaran', $id)->get();
        $pendaftaran = Pendaftaran::where('id', $id)->first();
        return view('page.admin.pembayaran.index', compact('pembayaran', 'pendaftaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pembayaran = Pembayaran::all();
        $pendaftaran = Pendaftaran::where('id', $id)->first();
        $dokter = User::where('id', $pendaftaran->id_dokter)->first();
        $resep = Resep::where('id_pendaftaran', $pendaftaran->id)->first();
        $klinik = Klinik::where('id', 1)->first();
        $biaya_dokter = $dokter->biaya_dokter;
        $harga_total = $resep->total_harga;
        $harga_admin = $klinik->biaya_admin;
        $total_biaya = $biaya_dokter + $harga_total + $harga_admin;
        return view('page.admin.pembayaran.create', compact('pembayaran', 'pendaftaran', 'total_biaya', 'biaya_dokter', 'harga_total', 'harga_admin'));
    }

    public function sukses(string $id)
    {
        $pembayaran = Pembayaran::where('id', $id)->first();
        return view('page.admin.transaksi-sukses1', compact('pembayaran'));
    }

    public function invoice(string $id)
    {
        $transaksi = Pembayaran::where('id', $id)->first();
        $data['name'] = Auth::user()->nama;
        $data['tanggal_transaksi'] = Carbon::now()->toDateString();
        $data['total_harga'] = $transaksi->biaya_obat;
        $data['total_biaya'] = $transaksi->total_biaya;
        $data['biaya_dokter'] = $transaksi->biaya_dokter;
        $data['biaya_admin'] = $transaksi->biaya_admin;
        $data['total_bayar'] = $transaksi->total_bayar;
        $data['kembalian'] = $transaksi->kembalian;
        $data['id_transaksi'] = $transaksi->id_pembayaran;
        $data['item'] = DetailResep::where('id_resep', $transaksi->id_resep)->get();
        $pdf = Pdf::loadView('page.admin.pembayaran.invoicepembayaran', $data)->setPaper([0, 0, 277, 477], 'potrait');
        return $pdf->download('invoice.pdf');
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
        $pendaftaran = Pendaftaran::where('id', $request->id_pendaftaran)->first();
        $dokter = User::where('id', $pendaftaran->id_dokter)->first();
        $resep = Resep::where('id_pendaftaran', $pendaftaran->id)->first();
        $klinik = Klinik::where('id', 1)->first();
        $biaya_dokter = $dokter->biaya_dokter;
        $harga_total = $resep->total_harga;
        $harga_admin = $klinik->biaya_admin;
        $data['id_pendaftaran'] = $request->id_pendaftaran;
        $data['biaya_obat'] = $request->biaya_obat;
        $data['id_resep'] = $resep->id;
        $data['biaya_admin'] = $request->biaya_admin;
        $data['biaya_dokter'] = $request->biaya_dokter;
        $total_biaya = $biaya_dokter + $harga_total + $harga_admin;
        $data['total_biaya'] = $biaya_dokter + $harga_total + $harga_admin;
        if ($request->total_bayar < $total_biaya) {
            Alert::error('Pembayaran gagal', 'uang kurang');
            return redirect()->route('pembayaran.create', $pendaftaran->id);
        } else {
            $data['id_pembayaran'] = 'FS -' . Str::random(10);
            $data['kembalian'] = $request->total_bayar - $total_biaya;
            // dd($data);
            $create = Pembayaran::create($data);
        }

        if ($create) {
            $transaksi = Pendaftaran::where('id', $request->id_pendaftaran)->first();
            $ubah = $transaksi->update([
                'status_bayar' => 1,
            ]);
            Alert::success('Pembuatan Berhasil', 'Data berhasil di buat');
            return redirect()->route('pembayaran-sukses', $create->id);
        } else {
            Alert::error('Pembayaran gagal', 'Data gagal di buat');
            return redirect()->route('resep.index');
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
        $pembayaran = Pembayaran::where('id')->first();
        $pendaftaran = Pendaftaran::where('id', $pembayaran->id_pendaftaran);
        return view('page.admin.pembayaran.edit', compact('pembayaran', 'pendaftaran'));
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
        $pembayaran = Pembayaran::where('id', $id)->first();

        $update = $pembayaran->update([
            'nama_pembayaran' => $request->nama_pembayaran,
            'biaya' => $request->biaya,
        ]);

        if ($update) {
            Alert::success('Update Berhasil', 'Data berhasil di update');
            return redirect()->route('pembayaran.index');
        } else {
            Alert::error('Update gagal', 'Data gagal di update');
            return redirect()->route('pembayaran.index');
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
        $pembayaran = Pembayaran::where('id', $id)->first();

        $delete = $pembayaran->delete();

        if ($delete) {
            Alert::success('Hapus Berhasil', 'Data berhasil di hapus');
            return redirect()->route('pembayaran.index');
        } else {
            Alert::error('Hapus gagal', 'Data gagal di hapus');
            return redirect()->route('pembayaran.index');
        }

    }
}
