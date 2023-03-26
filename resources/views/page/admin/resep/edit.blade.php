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
						<div class="card-title">Edit resep</div>
						<a href="{{ route('resep.index', $pendaftaran->id) }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('resep.update', $resep->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group classAdded mb-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Obat</label>
                                    <select name="id_obat[]" class="form-control selectobat">
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
                        <button class="btn btn-primary btn-sm subm" type="submit">Save</button>
                    </form>
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
