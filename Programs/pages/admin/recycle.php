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
<?php if (!isset($IsAdmin)){header("location: ../");} ?>
<?php
include_once("Programs/pages/admin/Languages/lang-".$Lang.".php");

$theList .= SubIconLink("recycle","RecyclePages"). "<br/>";

if(isset($_GET['subdo'])){
	if($_GET['subdo']== "RecyclePages"){
		$theContent =  RecyclePages();
	}//end if	
}//end if

function RecyclePages(){
	global $ThemeName,$TotalRecords,$Rows,$conn,$Recordset,$Lang  ;
	
	$RecyclePages = '<img src="Programs/pages/admin/images/pages.png" alt=""/><br/>';
	
	if(isset($_GET['RestPage'])){
		$RestPage = $_GET['RestPage'];
		mysqli_query($conn,"UPDATE `pages` set `Deleted`='0' where `IdPage`='".$RestPage."';");
		$RecyclePages .=  (HasBeenRestoredsuccufully)."<br/>";
	}//end if
	
	if(!isset($_GET['FinDelPage'])){
			ExcuteQuery("SELECT * FROM `languages` where `LangName`='".$Lang."';");
			$IdLang = $Rows['IdLang'];	
			//echo	$IdLang;		
			ExcuteQuery("SELECT * FROM `pages`,`pagelang` 
						WHERE `pages`.`Deleted`='1' 
						and `pagelang`.`IdLang`='".$IdLang."'
						and `pages`.`IdPage`=`pagelang`.`IdPage`;");
			if ($TotalRecords>0){
				$RecyclePages .= '<table width="100%" border="0" cellspacing="1" cellpadding="2">
							  <tr>
							    <td><strong>'. (PageNbr).'</strong></td>
							    <td><strong>'. (PageTitle).'</strong></td>
							    <td>&nbsp;</td>
							    <td>&nbsp;</td>
							  </tr>';
				for($i=0;$i<$TotalRecords;$i++){
					$IdPage = $Rows['IdPage'];
					$PageNbr = $Rows['PageNbr'];
					$PageTitle = $Rows['PageTitle'];
					$Vars		= array("todo","subdo","FinDelPage");
					$Vals		= array("recycle","RecyclePages",$IdPage);
					$DeletePage = '<a onclick="return acceptDel();" href="'
									.AdminCreateLink("",$Vars,$Vals).'" title="">
									'. (FinalDelete).'</a>';
					$Vars		= array("todo","subdo","RestPage");
					$Vals		= array("recycle","RecyclePages",$IdPage);
					$RestPage = '<a onclick="return acceptRest();" href="'
									.AdminCreateLink("",$Vars,$Vals).'" title="">
									'. (RestoreRecycle).'</a>';
					$RecyclePagesRec[] = '<tr>
									    <td>'.$PageNbr.'</td>
									    <td> | '.$PageTitle.'</td>
									    <td> | '.$DeletePage.'</td>
									    <td> | '.$RestPage.'</td>
									</tr>';
					$Rows = mysqli_fetch_assoc($Recordset);
				}//end for
                                $RecycleTabs = Pagination($RecyclePagesRec,10,10);
                                $RecyclePages.= $RecycleTabs[0];
                                $RecyclePages.='</table>';
                                $RecyclePages.= $RecycleTabs[1];
				$RecyclePages .='<script language="javascript" type="text/javascript">
									function acceptDel(){
										return confirm("'. (DidUWantToFinalDelete).'");
									}
									function acceptRest(){
										return confirm("'. (DidUWantToRestore).'");
									}								
									</script>';
			}
			else{
				$RecyclePages .=  (NocurrentDelPages);
			}//end if
	}
	else{
		ExcuteQuery("SELECT * FROM `pages` where `IdPage`='".InputFilter($_GET['FinDelPage'])."';");
		$ObjectId = $Rows['ObjectId'];	
		mysqli_query($conn,"delete from `objects` where `ObjectId`='".$ObjectId."';");
		mysqli_query($conn,"delete from `moderators` where `ObjectId`='".$ObjectId."';");
		mysqli_query($conn,"delete from `pages` where `IdPage`='".InputFilter($_GET['FinDelPage'])."';");
		mysqli_query($conn,"delete from `pagelang` where `IdPage`='".InputFilter($_GET['FinDelPage'])."';");
                // get the idmenu linked with this page
		ExcuteQuery("SELECT * FROM `mainmenu` where `IdPage`='".InputFilter($_GET['FinDelPage'])."';");
		$IdMM = $Rows['IdMM'];
                //delete mainmenu table info
                mysqli_query($conn,"delete from `mainmenu` where `IdPage`='".$IdMM."';");
                //delete mainmenu lang table info
                mysqli_query($conn,"delete from `menlang` where `IdMM`='".$IdMM."';");
		$RecyclePages .=  (SuccessFINALDelPage);
	}//end if
	
	return $RecyclePages;
	
}//end function

?>