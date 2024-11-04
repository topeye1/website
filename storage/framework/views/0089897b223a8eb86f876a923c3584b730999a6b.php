<?php $__env->startSection('content'); ?>
    <div class="container container-lg" style="max-width: 100%">
        <!-- PC Header-->
        <div class="row mt-2 header-pc">
            <div class="col-1">
                <div class="d-flex justify-content-end">
                    <img src="<?php echo e(URL::asset('assets/img/brand/logo-4.png')); ?>" class="header-brand-img light-logo1"
                         alt="logo" style="width: auto;">
                </div>
            </div>
            <div class="col-2">
                <div class="d-flex flex-row mt-4">
                    <img class="market-logo-btn" id="logo_bin" src="/assets/img/pngs/binance-logo.png" style="display: none;">
                    <img class="market-logo-btn" id="logo_htx" src="/assets/img/pngs/htx-logo.png" style="display: block;">
                </div>
            </div>
        </div>

        <!-- Body-->
        <div class="row justify-content-center" style="min-height: 30rem; background-color: white">
            <div style="width: 60%">
                <div class="header mt-5">
                    <div class="d-flex align-items-center pl-3 pt-1 pb-1 pr-3 position-absolute" style="left:2rem; width: auto; height: 1.5rem; cursor: pointer;">
                        <a class="d-flex" href="<?php echo e(url('/user.user-coupon-view/user-page/coupon')); ?>">
                            <img src="<?php echo e(URL::asset('assets/img/pngs/back_left.png')); ?>">
                            <span class="d-flex ml-2"><?php echo e(__('userpage.coupon')); ?></span>
                        </a>
                    </div>
                    <h5 id="payment_label" style="text-align: center; color: #404450;"><?php echo e(__('userpage.coupon_purchase_payment')); ?></h5>
                    <div class="d-flex align-items-center pl-3 pt-1 pb-1 pr-3 position-absolute" style="right:2rem; width: auto; height: 1.5rem; border-radius: 1rem; background-color: #F0F1F4; margin-top: -2rem;">
                        <img src="<?php echo e(URL::asset('assets/img/pngs/coupon.png')); ?>" class="mr-1" style="width: 1.2rem; height: 1.2rem">
                        <span class="d-flex mr-3" style="font-size: 0.75rem"><?php echo e(__('userpage.coupon_balance')); ?></span>
                        <span class="d-flex" style="font-size: 0.75rem">$</span>
                        <span class="d-flex" style="font-size: 0.75rem" id="coupon_balance"></span>
                    </div>
                </div>
                <div class="">
                    <div class="d-flex justify-content-center align-items-center" id="sel_payment_card">

                    </div>
                    <div class="row mt-2 justify-content-center">
                        <div class="col-6">
                            <div class="nav nav-tabs nav-fill mt-3" id="nav-tab" role="tablist">
                                <a class="d-flex pay-item pay-link active" id="nav-usdt-tab" data-toggle="tab" href="#nav-usdt"><?php echo e(__('userpage.usdt_payment')); ?></a>
                                <a class="d-flex pay-item pay-link" id="nav-point-tab" data-toggle="tab" href="#nav-point"><?php echo e(__('userpage.point_payment')); ?></a>
                                <a class="d-flex pay-item pay-link" id="nav-binance-tab" data-toggle="tab" href="#nav-binance"><?php echo e(__('userpage.binance_pay')); ?></a>
                            </div>
                        </div>

                    </div>
                    <div class="row justify-content-center pay-body-content" style="margin: 0 auto; width: 70%;">
                        <div class="tab-content d-flex pt-5 pb-4 justify-content-center" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-usdt" role="tabpanel">
                                <div class="mb-5" style="width: 80%; margin: 0 auto;">
                                    <div class="row mb-3">
                                        <div class="col-4" style="text-align: end;"><?php echo e(__('userpage.deposit_usdt_address')); ?></div>
                                        <div class="col-8" id="input_usdt_address"></div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4" style="text-align: end;"><?php echo e(__('userpage.deposit_network')); ?></div>
                                        <div class="col-8" id="input_usdt_network">Tron(TRC20)</div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-4" style="text-align: end;"><?php echo e(__('userpage.TxID')); ?></div>
                                        <div class="col-8">
                                            <input type="text" class="form-control form-control-user my-input" id="input_txid">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12" style="font-size:0.85rem; text-align: center; color: #F14382"><?php echo e(__('userpage.usdt_warning')); ?></div>
                                    </div>
                                    <div class="row mb-3 justify-content-center">
                                        <div id="btn_payment_usdt" class="btn btn-black btn-user btn-block w-50"><?php echo e(__('userpage.dispot_comp')); ?></div>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <div class="row"><div class="col-12 mb-1"><?php echo e(__('userpage.usdt_desc1')); ?></div></div>
                                    <div class="row"><div class="col-12 mb-1"><?php echo e(__('userpage.usdt_desc2')); ?></div></div>
                                    <div class="row"><div class="col-12 mb-3"><?php echo e(__('userpage.usdt_desc3')); ?></div></div>
                                    <div class="row" style="text-align: center;">
                                        <div class="col-12 justify-content-center">
                                            <img src="<?php echo e(URL::asset('assets/img/pngs/binance_ex.png')); ?>" style="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="nav-point" role="tabpanel">
                                <div class="w-75" style="margin: 0 auto;">
                                    <div class="row mb-2" style="font-size: 1.1rem; margin: 0 auto;">
                                        <div class="col-5">
                                            <?php echo e(__('userpage.points_held')); ?>

                                        </div>
                                        <div class="col-5" id="points-held-val" style="font-weight: bold; text-align: end;"></div>
                                        <div class="col-2" style="font-weight: bold;">Point</div>
                                    </div>
                                    <div class="row mb-3 justify-content-center" style="font-size: 0.9rem;"><?php echo e(__('userpage.points_desc1')); ?></div>
                                    <div class="row mb-3 points-content" style="margin: 0 auto; width: 95%; font-size: 0.9rem">
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="col-6" style="text-align: end;"><?php echo e(__('userpage.points_1')); ?></div>
                                                <div class="col-4" id="available_point" style="text-align: end;"></div>
                                                <div class="col-2">Point</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6" style="text-align: end;"><?php echo e(__('userpage.points_2')); ?></div>
                                                <div class="col-4" id="remaining_point" style="text-align: end;"></div>
                                                <div class="col-2">Point</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div id="btn_payment_point" class="btn btn-black btn-user btn-block w-50"><?php echo e(__('userpage.payment')); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-binance" role="tabpanel">

                            </div>
                        </div>
                    </div>
                    <div class="row w-75 justify-content-center pay-footer-content" style="margin: 0 auto;">
                        <div class="tab-content d-flex p-3 w-100">
                            <div class="w-100 mb-5" id="pay-footer-usdt" style="display: block;">
                                <ul>
                                    <li><?php echo e(__('userpage.usdt_desc4')); ?></li>
                                </ul>
                            </div>
                            <div class="w-100 mb-5" id="pay-footer-point" style="display: none;">
                                <ul>
                                    <li><?php echo e(__('userpage.points_desc2')); ?></li>
                                    <li><?php echo e(__('userpage.points_desc3')); ?></li>
                                    <li><?php echo e(__('userpage.points_desc4')); ?></li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="pay-footer-binance" style="display: none;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        let my_max_amount = 0;
        let coupon_price = 0;
        $(document).ready(function () {
            $('#logo_bin').click(function () {
                setMarket("htx");
            });
            $('#logo_htx').click(function () {
                setMarket("bin");
            });

            $('#nav-usdt-tab').click(function () {
                $('#pay-footer-usdt').css('display', 'block');
                $('#pay-footer-point').css('display', 'none');
                $('#pay-footer-binance').css('display', 'none');
            });
            $('#nav-point-tab').click(function () {
                getUserPoints();
                $('#pay-footer-usdt').css('display', 'none');
                $('#pay-footer-point').css('display', 'block');
                $('#pay-footer-binance').css('display', 'none');
            });
            $('#nav-binance-tab').click(function () {
                $('#pay-footer-usdt').css('display', 'none');
                $('#pay-footer-point').css('display', 'none');
                $('#pay-footer-binance').css('display', 'block');
            });

            //usdt 결제완료 버튼
            $('#btn_payment_usdt').click(function () {

            });
            //포인트 결제 버튼
            $('#btn_payment_point').click(function () {
                let hold_point = parseInt($('#points-held-val').text());
                let coupon_point = parseInt($('#available_point').text());
                if (hold_point < coupon_point) {
                    alert('<?php echo e(__('userpage.not_point')); ?>');
                } else {

                }
            });
            getSelectedCouponInfo();
        });
        function getUserPoints() {
            $.ajax({
                url: '/user.holdPoint',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        let point = parseInt(data.point);
                        let remain_point = point - coupon_price;
                        $('#points-held-val').text(point);
                        $('#available_point').text(coupon_price);
                        $('#remaining_point').text(remain_point);
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }
        function getSelectedCouponInfo() {
            $.ajax({
                url: '/user.selectedCardInfo',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    card_num: <?php echo e($tab); ?>

                },
                type: 'POST',
                success: function (data) {
                    $('#tbody_data_list').html('');
                    if (data.msg === "ok") {
                        let market = data.market;
                        $('#logo_bin').css('display', 'none');
                        $('#logo_htx').css('display', 'none');
                        if (market === 'bin') {
                            $('#logo_bin').css('display', 'block');
                        } else {
                            $('#logo_htx').css('display', 'block');
                        }

                        $('#input_usdt_address').text(data.usdt_address);
                        my_coupon = data.my_coupon;
                        my_max_amount = data.max_amount;
                        showSelectedCard(data.lists);
                    }
                    $('#coupon_balance').text(my_coupon);
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }
        function showSelectedCard(datas) {
            coupon_price = datas.coupon_price;
            let tag = '';
            let card_color = '#767F88';
            if (parseInt(datas.coupon_level) === 1) {
                card_color = '#767F88';
            } else if (parseInt(datas.coupon_level) === 2) {
                card_color = '#FFAA04';
            } else if (parseInt(datas.coupon_level) === 3) {
                card_color = '#F4519F';
            } else if (parseInt(datas.coupon_level) === 4) {
                card_color = '#13AE89';
            } else if (parseInt(datas.coupon_level) === 5) {
                card_color = '#F84747';
            } else if (parseInt(datas.coupon_level) === 6) {
                card_color = '#0098D9';
            } else if (parseInt(datas.coupon_level) >= 7) {
                card_color = '#9A62F7';
            }

            let div_item = '<div class="d-flex flex-row justify-content-center coupon-card-column">';

            tag += '<div class="card shadow mt-3 ml-3 mr-3 d-flex">';
            tag += '<div class="card-header py-3 d-flex flex-row align-items-center justify-content-center" style="background-color: '+card_color+'">';
            tag += '<h6 class="m-0 font-weight-bold card-header-title" id="card_coupon_name" style="color: white;">' + datas.coupon_name + '</h6>';
            tag += '</div>';
            tag += '<div class="card-body coupon-card">';
            tag += div_item;
            tag += '<span class="mb-2" id="card_coupon_level">Lv.'+datas.coupon_level+'</span>';
            tag += '</div>';
            tag += div_item;
            tag += '<span class="mb-2 md-bold-font">$'+datas.amount_given+' <?php echo e(__('userpage.offered')); ?></span>';
            tag += '</div>';
            tag += div_item;
            tag += '<span><?php echo e(__('userpage.max_trade_amount')); ?></span>';
            tag += '</div>';
            tag += div_item;
            tag += '<span class="mb-2 md-bold-font">$'+my_max_amount+'</span>';
            tag += '</div>';
            tag += div_item;
            tag += '<span><?php echo e(__('userpage.trade_coins')); ?></span>';
            tag += '</div>';
            tag += div_item;
            tag += '<span class="md-bold-font">'+datas.coin_count+' <?php echo e(__('userpage.coin_unit')); ?></span>';
            tag += '</div>';
            tag += '<hr class="sidebar-divider">';
            tag += div_item;
            tag += '<span><?php echo e(__('userpage.price')); ?></span>';
            tag += '</div>';
            tag += div_item;
            tag += '<span class="mb-2 mx-bold-font" style="color: '+card_color+'">$'+datas.coupon_price+'</span>';
            tag += '</div>';
            tag += '</div>';
            tag += '</div>';
            tag += '</div>';

            $('#sel_payment_card').html(tag);
        }
        function setMarket(market_name) {
            $.ajax({
                url: '/user.setMarket',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    market: market_name
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        let market = data.market;
                        $('#logo_bin').css('display', 'none');
                        $('#logo_htx').css('display', 'none');
                        if (market === 'bin') {
                            $('#logo_bin').css('display', 'block');
                        } else {
                            $('#logo_htx').css('display', 'block');
                        }
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master_payment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/user/user-coupon-payment-view.blade.php ENDPATH**/ ?>