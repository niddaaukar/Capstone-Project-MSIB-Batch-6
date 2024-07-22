@extends('frontend.layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center text-center">
            <div class="col-md-6">
                <h1 class="mb-4">Booking Berhasil!</h1>
                <p class="lead mb-5">Terima Kasih Telah Memesan Kendaraan Kami</p>
                <a href="{{ url('history') }}" class="btn btn-primary">Kembali ke Riwayat Pemesanan</a>
            </div>
        </div>
    </div>
@endSection