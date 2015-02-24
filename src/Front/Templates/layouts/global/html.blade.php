<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">

    <link rel="shortcut icon" href="media/favicon.ico" type="image/x-icon">
    <link rel="icon" href="media/favicon.ico" type="image/x-icon">

    <title>@yield('page_title', 'Asukademy 飛鳥學院')</title>

@if ($app->get('meta.description'))
    <meta name="description" content="{{{ $app->get('meta.description') }}}">
@endif
    <meta name="generator" content="The Time Machine">

@if ($app->get('og.image'))
    <meta property="og:image" content="https://cloud.githubusercontent.com/assets/1639206/4780266/64533a2a-5c60-11e4-9908-628396b5f69d.jpg">
@endif
    <meta property="og:title" content="@yield('page_title')">
    <meta property="og:site_name" content="Asukademy 飛鳥學院">
@if ($app->get('meta.description'))
    <meta property="og:description" content="{{{ $app->get('meta.description') }}}">
@endif


    <!-- HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- styles -->
    <link rel="stylesheet" href="{{{ $uri['media.path'] }}}css/uikit.min.css">
@yield('style')
    <link rel="stylesheet" type="text/css" href="{{{ $uri['media.path'] }}}css/front/main.css?{{{ Riki\Asset\Asset::getVersion() }}}">

    <!-- scripts -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{{ $uri['media.path'] }}}js/uikit.min.js"></script>
@yield('script')

    <script type="text/javascript">var _jf = _jf || [];_jf.push(['p','29887']);_jf.push(['_setFont','xingothic-tc-w4','css','.xingothic-tc-w4']);_jf.push(['_setFont','xingothic-tc-w4','css','xin4']);_jf.push(['_setFont','xingothic-tc-w4','alias','Xin4']);_jf.push(['_setFont','xingothic-tc-w6','css','.xingothic-tc-w6']);_jf.push(['_setFont','xingothic-tc-w6','css','xin6']);_jf.push(['_setFont','xingothic-tc-w6','alias','Xin6']);(function(f,q,c,h,e,i,r,d){var k=f._jf;if(k.constructor===Object){return}var l,t=q.getElementsByTagName("html")[0],a=function(u){for(var v in k){if(k[v][0]==u){if(false===k[v][1].call(k)){break}}}},j=/\S+/g,o=/[\t\r\n\f]/g,b=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,g="".trim,s=g&&!g.call("\uFEFF\xA0")?function(u){return u==null?"":g.call(u)}:function(u){return u==null?"":(u+"").replace(b,"")},m=function(y){var w,z,v,u,x=typeof y==="string"&&y;if(x){w=(y||"").match(j)||[];z=t[c]?(" "+t[c]+" ").replace(o," "):" ";if(z){u=0;while((v=w[u++])){if(z.indexOf(" "+v+" ")<0){z+=v+" "}}t[c]=s(z)}}},p=function(y){var w,z,v,u,x=arguments.length===0||typeof y==="string"&&y;if(x){w=(y||"").match(j)||[];z=t[c]?(" "+t[c]+" ").replace(o," "):"";if(z){u=0;while((v=w[u++])){while(z.indexOf(" "+v+" ")>=0){z=z.replace(" "+v+" "," ")}}t[c]=y?s(z):""}}},n;k.push(["_eventActived",function(){p(h);m(e)}]);k.push(["_eventInactived",function(){p(h);m(i)}]);k.addScript=n=function(u,A,w,C,E,B){E=E||function(){};B=B||function(){};var x=q.createElement("script"),z=q.getElementsByTagName("script")[0],v,y=false,D=function(){x.src="";x.onerror=x.onload=x.onreadystatechange=null;x.parentNode.removeChild(x);x=null;a("_eventInactived");B()};if(C){v=setTimeout(function(){D()},C)}x.type=A||"text/javascript";x.async=w;x.onload=x.onreadystatechange=function(G,F){if(!y&&(!x.readyState||/loaded|complete/.test(x.readyState))){y=true;if(C){clearTimeout(v)}x.src="";x.onerror=x.onload=x.onreadystatechange=null;x.parentNode.removeChild(x);x=null;if(!F){setTimeout(function(){E()},200)}}};x.onerror=function(H,G,F){if(C){clearTimeout(v)}D();return true};x.src=u;z.parentNode.insertBefore(x,z)};a("_eventPreload");m(h);n(r,"text/javascript",false,3000)})(this,this.document,"className","jf-loading","jf-active","jf-inactive","//d3gc6cgx8oosp4.cloudfront.net/js/stable/v/4.6/id/54380144134");</script>
