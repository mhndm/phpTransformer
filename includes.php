<?php

/* * *********************************************
 *
 * 	Project: phpTransformer.com .
 * 	Descriptions:	.
 * 	TODO:	 .
 * ***	Author: Mohsen Mousawi mhndm@phptransformer.com +961-3-687150.
 *
 * ********************************************* */
?>
<?php

global $scheme;

if (isset($_SERVER["HTTPS"])) {
    if ($_SERVER["HTTPS"] == 'on') {
        $scheme = 'https';
    } else {
        $scheme = 'http';
    }
} else {
    $scheme = 'http';
}

include_once (__DIR__ . "/config.php");

include_once(__DIR__ . '/includes/Sql.php');
include_once(__DIR__ . '/includes/session.php');

require_once(__DIR__ . "/DBConnect/MySql/index.php");
SqlConnect();
include_once (__DIR__ . "/includes/ezsql/ez_sql.php");
require_once (__DIR__ . "/includes/Functions.php");
require_once (__DIR__ . "/includes/InputFilters.php");
include_once(__DIR__ . '/Global.php');

$UserId = "20070000000";
$GroupId = "20070000000";

if (isset($_COOKIE['LastSession'])) {
    $LastSession = $_COOKIE['LastSession'];
    $db_user = new db();
    $user_info = $db_user->get_row(" select * from `users` where `LastSession`='" . $LastSession . "' ; ");
    if ($user_info) {
        $UserId = $user_info->UserId;
        $GroupId = $user_info->GroupId;
    }
}

if (isset($_COOKIE['phpTransformer'])) { // for admin interface
    $phpTransformer = $_COOKIE['phpTransformer'];
}
?>