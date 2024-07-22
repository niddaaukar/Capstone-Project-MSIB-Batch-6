@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Akun Admin</h3>
                            <a href="{{ route('admin.admin.index') }}" class="btn btn-success shadow-sm float-right"> <i
                                    class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row justify-content-center g-4">
                                <div class="card">
                                    <div class="card-header border-bottom">
                                        <h5>{{ __('Tambah Akun Admin') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show text-white"
                                                role="alert">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <form method="post" action="{{ route('admin.admin.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row pb-4">
                                                <div class="col-sm-12">
                                                    <label for="avatar" class="col-form-label">{{ __('Avatar') }}</label>
                                                    <div class="mt-auto">
                                                        <input type="file" id="avatar" name="avatar"
                                                            value="{{ old('avatar') }}"
                                                            class="form-control @error('avatar') is-invalid @enderror"
                                                            accept=".jpg,.jpeg,.png" required>
                                                        @error('avatar')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom pb-4">
                                                <label for="name" class="col-form-label">Nama</label>
                                                <div class="col-sm-12">
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" value="{{ old('name') }}" id="name" required>
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom pb-4">
                                                <label for="email" class="col-form-label">Email</label>
                                                <div class="col-sm-12">
                                                    <input type="text"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" id="email" required>
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row border-bottom pb-4">
                                                <label for="password"
                                                    class="col-form-label">{{ __('Password Baru') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="password" id="password" name="password"
                                                        value="{{ old('password') }}"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        required>
                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row border-bottom pb-4">
                                                <label for="password_confirmation"
                                                    class="col-form-label">{{ __('Konfirmasi Password Baru') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="password" id="password_confirmation"
                                                        name="password_confirmation"
                                                        value="{{ old('password_confirmation') }}"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        required>
                                                    @error('password_confirmation')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <input type="hidden" name="is_admin" value="1">
                                            <button type="submit" class="btn btn-success">Tambah Akun</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('script-alt')
    <script>
        $(document).ready(function() {
            $("#showPasswordBtn").click(function() {
                var passwordInput = $("#password");
                var buttonText = $(this).text();

                if (passwordInput.attr("type") === "password") {
                    passwordInput.attr("type", "text");
                    $(this).text("Hide");
                } else {
                    passwordInput.attr("type", "password");
                    $(this).text("Show");
                }
            });
        });
    </script>
@endpush
