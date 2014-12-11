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
global $TotalRecords,$Rows,$conn ,$CustomHead,$FloodSec ;
$theList = SubIconLink("blocking","banip"). "<br/>"
		.SubIconLink("blocking","bannedip"). "<br/>"
		.SubIconLink("blocking","blockemail"). "<br/>"
		.SubIconLink("blocking","blockedmails"). "<br/>"
		.SubIconLink("blocking","blackedwords"). "<br/>"
		.SubIconLink("blocking","addword"). "<br/>"
                .SubIconLink("faildlogin","FaildLogin"). "<br/>"
                .SubIconLink("antiflood","AntiFlood"). "<br/>"
                ;
if(isset($_POST['FloodSec'])){
	$FloodSec = PostFilter($_POST['FloodSec'])/1000;
	$result = mysqli_query($conn,"UPDATE `params` SET `FloodSec`='".$FloodSec."'");
}//end if

require_once('Global.php');
$CustomHead .= '<script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
				<link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
$antiflood  =  (SiteHaveAntiFloodSystem)."<br/>";
$antiflood .=  (NumberOfMillisecondsBetweenTwoRequest);
$antiflood .='<form id="formFlood" name="formFlood" method="post" action="">
				<span id="sprytextfield1">
			    <input class="text" name="FloodSec" type="text" value="'.($FloodSec * 1000).'" size="5" maxlength="5" />
				MilliSeconds 
				  <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span>
				  <span class="textfieldInvalidFormatMsg">'. (Invalidformat).'</span></span>
			    <input class="submit" type="submit" name="FloodSubmit" id="FloodSubmit" value="'. (save).'" />
			</form>';

$antiflood .='<script type="text/javascript">
			<!--
			var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer");
			//-->
			</script>';
$theContent = $antiflood;
$antiflood = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$antiflood = VarTheme("{todoImg}", "firewall.jpg",$antiflood );
$antiflood = VarTheme("{ThemeName}", $ThemeName,$antiflood );
$antiflood = VarTheme("{List}", $theList,$antiflood );
$antiflood = VarTheme("{Content}", $theContent,$antiflood );

?>