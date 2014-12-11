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
global $UserId,$TotalRecords,$conn,$Rows,$Recordset,$ThemeName  ;

//modifie Campaing status
if(isset($_POST['CompId'])){
	$CompId = PostFilter($_POST['CompId']);
	//echo "CompId " . $CompId;
	if(isset($_POST['StopCamp'])){
		StopCampaingn($CompId);
	}//endi f
	
	if(isset($_POST['ResumeCamp'])){
		ResumeCampaingn($CompId);
	}//endi f	
	
	if(isset($_POST['deleteCamp'])){
		 deleteCampaingn($CompId);
	}//endi f	
	
	if(isset($_POST['editCamp'])){
		echo editCampaingn($CompId);
		echo '
			<script type="text/javascript">
			    function catcalc(cal) {
			        var date = cal.date;
			        var time = date.getTime();
			    }
			    Calendar.setup({
			        inputField     :    "savecompstart",   // id of the input field
			        ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
			        showsTime      :    true,
			        timeFormat     :    "24",
			        onUpdate       :    catcalc
			    });
				    Calendar.setup({
			        inputField     :    "savecompend",   // id of the input field
			        ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
			        showsTime      :    true,
			        timeFormat     :    "24",
			        onUpdate       :    catcalc
			    });
			</script>';
	}//end if	
}//end if
if(isset($_POST['compid'])){
	$CompId = PostFilter($_POST['compid']);
	if(isset($_POST['savecamp'])){
		//echo $_POST['saveCamp'];
		saveCamp($CompId);
	}//end if
}//end if

function saveCamp($CompId){
	global $conn;
	$CampName = PostFilter($_POST['savecampname']);
	$CompStart = PostFilter($_POST['savecompstart']);
	$CompEnd = PostFilter($_POST['savecompend']);
	$MaxView = PostFilter($_POST['savemaxview']);
	$MaxClick = PostFilter($_POST['savemaxclick']);
	$Budget = PostFilter($_POST['savebudget']);
	
	$Query = "UPDATE `campaign` SET 
			`CampName` = '".$CampName."',
			`CompStart` = '".$CompStart."',
			`CompEnd` = '".$CompEnd."',
			`MaxView` = '".$MaxView."',
			`MaxClick` = '".$MaxClick."',
			`Budget` = '".$Budget."' 
			WHERE  `campaign`.`IdComp`  = '".$CompId."';";

		$Recordset = mysqli_query($conn,$Query ) ;	

	
}//end function

function editCampaingn($CompId){
	global $ThemeName, $TotalRecords,$Rows,$CustomHead,$UserId ;
	//befor showing edit form for the user , we must 
	$SecQuery ="SELECT * FROM `campaign` WHERE `IdComp`='".$CompId."' and `idBanClnt`='".$UserId."';";
	ExcuteQuery($SecQuery);
	if ($TotalRecords>0){
		$CustomHead .= '<link rel="stylesheet" type="text/css" media="all" href="includes/jscalendar/Style/calendar-Default.css" />
					<script type="text/javascript" src="includes/jscalendar/calendar.js"></script>
					<script type="text/javascript" src="includes/jscalendar/Languages/calendar-Arabic.js"></script>
					<script type="text/javascript" src="includes/jscalendar/calendar-setup.js"></script>
					<script src="Programs/ads/Themes/Default/SpryValidationTextField.js" type="text/javascript"></script>
					 <link href="Programs/ads/Themes/Default/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
		//echo "edit camp " .$ThemeName ;
		$Query = "SELECT `CampName`, `CompStart`, `CompEnd`, `MaxView`, `MaxClick`, `Budget` FROM `campaign` 
		WHERE `IdComp`='".$CompId."';";
		ExcuteQuery($Query);
		if ($TotalRecords>0){
			$CampName = $Rows['CampName'];
			$CompStart = $Rows['CompStart'];
			$CompEnd = $Rows['CompEnd'];
			$MaxView = $Rows['MaxView'];
			$MaxClick = $Rows['MaxClick'];
			$Budget = $Rows['Budget'];
		}//end if
		
		$EditCamp = get_include_contents("Programs/ads/Themes/".$ThemeName."/EditCamp.php");	
		$EditCamp = VarTheme("{CampName}", $CampName,$EditCamp);
		$EditCamp = VarTheme("{CompStart}", $CompStart,$EditCamp);
		$EditCamp = VarTheme("{CompEnd}", $CompEnd,$EditCamp);
		$EditCamp = VarTheme("{MaxView}", $MaxView,$EditCamp);
		$EditCamp = VarTheme("{MaxClick}", $MaxClick,$EditCamp);
		$EditCamp = VarTheme("{Budget}", $Budget,$EditCamp);
		$EditCamp = VarTheme("CampName",  (CampName),$EditCamp);
		$EditCamp = VarTheme("CompStart",  (CompStart),$EditCamp);
		$EditCamp = VarTheme("CompEnd",  (CompEnd),$EditCamp);
		$EditCamp = VarTheme("MaxView",  (MaxView),$EditCamp);
		$EditCamp = VarTheme("MaxClick",  (MaxClick),$EditCamp);
		$EditCamp = VarTheme("Budget",  (Budget),$EditCamp);
		$EditCamp = VarTheme("Save",  (save),$EditCamp); 
		$EditCamp = VarTheme("CompId", $CompId,$EditCamp); 
		$EditCamp = VarTheme("Avalueisrequired",  (Avalueisrequired),$EditCamp); 
		$EditCamp = VarTheme("Invalidformat",  (Invalidformat),$EditCamp); 
		return  $EditCamp;
	}
	else{
		return  (UcantEditThisCamp);
	}//end if
}//end function

