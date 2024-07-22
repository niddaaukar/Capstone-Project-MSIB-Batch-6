@extends('frontend.layout')

@section('content')
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Kontak Kami</h1>
                <p class="lead animated fadeIn mb-4">Untuk informasi lebih lanjut, silakan hubungi kami melalui kontak yang
                    tersedia di halaman Kontak Kami.</p>
            </div>
            <div class="col-md-6 wow slideInRight" data-wow-delay="0.3s">
                <img class="img-fluid" style="width: 100%; align-items:center"
                    src="{{ asset('frontend/img/header/contact-after.jpg') }}" alt="">
            </div>
            <hr>
        </div>
    </div>
    <!-- Header End -->

    <div class="site-section container-fluid" id="contact-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="text-center mb-5">
                    <div class="wow slideInRight" data-wow-delay="0.3s"">
                        <h2>Kontak Kami</h2>
                        <p>Saran dan kritik yang kami harapkan</p>
                    </div>
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-12 d-flex">
                                <div class="card flex-fill text-center border">
                                    <div class="card-body">
                                        <span class="d-block mb-2"><i class="fas fa-phone fs-2"></i></span>
                                        <h3 class="h5 mb-2">Nomor Telepon</h3>
                                        <p class="text-decoration-none text-primary">{{ $setting->phone ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 d-flex">
                                <div class="card flex-fill text-center border">
                                    <div class="card-body">
                                        <span class="d-block mb-2"><i class="fas fa-envelope fs-2"></i></span>
                                        <h3 class="h5 mb-2">Email</h3>
                                        <p class="text-decoration-none text-primary">{{ $setting->email ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 d-flex">
                                <div class="card flex-fill text-center border">
                                    <div class="card-body">
                                        <span class="d-block mb-2"><i class="fas fa-map-marker-alt fs-2"></i></span>
                                        <h3 class="h5 mb-2">Lokasi</h3>
                                        <p class="text-primary">{{ $setting->alamat ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 d-flex">
                                <div class="card flex-fill text-center border ">
                                    <div class="card-body">
                                        <span class="d-block mb-2"><i class="fas fa-clock fs-2"></i></span>
                                        <h3 class="h5 mb-2">Jam Buka</h3>
                                        <p class="text-primary">{{ $setting->jam_buka ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (count($errors) > 0)
                        <div class="content-header mb-0 pb-0">
                            <div class="container-fluid">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (session()->has('message'))
                        <div class="content-header mb-0 pb-0">
                            <div class="container-fluid">
                                <div class="mb-0 alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show"
                                    role="alert">
                                    <strong>{{ session()->get('message') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="container-fluid col-lg-7">
                    <div class="card card-contact px-4">
                        <div class="text-center btn bg-primary mx-5 shadow-lg text-white">
                            <h3 class="card-title"><i class="fa-solid fa-file-signature"></i> Kontak Kami</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-content">
                                <form action="{{ route('contact.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-4 mb-lg-0">
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control @error('nama_awal') is-invalid @enderror""
                                                    name="nama_awal" placeholder="Nama Awal">
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-user text-primary text-lg"></i>
                                                    <span class="text-danger text-lg">*</span>
                                                </span>
                                                @error('nama_awal')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="text" name="nama_akhir"
                                                    class="form-control @error('nama_akhir') is-invalid @enderror"
                                                    placeholder="Nama Akhir">
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-user text-primary text-lg"></i>
                                                        <span class="text-danger text-lg">*</span>
                                                    </span>
                                                @error('nama_akhir')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 my-3">
                                            <div class="input-group mb-3">
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Alamat Email">
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-envelope-open-text text-primary text-lg"></i>
                                                        <span class="text-danger text-lg">*</span>
                                                    </span>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <textarea name="pesan" id="pesan" class="form-control @error('pesan') is-invalid @enderror"
                                                    placeholder="Pesan yang membangun." rows="5"></textarea>
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-note-sticky text-primary text-lg"></i>
                                                    <span class="text-danger text-lg">*</span>
                                                </span>
                                                @error('pesan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <p class="text-danger">* Wajib diisi</p>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 mr-auto">
                                            <button type="submit"
                                                class="btn btn-block btn-primary text-white py-3 px-5">Kirim Pesan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid col-lg-5">
                    <iframe src="{{ $setting->maps }}" width="100%" height="100%" style="border:0;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
