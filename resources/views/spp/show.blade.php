<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">  
    <style>
      body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Times New Roman";
      }
  
      * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
      }
  
      .page {
        width: 210mm;
        min-height: 297mm;
        padding: 15mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        position: relative;
      }
  
      .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
      }
      
      td {
        padding-top: 5px;
      }

      .borderhr {
        color: black;
        background-color: black;
        border-color: black;
        height: 5px;
        opacity: 100;
      }
      
  
      @page {
        size: A4;
        margin: 0;
      }
  
      @media print {
  
        html,
        body {
          width: 210mm;
          height: 297mm;
        }
  
        .page {
          margin: 0;
          border: initial;
          border-radius: initial;
          width: initial;
          min-height: initial;
          box-shadow: initial;
          background: initial;
          page-break-after: always;
        }
      }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  </head>
  <body>
    <div class="page">
      <div class="row">
        <div class="col-3 d-flex align-self-top">
          <img src="{{ asset('logo-yayasan.png') }}" alt="" class="img-fluid" style="height: 100px;">
        </div>
        <div class="col-9">
          <p class="fw-bold" style="font-size: 16pt;">
            YAYASAN PENDIDIKAN SURAU MINANG<br> 
          </p>
          <p>
            <span class="fw-bold" style="font-size: 9pt;">TKIT</span>
            Surau Minang - <span class="fw-bold" style="font-size: 9pt;">SDIT</span>
            Padang Islamic School - <span class="fw-bold" style="font-size: 9pt;">SMPIT</span>
            Surau Minang <br>
            <span style="font-size: 8pt;">Kampung Lalang (Belakang Kantor Pos Kuranji), Kel . Pasar Ambacang Kec. Kuranji, Kota Padang, Prov. Sumbar <br> Telp. 0831 4939 5058</span>
          </p>
        </div>
      </div>
      <hr class="borderhr fw-bold m-0">
      <p class="fw-bold text-center mt-4" style="font-size: 15pt;">
        <u>KWITANSI DIGITAL PEMBAYARAN</u><br>
      </p>
      <p>Sudah terima dari <span class="fw-bold">{{ $item->student->studentParent->name }} - {{ $item->student->name }} - {{ $item->student->grade->name }}</span></p>
      <p>Untuk pembayaran</p>
      <p class="text-center fw-bold" style="font-size: 18pt;"><u>SPP BULAN {{ $item->bulan }} {{ $item->tahun }}</u></p>
      
      <div class="row mt-4">
        <div class="col-8">
          <p>Jumlah Rp. {{ number_format($item->student->studentFee->price, 0, ',', '.') }},-</p>
        </div>
        <div class="col-4">
          <p>Padang, {{ date('d F Y', strtotime($item->tanggal ?? now())) }}</p>
        </div>
      </div>
      
      <div class="row mt-3">
        <div class="col-9">
          <div class="border border-dark p-2">
            <p class="mb-1">NAMA BANK      : BANK NAGARI SYARIAH</p>
            <p class="mb-1">NOMOR REKENING : 7100.0201.0217.50</p>
            <p class="mb-0">ATAS NAMA      : YAYASAN PENDIDIKAN SURAU MINANG</p>
          </div>
        </div>
        <div class="col-3 text-center">
          <div id="qrcode"></div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    <script>
      new QRCode(document.getElementById("qrcode"), {
        text: "{{ route('spp.show', $item->id) }}",
        width: 150,
        height: 150
      });
    </script>
  </body>
</html>