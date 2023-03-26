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
						<div class="card-title">Edit obat</div>
						<a href="{{ route('obat.index') }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('obat.update', $obat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
							<label for="foto">Nama Obat</label>
							<input type="text" class="form-control" name="nama_obat" value="{{ $obat->nama_obat }}">
						</div>
                        <div class="form-group">
							<label for="foto">Harga Beli</label>
							<input type="text" class="form-control" name="harga_beli" value="{{ $obat->harga_beli }}">
						</div>
                        <div class="form-group">
							<label for="foto">Harga Jual</label>
							<input type="text" class="form-control" name="harga_jual" value="{{ $obat->harga_jual }}">
						</div>
                        <div class="form-group">
							<label for="foto">Stok</label>
							<input type="text" class="form-control" name="stok" value="{{ $obat->stok }}">
						</div>
                        <div class="form-group">
							<label for="foto">Jenis Obat</label>
                            <select class="select2 form-control" name="id_jenis_obat" id="">
                                @foreach ($jenis_obat as $row)
									@if ($row->id == $obat->id_jenis_obat)
									<option value="{{ $row->id }}" selected>{{ $row->nama_jenis }}</option>
									@else
									<option value="{{ $row->id }}">{{ $row->nama_jenis }}</option>
									@endif
                                @endforeach
                            </select>
						</div>
                        <div class="form-group">
							<label for="judul">Foto Bukti</label>
							<input type="file" class="form-control" name="gambar">
						</div>
                        <div class="form-group">
							<label for="foto">Kategori Obat</label>
                            <select class="select2 form-control" name="id_kategori" id="">
                                @foreach ($kategori as $row)
									@if ($row->id == $obat->id_kategori)
									<option value="{{ $row->id }}" selected>{{ $row->nama_kategori }}</option>
									@else
									<option value="{{ $row->id }}">{{ $row->nama_kategori }}</option>
									@endif
                                @endforeach
                            </select>
						</div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
@endsection
@push('scripts')
    <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
    </script>
@endpush
