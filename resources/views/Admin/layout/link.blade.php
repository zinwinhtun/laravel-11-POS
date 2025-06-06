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
    <script>
        // image upload
        function loadFile(event){
            var reader = new FileReader();
            reader.onload = function(){
                var image = document.getElementById('image');
                image.src = reader.result;
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    @yield('script')
</body>

</html>
