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
// we use this in the ADS and admin CP
include("chart/FusionCharts.php");

if(isset($_POST['ResetStatistics'])){//reset all statistics
	 ResetStatistics();
}//end if

function ResetStatistics(){
	global $TotalRecords,$Rows,$Recordset,$conn  ;
	//we cannot reset contries or themes   statistics because users preference
	//reset lang hits
	$Query = "update `languages` set `Hits`='1';";
	$Rs = mysqli_query( $conn,$Query) ;	
	//reset programs stat
	$Query = "update `programs` set `Hits`='1';";
	$Rs = mysqli_query( $conn,$Query) ;	
	//reset pages  stat
	$Query = "update `pages` set `Hits`='1';";
	$Rs = mysqli_query( $conn,$Query) ;	
	//reset pages  stat
	$Query = "update `pages` set `Hits`='1';";
	$Rs = mysqli_query( $conn,$Query) ;	
	//reset opstatistics  stat
	$Query = "UPDATE `opstatistics` SET 
						`MSIE` = '1',
						`Opera` = '1',
						`FireFox` = '1',
						`Windows` = '1',
						`Konqueror` = '1',
						`Netscape` = '1',
						`Bot` = '1',
						`Linux` = '1',
						`Mac` = '1',
						`FreeBsd` = '1',
						`Other` = '1';";
	$Rs = mysqli_query($conn,$Query)  ;	
	//reset screens  stat
	$Query = "update`screens` set `Hits`='1';";
	$Rs = mysqli_query($conn,$Query)  ;	
	
	//reset Countries  stat
	$Query = "update`cclang` set `rank`='1';";
	$Rs = mysqli_query($conn,$Query)  ;	
	
	//reset userslog  stat
	$Query = "truncate table `userslog` ;";
	$Rs = mysqli_query($conn,$Query)  ;	
	
}//end function

function RobotMainPrograms(){
	global $TotalRecords,$Rows,$Recordset,$conn  ;
	
	$q = "SELECT MAX(`Hits`)AS MaxProg  FROM `programs` ;";
	$Rs = mysqli_query( $conn,$q)  ;	
	$data = mysqli_fetch_assoc($Rs);
	$MaxProg   	  = $data['MaxProg'];

	$q = "SELECT `ProgramName`  FROM `programs` WHERE `Hits`='".$MaxProg."' ;";
	$Rs = mysqli_query( $conn,$q)  ;	
	$data = mysqli_fetch_assoc($Rs);
	$ProgramName   	  = $data['ProgramName'];
	
	return $ProgramName ;
	
}//end function 

function RobotMainLang(){
	global $TotalRecords,$Rows,$Recordset,$conn  ;
	
	$q = "SELECT MAX(`Hits`)AS MaxLang  FROM `languages` ;";
	$Rs = mysqli_query( $conn,$q)  ;	
	$data = mysqli_fetch_assoc($Rs);
	$MaxLang   	  = $data['MaxLang'];

	$q = "SELECT `LangName`  FROM `languages` WHERE `Hits`='".$MaxLang."' ;";
	$Rs = mysqli_query( $conn,$q)  ;	
	$data = mysqli_fetch_assoc($Rs);
	$LangName   	  = $data['LangName'];
	
	return $LangName ;
	
}//end function 

function RobotMainTheme(){
	global $TotalRecords,$Rows,$Recordset,$conn  ;
	$themesStstcs ='';
	$q = " SELECT Distinct(`PrefThem`) as theme FROM `users`; ";
	$Rs = mysqli_query($conn,$q)  ;	
	while($data = mysqli_fetch_assoc($Rs)){
		$theme = $data['theme'];
		$qC = " SELECT COUNT(*) as CountTheme FROM `users` WHERE `PrefThem`='".$theme."'; ";
		$RsC = mysqli_query($conn,$conn,$qC)  ;	
		while($dataC = mysqli_fetch_assoc($RsC)){
			$CountTheme = $dataC['CountTheme'];
			$themesStstcs[$CountTheme] = $theme;
		}//END While
		
	}//end while
	ksort($themesStstcs);
	//var_dump($themesStstcs);
	foreach($themesStstcs as $Key=>$VAL){
		
	}//end foreach
	return $VAL ;
	
}//end function 

