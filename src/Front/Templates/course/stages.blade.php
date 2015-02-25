{{-- Part of asukademy project. --}}

<table class="uk-table">
    <thead>
    <th>梯次名稱</th>
    <th>日期</th>
    <th>地點</th>
    <th>人數</th>
    <th>詳細資訊</th>
    <th>立即報名</th>
    </thead>

    <tbody>
    @foreach($stages as $stage)
        <tr>
            <td>{{{ $stage->title }}}</td>
            <td>{{{ $stage->time }}}</td>
            <td>{{{ $stage->position->title }}}</td>
            <td>
                @if ($stage->attendable)
                    {{{ $stage->people }}} / {{{ $stage->quota }}}
                @else
                    額滿
                @endif
            </td>
            <td>
                <a class="uk-button" href="#">
                    詳細資訊
                </a>
            </td>
            <td>
                <a class="uk-button" href="#">
                    立即報名
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>