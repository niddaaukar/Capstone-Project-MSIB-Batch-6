<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="{{ asset('favicon-96x96.png') }}" sizes="96x96" type="image/png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>{{ $setting->nama_perusahaan }} | Ankavi Team</title>
    <!--     Fonts and icons     -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/41f5370a51.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('frontend/css/argon/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    @stack('style-alt')
    
</head>
@yield('content')


@vite('resources/js/app.js')

<!--   Core JS Files   -->
<script src="{{ asset('frontend/js/argon/core/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/argon/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/argon/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('frontend/js/argon/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('frontend/js/argon/plugins/chartjs.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
{{-- @vite('resources/js/app.js') --}}
@stack('script-alt')

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('frontend/js/argon/argon-dashboard.min.js') }}"></script>
</body>

</html>
