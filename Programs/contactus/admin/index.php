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
<?php global $IsAdmin;
if (!isset($IsAdmin)) {
    header("location: ../");
} ?>
<?php

global $TotalRecords, $TotalRecords, $Rows, $Recordset, $Lang, $conn;

include_once("Programs/contactus/admin/Languages/lang-$Lang.php");
include_once("Programs/contactus/Languages/lang-$Lang.php");

if (isset($_GET['dep'])) {
    switch (InputFilter($_GET['dep'])) {
        case "addDepartment" :
            addDepartment();
            break;
        case "editDep" :
            editDep();
            break;
        case "delDep" :
            delDep();
            break;
        default :
            ListAllDep();
    }//end switch
} else {
    ListAllDep();
}//end if

function delDep() {
    global $CustomHead, $TotalRecords, $Rows, $Recordset, $conn;
    $IdDep = InputFilter($_GET['delDep']);

    $UPQ = "delete from `contactus` where `IdDep`='" . $IdDep . "' ;";
    $RS = mysqli_query($conn, $UPQ);

    $UPQ = "delete from `contactuslang` where `IdDep`='" . $IdDep . "' ;";
    $RS = mysqli_query($conn, $UPQ);

    echo "<strong>" . (SuccessDeleteDep) . "</strong><br/>";
    ListAllDep();
}

//end function

function editDep() {
    global $CustomHead, $TotalRecords, $Rows, $Recordset, $conn;
    if (!isset($_POST['submitEditDep'])) {
        $CustomHead .= '<script language="javascript" type="text/javascript">
                                document.onkeydown = document.onkeypress = function (evt) {
                                    if (!evt && window.event) {
                                        evt = window.event;
                                    }
                                    var keyCode = evt.keyCode ? evt.keyCode :
                                        evt.charCode ? evt.charCode : evt.which;
                                    if (keyCode) {
                                        if (evt.ctrlKey) {
                                            if(keyCode==83){
                                                document.getElementById("submitEditDep").click();
                                                return false;
                                            }
                                            return false;
                                        }
                                    }
                                    return true;
                                }
                            </script>';
        $CustomHead .= '<script src="Programs/contactus/admin/SpryValidationTextField.js" type="text/javascript"></script>
						<link href="Programs/contactus/admin/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
        $IdDep = InputFilter($_GET['editDep']);
        $Query = "select * from `contactus` where `IdDep`='" . $IdDep . "' ;";
        ExcuteQuery($Query);
        if ($TotalRecords > 0) {
            $DepEmail = $Rows['DepEmail'];
        } else {
            $DepEmail = "";
        }//end if

        echo '<strong>' . (editDepartment) . '</strong><br/>
			<form id="formNewDep" name="formNewDep" method="post" action="">
				' . (DepEmail) . ' : 
			  <span id="sprytextfield1">
			  <input value="' . $DepEmail . '" type="text" name="DepEmail" id="DepEmail" />
			  <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span>
			  <span class="textfieldInvalidFormatMsg">' . (Invalidformat) . '</span></span>
			   <table border="0" cellspacing="1" cellpadding="1">';
        $Query = "select * from `languages` ;";
        ExcuteQuery($Query);
        if ($TotalRecords > 0) {
            for ($i = 0; $i < $TotalRecords; $i++) {
                $LangName = $Rows['LangName'];
                $IdLang = $Rows['IdLang'];
                $q = "select * from `contactuslang` where `IdDep`='" . $IdDep . "' and `IdLang`='" . $IdLang . "' ;";
                $Rs = mysqli_query($conn, $q);
                $Totals = mysqli_num_rows($Rs);
                if ($Totals > 0) {
                    $data = mysqli_fetch_assoc($Rs);
                    $DepName = $data['DepName'];
                } else {
                    $DepName = "";
                }//end if
                echo '<td>' . (DepName) . ' ' . $LangName . ' </td>
				      <td><span id="sprytextfield' . ($i + 2) . '">
				        <input value="' . $DepName . '" type="text" name="DepName' . $LangName . '" id="DepName' . $LangName . '" />
				      <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span></td>
				    </tr>';
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
        }//end if
        echo '<tr>
			    <td colspan="2" align="center">
					<input class="submit" type="submit" name="submitEditDep" id="submitEditDep" value="' . (save) . '" />
				</td>
			    </tr>
			  </table>';

        echo '<script type="text/javascript">
			<!--
			var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");';
        for ($j = 2; $j <= $i + 2; $j++) {
            echo 'var sprytextfield' . $j . ' = new Spry.Widget.ValidationTextField("sprytextfield' . $j . '"); ';
        }//end for
        echo '//-->
			</script>';
    } else { // saving post info
        $IdDep = InputFilter($_GET['editDep']);
        $DepEmail = PostFilter($_POST['DepEmail']);
        $UPQ = "update `contactus` set `DepEmail`='" . $DepEmail . "' where `IdDep`='" . $IdDep . "' ;";
        $RS = mysqli_query($conn, $UPQ);

        $Query = "select * from `languages` ;";
        ExcuteQuery($Query);
        if ($TotalRecords > 0) {
            for ($i = 0; $i < $TotalRecords; $i++) {
                $LangName = $Rows['LangName'];
                $IdLang = $Rows['IdLang'];
                $DepName = PostFilter($_POST['DepName' . $LangName]);
                $UPQ = "UPDATE `contactuslang` SET `DepName`='" . $DepName . "' 
						WHERE `IdDep`='" . $IdDep . "' AND `IdLang`='" . $IdLang . "' ;";
                $RS = mysqli_query($conn, $UPQ);

                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
        }//end if
        echo (SucssesUpdateNewDep);
    }//end if
}

//end function

function addDepartment() {
    global $CustomHead, $TotalRecords, $Rows, $Recordset, $conn;
    if (!isset($_POST['submitNewDep'])) {
        $CustomHead .= '
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
                                    document.getElementById("submitNewDep").click();
                                    return false;
                                }
                                return false;
                            }
                        }
                        return true;
                    }
                </script>
                <script src="Programs/contactus/admin/SpryValidationTextField.js" type="text/javascript"></script>
						<link href="Programs/contactus/admin/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
        echo '<strong>' . (addDepartment) . '</strong><br/>
			<form id="formNewDep" name="formNewDep" method="post" action="">
				' . (DepEmail) . ' : 
			  <span id="sprytextfield1">
			  <input type="text" name="DepEmail" id="DepEmail" />
			  <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span>
			  <span class="textfieldInvalidFormatMsg">' . (Invalidformat) . '</span></span>
			   <table border="0" cellspacing="1" cellpadding="1">';
        $Query = "select * from `languages`  where `Deleted`<>'1' ;";
        ExcuteQuery($Query);
        if ($TotalRecords > 0) {
            for ($i = 0; $i < $TotalRecords; $i++) {
                $LangName = $Rows['LangName'];
                echo '<td>' . (DepName) . ' ' . $LangName . ' </td>
				      <td><span id="sprytextfield' . ($i + 2) . '">
				        <input type="text" name="DepName' . $LangName . '" id="DepName' . $LangName . '" />
				      <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span></td>
				    </tr>';
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
        }//end if
        echo '<tr>
			    <td colspan="2" align="center">
					<input class="submit" type="submit" name="submitNewDep" id="submitNewDep" value="' . (save) . '" />
				</td>
			    </tr>
			  </table>';

        echo '<script type="text/javascript">
			<!--
			var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");';
        for ($j = 2; $j <= $i + 2; $j++) {
            echo 'var sprytextfield' . $j . ' = new Spry.Widget.ValidationTextField("sprytextfield' . $j . '"); ';
        }//end for
        echo '//-->
			</script>';
    } else { // saving post info
        $IdDep = GenerateID('contactus', 'IdDep');
        $DepEmail = PostFilter($_POST['DepEmail']);
        $InsQ = "INSERT INTO `contactus` ( `IdDep` , `DepEmail` )
				VALUES ('" . $IdDep . "', '" . $DepEmail . "');";
        $RS = mysqli_query($conn, $InsQ);

        $Query = "select * from `languages` where `Deleted`<>'1';";
        ExcuteQuery($Query);
        if ($TotalRecords > 0) {
            for ($i = 0; $i < $TotalRecords; $i++) {
                $LangName = $Rows['LangName'];
                $IdLang = $Rows['IdLang'];
                $DepName = PostFilter($_POST['DepName' . $LangName]);
                $InsQ = "INSERT INTO `contactuslang` (`IdDep`, `IdLang`, `DepName`) 
						VALUES ('" . $IdDep . "', '" . $IdLang . "', '" . $DepName . "');";
                $RS = mysqli_query($conn, $InsQ);

                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
        }//end if
        echo "<strong>" . (SucssesInsertNewDep) . "</strong><br/>";
        ListAllDep();
    }//end if
}

