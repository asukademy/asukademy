{{-- Part of asukademy project. --}}

<h2>MENU</h2>
<ul class="uk-nav uk-nav-side side-menu side-bar" data-uk-nav="">

    {{--<li class="uk-nav-header">程式開發類</li>--}}


    <li class="{{{ $active == 'courses' ? 'uk-active' : '' }}}">
        <a href="{{{ $router->buildHtml('courses') }}}">我的課程</a>
    </li>

    <li class="{{{ $active == 'profile' ? 'uk-active' : '' }}}">
        <a href="{{{ $router->buildHtml('profile') }}}">會員資料</a>
    </li>

</ul>

