
@extends('_global.mail')

@section('body')
    <div class="body-inner">
        <h2>管理員 您好:</h2>

        <br />

        <h3>{{{ $item->name }}} 報名了這個課程:</h3>

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

        <h3>報名者資料</h3>
        <table>
            <tbody>
            <tr>
                <th style="min-width: 130px;">姓名</th>
                <td>{{{ $item->name }}}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{{ $item->email }}}</td>
            </tr>
            <tr>
                <th>匿稱</th>
                <td>{{{ $item->nick }}}</td>
            </tr>
            <tr>
                <th>手機</th>
                <td>{{{ $item->mobile }}}</td>
            </tr>
            <tr>
                <th>電話</th>
                <td>{{{ $item->phone }}}</td>
            </tr>
            <tr>
                <th>地址</th>
                <td>{{{ $item->address }}}</td>
            </tr>
            <tr>
                <th>組織</th>
                <td>{{{ $item->organization }}}</td>
            </tr>
            <tr>
                <th>統編</th>
                <td>{{{ $item->vat }}}</td>
            </tr>
            <tr>
                <th>職稱</th>
                <td>{{{ $item->title }}}</td>
            </tr>
            </tbody>
        </table>

        <br />

        <p>觀看報名詳細資訊</p>

        <p>
            <a href="{{{ $router->buildHtml('admin:order', ['id' => $item->id], \Windwalker\Core\Router\RestfulRouter::TYPE_FULL) }}}"
                    style="padding: 7px 10px; background-color: #00a8e6; box-shadow: 0 4px 0 #0091cc; color: #fff;
				display: inline-block; border-radius: 3px; text-decoration: none;"
                    >報名管理頁面
            </a>
        </p>

        <br /><br />
        <p>Asukademy 飛鳥學院 敬上</p>
    </div>
@stop
