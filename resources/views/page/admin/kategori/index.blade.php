@extends('layouts.dashboard')

@section('title')
    kategori
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">kategori</h1>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah Data</a>
    <p>Periode : 2020-2021</p>

    {{-- <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah Data</a>s --}}
</div>

<!-- Content Row -->
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Nama kategori obat</th>
                <th class="text-center">Aksi</th>
            </tr>
            @forelse ($kategori_obat as $row)
                <tr>
                    <th>{{ $row->nama_kategori }}</th>
                    <th class="text-center">
                        <a href="{{ route('kategori.edit', $row->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('kategori.destroy', $row->id) }}" method="POST" class="d-inline">
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
