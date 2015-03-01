{{-- Part of asukademy project. --}}

<div class="uk-panel" style="padding-left: 15px;">
    <h2 class="uk-text-left">講師</h2>

    @foreach ($tutors as $tutor)
        <article class="uk-panel tutor-box">
            <div class="uk-clearfix">
                <img class="uk-align-medium-left uk-border-circle"
                        src="{{{ $tutor->image }}}"
                        width="48" height="48" alt="Avatar">
                <h4 style="margin-top: 0">{{{ $tutor->name }}}</h4>
                <p class="article-author-description uk-overflow-container uk-text-small">
                    {{ nl2br($tutor->description) }}
                </p>
            </div>
        </article>
    @endforeach

    <hr />
</div>

<div class="attend-now uk-panel" style="padding-left: 15px;">
    <a class="uk-button uk-button-success uk-button-hero uk-width-1-1" data-uk-smooth-scroll href="#stages">
        <span class="uk-icon-long-arrow-down"></span> 觀看開課梯次
    </a>
</div>

<br /><br />

<ul class="uk-nav uk-nav-side side-menu side-bar" data-uk-nav>

    <li class="uk-nav-header">分類</li>
    <li>
        <a href="{{{ $router->buildHtml('category_courses', ['category_alias' => $category->alias]) }}}">{{{ $category->title }}}</a>
    </li>

    <li class="uk-nav-divider"></li>

    <li class="uk-nav-header">相關課程</li>

    @foreach($recommends as $item)
    <li>
        <a href="{{{ $item->link }}}">
            {{{ $item->title }}}
        </a>
    </li>
    @endforeach

    <li class="uk-nav-divider"></li>

    <li class="uk-nav-header">隨機推薦</li>

    @foreach($randoms as $item)
        <li>
            <a href="{{{ $item->link }}}">
                {{{ $item->title }}}
            </a>
        </li>
    @endforeach

    <li class="uk-nav-divider"></li>

    <li class="uk-nav-header">開課梯次</li>

    @foreach ($stages as $stage)
    <li>
        <a href="{{{ $router->buildHtml('stage', ['id' => $stage->id, 'course_alias' => $item->alias, 'category_alias' => $category->alias]) }}}"  data-uk-tooltip title="{{{ $stage->time }}}">
            {{{ $stage->title }}}
        </a>
    </li>
    @endforeach
</ul>