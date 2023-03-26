@extends('layouts.dashboard')

@section('title')
    pendaftaran
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">pendaftaran</h1>
    <p>Periode : 2020-2021</p>
    @hasrole('admin')
    <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary">Daftarkan Pasien</a>
    @endhasrole

</div>

<!-- Content Row -->
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Nama Pasien</th>
                <th>Nama Poli</th>
                <th>Nama Dokter</th>
                <th>No Antrian</th>
                <th>Status Periksa</th>
                @if (Auth::user()->roles->pluck('name')[0] == 'dokter')
                <th class="text-center">Aksi</th>
                @endif
            </tr>
            @forelse ($pendaftaran as $row)
                <tr>
                    <th>{{ $row->pasien->nama_pasien }}</th>
                    <th>{{ $row->poli->nama_poli }}</th>
                    <th>{{ $row->dokter->nama }}</th>
                    <th>{{ $row->no_antrian }}</th>
                    @switch($row->status_periksa)
                        @case(1)
                            <th>Selesai di periksa</th>
                            @break
                        @case(2)
                            <th>Sedang di periksa</th>
                            @break
                        @case(3)
                            <th>Menunggu antrian</th>
                            @break
                        @default

                    @endswitch
                    <th class="text-center">
                        @if ($row->status_periksa == 3 && Auth::user()->roles->pluck('name')[0] == 'dokter')
                            <a href="{{ route('periksa.create', $row->id) }}" class="btn btn-primary">Periksa Pasien</a>
                        @else

                        @endif
                    </th>
                </tr>
            @empty
                <td colspan="6" class="text-center">Belum ada pendaftaran hari ini!</td>
            @endforelse
        </table>
    </div>
</div>
@endsection
