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
global $TotalRecords,$Rows,$MainPrograms ;
if(isset($_GET['Id'])){
	
	$Id = InputFilter($_GET['Id']);
	$query = "select `Link` from `externallinks` where `Id`='".$Id."';";
	ExcuteQuery($query);
	if($TotalRecords>0){
		//id exist redirect to the external web site
		$Link = $Rows['Link'];
		//echo $Link ;
		$Link  = str_replace("\/","",$Link);
		$Link  = str_replace("\\","",$Link);
		echo $Link ;
		header("Location: ".$Link.""); 
	}
	else{
		//this id not exsit, wwe wil redirect to main page
                $Link = CreateLink('', array('Prog'), array($MainPrograms));
		header("Location: ".$Link."");
	}//end if
	
}//end if

?>