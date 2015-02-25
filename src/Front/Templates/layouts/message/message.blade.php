{{-- Part of asukademy project. --}}
<div class="message-wrap uk-container uk-container-center">
    @foreach ((array) $flashes as $type => $typeBag)
        <div class="uk-alert uk-alert-{{{$type}}}" data-uk-alert>
            <a href="" class="uk-alert-close uk-close"></a>

            @foreach ((array) $typeBag as $msg)
                <p>{{ $msg }}</p>
            @endforeach

        </div>
    @endforeach
</div>