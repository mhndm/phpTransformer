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
global $TheNavBar,$TitlePage,$ThemeName,$CustomHead ;

$TitlePage .= ' .:. ' . (editBanner) ;
$TheNavBar[] = array( (CampaingBanners),"javascript:history.back(1)");



$CustomHead .= '<script src="Themes/'.$ThemeName.'/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
                <script src="Programs/ads/ajax.js" type="text/javascript"></script>
				<link href="Themes/'.$ThemeName.'/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
				<script src="Themes/'.$ThemeName.'/SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
				<link href="Themes/'.$ThemeName.'/SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />';
				
if(isset($_GET['editban'])){
	$editban = InputFilter($_GET['editban']);
	ExcuteQuery("SELECT * FROM `banner` , `campaign` WHERE `banner`.`IdComp` = `campaign`.`IdComp`
	AND `campaign`.`idBanClnt` = '".$UserId."'
	and `banner`.`IdBanner`='".$editban."'");
	if ($TotalRecords>0){
		//text ban img have <img  flash have <object "
		$IdBanner = $Rows['IdBanner'];
		$IdComp = $Rows['IdComp'];
		$BanName = $Rows['BanName'];
		$ViewMade = $Rows['ViewMade'];
		$ClicksMade = $Rows['ClicksMade'];
		$CodeBan = $Rows['CodeBan'];
		$ClickUrl = $Rows['ClickUrl'];
		$altTxt = $Rows['altTxt'];
		$Position = $Rows['Position'];
		$Active = $Rows['Active'];
		$Cost = $Rows['Cost'];

		if(strrpos($CodeBan, "object")!=0){
			//this is flash banner
			EditFlashBan($IdBanner,$IdComp,$BanName,$ClickUrl,$CodeBan);
		}elseif(strrpos($CodeBan, "img") != 0){
			//this is an imag banner
			EditImgBan($IdBanner,$IdComp,$BanName,$altTxt,$CodeBan,$ClickUrl);
		}
		else{
			// text banner
			EditTextBan($IdBanner,$IdComp,$BanName,$CodeBan,$ClickUrl);
		}//end if
		
	}//END IF
	
}//end if

function EditFlashBan($IdBanner,$IdComp,$BanName,$ClickUrl,$CodeBan){
global $ThemeName ;
	$NewBan = get_include_contents("Programs/ads/Themes/".$ThemeName."/EditFlashBan.php");
	$NewBan = VarTheme("{campid}",$IdComp,$NewBan);
	$NewBan = VarTheme("{valBannerName}",$BanName,$NewBan);
	$NewBan = VarTheme("{valBannerTarget}",$ClickUrl,$NewBan);
	$NewBan = VarTheme("{Working}",  (Working),$NewBan);
	$NewBan = VarTheme("{Stoped}",  (Stoped),$NewBan);
	$NewBan = VarTheme("{Activity}",  (Activity),$NewBan);
	$pieces = explode('"', $CodeBan);
	$NewBan = VarTheme("{valFlashSource}",$pieces[3],$NewBan);
	$NewBan = VarTheme("{Pleaseselectanitem}",  (Pleaseselectanitem),$NewBan);
	$NewBan = VarTheme("{BannerName}",  (BannerName),$NewBan);
	$NewBan = VarTheme("{FlashSource}",  (FlashSource),$NewBan);
	$NewBan = VarTheme("{BannerTarget}",  (BannerTarget),$NewBan);
	$NewBan = VarTheme("Invalidformat",  (Invalidformat),$NewBan);
	$NewBan = VarTheme("Avalueisrequired",  (Avalueisrequired),$NewBan);
	$NewBan = VarTheme("{BannerPositions}",  (BannerPositions),$NewBan);
	$NewBan = VarTheme("{subminewtban}",  (subminewtban),$NewBan);
	$NewBan = VarTheme("{submitnewbanandaddnew}",  (submitnewbanandaddnew),$NewBan);
	$NewBan = VarTheme("{SelectBannerPositions}", BannerPositions(),$NewBan);
	$NewBan = VarTheme("{FlashTextViewandClickPrices}",  (FlashTextViewandClickPrices),$NewBan);	
	$Vars = array("Prog","updateban");
	$Vals = array("ads",$IdBanner);
	$banUpdatetaget = CreateLink("",$Vars,$Vals);
	$NewBan = VarTheme("{bansavetaget}", $banUpdatetaget,$NewBan);
	echo $NewBan ;
}//end function

function EditImgBan($IdBanner,$IdComp,$BanName,$altTxt,$CodeBan,$ClickUrl){
global $ThemeName;
	$NewBan = get_include_contents("Programs/ads/Themes/".$ThemeName."/EditImgBan.php");
	$NewBan = VarTheme("{valImgName}",$BanName,$NewBan);
	$NewBan = VarTheme("{valaltText}",$altTxt,$NewBan);
	$NewBan = VarTheme("{valClickUrl}",$ClickUrl,$NewBan);
	$NewBan = VarTheme("{Working}",  (Working),$NewBan);
	$NewBan = VarTheme("{Stoped}",  (Stoped),$NewBan);
	$NewBan = VarTheme("{Activity}",  (Activity),$NewBan);
	$pieces = explode('"', $CodeBan);
	$NewBan = VarTheme("{valImgSrc}",$pieces[1],$NewBan);
	$NewBan = VarTheme("{campid}",$IdComp,$NewBan);
	$NewBan = VarTheme("{altText}",  (altText),$NewBan);
	$NewBan = VarTheme("{ImgName}",  (ImgName),$NewBan);
	$NewBan = VarTheme("{ImgSrc}",  (ImgSrc),$NewBan);
	$NewBan = VarTheme("{ClickUrl}",  (ClickUrl),$NewBan);
	$NewBan = VarTheme("{Pleaseselectanitem}",  (Pleaseselectanitem),$NewBan);
	$NewBan = VarTheme("Invalidformat",  (Invalidformat),$NewBan);
	$NewBan = VarTheme("Avalueisrequired",  (Avalueisrequired),$NewBan);
	$NewBan = VarTheme("{BannerPositions}",  (BannerPositions),$NewBan);
	$NewBan = VarTheme("{subminewtban}",  (subminewtban),$NewBan);
	$NewBan = VarTheme("{submitnewbanandaddnew}",  (submitnewbanandaddnew),$NewBan);
	$NewBan = VarTheme("{SelectBannerPositions}", BannerPositions(),$NewBan);
	$NewBan = VarTheme("{ImgTextViewandClickPrices}",  (ImgTextViewandClickPrices),$NewBan);	
	$Vars = array("Prog","updateban");
	$Vals = array("ads",$IdBanner);
	$banUpdatetaget = CreateLink("",$Vars,$Vals);
	$NewBan = VarTheme("{bansavetaget}", $banUpdatetaget,$NewBan);
	echo $NewBan ;
}//end function

function EditTextBan($IdBanner,$IdComp,$BanName,$CodeBan,$ClickUrl){
global $ThemeName ;
	$IdComp = $IdComp." ";
	$NewBan = get_include_contents("Programs/ads/Themes/".$ThemeName."/EditTextBan.php");
	$NewBan = VarTheme("{valuebantexttitle}",$BanName,$NewBan);
	$NewBan = VarTheme("{Working}",  (Working),$NewBan);
	$NewBan = VarTheme("{Stoped}",  (Stoped),$NewBan);
	$NewBan = VarTheme("{Activity}",  (Activity),$NewBan);
	$NewBan = VarTheme("{Pleaseselectanitem}",  (Pleaseselectanitem),$NewBan);
	$pieces = explode("<br />", $CodeBan);
	$NewBan = VarTheme("{valbantextdesc1}",$pieces[1],$NewBan);
	$NewBan = VarTheme("{valbantextdesc2}",$pieces[2],$NewBan);
	$pieces = explode(">", $CodeBan);
	$NewBan = VarTheme("{valbanshowaddress}",substr($pieces[6], 0, strlen($pieces[6])-3),$NewBan);
	$NewBan = VarTheme("{valbanTargetaddress}", $ClickUrl,$NewBan);
	$NewBan = VarTheme("{campid}", $IdComp,$NewBan);
	$NewBan = VarTheme("Avalueisrequired",  (Avalueisrequired),$NewBan);
	$NewBan = VarTheme("{BannerExample}",  (BannerExample),$NewBan);
	$NewBan = VarTheme("{bantexttitle}",  (bantexttitle),$NewBan);
	$NewBan = VarTheme("{bantextdesc1}",  (bantextdesc1),$NewBan);
	$NewBan = VarTheme("{bantextdesc2}",  (bantextdesc2),$NewBan);
	$NewBan = VarTheme("{banshowaddress}",  (banshowaddress),$NewBan);
	$NewBan = VarTheme("{bantargeturl}",  (bantargeturl),$NewBan);
	$NewBan = VarTheme("{subminewtban}",  (subminewtban),$NewBan);
	$NewBan = VarTheme("{submitnewbanandaddnew}",  (submitnewbanandaddnew),$NewBan);
	$NewBan = VarTheme("{BannerPositions}",  (BannerPositions),$NewBan);
	$NewBan = VarTheme("{SelectBannerPositions}", BannerPositions(),$NewBan);
	$NewBan = VarTheme("Invalidformat",  (Invalidformat),$NewBan);
	$NewBan = VarTheme("{BanTextViewandClickPrices}",  (BanTextViewandClickPrices),$NewBan);
	$Vars = array("Prog","updateban");
	$Vals = array("ads",$IdBanner);
	$banupdatetarget = CreateLink("",$Vars,$Vals);
	$NewBan = VarTheme("{bansavetaget}", $banupdatetarget,$NewBan);
	echo $NewBan;
}//end function



?>