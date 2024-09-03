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
        font: 12pt "Poppins";
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
    @php
        $lastNumberFile = storage_path('app/last_number.txt');
        
        if (file_exists($lastNumberFile)) {
            $lastNumber = (int) file_get_contents($lastNumberFile);
        } else {
            $lastNumber = 0;
        }
        
        $currentNumber = $lastNumber + 1;
        
        file_put_contents($lastNumberFile, $currentNumber);
        
        $formattedNumber = sprintf('%03d', $currentNumber);
    @endphp
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
      
      <div class="content mt-4">
        <div class="d-flex justify-content-between">
          <table class="mb-3">
            <tr>
              <td>Nomor</td>
              <td>: {{ $formattedNumber }}/YYS-PSM/XII/{{ date('Y') }}</td>
            </tr>
            <tr>
              <td>Lampiran</td>
              <td>: -</td>
            </tr>
            <tr>
              <td>Perihal</td>
              <td class="fw-bold">: Tagihan Uang Pendidikan</td>
            </tr>
          </table>
          <div class="">
            <p class="">Padang, {{ date('d F Y') }}</p>
            <p>
              Kepada Yth :<br>
              Wali Murid<br>
              {{ $student->name }} ({{ $student->grade->name }})<br>
              di Tempat
            </p>
          </div>
        </div>
        

        
        <p>Assalamu'alaikum Warahmatullahi Wabarakatuh</p>
        
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           Segala puji bagi Allah Subhaanahu wa Ta'ala yang senantiasa melimpahkan <br>
           nikmat dan hidayah-Nya kepada kita. Shalawat dan Salam atas Nabi Muhammad <br>
           Shallallahu 'alaihi wa sallam, suri tauladan kita. Doa dan harapan semoga kita selalu <br>
          dalam lindungan Allah Subhaanahu wa Ta'ala. Aamiin.</p>
        
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Sehubungan dengan masuknya awal Bulan Desember Tahun Ajaran
           2024/2025, melalui surat ini kami beritahukan kepada Abu wa Ummu mengenai 
            Tagihan Uang Pendidikan <span class="fw-bold">{{ $student->name }}</span>, dengan rincian sebagai berikut:</p>
        
        <table class="table table-bordered mt-3 mb-3">
          <thead>
            <tr>
              <th>No.</th>
              <th>Uang Pendidikan</th>
              <th>Tagihan</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1.</td>
              <td>Uang Pangkal</td>
              <td>
                @foreach ($student->payments->where('fee_id', 2) as $payment)
                Rp {{ number_format($jumlahUp = $payment->amount, 0, ',', '.') }}
                @endforeach
              </td>
              <td>
                @foreach ($student->payments->where('fee_id', 2) as $payment)
                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                @endforeach
              </td>
            </tr>
            <tr>
              <td>2.</td>
              <td>Uang Daftar Ulang</td>
              <td>
                @foreach ($student->payments->where('fee_id', 1) as $payment)
                Rp {{ number_format($jumlahDu = $payment->amount, 0, ',', '.') }}
                @endforeach
              <td>                @foreach ($student->payments->where('fee_id', 1) as $payment)
                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                @endforeach</td>
            </tr>
            <tr>
              <td>3.</td>
              <td>Uang SPP {{$jumlahSpp = $student->sppStudents->where('status', 'BELUM BAYAR')->count() }} bulan</td>
              <td>{{ $jumlahSpp }} x {{ number_format($spp = $student->sppStudents->where('status', 'BELUM BAYAR')->first()->price, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($totalSpp = $jumlahSpp * $spp, 0, ',', '.') }}</td>
            </tr>
            <tr>
              <td colspan="3" class="text-end"><strong>Total</strong></td>
              <td><strong>Rp {{ number_format($jumlahUp + $jumlahDu + $totalSpp, 0, ',', '.') }}</strong></td>
            </tr>
          </tbody>
        </table>
        
        <p>Demikian kami sampaikan, atas perhatian dan kerjasamanya, kami ucapkan Jazaakumullahu Khayran.</p>
        
        <div class="text-end mt-5">
          <p>Hormat Kami</p>
          <br><br><br>
          <p><strong>Dr. Aulia Akbar, M.Si</strong><br>Ketua</p>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>