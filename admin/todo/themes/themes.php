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

global $ThemeName, $MainPrograms;
$theList = SubIconLink("themes", "CurrentThemes") . "<br/>";
$theList .= SubIconLink("themes", "NewTheme") . "<br/>";

if (isset($_GET['subdo'])) {
    switch ($_GET['subdo']) {
        case "CurrentThemes":
            $theContent = CurrentThemes();
            break;
        case "ModifyTheme":
            $theContent = ModifyTheme();
            break;
        case "NewTheme":
            $theContent = ShowNewTheme();
            break;
            break;
        case "editKey":
            $theContent = editKey();
            break;
        case "delTheme":
            $theContent = delTheme();
            $theContent .= CurrentThemes();
            break;
        default :
            $theContent = CurrentThemes();
            break;
    }//end switch
} else {
    $theContent = CurrentThemes();
}//end if	

if (isset($_GET['NewTheme'])) {
    $theContent = SaveNewTheme();
    //$theContent .= ShowNewTheme();
}//end if

$themes = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$themes = VarTheme("{todoImg}", "themes.png", $themes);
$themes = VarTheme("{ThemeName}", $ThemeName, $themes);
$themes = VarTheme("{List}", $theList, $themes);
$themes = VarTheme("{Content}", $theContent, $themes);

function ModifyTheme() {

    if (isset($_GET['Object'])) {
        $ThemeName = InputFilter($_GET['Object']);
        if (is_file("Themes/$ThemeName/admin/index.php")) {

            $ModifyTheme = get_include_contents("Themes/$ThemeName/admin/index.php");
        } else {
            $ModifyTheme = $ThemeName . ' ' . theme_no_control_panel;
        }
    } else {
        $ModifyTheme = theme_no_control_panel;
    }

    return $ModifyTheme;
}

function editKey() {

    $Object = InputFilter($_GET['Object']);
    $dbeditKeySQL = new db();

    if (isset($_POST['SaveKey'])) {
        $editKeySQL = $dbeditKeySQL->get_row(" UPDATE `themes` SET `License`='" . PostFilter($_POST['License']) . "' where `ThemeName`='" . $Object . "' ; ");
        $editKey = YourSupportKeyHasBeenSaved;
    } else {
        $editKeySQL = $dbeditKeySQL->get_row(" select `License` from `themes` where `ThemeName`='" . $Object . "' ; ");
        if ($editKeySQL) {
            $License = $editKeySQL->License;
        } else {
            $License = '';
        }
        $editKey = '<form method="post" name="editKey">
            <input name="License" id="License" value="' . $License . '" size="100" maxlength="255" class="text" type="text">
            <input value="' . save . '" name="SaveKey" class="submit" type="submit">
        </form>';
    }

    return $editKey;
}

function delTheme() {
    global $ThemeName,$conn;
    $themDel = InputFilter($_GET['themDel']);
    mysqli_query($conn,"update `themes` set `Active`='0' where `ThemeName`='" . $themDel . "';");
    //update all users having this Theme 
    mysqli_query($conn,"update `users` set `PrefThem`='" . $ThemeName . "' where `PrefThem`='" . $themDel . "';");
    //update params
    mysqli_query($conn,"update `params` set `DefaultThem`='" . $ThemeName . "' ;");

    return (SuccessDeleteTheme);
}

//end function

