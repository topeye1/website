<?php $__env->startSection('content'); ?>
    <div id="friend-card-pc">
        <div class="friend-card-header justify-content-center notice-card-header mt-3 position-relative" style="display: flex;">
            <ul class="nav nav-underline mt-3" style="font-size: 16px">
                <li class="nav-item">
                    <a class="nav-link active" id="link-friend-friend" data-set="friend" href="#"><?php echo e(__('userpage.friend')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="link-friend-settlement" data-set="settlement" href="#"><?php echo e(__('userpage.settlement')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="link-friend-points" data-set="points" href="#"><?php echo e(__('userpage.points')); ?></a>
                </li>
            </ul>
            <div class="d-flex align-items-center mt-3 pl-3 pt-1 pb-1 pr-3 top-my-info">
                <div class="align-items-center" id="top-my-profit" style="display: flex;">
                    <img src="<?php echo e(URL::asset('assets/img/pngs/coin.png')); ?>" class="mr-1" style="width: 1.2rem; height: 1.2rem">
                    <span class="d-flex mr-3" style="font-size: 0.75rem"><?php echo e(__('userpage.my_revenue')); ?></span>
                    <span class="d-flex" style="font-size: 0.75rem">$</span>
                    <span class="d-flex" style="font-size: 0.75rem" id="my_revenue"></span>
                </div>
                <div class="align-items-center" id="top-my-points" style="display: none;">
                    <img src="<?php echo e(URL::asset('assets/img/pngs/point.png')); ?>" class="mr-1" style="width: 1.2rem; height: 1.2rem">
                    <span class="d-flex mr-3" style="font-size: 0.75rem"><?php echo e(__('userpage.hold_points')); ?></span>
                    <span class="d-flex" style="font-size: 0.75rem" id="my_points"></span>
                </div>
            </div>
        </div>
        <div class="container form-group friend-card-body" style="margin: auto;">
            <div class="row" style="margin: 0 auto; width: 100%; display:flex;">
                <div class="col-3 mb-3 mt-3 d-flex align-items-center">
                    <select class="list-pages" id="select-pages">
                        <option value="20">20 <?php echo e(__('userpage.view_items')); ?></option>
                        <option value="50">50 <?php echo e(__('userpage.view_items')); ?></option>
                    </select>
                </div>
                <div class="col-9 mb-3 mt-3 ">
                    <div class="row w-100 align-items-center">
                        <div class="col-md-3 align-items-center">
                            <div class="input-group d-flex p-2" >
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio-seldate_1" checked>
                                    <span class="form-check-label"><?php echo e(__('userpage.sel_month')); ?></span>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio-seldate_2">
                                    <span class="form-check-label"><?php echo e(__('userpage.sel_year')); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 pb-md-0 pb-sm-2">
                            <div class="input-group">
                                <div class="direction-key" id="direction-left"><i class="fas fa fa-chevron-left"></i></div>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div>
                                <input id="datepicker_1" class="form-control datepicker_1" placeholder="YYYY-MM" type="text" style="display: block">
                                <input id="datepicker_2" class="form-control datepicker_2" placeholder="YYYY" type="text" style="display: none">

                                <div class="direction-key" id="direction-right"><i class="fas fa fa-chevron-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container form-group friend-card-body" style="margin: auto;">
            <div class="row" id="friend-friend-layout" style="margin: 0 auto; width: 100%; display:flex;">
                <?php echo $__env->make('user.user-friend-friend-view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="row" id="friend-settlement-layout" style="margin: 0 auto; width: 100%; display:none;">
                <?php echo $__env->make('user.user-friend-closing-view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="row" id="friend-points-layout" style="margin: 0 auto; width: 100%; display:none;">
                <?php echo $__env->make('user.user-friend-points-view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        let page_start = 1;
        let radio_idx = 1;

        let filter_date = '';
        let selected_date = '';
        let tab = 'friend';
        $(document).ready(function () {
            let current_date = new Date();
            getMyInfo();
            $('.friend-card-header .nav-link').click(function(){
                $('.friend-card-header .nav-link').attr('class','nav-link');
                $(this).attr('class','nav-link active');

                tab = $(this).attr('data-set');
                if(tab === 'friend'){
                    $('#top-my-profit').css({'display':'flex'});
                    $('#top-my-points').css({'display':'none'});

                    $('#friend-friend-layout').css({'display':'flex'});
                    $('#friend-settlement-layout').css({'display':'none'});
                    $('#friend-points-layout').css({'display':'none'});
                } else if(tab === 'settlement'){
                    $('#top-my-profit').css({'display':'none'});
                    $('#top-my-points').css({'display':'flex'});

                    $('#friend-friend-layout').css({'display':'none'});
                    $('#friend-settlement-layout').css({'display':'flex'});
                    $('#friend-points-layout').css({'display':'none'});
                }
                else{
                    $('#top-my-profit').css({'display':'none'});
                    $('#top-my-points').css({'display':'flex'});

                    $('#friend-friend-layout').css({'display':'none'});
                    $('#friend-settlement-layout').css({'display':'none'});
                    $('#friend-points-layout').css({'display':'flex'});
                }
                radio_idx = 1;
                $('input[id^="datepicker_"]').css("display","none");
                $('input[id^="datepicker_"]').val();
                $('input[id^="datepicker_'+radio_idx+'"]').css("display","block");
                $('input[id^="radio-seldate_'+radio_idx+'"]').prop("checked",true);
                selectedTab(0, radio_idx, current_date);
            });

            $('input[id^="radio-seldate_"]').click(function(){
                let oid=$(this).attr("id");
                radio_idx = oid.split('_')[1];
                $('input[id^="datepicker_"]').css("display","none");
                $('input[id^="datepicker_"]').val();
                $('input[id^="datepicker_'+radio_idx+'"]').css("display","block");
                selectedTab(0, radio_idx, current_date);
            });
            setDatapicker();
            selectedTab(0, 1, current_date);
        });
        function setDatapicker() {
            $("#datepicker_1").datepicker( {
                minViewMode: 1,
                maxViewMode: 2,
                autoclose: true,
                language: "<?php echo e(session()->get('locale')); ?>",
                format: "yyyy-mm",
                orientation: "bottom auto"
            });
            $("#datepicker_2").datepicker( {
                minViewMode: 2,
                maxViewMode: 2,
                autoclose: true,
                language: "<?php echo e(session()->get('locale')); ?>",
                format: "yyyy",
                orientation: "bottom auto"
            });
            $('#datepicker_1').change(function(){
                page_start = 1;
                let now_date = new Date();
                let day = '-' + ( (now_date.getDate()) < 9 ? "0" + (now_date.getDate()) : (now_date.getDate()));
                filter_date = $('#datepicker_1').val();
                selected_date = new Date(filter_date + day);
                if (tab === 'friend') {
                    showFriendTableList();
                } else if (tab === 'settlement') {
                    showSettlementTableList();
                } else if (tab === 'points') {
                    showPointsTableList();
                }
            });
            $('#datepicker_2').change(function(){
                page_start = 1;
                let now_date = new Date();
                let month = '-' + ( (now_date.getMonth()+1) < 9 ? "0" + (now_date.getMonth()+1) : (now_date.getMonth()+1) );
                let day = '-' + ( (now_date.getDate()) < 9 ? "0" + (now_date.getDate()) : (now_date.getDate()));
                filter_date = $('#datepicker_2').val();
                selected_date = new Date(filter_date + month + day);
                if (tab === 'friend') {
                    showFriendTableList();
                } else if (tab === 'settlement') {
                    showSettlementTableList();
                } else if (tab === 'points') {
                    showPointsTableList();
                }
            });
            $('#direction-left').click(function(){
                selectedTab(-1, radio_idx, selected_date);
            });
            $('#direction-right').click(function(){
                selectedTab(1, radio_idx, selected_date);
            });
        }
        function selectedTab(param, radio_idx, date) {
            page_start = 1;
            filterDatepicker(parseInt(radio_idx), getCurrentDate(date, radio_idx, param));
            if (tab === 'friend') {
                showFriendTableList();
            } else if (tab === 'settlement') {
                showSettlementTableList();
            } else if (tab === 'points') {
                showPointsTableList();
            }
        }
        function filterDatepicker(idx, date) {
            if (parseInt(idx) === 1) {
                $( '#datepicker_1' ).datepicker( "setDate", date );
                selected_date = $('#datepicker_1').datepicker('getDate');
                filter_date = $('#datepicker_1').val();
            } else if (parseInt(idx) === 2) {
                $( '#datepicker_2' ).datepicker( "setDate", date );
                selected_date = $('#datepicker_2').datepicker('getDate');
                filter_date = $('#datepicker_2').val();
            }
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
                        $('#my_points').text(data.my_points);
                        my_coupon = data.my_coupon;
                        my_fee = data.my_fee;
                        my_points = data.my_points;
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
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master_user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/user/user-friend-view.blade.php ENDPATH**/ ?>