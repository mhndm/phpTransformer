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

if (!isset($project)) {
    header("location: ../../");
}
?>
<?php

global $EchoThem, $TotalRecords, $Rows, $Lang, $WebSiteName, $WebsiteUrl, $WebsiteDesc;
$NewsMaxNbr = 10;

$EchoThem = false;

date_default_timezone_set('UTC');

header('Content-type: application/xml; charset="utf-8"', true);
$UseRew = "0";
global $UseRew;
$RssWebsiteUrl = CreateLinkNoLang("", array("Prog", "Lang"), array("rss", $Lang));
$RssWebsiteUrl = str_ireplace($WebsiteUrl, "", $RssWebsiteUrl);

echo'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0"
xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title>' . $WebSiteName . ' ' . $Lang . '</title>
    <link>' . $WebsiteUrl . '</link>
	<atom:link title="' . $WebSiteName . ' ' . $Lang . '" href="' . $WebsiteUrl . htmlspecialchars($RssWebsiteUrl, ENT_QUOTES) . '" rel="self" type="application/rss+xml" />
    <description>' . $WebsiteDesc . '</description>
    <copyright>' . date("Y") . ' ' . $WebSiteName . '</copyright>
    <language>' . MiniLang . '</language>
    <category>' . $WebSiteName . '</category>
    <managingEditor>support@' . $WebSiteName . ' (' . $WebSiteName . ' Support )</managingEditor>
    <webMaster>webMaster@' . $WebSiteName . ' (' . $WebSiteName . ' Web Master )</webMaster>
    <lastBuildDate>' . date('r') . '</lastBuildDate>
    <generator>phpTransformer</generator>
    <docs>http://blogs.law.harvard.edu/tech/rss</docs>
    <image>
      <url>' . $WebsiteUrl . 'images/logorss.jpg</url>
      <title>' . $WebSiteName . ' ' . $Lang . '</title>
      <link>' . $WebsiteUrl . '</link>
    </image>';

if (isset($_GET['app'])) {
    if ($_GET['app'] == 'news') {
        include_once 'news.php';
    } elseif ($_GET['app'] == 'gallery') {
        include_once 'gallery.php';
    } else {
        include_once 'news.php';
    }
} else {
    include_once 'news.php';
}
?>