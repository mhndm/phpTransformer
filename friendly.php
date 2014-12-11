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
 * 	Author: Mohsen Mousawi mhndm@phptransformer.com .
 *
 * ********************************************* */
?>
<?php

//MAKE PAGES ZIPPED FOR BANDWIDTH RANSFER 
if (strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') == true) {
    ini_set('zlib.output_compression_level', 6);
    ob_start('ob_gzhandler');
}//end if
// END GZIP
if (function_exists('set_time_limit')) {
    @set_time_limit(0);
}

$project = "PhpTransformer";
include_once('includes/Functions.php');
include_once("includes/session.php");
if (isset($_GET['print'])) {
    $PrintCode = '<script langauge="javascript">print();</script>';
} else {
    $PrintCode = "";
}//end if

if (isset($_SERVER['HTTP_REFERER'])) {
    $Ref = $_SERVER['HTTP_REFERER'];
} else {
    $Ref = "";
}//end if

$Host = $_SERVER['HTTP_HOST'];

if (strstr($Ref, $Host)) {
    if (!strstr($Ref, 'Lang')) {
        $Ref .='&Lang=' . $_SESSION['Lang'];
    }
    $AllPage = GetPageContent($Ref);
    $BeginDir = stristr($AllPage, '<html');
    ;
    $EndDir = strpos($BeginDir, '<head>');
    $dirHtml = substr($BeginDir, 0, $EndDir);
    $BeginTitle = stristr($AllPage, '<title>');
    ;
    $EndTitle = strpos($BeginTitle, '</title>');
    $PageTitle = substr($BeginTitle, 0, $EndTitle);
    $BeginCut = stristr($AllPage, '<!-- Begin of ProgCont TD -->');
    $EndCut = strpos($BeginCut, '<!-- End of ProgCont TD -->');
    $FriendlyCode = substr($BeginCut, 0, $EndCut);

    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			' . $dirHtml . '
				<head> 
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					' . $PageTitle . '</title>
				</head>
					<body>'
    . $PrintCode . $FriendlyCode . '
					</body>
			</html>';
} else {
    echo "";
}//end if
?>