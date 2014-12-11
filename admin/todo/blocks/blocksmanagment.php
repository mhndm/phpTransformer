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

global $TotalRecords, $Rows, $Recordset, $xmlstr;
$ScriptJS = '';
$blocksmanagment = '<strong>' . (PleaseChoiceBlockToManage) . ' : </strong><BR/>
                    <table style="width:100%;" cellpadding="4px" cellspacing="4px">';

ExcuteQuery("SELECT * FROM `blocks` where `Deleted`<>'1';");
if ($TotalRecords > 0) {
    $jquery_js = '';
    for ($i = 0; $i < $TotalRecords; $i++) {
        $BlockName = $Rows['BlockName'];
        //include lang file
        $LangFile = 'Blocks/' . $BlockName . '/admin/Languages/lang-' . $Lang . '.php';
        if (is_file($LangFile)) {
            include_once($LangFile);
        }
        $License = $Rows['License'];

        if (is_file('Blocks/' . $BlockName . '/admin/desc.php')) {
            include'Blocks/' . $BlockName . '/admin/desc.php';
            $xml = new SimpleXMLElement($xmlstr);
            $BlockDesc = $xml->$Lang;
            $BlockVersion = $xml->Version;
        } else {
            $BlockDesc = " ";
        }//end if
        if ($i % 4 == 0) {
            $blocksmanagment .= "<tr>";
        }
        if (is_file('Blocks/' . $BlockName . '/thumb.png')) {
            $Blockthumb = '<img border="0" src="Blocks/' . $BlockName . '/thumb.png" width="64" height="64" alt="' . $BlockName . '" />';
        } else {
            $Blockthumb = '<img border="0" src="images/block.png" width="64" height="64" alt="Thumb" />';
        }
        if ($License == '') {
            $LicenseImg = '<input type="hidden" value="' . $License . '" id="' . $BlockName . '" name="' . $BlockName . '">
                           <img  id="img' . $BlockName . '" border="0" src="admin/Themes/' . $ThemeName . '/images/dialog_infos.png" 
                                    width="16" height="16" title="' . Support_info . '"  
                                    alt="' . Support_info . '" /> 
                    <div class="hidden_div" id="msg' . $BlockName . '" name="msg' . $BlockName . '">
                        <span style="font-size: x-small;" >' . NoLicenseKeyFound . '</span>
                      <a target="_blank" href="http://phptransformer.com/release/Prog-getlicense_Lang-' . $Lang . '_nl-1.pt">
                    <br/>'.YouCanGetPaidSupport.'</a></div>';
            
             $jquery_js .= '$("#img' . $BlockName . '").click(function(){ 
                                $("#msg' . $BlockName . '").toggle();
                             });';
             
        } else {
            $LicenseKey = LicenseInfo($License);
            if ($LicenseKey["RegSource"] == 'OPN') {
                // 24/24
                $RegSource = TwentyFourHours;
            } else {
                $RegSource = OnSchedualTime;
            }
            if ($LicenseKey["RegPakage"] == 'ADV') {
                $RegPakage = SupportedBySystem;
            } else {
                $RegPakage = SupportedByObject;
            }
            if ($LicenseKey["RegEndDate"] == 'LIFETIME') {
                $RegEndDate = LifeTime;
            } else {
                $RegEndDate = $LicenseKey["RegEndDate"];
                $RegEndDate = substr($RegEndDate, 0, 10);
            }
            //$LicenseKey["ObjectName"]
            //$LicenseKeyInfo = $RegPakage .' '.$RegSource.'<br/>' .ContarctBegin .' '. substr($LicenseKey["RegStartDate"],0,10).' '.ContarctEnd.' ' .$RegEndDate .'<br/> '.JuresalemTimeZone;
            $LicenseKeyInfo = $RegPakage . ' ' . $RegSource . '<br/>' . ContarctBegin . ' ' . substr($LicenseKey["RegStartDate"], 0, 10) . ' ' . ContarctEnd . ' ' . $RegEndDate . '<br/> ';
            $LicenseImg = '<input type="hidden" value="' . $BlockName . '||' . $License . '" id="' . $BlockName . '" name="' . $BlockName . '">
                           <img id="img' . $BlockName . '" border="0" src="admin/Themes/' . $ThemeName . '/images/dialog_infos.png" width="16" height="16"
                               title="' . Support_info . '"  alt="' . Support_info . '" /> 
                            <div  class="hidden_div"  id="msg' . $BlockName . '" name="msg' . $BlockName . '">
                            <span style="font-size: x-small;" >
                            '. $LicenseKeyInfo . '</span></div>';
            $ScriptJS .= ' setTimeout(\'stat_From_messagecenter("' . $BlockName . '",theme,"'.$LicenseKeyInfo.'",nsup,lng)\',1033);' . "\n";
            
             $jquery_js .= '$("#img' . $BlockName . '").click(function(){ 
                                $("#msg' . $BlockName . '").toggle();
                                    });';
            
        }
        if (!constantDefined($BlockName)) {
            $NewBlockName = $BlockName;
        } else {
            $NewBlockName = constant($BlockName);
        }
        $Vars = array("block");
        $Vals = array($BlockName);
        $blocksmanagment .= '<td  valign="top"  width="242"><strong><a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">'
                . $Blockthumb . ' <br/>' . manage . ' ' . Block . ' : ' . $NewBlockName . ' ' . $BlockVersion . '</a> </strong> <br/> ' . $LicenseImg . '<strong>' . $BlockDesc . '</strong> <br/>&nbsp;</td>';
        if ($i + 1 % 4 == 0) {
            $blocksmanagment .= "</tr> \n";
        }
        $Rows = mysqli_fetch_assoc($Recordset);
    }//end for
    $blocksmanagment .='</table>
                                    <script language="javascript" type="text/javascript" src="admin/todo/blocks/ajax.js"></script>
                                    <script language="javascript" type="text/javascript">
                                    $(document).ready( function(){	
                                   ' . $jquery_js . '
                                    });
                                    
                                    var theme= "' . $ThemeName . '";
                                    var sup = "' . KeySupported . '";
                                    var nsup = "' . KeyNotSupported . '";
                                    var lng = "' . $Lang . '";
                                    ' . $ScriptJS . '
                                    </script>';
}//end if
?>