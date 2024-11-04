<div id="setting_api_add" style="display:none;">
    <div class="row justify-content-center">
        <img class="tab_logo" id="api_logo_bin" src="{{URL::asset('assets/img/pngs/binance-2.png')}}" style="display:none;">
        <img class="tab_logo" id="api_logo_htx" src="{{URL::asset('assets/img/pngs/htx-2.png')}}" style="display:none;">
    </div>
    <div class="row justify-content-center align-items-center mt-3" style="width: 70%; margin: 0 auto;">
        <div class="col-3">{{ __('userpage.api_key') }}</div>
        <div class="col-9">
            <div class="d-inline-block" style="width: 90%">
                <input type="password" class="form-control form-control-user my-input" name="input_api_key" id="input_api_key">
            </div>
            <div class="hidden_api_key" id="hidden_api_key" style="display: inline-block"><i class="fas fa-light fa-eye-slash"></i></div>
            <div class="show_api_key" id="show_api_key" style="display: none"><i class="fas fa-light fa-eye"></i></div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center mt-3" style="width: 70%; margin: 0 auto;">
        <div class="col-3">{{ __('userpage.secret_key') }}</div>
        <div class="col-9">
            <div class="d-inline-block" style="width: 90%">
                <input type="password" class="form-control form-control-user my-input" name="input_secret_key" id="input_secret_key">
            </div>
            <div class="hidden_secret_key" id="hidden_secret_key" style="display: inline-block"><i class="fas fa-light fa-eye-slash"></i></div>
            <div class="show_secret_key" id="show_secret_key" style="display: none"><i class="fas fa-light fa-eye"></i></div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center mt-3">
        <div id="btn_key_confirm" class="btn btn-confirm" >{{ __('userpage.confirm') }}</div>
    </div>
    <div class="row mt-5 mb-3" style="margin: 0">
        <div class="col-12 d-flex justify-content-center">
            <img src="{{URL::asset('assets/img/pngs/ex_apiKey.png')}}" style="display:block;">
        </div>

    </div>
</div>
<div id="setting_api_list" style="display:none;">
    <div class="col-12">
        <div class="row justify-content-center">
            <img class="tab_logo" id="api_list_logo_bin" src="{{URL::asset('assets/img/pngs/binance-2.png')}}" style="display:none;">
            <img class="tab_logo" id="api_list_logo_htx" src="{{URL::asset('assets/img/pngs/htx-2.png')}}" style="display:none;">
        </div>
    </div>
    <div class="col-12 mb-3 d-flex justify-content-end" style="margin-top: -2.5rem;">
        <div id="btn_key_add" class="btn btn-confirm" style="width: 150px;">{{ __('userpage.add_api') }}</div>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-bordered user-page-table" id="keysTable">
                <thead>
                <tr>
                    <th>{{ __('userpage.number') }}</th>
                    <th>{{ __('userpage.category') }}</th>
                    <th>{{ __('userpage.input_date') }}</th>
                    {{--<th>{{ __('userpage.edit') }}</th>--}}
                    <th>{{ __('userpage.delete') }}</th>
                </tr>
                </thead>
                <tbody id="tbody_key_list">


                </tbody>
            </table>
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
                    $('#tbody_key_list').html('');
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
                            if (i % 2 === 1) {
                                tags += '<tr style="background-color: #F0F1F4;">';
                            } else {
                                tags += '<tr>';
                            }
                            tags += '<td class="text-nowrap align-middle">' + num + '</td>';
                            tags += '<td class="text-nowrap align-middle">' + list.key_name + '</td>';
                            tags += '<td class="text-nowrap align-middle">' + list.create_date + '</td>';
                            //tags += '<td class="text-nowrap align-middle">';
                            //tags += '<div id="btn-edit" class="btn btn-user my-middle-btn btn-block" onclick="onKeyEdit('+kid+',\''+api_key+'\',\''+secret_key+'\')">' + '{{ __('userpage.edit') }}' + '</div>';
                            //tags += '</td>';
                            tags += '<td class="text-nowrap align-middle">';
                            tags += '<div id="btn-delete_'+kid+'" class="btn btn-user my-middle-btn btn-block">' + '{{ __('userpage.delete') }}' + '</div>';
                            tags += '</td>';
                            tags += '</tr>';
                        }
                        $('#tbody_key_list').html(tags);

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
