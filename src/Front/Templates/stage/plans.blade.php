{{-- Part of asukademy project. --}}

<table class="uk-table">
    <thead>
    <th>方案名稱</th>
    <th>價格</th>
    <th>人數</th>
    <th>立即報名</th>
    </thead>

    <tbody>
    @foreach ($plans as $plan)
        <tr>
            <th>{{{ $plan->title }}}</th>
            <td>
                @if ($plan->origin_price && $plan->origin_price != $plan->price)
                    <s>${{{ number_format($plan->origin_price, 0) }}}</s>
                @endif
                ${{{ number_format($plan->price, 0) }}}
            </td>
            <td>
                @if (!$plan->quota)
                    不限 ({{{ $plan->people }}})
                @elseif ($plan->attendable)
                    {{{ $plan->people }}} / {{{ (int) $plan->quota }}}
                @else
                    額滿 ({{{ $plan->people }}} / {{{ (int) $plan->quota }}})
                @endif
            </td>
            <td>
                <a class="uk-button uk-button-success" href="{{{ $router->buildHtml('order', ['plan_id' => $plan->id]) }}}">
                    <span class="uk-icon-sign-in"></span> 立即報名
                </a>
            </td>
        </tr>
    @endforeach
    <tr>
        <th>總人數</th>
        <td colspan="5">
            @if (!$item->quota)
                不限
            @else
            {{{ $item->total }}} / {{{ $item->quota }}}
            @endif
        </td>
    </tr>
    </tbody>
</table>