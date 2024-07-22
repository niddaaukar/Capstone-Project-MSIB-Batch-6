@extends('layouts.guest')

@section('content')

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
                                    </div>
                                    <div class="card-body">
                                        <form role="form" class="text-start" action="{{ route('password.update') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">
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
                                            <div class="mb-3">
                                                <div class="input-group">
                                                    <input type="password" name="password"
                                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                        placeholder="{{ __('Password') }}" required autocomplete="new-password">
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-lock text-primary text-lg"></i>
                                                    </span>
                                                    @error('password')
                                                        <span class="error invalid-feedback">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="input-group">
                                                    <input type="password" name="password_confirmation"
                                                        class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                                        placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-lock text-primary text-lg"></i>
                                                    </span>
                                                    @error('password_confirmation')
                                                        <span class="error invalid-feedback">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">
                                                    {{ __('Reset Password') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-6 d-flex align-items-center justify-content-center">
                                <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                    style="background-image: url('https://images.unsplash.com/photo-1502877338535-766e1452684a?q=80&w=1472&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover;">
                                    <span class="mask bg-gradient-primary opacity-6"></span>
                                    <h4 class="mt-5 text-white font-weight-bolder position-relative">OtoRent</h4>
                                    <p class="text-white position-relative">Solusi Praktis dan Menyenangkan untuk Setiap Perjalanan Anda</p>
                                </div>
                            </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
@endsection