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
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-bordered table-striped table-hover text-nowrap table-responsive text-center align-middle w-100">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Foto</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">No HP</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">KTP</th>
                                            <th scope="col">SIM</th>
                                            <th scope="col">Status Akun</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <th scope="row">{{ $user->id }}</th>
                                                <td>
                                                    <a href="{{ Storage::url('avatars/' . $user->avatar) }}" target="_blank">
                                                        <img src="{{ Storage::url('avatars/' . $user->avatar) }}" width="100" alt="{{ $user->name }} Avatar" class="img-fluid img-thumbnail">
                                                    </a>
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>
                                                    <a href="{{ Storage::url('ktp/' . $user->ktp) }}" target="_blank">
                                                        <img src="{{ Storage::url('ktp/' . $user->ktp) }}" width="100" alt="">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ Storage::url('sim/' . $user->sim) }}" target="_blank">
                                                        <img src="{{ Storage::url('sim/' . $user->sim) }}" width="100" alt="">
                                                    </a>
                                                </td>
                                                <td>{{ $user->account_status }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('admin.users.edit', $user) }}"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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