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

if(!isset($_POST['SubmitToFriend'])){
	include_once('FormRegistered.php');
}

//echo "registered";
$ErrInfo=false;
//FriendName
if(isset($_POST['FriendName'])){
	$FriendName = PostFilter($_POST['FriendName']);
	if(MinField($FriendName)==false){
		$ErrInfo=true;
	}//end if
	
}
else{
	$FriendName = "";
	//echo $FriendName.' FriendName <br/>';
}//end if

//FriendEmail
if(isset($_POST['FriendEmail'])){
	$FriendEmail = PostFilter($_POST['FriendEmail']);
	if(!preg_match('/^[-!#$%&\'*+\\.\/0-9=?A-Z^_`{|}~]+@([-0-9A-Z]+\.)+([0-9A-Z]){2,4}$/i',$FriendEmail)){
		$ErrInfo=true;
	}//end if
	//echo $FriendEmail.' FriendEmail <br/>' ;
}
else{
	$FriendEmail = "";
}//end if

//FriendTextMessage
if(isset($_POST['FriendTextMessage'])){
	$FriendTextMessage = PostFilter($_POST['FriendTextMessage']);
	//echo $FriendTextMessage.' FriendTextMessage <br/>';
}
else{
	$FriendTextMessage = "";
}//end if
/*
//Code
if(isset($_POST['HidCode'])){
	$HidCode = PostFilter($_POST['HidCode']);
	//echo $HidCode.' HidCode <br/>';
}
else{
	$HidCode ="";
}//end if
*/
//CodePic
if(isset($_POST['CodePic'])){
	$CodePic = PostFilter($_POST['CodePic']);
	//echo $CodePic.' CodePic <br/>';
}
else{
	$CodePic = "";
}//end if
if(isset($_POST['SubmitToFriend'])){
	if(($_SESSION['captcha']==$CodePic) and $ErrInfo==false ){
		//ok send email 
		//send nickname and new password to user mail address
		global $UserName, $FamName, $UserMail;
		$From =$UserMail;
		//echo  $NickName."</br>";
		$FromName = $UserName." ".$FamName;
		//echo $UserName." ".$FamName."</br>";
		//$mail->AddAddress("mhndm@fomacoserver.server.fomaco.com", "mhndm");
		$AddAddress[0]=$FriendEmail;
		$AddAddress[1]=$FriendName;
		//echo $FriendEmail . $FriendName."</br>";
		$Subject =  (MessageFromFriend)." ".$NickName;
		//echo   (MessageFromFriend)." ".$NickName."</br>";
		$Body    ='<div dir="'. (DirHtml).'" >'.$FriendTextMessage."</div>".'<a href="'.$Ref.'" target="_blank">'.$Ref.'</a><br />'. (EmailSignature);
		//echo '<div dir="'. (DirHtml).'" >'.$FriendTextMessage."</div>". (EmailSignature);
		//$mail->AddStringAttachment($row["photo"], "YourPhoto.jpg");
		//$mail->AddAttachment("c:/temp/11-10-00.zip", "new_name.zip");  // optional name
		$mail = SendEmail($From, $FromName, $AddAddress, $Subject, $Body);		
		if(!$mail){
		   echo  (ThereWasAnErrorTendingTheMessage)."<br/>";
		  // echo $mail->ErrorInfo;
		}
		else{
			echo  (MessageWasSentSuccessfully). "<br/>";
			setcookie("ref", "");
		}
	}
	else{
		//error reenter correct info
		echo  '<div class="err" >' .Err .'</div>';
		include_once('FormRegistered.php');
	}//end if
}
?>