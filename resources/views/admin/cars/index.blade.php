@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Mobil</h3>
                            <a href="{{ route('admin.cars.create') }}" class="btn btn-success shadow-sm float-right"> <i
                                    class="fa fa-plus"></i> Tambah </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-bordered table-striped table-hover text-nowrap table-responsive text-center align-middle w-100">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama</th>
                                            <th>Plat Nomor</th>
                                            <th>Type Mobil</th>
                                            <th>Harga Sewa</th>
                                            <th>Jumlah Penumpang</th>
                                            <th>Jumlah Pintu</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($car as $cars)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $cars->image1) }}" alt="image" class="img-fluid" width="100">
                                                </td>
                                                <td>{{ $cars->nama_mobil }}</td>
                                                <td>{{ $cars->plat_nomor }}</td>
                                                <td>
                                                    <span class="badge bg-primary">
                                                        {{ $cars->type->nama }}
                                                    </span>
                                                </td>
                                                <td>Rp{{ number_format($cars->price, 0, ',', '.') }}</td>
                                                <td>{{ $cars->penumpang }}</td>
                                                <td>{{ $cars->pintu }}</td>
                                                <td>{{ $cars->statusLabel() }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('admin.cars.edit', $cars) }}"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.cars.destroy', $cars) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                </table>
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

@include('layouts.datatable')