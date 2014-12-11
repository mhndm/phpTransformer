<?php
/*

  Project: phpTransformer.com .
  File Location :  .
  File Name:  .
  Date Created: 00-00-2007.
  Last Modified: 00-00-2007.
  Descriptions: .
  Changes: .
  TODO:  .
     Author: Mohsen Mousawi mhndm@phptransformer.com .

*/
?>
<?php
global $AdminFileName,$UpdateServiceUrl,$Localfile,$BackupFolder,$dbHostName,$dbBaseName,$dbUserPass ,$Version;

//deny foreign request for security reason
if(isset($_SERVER['HTTP_REFERER'])) {
    $Ref = $_SERVER['HTTP_REFERER'];
}
else {
    // first page in the browser
    $Ref=$_SERVER['HTTP_HOST'];
    $Ref['host']=$_SERVER['HTTP_HOST'];
}

$Ref = parse_url($Ref);
if(isset($Ref['host'])) {
    $Ref = $Ref['host'];
}
else {
    $Ref = $Ref['path'];
}
$Host = $_SERVER['HTTP_HOST'];
if ($Ref!=$Host) {
    die();
}

error_reporting(E_ERROR | E_WARNING | E_PARSE);
if(function_exists('set_time_limit')) {
    @set_time_limit(0);
}
ini_alter("memory_limit", "1024M");
//ob_end_clean();
ob_implicit_flush(TRUE);
ignore_user_abort(1);
clearstatcache();
error_reporting(6135);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

include_once '../../../config.php';
include_once '../../../includes/ezsql/ez_sql.php';
include_once '../../../includes/Functions.php';
include_once '../../../includes/InputFilters.php';
include_once '../../../Global.php';
require_once "../../../includes/dUnzip/dUnzip2.inc.php";
require_once "../../../includes/dUnzip/dZip.inc.php";

if(isset($_POST['Lang'])) {
    $Lang = PostFilter($_POST['Lang']);
}
else {
    $Lang = 'English';
}
include_once '../../../admin/languages/lang-'.$Lang.'.php';

//make shure if the structure is okay
$autoUpdateFolder = '../../../autoUpdate/';
if(!is_dir($autoUpdateFolder)) {
    mkdir($autoUpdateFolder);
    $handle = fopen($autoUpdateFolder."/index.html", "w");
    fclose($handle);
}
$autoUpdateFolder = '../../../autoUpdate/blocks';
if(!is_dir($autoUpdateFolder)) {
    mkdir($autoUpdateFolder);
    $handle = fopen($autoUpdateFolder."/index.html", "w");
    fclose($handle);
}
$autoUpdateFolder = '../../../autoUpdate/content';
if(!is_dir($autoUpdateFolder)) {
    mkdir($autoUpdateFolder);
    $handle = fopen($autoUpdateFolder."/index.html", "w");
    fclose($handle);
}
$autoUpdateFolder = '../../../autoUpdate/core';
if(!is_dir($autoUpdateFolder)) {
    mkdir($autoUpdateFolder);
    $handle = fopen($autoUpdateFolder."/index.html", "w");
    fclose($handle);
}
$autoUpdateFolder = '../../../autoUpdate/plugins';
if(!is_dir($autoUpdateFolder)) {
    mkdir($autoUpdateFolder);
    $handle = fopen($autoUpdateFolder."/index.html", "w");
    fclose($handle);
}
$autoUpdateFolder = '../../../autoUpdate/programs';
if(!is_dir($autoUpdateFolder)) {
    mkdir($autoUpdateFolder);
    $handle = fopen($autoUpdateFolder."/index.html", "w");
    fclose($handle);
}
$autoUpdateFolder = '../../../autoUpdate/themes';
if(!is_dir($autoUpdateFolder)) {
    mkdir($autoUpdateFolder);
    $handle = fopen($autoUpdateFolder."/index.html", "w");
    fclose($handle);
}

