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
                            <form method="post" action="{{ route('admin.cancellations.update', $cancellation->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group row border-bottom pb-4">
                                            <label for="nama" class="col-form-label">Nama</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="nama"
                                                    value="{{ old('name', $cancellation->user->name) }}" id="nama" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row border-bottom pb-4">
                                            <label for="booking_code" class="col-form-label">Kode Booking</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="booking_code"
                                                    value="{{ old('booking_code', $cancellation->booking_code) }}" id="booking_code" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row border-bottom pb-4">
                                            <label for="reason" class="col-form-label">Alasan Pembatalan</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="reason"
                                                    value="{{ old('reason', $cancellation->reason) }}" id="reason" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row pb-4">
                                            <label for="refund_account" class="col-form-label">Rekening Pengembalian</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="refund_account" id="refund_account"
                                                    value="{{ old('refund_account', $cancellation->refund_account) }}" id="refund_account" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row pb-4">
                                            <div class="col-sm-12">
                                                <label for="proof_payment" class="col-form-label">Bukti Pembayaran</label>
                                                <input type="hidden" name="proof_payment" id="proof_payment" value="{{ $cancellation->proof_payment }}"><br>
                                                <a href="{{ Storage::url($cancellation->proof_payment) }}" target="_blank">
                                                    <img src="{{ Storage::url($cancellation->proof_payment) }}" width="100%"
                                                        alt="{{ $cancellation->user->name }} Bukti Pembayaran">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="refund_proof">Upload Bukti Pengembalian Dana</label>
                                    <input type="file" class="form-control" name="refund_proof" id="refund_proof" accept="image/*">
                                </div>
                                
                                <button type="submit" class="btn btn-success">Simpan</button>
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
