@extends('layouts.dashboard')

@section('title')
    resep
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">resep</h1>
    {{-- <a href="{{ route('resep.create', $pendaftaran->id) }}" class="btn btn-primary">Tambah Data</a> --}}
    <p>Periode : 2020-2021</p>

    {{-- <a href="{{ route('resep.create') }}" class="btn btn-primary">Tambah Data</a>s --}}
</div>

<!-- Content Row -->
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>ID Pendaftaran</th>
                <th>Nama Resep</th>
                <th class="text-center">Aksi</th>
            </tr>
            @forelse ($resep as $row)
                <tr>
                    <th>{{ $row->id_pendaftaran }}</th>
                    <th>{{ $row->nama_resep }}</th>
                    <th class="text-center">
                        <a href="{{ route('resep.show', $row->id) }}" class="btn btn-primary">Detail</a>
                    </th>
                </tr>
            @empty
                <td colspan="4" class="text-center">Data Masih Kosong!</td>
            @endforelse
        </table>
    </div>
</div>
@endsection
