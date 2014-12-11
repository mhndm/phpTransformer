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

if (isset($_GET['NewBlockCreate'])) {
    $newblock = NewBlockCreate();
} elseif (isset($_GET['NewBlockSubmit'])) {
    $newblock = SaveNewBlock();
} else {
    $newblock = ShowNewBlocks();
}//end if

function NewBlockCreate() {

    if (isset($_POST['BlockFactory'])) {
        $BlockFactory = RightLangFileName(PostFilter($_POST['BlockFactory'], true));

        // this block name must be new
        if (!is_dir('Blocks/' . $BlockFactory)) {
            //create new folder for this block with admin panel
            mkdir('Blocks/' . $BlockFactory);
            // mkdir('Blocks/'.$BlockFactory.'/admin');
            mkdir('Blocks/' . $BlockFactory . '/Themes');
            mkdir('Blocks/' . $BlockFactory . '/Languages');
            mkdir('Blocks/' . $BlockFactory . '/images');

            $fp = fopen('Blocks/' . $BlockFactory . '/index.html', 'w');
            fwrite($fp, ' ');
            fclose($fp);
            $fp = fopen('Blocks/' . $BlockFactory . '/index.php', 'w');
            fwrite($fp, ' ');
            fclose($fp);
            // $fp = fopen('Blocks/'.$BlockFactory.'/admin/index.html', 'w'); fwrite($fp, ' ');fclose($fp);
            $fp = fopen('Blocks/' . $BlockFactory . '/Themes/index.html', 'w');
            fwrite($fp, ' ');
            fclose($fp);
            $fp = fopen('Blocks/' . $BlockFactory . '/Languages/index.html', 'w');
            fwrite($fp, ' ');
            fclose($fp);
            $fp = fopen('Blocks/' . $BlockFactory . '/images/index.html', 'w');
            fwrite($fp, ' ');
            fclose($fp);


            if (is_file('images/blocks-factory.png')) {
                copy('images/blocks-factory.png', 'Blocks/' . $BlockFactory . '/thumb.png');
            }
            directory_copy('Blocks/FreeBlock/admin', 'Blocks/' . $BlockFactory . '/admin/');
            //delete lang files for error : Constant FreeBlock already defined
            EmptyDirectory('Blocks/' . $BlockFactory . '/admin/Languages');
            //activate the new block
            return SaveNewBlock($BlockFactory);
        } else {
            $Vars = array('todo');
            $Vals = array('newblock');
            $redirectTO = AdminCreateLink('', $Vars, $Vals);
            return adminPrintMessageAndRedirect(NewBlock, BlockNameAlreadyExist, $redirectTO);
        }
    } else {
        $Vars = array('todo');
        $Vals = array('newblock');
        $redirectTO = AdminCreateLink('', $Vars, $Vals);
        return adminPrintMessageAndRedirect(NewBlock, BlockMustHaveName, $redirectTO);
    }
}

function SaveNewBlock($BlockName = '') {
    global $SqlType, $conn, $dbHostName, $dbUserName, $dbUserPass;
    if (isset($_GET['NewBlockSubmit'])) {
        $newBlock = InputFilter($_GET['NewBlockSubmit']);
    } else {
        $newBlock = $BlockName;
    }
    $ModId = GenerateID('moderators', 'ObjectId');
    $q = "INSERT INTO `blocks` ( `BlockName` , `Active` , `View` , `MainSec` , `Order` , `ObjectId`,`Deleted`,`License` )
			VALUES ('" . $newBlock . "', '1', '1', 'M', '1', '" . $ModId . "','0','');";

    $RS = mysqli_query($conn, $q);


    $q = "INSERT INTO `moderators` (`GroupId`, `ObjectId`, `Permission`)
			VALUES ('200700000-1', '" . $ModId . "', '1');";

    $RS = mysqli_query($conn, $q);


    //set default name in all langs

    $Query = 'SELECT * FROM `languages` ;';
    $Recordset = mysqli_query($conn, $Query);
    $TotalRecords = mysqli_num_rows($Recordset);
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $Rows = mysqli_fetch_assoc($Recordset);
            $LangName = $Rows['LangName'];
            $IdLang = $Rows['IdLang'];
            $idblocklang = GenerateID('blocklang', 'idblocklang');
            $q = "insert into `blocklang`
						(`idblocklang`,`BlockName`,`idLang`,`BlockTitle`) 
						values('" . $idblocklang . "','" . $newBlock . "','" . $IdLang . "','" . $newBlock . "');";
            $RS = mysqli_query($conn, $q);
        }//end for
    }//end if
    //get default Block value from sql file
    if (is_file('Blocks/' . $newBlock . '/admin/data.sql')) {
        include_once ("admin/includes/ClassSQLimporter.php");
        $dbUserName = $dbUserPass[0][0];
        $dbPass = $dbUserPass[0][1];
        $newImport = new sqlImport($dbHostName, $dbUserName, $dbPass, $dbBaseName, 'Blocks/' . $newBlock . '/admin/data.sql');
        $newImport->import();
    }
    //$newBlock ="<strong>".  (WeHaveSuccessInsertNewBlock)."</strong><br/>";
    //$newBlock .= ShowNewBlocks();
    $Vars = array('todo');
    $Vals = array('blocksmanagment');
    $redirectTO = AdminCreateLink('', $Vars, $Vals);
    return adminPrintMessageAndRedirect(NewBlock, WeHaveSuccessInsertNewBlock, $redirectTO);
    //return $newBlock;
}

//end function

