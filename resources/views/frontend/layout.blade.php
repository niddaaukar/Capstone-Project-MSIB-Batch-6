<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $setting->nama_perusahaan }} | Ankavi Team</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="icon" href="{{ asset('favicon-96x96.png') }}" sizes="96x96" type="image/png">
    <link rel="stylesheet" href="{{ asset('frontend/fonts/icomoon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.fancybox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/fonts/flaticon/font/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    <link id="pagestyle" href="{{ asset('frontend/css/argon/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend/css/animate/animate.min.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
        rel="stylesheet">
    @stack('style-alt')
    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100">
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div class="container-fluid nav-bar bg-transparent">
        @include('layouts.navbar')
    </div>

    <div class="flex-grow-1">
        @yield('content')
    </div>

    <!-- Footer Start -->
    @if (url()->current() == url('/'))
        <div class="container-fluid bg-dark text-light mt-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row gx-5">
                    <div class="col-lg-4 col-md-6 footer-about">
                        <div
                            class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary p-4">
                            @php
                                $settings = \App\Models\Setting::first();
                            @endphp
                            <h1 class="m-0 text-white mt-3">{{ $settings->nama_perusahaan }}</h1>
                            <p class="mt-3 mb-4">{{ $settings->footer_description }}</p>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <div class="row gx-5">
                            <div class="col-lg-4 col-md-12 pt-5 mb-5">
                                <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                    <h3 class="text-light mb-0">Hubungi Kami</h3>
                                </div>
                                <div class="d-flex mb-2">
                                    <i class="bi bi-geo-alt text-primary me-2"></i>
                                    <p class="mb-0">{{ $settings->alamat }}</p>
                                </div>
                                <div class="d-flex mb-2">
                                    <i class="bi bi-envelope-open text-primary me-2"></i>
                                    <p class="mb-0">{{ $settings->email }}</p>
                                </div>
                                <div class="d-flex mb-2">
                                    <i class="bi bi-telephone text-primary me-2"></i>
                                    <p class="mb-0">{{ $settings->phone }}</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                                <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                    <h3 class="text-light mb-0">Link Cepat</h3>
                                </div>
                                <div class="link-animated d-flex flex-column justify-content-start">
                                    <a class="text-light mb-2" href={{ url('/') }}><i
                                            class="bi bi-arrow-right text-primary me-2"></i>Beranda</a>
                                    <a class="text-light mb-2" href={{ url('/tentang-kami') }}><i
                                            class="bi bi-arrow-right text-primary me-2"></i>Tentang Kami</a>
                                    <a class="text-light mb-2" href={{ url('/kontak') }}><i
                                            class="bi bi-arrow-right text-primary me-2"></i>Kontak</a>
                                    <a class="text-light" href="#faqs"><i
                                            class="bi bi-arrow-right text-primary me-2"></i>FAQs</a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                                <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                    <h3 class="text-light mb-0">Sosial Media</h3>
                                </div>
                                <div class="d-flex mt-4">
                                    <a class="btn btn-social btn-primary me-2" href="{{ $settings->facebook }}"
                                        target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-social btn-primary me-2" href="{{ $settings->instagram }}"
                                        target="_blank"><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-social btn-primary me-2" href="{{ $settings->twitter }}"
                                        target="_blank"><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-social btn-primary" href="{{ $settings->linkedin }}"
                                        target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid text-white @if (url()->current() !== url('/')) mt-5 @endif"
        style="background: #061429;">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-6">
                    <div class="footer-bottom d-flex align-items-center justify-content-center w-100"
                        style="height: 75px;">
                        <p class="mb-0">&copy; 2024 OtoRent. All Rights Reserved. Designed by <a>Ankavi Team</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer End -->


    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/argon/core/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/argon/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('frontend/js/aos.js') }}"></script>
    <script src="{{ asset('frontend/js/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/js/wow/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('message'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '{{ session('alert-type') == 'success'
                        ? 'Berhasil!'
                        : (session('alert-type') == 'error'
                            ? 'Gagal!'
                            : (session('alert-type') == 'info'
                                ? 'Berhasil!'
                                : '')) }}',
                    text: '{{ session('message') }}',
                    icon: '{{ session('alert-type') }}',
                    confirmButtonColor: '#5e72e4',
                    confirmButtonText: 'OK',
                    timer: 1500
                });
            });
        </script>
    @endif
    @stack('script-alt')
    @stack('scripts')
</body>

</html>
