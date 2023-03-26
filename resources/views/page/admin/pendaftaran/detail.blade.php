@extends('layouts.dashboard')

@section('title')
    Kandidat
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Kandidat</h1>
    <p>Periode : 2020-2021</p>
</div>

<!-- Content Row -->
<div class="container">
    <div class="row d-flex">
        <div class="col-md-4" style="margin-left:-20px">
            <img src="{{ asset('/public/uploads/' . $kandidat->foto) }}" class="circular--square" width="200" alt="">
        </div>
        <div class="col-md-8 mt-3">
            <h1 class="text-center">{{ $kandidat->nama }}</h1>
            <h6 class="text-center">Visi & Misi</h6>
            <p class="text-center">Periode : {{ $kandidat->periode }}</p>
            <hr>
            <h4 class="text-center">Visi</h4>
            <p class="text-center">{!! $kandidat->visi !!}</p>
            <h4 class="mt-4 text-center">Misi</h4>
            <p class="text-center">{!! $kandidat->misi !!}</p>
            <h4 class="mt-4 text-center">Pengalaman Berorganisasi</h4>
            <p class="text-center">{!! $kandidat->pengalaman !!}</p>
            <a href="{{ route('kandidat.edit', $kandidat->id) }}" class="btn btn-primary">Edit Profil</a>
        </div>
    </div>
</div>
@endsection