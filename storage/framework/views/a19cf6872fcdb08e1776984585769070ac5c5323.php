<!-- Add User Modal-->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel"
     aria-hidden="true">
    <div class="modal-dialog add-user" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="changePasswordModalLabel" style="text-align: center;"><?php echo e(__('userpage.change_password')); ?></h5>
            </div>
            <div class="modal-body pl-5 pr-5">
                <div class="row">
                    <div class="col-12"><?php echo e(__('userpage.current_password')); ?></div>
                    <div class="col-12">
                        <input type="password" class="form-control form-control-user my-input" name="current_password" id="current_password">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12" style="color: #F84747; font-size: 0.8rem;">
                        <div id="err_nomatch_pwd" style="display: none;"><?php echo e(__('userpage.nomatch_pwd')); ?></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12"><?php echo e(__('userpage.new_password')); ?></div>
                    <div class="col-12">
                        <input type="password" class="form-control form-control-user my-input" name="new_password" id="new_password">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12"><?php echo e(__('userpage.re_enter_password')); ?></div>
                    <div class="col-12">
                        <input type="password" class="form-control form-control-user my-input" name="reenter_password" id="reenter_password">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12" style="color: #F84747; font-size: 0.8rem;">
                        <div id="err_password" style="display: none;"><?php echo e(__('userpage.err_password')); ?></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <div id="btn_change_password_cancel" class="btn btn-user my-middle-btn btn-block mr-5" style="width: 110px;">
                    <?php echo e(__('userpage.cancel')); ?>

                </div>
                <div id="btn_change_password_confirm" class="btn btn-confirm d-flex justify-content-center align-items-center" style="width: 110px; height: 30px; font-size: 0.9rem;">
                    <?php echo e(__('userpage.confirm')); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showChangePassword() {
        $('#changePasswordModal').modal('show');
        $('#btn_change_password_cancel').click(function () {
            $('#current_password').val('');
            $('#new_password').val('');
            $('#reenter_password').val('');
            $('#changePasswordModal').modal('hide');
        });
        $('#btn_change_password_confirm').click(function () {
            let c_password = $('#current_password').val().replace(/ /g, '');
            let n_password = $('#new_password').val().replace(/ /g, '');
            let r_password = $('#reenter_password').val().replace(/ /g, '');
            if (c_password === '' || n_password === '' || r_password === '') {
                return;
            }
            if (n_password !== r_password) {
                $('#err_password').css('display', 'block');
                setTimeout(function () {
                    $('#err_password').css('display', 'none');
                },3000);
            } else {
                $.ajax({
                    url: '/user.changePassword',
                    headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                    data: {
                        current_password: c_password,
                        new_password: n_password
                    },
                    type: 'POST',
                    success: function (data) {
                        if (data.msg === "ok") {
                            $('#current_password').val('');
                            $('#new_password').val('');
                            $('#reenter_password').val('');
                            $('#changePasswordModal').modal('hide');
                            changePasswordMessage();
                        } else {
                            $('#current_password').val('');
                            $('#err_nomatch_pwd').css('display', 'block');
                            setTimeout(function () {
                                $('#err_nomatch_pwd').css('display', 'none');
                            },3000);
                        }
                    },
                    error: function (jqXHR, errdata, errorThrown) {
                        console.log(errdata);
                    }
                });
            }
        });
    }
</script>
<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/modals/edit-password-modal.blade.php ENDPATH**/ ?>