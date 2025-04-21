<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Majestic Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('Admin/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('Admin/vendors/base/vendor.bundle.base.css') }}" />
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('Admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('Admin/css/style.css') }}" />
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('Admin/images/favicon.png') }}" />
    {{-- add bootstrap 5 CSS link  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <!--link to master -->
    @yield('link-to-master')

    <!-- plugins:js -->
    <script src="{{ asset('Admin/vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ asset('Admin/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('Admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('Admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('Admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('Admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('Admin/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('Admin/js/dashboard.js') }}"></script>
    <script src="{{ asset('Admin/js/data-table.js') }}"></script>
    <script src="{{ asset('Admin/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('Admin/js/dataTables.bootstrap4.js') }}"></script>
    <!-- End custom js for this page-->

    <script src="{{ asset('Admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
    {{-- bootstrap JS link  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>
