@extends('layouts.mobile_user')
@section('content')
    <div class="form-group" style="margin: auto;">
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3 mt-3 ">
                <div class="input-group" style="width: 15rem;">
                    <div class="direction-key mr-3" id="direction-left"><i class="fas fa fa-chevron-left"></i></div>
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                        </div>
                    </div>
                    <input id="datepicker" class="form-control datepicker" placeholder="YYYY-MM-DD" type="text" style="display: block">

                    <div class="direction-key ml-3" id="direction-right"><i class="fas fa fa-chevron-right"></i></div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="margin: 0 auto; width: 100%;">
            <div class="settings-card-header justify-content-center notice-card-header mt-3" style="display: flex;">
                <ul class="nav nav-underline" style="font-size: 16px">
                    <li class="nav-item">
                        <a class="nav-link active" id="link-live" style="padding: 0.2rem 1rem !important;" data-set="live" href="#">Live Coin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="link-stop" style="padding: 0.2rem 1rem !important;" data-set="stop" href="#">Stop Coin</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row p-3 justify-content-center" id="trading_live_list" style="display:flex; margin: 0 auto; width: 100%; background-color: #DCE0ED">



        </div>
        <div class="row p-3 justify-content-center" id="trading_stop_list" style="display:none; margin: 0 auto; width: 100%; background-color: #DCE0ED">



        </div>
    </div>
    @include('modals.current-order-modal')
