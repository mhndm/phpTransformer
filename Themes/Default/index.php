<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="{DirHtml}" xmlns="http://www.w3.org/1999/xhtml">
    <?php
    global $default_global;
    
    ?>
    <head>
        <meta http-equiv="Content-Language" content="{LangContry}"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="Author" content="{Author}"/>
        <meta name="abstract" content="{DetailedDescription}"/>
        <meta name="generator" content="phpTransformer"/>
        <meta name="Copyright" content="Copyright by phptransformer.com"/>
        <meta name="Robots" content="index,follow"/>
        <meta name="Distribution" content="Global"/>
        <meta name="Revisit-After" content="6 Days"/>

        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="icon" href="animated_favicon.gif" type="image/gif" />

        <title>{TitlePage}</title>

        <meta name="keywords" content="{SiteKeywords}"/>
        <meta name="description" content="{SiteDescription}"/>
        <link rel="alternate" type="application/rss+xml" title="{WebSiteName}" href="{rssLink}"/>
        
        <script src="includes/jquery/jquery-1.11.0.min.js"></script>
        
        <link rel='stylesheet' id='open-sans-css'  href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=3.8.1' type='text/css' media='all' />
        
        <script src="Themes/{ThemeName}/js/all.js?v=1"></script> 


        <link rel="stylesheet" href="Themes/{ThemeName}/slider/themes/default/default.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="Themes/{ThemeName}/slider/nivo-slider.css" type="text/css" media="screen" />

        <link rel="stylesheet" href="Themes/{ThemeName}/css-<?= $default_global["color"]; ?>/style-{DirHtml}.css" type="text/css" />
        <!--[if lt IE 8]>
                <script src ="http://ie7-js.googlecode.com/svn/version/2.1(beta2)/IE8.js"></script>
        <![endif]-->


        
        <script type="text/javascript" src="includes/jquery/jquery.mousewheel-3.0.6.pack.js"></script>

        <script type="text/javascript" src="Themes/{ThemeName}/fancybox/jquery.fancybox.js?v=2.1.5"></script>
        <link rel="stylesheet" type="text/css" href="Themes/{ThemeName}/fancybox/jquery.fancybox-{DirHtml}.css?v=2.1.5" media="screen" />
        

        <link rel="stylesheet" type="text/css" href="Themes/{ThemeName}/fancybox/helpers/jquery.fancybox-buttons-{DirHtml}.css?v=1.0.5" />
        
        <script type="text/javascript" src="Themes/{ThemeName}/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

        <link rel="stylesheet" type="text/css" href="Themes/{ThemeName}/fancybox/helpers/jquery.fancybox-thumbs-{DirHtml}.css?v=1.0.7" />
        
        <script type="text/javascript" src="Themes/{ThemeName}/fancybox/helpers/jquery.fancybox-thumbs-{DirHtml}.js?v=1.0.7"></script>

        <script type="text/javascript" src="Themes/{ThemeName}/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
        <script type="text/javascript">var RecaptchaOptions = {theme : 'clean',tabindex : 10};</script>

        {CustomHead}
    </head>
    <body {CustomBody} dir="{DirHtml}">
        <div id="PageCont">
            <div class="main_container">
                {TopCont}

                <div id="HeartCont" class="body">
                    
                <?php include_once "slider.php"; ?>

                    <div class="body_content">
                        <div class="body_container">
                            <div class="marquee">{MarqueeCont}</div>  
                            <div id="MainCont" class="main_column">
                                {MainCont}
                            </div>
                            <div class="prog_content" id="prog_content">
                                {NavCont}{ProgCont}
                            </div>

                        </div>
                    </div>
                    <div id="FootCont" >
                        {FootCont}
                    </div>
                </div>
            </div>
                    

        </div>
        <div class="static"></div>
        <script src="Themes/{ThemeName}/js/jquery.effects.core.js" type="text/javascript"></script>
        <script type="text/javascript" src="Themes/{ThemeName}/js/scripts.js"></script>
        <script type="text/javascript" src="Themes/{ThemeName}/slider/jquery.nivo.slider.js"></script>
        <script type="text/javascript">
            $(window).load(function() {
                $('#slider').nivoSlider({
                    controlNav: false
                });
            });
            
        </script>
        <script type="text/javascript">
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', '{GoogleCode}', '<?php global $WebSiteName;echo $WebSiteName; ?>');
                                        ga('send', 'pageview');
        </script>
        {LastLineCode}
    </body>
</html>