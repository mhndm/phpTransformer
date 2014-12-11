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

global $ThemeName;
$theList = SubIconLink("languages", "CurrentLang") . "<br/>";
$theList .= SubIconLink("languages", "NewLang") . "<br/>";

if (isset($_GET['subdo'])) {
    switch ($_GET['subdo']) {
        case "CurrentLang":
            $theContent = CurrentLang();
            break;
        case "NewLang":
            $theContent = NewLang();
            break;
        case "delLang":
            $theContent = delLang();
            $Vars = array("todo", "subdo");
            $Vals = array("languages", "CurrentLang");
            header("location: " . AdminCreateLink("", $Vars, $Vals) . '"');
            break;
        default :
    }//end switch
} else {
    $theContent = CurrentLang();
}//end if		

if (isset($_POST['NewLangSubmit'])) {
    $theContent = SaveLang() . '<br/>';
    $theContent .= NewLang();
}//end if

$languages = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$languages = VarTheme("{todoImg}", "languages.png", $languages);
$languages = VarTheme("{ThemeName}", $ThemeName, $languages);
$languages = VarTheme("{List}", $theList, $languages);
$languages = VarTheme("{Content}", $theContent, $languages);

function SaveLang() {
    global $conn;
    $Var = PostFilter($_POST['NewLnag']);
    $Var = substr($Var, 5, strlen($Var) - 5);
    $Var = substr($Var, 0, strlen($Var) - 4);
    $LangName = $Var;
    $IdLang = GenerateID('languages', 'IdLang');
    mysqli_query($conn, "INSERT INTO `languages` ( `IdLang` , `LangName` , `Hits` , `Deleted` )
					VALUES ('" . $IdLang . "', '" . $LangName . "', '0', '0');");
    return (NewLangHasBeenSaved);
}

//end if

function NewLang() {

    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang;
    $NewLang = '<strong>' . (PleaseChooseNewLangFromBelowIfUWanttoAddOne) . '&nbsp;&nbsp; <a href="admin/includes/webfolder/index.php?action=upload&order=name&srt=yes&lang=' . $Lang . '" target="_blank" >'
            . OrYouCanUploadAndExtractYourModuleFolder . '</a>
					</strong><br/>
					<form id="formNewLang" name="formNewLang" method="post" action="">
				  <select name="NewLnag" id="NewLnag">';
    $d = dir("languages");
    while (($entry = $d->read()) !== false) {
        if ($entry != "." and $entry != "..") {
            if (is_file($d->path . '/' . $entry)) {
                //this Lang exsit in our files
                //serch our data base for this file
                ExcuteQuery("SELECT * FROM `languages`;");
                if ($TotalRecords > 0) {
                    for ($i = 0; $i < $TotalRecords; $i++) {
                        $LangName = $Rows['LangName'];
                        if (strtolower($entry) == 'lang-' . strtolower($LangName) . '.php') {
                            $LangName = strtolower($LangName);
                            //echo $NewLang;
                            $$LangName = true;
                            break;
                        }//end if 
                        $Rows = mysqli_fetch_assoc($Recordset);
                    }//end for
                }//end if
            }//end if
        }//end if
    }//end while
    $d->close();
    $NmbrOfNewlangs = 0;
    $options = "";
    $d = dir("languages");
    while (($entry = $d->read()) !== false) {
        if ($entry != "." and $entry != "..") {
            if (is_file($d->path . '/' . $entry) and $entry != 'index.html') {
                $Var = $entry;
                $Var = substr($Var, 5, strlen($Var) - 5);
                $Var = substr($Var, 0, strlen($Var) - 4);
                $LangVar = strtolower($Var);
                if (!isset($$LangVar)) {
                    $options .= '<option value="' . $entry . '">' . $Var . '</option>';
                    $NmbrOfNewlangs++;
                }//end if 			
            }//END IF
        }//end if
    }//end while
    $d->close();
    if ($NmbrOfNewlangs > 0) {
        $NewLang .= $options . '  </select><input class="submit" type="submit" name="NewLangSubmit" id="NewLangSubmit" value="' . Setup . '" /></form>';
        return $NewLang;
    } else {
        return '<strong>' . (PleaseChooseNewLangFromBelowIfUWanttoAddOne) . '</strong>&nbsp;&nbsp; <a href="admin/includes/webfolder/index.php?action=upload&order=name&srt=yes&lang=' . $Lang . '" target="_blank" >'
                . OrYouCanUploadAndExtractYourModuleFolder . '</a>';
    }//end if
    return $NewLang;
}

//end if

function delLang() {
    global $conn;
    if (isset($_GET['LangName'])) {
        $LangName = $_GET['LangName'];
        mysqli_query($conn, "update `languages` set `Deleted`='1' where `LangName`='" . $LangName . "';");
        $delLang = (langHasBeenDeleted);
    } else {
        $delLang = '';
    }//end if
    return $delLang;
}

//end function

function CurrentLang() {
    global $TotalRecords, $Rows, $Recordset, $conn, $DefaultLang;
    include_once("Global.php");
    //echo $DefaultLang ;
    ExcuteQuery("SELECT * FROM `languages` where `Deleted`<>'1';");
    if ($TotalRecords > 0) {
        $CurrentLang = '<table width="100%" border="0" cellspacing="2" cellpadding="2">
						  <tr>
						    <td><strong>' . (Language) . '</strong></td>
						    <td><strong>' . (LangChoice) . '</strong></td>
						    <td>&nbsp;</td>
						  </tr>';
        for ($i = 0; $i < $TotalRecords; $i++) {
            $LangName = $Rows['LangName'];
            $Hits = $Rows['Hits'];
            $Deleted = $Rows['Deleted'];
            if ($Deleted == '1') {
                $Deleted = (yes);
            } else {
                $Deleted = (no);
            }//end if
            // we dont delete Default Lang
            if ($LangName == $DefaultLang) {
                $DeleteLang = '';
            } else {
                $Vars = array("todo", "subdo", "LangName");
                $Vals = array("languages", "delLang", $LangName);
                $DeleteLang = '<a onclick="return acceptDel();" href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">
							' . (delete) . '</a>';
            }//end if


            $CurrentLang .= '  <tr>
					<td style="border-bottom:dotted; border-bottom-width:thin">'
                    . $LangName . '</td>
					<td style="border-bottom:dotted; border-bottom-width:thin"> | '
                    . $Hits . '</td>
					
                                     <td style="border-bottom:dotted; border-bottom-width:thin"> | '
                    . $DeleteLang . '</td>
					</tr>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $CurrentLang .='</table>
						<script language="javascript" type="text/javascript">
							function acceptDel(){
								return confirm("' . (DoUWantToDeleteThisLanguages) . '");
							}
						</script>';
    }//end if
    return $CurrentLang;
}

//end function
?>