<?php

/* * *********************************************
 *
 * 	Project: phpTransformer.com .
 * 	File Location :  .
 * 	File Name:  .
 * 	Date Created: 00-00-2007.
 * 	Last Modified: 00-00-2007.
 * 	Descriptions:	.
 * 	Changes:	.
 * 	TODO:	 .
 * ***	Author: Mohsen Mousawi mhndm@phptransformer.com .
 *
 * ********************************************* */
?>
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if (function_exists('set_time_limit')) {
    @set_time_limit(0);
}
ini_alter("memory_limit", "1024M");
//ob_end_clean();
ob_implicit_flush(TRUE);
ignore_user_abort(1);
clearstatcache();
error_reporting(6135);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

if (count($_POST)) {
    include_once("../includes.php");
  
    if (isset($_POST['Title'])) {
        $Title = PostFilter($_POST['Title']);
    } else {
        die();
    }

    if (isset($_POST['Url'])) {
        $Url = PostFilter($_POST['Url']);
    } else {
        die();
    }
    if ($Title != '' and $Url != '') {
        PingSearchEngines($Title, $Url);
    } else {
        die();
    }
}

function PingSearchEngines($Title, $Url) {

    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    if (function_exists('set_time_limit')) {
        @set_time_limit(0);
    }
    ini_alter("memory_limit", "1024M");
    //ob_end_clean();
    ob_implicit_flush(TRUE);
    ignore_user_abort(1);
    clearstatcache();
    error_reporting(6135);
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");

    $Rss = CreateLink('', array('Prog'), array('rss'));
    $Title = str_replace('"', '', $Title);
    $PingServices = array(
        "http://blogsearch.google.com/ping?name=" . $Title . "&url=" . $Url . "&changesURL=" . $Rss
        ,
        "http://pingomatic.com/ping/?title=" . $Title . "&blogurl=" . $Url . "&rssurl=" . $Rss . "&chk_weblogscom=on&chk_blogs=on&chk_feedburner=on&chk_syndic8=on&chk_newsgator=on&chk_myyahoo=on&chk_pubsubcom=on&chk_blogdigger=on&chk_blogstreet=on&chk_moreover=on&chk_weblogalot=on&chk_icerocket=on&chk_newsisfree=on&chk_topicexchange=on&chk_google=on&chk_tailrank=on&chk_postrank=on&chk_skygrid=on&chk_collecta=on&chk_superfeedr=on"
    );
    foreach ($PingServices as $Service) {
        GetPageContent($Service);
    }
}
/*
function GetPageContent($PageUrl) { //get page content from url
    if (function_exists('set_time_limit')) {
        @set_time_limit(0);
    }
    //echo $PageUrl;
    if ($PageUrl) {
        $handle = @fopen($PageUrl, "rb");
        $GetPageContent = @stream_get_contents($handle);
        @fclose($handle);
        return $GetPageContent;
    }//end if
}
*/
?>