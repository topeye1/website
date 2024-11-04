<!-- Add User Modal-->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
     aria-hidden="true">
    <div class="modal-dialog add-user" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="addModalLabel" style="text-align: center;">{{ __('userpage.add_user') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 pr-3">
                                <div class="row align-items-center">
                                    <div class="col-3">{{ __('userpage.id') }}</div>
                                    <div class="col-9">
                                        <input type="email" class="form-control form-control-user my-input" name="input_id" id="input_id">
                                        <div class="error-text" id="error_id" style="display: none">{{ __('userpage.id_des') }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-3">{{ __('userpage.phone') }}</div>
                                    <div class="col-9">
                                        <input type="text" class="form-control form-control-user my-input" name="input_phone" id="input_phone">
                                        <div class="error-text" id="error_phone" style="display: none">{{ __('userpage.error_phone') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 pr-3">
                                <div class="row align-items-center">
                                    <div class="col-3">{{ __('userpage.name') }}</div>
                                    <div class="col-9">
                                        <input type="text" class="form-control form-control-user my-input" name="input_name" id="input_name">
                                        <div class="error-text" id="error_name" style="display: none">{{ __('userpage.error_name') }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-3">{{ __('userpage.level') }}</div>
                                    <div class="col-9">
                                        <input type="number" class="form-control form-control-user my-input" name="input_level" id="input_level" max="8" min="0" value="1">
                                        <div class="error-text" id="error_level" style="display: none">{{ __('userpage.error_level') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 pr-3">
                                <div class="row align-items-center">
                                    <div class="col-3">{{ __('userpage.password') }}</div>
                                    <div class="col-9">
                                        <div class="d-inline-block" style="width: 90%">
                                            <input type="password" class="form-control form-control-user my-input" name="input_pwd" id="input_pwd">
                                            <div class="error-text" id="error_pwd" style="display: none">{{ __('userpage.error_pwd') }}</div>
                                        </div>
                                        <div class="hidden_pwd" id="hidden_pwd" style="display: inline-block"><i class="fas fa-light fa-eye-slash"></i></div>
                                        <div class="show_pwd" id="show_pwd" style="display: none"><i class="fas fa-light fa-eye"></i></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-3">{{ __('userpage.confirm_pwd') }}</div>
                                    <div class="col-9">
                                        <div class="d-inline-block" style="width: 90%">
                                            <input type="password" class="form-control form-control-user my-input" name="input_confirm_pwd" id="input_confirm_pwd">
                                            <div class="error-text" id="error_conf_pwd" style="display: none">{{ __('userpage.dont_match_pwd') }}</div>
                                        </div>
                                        <div class="hidden_conf_pwd" id="hidden_conf_pwd" style="display: inline-block"><i class="fas fa-light fa-eye-slash"></i></div>
                                        <div class="show_conf_pwd" id="show_conf_pwd" style="display: none"><i class="fas fa-light fa-eye"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row w-100 mb-3 pl-3 pr-3 justify-content-start">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 pr-3">
                                <div class="row align-items-center">
                                    <div class="col-3">{{ __('userpage.fee_rate') }}</div>
                                    <div class="col-9">
                                        <input type="number" class="form-control form-control-user my-input" name="input_fee" id="input_fee" max="100" min="0">
                                        <div class="error-text" id="error_fee" style="display: none">{{ __('userpage.error_fee') }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-9">
                                        <div class="d-flex align-items-center">
                                            <div class="d-inline-block">
                                                <input class="form-control active-checked" type="checkbox" id="actived_check">
                                            </div>
                                            <div class="d-inline-block ml-3">{{ __('userpage.actived') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" id="btn_user_modal_cancel">{{ __('userpage.cancel') }}</button>
                <a class="btn btn-primary" href="#" id="btn_modal_add" style="display: block;">{{ __('userpage.add') }}</a>
                <a class="btn btn-primary" href="#" id="btn_modal_edit" style="display: none;">{{ __('userpage.edit') }}</a>
            </div>
        </div>
    </div>
</div>

<script>
    let user_num = 0;
    $(document).ready(function () {
        $('#input_level').change(function(){
            let val = $('#input_level').val();
            if (parseInt(val) > 8) {
                $('#input_level').val(8);
            }
            if (val < 0) {
                $('#input_level').val(0);
            }
        });
        $('#input_fee').change(function(){
            let val = $('#input_fee').val();
            if (parseInt(val) > 100) {
                $('#input_fee').val(100);
            }
            if (val < 0) {
                $('#input_fee').val(0);
            }
        });
        $('#show_pwd').click(function(){
            $('#show_pwd').css('display', 'none');
            $('#hidden_pwd').css('display', 'inline-block');
            $('#input_pwd').attr("type", 'password');
        });
        $('#hidden_pwd').click(function(){
            $('#hidden_pwd').css('display', 'none');
            $('#show_pwd').css('display', 'inline-block');
            $('#input_pwd').attr("type", 'text');
        });
        $('#show_conf_pwd').click(function(){
            $('#show_conf_pwd').css('display', 'none');
            $('#hidden_conf_pwd').css('display', 'inline-block');
            $('#input_confirm_pwd').attr("type", 'password');
        });
        $('#hidden_conf_pwd').click(function(){
            $('#hidden_conf_pwd').css('display', 'none');
            $('#show_conf_pwd').css('display', 'inline-block');
            $('#input_confirm_pwd').attr("type", 'text');
        });

        $('#btn_modal_add').click(function(){
            let id = $('#input_id').val().replace(/ /g, '');
            let password = $('#input_pwd').val().replace(/ /g, '');
            let check_password = $('#input_confirm_pwd').val().replace(/ /g, '');
            let name = $('#input_name').val().replace(/ /g, '');
            let phone = $('#input_phone').val().replace(/ /g, '');
            let level = $('#input_level').val().replace(/ /g, '');
            let fee = $('#input_fee').val().replace(/ /g, '');
            let checked = $('#actived_check');

            if(id === "") {
                $('#error_id').css('display', 'block');
                return;
            }
            if(phone === "") {
                $('#error_phone').css('display', 'block');
                return;
            }
            if(name === "") {
                $('#error_name').css('display', 'block');
                return;
            }
            if(parseInt(level) < 1 || parseInt(level) > 8) {
                $('#error_level').css('display', 'block');
                return;
            }
            if(password === "") {
                $('#error_pwd').css('display', 'block');
                return;
            }
            if(check_password === "") {
                $('#error_conf_pwd').css('display', 'block');
                return;
            }
            if(fee === "") {
                $('#error_fee').css('display', 'block');
                return;
            }

            let form_data = new FormData();
            form_data.append('user_id', id);
            form_data.append('user_pwd', password);
            form_data.append('user_name', name);
            form_data.append('user_phone', phone);
            form_data.append('user_level', level);
            form_data.append('user_fee', fee);
            form_data.append('user_active', checked[0].checked);

            $.ajax({
                url: '/admin.addNewUser',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#addUserModal').modal('hide');
                        showTableList();
                    }
                    else if(data.msg === "du"){
                        alert("User ID that already exists.");
                    }
                    else{
                        alert(" don't know -> " + data);
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        });

        $('#btn_modal_edit').click(function(){
            let id = $('#input_id').val().replace(/ /g, '');
            let password = $('#input_pwd').val().replace(/ /g, '');
            let check_password = $('#input_confirm_pwd').val().replace(/ /g, '');
            let name = $('#input_name').val().replace(/ /g, '');
            let phone = $('#input_phone').val().replace(/ /g, '');
            let level = $('#input_level').val().replace(/ /g, '');
            let fee = $('#input_fee').val().replace(/ /g, '');
            let checked = $('#actived_check').prop('checked');

            if(id === "") {
                $('#error_id').css('display', 'block');
                return;
            }
            if(phone === "") {
                $('#error_phone').css('display', 'block');
                return;
            }
            if(name === "") {
                $('#error_name').css('display', 'block');
                return;
            }
            if(parseInt(level) < 1 || parseInt(level) > 8) {
                $('#error_level').css('display', 'block');
                return;
            }
            if(password === "") {
                $('#error_pwd').css('display', 'block');
                return;
            }
            if(check_password === "") {
                $('#error_conf_pwd').css('display', 'block');
                return;
            }
            if(fee === "") {
                $('#error_fee').css('display', 'block');
                return;
            }

            let form_data = new FormData();
            form_data.append('user_id', id);
            form_data.append('user_pwd', password);
            form_data.append('user_name', name);
            form_data.append('user_phone', phone);
            form_data.append('user_level', level);
            form_data.append('user_fee', fee);
            form_data.append('user_active', checked);
            form_data.append('user_num', user_num);

            $.ajax({
                url: '/admin.setEditUser',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#addUserModal').modal('hide');
                        showTableList();
                    }
                    else if(data.msg === "du"){
                        alert("User ID that already exists.");
                    }
                    else{
                        alert(" don't know -> " + data);
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        });

        $('#addUserModal').on('hidden.bs.modal', function () {
            $('#show_pwd').css('display', 'none');
            $('#hidden_pwd').css('display', 'inline-block');
            $('#show_conf_pwd').css('display', 'none');
            $('#hidden_conf_pwd').css('display', 'inline-block');
            $('#input_id').val('');
            $('#input_phone').val('');
            $('#input_name').val('');
            $('#input_level').val('1');
            $('#input_pwd').val('');
            $('#input_confirm_pwd').val('');
            $('#input_fee').val('');
            $('#actived_check').val('');
            $('#error_id').css('display', 'none');
            $('#error_phone').css('display', 'none');
            $('#error_name').css('display', 'none');
            $('#error_level').css('display', 'none');
            $('#error_pwd').css('display', 'none');
            $('#error_conf_pwd').css('display', 'none');
            $('#error_fee').css('display', 'none');
            user_num = 0;
        })

    });

    function setEditUserInfo(num, id, phone, name, level, fee, checked) {
        $('#addModalLabel').text('{{ __('userpage.edit_user') }}');
        $('#btn_modal_add').css('display', 'none');
        $('#btn_modal_edit').css('display', 'block');

        user_num = num;
        $('#input_id').val(id);
        $('#input_phone').val(phone);
        $('#input_name').val(name);
        $('#input_level').val(level);
        $('#input_fee').val(fee);
        if (checked === 'checked')
            $('#actived_check').prop("checked", true);
        else
            $('#actived_check').prop("checked", false);

        $('#addUserModal').modal('show');
    }
</script>
