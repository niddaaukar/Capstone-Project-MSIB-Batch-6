@extends('frontend.layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-primary text-white">
                        <h4 class="text-white">{{ __('Verifikasi Alamat Email Anda') }}</h4>
                    </div>
                    <div class="card-body login-card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Silahkan verifikasi alamat email Anda.') }}
                            </div>
                        @endif

                        <p>{{ __('Agar Anda dapat menyewa kendaraan Kami.') }}</p>
                        <p>{{ __('Klik tombol dibawah ini.') }}</p>
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button id="resend-button" type="submit" class="btn btn-primary" disabled>
                                        {{ __('Mohon tunggu sebentar...') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@emretulek/jbvalidator"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var countdown = 3; // Set your countdown time in seconds
            var resendButton = document.getElementById('resend-button');

            var countdownInterval = setInterval(function () {
                if (countdown > 0) {
                    resendButton.textContent = `Mohon tunggu sebentar, ${countdown}`;
                    countdown--;
                } else {
                    clearInterval(countdownInterval);
                    resendButton.textContent = 'Klik di sini untuk meminta email verifikasi';
                    resendButton.disabled = false;
                }
            }, 1000); // Interval set to 1 second
        });
    </script>
@endsection