function ShowNewBlocks() {

    global $Version, $xmlstr, $Lang, $License, $TotalRecords, $Recordset, $Rows, $SqlType, $conn;
    $newBlock = '';
    $options = '';
    /**/
    $RegPakage = LicenseInfo($License);
    $RegPakage = $RegPakage['RegPakage']; // values : "STD" mean Sandard OR "ADV" mean Advanced
    if ($RegPakage == "STD") {
        $LicenseNbr = GetLicenseNbr('blocks', 'License');
        if ($LicenseNbr >= 1) {
            return $newBlock = (MaxNumberAllowedForSTD);
        }//end if
    }//end if
    /**/

    $newBlock .= '<strong>' . PleaseSelectBlockToActivate . '</strong>&nbsp;&nbsp;
            <a href="admin/includes/webfolder/index.php?action=upload&dir=Blocks&order=name&srt=yes&lang=' . $Lang . '" target="_blank" >'
            . OrYouCanUploadAndExtractYourModuleFolder . '</a><br/>
                    <table style="width:100%;" cellpadding="4px" cellspacing="4px">';

    $d = dir("Blocks");
    while (($entry = $d->read()) !== false) {
        if ($entry != "." and $entry != "..") {
            if (is_file($d->path . '/' . $entry . '/index.php')) {
                //this  prog exsit in our files
                //serch our data base for this file
                ExcuteQuery("SELECT * FROM `blocks`;");
                if ($TotalRecords > 0) {
                    for ($i = 0; $i < $TotalRecords; $i++) {
                        $BlockName = $Rows['BlockName'];
                        if (strtolower($entry) == strtolower($BlockName)) {
                            $BlockName = strtolower($BlockName);
                            $$BlockName = true;
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

    $d = dir("Blocks");
    while (($entry = $d->read()) !== false) {
        if ($entry != "." and $entry != "..") {
            //Block name must not begin with "blok" because we use blok- in admins permission form
            if (substr($entry, 0, 4) == 'blok') {
                $Valid = false;
            } else {
                $Valid = true;
            }
            if (is_file($d->path . '/' . $entry . '/index.php') and $Valid) {
                //include lang file
                 $db = new db();
                $db_exst = $db->get_var(" select `BlockName` from `blocks` where `BlockName`='" . $entry . "'; ");
                if ($db_exst) {
                    $LangFile = 'Blocks/' . $entry . '/admin/Languages/lang-' . $Lang . '.php';
                    if (is_file($LangFile)) {
                        include_once($LangFile);
                    }
                }
                $Var = strtolower($entry);
                if (!isset($$Var)) {
                    if ($NmbrOfNewProgs % 4 == 0) {
                        $options .= "<tr>";
                    }
                    if (is_file('Blocks/' . $entry . '/thumb.png')) {
                        $Blockthumb = '<img border="0" src="Blocks/' . $entry . '/thumb.png" width="64" height="64" alt="' . $entry . '" />';
                    } else {
                        $Blockthumb = '<img border="0" src="images/block.png" width="64" height="64" alt="Thumb" />';
                    }
                    if (is_file('Blocks/' . $entry . '/admin/desc.php')) {
                        include_once 'Blocks/' . $entry . '/admin/desc.php';
                        $xml = new SimpleXMLElement($xmlstr);
                        $BlockDesc = $xml->$Lang;
                        $BlocksVersion = $xml->Version;
                        $BlocksAuthor = $xml->Author;
                    } else {
                        $BlockDesc = " ";
                        $BlocksVersion = $Version['core'];
                        $BlocksAuthor = '';
                    }//end if
                    $Vars = array('todo', 'NewBlockSubmit');
                    $Vals = array('newblock', $entry);
                    $NewBlockLink = AdminCreateLink("", $Vars, $Vals);
                    if (!constantDefined($entry)) {
                        $entry = $entry;
                    } else {
                        $entry = constant($entry);
                    }
                    $options .= '<td><a href="' . $NewBlockLink . '" title="">' . $Blockthumb . '<BR/> ' . Activate . ' ' . Block . ' : ' . $entry . ' ' . $BlocksVersion . '</a><br/><span style="font-size: x-small;" >' . $BlocksAuthor . '</span> <br>' . $BlockDesc . '<br/></td>';
                    if ($NmbrOfNewProgs + 1 % 4 == 0) {
                        $options .= "<tr>";
                    }
                    $NmbrOfNewProgs++;
                }//end if
            }//END IF
        }//end if
    }//end while
    $d->close();

    $Vars = array('todo', 'NewBlockCreate');
    $Vals = array('newblock', 'BlockFactory');
    $NewBlockLink = AdminCreateLink("", $Vars, $Vals);
    $CreateNewBlock = '<form action="' . $NewBlockLink . '" method="POST">
                                <img src="images/blocks-factory.png" width="64" height="64" alt="bloks-factory" border="0" /><BR/>
                                    <input type="submit" class="submit" value="' . CreateNewBlock . '" name="BlockFactorySubmit" id="BlockFactorySubmit" /> :
                                    <input type="text" class="text" name="BlockFactory" id="BlockFactory" /><br/>
                                 ' . BlockFactoryDesc . '<br/></form>';
    if ($NmbrOfNewProgs > 0) {
        $newBlock .= $options . ' </table>';
        return $CreateNewBlock . $newBlock;
    } else {
        return '<strong>' . (PleaseinstalthefolderoftheBlockuwanttoaddnewone) . '</strong>' . $CreateNewBlock;
    }//end if
}

//end function
?>