<?php
/***********************************************
*
*	Project: phpTransformer.com .
*	File Location :  .
*	File Name:  .
*	Date Created: 00-00-2007.
*	Last Modified: 00-00-2007.
*	Descriptions:	.
*	Changes:	.
*	TODO:	 .
****	Author: Mohsen Mousawi mhndm@phptransformer.com .
*
***********************************************/
?>
<?php if (!isset($project)) {
    header("location: ../");
} ?>
<?php
global $DisplayErrors,$MaxErrNbrRecord,$store_erro_in_db ;

$MaxErrNbrRecord = 300;

if($DisplayErrors!="yes") {
    error_reporting(0);
    if($store_erro_in_db == "yes"){
        error_reporting(E_ALL ^ E_NOTICE);
        set_error_handler("errorHandler");
    }
    
}//end if

function errorHandler($errno, $errmsg, $filename, $linenum, $vars) {
    global $MaxErrNbrRecord;

    SqlConnect();

    if($MaxErrNbrRecord) {
        $result = mysqli_query($conn,"SELECT * FROM errlog");
        $num_rows = mysqli_num_rows($result);
        if($num_rows>=$MaxErrNbrRecord) {
            mysqli_query($conn,"delete from `errlog` ORDER BY `IdErr` LIMIT 1;")  ;
        }//end if
    }//end if

    $filename = str_replace("\\", "\/", $filename );
    $errmsg = str_replace("\\", '\/', $errmsg );
    $errmsg = str_replace("'", "\'", $errmsg );
 
    $errortype = array (
            E_ERROR           => "Error",
            E_WARNING         => "Warning",
            E_PARSE           => "Parsing Error",
            E_NOTICE          => "Notice",
            E_CORE_ERROR      => "Core Error",
            E_CORE_WARNING    => "Core Warning",
            E_COMPILE_ERROR   => "Compile Error",
            E_COMPILE_WARNING => "Compile Warning",
            E_USER_ERROR      => "User Error",
            E_USER_WARNING    => "User Warning",
            E_USER_NOTICE     => "User Notice",
            E_STRICT          => "Runtime Notice");

    $query = " SELECT * FROM `errlog` WHERE
                    `errno`='".$errno."' and
                    `errmsg`='".$errortype[$errno] ." : ".$errmsg ."' and
                    `filename`='".$filename."' and
                    `linenum`='".$linenum."' ; " ;
    $dbErrorLogSQL = new db();
    $ErrorLogSQl = $dbErrorLogSQL->get_row($query);
    if(is_null($ErrorLogSQl)) {
        
        $insertErrQuery = "INSERT INTO `errlog` ( `IdErr` , `errno` , `errmsg` , `filename` , `linenum` ,`DateErr`)
                                    VALUES (NULL , '".$errno."', '".$errortype[$errno] ." : ".$errmsg ."' , '".$filename."', '".$linenum ."', '".date("Y-m-d H:i:s")."');" ;
        $dbErrorLogSQL->query($insertErrQuery);
    }


}//end function



//error_reporting(E_ALL);
/*
// set the error reporting level for this script
error_reporting(E_USER_ERROR | E_USER_WARNING | E_USER_NOTICE);

// error handler function
function myErrorHandler($errno, $errstr, $errfile, $errline){
   echo "[$errno] $errstr <br/> infile:$errfile inline:$errline<br />\n";
   //create new table eror and insert eror
}
// set to the user defined error handler
$old_error_handler = set_error_handler("myErrorHandler");
*/
// Report all PHP errors (bitwise 63 may be used in PHP 3)

// Turn off all error reporting

//error_reporting(0);

// Report simple running errors
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

// Report all errors except E_NOTICE
//error_reporting(E_ALL ^ E_NOTICE);

// Report all PHP errors (bitwise 63 may be used in PHP 3)
//error_reporting(E_ALL);

// Same as error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);

?>