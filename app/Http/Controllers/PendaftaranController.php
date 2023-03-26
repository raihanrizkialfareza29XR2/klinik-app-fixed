<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Poli;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $pendaftaran = Pendaftaran::where('id_pasien', $id)->first();
        return view('page.admin.pendaftaran.index', compact('pendaftaran'));
    }

    public function all()
    {
        if (Auth::user()->roles->pluck('name')[0] == 'dokter') {
            $pendaftaran = Pendaftaran::where('created_at', 'LIKE', '%' . Carbon::now()->toDateString() . '%')->where('id_dokter', Auth::id())->get();
        } else {
            $pendaftaran = Pendaftaran::where('created_at', 'LIKE', '%' . Carbon::now()->toDateString() . '%')->get();
        }
        
        return view('page.admin.pendaftaran.all', compact('pendaftaran'));
    }

    public function cekantrian()
    {
        $didalam = Pendaftaran::with('poli')->where('status_periksa', 2)->get();
        $belum = Pendaftaran::with('poli')->where('status_periksa', 3)->get();
        return response()->json(['didalam' => $didalam, 'belum' => $belum]);
    }

    public function live()
    {
        return view('page.admin.pendaftaran.livecount');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pasien = Pasien::all();
        $poli = Poli::all();
        $dokter = User::whereHas("roles", function($q){ $q->where("name", "dokter"); })->get();
        return view('page.admin.pendaftaran.create', compact('pasien', 'poli', 'dokter'));
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
        $cek = Pasien::where('nama_pasien', $request->nama_pasien)->first();
        $dokter = User::where('id', $request->id_dokter)->first();
        $poli = Poli::where('nama_poli', 'LIKE', '%' . $dokter->spesialis . '%')->first();
        $count = Pendaftaran::where('created_at', 'LIKE', '%' . Carbon::now()->toDateString() . '%')->count();
        if ($cek == null) {
            $create = Pasien::create([
                'nama_pasien' => $request->nama_pasien,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);

            if ($create) {
                $make = Pendaftaran::create([
                    'id_pasien' => $create->id,
                    'id_poli' => $poli->id,
                    'id_dokter' => $request->id_dokter,
                    'keluhan' => $request->keluhan,
                    'no_antrian' => $count + 1,
                    'status_periksa' => 3,
                    'status_bayar' => 2,
                ]);
                if ($make) {
                    Alert::success('Success', 'Pendaftaran anda berhasil!');
                    return redirect()->route('pendaftaran.all');
                } else {
                    Alert::error('Error', 'Pendaftaran anda tidak berhasil!');
                    return redirect()->route('pendaftaran.all');
                }

            } else {
                Alert::error('Error', 'Pendaftaran anda tidak berhasil!');
                return redirect()->route('pendaftaran.all');
            }
        } else {
            $make = Pendaftaran::create([
                'id_pasien' => $cek->id,
                'id_poli' => $poli->id,
                'id_dokter' => $request->id_dokter,
                'keluhan' => $request->keluhan,
                'no_antrian' => $count + 1,
                'status_periksa' => 3,
                'status_bayar' => 2,
            ]);
            if ($make) {
                Alert::success('Success', 'Pendaftaran anda berhasil!');
                return redirect()->route('pendaftaran.all');
            } else {
                Alert::error('Error', 'Pendaftaran anda tidak berhasil!');
                return redirect()->route('pendaftaran.all');
            }
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
