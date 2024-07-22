@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Biaya Driver</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @forelse ($drivers as $driver)
                        <h3>Biaya Driver : Rp. {{ number_format($driver->biaya_driver) }}</h3>
                        <form method="post" action="{{ route('admin.drivers.update', $driver->id) }}">
                            @csrf
                            @method('put')
                            <div class="form-group row border-bottom pb-4">
                                <label for="biaya_driver" class="col-sm-2 col-form-label">Biaya Driver</label>
                                <div class="col-sm-12">
                                    <input type="hidden" name="id" value="{{ $driver->id }}">
                                    <input type="number" class="form-control" name="biaya_driver"
                                        value="{{ $driver->biaya_driver }}" id="biaya_driver" min="0" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                        @empty
                            
                        @endforelse
                        
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