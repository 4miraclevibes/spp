@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card mt-3">
    <h5 class="card-header">Daftar Detail Pembayaran</h5>
    <div class="card-body">
      <a href="{{ route('payments.details.create', $payment->id) }}" class="btn btn-primary btn-sm mb-3">Tambah Detail Pembayaran</a>
      <div class="table-responsive text-nowrap p-3">
        <table class="table" id="example">
          <thead>
            <tr class="text-nowrap table-dark">
              <th class="text-white">No</th>
              <th class="text-white">Fee Type</th>
              <th class="text-white">Jumlah Pembayaran</th>
              <th class="text-white">Status</th>
              <th class="text-white">Metode Pembayaran</th>
              <th class="text-white">Bukti Pembayaran</th>
              <th class="text-white">Tanggal Pembayaran</th>
              <th class="text-white">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($payment->paymentDetails as $paymentDetail)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $paymentDetail->payment->fee->name }}</td>
              <td>Rp. {{ number_format($paymentDetail->amount, 0, ',', '.') }}</td>
              <td>{{ $paymentDetail->status }}</td>
              <td>{{ $paymentDetail->payment_method }}</td>
              <td>
                @if ($paymentDetail->payment_proof)
                <a href="{{ Storage::url($paymentDetail->payment_proof) }}" target="_blank">Lihat Bukti</a>
                @else
                Tidak Ada Bukti
                @endif
              </td>
              <td>{{ date_format($paymentDetail->created_at, 'd - F - Y | H:i:s') }}</td>
              <td>
                <a href="{{ route('payments.details.edit', $paymentDetail->id) }}" class="btn btn-sm btn-warning"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                <form action="{{ route('payments.details.destroy', $paymentDetail->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" style="display: inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i>Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- / Content -->
@endsection