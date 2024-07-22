@extends('layouts.guest')

@section('content')
    <!-- Main Content -->

    <body class="">
        <main class="main-content  mt-0">
            <section>
                <div class="page-header min-vh-100">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 d-flex flex-column mx-lg-0 mx-auto">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-start">
                                        <h4 class="font-weight-bolder">Reset Password</h4>
                                        <p class="mb-0">Masukkan email Anda!</p>
                                    </div>
                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-danger alert-dismissible fade show text-white"
                                                role="alert">
                                                {{ session('status') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <form role="form" class="text-start" action="{{ route('password.email') }}"
                                            method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <div class="input-group">
                                                    <input type="email" name="email"
                                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                        placeholder="{{ __('Email') }}" required autocomplete="email">
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-envelope text-primary text-lg"></i>
                                                    </span>
                                                    @error('email')
                                                        <span class="error invalid-feedback">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">
                                                    {{ __('Send Password Reset Link') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-6 d-flex align-items-center justify-content-center">
                                <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                    style="background-image: url('https://images.unsplash.com/photo-1681392353566-c32e8975cc21?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover;">
                                    <span class="mask bg-gradient-primary opacity-6"></span>
                                    <h4 class="mt-5 text-white font-weight-bolder position-relative">OtoRent</h4>
                                    <p class="text-white position-relative">Solusi Praktis dan Menyenangkan untuk Setiap Perjalanan Anda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
@endsection
