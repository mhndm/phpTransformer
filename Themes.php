<?php

/*

  Project: phpTransformer.com .
  File Location :  .
  File Name:  .
  Date Created: 00-00-2007.
  Last Modified: 00-00-2007.
  Descriptions: .
  Changes: .
  TODO:  .
  Author: Mohsen Mousawi mhndm@phptransformer.com .

 */
?>
<?php

if (!isset($project)) {
    header("location: ");
}
?>
<?php
global $scheme,$Author;
$Content = GetPageContent("Themes/$ThemeName/index.php");
//$Page="";// page to display in the browser

if ($IsOpen == "1") {// IF THE SITE IS OPEN
    if (!isUserBanned() and !isIpBanned()) { // publish the site
        if ($EchoThem == true) {
            include('includes/MetaTags.php');
            echo ThemePublish();
        } else {
            echo trim($ProgCont);
        }//end if
    } else {//ip or user is banned
        $ProgCont = IPBanned;
        //include_once('includes/MetaTags.php');
        echo ThemeBanned();
    }//end if
} else { //site is closed
    //include_once('includes/MetaTags.php');
    $ProgCont = (WebSiteClosed);
    echo ThemeClosed();
}//end if

function ThemeBanned() {//them for banned users
    return '<html xmlns="http://www.w3.org/1999/xhtml">
                  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                  <body>!</body></html>';
}

function ThemePublish() {//them for open site
    global $CustomHead, $LastLineCode, $Lang, $NavCont, $Content, $TopCont, $MarqueeCont, $MenuCont, $MainCont, $SecCont, $ProgCont, $FootCont, $ThemeName;
    global $Page, $ViewProgCont, $ViewTopCont, $ViewMarqueeCont, $ViewMenuCont, $ViewMainCont, $ViewSecCont, $ViewFootCont, $ConvertAt;

    if ($ViewTopCont) {

        $Content = VarTheme("{TopCont}", $TopCont, $Content);
    } else {
        $Content = VarTheme("{TopCont}", "", $Content);
        $Content = VarTheme('id="TopCont"', 'id="TopCont" style="display:none;" ', $Content);
    }//end if

    if ($ViewMarqueeCont) {
        $Content = VarTheme("{MarqueeCont}", $MarqueeCont, $Content);
    } else {
        $Content = VarTheme("{MarqueeCont}", "", $Content);
        $Content = VarTheme('id="MarqueeCont"', 'id="MarqueeCont" style="display:none;" ', $Content);
    }//end if

    if ($ViewMenuCont) {
        $Content = VarTheme("{MenuCont}", $MenuCont, $Content);
    } else {
        $Content = VarTheme("{MenuCont}", "", $Content);
        $Content = VarTheme('id="MenuCont"', 'id="MenuCont" style="display:none;" ', $Content);
    }//end if

    if ($ViewMainCont) {
        $Content = VarTheme("{MainCont}", $MainCont, $Content);
    } else {
        $Content = VarTheme("{MainCont}", "", $Content);
        $Content = VarTheme('id="MainCont"', 'id="MainCont" style="display:none;" ', $Content);
    }//end if

    if ($ViewProgCont) {
        $Content = VarTheme("{NavCont}", $NavCont, $Content);
        $Content = VarTheme("{ProgCont}", $ProgCont, $Content);
    } else {
        $Content = VarTheme("{NavCont}", "", $Content);
        $Content = VarTheme("{ProgCont}", "", $Content);
        $Content = VarTheme('id="NavCont"', 'id="NavCont" style="display:none;" ', $Content);
        $Content = VarTheme('id="ProgCont"', 'id="ProgCont" style="display:none;" ', $Content);
    }//end if

    if ($ViewSecCont) {
        $Content = VarTheme("{SecCont}", $SecCont, $Content);
    } else {
        $Content = VarTheme("{SecCont}", "", $Content);
        $Content = VarTheme('id="SecCont"', 'id="SecCont" style="display:none;" ', $Content);
    }//end if

    if ($ViewFootCont) {
        $Content = VarTheme("{FootCont}", $FootCont, $Content);
    } else {
        $Content = VarTheme("{FootCont}", "", $Content);
        $Content = VarTheme('id="FootCont"', 'id="FootCont" style="display:none;" ', $Content);
    }//end if

    $Content = FinalThemeCode($Content);
    $Content = VarTheme("<!-- End of Page -->", "", $Content);
    $Content = VarTheme("<!-- Powered By phpTransformer -->", "", $Content);
    $Content = VarTheme("{rssLink}", CreateLinkNoLang("", array("Prog", "Lang"), array("rss", $Lang)), $Content);

    if ($ConvertAt) {
        $Content = VarTheme("@", ' (at) ', $Content);
    }
    $Content = trim($Content);

    if (!strpos(strtolower($Content), base64_decode('cGhwdHJhbnNmb3JtZXIuY29t'))) {
        exit();
    }

    return $Content;
}

