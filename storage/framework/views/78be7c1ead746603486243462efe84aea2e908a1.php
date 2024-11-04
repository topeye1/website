<div id="setting_trade">
    <div class="row justify-content-center">
        <img class="tab_logo" id="trade_logo_bin" src="<?php echo e(URL::asset('assets/img/pngs/binance-2.png')); ?>" style="display:none;">
        <img class="tab_logo" id="trade_logo_htx" src="<?php echo e(URL::asset('assets/img/pngs/htx-2.png')); ?>" style="display:none;">
    </div>
    <div class="row justify-content-center align-items-center mt-3 mb-3" style="width: auto; margin: 0 auto;">
        <div class="col-12 d-flex justify-content-center">
            <div class="text-title-font mr-3"><?php echo e(__('userpage.cash')); ?></div>
            <div class="text-bold-font">$</div>
            <div class="text-bold-font" id="user-hold-money"></div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center mt-1 mb-3" style="width: auto; margin: 0 auto;">
        <div class="col-4 d-flex justify-content-end"><?php echo e(__('userpage.max_trade_price')); ?></div>
        <div class="col-6 select-direction">
            <div class="direction-key" id="left-max-money"><i class="fa fa-caret-left" aria-hidden="true"></i></div>
            <div class="direction-val">
                <span class="mr-1">$</span>
                <span id="max_trade_money"></span>
            </div>
            <div class="direction-key" id="right-max-money"><i class="fa fa-caret-right" aria-hidden="true"></i></div>
        </div>
        <div class="col-md-2 d-flex" id="div_max_money_help" style="align-items: center;">
            <img id="max_money_help" src="/assets/img/pngs/help.png" style="width: 20px; height: 20px; cursor: pointer;">
        </div>
        <div>
            <?php echo $__env->make('tooltip.max_trade_price', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <div class="row justify-content-center align-items-center mt-1 mb-3" style="width: auto; margin: 0 auto;">
        <div class="col-4 d-flex justify-content-end"><?php echo e(__('userpage.trade_leverage')); ?></div>
        <div class="col-6 select-direction">
            <div class="direction-key" id="left-leverage"><i class="fa fa-caret-left" aria-hidden="true"></i></div>
            <div class="direction-val">
                <span class="mr-1">x</span>
                <span id="leverage_val"></span>
            </div>
            <div class="direction-key" id="right-leverage"><i class="fa fa-caret-right" aria-hidden="true"></i></div>
        </div>
        <div class="col-md-2 d-flex" style="align-items: center;">
            <img id="leverage_help" src="/assets/img/pngs/help.png" style="width: 20px; height: 20px; cursor: pointer;">
        </div>
        <div>
            <?php echo $__env->make('tooltip.trade_leverage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <div class="row justify-content-center align-items-center mt-1 mb-3" style="width: auto; margin: 0 auto;">
        <div class="col-4 d-flex justify-content-end"><?php echo e(__('userpage.profit_per_trade')); ?></div>
        <div class="col-6 select-direction">
            <div class="direction-key" id="left-profit_per_trade"><i class="fa fa-caret-left" aria-hidden="true"></i></div>
            <div class="direction-val">
                <span id="profit_per_trade_val"></span>
                <span class="ml-1">%</span>
            </div>
            <div class="direction-key" id="right-profit_per_trade"><i class="fa fa-caret-right" aria-hidden="true"></i></div>
        </div>
        <div class="col-md-2 d-flex" style="align-items: center;">
            <img id="profit_per_trade_help" src="/assets/img/pngs/help.png" style="width: 20px; height: 20px; cursor: pointer;">
        </div>
        <div>
            <?php echo $__env->make('tooltip.profit_per_trade', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="row justify-content-center align-items-center mt-5">
        <div id="btn_trade_setting_confirm" class="btn btn-confirm" ><?php echo e(__('userpage.confirm')); ?></div>
    </div>
    <div class="row justify-content-center align-items-center mt-5"><?php echo e(__('userpage.trade_description3')); ?></div>
    <div class="row justify-content-center align-items-center mt-3"><?php echo e(__('userpage.trade_description4')); ?></div>
    <div class="row justify-content-center align-items-center mt-3"><?php echo e(__('userpage.trade_description5')); ?></div>
    <div class="row justify-content-center align-items-center"><?php echo e(__('userpage.trade_description6')); ?></div>
    <div class="row justify-content-center align-items-center"><?php echo e(__('userpage.trade_description7')); ?></div>
    <div class="row justify-content-center align-items-center mt-3">
        <img src="<?php echo e(URL::asset('assets/img/pngs/ex_trade.png')); ?>" style="display:block;">
    </div>
</div>

<?php echo $__env->make('modals.setting-trade-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('modals.setting-process-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    let t_datas = []; //1회 최대 거래금액 배열
    let l_datas = []; //거래 레버리지 배열
    let pr_datas = []; //거래 당 수익범위 배열
    let lr_datas = []; //거래 당 청산범위 배열
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

                    let trade_money = fildSelectedValue(t_datas, t_idx);
                    $('#max_trade_money').text(trade_money);
                    let leverage = fildSelectedValue(l_datas, l_idx);
                    $('#leverage_val').text(leverage);
                    let profit_range = fildSelectedValue(pr_datas, pr_idx);
                    $('#profit_per_trade_val').text(profit_range);
/*
                    let liquidation_range = fildSelectedValue(lr_datas, lr_idx);
                    $('#liquidation_per_trade_val').text(liquidation_range);
*/
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
        /*$('#left-liquidation_per_trade').click( function () {
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
        });*/

        $('.trade_price_tooltip').css('margin-left', '-50px');
        $('.trade_price_tooltip').css('margin-top', '-50px');
        $('.trade_price_tooltip').css('display', 'none');
        $('#max_money_help').mouseover( function () {
            $('.trade_price_tooltip').css('display', 'block');
        });
        $('#max_money_help').mouseout( function () {
            $('.trade_price_tooltip').css('display', 'none');
        });

        $('.trade_leverage_tooltip').css('margin-left', '-50px');
        $('.trade_leverage_tooltip').css('margin-top', '-50px');
        $('.trade_leverage_tooltip').css('display', 'none');
        $('#leverage_help').mouseover( function () {
            $('.trade_leverage_tooltip').css('display', 'block');
        });
        $('#leverage_help').mouseout( function () {
            $('.trade_leverage_tooltip').css('display', 'none');
        });

        $('.profit_per_trade_tooltip').css('margin-left', '-50px');
        $('.profit_per_trade_tooltip').css('margin-top', '-40px');
        $('.profit_per_trade_tooltip').css('display', 'none');
        $('#profit_per_trade_help').mouseover( function () {
            $('.profit_per_trade_tooltip').css('display', 'block');
        });
        $('#profit_per_trade_help').mouseout( function () {
            $('.profit_per_trade_tooltip').css('display', 'none');
        });

/*
        $('.liquidation_per_trade_tooltip').css('margin-left', '-50px');
        $('.liquidation_per_trade_tooltip').css('margin-top', '-40px');
        $('.liquidation_per_trade_tooltip').css('display', 'none');
        $('#liquidation_per_trade_help').mouseover( function () {
            $('.liquidation_per_trade_tooltip').css('display', 'block');
        });
        $('#liquidation_per_trade_help').mouseout( function () {
            $('.liquidation_per_trade_tooltip').css('display', 'none');
        });
*/

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
                lr_id: lr_idx
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
<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/user/user-setting-trade-view.blade.php ENDPATH**/ ?>