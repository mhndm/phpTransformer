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
global $Lang,$TitlePage,$TheNavBar , $CustomHead,$ThemeName, $account;

if(is_file('Blocks/AccountBlock/Languages/lang-'.$Lang.'.php')){
	include_once('Blocks/AccountBlock/Languages/lang-'.$Lang.'.php');
}

if(isset($_GET['acnt'])){
	$acnt=InputFilter($_GET['acnt']);
}
else{
	$acnt="fastsignup";
}

switch($acnt){
case "login":
	$TitlePage .= ' .:. ' .  (Account). ' .:. ' ;
	
	$TheNavBar[] = array( (SignUpForm),CreateLink("",array("Prog","acnt"),array("account","login")));

	echo '<div>'.$account .'</div>';
	break;
case "signup":
	$TitlePage .= ' .:. ' .  (Account). ' .:. ' .  SignUpForm;
	
	$TheNavBar[] = array( (SignUpForm),CreateLink("",array("Prog","acnt"),array("account","signup")));

	include_once("Programs/account/SignUp.php");
	break;
case "fastsignup":
	$TitlePage .= ' .:. ' .  (Account). ' .:. ' .  SignUpForm;
	
	$TheNavBar[] = array( (SignUpForm),CreateLink("",array("Prog","acnt"),array("account","fastsignup")));

	include_once("Programs/account/FastSignUp.php");
	break;
case "forget":
	$TitlePage .= ' .:. ' .  (Account). ' .:. ' . strip_tags( (ForgetYourPassword));
	$TheNavBar[] = array( (ForgetYourPassword),CreateLink("",array("Prog","acnt"),array("account","forget")));
	include_once("Programs/account/ForgetPassword.php");
	break;
case "activate":
	$TitlePage .= ' .:. ' .  (Account). ' .:. ' .  (activate);
	$TheNavBar[] = array( (activate),CreateLink("",array("Prog","acnt"),array("account","activate")));
	include_once("Programs/account/Activate.php");
	break;
case "profile":
	include_once("Programs/account/profile.php");
	break;
    
default:

}//End switch

?>