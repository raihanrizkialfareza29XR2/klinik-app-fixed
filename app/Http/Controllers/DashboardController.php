<?php

namespace App\Http\Controllers;

use App\Models\DetailResep;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Penjualan;
use App\Models\Periksa;
use App\Models\Resep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(Auth::user());
        // dd(Auth::user()->roles->pluck('name')[0]);
        $data_pendaftaran = Pendaftaran::where('status_bayar', 1)->get();
        $data_pendaftaran_single = Pendaftaran::where('id_dokter', Auth::id())->where('status_bayar', 1)->get();
        $data_periksa = Periksa::all();
        if (Auth::user()->roles->pluck('name')[0] == 'admin') {
            $data_penjualan = Penjualan::all();
        } else {
            $data_penjualan = Penjualan::where('id', Auth::id())->get();
        }

        $penjualan_terbanyak = DB::table('obat')
                        ->leftJoin('detail_penjualan', 'obat.id','=','detail_penjualan.id_obat')
                        ->leftJoin('penjualan', 'detail_penjualan.id_penjualan', '=', 'penjualan.id')
                        ->selectRaw('obat.id, obat.nama_obat, SUM(detail_penjualan.jumlah) as total')
                        ->groupBy('obat.id')
                        ->orderBy('total', 'asc')
                        ->get();
        return view('page.admin.admin', compact('data_pendaftaran', 'data_pendaftaran_single', 'data_periksa', 'data_penjualan', 'penjualan_terbanyak'));
    }

    public function showDokter(string $id)
    {
        $pendaftaran = Pendaftaran::where('id', $id)->first();
        $pasien = Pasien::where('id', $pendaftaran->id_pasien)->first();
        $periksa = Periksa::where('id_pendaftaran', $pendaftaran->id)->first();
        $resep = Resep::where('id', $periksa->id_resep)->first();
        $detail_resep = DetailResep::where('id_resep', $resep->id)->get();
        return view('page.admin.showapoteker', compact('pendaftaran', 'pasien', 'periksa', 'resep', 'detail_resep'));
    }
    public function showApoteker(string $id)
    {
        $pendaftaran = Pendaftaran::where('id', $id)->first();
        $pasien = Pasien::where('id', $pendaftaran->id_pasien)->first();
        $periksa = Periksa::where('id_pendaftaran', $pendaftaran->id)->first();
        $resep = Resep::where('id', $periksa->id_resep)->first();
        $detail_resep = DetailResep::where('id_resep', $resep->id)->get();
        $dokter = User::where('id', $pendaftaran->id_dokter)->first();
        return view('page.admin.showapoteker', compact('pendaftaran', 'pasien', 'periksa', 'resep', 'dokter', 'detail_resep'));
    }
}
