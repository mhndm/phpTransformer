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
<?php

if (!isset($IsAdmin)) {
    header("location: ../");
}
?>
<?php

if (isset($_GET['todo'])) {
    if ($_GET['todo'] == 'programs') {
        $programs = ShowProgsList();
    }//end if
}//end if

function ShowProgsList() {

    global $ThemeName, $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang, $xmlstr;

    $programmanagment = '<strong>' . PleaseSelectProgToManage . ' : </strong><br/>
                                <table style="width:100%;" cellpadding="4px" cellspacing="4px">';
    //$Options="";

    ExcuteQuery("SELECT * FROM `programs` WHERE `Deleted`<>'1' ;");
    if ($TotalRecords > 0) {
        $ScriptJS = '';
        $jquery_js = '';
        for ($i = 0; $i < $TotalRecords; $i++) {
            $ProgramName = $Rows['ProgramName'];
            //include lang file
            $LangFile = 'Programs/' . $ProgramName . '/admin/Languages/lang-' . $Lang . '.php';
            if (is_file($LangFile)) {
                include_once($LangFile);
            }
            $License = $Rows['License'];

            $Vars = array("prog");
            $Vals = array($ProgramName);

            if (is_file('Programs/' . $ProgramName . '/admin/desc.php')) {
                //echo 'Programs/'.$ProgramName.'/admin/desc.php <br/>';
                require ('Programs/' . $ProgramName . '/admin/desc.php');
                $Pxml = new SimpleXMLElement($xmlstr);
                $ProgDesc = (string) $Pxml->$Lang;
                $ProgVersion = $Pxml->Version;
            } else {
                $ProgDesc = " ";
            }//end if

            if ($i % 4 == 0) {
                $programmanagment .= "<tr>";
            }
            if (is_file('Programs/' . $ProgramName . '/thumb.png')) {
                $Progthumb = '<img border="0" src="Programs/' . $ProgramName . '/thumb.png" width="64" height="64" alt="' . $ProgramName . '" />';
            } else {
                $Progthumb = '<img border="0" src="images/program.png" width="64" height="64" alt="Thumb" />';
            }

            if ($License == '') {
                $LicenseImg = '<input type="hidden" value="' . $License . '" id="' . $ProgramName . '" name="' . $ProgramName . '">
                               <img id="img' . $ProgramName . '" border="0" src="admin/Themes/' . $ThemeName . '/images/dialog_infos.png" 
                                   width="16" height="16" title="' . Support_info . '"  alt="' . Support_info . '" />

                                <div class="hidden_div" id="msg' . $ProgramName . '" name="msg' . $ProgramName . '">
                                    <span style="font-size: x-small;" >' . NoLicenseKeyFound . '</span> <br/>
                                 <a target="_blank" href="http://phptransformer.com/release/Prog-getlicense_Lang-' . $Lang . '_nl-1.pt">
                                        ' . YouCanGetPaidSupport . '
                                <br/></a> 
                            </div>';

                $jquery_js .= '$("#img' . $ProgramName . '").click(function(){ 
                                $("#msg' . $ProgramName . '").toggle();
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
                $LicenseKeyInfo = $RegPakage . ' ' . $RegSource . '<br/>' . ContarctBegin . ' '
                        . substr($LicenseKey["RegStartDate"], 0, 10) . ' ' . ContarctEnd . ' ' . $RegEndDate . '<br/> ';
                $LicenseImg = '
                            <img id="img' . $ProgramName . '" border="0" src="admin/Themes/' . $ThemeName
                        . '/images/dialog_infos.png" width="16" height="16" title="' . Support_info . '"  alt="' . Support_info . '" />
                            <div class="hidden_div" id="msg' . $ProgramName . '" name="msg' . $ProgramName . '">
                                <input type="hidden" value="' . $ProgramName . '||' . $License . '" id="'
                        . $ProgramName . '" name="' . $ProgramName . '">
                            <span style="font-size: small;" >' . $LicenseKeyInfo . '</span>
                            ' . YouCanGetPaidSupport . '<br/>
                            </div>';
                $jquery_js .= '$("#img' . $ProgramName . '").click(function(){ 
                                $("#msg' . $ProgramName . '").toggle();
                                    });';
                $ScriptJS .= ' setTimeout(\'stat_From_messagecenter("' . $ProgramName . '",theme,"'.$LicenseKeyInfo.'",nsup,lng)\',1333);' . "\n";
            }
            if (!constantDefined($ProgramName)) {
                $ProgramName = $ProgramName;
            } else {
                $ProgramName = constant($ProgramName);
            }

            //$LicenseImg = '<input type="hidden" value="'.$License.'" id="'.$ProgramName.'" name="'.$ProgramName.'"><span id="msg'.$ProgramName.'" name="msg'.$ProgramName.'"></span><img border="0" src="admin/Themes/'.$ThemeName.'/images/dialog_ok.png" width="16" height="16" alt="License Info" />';
            $programmanagment .= '<td  valign="top" width="242" ><br/><strong><a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . manage . ' : ' . $ProgramName . '">' . $Progthumb . '<br/>' . manage . ' ' . Progam . ' : ' . $ProgramName . ' ' . $ProgVersion . '</a> </strong> <br/> ' . $LicenseImg . '<strong> ' . $ProgDesc . '</strong></td>';
            if ($i + 1 % 4 == 0) {
                $programmanagment .= "</tr> \n";
            }
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//end if
    $programmanagment .= '</table>';
    // $programmanagment .= $Options.' <input type="submit" name="ManageProgSubmit" id="ManageProgSubmit" value="'. (submit).'" /></select></form>';   	
    //return $TableList ;
    return $programmanagment . '
               <script language="javascript" type="text/javascript" src="admin/todo/programs/ajax.js"></script>
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
}

//end function
?>
