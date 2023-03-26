@extends('layouts.dashboard')

@section('title')
    Kandidat
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Kandidat</h1>
    <p>Periode : 2020-2021</p>
</div>

<!-- Content Row -->
<div class="page-inner mt--5">
	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">Edit Kandidat</div>
						<a href="{{ route('kandidat.index') }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>
				
				<div class="card-body">
					<form action="{{ route('kandidat.update', $kandidat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
							<label for="judul">Nama</label>
							<input type="text" value="{{ $kandidat->nama }}" class="form-control" name="nama">
						</div>
						<div class="form-group">
							<label for="judul">Visi</label>
							<input type="text" value="{{ $kandidat->visi }}" class="form-control" name="visi">
							<!-- <textarea name="visi" value="{{ $kandidat->visi }}" id="editor1"></textarea> -->
						</div>
						<div class="form-group">
							<label for="judul">Misi</label>
							<!-- <input type="text" value="{{ $kandidat->misi }}" id="editor1" class="form-control" name="misi"> -->
							<textarea name="misi" id="editor1">{!! $kandidat->misi !!}</textarea>
						</div>
						<div class="form-group">
							<label for="judul">Pengalaman Berorganisasi</label>
							<!-- <input type="text" class="form-control" name="misi"> -->
							<textarea name="pengalaman" id="editor2">{!! $kandidat->pengalaman !!}</textarea>
						</div>
						<div class="form-group">
							<label for="judul">Periode</label>
							<input type="text" value="{{ $kandidat->periode }}" class="form-control" name="periode">
						</div>
						<div class="form-group">
							<label for="foto">Foto</label>
							<input type="file" class="form-control" name="foto">
						</div>
						<div class="form-group">
							<label for="judul">Jumlah Suara</label>
							<input type="text" value="{{ $kandidat->jumlahsuara }}" class="form-control" name="jumlahsuara">
						</div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        </div>
@endsection