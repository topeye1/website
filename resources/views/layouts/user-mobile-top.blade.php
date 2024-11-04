<div class="row header-mobile" style="background-color:#CCD1DE; height: 58px;">
    <div class="col-4 d-flex justify-content-center">
        <div class="flex-row mt-3">
            <img class="market-logo-btn" id="logo_htx" src="/assets/img/pngs/htx-logo.png" style="display: none; width: 100%;" alt="">
        </div>
    </div>
    <div class="col-4 d-flex justify-content-center align-items-center">
        <div class="d-flex align-items-center mobile_top_tab" id="nav-tab" style="cursor: pointer">
            <img class="mr-2" id="mobile_tab_image" src="" style="width: auto;" alt="">
            <span id="mobile_tab_text" style="color: #404450;"></span>
        </div>
    </div>
    <div class="col-4 d-flex justify-content-end align-items-center" id="div-user-info" style="font-size: 0.85rem;">
        <div class="mr-3" style="color: #404450;">
            <span>Lv.</span>
            <span id="span-user-level"></span>
        </div>
        <div>
            <img src="{{URL::asset('assets/img/pngs/alarm.png')}}" class="mr-3">
        </div>
    </div>
</div>

<div class="row align-items-center" style="height: 50px;">
    <div class="col-2 d-flex justify-content-center">
        <img id="mobile_menu" src="{{URL::asset('assets/img/pngs/mobile_menu.png')}}">
    </div>
    <div class="col-10 d-flex align-items-center">
        <div class="d-flex justify-content-center align-items-center" style="width: 80%; height: 1.5rem; border-radius: 1rem; background-color: #F0F1F4;">
            <img id="mobile_val_img" class="mr-1" style="width: 1.2rem; height: 1.2rem; display: none;">
            <span id="mobile_val_text" class="d-flex mr-3" style="font-size: 0.75rem"></span>
            <span id="mobile_val_unit" class="d-flex" style="font-size: 0.75rem"></span>
            <span id="mobile_val_balance" class="d-flex" style="font-size: 0.75rem"></span>
        </div>
    </div>
</div>
@include('modals.mobile-menu')
<script>
    $(document).ready(function () {
        $('#mobile_menu').click(function(){
            $('#MobileMenuModal').modal('show');
        });
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
