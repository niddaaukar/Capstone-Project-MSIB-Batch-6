@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data</h3>
                            <a href="{{ route('admin.admin.index') }}" class="btn btn-success shadow-sm float-right"> <i
                                    class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="row justify-content-center g-4">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header border-bottom">
                                            <h5>{{ __('Profile Settings') }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="{{ route('admin.admin.update', $admin) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div class="row justify-content-center border-bottom">
                                                    <div class="col-md-4">
                                                        <div class="form-group row pb-4">
                                                            <div class="col-sm-12">
                                                                <label for="avatar"
                                                                    class="col-form-label">{{ __('Avatar') }}</label>
                                                                @if ($admin->avatar)
                                                                    <div>
                                                                        @if (in_array(pathinfo($admin->avatar, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                                            <img id="existingAvatarPreview"
                                                                                class="img-fluid"
                                                                                src="{{ Storage::url('avatars/' . $admin->avatar) }}"
                                                                                alt="{{ $admin->name }} Avatar"
                                                                                style="width: 100%;">
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                                <div class="form-group row border-bottom pb-4">
                                                                    <div class="mt-auto">
                                                                        <input type="file" id="avatar" name="avatar" class="form-control @error('avatar') is-invalid @enderror mt-3" accept=".jpg,.jpeg,.png">
                                                                        @error('avatar')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group row border-bottom pb-4">
                                                            <label for="name" class="col-form-label">Nama</label>
                                                            <div class="col-sm-12">
                                                                <input type="text"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    name="name" value="{{ old('name', $admin->name) }}"
                                                                    id="name" required>
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
                                                                    name="email"
                                                                    value="{{ old('email', $admin->email) }}"
                                                                    id="email" required>
                                                                @error('email')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-success mb-3">Update
                                                            Profile</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header border-bottom">
                                            <h5>{{ __('Password Settings') }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="{{ route('password.update.custom') }}">
                                                @csrf
                                                <!-- Hidden Username Field for Accessibility -->
                                                <div class="form-group row" style="display: none;">
                                                    <label for="username"
                                                        class="col-form-label">{{ __('Username') }}</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" id="username" name="username"
                                                            class="form-control" value="{{ $admin->username }}"
                                                            autocomplete="username">
                                                    </div>
                                                </div>
                                                <div class="form-group row border-bottom pb-4">
                                                    <label for="current_password"
                                                        class="col-form-label">{{ __('Password Sekarang') }}</label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <input type="password" id="current_password"
                                                                name="current_password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                required autocomplete="current-password">
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
                                                </div>
                                                <div class="form-group row border-bottom pb-4">
                                                    <label for="password"
                                                        class="col-form-label">{{ __('Password Baru') }}</label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <input type="password" id="password" name="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                required autocomplete="new-password">
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
                                                </div>
                                                <div class="form-group row border-bottom pb-4">
                                                    <label for="password_confirmation"
                                                        class="col-form-label">{{ __('Konfirmasi Password Baru') }}</label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <input type="password" id="password_confirmation"
                                                                name="password_confirmation"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                required autocomplete="new-password">

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
                                                </div>
                                                <button type="submit" class="btn btn-success">Update Password</button>
                                            </form>
                                        </div>
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
    <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="cropModalLabel">Crop Avatar</h5>
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
@endsection
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
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
    <script>
document.addEventListener('DOMContentLoaded', function () {
    var avatarInput = document.getElementById('avatar');
    var image = document.getElementById('imageCrop');
    var cropButton = document.getElementById('cropButton');
    var cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
    var deleteAvatarButton = document.getElementById('deleteAvatarButton');
    var cropper;

    avatarInput.addEventListener('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
            avatarInput.value = '';
            image.src = url;
            cropModal.show();
            if (cropper) {
                cropper.destroy();
            }
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 1,
                responsive: true,
                scalable: true,
                zoomable: true,
                zoomOnWheel: true,
                minContainerWidth: 300,
                minContainerHeight: 600,
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
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    cropButton.addEventListener('click', function () {
        if (cropper) {
            var canvas = cropper.getCroppedCanvas({
                width: 500,
                height: 500,
            });
            canvas.toBlob(function (blob) {
                var url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;
                    var formData = new FormData();
                    formData.append('avatar', blob);
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route("admin.settings.updateAvatar") }}', {
                        method: 'POST',
                        body: formData,
                    }).then(response => response.json()).then(data => {
                        if (data.success) {
                            cropModal.hide();
                            existingAvatarPreview.src = base64data;
                            // alert('Avatar berhasil diperbarui!');
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Avatar berhasil diperbarui!',
                                icon: 'success',
                                confirmButtonColor: '#5e72e4',
                                confirmButtonText: 'OK',
                                timer: 1500
                            });
                            // location.reload();
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

@endpush
