@extends('layouts.dashboard')

@section('title')
    pembayaran
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah pembayaran</h1>
    <p>Periode : 2020-2021</p>
</div>

<!-- Content Row -->
<div class="page-inner mt--5">
	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">Tambah pembayaran</div>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
                        <input type="hidden" name="id_pendaftaran" value="{{ $pendaftaran->id }}">
                        <div class="form-group">
							<label for="foto">Biaya Administrasi</label>
                            <input type="number" name="biaya_admin" readonly class="form-control" value="{{ $harga_admin }}">
						</div>
						<div class="form-group">
							<label for="foto">Total Biaya Obat</label>
                            <input type="number" name="biaya_obat" readonly class="form-control" value="{{ $harga_total }}">
						</div>
						<div class="form-group">
							<label for="foto">Biaya Dokter</label>
                            <input type="number" name="biaya_dokter" readonly class="form-control" value="{{ $biaya_dokter }}">
						</div>
						<div class="form-group">
							<label for="foto">Total Biaya</label>
                            <input type="number" name="total_biaya" readonly class="form-control" value="{{ $total_biaya }}">
						</div>
                        <div class="form-group">
							<label for="foto">Total Bayar</label>
                            <input type="number" class="form-control" name="total_bayar">
						</div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        </div>
@endsection
