@extends('layouts.dashboard')

@section('title')
    laporan
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah laporan</h1>
    <p>Periode : 2020-2021</p>
</div>

<!-- Content Row -->
<div class="page-inner mt--5">
	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">Tambah laporan</div>
						<a href="{{ route('laporan.index') }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
                        <div class="form-group">
							<label for="judul">Nama laporan</label>
							<input type="text" class="form-control" name="nama_laporan">
						</div>
                        <div class="form-group">
							<label for="judul">Keterangan</label>
							<input type="text" class="form-control" name="keterangan">
						</div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        </div>
@endsection
