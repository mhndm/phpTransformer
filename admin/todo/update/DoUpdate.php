<?php
/*

  Project: phpTransformer.com .
  File Location :  .
  File Name:  .
  Date Created: 00-00-2007.
  Last Modified: 00-00-2007.
  Descriptions: .
  Changes: .
  TODO:  .
     Author: Mohsen Mousawi mhndm@phptransformer.com .

 */
?>
<?php  if (!isset($IsAdmin)){header("location: ../");} ?>
<?php

global $Update,$UpdateServiceUrl,$Lang;

if(isset($_POST['Update'])) { //core
    $ObjectLicense = PostFilter($_POST['License']);
    $UpdateObject = TheCore ;
    $UpdateType = 'Update' ;
    $ObjectName = 'core';

}elseif(isset($_POST['UpdateProg'])) {//programs
    $ObjectName = PostFilter($_POST['ProgramName']);
    $ObjectLicense = PostFilter($_POST['ProgramLicense']);
    $UpdateObject = Progam ;
    $UpdateType = 'UpdateProg' ;


}elseif(isset($_POST['UpdateBlock'])) {//blocks
    $ObjectName = PostFilter($_POST['BlockName']);
    $ObjectLicense = PostFilter($_POST['BlockLicense']);
    $UpdateObject = Block ;
    $UpdateType = 'UpdateBlock' ;
}
elseif(isset($_POST['ThemeName'])) {//themes
    $ObjectName = PostFilter($_POST['ThemeName']);
    $ObjectLicense = PostFilter($_POST['ThemeLicense']);
    $UpdateObject = Theme ;
    $UpdateType = 'UpdateTheme' ;
}
else{
    $ObjectName = PostFilter($_POST['PluginName']);
    $ObjectLicense = PostFilter($_POST['PluginLicense']);
    $UpdateObject = Plugin ;
    $UpdateType = 'UpdatePlugin' ;
}


$Ref =$_SERVER['SERVER_NAME'];

$Update = '
<script language="javascript" type="text/javascript" src="admin/todo/update/ajax.js"></script>
<script language="javascript" type="text/javascript">
FirstStep("'.$ObjectName.'","'.$ThemeName.'","'.UpdateLinkBecauseNoLicense.'","'.Link.'","'.$ObjectLicense.'","'.$Ref.'","'.$Lang.'","'.autoBackupFolder.'","'.$UpdateType.'");
</script>
<span style="font-weight: bold;">'.Update. ' '.$UpdateObject.' '.$ObjectName.' ...</span><br/><br/>
    '.StepsForUpdate.' : <br/><br/>
<table border="0" cellpadding="2" cellspacing="2">
    <tr>
        <td id="1"><img style="width: 16px; height: 16px;"
                        alt="?"
                        src="admin/Themes/'.$ThemeName.'/images/dialog_question.png"></td>
        <td>'.ChekingIfTheUpdateServiceIsOnline.' </td>
    </tr>
    <tr>
        <td id="1a" colspan="2" rowspan="1"></td>
    </tr>
    <tr>
        <td id="2"><img style="width: 16px; height: 16px;"
                        alt="?"
                        src="admin/Themes/'.$ThemeName.'/images/dialog_question.png"></td>
        <td>'.GetTheXmlFile.'</td>
    </tr>
    <tr>
        <td id="2a" colspan="2" rowspan="1"></td>
    </tr>
    <tr>
        <td id="3"><img
                style="width: 16px; height: 16px;" alt="?"
                src="admin/Themes/'.$ThemeName.'/images/dialog_question.png"></td>
        <td>'.ChekIfItsCompleteFile.'</td>
    </tr>
    <tr>
        <td id="3a" colspan="2" rowspan="1"></td>
    </tr>
    <tr>
        <td id="4"><img style="width: 16px; height: 16px;"
                        alt="?"
                        src="admin/Themes/'.$ThemeName.'/images/dialog_question.png"></td>
        <td>'.ParseTheXmlStringToGetTheInfo.'</td>
    </tr>
    <tr>
        <td id="4a" colspan="2" rowspan="1"></td>
    </tr>
    <tr>
        <td id="5"><img style="width: 16px; height: 16px;"
                        alt="?"
                        src="admin/Themes/'.$ThemeName.'/images/dialog_question.png"></td>
        <td>'.ChekIfTheUpdateProcessIsAvailbleNow.'</td>
    </tr>
    <tr>
        <td id="5a" colspan="2" rowspan="1"></td>
    </tr>
    <tr>
        <td id="6"><img style="width: 16px; height: 16px;"
                        alt="?"
                        src="admin/Themes/'.$ThemeName.'/images/dialog_question.png"></td>
        <td>'.DownloadOrAutoUpdate.'</td>
    </tr>
    <tr>
        <td id="6a" colspan="2" rowspan="1"></td>
    </tr>
    <tr>
        <td id="7"><img style="width: 16px; height: 16px;"
                        alt="?"
                        src="admin/Themes/'.$ThemeName.'/images/dialog_question.png"></td>
        <td>'.DownloadTheFile.'</td>
    </tr>
    <tr>
        <td id="7a" colspan="2" rowspan="1">
            <div id="progress"
                 style="margin: 1px; background-color: rgb(0, 0, 153); width: 0%; height: 8px;"></div>
            <span id="percent"> </span> <span
                id="received"> </span>
        </td>
    </tr>
    <tr>
        <td id="8"><img style="width: 16px; height: 16px;"
                        alt="?"
                        src="admin/Themes/'.$ThemeName.'/images/dialog_question.png"></td>
        <td>'.ChekMd5File.'</td>
    </tr>
    <tr>
        <td id="8a" colspan="2" rowspan="1"></td>
    </tr>
    <tr>
        <td id="9"><img style="width: 16px; height: 16px;"
                        alt="?"
                        src="admin/Themes/'.$ThemeName.'/images/dialog_question.png"></td>
        <td>'.MakeBackup.'</td>
    </tr>
    <tr>
        <td id="9a" colspan="2" rowspan="1"></td>
    </tr>
    <tr>
        <td id="10"><img
                style="width: 16px; height: 16px;" alt="?"
                src="admin/Themes/'.$ThemeName.'/images/dialog_question.png"></td>
        <td>'.ExtractData.'</td>
    </tr>
    <tr>
        <td id="10a" colspan="2" rowspan="1"></td>
    </tr>
    <tr>
        <td id="11"><img
                style="width: 16px; height: 16px;" alt="?"
                src="admin/Themes/'.$ThemeName.'/images/dialog_question.png"></td>
        <td>'.CompleteSuccessUpdate.'</td>
    </tr>
    <tr>
        <td id="11a" colspan="2" rowspan="1"></td>
    </tr>
</tbody>
</table>
<br/><br/><br/>
<img style="width: 16px; height: 16px;" alt="?"
     src="admin/Themes/'.$ThemeName.'/images/dialog_question.png">
: '.WaitingProcess.', <img style="width: 16px; height: 16px;"
                        alt="-"
                        src="admin/Themes/'.$ThemeName.'/images/dialog_ok.png">:
'.CompleteProcess.', <img style="width: 16px; height: 16px;" alt="x"
               src="admin/Themes/'.$ThemeName.'/images/dialog_no.png">
'.ErrorHappen.'.<br>
<br><br/><br/>


';


?>
