    <!-- Core plugin JavaScript-->
    <script src="{{ URL::asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ URL::asset('assets/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{ URL::asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Datapicker plugins -->
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.ko.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.zh-CN.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.ja.min.js')}}"></script>
{{--
    <!-- Page level plugins -->
    <script src="{{ URL::asset('assets/vendor/chart.js/Chart.min.js')}}"></script>


    <!-- Page level custom scripts -->
    <script src="{{ URL::asset('assets/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ URL::asset('assets/js/demo/chart-pie-demo.js')}}"></script>
--}}
    @yield('js')
