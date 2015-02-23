{{-- Part of asukademy project. --}}

@foreach($fields as $field)
<div class="form-group">
    <?php
    $field->set('class', $field->get('class') . ' form-control');
    $field->set('labelClass', $field->get('labelClass') . ' control-label ' . $label_cols);
    ?>
    {{ $field->renderLabel() }}
    <div class="{{ $input_cols }}">
        {{ $field->renderInput() }}
    </div>
</div>
@endforeach
