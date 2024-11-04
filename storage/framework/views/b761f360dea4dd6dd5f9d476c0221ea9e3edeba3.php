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
            <div class="input-group col-9 d-flex justify-content-end">
                <a href="#" class="btn btn-success btn-icon-split" id="btn_add_user">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text"><?php echo e(__('userpage.add')); ?></span>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                    <thead>
                        <tr>
                            <th width="7%"><?php echo e(__('userpage.user_number')); ?></th>
                            <th width="15%"><?php echo e(__('userpage.id')); ?></th>
                            <th><?php echo e(__('userpage.phone')); ?></th>
                            <th width="10%"><?php echo e(__('userpage.name')); ?></th>
                            
                            <th width="4%"><?php echo e(__('userpage.actived')); ?></th>
                            <th width="4%"><?php echo e(__('userpage.level')); ?></th>
                            <th width="7%"><?php echo e(__('userpage.fee_rate')); ?></th>
                            <th><?php echo e(__('userpage.edit')); ?></th>
                            <th width="10%"><?php echo e(__('userpage.signin_date')); ?></th>
                            <th width="10%"><?php echo e(__('userpage.login_date')); ?></th>
                            <th><?php echo e(__('userpage.delete')); ?></th>
                            <th width="7%">Log</th>
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
                $('#addModalLabel').text('<?php echo e(__('userpage.add_user')); ?>');
                $('#btn_modal_add').css('display', 'block');
                $('#btn_modal_edit').css('display', 'none');
                $('#addUserModal').modal('show');
            });

            $('#search_btn').click(function(){
                search_val = $('#search_text').val().replace(/ /g, '');
                showTableList();
            });

        });

        /*function showWallet(user_num) {

        }*/
        function checkActive(user_num, checked) {
            $.ajax({
                url: '/admin.checkActived',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    num: user_num,
                    checked: Number(checked)
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        showTableList();
                    }
                }
            });
        }

        function deleteUser(user_num) {
            $.ajax({
                url: '/admin.deleteUser',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    num: user_num
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        showTableList();
                    }
                }
            });
        }

        function showTableList() {
            $.ajax({
                url: '/admin.allUserList',
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
                        let names = '';

                        let tags = '';
                        for (let i = 0; i < lists.length; i++) {
                            let list = lists[i];
                            let active_checked = '';
                            let login_date = list.login_date;
                            if (login_date === null) {
                                login_date = "";
                            }

                            tags += '<tr>';
                            tags += '<td>' + list.num + '</td>';
                            tags += '<td>' + list.id + '</td>';
                            tags += '<td>' + list.phone + '</td>';
                            tags += '<td>' + list.name + '</td>';
                            //tags += '<td class="touch-td" onclick="showWallet('+list.num+');"><i class="fas fa-wallet"></i></td>';
                            if (parseInt(list.actived) === 1)
                                active_checked = 'checked';
                            tags += '<td class="touch-td"><input class="form-control active-checked" type="checkbox" id="checkbox_'+list.num+'" '+active_checked+'></td>';
                            tags += '<td>' + list.level + '</td>';
                            tags += '<td>' + list.my_fee + '</td>';
                            tags += '<td class="touch-td" ';
                            tags += 'onclick="setEditUserInfo(';
                            tags += list.num + ', \'';
                            tags += list.id + '\', \'';
                            tags += list.phone + '\', \'';
                            tags += list.name + '\', ';
                            tags += list.level + ', ';
                            tags += list.my_fee + ', \'';
                            tags += active_checked + '\'';
                            tags += ');">';
                            tags += '<i class="fas fa-edit"></i></td>';
                            tags += '<td>' + list.create_date + '</td>';
                            tags += '<td>' + login_date + '</td>';
                            tags += '<td class="touch-td" id="delete_'+list.num+'"><i class="fas fa-trash"></i></td>';
                            tags += '<td class="touch-td" id="log_'+list.num+'"><?php echo e(__('userpage.log_view')); ?></td>';
                            tags += '</tr>';
                        }
                        $('#tbody_data_list').html(tags);

                        setTablePageNavigation(totalpage, pstart);

                        $('input[id^="checkbox_"]').click(function(){
                            let oid=$(this).attr("id");
                            let num = oid.split('_')[1];
                            let checked = $('#'+oid).prop('checked');
                            checkActive(num, checked);
                        });

                        $('td[id^="delete_"]').click(function(){
                            let oid=$(this).attr("id");
                            let num = oid.split('_')[1];
                            deleteUser(num);
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

<?php echo $__env->make('layouts.master_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/admin/user-view.blade.php ENDPATH**/ ?>