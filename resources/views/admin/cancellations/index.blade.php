@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Pembatalan Sewa</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table"
                                    class="table table-bordered table-striped table-hover text-nowrap table-responsive text-center align-middle w-100">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Booking</th>
                                            <th>Kendaraan</th>
                                            <th>Nama</th>
                                            <th>Alasan</th>
                                            <th>Rekening Pengembalian</th>
                                            <th>Bukti Pembayaran</th>
                                            <th>Bukti Pengembalian</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($cancellations as $cancellation)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cancellation->booking_code }}</td>
                                                <td>{{ $cancellation->vehicle_name }}</td>
                                                <td>{{ $cancellation->user->name }}</td>
                                                <td>{{ $cancellation->reason }}</td>
                                                <td>{{ $cancellation->refund_account }}</td>
                                                <td>
                                                    <a href="{{ Storage::url($cancellation->proof_payment) }}" target="_blank">
                                                        <img src="{{ Storage::url($cancellation->proof_payment) }}" alt="Bukti Pembayaran" width="100">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ Storage::url($cancellation->refund_proof) }}" target="_blank">
                                                        <img src="{{ Storage::url($cancellation->refund_proof) }}" alt="Bukti Pengembalian" width="100">
                                                    </a>
                                                </td>
                                                <td>{{ $cancellation->booking->booking_status }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('admin.cancellations.edit', $cancellation) }}"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.cancellations.destroy', $cancellation) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@include('layouts.datatable')