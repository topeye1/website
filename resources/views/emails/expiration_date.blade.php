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
                        <h2 id="mainHeading" style="color: #333333;">The expiration date of coupon is coming soon.</h2>
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
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">Thank you for using 1ndd.com!<br>The coupon you are currently using will expire on the date below.</p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> Valid until : {{ $date_due }}</strong></p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">Please log in and purchase from the “Coupon” menu.</p>
                        </div>

                        <!-- Chinese Content -->
                        <div id="chineseContent" style="display: none;">
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">感谢您使用 1ndd.com！<br>您当前使用的优惠券将于以下日期到期。</p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> 有效期至 : {{ $date_due }}</strong></p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">请登录后从“优惠券”菜单中购买。</p>
                        </div>

                        <!-- Korean Content -->
                        <div id="koreanContent" style="display: none;">
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">1ndd를 이용해 주셔서 감사합니다!<br>현재 사용하시고 계신 쿠폰이 아래 날짜에 만료됩니다.</p>
                            <p style="font-size: 20px; line-height: 1.5; color: #ff6699;"><strong> 쿠폰 만료일 : {{ $date_due }}</strong></p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">로그인 후 "쿠폰" 메뉴에서 구매해 주시기 바랍니다.</p>
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
        document.getElementById('mainHeading').innerText = 'The expiration date of coupon is coming soon.';
    }

    function showChinese() {
        // Hide Korean and English content
        document.getElementById('koreanContent').style.display = 'none';
        document.getElementById('englishContent').style.display = 'none';
        // Display Chinese content
        document.getElementById('chineseContent').style.display = 'block';
        // Update title and main heading
        document.getElementById('mainHeading').innerText = '优惠券的有效期即将结束。';
    }

    function showKorean() {
        // Hide English and Chinese content
        document.getElementById('englishContent').style.display = 'none';
        document.getElementById('chineseContent').style.display = 'none';
        // Display Korean content
        document.getElementById('koreanContent').style.display = 'block';
        // Update title and main heading
        document.getElementById('mainHeading').innerText = '쿠폰의 유효기간이 얼마남지 않았어요.';
    }
</script>
</body>
</html>
