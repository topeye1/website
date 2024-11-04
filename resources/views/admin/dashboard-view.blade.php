@extends('layouts.master_admin')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body my-top-card">
                        <div class="row no-gutters align-items-center dash-top-items">
                            <div class="col mr-2">
                                <a href="{{ url('/admin.user-view/user-list') }}">
                                    <div class="text-xs dash-top-text font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('userpage.total_users') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_users"></div>
                                </a>
                            </div>

                            <div class="col-auto" id="total_user">
                                <i class="fas fa-fw fa-chart-area fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body my-top-card">
                        <div class="row no-gutters align-items-center dash-top-items">
                            <div class="col mr-2">
                                <a href="{{ url('/admin.usage-status-view/usage') }}">
                                    <div class="text-xs dash-top-text font-weight-bold text-success text-uppercase mb-1">
                                    {{ __('userpage.actived_user') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="actived_users"></div>
                                </a>
                            </div>
                            <div class="col-auto" id="actived_user">
                                <i class="fas fa-fw fa-chart-area fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body my-top-card">
                        <div class="row no-gutters align-items-center dash-top-items">
                            <div class="col mr-2">
                                <a href="{{ url('/admin.agent-view/agent') }}">
                                    <div class="text-xs dash-top-text font-weight-bold text-info text-uppercase mb-1">
                                    {{ __('userpage.agent_user') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="agent_users"></div>
                                </a>
                            </div>
                            <div class="col-auto" id="agent_user">
                                <i class="fas fa-fw fa-chart-area fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body my-top-card">
                        <div class="row no-gutters align-items-center dash-top-items">
                            <div class="col mr-2">
                                <a href="{{ url('/admin.agent-calc-request/request') }}">
                                    <div class="text-xs dash-top-text font-weight-bold text-warning text-uppercase mb-1">
                                    {{ __('userpage.request_point') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="req_point"></div>
                                </a>
                            </div>
                            <div class="col-auto" id="request_point">
                                <i class="fas fa-fw fa-chart-area fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body my-top-card">
                        <div class="row no-gutters align-items-center dash-top-items">
                            <div class="col mr-2">
                                <a href="{{ url('/admin.user-view/user-list') }}">
                                    <div class="text-xs dash-top-text font-weight-bold text-warning text-uppercase mb-1">
                                    {{ __('userpage.day_new_user') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="new_users"></div>
                                </a>
                            </div>
                            <div class="col-auto" id="new_user">
                                <i class="fas fa-fw fa-chart-area fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('js')
    <script>
        let current_id = 0;
        let pstart=1;
        let pnum = pstart;
        let pcount=5;
        let numg = 5;
        $(document).ready(function () {
            $('#total_user').click(function () {
                alert("total user");
            });

            $('#actived_user').click(function () {
                alert("actived user");
            });

            $('#agent_user').click(function () {

            });

            $('#request_point').click(function () {

            });

            $('#new_user').click(function () {

            });

            getDashboardInfo();

        });
        function getDashboardInfo() {
            $.ajax({
                url: '/admin.getDashboardInfo',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                type: 'POST',
                success: function (data) {
                    $('#total_users').text('');
                    $('#actived_users').text('');
                    $('#agent_users').text('');
                    $('#req_point').text('');
                    $('#new_users').text('');

                    if (data.msg === "ok") {
                        $('#total_users').text(data.total_users);
                        $('#actived_users').text(data.actived_users);
                        $('#agent_users').text(data.agent_users);
                        $('#req_point').text(data.req_point);
                        $('#new_users').text(data.new_users);
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(jqXHR['responseText'] ?? errdata);
                }
            });
        }
    </script>
@endsection
