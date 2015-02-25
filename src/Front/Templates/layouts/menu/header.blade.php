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
        <li class="">
            <a href="{{{ $menu->url ? : $router->buildHtml('user:logout') }}}">
                <span class="menu-item-title">登出</span>
                <span class="menu-item-sub-title">Logout</span>
            </a>
        </li>
    @endif

</ul>
