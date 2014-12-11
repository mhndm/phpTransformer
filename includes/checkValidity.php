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

function ValidServiceUser($IdService){
	global $TotalRecords,$Rows;
	
	if(isset($_GET['PartnerId'])){
		$PartnerId = InputFilter($_GET['PartnerId']);
	}
	else{
		$PartnerId =  '';
	}//end if
	
	if(isset($_GET['PartnerKey'])){
		$PartnerKey  = InputFilter($_GET['PartnerKey']);
	}
	else{
		$PartnerKey  =  '';
	}//end if
	
	ExcuteQuery("SELECT * FROM `servicespartners` WHERE
				`PartnerId`='".$PartnerId."' ; ");
	if ($TotalRecords>0){
		$UserId = $Rows['UserId'];
	}
	else{
		$UserId = "";
	}//end if
	
	//user active
	ExcuteQuery("SELECT * FROM `users` WHERE
				`UserId`='".$UserId."' and
				`Banned`!='1' and
				`Deleted`!='1' ; ");
	if ($TotalRecords<1){
		//echo 'user active';
		return false;
	}//end if
	//service availble	
	ExcuteQuery("SELECT * FROM `services` WHERE
				`IdService`='".$IdService."' and
				`Available`!='0' ; ");
	if ($TotalRecords<1){
		//echo 'service availble	';
		return false;
	}//end if
	
	//Service partner run 
	ExcuteQuery("SELECT * FROM `servicespartners` WHERE
				`IdService`='".$IdService."' and
				`UserId`='".$UserId."' and
				`PartnerId`='".$PartnerId."' and
				`PartnerKey`='".$PartnerKey ."' and
				`Runing`!='0' and
				`AdminOk`!='0'; ");
	if ($TotalRecords<1){
		//echo 'Service partner run ';
		return false;
	}//END IF

	//refer host is the same for partner

	if(isset($_SERVER['HTTP_REFERER'])){
		$ReferHost = parse_url($_SERVER['HTTP_REFERER']);
		$Host =  $ReferHost['host'];
		ExcuteQuery("SELECT * FROM `servicespartners` WHERE
				`IdService`='".$IdService."' and
				`UserId`='".$UserId."' and
				`PartnerId`='".$PartnerId."' and
				`PartnerKey`='".$PartnerKey ."'; ");
		if ($TotalRecords>0){
			$PartnerSite = parse_url($Rows['PartnerSite']);
			$PartnerHost = $PartnerSite['host'];
			//echo 'Host '.$Host .' PartnerHost ' .$PartnerHost;
			if(strtolower($Host)!=strtolower($PartnerHost)){
				//echo "not the same";
				return false;
			}
		}//end if
	
	}//end if
	
	return true;
	
}//end function

function ValidFileName($FileName=""){
	//this function delete characters not permited in the file name
	$FileName = str_replace('/', "",$FileName);
	$FileName = str_replace('\\', "",$FileName);
	$FileName = str_replace(':', "",$FileName);
	$FileName = str_replace('*', "",$FileName);
	$FileName = str_replace('?', "",$FileName);
	$FileName = str_replace('"', "",$FileName);
	$FileName = str_replace('<', "",$FileName);
	$FileName = str_replace('>', "",$FileName);
	$FileName = str_replace('|', "",$FileName);
	return $FileName;
}//end function

function ValidUser($NewUserName){
	global $TotalRecords;

	if(strrpos($NewUserName, "'") or strrpos($NewUserName, '"')){
		return false;
	}//end if

	SqlConnect();
	ExcuteQuery("SELECT `NickName` FROM `users` WHERE `NickName`='".$NewUserName."';");
	if ($TotalRecords>0){
		return false;
	}
	else{
		return MinField($NewUserName);
	}//end if

}//end function

function MinField($FieldStr){
	if(strlen($FieldStr)>2){
		return true;
	}
	else{
		return false;
	}//end if
}//end function

// checkemail  addresse's SYNTAX
function check_email($email){
$email = strtolower($email); 
	//if (preg_match('/^[-!#$%&\'*+\\.\/0-9=?A-Z^_`{|}~]+@([-0-9A-Z]+\.)+([0-9A-Z]){2,4}$/i', $email)) {
	if(check_email_address($email)){ 
		//Address syntax is OK
		
		SqlConnect();
		ExcuteQuery("SELECT `UserMail` FROM `users` WHERE `UserMail`='".$email."';");
		global $TotalRecords;
		if ($TotalRecords>0){
			return false;
		}
		else{
			return true;
		}
	} 
	else{
		//Address syntax is WRONG
		return FALSE;		
	}
}
function check_email_address($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!preg_match("{^[^@]{1,64}@[^@]{1,255}$}", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if(!preg_match("{^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&?'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$}",
		$local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!preg_match("{^\[?[0-9\.]+\]?$}", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
		(!preg_match("{^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
		?([A-Za-z0-9]+))$}",
		$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}


?>