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
<?php
/*
400 HTTP_BAD_REQUEST
401 HTTP_UNAUTHORIZED
403 HTTP_ACCESS_DENIED
404 HTTP_NOT_FOUND
405 HTTP_METHOD_NOT_ALLOWED
408 HTTP_REQUEST_TIME_OUT
410 HTTP_GONE
411 HTTP_LENGTH_REQUIRED
412 HTTP_PRECONDITION_FAILED
413 HTTP_REQUEST_ENTITY_TOO_LARGE
414 HTTP_REQUEST_URI_TOO_LARGE
415 HTTP_SERVICE_UNAVAILABLE
500 HTTP_INTERNAL_SERVER_ERROR
501 HTTP_NOT_IMPLEMENTED
502 HTTP_BAD_GATEWAY
503 HTTP_SERVICE_UNAVAILABLE
506 HTTP_VARIANT_ALSO_VARIES
*/


/*
$project = "phpTransformer";
include_once('includes/Rewrite.php');
include_once('includes/Functions.php');
include_once('includes/checkValidity.php');
include_once('includes/Passwords.php');
//include_once('includes/Functions.php');
include_once('includes/Sql.php');
require_once("DBConnect/".$SqlType."/index.php");
SqlConnect();
*/

require_once('config.php');
include_once("includes/ezsql/ez_sql.php");
include_once('includes/InputFilters.php');

if(isset($_GET['err'])){
	$ErrNumber = InputFilter($_GET['err']);
}
else{
	$ErrNumber = 0;
}//end if

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>'.
		GetErrorPage($ErrNumber);

function GetErrorPage($ErrNumber){

	$Errdb = new db();
	$ErrPage = $Errdb->get_var("SELECT * from `errpages` where `ErrNumber`='".$ErrNumber."';");
	if($ErrPage){
		return $ErrPage ;
	}
	else{
		return 'Error';
	}//end if
	
	/*
	//global $TotalRecords,$Rows,$Recordset ;
	ExcuteQuery("SELECT * from `errpages` where `ErrNumber`='".$ErrNumber."';");
	if ($TotalRecords>0){
	
		return $Rows['ErrPage'];
	}
	else{
		return 'Error';
	}//end if
	*/
	
}//end function

?>