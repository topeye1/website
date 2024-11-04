<?php $__env->startSection('content'); ?>
    <!-- Body-->
    <div class="row justify-content-center" style="min-height: 30rem; background-color: white">
        <div class="tab-content" id="nav-tabContent" style="background-color: white; width: 100%;">
            <div class="tab-pane fade active show" id="nav-trade" role="tabpanel" aria-labelledby="nav-trade-tab">
                <?php echo $__env->make('user.user-trade-view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="tab-pane fade" id="nav-revenue" role="tabpanel" aria-labelledby="nav-revenue-tab">
                2Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim
                occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor
                anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud
                minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor
                dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do
                dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
            </div>
            <div class="tab-pane fade" id="nav-coupon" role="tabpanel" aria-labelledby="nav-coupon-tab">
                <?php echo $__env->make('user.user-coupon-view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="tab-pane fade" id="nav-friend" role="tabpanel" aria-labelledby="nav-friend-tab">
                <?php echo $__env->make('user.user-friend-view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="tab-pane fade" id="nav-setting" role="tabpanel" aria-labelledby="nav-setting-tab">
                <?php echo $__env->make('user.user-setting-view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        let market = 'bin';
        let setv = 'all';
        let my_coupon = 0; //나의 쿠폰 잔액
        let my_fee = 0; //나의 수수료율
        let my_points = 0; //나의 포인트 수량

        $(document).ready(function () {
            let tab = '<?php echo e($tab); ?>';

            if (tab === 'coupon') {
                $('#nav-trade-tab').attr('class','d-flex nav-item nav-link');
                $('#nav-coupon-tab').attr('class','d-flex nav-item nav-link active');

                $('#nav-trade').attr('class','tab-pane fade');
                $('#nav-coupon').attr('class','tab-pane fade active show');

                $('#show-selected-tab').html('');
                let tag_tab = '<img src="<?php echo e(URL::asset('assets/img/pngs/coupon.png')); ?>" class="mr-3" style="width: auto;">';
                tag_tab += '<span class=""><?php echo e(__('userpage.coupon')); ?></span>';
                $('#show-selected-tab').html(tag_tab);

                $('#coupon-card-layout').css({'display':'flex'});
                $('#coupon-history-layout').css({'display':'none'});
                $('#link-coupon-purchase').attr('class','nav-link active');
                $('#link-coupon-history').attr('class','nav-link');
                showCouponPageView();
            }
            $('#nav-trade-tab').click(function () {
                $('#show-selected-tab').html('');
                let tag_tab = '<img src="<?php echo e(URL::asset('assets/img/pngs/trade.png')); ?>" class="mr-3" style="width: auto;">';
                tag_tab += '<span class=""><?php echo e(__('userpage.trade')); ?></span>';
                $('#show-selected-tab').html(tag_tab);

            });
            $('#nav-revenue-tab').click(function () {
                $('#show-selected-tab').html('');
                let tag_tab = '<img src="<?php echo e(URL::asset('assets/img/pngs/revenue.png')); ?>" class="mr-3" style="width: auto;">';
                tag_tab += '<span class=""><?php echo e(__('userpage.revenue')); ?></span>';
                $('#show-selected-tab').html(tag_tab);

            });
            $('#nav-coupon-tab').click(function () {
                $('#show-selected-tab').html('');
                let tag_tab = '<img src="<?php echo e(URL::asset('assets/img/pngs/coupon.png')); ?>" class="mr-3" style="width: auto;">';
                tag_tab += '<span class=""><?php echo e(__('userpage.coupon')); ?></span>';
                $('#show-selected-tab').html(tag_tab);

                $('#coupon-card-layout').css({'display':'flex'});
                $('#coupon-history-layout').css({'display':'none'});
                $('#link-coupon-purchase').attr('class','nav-link active');
                $('#link-coupon-history').attr('class','nav-link');
                showCouponPageView();
            });
            $('#nav-friend-tab').click(function () {
                $('#show-selected-tab').html('');
                let tag_tab = '<img src="<?php echo e(URL::asset('assets/img/pngs/friend.png')); ?>" class="mr-3" style="width: auto;">';
                tag_tab += '<span class=""><?php echo e(__('userpage.friend')); ?></span>';
                $('#show-selected-tab').html(tag_tab);
                showFriendPageView();
            });
            $('#nav-setting-tab').click(function () {
                $('#show-selected-tab').html('');
                let tag_tab = '<img src="<?php echo e(URL::asset('assets/img/pngs/setting.png')); ?>" class="mr-3" style="width: auto;">';
                tag_tab += '<span class=""><?php echo e(__('userpage.setting')); ?></span>';
                $('#show-selected-tab').html(tag_tab);
                showSettingPageView();
            });

            $('#logo_bin').click(function () {
                setMarket("htx")
            });
            $('#logo_htx').click(function () {
                setMarket("bin")
            });
            $('.mobile-menu').click(function () {
                $('#MobileMenuModal').modal('show');
            });
            getMyInfo();
        });


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
                        market = data.market;
                        window.location.href = "<?php echo e(url('/user.user_page/main/trade')); ?>";
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master_user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/user/user_page.blade.php ENDPATH**/ ?>