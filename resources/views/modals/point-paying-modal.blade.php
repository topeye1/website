<!-- Add User Modal-->
<div class="modal fade" id="pointPayingModal" tabindex="-1" role="dialog" aria-labelledby="pointPayingModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="d-flex mr-3">{{ __('userpage.paying_point_count') }}</div>
                    <input type="number" class="form-control form-control-user my-input mr-3" name="input_point_count" id="input_point_count" style="width: 35%;" min="0">
                    <div id="btn-point-paying" class="btn btn-success m-1 pt-1 pb-1" style="background-color: #e3a90d; border-color: #c5920a; color: #fff;">{{ __('userpage.paying') }}</div>
                </div>
                <div class="error-text text-center" id="error_input_points" style="display: none">{{ __('userpage.err_input_points') }}</div>
            </div>
        </div>
    </div>
</div>

<script>
    let sel_user_num = 0;
    let sel_user_name = '';
    let point_count = '';
    $(document).ready(function () {
        $('#input_point_count').change(function(){
            let val = $('#input_point_count').val();
            if (val < 0) {
                $('#input_point_count').val(0);
            }
        });
        $('#btn-point-paying').click(function(){
            point_count = $('#input_point_count').val();
            if (point_count === "") {
                $('#error_input_points').css('display', 'block');
                return;
            }
            $('#pointPayingModal').modal('hide');
            showPointPayingConfirmModal();
        });

        $('#pointPayingModal').on('hidden.bs.modal', function () {
            $('#error_input_points').css('display', 'none');
            $('#input_point_count').val('');
        })

    });

    function showPointPayingModal(num, name) {
        sel_user_num = num;
        sel_user_name = name;
        $('#pointPayingModal').modal('show');
    }
</script>
