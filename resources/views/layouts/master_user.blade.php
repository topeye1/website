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

<body id="page-top" style="overflow: hidden;">

@include('layouts.user-tab')

<!-- Page Wrapper -->
<div id="wrapper" style="margin-bottom: 3rem;">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column" style="overflow-y: auto;">

        <!-- Main Content -->
        <div class="userpage-content" id="content">

            <!-- Topbar -->
            <nav class="navbar-expand navbar-light" style="height: 100%">
                <div class="container container-lg" style="max-width: 100%; height: 100%">
                    <!-- Body-->
                    <div class="row justify-content-center" style="min-height: 30rem; background-color: white; height: 100%">
                        <div class="tab-content" id="nav-tabContent" style="background-color: white; width: 100%; height: 100%">
                            <div class="tab-pane fade active show" id="nav-trade" role="tabpanel">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
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

<script>
    let market = 'bin';
    let my_coupon = 0; //나의 쿠폰 잔액
    let my_fee = 0; //나의 수수료율
    let my_points = 0; //나의 포인트 수량
    let my_level = 0; //나의 레벨
    let my_id = 0; //나의 아이디
    let my_name = 'liveacc'; //나의 이름

    $(document).ready(function () {
        let window_height = $(window).height();
        let content_height = parseInt(window_height) - 58 - 40 - 15;
        $('#content-wrapper').css({'height':content_height});
    });
</script>

</body>

</html>
