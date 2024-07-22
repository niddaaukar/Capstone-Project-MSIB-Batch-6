<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Sewa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Rotasi tabel */
        @page {
            size: landscape;
        }

        .table td {
            white-space: normal;
            word-wrap: break-word;
        }

        .table th {
            white-space: normal;
            word-wrap: break-word;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        {{-- <h1 class="text-center">Data Sewa</h1> --}}
        <p>Dicetak: {{ $formattedDate }}</p>
        <header>
            <div class="text-center">
                <h1>OtoRent</h1>
            </div>
            <h1 class="text-center">Data Sewa</h1>

            <h6>Periode {{ $startDate }} - {{ $endDate }}</h6>
        </header>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Kendaraan</th>
                    <th>Unit</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Durasi</th>
                    <th>Pickup</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPendapatan = 0;
                @endphp
                @foreach ($bookings as $booking)
                    @if ($booking->booking_status == 'Selesai')
                        @php
                            $totalPendapatan += $booking->total_fee;
                        @endphp
                    @endif
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->vehicle_type == 'car' ? 'Mobil' : 'Motor' }}</td>
                        <td>{{ $booking->vehicle_type == 'car' ? $booking->vehicle->nama_mobil : $booking->vehicle->nama_motor }}
                        </td>
                        <td>{{ $booking->start_date }}</td>
                        <td>{{ $booking->end_date }}</td>
                        <td>{{ $booking->days_count }} Hari</td>
                        <td>{{ $booking->pickup }}</td>
                        <td>Rp {{ number_format($booking->total_fee, 0, ',', '.') }}</td>
                        <td>{{ $booking->booking_status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p>Total Pendapatan: Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
    </div>
</body>

</html>
