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

function StrongPassword($Password){

	if(strlen($Password)>=6){
		//strong or medium
		if (StrongOrMedium($Password)){
			return "strong";
		}
		else{
			return "medium";
		}//end if
	}
	else{
		return "easy";
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

class PasswordGenerator
{
	var $passwdchars;
	var $passwd;
	var $length;
	var $minlength;
	var $maxlength;

	function PasswordGenerator($min=6, $max=8, $special=NULL, $chararray=NULL)
	{
		if($chararray == NULL) 	{
        	     $passwdstr = "abcdefghijklmnopqrstuvwxyz";
        	     $passwdstr .= strtoupper($passwdstr);
        	     $passwdstr .= "12345678901234567890"; // twice to up the likelyhood
		    // add special chars to start
             	    if ($special) {
			$passwdstr .= "!@#$%";
             	    }
		} else { 
			$passwdstr = $chararray; 
		}

        	for($i=0; $i<=strlen($passwdstr) - 1; $i++) {
    			$this->passwdchars[$i]=$passwdstr[$i];
        	}
             
        	// randomize the chars
        	srand ((float)microtime()*1000000);
        	shuffle($this->passwdchars);

		$this->minlength = $min;
		$this->maxlength = $max;
	}

	function setLength()	// private method
	{ $this->length = rand($this->minlength, $this->maxlength); }

	function setMin($min)
	{ $this->minlength = $min; }

	function setMax($max)
	{ $this->maxlength = $max; }

	function getPassword()
	{
		$this->passwd = NULL; 
		$this->setLength();

		for($i=0; $i<$this->length; $i++)
		{
			$charnum = rand(0, count($this->passwdchars) - 1);
			$this->passwd .= $this->passwdchars[$charnum];
		}

		return $this->passwd; 
	}

	// to show in browser
	function getHTMLPassword()
	{
		return (htmlentities($this->getPassword()));
	}

	// Allows password to be shown as an image
	// Also semi-tempest resistant, with random text position,
	// and nifty gray color which should difuse tempest emissions
	// Created By: Flinn Mueller (flinn AT activeintra DOT net)
	function getImgPassword()
	{
		$RandPassword = $this->getPassword();

		// create the image
		$png = ImageCreate(200,80);
		$bg = ImageColorAllocate($png,192,192,192);
		$tx = ImageColorAllocate($png,128,128,128);
		ImageFilledRectangle($png,0,0,200,80,$bg);
		srand ((float)microtime()*1000000);
		ImageString($png,5,rand(0,90),rand(0,50),$RandPassword,$tx);

		// send the image
		header("content-type: image/png");
		ImagePng($png);
		imagedestroy ($png);
	}
}
?>