<?php
/***********************************************
*
*	Project: phpTransformer.com .
*	File Location :  . 
*	File Name:  .<font face="Courier New, Courier, mono"></font>
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
global  $SmtpHost,$SmtpPort,$SMTPusername,$SMTPpassword;
global $AdminMail,$WebSiteName;
global $WebSiteName, $AdminMail;
if(isset($_POST['ForgetPassword'])){
	$ForgetPassword=PostFilter(trim($_POST['ForgetPassword']));
	$MailQwery="SELECT * FROM `users` WHERE `UserMail`='".$ForgetPassword."';";

		//global $Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName,  $TotalRecords, $Rows;
		global $conn;
		$MailRecordset = mysqli_query($conn,$MailQwery);	
		$MailTotal = mysqli_num_rows($MailRecordset);
		if ($MailTotal>0){
			//this mail include in our database, sendin g email to the user
			$MailRows = mysqli_fetch_assoc($MailRecordset);
			$ForgetNickName =$MailRows['NickName'];
			mysqli_free_result($MailRecordset);
			//generate new password
			$Password = new PasswordGenerator(10, 20);
			$RandPassword = $Password->getHTMLPassword();
			//change user password
			$NewPassword=md5($RandPassword);		
			$MailUpdateQwery='UPDATE `users` SET `PassWord` = "'.$NewPassword.'" WHERE `UserMail` = "'.$ForgetPassword.'";';
			//echo $MailUpdateQwery;
			$MailRecordset = mysqli_query($conn,$MailUpdateQwery) ;
			$UserMail=$ForgetPassword;
			$NickName=$MailRows['NickName'];
			$UserName=$MailRows['UserName'];
			$FamName=$MailRows['FamName'];
			//send nickname and new password to user mail address

			$From     = $AdminMail;
			$FromName = $WebSiteName;			
			$AddAddress[0]=$UserMail;
			$AddAddress[1]=$NickName;			
			$Subject =  (NewPasswordForYouraccount).' '.$WebSiteName;
			$Body    ='<div dir="'. (DirHtml).'" >'. (DearMr).$UserName." ".$FamName."<br/>". (NewPasswordMessageBody).'<br/>'. (NickName)." : ".$ForgetNickName."<br/>". (NewPassqword)." : <strong>".$RandPassword."</strong><br/>". (YouCanChangeIt)."<br/>"."</div>". (EmailSignature);
			$mail = SendEmail($From, $FromName, $AddAddress, $Subject, $Body);			
			if(!$mail){	
			   echo  (ThereWasAnErrorTendingTheMessage)."<br/>";
			  // echo $mail->ErrorInfo;
				echo '<form method="post" action="'.  LangLink($_SERVER['QUERY_STRING'])  .'">
				<input class="submit" name="Submit" type="submit" value="'.  (TryAgain) .'" />
				</form>';
				
			}
			else{
				echo  (MessageWasSentSuccessfully). "<br/>";
			}
		}
		else{
			echo  (ThisEmailNotCorrect);
			echo '<form method="post" action="'.  LangLink($_SERVER['QUERY_STRING'])  .'">
			<input class="submit" name="Submit" type="submit" value="'.  (TryAgain) .'" />
			</form>';
		}//end if
		if(isset($_COOKIE['ForgetTry'])){
		$ForgetTry = $_COOKIE['ForgetTry'];
		$ForgetTry++;
		setcookie("ForgetTry", $ForgetTry);
		}//endif

}
else{
	if(isset($_COOKIE['ForgetTry'])){
		global $MaxNbrPost;
		if($_COOKIE['ForgetTry']<$MaxNbrPost){
			echo  (DidYouForgetYourPassword);
			$ForgetPassword="emailnone";
			echo '<form method="post" action="'.  LangLink($_SERVER['QUERY_STRING'])  .'">
			<input class="text" name="ForgetPassword" type="text" />
			<input class="submit" name="Submit" type="submit" value="'.  (submit) .'" />
			</form>';
		}
		else{
			echo  (MaximumTryToPost);
		}//end if
	}
	else{
		setcookie("ForgetTry", 0);
		echo  (DidYouForgetYourPassword);
		echo '<form method="post" action="'.  LangLink($_SERVER['QUERY_STRING'])  .'">
		<input class="text" name="ForgetPassword" type="text" />
		<input class="submit" name="Submit" type="submit" value="'.  (submit) .'" />
		</form>';		
	}
}


?>