function CurrentThemes() {
    global $SqlType, $conn, $ThemeName, $MainPrograms, $Lang; // $TotalRecords,$Recordset,$Rows;
    $DefaultTheme = $ThemeName;
    $Query = "SELECT * FROM `themes` where `Active`='1';";
    $RecordSet = mysqli_query( $conn,$Query) ;
    $TotalRecords = mysqli_num_rows($RecordSet);
    if ($TotalRecords > 0) {
        $jquery_js = '';
        $ScriptJS = '';
        $RowS = mysqli_fetch_assoc($RecordSet);
        $CurrentThemes = '<div>';
        for ($i = 0; $i < $TotalRecords; $i++) {

            $ThemedataBase = $RowS['ThemeName'];
            $Active = $RowS['Active'];
            $License = $RowS['License'];

            if ($Active == '1') {
                $Active = no;
            } else {
                $Active = yes;
            }//end if
            $q = "SELECT COUNT(*) AS THEMES FROM `users` WHERE `PrefThem`='" . $ThemedataBase . "'";
            $rs = mysqli_query( $conn,$q)  ;
            $data = mysqli_fetch_assoc($rs);
            $Hits = $data['THEMES'];
            if ($DefaultTheme != $ThemedataBase) {
                $Vars = array('todo', 'subdo', 'themDel');
                $Vals = array('themes', 'delTheme', $ThemedataBase);
                $deletethem = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" tilte="" onclick="return acceptDelFailed();">' . delete . '</a>';
            } else {
                $deletethem = '';
            }//end if
            $Edit = "<a href=" . AdminCreateLink('', array('todo', 'subdo', 'Object'), array('themes', 'editKey', $ThemedataBase)) . "  >" . edit . '</a>  ';
            $Modify = "<a href=" . AdminCreateLink('', array('todo', 'subdo', 'Object'), array('themes', 'ModifyTheme', $ThemedataBase)) . "  >" . modify_this_theme . '</a>  ';

            if ($License == '') {
                $LicenseImg = '<input type="hidden" value="' . $License . '" id="' . $ThemedataBase . '" name="' . $ThemedataBase . '">
                               <img id="img' . $ThemedataBase . '" border="0" src="admin/Themes/' . $ThemeName . '/images/dialog_infos.png" 
                                   width="16" height="16" title="' . Support_info . '"  alt="' . Support_info . '" />

                                <div class="hidden_div" id="msg' . $ThemedataBase . '" name="msg' . $ThemedataBase . '">
                                    <span style="font-size: x-small;" >' . NoLicenseKeyFound . '</span> <br/>
                                 <a target="_blank" href="http://phptransformer.com/release/Prog-getlicense_Lang-' . $Lang . '_nl-1.pt">
                                        ' . YouCanGetPaidSupport . '
                                <br/></a> 
                            </div>';

                $jquery_js .= '$("#img' . $ThemedataBase . '").click(function(){ 
                                            $("#msg' . $ThemedataBase . '").toggle();
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

                $LicenseKeyInfo = $RegPakage . ' ' . $RegSource . '<br/>' . ContarctBegin . ' '
                        . substr($LicenseKey["RegStartDate"], 0, 10) . ' <br/>' . ContarctEnd . ' ' . $RegEndDate . '<br/> ';
                $LicenseImg = '
                            <img id="img' . $ThemedataBase . '" border="0" src="admin/Themes/' . $ThemeName
                        . '/images/dialog_infos.png" width="16" height="16" title="' . Support_info . '"  alt="' . Support_info . '" />
                            <div class="hidden_div" id="msg' . $ThemedataBase . '" name="msg' . $ThemedataBase . '">
                                <input type="hidden" value="' . $ThemedataBase . '||' . $License . '" id="'
                        . $ThemedataBase . '" name="' . $ThemedataBase . '">
                            <span style="font-size: small;" >' . $LicenseKeyInfo . '</span>
                            ' . YouCanGetPaidSupport . '<br/> ' . $Edit . '
                            </div>';
                $jquery_js .= '$("#img' . $ThemedataBase . '").click(function(){ 
                                $("#msg' . $ThemedataBase . '").toggle();
                                    });';

                $ScriptJS .= ' setTimeout(\'stat_From_messagecenter("' . $ThemedataBase . '",theme,"' . $LicenseKeyInfo . '",nsup,lng," ' . $Edit . ' ")\',1333);' . "\n";
            }

            if (is_file("Themes/" . $ThemedataBase . "/screenshot-mini.jpg")) {
                $thm_image = "Themes/" . $ThemedataBase . "/screenshot-mini.jpg";
            } else {
                $thm_image = "images/screenshot-mini.jpg";
            }
            $CurrentThemes .= '<a target="_blank" href="' .
                    CreateLink('', array('Prog', 'thm'), array($MainPrograms, $ThemedataBase)) . '" title="' . Preview . ' ' . $ThemedataBase . '" >
                <div style="float:' . lang_float . ';height:247px; text-align:center;">
                                    <strong>' . $ThemedataBase . '</strong> 
                                    <div style="overflow:hidden;width:280px;height:136px;">
                                          <img src="' . $thm_image . '" border="0"/>
                                       </div></a> ' . previewed . ' ' . $Hits . ' ' . times . ' | ' . $Modify . ' | ' . $deletethem . ' <span style="text-align:' . lang_float . ';"> ' . $LicenseImg . '</span>
                                          </div>';
            $RowS = mysqli_fetch_assoc($RecordSet);
        }//end for
        $CurrentThemes .= '</div>
					<script language="javascript" type="text/javascript">
						function acceptDelFailed(){
						return confirm("' . (duuwanttodeltethisTheme) . '");
						}
					</script>
                                     <script language="javascript" type="text/javascript" src="admin/todo/themes/ajax.js"></script>
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
    } else {
        $CurrentThemes = '';
    }//end if

    return $CurrentThemes;
}

