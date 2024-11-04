<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">


<head>
    <title>User Page</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('assets/img/brand/favicon.ico')}}" />
    <!-- Custom fonts for this template-->
    <link href="{{ URL::asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ URL::asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <link href="{{ URL::asset('assets/js/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ URL::asset('assets/css/icons.css')}}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/use.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/datepicker.css')}}" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="{{ URL::asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper" style="margin-bottom: 3rem;">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div class="userpage-content" id="content">

            <!-- Topbar -->
            <nav class="navbar-expand navbar-light">

                @yield('content')
            </nav>

        </div>
    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

@include('layouts.footer-user')

</body>

</html>