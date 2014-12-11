<?php
/***********************************************
*
*	Project: phpTransformer.com .
*	File Location :  .
*	File Name:  .
*	Descriptions:	.
*	Changes:	.
*	TODO:	 .
****	Author: Mohsen Mousawi mhndm@phptransformer.com .
*
***********************************************/
?>
<?php  if (!isset($IsAdmin)){header("location: ../");} ?>
<?php
//the plugins mus'nt remove the pt.com line hash
if(isset($_GET['Enable'])) {
    $PluginName = InputFilter($_GET['Enable']);
    ReadPlugin($PluginName);
    $Plugins = EnablePlugin($PluginName);
}elseif(isset($_GET['Disable'])) {
    $PluginName = InputFilter($_GET['Disable']);
    ReadPlugin($PluginName);
    $Plugins = DisablePlugin($PluginName);
}
else {
    $Plugins = PluginsList();
}

function EnablePlugin($PluginName) {
    global $PlugArray;
    //excute the plugin , the file path must be writable and internal file

    //var_dump($PlugArray);

    //cheking existence of folder
    if(!is_dir("admin/todo/plugins/PluginsTemp")) {
        mkdir("admin/todo/plugins/PluginsTemp");
    }
    //empty the folder from old data
    EmptyDirectory("admin/todo/plugins/PluginsTemp");

    foreach($PlugArray as $ArrayLine) {
        $SignC = $ArrayLine['s'];
        $LineC = $ArrayLine['n'];
        $FileC = $ArrayLine['f'];
        $CodeC = $ArrayLine['c'];
        if(file_exists($FileC)) {

            //copy the file to the plugin directory with full path
            $LastSlash = strrpos($FileC,'/');
            $SourcePath = substr($FileC, 0, $LastSlash);
            //echo "<br/>";
            $DestPath ='admin/todo/plugins/PluginsTemp/'.$SourcePath;
            //echo "<br/>";
            $FileName = substr($FileC, $LastSlash+1);
            //echo "<br/>";
            CopyFileWithFullPath($SourcePath,$DestPath,$FileName );

            //CopyFileWithFullPath("./","plugins/PluginsTemp/",$FileC );
            $FileC = 'admin/todo/plugins/PluginsTemp/'.$FileC;
            $file = fopen($FileC,'r');
            $j = 1;
            $FileLinesArr = array();

            while(!feof($file)) {

                $FileLine = trim (fgets($file),"\n\r"  );
                $FileLinesArr[$j]=$FileLine."\n";//Add to the array the line
                //echo $j .' '. $LineC ."<br/>";
                if($j == $LineC) {
                    if($SignC=='-') {
                        //echo $FileLine. $CodeC."<br/>";
                        if($FileLine == $CodeC) {
                            //echo "correct \n"; //remove the ligne
                            $FileLinesArr[$j] = "\n";
                        }
                        else {
                            return WarningPluginNotCompatilbleOrAlreadyModifiedOrAnotherPlugin;
                           // return false;
                        }
                    }
                    else {
                        //+
                        //echo 'add';
                        $FileLinesArr[$j] = $CodeC."\n";
                    }

                }
                $j++;

            }
            //close the file
            fclose($file );
            //remoe the last \n
            $FileLinesArr[count($FileLinesArr)]= str_replace("\n", "", $FileLinesArr[count($FileLinesArr)]);
            //put the array into the file
            //var_dump($FileLinesArr);
            file_put_contents($FileC,$FileLinesArr );

        }


        //copy the file to the original path
        $FileC = str_replace("admin/todo/plugins/PluginsTemp/", "", $FileC);
        CopyFileWithFullPath("./admin/todo/plugins/PluginsTemp/","./",$FileC );
        EmptyDirectory("admin/todo/plugins/PluginsTemp/");




    }
    //set this plugin enabled in the database
    $dbEnable = new db();
    $Enable = $dbEnable->query(" INSERT INTO `plugins` (`id` ,`name`)VALUES ('".GenerateID("plugins", "id")."', '".$PluginName."'); ");
    return SuccessPluginEnable.' : ' .$PluginName;
}

