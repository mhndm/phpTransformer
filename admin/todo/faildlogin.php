<?php

/* * *********************************************
 *
 * 	Project: phpTransformer.com .
 * 	File Location :  .
 * 	File Name:  .
 * 	Date Created: 00-00-2007.
 * 	Last Modified: 00-00-2007.
 * 	Descriptions:	.
 * 	Changes:	.
 * 	TODO:	 .
 * ***	Author: Mohsen Mousawi mhndm@phptransformer.com .
 *
 * ********************************************* */
?>
<?php if (!isset($IsAdmin)) {
    header("location: ../");
} ?>
<?php

global $conn,$TotalRecords, $Rows, $Recordset;
$theList = SubIconLink("blocking", "banip") . "<br/>"
        . SubIconLink("blocking", "bannedip") . "<br/>"
        . SubIconLink("blocking", "blockemail") . "<br/>"
        . SubIconLink("blocking", "blockedmails") . "<br/>"
        . SubIconLink("blocking", "blackedwords") . "<br/>"
        . SubIconLink("blocking", "addword") . "<br/>"
        . SubIconLink("faildlogin", "FaildLogin") . "<br/>"
        . SubIconLink("antiflood", "AntiFlood") . "<br/>"
;
$faildlogin = '';

if (isset($_POST['ClearFaildLog'])) {
    mysqli_query($conn,"delete from `adminlog`;");
    $faildlogin = (SuccessDeleteAllFailedLoginLogs) . "<br/>";
}//end if

mysqli_query($conn,"SET @@session.time_zone = '+00:00';");
ExcuteQuery("select * from `adminlog` order by `TryDate` desc ;");
if ($TotalRecords > 0) {
    for ($i = 0; $i < $TotalRecords; $i++) {
        $TryName = $Rows['TryName'];
        $TryPassword = $Rows['TryPassword'];
        $TryDate = $Rows['TryDate'];
        $tryIp = $Rows['tryIp'];
        $Logins[] = '<tr onmouseover="this.style.background=\'url(admin/Themes/Default/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'" >
						<td style="border-bottom:dotted; border-bottom-width:thin">
						' . $TryName . '</td>
						<td style="border-bottom:dotted; border-bottom-width:thin">
						<strong> | </strong>' . $TryPassword . '</td>
						<td style="border-bottom:dotted; border-bottom-width:thin">
						<strong> | </strong>' . $TryDate . '</td>
						<td style="border-bottom:dotted; border-bottom-width:thin">
						<strong> | </strong>' . $tryIp . '</td>
					</tr>';
        $Rows = mysqli_fetch_assoc($Recordset);
    }//end for
    //$faildlogin.='</table>';
//$faildlogin .=CreateNaviPage($Logins,10,1);

    $faildlogin .= '<form name="formClearFaildLog" method="post" action="">
		<input class="submit" name="ClearFaildLog" onclick="return acceptDelFailed();" type="submit" value="' . (clearLog) . '">
		<table border="0" cellspacing="2" cellpadding="2">
				  <tr>
				    <td><strong>' . (TryUserName) . '</strong></td>
				    <td><strong>' . (TryPassword) . '</strong></td>
				    <td><strong>' . (DateanTimeTry) . '</strong></td>
				    <td><strong>' . (FromIpTry) . '</strong></td>
				  </tr>';
//$faildlogin.=CreateNaviPage($Logins,10,0);
    $faildloginTab = Pagination($Logins, 10, 10);
    $faildlogin.=$faildloginTab[0];
    $faildlogin.='<tr><td>' . $faildloginTab[1] . '</td></tr>';
    $faildlogin .='</table></form>';
} else {
    $faildlogin .= (NocurrentFaildLog);
}//end if
$faildlogin .= '<script language="javascript" type="text/javascript">
					function acceptDelFailed(){
						return confirm("' . (DouWanttoDeleteAllFailedLoginLogs) . '");
					}
				</script>';
$theContent = $faildlogin;
$faildlogin = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$faildlogin = VarTheme("{todoImg}", "firewall.jpg", $faildlogin);
$faildlogin = VarTheme("{ThemeName}", $ThemeName, $faildlogin);
$faildlogin = VarTheme("{List}", $theList, $faildlogin);
$faildlogin = VarTheme("{Content}", $theContent, $faildlogin);
?>