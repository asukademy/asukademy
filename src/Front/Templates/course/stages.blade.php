{{-- Part of asukademy project. --}}

<table class="uk-table">
    <thead>
    <th>梯次名稱</th>
    <th width="100">日期</th>
    <th>地點</th>
    <th width="60" class="uk-hidden-small">人數</th>
    <th width="95">詳細資訊</th>
    <th width="95" class="uk-hidden-small">立即報名</th>
    </thead>

    <tbody>
    @foreach($stages as $stage)
        <tr>
            <td>{{{ $stage->title }}}</td>
            <td>{{{ $stage->time }}}</td>
            <td>{{{ $stage->position->title }}}</td>
            <td class="uk-hidden-small">
                @if ($stage->attendable && !$stage->quota)
                    不限 ({{{ $stage->total }}})
                @elseif ($stage->attendable)
                    {{{ $stage->people }}} / {{{ $stage->quota }}}
                @else
                    <span data-uk-tooltip title="{{{ $stage->people }}} / {{{ $stage->quota }}}">
                        額滿
                    </span>
                @endif
            </td>
            <td>
                <a class="uk-button" href="{{{ $link = $router->buildHtml('stage', ['id' => $stage->id, 'course_alias' => $item->alias, 'category_alias' => $category->alias]) }}}">
                    詳細資訊
                </a>
            </td>
            <td class="uk-text-center uk-hidden-small">
                @if ($stage->attendable)
                <a class="uk-button" href="{{{ $link . '#attend' }}}">
                    立即報名
                </a>
                @else
                -
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>