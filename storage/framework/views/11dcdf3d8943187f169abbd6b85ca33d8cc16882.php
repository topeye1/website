<?php $__env->startSection('content'); ?>
    <div id="coupon-card-pc">
        <div class="coupon-card-header justify-content-center notice-card-header mt-3 position-relative" style="display: flex;">
            <ul class="nav nav-underline mt-3" style="font-size: 16px">
                <li class="nav-item">
                    <a class="nav-link active" id="link-coupon-purchase" data-set="purchase" href="#"><?php echo e(__('userpage.coupon_purchase')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="link-coupon-history" data-set="history" href="#"><?php echo e(__('userpage.purchase_history')); ?></a>
                </li>
            </ul>
        </div>

        <div class="container form-group coupon-card-body-purchase" style="margin: auto;">
            <div class="row pb-3" id="coupon-card-layout" style="margin: 0 auto; display: block; background-color: #DCE0ED;">


            </div>
            <div class="row" id="coupon-history-layout" style="margin: 0 auto; width: 70rem; display:none;">
                <div class="col-12 mt-3 mb-3">
                    <select class="list-pages" id="select-pages">
                        <option value="20">20 <?php echo e(__('userpage.view_items')); ?></option>
                        <option value="50">50 <?php echo e(__('userpage.view_items')); ?></option>
                    </select>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered user-page-table" id="dataTable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('userpage.buy_date')); ?></th>
                                <th><?php echo e(__('userpage.purchase_amount')); ?></th>
                                <th><?php echo e(__('userpage.coupon_name')); ?></th>
                                <th><?php echo e(__('userpage.level')); ?></th>
                                <th><?php echo e(__('userpage.used_amount')); ?></th>
                                <th><?php echo e(__('userpage.remaining_amount')); ?></th>
                                <th><?php echo e(__('userpage.validity')); ?></th>
                                <th><?php echo e(__('userpage.status')); ?></th>
                            </tr>
                            </thead>
                            <tbody id="tbody_data_list">


                            </tbody>
                        </table>
                    </div>
                </div>
                <?php echo $__env->make('layouts.page-navigation2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        let mpstart = 1;
        let my_max_amount = 0;

        $(document).ready(function () {
            getMyInfo();
            $('.coupon-card-header .nav-link').click(function(){
                $('.coupon-card-header .nav-link').attr('class','nav-link');
                $(this).attr('class','nav-link active');

                let data_set = $(this).attr('data-set');
                if(data_set === 'purchase'){
                    $('#coupon-card-layout').css({'display':'block'});
                    $('#coupon-history-layout').css({'display':'none'});
                    showCouponPageView();
                }
                else{
                    $('#coupon-card-layout').css({'display':'none'});
                    $('#coupon-history-layout').css({'display':'block'});
                    mpstart = 1;
                    getCouponHistory();
                }
            });
            $('#select-pages').change(function (){
                mpstart = 1;
                getCouponHistory();
            });
            showCouponPageView();
        });
        function showCouponPageView() {
            $.ajax({
                url: '/user.couponsInfo',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    market: market
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        my_max_amount = data.max_amount;
                        showCouponCard(data.lists)
                    }
                    else {
                        $('#coupon-card-layout').html('');
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }

        function getCouponHistory() {
            let coupon_using_pages = $('#select-pages').val();
            $.ajax({
                url: '/user.couponsHistory',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    pstart: mpstart,
                    pages: coupon_using_pages
                },
                type: 'POST',
                success: function (data) {
                    $('#tbody_data_list').html('');
                    if (data.msg === "ok") {
                        let lists = data.lists;
                        mpstart = parseInt(data.pstart);
                        let totalpage = parseInt(data.totalpage);
                        let tags = '';

                        for (let i = 0; i < lists.length; i++) {
                            let list = lists[i];
                            let date_buy = list.date_buy;
                            let price_buy = list.price_buy;
                            let coupon_name = list.coupon_name;
                            let level = list.level;
                            let amount_used = list.amount_used;
                            let remain_amount = parseInt(list.amount_given) - parseInt(amount_used)
                            let date_due = list.date_due;
                            let status = '';
                            if (parseInt(list.status) === 1) {
                                status = '<?php echo e(__('userpage.in_use')); ?>';
                            } else if(parseInt(list.status) === 2) {
                                status = '<?php echo e(__('userpage.expiration')); ?>';
                            } else if(parseInt(list.status) === 3) {
                                status = '<?php echo e(__('userpage.used')); ?>';
                            }

                            if (i % 2 === 1) {
                                tags += '<tr style="background-color: #F0F1F4;">';
                            } else {
                                tags += '<tr>';
                            }
                            tags += '<td class="text-nowrap align-middle">' + date_buy + '</td>';
                            tags += '<td class="text-nowrap align-middle">' + price_buy + '</td>';
                            tags += '<td class="text-nowrap align-middle">' + coupon_name + '</td>';
                            tags += '<td class="text-nowrap align-middle">' + level + '</td>';
                            tags += '<td class="text-nowrap align-middle">' + amount_used + '</td>';
                            tags += '<td class="text-nowrap align-middle">' + remain_amount + '</td>';
                            tags += '<td class="text-nowrap align-middle">' + date_due + '</td>';
                            tags += '<td class="text-nowrap align-middle">' + status + '</td>';
                            tags += '</tr>';
                        }
                        $('#tbody_data_list').html(tags);
                        setPageNavigation2(totalpage, mpstart, getCouponHistory);
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }

        function showCouponCard(cards) {
            $('#coupon-card-layout').html('');
            let tag = '';
            let div_item = '<div class="d-flex flex-row justify-content-center coupon-card-column">';

            for (let i = 0; i < cards.length; i++) {
                let card = cards[i];
                let card_data = JSON.stringify(card);
                let card_num = card.coupon_num;
                let name = card.coupon_name;
                let level = card.coupon_level;
                let price = card.coupon_price;
                let valid = card.coupon_valid;
                let given = card.amount_given;
                let coins = card.coin_count;
                let desc = card.description;
                let card_color = '#767F88';
                if (parseInt(level) === 1) {
                    card_color = '#767F88';
                } else if (parseInt(level) === 2) {
                    card_color = '#FFAA04';
                } else if (parseInt(level) === 3) {
                    card_color = '#F4519F';
                } else if (parseInt(level) === 4) {
                    card_color = '#13AE89';
                } else if (parseInt(level) === 5) {
                    card_color = '#F84747';
                } else if (parseInt(level) === 6) {
                    card_color = '#0098D9';
                } else if (parseInt(level) >= 7) {
                    card_color = '#9A62F7';
                }

                tag += '<div class="card shadow mt-3 ml-3 mr-3 d-flex">';
                tag += '<div class="card-header py-3 d-flex flex-row align-items-center justify-content-center" style="background-color: '+card_color+'">';
                tag += '<h6 class="m-0 font-weight-bold card-header-title" id="card_coupon_name" style="color: white;">' + name + '</h6>';
                tag += '</div>';
                tag += '<div class="card-body coupon-card">';
                tag += div_item;
                tag += '<span class="mb-2" id="card_coupon_level">Lv.'+level+'</span>';
                tag += '</div>';
                tag += div_item;
                tag += '<span class="mb-2 md-bold-font">$'+given+' <?php echo e(__('userpage.offered')); ?></span>';
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
                tag += '<span class="md-bold-font">'+coins+' <?php echo e(__('userpage.coin_unit')); ?></span>';
                tag += '</div>';
                tag += '<hr class="sidebar-divider">';
                tag += div_item;
                tag += '<span><?php echo e(__('userpage.price')); ?></span>';
                tag += '</div>';
                tag += div_item;
                tag += '<span class="mb-2 mx-bold-font" style="color: '+card_color+'">$'+price+'</span>';
                tag += '</div>';
                tag += '<div id="purchase-coupon-btn_'+card_num+'" class="btn btn-success" data-set=\''+card_data+'\' style="width: 100%; background-color: '+card_color+'; border-color: '+card_color+'; color: #fff">';
                tag += '<?php echo e(__('userpage.coupon_purchase')); ?>';
                tag += '</div>';
                tag += '</div>';
                tag += '</div>';
                tag += '</div>';
            }

            $('#coupon-card-layout').html(tag);

            $('div[id^="purchase-coupon-btn_"]').click(function(){
                let oid=$(this).attr("id");
                let card_num = oid.split('_')[1];
                window.location.href = "/user_mobile.user-coupon-payment-view/card-num/"+card_num;
            });
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
                        $('#logo_bin').css('display', 'none');
                        $('#logo_htx').css('display', 'none');
                        if (market === 'bin') {
                            $('#logo_bin').css('display', 'block');
                        } else {
                            $('#logo_htx').css('display', 'block');
                        }
                        $('#span-user-level').text(my_level);
                        $('#span-user-id').text(my_id);
                    }
                    else {
                        $('#coupon-card-layout').html('');
                    }

                    $('#mobile_tab_image').attr('src', '<?php echo e(URL::asset('assets/img/pngs/coupon.png')); ?>');
                    $('#mobile_tab_text').text('<?php echo e(__('userpage.coupon')); ?>');
                    $('#mobile_val_img').css('display', 'block');
                    $('#mobile_val_img').attr('src', '<?php echo e(URL::asset('assets/img/pngs/coupon.png')); ?>');
                    $('#mobile_val_text').text('<?php echo e(__('userpage.coupon_balance')); ?>');
                    $('#mobile_val_unit').text('$');
                    $('#mobile_val_balance').text(my_coupon);
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mobile_user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/user_mobile/user-coupon-view.blade.php ENDPATH**/ ?>