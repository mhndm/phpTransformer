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
global $TotalRecords,$Rows,$Recordset,$conn,$WebsiteUrl,$AdminFileName,$TitlePage;
global  $WebSiteName, $AdminMail;
$RegUsers ='';
// update users to activated when submit there id
ExcuteQuery("SELECT * FROM `users` where `Active`='0';");
if ($TotalRecords>0){
	for($i=0;$i<$TotalRecords;$i++){
            
		$UserId = $Rows['UserId'];
		$NickName = $Rows['NickName'];
		$UserName = $Rows['UserName'];
		$FamName = $Rows['FamName'];
		$UserMail = $Rows['UserMail'];
                
		if(isset($_POST[$UserId])){
				$upQuery = "UPDATE `users` SET `Active` = '1' WHERE `users`.`UserId` = '".$UserId."' ;";
				$upRecordset = mysqli_query($conn,$upQuery)  ;
                                //send notification email to inform user
                                $From     = $AdminMail;
                                $FromName = $WebSiteName;
                                $AddAddress[0]=$UserMail;
                                $AddAddress[1]=$NickName;
                                $Subject =  $WebSiteName;
                                $Body    = '<div dir="'. DirHtml.'" >'. DearMr.' '.$UserName." ".$FamName."<br/>"
                                    .AdminHasBeenActivateYourAccount."</div>". EmailSignature;
                                $RegUsers.= SendEmail($From,$FromName, $AddAddress, $Subject, $Body);
		}//end if
	$Rows = mysqli_fetch_assoc($Recordset);	
	}//end for
}//end if

//select users ther are not activated yet
ExcuteQuery("SELECT `UserId`,`NickName`,`UserName`,`FamName`,`UserMail` FROM `users` where `Active`='0';");
if ($TotalRecords>0){
$RegUsers = '<strong>'. (RegUsersOk).'</strong>
			<form id="formreguser" name="formreguser" method="post" action="">
			<table width="100%" border="0" cellspacing="2" cellpadding="2">
			  <tr>
			    <td>&nbsp;</td>
			    <td><strong>'. (NickName).'</strong></td>
			    <td><strong>'. (UserName).'</strong></td>
			    <td><strong>'. (FamName).'</strong></td>
			    <td><strong>'. (Email).'</strong></td>
			  </tr>
			  <tr>';

	for($i=0;$i<$TotalRecords;$i++){
		$UserId = $Rows['UserId'];
		$NickName = $Rows['NickName'];
		$UserName = $Rows['UserName'];
		$FamName = $Rows['FamName'];
		$UserMail = $Rows['UserMail'];
		
		$RegUsers .= '  <tr>
		    <td style="border-bottom:dotted; border-bottom-width:thin">
		     <input type="checkbox" name="'.$UserId.'" id="'.$UserId.'" /></td>
		    <td style="border-bottom:dotted; border-bottom-width:thin"> '.$NickName.'</td>
		    <td style="border-bottom:dotted; border-bottom-width:thin"> | '.$UserName.'</td>
		    <td style="border-bottom:dotted; border-bottom-width:thin"> | '.$FamName.'</td>
		    <td style="border-bottom:dotted; border-bottom-width:thin"> | '.$UserMail.'</td>
		  </tr>';
		$Rows = mysqli_fetch_assoc($Recordset);
	}//end for
$RegUsers .= '<input name="saveuserreg" type="submit" value="'. (save).'" />
			<a href="'.$WebsiteUrl.$AdminFileName.'" title="">'. (BackToMainBage).'</a>
			</table></form><br/>';	
}
else{
	$RegUsers = '<a href="'.$WebsiteUrl.$AdminFileName.'" title="">'. (BackToMainBage).'</a> <br/>'. (ThereIsNoWaintingUsers);
}//end if




?>