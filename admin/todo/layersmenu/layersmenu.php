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

global $TheNavBar, $ThemeName, $project, $IdLang;


$theList = SubIconLink("layersmenu", "RootMenu") . "<br/>";
$theList .= SubIconLink("layersmenu", "SubMenu") . "<br/>";
$theList .= SubIconLink("layersmenu", "AllElemnts") . "<br/>";
$theList .= SubIconLink("layersmenu", "AddMenu") . "<br/>";
$theList .= SubIconLink("layersmenu", "AddElemnts") . "<br/>";

if (isset($_GET['subdo'])) {
    switch ($_GET['subdo']) {
        case "RootMenu":
            $theContent = RootMenu();
            $TheNavBar[] = array((RootMenu), adminCreateLink("", array("todo", "subdo"), array("layersmenu", "RootMenu")));
            break;
        case "SubMenu":
            $theContent = SubMenu();
            $TheNavBar[] = array((SubMenu), adminCreateLink("", array("todo", "subdo"), array("layersmenu", "SubMenu")));
            break;
        case "AddElemnts":
            $theContent = AddElemnts();
            $TheNavBar[] = array((AddElemnts), adminCreateLink("", array("todo", "subdo"), array("layersmenu", "AddElemnts")));
            break;
        case "editMenu":
            $theContent = editMenu();
            $TheNavBar[] = array((editMenu), adminCreateLink("", array("todo", "subdo"), array("layersmenu", "editMenu")));
            break;
        case "AddMenu":
            $theContent = AddMenu();
            $TheNavBar[] = array((AddMenu), adminCreateLink("", array("todo", "subdo"), array("layersmenu", "AddMenu")));
            break;
        case "AllElemnts":
            $theContent = AllElemnts();
            $TheNavBar[] = array((AllElemnts), adminCreateLink("", array("todo", "subdo"), array("layersmenu", "AllElemnts")));
            break;
        case "delteMenu":
            $theContent = delteMenu();
            $TheNavBar[] = array((delteMenu), adminCreateLink("", array("todo", "subdo"), array("layersmenu", "delteMenu")));
            break;
        case "ChildsOfMenu":
            $theContent = ChildsOfMenu();
            $TheNavBar[] = array((delteMenu), adminCreateLink("", array("todo", "subdo"), array("layersmenu", "ChildsOfMenu")));
            break;
        default :
    }//end switch
} else {
    $theContent = RootMenu();
}//end if	

if (isset($_POST['SaveMenu'])) {
    $theContent = SaveMenu();
}//end if

if (isset($_POST['SaveNewMenu'])) {
    $theContent = SaveNewMenu();
}//end if

if (isset($_POST['SaveNewElement'])) {
    $theContent = SaveNewElement();
}//end if

include_once('MenuContainer.php');
$layersmenu = '<div style="border:solid; border-color:#61A0D6">' . (MenuSampleView) . $MenuCont . '<br/></div><br/>';
$layersmenu .= get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$layersmenu = VarTheme("{todoImg}", "layersmenu.png", $layersmenu);
$layersmenu = VarTheme("{ThemeName}", $ThemeName, $layersmenu);
$layersmenu = VarTheme("{List}", $theList, $layersmenu);
$layersmenu = VarTheme("{Content}", $theContent, $layersmenu);

