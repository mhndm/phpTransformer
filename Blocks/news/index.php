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
global $ThemeName, $Lang, $TotalRecords,$Rows,$NewsMaxNbr,$Recordset ;
global  $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName, $conn;

$NbrNews=0;
SqlConnect();
//get IdLang
ExcuteQuery('SELECT `IdLang`FROM `languages` WHERE `LangName`="'.$Lang.'";');
if ($TotalRecords>0){
	$IdLang= $Rows['IdLang'];
}
//get IdNews
//echo$IdLang;
closeQuery();

$Newsquery = "SELECT * FROM `news` WHERE `Active`='1' and `Deleted`<>'1' order by `IdNews` DESC;";

	$NewsRecordset = mysqli_query($conn,$Newsquery);	
	$NewsTotalRecords = mysqli_num_rows($NewsRecordset);
	$NewsLine = '';
	if ($NewsTotalRecords>0){
			if($NewsMaxNbr>=$NewsTotalRecords){
				$ActiveNews = $NewsTotalRecords;
			}
			else{
				$ActiveNews = $NewsMaxNbr;
			}//end if
		$NewsLine ='';
		 
		 
			$NewsRows 	= mysqli_fetch_assoc($NewsRecordset);
			$IdNews 	= $NewsRows['IdNews'];
			$IdUserName =$NewsRows['IdUserName'];
			//echo $IdUserName;
			$Date 		=$NewsRows['Date'];
			$NewsPic 	=$NewsRows['NewsPic'];
			//get IdCat
			ExcuteQuery('SELECT `IdCat` FROM `newscategoies` WHERE `IdNews`="'.$IdNews.'";');
			if ($TotalRecords>0){
				$IdCat = $Rows['IdCat'];
				//get CatName
				ExcuteQuery('SELECT `CatName` FROM `catlang` WHERE `IdCat`="'.$IdCat.'" and `IdLang`="'.$IdLang.'";');
				if ($TotalRecords>0){
					$CatName = $Rows['CatName'];
					ExcuteQuery('SELECT * FROM `newslang` WHERE `IdLang`="'.$IdLang.'" and `IdNews`="'.$IdNews.'";');
					if ($TotalRecords>0){
							
							$Tilte = $Rows['Tilte'];
							$SubTitle = $Rows['SubTitle'];
							$Breif = $Rows['Breif'];
					
							$Vars=array("Prog","ns","idnews","title");
							$Vals=array("news","details",$IdNews, str_replace(" ","_",subwords($Tilte,0,35)) );
							$LinkId = CreateLink("",$Vars,$Vals);
                                                        $NewsBlock = '<strong><a href="'.$LinkId.'" >'.$Tilte.'</a></strong><br/>'.$Breif;

						
					}// end if
				}
				else{
					echo "";
				}//end if
			}//end if
		
		
	}//end if	

	echo $NewsBlock;


?>



