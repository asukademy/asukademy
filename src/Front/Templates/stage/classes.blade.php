{{-- Part of asukademy project. --}}

<table class="uk-table uk-table-striped">
    <thead>
    <th width="1%">#</th>
    @if ($item->classes->date)
    <th>上課時間</th>
    @endif
    <th width="15%">時數</th>
    <th>課程內容</th>
    </thead>

    <tbody>
    @foreach ($item->classes as $k => $class)
        <tr>
            <td>
                {{{ $k + 1 }}}
            </td>
            @if ($item->classes->date)
            <td style="white-space: nowrap;">
                @if ($class->date)
                    {{{ $class->date }}}
                    ({{{ \Asukademy\Helper\DateTimeHelper::getWeekday($class->date) }}})

                    @if ($class->start && $class->end)
                    {{{ \Asukademy\Helper\ClassHelper::getTimeByID($class->start) }}}
                    ~
                    {{{ \Asukademy\Helper\ClassHelper::getTimeByID($class->end) }}}
                    @elseif ($class->start)
                    {{{ \Asukademy\Helper\ClassHelper::getTimeByID($class->start) }}}
                    @endif
                @else
                    ---
                @endif
            </td>
            @endif
            <td style="white-space: nowrap;">
                {{{ $class->hours }}} hrs
            </td>
            <td>
                <span class="uk-text-large">
                {{{ $class->title }}}

                @if ($class->intro)
                - <span class="uk-text-muted">{{{ $class->intro }}}</span>
                @endif
                </span>

                @if ($class->description)
                <p>
                    {{ Asukademy\Markdown\Markdown::defaultTransform($class->description) }}
                </p>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>