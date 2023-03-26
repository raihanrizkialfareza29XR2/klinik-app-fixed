@extends('layouts.dashboard')

@section('title')
    poli
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">poli</h1>
    <a href="{{ route('poli.create') }}" class="btn btn-primary">Tambah Data</a>
    <p>Periode : 2020-2021</p>

    {{-- <a href="{{ route('poli.create') }}" class="btn btn-primary">Tambah Data</a>s --}}
</div>

<!-- Content Row -->
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Nama Poli</th>
                <th class="text-center">Aksi</th>
            </tr>
            @forelse ($poli as $row)
                <tr>
                    <th>{{ $row->nama_poli }}</th>
                    <th class="text-center">
                        <a href="{{ route('poli.edit', $row->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('poli.destroy', $row->id) }}" method="POST" class="d-inline">
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
