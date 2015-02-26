{{-- Part of asukademy project. --}}

@extends('layouts.global.manager')

@section('page_title')
已報名課程資料
@stop

@section('body')
    <section id="manager-section" class="main-block manager-layout">
        <div class="uk-container uk-container-center">

            <article class="article-content">

                <div class="uk-grid">
                    <div class="uk-width-medium-3-4">
                        <h1>{{{ $item->course->title }}} ({{{ $item->plan->title }}})</h1>
                        <h3>{{{ $item->stage->title }}}</h3>
                    </div>

                    <div class="uk-width-medium-1-4">
                        @if ($item->state == 0)
                            <button type="button" class="disabled uk-button uk-button-danger uk-button-hero uk-width-1-1">
                                審核中
                            </button>
                        @elseif ($item->state == 1)
                            <button type="button" class="disabled uk-button uk-button-primary uk-button-hero uk-width-1-1">
                                立即付款
                            </button>
                        @else
                            <button type="button" class="disabled uk-button uk-button-success uk-button-hero uk-width-1-1">
                                報名成功
                            </button>
                        @endif
                    </div>
                </div>

                <div class="uk-grid">
                    <div class="uk-width-medium-1-2">
                        <table class="uk-table">
                            <tbody>
                            <tr>
                                <th>姓名</th>
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
                                <th>職稱</th>
                                <td>{{{ $item->payment }}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="uk-width-medium-1-2">
                        <table class="uk-table">
                            <tbody>
                            <tr>
                                <th>課程名稱</th>
                                <td>
                                    <a href="{{{ $router->buildHtml('front:course', ['alias' => $item->course->alias, 'category_alias' => $item->category->alias]) }}}">
                                        {{{ $item->course->title }}}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>開課梯次</th>
                                <td>
                                    <a href="{{{ $router->buildHtml('front:stage', ['id' => $item->stage->id, 'course_alias' => $item->course->alias, 'category_alias' => $item->category->alias]) }}}">
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
                                <td>{{{ $item->stage->start }}} ~ {{{ $item->stage->end }}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </article>

        </div>
    </section>
@stop
