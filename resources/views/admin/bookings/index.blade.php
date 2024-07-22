@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Sewa</h3>
                            {{-- <a href="{{ route('admin.bookings.pdf') }}" class="btn btn-danger float-right">Cetak PDF</a> --}}
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cetakModal">
                                Cetak PDF
                                <i class="fa-solid fa-file-pdf ms-2"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="cetakModal" tabindex="-1" aria-labelledby="cetakModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cetak PDF Sewa</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.bookings.pdf') }}" method="GET">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="start_date" class="col-form-label">Dari
                                                                Tanggal:</label>
                                                            <input type="date" class="form-control" id="start_date" required
                                                                name="start_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="end_date" class="col-form-label">Sampai
                                                                Tanggal:</label>
                                                            <input type="date" class="form-control" id="end_date" required
                                                                name="end_date">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Cetak</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table"
                                    class="table table-bordered table-striped table-hover text-nowrap table-responsive text-center align-middle w-100">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Unit</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Durasi</th>
                                            <th>Pickup</th>
                                            <th>Total Biaya</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($bookings as $booking)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $booking->user->name }}</td>
                                                <td>{{ $booking->vehicle_type == 'car' ? 'Mobil' : 'Motor' }}</td>
                                                <td>{{ $booking->vehicle_type == 'car' ? $booking->vehicle->nama_mobil : $booking->vehicle->nama_motor }}
                                                </td>
                                                {{-- <td>{{ $booking->vehicle_type == 'car' ? $booking->vehicle->nama_mobil : $booking->vehicle->nama_motor }} - {{ $booking->vehicle->type->nama }}</td> --}}
                                                <td>{{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('j F Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($booking->end_date)->translatedFormat('j F Y') }}</td>
                                                <td>{{ $booking->days_count }} Hari</td>
                                                <td>{{ $booking->pickup }}</td>
                                                <td>Rp {{ number_format($booking->total_fee, 0, ',', '.') }}</td>
                                                <td>{{ $booking->booking_status }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('admin.bookings.edit', $booking) }}"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="delete-form">
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
