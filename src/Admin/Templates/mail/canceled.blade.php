
@extends('_global.mail')

@section('body')
    <div class="body-inner">
        <h2>{{{ $item->name }}} 您好:</h2>

        <br />

        <h3 style="color: #da314b;">您的報名已被取消，可能是因為審核未通過或是超出付款期限。您可以隨時重新報名此課程:</h3>

        <table class="uk-table">
            <tbody>
            <tr>
                <th style="min-width: 130px;">課程名稱</th>
                <td>
                    <a href="{{{ $router->buildHtml('front:course', ['alias' => $item->course->alias, 'category_alias' => $item->category->alias], \Windwalker\Core\Router\RestfulRouter::TYPE_FULL) }}}">
                        {{{ $item->course->title }}}
                    </a>
                </td>
            </tr>
            <tr>
                <th>開課梯次</th>
                <td>
                    <a href="{{{ $router->buildHtml('front:stage', ['id' => $item->stage->id, 'course_alias' => $item->course->alias, 'category_alias' => $item->category->alias], \Windwalker\Core\Router\RestfulRouter::TYPE_FULL) }}}">
                        {{{ $item->stage->title }}}
                    </a>
                </td>
            </tr>
            <tr>
                <th>方案名稱</th>
                <td>{{{ $item->plan->title }}}</td>
            </tr>
            <tr>
                <th>費用</th>
                <td>{{{ number_format($item->price, 0) }}}</td>
            </tr>
            <tr>
                <th>上課時間</th>
                <td>
                    {{{ \Asukademy\Helper\DateTimeHelper::format($item->stage->start, \Asukademy\Helper\DateTimeHelper::FORMAT_YMD_HI) }}}
                    ~
                    {{{ \Asukademy\Helper\DateTimeHelper::format($item->stage->end, \Asukademy\Helper\DateTimeHelper::FORMAT_YMD_HI) }}}
                </td>
            </tr>
            </tbody>
        </table>

        <br />

        <p>前往報名資訊頁面確認您的資訊</p>

        <p>
            <a href="{{{ $router->buildHtml('user:order', ['id' => $item->id], \Windwalker\Core\Router\RestfulRouter::TYPE_FULL) }}}"
                    style="padding: 9px 10px; background-color: #8cc14c; color: #fff;
				display: inline-block; border-radius: 3px; text-decoration: none;"
                    >報名資訊
            </a>
        </p>

        <br /><br />
        <p>Asukademy 飛鳥學院 敬上</p>
    </div>
@stop