//where the update file will be stored
$Localfile = '../../../autoUpdate/content/update.zip';

if(isset($_POST['FileExist'])) {

    $Protocole      = PostFilter($_POST['Protocole']);
    $SupportPath    = PostFilter($_POST['SupportPath']);
    $MirrorPath     = PostFilter($_POST['MirrorPath']);
    $Hash           = PostFilter($_POST['Hash']);

    if(url_exists($Protocole.'://'.$SupportPath)) {
        $exst = 1;
    }
    elseif(url_exists($Protocole.'://'.$MirrorPath)) {
        $exst = 1;
    }
    else {
        $exst = 0;
    }
    header ('Content-type: application/xml; charset="utf-8"',true);
    echo '<?xml version="1.0" standalone="yes"?>
                <installer>
                    <FileExist>'.$exst.'</FileExist>
                    <Error>'.UpdateFileNotExistInTheServer.'</Error>
                </installer>';
}

if(isset($_POST['wwwCopy'])) {

    $Protocole = PostFilter($_POST['Protocole']);
    $SupportPath = PostFilter($_POST['SupportPath']);
    $MirrorPath = PostFilter($_POST['MirrorPath']);

    if(url_exists($Protocole.'://'.$SupportPath)) {
        $Reomtefile = $Protocole.'://'.$SupportPath;
    }
    elseif(url_exists($Protocole.'://'.$MirrorPath)) {
        $Reomtefile = $Protocole.'://'.$MirrorPath;
    }
    //Delete the old update file to save space
    if(is_file($Localfile)) {
        unlink($Localfile);
    }

    if(wwwcopy($Reomtefile,$Localfile)) {
        $wwwCopyError = 0;
    }
    else {
        $wwwCopyError = 1;
    }
    header ('Content-type: application/xml; charset="utf-8"',true);
    echo '<?xml version="1.0" standalone="yes"?>
                <installer>
                    <wwwCopyError>'.$wwwCopyError.'</wwwCopyError>
                    <Error>'.wwwCopyError.'</Error>
                </installer>';
}

if(isset($_POST['md5'])) {
    $Hash = PostFilter($_POST['Hash']);
    $TrueHash = md5_file($Localfile);
    if($TrueHash == $Hash) {
        $md5 = 1;
    }
    else {
        $md5 = 0 ;
    }

    header ('Content-type: application/xml; charset="utf-8"',true);
    echo '<?xml version="1.0" standalone="yes"?>
                <installer>
                    <TrueHash>'.$md5.'</TrueHash>
                    <Error>'.md5ErrorSize.'</Error>
                </installer>';
}

if(isset($_POST['backup'])) {

    $backupError = 'none' ;
    if(isset($_POST['UpdateType'])) {
        if($_POST['UpdateType'] == 'Update') {
            $Folder = 'core';
        }elseif($_POST['UpdateType'] =='UpdateProg') {
            $Folder = 'programs';
        }elseif($_POST['UpdateType'] =='UpdateBlock') {
            $Folder = 'blocks';
        }elseif($_POST['UpdateType'] =='UpdateTheme') {
            $Folder = 'themes';
        }
        elseif($_POST['UpdateType'] =='UpdatePlugin') {
            $Folder = 'plugins';
        }
    }
    else {
        $Folder = 'xxx';
    }

    //DELETE old files from backup directory for space saving reason
    $OldBackups = getFileList('../../../autoUpdate/'.$Folder);
    //umpty the directories from files
    foreach($OldBackups as $OldBackup) {
        if(is_file($OldBackup) and $OldBackup!='../../../autoUpdate/'.$Folder.'/index.html') {
            unlink($OldBackup);
        }
    }
    //delete folders
    foreach($OldBackups as $OldBackup) {
        if(!is_file($OldBackup) and $OldBackup!='.' and $OldBackup!='..' and is_dir($OldBackup) ) {
            EmptyDirectory($OldBackup);
        }
    }

    $BackupFolder = '../../../autoUpdate/'.$Folder.'/'.date('Y-m-d_H-i-s_').'_'.md5(rand(0,999999).date('Y-m-d_H-i-s')).'/';
    if(!is_dir($BackupFolder)) {
        mkdir($BackupFolder);
    }

    //make sql backup
    if(MakePTDatabaseBackup()) {
        $DatabaseBackupError = 0;
    }
    else {
        $DatabaseBackupError = 1;
        $backupError = DataBaseBackupError;
    }

    //make files backup
    if(MakePTFilesBackup()) {
        $PTFilesBackupError = 0;
    }
    else {
        $PTFilesBackupError = 1;
        $backupError = PTFilesBackupError;
    }

    if(($PTFilesBackupError == 1) or ($DatabaseBackupError == 1)) {
        $backup = 0;
    }
    else {
        $backup = 1;
        $backupError =substr($BackupFolder, 9, strlen($BackupFolder)-10);
        ; //show the user the name of backup folder
    }
    header ('Content-type: application/xml; charset="utf-8"',true);
    echo '<?xml version="1.0" standalone="yes"?>
                <installer>
                    <backup>'.$backup.'</backup>
                    <Error>'.$backupError.'</Error>
                </installer>';

}

