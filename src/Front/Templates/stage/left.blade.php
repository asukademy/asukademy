{{-- Part of asukademy project. --}}

<div class="attend-now uk-panel">
    <a class="uk-button uk-button-success uk-button-hero uk-width-1-1" data-uk-smooth-scroll href="#attend">
        <span class="uk-icon-sign-in"></span> 立即報名
    </a>
</div>

<div class="back-course uk-panel">
    <a class="uk-button uk-button-hero uk-width-1-1"
            href="{{{ $router->buildHtml('course', ['category_alias' => $item->category->alias, 'alias' => $item->course->alias]) }}}">
        <span class="uk-icon-chevron-left"></span> 回課程介紹
    </a>
</div>

<br /><br />

<ul class="uk-nav uk-nav-side side-menu side-bar" data-uk-nav>
    <li class="uk-nav-divider"></li>

    <li class="uk-nav-header">快速導覽</li>
    
    <li>
        <a href="#intro" data-uk-smooth-scroll >課程簡介</a>
    </li>

    <li>
        <a href="#classes" data-uk-smooth-scroll >課程規劃</a>
    </li>

    <li>
        <a href="#info" data-uk-smooth-scroll >課程資訊</a>
    </li>

    <li>
        <a href="#learned" data-uk-smooth-scroll >學習內容</a>
    </li>

    <li>
        <a href="#target" data-uk-smooth-scroll >適合對象</a>
    </li>

    <li>
        <a href="#note" data-uk-smooth-scroll >注意事項</a>
    </li>

    <li>
        <a href="#attend" data-uk-smooth-scroll >立即報名</a>
    </li>

    <li class="uk-nav-divider"></li>
    
    <li class="uk-nav-header">其他梯次</li>

    @foreach ($stages as $stage)
        <li class="{{{ $stage->id == $item->id ? 'uk-active' : '' }}}">
            <a href="{{{ $router->buildHtml('stage', ['id' => $stage->id, 'course_alias' => $item->course->alias, 'category_alias' => $item->category->alias]) }}}">
                {{{ $stage->title }}}
            </a>
        </li>
    @endforeach

    <li class="uk-nav-divider"></li>
</ul>

