<div id="setting_api_add" style="display:none;">
    <div class="row justify-content-center">
        <img class="tab_logo" id="api_logo_bin" src="<?php echo e(URL::asset('assets/img/pngs/binance-2.png')); ?>" style="display:none;">
        <img class="tab_logo" id="api_logo_htx" src="<?php echo e(URL::asset('assets/img/pngs/htx-2.png')); ?>" style="display:none;">
    </div>

    <div class="pl-3 pr-3 mt-3">
        <div><?php echo e(__('userpage.api_key')); ?></div>
        <div>
            <div class="d-inline-block" style="width: 90%">
                <input type="password" class="form-control form-control-user my-input" name="input_api_key" id="input_api_key">
            </div>
            <div class="hidden_api_key" id="hidden_api_key" style="display: inline-block"><i class="fas fa-light fa-eye-slash"></i></div>
            <div class="show_api_key" id="show_api_key" style="display: none"><i class="fas fa-light fa-eye"></i></div>
        </div>
    </div>
    <div class="pl-3 pr-3 mt-3">
        <div><?php echo e(__('userpage.secret_key')); ?></div>
        <div>
            <div class="d-inline-block" style="width: 90%">
                <input type="password" class="form-control form-control-user my-input" name="input_secret_key" id="input_secret_key">
            </div>
            <div class="hidden_secret_key" id="hidden_secret_key" style="display: inline-block"><i class="fas fa-light fa-eye-slash"></i></div>
            <div class="show_secret_key" id="show_secret_key" style="display: none"><i class="fas fa-light fa-eye"></i></div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center mt-3">
        <div id="btn_key_confirm" class="btn btn-confirm" ><?php echo e(__('userpage.confirm')); ?></div>
    </div>
    <div class="mt-5 mb-3">
        <img src="<?php echo e(URL::asset('assets/img/pngs/ex_apiKey.png')); ?>" style="display:block; width: 100%;">
    </div>
</div>
<div id="setting_api_list" style="display:none; height: 100%;">
    <div class="col-12">
        <div class="row justify-content-center">
            <img class="tab_logo" id="api_list_logo_bin" src="<?php echo e(URL::asset('assets/img/pngs/binance-2.png')); ?>" style="display:none;">
            <img class="tab_logo" id="api_list_logo_htx" src="<?php echo e(URL::asset('assets/img/pngs/htx-2.png')); ?>" style="display:none;">
        </div>
    </div>
    <div class="col-12 mt-3 mb-3 d-flex justify-content-end">
        <div id="btn_key_add" class="btn btn-confirm" style="width: 100px;"><?php echo e(__('userpage.add_api')); ?></div>
    </div>
    <div class="col-12" style="background-color: #e3e6f0; height: 100%;">
        <div id="api_list_view" style="padding-top: 0.5rem; font-size: 0.75rem;">

        </div>
    </div>
</div>

