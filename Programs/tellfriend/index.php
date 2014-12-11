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
<?php if (!isset($project)){header("location: ../../");} ?>
<?php
global $TheNavBar,$GuestCanWrite ,$NickName, $ThemeName,$TitlePage;
// can we trust for this request?
$TitlePage .= ' .:. '. (TellFriend);
$TheNavBar[] = array( (TellFriend),CreateLink("",array("Prog"),array("tellfriend")));

if(isset($_SERVER['HTTP_REFERER'])){
	//$pagename=$_SERVER['PHP_SELF'];  
	//$pagearray=explode("/","$pagename"); 
	$Ref = $_SERVER['HTTP_REFERER'];
	//$Ref = "http://".$_SERVER['HTTP_HOST'].$pagearray[1]."/".$pagearray[2].$Ref;
}
else{
	$Ref ="";
}//end if

if(!isset($_COOKIE['ref'])){
	setcookie("ref", $Ref);
}
else{
	if($_COOKIE['ref']==""){
		setcookie("ref", $Ref);
	}
	else{
		$Ref=$_COOKIE['ref'];
	}
}//end if

$Host = $_SERVER['HTTP_HOST'];
// trusted request
if (strstr($Ref, $Host)){
//echo $Ref." </br> ";
	if($NickName === "Guest"){
		// is this file found in current theme
		if(is_file('Programs/tellfriend/Themes/'.$ThemeName.'/Unregestired.php')){
			include_once('Programs/tellfriend/Themes/'.$ThemeName.'/Unregestired.php');
		}
		else{
			include_once('Programs/tellfriend/Themes/Default/Unregestired.php');
		}//end if		
	}
	else{
	// this is a registered user
		if(is_file('Programs/tellfriend/Themes/'.$ThemeName.'/Registered.php')){
			//include_once('Programs/TellFriend/Themes/'.$ThemeName.'/Unregestired.php');
			include_once('Programs/tellfriend/Themes/'.$ThemeName.'/Registered.php');
		}
		else{
			//include_once('Programs/TellFriend/Themes/'.$ThemeName.'/Unregestired.php');
			include_once('Programs/tellfriend/Themes/Default/Registered.php');
		}//end if	
	}//end if
}
else{
	echo "";
}//end if

?>