function NbrOfSessions($VisistsOrPagespervisit){ //Visists ,Pagespervisit   nbr of visits or average of pages per visits
	// nbr of visits = nbr of sessions UNTIL LAST MONTH TO TODAY
	global $UserId, $TotalRecords,$Rows,$Recordset,$conn  ;
	$SumOfPages =0;
	ExcuteQuery('SELECT Distinct(`SessionId`) AS dst FROM `userslog`;');
	if ($TotalRecords>0){
		// average of browsing per session
		for($i=0; $i<$TotalRecords; $i++){
			$dst = $Rows['dst'];
			//GET number of recurrence for each visit
			$dstquery = 'SELECT COUNT(*) AS CntL FROM `userslog` WHERE `SessionId` ="' . $dst . '";';

				$dstRecordset = mysqli_query($conn,$dstquery)  ;	
				$dstTotalRecords = mysqli_num_rows($dstRecordset);
				$dstRows = mysqli_fetch_assoc($dstRecordset);
				if($dstTotalRecords > 0){
					$CntL = $dstRows ['CntL'];
					$SumOfPages += $CntL;	
				}

			
			$Rows = mysqli_fetch_assoc($Recordset);
		}//End For
		
		if($VisistsOrPagespervisit == "Visists"){
			return $TotalRecords;
		}
		else{
			return round($SumOfPages/$i);
		}
	
	} //end if
}//end function

function NbrOfRegisteredUsers(){
	// nbr of registered users
	global $UserId, $TotalRecords,$Rows,$Recordset,$conn  ;
	// cheking if this user alredy have and publisher account
	ExcuteQuery('SELECT COUNT(*)-2 AS NbrReg FROM `users`;');
	if ($TotalRecords>0){
		$NbrReg = $Rows['NbrReg'];
		return $NbrReg ;
	}
}//end function

function LanguageOfUsers($width=600,$height=300){
	//language of users
	global $UserId, $TotalRecords,$Rows,$Recordset,$conn  ;
	if(DirHtml=="rtl"){
		$xml = '<graph caption="' . FlipText( (LanguageOfUsers)) .'" xAxisName="' .FlipText( (Language)). '" yAxisName="' .FlipText( (Cont)). '" decimalPrecision="0" formatNumberScale="0">';
	}
	else{
		$xml = '<graph caption="' .  (LanguageOfUsers) .'" xAxisName="' . (Language). '" yAxisName="' . (Cont). '" decimalPrecision="0" formatNumberScale="0">';
	}
	ExcuteQuery('SELECT * FROM `languages` ;');
	if ($TotalRecords>0){
		for($i=0; $i<$TotalRecords; $i++){
			$LangName = $Rows['LangName'];
			$Hits	  = $Rows['Hits'];
			//echo "PrefLang" . " " .  $PrefL ;
			//GET number of recurrence for each contry
			//$PrefLangquery = 'SELECT COUNT(*) AS CntL FROM `users` WHERE `PrefLang` ="' . $PrefL . '";';
			//if ($SqlType="MySql"){
			//	$PrefLangRecordset = mysqli_query($conn,$PrefLangquery)  ;	
			//	$PrefLangTotalRecords = mysqli_num_rows($PrefLangRecordset);
			//	$PrefLangRows = mysqli_fetch_assoc($PrefLangRecordset);
			//	if($PrefLangTotalRecords > 0){
			//		$CntL = $PrefLangRows ['CntL'];
					//echo ' ' . $CntL ."<br />";
			$xml .= '<set name="' .$LangName . '" value="'. $Hits .'" color="'. RenderColor() .'" />';
			//	}
			//}//end if
			
			$Rows = mysqli_fetch_assoc($Recordset);
		}//End For
	$xml.= '</graph>';
	return renderChartHTML("includes/chart/FusionCharts/FCF_Column3D.swf","", $xml, "StatChart", $width, $height, false);
	//echo "<br />";
	}
} //end function

