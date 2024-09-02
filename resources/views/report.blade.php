<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rincian Biaya Uang Pendidikan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-size: 0.38rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 4px;
            text-align: center;
        }
        th {
            background-color: #d9e1f2;
        }
        .uang-pangkal {
            background-color: #ffff00;
        }
        .daftar-ulang {
            background-color: #ccffcc;
        }
        .spp {
            background-color: #ffcccc;
        }
    </style>
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <th rowspan="3">NO</th>
          <th rowspan="3">NAMA LENGKAP SISWA</th>
          <th rowspan="3">NISN</th>
          <th rowspan="3">ROMBEL</th>
          <th colspan="15">RINCIAN BIAYA UANG PENDIDIKAN SISWA YAYASAN PENDIDIKAN SURAU MINANG</th>
        </tr>
        <tr>
          <th colspan="4" class="uang-pangkal">UANG PANGKAL</th>
          <th colspan="4" class="daftar-ulang">DAFTAR ULANG</th>
          <th colspan="7" class="spp">SPP</th>
        </tr>
        <tr>
          <th class="uang-pangkal">NOMINAL TAGIHAN</th>
          <th class="uang-pangkal">SISA TAGIHAN</th>
          <th class="uang-pangkal">STATUS</th>
          <th class="uang-pangkal">TRANSAKSI</th>
          <th class="daftar-ulang">NOMINAL TAGIHAN</th>
          <th class="daftar-ulang">SISA TAGIHAN</th>
          <th class="daftar-ulang">STATUS</th>
          <th class="daftar-ulang">TRANSAKSI</th>
          <th class="spp">BULAN</th>
          <th class="spp">TAHUN</th>
          <th class="spp">NOMINAL TAGIHAN</th>
          <th class="spp">STATUS</th>
          <th class="spp">TANGGAL PEMBAYARAN</th>
          <th class="spp">TOTAL LUNAS</th>
          <th class="spp">TOTAL BELUM LUNAS</th>
        </tr>
      </thead>
      <tbody>
        <!-- Contoh data -->
        @foreach ($students as $student)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $student->name }}</td>
          <td>{{ $student->nisn }}</td>
          <td>{{ $student->grade->name }}</td>
          <td class="uang-pangkal">
            @foreach ($student->payments->where('fee_id', 1) as $payment)
               Rp {{ number_format($payment->amount, 0, ',', '.') }}
            @endforeach
          </td>
          <td class="uang-pangkal">
            @foreach ($student->payments->where('fee_id', 1) as $payment)
                Rp {{ number_format($payment->amount - $payment->paymentDetails->sum('amount'), 0, ',', '.') }}
            @endforeach
          </td>
          <td class="uang-pangkal">
            @foreach ($student->payments->where('fee_id', 1) as $payment)
                {{ $payment->status }}
            @endforeach
          </td>
          <td class="uang-pangkal">
            @foreach ($student->payments->where('fee_id', 1) as $payment)
                @foreach ($payment->paymentDetails as $detail)
                  Rp {{ number_format($detail->amount, 0, ',', '.') }} {{ $detail->created_at->format('d/m/Y') }} <br>
                @endforeach
            @endforeach
          </td>
          <td class="daftar-ulang">
            @foreach ($student->payments->where('fee_id', 2) as $payment)
                Rp {{ number_format($payment->amount, 0, ',', '.') }}
            @endforeach
          </td>
          <td class="daftar-ulang">
            @foreach ($student->payments->where('fee_id', 2) as $payment)
                Rp {{ number_format($payment->amount - $payment->paymentDetails->sum('amount'), 0, ',', '.') }}
            @endforeach
          </td>
          <td class="daftar-ulang">
            @foreach ($student->payments->where('fee_id', 2) as $payment)
                {{ $payment->status }}
            @endforeach
          </td>
          <td class="daftar-ulang">
            @foreach ($student->payments->where('fee_id', 2) as $payment)
                @foreach ($payment->paymentDetails as $detail)
                  Rp {{ number_format($detail->amount, 0, ',', '.') }} {{ $detail->created_at->format('d/m/Y') }} <br>
                @endforeach
            @endforeach
          </td>
          <td class="spp">
            @foreach ($student->sppStudents as $spp)
                {{ $spp->bulan }} <br>
            @endforeach
          </td>
          <td class="spp">
            @foreach ($student->sppStudents as $spp)
                {{ $spp->tahun }} <br>
            @endforeach
          </td>
          <td class="spp">
            @foreach ($student->sppStudents as $spp)
                Rp {{ number_format($spp->price, 0, ',', '.') }} <br>
            @endforeach
          </td>
          <td class="spp">
            @foreach ($student->sppStudents as $spp)
                {{ $spp->status }} <br>
            @endforeach
          </td>
          <td class="spp">
            @foreach ($student->sppStudents as $spp)
                {{ $spp->tanggal ?? 'Belum Bayar' }} <br>
            @endforeach
          </td>
          <td class="spp">
            {{ $student->sppStudents->where('status', 'LUNAS')->sum('price') }}
          </td>
          <td class="spp">
            {{ $student->sppStudents->where('status', '!=', 'LUNAS')->sum('price') }}
          </td>
        </tr>
        @endforeach
        <!-- Tambahkan data lainnya di sini -->
      </tbody>
    </table>
    {{-- <script>
        window.onload = function() {
            window.print();
        }
    </script> --}}
  </body>
</html>