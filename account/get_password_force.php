<?php
error_reporting(E_ALL ^ E_NOTICE);

session_id($_POST['session_id']);
session_start();
include_once 'Languages/lang-'.$_SESSION['Lang'].'.php';

echo StrongPassword($_POST['password']);

function StrongPassword($Password){
$Password=trim($Password," "); // for spaces 
	if(strlen($Password)>=6){
		//strong or medium
		if (StrongOrMedium($Password)){
			return '<span class="password_strong" >'.strong.'<span>';
		}
		else{
			return '<span class="password_medium" >'.medium.'<span>';
		}//end if
	}
	else{
		return '<span class="password_easy" >' .easy.'<span>';
	}//end if
}//end function

function StrongOrMedium($Password){
	$i=0;
	// continu small letters
	$regex = "/[a-z\s]/";
	if (preg_match($regex, $Password)) {
		$i++;
	}
	// upercase leeters
	$regex = "/[A-Z\s]/";
	if (preg_match($regex, $Password)) {
		$i++;
	}
	$regex = "/[0-9\s]/";
	if (preg_match($regex, $Password)) {
		$i++;
	}
	if($i==3){
	return true;
	}
}
	
?>