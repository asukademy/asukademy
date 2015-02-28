{{-- Part of asukademy project. --}}

<table class="uk-table">
    <tbody>
    <tr>
        <th>課程名稱</th>
        <td>
            {{{ $item->course->title }}}
        </td>
    </tr>
    <tr>
        <th>開課梯次</th>
        <td>
            {{{ $item->title }}}
        </td>
    </tr>
    <tr>
        <th>課程講師</th>
        <td>
            {{{ implode(' / ', $tutors->name) }}}
        </td>
    </tr>
    <tr>
        <th>課程時數</th>
        <td>
            {{{ array_sum($item->classes->hours) }}} 小時
        </td>
    </tr>
    <tr>
        <th>課程費用</th>
        <td>
            @if (count($item->plans) == 1)
                ${{{ number_format($item->price_max, 0) }}}
            @else
                ${{{ number_format($item->price_min, 0) }}} ~ ${{{ number_format($item->price_max, 0) }}}
            @endif
        </td>
    </tr>
    <tr>
        <th>招生人數</th>
        <td>{{{ $item->quota }}} 人</td>
    </tr>
    <tr>
        <th>上課地點</th>
        <td>
            <a href="{{{ $item->position->url }}}">
                {{{ $item->position->title }}}
            </a>
            (<a target="_blank" href="{{{ $item->position->map }}}">{{{ $item->position->address }}}</a>)
        </td>
    </tr>
    </tbody>
</table>