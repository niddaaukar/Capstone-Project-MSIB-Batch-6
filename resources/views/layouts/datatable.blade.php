@push('style-alt')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('frontend/css/datatables/dataTables.bootstrap5.css') }}">
    <style>
        .table td  {
            white-space: normal;
            word-wrap: break-word;
        }
        .table th {
            white-space: normal;
            word-wrap: break-word;
            vertical-align: middle;
        }
    </style>
@endpush
@push('script-alt')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('.table');
    </script>
@endpush