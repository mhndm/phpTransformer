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
global $TheNavBar,$ThemeName ;
$theList = SubIconLink("blocking","banip"). "<br/>"
		.SubIconLink("blocking","bannedip"). "<br/>"
		.SubIconLink("blocking","blockemail"). "<br/>"
		.SubIconLink("blocking","blockedmails"). "<br/>"
		.SubIconLink("blocking","blackedwords"). "<br/>"
		.SubIconLink("blocking","addword"). "<br/>"
                .SubIconLink("faildlogin","FaildLogin"). "<br/>"
                .SubIconLink("antiflood","AntiFlood"). "<br/>"
                ;

if(isset($_GET['subdo'])){
	switch($_GET['subdo']){
		case "banip":
			$theContent =  banip();
			$TheNavBar[] = array( (banip),adminCreateLink("",array("todo","subdo"),array("blocking","banip")));
			break;	
		case "bannedip":
			$theContent =  bannedip();
			$TheNavBar[] = array( (bannedip),adminCreateLink("",array("todo","subdo"),array("blocking","bannedip")));
			break;	
		case "blockemail":
			$theContent =  blockemail();
			$TheNavBar[] = array( (blockemail),adminCreateLink("",array("todo","subdo"),array("blocking","blockemail")));
			break;	
		case "blockedmails":
			$theContent =  blockedmails();
			$TheNavBar[] = array( (blockedmails),adminCreateLink("",array("todo","subdo"),array("blocking","blockedmails")));
			break;	
		case "blackedwords":
			$theContent =  blackedwords();
			$TheNavBar[] = array( (blackedwords),adminCreateLink("",array("todo","subdo"),array("blocking","blackedwords")));
			break;
		case "addword":
			$theContent =  addword();
			$TheNavBar[] = array( (addword),adminCreateLink("",array("todo","subdo"),array("blocking","addword")));
			break;	
		case "delip":
			$theContent =  delip();
			$TheNavBar[] = array( banip,adminCreateLink("",array("todo","subdo"),array("blocking","delip")));
			break;
		case "deleml":
			$theContent =  deleml();
			$TheNavBar[] = array( (deleml),adminCreateLink("",array("todo","subdo"),array("blocking","deleml")));
			break;	
		case "delwrd":
			$theContent =  delwrd();
			$TheNavBar[] = array( (delwrd),adminCreateLink("",array("todo","subdo"),array("blocking","delwrd")));
			break;			
		default :	
			$theContent =  bannedip();
			$TheNavBar[] = array( (bannedip),adminCreateLink("",array("todo","subdo"),array("blocking","bannedip")));
	}//end switch
}
else{
	$theContent =  bannedip();
	$TheNavBar[] = array( (bannedip),adminCreateLink("",array("todo","subdo"),array("blocking","bannedip")));
}//end if		

$blocking = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$blocking = VarTheme("{todoImg}", "firewall.png",$blocking );
$blocking = VarTheme("{ThemeName}", $ThemeName,$blocking );
$blocking = VarTheme("{List}", $theList,$blocking );
$blocking = VarTheme("{Content}", $theContent,$blocking );

function delwrd(){
	$eml = InputFilter($_GET['wrd']);
	mysqli_query($conn,"DELETE FROM `blacklist` WHERE `BlackWord`='".$eml."';");
	return  (WeUnBlockIt);
}//end function

function deleml(){
	$eml = InputFilter($_GET['eml']);
	mysqli_query($conn,"DELETE FROM `blacklist` WHERE `BlackWord`='".$eml."';");
	return  (WeUnBlockIt);
}//end function

function  bannedip(){
	global $TotalRecords,$Rows,$Recordset ;
	$bannedip =  (IPSBannedNotFound);
	ExcuteQuery("SELECT * FROM `ipbanned` ");
	if ($TotalRecords>0){
		$bannedip='<table border="0" cellspacing="2" cellpadding="2">
			  <tr>
			    <td><strong>'. (IpStart).'</strong></td>
			    <td><strong>'. (Endip).'</strong></td>
			    <td><strong>'. (BlockReason).'</strong></td>
			    <td><strong>'. (BlockDate).'</strong></td>
			    <td>&nbsp;</td>
			  </tr>';
		for($i=0;$i<$TotalRecords;$i++){
			$idip = $Rows['idip'];
			$ipStart = $Rows['ipStart'];
			$ipEnd = $Rows['ipEnd'];
			$reason = $Rows['reason'];
			$date = $Rows['date'];
			$Vars = array("todo","subdo","idip");
			$Vals = array("blocking","delip",$idip);
			$idip = '<a href="'.AdminCreateLink("",$Vars,$Vals).'" onclick="return DidUnblock();" title="">'. (unban).'</a>';
			$bannedip .= '  <tr>
						    <td style="border-bottom:thin; border-bottom-color:#999999; border-bottom-style:dotted"> | 
								'.$ipStart.' </td>
							    <td style="border-bottom:thin; border-bottom-color:#999999; border-bottom-style:dotted"> | 
								'.$ipEnd.'</td>
							    <td style="border-bottom:thin; border-bottom-color:#999999; border-bottom-style:dotted"> | 
								'.$reason.'</td>
							    <td style="border-bottom:thin; border-bottom-color:#999999; border-bottom-style:dotted"> | 
								'.$date.'</td>
							    <td style="border-bottom:thin; border-bottom-color:#999999; border-bottom-style:dotted"> | 
								'.$idip.'</td>
						  </tr>';
			$Rows = mysqli_fetch_assoc($Recordset);
		}//end for
		$bannedip.='</table>
					<script language="javascript" type="text/javascript">
						function DidUnblock(){
							return confirm("'. (DouWanttoUnBlockThis).'");
						}
					</script>';
	}//end if
	
	return $bannedip;	
}//end if