function ProgramsMustView($width=600,$height=300){
	// Programs Must View
	global $UserId, $TotalRecords,$Rows,$Recordset,$conn  ;
	ExcuteQuery('SELECT * FROM `userslog` WHERE Month(`Gmt`) =MONTH(CURDATE()-1);');
	//progam must viewed
	if(DirHtml=="rtl"){
		$xml = '<graph caption="' . FlipText( (ProgamMustViewed)) .'" xAxisName="' .FlipText( (Progam)).'" yAxisName="' .FlipText( (Cont)). '" decimalPrecision="0" formatNumberScale="0">';
	}
	else{
		$xml = '<graph caption="' .  (ProgamMustViewed) .'" xAxisName="' . (Progam). '" yAxisName="' . (Cont). '" decimalPrecision="0" formatNumberScale="0">';
	}
	ExcuteQuery("SELECT `ProgramName`,`Hits` FROM `programs`;");
	if ($TotalRecords>0){
		for($i=0; $i<$TotalRecords; $i++){
			$ProgramName = $Rows['ProgramName'];
			$Hits = $Rows['Hits'];
			//echo "program : " . $ProgramName . " has " . $Hits . " hits <br />";
			$xml .= '<set name="' .$ProgramName . '" value="'. $Hits .'" color="'. RenderColor() .'" />';

			$Rows = mysqli_fetch_assoc($Recordset);
		}//end for
	}//end if
	$xml.= '</graph>';
	return renderChartHTML("includes/chart/FusionCharts/FCF_Line.swf","", $xml, "StatChart", $width, $height, false);
	//echo "<br />";
} //end function

