{{-- Part of starter project. --}}
<!doctype html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <title>@yield('page_title', '控制台') | 飛鳥學院 Asukademy 後台系統</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ $uri['base.path'] }}media/images/favicon.ico" />
    <meta name="generator" content="The Time Machine" />
    <meta name="robots" content="nofollow" />
    @yield('meta')

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    @yield('style')
    <link rel="stylesheet" href="{{ $uri['base.path'] }}media/css/admin/main.css?{{{ \Riki\Asset\Asset::getVersion() }}}" />

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    @yield('script')

</head>
<body class="asukademy admin">
    @section('navbar')
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ $router->buildHtml('home') }}">飛鳥學院 Asukademy</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                     @section('nav')
                        <li class=""><a href="{{ $router->buildHtml('users') }}">會員</a></li>
                        <li class=""><a href="{{ $router->buildHtml('courses') }}">課程</a></li>
                        <li class=""><a href="{{ $router->buildHtml('orders') }}">報名</a></li>
                        <li class=""><a href="{{ $router->buildHtml('tutors') }}">講師</a></li>
                        <li class=""><a href="{{ $router->buildHtml('positions') }}">場地</a></li>
                        <li class=""><a href="{{ $router->buildHtml('categories') }}">分類</a></li>
                     @show
                </ul>
                <ul class="nav navbar-nav navbar-right">
                     <li><a target="_blank" href="{{ $uri['base.path'] }}"><span class="glyphicon glyphicon-globe"></span> 觀看前台</a></li>
                    <li><a href="{{ $router->buildHtml('user:logout') }}"><span class="glyphicon glyphicon-log-out"></span> 登出</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
    @show

    @yield('body', 'Content')

    @section('copyright')
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <hr />

                    <footer>
                        &copy; Windwalker {{ $datetime->format('Y') }}
                    </footer>
                </div>
            </div>
        </div>
    </div>
    @show
</body>
</html>
