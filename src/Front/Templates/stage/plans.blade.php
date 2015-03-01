{{-- Part of asukademy project. --}}

<table class="uk-table">
    <thead>
    <th style="min-width: 55px;">方案<span class="uk-hidden-small">名稱</span></th>
    <th>價格</th>
    <th>人數</th>
    <th><span class="uk-hidden-small">立即</span>報名</th>
    </thead>

    <tbody>
    @foreach ($plans as $plan)
        <tr>
            <th>{{{ $plan->title }}}</th>
            <td>
                @if ((int) $plan->origin_price && $plan->origin_price != $plan->price)
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
                    <span class="uk-icon-sign-in"></span>
                    <span class="uk-hidden-small">立即報名</span>
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