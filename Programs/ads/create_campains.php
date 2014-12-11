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
global $TitlePage ;
echo "<strong>". (CreateCampaing)."</strong><br/>";
$TitlePage .= ' .:. '.  (CreateCampains) ;

if(isset($_POST['newcamp'])){
	//save new camp
	SaveNewCamp();
}
else{
	//create new camp
	echo  NewCamp();
}//end if

function SaveNewCamp(){
	global $conn,$UserId,$IdComp;
	$CampName = PostFilter($_POST['savecampname']);
	$CompStart = PostFilter($_POST['savecompstart']);
	$CompEnd = PostFilter($_POST['savecompend']);
	$MaxView = PostFilter($_POST['savemaxview']);
	$MaxClick = PostFilter($_POST['savemaxclick']);
	$Budget = PostFilter($_POST['savebudget']);
	$IdComp = GenerateID("campaign","IdComp"); 
	$idBanClnt = $UserId;
	
	$Query = "INSERT INTO `campaign` 
			( `IdComp` , `idBanClnt` , `CampName` , `CompStart` , `CompEnd` , `MaxView` , `MaxClick` , `Activity` , `Budget` )
			VALUES (
			'".$IdComp."', '".$idBanClnt."', '".$CampName."', '".$CompStart."', '".$CompEnd."', '".$MaxView."', '".$MaxClick."', '1', '".$Budget."');";	

	$Recordset = mysqli_query($conn,$Query );	

	
	//now we well add banners to this camp
	include_once("Programs/ads/newBanner.php");
	
}//end function


function NewCamp(){
	global $ThemeName, $TotalRecords,$Rows,$CustomHead,$Lang;

	$CustomHead .= '<script src="Themes/'.$ThemeName.'/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
			<link href="Themes/'.$ThemeName.'/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
				  
	$NewCamp = get_include_contents("Programs/ads/Themes/".$ThemeName."/SaveCamp.php");	

	$NewCamp = VarTheme("{CampName}", "",$NewCamp);
	$NewCamp = VarTheme("{CompStart}",  "",$NewCamp);
	$NewCamp = VarTheme("{CompEnd}",  "",$NewCamp);
	$NewCamp = VarTheme("{MaxView}",  "",$NewCamp);
	$NewCamp = VarTheme("{MaxClick}",  "",$NewCamp);
	$NewCamp = VarTheme("{Budget}",  "",$NewCamp);
	$NewCamp = VarTheme("CampName",  (CampName),$NewCamp);
	$NewCamp = VarTheme("CompStart",  (CompStart),$NewCamp);
	$NewCamp = VarTheme("CompEnd",  (CompEnd),$NewCamp);
	$NewCamp = VarTheme("MaxView",  (MaxView),$NewCamp);
	$NewCamp = VarTheme("MaxClick",  (MaxClick),$NewCamp);
	$NewCamp = VarTheme("Budget",  (Budget),$NewCamp);
	$NewCamp = VarTheme("Next",  (Next),$NewCamp); 
	$NewCamp = VarTheme("Avalueisrequired",  (Avalueisrequired),$NewCamp); 
	$NewCamp = VarTheme("Invalidformat",  (Invalidformat),$NewCamp); 
	
	$NewCamp .= '
		<script type="text/javascript">
		function catcalc(cal) {
				 var date = cal.date;
				var time = date.getTime();
		}
		Calendar.setup({
		inputField     :    "savecompstart",    
		ifFormat       :    "%Y-%m-%d %H:%M:%S",      
		showsTime      :    true,
		timeFormat     :    "24",
		onUpdate       :    catcalc
		});
		Calendar.setup({
		inputField     :    "savecompend",   
		ifFormat       :    "%Y-%m-%d %H:%M:%S",      
		showsTime      :    true,
		timeFormat     :    "24",
		onUpdate       :    catcalc
		});
		</script>';	
	return   $NewCamp;	
}//end function
	
?>
