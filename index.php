<?php

/* * *********************************************
 *
 * 	Project: phpTransformer.com .
 * 	File Location :  .
 * 	File Name:  .
 * 	Date Created: 00-00-2015.
 * 	Last Modified: 00-00-2013.
 * 	Descriptions:	.
 * 	Changes:	.
 * 	TODO:	if file not exist for include and err in languge .
 * ***	Author: Mohsen Mousawi mhndm@phptransformer.com .
 *
 * ********************************************* */
?>
<?php

/*
  Time:
 * 

  $time_start = microtime(true);
 */
// Memory :
/*
  $memStart =  memory_get_usage();
  echo $memStart /1024 . " Kbytes <br/>n"; // in bytes
 */

//MAKE PAGES ZIPPED FOR BANDWIDTH RANSFER
if (isset($_SERVER['HTTP_ACCEPT_ENCODING'])) {
    if (strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') == true) {
        ini_set('zlib.output_compression_level', 6);
        ob_start('ob_gzhandler');
    }//end if
}

//set_time_limit(0);
global $TitlePage, $TheNavBar, $Prog, $scheme, $Author;
$project = "PhpTransformer";
$ServerName = "localhost";
$Author = "mhndm";

$EchoThem = true; // for echo content not them , like XML
//delete the index.html file , some hosting use it as default page
if (isset($_GET['delindex'])) {
    @unlink('index.html');
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

if (is_file('config.php')) {
    require_once('config.php');
} else {
    //Go to setup
    $WebsiteUrl = $scheme . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $WebiteFolder = str_replace("index.php", "", $_SERVER['REQUEST_URI']);
    $SetupRedirect = $scheme . "://" . $_SERVER['SERVER_NAME'] . $WebiteFolder . 'setup/index.php';
    header("Location: $SetupRedirect");
}

// redirect from get url , like : login and redirect to another page
// please use urlencode function to use & and = characters in the url
if (isset($_GET['redirect'])) {
    $redirect = $_GET['redirect'];
    //  $urlregex = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
    if (filter_var($redirect, FILTER_VALIDATE_URL)) {
        header("Location: $redirect");
    }
}

if ($_SERVER['QUERY_STRING']) {
    if (strpos($_SERVER['QUERY_STRING'], "/", 1)) { //Resolution of bug when url contain slash character
        $Redirect = $scheme . "://" . $_SERVER['SERVER_NAME'] . "/" . $WebiteFolder . '/index.php';
        header("Location: $Redirect");
    }
}
include_once("includes/session.php");
include_once('includes/Rewrite.php');

include_once('includes/Functions.php');
include_once('includes/InputFilters.php');
include_once('includes/checkValidity.php');
include_once('includes/Passwords.php');

include_once('includes/Sql.php');
require_once("DBConnect/" . $SqlType . "/index.php");
SqlConnect();

include_once("includes/ezsql/ez_sql.php");
include_once('includes/ErrLog.php');

$TitlePage = $WebSiteName;

require_once('Global.php');

//themes configuration and parameters
if (is_file('Themes/' . $ThemeName . '/config.php')) {
    include_once('Themes/' . $ThemeName . '/config.php');
}

// file contain vars and functions for all applications 
if (is_file('Themes/' . $ThemeName . '/lib.php')) {
    include_once('Themes/' . $ThemeName . '/lib.php');
}


// admin mail 
$db = new db();
$AdminMail = $db->get_var("SELECT `AdminMail` FROM `admins` WHERE `IsAdam`=1;");

$Author = $db->get_var("SELECT concat(`UserName`,' ' , `FamName`)   FROM `users`,`admins` "
        . "WHERE `users`.`UserId`= `admins`.`AdminId`  "
        . "and `admins`.`IsAdam` = 1 ;");

if (!isset($Lang)) {
    $Lang = "English";
}//end if

if ($Lang == '') {
    $Lang = "English";
}//end if
if (file_exists("languages/lang-" . $Lang . ".pt.php")) {
    require_once("languages/lang-" . $Lang . ".pt.php"); //custom translation
} else {
    require_once("languages/lang-" . $Lang . ".php");
}



//include("includes/Utf8/utf8.class.php");
include_once("includes/IpBan.php");
include_once('includes/flood.php');

// the navigation bar array
$TheNavBar = array(array((HomePage), $WebsiteUrl));

if (isIpBanned()) {
    include_once("Themes.php");
    die();
}//end if

if (!isset($_GET['Prog'])) {
    $Vars = array("Prog");
    $Vals = array($MainPrograms);
    $P = CreateLink("", $Vars, $Vals);
    header("Location: $P");
} else {
    $Prog = InputFilter($_GET['Prog']);
}
$CustomBody = "";
$CustomHead = "";
// system cache Status from params
$_SESSION['cache'] = $CacheEnabled;
include_once('includes/Login.php');

// cache system
include_once("cache.php");

include_once('includes/Statistics.php');

//robot admin Enbled
if ($RobotAdmin == 1) {
    $RobotMainPrograms = RobotMainPrograms();
    $RobotMainLang = RobotMainLang();
    $RobotMainTheme = RobotMainTheme();
    mysqli_query($conn, "update `params` set
				`DefaultLang`='" . $RobotMainLang . "',
				`DefaultThem`='" . $RobotMainTheme . "', 
				`MainPrograms`='" . $RobotMainPrograms . "';");
}//end if

if ($EnableStatistics) {
    $LastLineCode .= '<script language="javascript" type="text/javascript" src="includes/statistics.js"></script>';
}

// add theme languages files , we use it to declare global constant set by the user
if (file_exists("Themes/" . $ThemeName . "/Languages/lang-" . $Lang . ".php")) {
    require_once("Themes/" . $ThemeName . "/Languages/lang-" . $Lang . ".php"); //custom translation
} else {
    require_once("Themes/Default/Languages/lang-" . $Lang . ".php");
}

include_once('includes/ads.php');
include_once('MainContainer.php');
include_once('SecondairyContainer.php');
include_once('ProgramsContainer.php');
include_once('NavCont.php');
include_once('TopContainer.php');
include_once('MarqueeContainer.php');
include_once('MenuContainer.php');
include_once('FootContainer.php');


// cheking of Setup folder exist
if (is_file('setup/index.php') and $EchoThem) {
    echo '<div style=" text-align: center; background: red; color: #FFFFFF; width: 100%; ">
        <span style=" text-decoration: blink">!</span> Dear admin,You must delete or rename the <strong>SETUP</strong> folder 
        <span style=" text-decoration: blink">!</span></div></br>';
}

include_once("Themes.php");

// *cache
if (!$ignore_page) {
    // Now the script has run, generate a new cache file
    $fp = gzopen($cachefile, 'w'); // save the contents of output buffer to the file
    gzwrite($fp, ob_get_contents());
    gzclose($fp);
    ob_end_flush();
}
/*
 * Memory

  $memEnd = memory_get_usage();
  echo $memEnd /1024 . " Kbytes <br/>n";
  echo "Memory : ".(($memEnd-$memStart ) /1024 ). " Kbytes";

  $time_end = microtime(true);
  $time = $time_end - $time_start;
  echo round($time,4)." seconds";
 */
?>