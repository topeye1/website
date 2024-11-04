<!-- Add User Modal-->
<div class="modal fade" id="settingTradeModal" tabindex="-1" role="dialog" aria-labelledby="settingTradeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog add-user" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="settingTradeModalLabel" style="text-align: center;"><?php echo e(__('userpage.warning')); ?></h5>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center align-items-center"><?php echo e(__('userpage.warning_content1')); ?></div>
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
<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/modals/setting-trade-modal.blade.php ENDPATH**/ ?>