@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Feedback</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table"
                                    class="table table-bordered table-striped table-hover text-nowrap table-responsive text-center align-middle w-100">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kendaraan</th>
                                            <th>Ulasan</th>
                                            <th>Rating</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($feedbacks as $feedback)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $feedback->user_name }}</td>
                                                <td>{{ $feedback->vehicle_type == 'car' ? $feedback->vehicle->nama_mobil : $feedback->vehicle->nama_motor }}
                                                </td>
                                                <td>{{ $feedback->feedback }}</td>
                                                <td>
                                                    @for ($i = 0; $i < $feedback->rating; $i++)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @endfor
                                                    @for ($i = $feedback->rating; $i < 5; $i++)
                                                        <i class="fas fa-star text-secondary"></i>
                                                    @endfor
                                                    <span class="ms-2">{{ $feedback->rating }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <form action="{{ route('admin.feedbacks.destroy', $feedback) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger" test$feedback="submit"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
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
@endSection
@include('layouts.datatable')
