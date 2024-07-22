@extends('frontend.layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center g-4">
            <!-- Profile Settings -->
            @if (session('status'))
                <div class="alert alert-success text-center">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        <li class="text-white">{{ $error }}</li>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-md-8">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white font-weight-bold">
                        {{ __('Ubah Profil') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                            id="profileForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 d-flex flex-column mb-3">
                                    <label for="avatar"
                                        class="form-label font-weight-bold">{{ __('Foto Profil') }}</label>
                                    <div>
                                        @if (Auth::user()->avatar)
                                            <img id="existingAvatarPreview" class="img-fluid"
                                                src="{{ Storage::url('avatars/' . Auth::user()->avatar) }}"
                                                alt="Avatar Preview">
                                        @else
                                            <img id="existingAvatarPreview" class="img-fluid"
                                                src="{{ asset('default-avatar.png') }}" alt="Avatar Preview">
                                        @endif
                                    </div>
                                    <div class="mt-auto">
                                        <div class="input-group mt-3">
                                            <input type="file" id="avatar" name="avatar"
                                                class="form-control @error('avatar') is-invalid @enderror" accept="image/*">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-upload text-lg text-primary"></i>
                                                <span class="text-danger text-lg">*</span>
                                            </span>
                                            @error('avatar')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 d-flex flex-column">
                                    <div class="mb-3">
                                        <label for="name"
                                            class="form-label font-weight-bold">{{ __('Nama') }}</label>
                                        <div class="input-group">
                                            <input type="text" id="name" name="name"
                                                class="form-control bg-light" value="{{ Auth::user()->name }}" required
                                                disabled>
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-user text-primary text-lg"></i>
                                                <span class="text-danger text-lg">*</span>
                                            </span>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email"
                                            class="form-label font-weight-bold">{{ __('Email') }}</label>
                                        <div class="input-group">
                                            <input type="email" id="email" name="email"
                                                class="form-control bg-light" value="{{ Auth::user()->email }}" required
                                                disabled>
                                            <span class="input-group-text">
                                                @if (!Auth::user()->hasVerifiedEmail())
                                                    <a href="{{ route('verification.notice') }}">Verify Email</a>
                                                @else
                                                    <i class="fas fa-check-circle text-success"></i> Verified
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone"
                                            class="form-label font-weight-bold">{{ __('Nomor Handphone') }}</label>
                                        <div class="input-group">
                                            <input type="number" id="phone" name="phone" class="form-control"
                                                required placeholder="Nomor Handphone Anda"
                                                value="{{ $user->phone ?? '' }}">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-phone text-primary text-lg"></i>
                                                <span class="text-danger text-lg">*</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label font-weight-bold">{{ __('Alamat') }}</label>
                                <div class="input-group">
                                    <textarea id="address" name="address" class="form-control" rows="4" placeholder="Masukkan Alamat Anda" required>{{ $user->address ?? '' }}</textarea>
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-location-dot text-primary text-lg"></i>
                                        <span class="text-danger text-lg">*</span>
                                    </span>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-6 d-flex flex-column">
                                        <label for="ktp"
                                            class="form-label font-weight-bold">{{ __('KTP') }}</label>
                                        @if ($user->ktp)
                                            <div>
                                                @if (in_array(pathinfo($user->ktp, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                    <img id="existingKtpPreview" class="img-fluid"
                                                        src="{{ Storage::url('ktp/' . $user->ktp) }}" alt="KTP Preview">
                                                @endif
                                            </div>
                                        @endif
                                        <div class="mt-auto">
                                            <div class="input-group mt-3">
                                                <input type="file" id="ktp" name="ktp"
                                                    class="form-control @error('ktp') is-invalid @enderror"
                                                    @if (!$user->ktp)
                                                        required
                                                    @else
                                                        data-default-file="{{ Storage::url('ktp/' . $user->ktp) }}" 
                                                    @endif
                                                    accept="image/*">
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-upload text-primary text-lg"></i>
                                                    <span class="text-danger text-lg">*</span>
                                                </span>
                                                @error('ktp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex flex-column">
                                        <label for="sim"
                                            class="form-label font-weight-bold">{{ __('SIM') }}</label>
                                        @if ($user->sim)
                                            <div>
                                                @if (in_array(pathinfo($user->sim, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                    <img id="existingSimPreview" class="img-fluid"
                                                        src="{{ Storage::url('sim/' . $user->sim) }}" alt="SIM Preview">
                                                @endif
                                            </div>
                                        @endif
                                        <div class="mt-auto">
                                            <div class="input-group mt-3">
                                                <input type="file" id="sim" name="sim"
                                                    class="form-control @error('sim') is-invalid @enderror"
                                                    @if (!$user->sim)
                                                        required
                                                    @else
                                                        data-default-file="{{ Storage::url('sim/' . $user->sim) }}" 
                                                    @endif
                                                    accept="image/*">
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-upload text-primary text-lg"></i>
                                                    <span class="text-danger text-lg">*</span>
                                                </span>
                                                @error('sim')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-danger mt-3">* Wajib diisi</p>
                            </div>
                            <div class="mb-3">
                                <p>{{ __('Status Akun') }} : <strong>{{ $user->account_status }}</strong></p>
                                @if ($user->account_status == 'Belum Terverifikasi')
                                    <p><strong>Silahkan lengkapi data diri Anda!</strong></p>
                                @elseif ($user->account_status == 'Menunggu Verifikasi')
                                    <p><strong>Menunggu Terverifikasi oleh Admin</strong></p>
                                @else
                                    <p><strong>Akun Anda telah Terverifikasi</strong></p>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Perbarui Profil') }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Update Password -->
            <div class="col-md-4">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white font-weight-bold">
                        {{ __('Ubah Password') }}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('password.update.custom') }}" method="POST">
                            @csrf
                            <input type="text" name="username"
                                value="{{ old('username', auth()->user()->username ?? '') }}" style="display: none;"
                                autocomplete="username">
                            <div class="mb-3">
                                <label for="current_password"
                                    class="form-label font-weight-bold">{{ __('Password Sekarang') }}</label>
                                <span class="text-danger text-lg">*</span>
                                <div class="input-group">
                                    <input type="password" id="current_password" name="current_password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        placeholder="{{ __('Masukan Password Sekarang') }}" required
                                        autocomplete="current-password">
                                    <span class="input-group-text" onclick="togglePassword(this)"
                                        style="cursor: pointer;">
                                        <i class="fas fa-eye-slash"></i>
                                    </span>
                                    @error('current_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password"
                                    class="form-label font-weight-bold">{{ __('Password Baru') }}</label>
                                <span class="text-danger text-lg">*</span>
                                <div class="input-group">
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="{{ __('Masukan Password Baru') }}" required
                                        autocomplete="new-password">
                                    <span class="input-group-text" onclick="togglePassword(this)"
                                        style="cursor: pointer;">
                                        <i class="fas fa-eye-slash"></i>
                                    </span>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation"
                                    class="form-label font-weight-bold">{{ __('Konfirmasi Password Baru') }}</label>
                                <span class="text-danger text-lg">*</span>
                                <div class="input-group">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="{{ __('Konfirmasi Password Baru') }}" required
                                        autocomplete="new-password">
                                    <span class="input-group-text" onclick="togglePassword(this)"
                                        style="cursor: pointer;">
                                        <i class="fas fa-eye-slash"></i>
                                    </span>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <p class="text-danger mt-3">* Wajib diisi</p>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Perbarui Password') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal untuk Crop Gambar -->
    <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title" id="cropModalLabel">Crop Profil</h5>
                        <p class="text-muted">Pilih area yang ingin di-crop dan klik tombol "Crop".</p>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="imageCrop" src="#" alt="Crop Preview">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button id="cropButton" type="button" class="btn btn-primary">Crop</button>
                </div>
            </div>
        </div>
    </div>



    <style>
        .img-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            overflow: hidden;
        }

        #imageCrop {
            max-width: 100%;
            max-height: 100%;
        }
    </style>

    @push('script-alt')
        <!-- Cropper.js -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var avatar = document.getElementById('avatar');
                var image = document.getElementById('imageCrop');
                var existingAvatarPreview = document.getElementById('existingAvatarPreview');
                var cropButton = document.getElementById('cropButton');
                var cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
                var cropper;

                avatar.addEventListener('change', function(e) {
                    var files = e.target.files;
                    var done = function(url) {
                        avatar.value = '';
                        image.src = url;
                        cropModal.show();
                        if (cropper) {
                            cropper.destroy();
                        }
                        cropper = new Cropper(image, {
                            aspectRatio: 1,
                            viewMode: 1,
                            dragMode: 'move',
                            autoCropArea: 1, // Perbesar area crop
                            responsive: true,
                            scalable: true,
                            zoomable: true,
                            zoomOnWheel: true, // Allow zooming with mouse wheel
                            minContainerWidth: 300, // Set minimum container width for the cropper
                            minContainerHeight: 600, // Set minimum container height for the cropper
                        });
                    };
                    var reader;
                    var file;
                    if (files && files.length > 0) {
                        file = files[0];
                        if (URL) {
                            done(URL.createObjectURL(file));
                        } else if (FileReader) {
                            reader = new FileReader();
                            reader.onload = function(e) {
                                done(reader.result);
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                });

                cropButton.addEventListener('click', function() {
                    if (cropper) {
                        var canvas = cropper.getCroppedCanvas({
                            width: 500,
                            height: 500,
                        });
                        canvas.toBlob(function(blob) {
                            var url = URL.createObjectURL(blob);
                            var reader = new FileReader();
                            reader.readAsDataURL(blob);
                            reader.onloadend = function() {
                                var base64data = reader.result;
                                var formData = new FormData();
                                formData.append('avatar', blob);
                                formData.append('_token', '{{ csrf_token() }}');

                                fetch('{{ route('profile.update.avatar') }}', {
                                    method: 'POST',
                                    body: formData,
                                }).then(response => response.json()).then(data => {
                                    if (data.success) {
                                        existingAvatarPreview.src = base64data;
                                        cropModal.hide();
                                        // alert('Avatar berhasil diperbarui!');
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: 'Avatar berhasil diperbarui!',
                                            icon: 'success',
                                            confirmButtonColor: '#5e72e4',
                                            confirmButtonText: 'OK',
                                            timer: 1500
                                        });
                                    } else {
                                        // alert('Gagal memperbarui avatar.');
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: 'Gagal memperbarui avatar.',
                                            icon: 'error',
                                            confirmButtonColor: '#5e72e4',
                                            confirmButtonText: 'OK',
                                            timer: 1500
                                        });
                                    }
                                }).catch(error => {
                                    console.error(error);
                                    // alert('Terjadi kesalahan.');
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: 'Terjadi kesalahan.',
                                        icon: 'error',
                                        confirmButtonColor: '#5e72e4',
                                        confirmButtonText: 'OK',
                                        timer: 1500
                                    });
                                });
                            };
                        });
                    }
                });
            });
        </script>
        <script>
            function togglePassword(element) {
                const $input = $(element).closest('.input-group').find('input');
                const $icon = $(element).find('i');

                if ($input.attr('type') === 'password') {
                    $input.attr('type', 'text');
                    $icon.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    $input.attr('type', 'password');
                    $icon.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            }
        </script>
    @endpush
@endsection