@extends('layouts.dashboard')

@section('title')
    Penjualan
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Penjualan</h1>
</div>

<!-- Content Row -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
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
                            @foreach ($detail_penjualan as $row)
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
                                        <b>Rp{{ number_format($penjualan->total_harga) }}</b>
                                    </td>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