function StopCampaingn($CompId){
	global $conn;
	$Query = "UPDATE `campaign` SET `Activity` = '0' WHERE `campaign`.`IdComp` = '".$CompId."';";
	$Recordset = mysqli_query($conn,$Query ) ;	

	$Query = "UPDATE `banner` SET `Active` = '0' WHERE `IdComp` = '".$CompId."';";
	$Recordset = mysqli_query($conn,$Query ) ;	

}//end function

function ResumeCampaingn($CompId){
	global $conn;
	$Query = "UPDATE `campaign` SET `Activity` = '1' WHERE `campaign`.`IdComp` = '".$CompId."';";
	$Recordset = mysqli_query($conn,$Query ) ;	

}//end function

function deleteCampaingn($CompId){
	global $conn;
	$Query = "UPDATE `campaign` SET `Activity` = '-1' WHERE `campaign`.`IdComp` = '".$CompId."';";
	$Recordset = mysqli_query($conn,$Query ) ;	
	$Query = "UPDATE `banner` SET `Active` = '0' WHERE `IdComp` = '".$CompId."';";
	$Recordset = mysqli_query($conn,$Query ) ;	
}//end function


$Vars = array("Prog","CreateCamp");
$Vals = array("ads","yes");
$newCampaignPage = CreateLink("",$Vars,$Vals);
$Vars = array("Prog","accdet");
$Vals = array("ads","yes");
$accDet = CreateLink("",$Vars,$Vals);
$Vars = array("Prog","PriceList");
$Vals = array("ads","show");
$PriceList = CreateLink("",$Vars,$Vals);
$CurrentCamps = "<br /><center><strong>" .  (Campains). "</strong></center><br />";
$CurrentCamps .=  '<form id="formCamp" name="formCamp" method="post" action="">
			<input class="submit" name="StopCamp" type="submit" value="'. (Stop).'" />
			<input class="submit" name="ResumeCamp" type="submit" value="'. (Resume).'" />
			<input class="submit" name="deleteCamp" type="submit" value="'. (Delete).'" />
			<input class="submit" name="editCamp" type="submit" value="'. (Edit).'" />
			<a href="'.$newCampaignPage.'" title="'. (newCampaign).'">'. (newCampaign).'</a>
			&nbsp;-&nbsp;<a href="'.$accDet.'" title="'. (AccountDetails).'">'. (AccountDetails).'</a>
			&nbsp;-&nbsp;<a href="'.$PriceList.'" title="'. (PriceList).'">'. (PriceList).'</a>
			<br /> <br />';
$CampQuery = "SELECT `IdComp`,`CampName`, `CompStart`, `CompEnd`, `MaxView`, `MaxClick`, `Activity`, `Budget` FROM `campaign` 
			WHERE `idBanClnt`='".$UserId."' order by `IdComp` desc;";

