<!DOCTYPE html>
<html lang="en" >

<head>

  <meta charset="UTF-8">
  <title>HTML Invoice</title>

  <style>
@media print {
    .page-break { display: block; page-break-before: always; }
}
      #invoice-POS {
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding: 2mm;
  margin: 0 auto;
  width: 44mm;
  background: #FFF;
}
#invoice-POS ::selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS ::moz-selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS h1 {
  font-size: 1.5em;
  color: #222;
}
#invoice-POS h2 {
  font-size: .9em;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoice-POS p {
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}
#invoice-POS #top {
  min-height: 100px;
}
#invoice-POS #mid {
  min-height: 10px;
}
#invoice-POS #bot {
  min-height: 50px;
}
#invoice-POS .info {
  display: block;
  margin-left: 0;
}
#invoice-POS .title {
  float: right;
}
#invoice-POS .title p {
  text-align: right;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
}
#invoice-POS .tabletitle {
  font-size: .5em;
  background: #EEE;
}
#invoice-POS .service {
  border-bottom: 1px solid #EEE;
}
#invoice-POS .item {
  width: 24mm;
}
#invoice-POS .itemtext {
  font-size: .5em;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
}

    </style>

  <script>
  window.console = window.console || function(t) {};
</script>



  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>


</head>

<body translate="no" >


  <div id="invoice-POS">

    <center id="top">
      <div class="logo"></div>
      <div class="info">
        <h2>Rizkigroups Klinik</h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->

    <div id="mid">
      <div class="info">
        <h2>Id Transaksi</h2>
        <p>
           Id Transaksi : {{ $nomor_pemesanan }}</br>
        </p>
        <h2>Tanggal Transaksi</h2>
        <p>
           Tanggal Transaksi : {{ $tanggal_transaksi }}</br>
        </p>
      </div>
    </div><!--End Invoice Mid-->

    <div id="bot">

                    <div id="table">
                        <table>
                            <tr class="tabletitle">
                                <td class="item"><h2>Item</h2></td>
                                <td class="Hours"><h2>Qty</h2></td>
                                <td class="Rate"><h2>Harga</h2></td>
                            </tr>

                            @foreach ($item as $row)
                                <tr class="service">
                                    <td class="tableitem"><p class="itemtext">{{ $row->obat->pluck('nama_obat')[0] }}</p></td>
                                    <td class="tableitem"><p class="itemtext">{{ $row->jumlah }}</p></td>
                                    @php
                                        $harga = $row->obat->pluck('harga_jual')[0];
                                    @endphp
                                    <td class="tableitem"><p class="itemtext">Rp{{ number_format($harga) }},</p></td>
                                </tr>
                            @endforeach

                            <tr class="tabletitle">
                                <td></td>
                                <td class="Rate"><h2>Subtotal</h2></td>
                                <td class="payment"><h2>Rp{{ number_format($total_harga) }},</h2></td>
                            </tr>
                            <tr class="tabletitle">
                              <td></td>
                              <td class="Rate"><h2>Total Bayar</h2></td>
                              <td class="payment"><h2>Rp{{ number_format($total_bayar) }},</h2></td>
                          </tr>
                            <tr class="tabletitle">
                                <td></td>
                                <td class="Rate"><h2>Kembalian</h2></td>
                                <td class="payment"><h2>Rp{{ number_format($kembalian) }},</h2></td>
                            </tr>

                        </table>
                    </div><!--End Table-->

                    <div id="legalcopy">
                        <p class="legal"><strong>Terimakasih Telah Berbelanja!</strong>  Barang yang sudah dibeli tidak dapat dikembalikan. Jangan lupa berkunjung kembali
                        </p>
                    </div>

                </div><!--End InvoiceBot-->
  </div><!--End Invoice-->

</body>

</html>