function ChildsOfMenu() {

    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $ThemeName, $IdLang;
    $RootMenu = '';
    if (isset($_GET['Menu'])) {
        $Id = InputFilter($_GET['Menu']);

        ExcuteQuery("SELECT * FROM `pt_menu` ,`pt_menu_lang`
						where `parent_id`='" . $Id . "'
						and `pt_menu`.`id`=`pt_menu_lang`.`id`
						and `IdLang`='" . $IdLang . "'
						order by `parent_id`,`orderfield` ;");

        if ($TotalRecords > 0) {
            $RootMenu = '<table border="0" cellspacing="2" cellpadding="2">
					  <tr style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;" >
					    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
						<strong>' . (Text) . '</strong></td>
					    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
						<strong>' . (Icon) . '</strong></td>
					    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
						<strong>' . (Title) . '</strong></td>
					    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
						<strong>' . (link) . '</strong></td>
					    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
						<strong>' . (Target) . '</strong></td>
					    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
						<strong>' . (Order) . '</strong></td>
					    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
						<strong>&nbsp;</strong></td>
						<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
						<strong>&nbsp;</strong></td>
					  </tr>';

            for ($i = 0; $i < $TotalRecords; $i++) {
                $parent_id = $Rows['parent_id'];
                $text = subwords($Rows['text'], 0, 60);
                $href = subwords($Rows['href'], 0, 60);
                $title = subwords($Rows['title'], 0, 60);
                $icon = $Rows['icon'];
                $target = subwords($Rows['target'], 0, 60);
                $orderfield = $Rows['orderfield'];
                $expanded = $Rows['expanded'];
                $id = $Rows['id'];

                //if(HaveChids($id)){
                $Vars = array("todo", "subdo", "Menu");
                $Vals = array("layersmenu", "editMenu", $id);
                $EditMenu = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">' . (edit) . '</a>';
                $Vars = array("todo", "subdo", "Menu");
                $Vals = array("layersmenu", "delteMenu", $id);
                $DeleteMenu = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" onclick="return acceptDelFailed();" title="">' . (delete) . '</a>';
                $RootMenu .= '<tr onmouseover="this.style.background=\'url(admin/Themes/' . $ThemeName . '/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">
								    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $text . '</td>
								    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
									<img src="Themes/Default/Images/menuicons/' . $icon . '" alt="" />
									</td>
								    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $title . '</td>
								    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $href . '</td>
								    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $target . '</td>
								    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $orderfield . ' </td>
								    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $EditMenu . '</td>
									<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $DeleteMenu . '</td>
								  </tr>	';
                //}//end if
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
            $RootMenu .='</table>								
							<script language="javascript" type="text/javascript">
								function acceptDelFailed(){
									return confirm("' . (DouWanttoDeleteThisMenuAndAllSubMENU) . '");
								}
							</script>';
        } else {
            $RootMenu = (NoDataFound);
        }//end if
    } else {
        $RootMenu = '';
    }
    return $RootMenu;
}

//end function

function delteMenu() {
    global $conn, $TotalRecords, $Rows, $Recordset;
    if (isset($_GET['Menu'])) {
        $Menu = InputFilter($_GET['Menu']);

        //get all childs to deted langs
        ExcuteQuery("SELECT * FROM `pt_menu` where `parent_id`=" . $Menu . " ;");
        if ($TotalRecords > 0) {
            $id = $Rows['id'];
            mysqli_query($conn, "delete from `pt_menu_lang` where `id`='" . $id . "';");
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end if
        mysqli_query($conn, "delete from `pt_menu_lang` where `id`='" . $Menu . "';");
        mysqli_query($conn, "delete from `pt_menu` where `parent_id`='" . $Menu . "';");
        mysqli_query($conn, "delete from `pt_menu` where `id`='" . $Menu . "';");
        return (successDeleteMenu);
    } else {
        return '';
    }//end if
}

//end function

function RootMenu() {

    global $IdLang, $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $ThemeName;
    $RootMenu = '';


    ExcuteQuery("SELECT * FROM `pt_menu`,`pt_menu_lang` 
					where 
					`parent_id`=0 
					and `pt_menu`.`id`=`pt_menu_lang`.`id`
					and `IdLang`='" . $IdLang . "'
					order by `orderfield`;");
    if ($TotalRecords > 0) {
        $RootMenu = '<table border="0" cellspacing="2" cellpadding="2">
				  <tr  style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;" >
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Text) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Icon) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Title) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (link) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Target) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Order) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>&nbsp;</strong></td>
					<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>&nbsp;</strong></td>					
					<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>&nbsp;</strong></td>
				  </tr>';

        for ($i = 0; $i < $TotalRecords; $i++) {
            $parent_id = $Rows['parent_id'];
            $text = subwords($Rows['text'], 0, 60);
            $href = subwords($Rows['href'], 0, 60);
            $title = subwords($Rows['title'], 0, 60);
            $icon = $Rows['icon'];
            $target = subwords($Rows['target'], 0, 60);
            $orderfield = $Rows['orderfield'];
            $expanded = $Rows['expanded'];
            $id = $Rows['id'];
            $Vars = array("todo", "subdo", "Menu");
            $Vals = array("layersmenu", "editMenu", $id);
            $EditMenu = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">' . (edit) . '</a>';

            $Vars = array("todo", "subdo", "Menu");
            $Vals = array("layersmenu", "delteMenu", $id);
            $DeleteMenu = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" onclick="return acceptDelFailed();" title="">' . (delete) . '</a>';

            $Vars = array("todo", "subdo", "Menu");
            $Vals = array("layersmenu", "ChildsOfMenu", $id);
            $MenuChilds = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">' . (MenuChilds) . '</a>';

            $RootMenu .= '<tr   onmouseover="this.style.background=\'url(admin/Themes/' . $ThemeName . '/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">
						    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $text . '</td>
						    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
							<img src="Themes/' . $ThemeName . '/Images/menuicons/' . $icon . '" alt="" />
							</td>
						    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $title . '</td>
						    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $href . '</td>
						    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $target . '</td>
						    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $orderfield . ' </td>
						    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $EditMenu . '</td>
							<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $DeleteMenu . '</td>							
							<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $MenuChilds . '</td>
						  </tr>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $RootMenu .='</table>
					<script language="javascript" type="text/javascript">
						function acceptDelFailed(){
							return confirm("' . (DouWanttoDeleteThisMenuAndAllSubMENU) . '");
						}
					</script>';
    } else {
        return (NoDataFound);
    }//end if

    return $RootMenu;
}