//end FUNCTION

function SaveNewTheme() {
global $conn;
    $NewTheme = InputFilter($_GET['NewTheme']);
    mysqli_query($conn,"insert into `themes` (`ThemeName`,`Active`) values('" . $NewTheme . "','1')");
    $Vars = array('todo', 'subdo');
    $Vals = array('themes', 'CurrentThemes');
    $redirectTO = AdminCreateLink('', $Vars, $Vals);
    return adminPrintMessageAndRedirect(NewTheme, WeHaveInsertNewTheme, $redirectTO);
}

//end function

function ShowNewTheme() {

    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang;
    $newthemes = '<strong>' . (PleaseChooseNewThemeFromBelowIfUWanttoAddOne) . '</strong>';
    $d = dir("Themes");
    while (($entry = $d->read()) !== false) {
        if ($entry != "." and $entry != "..") {
            if (is_file($d->path . '/' . $entry . '/index.php')) {
                //this  prog exsit in our files
                //serch our data base for this file
                ExcuteQuery("SELECT * FROM `themes`;");
                if ($TotalRecords > 0) {
                    for ($i = 0; $i < $TotalRecords; $i++) {
                        $ThemeName = $Rows['ThemeName'];
                        if (strtolower($entry) == strtolower($ThemeName)) {
                            $ThemeName = strtolower($ThemeName);
                            $$ThemeName = true;
                            break;
                        }//end if 
                        $Rows = mysqli_fetch_assoc($Recordset);
                    }//end for
                }//end if
            }//end if
        }//end if
    }//end while
    $d->close();
    $NmbrOfNewThemes = 0;
    $newthemes .='&nbsp;&nbsp; <a href="admin/includes/webfolder/index.php?action=upload&dir=Themes&order=name&srt=yes&lang=' . $Lang . '" target="_blank" >'
            . OrYouCanUploadAndExtractYourModuleFolder . '</a><br/><table style="text-align: left; width:100%;" cellpadding="4px" cellspacing="4px">';
    $d = dir("Themes");
    while (($entry = $d->read()) !== false) {

        if ($entry != "." and $entry != "..") {
            if (is_file($d->path . '/' . $entry . '/index.php')) {
                $Var = strtolower($entry);
                if (!isset($$Var)) {
                    if ($NmbrOfNewThemes % 3 == 0) {
                        $newthemes .= ' <tr>';
                    }
                    $newthemes .= '<td style="border:solid gray 1px ;" align="center">';
                    if (is_file($d->path . '/' . $entry . '/screenshot.jpg')) {
                        $newthemes .='<a target="_blank"  href="' . $d->path . '/' . $entry . '/screenshot.jpg' . '" ><img border=0 src="' . $d->path . '/' . $entry . '/screenshot-mini.jpg' . '" /></a><BR/>';
                    } else {
                        $newthemes .='<a target="_blank" href="images/screenshot.jpg" ><img border=0 src="images/screenshot-mini.jpg" /></a><BR/>';
                    }
                    //$options = '<select name="NewTheme" id="NewTheme"><option value="'.$entry.'">'.$entry.'</option>';
                    $Vars = array('todo', 'subdo', 'NewTheme');
                    $Vals = array('themes', 'NewTheme', $entry);
                    $optionLink = AdminCreateLink('', $Vars, $Vals);
                    $options = '<a href="' . $optionLink . '">' . Activate . ' ' . $entry . '</a><BR/>';

                    $newthemes .= '<br/>' . $options . '<BR/>';

                    //get description of file
                    $File = $d->path . '/' . $entry . '/description.txt';
                    if (file_exists($File)) {
                        $newthemes .= '<div dir=ltr align=left>';
                        $lines = file($File, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                        foreach ($lines as $line_num => $line) {
                            $newthemes .= $line . '<br/>';
                        }
                        $newthemes .= '</div>';
                    }
                    $newthemes .= '</td>';
                    $NmbrOfNewThemes++;
                    if ($NmbrOfNewThemes + 1 % 3 == 0) {
                        $newthemes .= ' </tr>';
                    }
                }//end if
            }//END IF
        }//end if
        $i++;
    }//end while
    $newthemes .= '</table>';
    $d->close();
    $newthemes .= '</form>';
    if ($NmbrOfNewThemes > 0) {
        //$newthemes .= $options.'  </select><input type="submit" name="NewThemeSubmit" id="NewThemeSubmit" value="'. (setup).'" /></form>';
        return $newthemes;
    } else {
        return '<strong>' . (PleaseinstalthefolderoftheThemeIfwanttoaddnewone) . '</strong>';
    }//end if
}

//end function
?>