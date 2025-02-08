<div id="setting_trade">
    <div class="row justify-content-center">
        <img class="tab_logo" id="trade_logo_bin" src="{{URL::asset('assets/img/pngs/binance-2.png')}}" style="display:none;">
        <img class="tab_logo" id="trade_logo_htx" src="{{URL::asset('assets/img/pngs/htx-2.png')}}" style="display:none;">
    </div>
    <div class="row justify-content-center align-items-center mt-3 mb-3" style="width: auto; margin: 0 auto;">
        <div class="col-12 d-flex justify-content-center">
            <div class="text-title-font mr-3">{{ __('userpage.cash') }}</div>
            <div class="text-bold-font">$</div>
            <div class="text-bold-font" id="user-hold-money"></div>
        </div>
    </div>
    <div class="row align-items-center mt-1 mb-3" style="width: auto; margin: 0 auto;">
        <div>{{ __('userpage.max_trade_price') }}</div>
        <div class="col-10 select-direction">
            <div class="direction-key" id="left-max-money"><i class="fa fa-caret-left" aria-hidden="true"></i></div>
            <div class="direction-val">
                <span class="mr-1">$</span>
                <span id="max_trade_money"></span>
            </div>
            <div class="direction-key" id="right-max-money"><i class="fa fa-caret-right" aria-hidden="true"></i></div>
        </div>
        <div class="col-2 d-flex justify-content-end align-items-center" id="div_max_money_help">
            <img id="max_money_help" src="/assets/img/pngs/help.png" style="width: 20px; height: 20px; cursor: pointer;">
        </div>
        <div>
            @include('tooltip.mobile_max_trade_price')
        </div>
    </div>
    <div class="row align-items-center mt-1 mb-3" style="width: auto; margin: 0 auto;">
        <div>{{ __('userpage.trade_leverage') }}</div>
        <div class="col-10 select-direction">
            <div class="direction-key" id="left-leverage"><i class="fa fa-caret-left" aria-hidden="true"></i></div>
            <div class="direction-val">
                <span class="mr-1">x</span>
                <span id="leverage_val"></span>
            </div>
            <div class="direction-key" id="right-leverage"><i class="fa fa-caret-right" aria-hidden="true"></i></div>
        </div>
        <div class="col-2 d-flex justify-content-end align-items-center">
            <img id="leverage_help" src="/assets/img/pngs/help.png" style="width: 20px; height: 20px; cursor: pointer;">
        </div>
        <div>
            @include('tooltip.mobile_trade_leverage')
        </div>
    </div>
    <div class="row align-items-center mt-1 mb-3" style="width: auto; margin: 0 auto;">
        <div>{{ __('userpage.liquidation_per_trade') }}</div>
        <div class="col-10 select-direction">
            <div class="direction-key" id="left-liquidation_per_trade"><i class="fa fa-caret-left" aria-hidden="true"></i></div>
            <div class="direction-val">
                <span id="liquidation_per_trade_val"></span>
                <span class="ml-1">%</span>
            </div>
            <div class="direction-key" id="right-liquidation_per_trade"><i class="fa fa-caret-right" aria-hidden="true"></i></div>
        </div>
        <div class="col-2 d-flex justify-content-end align-items-center">
            <img id="liquidation_per_help" src="/assets/img/pngs/help.png" style="width: 20px; height: 20px; cursor: pointer;">
        </div>
        <div>
            @include('tooltip.mobile_liquidation_per_trade')
        </div>
    </div>
    <div class="row align-items-center mt-1 mb-3" style="width: auto; margin: 0 auto;">
        <div>{{ __('userpage.profit_per_trade') }}</div>
        <div class="col-10 select-direction">
            <div class="direction-key" id="left-profit_per_trade"><i class="fa fa-caret-left" aria-hidden="true"></i></div>
            <div class="direction-val">
                <span id="profit_per_trade_val"></span>
                <span class="ml-1">%</span>
            </div>
            <div class="direction-key" id="right-profit_per_trade"><i class="fa fa-caret-right" aria-hidden="true"></i></div>
        </div>
        <div class="col-2 d-flex justify-content-end align-items-center">
            <img id="profit_per_help" src="/assets/img/pngs/help.png" style="width: 20px; height: 20px; cursor: pointer;">
        </div>
        <div>
            @include('tooltip.mobile_profit_per_trade')
        </div>
    </div>
    <div class="row align-items-center mt-1 mb-3" style="width: auto; margin: 0 auto;">
        <div>{{ __('userpage.auto_check_time') }}</div>
        <div class="col-10 select-direction">
            <div class="direction-key" id="left-check_time"><i class="fa fa-caret-left" aria-hidden="true"></i></div>
            <div class="direction-val">
                <span id="check_time_val"></span>
                <span class="ml-1">{{ __('userpage.time') }}</span>
            </div>
            <div class="direction-key" id="right-check_time"><i class="fa fa-caret-right" aria-hidden="true"></i></div>
        </div>
        <div class="col-md-2 d-flex" style="align-items: center;">
        </div>
    </div>

    <div class="row justify-content-center align-items-center mt-5">
        <div id="btn_trade_setting_confirm" class="btn btn-confirm" >{{ __('userpage.confirm') }}</div>
    </div>
    <div class="row justify-content-center align-items-center mt-5">{{ __('userpage.trade_description3') }}</div>
    <div class="row justify-content-center align-items-center mt-3">{{ __('userpage.trade_description4') }}</div>
    <div class="row justify-content-center align-items-center mt-3">{{ __('userpage.trade_description5') }}</div>
    <div class="row justify-content-center align-items-center">{{ __('userpage.trade_description6') }}</div>
    <div class="row justify-content-center align-items-center">{{ __('userpage.trade_description7') }}</div>
    <div class="row justify-content-center align-items-center mt-3">
        <img src="{{URL::asset('assets/img/pngs/ex_trade.png')}}" style="display:block;">
    </div>
