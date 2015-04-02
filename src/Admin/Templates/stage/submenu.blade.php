{{-- Part of asukademy project. --}}
<?php
$disabled = null;

if (!$stage_id)
{
    $active = 'stage';
    $disabled = 'disabled';
}
?>

<ul class="nav nav-pills nav-stacked">
    <li role="presentation" class="{{ $active == 'stage' ? 'active' : null }} {{ $disabled }}">
        <a href="{{{ $disabled ? '#' : $router->buildHtml('stage', ['course_id' => $course_id, 'id' => $stage_id]) }}}">開課編輯</a>
    </li>
    <li role="presentation" class="{{ $active == 'plans' ? 'active' : null }} {{ $disabled }}">
        <a href="{{{ $disabled ? '#' : $router->buildHtml('plans', ['course_id' => $course_id, 'stage_id' => $stage_id]) }}}">票價方案</a>
    </li>
    <li role="presentation" class="{{ $active == 'classes' ? 'active' : null }} {{ $disabled }}">
        <a href="{{{ $disabled ? '#' : $router->buildHtml('classes', ['course_id' => $course_id, 'stage_id' => $stage_id]) }}}">課程內容</a>
    </li>
    <li role="presentation" class="{{ $active == 'checkin' ? 'active' : null }} {{ $disabled }}">
        <a href="{{{ $disabled ? '#' : $router->buildHtml('checkin', ['course_id' => $course_id, 'stage_id' => $stage_id]) }}}">簽到管理</a>
    </li>
</ul>

<hr />
@if (!$stage_id)

<div class="alert alert-info">
    請先儲存此開課資訊才能編輯票價與課程內容
</div>
@endif
