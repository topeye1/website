<div id="setting_trade">

    <div class="row justify-content-center align-items-center mt-1 mb-3" style="width: auto; margin: 0 auto;">
        <div class="col-4 d-flex justify-content-end">{{ __('userpage.lang') }}</div>
        <div class="col-5">
            <div class="dropdown my-dropdown">
                <button class="btn my-middle-btn lang-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%;">
                    {{ __('userpage.language') }}
                </button>
                <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton" style="width: 100%; text-align: center;">
                    <a class="dropdown-item" href="{{ route('lang.switch', 'ko') }}">한국어</a>
                    <a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a>
                    <a class="dropdown-item" href="{{ route('lang.switch', 'zh-CN') }}">中文</a>
                    <a class="dropdown-item" href="{{ route('lang.switch', 'ja') }}">日语</a>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
    <div class="row justify-content-center align-items-center mt-1" style="width: auto; margin: 0 auto;">
        <div class="col-4 d-flex justify-content-end">{{ __('userpage.phone') }}</div>
        <div class="col-5">
            <div class="setting_text d-flex align-items-center pl-3 pr-3" id="my_phone_number"></div>
        </div>
        <div class="col-md-3 d-flex" style="align-items: center;">
            <div class="edit-pen-icon" id="edit-phone"><i class="fa fa-pencil" aria-hidden="true"></i></div>
        </div>
    </div>
    <div class="row justify-content-center mb-3" style="font-size: 0.8rem; color: #404450;">
        <div class="col-4"></div>
        <div class="col-5">
            <div id="change_phone_number" style="display: none;">{{ __('userpage.change_ok') }}</div>
        </div>
        <div class="col-md-3 d-flex"></div>
    </div>
    <div class="row justify-content-center align-items-center mt-1" style="width: auto; margin: 0 auto;">
        <div class="col-4 d-flex justify-content-end">{{ __('userpage.password') }}</div>
        <div class="col-5">
            <div class="setting_text d-flex align-items-center pl-3 pr-3" id="my_password">***********</div>
        </div>
        <div class="col-md-3 d-flex" style="align-items: center;">
            <div class="edit-pen-icon" id="edit-password"><i class="fa fa-pencil" aria-hidden="true"></i></div>
        </div>
    </div>
    <div class="row justify-content-center mb-3" style="font-size: 0.8rem; color: #404450;">
        <div class="col-4"></div>
        <div class="col-5">
            <div id="change_password" style="display: none;">{{ __('userpage.change_ok') }}</div>
        </div>
        <div class="col-md-3 d-flex"></div>
    </div>
    <div class="row justify-content-center align-items-center" style="width: auto; margin: 0 auto;">
        <div class="col-4 d-flex justify-content-end">{{ __('userpage.recommender') }}</div>
        <div class="col-5">
            <input type="text" class="setting_text " id="my_recommender" />
        </div>
        <div class="col-md-3 d-flex" style="align-items: center;">
            <div id="btn_setting_recommender" class="btn btn-ok-confirm" >{{ __('userpage.confirm') }}</div>
        </div>
    </div>
    <div class="row justify-content-center mb-3" style="font-size: 0.8rem; color: #404450;">
        <div class="col-4"></div>
        <div class="col-5">
            <div id="add_recommender" style="display: none;">{{ __('userpage.add_recommender') }}</div>
            <div id="nofind_recommender1" style="color: #F84747;">{{ __('userpage.err_recommender') }}</div>
            <div id="nofind_recommender2" style="color: #F84747;">{{ __('userpage.err_phone_number1') }}</div>
        </div>
        <div class="col-md-3 d-flex"></div>
    </div>

    <div class="row justify-content-center align-items-center mt-5 font-weight-bold" style="color: #404450;">{{ __('userpage.precautions') }}</div>
    <div class="row justify-content-center align-items-center mt-3">
        <ul>
            <li>{{ __('userpage.recommender_description1') }}</li>
            <li>{{ __('userpage.recommender_description2') }}</li>
        </ul>
    </div>

</div>
@include('modals.edit-phone-modal')
@include('modals.edit-password-modal')
<script>
    function setInitPreference() {
        $('#edit-phone').click(function () {
            let my_phone = $('#my_phone_number').text();
            showChangePhone(my_phone);
        });
        $('#edit-password').click(function () {
            showChangePassword();
        });
    }
    function getPreferenceView() {
        $('#change_phone_number').css('display', 'none');
        $('#change_password').css('display', 'none');
        $('#add_recommender').css('display', 'none');
        $('#nofind_recommender1').css('display', 'none');
        $('#nofind_recommender2').css('display', 'none');

        getUserSettingInfo();
    }
    function getUserSettingInfo() {
        $.ajax({
            url: '/user.getUserInfo',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    $('#my_phone_number').text(data.my_phone);
                    $('#my_recommender').val('');
                    //getCouponList();
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }
    function changePhoneMessage(phone) {
        $('#my_phone_number').text(phone);
        $('#change_phone_number').css('display', 'block');
    }
    function changePasswordMessage() {
        $('#change_password').css('display', 'block');
    }

</script>
