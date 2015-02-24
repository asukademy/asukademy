<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">

    <link rel="shortcut icon" href="media/favicon.ico" type="image/x-icon">
    <link rel="icon" href="{{{ $uri['media.path'] }}}media/favicon.ico" type="image/x-icon">

@if ($view->layout == 'index')
    <title>@yield('page_title', 'Asukademy 飛鳥學院')</title>
@else
    <title>@yield('page_title') | Asukademy 飛鳥學院</title>
@endif

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
    {{ \Riki\Asset\Asset::setIndents(4)->renderStyles() }}

    <!-- scripts -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{{ $uri['media.path'] }}}js/uikit.min.js"></script>
    {{ \Riki\Asset\Asset::renderScripts() }}
@yield('script')

    <script type="text/javascript">var _jf = _jf || [];_jf.push(['p','29887']);_jf.push(['_setFont','xingothic-tc-w4','css','.xingothic-tc-w4']);_jf.push(['_setFont','xingothic-tc-w4','css','xin4']);_jf.push(['_setFont','xingothic-tc-w4','alias','Xin4']);_jf.push(['_setFont','xingothic-tc-w6','css','.xingothic-tc-w6']);_jf.push(['_setFont','xingothic-tc-w6','css','xin6']);_jf.push(['_setFont','xingothic-tc-w6','alias','Xin6']);(function(f,q,c,h,e,i,r,d){var k=f._jf;if(k.constructor===Object){return}var l,t=q.getElementsByTagName("html")[0],a=function(u){for(var v in k){if(k[v][0]==u){if(false===k[v][1].call(k)){break}}}},j=/\S+/g,o=/[\t\r\n\f]/g,b=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,g="".trim,s=g&&!g.call("\uFEFF\xA0")?function(u){return u==null?"":g.call(u)}:function(u){return u==null?"":(u+"").replace(b,"")},m=function(y){var w,z,v,u,x=typeof y==="string"&&y;if(x){w=(y||"").match(j)||[];z=t[c]?(" "+t[c]+" ").replace(o," "):" ";if(z){u=0;while((v=w[u++])){if(z.indexOf(" "+v+" ")<0){z+=v+" "}}t[c]=s(z)}}},p=function(y){var w,z,v,u,x=arguments.length===0||typeof y==="string"&&y;if(x){w=(y||"").match(j)||[];z=t[c]?(" "+t[c]+" ").replace(o," "):"";if(z){u=0;while((v=w[u++])){while(z.indexOf(" "+v+" ")>=0){z=z.replace(" "+v+" "," ")}}t[c]=y?s(z):""}}},n;k.push(["_eventActived",function(){p(h);m(e)}]);k.push(["_eventInactived",function(){p(h);m(i)}]);k.addScript=n=function(u,A,w,C,E,B){E=E||function(){};B=B||function(){};var x=q.createElement("script"),z=q.getElementsByTagName("script")[0],v,y=false,D=function(){x.src="";x.onerror=x.onload=x.onreadystatechange=null;x.parentNode.removeChild(x);x=null;a("_eventInactived");B()};if(C){v=setTimeout(function(){D()},C)}x.type=A||"text/javascript";x.async=w;x.onload=x.onreadystatechange=function(G,F){if(!y&&(!x.readyState||/loaded|complete/.test(x.readyState))){y=true;if(C){clearTimeout(v)}x.src="";x.onerror=x.onload=x.onreadystatechange=null;x.parentNode.removeChild(x);x=null;if(!F){setTimeout(function(){E()},200)}}};x.onerror=function(H,G,F){if(C){clearTimeout(v)}D();return true};x.src=u;z.parentNode.insertBefore(x,z)};a("_eventPreload");m(h);n(r,"text/javascript",false,3000)})(this,this.document,"className","jf-loading","jf-active","jf-inactive","//d3gc6cgx8oosp4.cloudfront.net/js/stable/v/4.6/id/54380144134");</script>
</head>
<body class="{{{ $page_class }}}">
<nav id="header" class="uk-navbar uk-navbar-attached">
    <div class="uk-container uk-container-center">

        <a id="big-logo" class="uk-navbar-brand uk-hidden-small" href="{{{ $uri['base.path'] }}}">
            <img class="uk-margin uk-margin-remove" src="{{{ $uri['media.path'] }}}img/asukademy-logo-horz.png" title="Asukademy" alt="Asukademy">
        </a>

        <a href="#" class="uk-navbar-toggle uk-visible-small" data-uk-toggle="{target:'#mainmenu', cls: 'uk-hidden-small'}"></a>

        <a id="small-logo" class="uk-navbar-brand uk-navbar-center uk-visible-small" href="{{{ $uri['base.path'] }}}">
            <img class="uk-margin uk-margin-remove" style="max-width: 95%;" src="{{{ $uri['media.path'] }}}img/asukademy-logo-horz.png" title="Asukademy" alt="Asukademy">
        </a>

        @include('layouts.menu.header')

    </div>
</nav>

<section id="banner" class="{{{ $page_class }}}">
    <div class="banner-inner">
        @yield('banner')
    </div>
</section>

<div id="main-body">
    @yield('body')
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