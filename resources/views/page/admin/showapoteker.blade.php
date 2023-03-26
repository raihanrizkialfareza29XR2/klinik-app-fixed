@extends('layouts.dashboard')

@section('title')
    Penjualan
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Resep</h1>
</div>

<!-- Content Row -->
<div class="container">
    <div class="row">
        @if ($detail_resep->count() <= 0)
            <div class="col-md-12">
                <h4>Nama Resep : {{ $resep->nama_resep }}</h4>
                <h4>Nama Pasien : {{ $pasien->nama_pasien }}</h4>
                <h4>ID Pendaftaran : {{ $pendaftaran->id }}</h4>
                <h4>Keluhan : {{ $periksa->keluhan }}</h4>
                <h4>Diagnosis : {{ $periksa->diagnosa }}</h4>
                <h4>Dokter : {{ $dokter->nama }}</h4>
                @if ($resep->foto_resep != null)
                    <h3 class="mt-4">Foto Resep :</h3>
                    <img src="{{ asset('/storage/' . $resep->foto_resep) }}" height="100" class="mt-3" alt="">
                @endif
            </div>
            <div class="col-md-12 mt-4">
                <h2 class="">Daftar Racikan :</h2>
                <div class="table-responsive mt-2">
                    <table class="table mb-0 text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Obat</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td colspan="3">Belum ada data resep! silahkan tambahkan.</td>
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="col-md-12">
                <h4>Nama Resep : {{ $resep->nama_resep }}</h4>
                @if ($resep->foto_resep != null)
                    <h3 class="mt-4">Foto Resep :</h3>
                    <img src="{{ asset('/storage/' . $resep->foto_resep) }}" height="100" class="mt-3" alt="">
                @endif
            </div>
            <div class="col-md-12 mt-4">
                <h2 class="">Daftar Racikan :</h2>
                <div class="table-responsive mt-2">
                    <div class="table-responsive">
                        <table class="table mb-0 text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama Obat</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($detail_resep as $row)
                                    <tr>
                                        <td>{{ $row->obat->pluck('nama_obat')[0] }}</td>
                                        <td>{{ $row->jumlah }}</td>
                                        <td>Rp{{ number_format($row->obat->pluck('harga_jual')[0]) }}</td>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td>
                                            <b>Total</b>
                                        </td>
                                        <td colspan="1">
                                            <td>
                                                <b>Rp{{ number_format($resep->total_harga) }}</b>
                                            </td>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
