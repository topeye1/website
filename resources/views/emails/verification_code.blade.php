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
                        <h2 id="mainHeading" style="color: #333333;">Verification code
                        </h2>
                        <h4 style="color: #333333;">Please choose your language.
                        </h4>
                        <!-- Language Buttons -->
                        <button style="padding: 4px;" onclick="showChinese()">中 文</button>
                        <button style="padding: 3.5px;" onclick="showKorean()">한국어</button>
                        <button style="padding: 5px;" onclick="showEnglish()">English</button>
                    </td>
                </tr>
                <!-- Content -->
                <tr>
                    <td align="center" style="padding: 40px;">

                        <!-- English Content -->
                        <div id="englishContent">
                            <p style="font-size: 30px; line-height: 1.5; color: #ff6699;"><strong> {{ $auth_number }} </strong></p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">Copy the verification code and use it.<br>Please do not tell others.</p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">The verification code is valid for 10 minutes.</p>
                        </div>

                        <!-- Chinese Content -->
                        <div id="chineseContent" style="display: none;">
                            <p style="font-size: 30px; line-height: 1.5; color: #ff6699;"><strong> {{ $auth_number }} </strong></p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">复制验证码并使用。<br>请不要告诉其他人。</p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">验证码的有效期为10分钟。</p>
                        </div>
                        <!-- Korean Content -->
                        <div id="koreanContent" style="display: none;">
                            <p style="font-size: 30px; line-height: 1.5; color: #ff6699;"><strong> {{ $auth_number }} </strong></p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">인증번호를 복사해서 사용하세요.<br>타인에게 알려주지 마세요.</p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">인증 번호는 10분간 유효합니다.</p>
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
        document.getElementById('mainHeading').innerText = 'Thank you very much for sign up.\nCheck the verification code below,';
    }

    function showChinese() {
        // Hide Korean and English content
        document.getElementById('koreanContent').style.display = 'none';
        document.getElementById('englishContent').style.display = 'none';
        // Display Chinese content
        document.getElementById('chineseContent').style.display = 'block';
        // Update title and main heading
        document.getElementById('mainHeading').innerText = '非常感谢您的注册。\n检查下面的验证码。';
    }

    function showKorean() {
        // Hide English and Chinese content
        document.getElementById('englishContent').style.display = 'none';
        document.getElementById('chineseContent').style.display = 'none';
        // Display Korean content
        document.getElementById('koreanContent').style.display = 'block';
        // Update title and main heading
        document.getElementById('mainHeading').innerText = '가입해 주셔서 대단히 감사합니다.\n아래 인증번호를 확인하세요.';
    }
</script>
</body>
</html>
