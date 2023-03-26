@extends('layouts.dashboard')

@section('title')
    penjualan
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah penjualan</h1>
    <p>Periode : 2020-2021</p>
</div>

<!-- Content Row -->
<div class="page-inner mt--5">
	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">Tambah penjualan</div>
						<a href="{{ route('penjualan.index') }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('penjualan-konfirm-update', $penjualan->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
                        @method('PUT')
                        <div class="form-group classAdded mb-2">
                            <label for="">Total Harga</label>
                            <input type="number" readonly value="{{ $penjualan->total_harga }}" class="form-control">
                        </div>
                        <div class="form-group classAdded mb-2">
                            <label for="">Total Bayar</label>
                            <input type="number" name="total_bayar" class="form-control">
                        </div>
                            
                        <div class="form-group">
                            <button class="btn btn-primary subm btn-sm" type="submit">Save</button>
                        </div>
@endsection
