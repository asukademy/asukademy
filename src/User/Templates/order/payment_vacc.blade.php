{{-- Part of asukademy project. --}}

<p>
    您可透過自己的網路銀行或 ATM 櫃員機完成轉帳
</p>

<table class="uk-table">
    <tr width="130">
        <th>付款方式</th>
        <td>{{{ \Windwalker\Pay2Go\Pay2GoHelper::getPaymentTitle($item->payment) }}}</td>
    </tr>
    <tr>
        <th>銀行代碼</th>
        <td>{{{ $payment->getBankCode() }}}</td>
    </tr>
    <tr>
        <th>轉帳帳號</th>
        <td>{{{ $payment->getCodeNo() }}}</td>
    </tr>
    <tr>
        <th>金額</th>
        <td>{{{ number_format($payment->getAmt(), 0) }}}</td>
    </tr>
    <tr>
        <th>訂單編號</th>
        <td>{{{ $payment->getMerchantOrderNo() }}}</td>
    </tr>
    <tr>
        <th>有效繳費期限</th>
        <td>{{{ $payment->getExpireDate() }}}</td>
    </tr>

</table>