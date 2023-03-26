@extends('layouts.dashboard')

@section('title')
    pasien
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">pasien</h1>

    {{-- <a href="{{ route('pasien.create') }}" class="btn btn-primary" >Tambah Data</a> --}}
</div>

<!-- Content Row -->
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th class="text-center">Aksi</th>
            </tr>
            @forelse ($pasien as $row)
                <tr>
                    <th>{{ $row->nama_pasien }}</th>
                    <th>{{ $row->alamat }}</th>
                    <th>{{ $row->no_telp }}</th>
                    <th class="text-center">
                        <a href="{{ route('pendaftaran.index', $row->id) }}" class="btn btn-primary">Pendaftaran</a> |
                    </th>
                </tr>
            @empty

            @endforelse
        </table>
    </div>
</div>
@endsection
