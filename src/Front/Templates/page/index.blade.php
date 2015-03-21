{{-- Part of asukademy project. --}}

@extends('layouts.global.home')

@section('body')
    <section id="features" class="main-block">
        <div class="uk-container uk-container-center">
            <div class="uk-grid" data-uk-grid-match>
                <div class="uk-width-medium-1-2 uk-margin-top uk-margin-bottom feature-desc">
                    <h2>What Is Asukademy</h2>
                    <p>
                        飛鳥，在日文中意味著「安居之地」，意即這個地方，既能如飛鳥般意氣風發、前程萬里，卻又是一個讓人寧靜定居的故鄉。
                        我們希望飛鳥學院能夠帶領學生們意氣風發的面對人生，在競爭激烈的現代社會中立足，更希望成為員工們的安居之地，專心面對人生的一切挑戰。
                    </p>
                    <p class="uk-text-right">
                        <a class="uk-button" href="{{{ $router->buildHtml('page', ['paths' => 'about']) }}}">了解更多</a>
                    </p>
                </div>

                <div class="uk-width-medium-1-4 uk-margin-top uk-margin-bottom feature-img">
                    <a href="{{{ $router->buildHtml('courses') }}}">
                        <img src="{{{ $uri['media.path'] }}}img/home/course-info.jpg" alt="Image" />
                    </a>
                </div>

                <div class="uk-width-medium-1-4 uk-margin-top uk-margin-bottom feature-img">
                    <a href="{{{ $router->buildHtml('page', ['paths' => 'faq']) }}}">
                        <img src="{{{ $uri['media.path'] }}}img/home/faq.jpg" alt="Image" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="what-we-do" class="feature-block">
        <div class="uk-container uk-container-center">
            <h2>What We Do</h2>
            <p>我們提供程式開發、設計、管理、藝術文教類各種課程，</p>
            <p>並切合職場實際需求，直接與業界接軌。</p>
        </div>
    </section>

    <section id="our-feature" class="feature-block">
        <div class="uk-container uk-container-center">
            <h2>Our Feature</h2>
            <p>飛鳥學院重視教學理論的設計，採螺旋式漸進教學，由淺入深，</p>
            <p>並盡可能提供培養實戰經驗的機會，讓學員掌握實用的工作技能。</p>
        </div>
    </section>

    <section id="our-concept" class="feature-block">
        <div class="uk-container uk-container-center">
            <h2>Our Concept</h2>
            <p>每個人都有潛能，只是因為環境的限縮，而無法發揮最大價值。</p>
            <p>飛鳥學院希望能激發學員的潛力，替他們在未來的人生路線找出新方向。</p>
        </div>
    </section>

    <section id="fan-page" class="main-block">
        <div class="uk-container uk-container-center uk-text-center">
            <h1>Subscribe Us</h1>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-like-box" data-href="https://www.facebook.com/asukademy" data-width="1200px" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true" style="width: 100%;"></div>
            <style>
                #fb-root {
                    display: none;
                }

                /* To fill the container and nothing else */

                .fb_iframe_widget, .fb_iframe_widget span, .fb_iframe_widget span iframe[style] {
                    width: 100% !important;
                }
            </style>

            <p>
                <a style="margin-top: 50px;" class="see-course-button uk-button uk-button-hero uk-button-primary" href="{{{ $router->buildHtml('page', ['paths' => 'courses']) }}}">
                    立即了解我們的課程內容
                </a>
            </p>
        </div>
    </section>
@stop
