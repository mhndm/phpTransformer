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
<?php  if (!isset($IsAdmin)){header("location: ../");} ?>
<?php
global $dbBaseName,$conn;

if(isset($_POST['Optimize'])){
	$result = mysqli_query($conn,"SHOW TABLE STATUS");
	while($row = mysqli_fetch_array($result)){
		$Name = $row['Name'];
		$OPT = mysqli_query($conn,"OPTIMIZE TABLE ".$Name );
	}//END WHILE
}//end if

$optimize='<form name="StatusForm" action="" method="POST">
			<table width="100%" border="0" cellspacing="1" cellpadding="1">
			  <tr>
			    <td align="center"><strong>'. (TableName).'</strong></td>
			    <td align="center"><strong>'. (LastTimeUpdate).'</strong></td>
			    <td align="center"><strong>'. (NumberOfRecords).'</strong></td>
			    <td align="center"><strong>'. (FreeSpace).'</strong></td>
			    <td ><strong>'. (TableSize).'</strong></td>
			  </tr>';

$result = mysqli_query($conn,"SHOW TABLE STATUS");
while($row = mysqli_fetch_array($result)) {
	$Name			 = $row['Name'];
	$Data_free		 = $row['Data_free'];
	$Avg_row_length  = $row['Avg_row_length'];
	$Rows 			 = $row['Rows'];
	$Update_time 	 = $row['Update_time'] ;
	$optimize .= '<tr  onmouseover="this.style.background=\'url(admin/Themes/Default/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'" >
				    <td dir="ltr">'.$Name.'</td>
				    <td align="center" >'.$Update_time.'</td>
				    <td align="center" >'.$Rows.'</td>
				    <td align="center" >'.$Data_free.'</td>
				    <td>'.$Avg_row_length.' '.  (Byte).'</td>
				</tr>';
}//END WHILE

$optimize .='</table>
			<br/>
				<div align="center">
				  <input class="submit" name="Optimize" type="submit" value="'. (OptimizeNow).'">
				</div>
			<br/>
			</form>';
?>