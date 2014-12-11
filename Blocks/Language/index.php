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
global $ThemeName,$Lang, $conn;
$Flags = "";
echo "<form onsubmit=\"this.submit.disabled='true'\" action=\"index.php\" method=\"get\">";
echo "<select class=\"select\" name=\"newlanguage\" onchange=\"top.location.href=this.options[this.selectedIndex].value\">";

// select or flags ?

	$LngQuery="SELECT `LangName` FROM `languages` where `Deleted`<>'1';";
	$LngRs = mysqli_query($conn,$LngQuery) ;	
	$LngTotals = mysqli_num_rows($LngRs);
	//echo "LngTotals ".$LngTotals;
	if ($LngTotals>0){
		for ($i=0; $i<$LngTotals; $i++){
			$LngRows = mysqli_fetch_assoc($LngRs);
			$LangName =$LngRows['LangName'];
			$QrySTR=NewLangLink($Lang,$LangName);
			//echo "QrySTR :$QrySTR";
			if(!strpos($QrySTR, "nl")){
				$QrySTR .= "&nl=1";
			}
			//echo "QrySTR :$QrySTR";
			$LangPath = LangLink($QrySTR);
			
			$Flags .= '<a href="'.$LangPath.'" title="'.$LangName.'"><img width="40" height="20" alt="'.$LangName.'" src="Themes/'.$ThemeName.'/Images/Languages/'.$LangName.'.gif" border="0"/></a>&nbsp;';
			if($Lang==$LangName){
				echo "<option value=\"$LangPath\" selected=\"selected\">$LangName</option>";
			}
			else{
				echo "<option value=\"$LangPath\">$LangName</option>";
			}//end if
		}//end for
	}//end if
	mysqli_free_result($LngRs);

echo "</select></form><br/>" .$Flags ;

?>