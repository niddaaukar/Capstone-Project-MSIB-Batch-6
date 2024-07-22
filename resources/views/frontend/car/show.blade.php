@extends('frontend.layout')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-7">
                <div id="carouselExample" class="carousel slide carousel-fade wow fadeInUp" data-wow-delay="0.1s">
                    <div class="carousel-inner">
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="carousel-item image-container {{ $i == 1 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $cars->{"image$i"}) }}" class="d-block img-fluid"
                                    alt="...">
                            </div>
                        @endfor
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="row mt-2 wow slideInLeft" data-wow-delay="0.1s">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="col-3 thumbnail">
                            <div class="image-container">
                                <img src="{{ asset('storage/' . $cars->{"image$i"}) }}" class="img-fluid"
                                    data-bs-target="#carouselExample" data-bs-slide-to="{{ $i - 1 }}" alt="...">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="col-lg-5 mt-3">
                <div class="card p-4 wow slideInRight" data-wow-delay="0.1s">
                    <h1>{{ $cars->nama_mobil }}</h1>
                    <h5>{{ $cars->plat_nomor }}</h5>
                    <div class="row">
                        <div class="col">
                            <p class="lead mb-0">Rp. {{ number_format($cars->price) }} / hari</p>
                        </div>
                        <div class="col">
                            @php
                                $averageRating = $feedbacks->avg('rating');
                                $roundedRating = round($averageRating);
                            @endphp

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $roundedRating)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="fas fa-star text-secondary"></i>
                                @endif
                            @endfor
                            <span class="ms-2">{{ number_format($averageRating, 1) }}</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-car text-primary custom-icon me-2"></i>
                                    <span class="badge bg-primary">
                                        {{ $cars->type->nama }}
                                    </span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-user text-primary custom-icon me-2"></i>
                                    <span class="badge bg-primary">
                                        {{ $cars->penumpang }} Penumpang
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="description">
                        <h5><strong>Deskripsi</strong></h5>
                        <p class="text-muted" style="text-align: justify">{{ $cars->description }}</p>
                    </div>
                    <hr>
                    @auth
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            {{-- <a href="{{ route('check_availability', ['car_id' => $cars->id]) }}" class="btn btn-primary">Cek Ketersediaan</a> --}}
                            <a href="{{ route('check_availability', ['vehicle_type' => 'car', 'vehicle_id' => $cars->id]) }}"
                                class="btn btn-primary">Cek Ketersediaan Mobil</a>
                        </div>
                    @else
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="{{ url('/login') }}" class="btn btn-primary">Login untuk menyewa</a>
                        </div>
                    @endauth
                </div>
            </div>
            <div class="row mt-5">
                <!-- Testimonial Start -->
                <div class="mx-auto mb-1 wow fadeInUp" data-wow-delay="0.1s">
                    <h3>Ulasan Pelanggan Kami</h3>
                </div>

                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    @foreach ($feedbacks as $feedback)
                        <div class="testimonial-item rounded p-3">
                            <div class="bg-white border rounded p-4">
                                <p>{{ $feedback->feedback }}</p>
                                <div class="col mb-3">
                                    @for ($i = 0; $i < $feedback->rating; $i++)
                                        <i class="fas fa-star text-warning"></i>
                                    @endfor
                                    @for ($i = $feedback->rating; $i < 5; $i++)
                                        <i class="fas fa-star text-secondary"></i>
                                    @endfor
                                    <span class="ms-2">{{ $feedback->rating }}</span>
                                </div>
                                <div class="d-flex align-items-center">
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
    </div>
@endsection
@push('style-alt')
    <style>
        .thumbnail {
            object-fit: cover;
            cursor: pointer;
        }

        .img-fluid {
            height: auto;
            border-radius: 10px;
        }

        .custom-icon {
            font-size: 1.5rem;
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
