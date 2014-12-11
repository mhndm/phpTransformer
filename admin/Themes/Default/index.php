<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="{DirHtml}" xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Language" content="{LangContry}"/>
        <meta http-equiv="Content-Type" content="text/html; charset={LangEncoding}"/>
        <meta name="Author" content="{Author}"/>
        <meta name="abstract" content="{DetailedDescription}"/>
        <meta name="generator" content="phpTransformer"/>
        <meta name="Copyright" content="Copyright by phptransformer.com "/>
        <meta name="Robots" content="noindex,nofollow"/>

        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="icon" href="animated_favicon.gif" type="image/gif" />

        <script language="javascript" type="text/javascript" src="includes/Javascripts.js"></script>
        <script language="javascript" type="text/javascript" src="includes/jquery/jquery-1.7.1.min.js"></script>

        <title>{TitlePage}</title>
        <link rel="stylesheet" type="text/css" href="admin/Themes/{ThemeName}/style-{DirHtml}.css?v=2014.5"/> 

        {CustomHead}

    </head>

    <body class="body" {CustomBody} dir="{DirHtml}">

        <!--Begin of Page Table -->
        <table  align="center" style="width:980px;margin: 0px auto;padding: 0px !important;" id="PageCont">
            <tr>
                <td valign="top">
                    <!-- end open table -->
                    <!-- Begin of TopCont table -->
                    <table border="0" width="100%" id="TopCont" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                {TopCont}
                            </td>
                        </tr>
                    </table> <!-- End of TopCont table -->
                    <!-- Begin of MenuCont table -->
                    <table border="0" width="100%" cellspacing="0" cellpadding="0"  id="MenuCont">
                        <tr>
                            <td></td>
                        </tr>
                    </table> <!-- End of MenuCont table -->
                    <!-- Begin of HeartCont table -->
                    <table width="100%" height="450" border="0" cellpadding="0" cellspacing="0" id="HeartCont">
                        <tr>
                            <!-- Begin of ProgCont TD -->
                            <td height="201" valign="top" id="MainCont">{NavCont}{ProgCont}</td>
                            <!-- End of ProgCont TD -->
                        </tr>
                    </table> <!-- End of HeartCont table -->

                    <!-- Begin of FootCont Table -->
                    <table border="0" width="100%" cellspacing="0" cellpadding="0" id="FootCont" class="foot_cont">
                        <tr>
                            <td>
                                {FootCont}
                            </td>
                        </tr>
                    </table> <!-- End of FootCont Table -->
                    <!-- Begin end of page -->
                </td>
            </tr>
        </table> <!-- End of Page Table -->
        <noscript>
            <p style="text-decoration: blink; text-align: center;"><strong>This page is for JavaScript clients.</strong></p>
        </noscript>
    </body>

</html>