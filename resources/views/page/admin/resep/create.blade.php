@extends('layouts.dashboard')

@section('title')
    resep
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah resep</h1>
    <p>Periode : 2020-2021</p>
</div>

<!-- Content Row -->
<div class="page-inner mt--5">
	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">Tambah resep</div>
						<a href="{{ route('resep.index', $pendaftaran->id) }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('resep.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
                        <div class="form-group">
                            <input type="hidden" name="id_pendaftaran" value="{{ $pendaftaran->id }}">
							<label for="foto">Nama Obat</label>
							<select name="status" class="form-control">
                                @foreach ($obat as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_obat }}</option>
                                @endforeach
                            </select>
						</div>
                        <div class="form-group">
							<label for="foto">Jumlah</label>
							<input type="number" name="jumlah" ">
						</div>
                        <div class="form-group">
							<label for="foto">Nama Resep</label>
							<input type="text" name="nama_resep">
						</div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        </div>
@endsection
