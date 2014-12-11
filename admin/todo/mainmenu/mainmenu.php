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

global $ThemeName;
$theList = SubIconLink("mainmenu", "BrowseMenu") . "<br/>";
$theList .= SubIconLink("mainmenu", "AddElement") . "<br/>";

if (isset($_GET['subdo'])) {
    switch ($_GET['subdo']) {
        case "BrowseMenu":
            $theContent = BrowseMenu();
            break;
        case "AddElement":
            $theContent = AddElement();
            break;
        case "EditElement":
            $theContent = EditElement();
            break;
        case "DeleteElement":
            $theContent = DeleteElement();
            break;
        default :
    }//end switch
} else {
    $theContent = BrowseMenu();
}//end if	

if (isset($_POST['SubmitSaveEditmainMenu'])) {
    $theContent = SaveElement();
}//end if

if (isset($_POST['SubmitSaveNewEditmainMenu'])) {
    $theContent = SaveNewElement();
}//end if

$mainmenu = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$mainmenu = VarTheme("{todoImg}", "MainMenu.png", $mainmenu);
$mainmenu = VarTheme("{ThemeName}", $ThemeName, $mainmenu);
$mainmenu = VarTheme("{List}", $theList, $mainmenu);
$mainmenu = VarTheme("{Content}", $theContent, $mainmenu);

function DeleteElement() {

    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang;
    $IdMM = InputFilter($_GET['Element']);
    //delete main table info
    mysqli_query($conn, "delete from `mainmenu` where `IdMM`='" . $IdMM . "';");
    //delete lang table info
    mysqli_query($conn, "delete from `menlang` where `IdMM`='" . $IdMM . "';");
    return SuccessDeleteManinMenuElement;
}

//end function

