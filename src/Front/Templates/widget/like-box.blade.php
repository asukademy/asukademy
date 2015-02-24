{{-- Part of asukademy project. --}}

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like-box" data-href="https://www.facebook.com/asukademy" data-width="1200px" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true" style="width: 100%;"></div>

@section('style')
@parent
<style>
    #fb-root {
        display: none;
    }

    /* To fill the container and nothing else */

    .fb_iframe_widget, .fb_iframe_widget span, .fb_iframe_widget span iframe[style] {
        width: 100% !important;
    }
</style>
@stop