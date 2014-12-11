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
$TitlePage .= ' .:. ' . (BannerAccount) ;
//ADS Transactions
echo '<strong>'. (CampainsTransaction).'</strong>';
echo '<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td><span style="color:#9CAFF3"><strong>'. (CampName).'</strong></span></td>
    <td><span style="color:#ffffff"><strong>'. (CompStart).'</strong></span></td>
    <td><span style="color:#9CAFF3"><strong>'. (CompEnd).'</strong></span></td>
    <td><span style="color:#ffffff"><strong>'. (CurrentCharge).'</strong></span></td>
  </tr>';

$TotalBanCost = 0;
$cquery ="SELECT `IdComp`, `CampName`,`CompStart`, `CompEnd` FROM `campaign` WHERE `idBanClnt` = '$UserId' ;";

	$cRecordset = mysqli_query($conn,$cquery) ;	
	$cTotalRecords = mysqli_num_rows($cRecordset);
	if ($cTotalRecords>0){
		while($cRows = mysqli_fetch_assoc($cRecordset)){
		$Cost = CurrentCharge($cRows["IdComp"]);
		 echo '  <tr>
		    <td><span style="color:#9CAFF3">'.$cRows["CampName"].'</span></td>
		    <td><span style="color:#ffffff">'.$cRows["CompStart"].'</span></td>
		    <td><span style="color:#9CAFF3">'.$cRows["CompEnd"].'</span></td>
		    <td><span style="color:#ffffff">'.$Cost.'</span></td>
			</tr>';	
		$TotalBanCost += $Cost;
		}//end while
	}//end if

echo '</table><br/>';
echo  (TotalBanCost) . $TotalBanCost ."$ <br/> <br/>";

//payment transactions
echo '<strong>'. (PaymentsTransaction).'</strong>';
echo '<br/><table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td><span style="color:#9CAFF3"><strong>'. (Date).'</strong></span></td>
    <td><span style="color:#ffffff"><strong>'. (Debit).'</strong></span></td>
    <td><span style="color:#9CAFF3"><strong>'. (Credit).'</strong></span></td>
    <td><span style="color:#ffffff"><strong>'. (ValueDate).'</strong></span></td>
    <td><span style="color:#9CAFF3"><strong>'. (Desc).'</strong></span></td>
  </tr>';
$Debit = 0;
$Credit = 0;
$cquery ="SELECT `Debit`,`Credit`,`Date`,`ValueDate`,`Desc` FROM `bancltrans` WHERE `idBanClnt`='$UserId';";

	$cRecordset = mysqli_query($conn,$cquery) ;	
	$cTotalRecords = mysqli_num_rows($cRecordset);
	if ($cTotalRecords>0){
		while($cRows = mysqli_fetch_assoc($cRecordset)){
		echo '  <tr>
		    <td><span style="color:#9CAFF3">'.$cRows["Date"].'</span></td>
		    <td><span style="color:#ffffff">'.$cRows["Debit"].'</span></td>
		    <td><span style="color:#9CAFF3">'.$cRows["Credit"].'</span></td>
		    <td><span style="color:#ffffff">'.$cRows["ValueDate"].'</span></td>
		    <td><span style="color:#9CAFF3">'.$cRows["Desc"].'</span></td>
		  </tr>';
		// if($cRows["ValueDate"] >= date('Y-m-d H:i:s')){
			$Debit  +=$cRows["Debit"];
			$Credit +=$cRows["Credit"];
		// }//end if
		}//end while
	}//end if

echo '</table><br/><strong>';
echo  (ResumeAccountTransaction). "<br/>";
echo  (Debit) . " " . ($Debit + $TotalBanCost) . "$ &nbsp;&nbsp;&nbsp; ";
echo  (Credit) . " " . $Credit . "$ &nbsp;&nbsp;&nbsp; ";
//balance
$Balance = $Credit - ($Debit + $TotalBanCost)  ;
echo  (Balance). ': ' .$Balance .' $ </strong>';

?>