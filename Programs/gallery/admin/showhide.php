<?php
require_once '../../../includes.php';
if (isset($phpTransformer)) {
    @session_id($phpTransformer);
    @session_start();

    if (isset($_SESSION['Login' . $WebsiteUrl])) {
        if ($_SESSION['Login' . $WebsiteUrl]) {
            $UserId = $_SESSION['UserId'];
            $Lang = $_SESSION['Lang'];
            
            if(isset($_GET['id'])){
                  $id = InputFilter($_GET['id']);
            }else{
                  $id ='';
            }

            //get current visibility
            $db = new db();
            $visible = $db->get_var(" select `visible` from `gallery` where `IdMedia`='" . $id . "' ; ");
            if ($visible) {
                $db->query(" update `gallery` set `visible`=0 where `IdMedia`='" . $id . "' ;");
                echo 'hidden.png';
            } else {
                $db->query(" update `gallery` set `visible`=1 where `IdMedia`='" . $id . "' ;");
                addMedia();
                echo 'visible.png';
            }
        }
    } else {
        die("warning.png");
    }
} else {
    die("warning.png");
}

function addMedia($galid = false) {
    global $TimeFormat;
    //$TheNavBar[] = array(BackToMedia, "javascript:history.go(-1)");

    if (!$galid) {
        if (!isset($_GET['galid'])) {
            return false;
        } else {
            $galid = InputFilter($_GET['galid']);
        }
    }

    if ($galid) {
        if (InfoInDatabase($galid)) {//cheking if this path aleady in the db
            return false;
        } else {
            $Path = $galid;
            $IdMedia = GenerateID('gallery', 'IdMedia');
            $AddDate = date('Y-m-d H:i:s');
            $MediaType = MediaType($Path);
            $db = new db();
            $db->query("INSERT INTO `gallery` ( `IdMedia` , `Path` , `AddDate` , `MapLocation` , `MediaRank` , `MediaType`,`visible` )
			VALUES ('" . $IdMedia . "', '" . $Path . "', '" . $AddDate . "', '', '', '" . $MediaType . "' ,1);");

            $dbLang = new db();
            $Langs = $dbLang->get_results("SELECT * FROM `languages`;");
            if ($Langs) {
                foreach ($Langs as $language) {
                    $IdLang = $language->IdLang;
                    $dbInsetLang = new db();
                    $xe = explode("/", $Path);
                    $caption = end($xe);
                    $last_dot = strrpos($caption, ".");
                    if ($last_dot) {
                        $caption = substr($caption, 0, $last_dot);
                    } else {
                        $caption = substr($caption, 0);
                    }


                    $db->query("INSERT INTO `gallerylang` ( `IdMedia` , `IdLang` , `Caption` , `Desc` , `Place` , `Tags` )
                VALUES ('" . $IdMedia . "', '" . $IdLang . "', '" . $caption . "', '', '', '')");
                }//end foreach
            }//end if

            $MediaUrl = CreateLink('', array('Prog', 'show', 'galid'), array('gallery', 'all', $IdMedia));

            return true;
        }//end if
    }//end if
}

function InfoInDatabase($Path) {
    global $Lang;
    $IdMedia = null;
    $i = 0;
    $Info = array();
    if ($Path) {
        $db = new db();
        $IdLang = $db->get_var("SELECT `IdLang` FROM `languages` where `LangName`='" . $Lang . "';");
        $db = new db();
        $IdMedia = $db->get_var("SELECT `IdMedia` FROM `gallery` where `Path`='" . $Path . "';");
        if ($IdMedia) {
            $db = new db();
            $InfoInDatabase = $db->get_results("SELECT * FROM `gallery`,`gallerylang` 
                			WHERE
                			`gallery`.`IdMedia`=`gallerylang`.`IdMedia` and
                			`gallerylang`.`IdLang`='" . $IdLang . "' and 
                			`gallery`.`Path`='" . $Path . "';");
            if ($InfoInDatabase) {
                foreach ($InfoInDatabase as $Record) {
                    $Info[0]['IdMedia'] = $Record->IdMedia;
                    $Info[0]['Path'] = $Record->Path;
                    $Info[0]['AddDate'] = $Record->AddDate;
                    $Info[0]['MapLocation'] = $Record->MapLocation;
                    $Info[0]['MediaRank'] = $Record->MediaRank;
                    $Info[0]['MediaType'] = $Record->MediaType;
                    $Info[0]['Caption'] = $Record->Caption;
                    $Info[0]['Desc'] = substr($Record->Desc, 0, 75) . '...';
                    $Info[0]['Place'] = substr($Record->Place, 0, 75) . '...';
                    $Info[0]['Tags'] = $Record->Tags;
                    $Info[0]['visible'] = $Record->visible;
                }//end for each
            }//end if

            $db = new db();
            $InfoInDatabase = $db->get_results("SELECT * FROM `galleryfav`
                			WHERE
                			`IdMedia` = '" . $IdMedia . "';");
            if ($InfoInDatabase) {

                foreach ($InfoInDatabase as $Record) {
                    $i++;
                    $Info[$i]['UserId'] = $Record->UserId;
                    $Info[$i]['Comment'] = $Record->Comment;
                    $Info[$i]['Date'] = $Record->Date;
                }//end for each
            }//end if

            return $Info;
        } else {
            return false;
        }//end if
    } else {
        return false;
    }//end if
}

function MediaType($Path) {
    if ($Path) {
        if (is_dir("../../../".$Path)) {
            return 'folder';
        } else {
            $FileName = substr($Path, strrpos($Path, "/") + 1);
            $Extension = substr($FileName, strrpos($FileName, ".") + 1);
            return trim($Extension);
        }//end if
    } else {
        return false;
    }//end if
}

?>
