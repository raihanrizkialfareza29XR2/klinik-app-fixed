@extends('layouts.dashboard')
@section('title', 'Edit Suara')
@section('content')
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
						<div class="card-title">Edit jadwal</div>
						<a href="{{ route('jadwal.index') }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
							<label for="foto">Dokter</label>
							<select name="id_dokter" class="form-control">
                                @foreach ($dokter as $row)
									@if ($row->id == $jadwal->id_dokter)
									<option value="{{ $row->id }}" selected>{{ $row->nama }}</option>
									@else
									<option value="{{ $row->id }}">{{ $row->nama }}</option>
									@endif
                                @endforeach
                            </select>
						</div>
                        <div class="form-group">
							<label for="foto">Poli</label>
							<select name="id_poli" class="form-control">
                                @foreach ($poli as $row)
									@if ($row->id == $jadwal->id_poli)
									<option value="{{ $row->id }}" selected>{{ $row->nama_poli }}</option>
									@else
									<option value="{{ $row->id }}">{{ $row->nama_poli }}</option>
									@endif
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
							<input type="text" name="jam_mulai" value="{{ $jadwal->jam_mulai }}">
						</div>
                        <div class="form-group">
							<label for="foto">Jam Selesai</label>
							<input type="text" name="jam_selesai" value="{{ $jadwal->jam_selesai }}">
						</div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
@endsection
