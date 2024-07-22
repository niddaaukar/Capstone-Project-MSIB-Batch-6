@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data</h3>
                            <a href="{{ route('admin.motorcycles.index') }}" class="btn btn-success shadow-sm float-right"> <i
                                    class="fa fa-arrow-left"></i> Kembali</a>
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
                            <form method="post" action="{{ route('admin.motorcycles.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row border-bottom pb-4">
                                    <label for="nama_motor" class="col-sm-2 col-form-label">Nama Motor</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('nama_motor') is-invalid @enderror"
                                            name="nama_motor" value="{{ old('nama_motor') }}" id="nama_motor" required>
                                        @error('nama_motor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="plat_nomor" class="col-sm-2 col-form-label">Plat Nomor</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('nama_mobil') is-invalid @enderror"
                                            name="plat_nomor" value="{{ old('plat_nomor') }}" id="plat_nomor" required>
                                        @error('plat_nomor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="type_id" class="col-sm-2 col-form-label">Tipe Motor</label>
                                    <div class="col-sm-12">
                                        <select class="form-control @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                                            @foreach ($types as $type)
                                                <option {{ old('type_id') == $type->id ? 'selected' : null }}
                                                    value="{{ $type->id }}">{{ $type->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('type_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="price" class="col-sm-2 col-form-label">Harga Sewa</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                                            value="{{ old('price') }}" id="price">
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="image1" class="col-sm-2 col-form-label">Gambar-1</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control @error('image1') is-invalid @enderror id="image1" name="image1" accept="image/*" required>
                                        @error('image1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="image2" class="col-sm-2 col-form-label">Gambar-2</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control @error('image2') is-invalid @enderror" id="image2" name="image2" accept="image/*" required>
                                    </div>
                                    @error('image2')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Tambahkan input file untuk Gambar-3 -->
                                <div class="form-group row border-bottom pb-4">
                                    <label for="image3" class="col-sm-2 col-form-label">Gambar-3</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control @error('image3') is-invalid @enderror id="image3" name="image3" accept="image/*" required>
                                        @error('image3')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Tambahkan input file untuk Gambar-4 -->
                                <div class="form-group row border-bottom pb-4">
                                    <label for="image4" class="col-sm-2 col-form-label">Gambar-4</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control @error('image4') is-invalid @enderror" id="image4" name="image4" accept="image/*" required>
                                        @error('image4')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="6">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-12">
                                        <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                            @foreach ($statuses as $no => $status)
                                                <option {{ old('status') == $no ? 'selected' : null }}
                                                    value="{{ $no }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
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
@endsection
@push('script-alt')
    <script>
        $(document).ready(function() {
            $('input[type="number"]').on('keypress', function(event) {
                // Prevent "-" from being entered
                if (event.which === 45 || event.key === '-') {
                    event.preventDefault();
                }
            });

            $('input[type="number"]').on('input', function() {
                // Remove any negative signs that might have been pasted
                let value = $(this).val();
                if (value.indexOf('-') !== -1) {
                    $(this).val(value.replace('-', ''));
                }
            });

            $('input[type="number"]').on('blur', function() {
                // Ensure no negative value remains after input loses focus
                let value = $(this).val();
                if (value < 0) {
                    $(this).val(Math.abs(value)); // Convert negative to positive
                }
            });
        });
    </script>
@endpush
