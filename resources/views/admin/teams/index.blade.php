@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Semua Data</h3>
                            <a href="{{ route('admin.teams.create') }}" class="btn btn-success shadow-sm float-right"> <i
                                    class="fa fa-plus"></i> Tambah </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-bordered table-striped table-hover text-nowrap table-responsive text-center align-middle w-100">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Photo</th>
                                            <th>Jabatan</th>
                                            <th>Bio</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($teams as $team)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $team->nama }}</td>
                                                <td>
                                                    <a href="{{ Storage::url($team->photo) }}" target="_blank">
                                                        <img src="{{ Storage::url($team->photo) }}" width="80"
                                                            alt="">
                                                    </a>
                                                </td>
                                                <td>{{ $team->jabatan }}</td>
                                                <td>{{ $team->bio }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('admin.teams.edit', $team) }}"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form  action="{{ route('admin.teams.destroy', $team) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" team="submit"><i
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