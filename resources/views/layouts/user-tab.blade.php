<!-- PC Header-->
<div class="row mt-2 header-pc" style="background-color:#CCD1DE; height: 58px;">
    <div class="col-1">
        <div class="d-flex justify-content-end">
            <img src="{{URL::asset('assets/img/brand/logo-4.png')}}" class="header-brand-img light-logo1"
                 alt="logo" style="width: auto;">
        </div>
    </div>
    <div class="col-1 d-flex">
        <div class="flex-row mt-4 mb-1">
            <!--// comment - binance 2024-06-21
            <img class="market-logo-btn" id="logo_bin" src="/assets/img/pngs/binance-logo.png" style="display: none; width: 100%" alt="">
            -->
            <img class="market-logo-btn" id="logo_htx" src="/assets/img/pngs/htx-logo.png" style="display: none; width: 100%;" alt="">
        </div>
    </div>
    <div class="col-8">
        <div class="nav nav-tabs nav-fill mt-3" id="nav-tab" role="tablist">
            <a class="nav-item nav-link {{$tab=='revenue' ? 'active':''}}" id="nav-revenue-tab" href="{{ url('/user.user-revenue-view/user-page/revenue') }}" style="width: 15%; display: flex;">
                <img src="{{URL::asset('assets/img/pngs/revenue.png')}}" class="mr-3" style="width: auto;" alt="">
                <span class="">{{ __('userpage.revenue') }}</span>
            </a>
            <a class="nav-item nav-link {{$tab=='trade' ? 'active':''}}" id="nav-trade-tab" href="{{ url('/user.user-trade-view/user-page/trade') }}" style="width: 15%; display: flex;">
                <img src="{{URL::asset('assets/img/pngs/trade.png')}}" class="mr-3" style="width: auto;" alt="">
                <span class="">{{ __('userpage.trade') }}</span>
            </a>
            <a class="nav-item nav-link {{$tab=='coupon' ? 'active':''}}" id="nav-coupon-tab" href="{{ url('/user.user-coupon-view/user-page/coupon') }}" style="width: 15%; display: flex;">
                <img src="{{URL::asset('assets/img/pngs/coupon.png')}}" class="mr-3" style="width: auto;" alt="">
                <span class="">{{ __('userpage.coupon') }}</span>
            </a>
            <a class="nav-item nav-link {{$tab=='friend' ? 'active':''}}" id="nav-friend-tab" href="{{ url('/user.user-friend-view/user-page/friend') }}" style="width: 15%; display: flex;">
                <img src="{{URL::asset('assets/img/pngs/friend.png')}}" class="mr-3" style="width: auto;" alt="">
                <span class="">{{ __('userpage.friend') }}</span>
            </a>
            <a class="nav-item nav-link {{$tab=='setting' ? 'active':''}}" id="nav-setting-tab" href="{{ url('/user.user-setting-view/user-page/setting') }}" style="width: 15%; display: flex;">
                <img src="{{URL::asset('assets/img/pngs/setting.png')}}" class="mr-3" style="width: auto;" alt="">
                <span class="">{{ __('userpage.setting') }}</span>
            </a>
        </div>
    </div>
    <div class="col-2 justify-content-end pt-3 pr-0" id="div-user-info" style="font-size: 0.85rem; display: none">
        <div class="d-flex align-items-center flex-column mr-3">
            <div class="w-100">
                <span>Lv.</span>
                <span id="span-user-level"></span>
            </div>
            <div class="w-100">
                <span id="span-user-id"></span>
            </div>
        </div>

        <div class="d-flex align-items-end pb-1">
            <img src="{{URL::asset('assets/img/pngs/alarm.png')}}" class="mr-3" style="width: auto;" alt="">
        </div>
    </div>
    <div class="col-2 justify-content-end pt-3 pr-0" id="div-login-btn" style="font-size: 1rem; display: none">
        <a style="color:#fff;" href="{{ url('/user.login') }}">
            <div id="top_btn_login" class="btn btn-confirm btn-block" style="width: 7rem; height: 2.4rem; margin-right: 4rem;">
            {{ __('userpage.login') }}
            </div>
        </a>
    </div>
</div>

<script>
    $(document).ready(function () {
        if (window.localStorage.authToken === undefined || window.localStorage.authToken === null || window.localStorage.authToken === '') {
            $('#nav-coupon-tab').css('display', 'none');
            $('#nav-friend-tab').css('display', 'none');
            $('#nav-setting-tab').css('display', 'none');
            $('#div-user-info').css('display', 'none');
            $('#div-login-btn').css('display', 'flex');
        } else {
            $('#nav-coupon-tab').css('display', 'flex');
            $('#nav-friend-tab').css('display', 'flex');
            $('#nav-setting-tab').css('display', 'flex');
            $('#div-user-info').css('display', 'flex');
            $('#div-login-btn').css('display', 'none');
        }

        $('#logo_bin').click(function () {
            setMarket("htx")
        });
        /*// comment - binance 2024-06-21
        $('#logo_htx').click(function () {
            setMarket("bin")
        });
        */
    });
    function setMarket(market_name) {
        let currentURL = window.location.href;
        currentURL = currentURL.replace('#', '');
        $.ajax({
            url: '/user.setMarket',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                market: market_name
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    market = data.market;
                    window.location.href = currentURL;
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }
</script>
