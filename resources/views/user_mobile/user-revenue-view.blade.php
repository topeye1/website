@extends('layouts.mobile_user')
@section('content')
    <div class="form-group" style="margin: auto;">
        <div class="input-group d-flex p-2 justify-content-center" >
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="seldate_1" checked>
                <span class="form-check-label">{{ __('userpage.sel_month') }}</span>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="seldate_2">
                <span class="form-check-label">{{ __('userpage.sel_year') }}</span>
            </div>
        </div>
        <div class="input-group justify-content-center">
            <div class="d-flex" style="width: 60%">
                <div class="direction-key" id="direction-left" style="width: 20%"><i class="fas fa fa-chevron-left"></i></div>
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                    </div>
                </div>
                <input id="datepicker_1" class="form-control datepicker_1" placeholder="YYYY-MM" type="text" style="display: block">
                <input id="datepicker_2" class="form-control datepicker_2" placeholder="YYYY" type="text" style="display: none">

                <div class="direction-key" id="direction-right" style="width: 20%"><i class="fas fa fa-chevron-right"></i></div>
            </div>
        </div>

        <div class="row justify-content-center mt-3" style="width: 80%; margin: 0 auto;">
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card h-100 py-2" style="background-color: #F0F1F4;">
                    <div class="card-body my-top-card">
                        <div class="row no-gutters align-items-center dash-top-items">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-center mb-1">
                                    {{ __('userpage.today_revenue') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center" id="today_revenue">
                                    <span id="today_revenue_money">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card h-100 py-2" style="background-color: #F0F1F4;">
                    <div class="card-body my-top-card">
                        <div class="row no-gutters align-items-center dash-top-items">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-center mb-1">
                                    {{ __('userpage.cash_balance') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center" id="cash_balance">
                                    <span id="cash_balance_money">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card h-100 py-2" style="background-color: #F0F1F4;">
                    <div class="card-body my-top-card">
                        <div class="row no-gutters align-items-center dash-top-items">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-center mb-1" id="revenue_text">
                                    {{ __('userpage.month_revenue') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center" id="month_revenue">
                                    <span id="month_revenue_money"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card h-100 py-2" style="background-color: #F0F1F4;">
                    <div class="card-body my-top-card">
                        <div class="row no-gutters align-items-center dash-top-items">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-center mb-1">
                                    {{ __('userpage.monthly_roi') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center" id="monthly_roi">
                                    <span id="monthly_roi_percent">0</span>
                                    <span>%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card h-100 py-2" style="background-color: #F0F1F4;">
                    <div class="card-body my-top-card">
                        <div class="row no-gutters align-items-center dash-top-items">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-center mb-1">
                                    {{ __('userpage.annual_roi') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center" id="annual_roi">
                                    <span id="annual_roi_percent">0</span>
                                    <span>%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group" style="width: 95%; margin: 0 auto;">
        <div class="row">
            <table class="table table-bordered user-page-table" id="dataTable" style="border: 0;">
                <tbody id="tbody_symbol_list">


                </tbody>
            </table>
        </div>
        <div class="row mb-3">
            @include('layouts.page-navigation3')
        </div>
    </div>
    <div class="form-group" style="width: 100%; margin: 0 auto;">
        @include('user_mobile.user-revenue-chart-view')
    </div>
    <div class="form-group">
        @include('user_mobile.user-revenue-list-view')
    </div>
@endsection
@section('js')
    <script>
        let mpstart = 1; // datalist page navigation
        let gpstart = 1; // progress page navigation
        let my_max_amount = 0;
        let radio_idx = 1;
        let filter_date = '';
        let selected_date = '';
        let symbol_totalpage = 0;

        $(document).ready(function () {
            getMyInfo();
            $('.mobile_top_tab').click(function (){
                window.location.href = '{{ url('/user_mobile.user-revenue-view/user-page/revenue') }}';
            });
        });
        function numberWithCommas(number) {
            return number.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")
        }
        function initDataPicker() {
            $("#datepicker_1").datepicker( {
                minViewMode: 1,
                maxViewMode: 2,
                autoclose: true,
                language: "{{session()->get('locale')}}",
                format: "yyyy-mm",
                orientation: "bottom auto"
            });
            $("#datepicker_2").datepicker( {
                minViewMode: 2,
                maxViewMode: 2,
                autoclose: true,
                language: "{{session()->get('locale')}}",
                format: "yyyy",
                orientation: "bottom auto"
            });

            let today = new Date();
            setDatepicker(radio_idx, getCurrentDate(today, radio_idx, 0));
            $('input[id^="seldate_"]').click(function(){
                let oid=$(this).attr("id");
                radio_idx = oid.split('_')[1];
                //if (parseInt(radio_idx) === 1) {
                    $('#revenue_text').text('{{ __('userpage.month_revenue') }}');
                //} else {
                //    $('#revenue_text').text('{{ __('userpage.year_revenue') }}');
                //}

                $('input[id^="datepicker_"]').css("display","none");
                $('input[id^="datepicker_"]').val();

                $('input[id^="datepicker_'+radio_idx+'"]').css("display","block");

                setDatepicker(radio_idx, getCurrentDate(today, radio_idx, 0));

            });
            $('#direction-left').click(function(){
                setDatepicker(radio_idx, getCurrentDate(selected_date, radio_idx, -1));
            });
            $('#direction-right').click(function(){
                setDatepicker(radio_idx, getCurrentDate(selected_date, radio_idx, 1));
            });
            $('#datepicker_1').change(function(){
                mpstart = 1;
                gpstart = 1;
                let now_date = new Date();
                let day = '-' + ( (now_date.getDate()) < 9 ? "0" + (now_date.getDate()) : (now_date.getDate()));
                filter_date = $('#datepicker_1').val();
                selected_date = new Date(filter_date + day);
                getRevenueInfo();
                getCoinRevenueList();
                showRevenueDataList();
            });
            $('#datepicker_2').change(function(){
                mpstart = 1;
                gpstart = 1;
                let now_date = new Date();
                let month = '-' + ( (now_date.getMonth()+1) < 9 ? "0" + (now_date.getMonth()+1) : (now_date.getMonth()+1) );
                let day = '-' + ( (now_date.getDate()) < 9 ? "0" + (now_date.getDate()) : (now_date.getDate()));
                filter_date = $('#datepicker_2').val();
                selected_date = new Date(filter_date + month + day);
                getRevenueInfo();
                getCoinRevenueList();
                showRevenueDataList();
            });
        }
        function getRevenueInfo() {
            $.ajax({
                url: '/user.revenueInfo',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    search_date: filter_date,
                    market: market,
                    date_idx: radio_idx
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        let d_profit = parseFloat(data.day_profit);
                        let day_profit = '$' + d_profit;
                        if (d_profit < 0) {
                            day_profit = '-$' + Math.abs(d_profit);
                        }
                        $('#today_revenue_money').text(day_profit);
                        $('#cash_balance_money').text('$'+data.current_amount);
                        let m_profit = parseFloat(data.month_profit);
                        let month_profit = '$' + m_profit;
                        if (m_profit < 0) {
                            month_profit = '-$' + Math.abs(m_profit);
                        }
                        $('#month_revenue_money').text(month_profit);
                        $('#monthly_roi_percent').text(data.month_rate);
                        $('#annual_roi_percent').text(data.year_rate);
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }
        function getCoinRevenueList() {
            $.ajax({
                url: '/user.coinRevenue',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    pstart: gpstart,
                    search_date: filter_date,
                    market: market,
                    date_idx: radio_idx,
                    pages: 5,
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        let tags = '';
                        $('#tbody_symbol_list').html('');
                        gpstart = parseInt(data.pstart);
                        symbol_totalpage = parseInt(data.totalpage);

                        let lists = data.symbol_list;
                        for (let i = 0; i < lists.length; i++) {
                            let list = lists[i];
                            let profit = parseFloat(list.profit);
                            let bet_limit = parseFloat(list.bet_limit);
                            let pro = Math.round(profit / bet_limit * 100);
                            let percent1 = 50;
                            let percent2 = pro;
                            if (pro < 0) {
                                if (pro > 50) {
                                    pro = 50;
                                }
                                percent1 = 50 - Math.abs(pro);
                                percent2 = Math.abs(pro);
                            }
                            let bar_color = "#f14382 !important";
                            let radius = "border-top-right-radius: 4px; border-bottom-right-radius: 4px;";
                            if (profit < 0) {
                                bar_color = "#0098d9 !important";
                                radius = "border-top-left-radius: 4px; border-bottom-left-radius: 4px;";
                            }
                            tags += '<tr>';
                            tags += '   <td>';
                            tags += '   <div class="row" style="align-items: center;">';
                            tags += '       <div class="col-3 market-name">'+list.symbol+'</div>';
                            tags += '       <div class="col-6">';
                            tags += '           <div class="progress">';
                            tags += '               <div class="progress" role="progressbar" style="width: '+percent1+'%;"></div>';
                            tags += '               <div class="progress-bar bg-info" role="progressbar" style="width: '+percent2+'%; background-color: '+bar_color+'; '+radius+'"></div>';
                            tags += '           </div>';
                            tags += '       </div>';
                            tags += '       <div class="col-3 market-money">';
                            tags += '           <span>$</span>';
                            tags += '           <span id="market-money-val_1">'+list.profit+'</span>';
                            tags += '       </div>';
                            tags += '   </div>';
                            tags += '   </td>';
                            tags += '</tr>';
                        }
                        $('#tbody_symbol_list').html(tags);
                        setPageNavigation3(symbol_totalpage, gpstart, getCoinRevenueList);
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }

        function setDatepicker(idx, date) {
            mpstart = 1;
            gpstart = 1;
            if (parseInt(idx) === 1) {
                $( '#datepicker_1' ).datepicker( "setDate", date );
                selected_date = $('#datepicker_1').datepicker('getDate');
                filter_date = $('#datepicker_1').val();
            } else if (parseInt(idx) === 2) {
                $( '#datepicker_2' ).datepicker( "setDate", date );
                selected_date = $('#datepicker_2').datepicker('getDate');
                filter_date = $('#datepicker_2').val();
            }
            getRevenueInfo();
            getCoinRevenueList();
            showRevenueDataList();
        }
        function getCurrentDate(today, idx, val) {
            let date;
            if (parseInt(idx) === 1) {
                date = new Date(today.setMonth(today.getMonth() + val))
            }
            if (parseInt(idx) === 2) {
                date = new Date(today.setFullYear(today.getFullYear() + val))
            }
            return date;
        }

        function getMyInfo() {
            $.ajax({
                url: '/user.myInfo',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        my_coupon = data.my_coupon;
                        market = data.market;
                        my_level = data.my_level;
                        my_id = data.my_id;
                        my_name = data.my_name;

                        $('#logo_bin').css('display', 'none');
                        $('#logo_htx').css('display', 'none');
                        if (market === 'bin') {
                            $('#logo_bin').css('display', 'block');
                        } else {
                            $('#logo_htx').css('display', 'block');
                        }
                        $('#span-user-level').text(my_level);
                        $('#span-user-id').text(my_name);

                        initDataPicker();
                        initRevenueList();

                        $('#mobile_tab_image').attr('src', '{{URL::asset('assets/img/pngs/revenue.png')}}');
                        $('#mobile_tab_text').text('{{ __('userpage.revenue') }}');
                        $('#mobile_val_img').css('display', 'block');
                        $('#mobile_val_img').attr('src', '{{URL::asset('assets/img/pngs/coupon.png')}}');
                        $('#mobile_val_text').text('{{ __('userpage.coupon_balance') }}');
                        $('#mobile_val_unit').text('$');
                        $('#mobile_val_balance').text(my_coupon);
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }
    </script>
@endsection
