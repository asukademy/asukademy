{{-- Part of asukademy project. --}}

<h2>講師</h2>

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

<p class="uk-text-center uk-panel uk-text-large">
    分類： <a href="{{{ $router->buildHtml('category_courses', ['category_alias' => $category->alias]) }}}">{{{ $category->title }}}</a>
</p>

<hr />

<h2>相關課程</h2>

<ul class="uk-nav uk-nav-side side-menu side-bar" data-uk-nav>
    @foreach($recommends as $item)
    <li>
        <a href="{{{ $item->link }}}">
            {{{ $item->title }}}
        </a>
    </li>
    @endforeach
</ul>

<h2>隨機推薦</h2>

<ul class="uk-nav uk-nav-side side-menu side-bar" data-uk-nav>
    @foreach($randoms as $item)
        <li>
            <a href="{{{ $item->link }}}">
                {{{ $item->title }}}
            </a>
        </li>
    @endforeach
</ul>

<h2>開課梯次</h2>

<table class="uk-table">
    <tbody>
    @foreach ($stages as $stage)
        <tr>
            <td>
                <a href=""  data-uk-tooltip title="{{{ $stage->time }}}">
                    {{{ $stage->title }}}
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