//end function

function ListAllDep() {
    global $conn, $Lang;

    $Vars = array("prog", "dep");
    $Vals = array("contactus", "addDepartment");
    echo '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">' . (addDepartment) . '</a>&nbsp;';

    SqlConnect();
    $query = "SELECT * from `languages` where `LangName`='" . $Lang . "' ;";
    $Rec = mysqli_query($conn, $query);
    $cuRows = mysqli_fetch_assoc($Rec);
    $IdLang = $cuRows['IdLang'];

    $query = "SELECT *
			FROM `contactus` , `contactuslang`
			WHERE `contactus`.`IdDep` = `contactuslang`.`IdDep`
			AND `contactuslang`.`IdLang` = '" . $IdLang . "'";

    $Rec = mysqli_query($conn, $query); //;	
    $Totals = mysqli_num_rows($Rec);
    if ($Totals > 0) {
        echo '<table border="0" cellspacing="2" cellpadding="2">
			  <tr>
			    <td><strong>' . (DepName) . '</strong></td>
			    <td><strong>' . (DepEmail) . '</strong></td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			  </tr>';
        for ($i = 0; $i < $Totals; $i++) {
            $cuRows = mysqli_fetch_assoc($Rec);
            $IdDep = $cuRows['IdDep'];
            $DepName = $cuRows['DepName'];
            $DepEmail = $cuRows['DepEmail'];
            $Vars = array("prog", "dep", "editDep");
            $Vals = array("contactus", "editDep", $IdDep);
            $Edit = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">' . (editDepartment) . '</a>';

            $Vars = array("prog", "dep", "delDep");
            $Vals = array("contactus", "delDep", $IdDep);
            $Delete = '<a onclick="return acceptDel();" href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">' . (DeleteDepartment) . '</a>';

            echo '  <tr>
						    <td>' . $DepName . '</td>
						    <td>' . $DepEmail . '</td>
						    <td>' . $Edit . '</td>
						    <td>' . $Delete . '</td>
						  </tr>';
        }
        echo '</table>
				<script language="javascript" type="text/javascript">
					function acceptDel(){
						return confirm("' . (DidUWantToFinalDelete) . '");
					}
					</script>';
    } else {
        echo (NoDepartmentFound) . '&nbsp;';
    }//end if
}

//end function
?>