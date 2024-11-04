<div class="row" id="revenue-data-list">
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
                <tr id="thead_list">
                    <th><?php echo e(__('userpage.date')); ?></th>
                    <th><?php echo e(__('userpage.cash_balance')); ?></th>
                    <th><?php echo e(__('userpage.revenue1')); ?></th>
                    <th><?php echo e(__('userpage.roi_rate')); ?></th>
                    <th><?php echo e(__('userpage.fees')); ?></th>
                    <th><?php echo e(__('userpage.profit1')); ?></th>
                    <th><?php echo e(__('userpage.coupon_balance')); ?></th>
                </tr>
                </thead>
                <tbody id="tbody_data_list">


                </tbody>
            </table>
        </div>
    </div>
    <div style="width: 100%; margin-top: 1rem;">
        <?php echo $__env->make('layouts.page-navigation2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

</div>

<script>
    function initRevenueList() {
        $('#select-pages').change(function (){
            mpstart = 1;
            showRevenueDataList();
        });
    }

    function showRevenueDataList() {
        let list_pages = $('#select-pages').val();
        $.ajax({
            url: '/user.revenueList',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                mpstart: mpstart,
                search_date: filter_date,
                market: market,
                date_idx: radio_idx,
                pages: list_pages
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    $('#thead_list').html('');
                    let thead_tag = "";
                    thead_tag += "<th><?php echo e(__('userpage.date')); ?></th>";
                    if (parseInt(radio_idx) === 1) {
                        thead_tag += "<th><?php echo e(__('userpage.cash_balance')); ?></th>";
                    }
                    thead_tag += "<th><?php echo e(__('userpage.revenue1')); ?></th>";
                    thead_tag += "<th><?php echo e(__('userpage.roi_rate')); ?></th>";
                    thead_tag += "<th><?php echo e(__('userpage.fees')); ?></th>";
                    thead_tag += "<th><?php echo e(__('userpage.profit1')); ?></th>";
                    thead_tag += "<th><?php echo e(__('userpage.coupon_balance')); ?></th>";
                    $('#thead_list').html(thead_tag);


                    $('#tbody_data_list').html('');
                    let lists = data.revenue_list;
                    pstart = parseInt(data.pstart);
                    let totalpage = parseInt(data.totalpage);
                    let tags = '';
                    for (let i = 0; i < lists.length; i++) {
                        let list = lists[i];
                        let amount = "$" + list.amount
                        if (parseFloat(list.amount) < 0) {
                            amount = "-$" + Math.abs(list.amount);
                        }
                        let profit = "$" + list.profit
                        if (parseFloat(list.profit) < 0) {
                            profit = "-$" + Math.abs(list.profit);
                        }
                        let rate = list.rate + "%"
                        let fee = "$" + list.fee
                        if (parseFloat(list.fee) < 0) {
                            fee = "-$" + Math.abs(list.fee);
                        }
                        let real = "$" + list.real
                        if (parseFloat(list.real) < 0) {
                            real = "-$" + Math.abs(list.real);
                        }
                        if (i % 2 === 1) {
                            tags += '<tr style="background-color: #F0F1F4;">';
                        } else {
                            tags += '<tr>';
                        }
                        tags += '<td>' + list.date + '</td>';
                        if (parseInt(radio_idx) === 1) {
                            tags += '<td>' + numberWithCommas(amount) + '</td>';
                        }
                        tags += '<td>' + numberWithCommas(profit) + '</td>';
                        tags += '<td>' + rate + '</td>';
                        tags += '<td>' + numberWithCommas(fee) + '</td>';
                        tags += '<td>' + numberWithCommas(real) + '</td>';
                        tags += '<td>' + numberWithCommas(list.coupon) + '</td>';
                        tags += '</tr>';
                    }
                    $('#tbody_data_list').html(tags);
                    setPageNavigation2(totalpage, mpstart, showRevenueDataList);

                    let assetDatas = data.assetDatas;
                    let liveCoins = data.liveCoins;
                    let roiDatas = data.roiDatas;
                    let profitDatas = data.profitDatas;
                    let lang = data.lang;
                    showLineChart(assetDatas, liveCoins, roiDatas, profitDatas, selected_date, lang, radio_idx);
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }
</script>
<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/user/user-revenue-list-view.blade.php ENDPATH**/ ?>