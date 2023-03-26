@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered" id="livecount">
            <tr>
                <th>Dalam Antrian</th>
                <th>Sedang Diperiksa</th>
            </tr>
            <tr class="tr-satu">

            </tr>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
    function startLiveUpdates() {
        const belumDipanggil = document.getElementById('menunggu');
        const diDalam = document.getElementById('periksa');
        setInterval(function () {
            $('.tr').empty()
            fetch('{{ route('cekantrian') }}').then(function (response) {
                return response.json();
            }).then(function (data) {
                // console.log(data);
                for (let i = 0; i < data.belum.length; i++) {
                    $('table').append(`<tr class="tr"><th class="satu">${data.belum[i].no_antrian} | ${data.belum[i].poli.nama_poli}</th></tr>`)
                }
                for (let i = 0; i < data.didalam.length; i++) {
                    $(`<th>${data.didalam[i].no_antrian} | ${data.didalam[i].poli.nama_poli}</th>`).insertAfter('.satu')
                }
            }).catch(function (error) {
                console.log(error);
            });
        }, 10000);
    }
    document.addEventListener('DOMContentLoaded', function () {
        startLiveUpdates();
    });
</script>
@endpush
