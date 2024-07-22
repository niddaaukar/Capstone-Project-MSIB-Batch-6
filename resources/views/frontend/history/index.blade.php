@extends('frontend.layout')

@section('content')
    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <li class="text-white">{{ $error }}</li>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row justify-content-center g-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <!-- Tabel Riwayat Sewa -->
                        <h5 class="mb-4">Riwayat Sewa</h5>
                        <div class="table-responsive">
                            <table id="data-table"
                                class="table table-bordered table-striped table-hover text-nowrap table-responsive text-center align-middle w-100">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Booking</th>
                                        <th>Jenis Kendaraan</th>
                                        <th>Kendaraan</th>
                                        <th>Plat Nomor</th>
                                        <th>Tanggal Mulai Sewa</th>
                                        <th>Tanggal Selesai Sewa</th>
                                        <th>Metode Pickup</th>
                                        <th>Durasi</th>
                                        <th>Driver</th>
                                        <th>Total Biaya</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $index => $booking)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $booking->booking_code }}</td>
                                            <td>{{ $booking->vehicle_type == 'car' ? 'Mobil' : 'Motor' }}</td>
                                            <td>{{ $booking->vehicle->nama_mobil ?? $booking->vehicle->nama_motor }}</td>
                                            <td>{{ $booking->vehicle->plat_nomor }}</td>
                                            <td>{{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('j F Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($booking->end_date)->translatedFormat('j F Y') }}</td>
                                            <td>{{ $booking->pickup }}</td>
                                            <td>{{ $booking->days_count }} Hari</td>
                                            <td>{{ $booking->with_driver ? 'Ya' : 'Tidak' }}</td>
                                            <td>Rp {{ number_format($booking->total_fee, 0, ',', '.') }}</td>
                                            <td>{{ $booking->booking_status }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    {{-- <a href="{{ route('booking_confirmation', ['booking_code' => $booking->booking_code, 'vehicle_type' => $booking->vehicle_type, 'vehicle_id' => $booking->vehicle_id]) }}" --}}
                                                    <a href="{{ route('booking_detail', ['booking_code' => $booking->booking_code]) }}"
                                                        class="btn btn-primary btn-sm me-2 text-center py-4">Detail</a>
                                                    @if (!in_array($booking->booking_status, ['Selesai', 'Belum Dikembalikan', 'Menunggu Konfirmasi', 'Dibatalkan']))
                                                        <button class="btn btn-danger btn-sm text-center"
                                                            data-bs-toggle="modal" data-bs-target="#batalkanModal"
                                                            data-booking-code="{{ $booking->booking_code }}"
                                                            data-booking-status="{{ $booking->booking_status }}"
                                                            data-vehicle-name="{{ $booking->vehicle->nama_mobil ?? $booking->vehicle->nama_motor }}">
                                                            Batalkan
                                                        </button>
                                                    @endif
                                                    @if ($booking->booking_status == 'Selesai')
                                                        @php
                                                            $feedback = \App\Models\Feedback::where(
                                                                'booking_code',
                                                                $booking->booking_code,
                                                            )
                                                                ->where('user_id', Auth::user()->id)
                                                                ->first();
                                                        @endphp
                                                        @if ($feedback)
                                                            <button class="btn btn-secondary btn-sm text-center"
                                                                disabled>Anda sudah memberikan feedback</button>
                                                        @else
                                                            <button class="btn btn-success btn-sm text-center"
                                                                data-bs-toggle="modal" data-bs-target="#feedbackModal"
                                                                data-booking-code="{{ $booking->booking_code }}"
                                                                data-vehicle-type="{{ $booking->vehicle_type }}"
                                                                data-vehicle-id="{{ $booking->vehicle_id }}">Beri
                                                                Feedback</button>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Batalkan Modal -->
    <div class="modal fade" id="batalkanModal" tabindex="-1" aria-labelledby="batalkanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="batalkanModalLabel">Batalkan Sewa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('history.cancel') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="booking_code">Kode Booking</label>
                            <span class="text-danger text-lg">*</span>
                            <input type="text" class="form-control" name="booking_code" id="booking_code" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="vehicle_name">Nama Kendaraan</label>
                            <span class="text-danger text-lg">*</span>
                            <input type="text" class="form-control" name="vehicle_name" id="vehicle_name" readonly>
                        </div>
                        <div id="paymentSection" style="display: none;">
                            <div class="mb-3">
                                <label for="proof_payment">Bukti Transfer</label>
                                <span class="text-danger text-lg">*</span>
                                <input type="file" class="form-control" name="proof_payment" id="proof_payment"
                                    accept="image/*">
                                <p class="text-sm mt-1">Maksimal 2 MB</p>
                            </div>
                            <div class="mb-3">
                                <label for="refund_account">Rekening Bank atau Dompet Digital
                                    <span class="text-danger text-lg">*</span>
                                </label>
                                <textarea class="form-control" name="refund_account" id="refund_account" rows="2"
                                    placeholder="Contoh: BRI 1234567890 atau OVO 081234567890"></textarea>
                                <p class="text-sm">Contoh: BRI 1234567890 atau OVO 081234567890</p>
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="reason">Alasan Pembatalan
                                <span class="text-danger text-lg">*</span>
                            </label>
                            <textarea class="form-control" name="reason" id="reason" rows="3" placeholder="Alasan pembatalan" required></textarea>
                        </div>
                        <p class="text-danger mt-3">* Wajib diisi</p>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Batalkan Sewa</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Form Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('feedback.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="avatar" value="{{ Auth::user()->avatar }}">
                        <input type="hidden" name="booking_code" id="booking_code">
                        <input type="hidden" name="vehicle_type" id="vehicle_type">
                        <input type="hidden" name="vehicle_id" id="vehicle_id">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="mb-3">
                            <label for="feedback">Feedback</label>
                            <span class="text-danger text-lg">*</span>
                            <textarea class="form-control" id="feedback" name="feedback" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rating">Rating</label>
                            <span class="text-danger text-lg">*</span>
                            <div class="rating-stars">
                                <span class="star" data-rating="1"><i class="fas fa-star text-secondary"></i></span>
                                <span class="star" data-rating="2"><i class="fas fa-star text-secondary"></i></span>
                                <span class="star" data-rating="3"><i class="fas fa-star text-secondary"></i></span>
                                <span class="star" data-rating="4"><i class="fas fa-star text-secondary"></i></span>
                                <span class="star" data-rating="5"><i class="fas fa-star text-secondary"></i></span>
                            </div>
                            <input type="hidden" name="rating" id="rating-value" value="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_name">Nama Pengguna</label>
                            <span class="text-danger text-lg">*</span>
                            <input type="text" class="form-control" id="user_name" name="user_name"
                                value="{{ Auth::user()->name }}" required>
                        </div>
                        <p class="text-danger">* Wajib diisi</p>
                        <button type="submit" class="btn btn-primary">Kirim Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var feedbackModal = document.getElementById('feedbackModal');
        feedbackModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var bookingCode = button.getAttribute('data-booking-code');
            var vehicleType = button.getAttribute('data-vehicle-type');
            var vehicleId = button.getAttribute('data-vehicle-id');

            var modalBookingCode = feedbackModal.querySelector('#booking_code');
            var modalVehicleType = feedbackModal.querySelector('#vehicle_type');
            var modalVehicleId = feedbackModal.querySelector('#vehicle_id');

            modalBookingCode.value = bookingCode;
            modalVehicleType.value = vehicleType;
            modalVehicleId.value = vehicleId;
        });

        var batalkanModal = document.getElementById('batalkanModal');
        batalkanModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var bookingCode = button.getAttribute('data-booking-code');
            var vehicleName = button.getAttribute('data-vehicle-name');
            var bookingStatus = button.getAttribute('data-booking-status');

            var modalBookingCode = batalkanModal.querySelector('#booking_code');
            var modalVehicleName = batalkanModal.querySelector('#vehicle_name');
            var paymentSection = batalkanModal.querySelector('#paymentSection');

            modalBookingCode.value = bookingCode;
            modalVehicleName.value = vehicleName;

            if (bookingStatus === 'Pembayaran Terkonfirmasi') {
                paymentSection.style.display = 'block';
            } else {
                paymentSection.style.display = 'none';
            }
        });


        document.addEventListener("DOMContentLoaded", function() {
            const stars = document.querySelectorAll(".rating-stars .star");
            const ratingValue = document.getElementById("rating-value");

            stars.forEach((star) => {
                star.addEventListener("click", function() {
                    const rating = parseInt(star.getAttribute("data-rating"));
                    ratingValue.value = rating;

                    stars.forEach((s) => {
                        s.querySelector("i").classList.remove("text-warning");
                        s.querySelector("i").classList.add("text-secondary");
                    });

                    for (let i = 0; i < rating; i++) {
                        stars[i].querySelector("i").classList.add("text-warning");
                        stars[i].querySelector("i").classList.remove("text-secondary");
                    }
                });
            });
        });
    </script>
@endsection

@include('layouts.datatable')