@endsection
@section('js')
    <script>
        let filter_date = '';
        let selected_date = '';
        let open_modal = 0;
        let open_symbol = '';
        let show_mark = 1;

        $(document).ready(function () {
            getMyInfo();
            initDataPicker();
            $('.settings-card-header .nav-link').click(function(){
                $('.settings-card-header .nav-link').attr('class','nav-link');
                $(this).attr('class','nav-link active');

                let data_set = $(this).attr('data-set');
                if(data_set === 'live') {
                    $('#trading_live_list').css({'display':'flex'});
                    $('#trading_stop_list').css({'display':'none'});
                }
                else if(data_set === 'stop') {
                    $('#trading_live_list').css({'display':'none'});
                    $('#trading_stop_list').css({'display':'flex'});
                }
            });

            $('.mobile_top_tab').click(function (){
                window.location.href = '{{ url('/user_mobile.user-trade-view/user-page/trade') }}';
            });
        });
        function initDataPicker() {
            $("#datepicker").datepicker( {
                language: "{{session()->get('locale')}}",
                format: "yyyy-mm-dd",
                autoclose: true,
                orientation: "bottom auto"
            });

            let curr = new Date();
            const utc = curr.getTime() + (curr.getTimezoneOffset() * 60 * 1000);
            const TIME_DIFF = 8 * 60 * 60 * 1000; // Beijing Timezone
            let today = new Date(utc + (TIME_DIFF));
            setDatepicker(getCurrentDate(today, 0));
            $('#datepicker').change(function(){
                filter_date = $('#datepicker').val();
                selected_date = new Date(filter_date);
                getLiveTradingList();
            });
            $('#direction-left').click(function(){
                setDatepicker(getCurrentDate(selected_date, -1));
                let s_date = getTody();
                if (s_date !== filter_date) {
                    show_mark = 0;
                } else {
                    show_mark = 1;
                }
                getLiveTradingList();
            });
            $('#direction-right').click(function(){
                setDatepicker(getCurrentDate(selected_date, 1));
                let s_date = getTody();
                if (s_date !== filter_date) {
                    show_mark = 0;
                } else {
                    show_mark = 1;
                }
                getLiveTradingList();
            });
            $('#btn_order_confirm').click( function () {
                $('#currentOrderModal').modal('hide');
            });
            $('#currentOrderModal').on('hidden.bs.modal', function () {
                open_modal = 0;
            })
        }
        function setDatepicker(date) {
            $( '#datepicker' ).datepicker( "setDate", date);
            selected_date = $('#datepicker').datepicker('getDate');
            filter_date = $('#datepicker').val();
        }
        function getCurrentDate(today, val) {
            return new Date(today.setDate(today.getDate() + val));
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

                        setDatepicker(data.today);
                        getLiveTradingList();
                        real_data();

                        $('#mobile_tab_image').attr('src', '{{URL::asset('assets/img/pngs/trade.png')}}');
                        $('#mobile_tab_text').text('{{ __('userpage.trade') }}');
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
        function getTody() {
            let curr = new Date();
            const utc = curr.getTime() + (curr.getTimezoneOffset() * 60 * 1000);
            const TIME_DIFF = 8 * 60 * 60 * 1000; // Beijing Timezone
            let today = new Date(utc + (TIME_DIFF));
            let year = today.getFullYear();
            let month = today.getMonth() + 1;
            let day = today.getDate();

            if (month < 10) month = '0' + month;
            if (day < 10) day = '0' + day;

            return year + '-' + month + '-' + day;
        }
        function getLiveTradingList() {
            $.ajax({
                url: '/user.liveTradingList',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    search_date: filter_date,
                    market: market
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        let live_lists = data.live_lists;
                        let live_symbols = data.live_symbols;
                        let live_leverages = data.live_leverage;
                        let live_running = data.live_running;
                        let live_limit = data.live_limit;
                        let hold_status = data.hold_status;

                        let stop_lists = data.stop_lists;
                        let stop_symbols = data.stop_symbols;
                        let stop_leverages = data.stop_leverage;
                        let stop_limit = data.stop_limit;

                        showLiveTradingList(live_lists, live_symbols, live_leverages, live_running, live_limit, hold_status);
                        showStopTradingList(stop_lists, stop_symbols, stop_leverages, stop_limit);
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }
        function showLiveTradingList(lists, symbols, leverages, running, limits, holdings) {
            let tags = '';
            $('#trading_live_list').html('');
            for (let i = 0; i < lists.length; i++) {
                let live_data = lists[i].reverse();
                let symbol = symbols[i];
                let leverage = leverages[i];
                let limit = limits[i];
                let holding = holdings[i];

                let t_profit = 0;
                let e_profit = 0;
                let amount = (limit / leverage) * 10;
                let rate = 0;
                //let total_expect_profit = 0;
                for (let p = 0; p < live_data.length; p++) {
                    let l_data = live_data[p];
                    if (parseFloat(l_data.make_price) === 0) {
                        e_profit += 0;
                        t_profit += 0;
                    } else {
                        if (l_data.profit_money !== 'OK')
                            t_profit += parseFloat(l_data.profit_money);
                        if (l_data.side === 'buy') {
                            e_profit += parseFloat(l_data.order_money) - (parseFloat(l_data.order_money) * parseFloat(l_data.order_price) / parseFloat(l_data.make_price));
                        } else {
                            e_profit += (parseFloat(l_data.order_money) * parseFloat(l_data.order_price) / parseFloat(l_data.make_price)) - parseFloat(l_data.order_money);
                        }
                    }
                    let margin =  Math.round(l_data.order_money * 1000) / 1000;
                }
                //let profit = Math.round(e_profit * 1000) / 1000;
                let profit = Math.round(t_profit * 1000) / 1000
                let total_profit = '$' + profit;
                let total_profit_color = '#ff0000';
                if (profit < 0) {
                    total_profit = '-$' + Math.abs(profit);
                    total_profit_color = '#0070c0';
                }
                rate = (profit / amount) * 100;
                let is_run = parseInt(running[i]);
                tags += '<div class="card shadow mt-3 mb-3 d-flex" id="trading_orders">';
                tags += '<div class="trade-card-header">';
                tags += '    <div class="d-flex mb-2">';
                if (show_mark === 1) {
                    let break_txt = "BREAK";
                    if (holding === 0) {
                        if (is_run === 1) {
                            tags += '        <span class="trade-color-live">LIVE</span>';
                        } else {
                            let bg_color = 'background-color: #ffc000;';
                            if (is_run === 2) {
                                break_txt = "L_BREAK";
                                bg_color = 'background-color: #ffc000;';
                            } else if (is_run === 3) {
                                break_txt = "S_BREAK";
                                bg_color = 'background-color: #e9e902;';
                            } else if (is_run === 4) {
                                break_txt = "LS_BREAK";
                                bg_color = 'background-color: #92d050;';
                            }
                            tags += '        <span class="trade-color-break" style="'+bg_color+'">'+break_txt+'</span>';
                        }
                    } else {
                        tags += '        <span class="trade-color-live" style="background-color:#ffacca; color: #000000">HOLDING</span>';
                    }
                }
                tags += '        <span class="trade-header-title">'+symbol+'</span>';
                tags += '        <span class="trade-header-leverage">x'+leverage+'</span>';
                tags += '        <span class="trade-header-profit" style="color: '+total_profit_color+'">'+total_profit+'</span>';
                tags += '     </div>';
                tags += '    <div class="d-flex">';
                tags += '        <div class="d-flex mt-2" style="width: 60%;">';
                tags += '            <span class="btn btn-user my-middle-btn btn-block" id="btn-live-status_'+symbol+'">{{ __('userpage.order_status') }}</span>';
                tags += '        </div>';
                tags += '        <div style="text-align: right; width: 100%;">';
                tags += '            <div style="font-size:0.7rem">{{ __('userpage.day_revenue_rate') }}</div>';
                tags += '            <div class="trade-header-profit" style="color: '+total_profit_color+'">'+Math.round(rate * 10000) / 10000+'%</div>';
                tags += '        </div>';
                tags += '    </div>';
                tags += '</div>';
                tags += '<div class="trade-card-body">';
                tags += '   <table class="table user-page-table" id="trading_table">';
                tags += '       <tbody>';

                for (let k = 0; k < live_data.length; k++) {
                    //let index = k + 1;
                    let list = live_data[k];
                    if (list.order_position === 0) {
                        continue;
                    }
                    let side1 = '{{ __('userpage.side1') }}';
                    let side2 = '{{ __('userpage.side2') }}';
                    let side1_color = '#ff0000'
                    let side2_color = '#0070c0'
                    if (list.side === 'sell') {
                        side1 = '{{ __('userpage.side2') }}';
                        side2 = '{{ __('userpage.side1') }}';
                        side1_color = '#0070c0'
                        side2_color = '#ff0000'
                    }
                    let price1 = Math.round(list.order_price * 1000000) / 1000000;
                    let price2 = Math.round(list.make_price * 1000000) / 1000000;

                    let margin1 =  Math.round(list.order_money * 10000) / 10000;
                    //let margin2 =  Math.round(list.make_money * 1000) / 1000;
                    if (k % 2 === 1) {
                        tags += '   <tr style="background-color: #fdfdfd;">';
                    } else {
                        tags += '   <tr style="background-color: #f5f5f5;">';
                    }
                    let profit = list.profit_money;
                    let profit_color = '#858796';
                    if (list.profit_money !== 'OK') {
                        let profit_money = Math.round(list.profit_money * 10000) / 10000;
                        profit = '$' + profit_money
                        if (profit_money < 0) {
                            profit = '-$' + Math.abs(profit_money);
                            profit_color = '#0070c0';
                        } else {
                            profit_color = '#ff0000';
                        }
                    }

                    let e_money = 0;
                    if (list.side === 'buy') {
                        e_money = parseFloat(list.order_money) - (parseFloat(list.order_money) * parseFloat(list.order_price) / parseFloat(list.make_price));
                    } else {
                        e_money = (parseFloat(list.order_money) * parseFloat(list.order_price) / parseFloat(list.make_price)) - parseFloat(list.order_money);
                    }
                    e_money = Math.round(e_money * 10000) / 10000;
                    let e_profit_color = '#ff0000';
                    let e_profit = '$' + e_money;
                    if (e_money < 0) {
                        e_profit = '-$' + Math.abs(e_money);
                        e_profit_color = '#0070c0';
                    }

                    //tags += '           <td class="text-nowrap align-middle" style="width: 10%">' + index + '</td>';
                    tags += '           <td class="text-nowrap align-middle" style="width: 15%">';
                    tags += '               <div style="color: '+side1_color+'">' + side1 + '</div>';
                    tags += '               <div style="color: '+side2_color+'">' + side2 + '</div>';
                    tags += '           </td>';
                    tags += '           <td class="text-nowrap align-middle" style="width: 35%">';
                    tags += '               <div>$' + price1 + '</div>';
                    tags += '               <div>$' + price2 + '</div>';
                    tags += '           </td>';
                    tags += '           <td class="text-nowrap align-middle" style="width: 35%">';
                    tags += '               <div>$' + margin1 + '</div>';
                    tags += '               <div>';
                    tags += '               <span style="color: '+profit_color+'">' + profit + '</span>';
                    if (list.profit_money === "OK") {
                        tags += '               <span> / </span>';
                        tags += '               <span style="color: '+e_profit_color+'">' + e_profit + '</span>';
                    } else if (parseFloat(list.profit_money) !== 0) {
                        tags += '               <span> / </span>';
                        tags += '               <span style="color: '+e_profit_color+'">' + e_profit + '</span>';
                    }
                    tags += '               </div>';
                    tags += '           </td>';
                    tags += '       </tr>';
                }

                tags += '       </tbody>';
                tags += '    </table>';
                tags += '</div>';
                tags += '</div>';
            }
            if (tags === '') {
                tags += '<a id="nav-setting-tab" href="{{ url('/user_mobile.user-setting-view/user-page/setting') }}" style="width: 100%; text-align: center;">';
                tags += '    <span style="color:#4e73df;">{{ __('userpage.add_coins') }}</span>';
                tags += '</a>';
            }
            $('#trading_live_list').html(tags);
            $('span[id^="btn-live-status_"]').click(function(){
                let oid=$(this).attr("id");
                let symbol = oid.split('_')[1];
                open_symbol = symbol;
                getLiveCurrentOrderList(symbol)
            });
        }
        function showStopTradingList(lists, symbols, leverages, limits) {
            let tags = '';
            $('#trading_stop_list').html('');
            for (let i = 0; i < lists.length; i++) {
                let stop_data = lists[i].reverse();
                let symbol = symbols[i];
                let leverage = leverages[i];
                let limit = limits[i];

                let t_profit = 0;
                let e_profit = 0;
                let amount = (limit / leverage) * 10;
                let rate = 0;
                //let total_expect_profit = 0;
                for (let p = 0; p < stop_data.length; p++) {
                    let s_data = stop_data[p];
                    if (parseFloat(s_data.make_price) === 0) {
                        e_profit += 0;
                        t_profit += 0;
                    } else {
                        if (s_data.profit_money !== 'OK')
                            t_profit += parseFloat(s_data.profit_money);
                        if (s_data.side === 'buy') {
                            e_profit += parseFloat(s_data.order_money) - (parseFloat(s_data.order_money) * parseFloat(s_data.order_price) / parseFloat(s_data.make_price));
                        } else {
                            e_profit += (parseFloat(s_data.order_money) * parseFloat(s_data.order_price) / parseFloat(s_data.make_price)) - parseFloat(s_data.order_money);
                        }
                    }
                    let margin =  Math.round(s_data.order_money * 1000) / 1000;
                }
                //let profit = Math.round(e_profit * 1000) / 1000;
                let profit = Math.round(t_profit * 1000) / 1000
                let total_profit = '$' + profit;
                let total_profit_color = '#ff0000';
                if (profit < 0) {
                    total_profit = '-$' + Math.abs(profit);
                    total_profit_color = '#0070c0';
                }
                rate = (profit / amount) * 100;
                tags += '<div class="card shadow mt-3 mb-3 d-flex" id="trading_orders">';
                tags += '<div class="trade-card-header">';
                tags += '    <div class="d-flex mb-2">';
                tags += '        <span class="trade-color-stop">STOP</span>';
                tags += '        <span class="trade-header-title">'+symbol+'</span>';
                tags += '        <span class="trade-header-leverage">x'+leverage+'</span>';
                tags += '        <span class="trade-header-profit" style="color: '+total_profit_color+'">'+total_profit+'</span>';
                tags += '     </div>';
                tags += '    <div class="d-flex">';
                //tags += '        <div class="d-flex mt-2" style="width: 60%;">';
                //tags += '            <span class="btn btn-user my-middle-btn btn-block" id="btn-live-status_'+symbol+'">{{ __('userpage.order_status') }}</span>';
                //tags += '        </div>';
                tags += '        <div style="text-align: right; width: 100%;">';
                tags += '            <div style="font-size:0.7rem">{{ __('userpage.day_revenue_rate') }}</div>';
                tags += '            <div class="trade-header-profit" style="color: '+total_profit_color+'">'+Math.round(rate * 10000) / 10000+'%</div>';
                tags += '        </div>';
                tags += '    </div>';
                tags += '</div>';
                tags += '<div class="trade-card-body">';
                tags += '   <table class="table user-page-table" id="trading_table">';
                tags += '       <tbody>';
                for (let k = 0; k < stop_data.length; k++) {
                    //let index = k + 1;
                    let list = stop_data[k];
                    let side1 = '{{ __('userpage.side1') }}';
                    let side2 = '{{ __('userpage.side2') }}';
                    let side1_color = '#ff0000'
                    let side2_color = '#0070c0'
                    if (list.side === 'sell') {
                        side1 = '{{ __('userpage.side2') }}';
                        side2 = '{{ __('userpage.side1') }}';
                        side1_color = '#0070c0'
                        side2_color = '#ff0000'
                    }
                    let price1 = Math.round(list.order_price * 100000) / 100000;
                    let price2 = Math.round(list.make_price * 100000) / 100000;


                    let margin1 =  Math.round(list.order_money * 100000) / 100000;
                    //let margin2 =  Math.round(list.make_money * 1000) / 1000;
                    if (k % 2 === 1) {
                        tags += '   <tr style="background-color: #fdfdfd;">';
                    } else {
                        tags += '   <tr style="background-color: #f5f5f5;">';
                    }
                    let profit = list.profit_money;
                    let profit_color = '#858796';
                    if (list.profit_money !== 'OK') {
                        let profit_money = Math.round(list.profit_money * 10000) / 10000;
                        profit = '$' + profit_money;
                        if (profit_money < 0) {
                            profit = '-$' + Math.abs(profit_money);
                            profit_color = '#0070c0';
                        } else {
                            profit_color = '#ff0000';
                        }
                    }

                    let e_money = 0;
                    if (list.side === 'buy') {
                        e_money = parseFloat(list.order_money) - (parseFloat(list.order_money) * parseFloat(list.order_price) / parseFloat(list.make_price));
                    } else {
                        e_money = (parseFloat(list.order_money) * parseFloat(list.order_price) / parseFloat(list.make_price)) - parseFloat(list.order_money);
                    }
                    e_money = Math.round(e_money * 10000) / 10000;
                    let e_profit_color = '#ff0000';
                    let e_profit = '$' + e_money;
                    if (e_money < 0) {
                        e_profit = '-$' + Math.abs(e_money);
                        e_profit_color = '#0070c0';
                    }

                    //tags += '           <td class="text-nowrap align-middle" style="width: 10%">' + index + '</td>';
                    tags += '           <td class="text-nowrap align-middle" style="width: 15%">';
                    tags += '               <div style="color: '+side1_color+'">' + side1 + '</div>';
                    tags += '               <div style="color: '+side2_color+'">' + side2 + '</div>';
                    tags += '           </td>';
                    tags += '           <td class="text-nowrap align-middle" style="width: 35%">';
                    tags += '               <div>$' + price1 + '</div>';
                    tags += '               <div>$' + price2 + '</div>';
                    tags += '           </td>';
                    tags += '           <td class="text-nowrap align-middle" style="width: 35%">';
                    tags += '               <div>$' + margin1 + '</div>';
                    tags += '               <div>';
                    tags += '               <span style="color: '+profit_color+'">' + profit + '</span>';
                    if (list.profit_money === "OK") {
                        tags += '               <span> / </span>';
                        tags += '               <span style="color: '+e_profit_color+'">' + e_profit + '</span>';
                    } else if (parseFloat(list.profit_money) !== 0){
                        tags += '               <span> / </span>';
                        tags += '               <span style="color: '+e_profit_color+'">' + e_profit + '</span>';
                    }
                    tags += '               </div>';
                    tags += '           </td>';
                    tags += '       </tr>';
                }

                tags += '       </tbody>';
                tags += '    </table>';
                tags += '</div>';
                tags += '</div>';
            }
            $('#trading_stop_list').html(tags);
        }

        function sortArrayAsc(arr, val) {
            return arr.sort((a, b) => {
                let distA = Math.abs(a[1] - val);
                let distB = Math.abs(b[1] - val);
                return distA - distB;
            });
        }
        function sortArrayDesc(arr, val) {
            return arr.sort((a, b) => {
                let distA = Math.abs(a[1] - val);
                let distB = Math.abs(b[1] - val);
                return distB - distA;
            });
        }

        function getLiveCurrentOrderList(symbol) {
            $.ajax({
                url: '/user.currentOrderList',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    search_date: filter_date,
                    market: market,
                    symbol: symbol
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        let lists = data.lists;
                        let live_data = lists.reverse();
                        let current_price = data.c_price;

                        $('#currentOrderModalLabel').text(symbol);
                        $('#current_order_sell').html('');
                        $('#current_order_buy').html('');


                        let top_lists = [];
                        let bottom_lists = [];
                        let color_sell = '#0070c0';
                        let color_buy = '#ff0000';
                        for (let i = 0; i < live_data.length; i++) {
                            let list = live_data[i];
                            let items = [];
                            let margin = Math.round(list.order_money * 1000000) / 1000000;

                            if (list.side === 'sell') {
                                if (parseInt(list.order_position) === 1) {
                                    /*items = [];
                                    items.push('SL');
                                    items.push(Math.round(list.sl_price * 10000) / 10000);
                                    items.push(margin);
                                    items.push(color_buy);
                                    if (parseFloat(current_price) > parseFloat(list.sl_price)) {
                                        bottom_lists.push(items);
                                    } else {
                                        top_lists.push(items);
                                    }*/

                                    items = [];
                                    items.push('TP');
                                    items.push(Math.round(list.tp_price * 1000000) / 1000000);
                                    items.push(margin);
                                    items.push(color_buy);
                                    if (parseFloat(current_price) > parseFloat(list.tp_price)) {
                                        bottom_lists.push(items);
                                    } else {
                                        top_lists.push(items);
                                    }
                                } else {
                                    items = [];
                                    items.push('{{ __('userpage.side2') }}');
                                    items.push(Math.round(list.order_price * 1000000) / 1000000);
                                    items.push(margin);
                                    items.push(color_sell);
                                    if (parseFloat(current_price) > parseFloat(list.order_price)) {
                                        bottom_lists.push(items);
                                    } else {
                                        top_lists.push(items);
                                    }
                                }
                            } else {
                                if (parseInt(list.order_position) === 1) {
                                    items = [];
                                    items.push('TP');
                                    items.push(Math.round(list.tp_price * 1000000) / 1000000);
                                    items.push(margin);
                                    items.push(color_sell);
                                    if (parseFloat(current_price) > parseFloat(list.tp_price)) {
                                        bottom_lists.push(items);
                                    } else {
                                        top_lists.push(items);
                                    }

                                    /*items = [];
                                    items.push('SL');
                                    items.push(Math.round(list.sl_price * 10000) / 10000);
                                    items.push(margin);
                                    items.push(color_sell);
                                    if (parseFloat(current_price) > parseFloat(list.sl_price)) {
                                        bottom_lists.push(items);
                                    } else {
                                        top_lists.push(items);
                                    }*/
                                } else {
                                    items = [];
                                    items.push('{{ __('userpage.side1') }}');
                                    items.push(Math.round(list.order_price * 1000000) / 1000000);
                                    items.push(margin);
                                    items.push(color_buy);
                                    if (parseFloat(current_price) > parseFloat(list.order_price)) {
                                        bottom_lists.push(items);
                                    } else {
                                        top_lists.push(items);
                                    }
                                }
                            }
                        }
                        let sells = sortArrayDesc(top_lists, current_price);
                        let buys = sortArrayAsc(bottom_lists, current_price);
                        for (let j = 0; j < 5 - sells.length; j++) {
                            let tags_empty = '';
                            tags_empty += '<tr style="background-color: #fdfdfd; height: 1.7rem">';
                            tags_empty += '    <td class="text-nowrap align-middle" style="width: 15%"></td>';
                            tags_empty += '    <td class="text-nowrap align-middle" style="width: 35%"></td>';
                            tags_empty += '    <td class="text-nowrap align-middle" style="width: 35%"></td>';
                            tags_empty += '</tr>';
                            $('#current_order_sell').append(tags_empty);
                        }
                        for (let i = 0; i < sells.length; i++) {
                            let tags_sell = '';
                            let sell_data = sells[i];
                            if (i % 2 === 1) {
                                tags_sell += '<tr style="background-color: #fdfdfd;">';
                            } else {
                                tags_sell += '<tr style="background-color: #f5f5f5;">';
                            }
                            tags_sell += '       <td class="text-nowrap align-middle" style="width: 15%">';
                            tags_sell += '            <div style="color: ' + sell_data[3] + '">' + sell_data[0] + '</div>';
                            tags_sell += '        </td>';
                            tags_sell += '       <td class="text-nowrap align-middle" style="width: 35%">';
                            tags_sell += '           <div>$' + sell_data[1] + '</div>';
                            tags_sell += '       </td>';
                            tags_sell += '       <td class="text-nowrap align-middle" style="width: 35%">';
                            tags_sell += '           <div>$' + sell_data[2] + '</div>';
                            tags_sell += '       </td>';
                            tags_sell += '    </tr>';
                            $('#current_order_sell').append(tags_sell);
                        }

                        for (let i = 0; i < buys.length; i++) {
                            let tags_buy = '';
                            let buy_data = buys[i];
                            if (i % 2 === 1) {
                                tags_buy += '<tr style="background-color: #fdfdfd;">';
                            } else {
                                tags_buy += '<tr style="background-color: #f5f5f5;">';
                            }
                            tags_buy += '       <td class="text-nowrap align-middle" style="width: 15%">';
                            tags_buy += '           <div style="color: ' + buy_data[3] + '">' + buy_data[0] + '</div>';
                            tags_buy += '       </td>';
                            tags_buy += '       <td class="text-nowrap align-middle" style="width: 35%">';
                            tags_buy += '           <div>$' + buy_data[1] + '</div>';
                            tags_buy += '       </td>';
                            tags_buy += '       <td class="text-nowrap align-middle" style="width: 35%">';
                            tags_buy += '           <div>$' + buy_data[2] + '</div>';
                            tags_buy += '       </td>';
                            tags_buy += '   </tr>';
                            $('#current_order_buy').append(tags_buy);
                        }
                        $('#show_current_price').text(current_price);
                        if (open_modal === 0) {
                            open_modal = 1;
                            $('#currentOrderModal').modal('show');
                        }
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    // 에러가 발생한 경우 실행할 코드
                    console.log('AJAX call failed');
                    console.log('Status:', errdata);
                    console.log('Error thrown:', errorThrown);

                    // jqXHR 객체에서 추가 정보 확인
                    console.log('Response text:', jqXHR.responseText);
                    console.log('Status code:', jqXHR.status);
                    console.log('Status text:', jqXHR.statusText);
                }
            });
        }
        function real_data(){
            setTimeout(function(){
                let curr = new Date();
                const utc = curr.getTime() + (curr.getTimezoneOffset() * 60 * 1000);
                const TIME_DIFF = 8 * 60 * 60 * 1000; // Beijing Timezone
                let today = new Date(utc + (TIME_DIFF));
                if (show_mark === 1) {
                    setDatepicker(getCurrentDate(today, 0));
                    getLiveTradingList();
                    if (open_modal === 1) {
                        getLiveCurrentOrderList(open_symbol);
                    }
                    real_data();
                }
            }, 1000 * 60)
        }
    </script>
@endsection
