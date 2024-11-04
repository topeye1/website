<div>
    <div style="padding-left: 1.5rem; padding-bottom: 1rem">
        <select class="list-pages" id="select-pages">
            <option value="20">20 {{ __('userpage.view_items') }}</option>
            <option value="50">50 {{ __('userpage.view_items') }}</option>
        </select>
    </div>
    <div style="background-color: #e3e6f0; font-size: 0.75rem; padding: 0.5rem 1rem;">
        <div style="width: 100%; margin-top: 1rem;">
            @include('layouts.page-navigation2')
        </div>
        <div id="revenue_list_view">

        </div>
    </div>
</div>

<script>
    function initRevenueList() {
        $('#select-pages').change(function (){
            mpstart = 1;
            showRevenueDataList();
        });
    }

    function showRevenueDataList() {
        let list_pages = $('#select-pages').val();
        $.ajax({
            url: '/user.revenueList',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            data: {
                mpstart: mpstart,
                search_date: filter_date,
                market: market,
                date_idx: radio_idx,
                pages: list_pages
            },
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    $('#revenue_list_view').html('');
                    let lists = data.revenue_list;
                    pstart = parseInt(data.pstart);
                    let totalpage = parseInt(data.totalpage);
                    let tags = '';
                    for (let i = 0; i < lists.length; i++) {
                        let list = lists[i];
                        let amount = "$" + list.amount
                        if (parseFloat(list.amount) < 0) {
                            amount = "-$" + Math.abs(list.amount);
                        }
                        let profit = "$" + list.profit
                        if (parseFloat(list.profit) < 0) {
                            profit = "-$" + Math.abs(list.profit);
                        }
                        let rate = list.rate + "%"
                        let fee = "$" + list.fee
                        if (parseFloat(list.fee) < 0) {
                            fee = "-$" + Math.abs(list.fee);
                        }
                        let real = "$" + list.real
                        if (parseFloat(list.real) < 0) {
                            real = "-$" + Math.abs(list.real);
                        }
                        tags += '<div style="background-color: white; width: 90%; border-radius: 0.2rem; padding: 1rem; margin: 0 auto; margin-top: 0.7rem;">';
                        tags += '    <div class="row m-0 mb-2" style="border-bottom: 1px solid #e3e6f0;">';
                        tags += '        <div class="col-6 p-0">{{ __('userpage.date') }}</div>';
                        tags += '        <div class="col-6 p-0 d-flex justify-content-end">'+list.date+'</div>';
                        tags += '    </div>';
                        if (parseInt(radio_idx) === 1) {
                            tags += '    <div class="row m-0 mb-2" style="border-bottom: 1px solid #e3e6f0;">';
                            tags += '        <div class="col-6 p-0">{{ __('userpage.cash_balance') }}</div>';
                            tags += '        <div class="col-6 p-0 d-flex justify-content-end">'+numberWithCommas(amount)+'</div>';
                            tags += '    </div>';
                        }
                        tags += '    <div class="row m-0 mb-2" style="border-bottom: 1px solid #e3e6f0;">';
                        tags += '        <div class="col-6 p-0">{{ __('userpage.revenue1') }}</div>';
                        tags += '        <div class="col-6 p-0 d-flex justify-content-end">'+numberWithCommas(profit)+'</div>';
                        tags += '    </div>';
                        tags += '    <div class="row m-0 mb-2" style="border-bottom: 1px solid #e3e6f0;">';
                        tags += '        <div class="col-6 p-0">{{ __('userpage.roi_rate') }}</div>';
                        tags += '        <div class="col-6 p-0 d-flex justify-content-end">'+rate+'</div>';
                        tags += '    </div>';
                        tags += '    <div class="row m-0 mb-2" style="border-bottom: 1px solid #e3e6f0;">';
                        tags += '        <div class="col-6 p-0">{{ __('userpage.fees') }}</div>';
                        tags += '        <div class="col-6 p-0 d-flex justify-content-end">'+numberWithCommas(fee)+'</div>';
                        tags += '    </div>';
                        tags += '    <div class="row m-0 mb-2" style="border-bottom: 1px solid #e3e6f0;">';
                        tags += '        <div class="col-6 p-0">{{ __('userpage.profit1') }}</div>';
                        tags += '        <div class="col-6 p-0 d-flex justify-content-end">'+numberWithCommas(real)+'</div>';
                        tags += '    </div>';
                        tags += '    <div class="row m-0 mb-2">';
                        tags += '        <div class="col-6 p-0">{{ __('userpage.coupon_balance') }}</div>';
                        tags += '        <div class="col-6 p-0 d-flex justify-content-end">'+numberWithCommas(list.coupon)+'</div>';
                        tags += '    </div>';
                        tags += '</div>';
                    }
                    $('#revenue_list_view').html(tags);
                    setPageNavigation2(totalpage, mpstart, showRevenueDataList);

                    let assetDatas = data.assetDatas;
                    let liveCoins = data.liveCoins;
                    let roiDatas = data.roiDatas;
                    let profitDatas = data.profitDatas;
                    let lang = data.lang;
                    showLineChart(assetDatas, liveCoins, roiDatas, profitDatas, selected_date, lang, radio_idx);
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }
</script>
