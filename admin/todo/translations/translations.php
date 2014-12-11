<?php
/***********************************************
*
*	Project: phpTransformer.com .
*	File Location :  .
*	File Name:  .
*	Date Created: 00-00-2007.
*	Last Modified: 00-00-2007.
*	Descriptions:	.
*	Changes:	.
*	TODO:	 .
*	Author:	mhndm .
*
***********************************************/
?>
<?php
global $ThemeName ;
ini_set('display_errors', 1); 
error_reporting(E_ALL);
$Translations = 'TRANSLATION PROGRAM';
$theList = SubIconLink("Translations","NewTrans"). "<br/>"
        .SubIconLink("Translations","LisTrans"). "<br/>"
        .SubIconLink("Translations","MakeTransZip"). "<br/>";

if(isset($_GET['subdo'])) {
    switch($_GET['subdo']) {
        case "NewTrans":
            $theContent =  NewTrans();
            break;
        case "EditTrans":
            $theContent =  EditTrans();
            break;
        case "LisTrans":
            $theContent =  LisTrans();
            break;
        case "MakeTransZip":
            $theContent = MakeTransZip();
            break;
        default :
            $theContent =  NewTrans();
    }//end switch
}
else {
    $theContent =  LisTrans();
}//end if

$Translations = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$Translations = VarTheme("{todoImg}", "translations.png",$Translations );
$Translations = VarTheme("{ThemeName}", $ThemeName,$Translations );
$Translations = VarTheme("{List}", $theList,$Translations );
$Translations = VarTheme("{Content}", $theContent,$Translations );

function MakeTransZip() {
    global $Lang;

    if(!isset($_POST['ShareTrans'])) {
        $ShareList = '<a target="_blank" href="admin/includes/webfolder/index.php?action=list&dir=admin%2Ftodo%2Ftranslations%2FTransShare&order=name&srt=yes&lang='.$Lang.'" >'
                .ManageLinkInWebFolder.'</a>
                        <br/>'.CurrentShareList.' :<br/>
                    ';
        if(is_dir("admin/todo/translations/TransShare")) {
            $d = dir("admin/todo/translations/TransShare");
            while (($entry = $d->read()) !== false) {
                //echo $entry;
                if($entry!="." and $entry!="..") {
                    if(is_dir($d->path.'/'.$entry)) {
                        $ShareList .= $entry .' : ';
                        $e = dir($d->path.'/'.$entry);
                        while (($ent = $e->read()) !== false) {
                            //echo $entry;
                            if($ent!="." and $ent!="..") {
                                if(is_file($e->path.'/'.$ent)) {
                                    if( substr($ent, strlen($ent)-3,3)=='zip')
                                        $ShareList .= '<a href="admin/todo/translations/TransShare/'.$entry.'/'.$ent.'">'.$ent.'</a>';

                                }
                            }
                        }
                        $e->close();
                        $ShareList .= "<br/>";
                    }
                }
            }
            $d->close();
        }

        $ShareList .='<br/>'.ShareNowThisTranslation.' :
                <form id="formShareTranslation" name="formShareTranslation" method="post" action="">
                  <select class="select" name="ShareTranslation" id="ShareTranslation">';
        if(is_dir("languages")) {
            $d = dir("languages");
            while (($entry = $d->read()) !== false) {
                //echo $entry;
                if($entry!="." and $entry!="..") {
                    if(is_file($d->path.'/'.$entry) and $entry!="index.html" ) {
                        $LangOption = substr($entry, 5, strlen($entry)-9);
                        $ShareList .= '<option value="'.$LangOption.'">'.$LangOption.'</option>';
                    }
                }
            }
            $d->close();
        }
        $ShareList .= ' </select>
            <input class="submit" type="submit" value="'.Share.'" name="ShareTrans" id="ShareTrans"/>
                </form>';
        return $ShareList;
    }
    else {

        $outputDir = "";
        $LangTransName = PostFilter($_POST['ShareTranslation']);
        $zipName = "admin/todo/translations/TransShare/".$LangTransName."/".md5( date("d-m-y-s") ).".zip";
        //create folder
        if(!is_dir("admin/todo/translations/TransShare/".$LangTransName)) { //ex : TransShare/English/sadsadsadsadasdasd.zip
            mkdir("admin/todo/translations/TransShare/".$LangTransName);
        }
        //Empty old dir
        if(is_dir("admin/todo/translations/TransShare/".$LangTransName)) {
            EmptyDirectory("admin/todo/translations/TransShare/".$LangTransName);
            $fd = fopen("admin/todo/translations/TransShare/".$LangTransName."/index.html", "wb");
            fclose($fd);
        }
        include_once("includes/CreateZipFile/CreateZipFile.inc.php");
        $createZipFile = new CreateZipFile;
        //$createZipFile->addDirectory($outputDir);
        // User Interface Translation :
        if(is_file("languages/lang-".$LangTransName.".php")) {
            $fileToZip = "languages/lang-".$LangTransName.".php";
            $fileContents=file_get_contents($fileToZip);
            $createZipFile->addFile($fileContents, $fileToZip);
        }
        // Programs Translation and prog Admin
        $d = dir("Programs");
        while (($entry = $d->read()) !== false) {
            if($entry!="." and $entry!=".." ) {
                if(is_file("Programs/".$entry."/Languages/lang-".$LangTransName.".php")) {
                    $fileToZip = "Programs/".$entry."/Languages/lang-".$LangTransName.".php";
                    $fileContents=file_get_contents($fileToZip);
                    $createZipFile->addFile($fileContents, $fileToZip);
                }
                if(is_file("Programs/".$entry."/admin/Languages/lang-".$LangTransName.".php")) {
                    $fileToZip = "Programs/".$entry."/admin/Languages/lang-".$LangTransName.".php";
                    $fileContents=file_get_contents($fileToZip);
                    $createZipFile->addFile($fileContents, $fileToZip);
                }
            }
        }
        $d->close();

        //Blocks Translation :
        $d = dir("Blocks");
        while (($entry = $d->read()) !== false) {
            if($entry!="." and $entry!="..") {
                if(is_file("Blocks/".$entry."/Languages/lang-".$LangTransName.".php")) {
                    $fileToZip = "Blocks/".$entry."/Languages/lang-".$LangTransName.".php";
                    $fileContents=file_get_contents($fileToZip);
                    $createZipFile->addFile($fileContents, $fileToZip);
                }
                if(is_file("Blocks/".$entry."/admin/Languages/lang-".$LangTransName.".php")) {
                    $fileToZip = "Blocks/".$entry."/admin/Languages/lang-".$LangTransName.".php";
                    $fileContents=file_get_contents($fileToZip);
                    $createZipFile->addFile($fileContents, $fileToZip);
                }
            }
        }
        $d->close();

        //Admin Control Panel Interface
        if(is_file("admin/languages/lang-".$LangTransName.".php")) {
            $fileToZip = "admin/languages/lang-".$LangTransName.".php";
            $fileContents=file_get_contents($fileToZip);
            $createZipFile->addFile($fileContents, $fileToZip);
        }

        $fd = fopen($zipName, "wb");
        $out = fwrite($fd,$createZipFile->getZippedfile());
        fclose($fd);
        return ShareLink. ': <br/><a href="'.$zipName.'">'.$zipName.'</a>';
        
    }
}

