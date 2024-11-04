<!-- Add User Modal-->
<div class="modal fade" id="agentFeeModal" tabindex="-1" role="dialog" aria-labelledby="agentFeeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="agentFeeModal" style="text-align: center;">{{ __('userpage.agent_discount_rate') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="number" class="form-control form-control-user my-input w-25 text-center" name="input_fee_rate" id="input_fee_rate" max="100" min="0">
                        <i class="fee_rate_percent">%</i>
                    </div>
                    <div class="error-text" id="error_fee_rate" style="display: none">{{ __('userpage.err_input_fee') }}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" id="btn_modal_cancel">{{ __('userpage.cancel') }}</button>
                <a class="btn btn-primary" href="#" id="btn_modal_confirm">{{ __('userpage.confirm') }}</a>
            </div>
        </div>
    </div>
</div>

<script>
    let user_num = 0;
    $(document).ready(function () {
        $('#input_fee_rate').change(function(){
            let val = $('#input_fee_rate').val();
            if (parseInt(val) > 100) {
                $('#input_fee_rate').val(100);
            }
            if (val < 0) {
                $('#input_fee_rate').val(0);
            }
        });
        $('#btn_modal_confirm').click(function(){
            let fee_rate = $('#input_fee_rate').val().replace(/ /g, '');

            if(fee_rate === "") {
                $('#error_fee_rate').css('display', 'block');
                return;
            }

            $.ajax({
                url: '/admin.addAgent',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    fee_rate: fee_rate,
                    user_num: user_num
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#agentFeeModal').modal('hide');
                        showTableList();
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        });

        $('#agentFeeModal').on('hidden.bs.modal', function () {
            $('#error_fee_rate').css('display', 'none');
            $('#input_fee_rate').val('');
            user_num = 0;
        })

    });

    function setAgentFeeRateInfo(num) {
        user_num = num;
        $('#input_fee_rate').val('20');

        $('#agentFeeModal').modal('show');
    }
</script>
