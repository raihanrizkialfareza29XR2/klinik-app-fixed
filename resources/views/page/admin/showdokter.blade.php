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
                <h4>Nama Pasien : {{ $pasien->nama_pasien }}</h4>
                <h4>ID Pendaftaran : {{ $pendaftaran->id }}</h4>
                <h4>Keluhan : {{ $periksa->keluhan }}</h4>
                <h4>Diagnosis : {{ $periksa->diagnosa }}</h4>
                <h4>Nama Resep : {{ $resep->nama_resep }}</h4>
            </div>
            <div class="col-md-12 mt-4">
                <h2 class="">Daftar Resep :</h2>
                <div class="table-responsive mt-2">
                    <a href="{{ route('resep.edit', $resep->id) }}" class="btn btn-primary">Tambah data resep!</a>
                    <table class="table mb-0 text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Obat</th>
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
            </div>
            <div class="col-md-12 mt-4">
                <h2 class="">Daftar Racikan :</h2>
                <div class="table-responsive mt-2">
                    <div class="table-responsive">
                        <table class="table mb-0 text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama Obat</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($detail_resep as $row)
                                    <tr>
                                        <td>{{ $row->obat->pluck('nama_obat')[0] }}</td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
