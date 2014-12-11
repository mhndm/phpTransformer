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

global $ThemeName, $theList, $theContent;

$db = new db();
$theList = '';
//add Recycle files from programs folder
$d = dir("Programs/");
while (false !== ($entry = $d->read())) {
    $db_exst = $db->get_var(" select `ProgramName` from `programs` where `ProgramName`='" . $entry . "'; ");
    if ($db_exst) {
        if ($entry != "." and $entry != ".." and is_dir($d->path . $entry)) {
            if (is_file($d->path . $entry . '/admin/recycle.php')) {
                include_once($d->path . $entry . '/admin/recycle.php');
            }
        }
    }
}
$d->close();

//add Recycle files from Blocks folder
$Bd = dir("Blocks/");
while (false !== ($Bentry = $Bd->read())) {
    $db_exst = $db->get_var(" select `BlockName` from `blocks` where `BlockName`='" . $Bentry . "'; ");
    if ($db_exst) {
        if ($Bentry != "." and $Bentry != ".." and is_dir($Bd->path . $Bentry)) {
            if (is_file($Bd->path . $Bentry . '/admin/recycle.php')) {
                include_once($Bd->path . $Bentry . '/admin/recycle.php');
            }
        }
    }
}
$Bd->close();

$theList .= SubIconLink("recycle", "RecycleUsers") . "<br/>"
        . SubIconLink("recycle", "RecycleGroups") . "<br/>"
        . SubIconLink("recycle", "RecycleThemes") . "<br/>"
        . SubIconLink("recycle", "RecycleLangs") . "<br/>"
        . SubIconLink("recycle", "RecycleProgs") . "<br/>"
        . SubIconLink("recycle", "RecycleBlocks") . "<br/>"
        . SubIconLink("recycle", "RecycleMarques") . "<br/>"
        . SubIconLink("recycle", "RecycleLetters") . "<br/>";

if (isset($_GET['subdo'])) {
    switch ($_GET['subdo']) {
        case "RecycleUsers":
            $theContent = RecycleUsers();
            break;
        case "RecycleGroups":
            $theContent = RecycleGroups();
            break;
        case "RecycleThemes":
            $theContent = RecycleThemes();
            break;
        case "RecycleLangs":
            $theContent = RecycleLangs();
            break;
        case "RecycleProgs":
            $theContent = RecycleProgs();
            break;
        case "RecycleBlocks":
            $theContent = RecycleBlocks();
            break;
        case "RecycleMarques":
            $theContent = RecycleMarques();
            break;
        case "RecycleLetters":
            $theContent = RecycleLetters();
            break;

        default :
    }//end switch
} else {
    $theContent = RecycleUsers();
}//end if	

$recycle = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$recycle = VarTheme("{todoImg}", "recylce.png", $recycle);
$recycle = VarTheme("{ThemeName}", $ThemeName, $recycle);
$recycle = VarTheme("{List}", $theList, $recycle);
$recycle = VarTheme("{Content}", $theContent, $recycle);

