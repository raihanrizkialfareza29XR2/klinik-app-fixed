@extends('layouts.dashboard')

@section('title')
    Penjualan
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">penjualan</h1>
    <a href="{{ route('penjualan.create') }}" class="btn btn-primary">Tambah Data</a>
    <p>Periode : 2020-2021</p>

    {{-- <a href="{{ route('penjualan.create') }}" class="btn btn-primary">Tambah Data</a>s --}}
</div>

<!-- Content Row -->
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>ID Transaksi</th>
                <th>Total Harga</th>
                <th>Tanggal Transaksi</th>
                <th class="text-center">Aksi</th>
            </tr>
            @forelse ($penjualan as $row)
                <tr>
                    <th>{{ $row->id_transaksi }}</th>
                    <th>{{ $row->total_harga }}</th>
                    <th>{{ $row->tgl_penjualan }}</th>
                    <th class="text-center">
                        <a href="{{ route('penjualan.show', $row->id) }}" class="btn btn-primary">Detail</a>
                    </th>
                </tr>
            @empty
                <td colspan="4" class="text-center">Data Masih Kosong!</td>
            @endforelse
        </table>
    </div>
</div>
@endsection
