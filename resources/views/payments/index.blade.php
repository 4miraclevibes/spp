@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mt-3">
        <h5 class="card-header">Daftar Pembayaran</h5>
        <div class="card-body">
            <a href="{{ route('payments.create') }}" class="btn btn-primary btn-sm mb-3">Tambah Pembayaran</a>
            <div class="table-responsive text-nowrap p-3">
                <table class="table" id="example">
                    <thead>
                        <tr class="text-nowrap table-dark">
                            <th class="text-white">No</th>
                            <th class="text-white">User</th>
                            <th class="text-white">Nama Siswa</th>
                            <th class="text-white">Fee Type</th>
                            <th class="text-white">Jumlah Pembayaran</th>
                            <th class="text-white">Created At</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $payment->user->name }}</td>
                            <td>{{ $payment->student->name }}</td>
                            <td>{{ $payment->fee->name }}</td>
                            <td>Rp. {{ number_format($payment->paymentDetails->where('status', 'paid')->sum('amount'), 0, ',', '.') }} / Rp. {{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td>{{ date_format($payment->created_at, 'd - F - Y | H:i:s') }}</td>
                            <td>{{ $payment->status }}</td>
                            <td>
                                <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-sm btn-warning"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                                <a href="{{ route('payments.details.index', $payment->id) }}" class="btn btn-sm btn-info"><i class="bx bx-info-circle me-1"></i>Detail</a>
                                <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" style="display: inline-block">
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