function DisablePlugin($PluginName) {

    global $PlugArray;
    //excute the plugin , the file path must be writable and internal file

    //cheking existence of folder
    if(!is_dir("admin/todo/plugins/PluginsTemp")) {
        mkdir("admin/todo/plugins/PluginsTemp");
    }
    //empty the folder from old data
    EmptyDirectory("admin/todo/plugins/PluginsTemp");

    for($i= count($PlugArray)-1;$i>=0;$i--) {
        $ArrayLine = $PlugArray[$i];
        $SignC = $ArrayLine['s'];
        $LineC = $ArrayLine['n'];
        $FileC = $ArrayLine['f'];
        $CodeC = $ArrayLine['c'];
        if(file_exists($FileC)) {

            //copy the file to the plugin directory with full path
            $LastSlash = strrpos($FileC,'/');
            $SourcePath = substr($FileC, 0, $LastSlash);
            //echo "<br/>";
            $DestPath ='admin/todo/plugins/PluginsTemp/'.$SourcePath;
            //echo "<br/>";
            $FileName = substr($FileC, $LastSlash+1);
            //echo "<br/>";
            CopyFileWithFullPath($SourcePath,$DestPath,$FileName );

            $FileC = 'admin/todo/plugins/PluginsTemp/'.$FileC;
            $file = fopen($FileC,'r');
            $j=1;
            $FileLinesArr = array();

            while(!feof($file)) {

                $FileLine = trim (fgets($file),"\n\r"  );
                $FileLinesArr[$j]=$FileLine."\n";//Add to the array the line
                if($j == $LineC) {
                    if($SignC=='+') {
                        if($FileLine == $CodeC) {
                            $FileLinesArr[$j] = "\n";
                        }
                        else {
                            return WarningPluginNotCompatilbleOrAlreadyModifiedOrAnotherPlugin;
                           // return false;
                        }
                    }
                    else {
                        //-
                        $FileLinesArr[$j] = $CodeC."\n";
                    }

                }
                $j++;

            }
            //close the file
            fclose($file );

            //remoe the last \n
            $FileLinesArr[count($FileLinesArr)]= str_replace("\n", "", $FileLinesArr[count($FileLinesArr)]);
            //put the array into the file
            //var_dump($FileLinesArr);      
            file_put_contents($FileC,$FileLinesArr );
        }


        //copy the file to the original path
        $FileC = str_replace("admin/todo/plugins/PluginsTemp/", "", $FileC);
        CopyFileWithFullPath("./admin/todo/plugins/PluginsTemp/","./",$FileC );
        EmptyDirectory("admin/todo/plugins/PluginsTemp/");

    }//end for
    $dbDisabled = new db();
    $dbDisabled->query(" delete from `plugins` where `name`='".$PluginName."'; ");
    return SuccessPluginDisable.' : '.$PluginName;
}

function PluginsList() {

    global $Lang;

    $Plugins = PleaseEnableOrDisableOneOfPluginsListedBellow.'&nbsp;&nbsp;
            <a href="admin/includes/webfolder/index.php?action=upload&dir=Plugins&order=name&srt=yes&lang='.$Lang.'" target="_blank" >'
            .OrYouCanUploadAndExtractYourModuleFolder.'</a>';
    $d = dir("Plugins");
    while (($entry = $d->read()) !== false) {

        if($entry!="." and $entry!="..") {
            if (is_file($d->path.'/'.$entry.'/index.php')) {
                $PluginName = $entry;
                $GetPluginInfo = GetPluginInfo($PluginName);

                if($GetPluginInfo['Enabled']==Enabled) {
                    $Enable = Enable;
                    $DisableLink = AdminCreateLink('', array('todo','Disable'), array('plugins',$PluginName));
                    $Disable = '<a href="'.$DisableLink.'">'.Disable.'</a>';
                }
                else {
                    $EnableLink = AdminCreateLink('', array('todo','Enable'), array('plugins',$PluginName));
                    $Enable = '<a href="'.$EnableLink.'">'.Enable.'</a>';
                    $Disable = Disable;
                }

                $Plugins .='<p dir="'.DirHtml.'"><strong>'.$PluginName.'</strong> '.By.'
                         '.$GetPluginInfo['Author'].' &nbsp;('.$GetPluginInfo['Enabled'].')&nbsp;
                        '.$Enable.' &nbsp;&nbsp;'.$Disable.'<br>
                             '.$GetPluginInfo['Desc'].'
                            </p>';
            }
        }
    }
    return $Plugins ;
}

