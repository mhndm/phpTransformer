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
<?php  if (!isset($IsAdmin)){header("location: ../");} ?>
<?php
global $ThemeName,$Rows;

if(isset($_POST['RobotAdmin'])){
	$RobotAdmin = PostFilter($_POST['RobotAdmin']);
	mysqli_query($conn,"update `params` set `RobotAdmin`='".$RobotAdmin."'");
}//END IF

ExcuteQuery("SELECT `RobotAdmin` FROM `params`;");
$RobotAdmin = $Rows['RobotAdmin'];
if($RobotAdmin==1){
	$RobotAdmin = '<option  selected="selected" value="1">'. (yes).'</option>
					<option value="0">'. (no).'</option>';
	$RobotAdminStatus =  (enable);				
}
else{
	$RobotAdmin = '<option value="1">'. (yes).'</option>
					<option selected="selected" value="0">'. (no).'</option>';
	$RobotAdminStatus =  (disable);	
}//end if




$theContent  =  (RobotAdminDesc).'<form name="formRobotAdmin" method="post" action=""><br/><strong>';
$theContent .=  (DiduWantToEnableRobotAdmin)."</strong>";
$theContent .='<select class="select" name="RobotAdmin" id="RobotAdmin">
				'.$RobotAdmin .'
				<input class="submit" type="submit" name="SubmitSaveRobotAdmin" id="SubmitSaveRobotAdmin" value="'
				. (save).'">
				</select></form>';
$theContent .= '('. (RobotAdminStatus).' : <strong>'.$RobotAdminStatus.'</strong>)';

$robotsadmin  = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$robotsadmin  = VarTheme("{todoImg}", "wizard.png",$robotsadmin  );
$robotsadmin  = VarTheme("{ThemeName}", $ThemeName,$robotsadmin  );
$robotsadmin  = VarTheme("{List}", '',$robotsadmin  );
$robotsadmin  = VarTheme("{Content}", $theContent,$robotsadmin  );


	

?>