function PagesMustViewed($width=600,$height=300){
	//pages must viewed
	global $UserId, $TotalRecords,$Rows,$Recordset,$conn,$Lang  ;
	ExcuteQuery("SELECT * from `languages` where `LangName` = '".$Lang."';");
	if ($TotalRecords>0){
		$IdLang = $Rows['IdLang'];
	}//endif
	if(DirHtml=="rtl"){
		$xml = '<graph caption="' . FlipText( (PagesMustViewed)) .'" xAxisName="' .FlipText( (Pages)). '" yAxisName="' .FlipText( (Cont)). '" decimalPrecision="0" formatNumberScale="0">';
	}
	else{
		$xml = '<graph caption="' .  (PagesMustViewed) .'" xAxisName="' . (Pages). '" yAxisName="' . (Cont). '" decimalPrecision="0" formatNumberScale="0">';

	}//end if
	ExcuteQuery("SELECT `pages`.`Hits` ,`pagelang`.`PageTitle` FROM `pages`, `pagelang`
				 WHERE 
				`pages`.`IdPage` = `pagelang`.`IdPage` 
				and
				`pagelang`.`IdLang`='".$IdLang."'
				ORDER BY `Hits` DESC 
					LIMIT 0 , 20;");
	if ($TotalRecords>0){
		for($i=0; $i<10; $i++){
			$PageTitle = $Rows['PageTitle'];
			$Hits = $Rows['Hits'];
			if(DirHtml=="rtl"){
				$xml .= '<set name="' .FlipText($PageTitle) . '" value="'. $Hits .'" color="'. RenderColor() .'" />';
			}
			else{
				$xml .= '<set name="' .$PageTitle . '" value="'. $Hits .'" color="'. RenderColor() .'" />';
			}
			$Rows = mysqli_fetch_assoc($Recordset);
		} //end for

	$xml.= '</graph>';
	return renderChartHTML("includes/chart/FusionCharts/FCF_Column3D.swf","", $xml, "StatChart",  $width, $height, false);
	//echo "<br />";
		
	}//end if
} //end function

function BrowsersAndOperatingSystems($BrowserOrOpSys, $width=600,$height=300){ // Browser , OpSys
// browsers of users and  operating system of users
	global $UserId, $TotalRecords,$Rows,$Recordset,$conn  ;
	ExcuteQuery("SELECT `MSIE`,`Opera`,`Konqueror`,`Netscape`,`FireFox`,`Bot`,`Windows`,`Linux`,`Mac`,`FreeBsd`,`Other` FROM `opstatistics`;");
	if ($TotalRecords>0){
		// browsers
		if(DirHtml=="rtl"){
			$xml = '<graph caption="' . FlipText( (BrowsersOfUsers)) .'" xAxisName="' .FlipText( (Browsers)). '" yAxisName="' .FlipText( (Cont)). '" decimalPrecision="0" formatNumberScale="0">';
		}
		else{
			$xml = '<graph caption="'.  (BrowsersOfUsers) .'" xAxisName="' . (Browsers). '" yAxisName="' . (Cont). '" decimalPrecision="0" formatNumberScale="0">';
		}
		$xml .= '<set name="MSIE" value="'. $Rows['MSIE'] .'" color="'. RenderColor() .'" />';
		$xml .= '<set name="Opera" value="'. $Rows['Opera'] .'" color="'. RenderColor() .'" />';
		$xml .= '<set name="Konqueror" value="'. $Rows['Konqueror'] .'" color="'. RenderColor() .'" />';
		$xml .= '<set name="Netscape" value="'. $Rows['Netscape'] .'" color="'. RenderColor() .'" />';
		$xml .= '<set name="FireFox" value="'. $Rows['FireFox'] .'" color="'. RenderColor() .'" />';
		$xml .= '<set name="Bot" value="'. $Rows['Bot'] .'" color="'. RenderColor() .'" />';
		$xml.= '</graph>';
		$Browser = renderChartHTML("includes/chart/FusionCharts/FCF_Column3D.swf","", $xml, "StatChart",  $width, $height, false);
		
		//operating systems
		if(DirHtml=="rtl"){
			$xml = '<graph caption="' . FlipText( (OperatingSystems)) .'" xAxisName="' .FlipText( (OperatingSystems)). '" yAxisName="' .FlipText( (Cont)).'" decimalPrecision="0" formatNumberScale="0">';
		}
		else{
			$xml = '<graph caption="' .  (OperatingSystems) .'" xAxisName="' . (OperatingSystems). '" yAxisName="' . (Cont). '" decimalPrecision="0" formatNumberScale="0">';
		}
		$xml .= '<set name="Windows" value="'. $Rows['Windows'] .'" color="'. RenderColor() .'" />';
		$xml .= '<set name="Linux" value="'. $Rows['Linux'] .'" color="'. RenderColor() .'" />';
		$xml .= '<set name="Mac" value="'. $Rows['Mac'] .'" color="'. RenderColor() .'" />';
		$xml .= '<set name="FreeBsd" value="'. $Rows['FreeBsd'] .'" color="'. RenderColor() .'" />';
		//$xml .= '<set name="Other" value="'. $Rows['Other'] .'" color="'. RenderColor() .'" />';
		$xml.= '</graph>';
		$OpSys = renderChartHTML("includes/chart/FusionCharts/FCF_Column3D.swf","", $xml, "StatChart",  $width, $height, false);
	}
	if($BrowserOrOpSys == "Browser"){
		return $Browser;
	}
	else{
		return $OpSys;
	}//end if 
	
} //end function

function Screen($width=600,$height=300){
	//screens x*y
	global $UserId, $TotalRecords,$Rows,$Recordset,$conn  ;
	ExcuteQuery("SELECT `ScreenXY`,`Hits` FROM `screens` where `ScreenXY`<>'Anknow' order by `Hits` DESC;");
	if ($TotalRecords>0){
		if(DirHtml=="rtl"){
			$xml = '<graph caption="' . FlipText( (ScreensOfUsers)) .'" xAxisName="' .FlipText( (Screens)). '" yAxisName="' .FlipText( (Cont)). '" decimalPrecision="0" formatNumberScale="0">';
		}
		else{
			$xml = '<graph caption="' .  (ScreensOfUsers) .'" xAxisName="' . (Screens). '" yAxisName="' . (Cont). '" decimalPrecision="0" formatNumberScale="0">';
		}
		for($i=0; $i<10; $i++){
			$ScreenXY = $Rows['ScreenXY'];
			$Hits = $Rows['Hits'];
			$xml .= '<set name="' . $ScreenXY .'" value="'. $Hits .'" color="'. RenderColor() .'" />';
			$Rows = mysqli_fetch_assoc($Recordset);
		}//end for
		$xml.= '</graph>';
		return renderChartHTML("includes/chart/FusionCharts/FCF_Column3D.swf","", $xml, "StatChart",  $width, $height, false);
			
	}//end if
}//end function

function ThemesStatistics($width=600,$height=300){
	// themes of users
	global $UserId, $TotalRecords,$Rows,$Recordset,$conn  ;
	if(DirHtml=="rtl"){
		$xml = '<graph caption="' . FlipText( (ThemeName)) .'" xAxisName="' .FlipText( (ThemeName)). '" yAxisName="' .FlipText( (Cont)). '" decimalPrecision="0" formatNumberScale="0">';
	}
	else{
		$xml = '<graph caption="'.  (ThemeName) .'" xAxisName="' . (ThemeName). '" yAxisName="' . (Cont). '" decimalPrecision="0" formatNumberScale="0">';
	}
	ExcuteQuery('SELECT DISTINCT(ThemeName) AS Themes FROM `themes`;');
	if ($TotalRecords>0){
		for($i=0; $i<$TotalRecords; $i++){
			$Themes = $Rows['Themes'];
			//GET number of recurrence for each theme
			$Themesquery = 'SELECT COUNT(*) AS Cnt FROM `users` WHERE `PrefThem` ="' . $Themes . '";';

				$ThemesRecordset = mysqli_query($conn,$Themesquery)  ;	
				$ThemesTotalRecords = mysqli_num_rows($ThemesRecordset);
				$ThemesRows = mysqli_fetch_assoc($ThemesRecordset);
				if($ThemesTotalRecords>0){
					$Cnt = $ThemesRows ['Cnt'];
					$xml .= '<set name="' . $Themes . '" value="'. $Cnt .'" color="'. RenderColor() .'" />';
				}

			$Rows = mysqli_fetch_assoc($Recordset);
		}
	$xml.= '</graph>';
	return renderChartHTML("includes/chart/FusionCharts/FCF_Column2D.swf","", $xml, "StatChart", $width, $height, false);
	}
}//end function


function CountiresOfUsers($width=600,$height=300){
	// countries of users
	global $UserId, $TotalRecords,$Rows,$Recordset,$conn,$Lang ;

	
	if(DirHtml=="rtl"){
		$xml = '<graph caption="' . FlipText( (countriesofusers)) .'" xAxisName="' .FlipText( (contrie)). '" yAxisName="' .FlipText( (Cont)). '" decimalPrecision="0" formatNumberScale="0">';
	}
	else{
		$xml = '<graph caption="' .  (countriesofusers) .'" xAxisName="' . (contrie). '" yAxisName="' . (Cont). '" decimalPrecision="0" formatNumberScale="0">';
	}
	ExcuteQuery("SELECT * FROM `cclang` WHERE `rank`>0
					ORDER BY `rank` DESC 
					LIMIT 0 , 10;");
	if ($TotalRecords>0){

		for($i=0; $i<$TotalRecords; $i++){
			$Contry = $Rows['Contry'];
			$rank = $Rows['rank'];
			$xml .= '<set name="' . $Contry . '" value="'. $rank .'" color="'. RenderColor() .'" />';
			$Rows = mysqli_fetch_assoc($Recordset);
		}//end FOR
			
	}//end if
	$xml.= '</graph>';
	return renderChartHTML("includes/chart/FusionCharts/FCF_Column2D.swf","", $xml, "StatChart", $width, $height, false);

}//end function

?>