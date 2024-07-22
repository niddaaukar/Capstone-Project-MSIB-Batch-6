@extends('frontend.layout')

@section('content')
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5 wow fadeInLeft" data-wow-delay="0.1s">
                <h1 class="display-5 animated fadeIn mb-4>
                    <span class="text-primary">
                    {{ $setting->nama_perusahaan }}</span>
                    Solusi Perjalanan Anda!
                </h1>
                <h5 class="animated fadeIn pb-2">Temukan Mobil dan Motor terbaik untuk setiap perjalanan Anda!</h5>
                <h5 class="animated fadeIn pb-2">Sewa sekarang dan rasakan kenyamanannya!</h5>
                <h4><i class="fa fa-check text-primary me-3"></i>Mudah</h4>
                <h4><i class="fa fa-check text-primary me-3"></i>Aman</h4>
                <h4><i class="fa fa-check text-primary me-3"></i>Nyaman</h4>
                <a href="#more" class="btn btn-primary mt-3 py-3 px-5 me-3 animated fadeIn">Selengkapnya</a>
            </div>
            <div class="col-md-6 wow fadeInRight" data-wow-delay="0.1s">
                <div class="owl-carousel header-carousel">
                    <div class="owl-carousel-item">
                        <img class="img-fluid" src="{{ asset('frontend/img/carousel/carousel-1.jpg') }}" alt="">
                    </div>
                    <div class="owl-carousel-item">
                        <img class="img-fluid" src="{{ asset('frontend/img/carousel/carousel-2.jpg') }}" alt="">
                    </div>
                    <div class="owl-carousel-item">
                        <img class="img-fluid" src="{{ asset('frontend/img/carousel/carousel-3.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header End -->

    <!-- Search Start -->
    <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.3s" style="padding: 35px;">

        <div class="container">
            @if (session('status'))
                <div class="alert alert-success text-center text-white">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger text-white">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="searchForm" method="GET" action="{{ route('cari-kendaraan') }}">
                <div class="row g-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row g-2">
                                    <div class="col-xl-3 col-md-6 mr-2">
                                        <h5 class="text-white mb-3">Kendaraan</h5>
                                        <select id="kendaraan" name="kendaraan" class="form-select border-0 py-3 mt-auto">
                                            <option value="" hidden>Pilih Kendaraan</option>
                                            <option value="Mobil">Mobil</option>
                                            <option value="Motor">Motor</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mr-2">
                                        <h5 class="text-white mb-3">Rentang Harga</h5>
                                        <select id="harga" name="harga" class="form-select border-0 py-3 mt-auto">
                                            <option value="" hidden>Pilih Rentang Harga</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mr-2">
                                        <h5 class="text-white mb-3">Kategori</h5>
                                        <select name="category_id" id="category_id"
                                            class="form-select border-0 py-3 mt-auto">
                                            <option value="" hidden>Pilih Kategori</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mr-2">
                                        <h5 class="text-white mb-3">Jumlah Penumpang</h5>
                                        <select name="penumpang" class="form-select border-0 py-3 mt-auto">
                                            <option value="" hidden>Pilih Jumlah Penumpang</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" id="searchButton"
                                    class="btn btn-dark border-0 w-100 py-3 mt-3 mt-md-0" disabled>Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Kenapa harus di OtoRent -->
    <div class="container py-5 wow fadeInUp" data-wow-delay="0.1s" id="more">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="mb-4"><strong>Kenapa Harus di {{ $setting->nama_perusahaan }} ?</strong></h1>
                <p class="lead mb-5">Berikut Alasan Mengapa {{ $setting->nama_perusahaan }} Menjadi Pilihan Terbaik Anda</p>
            </div>
        </div>
        <div class="row text-center">
            @php
                $advantages = [
                    [
                        'title' => 'Mudah, Aman dan Nyaman',
                        'icon' => 'fas fa-shield-alt',
                    ],
                    [
                        'title' => 'Proses Cepat dan Praktis',
                        'icon' => 'fas fa-tachometer-alt',
                    ],
                    [
                        'title' => 'Antar Jemput ke Lokasi',
                        'icon' => 'fas fa-shipping-fast',
                    ],
                    [
                        'title' => 'Pembayaran Mudah',
                        'icon' => 'fas fa-credit-card',
                    ],
                    [
                        'title' => 'Banyak Pilihan',
                        'icon' => 'fas fa-car',
                    ],
                    [
                        'title' => 'Terpercaya',
                        'icon' => 'fas fa-thumbs-up',
                    ],
                ];
            @endphp
            @foreach ($advantages as $index => $advantage)
                <div class="col-lg-2 mb-5 wow fadeInUp" data-wow-delay="0.{{ $index + 2 }}s">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-container mb-3 bg-primary rounded-circle p-3">
                            <i class="{{ $advantage['icon'] }} fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-3 text-center">{{ $advantage['title'] }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--End  Mengapa-->
    <!-- Cara Pemesanan -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-4"><strong>Cara Pemesanan</strong></h1>
                <p class="lead mb-5">Ikuti Langkah Mudah Ini untuk Menyewa di {{ $setting->nama_perusahaan }}</p>
            </div>
        </div>
        <div class="row text-center">
            @php
                $steps = [
                    [
                        'title' => 'Melengkapi Data Diri',
                        'description' =>
                            'Isi formulir dengan data diri lengkap dan informasi yang diperlukan untuk proses pemesanan.',
                        'icon' => 'fas fa-user',
                        'color' => 'text-success',
                    ],
                    [
                        'title' => 'Memilih Kendaraan',
                        'description' =>
                            'Pilih kendaraan yang Anda inginkan dan tentukan jadwal rental yang sesuai dengan kebutuhan Anda.',
                        'icon' => 'fas fa-tachometer-alt',
                        'color' => 'text-primary',
                    ],
                    [
                        'title' => 'Melakukan Pembayaran',
                        'description' =>
                            'Kami telah menyediakan proses pembayaran melalui transfer bank dan dompet digital',
                        'icon' => 'fas fa-check',
                        'color' => 'text-warning',
                    ],
                    [
                        'title' => 'Kendaraan Siap Pakai',
                        'description' => 'Nikmati kendaraan rental sesuai dengan jadwal yang telah Anda tentukan.',
                        'icon' => 'fas fa-clock',
                        'color' => 'text-danger',
                    ],
                ];
            @endphp
            @foreach ($steps as $index => $step)
                <div class="col-lg-3 mb-5 wow fadeInUp" data-wow-delay="0.{{ $index + 2 }}s">
                    <div class="card h-100 shadow border-0" style="box-shadow: 0 0.5rem 1rem rgba(0, 0, 255, 0.2);">
                        <div class="card-header bg-light">
                            <div class="fs-1 {{ $step['color'] }}"><i class="{{ $step['icon'] }}"></i></div>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">{{ $step['title'] }}</h3>
                            <p class="card-text">{{ $step['description'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                        <img class="img-fluid w-100" src="{{ asset('frontend/img/header/about-us-1.jpg') }}">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-4">Tentang Kami</h1>
                    <p class="mb-4" style="text-align: justify">{{ $setting->tentang_perusahaan }}</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Kendaraan yang selalu terjaga kebersihannya</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Pengemudi yang berpengalaman dan ramah</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Sistem pemesanan yang mudah dan cepat</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    <!-- Property List Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h1 class="mb-3">Daftar Kendaraan</h1>
                        <p>Temukan kendaraan yang sesuai dengan kebutuhan dan preferensi Anda!</p>
                    </div>
                </div>
                <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1">Mobil</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2">Motor</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        @php
                            $randomCars = $cars->shuffle()->take(6);
                        @endphp
                        @foreach ($randomCars as $car)
                            <div class="col-lg-4 col-md-6 car-item" data-category="{{ $car->type->nama }}"
                                data-passenger="{{ $car->penumpang }}">
                                <div class="property-item rounded overflow-hidden wow fadeInUp"
                                    data-wow-delay="{{ $loop->iteration * 0.2 }}s">
                                    <div class="position-relative overflow-hidden image-container">
                                        <img class="img-fluid" src="{{ Storage::url($car->image1) }}"
                                            alt="gambar-mobil">
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            {{ $car->type->nama }}
                                        </div>
                                    </div>
                                    <div class="p-4 property-content">
                                        <h5 class="text-primary mb-3 price">Rp. {{ number_format($car->price) }} / hari
                                        </h5>
                                        <p class="d-block h5 mb-2" href="">{{ $car->nama_mobil }}</p>
                                    </div>
                                    <div class="property-footer">
                                        <div class="d-flex justify-content-end p-4 pb-0">
                                            <a href="{{ route('car.show', $car->id) }}"
                                                class="btn btn-primary btn-pesan btn-lg">Pesan</a>
                                        </div>
                                        <div class="d-flex border-top mt-3">
                                            <div class="flex-fill text-center border-end py-3">
                                                <i class="fa-solid fa-person text-primary me-2"></i>{{ $car->penumpang }}
                                                Penumpang
                                            </div>
                                            <div class="flex-fill text-center py-3">
                                                <i
                                                    class="fa-solid fa-door-closed text-primary me-2"></i>{{ $car->pintu }}
                                                Pintu
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                            <a class="btn btn-primary py-3 px-5" href="{{ url('daftar-mobil') }}">Cari Mobil Lainnya</a>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        @php
                            $randomizedMotorcycles = $motorcycles->shuffle()->take(6);
                        @endphp
                        @foreach ($randomizedMotorcycles as $motorcycle)
                            <div class="col-lg-4 col-md-6 car-item" data-category="{{ $motorcycle->type->nama }}"
                                data-passenger="{{ $motorcycle->penumpang }}">
                                <div class="property-item rounded overflow-hidden wow fadeInUp"
                                    data-wow-delay="{{ $loop->iteration * 0.2 }}s">
                                    <div class="position-relative overflow-hidden image-container">
                                        <img class="img-fluid" src="{{ Storage::url($motorcycle->image1) }}"
                                            alt="gambar-mobil">
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            {{ $motorcycle->type->nama }}
                                        </div>
                                    </div>
                                    <div class="p-4 property-content">
                                        <h5 class="text-primary mb-3 price">Rp. {{ number_format($motorcycle->price) }} /
                                            hari</h5>
                                        <p class="d-block h5 mb-2" href="">{{ $motorcycle->nama_motor }}</p>
                                    </div>
                                    <div class="property-footer">
                                        <div class="d-flex justify-content-end p-4 pb-0">
                                            <a href="{{ route('moto.show', $motorcycle->id) }}"
                                                class="btn btn-primary btn-pesan btn-lg">Pesan</a>
                                        </div>
                                        <div class="d-flex border-top mt-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-12 text-center" data-wow-delay="0.1s">
                            <a class="btn btn-primary py-3 px-5" href="{{ url('daftar-motor') }}">Cari Motor Lainnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Property List End -->
    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Testimoni Pelanggan Kami</h1>
                <p>Dengarkan apa yang pelanggan kami katakan:</p>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                @foreach ($feedbacks as $feedback)
                    <div class="testimonial-item bg-light rounded p-3">
                        <div class="bg-white border rounded p-4">
                            @if ($feedback->vehicle_type == 'car')
                                @php
                                    $vehicle = $cars->where('id', $feedback->vehicle_id)->first();
                                @endphp
                                @if ($vehicle)
                                    <h3>{{ $vehicle->nama_mobil }} - {{ $vehicle->type->nama }}</h3>
                                @endif
                            @else
                                @php
                                    $vehicle = $motorcycles->where('id', $feedback->vehicle_id)->first();
                                @endphp
                                @if ($vehicle)
                                    <h3>{{ $vehicle->nama_motor }} - {{ $vehicle->type->nama }}</h3>
                                @endif
                            @endif
                            <p>{{ $feedback->feedback }}</p>
                            <div class="d-flex align-items-center">
                                <div class="col mb-3">
                                    @for ($i = 0; $i < $feedback->rating; $i++)
                                        <i class="fas fa-star text-warning"></i>
                                    @endfor
                                    @for ($i = $feedback->rating; $i < 5; $i++)
                                        <i class="fas fa-star text-secondary"></i>
                                    @endfor
                                    <span class="ms-2">{{ $feedback->rating }}</span>
                                </div>
                                <img class="img-fluid flex-shrink-0 rounded"
                                    src="{{ asset('storage/avatars/' . $feedback->avatar) }}" alt=""
                                    style="width: 45px; height: 45px;">
                                <div class="ps-3">
                                    <h6 class="fw-bold mb-1">{{ $feedback->user_name }}</h6>
                                    <small>{{ $feedback->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- Faq Start -->
    <div class="container-xxl py-5">
        <div class="container" id="faqs">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-3">Pertanyaan Umum</h1>
            </div>
            <div class="accordion wow fadeInUp" data-wow-delay="0.1s" id="accordionExample">
                <!-- Accordion Item 1 -->
                @foreach ($faqs as $faq)
                    <div class="accordion-item mb-3">
                        <div class="accordion-card card shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $faq->id }}" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    <span class="accordion-title">{{ $loop->iteration }}. {{ $faq->question }}</span>
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Faq End -->
    <!-- Call to Action Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-light rounded p-3">
                <div class="bg-white rounded p-4" style="border: 1px solid rgba(0, 0, 0, .05);">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <img class="img-fluid rounded w-100"
                                src="{{ asset('frontend/img/assets/contact-after.jpg') }}" alt="">
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <div class="mb-4">
                                <h1 class="mb-3">Hubungi Kami</h1>
                                <p style="text-align: justify">{{ $setting->hubungi_kami }}</p>
                            </div>
                            <a href="https://wa.me/{{ $setting->phone }}" class="btn btn-primary py-3 px-4 me-2"><i
                                    class="fa fa-phone-alt me-2"></i>Telepon Kami</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action End -->
@endsection
@push('style-alt')
    <style>
        .property-item {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .property-content {
            flex-grow: 1;
        }

        .property-footer {
            margin-top: auto;
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
        }

        .image-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endpush
@push('script-alt')
    <script>
        $(document).ready(function() {
            var kendaraanSelect = $('#kendaraan');
            var hargaSelect = $('#harga');
            var categorySelect = $('#category_id');
            var penumpangSelect = $('select[name="penumpang"]');
            var searchButton = $('#searchButton');
            var inputs = $('input, select');

            inputs.on('input', function() {
                toggleSearchButton();
            });

            function toggleSearchButton() {
                var isInputEmpty = true;
                inputs.each(function() {
                    if ($(this).val().trim() !== '') {
                        isInputEmpty = false;
                    }
                });

                if (isInputEmpty) {
                    searchButton.prop('disabled', true);
                } else {
                    searchButton.prop('disabled', false);
                }
            }

            kendaraanSelect.on('change', function() {
                var selectedKendaraan = $(this).val();
                fetchCategories(selectedKendaraan);
                updateHargaOptions(selectedKendaraan);
                disablePenumpangSelect(selectedKendaraan);
                updateJumlahPenumpang(selectedKendaraan);
            });

            function updateHargaOptions(kendaraan) {
                hargaSelect.html('<option value="" hidden>Pilih Rentang Harga</option>');
                var hargaOptions;

                if (kendaraan === 'Mobil') {
                    hargaOptions = [{
                            value: '300000-500000',
                            text: 'Rp. 300.000 - Rp. 500.000'
                        },
                        {
                            value: '500000-700000',
                            text: 'Rp. 500.000 - Rp. 700.000'
                        },
                        {
                            value: '700000-1000000',
                            text: 'Rp. 700.000 - Rp. 1.000.000'
                        },
                        {
                            value: '1000000-1500000',
                            text: 'Rp. 1.000.000 - Rp. 1.500.000'
                        }
                    ];
                } else if (kendaraan === 'Motor') {
                    hargaOptions = [{
                            value: '60000-100000',
                            text: 'Rp. 60.000 - Rp. 100.000'
                        },
                        {
                            value: '100000-200000',
                            text: 'Rp. 100.000 - Rp. 200.000'
                        },
                        {
                            value: '200000-300000',
                            text: 'Rp. 200.000 - Rp. 300.000'
                        }
                    ];
                } else {
                    return;
                }

                $.each(hargaOptions, function(index, option) {
                    hargaSelect.append($('<option>', {
                        value: option.value,
                        text: option.text
                    }));
                });
            }

            function updateJumlahPenumpang(kendaraan) {
                penumpangSelect.html('<option value="" hidden>Pilih Jumlah Penumpang</option>');
                var penumpangOptions;

                if (kendaraan === 'Mobil') {
                    penumpangOptions = [{
                            value: '4',
                            text: '4 Penumpang'
                        },
                        {
                            value: '6',
                            text: '6 Penumpang'
                        },
                        {
                            value: '8',
                            text: '8 Penumpang'
                        }
                    ];
                }

                $.each(penumpangOptions, function(index, option) {
                    penumpangSelect.append($('<option>', {
                        value: option.value,
                        text: option.text
                    }));
                });
            }

            function disablePenumpangSelect(kendaraan) {
                if (kendaraan === 'Motor') {
                    penumpangSelect.prop('disabled', true).val('');
                } else {
                    penumpangSelect.prop('disabled', false);
                }
            }

            function fetchCategories(kendaraan) {
                categorySelect.html('<option value="" hidden>Pilih Kategori</option>');

                var url;
                if (kendaraan === 'Mobil') {
                    url = '{{ route('car.categories') }}';
                } else if (kendaraan === 'Motor') {
                    url = '{{ route('motor.categories') }}';
                } else {
                    return;
                }

                $.get(url, function(data) {
                    $.each(data, function(index, category) {
                        categorySelect.append($('<option>', {
                            value: category.id,
                            text: category.nama
                        }));
                    });
                });
            }
        });
    </script>
@endpush
