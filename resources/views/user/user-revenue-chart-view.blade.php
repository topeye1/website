<div class="row pl-5 pr-5 mb-3">
    <div class="col-6">
        <div class="line-chart-border">
            <div class="d-flex justify-content-center">
                <h6>{{ __('userpage.total_asset') }}</h6>
            </div>
            <div class="chart-area" id="div_total_asset">
                <canvas id="total_asset"></canvas>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="line-chart-border">
            <div class="d-flex justify-content-center">
                <h6>{{ __('userpage.live_coins') }}</h6>
            </div>
            <div class="chart-area" id="div_live_coins">
                <canvas id="live_coins"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row pl-5 pr-5 mb-3">
    <div class="col-6">
        <div class="line-chart-border">
            <div class="d-flex justify-content-center">
                <h6>{{ __('userpage.roi_rate') }}</h6>
            </div>
            <div class="chart-area" id="div_roi">
                <canvas id="roi"></canvas>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="line-chart-border">
            <div class="d-flex justify-content-center">
                <h6>{{ __('userpage.revenue1') }}</h6>
            </div>
            <div class="chart-area" id="div_revenue">
                <canvas id="revenue"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('assets/vendor/chart.js/Chart.js')}}"></script>

<script>
    let month_name = "";
    let asset_ctx = null;
    let coin_ctx = null;
    let roi_ctx = null;
    let revenue_ctx = null;


    function showLineChart(assetDatas, liveCoins, roiDatas, profitDatas, sel_date, lang, radio_idx) {
        $('#div_total_asset').html("")
        let total_asset = '<canvas id="total_asset"></canvas>';
        $('#div_total_asset').html(total_asset)
        let asset_id = document.getElementById("total_asset");
        asset_ctx = asset_id.getContext('2d');
        asset_ctx.clearRect(0, 0, asset_id.width, asset_id.height);
        drawLineChart(asset_ctx, assetDatas, getDayLabels(sel_date, lang, radio_idx), '$');

        $('#div_live_coins').html("")
        let live_coins = '<canvas id="live_coins"></canvas>';
        $('#div_live_coins').html(live_coins)
        let liveCoin_id = document.getElementById("live_coins");
        coin_ctx = liveCoin_id.getContext('2d');
        coin_ctx.clearRect(0, 0, liveCoin_id.width, liveCoin_id.height);
        drawLineChart(coin_ctx, liveCoins, getDayLabels(sel_date, lang, radio_idx), '');

        $('#div_roi').html("")
        let roi = '<canvas id="roi"></canvas>';
        $('#div_roi').html(roi)
        let roi_id = document.getElementById("roi");
        roi_ctx = roi_id.getContext('2d');
        roi_ctx.clearRect(0, 0, roi_id.width, roi_id.height);
        drawLineChart(roi_ctx, roiDatas, getDayLabels(sel_date, lang, radio_idx), '%');

        $('#div_revenue').html("")
        let revenue = '<canvas id="revenue"></canvas>';
        $('#div_revenue').html(revenue)
        let revenue_id = document.getElementById("revenue");
        revenue_ctx = revenue_id.getContext('2d');
        revenue_ctx.clearRect(0, 0, revenue_id.width, revenue_id.height);
        drawLineChart(revenue_ctx, profitDatas, getDayLabels(sel_date, lang, radio_idx), '$');
    }

    function drawLineChart(ctx, datas, labels, unit) {
        let dot_digit = 0;
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: "",
                    lineTension: 0.1,
                    backgroundColor: "rgba(255, 255, 255, 0.05)",
                    borderColor: "rgba(78, 115, 190, 1)",
                    pointRadius: 2,
                    pointBorderColor: "rgba(255, 150, 0, 1)",
                    pointHoverRadius: 1,
                    pointHoverBorderColor: "rgba(255, 255, 255, 1)",
                    pointHitRadius: 1,
                    pointBorderWidth: 1,
                    data: datas,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: labels.length
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 10,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                let s_val = value.toString().split('.');

                                if (s_val.length > 1) {
                                    let decimalPart = s_val[1];
                                    dot_digit = decimalPart.length
                                }
                                let y = unit + number_format(value, dot_digit);
                                if (unit === '%')
                                    y = number_format(value, dot_digit) + unit;
                                return y;
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [0],
                            zeroLineBorderDash: [0]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 0.5,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    caretPadding: 10
                }
            }
        });
    }
    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(',', '').replace(' ', '');
        let n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                let k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    function getDayLabels(currentDate, lang, radio_idx) {
        let monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        let day_unit = "th";
        if (lang === 'ko') {
            monthNames = ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"];
            day_unit = "일";
        } else if (lang === 'zh-CN') {
            monthNames = ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"];
            day_unit = "日";
        } else if (lang === 'ja') {
            monthNames = ["1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月"];
            day_unit = "日";
        }
        month_name = monthNames[currentDate.getMonth()];

        currentDate.setDate(1);
        let lastDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
        let lastDate = lastDayOfMonth.getDate();
        if (parseInt(radio_idx) === 2) {
            lastDate = 12;
        }
        let labels = [];
        for (let i = 1; i <= lastDate; i++) {
            labels.push(i);
        }
        return labels;
    }
</script>
