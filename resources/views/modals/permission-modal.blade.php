<!-- Add User Modal-->
<div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="permissionModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="permissionModal" style="text-align: center;">{{ __('userpage.permission') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center align-items-center mb-3">
                        <div class="col-5">
                            <input class="radio-group" type="radio" name="radioPermission" id="using-permission_5" value="5" checked />
                            <span class="radio-group" id="radio-text_5">{{ __('userpage.investor') }}</span>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center align-items-center mb-3">
                        <div class="col-5">
                            <input class="radio-group" type="radio" name="radioPermission" id="using-permission_4" value="4" />
                            <span class="radio-group" id="radio-text_4">{{ __('userpage.revenue_manager') }}</span>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center align-items-center mb-3">
                        <div class="col-5">
                            <input class="radio-group" type="radio" name="radioPermission" id="using-permission_3" value="3" />
                            <span class="radio-group" id="radio-text_3">{{ __('userpage.agent_manager') }}</span>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center align-items-center mb-3">
                        <div class="col-5">
                            <input class="radio-group" type="radio" name="radioPermission" id="using-permission_2" value="2" />
                            <span class="radio-group" id="radio-text_2">{{ __('userpage.manager') }}</span>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <div class="col-5">
                            <input class="radio-group" type="radio" name="radioPermission" id="using-permission_1" value="1" />
                            <span class="radio-group" id="radio-text_1">{{ __('userpage.general_manager') }}</span>
                        </div>
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
    let user_num = 0;
    let p_idx = 5;
    $(document).ready(function () {
        $('span[id^="radio-text_"]').click(function () {
            //$('.radioPermission').prop('checked', false);
            let oid=$(this).attr("id");
            p_idx = oid.split('_')[1];
            $('#using-permission_'+p_idx).prop('checked', true);
        });

        $('input[id^="using-permission_"]').click(function(){
            let oid=$(this).attr("id");
            p_idx = oid.split('_')[1];
        });

        $('#btn_modal_confirm').click(function(){
            let permission = $("input[name='radioPermission']:checked").val();

            $.ajax({
                url: '/admin.setPermisssion',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                data: {
                    permission: p_idx,
                    user_num: user_num
                },
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#permissionModal').modal('hide');
                        showTableList();
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        });

        $('#permissionModal').on('hidden.bs.modal', function () {
            permission_idx = 5;
            user_num = 0;
            $(".radioPermission").prop( "checked", false );
        })

    });

    function setAssignPermissions(num, p) {
        user_num = num;
        $('#using-permission_'+p).prop('checked', true);

        $('#permissionModal').modal('show');
    }
</script>
