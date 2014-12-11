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

$FootTheme	= get_include_contents("admin/Themes/$ThemeName/FootContainer.php");
$FootTheme	= VarTheme("{ThemeName}",$ThemeName,$FootTheme);
$FootTheme	= VarTheme("{SpecialText}", SpecialText .' '.$Version['core'],$FootTheme);
$FootTheme	= VarTheme("{AllRightReserved}", (AllRightReserved),$FootTheme);
$FootTheme	= VarTheme("{DevelopedAndDesignedby}", (DevelopedAndDesignedby),$FootTheme);

//License info
$LicenseKey = LicenseInfo($License);
//var_dump($LicenseKey);
if($LicenseKey==''){
    $LisenceInformation = '<input type="hidden" value="'.$License.'" id="core" name="core"><span id="msgcore" name="msgcore"></span>
                    <a target="_blank" href="http://phptransformer.com/release/Prog-getlicense_Lang-'.$Lang.'_nl-1.pt">
                    <img border="0" src="admin/Themes/'.$ThemeName.'/images/dialog_infos.png" width="16" height="16" 
                        title="'.Support_info.'"  alt="'.Support_info.'" /></a> '
                    .'<span style="font-size: x-small;" >'.NoLicenseKeyFound."</span>";
	$ScriptJS = '';
}
else{
        if($LicenseKey["RegSource"] == 'OPN'){
            // 24/24
            $RegSource = TwentyFourHours;
        }
        else{
            $RegSource = OnSchedualTime;
        }
        if($LicenseKey["RegPakage"]=='ADV'){
            $RegPakage = FullSupportedCoreAndObjects;
        }
        else{
            $RegPakage = OnlyCoreSupported;
        }
        if($LicenseKey["RegEndDate"] == 'LIFETIME'){
            $RegEndDate = LifeTime;
        }else{
            $RegEndDate = substr($LicenseKey["RegEndDate"],0,10);
        }
        //$CoreName = $LicenseKey["ObjectName"];
        $CoreName = 'core';
        $LicenseKeyInfo = $RegPakage .' '.$RegSource.' ' .ContarctBegin .' '. substr($LicenseKey["RegStartDate"],0,10).' '.ContarctEnd.' ' .$RegEndDate .' '.JuresalemTimeZone;
        $LisenceInformation = '<br/><input type="hidden" value="'.$CoreName.'||'.$License.'" id="'.$CoreName.'" name="'.$CoreName.'">
                        <span id="msg'.$CoreName.'" name="msg'.$CoreName.'">
                        <a target="_blank" href="http://phptransformer.com/release/Prog-getlicense_Lang-' . $Lang . '_nl-1.pt">
                        <img border="0" src="admin/Themes/'.$ThemeName.'/images/dialog_infos.png" width="16" height="16" title="'.Support_info.'"  alt="'.Support_info.'" />
                            </a> '
                        .'<span style="font-size: x-small;" >'.$LicenseKeyInfo."</span> </span>";
        $ScriptJS = "\n".' setTimeout(\'key_From_messagecenter("'.$CoreName.'",theme,"'.$LicenseKeyInfo.'",nsup,lng)\',1333);'."\n";

}
if(isset($_SESSION['Login'.$WebsiteUrl])){
    if($_SESSION['Login'.$WebsiteUrl] ==true){
        $FootCont = $LisenceInformation .
                        '<script language="javascript" type="text/javascript" src="admin/ajax.js"></script>
                         <script language="javascript" type="text/javascript">
                            var theme= "'.$ThemeName.'";
                            var sup = "'.KeySupported.'";
                            var nsup = "'.KeyNotSupported.'";
                            var lng = "'.$Lang.'";'
                        .$ScriptJS
                        .'</script>'
                        . $FootTheme;

    }
    else{
        $FootCont = $FootTheme;
    }
}
else{
     $FootCont = $FootTheme;
}
?>