function GetPluginInfo($PluginName) {

    global $Lang;

    $GetPluginInfo =array();
    $GetPluginInfo['Enabled'] = Disabled;
    $GetPluginInfo['Author'] = '';
    $GetPluginInfo['Desc'] = '';

    $query = " select `name` from `plugins` where lower(`name`)='".strtolower($PluginName)."'; ";
    $dbGetPluginInfoSQL = new db();
    $GetPluginInfoSQL = $dbGetPluginInfoSQL->get_row($query);
    if($GetPluginInfoSQL) {
        $GetPluginInfo['Enabled'] = Enabled;
    }

    if(is_file('Plugins/'.$PluginName.'/desc.php')) {
        include_once 'Plugins/'.$PluginName.'/desc.php';
        $xml = new SimpleXMLElement($xmlstr);
        $GetPluginInfo['Author'] = $xml->Author ;
        $GetPluginInfo['Desc'] = $xml->$Lang ;
    }

    return $GetPluginInfo;

}

function ReadPlugin($PluginName) {
    global $PlugArray;
    ini_set('auto_detect_line_endings',true);

    //read plugin file and put info into array $PlugArray
    $fileName = 'Plugins/'.$PluginName.'/index.php';
    $PlugArray =array();
    $i = 0;
    if(file_exists($fileName)) {
        $file = fopen($fileName,'r');
        while(!feof($file)) {
            $name = trim (fgets($file));
            if(substr($name, 0, 1) == '-' or substr($name, 0, 1)=='+') {
                $PlugArray[$i]['s']= substr($name, 0, 1); // what we do + or -
                $LineNumberStart = strpos( substr($name,2), '(');
                $LineNumberEnd = strpos(substr($name,2), ')');
                $LineNumber = substr(substr($name,2), $LineNumberStart+1, $LineNumberEnd-$LineNumberStart-1); // the line number
                $PlugArray[$i]['n']= $LineNumber;
                $FileStart = strpos( $name, '('.$LineNumber.')')+ strlen($LineNumber)+3;
                $StrFileBegin = substr($name, $FileStart);
                $FileEnd = strpos( $StrFileBegin, ')');
                $FileName = substr($StrFileBegin, 1, $FileEnd-1);
                $PlugArray[$i]['f']= $FileName; // the FILE path  portion
                $PlugArray[$i]['c']= substr($StrFileBegin, $FileEnd+2); // the code path  portion
                $i++;
            }
        }
        fclose($file);
    }
    return $PlugArray;
}

function CopyDirectory($src,$dst) {
    //copy entire folder with sub folders
    $dir = opendir($src);
    if(!is_dir($dst)) {
        mkdir($dst);
    }
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                CopyDirectory($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}
/*
function EmptyDirectory($directory, $deleteRootToo = false) {
    //delte entire folder and sub folders
    if(substr($directory,-1) == "/") {
        $directory = substr($directory,0,-1);
    }

    if(!file_exists($directory) || !is_dir($directory)) {
        return false;
    } elseif(!is_readable($directory)) {
        return false;
    } else {
        $directoryHandle = opendir($directory);

        while ($contents = readdir($directoryHandle)) {
            if($contents != '.' && $contents != '..') {
                $path = $directory . "/" . $contents;

                if(is_dir($path)) {
                    EmptyDirectory($path,true);

                } else {
                    unlink($path);
                }
            }
        }

        closedir($directoryHandle);
        $directory ."\n";

        if ($deleteRootToo) {
            if(!rmdir($directory)) {

                return false;
            }
            else {
                return true;
            }
        }


    }

}
*/
function CopyFileWithFullPath($SourcePath,$DestPath,$FileName ) {

    if(!is_dir($DestPath)) {
        if (!mkdir($DestPath, 0777, true)) {
            return 'Failed to create folders';
        }
    }
//echo $SourcePath.'/'.$FileName.'<br/> '. $DestPath.'/'.$FileName."<br/>";
    if(is_file($SourcePath.'/'.$FileName)) {
        if(!copy($SourcePath.'/'.$FileName, $DestPath.'/'.$FileName)) {
            return 'failed to copy file ';
        }
    }
    else {
        return 'file not found';
    }
    return true;
}

?>
