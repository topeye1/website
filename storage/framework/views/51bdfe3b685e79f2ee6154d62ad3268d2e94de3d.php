<!-- Add User Modal-->
<div class="modal fade" id="settingFeeModal" tabindex="-1" role="dialog" aria-labelledby="settingFeeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog add-user" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title w-100" id="settingFeeModalLabel" style="text-align: center;"><?php echo e(__('userpage.fee_setting')); ?></h6>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <h5  id="settingFeeModalLabel" style="text-align: center;">
                        <span><?php echo e(__('userpage.my_fee_discount_rate')); ?>:</span>
                        <span id="my_fee_discount"></span>
                        <span>%</span>
                    </h5>
                </div>

                <div class="row justify-content-center align-items-center"><?php echo e(__('userpage.warning_content2')); ?></div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <div id="btn_setting_trade_cancel" class="btn btn-user my-middle-btn btn-block" style="width: 150px;">
                    <?php echo e(__('userpage.cancel')); ?>

                </div>
                <div id="btn_setting_trade_confirm" class="btn btn-confirm d-flex justify-content-center align-items-center" style="width: 150px; height: 30px; font-size: 0.9rem;">
                    <?php echo e(__('userpage.confirm')); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/modals/setting-fee-modal.blade.php ENDPATH**/ ?>