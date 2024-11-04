@extends('layouts.mobile_user')
@section('content')
    <div id="settings-card-pc">
        <div class="settings-card-header justify-content-center notice-card-header mt-3" style="display: flex;">
            <ul class="nav nav-underline mt-3" style="font-size: 16px">
                <li class="nav-item">
                    <a class="nav-link active" id="link-settings-api" style="padding: 0.2rem 1rem !important;" data-set="api" href="#">{{ __('userpage.api') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="link-settings-trade" style="padding: 0.2rem 1rem !important;" data-set="trade" href="#">{{ __('userpage.trade') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="link-settings-coin" style="padding: 0.2rem 1rem !important;" data-set="coin" href="#">{{ __('userpage.coin') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="link-settings-normal" style="padding: 0.2rem 1rem !important;" data-set="normal" href="#">{{ __('userpage.normal') }}</a>
                </li>
            </ul>
        </div>

        <div class="settings-card-body d-flex justify-content-center">
            <div class="mt-3" id="setting_api" style="display:block; width: 100%">
                @include('user_mobile.user-setting-api-view')
            </div>

            <div class="mt-3" id="setting_trade" style="display:none; width: 90%">
                @include('user_mobile.user-setting-trade-view')
            </div>

            <div class="mt-3" id="setting_coin" style="display:none; width: 100%; font-size: 0.85rem;">
                @include('user_mobile.user-setting-coin-view')
            </div>

            <div class="mt-3" id="setting_normal" style="display:none; width: 100%">
                @include('user_mobile.user-setting-normal-view')
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        let key_status = 0;
        let edit_key_id = 0;
        let trade_money = 0; //1회 최대 거래 금액
        let leverage = 0; // 거래 레버리지
        let profit_range = 0; // 거래 당 수익범위
        let liquidation_range = 0; // 거래 당 청산범위
        let t_idx = 0;
        let l_idx = 0;
        let pr_idx = 0;
        let lr_idx = 0;

        $(document).ready(function () {
            getMyInfo();
            $('.settings-card-header .nav-link').click(function(){
                $('.settings-card-header .nav-link').attr('class','nav-link');
                $(this).attr('class','nav-link active');

                let data_set = $(this).attr('data-set');
                if(data_set === 'api') {
                    $('#setting_api').css({'display':'block'});
                    $('#setting_trade').css({'display':'none'});
                    $('#setting_coin').css({'display':'none'});
                    $('#setting_normal').css({'display':'none'});
                    getApiKeyList();
                }
                else if(data_set === 'trade') {
                    $('#setting_api').css({'display':'none'});
                    $('#setting_trade').css({'display':'block'});
                    $('#setting_coin').css({'display':'none'});
                    $('#setting_normal').css({'display':'none'});
                    getTradeValues();
                }
                else if(data_set === 'coin') {
                    $('#setting_api').css({'display':'none'});
                    $('#setting_trade').css({'display':'none'});
                    $('#setting_coin').css({'display':'block'});
                    $('#setting_normal').css({'display':'none'});
                    getRunCoinList();
                }
                else if(data_set === 'normal') {
                    $('#setting_api').css({'display':'none'});
                    $('#setting_trade').css({'display':'none'});
                    $('#setting_coin').css({'display':'none'});
                    $('#setting_normal').css({'display':'block'});
                    getPreferenceView();
                }
            });
            $('#show_api_key').click(function(){
                $('#show_api_key').css('display', 'none');
                $('#hidden_api_key').css('display', 'inline-block');
                $('#input_api_key').attr("type", 'password');
            });
            $('#hidden_api_key').click(function(){
                $('#hidden_api_key').css('display', 'none');
                $('#show_api_key').css('display', 'inline-block');
                $('#input_api_key').attr("type", 'text');
            });
            $('#show_secret_key').click(function(){
                $('#show_secret_key').css('display', 'none');
                $('#hidden_secret_key').css('display', 'inline-block');
                $('#input_secret_key').attr("type", 'password');
            });
            $('#hidden_secret_key').click(function(){
                $('#hidden_secret_key').css('display', 'none');
                $('#show_secret_key').css('display', 'inline-block');
                $('#input_secret_key').attr("type", 'text');
            });

            $('#btn_key_add').click(function (){
                $('#setting_api_add').css('display', 'block');
                $('#setting_api_list').css('display', 'none');
            });
            $('#btn_key_confirm').click(function (){
                if (key_status === 0) {
                    inputApiKey();
                } else {
                    editApiKey();
                }

            });
        });

        function getMyInfo() {
            $.ajax({
                url: '/user.myInfo',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#my_fee_rate').text(data.my_fee);
                        my_coupon = data.my_coupon;
                        my_fee = data.my_fee;
                        my_points = data.my_points;
                        market = data.market;
                        my_level = data.my_level;
                        my_id = data.my_id;
                        my_name = data.my_name;

                        $('#logo_bin').css('display', 'none');
                        $('#logo_htx').css('display', 'none');
                        if (market === 'bin') {
                            $('#logo_bin').css('display', 'block');
                        } else {
                            $('#logo_htx').css('display', 'block');
                        }

                        $('#span-user-level').text(my_level);
                        $('#span-user-id').text(my_name);

                        getApiKeyList();
                        setInitTrade();
                        setInitPreference();

                        $('#mobile_tab_image').attr('src', '{{URL::asset('assets/img/pngs/setting.png')}}');
                        $('#mobile_tab_text').text('{{ __('userpage.setting') }}');
                        $('#mobile_val_img').css('display', 'none');
                        $('#mobile_val_text').text('{{ __('userpage.fee_rate') }}');
                        $('#mobile_val_unit').text(my_fee);
                        $('#mobile_val_balance').text('%');
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }


    </script>
@endsection
