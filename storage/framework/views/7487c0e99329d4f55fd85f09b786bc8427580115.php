<div class="col-12">
    <div class="table-responsive">
        <table class="table table-bordered user-page-table">
            <thead>
            <tr>
                <th><?php echo e(__('userpage.period')); ?></th>
                <th><?php echo e(__('userpage.my_revenue')); ?></th>
                <th><?php echo e(__('userpage.deduction')); ?></th>
                <th><?php echo e(__('userpage.agent_friends_revenue')); ?></th>
                <th><?php echo e(__('userpage.final_amount')); ?></th>
                <th><?php echo e(__('userpage.completed')); ?></th>
            </tr>
            </thead>
            <tbody id="tbody_settlement_list">


            </tbody>
        </table>
    </div>
</div>
<?php echo $__env->make('layouts.page-closing-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    function showSettlementTableList() {
        let pages = $('#select-pages').val();
        $.ajax({
            url: '/user.settlementList',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                pstart: page_start,
                search_date:filter_date,
                pages: pages
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    $('#tbody_settlement_list').html('');

                    let lists = data.lists;
                    page_start = parseInt(data.pstart);
                    let totalpage = parseInt(data.totalpage);

                    let tags = '';
                    for (let i = 0; i < lists.length; i++) {
                        let list = lists[i];
                        let convert_date = list.convert_date;
                        if (convert_date === undefined || convert_date === null)
                            convert_date = '';

                        if (i % 2 === 1) {
                            tags += '<tr style="background-color: #F0F1F4;">';
                        } else {
                            tags += '<tr>';
                        }
                        tags += '<td>' + list.create_date + '</td>';
                        tags += '<td>' + list.my_profit + '</td>';
                        tags += '<td>' + list.deduction + '</td>';
                        tags += '<td>' + list.friend_profit + '</td>';
                        tags += '<td>' + list.final_amount + '</td>';
                        if (convert_date !== '') {
                            tags += '<td>' + list.convert_date + '</td>';
                        } else {
                            tags += '<td><div id="btn-edit" class="btn btn-user my-middle-btn btn-block" onclick="onConvertPoint('+list.final_amount+')"><?php echo e(__('userpage.convert_to_points')); ?></div></td>';
                        }
                        tags += '</tr>';
                    }
                    $('#tbody_settlement_list').html(tags);

                    setPageNavClosing(totalpage, cpage_start, showSettlementTableList);

                    $('td[id^="closing_"]').click(function(){
                        let oid=$(this).attr("id");
                        let num = oid.split('_')[2];
                        showLogHistory(num);
                    });

                }
                else {
                    $('#page_nav_closing').html('');
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }

    function onConvertPoint(amount) {
        showSettlementTableList();
    }
</script>
<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/user/user-friend-closing-view.blade.php ENDPATH**/ ?>