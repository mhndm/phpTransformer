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
global $Update,$ThemeName ;

$Update .= StepsForUpdate.'<br/><br/>';
$CompleteSuccessUpdate = '<a href="'.AdminCreateLink('', array('todo'), array('Update')).'" title="'.CompleteSuccessUpdate.'">'.CompleteSuccessUpdate.'</a>';
$Update .='<div id="1" ><span id="1a"> <img style="width: 16px; height: 16px;" alt="?" src="admin/Themes/'.$ThemeName.'/images/dialog_question.png"></span> '.GetUpInfoFromServer.'</div>
            <div id="2" ><span id="2a" > <img style="width: 16px; height: 16px;" alt="?" src="admin/Themes/'.$ThemeName.'/images/dialog_question.png"></span> '.DistributeUpdateInfo.'</div>
            <div id="3" ><span id="3a" > <img style="width: 16px; height: 16px;" alt="?" src="admin/Themes/'.$ThemeName.'/images/dialog_question.png"></span> '.$CompleteSuccessUpdate.'</div>
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

