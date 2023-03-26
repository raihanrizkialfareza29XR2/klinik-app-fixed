@extends('layouts.dashboard')

@section('title')
    jadwal
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah jadwal</h1>
    <p>Periode : 2020-2021</p>
</div>

<!-- Content Row -->
<div class="page-inner mt--5">
	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">Tambah jadwal</div>
						<a href="{{ route('jadwal.index') }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('jadwal.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
                        <div class="form-group">
							<label for="foto">Dokter</label>
							<select name="id_dokter" class="form-control">
                                @foreach ($dokter as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                @endforeach
                            </select>
						</div>
                        <div class="form-group">
							<label for="foto">Poli</label>
							<select name="id_poli" class="form-control">
                                @foreach ($poli as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_poli }}</option>
                                @endforeach
                            </select>
						</div>
                        <div class="form-group">
							<label for="foto">Hari</label>
							<select name="hari" class="form-control">
                                <option value="senin">Senin</option>
                                <option value="selasa">Selasa</option>
                                <option value="rabu">Rabu</option>
                                <option value="kamis">Kamis</option>
                                <option value="jumat">Jumat</option>
                                <option value="sabtu">Sabtu</option>
                                <option value="minggu">Minggu</option>
                            </select>
						</div>
                        <div class="form-group">
							<label for="foto">Jam Mulai</label>
							<input type="text" name="jam_mulai" placeholder="isi dengan jam seperti 14:00">
						</div>
                        <div class="form-group">
							<label for="foto">Jam Selesai</label>
							<input type="text" name="jam_selesai" placeholder="isi dengan jam seperti 20:00">
						</div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        </div>
@endsection