//end function

function SubMenu() {
    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $ThemeName, $IdLang;
    $RootMenu = '';
    $FoundSubMenu = false;

    ExcuteQuery("SELECT * FROM `pt_menu` , `pt_menu_lang`
					where `parent_id`<>'0' 
					and `pt_menu`.`id`=`pt_menu_lang`.`id`
					and `pt_menu_lang`.`IdLang`='" . $IdLang . "'
					order by `parent_id`,`orderfield`;");

    if ($TotalRecords > 0) {
        $RootMenu = '<table border="0" cellspacing="2" cellpadding="2">
				  <tr style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Text) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Icon) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Title) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (link) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Target) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Order) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>&nbsp;</strong></td>
					<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>&nbsp;</strong></td>
				  </tr>';
        for ($i = 0; $i < $TotalRecords; $i++) {
            $parent_id = $Rows['parent_id'];
            $text = subwords($Rows['text'], 0, 60);
            $href = subwords($Rows['href'], 0, 60);
            $title = subwords($Rows['title'], 0, 60);
            $icon = $Rows['icon'];
            $target = subwords($Rows['target'], 0, 60);
            $orderfield = $Rows['orderfield'];
            $expanded = $Rows['expanded'];
            $id = $Rows['id'];

            if (HaveChids($id)) {
                $FoundSubMenu = true;
                $Vars = array("todo", "subdo", "Menu");
                $Vals = array("layersmenu", "editMenu", $id);
                $EditMenu = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">' . (edit) . '</a>';
                $Vars = array("todo", "subdo", "Menu");
                $Vals = array("layersmenu", "delteMenu", $id);
                $DeleteMenu = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" onclick="return acceptDelFailed();" title="">' . (delete) . '</a>';
                $Vars = array("todo", "subdo", "Menu");
                $Vals = array("layersmenu", "ChildsOfMenu", $id);
                $MenuChilds = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">' . (MenuChilds) . '</a>';

                $RootMenu .= '<tr  onmouseover="this.style.background=\'url(admin/Themes/' . $ThemeName . '/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">
							    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $text . '</td>
							    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
								<img src="Themes/Default/Images/menuicons/' . $icon . '" alt="" />
								</td>
							    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $title . '</td>
							    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $href . '</td>
							    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $target . '</td>
							    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $orderfield . ' </td>
							    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $EditMenu . '</td>
								 <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $DeleteMenu . '</td>
								<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                        . $MenuChilds . '</td>
							  </tr>';
            }//end if
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $RootMenu .='</table>
					<script language="javascript" type="text/javascript">
						function acceptDelFailed(){
							return confirm("' . (DouWanttoDeleteThisMenuAndAllSubMENU) . '");
						}
					</script>';
    }//end if
    if ($FoundSubMenu) {
        return $RootMenu;
    } else {
        return (NoDataFound);
    }//end if
}

//end function

