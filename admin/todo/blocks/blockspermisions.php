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

$blockspermisions = "blockspermisions";
if (isset($_POST['PermBlockSubmit']) or isset($_POST['SaveBlockPerm'])) {
    if (isset($_POST['SaveBlockPerm'])) {
        //save permisions
        $blockspermisions = SavePermList();
    } else {
        //show permisions form
        $blockspermisions = ShowPermList();
    }//end if
} else {
    //show list of programs to select one
    $blockspermisions = ShowBlockList();
}//end if

function SavePermList() {
    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn;
    $BlockName = $_POST['BlockName'];
    ExcuteQuery("SELECT * FROM `blocks` where `BlockName`='" . $BlockName . "';");
    if ($TotalRecords > 0) {
        $ObjectId = $Rows['ObjectId'];
    }//end if

    $Permission = $_POST['Permission'];
    //UPDATE permission of  table programs
    $query = "UPDATE `blocks` SET `view` = '" . $Permission . "' WHERE `BlockName`='" . $BlockName . "' ";

    $Rs = mysqli_query($conn, $query);


    //first step we well delete all Old permisions
    $query = "delete from `moderators` where `ObjectId`='" . $ObjectId . "'; ";

    $Rs = mysqli_query($conn, $query);


    //insert new permisions
    ExcuteQuery("SELECT * FROM `groups`;");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $GroupId = $Rows['GroupId'];
            if (isset($_POST[$GroupId])) {
                //$GroupId = $_POST[$GroupId];
                //echo 'GroupId : '.$GroupId .' ObjectId: '. $ObjectId . ' '.$_POST[$GroupId]. '</br>';
                $query = "INSERT INTO `moderators` (`GroupId`, `ObjectId`, `Permission`) 
							VALUES ('" . $GroupId . "', '" . $ObjectId . "', '" . $_POST[$GroupId] . "');";

                $Rs = mysqli_query($conn, $query);
            }//end if
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//end if

    return (WeHaveSavePermissionForTheBlock);
}

//end function

function ShowPermList() {
    global $Lang, $TotalRecords, $Recordset, $Rows, $SqlType, $conn;

    $BlockName = PostFilter($_POST['BlockName']);
    //include lang file
    $LangFile = 'Blocks/' . $BlockName . '/admin/Languages/lang-' . $Lang . '.php';
    if (is_file($LangFile)) {
        include_once($LangFile);
    }
    ExcuteQuery("SELECT * FROM `blocks` where `BlockName`='" . $BlockName . "';");
    if ($TotalRecords > 0) {
        $View = $Rows['View'];
        $ObjectId = $Rows['ObjectId'];
    }//end if
    if ($View == "1") {
        $Option = '<option selected="selected" value="1">' . yes . '</option>
			 <option value="0">' . no . '</option>';
    } else {
        $Option = '<option value="1">' . yes . '</option>
			 <option selected="selected" value="0">' . no . '</option>';
    }

    if (!constantDefined($BlockName)) {
        $NewBlockName = $BlockName;
    } else {
        $NewBlockName = constant($BlockName);
    }

    $ShowPermList = '<form name="FormPerm" action="" method="post">
					<input class="submit" type="hidden" value="' . $BlockName . '" name="BlockName" id="BlockName" />
					<table border="0" cellspacing="2" cellpadding="1">
					  <tr>
					    <td><strong>' . GroupCanAccess . '</strong></td>
					    <td><strong>' . $NewBlockName . '</strong></td>
					  </tr>
					  <tr>
					    <td style="border-bottom:dotted; border-bottom-width:thin">' . OtherUsers . '</td>
					    <td style="border-bottom:dotted; border-bottom-width:thin">
					      <select class="select" name="Permission" id="Permission">
						' . $Option . '
					      </select>
					    </td>
					  </tr>';
    ExcuteQuery("SELECT * FROM `groups` ;");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $GroupId = $Rows['GroupId'];
            $GroupName = $Rows['GroupName'];
            $qry = "select `Permission` from `moderators` where `GroupId`='" . $GroupId . "' 
					and `ObjectId`='" . $ObjectId . "';";

            $Rs = mysqli_query($conn, $qry);
            $Totals = mysqli_num_rows($Rs);
            $data = mysqli_fetch_assoc($Rs);
            if ($Totals > 0) {
                $Permission = $data['Permission'];
            } else {
                $Permission = "0";
            }//end if

            if ($Permission == "1") {
                $option = '<option selected="selected" value="1">' . (yes) . '</option>
						<option value="0">' . (no) . '</option>';
            } else {
                $option = '<option value="1">' . (yes) . '</option>
						<option selected="selected" value="0">' . (no) . '</option>';
            }//end if
            $ShowPermList .= '<td style="border-bottom:dotted; border-bottom-width:thin">' . $GroupName . '</td>
						    <td style="border-bottom:dotted; border-bottom-width:thin">
							<select class="select" name="' . $GroupId . '" id="' . $GroupId . '">
							' . $option . '
						    </select></td>
						  </tr>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//END IF
    $ShowPermList .='</table><br/><input class="submit" type="submit" name="SaveBlockPerm" id="SaveBlockPerm" value="'
            . (save) . '"></form><br/>';
    return $ShowPermList;
}

//end function

function ShowBlockList() {
    global $Lang, $TotalRecords, $Recordset, $Rows, $SqlType, $conn;
    $Blockspermisions = (PleaseSelectBlockToAddPerm) .
            '<br/><form id="formblockList" name="formblockList" method="post" action="">
							<select class="select" name="BlockName" id="BlockName">';
    $Options = "";
    ExcuteQuery("SELECT * FROM `blocks` WHERE `Deleted`<>'1' ;");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $BlockName = $Rows['BlockName'];
            //include lang file
            $LangFile = 'Blocks/' . $BlockName . '/admin/Languages/lang-' . $Lang . '.php';
            if (is_file($LangFile)) {
                include_once($LangFile);
            }
            if (!constantDefined($BlockName)) {
                $NewBlockName = $BlockName;
            } else {
                $NewBlockName = constant($BlockName);
            }
            $Options .= '<option value="' . $BlockName . '">' . $NewBlockName . '</option>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//end if
    $Blockspermisions .= $Options . ' <input class="submit" type="submit" name="PermBlockSubmit" id="PermBlockSubmit" value="'
            . (submit) . '" /></select></form>';
    return $Blockspermisions;
}

//end function
?>