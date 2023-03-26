@extends('layouts.dashboard')

@section('title')
    edit dokter
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit dokter</h1>
    <p>Periode : 2020-2021</p>
</div>

<!-- Content Row -->
<div class="page-inner mt--5">
	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">Tambah dokter</div>
						<a href="{{ route('dokter.index') }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('dokter.update', $dokter->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
						@csrf
						<div class="form-group">
							<label for="judul">Nama</label>
							<input type="text" required value="{{ $dokter->nama }}" class="form-control" name="nama">
						</div>
						<div class="form-group">
							<label for="judul">Spesialis</label>
							<input type="text" required value="{{ $dokter->spesialis }}" class="form-control" name="spesialis">
						</div>
						<div class="form-group">
							<label for="judul">Email</label>
							<input type="text" required value="{{ $dokter->email }}" class="form-control" name="email">
						</div>
                        <div class="form-group">
							<label for="judul">biaya dokter</label>
							<input type="number" required value="{{ $dokter->biaya_dokter }}" class="form-control" name="biaya_dokter">
						</div>
						<div class="form-group">
							<label for="judul">Password</label>
							<input type="text" class="form-control" name="password">
                        </div>
                        <div class="form-group">
							<label for="foto">Poli</label>
							<select name="id_poli" class="form-control">
                                @foreach ($poli as $row)
									@if ($row->id == $dokter->id_poli)
									<option value="{{ $row->id }}" selected>{{ $row->nama_poli }}</option>
									@else
									<option value="{{ $row->id }}">{{ $row->nama_poli }}</option>
									@endif
                                @endforeach
                            </select>
						</div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        </div>
@endsection
