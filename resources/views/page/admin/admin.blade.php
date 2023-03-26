@extends('layouts.dashboard')

@section('title')
    Dashboard
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="row">
    <div class="container">
        @switch(Auth::user()->roles->pluck('name')[0])
            @case('dokter')
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Pasien</th>
                            <th>ID Pendaftaran</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        @forelse ($data_pendaftaran_single as $row)
                            <tr>
                                <th>{{ $row->pasien->nama_pasien }}</th>
                                <th>{{ $row->id }}</th>
                                <th class="text-center">
                                    <a href="{{ route('showDokter', $row->id) }}" class="btn btn-primary">Detail Data</a>
                                </th>
                            </tr>
                        @empty
                            <td colspan="4" class="text-center">Data Masih Kosong!</td>
                        @endforelse
                    </table>
                </div>
                @break
            @case('apoteker')
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Pasien</th>
                            <th>ID Pendaftaran</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        @forelse ($data_pendaftaran as $row)
                            <tr>
                                <th>{{ $row->pasien->nama_pasien }}</th>
                                <th>{{ $row->id }}</th>
                                <th class="text-center">
                                    <a href="{{ route('showApoteker', $row->id) }}" class="btn btn-primary">Detail Data</a>
                                </th>
                            </tr>
                        @empty
                            <td colspan="4" class="text-center">Data Masih Kosong!</td>
                        @endforelse
                    </table>
                </div>
                @break
            @case('kasir')
                <div id="chart"></div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Tanggal Penjualan</th>
                            <th>Total Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        @forelse ($data_penjualan as $row)
                            <tr>
                                <th>{{ $row->id_penjualan }}</th>
                                <th>{{ $row->tgl_penjualan }}</th>
                                <th>{{ $row->total_harga }}</th>
                            </tr>
                        @empty
                            <td colspan="4" class="text-center">Data Masih Kosong!</td>
                        @endforelse
                    </table>
                </div>
                @break
            @case('admin')
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Pasien</th>
                            <th>ID Pendaftaran</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        @forelse ($data_pendaftaran as $row)
                            <tr>
                                <th>{{ $row->pasien->nama_pasien }}</th>
                                <th>{{ $row->id }}</th>
                                <th class="text-center">
                                    <a href="{{ route('showApoteker', $row->id) }}" class="btn btn-primary">Detail Data</a>
                                </th>
                            </tr>
                        @empty
                            <td colspan="4" class="text-center">Data Masih Kosong!</td>
                        @endforelse
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Tanggal Penjualan</th>
                            <th>Total Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        @forelse ($data_penjualan as $row)
                            <tr>
                                <th>{{ $row->id_penjualan }}</th>
                                <th>{{ $row->tgl_penjualan }}</th>
                                <th>{{ $row->total_harga }}</th>
                            </tr>
                        @empty
                            <td colspan="4" class="text-center">Data Masih Kosong!</td>
                        @endforelse
                    </table>
                </div>
                <div id="chart"></div>
                @break
            @default

        @endswitch
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>

    Highcharts.chart('chart', {
        title: {
            text: 'Laporan'
        },
        subtitle: {
            text: 'Berikut Obat paling banyak terjual'
        },
        xAxis: {
            categories: [@foreach ($penjualan_terbanyak as $row)
            '<?= $row->nama_obat ?>',
            @endforeach],
        },
        yAxis: {
            title: {
                text: 'Obat Terlaris'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            type: 'bar',
            name: 'penjualan',
            data: [
             @if ($penjualan_terbanyak->count() <= 0)
                {name: 'theres no data',}
             @else
             @foreach ($penjualan_terbanyak as $row)
                {
                    name: '<?= $row->nama_obat ?>',
                    @if ($row->total <= 0)
                        y: <?= 0 ?>
                    @else
                        y: <?= $row->total ?>
                    @endif,
                },
            @endforeach
             @endif
            ]
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'vertical',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
 });
     </script>
@endpush
