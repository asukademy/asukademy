{{-- Part of asukademy project. --}}

<div class="uk-width-medium-1-3 course-item">
    <a href="{{{ $item->link }}}">
        <img class="uk-border-rounded work-img" src="{{{ $item->image }}}" alt="HTML &amp; CSS 基礎入門 Image">
    </a>

    <h2><a href="{{{ $item->link }}}">{{{ $item->title }}}</a></h2>

    <p class="uk-article-lead uk-text-muted">{{{ $item->subtitle }}}</p>

    <p>
        {{ nl2br($item->introtext) }}
    </p>


    <p>
        <a class="uk-button uk-button-primary" href="{{{ $item->link }}}">瞭解詳情</a>
    </p>
</div>