function AllElemnts() {

    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $ThemeName, $IdLang;
    $RootMenu = '';
    ExcuteQuery("SELECT * FROM `pt_menu` ,`pt_menu_lang`
					where  `pt_menu`.`id`=`pt_menu_lang`.`id`
					and `pt_menu_lang`.`IdLang`='" . $IdLang . "'
					order by `parent_id`,`orderfield`;");
    if ($TotalRecords > 0) {
        $RootMenu = '<table border="0" cellspacing="2" cellpadding="2">
				  <tr style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;" >
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Text) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Icon) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Title) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (link) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Target) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . (Order) . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>&nbsp;</strong></td>
					<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>&nbsp;</strong></td>
				  </tr>';

        for ($i = 0; $i < $TotalRecords; $i++) {
            $parent_id = $Rows['parent_id'];
            $text = subwords($Rows['text'], 0, 60);
            $href = subwords($Rows['href'], 0, 60);
            $title = subwords($Rows['title'], 0, 60);
            $icon = $Rows['icon'];
            $target = subwords($Rows['target'], 0, 60);
            $orderfield = $Rows['orderfield'];
            $expanded = $Rows['expanded'];
            $id = $Rows['id'];

            //if(HaveChids($id)){
            $Vars = array("todo", "subdo", "Menu");
            $Vals = array("layersmenu", "editMenu", $id);
            $EditMenu = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">' . (edit) . '</a>';
            $Vars = array("todo", "subdo", "Menu");
            $Vals = array("layersmenu", "delteMenu", $id);
            $DeleteMenu = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" onclick="return acceptDelFailed();" title="">' . (delete) . '</a>';
            $RootMenu .= '<tr onmouseover="this.style.background=\'url(admin/Themes/' . $ThemeName . '/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">
							    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $text . '</td>
							    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
								<img src="Themes/Default/Images/menuicons/' . $icon . '" alt="" />
								</td>
							    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $title . '</td>
							    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $href . '</td>
							    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $target . '</td>
							    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $orderfield . ' </td>
							    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $EditMenu . '</td>
								<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $DeleteMenu . '</td>
							  </tr>	';
            //}//end if
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $RootMenu .='</table>								
						<script language="javascript" type="text/javascript">
							function acceptDelFailed(){
								return confirm("' . (DouWanttoDeleteThisMenuAndAllSubMENU) . '");
							}
						</script>';
    } else {
        return (NoDataFound);
    }//end if

    return $RootMenu;
}

//end function