function ThemeClosed() {//them forwebsite closed
    global $ProgCont;

    $Content = '<html dir="' . DirHtml . '" xmlns="http://www.w3.org/1999/xhtml">
                  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                  <body  dir="' . DirHtml . '">'
            . $ProgCont . '</body></html>';
    // end of close
    return $Content;
}

function GetThemeCode($Begin=null, $End=null) {// extract top head +  code from theme file
    global $ThemeName;
    $OriginalTheme = (get_include_contents("Themes/$ThemeName/index.php")); // get them file
    if ($Begin == null and $End == null) {
        return $OriginalTheme;
    }
    $StartCont = strpos($OriginalTheme, $Begin); // position of  begin
    //echo $StartTopCont."<br>";
    $EndCont = strpos($OriginalTheme, $End); // position of  end
    //echo $EndTopCont."<br>";
    return substr($OriginalTheme, $StartCont, ($EndCont - $StartCont) + strlen($End)); //code of top container
}

//end function

function FinalThemeCode($CoveThem) {// extract top head +  code from theme file
    global $WebsiteUrl,$scheme;
    $OriginalTheme = $CoveThem;
    $StartCont = 0; //strpos($OriginalTheme, $Begin); // position of  begin
    $EndCont = strlen($CoveThem); //strpos($OriginalTheme, $End); // position of  end

    $FinalThemeCode = substr($OriginalTheme, $StartCont, ($EndCont - $StartCont) + strlen($EndCont)); //code of top container
    if (!strpos(strtolower($FinalThemeCode), base64_decode(strrev('t92YuIXZtJ3bmNnbhJHdwhGc')))) {
        die();
    }
    if (isset($_SERVER["HTTPS"])) {
        if ($_SERVER["HTTPS"] == 'on') {
            $scheme = 'https';
        } else {
            $scheme = 'http';
        }
    } else {
        $scheme = 'http';
    }
    $newWebsiteUrl = str_replace('https', $scheme, $WebsiteUrl);
    $newWebsiteUrl = str_replace('httpss', 'https', $newWebsiteUrl);
    $FinalThemeCode = str_replace($WebsiteUrl, $newWebsiteUrl, $FinalThemeCode);

    // $size_before = mb_strlen($FinalThemeCode, '8bit');

    require_once 'includes/compactor.php';
    $compactor = new Compactor(array(
                'buffer_echo' => false,
                'strip_comments' => true,
                'compress_scripts' => true
            ));
    $FinalThemeCode = $compactor->squeeze($FinalThemeCode);

    //$size_after = mb_strlen($FinalThemeCode, '8bit');

    return $FinalThemeCode;
    //return $FinalThemeCode .'from '.round($size_before/1024, 2).'KB to '.round($size_after/1024, 2).'KB   saving '.round((1-($size_after/$size_before))*100, 2).'%';
}

?>