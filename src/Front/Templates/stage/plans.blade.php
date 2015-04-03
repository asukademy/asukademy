{{-- Part of asukademy project. --}}

<table class="uk-table">
    <thead>
    <th style="min-width: 55px;">方案<span class="uk-hidden-small">名稱</span></th>
    <th></th>
    <th>價格</th>
    <th>名額</th>
    <th><span class="uk-hidden-small">立即</span>報名</th>
    </thead>

    <tbody>
    @foreach ($plans as $plan)
        <tr>
            <th>{{{ $plan->title }}}</th>
            <td>
                @if ($plan->start || $plan->end)

                <?php
                $start = $plan->start ? : '即日起';
                $end = $plan->end ? : '活動開始';
                ?>
                <span class="uk-icon-clock-o"  data-uk-tooltip title="本方案可報名時間: <br> {{{ $start }}} <br>至<br> {{{ $end }}}"></span>
                @endif
            </td>
            <td>
                @if ((int) $plan->price)
                    @if ((int) $plan->origin_price && $plan->origin_price != $plan->price)
                        <s>${{{ number_format($plan->origin_price, 0) }}}</s>
                    @endif
                    ${{{ number_format($plan->price, 0) }}}
                @else
                    免費
                @endif
            </td>
            <td>
                @if (!$plan->quota)
                    不限
                    {{--({{{ $plan->people }}})--}}
                @elseif ($plan->attendable)
                    {{--{{{ $plan->people }}} / --}}
                    {{{ (int) $plan->quota }}}
                @else
                    {{--額滿 ({{{ $plan->people }}} / {{{ (int) $plan->quota }}})--}}

                    {{{ (int) $plan->quota }}} (額滿)
                @endif
            </td>
            <td>
                @if ($plan->attendable)
                <a class="uk-button uk-button-success" href="{{{ $router->buildHtml('order', ['plan_id' => $plan->id]) }}}">
                    <span class="uk-icon-sign-in"></span>
                    <span class="uk-hidden-small">立即報名</span>
                </a>
                @else
                <button class="uk-button uk-button-success" disabled>
                    <span class="uk-icon-sign-in"></span>
                    <span class="uk-hidden-small">立即報名</span>
                </button>
                @endif
            </td>
        </tr>
    @endforeach
    <tr>
        <th>總人數限制</th>
        <td colspan="5">
            @if (!$item->quota)
                不限
            @else
            {{--{{{ $item->total }}} / --}}
            {{{ $item->quota }}}
            @endif
        </td>
    </tr>
    </tbody>
</table>