function SaveNewElement() {

    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang;
    // save main table info
    $IdMM = GenerateID('mainmenu', 'IdMM');
    $Link = PostFilter($_POST['Link']);
    $Target = PostFilter($_POST['Target']);
    ExcuteQuery("SELECT MAX(`Order`) AS Morder FROM `mainmenu`;");
    $Order = $Rows['Morder'] + 1;
    $External = PostFilter($_POST['External']);
    mysqli_query($conn, "insert into `mainmenu` (`IdMM`,`Link`,`Target`,`Order`,`External` ) values(
				'" . $IdMM . "','" . $Link . "','" . $Target . "', '" . $Order . "','" . $External . "');");
    //save lang table info
    $q = "SELECT * from `languages`  where `Deleted`<>'1' ;";
    $Rs = mysqli_query($conn, $q);
    $Totals = mysqli_num_rows($Rs);
    $data = mysqli_fetch_assoc($Rs);
    for ($j = 0; $j < $Totals; $j++) {
        $IdLang = $data['IdLang'];
        $LangName = $data['LangName'];
        $TitleElement = PostFilter($_POST['TitleElement' . $IdLang]);
        mysqli_query($conn, "insert into `menlang` (`IdLang`,`idMM`,`TitleElement`)
					values('" . $IdLang . "','" . $IdMM . "','" . $TitleElement . "')");

        $data = mysqli_fetch_assoc($Rs);
    }//End for
    return (ElementSuccessSaved);
}

//end function

function SaveElement() {
    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang;

    // save main table info
    $IdMM = InputFilter($_GET['Element']);
    $Link = PostFilter($_POST['Link']);
    $Target = PostFilter($_POST['Target']);
    $Order = PostFilter($_POST['Order']);
    $External = PostFilter($_POST['External']);


    mysqli_query($conn, "UPDATE `mainmenu`
				SET `Link` = '" . $Link . "',
				`Target` = '" . $Target . "',
				`Order` = '" . $Order . "',
				`External` = '" . $External . "'
				WHERE `IdMM`='" . $IdMM . "'");
    mysqli_query($conn, "delete from `menlang` WHERE `IdMM`='" . $IdMM . "'");

    //save lang table info
    $q = "SELECT * from `languages`  where `Deleted`<>'1' ;";
    $Rs = mysqli_query($conn, $q);
    $Totals = mysqli_num_rows($Rs);
    $data = mysqli_fetch_assoc($Rs);
    for ($j = 0; $j < $Totals; $j++) {
        $IdLang = $data['IdLang'];
        $LangName = $data['LangName'];
        $TitleElement = PostFilter($_POST['TitleElement' . $IdLang]);
        mysqli_query($conn, "UPDATE `menlang`
					SET `TitleElement` = '" . $TitleElement . "'
					where `idMM`='" . $IdMM . "'
					and `IdLang`='" . $IdLang . "';");
        $data = mysqli_fetch_assoc($Rs);
    }//End for
    //save lang table info
    $q = "SELECT * from `languages`  where `Deleted`<>'1' ;";
    $Rs = mysqli_query($conn, $q);
    $Totals = mysqli_num_rows($Rs);
    $data = mysqli_fetch_assoc($Rs);
    for ($j = 0; $j < $Totals; $j++) {
        $IdLang = $data['IdLang'];
        $LangName = $data['LangName'];
        $TitleElement = PostFilter($_POST['TitleElement' . $IdLang]);
        mysqli_query($conn, "insert into `menlang` (`idMM` ,`IdLang` ,`TitleElement`) values('" . $IdMM . "','" . $IdLang . "','" . $TitleElement . "');");
        $data = mysqli_fetch_assoc($Rs);
    }//End for

    /* Bug solution : when we add new lang pt update only the old inserted rows
      mysqli_query($conn,"UPDATE `mainmenu`
      SET `Link` = '".$Link."',
      `Target` = '".$Target."',
      `Order` = '".$Order."',
      `External` = '".$External."'
      WHERE `IdMM`='".$IdMM."'");
      //save lang table info
      $q = "SELECT * from `languages`  where `Deleted`<>'1' ;";
      $Rs = mysqli_query( $conn,$q)  ;
      $Totals = mysqli_num_rows($Rs);
      $data = mysqli_fetch_assoc($Rs);
      for($j=0;$j<$Totals;$j++) {
      $IdLang   	  = $data['IdLang'];
      $LangName 	  = $data['LangName'];
      $TitleElement = PostFilter($_POST['TitleElement'.$IdLang]);
      mysqli_query($conn,"UPDATE `menlang`
      SET `TitleElement` = '".$TitleElement."'
      where `idMM`='".$IdMM ."'
      and `IdLang`='".$IdLang ."';");
      $data = mysqli_fetch_assoc($Rs);
      }//End for
     */
    return (ElementSuccessSaved);
}

//end function 

function AddElement() {
    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang, $CustomHead;
    $CustomHead .= '<script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
                        <link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
                        <script language="javascript" type="text/javascript">
                            document.onkeydown = document.onkeypress = function (evt) {
                                if (!evt && window.event) {
                                    evt = window.event;
                                }
                                var keyCode = evt.keyCode ? evt.keyCode :
                                    evt.charCode ? evt.charCode : evt.which;
                                if (keyCode) {
                                    if (evt.ctrlKey) {
                                        if(keyCode==83){
                                            document.getElementById("SubmitSaveNewEditmainMenu").click();
                                            return false;
                                        }
                                        return false;
                                    }
                                }
                                return true;
                            }
                        </script>
                        ';
    $AddElement = '<form name="formEditElementMenu" method="post" action="">
					  <table border="0" cellspacing="2" cellpadding="2">
					    <tr>
					      <td>' . (Link) . '</td>
					      <td>
					        <input class="text" value="" dir="ltr" type="text" name="Link" id="Link" maxlength="256">
					     </td>
					    </tr>
					    <tr>
					      <td>' . (Target) . '</td>
						      <td>
						        <input class="text" value="" dir="ltr" type="text" name="Target" id="Target" maxlength="256">
						      </td>
						    </tr>
						    </tr>
						    <tr>
						      <td>' . (External) . '</td>
						      <td>
							  <select class="select" name="External" id="External">
									<option  value="1">' . (yes) . '</option>
									<option selected="selected" value="0">' . (no) . '</option>
							  </select>
							  </td>
						    </tr>';

    $q = "SELECT * from `languages` where `Deleted`<>'1' ;";
    $Rs = mysqli_query($conn, $q);
    $Totals = mysqli_num_rows($Rs);
    $data = mysqli_fetch_assoc($Rs);
    $spray = '';
    for ($j = 0; $j < $Totals; $j++) {
        $IdLang = $data['IdLang'];
        $LangName = $data['LangName'];
        $AddElement .= '<tr>
                            <td>' . (TitleElement) . ' ' . $LangName . '</td>
                             <td> <span id="sprytextfield' . $j . '"><input class="text" value="" dir="ltr" type="text" name="TitleElement' . $IdLang . '" id="Link" maxlength="35">
                                 <span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span></td>
                        </tr>';
        //$Rows = mysqli_fetch_assoc($Recordset);
        $data = mysqli_fetch_assoc($Rs);
        $spray .= 'var sprytextfield' . $j . ' = new Spry.Widget.ValidationTextField("sprytextfield' . $j . '"); ';
    }//end for
    return $AddElement . '</table>
                            <input class="submit" type="submit" name="SubmitSaveNewEditmainMenu" id="SubmitSaveNewEditmainMenu" value="'
            . (save) . '"></form>


<script type="text/javascript">
<!--
' . $spray . '
//-->
</script>
        ';
}

//end function

function EditElement() {
    global $CustomHead, $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang;

    $CustomHead .= '<script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
                        <link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
                        <script language="javascript" type="text/javascript">
                            document.onkeydown = document.onkeypress = function (evt) {
                                if (!evt && window.event) {
                                    evt = window.event;
                                }
                                var keyCode = evt.keyCode ? evt.keyCode :
                                    evt.charCode ? evt.charCode : evt.which;
                                if (keyCode) {
                                    if (evt.ctrlKey) {
                                        if(keyCode==83){
                                            document.getElementById("SubmitSaveEditmainMenu").click();
                                            return false;
                                        }
                                        return false;
                                    }
                                }
                                return true;
                            }
                        </script>
                        ';

    $IdMM = InputFilter($_GET['Element']);
    ExcuteQuery("SELECT `Link`,`Target`,`Order`,`External` FROM `mainmenu` Where `IdMM`='" . $IdMM . "' ;");
    if ($TotalRecords > 0) {
        $Link = $Rows['Link'];
        $Target = $Rows['Target'];
        $Order = $Rows['Order'];
        $External = $Rows['External'];
        $Order = elementOrder($Order);

        if ($External == "1") {
            $External = '<select class="select"  name="External" id="External">
						    <option selected="selected" value="1">' . (yes) . '</option>
						    <option value="0">' . (no) . '</option>
					    </select>';
        } else {
            $External = '<select class="select" name="External" id="External">
						    <option  value="1">' . (yes) . '</option>
						    <option selected="selected" value="0">' . (no) . '</option>
					    </select>';
        }//end if

        $EditElement = '<form name="formEditElementMenu" method="post" action="">
						  <table border="0" cellspacing="1" cellpadding="0">
						    <tr>
						      <td>' . (Link) . '</td>
						      <td>
						        <input class="text" value="' . $Link . '" dir="ltr" type="text" name="Link" id="Link" maxlength="256">
						     </td>
						    </tr>
						    <tr>
						      <td>' . (Target) . '</td>
						      <td>
						        <input class="text" value="' . $Target . '" dir="ltr" type="text" name="Target" id="Target" maxlength="256">
						      </td>
						    </tr>
						    <tr>
						      <td>' . (Order) . '</td>
						      <td>
						        ' . $Order . '
						      </td>
						    </tr>
						    <tr>
						      <td>' . (External) . '</td>
						      <td>' . $External . '</td>
						    </tr>';

        $q = "SELECT * from `languages` where `Deleted`<>'1' ;";
        $Rs = mysqli_query($conn, $q);
        $Totals = mysqli_num_rows($Rs);
        $data = mysqli_fetch_assoc($Rs);
        $spray = '';
        for ($j = 0; $j < $Totals; $j++) {
            $IdLang = $data['IdLang'];
            $LangName = $data['LangName'];
            ExcuteQuery("SELECT `TitleElement` FROM `menlang` WHERE `idMM`='" . $IdMM . "' AND `IdLang`='" . $IdLang . "' ;");

            //for($i=0;$i<$TotalRecords;$i++) {
            $TitleElement = $Rows['TitleElement'];
            //echo $TitleElement;
            $EditElement .= '<tr>
                                            <td>' . (TitleElement) . ' ' . $LangName . '</td>
                                             <td> <span id="sprytextfield' . $j . '">
                                                 <input class="text" value="' . $TitleElement . '" dir="ltr" type="text" name="TitleElement' . $IdLang . '" id="Link" maxlength="35">
                                                     <span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span>
                                             </td>
                                    </tr>';
            $Rows = mysqli_fetch_assoc($Recordset);
            $spray .= 'var sprytextfield' . $j . ' = new Spry.Widget.ValidationTextField("sprytextfield' . $j . '"); ';
            //}//end for



            $data = mysqli_fetch_assoc($Rs);
        }//end for
    }//en if
    return $EditElement . '</table>
			<input class="submit" type="submit" name="SubmitSaveEditmainMenu" id="SubmitSaveEditmainMenu" value="'
            . (save) . '"></form>
                <script type="text/javascript">
                <!--
                ' . $spray . '
                //-->
                </script>';
}

//end function

function BrowseMenu() {
    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang;
    ExcuteQuery("SELECT `IdLang` from `languages` where `LangName`='" . $Lang . "';");
    $IdLang = $Rows['IdLang'];
    $BrowseMenu = '';
    ExcuteQuery("SELECT * FROM `mainmenu` ,`menlang`
				WHERE `mainmenu`.`idMM`  = `menlang`.`idMM` 
                                and `menlang`.`IdLang` ='" . $IdLang . "'
                                    order by `Order` asc;");
    if ($TotalRecords > 0) {

        $BrowseMenu = '<table border="0" cellspacing="2" cellpadding="2">
				  <tr style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;" >
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . TitleElement . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . Link . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . Target . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . External . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>' . Order . '</strong></td>
				    <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>&nbsp;</strong></td>
					<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">
					<strong>&nbsp;</strong></td>
				  </tr>';
        for ($i = 0; $i < $TotalRecords; $i++) {
            $idMM = $Rows['idMM'];
            $Link = substr($Rows['Link'], -100);
            $Target = subwords($Rows['Target'], 0, 50);
            $Order = $Rows['Order'];
            $TitleElement = $Rows['TitleElement']; //substr($Rows['TitleElement'],0,20);
            $External = $Rows['External'];

            if ($External == 0) {
                $External = (no);
            } else {
                $External = (yes);
            }//end if
            $Vars = array("todo", "subdo", "Element");
            $Vals = array("mainmenu", "EditElement", $idMM);
            $EditMenu = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">' . (edit) . '</a>';
            $Vars = array("todo", "subdo", "Element");
            $Vals = array("mainmenu", "DeleteElement", $idMM);
            $DeleteMenu = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" onclick="return acceptDelFailed();" title="">' . (delete) . '</a>';

            $BrowseMenu .= '<tr   onmouseover="this.style.background=\'url(admin/Themes/Default/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">
						<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $TitleElement . '</td>
						   <td dir="ltr" style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $Link . '</td>
						 <td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $Target . '&nbsp;</td>
						<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $External . '</td>
						<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $Order . ' </td>
						<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $EditMenu . '</td>
						<td style="border-bottom:dotted; border-bottom-width:thin;border-left:dotted; border-left-width:thin;">'
                    . $DeleteMenu . '</td>
						</tr>';

            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $BrowseMenu .='</table>
					<script language="javascript" type="text/javascript">
						function acceptDelFailed(){
							return confirm("' . (DouWanttoDeleteThisMenuElement) . '");
						}
					</script>';
    }//end if

    return $BrowseMenu;
}

//end if

function elementOrder($Order) {
    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang;
    $elementOrder = '';
    ExcuteQuery("SELECT `Order` FROM `mainmenu` ;");
    if ($TotalRecords > 0) {

        $elementOrder .= '<select class="select" name="Order" id="Order">';
        for ($i = 0; $i < $TotalRecords; $i++) {

            $DATAOrder = $Rows['Order'];

            if ($DATAOrder == $Order) {
                $elementOrder .='<option selected="selected" value="' . ($i + 1) . '">' . ($i + 1) . '</option>';
            } else {
                $elementOrder .='<option value="' . ($i + 1) . '">' . ($i + 1) . '</option>';
            }//end if
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $elementOrder .= '</select>';
    }//end if
    return $elementOrder;
}

//end if
?>