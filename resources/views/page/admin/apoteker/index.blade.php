@extends('layouts.dashboard')

@section('title')
    apoteker
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">apoteker</h1>
    <a href="{{ route('apoteker.create') }}" class="btn btn-primary">Tambah Data</a>
</div>

<!-- Content Row -->
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Nama apoteker</th>
                <th class="text-center">Aksi</th>
            </tr>
            @forelse ($apoteker as $row)
                <tr>
                    <th>{{ $row->nama }}</th>
                    <th class="text-center">
                        <form action="{{ route('apoteker.edit', $row->id) }}" class="d-inline">
                            @method('PUT')
                            <button class="btn btn-primary">
                                Edit
                            </button>
                        </form> |
                        <form action="{{ route('apoteker.destroy', $row->id) }}" method="POST" class="d-inline">
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
