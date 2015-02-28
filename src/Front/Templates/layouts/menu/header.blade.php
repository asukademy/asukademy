{{-- Part of asukademy project. --}}

<ul id="mainmenu" class="uk-navbar-nav uk-float-right uk-hidden-small">

    @foreach ($mainmenu as $menu)
        <li class="{{{ $app->get('uri.route') == $menu->path ? 'uk-active' : '' }}}">
            <a href="{{{ $menu->url ? : $router->buildHtml('front:page', ['paths' => [$menu->path]]) }}}">
                <span class="menu-item-title">{{{ $menu->title }}}</span>
                <span class="menu-item-sub-title">{{{ $menu->sub_title }}}</span>
            </a>
        </li>
    @endforeach

    @if (!\User\Helper\UserHelper::isLogin())
        <li class="">
            <a href="{{{ $menu->url ? : $router->buildHtml('user:login') }}}">
                <span class="menu-item-title">登入</span>
                <span class="menu-item-sub-title">Login</span>
            </a>
        </li>
    @else
        <li data-uk-dropdown>
            <a href="#">
                <span class="menu-item-title">

                    會員中心
                    <span class="uk-icon-angle-down"></span>
                </span>

                <span class="menu-item-sub-title">My Profile</span>
            </a>
            <div class="uk-dropdown uk-dropdown-navbar">
                <ul class="uk-nav uk-nav-navbar">
                    <li class="">
                        <a href="{{{ $menu->url ? : $router->buildHtml('user:profile') }}}">
                            <span class="menu-item-title">
                                <span class="uk-icon-user"></span> 會員資料
                            </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{{ $menu->url ? : $router->buildHtml('user:courses') }}}">
                            <span class="menu-item-title">
                                <span class="uk-icon-book"></span> 我的課程
                            </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{{ $menu->url ? : $router->buildHtml('user:logout') }}}">
                            <span class="menu-item-title">
                                <span class="uk-icon-sign-out"></span> 登出
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endif

</ul>
