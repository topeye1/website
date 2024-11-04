<div class="col-12">
    <div class="table-responsive">
        <table class="table table-bordered user-page-table">
            <thead>
            <tr>
                <th><?php echo e(__('userpage.name')); ?></th>
                <th><?php echo e(__('userpage.phone')); ?></th>
                <th><?php echo e(__('userpage.total_profit')); ?></th>
                <th><?php echo e(__('userpage.total_fee')); ?></th>
                <th><?php echo e(__('userpage.discount_rate')); ?></th>
                <th><?php echo e(__('userpage.fixed_fee')); ?></th>
                <th><?php echo e(__('userpage.level')); ?></th>
                <th><?php echo e(__('userpage.level_discount_rate')); ?></th>
                <th><?php echo e(__('userpage.my_revenue')); ?></th>
            </tr>
            </thead>
            <tbody id="tbody_data_list">


            </tbody>
        </table>
    </div>
</div>
<?php echo $__env->make('layouts.page-friend-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="col-12 d-flex justify-content-center">
    <div id="btn_fee_setting" class="btn btn-confirm"><?php echo e(__('userpage.fee_setting')); ?></div>
</div>

<?php echo $__env->make('modals.setting-discount-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    function showFriendTableList() {
        let pages = $('#select-pages').val();
        $.ajax({
            url: '/user.friendProfitList',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                pstart: page_start,
                search_date:filter_date,
                pages: pages
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    $('#tbody_data_list').html('');

                    let lists = data.lists;
                    page_start = parseInt(data.pstart);
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

                        if (i % 2 === 1) {
                            tags += '<tr style="background-color: #F0F1F4;">';
                        } else {
                            tags += '<tr>';
                        }
                        tags += '<td>' + list.num + '</td>';
                        tags += '<td id="table_user_'+list.num+'">' + list.id + '</td>';
                        tags += '<td>' + list.phone + '</td>';
                        tags += '<td>' + list.name + '</td>';
                        tags += '<td></td>';
                        tags += '<td></td>';
                        tags += '<td>' + list.level + '</td>';
                        tags += '<td>' + list.my_fee + '</td>';
                        tags += '<td>' + list.create_date + '</td>';
                        tags += '<td>' + list.create_date + '</td>';
                        tags += '</tr>';
                    }
                    $('#tbody_data_list').html(tags);

                    setPageNavFriend(totalpage, fpage_start, showFriendTableList);

                    $('td[id^="table_user_"]').click(function(){
                        let oid=$(this).attr("id");
                        let num = oid.split('_')[2];
                        showLogHistory(num);
                    });

                }
                else {
                    $('#page_nav_friend').html('');
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }
    $('#btn_fee_setting').click( function () {
        settingDiscountRate(0);
    });
</script>
<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/user/user-friend-friend-view.blade.php ENDPATH**/ ?>