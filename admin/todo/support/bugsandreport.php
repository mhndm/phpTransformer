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
<?php  if (!isset($IsAdmin)) {
    header("location: ../");
} ?>
<?php
global $TotalRecords,$Rows,$Recordset,$WebSiteFullName,$WebsiteUrl;

$bugsandreport = '';

if(isset($_POST['sendreport'])) {
    //generate pdf file
    if(!is_dir('admin/todo/support/pdf')) {
        mkdir('admin/todo/support/pdf'); //create directory
    }
    //get error info
    $dbErrLog = new db();
    $query = "SELECT * FROM `errlog` ORDER BY `IdErr` DESC; ";
    $ErrLog = $dbErrLog ->get_results($query);

    if ($ErrLog) {
        $PDFreport = '<table width="3264" border="1" cellspacing="1" cellpadding="0">
                                              <tr>
                                                <td align="center" width="150"><strong>#</strong></td>
                                                <td align="center" width="200" ><strong>'. ErrNumber.'</strong></td>
                                                <td align="center" width="1200"><strong>'. ErrMessage.'</strong></td>
                                                <td align="center" width="1200"><strong>'. FileName.'</strong></td>
                                                <td align="center" width="200"><strong>'. LineNumber.'</strong></td>
                                                <td align="center" width="270" ><strong>'. Date.'</strong></td>
                                            </tr>';
        foreach($ErrLog as $log) {
            $IdErr	= $log->IdErr;
            $errno	= $log->errno;
            $errmsg 	= $log->errmsg;
            $filename   = $log->filename;
            $linenum 	= $log->linenum;
            $DateErr 	= $log->DateErr;
            $PDFreport .='<tr>
                                                <td align="center" width="150" >'.$IdErr.'</td>
                                                <td align="center" width="200" >'.$errno.'</td>
                                                <td align="left" dir="ltr" width="1200" >'.$errmsg.'</td>
                                                <td align="left" dir="ltr" width="1200" >'.$filename.'</td>
                                                <td align="center" width="200" >'.$linenum.'</td>
                                                <td align="center" width="270" >'.$DateErr.'</td>
                                         </tr>';
        }//end for
        $PDFreport .= '</table>';
    }
    else {
        $PDFreport =  YouAreLukyNoErrFound;
    }


    // create new PDF document
    error_reporting(0);
    if(function_exists('set_time_limit')) {
        @set_time_limit(0);
    }
    ini_alter("memory_limit", "16M");
    //ob_end_clean();
    ob_implicit_flush(TRUE);
    ignore_user_abort(1);
    clearstatcache();
    error_reporting(6135);

    require_once('includes/tcpdf/tcpdf.php');
    $pdf = new TCPDF('L', 'mm', 'A4',TRUE,"UTF-8",true);
    //$pdf = new TCPDF('L', 'mm', 'A4', "UTF-8");
    // set document information
    $pdf->SetCreator('phpTransformer.com');
    $pdf->SetAuthor("phpTransformer PDF Generator");
    $pdf->SetTitle('Error Report');
    $pdf->SetSubject('Error Report Log');
    $pdf->SetKeywords("phpTransformer, PDF, Generator");
    // set default header data
    $pdf->SetHeaderData('pdf_logo.gif', PDF_HEADER_LOGO_WIDTH, $WebSiteFullName, $WebsiteUrl);
    // set header and footer fonts
    $pdf->setHeaderFont(Array('almohanad', '', 12));
    $pdf->setFooterFont(Array('almohanad', '', PDF_FONT_SIZE_DATA));
    //set margins
    $pdf->SetMargins(5, 20, 5);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

    //$pdf->SetFooterMargin(0);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    $lg = Array();
    $lg['a_meta_charset'] = "UTF-8";
    $lg['a_meta_dir'] = DirHtml;
    $lg['a_meta_language'] = MiniLang;
    $lg['w_page'] = "page";
    $pdf->setLanguageArray($lg);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    if(strtolower(DirHtml)=='rtl') {
        $pdf->setRTL(true);
    }
    $pdf->SetFont("almohanad", "",12);
    $pdf->WriteHTML($PDFreport, true, 0, true, 0);
    $pdfFileName = "admin/todo/support/pdf/report-".md5(date('y-m-d-s')).".pdf";
    $pdf->Output($pdfFileName, "F"); // Save PDF to a local file

    $pdfFileLink = $WebsiteUrl.'/'.$pdfFileName;

    //send it as link by mail
    require("includes/phpmailer/class.phpmailer.php");
    $mail = new PHPMailer();
    global $SmtpHost,$SMTPusername,$SMTPpassword,$SmtpPort;
    global $AdminMail,$WebSiteName;
    $mail->Host = $SmtpHost;
    $mail->Port     = $SmtpPort;
    //$mail->IsSMTP();
    $mail->IsHTML(true);
    $mail->From     = $AdminMail;
    $mail->FromName = $WebSiteName;
    $mail->AddAddress('support@phptransformer.com', 'phpTransformerSupport');
    $mail->Subject = 'Error Report in Site '.$WebSiteName;
    $mail->Body    = 'Please corect problems in our Site : '.$_SERVER['SERVER_ADDR'].'<br/>'.$pdfFileLink;
    $mail->Send();

    $bugsandreport .=  AMessageHasBeenSentToDevelopper."<br/>";

}

