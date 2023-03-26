@extends('layouts.dashboard')

@section('title')
    laporan
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">laporan</h1>
    <a href="{{ route('pendaftaran.all') }}" class="btn btn-primary">Tambah Data</a>
    <p>Periode : 2020-2021</p>

    {{-- <a href="{{ route('laporan.create') }}" class="btn btn-primary">Tambah Data</a>s --}}
</div>

<!-- Content Row -->
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Nama laporan</th>
                <th class="text-center">Aksi</th>
            </tr>
            @forelse ($laporan as $row)
                <tr>
                    <th>{{ $row->id_pendaftaran }}</th>
                    <th>{{ $row->admin->name }}</th>
                    <th>{{ $row->nama_laporan }}</th>
                    <th>{{ $row->keterangan }}</th>
                    <th class="text-center">
                        <a href="{{ route('laporan.edit', $row->id_laporan) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('laporan.destroy', $row->id_laporan) }}" method="POST" class="d-inline">
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
