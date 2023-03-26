@extends('layouts.dashboard')

@section('title')
    pendaftaran
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah pendaftaran</h1>
    <p>Periode : 2020-2021</p>
</div>

<!-- Content Row -->
<div class="page-inner mt--5">
	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">Tambah pendaftaran</div>
						<a href="{{ route('pendaftaran.all') }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
                        <div class="form-group">
							<label for="judul">Nama Pasien</label>
							<input type="text" class="form-control" name="nama_pasien">
						</div>
                        <div class="form-group">
							<label for="judul">No Telpon</label>
							<input type="text" class="form-control" name="no_telp">
						</div>
                        <div class="form-group">
							<label for="judul">Alamat</label>
							<input type="text" class="form-control" name="alamat">
						</div>
                        <div class="form-group">
							<label for="judul">Keluhan</label>
							<input type="text" class="form-control" name="keluhan">
						</div>
                        <div class="form-group">
							<label for="judul">Dokter</label>
							<select class="form-control select2" name="id_dokter">
                                @foreach ($dokter as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama }} | {{ $row->spesialis }}</option>
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
