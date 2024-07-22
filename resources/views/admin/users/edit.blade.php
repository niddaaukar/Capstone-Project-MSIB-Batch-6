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
                            <a href="{{ route('admin.users.index') }}" class="btn btn-success shadow-sm float-right"> <i
                                    class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.users.update', $user) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row justify-content-center border-bottom">
                                    <div class="col-md-3">
                                        <div class="form-group row pb-4">
                                            <div class="col-sm-12">
                                                <label for="avatar" class="col-form-label">Avatar</label>
                                                <input type="hidden" name="avatar" value="{{ $user->avatar }}"><br>
                                                <a href="{{ Storage::url('avatars/' . $user->avatar) }}" target="_blank">
                                                    <img src="{{ Storage::url('avatars/' . $user->avatar) }}" width="100%"
                                                        alt="{{ $user->name }} Avatar">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group row border-bottom pb-4">
                                            <label for="nama" class="col-form-label">Nama</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="nama"
                                                    value="{{ old('name', $user->name) }}" id="nama" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row border-bottom pb-4">
                                            <label for="email" class="col-form-label">Email</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="email"
                                                    value="{{ old('email', $user->email) }}" id="email" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row pb-4">
                                            <label for="phone" class="col-form-label">No Handphone</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ old('phone', $user->phone) }}" id="phone" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="form-group row border-bottom pb-4">
                                        <label for="alamat" class="col-form-label">Alamat</label>
                                        <div class="col-sm-12">
                                            <input type="textarea" class="form-control" name="alamat"
                                                value="{{ old('alamat', $user->address) }}" id="alamat" readonly>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center border-bottom">
                                        <div class="col-md-6">
                                            <div class="form-group row pb-4">
                                                <div class="col-sm-12">
                                                    <label for="ktp" class="col-form-label">KTP</label>
                                                    <input type="hidden" name="ktp" value="{{ $user->ktp }}"><br>
                                                    <a href="{{ Storage::url('ktp/' . $user->ktp) }}" target="_blank">
                                                        <img src="{{ Storage::url('ktp/' . $user->ktp) }}" width="100%"
                                                            alt="{{ $user->name }} KTP"">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row pb-4">
                                                <div class="col-sm-12">
                                                    <label for="sim" class="col-form-label">SIM</label>
                                                    <input type="hidden" name="sim" value="{{ $user->sim }}"><br>
                                                    <a href="{{ Storage::url('sim/' . $user->sim) }}" target="_blank">
                                                        <img src="{{ Storage::url('sim/' . $user->sim) }}" width="100%"
                                                            alt="{{ $user->name }} SIM">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row border-bottom pb-4">
                                        <label for="status_akun" class="col-form-label">Status Akun</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" name="account_status" id="status_akun">
                                                <option value="Belum Terverifikasi"
                                                    {{ $user->account_status == 'Belum Terverifikasi' ? 'selected' : '' }}>
                                                    Belum Terverifikasi</option>
                                                <option value="Menunggu Verifikasi"
                                                    {{ $user->account_status == 'Menunggu Verifikasi' ? 'selected' : '' }}>
                                                    Menunggu Verifikasi</option>
                                                <option value="Terverifikasi"
                                                    {{ $user->account_status == 'Terverifikasi' ? 'selected' : '' }}>
                                                    Terverifikasi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Save</button>
                            </form>
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
