<div id="coupon-card-mobile">
    <div class="row" style="display: flex;">
        <div class="col-12 m-2">
            <div class="row">
                <div class="col-2 d-flex justify-content-center">
                    <img class="mobile-menu" src="{{URL::asset('assets/img/pngs/mobile_menu.png')}}" style="">
                </div>
                <div class="col-10 d-flex justify-content-center">
                    <div class="d-flex align-items-center pl-3 pt-1 pb-1 pr-3" style="right:2rem; width: auto; height: 1.5rem; border-radius: 1rem; background-color: #F0F1F4;">
                        <img src="{{URL::asset('assets/img/pngs/coupon.png')}}" class="mr-1" style="width: 1.2rem; height: 1.2rem">
                        <span class="d-flex mr-3" style="font-size: 0.75rem">{{ __('userpage.coupon_balance') }}</span>
                        <span class="d-flex" style="font-size: 0.75rem">$</span>
                        <span class="d-flex" style="font-size: 0.75rem" id="coupon_balance">90000</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="coupon-card-header col-12 d-flex justify-content-center">
            <ul class="nav nav-underline" style="font-size: 16px">
                <li class="nav-item">
                    <a class="nav-link active" data-set="purchase" href="#">{{ __('userpage.coupon_purchase') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-set="history" href="#">{{ __('userpage.purchase_history') }}</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container form-group coupon-card-body-purchase" style="margin: auto;">
        <div class="row " id="coupon-card-layout" style="margin: 0 auto; display: flex;">


        </div>
        <div class="row " id="coupon-history-layout" style="margin: 0 auto; width: 70rem; display:none;">
            <div class="col-12 mt-3 mb-3">
                <select class="coupon-history-pages" style="border-color:#c3c3c3; width: 6rem;">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered coupon-history-table" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{ __('userpage.buy_date') }}</th>
                            <th>{{ __('userpage.purchase_amount') }}</th>
                            <th>{{ __('userpage.coupon_name') }}</th>
                            <th>{{ __('userpage.level') }}</th>
                            <th>{{ __('userpage.used_amount') }}</th>
                            <th>{{ __('userpage.remaining_amount') }}</th>
                            <th>{{ __('userpage.validity') }}</th>
                            <th>{{ __('userpage.status') }}</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_data_list">


                        </tbody>
                    </table>
                </div>
            </div>
            @include('layouts.page-navigation2')


        </div>
    </div>
</div>