function delip(){

	$idip = InputFilter($_GET['idip']);
	mysqli_query($conn,"delete from `ipbanned` where `idip`='".$idip."';");
	$delip =  (WeUnBlockIt);
	return $delip;	
	
}//end if

function  banip(){
	global $CustomHead ;
	if(isset($_POST['Block'])){
		$ipStart = PostFilter($_POST['ipStart']);
		$ipEnd 	 = PostFilter($_POST['ipEnd']);
		$reason  = PostFilter($_POST['reason']);
		$date = date("Y-m-d H:i:s");
		mysqli_query($conn,"INSERT INTO `ipbanned` ( `idip` , `ipStart` , `ipEnd` , `reason` , `date` )
		VALUES (NULL , '".$ipStart."', '".$ipEnd."', '".$reason."', '".$date."');");
		$banip   =  (WeSuccessBlockIt);
	}
	else{
		$CustomHead .= '<script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
						<link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
		$banip ='<form id="blockIp" name="blockIp" method="post" action="">
				<br />
				<table border="0" cellspacing="1" cellpadding="0">
				  <tr>
				    <td>'. (IpStart).' : </td>
				    <td><span id="sprytextfield1">
				  <input class="text" name="ipStart" type="text" id="ipStart" size="15" maxlength="15" />
				  <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span>
				  <span class="textfieldInvalidFormatMsg">'. (Invalidformat).'</span></span></td>
				  </tr>
				  <tr>
				    <td>'. (Endip).' : </td>
				    <td><span id="sprytextfield2">
				<input class="text" name="ipEnd" type="text" id="ipEnd" size="15" maxlength="15" />
				<span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span>
				<span class="textfieldInvalidFormatMsg">'. (Invalidformat).'</span></span></td>
				  </tr>
				</table>
				'. (BlockReason).' :<br />
				<input class="text" name="reason" type="text" id="reason" size="100" maxlength="256" />
				<br /><br />
				  <input class="submit" type="submit" name="Block" id="Block" value="'. (banit).'" />
				</form><br />';
		$banip .= '<script type="text/javascript">
				<!--
				var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "ip");
				var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "ip");
				//-->
				</script>';	
	}//end if

	return $banip;
}//end if

