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

$theList .= SubIconLink("recycle","RecyclePool"). "<br/>";

if(isset($_GET['subdo'])){
	if($_GET['subdo']== "RecyclePool"){
		$theContent =  RecyclePool();
	}//end if	
}//end if

function RecyclePool(){
	global $ThemeName,$conn,$TotalRecords,$Rows,$Recordset,$Lang  ;
	$RecyclePool = '<img src="Programs/Pool/admin/images/pool.png" alt=""/><br/>';

	if(isset($_GET['RestPool'])){
		$DeletePool = InputFilter($_GET['RestPool']);
		$query = "update `pooltitle` set `Deleted`='0' where `Idpt`='".$DeletePool."' ;";
		$Recordset = mysqli_query($conn,$query);
		$RecyclePool .=  (HasBeenRestoredsuccufully)."<br/>" ;
	}//end if
		
	//delete Pool:
	if(isset($_GET['finDelPool'])){
		$DeletePool = PostFilter($_GET["finDelPool"]);
		//deleting Pool

			
			$query = "delete from `pooltitle` where `Idpt`='".$DeletePool."' ;";
			$Recordset = mysqli_query($conn,$query) ;
			
			$query = "delete from `poollangtitles` where `Idpt`='".$DeletePool."' ;";
			$Recordset = mysqli_query($conn,$query) ;
			
			$query = "delete from `poollangchoices` where `Idpt`='".$DeletePool."' ;";
			$Recordset = mysqli_query($conn,$query) ;
			
			$query = "delete from `poolchoices` where `Idpt`='".$DeletePool."' ;";
			$Recordset = mysqli_query($conn,$query) ;
			
			$query = "delete from `poolusers` where `Idpt`='".$DeletePool."' ;";
			$Recordset = mysqli_query($conn,$query) ;			
			
			$RecyclePool .=  (WeHaveSuccefullyDeletePool) ;					

		
	}
	else{
		$RecyclePool .='';
		ExcuteQuery("select * from `languages` where `LangName`='".$Lang."';");
		$IdLang	= $Rows['IdLang'];
			ExcuteQuery("SELECT * FROM `pooltitle`,`poollangtitles`
						WHERE `Deleted` ='1'
						and  `pooltitle`.`Idpt`=`poollangtitles`.`Idpt`
						and `poollangtitles`.`IdLang` = '".$IdLang."';");
			if ($TotalRecords>0){
				for($i=0;$i<$TotalRecords;$i++){
					$Idpt	 	= $Rows['Idpt'];
					$Title	= $Rows['Title'];
					$Vars		= array("todo","subdo","finDelPool");
					$Vals		= array("recycle","RecyclePool",$Idpt );
					$FinalDelete = '<a onclick="return acceptDel();" href="'
								.AdminCreateLink("",$Vars,$Vals).'" title="" >'
								. (FinalDelete).'</a>';
					$Vars	= array("todo","subdo","RestPool");
					$Vals	= array("recycle","RecyclePool",$Idpt );
					$RecPool= '<a onclick="return acceptrest();" href="'
								.AdminCreateLink("",$Vars,$Vals).'" title="" >'
								. (RestoreRecycle).'</a>';
								
					$RecyclePool .= $Title . ' | '.$FinalDelete . ' | '.$RecPool.'<br/>';
					$Rows = mysqli_fetch_assoc($Recordset);
				}//end for
				$RecyclePool .= '<script language="javascript" type="text/javascript">
									function acceptDel(){
										return confirm("'. (DidUWantToFinalDelete).'");
									}
									function acceptrest(){
										return confirm("'. (DidUWantToRestore).'");
									}									</script>';
			}
			else{
				$RecyclePool .=  (ThereIsNocurrentdeletedPool);
			
			}//end if
	}//end if
	return $RecyclePool;

}//end function
