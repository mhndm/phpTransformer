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

if (!isset($IsAdmin)) {
    header("location: ../");
}
?>
<?php

global $conn, $dbHostName, $dbUserName, $dbPass, $restore, $dbBaseName, $backup, $BackupFolder, $LOG;

$LOG = '';
$restore = '';
$database_charset = "utf8";
$database_host = $dbHostName;
$database_port = "3306";
define('PATH', $BackupFolder);
define('URL', $BackupFolder);
define('TIME_LIMIT', 6000); //number of  maximum execution time  of php script in seconds , 
define('LIMIT', 1);
define('DBHOST', $database_host . ':' . $database_port);
define('DBNAMES', '');
define('CHARSET', $database_charset);
define('SC', 1);
define('GS', 1);
$is_safe_mode = ini_get('safe_mode') == '1' ? 1 : 0;
if (!$is_safe_mode) {
    if (function_exists('set_time_limit')) {
        @set_time_limit(TIME_LIMIT);
    }
}
header("Expires: Tue, 1 Jul 2003 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
//$timer = array_sum(explode(' ', microtime()));
ob_implicit_flush();
$auth = 0;
$error = '';
include_once('admin/todo/support/dumper.php');
$SK = new dumper();

$SK->SET = array(
    'last_action' => '0',
    'last_db_backup' => $dbBaseName,
    'tables' => '',
    'comp_method' => '1',
    'comp_level' => '7',
    'last_db_restore' => '',
    'tables_exclude' => '0',
    'conn' => $conn
);

define('C_DEFAULT', 1);
define('C_RESULT', 2);
define('C_ERROR', 3);
$restore .= $backup;

if (!isset($_POST['file'])) {
    $Vars = array('todo', 'subdo', 'action');
    $Vals = array('database', 'restore', 'dorestore');
    $restore .= (PleaseSelectFileToRestore) . '<br><strong>' . (NoteRestoreCanDeleteInfo) . '</strong>
				<form id="formRestore" name="formRestore" method="post" action="' . AdminCreateLink('', $Vars, $Vals) . '">
				<input type="hidden" value="' . $dbBaseName . '" name="db_restore" id="db_restore" />
				<select class="select" name="file" id="file">';
    $restore .= $SK->fn_select($SK->file_select(), '');
    $restore .= '<input class="submit" type="submit" name="submit" id="submit" value="' . submit . '" /></select>';
} else {

    $restore = restoreLog . ': <br>
			<DIV ID=logarea STYLE="width: 800px; height: 140px; border: 1px solid #7F9DB9; padding: 3px; overflow: auto;">';
}//end if


mysqli_query($conn, "/*!40101 SET NAMES '" . CHARSET . "' */") or die("Invalid query: " . mysql_error());
if (isset($_GET['action'])) {
    $action = InputFilter($_GET['action']);
    switch ($action) {
        case 'dobackup':
            $SK->backup();
            break;
        case 'dorestore':
            if (isset($_POST['file'])) {
                $SK->restore();
                break;
            }//end if
        default:
    }
}//end if
//mysql_close();

$restore .= $LOG . '</div>';
?>