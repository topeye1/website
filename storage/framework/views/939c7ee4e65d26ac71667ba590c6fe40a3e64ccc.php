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
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                        <thead>
                            <tr>
                                <th width="7%"><?php echo e(__('userpage.user_number')); ?></th>
                                <th width="15%"><?php echo e(__('userpage.phone')); ?></th>
                                <th width="10%"><?php echo e(__('userpage.name')); ?></th>
                                <th width="10%"><?php echo e(__('userpage.level')); ?></th>
                                <th width="10%"><?php echo e(__('userpage.live_coin')); ?></th>
                                <th width="15%"><?php echo e(__('userpage.amount_money')); ?></th>
                                <th width="10%"><?php echo e(__('userpage.exchange')); ?></th>
                            </tr>
                        </thead>
                        <tbody id="tbody_data_list">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php echo $__env->make('layouts.page-navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('modals.log-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        let pstart = 1;
        let search_val = '';

        $(document).ready(function () {
            showTableList();
            $('#btn_add_user').click(function(){
                $('#addUserModal').modal('show');
            });

            $('#search_btn').click(function(){
                search_val = $('#search_text').val().replace(/ /g, '');
                showTableList();
            });

        });


        function showTableList() {
            $.ajax({
                url: '/admin.usageStatus',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    pstart: pstart,
                    search_val:search_val
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#tbody_data_list').html('');

                        let lists = data.lists;
                        pstart = parseInt(data.pstart);
                        let totalpage = parseInt(data.totalpage);

                        let tags = '';
                        for (let i = 0; i < lists.length; i++) {
                            let list = lists[i];
                            let market = list.market;
                            if (market === 'htx') {
                                market = "Huobi"
                            } else {
                                market = "Binamce"
                            }

                            tags += '<tr>';
                            tags += '<td>' + list.num + '</td>';
                            tags += '<td>' + list.phone + '</td>';
                            tags += '<td>' + list.name + '</td>';
                            tags += '<td>' + list.level + '</td>';
                            tags += '<td>' + list.live_cnt + '</td>';
                            tags += '<td>' + list.amount + '</td>';
                            tags += '<td>' + market + '</td>';
                            tags += '</tr>';
                        }
                        $('#tbody_data_list').html(tags);

                        setTablePageNavigation(totalpage, pstart);

                        $('input[id^="checkbox_"]').click(function(){
                            let oid=$(this).attr("id");
                            let num = oid.split('_')[1];
                            let checked = $('#'+oid);
                            checkActive(num, checked[0].checked);
                        });

                        $('td[id^="log_"]').click(function(){
                            let oid=$(this).attr("id");
                            let num = oid.split('_')[1];
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

<?php echo $__env->make('layouts.master_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/admin/usage-status-view.blade.php ENDPATH**/ ?>