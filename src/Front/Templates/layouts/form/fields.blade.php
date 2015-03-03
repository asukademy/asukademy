{{-- Part of asukademy project. --}}

@foreach($fields as $field)
<div class="uk-form-row">
    <?php
    $field->appendAttribute('labelClass', 'uk-form-label');
    $field->appendAttribute('class', $input_cols);
    ?>
    @if (!($field instanceof \Windwalker\Form\Field\HiddenField))
    {{ $field->renderLabel() }}
    @endif
    <div class="{{ '' }} uk-form-controls">
        {{ $field->renderInput() }}
    </div>
</div>
@endforeach