if(isset($_POST['unzip'])) {
    //close website for visitors
    $query = "UPDATE `params` SET `IsOpen` = '0' ;";
    $dbIsOpen = new db();
    $dbIsOpen ->query($query);

    if(isset($_POST['ObjectName'])) {
        $ObjectName = $_POST['ObjectName'];
        if($ObjectName=='core'){
            $ObjectName = ''; //update of the all pt
        }
 
    }
    else {
        $ObjectName = 'xxx';
    }

    if(isset($_POST['UpdateType'])) {
        if($_POST['UpdateType'] == 'Update') {
            $Folder = '../../../'; // we need to update everythings
            $SQLFile = 'setup/sql/upgrade.sql';
            $VerionSQL = " UPDATE `params` SET `UpdateAvailble`='0'; ";
        }elseif($_POST['UpdateType'] =='UpdateProg') {
            $Folder = '../../../Programs/';
            $SQLFile = $Folder .$ObjectName.'/admin/data.sql';
            $VerionSQL = " UPDATE `programs` SET `UpdateAvailble`='0' where `ProgramName`='".$ObjectName."' ; ";
        }elseif($_POST['UpdateType'] =='UpdateBlock') {
            $Folder = '../../../Blocks/';
            $SQLFile = $Folder .$ObjectName.'/admin/data.sql';
            $VerionSQL = " UPDATE `blocks` SET `UpdateAvailble`='0' where `BlockName`='".$ObjectName."' ; ";
        }elseif($_POST['UpdateType'] =='UpdateTheme') {
            $Folder = '../../../'; //themes is distributed system files
            $SQLFile = $Folder .$ObjectName.'/admin/data.sql';
            $VerionSQL = " UPDATE `themes` SET `UpdateAvailble`='0' where `ThemeName`='".$ObjectName."' ; ";
        }
        elseif($_POST['UpdateType'] =='UpdatePlugin') {
            $Folder = '../../../Plugins/';
            $SQLFile = $Folder .$ObjectName.'/admin/data.sql';
            $VerionSQL = "  ";
        }
    }
    else {
        $Folder = '../../../xxx/';
        $SQLFile = $Folder .$ObjectName.'/admin/data.sql';
        $VerionSQL = "  ";
    }
//echo " object esem : ".$ObjectName;
    // do unzip
    $zip = new dUnzip2($Localfile);
    $zip->debug = false;
    $zip->getList();
    $zip->unzipAll($Folder.$ObjectName."/");

    //rename the admin control file name
    if(is_file('../../../admin(renamed).php')) {
        copy('../../../admin(renamed).php','../../../'.$AdminFileName);
    }

    //do restore to sql file
    //get default program value from sql file
    if(is_file($SQLFile)) {
        include_once ("admin/includes/ClassSQLimporter.php");
        $dbUserName = $dbUserPass[0][0];
        $dbPass 	= $dbUserPass[0][1];
        $newImport = new sqlImport ($dbHostName, $dbUserName, $dbPass,$dbBaseName, $SQLFile);
        $newImport->import();
    }

    $unzip = 1;
    $unzipError = unzipError;

    //This is the last update process NOW WE WILL Open the website
    $query = "UPDATE `params` SET `IsOpen` = '1' ;";
    $dbIsOpen ->query($query);

    //update the version to ZERO to set no update availble
    $dbVerionSQL = new db();
    $dbVerionSQL->query($VerionSQL);
    $SetupFolder = date('h-i-s, j-m-y, it is w Day z ');
    @rename("../../../setup", "../../../".md5($SetupFolder));
    //post the xml info to ajax
    header ('Content-type: application/xml; charset="utf-8"',true);
    echo '<?xml version="1.0" standalone="yes"?>
                <installer>
                    <unzip>'.$unzip.'</unzip>
                    <Error>'.$unzipError.'</Error>
                </installer>';
}

