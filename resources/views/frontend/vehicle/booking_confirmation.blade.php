@extends('frontend.layout')
@php
    use Carbon\Carbon;
    $timezone = 'Asia/Jakarta';
    $now = Carbon::now($timezone);
@endphp
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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mb-4">Booking Konfirmasi</h1>
                <div class="table-responsive">
                    <table class="table table-responsive table-bordered table-hover table-striped align-middle">
                        <tbody>
                            <tr>
                                <th scope="row">Booking Kode</th>
                                <td>{{ $booking->booking_code }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Penyewa</th>
                                <td>{{ $booking->user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kendaraan</th>
                                <td>{{ $booking->vehicle_type == 'car' ? $booking->vehicle->nama_mobil : $booking->vehicle->nama_motor }}
                                    - {{ $booking->vehicle->type->nama }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Plat Nomor</th>
                                <td>
                                    @if ($booking->vehicle_type == 'car')
                                        {{ $booking->vehicle->plat_nomor }}
                                    @elseif ($booking->vehicle_type == 'motorcycle')
                                        {{ $booking->vehicle->plat_nomor }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Metode Pickup</th>
                                <td>{{ $booking->pickup }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Hari Sewa</th>
                                <td>{{ $booking->days_count }} Hari</td>
                            </tr>
                            <tr>
                                <th scope="row">Mulai Sewa</th>
                                <td>{{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('j F Y') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Selesai Sewa</th>
                                <td>{{ \Carbon\Carbon::parse($booking->end_date)->translatedFormat('j F Y') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Biaya Sewa {{ $booking->vehicle_type == 'car' ? 'Mobil' : 'Motor' }}
                                    ({{ $booking->days_count }} Hari)</th>
                                <td>Rp {{ number_format($booking->booking_fee, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Biaya Driver ({{ $booking->days_count }} Hari)</th>
                                <td>Rp {{ number_format($booking->driver_fee, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Total Biaya</th>
                                <td>Rp {{ number_format($booking->total_fee, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Status Sewa</th>
                                <td>{{ ucfirst(str_replace('_', ' ', $booking->booking_status)) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                @if ($booking->booking_status == 'Menunggu Pembayaran')
                    <h1>Pembayaran</h1>
                    <h3>Silahkan lakukan pembayaran terlebih dahulu!</h3>
                    <h5>Pembayaran otomatis batal setelah 24 jam</h5>
                    <div class="d-flex align-items-center">
                        <h5 class="me-2">Sisa waktu Pembayaran:</h5>
                        <h1 id="countdown" class="ms-2"></h1>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Booking creation time from the server (UTC +0)
                            const bookingCreatedAtUTC = new Date("{{ $booking->created_at }}").getTime();
                            // Convert to UTC +7
                            const bookingCreatedAt = bookingCreatedAtUTC + (7 * 60 * 60 * 1000);
                            // 24 hours in milliseconds
                            const countdownDuration = 24 * 60 * 60 * 1000;
                            const endTime = bookingCreatedAt + countdownDuration;

                            function updateCountdown() {
                                const now = new Date().getTime();
                                const distance = endTime - now;
                                if (distance < 0) {
                                    document.getElementById('countdown').innerHTML = "Pembayaran telah dibatalkan.";
                                    return;
                                }
                                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                document.getElementById('countdown').innerHTML = hours + "h " +
                                    minutes + "m " + seconds + "s ";
                            }
                            // Update the countdown every 1 second
                            setInterval(updateCountdown, 1000);
                            // Initialize the countdown
                            updateCountdown();
                        });
                    </script>
                @elseif ($booking->booking_status == 'Menunggu Konfirmasi')
                    <h3>Silahkan tunggu konfirmasi dari admin</h3>
                @elseif ($booking->booking_status == 'Pembayaran Terkonfirmasi')
                    @if ($booking->pickup == 'Ambil Sendiri')
                        <!--warning user untuk pengembalian-->
                        <h3>Silahkan ambil kendaraan di lokasi kami</h3>
                        <h4>Jika Anda mengembalikan kendaraan melebihi waktu sewa. Maka akan dikenakan denda sebesar 1 hari
                            sewa</h4>
                    @else
                        <!--warning user untuk pengembalian-->
                        <h3>Silahkan tunggu kendaraan diantar ke lokasi Anda!</h3>
                        <h4>Jika Anda mengembalikan kendaraan melebihi waktu sewa. Maka akan dikenakan denda sebesar 1 hari
                            sewa</h4>
                    @endif
                @elseif ($booking->booking_status == 'Belum Dikembalikan')
                    <!--warning user untuk pengembalian-->
                    <h3>Silahkan kembalikan kendaraan maksimal jam 12 malam pada tanggal {{ $booking->end_date }}</h3>
                    @php
                        $endDate = Carbon::parse($booking->end_date)
                            ->addDays()
                            ->startOfDay();
                    @endphp
                    @if ($now->lessThan($endDate))
                        <p>Jika Anda melebihi batas sewa maka dikenakan denda.</p>
                    @else
                        @php
                            $lateDays = $now->diffInDays($endDate) + 1;
                            $lateFee = $booking->total_fee * $lateDays;
                        @endphp
                        <p>Anda melebihi sewa selama {{ $lateDays }} hari</p>
                        <p>Anda dikenakan denda sebesar: Rp {{ number_format($lateFee, 0, ',', '.') }}</p>
                    @endif
                @elseif ($booking->booking_status == 'Selesai')
                    <h3>Terima kasih telah menggunakan sewa kendaraan kami! Sampai jumpa di pemesanan selanjutnya!</h3>
                    <div class="col-md-12">
                        <div class="d-flex align-items-center mb-3" data-bs-toggle="collapse" href="#feedbackForm"
                            aria-expanded="false">
                            <div style="border-top: 1px solid #000; flex-grow: 1;"></div>
                            <span class="btn mx-3">Lihat Feedback</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        @foreach ($feedbacks as $feedback)
                            <div id="feedbackForm" class="collapse">
                                <h3 class="mt-4">Feedback Anda</h3>
                                <form action="{{ route('feedback.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="avatar" value="{{ Auth::user()->avatar }}">
                                    <input type="hidden" name="booking_code" value="{{ $booking->booking_code }}">
                                    <input type="hidden" name="vehicle_type" value="{{ $booking->vehicle_type }}">
                                    <input type="hidden" name="vehicle_id" value="{{ $booking->vehicle_id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                    <div class="mb-3">
                                        <label for="feedback">Feedback</label>
                                        <textarea class="form-control bg-light" id="feedback" name="feedback" rows="3" required disabled>{{ $feedback->feedback }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rating">Rating</label>
                                        <div class="rating-stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $feedback->rating)
                                                    <span class="star" data-rating="{{ $i }}"><i
                                                            class="fas fa-star text-warning"></i></span>
                                                @else
                                                    <span class="star" data-rating="{{ $i }}"><i
                                                            class="fas fa-star text-secondary"></i></span>
                                                @endif
                                            @endfor
                                        </div>
                                        <input type="hidden" name="rating" id="rating-value" value="0" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="user_name">Nama Pengguna</label>
                                        <input type="text" class="form-control bg-light" id="user_name" name="user_name"
                                            value="{{ Auth::user()->name }}" required disabled>
                                    </div>
                        @endforeach
                        </form>
                    </div>
                @elseif ($booking->booking_status == 'Dibatalkan')
                    <h3>Pemesanan Anda telah dibatalkan</h3>
                    @if ($booking->cancellation && $booking->cancellation->refund_proof)
                        <div class="mt-3">
                            <h4>Bukti Pengembalian Dana</h4>
                            <img src="{{ Storage::url($booking->cancellation->refund_proof) }}" alt="Bukti Pengembalian"
                                width="100%">
                        </div>
                    @endif
                @endif
                @if ($booking->booking_status == 'Menunggu Pembayaran')
                    <button type="button" class="btn btn-primary" id="pay-button">
                        Bayar Sekarang
                    </button>
                @endif
            </div>
        </div>
    </div>
    </div>

@endsection

@section('styles')
    <style>
        .fa-chevron-down {
            font-size: 16px;
            color: #000;
        }

        .rating-stars {
            cursor: pointer;
        }

        .rating-stars .star {
            font-size: 24px;
            color: #ccc;
            transition: color 0.2s;
        }

        .rating-stars .star.selected i {
            color: gold !important;
        }
    </style>
@endsection

@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $booking->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    window.location.href = "{{ route('booking_success', $booking->booking_code) }}";
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endpush
