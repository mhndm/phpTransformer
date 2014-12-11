<?php


//error_reporting(0);
date_default_timezone_set(date_default_timezone_get());
ini_set('session.use_only_cookies',1);
session_name("phpTransformer"); // change the session name from PHPSESSID  to phpTransformer for security reason
/*
$new_name = session_name();
*/
@session_start();

if(isset($_POST['data'])){
	$NickName = $_POST['data'];
}
else{
	$NickName = "Guest";//maybe Hacker
}//end if

include_once("../../config.php");
include_once("../../includes/Sql.php");
require_once("../../DBConnect/".$SqlType."/index.php");

global $conn, $TotalRecords;

// search if this user exist in our data base
SqlConnect();

//update last login
$UpdateQwery = 'UPDATE `users` SET `LastLogin` = '.date("Y-m-d H:i:s").'
				WHERE CONVERT( `users`.`NickName` USING utf8 ) = "'.$NickName.'" LIMIT 1 ;';
$Rec = mysqli_query($conn,$UpdateQwery);
//update user log : user still online
$UpdateQwery = 'UPDATE `userslog` SET `Gmt` = "'.date("Y-m-d H:i:s").'" WHERE `SessionId`="'.session_id().'" and `NickName`="'.$NickName.'";';
$Rec = mysqli_query($conn,$UpdateQwery);



//now we will select Online users (until 1 min) and ther contry code
// first step number of  registered users:
ExcuteQuery('SELECT distinct(`SessionId`) from userslog where (`Gmt` + INTERVAL 60 SECOND) >= NOW() and `NickName` <> "Guest";');
if ($TotalRecords>0){
	$TotalUsersOnline = $TotalRecords;
}
else{
	$TotalUsersOnline =0;
}//endif

// number of Guest :
ExcuteQuery('SELECT distinct(`SessionId`) from userslog where (`Gmt` + INTERVAL 60 SECOND) >=NOW() and `NickName` = "Guest" or `NickName` ="";');
if ($TotalRecords>0){
	$TotalGuestOnline = $TotalRecords;
}
else{
	$TotalGuestOnline = 0;
}//endif

//get geo ip service
ExcuteQuery("SELECT * FROM params;");
if ($TotalRecords>0){
	$GeoIpService = $Rows['GeoIpService'];
}

//conutries statistics :
// Get distinct ip address
ExcuteQuery('SELECT DISTINCT(`IpNbr`) FROM `userslog` where (`Gmt` + INTERVAL 60 SECOND) >= NOW();');
$Contries="";
//echo $TotalRecords;
if ($TotalRecords>0){

	for($i=0;$i<$TotalRecords;$i++){
		$IpNbr = $Rows['IpNbr'];
		$Rows = mysqli_fetch_assoc($Recordset);
		// Now we will get nbr of user from this ip

		$nbrsquery = "SELECT COUNT(*) as nbrs FROM `userslog` WHERE `IpNbr`='".$IpNbr."' and (`Gmt` + INTERVAL 60 SECOND) >= CURDATE();";
			$nbrsRecordset = mysqli_query($nbrsquery) ;
			$nbrsTotalRecords = mysqli_num_rows($nbrsRecordset);
				if ($nbrsTotalRecords>0){
					$nbrsThisIp = $nbrsTotalRecords;
				}//end if

		$ContryCode = strtolower(GetPageContent($GeoIpService.$IpNbr));
		if(isset($Contrys[$ContryCode])){
			$Contrys[$ContryCode]+=$nbrsThisIp;
		}
		else{
			$Contrys[$ContryCode]=1;
		}//end if

	}//end for

	//var_dump($Contrys);
	$thekeys = array_keys($Contrys);

	for($i=0;$i<count($thekeys);$i++){
            //ECHO "../../images/flags/" . $thekeys[$i] .".png";
            if(is_file('../../images/flags/' . $thekeys[$i] .'.png')){
		$Contries .='&lt;img width="18" height="12" src="images/flags/' . $thekeys[$i] .'.png" alt="'. $thekeys[$i].'" border="0" /&gt;'. ':' . $Contrys[$thekeys[$i]].'&lt;br /&gt;';
            }
            else{
                $Contries .='&lt;img width="18" height="12" src="images/flags/yy.png" alt="'. $thekeys[$i].'" border="0" /&gt;'. ':' . $Contrys[$thekeys[$i]].'&lt;br /&gt;';
            }
	}//end for
}
else{
		$Contries .='&lt;img width="18" height="12" src="images/flags/xx.png" alt="xx" border="0" /&gt;'. ': 0 &lt;br /&gt;';
}//end if


header ("content-type: text/xml");
echo "<?xml version='1.0' standalone='yes'?>";
	echo '<data>';
		echo '<members>';
			echo '<total>'.$TotalUsersOnline.'</total>';
		echo '</members>';
		echo '<guests>';
			echo '<total>'.$TotalGuestOnline.'</total>';
		echo '</guests>';
		echo '<Contries>';
			echo '<code>'.$Contries.'</code>';
		echo '</Contries>';
	echo '</data>';

?>
<?php
function GetPageContent($PageUrl){ //get page content from url
	if($PageUrl){
		$handle = @fopen($PageUrl,"rb") ;
                if(!$handle){ //unable to get Geoip service
                    return 'xx';
                }
		return @stream_get_contents($handle);
		fclose($PageUrl);
	}//end if
}//end function

?>