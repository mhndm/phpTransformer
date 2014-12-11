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
global $ThemeName, $TheNavBar,$SqlType,$TitlePage,$CustomHead,$TotalRecords,$Recordset,$Rows,$conn;
$CustomHead.='<script src="Programs/pool/SpryCollapsiblePanel.js" type="text/javascript"></script>';

if(is_file("Programs/pool/Themes/'.$ThemeName.'/SpryCollapsiblePanel.css")){
   $CustomHead.= ' <link href="Programs/pool/Themes/'.$ThemeName.'/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />';
    
}else{
   $CustomHead.= ' <link href="Programs/pool/Themes/Default/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />';

}


$TitlePage .= ' .:. ' .  (pool). ' .:. ' .  (OldPools);
$TheNavBar[] = array( (pool),CreateLink("",array("Prog"),array("pool")));

$Poolquery = "SELECT `Idpt` FROM `pooltitle` where `Deleted` <>'1';";
$PoolRecordset = mysqli_query($conn,$Poolquery) ;// ;	
$PoolTotalRecords = mysqli_num_rows($PoolRecordset);
	if ($PoolTotalRecords>0){
	echo '<strong>'. (OldPools).'</strong>' ;
	$PoolRows = mysqli_fetch_assoc($PoolRecordset);
		for($i=0;$i<$PoolTotalRecords;$i++){
			$Idpt = $PoolRows['Idpt'];
			//echo ' Idpt '.$Idpt;
			$x = PoolsResults($Idpt);
			$PoolArray[] = '<div id="CollapsiblePanel'. ($i + 1) .'" class="CollapsiblePanel'. ($i + 1) .'">
			  <div class="CollapsiblePanelTab" tabindex="0">'.$x[0].'</div>
			  <div class="CollapsiblePanelContent">'.$x[1].'</div>
			</div>';
			$PoolRows = mysqli_fetch_assoc($PoolRecordset);
		}//end for
                $PoolArrayTab = Pagination($PoolArray,10,10);
                /*
		echo '<br/>'.CreateNaviPage($PoolArray,$MaxResultPerPage=1,$ShowNaviBar=1);
		echo '<br/>'.CreateNaviPage($PoolArray,$MaxResultPerPage=1,$ShowNaviBar=0);
                 * */
                 
	}
	else{
            $PoolArray =array();
            $PoolArrayTab = Pagination($PoolArray,0,0);
		//echo '';
	}//end if
	
 
echo $PoolArrayTab[0];
echo $PoolArrayTab[1];

if(isset($_GET['page'])){
    $pageNbr = InputFilter($_GET['page']);
}
else{
     $pageNbr =1;
}
echo '<script type="text/javascript">';

for($j=($pageNbr-1)*10;$j<$i;$j++){

	echo 'var CollapsiblePanel'. ($j + 1) .' = new Spry.Widget.CollapsiblePanel("CollapsiblePanel'. ($j + 1) .'", {contentIsOpen:false});';

}//end for

echo '</script>';

function PoolsResults($Idpt){
global $TotalRecords,$Rows, $Recordset,$conn,$Lang ;
	$PoolCode = "";
        $Title = '';
	ExcuteQuery('SELECT `IdLang` FROM `languages` WHERE `LangName` ="'.$Lang.'";');
	if ($TotalRecords>0){
		$IdLang= $Rows['IdLang'];
		
	}//end if

	ExcuteQuery('SELECT `Title` FROM `poollangtitles` WHERE
	`IdLang` ="'.$IdLang.'" and `Idpt`="'.$Idpt .'"');
	if ($TotalRecords>0){
		$Title = $Rows['Title'];
	}//end if
	ExcuteQuery('SELECT * FROM `poolusers` WHERE `Idpt` = "'.$Idpt.'"');
	$SumOfAll =  $TotalRecords;
	
	ExcuteQuery('SELECT `idpc` FROM `poolchoices` WHERE `idpt`="'.$Idpt.'";');
	if ($TotalRecords>0){
		for ($i=0;$i<$TotalRecords;$i++){
			$idpc = $Rows['idpc'];
			// get the sum of itch option

			$ChoiseQuery = 'SELECT `Choise` FROM `poollangchoices` WHERE `IdLang` ="'.$IdLang.'" and `idpc` ="'.$idpc .'" and `idpt`="'.$Idpt.'"';
			$ChoiseRecordset = mysqli_query($conn,$ChoiseQuery) ;// ;	
			$ChoiseTotalRecords = mysqli_num_rows($ChoiseRecordset);
			$ChoiseRows = mysqli_fetch_assoc($ChoiseRecordset);
			if ($ChoiseTotalRecords>0){
				$Choise = $ChoiseRows['Choise'];
				$PoolCode .= $Choise."&nbsp;";
			}//end if

			$idpcquery = 'SELECT COUNT(*) as Ttl  FROM `poolusers` WHERE `Idpt` ="'.$Idpt .'" AND `idpc` ="'.$idpc.'";';
				$idpcRecordset = mysqli_query($conn,$idpcquery);//  ;	
				$idpcTotalRecords = mysqli_num_rows($idpcRecordset);
				$idpcRows = mysqli_fetch_assoc($idpcRecordset);
				$Ttl=$idpcRows['Ttl'] ;
				if($SumOfAll!=0){
					$PoolCode .= round($Ttl/$SumOfAll*100,1) . "%" . "<br />";
					$PoolCode .= '<img src="Programs/pool/images/poll.jpg" alt=" " width="' . round($Ttl/$SumOfAll*100,1)  . '%" height="9" /><br /><br />';

				}
				else{
					$PoolCode .= "0%" . "<br />";
					$PoolCode .= '<img src="Programs/pool/images/poll.jpg" alt=" " width="0%" height="9" /><br /><br />';
				}

		$Rows = mysqli_fetch_assoc($Recordset);
		}
		$PoolCode .=  (SumOfVoices). " : ". $SumOfAll;
	}// End if
	return array($Title,$PoolCode);
}//end function

?>