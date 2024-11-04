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
                        <h2 id="mainHeading" style="color: #333333;">You have used all of your coupon balance.</h2>
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
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">Thank you for using 1ndd.com!<br>We would like to inform you that you have used the entire coupon amount.</p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">At the same time, we would like to inform you that all transactions have been suspended.</p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;">Please log in and purchase the coupon from the “Coupon” menu.</p>
                        </div>

                        <!-- Chinese Content -->
                        <div id="chineseContent" style="display: none;">
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">感谢您使用 1ndd.com！<br>您当前使用的优惠券将于以下日期到期。</p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">同时，我们谨通知您，所有交易已暂停。</p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;">请登录并从“优惠券”菜单购买优惠券。</p>
                        </div>

                        <!-- Korean Content -->
                        <div id="koreanContent" style="display: none;">
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">1ndd.com을 이용해 주셔서 감사합니다!<br>사용하시던 쿠폰의 금액이 모두 소진되었음을 알려드립니다.</p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">동시에  모든 거래가 중단이 되었음을 알려드립니다.</p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;">쿠폰은 로그인 후 "쿠폰" 메뉴에서 구매해 주세요.</p>
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
        document.getElementById('mainHeading').innerText = 'You have used all of your coupon balance.';
    }

    function showChinese() {
        // Hide Korean and English content
        document.getElementById('koreanContent').style.display = 'none';
        document.getElementById('englishContent').style.display = 'none';
        // Display Chinese content
        document.getElementById('chineseContent').style.display = 'block';
        // Update title and main heading
        document.getElementById('mainHeading').innerText = '您已用完所有优惠券余额。';
    }

    function showKorean() {
        // Hide English and Chinese content
        document.getElementById('englishContent').style.display = 'none';
        document.getElementById('chineseContent').style.display = 'none';
        // Display Korean content
        document.getElementById('koreanContent').style.display = 'block';
        // Update title and main heading
        document.getElementById('mainHeading').innerText = '쿠폰 잔액을 모두 사용하셨습니다.';
    }
</script>
</body>
</html>
