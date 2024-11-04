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
                        <h2 id="mainHeading" style="color: #333333;">This is a temporary password.<br>Please change it after logging in.</h2>
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
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">Hello! <br>We have received a request for a new password from you.<br>The temporary password you requested is as follows.</p>
                            <p align="center" style="font-size: 30px; line-height: 1.5; color: #ff6699;"><strong> {{ $temp_password }} </strong></p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">This number is valid for 10 minutes. </p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">After logging in, please change your password in “Settings” - “Preference”.</p>
                        </div>

                        <!-- Chinese Content -->
                        <div id="chineseContent" style="display: none;">
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">你好！ <br>我们已收到您的新密码请求。<br>您请求的临时密码如下</p>
                            <p align="center" style="font-size: 30px; line-height: 1.5; color: #ff6699;"><strong> {{ $temp_password }} </strong></p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">该号码的有效期为 10 分钟。</p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">登录后，请在“设置”-“偏好设置”中更改密码。</p>
                        </div>
                        <!-- Korean Content -->
                        <div id="koreanContent" style="display: none;">
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;"> 안녕하세요. 고객님으로 부터 신규 비밀번호 요청을 접수하였습니다.<br>요청하신 임시 비밀 번호는 아래와 같습니다.</p>
                            <p align="center" style="font-size: 30px; line-height: 1.5; color: #ff6699;"><strong> {{ $temp_password }} </strong></p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">해당 번호는 10분간 유효합니다. </p>
                            <p style="font-size: 16px; line-height: 1.5; color: #666666;">로그인 후 "설정" - "일반"에서 비밀번호를 변경하여 주시기 바랍니다.</p>
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
        document.getElementById('mainHeading').innerText = 'This is a temporary password.\nPlease change it after logging in.';
    }

    function showChinese() {
        // Hide Korean and English content
        document.getElementById('koreanContent').style.display = 'none';
        document.getElementById('englishContent').style.display = 'none';
        // Display Chinese content
        document.getElementById('chineseContent').style.display = 'block';
        // Update title and main heading
        document.getElementById('mainHeading').innerText = '临时密码。\n请登录后更改。';
    }

    function showKorean() {
        // Hide English and Chinese content
        document.getElementById('englishContent').style.display = 'none';
        document.getElementById('chineseContent').style.display = 'none';
        // Display Korean content
        document.getElementById('koreanContent').style.display = 'block';
        // Update title and main heading
        document.getElementById('mainHeading').innerText = '임시 비밀번호 입니다.\n로그인 후 변경해 주세요.';
    }
</script>
</body>
</html>
