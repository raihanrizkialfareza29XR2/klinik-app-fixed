@extends('layouts.dashboard')

@section('title')
    obat
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah obat</h1>
    <p>Periode : 2020-2021</p>
</div>

<!-- Content Row -->
<div class="page-inner mt--5">
	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">Tambah obat</div>
						<a href="{{ route('obat.index') }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('obat.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
                        <div class="form-group">
							<label for="judul">Nama Obat</label>
							<input type="text" class="form-control" name="nama_obat">
						</div>
                        <div class="form-group">
							<label for="judul">Harga Beli</label>
							<input type="text" class="form-control" name="harga_beli">
						</div>
                        <div class="form-group">
							<label for="judul">Harga Jual</label>
							<input type="text" class="form-control" name="harga_jual">
						</div>
                        <div class="form-group">
							<label for="judul">Stok</label>
							<input type="text" class="form-control" name="stok">
						</div>
                        <div class="form-group">
							<label for="judul">Foto Bukti</label>
							<input type="file" class="form-control" name="gambar">
						</div>
                        <div class="form-group">
							<label for="judul">Kategori</label>
							<select class="select2 form-control" name="id_kategori" id="">
                                @foreach ($kategori as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_kategori }}</option>
                                @endforeach
                            </select>
						</div>
                        <div class="form-group">
							<label for="judul">Jenis Obat</label>
                            <select class="select2 form-control" name="id_jenis_obat" id="">
                                @foreach ($jenis_obat as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_jenis }}</option>
                                @endforeach
                            </select>
						</div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        </div>
@endsection

@push('scripts')
    <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
    </script>
@endpush
