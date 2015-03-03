<div id="email-body" style="max-width: 960px;">
    <div class="main-wrap" style="padding: 30px; background-color: #eee;">
        <div id="banner" style="margin-bottom: 30px; padding: 30px 0; text-align: center;
			background: url({{{ $uri['media.full'] }}}/img/banner/feature-2-dark.jpg) center center no-repeat;">
            <a href="{{{ $router->buildHtml('front:page', ['paths' => ''], \Windwalker\Core\Router\RestfulRouter::TYPE_FULL) }}}">
                <img src="{{{ $uri['media.full'] }}}img/asukademy-logo-horz-white.png" alt="LOGO" />
            </a>
        </div>

        <div id="body" style="border: 1px solid #ccc; margin-bottom: 30px; padding: 30px; background-color: white;">

            @yield('body', 'Body')

            @if (false)
            <h1>Heading 1</h1>
            <h2>Heading 2</h2>
            <h3>Heading 3</h3>

            <p>Paragraph</p>
            <p>Paragraph</p>
            <p>Paragraph</p>

            <hr style="border: none; border-top: 1px solid #ccc; margin: 30px 0;" />

            <!-- Link -->
            <a href="#" style="color: #07d;">Link</a>

            <!-- Button Primary -->
            <a href="#" style="padding: 7px 10px; background-color: #00a8e6; box-shadow: 0 4px 0 #0091cc; color: #fff;
				display: inline-block; border-radius: 3px; text-decoration: none;">
                Button Primary
            </a>

            <!-- Button Success -->
            <a href="#" style="padding: 9px 10px; background-color: #8cc14c; color: #fff;
				display: inline-block; border-radius: 3px; text-decoration: none;">
                Button Success
            </a>

            <!-- Button Default -->
            <a href="#" style="padding: 9px 10px; background-color: #eee; color: #333;
				display: inline-block; border-radius: 3px; text-decoration: none;">
                Button Success
            </a>
            @endif
        </div>

        <div id="footer" style="text-align: center;">
            <p>2015 &copy; <a target="_blank" style="color: #07d;" href="{{{ $router->buildHtml('front:page', ['paths' => ''], \Windwalker\Core\Router\RestfulRouter::TYPE_FULL) }}}">Asukademy 飛鳥學院</a></p>
        </div>
    </div>
</div>
