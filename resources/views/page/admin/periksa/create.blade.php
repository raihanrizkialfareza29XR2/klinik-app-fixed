@extends('layouts.dashboard')

@section('title')
    periksa
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah periksa</h1>
    <p>Periode : 2020-2021</p>
</div>

<!-- Content Row -->
<div class="page-inner mt--5">
	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">Tambah periksa</div>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('periksa.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
                        <input type="hidden" name="id_pendaftaran" value="{{ $pendaftaran->id }}">
                        <div class="form-group">
							<label for="foto">Keluhan</label>
							<input type="text" value="{{ $pendaftaran->keluhan }}" class="form-control" name="keluhan">
						</div>
                        <div class="form-group">
							<label for="foto">Diagnosa</label>
							<input type="text" class="form-control" name="diagnosa">
						</div>
                        <br>
                        <h1>Resep Dokter</h1>
                        <br>
                        <br>
                        <h5>* Pilih salah satu atau pilih kedua opsi di bawah ini untuk menginputkan data manual / mengunggah foto resep</h5>
                        <div class="form-group">
							<label for="foto">Foto Resep</label>
							<input type="file" class="form-control" name="gambar">
						</div>
                        <div class="form-group">
							<label for="foto">Nama Resep</label>
							<input type="text" readonly value="{{ $nama_resep }}" class="form-control" name="nama_resep">
						</div>
                        <div class="form-group classAdded mb-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Obat</label>
                                    <select name="id_obat[]" class="form-control selectobat">
                                        <option value="">---- Pilih Obat ----</option>
                                        @foreach ($obat as $row)
                                            <option value="{{ $row->id }}">{{ $row->nama_obat }} / {{ $row->jenis->nama_jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label for="exampleInputEmail1">Jumlah</label>
                                    <input type="number" name="jumlah[]" class="form-control">
                                </div>
                                <div class="col-md-1" style="margin-top: 1.8rem">
                                    <a class="btn btn-success addClass" href="javascript:void(0)">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary subm btn-sm" type="submit">Selesai Periksa</button>
                        </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
     $('.selectobat').select2();
    });
    $('form').on('click', '.addClass', function () {
        var form = "<div class='form-group classAdded'>"+
                            "<div class='row'>"+
                                "<div class='col-md-6'>"+
                                    "<label for='exampleInputEmail1'>Obat</label>"+
                                    "<select id='selectobat' name='id_obat[]' class='form-control selectobat'>"+
                                        "@foreach ($obat as $row)"+
                                            "<option value="{{ $row->id }}">{{ $row->nama_obat }} / {{ $row->jenis->nama_jenis }}</option>"+
                                        "@endforeach"+
                                    "</select>"+
                                "</div>"+
                                "<div class='col-md-5'>"+
                                    "<label for='exampleInputEmail1'>Jumlah</label>"+
                                    "<input type='number' name='jumlah[]' class='form-control'>"+
                                "</div>"+
                                "<div class='col-md-1' style='margin-top: 1.8rem'>"+
                                    "<a class='btn btn-danger removeClass' href='javascript:void(0)'>-</a>"+
                                "</div>"+
                            "</div>"+
                        "</div>"
        $(form).insertBefore('.subm');
    });
    $('form').on('click', '.removeClass', function() {
        $(this).parent().parent().remove();
    });
</script>
@endpush

