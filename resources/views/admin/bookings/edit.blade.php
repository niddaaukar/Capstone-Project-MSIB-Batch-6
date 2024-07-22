@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data</h3>
                            <a href="{{ route('admin.bookings.index') }}" class="btn btn-success shadow-sm float-right"> <i
                                    class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <row class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nama_penyewa" class="col-form-label">Nama Penyewa:</label>
                                        <input type="text" class="form-control" id="nama_penyewa"
                                            value="{{ $booking->user->name }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kendaraan" class="col-form-label">Kendaraan:</label>
                                        <input type="text" class="form-control" id="kendaraan"
                                            value="{{ $booking->vehicle_type == 'car' ? $booking->vehicle->nama_mobil : $booking->vehicle->nama_motor }} - {{ $booking->vehicle->type->nama }}"
                                            readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_mulai" class="col-form-label">Tanggal Mulai Sewa:</label>
                                        <input type="text" class="form-control" id="tanggal_mulai"
                                            value="{{ $booking->start_date }}" name="start_date" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_selesai" class="col-form-label">Tanggal Selesai Sewa:</label>
                                        <input type="text" class="form-control" id="tanggal_selesai"
                                            value="{{ $booking->end_date }}" name="end_date" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="total_hari" class="col-form-label">Total Hari:</label>
                                        <input type="text" class="form-control" id="total_hari"
                                            value="{{ $booking->days_count }} Hari" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pickup" class="col-form-label">Metode Pickup:</label>
                                        <input type="text" class="form-control" id="pickup"
                                            value="{{ $booking->pickup }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="driver" class="col-form-label">Menggunakan Driver:</label>
                                        <input type="text" class="form-control" id="driver"
                                            value="{{ $booking->with_driver ? 'Ya' : 'Tidak' }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="harga_sewa" class="col-form-label">Harga Sewa Mobil
                                            <strong>({{ $booking->days_count }} Hari)</strong></label>
                                        <input type="text" class="form-control" id="harga_sewa"
                                            value="Rp {{ number_format($booking->booking_fee, 0, ',', '.') }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="biaya_driver" class="col-form-label">Biaya Driver
                                            <strong>({{ $booking->days_count }} Hari)</strong></label>
                                        <input type="text" class="form-control" id="biaya_driver"
                                            value="Rp {{ number_format($booking->driver_fee, 0, ',', '.') }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="total_harga" class="col-form-label">Total Harga:</label>
                                        <input type="text" class="form-control" id="total_harga"
                                            value="Rp {{ number_format($booking->total_fee, 0, ',', '.') }}" readonly>
                                    </div>
                                    <form method="post" action="{{ route('admin.bookings.update', $booking) }}">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label for="booking_status" class="col-form-label">Status:</label>
                                            <select name="booking_status" id="booking_status" class="form-control">
                                                <option value="Menunggu Pembayaran" {{ $booking->booking_status == 'Menunggu Pembayaran' ? 'selected' : '' }}>
                                                    Menunggu Pembayaran
                                                </option>
                                                <option value="Menunggu Konfirmasi" {{ $booking->booking_status == 'Menunggu Konfirmasi' ? 'selected' : '' }}>
                                                    Menunggu Konfirmasi
                                                </option>
                                                <option value="Pembayaran Terkonfirmasi" {{ $booking->booking_status == 'Pembayaran Terkonfirmasi' ? 'selected' : '' }}>
                                                    Pembayaran Terkonfirmasi
                                                </option>
                                                <option value="Belum Dikembalikan" {{ $booking->booking_status == 'Belum Dikembalikan' ? 'selected' : '' }}>
                                                    Belum Dikembalikan
                                                </option>
                                                <option value="Selesai" {{ $booking->booking_status == 'Selesai' ? 'selected' : '' }}>
                                                    Selesai
                                                </option>
                                                <option value="Dibatalkan" {{ $booking->booking_status == 'Dibatalkan' ? 'selected' : '' }}>
                                                    Dibatalkan
                                                </option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </form>
                                </div>
                            </row>
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
