@extends('frontend.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Daftar motor</h1>
                <p class="lead animated fadeIn mb-4">Temukan motor ideal Anda, dengan pilihan kategori dan rentang harga yang
                    telah kami sediakan !</p>
            </div>
            <div class="col-md-6 wow slideInRight" data-wow-delay="0.3s">
                <img class="img-fluid" style="width: 100%; align-items:center"
                    src="{{ asset('frontend/img/carousel/carousel-3.jpg') }}" alt="">
            </div>
            <hr>
        </div>
    </div>
    <!-- Header End -->

    <!-- Property List Start -->
    <div class="container-fluid px-5">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                    <h1 class="mb-3">Daftar Motor</h1>
                    <p>Temukan motor yang sesuai dengan kebutuhan dan preferensi Anda!</p>
                </div>
            </div>
        </div>
        <div class="row g-4" id="moto-list">
            @php
                $isFiltered = request()->filled('harga') || request()->filled('category_id');
            @endphp
            @if ($motos->isEmpty())
                <div class="col-lg-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                    <div class="alert alert-danger" role="alert">
                        <h2 class="text-white">Maaf, motor tidak tersedia saat ini!</h2>
                    </div>
                </div>
                @if ($isFiltered)
                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <a class="btn btn-primary py-3 px-5 mt-3" href="{{ route('moto.index') }}">Cari Motor
                            Lainnya</a>
                    </div>
                @endif
            @else
                @if (!$isFiltered)
                    <div class="col-lg-2 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                        <div class="text-start mb-2">
                            <i class="fa-solid fa-filter text-primary mb-2" style="font-size: 2rem"></i>
                            <h2 class="card-title">Filter motor</h2>
                        </div>
                        <div class="accordion" id="accordionFilters">
                            <!-- Filter motor -->
                            <div class="accordion-item shadow-sm">
                                <h2 class="accordion-header" id="headingType">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseType" aria-expanded="true" aria-controls="collapseType">
                                        Kategori motor
                                    </button>
                                </h2>
                                <div id="collapseType" class="accordion-collapse collapse show"
                                    aria-labelledby="headingType" data-bs-parent="#accordionFilters">
                                    <div class="accordion-body">
                                        <ul class="nav nav-pills flex-column mb-5">
                                            <li class="nav-item mb-2">
                                                <button class="btn btn-outline-primary active w-100" data-bs-toggle="pill"
                                                    data-filter="all">Semua</button>
                                            </li>
                                            @foreach ($types as $type)
                                                <li class="nav-item mb-2">
                                                    <button class="btn btn-outline-primary w-100" data-bs-toggle="pill"
                                                        data-filter="{{ $type->nama }}">{{ $type->nama }}</button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Filter Rentang Harga -->
                            <div class="accordion-item shadow-sm">
                                <h2 class="accordion-header" id="headingPrice">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapsePrice" aria-expanded="false" aria-controls="collapsePrice">
                                        Rentang Harga
                                    </button>
                                </h2>
                                <div id="collapsePrice" class="accordion-collapse collapse" aria-labelledby="headingPrice"
                                    data-bs-parent="#accordionFilters">
                                    <div class="accordion-body">
                                        <ul class="nav nav-pills flex-column mb-5">
                                            <li class="nav-item mb-2">
                                                <button class="btn btn-outline-primary w-100" data-bs-toggle="pill"
                                                    data-price-min="0" data-price-max="">Semua</button>
                                            </li>
                                            <li class="nav-item mb-2">
                                                <button class="btn btn-outline-primary w-100" data-bs-toggle="pill"
                                                    data-price-min="60000" data-price-max="100000">Rp. 60000 -
                                                    100.000</button>
                                            </li>
                                            <li class="nav-item mb-2">
                                                <button class="btn btn-outline-primary w-100" data-bs-toggle="pill"
                                                    data-price-min="100000" data-price-max="200000">Rp. 100.000 -
                                                    200.000</button>
                                            </li>
                                            <li class="nav-item mb-2">
                                                <button class="btn btn-outline-primary w-100" data-bs-toggle="pill"
                                                    data-price-min="200000" data-price-max="300000">Rp. 200.000 -
                                                    300.000</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-lg-{{ $isFiltered ? '12' : '10' }}">
                    <div class="row g-4">
                        @foreach ($motos as $moto)
                            <div class="col-lg-3 col-md-6 moto-item" data-category="{{ $moto->type->nama }}"
                                data-passenger="{{ $moto->penumpang }}">
                                <div class="property-item rounded overflow-hidden wow fadeInUp card-motor"
                                    data-wow-delay="{{ $loop->iteration * 0.1 }}s">
                                    <div class="position-relative overflow-hidden image-container">
                                        <img class="img-fluid" src="{{ asset('storage/' . $moto->image1) }}"
                                            alt="gambar-motor">
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            {{ $moto->type->nama }}
                                        </div>
                                    </div>
                                    <div class="p-4 property-content">
                                        <h5 class="text-primary mb-3 price">Rp. {{ number_format($moto->price) }} /
                                            hari</h5>
                                        <p class="d-block h5 mb-2" href="">{{ $moto->nama_motor }}</p>

                                    </div>
                                    <div class="property-footer">
                                        <div class="d-flex justify-content-end p-4 pb-0">
                                            <a href="{{ route('moto.show', $moto->id) }}"
                                                class="btn btn-primary btn-pesan mb-3">Pesan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($isFiltered)
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                            <a class="btn btn-primary py-3 px-5 mt-3" href="{{ route('moto.index') }}">Cari Motor
                                Lainnya</a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <!-- Property List End -->
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
            padding-top: 56.25%;
            /* 16:9 aspect ratio (9 / 16 = 0.5625 * 100 = 56.25) */
            overflow: hidden;
        }

        .image-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures the image covers the container */
        }
    </style>
@endpush
@push('script-alt')
    <script>
        $(document).ready(function() {

            $('.card-motor div').click(function(e) {
                e.preventDefault(); // Menghentikan aksi default, jika ada
                e.stopPropagation(); // Menghentikan propagasi event
            });

            $('.btn-pesan').click(function(e) {
                e.stopPropagation();
            });

            $('[data-filter]').click(function() {
                var filterValue = $(this).attr('data-filter');
                if (filterValue === 'all') {
                    $('.moto-item').show();
                } else {
                    $('.moto-item').hide();
                    $('.moto-item[data-category="' + filterValue + '"]').show();
                }

                $('[data-filter]').removeClass('active');
                $(this).addClass('active');
            });

            $('[data-passenger]').click(function() {
                var passengerValue = $(this).attr('data-passenger');
                if (passengerValue === 'all') {
                    $('.moto-item').show();
                } else {
                    $('.moto-item').hide();
                    $('.moto-item[data-passenger="' + passengerValue + '"]').show();
                }

                $('[data-passenger]').removeClass('active');
                $(this).addClass('active');
            });


            $('[data-price-min]').click(function() {
                var minPrice = parseFloat($(this).attr('data-price-min'));
                var maxPrice = $(this).attr('data-price-max') ? parseFloat($(this).attr('data-price-max')) :
                    Infinity;

                $('.moto-item').each(function() {
                    var priceText = $(this).find('.price').text();
                    var motoPrice = parseFloat(priceText.replace(/[^0-9]/g, ''));
                    console.log(motoPrice);
                    if (motoPrice >= minPrice && motoPrice <= maxPrice) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                $('[data-price-min]').removeClass('active');
                $(this).addClass('active');
            });

        });
    </script>
@endpush
