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

include_once ("config.php");

include_once('includes/Sql.php');
require_once("DBConnect/MySql/index.php");
SqlConnect();

include_once ("includes/ezsql/ez_sql.php");
require_once ("includes/Functions.php");
require_once ("includes/InputFilters.php");

if (isset($_COOKIE['LastSession'])) {
    $LastSession = $_COOKIE['LastSession'];
} else {
    $LastSession = "";
}


$db_user = new db();
$user_info = $db_user->get_row(" select * from `users` where `LastSession`='" . $LastSession . "' ; ");
$UserId = $user_info->UserId;
$GroupId = $user_info->GroupId;

$args = array("var1" => 1, "var2" => 2);

echo get_program('gadget', $args, $GroupId, 'Arabic');

function get_program($prog, $args, $GroupId, $Lang) {
    
    global $WebsiteUrl;
    
    if ($prog) {
        $Program = InputFilter($prog);

        $dbPrograms = new db();
        $ProgramsRow = $dbPrograms->get_row("SELECT * FROM `programs` where `ProgramName`='" . $Program . "' and `Deleted`<>'1' ;");

        if ($ProgramsRow) {//program name exist in the table
            $ProgramName = $ProgramsRow->ProgramName;
            $ObjectId = $ProgramsRow->ObjectId;
            $Permission = $ProgramsRow->Permission;
            $License = $ProgramsRow->License;
            $ObjectName = "program" . $Program;
            
            if (file_exists("languages/lang-" . $Lang . ".php")) {
                include_once("languages/lang-" . $Lang . ".php");
            }
            if ($Permission == "1" and ContPermission($GroupId, $ObjectId)) {// u have permission to view this program  
                //loading lang file
                if (file_exists("Programs/$Program/Languages/lang-" . $Lang . ".pt.php")) {
                    $filename = "Programs/$Program/Languages/lang-" . $Lang . ".pt.php"; //custom translation
                } else {
                    $filename = "Programs/$Program/Languages/lang-" . $Lang . ".php";
                }
                //echo $filename;
                if (file_exists($filename)) {
                    include_once($filename);
                }
                //loading program
                $params = "";
                foreach ($args as $arg => $val) {
                    $params .= "&" . $arg . "=" . $val;
                }
                //echo $WebsiteUrl."Programs/$Program/index.php?" . $params;
                
                return GetPageContent($WebsiteUrl."Programs/$Program/index.php?" . $params);
            } else {  //u dont have permission
                return false;
            }
        } else {
            return false;
        }
    }
}




?>