<script>
    function initKeyValue() {
        $('#input_api_key').val('');
        $('#input_secret_key').val('');
        $('#show_api_key').css('display', 'none');
        $('#hidden_api_key').css('display', 'inline-block');
        $('#input_api_key').attr("type", 'password');
        $('#show_secret_key').css('display', 'none');
        $('#hidden_secret_key').css('display', 'inline-block');
        $('#input_secret_key').attr("type", 'password');
        key_status = 0;
        edit_key_id = 0;
    }
    function inputApiKey() {
        let api_key = $('#input_api_key').val();
        let secret_key = $('#input_secret_key').val();
        if (api_key === '' || secret_key === '') {
            return;
        }
        $.ajax({
            url: '/user.inputKey',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                api_key: api_key,
                secret_key: secret_key,
                market: market,
                key_name: 'API Key'
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    getApiKeyList();
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }
    function editApiKey() {
        let api_key = $('#input_api_key').val();
        let secret_key = $('#input_secret_key').val();
        if (api_key === '' || secret_key === '') {
            return;
        }
        $.ajax({
            url: '/user.editKey',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                api_key: api_key,
                secret_key: secret_key,
                kid: edit_key_id
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    getApiKeyList();
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }
    function getApiKeyList() {
        if (market === 'bin') {
            $('#api_logo_bin').css('display', 'block');
            $('#api_logo_htx').css('display', 'none');
            $('#api_list_logo_bin').css('display', 'block');
            $('#api_list_logo_htx').css('display', 'none');
        } else {
            $('#api_logo_bin').css('display', 'none');
            $('#api_logo_htx').css('display', 'block');
            $('#api_list_logo_bin').css('display', 'none');
            $('#api_list_logo_htx').css('display', 'block');
        }

        initKeyValue();
        $.ajax({
            url: '/user.keyList',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                market: market,
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    $('#api_list_view').html('');
                    if (data.lists.length > 0) {
                        $('#setting_api_add').css('display', 'none');
                        $('#setting_api_list').css('display', 'block');
                        let lists = data.lists;
                        let tags = '';
                        for (let i = 0; i < lists.length; i++) {
                            let num = i + 1;
                            let list = lists[i];
                            let kid = list.kid;
                            let api_key = list.api_key;
                            let secret_key = list.secret_key;


                            tags += '<div style="background-color: white; border-radius: 0.2rem; padding: 1rem; margin: 0 auto; margin-top: 0.7rem;">';
                            tags += '    <div class="row m-0 mb-2" style="border-bottom: 1px solid #e3e6f0;">';
                            tags += '        <div class="col-5 p-0"><?php echo e(__('userpage.number')); ?></div>';
                            tags += '        <div class="col-7 p-0 d-flex justify-content-end">'+num+'</div>';
                            tags += '    </div>';
                            tags += '    <div class="row m-0 mb-2" style="border-bottom: 1px solid #e3e6f0;">';
                            tags += '        <div class="col-5 p-0"><?php echo e(__('userpage.category')); ?></div>';
                            tags += '        <div class="col-7 p-0 d-flex justify-content-end">'+list.key_name+'</div>';
                            tags += '    </div>';
                            tags += '    <div class="row m-0 mb-2" style="border-bottom: 1px solid #e3e6f0;">';
                            tags += '        <div class="col-5 p-0"><?php echo e(__('userpage.input_date')); ?></div>';
                            tags += '        <div class="col-7 p-0 d-flex justify-content-end">'+list.create_date+'</div>';
                            tags += '    </div>';
                            tags += '    <div class="row m-0">';
                            tags += '        <div class="col-5 p-0"><?php echo e(__('userpage.delete')); ?></div>';
                            tags += '        <div class="col-7 p-0 d-flex justify-content-end">';
                            tags += '           <div id="btn-delete_'+kid+'" class="btn btn-user my-middle-btn btn-block" style="height: 22px; font-size: 0.75rem; width:50%;">' + '<?php echo e(__('userpage.delete')); ?>' + '</div>';
                            tags += '        </div>';
                            tags += '    </div>';
                            tags += '</div>';
                        }
                        $('#api_list_view').html(tags);

                        $('div[id^="btn-delete_"]').click(function(){
                            let oid=$(this).attr("id");
                            let key_num = oid.split('_')[1];
                            onKeyDelete(key_num);
                        });

                    } else {
                        $('#setting_api_add').css('display', 'block');
                        $('#setting_api_list').css('display', 'none');
                    }
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }

    function onKeyEdit(kid, api_key, secret_key) {
        key_status = 1;
        edit_key_id = kid;
        $('#input_api_key').val(api_key);
        $('#input_secret_key').val(secret_key);
        $('#setting_api_add').css('display', 'block');
        $('#setting_api_list').css('display', 'none');
    }
    function onKeyDelete(kid) {
        $.ajax({
            url: '/user.deleteKey',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                kid: kid
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    getApiKeyList();
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }
</script>
<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/user_mobile/user-setting-api-view.blade.php ENDPATH**/ ?>