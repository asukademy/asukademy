{{-- Part of asukademy project. --}}

@foreach (array_chunk($items, 3) as $rowItems)
    <div class="uk-grid">
        @foreach ($rowItems as $item)
            @include('item')
        @endforeach
    </div>
@endforeach