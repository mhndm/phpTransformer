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
<?php if (!isset($project)){header("location: ../");} ?>
<?php
ini_set('session.use_only_cookies',1);
session_name("phpTransformer"); // change the session name from PHPSESSID  to phpTransformer for security reason
$new_name = session_name();
@session_start();
/*
global $SessionPath;
$save_path = $SessionPath;
session_set_save_handler("open", "close", "read", "write", "destroy", "gc");

function open() {
 global $sess_save_path, $sess_session_name,$save_path;

 $sess_save_path =$save_path; //$save_path;
 
 return(true);
}//end function

function close() {
 return(true);
}//end function

function read($id) {
 global $sess_save_path, $sess_session_name;

 $sess_file = "$sess_save_path/sess_$id";
 if ($fp = @fopen($sess_file, "r")) {
	if(filesize($sess_file)>0){
		$sess_data = fread($fp, filesize($sess_file));
		return($sess_data);
   }
 } else {
   return(""); // Must return "" here.
 }
}//end function

function write($id, $sess_data) {
 global $sess_save_path, $sess_session_name;

 $sess_file = "$sess_save_path/sess_$id";
 if ($fp = @fopen($sess_file, "w")) {
   return(fwrite($fp, $sess_data));
 } else {
   return(false);
 }

}//end function

function destroy($id) {
 global $sess_save_path, $sess_session_name;
      
 $sess_file = "$sess_save_path/sess_$id";
 return(@unlink($sess_file));
}//end function

function gc($maxlifetime) {
 return true;
}//end function
*/
?>