@extends('layouts.master_admin')
@section('content')
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Admin Page, User Page, Watcher1</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th width="10%">Server Num</th>
                                    <th width="15%">IP</th>
                                    <th width="15%">Name</th>
                                    <th width="10%">CPU</th>
                                    <th width="10%">RAM(%)</th>
                                    <th width="10%">RAM size</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_data_list1">
                                <tr>
                                    <td id="number_1">1</td>
                                    <td id="ip_1">********</td>
                                    <td id="name_1">Web</td>
                                    <td id="cpu_1"></td>
                                    <td id="ram_1"></td>
                                    <td id="size_1"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="mb-4">
                <div class="card-body d-inline-flex">
                    <div class="chart-pie pb-2">
                        <div class="d-inline-flex w-100 justify-content-center">
                            <h6 class="m-0 font-weight-bold">CPU</h6>
                        </div>
                        <div class="d-flex">
                            <canvas id="web_cpu_chart"></canvas>
                        </div>
                    </div>
                    <div class="chart-pie pb-2">
                        <div class="d-inline-flex w-100 justify-content-center">
                            <h6 class="m-0 font-weight-bold">RAM</h6>
                        </div>
                        <div class="d-flex">
                            <canvas id="web_ram_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Watcher2 Server</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                            <thead>
                            <tr>
                                <th width="10%">Server Num</th>
                                <th width="15%">IP</th>
                                <th width="15%">Name</th>
                                <th width="10%">CPU</th>
                                <th width="10%">RAM(%)</th>
                                <th width="10%">RAM size</th>
                            </tr>
                            </thead>
                            <tbody id="tbody_data_list2">
                            <tr>
                                <td id="number_2">2</td>
                                <td id="ip_2">********</td>
                                <td id="name_2">Watcher2</td>
                                <td id="cpu_2"></td>
                                <td id="ram_2"></td>
                                <td id="size_2"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="mb-4">
                <div class="card-body d-inline-flex">
                    <div class="chart-pie pb-2">
                        <div class="d-inline-flex w-100 justify-content-center">
                            <h6 class="m-0 font-weight-bold">CPU</h6>
                        </div>
                        <div class="d-flex">
                            <canvas id="watcher2_cpu_chart"></canvas>
                        </div>
                    </div>
                    <div class="chart-pie pb-2">
                        <div class="d-inline-flex w-100 justify-content-center">
                            <h6 class="m-0 font-weight-bold">RAM</h6>
                        </div>
                        <div class="d-flex">
                            <canvas id="watcher2_ram_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Maker Server</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                            <thead>
                            <tr>
                                <th width="10%">Server Num</th>
                                <th width="15%">IP</th>
                                <th width="15%">Name</th>
                                <th width="10%">CPU</th>
                                <th width="10%">RAM(%)</th>
                                <th width="10%">RAM size</th>
                            </tr>
                            </thead>
                            <tbody id="tbody_data_list3">
                            <tr>
                                <td id="number_3">3</td>
                                <td id="ip_3">********</td>
                                <td id="name_3">Maker</td>
                                <td id="cpu_3"></td>
                                <td id="ram_3"></td>
                                <td id="size_3"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="mb-4">
                <div class="card-body d-inline-flex">
                    <div class="chart-pie pb-2">
                        <div class="d-inline-flex w-100 justify-content-center">
                            <h6 class="m-0 font-weight-bold">CPU</h6>
                        </div>
                        <div class="d-flex">
                            <canvas id="maker_cpu_chart"></canvas>
                        </div>
                    </div>
                    <div class="chart-pie pb-2">
                        <div class="d-inline-flex w-100 justify-content-center">
                            <h6 class="m-0 font-weight-bold">RAM</h6>
                        </div>
                        <div class="d-flex">
                            <canvas id="maker_ram_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ URL::asset('assets/vendor/chart.js/Chart.js')}}"></script>

    <script>
        $(document).ready(function () {
            showServerStatus();
            setInterval(function(){
                showServerStatus();
            }, 60000);
        });

        function showServerStatus() {
            $.ajax({
                url: '/admin.serverStatus',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        let web_cpu_using = parseFloat(data.web_cpu_using);
                        let web_ram_using = parseFloat(data.web_ram_using);
                        let web_ram_size = parseFloat(data.web_ram_size);

                        let w2_cpu_using = parseFloat(data.w2_cpu_using);
                        let w2_ram_using = parseFloat(data.w2_ram_using);
                        let w2_ram_size = parseFloat(data.w2_ram_size);

                        let m_cpu_using = parseFloat(data.m_cpu_using);
                        let m_ram_using = parseFloat(data.m_ram_using);
                        let m_ram_size = parseFloat(data.m_ram_size);

                        $('#cpu_1').text(web_cpu_using + " %");
                        $('#ram_1').text(web_ram_using + " %");
                        $('#size_1').text(web_ram_size + " G");

                        $('#cpu_2').text(w2_cpu_using + " %");
                        $('#ram_2').text(w2_ram_using + " %");
                        $('#size_2').text(w2_ram_size + " G");

                        $('#cpu_3').text(m_cpu_using + " %");
                        $('#ram_3').text(m_ram_using + " %");
                        $('#size_3').text(m_ram_size + " G");

                        let web_cup = document.getElementById("web_cpu_chart");
                        drawChart(web_cup, 'CPU', web_cpu_using, 100-web_cpu_using);
                        let web_ram = document.getElementById("web_ram_chart");
                        drawChart(web_ram, 'RAM', web_ram_using, 100-web_ram_using);

                        let watcher2_cup = document.getElementById("watcher2_cpu_chart");
                        drawChart(watcher2_cup, 'CPU', w2_cpu_using, 100-w2_cpu_using);
                        let watcher2_ram = document.getElementById("watcher2_ram_chart");
                        drawChart(watcher2_ram, 'RAM', w2_ram_using, 100-w2_ram_using);

                        let maker_cup = document.getElementById("maker_cpu_chart");
                        drawChart(maker_cup, 'CPU', m_cpu_using, 100-m_cpu_using);
                        let maker_ram = document.getElementById("maker_ram_chart");
                        drawChart(maker_ram, 'RAM', m_ram_using, 100-m_ram_using);
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }

        function drawChart(canvasID, title, using, free) {
            new Chart(canvasID, {
                type: 'doughnut',
                data: {
                    labels: ["using", "free"],
                    datasets: [{
                        data: [using, free],
                        backgroundColor: ['#064077', '#dcdcdc'],
                        hoverBackgroundColor: ['#478bcd', '#e9e9e9'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 70,
                },
            });

        }
    </script>
@endsection
