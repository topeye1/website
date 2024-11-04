<div class="row justify-content-center pay-body-content" style="margin: 0 auto; width: 70%;">
    <div class="tab-content d-flex pt-4 pb-4 justify-content-center" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-usdt" role="tabpanel">
            <div class="mb-3" style="width: 100%; margin: 0 auto;">
                <div class="row mb-2">
                    <div class="col-6" style="text-align: end;">{{ __('userpage.available_cash') }}</div>
                    <div class="col-6 text-value-font">
                        <span>$</span>
                        <span id="coin_available_cash"></span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6" style="text-align: end;">{{ __('userpage.leverage') }}</div>
                    <div class="col-6 text-value-font">
                        <span id="coin_leverage"></span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6" style="text-align: end;">{{ __('userpage.leverage_cash') }}</div>
                    <div class="col-6 text-value-font">
                        <span>$</span>
                        <span id="coin_leverage_cash"></span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6" style="text-align: end;">{{ __('userpage.max_trade_price') }}</div>
                    <div class="col-6 text-value-font">
                        <span>$</span>
                        <span id="coin_max_trade_price"></span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6" style="text-align: end;">{{ __('userpage.req_coin_cash') }}</div>
                    <div class="col-6 text-value-font">
                        <span>$</span>
                        <span id="req_coin_cash"></span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6" style="text-align: end;">{{ __('userpage.operable_coins') }}</div>
                    <div class="col-6 text-value-font">
                        <span id="coin_operable_coins" style="color: #F14382;">0</span>
                        <span>/</span>
                        <span id="coin_total_coins"></span>
                    </div>
                </div>
            </div>
            <div class="mb-1">
                <div class="row">
                    <div class="col-12 mb-1 d-flex justify-content-center">{{ __('userpage.minimum_cash_desc1') }}</div>
                </div>
                <div class="row">
                    <div class="col-12 mb-1 d-flex justify-content-center">{{ __('userpage.minimum_cash_desc2') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin: 0 auto; width: 70%;">
    <div class="row mt-2" id="coin-run-layout" style="display: flex;">

    </div>
</div>

<script>
    let size_multiple = 5;

    function getRunCoinList() {
        $.ajax({
            url: '/user.runningCoins',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            type: 'POST',
            success: function (data) {
                $('#coin-run-layout').html('');
                let tag = '';
                if (data.msg === "ok") {
                    trade_money = data.max_amount;
                    leverage = data.leverage;
                    profit_range = data.profit_range;
                    liquidation_range = data.liquidation_range;
                    $('#coin_max_trade_price').text(trade_money);
                    let amount = parseFloat(data.amount.toFixed(2))
                    let leverage_amount = amount * parseInt(leverage)
                    //let operable_coins = parseInt(leverage_amount / (trade_money * 10))
                    //if (operable_coins > 50)
                    //    operable_coins = 50
                    $('#coin_available_cash').text(amount);
                    $('#coin_leverage').text(leverage);
                    $('#coin_leverage_cash').text(leverage_amount.toFixed(2))
                    $('#req_coin_cash').text(trade_money * size_multiple);

                    let lists = data.coin_lists;
                    let total_coins = 0;
                    let live_total_coins = leverage_amount / (trade_money * size_multiple);
                    live_total_coins = Math.floor(live_total_coins);
                    let running_coins = 0;
                    for (let i = 0; i < lists.length; i++) {
                        let list = lists[i];
                        let coin_id = list.coin_id;
                        let coin_name = list.coin_name;
                        let display1 = 'none !important';
                        let display2 = 'none !important';
                        let live_color = '';
                        if (parseInt(list.status) !== 1) {
                            live_color = 'style="background-color: #DCE0ED;"';
                        } else {
                            total_coins += 1
                        }
                        if (parseInt(list.bRun) === 1) {
                            display1 = 'flex';
                            running_coins += 1
                        } else {
                            display2 = 'flex';
                        }

                        tag += '<div class="col-6 mb-3">';
                        tag += '<div class="row align-items-center">';
                        tag += '<div class="col-4">'+coin_name+'</div>';
                        tag += '<div class="col-3"><span class="color-live" '+live_color+'>LIVE</span></div>';
                        tag += '<div class="col-5">';
                        tag += '<div id="btn-coin-stop_'+coin_id+'_'+coin_name+'_1" class="btn btn-user my-middle-btn btn-block btn_stop" style="display: '+display1+';">';
                        tag += '{{ __('userpage.stop') }}';
                        tag += '</div>';
                        if (parseInt(list.status) === 1) {
                            tag += '<div id="btn-coin-start_'+coin_id+'_'+coin_name+'_1" class="btn btn-confirm d-flex justify-content-center align-items-center btn_start" style="display: ' + display2 + '; ">';
                        } else {
                            tag += '<div id="btn-coin-start_'+ coin_id+'_'+coin_name+'_0" class="btn-disable d-flex justify-content-center align-items-center btn_start" style="display: '+display2+'; ">';
                        }
                        tag += '{{ __('userpage.start') }}';
                        tag += '</div>';
                        tag += '</div>';
                        tag += '</div>';
                        tag += '</div>';
                    }
                    if (live_total_coins > total_coins)
                        live_total_coins = total_coins;
                    $('#coin-run-layout').html(tag);
                    let operable_coins = live_total_coins - running_coins
                    $('#coin_operable_coins').text(operable_coins);
                    $('#coin_total_coins').text(live_total_coins);
                }

                $('div[id^="btn-coin-stop_"]').click(function(){
                    let oid=$(this).attr("id");
                    let coin_num = oid.split('_')[1];
                    let symbol = oid.split('_')[2];
                    let status = oid.split('_')[3];
                    if (parseInt(status) === 1)
                        setCoinRunStatus(coin_num, symbol, 0);
                });
                $('div[id^="btn-coin-start_"]').click(function(){
                    let total_coins = parseInt($('#coin_total_coins').text());
                    let live_coins = total_coins - parseInt($('#coin_operable_coins').text());
                    let limit_bet = parseInt($('#coin_max_trade_price').text());
                    let leverage = parseFloat($('#coin_leverage_cash').text());
                    let runable_coins = leverage / (limit_bet * size_multiple);
                    if (runable_coins < live_coins + 1) {
                        alert("{{ __('userpage.error_cash1') }}\n{{ __('userpage.error_cash2') }}");
                    } else {
                        let oid=$(this).attr("id");
                        let coin_num = oid.split('_')[1];
                        let symbol = oid.split('_')[2];
                        let status = oid.split('_')[3];
                        if (parseInt(status) === 1)
                            setCoinRunStatus(coin_num, symbol, 1);
                    }
                });
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }

    function setCoinRunStatus(coin_num, symbol, isRun) {
        $.ajax({
            url: '/user.setRunning',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                coin_num: coin_num,
                symbol: symbol,
                is_run: isRun,
                trade_money: trade_money,
                leverage: leverage,
                profit_range: profit_range,
                liquidation_range: liquidation_range,
                market: market,
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    getRunCoinList();
                } else if (data.msg === "exceed") {
                    alert("{{ __('userpage.api_description1') }} \n {{ __('userpage.api_description2') }}");
                } else if (data.msg === "err") {
                    alert("{{ __('userpage.api_description1') }} \n {{ __('userpage.api_description2') }}");
                } else if (data.msg === "cnt") {
                    let limit = data.limit;
                    alert("{{ __('userpage.live_coin_condition1') }}"+limit+"{{ __('userpage.live_coin_condition2') }}");
                } else if (data.msg === "nocoin") {
                    alert("The coin does not exist.");
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }
</script>
