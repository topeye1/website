<!-- Add User Modal-->
<div class="modal fade" id="pointPayingConfirmModal" tabindex="-1" role="dialog" aria-labelledby="pointPayingConfirmModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="pointPayingConfirmModal" style="text-align: center;">{{ __('userpage.paying_point') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3 d-flex justify-content-center">
                    <div class="col-4 d-flex justify-content-center">
                        <div class="d-flex mr-1">{{ __('userpage.user_number') }} : </div>
                        <div class="d-flex" id="sel_user_number"></div>
                    </div>
                    <div class="col-5 d-flex justify-content-center">
                        <div class="d-flex mr-1">{{ __('userpage.name') }} : </div>
                        <div class="d-flex" id="sel_user_name"></div>
                    </div>
                </div>
                <div class="row mb-1 justify-content-center">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="d-flex mr-1">{{ __('userpage.points_pay') }} : </div>
                        <div class="d-flex mr-1" id="sel_user_point"></div>
                        <div class="d-flex">{{ __('userpage.points') }}</div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="d-flex">{{ __('userpage.paying_ask') }}</div>
                    </div>
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
    $(document).ready(function () {
        $('#btn_modal_confirm').click(function(){
            $.ajax({
                url: '/admin.payingPoints',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    point: point_count,
                    user_num: sel_user_num
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#pointPayingConfirmModal').modal('hide');
                        showTableList();
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        });

        $('#pointPayingConfirmModal').on('hidden.bs.modal', function () {
            sel_user_num = 0;
            sel_user_name = '';
            point_count = '';
        })

    });

    function showPointPayingConfirmModal() {
        $('#sel_user_number').text(sel_user_num);
        $('#sel_user_name').text(sel_user_name);
        $('#sel_user_point').text(point_count);
        $('#pointPayingConfirmModal').modal('show');
    }

</script>