function  blockemail(){
	global $CustomHead;

	if(isset($_POST['blockemail'])){
		$BlackWord   = PostFilter($_POST['BlackWord']);
		$BlockReason = PostFilter($_POST['BlockReason']);
		$BlockDate 	= date("Y-m-d H:i:s");
		
		mysqli_query($conn,"INSERT INTO `blacklist` 
					(`BlackWord`, `BlockReason`, `BlockDate`) VALUES 
					('".$BlackWord."', '".$BlockReason."', '".$BlockDate."');");
					
		$blockemail =  (WeSuccessBlockIt);
	}
	else{
		
		$CustomHead .= '<script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
							<link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
		
		$blockemail ='<form id="formblockemail" name="formblockemail" method="post" action="">
					  <table border="0" cellspacing="1" cellpadding="0">
					  <tr>
					    <td>'. (BlockeMail).' : </td>
					    <td><span id="sprytextfield1">
					      <input class="text" dir="ltr" name="BlackWord" type="text" id="BlackWord" size="25" maxlength="100" />
					      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span>
						   <span class="textfieldInvalidFormatMsg">'. (Invalidformat).'</span>
					  </span></td>
					  </tr>
					</table>
					'. (BlockReason).' : <br />
					<input  class="text" name="BlockReason" type="text" id="BlockReason" size="100" maxlength="1024" />
					<br />
					<input class="submit" type="submit" name="blockemail" id="blockemail" value="'. (banit).'" />
					<br />
					</form>';
		$blockemail .= '<script type="text/javascript">
					<!--
					var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
					//-->
					</script>';
	}//end if
	

				
	return $blockemail;
}//end finction

function  addword(){

	global $CustomHead;

	if(isset($_POST['submitBlackWord'])){
		$BlackWord   = PostFilter($_POST['BlackWord']);
		$BlockReason = PostFilter($_POST['BlockReason']);
		$BlockDate 	= date("Y-m-d H:i:s");
		
		mysqli_query($conn,"INSERT INTO `blacklist` 
					(`BlackWord`, `BlockReason`, `BlockDate`) VALUES 
					('".$BlackWord."', '".$BlockReason."', '".$BlockDate."');");
					
		$addword =  (WeSuccessBlockIt);
	}
	else{
		
		$CustomHead .= '<script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
							<link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
		
		$addword ='<form id="formBlackWord" name="formBlackWord" method="post" action="">
					  <table border="0" cellspacing="1" cellpadding="0">
					  <tr>
					    <td>'. (blackedwords).' : </td>
					    <td><span id="sprytextfield1">
					      <input  class="text" name="BlackWord" type="text" id="BlackWord" size="25" maxlength="100" />
					      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span>
						   <span class="textfieldInvalidFormatMsg">'. (Invalidformat).'</span>
					  </span></td>
					  </tr>
					</table>
					'. (BlockReason).' : <br />
					<input  class="text" name="BlockReason" type="text" id="BlockReason" size="100" maxlength="1024" />
					<br />
					<input class="submit" type="submit" name="submitBlackWord" id="submitBlackWord" value="'. (banit).'" />
					<br />
					</form>';
		$addword .= '<script type="text/javascript">
					<!--
					var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
					//-->
					</script>';
	}//end if
			
	return $addword;
}//end function

function  blockedmails(){

	global $TotalRecords,$Rows,$Recordset ;
	$blockedmails =  (blockemailsnotfound);
	ExcuteQuery("SELECT * FROM `blacklist` WHERE `BlackWord` like '%@%';");
	if ($TotalRecords>0){
	$blockedmails ='<table border="0" cellspacing="2" cellpadding="2">
					  <tr>
					    <td><strong>'. (blockemail).'</strong></td>
					    <td><strong>'. (BlockReason).'</strong></td>
					    <td><strong>'. (BlockDate).'</strong></td>
					    <td>&nbsp;</td>
					  </tr>';	
			for($i=0;$i<$TotalRecords;$i++){
				$BlackWord 	 = $Rows['BlackWord'];
				$BlockReason = $Rows['BlockReason'];
				$BlockDate 	 = $Rows['BlockDate'];
				$Vars = array("todo","subdo","eml");
				$Vals = array("blocking","deleml",$BlackWord);
				$UnBlock = '<a href="'.AdminCreateLink("",$Vars,$Vals).'" onclick="return DidUnblock();" title="">'
							. (unban).'</a>';
				$blockedmails .= '  <tr>
									    <td>'.$BlackWord.'</td>
									    <td>'.$BlockReason.'</td>
									    <td>'.$BlockDate.'</td>
									    <td>'.$UnBlock.'</td>
									  </tr>' ;
													
				$Rows = mysqli_fetch_assoc($Recordset);
			}//end for
			$blockedmails .= '<script language="javascript" type="text/javascript">
						function DidUnblock(){
							return confirm("'. (DouWanttoUnBlockThis).'");
						}
					</script></table>';
	}//end if
	return $blockedmails;
	
}//end function

function  blackedwords(){
	
	global $TotalRecords,$Rows,$Recordset ;
	$blockewrds=  (BlackWordsNotFound);
	ExcuteQuery("SELECT * FROM `blacklist` WHERE `BlackWord` not like '%@%';");
	if ($TotalRecords>0){
		$blockewrds ='<table border="0" cellspacing="1" cellpadding="0">
					  <tr>
					    <td><strong>'. (blackedwords).'</strong></td>
					    <td><strong>'. (BlockReason).'</strong></td>
					    <td><strong>'. (BlockDate).'</strong></td>
					    <td>&nbsp;</td>
					  </tr>';
			for($i=0;$i<$TotalRecords;$i++){
				$BlackWord 	 = $Rows['BlackWord'];
				$BlockReason = $Rows['BlockReason'];
				$BlockDate 	 = $Rows['BlockDate'];
				$Vars = array("todo","subdo","wrd");
				$Vals = array("blocking","delwrd",$BlackWord);
				$UnBlock = '<a href="'.AdminCreateLink("",$Vars,$Vals).'" onclick="return DidUnblock();" title="">'
							. (unban).'</a>';
				$blockewrds .= '  <tr>
									    <td>  '.$BlackWord.'</td>
									    <td> | '.$BlockReason.'</td>
									    <td> | '.$BlockDate.'</td>
									    <td> | '.$UnBlock.'</td>
									  </tr>' ;
													
				$Rows = mysqli_fetch_assoc($Recordset);
			}//end for
			$blockewrds .= '<script language="javascript" type="text/javascript">
						function DidUnblock(){
							return confirm("'. (DouWanttoUnBlockThis).'");
						}
					</script></table>';
	}//end if
	return $blockewrds;
}//end function


?>