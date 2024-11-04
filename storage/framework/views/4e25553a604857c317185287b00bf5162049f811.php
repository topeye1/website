<!-- Add User Modal-->
<div class="modal fade" id="changePhoneModal" tabindex="-1" role="dialog" aria-labelledby="changePhoneModalLabel"
     aria-hidden="true">
    <div class="modal-dialog add-user" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="changePhoneModalLabel" style="text-align: center;"><?php echo e(__('userpage.change_phone_number')); ?></h5>
            </div>
            <div class="modal-body pl-5 pr-5">
                <div class="row mb-3">
                    <div class="col-12"><?php echo e(__('userpage.current_phone_number')); ?></div>
                    <div class="col-12">
                        <input type="text" class="form-control form-control-user my-input" name="current_phone_number" id="current_phone_number">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12"><?php echo e(__('userpage.new_phone_number')); ?></div>
                    <div class="col-12">
                        <input type="text" class="form-control form-control-user my-input" name="new_phone_number" id="new_phone_number">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12"><?php echo e(__('userpage.re_enter_phone_number')); ?></div>
                    <div class="col-12">
                        <input type="text" class="form-control form-control-user my-input" name="reenter_phone_number" id="reenter_phone_number">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12" style="color: #F84747; font-size: 0.8rem;">
                        <div id="err_change_phone3" style="display: none;"><?php echo e(__('userpage.err_phone_number3')); ?></div>
                        <div id="err_change_phone2" style="display: none;"><?php echo e(__('userpage.err_phone_number2')); ?></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <div id="btn_change_phone_cancel" class="btn btn-user my-middle-btn btn-block mr-5" style="width: 110px;">
                    <?php echo e(__('userpage.cancel')); ?>

                </div>
                <div id="btn_change_phone_confirm" class="btn btn-confirm d-flex justify-content-center align-items-center" style="width: 110px; height: 30px; font-size: 0.9rem;">
                    <?php echo e(__('userpage.confirm')); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showChangePhone(phone) {
        $('#current_phone_number').val(phone);
        $('#changePhoneModal').modal('show');
        $('#btn_change_phone_cancel').click(function () {
            $('#current_phone_number').val('');
            $('#new_phone_number').val('');
            $('#reenter_phone_number').val('');
            $('#changePhoneModal').modal('hide');
        });
        $('#btn_change_phone_confirm').click(function () {
            let c_phone = $('#current_phone_number').val().replace(/ /g, '');;
            let n_phone = $('#new_phone_number').val().replace(/ /g, '');;
            let r_phone = $('#reenter_phone_number').val().replace(/ /g, '');;
            if (c_phone === '' || n_phone === '' || r_phone === '') {
                return;
            }
            if (n_phone !== r_phone) {
                $('#err_change_phone3').css('display', 'block');
                setTimeout(function () {
                    $('#err_change_phone3').css('display', 'none');
                },3000);
            } else {
                $.ajax({
                    url: '/user.changePhone',
                    headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                    data: {
                        new_phone: n_phone
                    },
                    type: 'POST',
                    success: function (data) {
                        if (data.msg === "ok") {
                            changePhoneMessage($('#new_phone_number').val());
                            $('#current_phone_number').val('');
                            $('#new_phone_number').val('');
                            $('#reenter_phone_number').val('');
                            $('#changePhoneModal').modal('hide');
                        } else {
                            $('#new_phone_number').val('');
                            $('#reenter_phone_number').val('');
                            $('#err_change_phone2').css('display', 'block');
                            setTimeout(function () {
                                $('#err_change_phone2').css('display', 'none');
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
<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/modals/edit-phone-modal.blade.php ENDPATH**/ ?>