<!doctype html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <title>歡迎來到飛鳥學院</title>
</head>
<body>
    <p>{{{ $user->name }}} 您好:</p>

    <br /><br />

    <p>歡迎您加入飛鳥學院的會員，這是您的註冊資料:</p>

    <table class="uk-table uk-table-striped"
            style="border-collapse:collapse; border-spacing:0px; color:rgb(68, 68, 68); font-family:roboto,heiti tc,微軟正黑體,sans-serif; font-size:17px; line-height:29.75px; margin-bottom:15px; margin-top:15px; width: 600px;">
        <tbody>
        <tr style="">
            <td style="vertical-align:top; padding: 5px 10px;border-bottom: 1px solid #eee;">姓名</td>
            <td style="vertical-align:top; padding: 5px 10px;border-bottom: 1px solid #eee;">{{{ $user->name }}}</td>
        </tr>
        <tr>
            <td style="vertical-align:top; padding: 5px 10px;border-bottom: 1px solid #eee;">帳號</td>
            <td style="vertical-align:top; padding: 5px 10px;border-bottom: 1px solid #eee;">{{{ $user->username }}}</td>
        </tr>
        <tr>
            <td style="vertical-align:top; padding: 5px 10px;">Email</td>
            <td style="vertical-align:top; padding: 5px 10px;">{{{ $user->email }}}</td>
        </tr>
        </tbody>
    </table>

    <br /><br />
    <p>請點擊以下連結，完成信箱認證手續</p>

    <p>
        <a href="{{{ \Riki\Uri\Uri::root() }}}user/activation?token={{{ $user->activation }}}"
                style="color: rgb(255, 255, 255); text-decoration: none; cursor: pointer; -webkit-transition: all 0.5s;
                transition: all 0.5s; box-sizing: border-box; width: 256.25px; -webkit-appearance: none;
                margin: 0px; border: none; overflow: visible; font-family: inherit; font-style: inherit;
                font-variant: inherit; font-weight: inherit; font-stretch: inherit; display: inline-block;
                padding: 10px 20px; vertical-align: middle; line-height: 40px; min-height: 30px; font-size: 24px;
                text-align: center; border-radius: 3px; background: rgb(140, 193, 76);"
                >
            &nbsp;驗證我的信箱
        </a>
    </p>

    <br /><br /><br />
    <p><a href="{{{ \Riki\Uri\Uri::root() }}}">Asukademy 飛鳥學院</a> 敬上</p>
</body>
</html>