function SaveNewElement() {

    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $DefaultLang;
    $parent_id = PostFilter($_POST['SubMenuSelect']);
    ExcuteQuery("SELECT MAX(`id`)AS MenuID,MAX(`orderfield`) AS orderfield FROM `pt_menu`;");
    $id = $Rows['MenuID'] + 10;
    $orderfield = $Rows['orderfield'] + 10;

    $icon = PostFilter($_POST['iconval']);

    $db = new db();
    $default_lang_id = $db->get_var(" select `IdLang` from `languages` where `LangName`='" . $DefaultLang . "'; ");

    $text = PostFilter($_POST['textval' . $default_lang_id]);
    $title = PostFilter($_POST['titleval' . $default_lang_id]);
    $href = PostFilter($_POST['hrefval']);
    $target = PostFilter($_POST['targetval']);

    //save main table menu
    mysqli_query($conn, "INSERT INTO `pt_menu` ( `id` , `parent_id`  , `href` , `icon` , `target` , `orderfield` , `expanded` )
			VALUES ('" . $id . "', '" . $parent_id . "', '" . $href . "', '" . $icon . "', '" . $target . "', '" . $orderfield . "', '0');");
    //save languages table menu
    ExcuteQuery("SELECT * FROM `languages` where `Deleted`!='1';");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $IdLang = $Rows['IdLang'];
            $text = PostFilter($_POST['textval' . $IdLang]);
            $title = PostFilter($_POST['titleval' . $IdLang]);
            mysqli_query($conn, "INSERT INTO `pt_menu_lang` (`IdLang`, `id`, `text`, `title`) 
						VALUES ('" . $IdLang . "', '" . $id . "', '" . $text . "', '" . $title . "');");
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//end if
    return (SuccessSaveNewElement);
}

//end function

function AddMenu() {

    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $ThemeName;
    $AddMenu = '<form name="formNewForm" id="formNewForm" method="post" action="" >
		      <input checked="1" type="radio" name="RadioMenu" id="RadioMenu" value="RootMenu"> 
		    ' . RootMenu . '  <br/>
		      <input type="radio" name="RadioMenu" id="RadioMenu" value="SubMenu">
		      ' . SubMenu . ' : ' . AllSubMenuSelect() . '  <br/>
		    <table border="0" cellspacing="2" cellpadding="2">
		    <tr>
		      <td>' . (icon) . ' :</td>
		      <td>
			  <!-- <input class="text" name="iconval" type="text" id="iconval" /> -->
			  	<select class="select"  onchange="changePic();" name="iconval" id="iconval">';

    $d = dir("Themes/Default/Images/menuicons/");
    while (false !== ($entry = $d->read())) {
        if ($entry != "." and $entry != ".." and is_file($d->path . $entry)) {
            if (strpos(strtolower($entry), ".jpg") or strpos(strtolower($entry), ".gif") or strpos(strtolower($entry), ".png")) {
                if ($entry == 'none.gif') {
                    $selected = ' selected="selected "';
                } else {
                    $selected = '';
                }
                $AddMenu .= '<option ' . $selected . ' value="' . $entry . '">' . $entry . '</option>';
                //$LastPic = $entry;
            }
        }
    }
    $d->close();
    //echo 'entry '. $entry;
    $AddMenu .= '</select>
						  <span id="IconPic"><img src="Themes/Default/Images/menuicons/none.gif" alt="none"/></span>
							  
			  </td>
		    </tr>';
    ExcuteQuery("SELECT * FROM `languages` where `Deleted`!='1';");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $IdLang = $Rows['IdLang'];
            $LangName = $Rows['LangName'];
            $AddMenu .= '<tr>
					      <td>' . Text . ' ' . $LangName . ' : </td>
					      <td><input class="text" name="textval' . $IdLang . '" type="text" id="textval" /></td>
					    </tr>
					    <tr>
					      <td>' . Title . ' ' . $LangName . ' : </td>
					      <td><input class="text" name="titleval' . $IdLang . '" type="text" id="titleval" /><p></p></td>
					    </tr>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $AddMenu .= '<tr>
			      <td>' . (Link) . ' : </td>
			      <td><input class="text" dir="ltr" name="hrefval" type="text" id="hrefval" /></td>
			    </tr>
			    <tr>
			      <td>' . (Target) . ' : </td>
			      <td><input class="text" dir="ltr" name="targetval" type="text" id="targetval" /></td>
			    </tr>
				  </table>
				<br/>
				    <input class="submit" type="submit" name="SaveNewMenu" id="SaveNewMenu" value="' . (save) . '">
				<br/>
				</form>
								<script language="javascript" type="text/javascript">

							function changePic(){
								
								document.getElementById("IconPic").innerHTML= \'<img src="Themes/Default/Images/menuicons/\'+document.getElementById(\'iconval\').value+\'"/>\'; 
							}
				</script>';
    }//end if
    return $AddMenu;
}

//END Function

function SaveNewMenu() {

    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $DefaultLang;
    if ($_POST['RadioMenu'] == 'RootMenu') {
        //RootMenu
        $parent_id = '0';
    } else {
        //SubMenu
        $parent_id = PostFilter($_POST['SubMenuSelect']);
    }//end if
    ExcuteQuery("SELECT MAX(`id`)AS MenuID,MAX(`orderfield`) AS orderfield FROM `pt_menu`;");
    $id = $Rows['MenuID'] + 10;
    $orderfield = $Rows['orderfield'] + 10;
    $icon = PostFilter($_POST['iconval']);
    $db = new db();
    $default_lang_id = $db->get_var(" select `IdLang` from `languages` where `LangName`='" . $DefaultLang . "'; ");

    $text = PostFilter($_POST['textval' . $default_lang_id]);
    $title = PostFilter($_POST['titleval' . $default_lang_id]);
    $href = PostFilter($_POST['hrefval']);
    $target = PostFilter($_POST['targetval']);

    //save main table menu
    mysqli_query($conn, "INSERT INTO `pt_menu` ( `id` , `parent_id` , `href`  , `icon` , `target` , `orderfield` , `expanded` )
                    VALUES ('" . $id . "', '" . $parent_id . "', '" . $href . "', '" . $icon . "', '" . $target . "', '" . $orderfield . "', '0');");
    //save languages table menu
    ExcuteQuery("SELECT * FROM `languages` where `Deleted`!='1' ;");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $IdLang = $Rows['IdLang'];
            $text = PostFilter($_POST['textval' . $IdLang]);
            $title = PostFilter($_POST['titleval' . $IdLang]);
            mysqli_query($conn, "INSERT INTO `pt_menu_lang` (`IdLang`, `id`, `text`, `title`) 
						VALUES ('" . $IdLang . "', '" . $id . "', '" . $text . "', '" . $title . "');");
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//end if
    return (SuccessSaveNewMenu);
}

//end function

function SaveMenu() {

    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $DefaultLang;
    $IDMenu = InputFilter($_GET['Menu']);
    $iconval = PostFilter($_POST['iconval']);

    $db = new db();
    $default_lang_id = $db->get_var(" select `IdLang` from `languages` where `LangName`='" . $DefaultLang . "'; ");

    $textval = PostFilter($_POST['textval' . $default_lang_id]);
    $titleval = PostFilter($_POST['titleval' . $default_lang_id]);

    $hrefval = PostFilter($_POST['hrefval']);
    $targetval = PostFilter($_POST['targetval']);
    $orderfield = PostFilter($_POST['orderfield']);
    
 ExcuteQuery("SELECT MAX(`id`)AS MenuID,MAX(`orderfield`) AS orderfield FROM `pt_menu`;");
    $id = $Rows['MenuID'] + 10;

    mysqli_query($conn, " delete from `pt_menu` where `id`='" . $IDMenu . "' ; ");
    
    mysqli_query($conn, " INSERT INTO `pt_menu` (`id`, `parent_id`, `href`, `icon`, `target`, `orderfield`, `expanded`) "
            . "VALUES ('" . $id . "', '0', '" . $hrefval . "',"
            . " '" . $iconval . "', '" . $targetval . "', '" . $orderfield . "', '');  ");

    //update Language menu table
    ExcuteQuery("SELECT * FROM `languages` where `Deleted`!='1' ;");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $IdLang = $Rows['IdLang'];
            $text = PostFilter($_POST['textval' . $IdLang]);
            $title = PostFilter($_POST['titleval' . $IdLang]);

            mysqli_query($conn, " delete from `pt_menu_lang` where `id`='" . $IDMenu . "' ; ");

            mysqli_query($conn, " INSERT INTO `pt_menu_lang` (`IdLang`, `id`, `text`, `title`) 
			VALUES ('" . $IdLang . "', '" . $id . "', '" . $text . "', '" . $title . "');");

            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//end if

    return (MenuHasBeenSaved) . "<br/>";
}

//end function

function editMenu() {

    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn;
    $Menu = '';
    $IdMenu = InputFilter($_GET['Menu']);
    ExcuteQuery("SELECT * FROM `pt_menu` as m,pt_menu_lang as ml where m.id = ml.id and m.`id`='" . $IdMenu . "' order by m.`orderfield`;");
    if ($TotalRecords > 0) {
        $parent_id = $Rows['parent_id'];
        $text = $Rows['text'];
        $title = $Rows['title'];
        $href = $Rows['href'];
        $icon = $Rows['icon'];
        $target = $Rows['target'];
        $orderfield = $Rows['orderfield'];
        $expanded = $Rows['expanded'];
        $id = $Rows['id'];
        $q = "SELECT * FROM `languages` where `Deleted` != '1';";
        $rs = mysqli_query($conn, $q);
        $Totals = mysqli_num_rows($rs);
        if ($Totals > 0) {
            $Menu = '<form name="formEditMenu" method="post" action="">
						  <table border="0" cellspacing="2" cellpadding="2">
						    <tr>
						      <td>' . (icon) . ' :</td>
						      <td>
							  	 <select class="select"  onchange="changePic();" name="iconval" id="iconval">';

            $d = dir("Themes/Default/Images/menuicons/");
            while (false !== ($entry = $d->read())) {
                if ($entry != "." and $entry != ".." and is_file($d->path . $entry)) {
                    if (strpos(strtolower($entry), ".jpg") or strpos(strtolower($entry), ".gif") or strpos(strtolower($entry), ".png")) {
                        if ($icon == $entry) {
                            $Menu .= '<option selected="selected" value="' . $entry . '">' . $entry . '</option>';
                        } else {
                            $Menu .= '<option value="' . $entry . '">' . $entry . '</option>';
                        }//end if



                        $LastPic = $entry;
                    }
                }
            }
            $d->close();
            //echo 'entry '. $entry;
            $Menu .= '</select>
			<span id="IconPic"><img src="Themes/Default/Images/menuicons/' . $LastPic . '" alt="' . $LastPic . '"/></span>			  
			</td>
		</tr>';

            for ($i = 0; $i < $Totals; $i++) {
                $data = mysqli_fetch_assoc($rs);
                // var_dump($data);
                $IdLang = $data['IdLang'];
                $LangName = $data['LangName'];
                $IdLangQ = "SELECT * FROM `pt_menu_lang` WHERE `IdLang`='" . $IdLang . "' AND `id`='" . $id . "' ;";
                $IdLangrs = mysqli_query($conn, $IdLangQ);
                $IdLangRows = mysqli_fetch_assoc($IdLangrs);
                $text = $IdLangRows['text'];
                $title = $IdLangRows['title'];
                //$Menu =  $data['IdLang'];
                $Menu .= '<tr>
				<td> ' . Text . ' ' . $LangName . ' : </td>
				<td><input class="text" name="textval' . $IdLang . '" type="text" id="textval" value="' . $text . '" /></td>
			</tr>
			<tr>
			<td>' . Title . ' ' . $LangName . ' : </td>
			<td><input class="text" name="titleval' . $IdLang . '" type="text" id="titleval" value="' . $title . '" /><p></p>
			</td>
			</tr>';
            }//end for
            $Menu .='<tr>
			<td>' . (Link) . ' : </td>
			<td><input class="text" dir="ltr" name="hrefval" type="text" id="hrefval" value="' . $href . '" /></td>
			</tr>
					    <tr>
					      <td>' . (Target) . ' : </td>
					      <td><input class="text" dir="ltr" name="targetval" type="text" id="targetval" value="' . $target . '" /></td>
					    </tr>
					    <tr>
					      <td>' . (OrderFromLeft) . ' : </td>
					      <td>' . SelectOrderMenu($parent_id) . '</td>
					    </tr>
					  </table>
					<br/>
					    <input class="submit" type="submit" name="SaveMenu" id="SaveMenu" value="' . (save) . '">
					<br/>
					</form>				
				<script language="javascript" type="text/javascript">

							function changePic(){
								
								document.getElementById("IconPic").innerHTML= \'<img src="Themes/Default/Images/menuicons/\'+document.getElementById(\'iconval\').value+\'"/>\'; 
							}
				</script>
					<br/>';
        }//end if
    }//end if	

    return $Menu;
}

//end function

function AddElemnts() {
    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $ThemeName;

    $AddElemnts = '<form name="formNewForm" id="formNewForm" method="post" action="" >
		      ' . AddElemnts . ' : ' . AllMenuSelect() . '  <br/>
		    <table border="0" cellspacing="2" cellpadding="2">
		    <tr>
		      <td>' . (icon) . ' :</td>
		      <td>
			  
			  <!-- <input class="text" name="iconval" type="text" id="iconval" /> -->
			 <select class="select"  onchange="changePic();" name="iconval" id="iconval">';

    $d = dir("Themes/Default/Images/menuicons/");
    while (false !== ($entry = $d->read())) {
        if ($entry != "." and $entry != ".." and is_file($d->path . $entry)) {
            if (strpos(strtolower($entry), ".jpg") or strpos(strtolower($entry), ".gif") or strpos(strtolower($entry), ".png")) {
                if ($entry == 'none.gif') {
                    $selected = ' selected="selected "';
                } else {
                    $selected = '';
                }
                $AddElemnts .= '<option ' . $selected . '  value="' . $entry . '">' . $entry . '</option>';
                //$LastPic = $entry;
            }
        }
    }
    $d->close();
    //echo 'entry '. $entry;
    $AddElemnts .= '</select>
						  <span id="IconPic"><img src="Themes/Default/Images/menuicons/none.gif" alt="none"/></span>
			  
			  </td>
		    </tr>';
    ExcuteQuery("SELECT * FROM `languages` where `Deleted`!='1';");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $IdLang = $Rows['IdLang'];
            $LangName = $Rows['LangName'];
            $AddElemnts .= '<tr>
				<td>' . Text . ' ' . $LangName . ' : </td>
				<td><input class="text" name="textval' . $IdLang . '" type="text" id="textval" /></td>
				</tr>
				<tr>
				<td>' . Title . ' ' . $LangName . ' : </td>
				<td><input class="text" name="titleval' . $IdLang . '" type="text" id="titleval" /><p></p></td>
			</tr>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $AddElemnts .= '<tr>
			      <td>' . (Link) . ' : </td>
			      <td><input class="text" dir="ltr" name="hrefval" type="text" id="hrefval" /></td>
			    </tr>
			    <tr>
			      <td>' . (Target) . ' : </td>
			      <td><input class="text" dir="ltr" name="targetval" type="text" id="targetval" /></td>
			    </tr>
				  </table>
				<br/>
				    <input class="submit" type="submit" name="SaveNewElement" id="SaveNewElement" value="' . (save) . '">
				<br/>
				</form>						
				<script language="javascript" type="text/javascript">

							function changePic(){
								
								document.getElementById("IconPic").innerHTML= \'<img src="Themes/Default/Images/menuicons/\'+document.getElementById(\'iconval\').value+\'"/>\'; 
							}
				</script>';
    }//end if
    return $AddElemnts;
}

//end function

function SelectOrderMenu($IdMenu) {
    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn;
    $SelectOrderMenu = '';
    ExcuteQuery("SELECT  MIN(`orderfield`) AS `MinOrder`, COUNT(`orderfield`) AS `Countfield`  FROM `pt_menu` where `parent_id`='" . $IdMenu . "';");
    if ($TotalRecords > 0) {
        $SelectOrderMenu = '<select class="select" name="orderfield">';
        $MinOrder = $Rows['MinOrder'];
        $Countfield = $Rows['Countfield'];
        $Value = $MinOrder;
        for ($i = 0; $i < $Countfield; $i++) {
            $Order = $i + 1;
            $SelectOrderMenu .= '<option value="' . $Value . '">' . $Order . '</option>';
            $Value = $Value + 10;
            //$Rows = mysqli_fetch_assoc($Recordset);
        }//end if
        $SelectOrderMenu .= '</select>';
    }//end if
    return $SelectOrderMenu;
}

//end function

function AllMenuSelect() {

    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $IdLang;
    ExcuteQuery("SELECT * FROM `pt_menu`,`pt_menu_lang` where `pt_menu`.`id`=`pt_menu_lang`.`id` and `pt_menu_lang`.`IdLang`='" . $IdLang . "' order by `orderfield`;");
    if ($TotalRecords > 0) {
        $AllSubMenuSelect = '<select class="select" name="SubMenuSelect" id="SubMenuSelect" onclick="document.formNewForm.RadioMenu[1].checked = 1;">';
        for ($i = 0; $i < $TotalRecords; $i++) {
            $parent_id = $Rows['parent_id'];
            $text = $Rows['text'];
            $title = $Rows['title'];
            $href = $Rows['href'];
            $icon = $Rows['icon'];
            $target = $Rows['target'];
            $orderfield = $Rows['orderfield'];
            $expanded = $Rows['expanded'];
            $id = $Rows['id'];
            //if(!HaveChids($id)){
            $AllSubMenuSelect .='<option value="' . $id . '">' . $text . '</option>';
            //}//end if
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $AllSubMenuSelect .='</select>';
    } else {
        $AllSubMenuSelect = '';
    }//end if
    return $AllSubMenuSelect;
}

//end function

function AllSubMenuSelect() {

    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $IdLang;
    ExcuteQuery("SELECT * FROM `pt_menu` ,`pt_menu_lang` 
                        where `pt_menu`.`id`=`pt_menu_lang`.`id` and `pt_menu_lang`.`IdLang`='" . $IdLang . "' order by `orderfield`;");
    if ($TotalRecords > 0) {
        $AllSubMenuSelect = '<select class="select" name="SubMenuSelect" id="SubMenuSelect" onclick="document.formNewForm.RadioMenu[1].checked = 1;">';
        for ($i = 0; $i < $TotalRecords; $i++) {
            $parent_id = $Rows['parent_id'];
            $text = $Rows['text'];
            $title = $Rows['title'];
            $href = $Rows['href'];
            $icon = $Rows['icon'];
            $target = $Rows['target'];
            $orderfield = $Rows['orderfield'];
            $expanded = $Rows['expanded'];
            $id = $Rows['id'];
            if (!HaveChids($id)) {
                $AllSubMenuSelect .='<option value="' . $id . '">' . $text . '</option>';
            }//end if
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $AllSubMenuSelect .='</select>';
    } else {
        $AllSubMenuSelect = '';
    }//end if
    return $AllSubMenuSelect;
}

//end function

function HaveChids($IdMenu) {

    global $conn;
    $query = "SELECT * FROM `pt_menu` WHERE `parent_id`='" . $IdMenu . "';";
    $Recordset = mysqli_query($conn, $query);
    $TotalRecords = mysqli_num_rows($Recordset);
    $Rows = mysqli_fetch_assoc($Recordset);
    if ($TotalRecords > 0) {
        return true;
    } else {
        return false;
    }//end if
}

//end function
?>