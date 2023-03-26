<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Obat;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->roles->pluck('name')[0] == 'admin' | Auth::user()->roles->pluck('name')[0] == 'apoteker') {
            $penjualan = Penjualan::all();
        } else {
            $penjualan = Penjualan::where('id_kasir', Auth::id())->get();
        }
        return view('page.admin.penjualan.index', compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $obat = Obat::all();

        return view('page.admin.penjualan.create', compact('obat'));
    }

    public function fetchObat($id) 
    { 
        $obat = Obat::where('id', $id)->first();
        return response()->json($obat);
    }

    public function sukses(string $id)
    {
        $penjualan = Penjualan::where('id', $id)->first();
        return view('page.admin.transaksi-sukses', compact('penjualan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
            $makepenjualan = Penjualan::create([
                'tgl_penjualan' => Carbon::now()->toDateString(),
                'total_bayar' => 0,
                'kembalian' => 0,
                'id_transaksi' => 'FJ -' . Str::random(10),
                'total_harga' => $value,
                'id_kasir' => Auth::id(),
            ]);

            if ($makepenjualan) {
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
                        'id_penjualan' => $makepenjualan->id,
                        'id_obat' => $id_obat[$i],
                        'jumlah' => $quantity[$i],
                        'harga' => $datas[$i]->harga_jual,
                    ];
                    DB::table('detail_penjualan')->insert($data);
                }
                // Alert::success('Pembuatan Berhasil', 'Data berhasil di buat');
                return redirect()->route('penjualan-konfirm', $makepenjualan->id);
            } else {
                Alert::error('Pembuatan gagal', 'Data gagal di buat');
                return redirect()->route('penjualan.index');
            }
    }

    public function konfirmasi(string $id) 
    { 
        $penjualan = Penjualan::where('id', $id)->first();
        return view('page.admin.penjualan.konfirmasi', compact('penjualan'));
    }

    public function konfirmasiUpdate(Request $request, string $id) 
    { 
        $penjualan = Penjualan::where('id', $id)->first();
        // dd($penjualan);

        if ($request->total_bayar > $penjualan->total_harga) {
            $update = $penjualan->update([
                'total_bayar' => $request->total_bayar,
                'kembalian' => $request->total_bayar - $penjualan->total_harga,
            ]);
            if ($update) {
                $penjualan_detail = DetailPenjualan::where('id_penjualan', $id)->get()->pluck('id_obat')->toArray();
                // dd(count($penjualan_detail));
                $penjualan_detail_jumlah = DetailPenjualan::where('id_penjualan', $id)->get()->pluck('jumlah')->toArray();
                for ($i=0; $i < count($penjualan_detail); $i++) {
                    // $i
                    // if (count($penjualan_detail) <= 1) {
                    //     $i + 1;
                    // } else {
                    //     # code...
                    // }
                    
                    // dd($i++);
                    $datas = Obat::whereIn('id', $penjualan_detail)->get();
                    // dd($datas);
                    
                    $jumlah = $datas[$i]->stok;
                    $update_obat = $datas[$i]->update([
                        'stok' => $datas[$i]->stok - $penjualan_detail_jumlah[$i],
                    ]);
                }
                Alert::success('Penjualan Berhasil', 'Data berhasil di buat');
                return redirect()->route('penjualan-sukses', $penjualan->id);
            } else {
                Alert::error('Pembuatan gagal', 'penjualan gagal di buat');
                return redirect()->route('penjualan.index');
            }
            
        } else {
            Alert::error('Penjualan gagal', 'uang kurang di buat');
            return redirect()->route('penjualan.index');
        }
    }

    public function invoice(string $id)
    {
        $transaksi = Penjualan::where('id', $id)->first();
        $data['name'] = Auth::user()->nama;
        $data['tanggal_transaksi'] = $transaksi->tgl_penjualan;
        $data['total_harga'] = $transaksi->total_harga;
        $data['total_bayar'] = $transaksi->total_bayar;
        $data['kembalian'] = $transaksi->kembalian;
        $data['nomor_pemesanan'] = $transaksi->id_penjualan;
        $data['item'] = DetailPenjualan::where('id_penjualan', $id)->get();
        $pdf = Pdf::loadView('page.admin.penjualan.pdf', $data)->setPaper([0, 0, 277, 477], 'potrait');
        
        return $pdf->download('invoice.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penjualan = Penjualan::where('id', $id)->first();
        $detail_penjualan = DetailPenjualan::where('id_penjualan', $id)->get();

        return view('page.admin.penjualan.show', compact('penjualan', 'detail_penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
