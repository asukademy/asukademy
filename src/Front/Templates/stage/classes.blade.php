{{-- Part of asukademy project. --}}

<table class="uk-table uk-table-striped">
    <thead>
    <th width="10%">#</th>
    @if (!$item->classes->date)
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
            @if (!$item->classes->date)
            <td>
                @if ($class->date)
                    {{{ $class->date }}}

                    {{{ $class->start }}}
                    @if ($class->start && $class->end)
                    {{{ $class->start }}} ~ {{{ $class->end }}}
                    @endif
                @else
                    ---
                @endif
            </td>
            @endif
            <td>
                {{{ $class->hours }}} hrs
            </td>
            <td>
                {{{ $class->title }}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>