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

</ul>