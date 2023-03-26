@extends('layouts.dashboard')

@section('title')
    obat
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">obat</h1>
    <a href="{{ route('obat.create') }}" class="btn btn-primary">Tambah Data</a>
    <p>Periode : 2020-2021</p>

    {{-- <a href="{{ route('obat.create') }}" class="btn btn-primary">Tambah Data</a>s --}}
</div>

<!-- Content Row -->
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Nama obat</th>
                <th>Jenis obat</th>
                <th>Harga obat</th>
                <th>Kategori obat</th>
                <th>Stok obat</th>
                <th class="text-center">Aksi</th>
            </tr>
            @forelse ($obat as $row)
                <tr>
                    <th>{{ $row->nama_obat }}</th>
                    <th>{{ $row->jenis->nama_jenis }}</th>
                    <th>{{ $row->harga_jual }}</th>
                    <th>{{ $row->kategori->pluck('nama_kategori')[0] }}</th>
                    <th>{{ $row->stok }}</th>
                    <th class="text-center">
                        <a href="{{ route('obat.edit', $row->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('obat.destroy', $row->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                Hapus
                            </button>

                        </form>
                    </th>
                </tr>
            @empty
                <td colspan="5" class="text-center">Data Masih Kosong!</td>
            @endforelse
        </table>
    </div>
</div>
@endsection
