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
if(isset($_GET['actvcode'])){
	$actvcode=InputFilter($_GET['actvcode']);
}
else{
	$actvcode="none";
}
if(isset($_GET['user'])){
	$user=InputFilter($_GET['user']);
}
else{
	$user="Guest";
}

SqlConnect();

	global $conn,$Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName,  $TotalRecords, $Rows;
	$SelectQwery="SELECT * FROM `users` WHERE `ConfirmCode`='".$actvcode."' and `NickName`='".$user."';";
	//$SelectQwery="SELECT * FROM `users` WHERE `ConfirmCode`='".$actvcode."';";
	//echo $SelectQwery."<br>";
	$RSSelect = mysqli_query($conn,$SelectQwery);	
	if ($TotalRecords>0){
		$ConfirmCodeRows = mysqli_fetch_assoc($RSSelect);
		$ConfirmCode= $ConfirmCodeRows['ConfirmCode'];

		if(trim($actvcode)==trim($ConfirmCode)){
			//update user profile to be activated
			$UpdateQuery="UPDATE `users` SET `Active` = '1' WHERE  `users`.`NickName` = '".$user."' LIMIT 1 ;";
			$RSUpdate = mysqli_query($UpdateQuery) ;	
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			echo  (SuccessAtivatedNewUser).$user.'<br/><a href="http://'.$host.$uri.'/">'. (ToHomePage)."</a>";
		}
		else{
			echo  (ErrInActivateNewUser);
		}//endif
	}



?>