</head>
<body>
<nav id="header" class="uk-navbar uk-navbar-attached home">
    <div class="uk-container uk-container-center">

        <a id="big-logo" class="uk-navbar-brand uk-hidden-small" href="">
            <img class="uk-margin uk-margin-remove" src="{{{ $uri['media.path'] }}}img/asukademy-logo-horz.png" title="Asukademy" alt="Asukademy">
        </a>

        <a href="#" class="uk-navbar-toggle uk-visible-small" data-uk-toggle="{target:'#mainmenu', cls: 'uk-hidden-small'}"></a>

        <a id="small-logo" class="uk-navbar-brand uk-navbar-center uk-visible-small" href="">
            <img class="uk-margin uk-margin-remove" style="max-width: 95%;" src="{{{ $uri['media.path'] }}}img/asukademy-logo-horz.png" title="Asukademy" alt="Asukademy">
        </a>

        <ul id="mainmenu" class="uk-navbar-nav uk-float-right uk-hidden-small">
            <li class="">
                <a href="about">
                    <span class="menu-item-title">關於我們</span>
                    <span class="menu-item-sub-title">About</span>
                </a>
            </li>

            <li class="">
                <a href="courses">
                    <span class="menu-item-title">課程資訊</span>
                    <span class="menu-item-sub-title">Courses</span>
                </a>
            </li>

            <li class="">
                <a href="http://blog.asukademy.com">
                    <span class="menu-item-title">部落格</span>
                    <span class="menu-item-sub-title">Blog</span>
                </a>
            </li>

            <li class="">
                <a href="faq">
                    <span class="menu-item-title">常見問題</span>
                    <span class="menu-item-sub-title">FAQ</span>
                </a>
            </li>

            <li class="">
                <a href="contact">
                    <span class="menu-item-title">聯絡與諮詢</span>
                    <span class="menu-item-sub-title">Contact</span>
                </a>
            </li>
        </ul>

    </div>
</nav>

<section id="banner" style="background-image: url({{{ $uri['media.path'] }}}img/banner/banner-2000-2.jpg);height:650px ;">
    <div class="banner-inner">

    </div>
</section>

<div id="main-body">

    <section id="features" class="main-block">
        <div class="uk-container uk-container-center">
            <div class="uk-grid" data-uk-grid-match>
                <div class="uk-width-medium-1-2 feature-desc">
                    <h2>What Is Asukademy</h2>
                    <p>
                        飛鳥，在日文中意味著「安居之地」，意即這個地方，既能如飛鳥般意氣風發、前程萬里，卻又是一個讓人寧靜定居的故鄉。
                        我們希望飛鳥學院能夠帶領學生們意氣風發的面對人生，在競爭激烈的現代社會中立足，更希望成為員工們的安居之地，專心面對人生的一切挑戰。
                    </p>
                    <p class="uk-text-right">
                        <a class="uk-button" href="about">了解更多</a>
                    </p>
                </div>

                <div class="uk-width-medium-1-4 feature-img">
                    <a href="courses">
                        <img src="media/img/home/course-info.jpg" alt="Image" />
                    </a>
                </div>

                <div class="uk-width-medium-1-4 feature-img">
                    <a href="faq">
                        <img src="media/img/home/faq.jpg" alt="Image" />
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
                <a style="margin-top: 50px;" class="see-course-button uk-button uk-button-hero uk-button-primary" href="courses">
                    立即了解我們的課程內容
                </a>
            </p>
        </div>
    </section>
</div>

<footer id="footer">
    <div class="uk-container uk-container-center uk-text-center">

        <div class="footer-logo">
            <a href="#" data-uk-smooth-scroll>
                <img src="media/img/asukademy-logo-hex.png" width="150" alt="Footer LOGO">
            </a>
        </div>

        <p class="uk-text-center social-buttons">
            <a target="_blank" class="uk-icon-button uk-icon-facebook" href="https://fb.me/asukademy"></a>

            <a target="_blank" class="uk-icon-button uk-icon-github" href="https://github.com/asukademy"></a>

            <a class="uk-icon-button uk-icon-envelope-o" href="mailto:simon@asukademy.com"></a>
        </p>

        <p>
            Copyright © 2014 Asukademy. All Rights Reserved.
        </p>
        <p class="back">
            <a href="#" data-uk-smooth-scroll><span class="uk-icon-chevron-up"></span> Back to Top</a>
        </p>
    </div>
</footer>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-59448570-3', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>