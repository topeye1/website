<div class="modal fade" id="MobileMenuModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="min-height: 0; margin: 58px 0 0 0;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body menu-body">
                <div class="">
                    <div class="d-flex justify-content-center" id="modal-trade-tab">
                        <a class="{{$tab=='revenue' ? 'active':''}}" id="nav-revenue-tab" href="{{ url('/user_mobile.user-revenue-view/user-page/revenue') }}" style="display: flex;color: #404450;">
                            <img src="{{URL::asset('assets/img/pngs/revenue.png')}}" class="mr-3" style="width: auto;" alt="">
                            <span class="">{{ __('userpage.revenue') }}</span>
                        </a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-content-center" id="modal-revenue-tab">
                        <a class="{{$tab=='trade' ? 'active':''}}" id="nav-trade-tab" href="{{ url('/user_mobile.user-trade-view/user-page/trade') }}" style="display: flex;color: #404450;">
                            <img src="{{URL::asset('assets/img/pngs/trade.png')}}" class="mr-3" style="width: auto;" alt="">
                            <span class="">{{ __('userpage.trade') }}</span>
                        </a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-content-center" id="modal-coupon-tab">
                        <a class="{{$tab=='coupon' ? 'active':''}}" id="nav-coupon-tab" href="{{ url('/user_mobile.user-coupon-view/user-page/coupon') }}" style="display: flex;color: #404450;">
                            <img src="{{URL::asset('assets/img/pngs/coupon.png')}}" class="mr-3" style="width: auto;" alt="">
                            <span class="">{{ __('userpage.coupon') }}</span>
                        </a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-content-center" id="modal-friend-tab">
                        <a class="{{$tab=='friend' ? 'active':''}}" id="nav-friend-tab" href="{{ url('/user_mobile.user-friend-view/user-page/friend') }}" style="display: flex;color: #404450;">
                            <img src="{{URL::asset('assets/img/pngs/friend.png')}}" class="mr-3" style="width: auto;" alt="">
                            <span class="">{{ __('userpage.friend') }}</span>
                        </a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-content-center" id="modal-setting-tab">
                        <a class="{{$tab=='setting' ? 'active':''}}" id="nav-setting-tab" href="{{ url('/user_mobile.user-setting-view/user-page/setting') }}" style="display: flex;color: #404450;">
                            <img src="{{URL::asset('assets/img/pngs/setting.png')}}" class="mr-3" style="width: auto;" alt="">
                            <span class="">{{ __('userpage.setting') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
