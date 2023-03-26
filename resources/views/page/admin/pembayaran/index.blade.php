@extends('layouts.dashboard')

@section('title')
    pembayaran
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">pembayaran</h1>
    <a href="{{ route('pembayaran.create', $pendaftaran->id) }}" class="btn btn-primary">Tambah Data</a>
    <p>Periode : 2020-2021</p>

    {{-- <a href="{{ route('pembayaran.create') }}" class="btn btn-primary">Tambah Data</a>s --}}
</div>

<!-- Content Row -->
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>ID Pendaftaran</th>
                <th>Nama Pembayaran</th>
                <th>Biaya</th>
                <th class="text-center">Aksi</th>
            </tr>
            @forelse ($pembayaran as $row)
                <tr>
                    <th>{{ $row->id_pendaftaran }}</th>
                    <th>{{ $row->nama_pembayaran }}</th>
                    <th>{{ $row->biaya }}</th>
                    <th class="text-center">
                        <a href="{{ route('pembayaran.edit', $row->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('pembayaran.destroy', $row->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                Hapus
                            </button>

                        </form>
                    </th>
                </tr>
            @empty
                <td colspan="4" class="text-center">Data Masih Kosong!</td>
            @endforelse
        </table>
    </div>
</div>
@endsection
