{{-- Part of asukademy project. --}}

@foreach($fields as $field)
<div class="form-group">
    <?php
    $field->set('class', $field->get('class') . ' form-control');
    ?>
    <div class="{{{ $label_cols }}}">
        {{ $field->renderLabel() }}
    </div>
    <div class="{{ $input_cols }}">
        {{ $field->renderInput() }}
    </div>
</div>
@endforeach
