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

<h3>其他梯次</h3>

