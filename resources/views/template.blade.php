<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('head') </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('asset/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    <!-- endinject -->
    {{-- <link rel="shortcut icon" href="{{ asset('asset/images/favicon.png')}}" /> --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('asset/favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('asset/favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('asset/favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('asset/favicon_io/site.webmanifest') }}">
    @yield('style')
</head>

<body>

    <!-- partial:partials/_navbar.html -->
    @include('includes.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('includes.sidebar')
        <!-- partial -->
        <div class="main-panel">
            @yield('page')
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            @include('includes.footer')

            <script src="{{ asset('asset/vendors/base/vendor.bundle.base.js') }}"></script>
            <!-- endinject -->
            <!-- Plugin js for this page-->
            <script src="{{ asset('asset/vendors/chart.js/Chart.min.js') }}"></script>
            <script src="{{ asset('asset/js/jquery.cookie.js') }}" type="text/javascript"></script>
            <!-- End plugin js for this page-->
            <!-- inject:js -->
            <script src="{{ asset('asset/js/off-canvas.js') }}"></script>
            <script src="{{ asset('asset/js/hoverable-collapse.js') }}"></script>
            <script src="{{ asset('asset/js/template.js') }}"></script>
            <script src="{{ asset('asset/js/todolist.js') }}"></script>
            <!-- endinject -->
            <!-- Custom js for this page-->
            <script src="{{ asset('asset/js/dashboard.js') }}"></script>

            @yield('script')
            <!-- End custom js for this page-->
</body>

</html>
