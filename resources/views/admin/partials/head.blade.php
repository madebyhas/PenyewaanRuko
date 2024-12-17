<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin/src/asset/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('admin/src/assets/css/styles.min.css') }}" />
    <!--Responsive Extension Datatables CSS & JS-->
    <link rel="stylesheet" href="https://datatables.net/legacy/v1/media/css/dataTables.bootstrap5.css" />
   

    <title>Dashboard Aksara</title>
</head>

<body>
    <div class="wrapper">
        @include('admin.partials.nav')
        <div class="content-wrapper">
            @yield('container')
        </div>
    </div>
    @include('admin.partials.footer')

    </div>

    <script src="{{ asset('admin/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/src/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('admin/src/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('admin/src/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('admin/src/assets/js/dashboard.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>



</body>

</html>