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
    @if (count($tutors))
    <tr>
        <th>課程講師</th>
        <td>
            {{{ implode(' / ', $tutors->name) }}}
        </td>
    </tr>
    @endif

    @if ($item->hours)
    <tr>
        <th>課程時數</th>
        <td>
            {{{ $item->hours }}} 小時
        </td>
    </tr>
    @endif
    <tr>
        <th>課程費用</th>
        <td>
            @if ($item->all_free)
                免費
            @else
                @if (count($plans) == 1)
                    ${{{ number_format($item->price_max, 0) }}}
                @elseif ($item->price_min == $item->price_max)
                    ${{{ number_format($item->price_max, 0) }}}
                @else
                    ${{{ number_format($item->price_min, 0) }}} ~ ${{{ number_format($item->price_max, 0) }}}
                @endif

                {{{ $item->has_free ? '(含免費方案)' : null }}}
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
            <a target="_blank" href="{{{ $item->position->url }}}">
                {{{ $item->position->title }}}
            </a>
            (<a target="_blank" href="{{{ $item->position->map }}}">{{{ $item->position->address }}}</a>)
        </td>
    </tr>
    </tbody>
</table>

@if ($item->position->address)
    <iframe
            width="100%"
            height="350"
            frameborder="0"
            style="border:0"
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyC04nF4KXjfR2VQ0jsFm5vEd9LbyiXqbKw&q={{{ $item->position->address }}}">
    </iframe>
@endif