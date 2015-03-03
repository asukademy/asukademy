
@extends('_global.mail')

@section('body')
    <div class="body-inner">
        <h2>{{{ $user->name }}} 您好:</h2>

        <br />

        <p>歡迎您加入飛鳥學院的會員，這是您的註冊資料:</p>

        <table
                style="border-collapse:collapse; border-spacing:0px; color:rgb(68, 68, 68); font-family:roboto,heiti tc,微軟正黑體,sans-serif; font-size:17px; line-height:150%; margin-bottom:15px; margin-top:15px; width: 100%;"
                >
            <tbody>
            <tr style="">
                <th style="vertical-align:top; padding: 5px 10px;border-bottom: 1px solid #eee;">姓名</th>
                <td style="vertical-align:top; padding: 5px 10px;border-bottom: 1px solid #eee;">{{{ $user->name }}}</td>
            </tr>
            <tr>
                <th style="vertical-align:top; padding: 5px 10px;border-bottom: 1px solid #eee;">帳號</th>
                <td style="vertical-align:top; padding: 5px 10px;border-bottom: 1px solid #eee;">{{{ $user->username }}}</td>
            </tr>
            <tr>
                <th style="vertical-align:top; padding: 5px 10px;">Email</th>
                <td style="vertical-align:top; padding: 5px 10px;">{{{ $user->email }}}</td>
            </tr>
            </tbody>
        </table>

        <br />

        <p>請點擊以下連結，完成信箱認證手續</p>

        <p>
            <a href="{{{ $router->buildHtml('user:activation', ['token' => $user->activation], \Windwalker\Core\Router\RestfulRouter::TYPE_FULL) }}}"
                    style="padding: 9px 10px; background-color: #8cc14c; color: #fff;
				display: inline-block; border-radius: 3px; text-decoration: none;"
                    >驗證我的信箱
            </a>
        </p>

        <br /><br />
        <p><a href="{{{ \Riki\Uri\Uri::root() }}}">Asukademy 飛鳥學院</a> 敬上</p>
    </div>
@stop