</div>

@include('modals.setting-trade-modal')
@include('modals.setting-process-modal')
<script>
    let t_datas = []; //1회 최대 거래금액 배열
    let l_datas = []; //거래 레버리지 배열
    let pr_datas = []; //거래 당 수익범위 배열
    let lr_datas = []; //거래 당 청산범위 배열
    let check_time = 1; //자동확인 시간
    function getTradeValues() {
        if (market === 'bin') {
            $('#trade_logo_bin').css('display', 'block');
            $('#trade_logo_htx').css('display', 'none');
        } else {
            $('#trade_logo_bin').css('display', 'none');
            $('#trade_logo_htx').css('display', 'block');
        }

        $.ajax({
            url: '/user.tradeSetting',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                market: market,
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    t_datas = data.t_datas;
                    l_datas = data.l_datas;
                    pr_datas = data.pr_datas;
                    lr_datas = data.lr_datas;
                    t_idx = data.u_datas.tid;
                    l_idx = data.u_datas.lid;
                    pr_idx = data.u_datas.prid;
                    lr_idx = data.u_datas.lrid;
                    check_time = data.u_datas.ctime;

                    let trade_money = fildSelectedValue(t_datas, t_idx);
                    $('#max_trade_money').text(trade_money);
                    let leverage = fildSelectedValue(l_datas, l_idx);
                    $('#leverage_val').text(leverage);
                    let profit_range = fildSelectedValue(pr_datas, pr_idx);
                    $('#profit_per_trade_val').text(profit_range);
                    let liquidation_range = fildSelectedValue(lr_datas, lr_idx);
                    $('#liquidation_per_trade_val').text(liquidation_range);
                    $('#check_time_val').text(check_time);
                    let amount = parseFloat(data.amount.toFixed(2))
                    $('#user-hold-money').text(amount);
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });


    }
    function setInitTrade() {
        $('#left-max-money').click( function () {
            let sel_id = t_idx - 1;
            if (sel_id > 0) {
                $('#max_trade_money').text(fildSelectedValue(t_datas, sel_id));
                t_idx = sel_id;
            }
        });
        $('#right-max-money').click( function () {
            let sel_id = t_idx + 1;
            if (sel_id <= t_datas.length) {
                $('#max_trade_money').text(fildSelectedValue(t_datas, sel_id));
                t_idx = sel_id;
            }
        });
        $('#left-leverage').click( function () {
            let sel_id = l_idx - 1;
            if (sel_id > 0) {
                $('#leverage_val').text(fildSelectedValue(l_datas, sel_id));
                l_idx = sel_id;
            }
        });
        $('#right-leverage').click( function () {
            let sel_id = l_idx + 1;
            if (sel_id <= l_datas.length) {
                $('#leverage_val').text(fildSelectedValue(l_datas, sel_id));
                l_idx = sel_id;
            }
        });
        $('#left-profit_per_trade').click( function () {
            let sel_id = pr_idx - 1;
            if (sel_id > 0) {
                $('#profit_per_trade_val').text(fildSelectedValue(pr_datas, sel_id));
                pr_idx = sel_id;
            }
        });
        $('#right-profit_per_trade').click( function () {
            let sel_id = pr_idx + 1;
            if (sel_id <= pr_datas.length) {
                $('#profit_per_trade_val').text(fildSelectedValue(pr_datas, sel_id));
                pr_idx = sel_id;
            }
        });
        $('#left-liquidation_per_trade').click( function () {
            let sel_id = lr_idx - 1;
            if (sel_id > 0) {
                $('#liquidation_per_trade_val').text(fildSelectedValue(lr_datas, sel_id));
                lr_idx = sel_id;
            }
        });
        $('#right-liquidation_per_trade').click( function () {
            let sel_id = lr_idx + 1;
            if (sel_id <= lr_datas.length) {
                $('#liquidation_per_trade_val').text(fildSelectedValue(lr_datas, sel_id));
                lr_idx = sel_id;
            }
        });
        $('#left-check_time').click( function () {
            check_time = check_time - 1;
            if (check_time > 0) {
                $('#check_time_val').text(check_time);
            } else {
                check_time = 1;
                $('#check_time_val').text(check_time);
            }
        });
        $('#right-check_time').click( function () {
            check_time = check_time + 1;
            $('#check_time_val').text(check_time);
        });

        $('#max_money_help').click( function () {
            $('#max_trade_price_help').modal('show');
        });

        $('#leverage_help').click( function () {
            $('#trade_leverage_help').modal('show');
        });

        $('#profit_per_help').click( function () {
            $('#profit_per_trade_help').modal('show');
        });

        $('#liquidation_per_help').click( function () {
            $('#liquidation_per_trade_help').modal('show');
        });

        $('#btn_trade_setting_confirm').click( function () {
            $('#settingTradeModal').modal('show');
        });
        $('#btn_setting_trade_cancel').click( function () {
            $('#settingTradeModal').modal('hide');
        });
        $('#btn_setting_trade_confirm').click( function () {
            updateTradeSetting();
        });
    }

    function getLivedSymbols() {
        $.ajax({
            url: '/user.getLivedSymbol',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                market: market
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    $('#settingTradeModal').modal('hide');
                    //$('#settingProcessModal').modal('show');

                    live_symbols = data.lists;
                    live_idx = 0;
                    //process_timer();
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }

    let live_symbols;
    let live_idx = 0;
    function process_timer(){
        setTimeout(function(){
            if (live_idx < live_symbols.length) {
                let symbol_num = live_symbols[live_idx].coin_num;
                updateLiveSetting(symbol_num);
                process_timer();
                live_idx ++;
            } else {
                $('#settingProcessModal').modal('hide');
            }
        }, 2000)
    }
    function updateLiveSetting(symbol_num){
        $.ajax({
            url: '/user.updateLive',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                market: market,
                symbol_num: symbol_num
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }
    function updateTradeSetting(){
        $.ajax({
            url: '/user.updateSetting',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                market: market,
                t_id: t_idx,
                l_id: l_idx,
                pr_id: pr_idx,
                lr_id: lr_idx,
                ctime: check_time
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    getLivedSymbols();
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }

    function fildSelectedValue (datas, sel_num) {
        let val = 0;
        for (let i = 0; i < datas.length; i++) {
            let data = datas[i];
            if (parseInt(sel_num) === parseInt(data.fid)) {
                val = data.value;
                break;
            }
        }
        return val;
    }
</script>
