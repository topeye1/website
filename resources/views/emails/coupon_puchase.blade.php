<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Language" content="zh-CN">
    <title>DDUKDDAK!</title>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#f1f1f1">
    <tr>
        <td align="center" style="padding: 40px 0;">
            <table width="600" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="border-radius: 6px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);">
                <!-- Header -->
                <tr>


                    <td align="center" bgcolor="#f1f1f1" style="padding: 20px 0;">
                        <a href="https://www.1ndd.com/" target="_blank"><img src="https://www.1ndd.com/img/1ndd_logo.png" width="200"></a>
                        <h2 id="mainHeading" style="color: #333333;">Coupon payment receipt</h2>
                        <h4 style="color: #333333;">Please choose your language.</h4>

                        <!-- Language Buttons -->
                        <button style="padding: 4px;" onclick="showChinese()">中 文</button>
                        <button style="padding: 3.5px;" onclick="showKorean()">한국어</button>
                        <button style="padding: 5px;" onclick="showEnglish()">English</button>
                    </td>
                </tr>

                <!-- Content -->
                <tr>
                    <td align="left" style="padding: 40px;">

                        <!-- English Content -->
                        <div id="englishContent">
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">The details of the coupon you purchased are as follows,</p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> Coupon name : {{ $data['coupon_name'] }}</strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> Provided amount : ${{ $data['amount_given'] }}</strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> Max trade price : ${{ $data['max_trade_price'] }}</strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> Coupon expiration : {{ $data['date_due'] }}</strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> Price : ${{ $data['price_buy'] }}</strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> Payment time : {{ $data['date_buy'] }}</strong></p>
                        </div>

                        <!-- Chinese Content -->
                        <div id="chineseContent" style="display: none;">
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">您购买的优惠券详情如下：</p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> 优惠券名称 : {{ $data['coupon_name'] }}</strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> 提供金额 : ${{ $data['amount_given'] }}</strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> 最大交易金额 : ${{ $data['max_trade_price'] }}</strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> 优惠券到期日 : {{ $data['date_due'] }}</strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> 价格 : ${{ $data['price_buy'] }}</strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> 付款时间 : {{ $data['date_buy'] }}</strong></p>
                        </div>

                        <!-- Korean Content -->
                        <div id="koreanContent" style="display: none;">
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">구매하신 쿠폰의 내역은 아래와 같습니다.</p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> 쿠폰이름 : {{ $data['coupon_name'] }} </strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> 제공 거래금액 : ${{ $data['amount_given'] }} </strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> 최대 거래금액 : ${{ $data['max_trade_price'] }} </strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> 쿠폰 만료일 : {{ $data['date_due'] }} </strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> 구매 가격 : ${{ $data['price_buy'] }} </strong></p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> 결제 시간 : {{ $data['date_buy'] }} </strong></p>
                        </div>
                    </td>
                </tr>
                <!-- Footer -->
                <tr>
                    <td align="center" bgcolor="#f1f1f1" style="padding: 20px 0;"><img src="https://www.1ndd.com/img/logo1.png"  alt="center" width="50"/>
                        <p style="font-size: 14px; line-height: 1.5; color: #999999;">© 2023 1ndd.com. All rights reserved.</p>
                        <p style="font-size: 14px; line-height: 1.5; color: #999999;">help@1ndd.com</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>


<script>
    function showEnglish() {
        // Hide Korean and Chinese content
        document.getElementById('koreanContent').style.display = 'none';
        document.getElementById('chineseContent').style.display = 'none';
        // Display English content
        document.getElementById('englishContent').style.display = 'block';
        // Update title and main heading
        document.getElementById('mainHeading').innerText = 'Coupon payment receipt';
    }

    function showChinese() {
        // Hide Korean and English content
        document.getElementById('koreanContent').style.display = 'none';
        document.getElementById('englishContent').style.display = 'none';
        // Display Chinese content
        document.getElementById('chineseContent').style.display = 'block';
        // Update title and main heading
        document.getElementById('mainHeading').innerText = '优惠券支付收据';
    }

    function showKorean() {
        // Hide English and Chinese content
        document.getElementById('englishContent').style.display = 'none';
        document.getElementById('chineseContent').style.display = 'none';
        // Display Korean content
        document.getElementById('koreanContent').style.display = 'block';
        // Update title and main heading
        document.getElementById('mainHeading').innerText = '쿠폰 구매 내역';
    }
</script>
</body>
</html>
