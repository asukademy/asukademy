{{-- Part of asukademy project. --}}

<div class="sub-toolbar">
{{ \Riki\Toolbar\Toolbar::add('stage', 'admin:new', ['queries' => ['course_id' => $item->id]]) }}
</div>

<hr />

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>ID</th>
        <th>標題</th>
        <th>日期</th>
        <th>人數限制</th>
        <th>狀態</th>
        <th>刪除</th>
    </tr>
    </thead>
    @forelse($stages as $k => $stage)

        <tr>
            <td>
                <input type="checkbox" name="cid[]" id="cb{{ $k }}" />
            </td>
            <td>
                {{{ $stage->id }}}
            </td>
            <td>
                {{ \Riki\Toolbar\Toolbar::edit($stage->title, $stage->id, 'admin:stage', ['course_id' => $item->id]) }}
            </td>
            <td>
                {{{ $stage->start }}} ~ {{{ $stage->end }}}
            </td>
            <td>
                {{{ $stage->quota }}}
            </td>
            <td>
                @if ($stage->state)
                    <span class="label label-success">啟動</span>
                @else
                    <span class="label label-danger">關閉</span>
                @endif
            </td>
            <td>
                <button type="button" class="btn btn-default"
                        onclick="RikiForm.deleteItem('{{{ $router->buildHttp('stage', ['id' => $item->id]) }}}');">
                    <span class="glyphicon glyphicon-trash text-danger"></span>
                </button>
            </td>
        </tr>

    @empty

        <tr>
            <td colspan="20">
                沒有開課梯次
            </td>
        </tr>

    @endforelse
</table>