function RecycleLetters() {

    global $ThemeName, $TotalRecords, $Rows, $conn, $Recordset, $Lang;

    $RecycleLetters = '<img src="admin/Themes/' . $ThemeName . '/images/letters.png" alt=""/><br/>';
    if (isset($_GET['RestLetter'])) {
        $RestLetter = $_GET['RestLetter'];
        mysqli_query($conn, "UPDATE `letters` SET `Deleted`='0' where `idLetter`='" . $RestLetter . "';");
        $RecycleLetters .= (HasBeenRestoredsuccufully) . "<br/>";
    }//end if

    if (!isset($_GET['FinDelLetter'])) {
        ExcuteQuery("SELECT * FROM `letters`,`letterslang` 
					WHERE `letters`.`idLetter`=`letterslang`.`idLetter`
					AND `idLang` = '20070000001' AND `letters`.`Deleted`='1';");
        if ($TotalRecords > 0) {
            $RecycleLetters .= '<table width="100%" border="0" cellspacing="2" cellpadding="2">
									  <tr>
									    <td><strong>' . (LetterNameDesc) . '</strong></td>
									    <td><strong>' . (TitleLetterDesc) . '</strong></td>
									    <td>&nbsp;</td>
									    <td>&nbsp;</td>
									  </tr>';
            for ($i = 0; $i < $TotalRecords; $i++) {
                $idLetter = $Rows['idLetter'];
                $LatterName = subwords($Rows['LatterName'], 0, 75);
                $TitleLetter = subwords($Rows['TitleLetter'], 0, 75);
                $Vars = array("todo", "subdo", "FinDelLetter");
                $Vals = array("recycle", "RecycleLetters", $idLetter);
                $DeleteLetters = '<a onclick="return acceptDel();" href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" title="">
										' . (FinalDelete) . '</a>';
                $Vars = array("todo", "subdo", "RestLetter");
                $Vals = array("recycle", "RecycleLetters", $idLetter);
                $RestLetters = '<a onclick="return acceptRest();" href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" title="">
										' . (RestoreRecycle) . '</a>';
                $RecycleLetters .= '<tr>
									    <td><strong>' . $LatterName . '</strong></td>
									    <td> | <strong>' . $TitleLetter . '</strong></td>
									    <td> | ' . $DeleteLetters . '</td>
									    <td> | ' . $RestLetters . '</td>
									  </tr>';

                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
            $RecycleLetters .='</table><script language="javascript" type="text/javascript">
										function acceptDel(){
											return confirm("' . (DidUWantToFinalDelete) . '");
										}
										function acceptRest(){
											return confirm("' . (DidUWantToRestore) . '");
										}
										</script>';
        } else {
            $RecycleLetters .= (NocurrentDeleteLetter);
        }//end if
    } else {
        $idmarque = $_GET['FinDelLetter'];
        mysqli_query($conn, "delete from `letters` where `idLetter`='" . $idmarque . "';");
        mysqli_query($conn, "delete from `letterslang` where `idLetter`='" . $idmarque . "';");
        $RecycleLetters .= (SuccessFinalDeleteLetter);
    }//end if
    return $RecycleLetters;
}

//end function

function RecycleMarques() {

    global $ThemeName, $TotalRecords, $Rows, $conn, $Recordset, $Lang;

    $RecycleMarques = '<img src="admin/Themes/' . $ThemeName . '/images/marquee.jpg" alt=""/><br/>';

    if (isset($_GET['RestMarquee'])) {
        $RestMarquee = $_GET['RestMarquee'];
        mysqli_query($conn, "update `marques` set `Deleted`='0' where `idmarque`='" . $RestMarquee . "';");
        $RecycleMarques .= (HasBeenRestoredsuccufully) . "<br/>";
    }//end if

    if (!isset($_GET['FinDelMarquee'])) {
        ExcuteQuery("SELECT * FROM `marques`,`marqlang` 
					WHERE `marques`.`idmarque`=`marqlang`.`idmarque`
					AND `idLang` = '20070000001' AND `Deleted`='1';");
        if ($TotalRecords > 0) {
            $RecycleMarques .= '<table width="100%" border="0" cellspacing="2" cellpadding="2">
									  <tr>
									    <td><strong>' . (MarqueeMessage) . '</strong></td>
									    <td><strong>' . (Link) . '</strong></td>
									    <td>&nbsp;</td>
									  </tr>';
            for ($i = 0; $i < $TotalRecords; $i++) {
                $idMarque = $Rows['idMarque'];
                $Link = subwords($Rows['Link'], 0, 70);
                $Message = subwords($Rows['Message'], 0, 70);
                $Vars = array("todo", "subdo", "FinDelMarquee");
                $Vals = array("recycle", "RecycleMarques", $idMarque);
                $DeleteMarquee = '<a onclick="return acceptDel();" href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" title="">
										' . (FinalDelete) . '</a>';
                $Vars = array("todo", "subdo", "RestMarquee");
                $Vals = array("recycle", "RecycleMarques", $idMarque);
                $RestMarquee = '<a onclick="return acceptRest();" href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" title="">
										' . (RestoreRecycle) . '</a>';
                $RecycleMarques .= '<tr>
									    <td><strong>' . $Message . '</strong></td>
									    <td> | <strong>' . $Link . '</strong></td>
									    <td> | ' . $DeleteMarquee . '</td>
									    <td> | ' . $RestMarquee . '</td>
									  </tr>';

                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
            $RecycleMarques .='</table><script language="javascript" type="text/javascript">
										function acceptDel(){
											return confirm("' . (DidUWantToFinalDelete) . '");
										}
										function acceptRest(){
											return confirm("' . (DidUWantToRestore) . '");
										}									</script>';
        } else {
            $RecycleMarques .= (NocurrentDeleteMarquees);
        }//end if
    } else {
        $idmarque = $_GET['FinDelMarquee'];
        mysqli_query($conn, "delete from `marques` where `idmarque`='" . $idmarque . "';");
        mysqli_query($conn, "delete from `marqlang` where `idmarque`='" . $idmarque . "';");
        $RecycleMarques .= (SuccessFinalDeleteMarueeNews);
    }//end if
    return $RecycleMarques;
}

//end function

function RecycleBlocks() {
    global $ThemeName, $TotalRecords, $Rows, $conn, $Recordset;

    $RecycleBlocks = '<img src="admin/Themes/' . $ThemeName . '/images/blocks.png" alt=""/><br/>';

    if (isset($_GET['RestBlock'])) {
        $RestBlock = $_GET['RestBlock'];
        mysqli_query($conn, "update`blocks` set `Deleted`='0' where `BlockName`='" . $RestBlock . "';");
        $RecycleBlocks .= (HasBeenRestoredsuccufully) . "<br/>";
    }//end if

    if (!isset($_GET['FinDelBlock'])) {

        ExcuteQuery("SELECT * FROM `blocks` WHERE `Deleted`='1';");
        if ($TotalRecords > 0) {
            $RecycleBlocks .= '<table width="100%" border="0" cellspacing="2" cellpadding="2">
							  <tr>
							    <td><strong>' . (BlockName) . '</strong></td>
							    <td><strong>' . (Active) . '</strong></td>
							    <td>&nbsp;</td>
							    <td>&nbsp;</td>
							  </tr>';
            for ($i = 0; $i < $TotalRecords; $i++) {
                $BlockName = $Rows['BlockName'];
                $Active = $Rows['Active'];
                $Vars = array("todo", "subdo", "FinDelBlock");
                $Vals = array("recycle", "RecycleBlocks", $BlockName);
                $DeleteBlock = '<a onclick="return acceptDel();" href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" title="">
									' . (FinalDelete) . '</a>';
                $Vars = array("todo", "subdo", "RestBlock");
                $Vals = array("recycle", "RecycleBlocks", $BlockName);
                $RestBlock = '<a onclick="return acceptRest();" href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" title="">
									' . (RestoreRecycle) . '</a>';
                $RecycleBlocksRec[] = '<tr>
									    <td>' . $BlockName . '</td>
									    <td> | ' . $Active . '</td>
									    <td> | ' . $DeleteBlock . '</td>
									    <td> | ' . $RestBlock . '</td>
									</tr>';
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
            $RecycleTabs = Pagination($RecycleBlocksRec, 10, 10);
            $RecycleBlocks.= $RecycleTabs[0];
            $RecycleBlocks.='</table>';
            $RecycleBlocks.= $RecycleTabs[1];
            $RecycleBlocks .= '<script language="javascript" type="text/javascript">
									function acceptDel(){
										return confirm("' . (DidUWantToFinalDelete) . '");
									}
									function acceptRest(){
										return confirm("' . (DidUWantToRestore) . '");
									}
								</script>';
        } else {
            $RecycleBlocks .= NocurrentDelBlocks;
        }//end if
    } else {
        $BlockName = InputFilter($_GET['FinDelBlock']);
        $FinalDeleteBlockDB = new db();
        $query = "select * from `blocks` where `BlockName`='" . $BlockName . "' ; ";
        $FinalDeleteBlock = $FinalDeleteBlockDB->get_row($query);
        if ($FinalDeleteBlock) {
            $FinalDeleteBlockDB->query("delete from `blocks` where `BlockName`='" . $BlockName . "';");
            $FinalDeleteBlockDB->query("delete from `blocklang` where `BlockName`='" . $BlockName . "';");
            $FinalDeleteBlockDB->query("delete from `adminperm` where `constName`='blok' and `varName`='todo' and `varValue`='" . $BlockName . "' ;");
            $RecycleBlocks .= SuccessFINALDelBlock;
        } else {
            $RecycleBlocks .= NocurrentDelBlocks;
        }
    }//end if

    return $RecycleBlocks;
}

//end function

function RecycleProgs() {
    global $ThemeName, $TotalRecords, $Rows, $conn, $Recordset;

    $RecycleProgs = '<img src="admin/Themes/' . $ThemeName . '/images/programs.png" alt=""/><br/>';

    if (isset($_GET['RestProg'])) {
        $RestProg = $_GET['RestProg'];
        mysqli_query($conn, "UPDATE `programs` set `Deleted`='0' where `IdProgram`='" . $RestProg . "';");
        $RecycleProgs .= (HasBeenRestoredsuccufully) . '<br/>';
    }//end if

    if (!isset($_GET['FinDelProg'])) {
        ExcuteQuery("SELECT * FROM `programs` WHERE `Deleted`='1';");
        if ($TotalRecords > 0) {
            $RecycleProgs .= '<table width="100%" border="0" cellspacing="2" cellpadding="2">
							  <tr>
							    <td><strong>' . (ProgramName) . '</strong></td>
							    <td><strong>' . (Hits) . '</strong></td>
							    <td>&nbsp;</td>
							    <td>&nbsp;</td>
							  </tr>';
            for ($i = 0; $i < $TotalRecords; $i++) {
                $IdProgram = $Rows['IdProgram'];
                $ProgramName = $Rows['ProgramName'];
                $Hits = $Rows['Hits'];
                $Vars = array("todo", "subdo", "FinDelProg");
                $Vals = array("recycle", "RecycleProgs", $IdProgram);
                $DeleteProg = '<a onclick="return acceptDel();" href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" title="">
									' . (FinalDelete) . '</a>';
                $Vars = array("todo", "subdo", "RestProg");
                $Vals = array("recycle", "RecycleProgs", $IdProgram);
                $RestProg = '<a onclick="return acceptRest();" href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" title="">
									' . (RestoreRecycle) . '</a>';
                $RecycleProgsRec[] = '<tr>
									    <td>' . $ProgramName . '</td>
									    <td> | ' . $Hits . '</td>
									    <td> | ' . $DeleteProg . '</td>
									    <td> | ' . $RestProg . '</td>
									</tr>';
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
            $RecycleTabs = Pagination($RecycleProgsRec, 10, 10);
            $RecycleProgs.= $RecycleTabs[0];
            $RecycleProgs.='</table>';
            $RecycleProgs.= $RecycleTabs[1];

            $RecycleProgs .= '<script language="javascript" type="text/javascript">
										function acceptDel(){
											return confirm("' . (DidUWantToFinalDelete) . '");
										}
										function acceptRest(){
											return confirm("' . (DidUWantToRestore) . '");
										}
										</script>';
        } else {
            $RecycleProgs .= NocurrentDelPROGS;
        }//end if
    } else {
        $IdProgram = InputFilter($_GET['FinDelProg']);
        $FinalDeleteProdDB = new db();
        $query = "select * from `programs` where `IdProgram`='" . $IdProgram . "';";
        $FinalDeleteProd = $FinalDeleteProdDB->get_row($query);
        if ($FinalDeleteProd) {
            //echo $FinalDeleteProd->ProgramName;
            $FinalDeleteProdDB->query("delete from `programs` where `IdProgram`='" . $IdProgram . "';");
            $FinalDeleteProdDB->query("delete from `adminperm` where `constName`='prog' and `varName`='todo' and `varValue`='" . $FinalDeleteProd->ProgramName . "' ;");
            $RecycleProgs .= SuccessFINALDelProg;
        } else {
            $RecycleProgs .= NocurrentDelPROGS;
        }
    }//end if

    return $RecycleProgs;
}

//end function

function RecycleLangs() {
    global $ThemeName, $TotalRecords, $Rows, $conn, $Recordset, $Lang;

    $RecycleLangs = '<img src="admin/Themes/' . $ThemeName . '/images/languages.jpg" alt=""/><br/>';

    if (isset($_GET['RestlLang'])) {
        $RestlLang = InputFilter($_GET['RestlLang']);
        mysqli_query($conn, "update`languages` set `Deleted`='0' where `IdLang`='" . $RestlLang . "';");
        $RecycleLangs .= (HasBeenRestoredsuccufully) . "<br/>";
    }//end if

    if (!isset($_GET['FinDelLang'])) {

        ExcuteQuery("SELECT * FROM `languages` WHERE `Deleted`='1';");
        if ($TotalRecords > 0) {
            $RecycleLangs .= '<table width="100%" border="0" cellspacing="2" cellpadding="2">
							  <tr>
							    <td><strong>' . (Language) . '</strong></td>
							    <td><strong>' . (LangChoice) . '</strong></td>
							    <td>&nbsp;</td>
							    <td>&nbsp;</td>
							  </tr>';
            for ($i = 0; $i < $TotalRecords; $i++) {
                $IdLang = $Rows['IdLang'];
                $LangName = $Rows['LangName'];
                $Hits = $Rows['Hits'];
                $Deleted = $Rows['Deleted'];
                $Vars = array("todo", "subdo", "FinDelLang");
                $Vals = array("recycle", "RecycleLangs", $IdLang);
                $DeleteLang = '<a onclick="return acceptDel();" href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" title="">
									' . (FinalDelete) . '</a>';
                $Vars = array("todo", "subdo", "RestlLang");
                $Vals = array("recycle", "RecycleLangs", $IdLang);
                $restLang = '<a onclick="return acceptRest();" href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" title="">
									' . (RestoreRecycle) . '</a>';
                $RecycleLangs .= '<tr>
									    <td>' . $LangName . '</td>
									    <td> | ' . $Hits . '</td>
									    <td> | ' . $DeleteLang . '</td>
									    <td> | ' . $restLang . '</td>
									</tr>';

                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
            $RecycleLangs .= '<table><script language="javascript" type="text/javascript">
										function acceptDel(){
											return confirm("' . (DidUWantToFinalDelete) . '");
										}
										function acceptRest(){
											return confirm("' . (DidUWantToRestore) . '");
										}										</script>';
        } else {
            $RecycleLangs .= (NocurrentDelLangs);
        }//end if
    } else {
        $FinDelLang = $_GET['FinDelLang'];
        //update users langs
        mysqli_query($conn, "update `users` set `PrefLang`='" . $Lang . "' where `PrefLang`='" . $FinDelLang . "';");
        //delete lang
        mysqli_query($conn, "delete from `languages` where `IdLang`='" . $FinDelLang . "';");
        $RecycleLangs .= (SuccessFINALDelLang);
    }//end if

    return $RecycleLangs;
}

//end function

function RecycleThemes() {
    global $conn, $ThemeName;
    $RecycleThemes = '<img src="admin/Themes/' . $ThemeName . '/images/themes.png" alt=""/><br/>';

    if (isset($_GET['restTheme'])) {
        $themrest = $_GET['restTheme'];
        mysqli_query($conn, "update `themes` set `Active`='1' where `ThemeName`='" . $themrest . "';");
        $RecycleThemes = (HasBeenRestoredsuccufully) . "<br/>";
    }//end if

    if (!isset($_GET['FinthemDel'])) {
        $Query = "SELECT * FROM `themes` where `Active`='0';";
        $RecordSet = mysqli_query($conn, $Query);
        $TotalRecords = mysqli_num_rows($RecordSet);
        if ($TotalRecords > 0) {
            $CurrentThemes = '<table border="0" cellspacing="2" cellpadding="2">
				  <tr>
				    <td><strong>' . (ThemeName) . '</strong></td>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				  </tr>';
            while ($RowS = mysqli_fetch_assoc($RecordSet)) {
                $dataThemeName = $RowS['ThemeName'];
                $Active = $RowS['Active'];
                $Vars = array('todo', 'subdo', 'FinthemDel');
                $Vals = array('recycle', 'RecycleThemes', $dataThemeName);
                $deletethem = '<a href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" tilte="" onclick="return acceptDelFailed();">'
                        . (FinalDelete) . '</a>';
                $Vars = array('todo', 'subdo', 'restTheme');
                $Vals = array('recycle', 'RecycleThemes', $dataThemeName);
                $Restorethem = '<a href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" tilte="" onclick="return acceptRestore();">'
                        . (RestoreRecycle) . '</a>';
                $CurrentThemes .= ' <tr>
										<td>' . $dataThemeName . '</td>
										<td> | ' . $deletethem . '</td>
										<td> | ' . $Restorethem . '</td>
									</tr>';
            }//end while
            $CurrentThemes .= '</table>
							<script language="javascript" type="text/javascript">
								function acceptDelFailed(){
								return confirm("' . (DidUWantToFinalDelete) . '");
								}
								function acceptRestore(){
								return confirm("' . (DidUWantToRestore) . '");
								}
							</script>';
            $RecycleThemes .= $CurrentThemes;
        } else {
            $RecycleThemes .= (NoCurrentDelThemes);
        }//END IF
    } else {
        $FinthemDel = $_GET['FinthemDel'];
        //update all user theme to default theme :
        global $ThemeName;
        mysqli_query($conn, "update `users` set `PrefThem`='" . $ThemeName . "' where `PrefThem`='" . $FinthemDel . "';");
        //delte the them 

        mysqli_query($conn, "delete from `themes` where `ThemeName`='" . $FinthemDel . "';");
        $RecycleThemes = (SuccessFINALDeleteTheme);
    }//end if
    return $RecycleThemes;
}

//end function

function RecycleGroups() {

    global $ThemeName, $conn, $TotalRecords, $Rows, $Recordset;
    $RecycleGroups = '<img src="admin/Themes/' . $ThemeName . '/images/groups.png" alt=""/><br/>';

    if (isset($_GET['RestGroup'])) {
        $DeleteGroup = InputFilter($_GET['RestGroup']);
        $query = "update `groups` set `Deleted`='0' where `GroupId`='" . $DeleteGroup . "' ;";
        $Recordset = mysqli_query($conn, $query);
        $RecycleGroups .= (HasBeenRestoredsuccufully) . "<br/>";
    }//end if
    //delete group:
    if (isset($_GET['finDelGroup'])) {
        // WE DONT DELETE : 3 GROUPS users guests an d admins
        if ($_GET['finDelGroup'] != "20070000000" and $_GET['finDelGroup'] != "20070000001" and $_GET['finDelGroup'] != "200700000-1") {
            $DeleteGroup = PostFilter($_GET["finDelGroup"]);
            //cheking if users have this group
            ExcuteQuery("SELECT * FROM `users` WHERE `GroupId` ='" . $DeleteGroup . "';");
            if ($TotalRecords > 0) {
                $RecycleGroups .= (YouCantdeletethisGroupBecauseusershavethisGroup);
            } else {
                //deleting group

                $query = "delete from `groups` where `GroupId`='" . $DeleteGroup . "' ;";
                $Recordset = mysqli_query($conn, $Query);
                $RecycleGroups .= (WeHaveSuccefullyDeleteGroup);
            }//end if
        } else {
            $RecycleGroups .= (YouCantdeletethisGroupBecauseitsasystemgroup);
        }//end if
    } else {
        $RecycleGroups .='';
        ExcuteQuery("SELECT * FROM `groups` WHERE `Deleted` ='1';");
        if ($TotalRecords > 0) {
            for ($i = 0; $i < $TotalRecords; $i++) {
                $GroupId = $Rows['GroupId'];
                $GroupName = $Rows['GroupName'];
                $Desc = $Rows['Desc'];
                $Vars = array("todo", "subdo", "finDelGroup");
                $Vals = array("recycle", "RecycleGroups", $GroupId);
                $FinalDelete = '<a onclick="return acceptDel();" href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" title="" >'
                        . (FinalDelete) . '</a>';
                $Vars = array("todo", "subdo", "RestGroup");
                $Vals = array("recycle", "RecycleGroups", $GroupId);
                $RecycleGroup = '<a onclick="return acceptrest();" href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" title="" >'
                        . (RestoreRecycle) . '</a>';

                $RecycleGroups .= $GroupName . ' : ' . $Desc . ' | ' . $FinalDelete . ' | ' . $RecycleGroup . '<br/>';
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
            $RecycleGroups .= '<script language="javascript" type="text/javascript">
									function acceptDel(){
										return confirm("' . (DidUWantToFinalDelete) . '");
									}
									function acceptrest(){
										return confirm("' . (DidUWantToRestore) . '");
									}									</script>';
        } else {
            $RecycleGroups .= (ThereIsNocurrentdeletedGroup);
        }//end if
    }//end if
    return $RecycleGroups;
}

//end function

function RecycleUsers() {
    global $ThemeName, $TotalRecords, $Rows, $conn, $Recordset;

    $RecycleUsers = '<img src="admin/Themes/' . $ThemeName . '/images/users.png" alt=""/><br/>';

    //restore info
    if (isset($_GET['finRESUser'])) {
        $NickName = $_GET['finRESUser'];
        $query = "update `users` set `Deleted`='0' where `NickName`='" . $NickName . "'";
        $Recordset = mysqli_query($conn, $query);
        $RecycleUsers .= "<br/>" . (HasBeenRestoredsuccufully) . "<br/>";
    }//end if

    if (isset($_GET['finDelUser'])) {
        $NickName = InputFilter($_GET['finDelUser']);
        ExcuteQuery("SELECT `UserId` FROM `users` WHERE `NickName`='" . $NickName . "';");
        if ($TotalRecords > 0) {
            $UserId = $Rows['UserId'];

            //UPDATE USER Transaction in the site to the GUEST USER
            $query = "update `bancltrans` set `idBanClnt`='20070000000' where `idBanClnt`='" . $UserId . "';";
            $Recordset = mysqli_query($conn, $query);

            $query = "update `bannerclients` set `UserId`='20070000000' where `UserId`='" . $UserId . "';";
            $Recordset = mysqli_query($conn, $query);

            $query = "update `campaign` set `idBanClnt`='20070000000' where `idBanClnt`='" . $UserId . "';";
            $Recordset = mysqli_query($conn, $query);

            $query = "update `news` set `IdUserName`='20070000000' where `IdUserName`='" . $UserId . "';";
            $Recordset = mysqli_query($conn, $query);

            $query = "update `newscomment` set `UserId`='20070000000' where `UserId`='" . $UserId . "';";
            $Recordset = mysqli_query($conn, $query);

            $query = "update `poolusers` set `UserId`='20070000000' where `UserId`='" . $UserId . "';";
            $Recordset = mysqli_query($conn, $query);

            $query = "update `poolusers` set `UserId`='20070000000' where `UserId`='" . $UserId . "';";
            $Recordset = mysqli_query($conn, $query);

            //DELETE USER
            $query = "delete from `users` where `UserId`='" . $UserId . "'";
            $Recordset = mysqli_query($conn, $query);
            $RecycleUsers .= $NickName . ' ' . (HasBeenDeletedsuccufully);
        } else {
            $delUser = (ThisNickNameNotExist) . '<br/>';
            $delUser .= get_include_contents("admin/todo/members/deleteUserForm.php");
            $delUser = VarTheme("{NickName}", (NickName), $delUser);
            $delUser = VarTheme("{delete}", (delete), $delUser);
            $RecycleUsers .= $delUser;
        }//end if
    } else {
        ExcuteQuery("SELECT * FROM `users` WHERE `Deleted`='1';");
        if ($TotalRecords > 0) {
            for ($i = 0; $i < $TotalRecords; $i++) {
                $UserId = $Rows['UserId'];
                $UserName = $Rows['UserName'];
                $ParentName = $Rows['ParentName'];
                $FamName = $Rows['FamName'];
                $Contry = '<img src="images/flags/' . strtolower($Rows['Contry']) . '.png" width="18" height="12" alt="' . $Rows['Contry'] . '" />';
                $UserMail = $Rows['UserMail'];
                $resNickName = $Rows['NickName'];
                $Vars = array("todo", "subdo", "finDelUser");
                $Vals = array("recycle", "RecycleUsers", $resNickName);
                $FinalDelete = '<a onclick="return acceptDel();" href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" title="" >'
                        . (FinalDelete) . '</a>';
                $Vars = array("todo", "subdo", "finRESUser");
                $Vals = array("recycle", "RecycleUsers", $resNickName);
                $RestoreRecycle = '<a onclick="return acceptRestore();" href="'
                        . AdminCreateLink("", $Vars, $Vals) . '" title="" >'
                        . (RestoreRecycle) . '</a>';
                $SearchUser[] = '<tr>
									<td style="border-bottom:dotted; border-bottom-width:thin">'
                        . $resNickName . '</td>
									<td style="border-bottom:dotted; border-bottom-width:thin"> | '
                        . $UserName . ' ' . $ParentName . ' ' . $FamName . '</td>
									<td style="border-bottom:dotted; border-bottom-width:thin"> | '
                        . $UserMail . '</td>
									<td style="border-bottom:dotted; border-bottom-width:thin"> | '
                        . $Contry . '</td>
									<td style="border-bottom:dotted; border-bottom-width:thin"> | '
                        . $FinalDelete . '</td>
									<td style="border-bottom:dotted; border-bottom-width:thin"> | '
                        . $RestoreRecycle . '</td>
								</tr>';
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
            $Result = '<table width="100%" border="0" cellspacing="2" cellpadding="2">';
            $Result .='<tr>
						<td style="border-bottom:dotted; border-bottom-width:thin"><strong>'
                    . (NickName) . '</strong></td>
						<td style="border-bottom:dotted; border-bottom-width:thin"><strong>'
                    . (UserName) . '</strong></td>
						<td style="border-bottom:dotted; border-bottom-width:thin"><strong>'
                    . (Email) . '</strong></td>
						<td style="border-bottom:dotted; border-bottom-width:thin"><strong>'
                    . (contrie) . '</strong></td>
						<td style="border-bottom:dotted; border-bottom-width:thin">&nbsp;</td>
						<td style="border-bottom:dotted; border-bottom-width:thin">&nbsp;</td>
					</tr>';
            $RecyclePages = Pagination($SearchUser, 10, 10);
            $Result.= $RecyclePages[0];
            $Result.='</table>';
            $Result.= $RecyclePages[1];
            $RecycleUsers .= $Result . '<script language="javascript" type="text/javascript">
									function acceptRestore(){
										return confirm("' . (DidUWantToRestore) . '");
									}
									function acceptDel(){
										return confirm("' . (DidUWantToFinalDelete) . '");
									}
									</script>';
        } else {
            $RecycleUsers .= (ThereIsNoCurrentDeltedUsers);
        }//end if
    }//end if

    return $RecycleUsers;
}

//end function
?>