if(isset($_POST['AllObjects'])) {
    GetAllUpdates(PostFilter($_POST['AllObjects']));
}

function GetAllUpdates($AllObjects) {
    global $Version;
    //modifie date of last chek
    $dbLastChek = new db();
    $dbLastChek->query(" update `params` set `LastChekUpdate`='".date('Y-m-d H:i:s')."' ; ")  ;

    $AllObjects = VarTheme('\"','"',$AllObjects);
    $AllObjects = VarTheme("\'","'",$AllObjects);
    $AllObjects = new SimpleXMLElement($AllObjects);

    //service state
    $service = $AllObjects->service;
    $status = $AllObjects->status;

    //core
    $core = $AllObjects->core;
    $Name = $core->Name;
    $NewVersion = $core->Version;
    $Compatibility = $core->Compatibility;
    $UpdateDesc = $core->UpdateDesc;

    if(floatval($Version['core'])< floatval($NewVersion)) {
        $dbLastChek->query(" update `params` set `UpdateAvailble`='".$NewVersion."',`UpdateDesc`='".$UpdateDesc."' , `UpdateName`='".$Name."'; ")  ;
    }

    //Programs
    foreach( $AllObjects->program as $program ) {
        $Name = (string)$program->Name;
        $NewVersion = (string)$program->Version;
        $Compatibility = (string)$program->Compatibility;
        $UpdateDesc = (string)$program->UpdateDesc;
        $VersionS = explode('|', $Compatibility);
        foreach($VersionS as $S) {
            if($S ==$Version[$Name]) {//its compatible
                if(floatval($NewVersion)>floatval($Version[$Name])) {//the new version is UP
                    $dbLastChek->query(" update `programs` set
                                        `UpdateAvailble`= '".$NewVersion."',
                                         `UpdateDesc`='".$UpdateDesc."',
                                         `LastChekUpdate`='".date('Y-m-d H:i:s')."'
                                          where `ProgramName`='".$Name."' ;");
                }
                else {
                    $dbLastChek->query(" update `programs` set `UpdateAvailble`= '0',
                     `UpdateDesc`='',`LastChekUpdate`='".date('Y-m-d H:i:s')."'
                      where `ProgramName`='".$Name."' ;");
                }

            }
            else {
                $dbLastChek->query(" update `programs` set `UpdateAvailble`= '0',
                                     `UpdateDesc`='',`LastChekUpdate`='".date('Y-m-d H:i:s')."'
                                      where `ProgramName`='".$Name."' ;");
            }
        }
    }

    //Blocks
    foreach( $AllObjects->block as $block ) {
        $Name = (string)$block->Name;
        $NewVersion = (string)$block->Version;
        $Compatibility = (string)$block->Compatibility;
        $UpdateDesc = (string)$block->UpdateDesc;
        $VersionS = explode('|', $Compatibility);
        foreach($VersionS as $S) {
            if($S ==$Version[$Name]) {//its compatible
                if(floatval($NewVersion)>floatval($Version[$Name])) {//the new version is UP
                    $dbLastChek->query(" update `blocks` set
                                        `UpdateAvailble`= '".$NewVersion."',
                                         `UpdateDesc`='".$UpdateDesc."',
                                         `LastChekUpdate`='".date('Y-m-d H:i:s')."'
                                          where `BlockName`='".$Name."' ;");
                }
                else {
                    $dbLastChek->query(" update `blocks` set `UpdateAvailble`= '0',
                                         `UpdateDesc`='',`LastChekUpdate`='".date('Y-m-d H:i:s')."'
                                          where `BlockName`='".$Name."' ;");
                }
            }
            else {
                $dbLastChek->query(" update `blocks` set `UpdateAvailble`= '0',
                                     `UpdateDesc`='',`LastChekUpdate`='".date('Y-m-d H:i:s')."'
                                      where `BlockName`='".$Name."' ;");
            }
        }
    }

    //Themes
    foreach( $AllObjects->theme as $theme ) {
        $Name = (string)$theme->Name;
        $NewVersion = (string)$theme->Version;
        $Compatibility = (string)$theme->Compatibility;
        $UpdateDesc = (string)$theme->UpdateDesc;
        $VersionS = explode('|', $Compatibility);
        foreach($VersionS as $S) {
            if($S ==$Version[$Name]) {//its compatible
                if(floatval($NewVersion)>floatval($Version[$Name])) {//the new version is UP
                    $dbLastChek->query(" update `themes` set
                                        `UpdateAvailble`= '".$NewVersion."',
                                         `UpdateDesc`='".$UpdateDesc."',
                                         `LastChekUpdate`='".date('Y-m-d H:i:s')."'
                                          where `ThemeName`='".$Name."' ;");
                }
                else {
                    $dbLastChek->query(" update `themes` set `UpdateAvailble`= '0',
                                         `UpdateDesc`='',`LastChekUpdate`='".date('Y-m-d H:i:s')."'
                                          where `ThemeName`='".$Name."' ;");
                }
            }
            else {
                $dbLastChek->query(" update `themes` set `UpdateAvailble`= '0',
                                     `UpdateDesc`='',`LastChekUpdate`='".date('Y-m-d H:i:s')."'
                                      where `ThemeName`='".$Name."' ;");
            }
        }
    }

    header ('Content-type: application/xml; charset="utf-8"',true);
    echo '<?xml version="1.0" standalone="yes"?>
                <installer>
                    <GetAllUpdates>1</GetAllUpdates>
                    <Error>'.GetAllUpdatesError.'</Error>
                </installer>';


}

function MakePTFilesBackup() {

    global $BackupFolder ;

    $AllDir = getFileList("../../../");
    $newzip = new dZip($BackupFolder.'Backup_Files_'.md5(rand(0,999999).date('Y-m-d_H-i-s')).'.zip');

    foreach($AllDir as $item) {
        if(is_dir($item)) {
            $newzip->addDir($item);
        }
        else {
            $newzip->addFile($item, $item);
        }
    }
    $newzip->save();

    return true;

}

function MakePTDatabaseBackup() {

    global $dbHostName,$BackupFolder,$dbBaseName ;

    $database_charset="utf8";
    $database_host=$dbHostName;
    $database_port="3306";

    define('PATH', $BackupFolder);
    define('URL',  $BackupFolder);
    define('TIME_LIMIT', 6000); //number of  maximum execution time  of php script in seconds ,
    define('LIMIT', 1);
    define('DBHOST', $database_host.':'.$database_port);
    define('DBNAMES', '');
    define('CHARSET', $database_charset);
    define('SC', 1);
    define('GS', 1);
    $is_safe_mode = ini_get('safe_mode') == '1' ? 1 : 0;
    if (!$is_safe_mode) {
        if(function_exists('set_time_limit')) {
            @set_time_limit(TIME_LIMIT);
        }
    }
    header("Expires: Tue, 1 Jul 2003 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Pragma: no-cache");
    //$timer = array_sum(explode(' ', microtime()));
    ob_implicit_flush();
    $auth = 0;
    $error = '';
    include_once('../../../admin/todo/support/dumper.php');
    $SK = new dumper();

    $SK->SET = array(
            'last_action' => '0',
            'last_db_backup' => $dbBaseName,
            'tables' => '',
            'comp_method' => '1',
            'comp_level' => '7',
            'last_db_restore' => '',
            'tables_exclude' => '0',
    );

    define('C_DEFAULT', 1);
    define('C_RESULT', 2);
    define('C_ERROR', 3);

    mysqli_query($conn,"/*!40101 SET NAMES '" . CHARSET . "' */") ;
    $SK->backup();
    mysqli_close($conn);

    return true;

}

function wwwcopy($Reomtefile,$Localfile) {

    //$FileSize = remotefilesize($Reomtefile)/1024;
    //$DisplayFileSize = round($FileSize,2);

    //echo ' '. $DisplayFileSize  .' KB <br/>';

    //$PortionPercentage =  $FileSize/50; //every 2%

    $fp  = @fopen($Reomtefile,"rb");
    $fp2 = @fopen($Localfile,"w");
    //$i = 0;
    //$j = 0;
    //$percent = 1;
    while(!feof($fp)) {
        $cont= fread($fp,1024);
        fwrite($fp2,$cont);
        //if($i == $j){
        // $j = round($j+$PortionPercentage);
        // echo '<script>pr('. ($percent-1) .','. $i .')</script>';
        //$percent = $percent + 2;
        // }
        // $i++;
    }
    fclose($fp);
    fclose($fp2);
    // echo '<script>pr(100,'. $DisplayFileSize .')</script>'; //100%
    return true;
}

function getFileList($dir, $recurse=true) {

    // don't include for backup the autoUpdate folder , and each backup folder for admins
    //get admins backup folders into array
    $Excludefolder = array();
    $query = " select * from `admins` ;";
    $dbAdminsFolders = new db();
    $AdminsFolders = $dbAdminsFolders ->get_results($query);
    if($AdminsFolders) {
        foreach($AdminsFolders as $row) {
            if(substr($row->BackupFolder,-1)=='/') {
                $Excludefolder[] = substr( $row->BackupFolder, 0, strlen($row->BackupFolder)-1);
            }
            else {
                $Excludefolder[] = $row->BackupFolder;
            }
        }
    }
    //add the auto update folder and uploads and downloads to the list
    $Excludefolder[] = 'autoUpdate';
    $Excludefolder[] = 'uploads';
    $Excludefolder[] = 'downloads';
    
    $c=0;
    // array to hold return value
    $retval = array();
    // add trailing slash if missing
    if(substr($dir, -1) != "/") $dir .= "/";
    // open pointer to directory and read list of files
    $d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading");
    while(false !== ($entry = $d->read())) {
        // skip up path  dir
        if($entry == "." or $entry == "..") continue;
        foreach ($Excludefolder as $i => $cont) {
            if($dir.$entry =='../../../'.$cont) {
                $c = 1;
                continue;
            }
        }
        if($c==1) {
            $c=0;
            continue;
        }
        if(is_dir("$dir$entry")) {
            $retval[] = $dir.$entry;
            if($recurse && is_readable("$dir$entry/")) {
                $retval = array_merge($retval, getFileList("$dir$entry/", true));
            }
        }
        elseif(is_readable("$dir$entry")) {
            $retval[] = $dir.$entry;
        }
    }
    $d->close();
    return $retval;
}

?>