function EditTrans() {
    global $CustomHead;
    
    $EditTrans ='';

    //Chosing the file to load
    if(isset($_GET['MainTrans'])) {
        //translation of main file /Languages
        $File = 'languages/lang-'.InputFilter($_GET['MainTrans']).'.php';
    }elseif(isset($_GET['AdminTrans'])) {
        //translation of main file /admin/languages
        $File = 'admin/languages/lang-'.InputFilter($_GET['AdminTrans']).'.php';
    }elseif(isset($_GET['ProgTrans'])) {
        //translation of Program file Programs/{Progname}/Languages
        $TransLang = InputFilter($_GET['TransLang']);
        $ProgTrans = InputFilter($_GET['ProgTrans']);
        $File = 'Programs/'.$ProgTrans.'/Languages/lang-'.$TransLang .'.php';
    }elseif(isset($_GET['ProgAdminTrans'])) {
        //translation of Program admin file Programs/{Progname}/admin/Languages
        $TransLang = InputFilter($_GET['TransLang']);
        $ProgTrans = InputFilter($_GET['ProgAdminTrans']);
        $File = 'Programs/'.$ProgTrans.'/admin/Languages/lang-'.$TransLang .'.php';
    }elseif(isset($_GET['BlockTrans'])) {
        //translation of Block file Blocks/{Blockname}/Languages
        $TransLang = InputFilter($_GET['TransLang']);
        $BlockTrans = InputFilter($_GET['BlockTrans']);
        $File = 'Blocks/'.$BlockTrans.'/Languages/lang-'.$TransLang .'.php';
    }elseif(isset($_GET['BlockAdminTrans'])) {
        //translation of Block Admin file Blocks/admin/{Blockname}/Languages
        $TransLang = InputFilter($_GET['TransLang']);
        $BlockAdminTrans = InputFilter($_GET['BlockAdminTrans']);
        $File = 'Blocks/'.$BlockAdminTrans.'/admin/Languages/lang-'.$TransLang .'.php';
    }elseif(isset($_GET['ThemeTrans'])){
        //translation of Theme file Themes/{ThemeName}/Languages
        $TransLang = InputFilter($_GET['TransLang']);
        $ThemeTrans = InputFilter($_GET['ThemeTrans']);
        $File = 'Themes/'.$ThemeTrans.'/Languages/lang-'.$TransLang .'.php';
    }

    if(isset($File)) {
        if(!isset($_POST['Submit'])) {
            $CustomHead .= '  <script language="javascript" type="text/javascript">
                                document.onkeydown = document.onkeypress = function (evt) {
                                    if (!evt && window.event) {
                                        evt = window.event;
                                    }
                                    var keyCode = evt.keyCode ? evt.keyCode :
                                        evt.charCode ? evt.charCode : evt.which;
                                    if (keyCode) {
                                        if (evt.ctrlKey) {
                                            if(keyCode==83){
                                                                    document.getElementById("Submit").click();
                                                return false;
                                            }
                                            return false;
                                        }
                                    }
                                    return true;
                                }
                            </script>
                        ';
            $EditTrans = LisTrans."<br/>" .' '. $File ."<br/>";
            $EditTrans .= '<form method="post">
                    <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">';
            $lines = file($File, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            // Loop through our array, show HTML source as HTML source; and line numbers too.
            $AuthorInfo = AuthorInfo.' : <input style="width:600px;" name="AuthorInfo" value="">';
            $i=0;
            foreach ($lines as $line_num => $line) {
                if(substr($line, 0, 11)=='*    Author') {
                    $AuthorInfo = str_replace("\'", "'", substr($line, 14) );
                    $AuthorInfo = str_replace("\&quot;", "&quot;", $AuthorInfo );
                    if(!isset($_GET['AdminTrans'])) {
                        $AuthorInfo = AuthorInfo.' : <input style="width:600px;" name="AuthorInfo" value="'.$AuthorInfo.'">';
                    }
                    else {
                        $AuthorInfo = AuthorInfo.' : <input style="width:600px;" name="AuthorInfoAdminTrans" value="'.$AuthorInfo.'">';
                    }
                }
                if(substr($line, 0, 6)=='define' ) {
                    $line = trim($line);
                    $line = substr($line, 7,strlen($line)-7);
                    $line = substr($line, 0,strlen($line)-2);
                    $line = explode(",", $line);
                    $line[0] = trim($line[0]);
                    $line[1] = trim($line[1]);
                    //$line[1] = str_replace("\'", "'", $line[1]);
                    $lineName = substr($line[0],1,strlen($line[0])-2) ;
                    $lineLang = substr($line[1],1,strlen($line[1])-2);
                    $TransArray[$i][0] = $lineName ;
                    $TransArray[$i][1] = $lineLang ;
                    $i++;
                    $EditTrans .= '<tr><td><fieldset style="color:silver;">'.$lineName.'<br/>
                        <textarea style="overflow: scroll; overflow-y: scroll; overflow-x: hidden; overflow:-moz-scrollbars-vertical;" cols="100" rows="3" name="'.$lineName.'">'.$lineLang.'</textarea></fieldset></td></tr>';
                }
            }
            $EditTrans .= '</table>'.$AuthorInfo.'<br/><input class="submit" name="Submit" id="Submit" value="'.submit.'" type="submit"/></form>';
        }
        else {
            $Posts = $_POST;
            // echo  $key.$value;
            //save Translation file
            $First = 1;
            $TranslationData = '';
            foreach($Posts as $lineName=>$lineLang) {
                // echo $First ;
                if($lineName!="Submit" and $lineName!="AuthorInfo" and $lineName!="AuthorInfoAdminTrans") {
                    $lineLang = str_replace("'", "&#39;", $lineLang);
                    $lineLang = str_replace("\\", "", $lineLang);
                    $lineLang = str_replace("\n", "", $lineLang);
                    $lineLang = str_replace(",", "&#44;", $lineLang);
                    $TranslationData .= "define('".$lineName."','".$lineLang."'); \n";
                }
                if(isset($_GET['AdminTrans']) and $lineName=="AuthorInfo" ) {
                    $TranslationData .= "define('AuthorInfo','".$lineLang."'); \n";
                }
            }
            $Translation = "<?php \n/*********************************************** \n*\n*    Project: phpTransformer.com .\n*    Description: phpTransformer Translation Engine	.\n*    License: http://www.gnu.org/licenses/agpl-3.0-standalone.html .\n";
            if(!isset($_GET['AdminTrans'])) {
                $Translation .= "*    Author : ". str_replace('"', "&quot;",PostFilter($_POST['AuthorInfo']))."\n";
            }else {
                $Translation .= "*    Author : ". str_replace('"', "&quot;",PostFilter($_POST['AuthorInfoAdminTrans']))."\n";
            }
            $Translation .= "*    \n***********************************************/ \n";
            $Translation .= $TranslationData;
            $Translation .= '?>';
            //unlink($File);
            $Handle = fopen($File, 'w');
            fwrite($Handle,$Translation);
            $Vars = array('todo','subdo') ;
            $Vals = array('Translations','LisTrans');
            $redirectTO = AdminCreateLink('',$Vars,$Vals);
            $EditTrans = adminPrintMessageAndRedirect(Translations, TranslationSuccessSaved, $redirectTO);
        }
    }
    else {
        $EditTrans ='';
    }
    return $EditTrans;
}
function NewTrans() {
    global $CustomHead;
    if(!isset($_GET['to']) and !isset($_GET['from'])) {
        //display list of all languages files to putit in the get var
        if(!isset($_GET['FromTo'])) {
            $d = dir("Programs");
            $Programs = '';
            while (($entry = $d->read()) !== false) {
                if($entry!="." and $entry!=".." and is_dir($d->path.'/'.$entry)) {
                    $Programs[] = $entry  ;
                }
            }
            $d->close();
            $d = dir("Blocks");
            $Blocks = '';
            while (($entry = $d->read()) !== false) {
                if($entry!="." and $entry!=".." and is_dir($d->path.'/'.$entry)) {
                    $Blocks[]= $entry  ;
                }
            }
            $d->close();
            $NewTrans  = '<strong>'.MainTranslation.'</strong><br/>';
            $Vars =array('todo','subdo','Trans','FromTo') ;
            $Vals =array('Translations','NewTrans','MainTrans','1') ;
            $LinkTrans = AdminCreateLink('',$Vars,$Vals);
            $NewTrans .='<a href="'.$LinkTrans.'">'. MainTrans.'</a><br/><br/>';
            $NewTrans .= ProgTrans.' : <br/>';
            for($i=0;$i<count($Programs);$i++) {
                $Vars =array('todo','subdo','ProgTrans','FromTo') ;
                $Vals =array('Translations','NewTrans',$Programs[$i],'1') ;
                $LinkTrans = AdminCreateLink('',$Vars,$Vals);
                $NewTrans .= '<a href="'.$LinkTrans.'">'.$Programs[$i].'</a>, ';
            }
            $NewTrans .= '<br/><br/>'.BlockTrans.' : <br/>';
            for($i=0;$i<count($Blocks);$i++) {
                $Vars =array('todo','subdo','BlockTrans','FromTo') ;
                $Vals =array('Translations','NewTrans',$Blocks[$i],'1') ;
                $LinkTrans = AdminCreateLink('',$Vars,$Vals);
                $NewTrans .= '<a href="'.$LinkTrans.'">'.$Blocks[$i].'</a>, ';
            }
            $NewTrans .= '<br/><br/><strong>'.AdminControlPanelInterface.'</strong><br/>';
            $Vars =array('todo','subdo','Trans','FromTo') ;
            $Vals =array('Translations','NewTrans','AdminTrans','1') ;
            $LinkTrans = AdminCreateLink('',$Vars,$Vals);
            $NewTrans .= '<a href="'.$LinkTrans.'">'.AdminTrans.'</a><br/><br/>';
            $NewTrans .= ProgAdminTrans.' : <br/>';
            for($i=0;$i<count($Programs);$i++) {
                $Vars =array('todo','subdo','ProgAdminTrans','FromTo') ;
                $Vals =array('Translations','NewTrans',$Programs[$i],'1') ;
                $LinkTrans = AdminCreateLink('',$Vars,$Vals);
                $NewTrans .= '<a href="'.$LinkTrans.'">'.$Programs[$i].'</a>, ';
            }
            $NewTrans .= '<br/><br/>'. BlockAdminTrans.' : <br/>';
            for($i=0;$i<count($Blocks);$i++) {
                $Vars =array('todo','subdo','BlockAdminTrans','FromTo') ;
                $Vals =array('Translations','NewTrans',$Blocks[$i],'1') ;
                $LinkTrans = AdminCreateLink('',$Vars,$Vals);
                $NewTrans .= '<a href="'.$LinkTrans.'">'.$Blocks[$i].'</a>, ';
            }
            $NewTrans .= '<br/>';
        }
        else {
            $NewTrans = '<script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
                    <link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" /><form method="get" name="TranslateFromTo"><table border="0" cellpadding="2" cellspacing="2">
                    <table style="text-align: left;" border="0" cellpadding="2" cellspacing="2">
                          <tr><td><strong>'.FromLanguage.'</strong></td><td>
                            <select class="select" name="from">';
            $d = dir("languages");
            $Blocks = '';
            while (($entry = $d->read()) !== false) {
                if($entry!="." and $entry!=".." and !is_dir($d->path.'/'.$entry)) {
                    if(substr($entry, 0,4) =='lang') {
                        $NewTrans.='<option value="'.substr($entry, 5,strlen($entry)-9).'">'.substr($entry, 5,strlen($entry)-9).'</option>';
                    }
                }
            }
            $d->close();
            $NewTrans.=  '</select></td></tr>
                      <tr><td><strong>'.StandardOrCustom.'</strong></td><td>
                      <select class="select" name="StandardOrCustom">
                      <option value="Standard">'.Standard.'</option>
                      <option value="Custom" selected="selected" >'.Custom.'</option>
                      </select></td></tr>
                      <tr>
                      <input name="todo" value="Translations" type="hidden">
                      <input name="subdo" value="NewTrans" type="hidden">';
            if(isset($_GET['ProgTrans'])) {
                $NewTrans.=  ' <input name="ProgTrans" value="'.InputFilter($_GET['ProgTrans']).'" type="hidden">';
            }
            if(isset($_GET['BlockTrans'])) {
                $NewTrans.=  ' <input name="BlockTrans" value="'.InputFilter($_GET['BlockTrans']).'" type="hidden">';
            }
            if(isset($_GET['ProgAdminTrans'])) {
                $NewTrans.=  ' <input name="ProgAdminTrans" value="'.InputFilter($_GET['ProgAdminTrans']).'" type="hidden">';
            }
            if(isset($_GET['BlockAdminTrans'])) {
                $NewTrans.=  ' <input name="BlockAdminTrans" value="'.InputFilter($_GET['BlockAdminTrans']).'" type="hidden">';
            }
            if(isset($_GET['BlockAdminTrans'])) {
                $NewTrans.=  ' <input name="BlockAdminTrans" value="'.InputFilter($_GET['BlockAdminTrans']).'" type="hidden">';
            }
            if(isset($_GET['Trans'])) {
                $NewTrans.=  ' <input name="Trans" value="'.InputFilter($_GET['Trans']).'" type="hidden">';
            }
            $NewTrans.=  '<td><strong>'.TheNewLanguage .'</strong><br></td>
                      <td><span id="sprytextfield1">
                      <input name="to"><span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>
                          </td></tr></table>
                          <br>
                          ( '.MustBeInLatinLattersIfExistEditElseCreateNewFiles.' )<br/>
                       '.TranslationStandardOrCustom.'<br/>
                        <input class="submit" type="submit" value="'.submit.'"></form>
                         
                      <script type="text/javascript">
                        <!--
			var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
			//-->
			</script>';
        }

    }else {
        if(!isset($_POST['SubmitSaveTrans'])) {
            $CustomHead .= ' <script language="javascript" type="text/javascript">
                        document.onkeydown = document.onkeypress = function (evt) {
                            if (!evt && window.event) {
                                evt = window.event;
                            }
                            var keyCode = evt.keyCode ? evt.keyCode :
                                evt.charCode ? evt.charCode : evt.which;
                            if (keyCode) {
                                if (evt.ctrlKey) {
                                    if(keyCode==83){
                                                            document.getElementById("SubmitSaveTrans").click();
                                        return false;
                                    }
                                    return false;
                                }
                            }
                            return true;
                        }
                    </script> ';
            if($_GET['StandardOrCustom']=='Custom') {
                $Custom = '.pt';
            }
            else {
                $Custom = '';
            }
            $NewTrans = '';
            if(isset($_GET['from'])) {
                $From = InputFilter($_GET['from']);
            }else {
                $From = '';
            }

            if(isset($_GET['to'])) {
                $To = RightLangFileName(InputFilter($_GET['to']));
            }else {
                $To = '';
            }
            if($To=='') {
                return InvalidFileName;
            }
            if(isset($_GET['StandardOrCustom'])) {
                $StandardOrCustom = InputFilter($_GET['StandardOrCustom']);
            }else {
                $StandardOrCustom = '';
            }
            if(isset($_GET['ProgTrans'])) {
                $ProgTrans = InputFilter($_GET['ProgTrans']);
                $File = 'Programs/'.$ProgTrans.'/Languages/lang-'.$To .$Custom.'.php';
                $FileFrom = 'Programs/'.$ProgTrans.'/Languages/lang-'.$From .'.php';
            }else {
                $ProgTrans = '';
            }
            if(isset($_GET['ProgAdminTrans'])) {
                $ProgAdminTrans = InputFilter($_GET['ProgAdminTrans']);
                $File = 'Programs/'.$ProgAdminTrans.'/admin/Languages/lang-'.$To .$Custom.'.php';
                $FileFrom = 'Programs/'.$ProgAdminTrans.'/admin/Languages/lang-'.$From .'.php';

            }else {
                $ProgAdminTrans = '';
            }
            if(isset($_GET['BlockTrans'])) {
                $BlockTrans = InputFilter($_GET['BlockTrans']);
                $File = 'Blocks/'.$BlockTrans.'/Languages/lang-'.$To .$Custom.'.php';
                $FileFrom = 'Blocks/'.$BlockTrans.'/Languages/lang-'.$From .'.php';
            }else {
                $BlockTrans = '';
            }

            if(isset($_GET['BlockAdminTrans'])) {
                $BlockAdminTrans = InputFilter($_GET['BlockAdminTrans']);
                $File = 'Blocks/'.$BlockAdminTrans.'/admin/Languages/lang-'.$To .$Custom.'.php';
                $FileFrom = 'Blocks/'.$BlockAdminTrans.'/admin/Languages/lang-'.$From .'.php';
            }else {
                $BlockAdminTrans = '';
            }
            if(isset($_GET['Trans'])) {
                $Trans = InputFilter($_GET['Trans']);
                if($Trans=='MainTrans') {
                    $File = 'languages/lang-'.$To .$Custom.'.php';
                    $FileFrom = 'languages/lang-'.$From .'.php';
                }elseif($Trans=='AdminTrans') {
                    $File = 'admin/languages/lang-'.$To .$Custom.'.php';
                    $FileFrom = 'admin/languages/lang-'.$From .'.php';
                }else {
                    $File = '';
                    $FileFrom ='';
                }
            }
            /* check if file exist */
            $NewTrans .= Translations .' '. From.' ' .$From .' ' .to.' '.$To ."<br/>".$File;
            if(is_file($File )) {
                $Oldlines = file($File, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $OldTransArray = array();
                foreach ($Oldlines as $key => $data) {
                    if(substr($data, 0, 6)=='define' ) {
                        $Oldline = substr($data, 7,strlen($data)-7);
                        $Oldline = substr($Oldline, 0,strlen($Oldline)-2);
                        $Oldline = explode(",", $Oldline);
                        $Oldline[0] = trim($Oldline[0]);
                        $Oldline[1] = trim($Oldline[1]);
                        $Oldline[1] = str_replace("\'", "'", $Oldline[1]);
                        $OldlineName = substr($Oldline[0],1,strlen($Oldline[0])-2) ;
                        $OldlineLang = substr($Oldline[1],1,strlen($Oldline[1])-3);
                        $OldTransArray[$OldlineName] = $OldlineLang ;
                    }
                }
            }
            //load constant from the main language
            $lines = file($FileFrom, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            // Loop through our array, show HTML source as HTML source; and line numbers too.
            $NewTrans .= '<form id="form_trans" method="post">
                    <table  border="0" cellpadding="2" cellspacing="2">';
            $AuthorInfo = AuthorInfo.' : <input size="120" name="AuthorInfo" value="">';
            $i=0;
            foreach ($lines as $line_num => $line) {
                if(substr($line, 0, 11)=='*    Author') {
                    $AuthorInfo = str_replace("\'", "'", substr($line, 14) );
                    $AuthorInfo = str_replace("\&quot;", "&quot;", $AuthorInfo );
                    if(!isset($_GET['AdminTrans'])) {
                        $AuthorInfo = AuthorInfo.' : <input style="width:800px;" name="AuthorInfo" value="'.$AuthorInfo.'">';
                    }
                    else {
                        $AuthorInfo = AuthorInfo.' : <input  style="width:800px;" name="AuthorInfoAdminTrans" value="'.$AuthorInfo.'">';
                    }
                }
                if(substr($line, 0, 6)=='define' ) {
                    $line = substr($line, 7,strlen($line)-7);
                    $line = substr($line, 0,strlen($line)-2);
                    $line = explode(",", $line);
                    $line[0] = trim($line[0]);
                    $line[1] = trim($line[1]);
                    $line[1] = str_replace("\'", "'", $line[1]);
                    $lineName = substr($line[0],1,strlen($line[0])-2) ;
                    $lineLang = substr($line[1],1,strlen($line[1])-3);
                    $i++;
                    if(isset($OldTransArray[$lineName])) {
                        $OldTrans = $OldTransArray[$lineName];
                    }else {
                        $OldTrans = '';
                    }
                    $NewTrans .= '<tr><td><fieldset><div dir="ltr"   style="color:silver;">'.$lineName.'</div>'.$lineLang.'<br/>
                                <textarea style="overflow: scroll; overflow-y: scroll; overflow-x: hidden;
                                overflow:-moz-scrollbars-vertical;" cols="100" rows="3" name="'.$lineName.'">'
                            .$lineLang.'</textarea></fieldset></td></tr>';
                }
            }
            $NewTrans .= '</table>'.$AuthorInfo.'<br/>'
                    . '<input class="submit" name="SubmitSaveTrans" id="SubmitSaveTrans" value="'.submit.'" type="submit"/>'
                    . '&nbsp;&nbsp;&nbsp;<input type="button" class="submit" onclick="$(\'#form_trans\').find(\'textarea\').val(\'\');" value="'.clear.'" />'
                    . '</form>';
        }
        else {
            //save to file
            $Posts = $_POST;
            //Chosing the file
            if($_GET['StandardOrCustom']=='Custom') {
                $Custom = '.pt';
            }
            else {
                $Custom = '';
            }
            if(isset($_GET['Trans'])) {
                if($_GET['Trans']=='MainTrans') {
                    //translation of main file /Languages
                    $File = 'languages/lang-'.InputFilter($_GET['to']).$Custom.'.php';
                }elseif($_GET['Trans']=='AdminTrans') {
                    //translation of main file /admin/languages
                    $File = 'admin/languages/lang-'.InputFilter($_GET['to']).$Custom.'.php';
                }
            }elseif(isset($_GET['ProgTrans'])) {
                //translation of Program file Programs/{Progname}/Languages
                $TransLang = InputFilter($_GET['to']);
                $ProgTrans = InputFilter($_GET['ProgTrans']);
                $File = 'Programs/'.$ProgTrans.'/Languages/lang-'.$TransLang .$Custom.'.php';
            }elseif(isset($_GET['ProgAdminTrans'])) {
                //translation of Program admin file Programs/{Progname}/admin/Languages
                $TransLang = InputFilter($_GET['to']);
                $ProgTrans = InputFilter($_GET['ProgAdminTrans']);
                $File = 'Programs/'.$ProgTrans.'/admin/Languages/lang-'.$TransLang .$Custom.'.php';
            }elseif(isset($_GET['BlockTrans'])) {
                //translation of Block file Blocks/{Blockname}/Languages
                $TransLang = InputFilter($_GET['to']);
                $BlockTrans = InputFilter($_GET['BlockTrans']);
                $File = 'Blocks/'.$BlockTrans.'/Languages/lang-'.$TransLang .$Custom.'.php';
            }elseif(isset($_GET['BlockAdminTrans'])) {
                //translation of Block Admin file Blocks/admin/{Blockname}/Languages
                $TransLang = InputFilter($_GET['to']);
                $BlockAdminTrans = InputFilter($_GET['BlockAdminTrans']);
                $File = 'Blocks/'.$BlockAdminTrans.'/admin/Languages/lang-'.$TransLang .$Custom.'.php';
            }
            //save Translation file
            $First = 1;
            $TranslationData = '';
            foreach($Posts as $lineName=>$lineLang) {
                if($lineName!="SubmitSaveTrans" and $lineName!="AuthorInfo" and $lineName!="AuthorInfoAdminTrans") {
                    $lineLang = str_replace("'", "&#39;", $lineLang);
                    $lineLang = str_replace("\n", "", $lineLang);
                    $lineLang = str_replace(",", "&#44;", $lineLang);
                    $TranslationData .= "define('".$lineName."','".$lineLang."'); \n";
                }
                if(isset($_GET['AdminTrans']) and $lineName=="AuthorInfo" ) {
                    $TranslationData .= "define('AuthorInfo','".$lineLang."'); \n";
                }
            }
            $Translation = "<?php \n/*********************************************** \n*\n*    Project: phpTransformer.com .\n*    Description: phpTransformer Translation Engine	.\n*    License: http://www.gnu.org/licenses/agpl-3.0-standalone.html .\n";
            if(!isset($_GET['AdminTrans'])) {
                $Translation .= "*    Author : ". str_replace('"', "&quot;",PostFilter($_POST['AuthorInfo']))."\n";
            }else {
                $Translation .= "*    Author : ". str_replace('"', "&quot;",PostFilter($_POST['AuthorInfoAdminTrans']))."\n";
            }
            $Translation .= "*    \n***********************************************/ \n";
            $Translation .= $TranslationData;
            $Translation .= '?>';
            // unlink($File);
            $Handle = fopen($File, 'w');
            fwrite($Handle,$Translation);
            $Vars = array('todo','subdo') ;
            $Vals = array('Translations','NewTrans');
            $redirectTO = AdminCreateLink('',$Vars,$Vals);
            $NewTrans = adminPrintMessageAndRedirect(Translations, TranslationSuccessSaved, $redirectTO);
        }
    }
    return $NewTrans;
}

function LisTrans() {

    $UserProgLisTrans = '<strong> * '.MainTranslation.' : </strong>';
    //main translation
    $d = dir("languages");
    while (($entry = $d->read()) !== false) {
        if($entry!="." and $entry!=".." and (substr($entry, 0,4) =='lang')) {
            $Vars =array('todo','subdo','MainTrans') ;
            $Vals =array('Translations','EditTrans',substr($entry , 5, strlen($entry)-9)) ;
            $LinkTrans = AdminCreateLink('',$Vars,$Vals);
            $UserProgLisTrans.=  '&nbsp;&nbsp;<a href="'.$LinkTrans.'" >'.substr($entry , 5, strlen($entry)-9) .'</a>,';

        }//end if
    }//end while
    $d->close();
    // user interface Programs
    $UserProgLisTrans.= '<br/><br/><span style="text-decoration: underline;">'.Programs .' : </span><br/> <br/> <div dir="ltr" width="100%">' ;
    $d = dir("Programs");
    while (($entry = $d->read()) !== false) {
        if($entry!="." and $entry!=".." and is_dir($d->path.'/'.$entry)) {

            if(is_dir($d->path.'/'.$entry.'/Languages')) {
                $UserProgLisTrans.= $entry .' : ';
                $f = dir($d->path.'/'.$entry.'/Languages');
                while (($files = $f->read()) !== false) {
                    if($files!="." and $files!=".." and (substr($files, 0,4) =='lang')) {
                        $Vars =array('todo','subdo','ProgTrans','TransLang') ;
                        $Vals =array('Translations','EditTrans',$entry,substr($files , 5, strlen($files)-9)) ;
                        $LinkTrans = AdminCreateLink('',$Vars,$Vals);
                        $UserProgLisTrans.= '&nbsp;&nbsp;<a href="'.$LinkTrans.'" >'.substr($files , 5, strlen($files)-9).'</a>,';
                    }//end if
                }
                $UserProgLisTrans.='<br/>';
            }
        }
    }//end while
    $d->close();
    $UserProgLisTrans.= '</div>';

    // user interface Blocks
    $UserBlockLisTrans = '<span style="text-decoration: underline;">'.Blocks .' : </span><br/><br/><div dir="ltr" width="100%">' ;
    $d = dir("Blocks");
    while (($entry = $d->read()) !== false) {
        if($entry!="." and $entry!=".." and is_dir($d->path.'/'.$entry)) {
            if(is_dir($d->path.'/'.$entry.'/Languages')) {
                $UserBlockLisTrans.= $entry .' : ';
                $f = dir($d->path.'/'.$entry.'/Languages');
                while (($files = $f->read()) !== false) {
                    if($files!="." and $files!=".." and (substr($files, 0,4) =='lang')) {
                        $Vars =array('todo','subdo','BlockTrans','TransLang') ;
                        $Vals =array('Translations','EditTrans',$entry,substr($files , 5, strlen($files)-9)) ;
                        $LinkTrans = AdminCreateLink('',$Vars,$Vals);
                        $UserBlockLisTrans.= '&nbsp;&nbsp;<a href="'.$LinkTrans.'" >'.substr($files , 5, strlen($files)-9).'</a>,';
                    }//end if
                }
                $UserBlockLisTrans.='<br/>';
            }

        }
    }//end while
    $d->close();
    $UserBlockLisTrans.= '</div>';

    //admin panel
    $AdminProgLisTrans= '<strong>*'.AdminControlPanelInterface .' : </strong>' ;
    $d = dir("admin/languages");
    while (($entry = $d->read()) !== false) {
        if($entry!="." and $entry!=".." and (substr($entry, 0,4) =='lang')) {
            $Vars =array('todo','subdo','AdminTrans') ;
            $Vals =array('Translations','EditTrans',substr($entry , 5, strlen($entry)-9)) ;
            $LinkTrans = AdminCreateLink('',$Vars,$Vals);
            $AdminProgLisTrans.= '&nbsp;&nbsp;<a href="'.$LinkTrans.'" >'.substr($entry , 5, strlen($entry)-9).'</a>,';

        }//end if
    }//end while
    $d->close();


    // admin Programs
    $AdminProgLisTrans.= '<br/><br/><span style="text-decoration: underline;">'.Programs .' : </span><br/> <br/> <div dir="ltr" width="100%">' ;
    $d = dir("Programs");
    while (($entry = $d->read()) !== false) {
        if($entry!="." and $entry!=".." and is_dir($d->path.'/'.$entry)) {

            if(is_dir($d->path.'/'.$entry.'/admin/Languages')) {
                $AdminProgLisTrans.= $entry .' : ';
                $f = dir($d->path.'/'.$entry.'/admin/Languages');
                while (($files = $f->read()) !== false) {
                    if($files!="." and $files!=".." and (substr($files, 0,4) =='lang')) {
                        $Vars =array('todo','subdo','ProgAdminTrans','TransLang') ;
                        $Vals =array('Translations','EditTrans',$entry,substr($files , 5, strlen($files)-9)) ;
                        $LinkTrans = AdminCreateLink('',$Vars,$Vals);
                        $AdminProgLisTrans.= '&nbsp;&nbsp;<a href="'.$LinkTrans.'" >'. substr($files , 5, strlen($files)-9).'</a>,';
                    }//end if
                }
                $AdminProgLisTrans.='<br/>';
            }

        }
    }//end while
    $d->close();
    $AdminProgLisTrans.= '</div>';

    // admin Blocks
    $AdminBlockLisTrans= '<span style="text-decoration: underline;">'.Blocks .' :</span><br/> <br/> <div dir="ltr" width="100%">' ;
    $d = dir("Blocks");
    while (($entry = $d->read()) !== false) {
        if($entry!="." and $entry!=".." and is_dir($d->path.'/'.$entry)) {
            if(is_dir($d->path.'/'.$entry.'/admin/Languages')) {
                $AdminBlockLisTrans.= $entry .' : ';
                $f = dir($d->path.'/'.$entry.'/admin/Languages');
                while (($files = $f->read()) !== false) {
                    if($files!="." and $files!=".." and (substr($files, 0,4) =='lang')) {
                        $Vars =array('todo','subdo','BlockAdminTrans','TransLang') ;
                        $Vals =array('Translations','EditTrans',$entry,substr($files , 5, strlen($files)-9)) ;
                        $LinkTrans = AdminCreateLink('',$Vars,$Vals);
                        $AdminBlockLisTrans.='&nbsp;&nbsp;<a href="'.$LinkTrans.'" >'. substr($files , 5, strlen($files)-9).'</a>,';
                    }//end if
                }
                $AdminBlockLisTrans.='<br/>';
            }
        }
    }//end while
    $d->close();
    $AdminBlockLisTrans.= '</div>';
    
    
    
        // admin Blocks
    $themes_trans = '<span style="text-decoration: underline;">'.Theme .' :</span><br/> <br/> <div dir="ltr" width="100%">' ;
    $d = dir("Themes");
    while (($entry = $d->read()) !== false) {
        if($entry!="." and $entry!=".." and is_dir($d->path.'/'.$entry)) {
            if(is_dir($d->path.'/'.$entry.'/Languages')) {
                $themes_trans.= $entry .' : ';
                $f = dir($d->path.'/'.$entry.'/Languages');
                while (($files = $f->read()) !== false) {
                    if($files!="." and $files!=".." and (substr($files, 0,4) =='lang')) {
                        $Vars =array('todo','subdo','ThemeTrans','TransLang') ;
                        $Vals =array('Translations','EditTrans',$entry,substr($files , 5, strlen($files)-9)) ;
                        $LinkTrans = AdminCreateLink('',$Vars,$Vals);
                        $themes_trans.='&nbsp;&nbsp;<a href="'.$LinkTrans.'" >'. substr($files , 5, strlen($files)-9).'</a>,';
                    }//end if
                }
                $themes_trans.='<br/>';
            }
        }
    }//end while
    $d->close();
    $themes_trans.= '</div>';
    

    $LisTrans = '<table width: 100%;" border="0" cellpadding="2" cellspacing="20">
                        <tr>
                          <td style="vertical-align: top;">'.$UserProgLisTrans.'</td>
                          <td style="vertical-align: top;">'.$AdminProgLisTrans.'</td>
                        </tr>
                        <tr>
                          <td style="vertical-align: top;">'.$UserBlockLisTrans.'</td>
                          <td style="vertical-align: top;">'.$AdminBlockLisTrans.'</td>
                        </tr>
                        <tr>
                            <td>'.$themes_trans.' </td>
                        </tr>
                    </table>';

    return $LisTrans;
}

?>