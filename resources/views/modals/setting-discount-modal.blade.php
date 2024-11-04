<!-- Add User Modal-->
<div class="modal fade" id="settingDiscountModal" tabindex="-1" role="dialog" aria-labelledby="settingDiscountModalLabel"
     aria-hidden="true">
    <div class="modal-dialog add-user" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title w-100" id="settingDiscountModalLabel" style="text-align: center;">{{ __('userpage.fee_setting') }}</h6>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center mb-3">
                    <h5  id="settingDiscountModalLabel" style="text-align: center;">
                        <span>{{ __('userpage.my_fee_discount_rate') }}:</span>
                        <span id="my_fee_discount">0</span>
                        <span>%</span>
                    </h5>
                </div>

                <div class="row justify-content-center" id="total_friend_discount" style="display: flex">
                    <div style="width: 8rem;">{{ __('userpage.friends_discount') }}</div>
                </div>
                <div class="row justify-content-center" id="every_friend_discount" style="display: none">
                    <span id="every_friend_name"></span>
                    <span>{{ __('userpage.discount_rate') }}</span>
                </div>
                <div class="row justify-content-center align-items-center" id="every_friend_discount">
                    <input type="number" class="form-control form-control-user my-input" id="input_discount_rate" max="100" min="0" style="width: 100px;">
                    <span class="ml-2">%</span>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <div id="btn_setting_discount_cancel" class="btn btn-user my-middle-btn btn-block mr-5" style="width: 150px;">
                    {{ __('userpage.cancel') }}
                </div>
                <div id="btn_setting_discount_confirm" class="btn btn-confirm d-flex justify-content-center align-items-center" style="width: 150px; height: 30px; font-size: 0.9rem;">
                    {{ __('userpage.confirm') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let discount_target = 0;
    $(document).ready(function () {
        $('#btn_setting_discount_cancel').click( function () {
            $('#settingDiscountModal').modal('hide');
        });
        $('#btn_setting_discount_confirm').click( function () {
            let discount_rate = $('#input_discount_rate').val();
            $.ajax({
                url: '/user.friendDiscount',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    friend_num: discount_target,
                    discount_rate: discount_rate,
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#settingDiscountModal').modal('hide');
                        showFriendTableList();
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        });

        $('#input_discount_rate').change(function(){
            let val = $('#input_discount_rate').val();
            if (parseInt(val) > 100) {
                $('#input_discount_rate').val(100);
            }
            if (val < 0) {
                $('#input_discount_rate').val(0);
            }
        });

        $('#settingDiscountModal').on('hidden.bs.modal', function () {
            $('#input_discount_rate').val('');
        })

    });

    function settingDiscountRate(target) {
        discount_target = target;
        $('#my_fee_discount').text(my_fee)
        $('#settingDiscountModal').modal('show');
    }

</script>
