<div class="col-12">
    <div class="table-responsive">
        <table class="table table-bordered user-page-table">
            <thead>
            <tr>
                <th><?php echo e(__('userpage.date')); ?></th>
                <th><?php echo e(__('userpage.points')); ?></th>
                <th><?php echo e(__('userpage.status')); ?></th>
                <th><?php echo e(__('userpage.payment_method')); ?></th>
                <th><?php echo e(__('userpage.amount')); ?></th>
                <th><?php echo e(__('userpage.tx_id')); ?></th>
                <th><?php echo e(__('userpage.exchange')); ?></th>
                <th><?php echo e(__('userpage.completion_date')); ?></th>
            </tr>
            </thead>
            <tbody id="tbody_points_list">


            </tbody>
        </table>
    </div>
</div>
<?php echo $__env->make('layouts.page-points-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    function showPointsTableList() {
        let pages = $('#select-pages').val();
        $.ajax({
            url: '/user.pointsList',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                pstart: page_start,
                search_date:filter_date,
                pages: pages
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    $('#tbody_points_list').html('');

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
                    $('#tbody_points_list').html(tags);

                    setPageNavPoints(totalpage, cpage_start, showPointsTableList);
                }
                else {
                    $('#page_nav_points').html('');
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }

</script>
<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/user/user-friend-points-view.blade.php ENDPATH**/ ?>