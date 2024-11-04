<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="mb-4">
            <div class="row mt-3 ml-3 mr-3 mb-md-3">
                <div class="input-group col-3 form-inline navbar-search">
                    <input type="text" class="form-control bg-light border-1 small" placeholder="<?php echo e(__('userpage.search')); ?>" id="search_text">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="search_btn">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
                <div class="input-group col-9">
                    <div class="row w-100 align-items-center">
                        <div class="col-md-5 align-items-center">
                            <?php echo $__env->make('layouts.date-radio-view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="col-md-3 pb-md-0 pb-sm-2">
                            <?php echo $__env->make('layouts.date-picker-view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                        <thead>
                        <tr>
                            <th width="7%"><?php echo e(__('userpage.user_number')); ?></th>
                            <th width="12%"><?php echo e(__('userpage.id')); ?></th>
                            <th width="7%"><?php echo e(__('userpage.phone')); ?></th>
                            <th width="7%"><?php echo e(__('userpage.name')); ?></th>
                            <th width="12%"><?php echo e(__('userpage.amount_money')); ?></th>
                            <th width="12%"><?php echo e(__('userpage.revenue_money')); ?></th>
                            <th width="10%"><?php echo e(__('userpage.revenue_rate')); ?></th>
                            <th width="7%"><?php echo e(__('userpage.fee_rate')); ?></th>
                            <th width="10%"><?php echo e(__('userpage.fee')); ?></th>
                            <th width="7%"><?php echo e(__('userpage.real_money')); ?></th>
                            <th width="15%"><?php echo e(__('userpage.coupon_remain')); ?></th>
                        </tr>
                        </thead>
                        <tbody id="tbody_data_list">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php echo $__env->make('layouts.page-navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('modals.add-user-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        let pstart = 1;
        let search_val = '';
        let radio_idx = 1;
        let filter_date = '';
        let selected_date = '';


        function getCurrentDate(today, idx, val) {
            let date;
            if (parseInt(idx) === 1) {
                date = new Date(today.setDate(today.getDate() + val));
            }
            if (parseInt(idx) === 2) {
                date = new Date(today.setMonth(today.getMonth() + val))
            }
            if (parseInt(idx) === 3) {
                date = new Date(today.setFullYear(today.getFullYear() + val))
            }
            return date;
        }
        function setDatepicker(idx, date) {
            if (parseInt(idx) === 1) {
                $( "#input_datepicker_1" ).datepicker( "setDate", date );
                selected_date = $('#input_datepicker_1').datepicker('getDate');
                filter_date = $('#input_datepicker_1').val();
            } else if (parseInt(idx) === 2) {
                $( "#input_datepicker_2" ).datepicker( "setDate", date );
                selected_date = $('#input_datepicker_2').datepicker('getDate');
                filter_date = $('#input_datepicker_2').val();
            } else {
                $( "#input_datepicker_3" ).datepicker( "setDate", date );
                selected_date = $('#input_datepicker_3').datepicker('getDate');
                filter_date = $('#input_datepicker_3').val();
            }
        }

        $(document).ready(function () {
            let today = new Date();
            setDatepicker(radio_idx, getCurrentDate(today, radio_idx, 0));
            $('input[id^="seldate_"]').click(function(){
                let oid=$(this).attr("id");
                radio_idx = oid.split('_')[1];

                $('input[id^="input_datepicker_"]').css("display","none");
                $('input[id^="input_datepicker_"]').val();

                $('input[id^="input_datepicker_'+radio_idx+'"]').css("display","block");

                let sval = $('#search_text').val();
                search_val = sval.replace(/\s/g, '');
                setDatepicker(radio_idx, getCurrentDate(today, radio_idx, 0));
                showTableList();
            });
            $('#direction-left').click(function(){
                setDatepicker(radio_idx, getCurrentDate(selected_date, radio_idx, -1));
                showTableList();
            });
            $('#direction-right').click(function(){
                setDatepicker(radio_idx, getCurrentDate(selected_date, radio_idx, 1));
                showTableList();
            });

            showTableList();
            /*$('#btn_add_user').click(function(){
                $('#addUserModal').modal('show');
            });*/
            $('#search_btn').click(function(){
                search_val = $('#search_text').val().replace(/\s/g, '');
                showTableList();
            });

        });
        function numberWithCommas(number) {
            return number.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")
        }

        function showTableList() {
            $.ajax({
                url: '/admin.userRevenue',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    pstart: pstart,
                    search_val:search_val,
                    search_date:filter_date,
                    date_idx: radio_idx,
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#tbody_data_list').html('');

                        let lists = data.lists;
                        pstart = parseInt(data.pstart);
                        let totalpage = parseInt(data.totalpage);
                        let names = '';

                        let tags = '';
                        for (let i = 0; i < lists.length; i++) {
                            let list = lists[i];
                            let active_checked = '';
                            let login_date = list.login_date;
                            if (login_date === null) {
                                login_date = "";
                            }
                            let profit = parseFloat(list.profit);
                            let punit = "$";
                            if (profit < 0) {
                                profit = Math.abs(profit);
                                punit = "-$";
                            }

                            let real_profit = parseFloat(list.real_profit);
                            let runit = "$";
                            if (real_profit < 0) {
                                real_profit = Math.abs(real_profit);
                                runit = "-$";
                            }

                            tags += '<tr>';
                            tags += '<td>' + list.user_num + '</td>';
                            tags += '<td id="table_user_'+list.user_num+'">' + list.user_id + '</td>';
                            tags += '<td>' + list.user_phone + '</td>';
                            tags += '<td>' + list.user_name + '</td>';
                            tags += '<td>$' + numberWithCommas(list.amount) + '</td>';
                            tags += '<td>' + punit + numberWithCommas(profit) + '</td>';
                            tags += '<td>' + list.profit_rate + '%</td>';
                            tags += '<td>' + list.fee_rate + '%</td>';
                            tags += '<td>' + numberWithCommas(list.fee) + '</td>';
                            tags += '<td>' + runit + numberWithCommas(real_profit) + '</td>';
                            tags += '<td>' + numberWithCommas(list.coupon) + '</td>';
                            tags += '</tr>';
                        }
                        $('#tbody_data_list').html(tags);

                        setTablePageNavigation(totalpage, pstart);

                        $('td[id^="table_user_"]').click(function(){
                            let oid=$(this).attr("id");
                            let num = oid.split('_')[2];
                            showLogHistory(num);
                        });

                    }
                    else {
                        $('#page_nav_container').html('');
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/admin/user-revenue-view.blade.php ENDPATH**/ ?>