if(isset($_POST['clearlog'])) {
    $bugsandreport .=   WeCleareAllErrLogs."<br/>";
    $result = mysqli_query($conn,"truncate table `errlog`;");
}//end if


ExcuteQuery("SELECT * FROM `errlog` ORDER BY `IdErr` DESC;");
if ($TotalRecords>0) {
    $bugsandreport .= '<table width="100%" border="0" cellspacing="1" cellpadding="0">
				  <tr>
				    <td align="center"><strong>#</strong></td>
				    <td align="center"><strong>'. ErrNumber.'</strong></td>
				    <td align="center"><strong>'. ErrMessage.'</strong></td>
				    <td align="center"><strong>'. FileName.'</strong></td>
				    <td align="center"><strong>'. LineNumber.'</strong></td>
				    <td align="center"><strong>'. Date.'</strong></td>
				</tr>';
    for($i=0;$i<$TotalRecords;$i++) {
        $IdErr		= $Rows['IdErr'];
        $errno		= $Rows['errno'];
        $errmsg 	= $Rows['errmsg'];
        $filename       = $Rows['filename'];
        $linenum 	= $Rows['linenum'];
        $DateErr 	= $Rows['DateErr'];
        $ArrayData[]='<tr onmouseover="this.style.background=\'url(admin/Themes/Default/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">
						<td align="center" >'.$IdErr.'</td>
						<td align="center"  >'.$errno.'</td>
						<td align="left" dir="ltr" >'.$errmsg.'</td>
						<td align="left" dir="ltr">'.$filename.'</td>
						<td align="center" >'.$linenum.'</td>
						<td align="center" width="100">'.$DateErr.'</td>
					</tr>';
        $Rows = mysqli_fetch_assoc($Recordset);
    }//end for

    $bugsandreportTab = Pagination($ArrayData,50,10);
    $bugsandreport .= $bugsandreportTab[0].'</table>';
    $bugsandreport .= $bugsandreportTab[1];
    $bugsandreport .= '<form name="formlOG" method="post" action="">
					<input class="submit" type="submit" onclick="return acceptSend();"name="sendreport" id="sendreport" value="'. (sendReport).'">
					<input class="submit" type="submit" onclick="return acceptDel();" name="clearlog" id="clearlog" value="'. (clearLog).'">
                                            <a target="_blank" href="http://sourceforge.net/tracker/?func=add&group_id=285188&atid=1208823"
                                            title="'.WriteBugReportAtSourceForgeProjectPage.'">
                                            '.WriteBugReportAtSourceForgeProjectPage.'</a>
				 </form>';

    $bugsandreport .= '<script language="javascript" type="text/javascript">
					function acceptDel(){
						return confirm("'. DouWanttoDeleteAllErrLogs.'");
					}
					function acceptSend(){
						return confirm("'. DoUWantToSendErrReport.'");
					}
					</script>';
}
else {
    $bugsandreport .=  YouAreLukyNoErrFound. '<br/><a target="_blank" href="http://sourceforge.net/tracker/?func=add&group_id=285188&atid=1208823"
                                            title="'.WriteBugReportAtSourceForgeProjectPage.'">
                                            '.WriteBugReportAtSourceForgeProjectPage.'</a><br/>';
}//end if




?>