@extends('layouts.dashboard')

@section('title')
    periksa
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">periksa</h1>
    <a href="{{ route('periksa.create', $pendaftaran->id) }}" class="btn btn-primary">Tambah Data</a>
    <p>Periode : 2020-2021</p>

    {{-- <a href="{{ route('periksa.create') }}" class="btn btn-primary">Tambah Data</a>s --}}
</div>

<!-- Content Row -->
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>ID Pendaftaran</th>
                <th>No Antrian</th>
                <th>Keluhan</th>
                <th class="text-center">Aksi</th>
            </tr>
            @forelse ($pendaftaran as $row)
                <tr>
                    <th>{{ $row->id_pendaftaran }}</th>
                    <th>{{ $row->no_antrian }}</th>
                    <th>{{ $row->keluhan }}</th>
                    <th class="text-center">
                        <a href="{{ route('periksa.create', $row->id) }}" class="btn btn-primary">Periksa Pasien</a>
                    </th>
                </tr>
            @empty
                <td colspan="4" class="text-center">Data Masih Kosong!</td>
            @endforelse
        </table>
    </div>
</div>
@endsection
