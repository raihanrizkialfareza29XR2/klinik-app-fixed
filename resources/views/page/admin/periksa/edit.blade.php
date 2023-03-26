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
						<div class="card-title">Edit periksa</div>
						<a href="{{ route('periksa.index', $pendaftaran->id) }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('periksa.update', $periksa->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
							<label for="foto">Keluhan</label>
							<input type="text" value="{{ $periksa->keluhan }}" name="keluhan">
						</div>
                        <div class="form-group">
							<label for="foto">Diagnosa</label>
							<input type="text" value="{{ $periksa->diagnosa }}" name="diagnosa">
						</div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
@endsection
