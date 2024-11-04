<!-- Add User Modal-->
<div class="modal fade" id="currentOrderModal" tabindex="-1" role="dialog" aria-labelledby="currentOrderModalLabel"
     aria-hidden="true">
    <div class="modal-dialog add-user" role="document">
        <div class="modal-content" style="width: 22rem;">
            <div class="modal-header">
                <h6 class="modal-title w-100" id="currentOrderModalLabel" style="text-align: center;"></h6>
            </div>
            <div class="modal-body p-0" style="height: 22rem;">
                <div style="overflow-x: hidden; overflow-y: auto; height: 45%;">
                    <table class="table user-page-table" id="sell_table" style="font-size: 0.75rem;">
                        <tbody id="current_order_sell">

                        </tbody>
                    </table>
                </div>
                <div style="width: 100%; height: 10%; background-color: #0c0c0c; opacity: 40%; color: #ffffff; padding: 0.4rem; top: 50%; text-align: center;">
                    <span><?php echo e(__('userpage.current_price')); ?>: $ </span>
                    <span id="show_current_price"></span>
                </div>
                <div style="overflow-x: hidden; overflow-y: auto; height: 45%;">
                    <table class="table user-page-table" id="buy_table" style="font-size: 0.75rem;">
                        <tbody id="current_order_buy">

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer" style="justify-content: center;">
                <div id="btn_order_confirm" class="btn btn-confirm d-flex justify-content-center align-items-center" style="width: 150px; height: 30px; font-size: 0.9rem;">
                    <?php echo e(__('userpage.confirm')); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/modals/current-order-modal.blade.php ENDPATH**/ ?>