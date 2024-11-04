<!-- Add User Modal-->
<div class="modal fade" id="logHistoryModal" tabindex="-1" role="dialog" aria-labelledby="logUserModalLabel"
     aria-hidden="true">
    <div class="modal-dialog add-user" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="logUserModalLabel" style="text-align: center;"><?php echo e(__('userpage.mod_history')); ?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                        <thead>
                        <tr>
                            <th>Time</th>
                            <th>ID</th>
                            <th>Edit</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_log_list">


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" id="btn_log_modal_cancel"><?php echo e(__('userpage.confirm')); ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    function showLogHistory(user_num) {
        $.ajax({
            url: '/admin.getHistory',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                user_num : user_num
            },
            type: 'POST',
            success: function (data) {
                $('#logHistoryModal').modal('show');
                if (data.msg === "ok") {
                    $('#tbody_log_list').html('');
                    let tags = '';
                    let lists = data.lists;
                    if (lists.length === 0) {
                        let tags = '';
                        tags += '<tr><td colspan="4">';
                        tags += '<?php echo e(__('userpage.not_history')); ?>';
                        tags += '</td></tr>';
                        $('#tbody_log_list').html(tags);
                        return;
                    }
                    for (let i = 0; i < lists.length; i++) {
                        let list = lists[i];
                        tags += '<tr style="height: 2rem;">';
                        tags += '<td width="30%">' + list.log_date + '</td>';
                        tags += '<td width="30%">' + list.edit_admin + '</td>';
                        tags += '<td width="20%">' + list.edit_field + '</td>';
                        tags += '<td width="20%">' + list.edit_val + '</td>';
                        tags += '</tr>';
                    }
                    $('#tbody_log_list').html(tags);

                } else {
                    let tags = '';
                    tags += '<tr><td colspan="4">';
                    tags += '<?php echo e(__('userpage.not_history')); ?>';
                    tags += '</td></tr>';
                    $('#tbody_log_list').html(tags);
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }

</script>
<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/modals/log-modal.blade.php ENDPATH**/ ?>