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

global $dbHostName, $dbUserName, $dbPass, $restore, $dbBaseName, $backup, $BackupFolder, $LOG;

if (isset($_GET['NewProgSubmit'])) {
    $newprograms = SaveNewProg();
} else {
    $newprograms = ShowNewProgs();
}//end if

function SaveNewProg() {
    global $SqlType, $conn;
    $newprograms = InputFilter($_GET['NewProgSubmit']);
    $Chekdb = new db();
    $query = " select `ProgramName` from `programs` where `ProgramName`='" . $newprograms . "' ; ";
    $ChekdbSQL = $Chekdb->get_row($query);

    if (!$ChekdbSQL) {
        $ModId = GenerateID('moderators', 'ObjectId');
        $q = "INSERT INTO `programs` ( `IdProgram` , `ProgramName` , `Permission` , `ViewTopCont` , `ViewMarqueeCont` , `ViewMenuCont` , `ViewMainCont` , `ViewSecCont` , `ViewFootCont` , `ViewProgCont` , `ObjectId` , `Hits` , `Deleted`,`License` )
                    VALUES ('" . GenerateID('programs', 'IdProgram') . "', '" . $newprograms . "', '1', '1', '1', '1', '1', '1', '1', '1', '" . $ModId . "', '0', '0','');";

        $Recordset = mysqli_query($conn, $q);

        $q = "INSERT INTO `moderators` (`GroupId`, `ObjectId`, `Permission`) VALUES ('200700000-1', '" . $ModId . "', '1');";
        $Recordset = mysqli_query($conn, $q);

        //get default program value from sql file
        if (is_file('Programs/' . $newprograms . '/admin/data.sql')) {
            include_once ("admin/includes/ClassSQLimporter.php");
            $dbUserName = $dbUserPass[0][0];
            $dbPass = $dbUserPass[0][1];
            $newImport = new sqlImport($dbHostName, $dbUserName, $dbPass, $dbBaseName, 'Programs/' . $newprograms . '/admin/data.sql');
            $newImport->import();
        }

        $newprograms = "<strong>" . WeHaveSuccessInsertNewProg . "</strong><br/>";
        $newprograms .= ShowNewProgs();
    } else {
        $newprograms = AlredyActivated;
    }
    return $newprograms;
}

//end function

function ShowNewProgs() {

    global $Version, $xmlstr, $Lang, $License, $TotalRecords, $Recordset, $Rows, $SqlType, $conn;
    /*
      $RegPakage = LicenseInfo($License);
      $RegPakage =  $RegPakage['RegPakage']; // values : "STD" mean Sandard OR "ADV" mean Advanced
      if($RegPakage  == "STD"){
      $LicenseNbr = GetLicenseNbr('programs', 'License');
      if($LicenseNbr>=1){
      return $newprograms =  MaxNumberAllowedForSTD;
      }//end if
      }//end if
     */
    $newprograms = '<strong>' . PleaseChooseNewProgramsFromBelowIfUWanttoAddOne . '</strong>&nbsp;&nbsp;
                        <a href="admin/includes/webfolder/index.php?action=upload&dir=Programs&order=name&srt=yes&lang=' . $Lang . '" target="_blank" >'
            . OrYouCanUploadAndExtractYourModuleFolder . '</a><br/>
                        <table style="width:100%; height:400px" cellpadding="4px" cellspacing="4px">';
    $d = dir("Programs");
    while (($entry = $d->read()) !== false) {

        if ($entry != "." and $entry != "..") {
            if (is_file($d->path . '/' . $entry . '/index.php')) {
                //this  prog exsit in our files
                //serch our data base for this file
                ExcuteQuery("SELECT * FROM `programs` ;");
                if ($TotalRecords > 0) {
                    for ($i = 0; $i < $TotalRecords; $i++) {
                        $ProgramName = $Rows['ProgramName'];

                        if (strtolower($entry) == strtolower($ProgramName)) {
                            $ProgramName = strtolower($ProgramName);
                            $$ProgramName = true;
                            break;
                        }//end if 
                        $Rows = mysqli_fetch_assoc($Recordset);
                    }//end for
                }//end if
            }//end if
        }//end if
    }//end while
    $d->close();
    $NmbrOfNewProgs = 0;
    $options = "";
    $d = dir("Programs");
    while (($entry = $d->read()) !== false) {
        if ($entry != "." and $entry != "..") {
            //program name must not begin with "prog" because we use prog- in admins permission form
            if (substr($entry, 0, 4) == 'prog') {
                $Valid = false;
            } else {
                $Valid = true;
            }
            if (is_file($d->path . '/' . $entry . '/index.php') and $Valid) {
                //include lang file
                $db = new db();
                $db_exst = $db->get_var(" select `ProgramName` from `programs` where `ProgramName`='" . $entry . "'; ");
                if ($db_exst) {
                    $LangFile = 'Programs/' . $entry . '/admin/Languages/lang-' . $Lang . '.php';
                    if (is_file($LangFile)) {
                        include_once($LangFile);
                    }
                }
                $Var = strtolower($entry);
                if (!isset($$Var)) {

                    if ($NmbrOfNewProgs % 4 == 0) {
                        $options .= "<tr>";
                    }

                    if (is_file('Programs/' . $entry . '/thumb.png')) {
                        $Progthumb = '<img border="0" src="Programs/' . $entry . '/thumb.png" width="64" height="64" alt="' . $entry . '" />';
                    } else {
                        $Progthumb = '<img border="0" src="images/program.png" width="64" height="64" alt="Thumb" />';
                    }

                    if (is_file('Programs/' . $entry . '/admin/desc.php')) {
                        //echo 'Programs/'.$ProgramName.'/admin/desc.php <br/>';
                        require ('Programs/' . $entry . '/admin/desc.php');
                        $Pxml = new SimpleXMLElement($xmlstr);
                        $ProgDesc = (string) $Pxml->$Lang;
                        $ProgVersion = $Pxml->Version;
                        $ProgAuthor = $Pxml->Author;
                    } else {
                        $ProgDesc = " ";
                        $ProgVersion = $Version['core'];
                        $ProgAuthor = '';
                    }//end if

                    if (!constantDefined($entry)) {
                        $entryName = $entry;
                    } else {
                        $entryName = constant($entry);
                    }



                    $Vars = array('todo', 'NewProgSubmit');
                    $Vals = array('newprograms', $entry);
                    $ProgLink = AdminCreateLink('', $Vars, $Vals);
                    $options .= '<td STYLE="vertical-align: top;"><a href="' . $ProgLink . '" >' . $Progthumb . '<br/>' . Activate . ' ' . Progam . ' : ' . $entryName . ' ' . $ProgVersion . '</a><br/><span style="font-size: x-small;" >' . $ProgAuthor . '</span><br/>' . $ProgDesc . '</td>';
                    $NmbrOfNewProgs++;

                    if ($NmbrOfNewProgs % 4 == 0) {
                        $options .= "<tr>";
                    }
                }//end if
            }//END IF
        }//end if
    }//end while
    $d->close();
    if ($NmbrOfNewProgs > 0) {
        $newprograms .= $options . '<table>';
        // $newprograms .= 'admin/includes/webfolder/index.php?action=upload&dir=Programs&order=name&srt=yes&lang=Arabic ';

        return $newprograms . '<BR/><BR/>';
    } else {
        return '<strong>' . Pleaseinstalthefolderoftheprogramuwanttoaddnewone . '</strong>';
    }//end if
}

//end function
?>