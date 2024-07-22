@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Pengaturan Tampilan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                {{-- <input type="hidden" name="id" value="{{ $setting->id }}"> --}}
                                <div class="form-group row border-bottom pb-4">
                                    <label for="nama_perusahaan" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                    <div class="col-sm-12">
                                        <input type="text"
                                            class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                            name="nama_perusahaan"
                                            value="{{ old('nama_perusahaan', $setting->nama_perusahaan) }}"
                                            id="nama_perusahaan">
                                        @error('nama_perusahaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                                    @if ($setting->logo)
                                        <div>
                                            @if (in_array(pathinfo($setting->logo, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                <img id="existingLogoPreview" class="img-fluid"
                                                    src="{{ Storage::url($setting->logo) }}" style="width: 150px;">
                                            @endif
                                        </div>
                                    @endif
                                    <div class="mt-auto">
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror mt-3"
                                            name="logo" id="logo" accept="image/*">
                                        <div class="mb-3" id="logo-section">

                                        </div>
                                        @error('logo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            onkeyup="this.value = this.value.toUpperCase()" name="alamat"
                                            value="{{ old('alamat', $setting->alamat) }}" id="alamat">
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email', $setting->email) }}" id="email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="phone" class="col-sm-2 col-form-label">Nomer Perusahaan</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" value="{{ old('phone', $setting->phone) }}" id="phone">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div id="phone-error" class="invalid-feedback" style="display: none;">
                                            Format nomor telepon harus dimulai dengan '62'.
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    const phoneInput = document.getElementById('phone');
                                    const phoneError = document.getElementById('phone-error');

                                    phoneInput.addEventListener('input', function() {
                                        let phoneValue = phoneInput.value;
                                        phoneValue = phoneValue.replace(/\D/g, '');

                                        if (!phoneValue.startsWith('62')) {
                                            phoneError.style.display = 'block';
                                        } else {
                                            phoneError.style.display = 'none';
                                        }

                                        if (!phoneValue.startsWith('62')) {
                                            phoneValue = '62' + phoneValue;
                                        }

                                        phoneInput.value = phoneValue;
                                    });
                                </script>

                                <div class="form-group row border-bottom pb-4">
                                    <label for="jam_buka" class="col-sm-2 col-form-label">Jam buka</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('jam_buka') is-invalid @enderror"
                                            name="jam_buka" value="{{ old('jam_buka', $setting->jam_buka) }}"
                                            id="jam_buka">
                                        @error('jam_buka')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="footer_description" class="col-sm-2 col-form-label">Footer
                                        Description</label>
                                    <div class="col-sm-12">
                                        <textarea name="footer_description" id="footer_description"
                                            class="form-control @error('footer_description') is-invalid @enderror" cols="30" rows="6">{{ old('footer_description', $setting->footer_description) }}</textarea>
                                        @error('footer_description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="tentang_perusahaan" class="col-sm-2 col-form-label">Tentang
                                        Perusahaan</label>
                                    <div class="col-sm-12">
                                        <textarea name="tentang_perusahaan" id="tentang_perusahaan"
                                            class="form-control @error('tentang_perusahaan') is-invalid @enderror" cols="30" rows="6">{{ old('tentang_perusahaan', $setting->tentang_perusahaan) }}</textarea>
                                        @error('tentang_perusahaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="sejarah_perusahaan" class="col-sm-2 col-form-label">Sejarah
                                        Perusahaan</label>
                                    <div class="col-sm-12">
                                        <textarea name="sejarah_perusahaan" id="sejarah_perusahaan"
                                            class="form-control @error('sejarah_perusahaan') is-invalid @enderror" cols="30" rows="6">{{ old('sejarah_perusahaan', $setting->sejarah_perusahaan) }}</textarea>
                                        @error('sejarah_perusahaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="tentang_team" class="col-sm-2 col-form-label">Tentang Team</label>
                                    <div class="col-sm-12">
                                        <textarea name="tentang_team" id="tentang_team" class="form-control @error('tentang_team') is-invalid @enderror"
                                            cols="30" rows="6">{{ old('tentang_team', $setting->tentang_team) }}</textarea>
                                        @error('tentang_team')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="hubungi_kami" class="col-sm-2 col-form-label">Hubungi Kami</label>
                                    <div class="col-sm-12">
                                        <textarea name="hubungi_kami" id="hubungi_kami" class="form-control @error('hubungi_kami') is-invalid @enderror"
                                            cols="30" rows="6">{{ old('hubungi_kami', $setting->hubungi_kami) }}</textarea>
                                        @error('hubungi_kami')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="maps" class="col-sm-3 col-form-label">Link Peta Google Maps</label>
                                    <div class="col-sm-12">
                                        <textarea name="maps" id="maps" class="form-control @error('maps') is-invalid @enderror" cols="30"
                                            rows="6">{{ old('maps', $setting->maps) }}</textarea>
                                        @error('maps')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                                    <div class="col-sm-12">
                                        <input type="text" placeholder="https://example.com" pattern="https://.*"
                                            class="form-control @error('facebook') is-invalid @enderror" name="facebook"
                                            value="{{ old('facebook', $setting->facebook) }}" id="facebook">
                                        @error('facebook')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                                    <div class="col-sm-12">
                                        <input type="text" placeholder="https://example.com" pattern="https://.*"
                                            class="form-control @error('instagram') is-invalid @enderror"
                                            name="instagram" value="{{ old('instagram', $setting->instagram) }}"
                                            id="instagram">
                                        @error('instagram')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="linkedin" class="col-sm-2 col-form-label">Linkedin</label>
                                    <div class="col-sm-12">
                                        <input type="text" placeholder="https://example.com" pattern="https://.*"
                                            class="form-control @error('linkedin') is-invalid @enderror" name="linkedin"
                                            value="{{ old('linkedin', $setting->linkedin) }}" id="linkedin">
                                        @error('linkedin')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="twitter" class="col-sm-2 col-form-label">twitter</label>
                                    <div class="col-sm-12">
                                        <input type="text" placeholder="https://example.com" pattern="https://.*"
                                            class="form-control @error('twitter') is-invalid @enderror" name="twitter"
                                            value="{{ old('twitter', $setting->twitter) }}" id="twitter">
                                        @error('twitter')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
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
    <!-- Modal untuk Crop Gambar -->
    <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title" id="cropModalLabel">Crop Logo</h5>
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
                var logoInput = document.getElementById('logo');
                var image = document.getElementById('imageCrop');
                var cropButton = document.getElementById('cropButton');
                var cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
                var cropper;

                logoInput.addEventListener('change', function(e) {
                    var files = e.target.files;
                    var done = function(url) {
                        logoInput.value = '';
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
                                formData.append('logo', blob);
                                formData.append('_token', '{{ csrf_token() }}');

                                fetch('{{ route('admin.settings.updateLogo') }}', {
                                    method: 'POST',
                                    body: formData,
                                }).then(response => response.json()).then(data => {
                                    if (data.success) {
                                        cropModal.hide();
                                        // alert('Logo berhasil diperbarui!');
                                        existingLogoPreview.src = base64data;
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: 'Logo berhasil diperbarui!',
                                            icon: 'success',
                                            confirmButtonColor: '#5e72e4',
                                            confirmButtonText: 'OK',
                                            timer: 1500
                                        });
                                        // location.reload();
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1500); // 1500 milidetik = 1,5 detik
                                    } else {
                                        // alert('Gagal memperbarui logo.');
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: 'Gagal memperbarui logo.',
                                            icon: 'error',
                                            confirmButtonColor: '#5e72e4',
                                            confirmButtonText: 'OK',
                                            timer: 1500
                                        });
                                    }
                                }).catch(error => {
                                    console.error(error);
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: 'Terjadi kesalahan.',
                                        icon: 'error',
                                        confirmButtonColor: '#5e72e4',
                                        confirmButtonText: 'OK',
                                        timer: 1500
                                    });
                                    // alert('Terjadi kesalahan.');
                                });
                            };
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
