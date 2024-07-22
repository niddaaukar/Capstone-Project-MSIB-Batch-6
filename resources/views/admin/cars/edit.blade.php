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
                            <a href="{{ route('admin.cars.index') }}" class="btn btn-success shadow-sm float-right"> 
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
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
                            <form method="post" action="{{ route('admin.cars.update', $car) }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group row border-bottom pb-4">
                                    <label for="nama_mobil" class="col-form-label">Nama Mobil</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('nama_mobil') is-invalid @enderror" name="nama_mobil"
                                            value="{{ old('nama_mobil', $car->nama_mobil) }}" id="nama_mobil">
                                        @error('nama_mobil')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="plat_nomor" class="col-form-label">Plat Nomor</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('nama_mobil') is-invalid @enderror" name="plat_nomor"
                                            value="{{ old('plat_nomor', $car->plat_nomor) }}" id=plat_nomor">
                                        @error('plat_nomor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="type_id" class="col-form-label">Tipe Mobil</label>
                                    <div class="col-sm-12">
                                        <select class="form-control @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                                            @foreach ($types as $type)
                                                <option {{ old('type_id', $car->type_id) == $type->id ? 'selected' : null }}
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
                                    <label for="price" class="col-form-label">Harga Sewa</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                                            value="{{ old('price', $car->price) }}" id="price">
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="penumpang" class="col-sm-2 col-form-label">Jumlah Penumpang</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control @error('penumpang') is-invalid @enderror" name="penumpang"
                                            value="{{ old('penumpang', $car->penumpang) }}" id="penumpang">
                                        @error('penumpang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="pintu" class="col-sm-2 col-form-label">Jumlah Pintu</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" name="pintu"
                                            value="{{ old('pintu', $car->pintu) }}" id="pintu">
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="image1" class="col-sm-2 col-form-label">Gambar 1</label>
                                    <div class="col-sm-12">
                                        <img src="{{ asset('storage/' . $car->image1) }}" alt="Gambar 1" class="img-thumbnail mb-2" width="150">
                                        <a href="{{ route('admin.cars.edit_image', ['car' => $car->id, 'image' => 'image1']) }}" class="btn btn-primary">Edit Gambar 1</a>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="image2" class="col-sm-2 col-form-label">Gambar 2</label>
                                    <div class="col-sm-12">
                                        <img src="{{ asset('storage/' . $car->image2) }}" alt="Gambar 2" class="img-thumbnail mb-2" width="150">
                                        <a href="{{ route('admin.cars.edit_image', ['car' => $car->id, 'image' => 'image2']) }}" class="btn btn-primary">Edit Gambar 2</a>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="image3" class="col-sm-2 col-form-label">Gambar 3</label>
                                    <div class="col-sm-12">
                                        <img src="{{ asset('storage/' . $car->image3) }}" alt="Gambar 3" class="img-thumbnail mb-2" width="150">
                                        <a href="{{ route('admin.cars.edit_image', ['car' => $car->id, 'image' => 'image3']) }}" class="btn btn-primary">Edit Gambar 3</a>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="image4" class="col-sm-2 col-form-label">Gambar 4</label>
                                    <div class="col-sm-12">
                                        <img src="{{ asset('storage/' . $car->image4) }}" alt="Gambar 4" class="img-thumbnail mb-2" width="150">
                                        <a href="{{ route('admin.cars.edit_image', ['car' => $car->id, 'image' => 'image4']) }}" class="btn btn-primary">Edit Gambar 4</a>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="description" id="description" cols="30" rows="6">{{ old('description', $car->description) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="status" class="col-form-label">Status</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="status" id="status">
                                            @foreach ($statuses as $no => $status)
                                                <option {{ old('status', $car->status) == $no ? 'selected' : null }}
                                                    value="{{ $no }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
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
