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
global $conn,$TotalRecords,$Rows,$Recordset;
$TitlePage .= ' .:. '. (CampaingBanners) ;
if(isset($_GET['CampDetails'])){
	$DetailsIdComp = InputFilter($_GET['CampDetails']);
	ExcuteQuery("SELECT `CampName` FROM `campaign` WHERE `IdComp`='".$DetailsIdComp."'");
	if ($TotalRecords>0){
		$CampName = $Rows['CampName'];
	}//end if
	if(!isset($_POST['newcampbanner'])){
		echo  (DetailsForCampaing) . $CampName."<br/><br/>";
				echo '<form method="post" target="">
			<input name="campid" type="hidden" id="campid" value="'.$DetailsIdComp.'" />
			<input class="submit" name="newcampbanner" type="submit" value="'. (ConstructNewBannersForThisCamp).'" />
			<br/><br/></form>';
		
		ShowBanners($DetailsIdComp);
	}//end if

}//end if


function ShowBanners($DetailsIdComp){

	global $conn,$TotalRecords,$Rows,$Recordset;
	//echo $DetailsIdComp;
	ExcuteQuery("SELECT `banner`.`IdBanner`,
						`banner`.`BanName`,
						`banner`.`ViewMade`,
						`banner`.`ClicksMade`,
						`banner`.`CodeBan`, 
						`banner`.`ClickUrl`,
						`banner`.`altTxt`,
						`banner`.`Active`,
						`banner`.`Cost`,
						`bannerpositions`.`PosWidth`,
						`bannerpositions`.`PosHeight` 
						FROM `banner`,`bannerpositions` 
						WHERE `IdComp`='".$DetailsIdComp."' 
						and (`banner`.`Position`=`bannerpositions`.`PositionNbr`);");
		echo $TotalRecords;				
	if ($TotalRecords>0){
		for($i=0;$i<$TotalRecords;$i++){
			$BanName = $Rows['BanName'];
			$ClicksMade = $Rows['ClicksMade'];
			$ViewMade = $Rows['ViewMade'];
			$Active = $Rows['Active'];
			$Cost = $Rows['Cost'];
			$IdBanner = $Rows['IdBanner'];
			$altTxt = $Rows['altTxt'];
			$PosWidth = $Rows['PosWidth'];
			$PosHeight = $Rows['PosHeight'];
			$ClickUrl = $Rows['ClickUrl'];
			$CodeBan = $Rows['CodeBan'];
			$CodeBan = VarTheme("{width}",$PosWidth,$CodeBan);
			$CodeBan = VarTheme("{height}",$PosHeight,$CodeBan);
			
			//convert activity value to comprehensible word
			if($Active=="1"){
				$Active = (Working);
			}
			elseif($Active=="0"){
				$Active = (Stoped);
			}
			else{
				$Active = (Deleted);
			}
			
			$Vars = array("Prog","editban");
			$Vals = array("ads",$IdBanner);
			echo $CodeBan. '<br/>'
			.'<a href="'.CreateLink("",$Vars,$Vals).'" title="'. (edit).' '.$BanName.'">
			<img src="Programs/ads/images/miniedit.gif" alt="'. (edit).'" border="0" />&nbsp;'
			. (BannerName) . ":" . $BanName . "&nbsp; "
			. (Activity) . ":". $Active . "&nbsp;"
			. (ClicksMade) . ":". $ClicksMade . "&nbsp; "
			. (ViewsMade) . ":" . $ViewMade . "&nbsp; "
			. (CurrentCharge) . ":" . round($Cost,2) ."&nbsp;$&nbsp; "
			.'<br/></a>' ;
			$Rows = mysqli_fetch_assoc($Recordset);
		}//end for
	}
	else{
		//print default banner for no ads availble
		echo  (NoBannersForThisCamp);
	}//end if
}//end function

?>