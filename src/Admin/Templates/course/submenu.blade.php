{{-- Part of asukademy project. --}}

<ul class="nav nav-pills">
    <li role="presentation" class="active"><a href="{{{ $router->buildHtml('course', ['id' => $course->id]) }}}">課程資訊</a></li>
    <li role="presentation"><a href="{{{ $router->buildHtml('stages', ['course_id' => $course->id]) }}}">開課梯次</a></li>
    <li role="presentation"><a href="#"></a></li>
</ul>