ExcuteQuery($CampQuery);
if ($TotalRecords>0){

	for($i=0;$i<$TotalRecords;$i++){
		$IdComp = $Rows['IdComp'];
		$CampName = $Rows['CampName'];
		$CompStart = $Rows['CompStart'];
		$CompEnd = $Rows['CompEnd'];
		$MaxView = $Rows['MaxView'];
		$MaxClick = $Rows['MaxClick'];
		$Activity = $Rows['Activity'];
		$Budget = $Rows['Budget'];
		$campainsTable = get_include_contents('Programs/ads/Themes/'.$ThemeName.'/campainsTable.php');
		$Vars = array("Prog","CampDetails");
		$Vals = array("ads",$IdComp);
		$campainsTable = VarTheme("{CampName}", '<a href="'.CreateLink('',$Vars,$Vals).'" title="'. (CampName).' : '.$CampName.'">'.$CampName.'</a>',$campainsTable);
		$campainsTable = VarTheme("{CompStart}", $CompStart,$campainsTable);
		$campainsTable = VarTheme("{CompEnd}", $CompEnd,$campainsTable);
		$campainsTable = VarTheme("{MaxView}", $MaxView,$campainsTable);
		$campainsTable = VarTheme("{MaxClick}", $MaxClick,$campainsTable);
		
		//convert activity value to comprehensible word
		if($Activity=="1"){
			$Activity = (Working);
		}
		elseif($Activity=="0"){
			$Activity = (Stoped);
		}
		else{
			$Activity = (Deleted);
		}
		
		$campainsTable = VarTheme("{Activity}", $Activity,$campainsTable);
		$campainsTable = VarTheme("{Budget}", $Budget."$",$campainsTable);
		$campainsTable = VarTheme("{NbrOfBans}", NbrOfBanOfCamp($IdComp),$campainsTable);
		$campainsTable = VarTheme("{ViewsMade}", ViewMade($IdComp),$campainsTable);
		$campainsTable = VarTheme("{ClicksMade}", ClicksMade($IdComp),$campainsTable); 	 	
		$campainsTable = VarTheme("{CurrentCharge}", CurrentCharge($IdComp),$campainsTable); 
		$campainsTable = VarTheme("{IdComp}", $IdComp,$campainsTable); 
		$campainsTable = VarTheme("CampName",  (CampName),$campainsTable);
		$campainsTable = VarTheme("CompStart", (CompStart),$campainsTable);
		$campainsTable = VarTheme("CompEnd",  (CompEnd),$campainsTable);
		$campainsTable = VarTheme("MaxView",  (MaxView),$campainsTable);
		$campainsTable = VarTheme("MaxClick",  (MaxClick),$campainsTable);
		$campainsTable = VarTheme("Activity",  (Activity),$campainsTable);
		$campainsTable = VarTheme("Budget",  (Budget),$campainsTable);
		$campainsTable = VarTheme("NbrOfBans",  (NbrOfBans),$campainsTable);
		$campainsTable = VarTheme("ViewsMade",  (ViewsMade),$campainsTable);
		$campainsTable = VarTheme("ClicksMade",  (ClicksMade),$campainsTable); 	 	
		$campainsTable = VarTheme("CurrentCharge",  (CurrentCharge),$campainsTable); 
		//$CurrentCamps. = $campainsTable ."<br />";
		$Thiscampains[] = $campainsTable ."<br />";
		$Rows = mysqli_fetch_assoc($Recordset);
	}//end for

}
else{

		$Thiscampains[] = '';
}//end if

//if not in edit mode show all campains
if(!isset($_POST['editCamp'])){	
		echo $CurrentCamps;
                /*
		echo CreateNaviPage($Thiscampains,$MaxResultPerPage=10,$ShowNaviBar=1);	
		echo CreateNaviPage($Thiscampains,$MaxResultPerPage=10,$ShowNaviBar=0);
                */
                $ThiscampainsTab = Pagination($Thiscampains,10,10) ;
                echo $ThiscampainsTab[0];
		echo '</form>';
                echo $ThiscampainsTab[1];
}//END IF

function NbrOfBanOfCamp($IdComp){
global $conn;
	$CountQuery = "SELECT count(`IdBanner`) as BanCount FROM `banner` 
					WHERE `IdComp`='".$IdComp."';";

		$CountRecordset = mysqli_query($conn,$CountQuery ) ;	
		$CountTotalRecords = mysqli_num_rows($CountRecordset);
		if ($CountRecordset ){
			$CountRows = mysqli_fetch_assoc($CountRecordset);
			return $CountRows['BanCount'];
		}
		else{
			return 0;
		}//end if

}//end function



?>

