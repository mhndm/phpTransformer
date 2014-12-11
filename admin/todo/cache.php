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
****	Author: Mohsen Mousawi mhndm@phptransformer.com .
*
***********************************************/
?>
<?php if (!isset($IsAdmin)){header("location: ../");} ?>
<?php
global $CacheEnabled,$TimeCache,$IgnoreList ;
//TODO: CACHE DIR , CACHE EXTENTION FILE, ENABLE GZIP COMPRESSION WHEN SAVE
$cachedir = 'cache/'; // Directory to cache files in
$cacheext = 'cache'; //the files cache Extention
$CacheSystem = '';

if(isset($_POST['SaveIgnoreList'])){

    $IgnoreList = PostFilter($_POST['IgnoreList']) ;
    $UpdateIgnoreList = new db();
    $UpdateIgnoreList ->query("UPDATE `params` SET `IgnoreList` = '".$IgnoreList."';");
}

if(isset($_POST['SaveCachedProgams'])){
    $GETCachedProgams = new db();
    $GETProgName =$GETCachedProgams->get_results( 'SELECT `ProgramName`,`cached` FROM `programs`;');
    foreach($GETProgName as $GETProg){

        $UpdProgCache = new db();
        if(isset($_POST[$GETProg->ProgramName])){
            $cachetime = $_POST[$GETProg->ProgramName."cachetime"];
            $UpdProgCache->query("UPDATE `programs` SET `cached` = '1', `cachetime`='". $cachetime ."' WHERE `ProgramName` = '".$GETProg->ProgramName."';");
        }
        else{
            $cachetime = $_POST[$GETProg->ProgramName."cachetime"];
            $UpdProgCache->query("UPDATE `programs` SET `cached` = '0', `cachetime`='". $cachetime ."' WHERE `ProgramName` = '".$GETProg->ProgramName."';");
        }
    }
}

if(isset($_POST['EmptyCachePage'])){
    $DeleteCacheURL = InputFilter($_POST['DeleteCacheURL']);
    $File = $cachedir . md5($DeleteCacheURL).'.'.$cacheext;
    if(is_file($File)){
        @unlink($File);
        $CacheSystem .= $File . ' '. (HasBeenDeletedsuccufully).'<br>';
    }
}

if(isset($_POST['SaveCacheEnabled'])){
   $CacheEnabled = PostFilter($_POST['CacheEnabled']);
   //Save in the database the status of the cache
   if($CacheEnabled=='yes'){
       $CacheEnabled = 1;
   }else{
       $CacheEnabled = 0;
   }
   $SaveCacheEnabled = new db();
   $SaveCacheEnabled->query("UPDATE `params` SET `CacheEnabled` = '". $CacheEnabled."'; ");
}

if(isset($_POST['SaveTimeCache'])){
   $TimeCache  = InputFilter($_POST['TimeCache']);
   $SaveTimeCache = new db();
   $SaveTimeCache->query("UPDATE `params` SET `TimeCache` = '". $TimeCache."'; ");
}

if(isset($_POST['EmptyAllCache'])){
    // clear cache dir
     if ($handle = @opendir($cachedir)) {
             while (false !== ($file = @readdir($handle))) {
                     if ($file != '.' and $file != '..' and $file!='index.html') {
                            @unlink($cachedir . '/' . $file);
                            $CacheSystem .= $file . ' '. (HasBeenDeletedsuccufully).'<br>';
                     }
             } @closedir($handle);
     }
}

$CacheSystem .='<form method="post" >
<p>'. (CachesystemEnabled).' :
    <select name="CacheEnabled" id="CacheEnabled">';
if($CacheEnabled){
    $CacheSystem .='
          <option value="yes" selected="selected" >'. (yes).'</option>
          <option value="no">'. (no).'</option>
     ';
}
else{
    $CacheSystem .='
          <option value="yes" >'. (yes).'</option>
          <option value="no" selected="selected">'. (no).'</option>
     ';
}

$CacheSystem .='</select>
        <input type="submit" class="submit" name="SaveCacheEnabled" id="SaveCacheEnabled" value="'. (SaveCacheEnabled).'">
</p>
<p>'. (Defaulttimetosavecache).' :
    <input name="TimeCache" type="text" id="TimeCache" size="8" maxlength="100" value="'.$TimeCache.'">
  ('. (inSeconds).')  <input class="submit"  type="submit" name="SaveTimeCache" id="SaveTimeCache" value="'. (SaveTimeCache).'">
</p>
<p>'. (Emptyallthesystemcache).' :
    <input onClick="return acceptEmptyCache();" class="submit"  type="submit" name="EmptyAllCache" id="EmptyAllCache" value="'. (EmptyNow).'">
</p>
<p>'. (DeleteURLfromthecacheFullUrlwithhttp).' :
    <input dir="ltr" name="DeleteCacheURL" type="text" id="DeleteCacheURL" size="100" maxlength="1000">
    <input onClick="return acceptDelUrl();" class="submit"  type="submit" name="EmptyCachePage" id="EmptyCachePage" value="'. (EmptyCachePage).'">
</p>
<p>'. (CachedProgams).' :</p>
<table dir="ltr"  border="0"><tr><td>';

$SaveCachedProgams = new db();
$ProgName =$SaveCachedProgams->get_results( 'SELECT `ProgramName`,`cached`,`cachetime` FROM `programs`;');
foreach($ProgName as $Prog){
    if($Prog->cached){
        $CacheSystem .='<input type="checkbox" checked="checked" name="'.$Prog->ProgramName.'" id="'.$Prog->ProgramName.'">'.$Prog->ProgramName;
    }
    else{
        $CacheSystem .='<input type="checkbox"  name="'.$Prog->ProgramName.'" id="'.$Prog->ProgramName.'">'.$Prog->ProgramName;
    }
     $CacheSystem .= ' : <input name="'.$Prog->ProgramName.'cachetime" type="text" id="'.$Prog->ProgramName.'cachetime" size="8" maxlength="100" value="'.$Prog->cachetime.'"> '. (inSeconds).'<br/>';
}

$CacheSystem .='</td></tr></table>
<p>
  <input class="submit"  type="submit" name="SaveCachedProgams" id="SaveCachedProgams" value="'. (SaveCachedProgams).'">
</p>
<p>'. (IgnoreListEacheUrlinoneline).'<br>
    <textarea wrap="off" dir="ltr" name="IgnoreList" id="IgnoreList" cols="100" rows="10">'.$IgnoreList.'</textarea><br/>
    <input class="submit"  type="submit" name="SaveIgnoreList" id="SaveIgnoreList" value="'. (SaveIgnoreList).'">
  <br/>
</p>
</form>
<script language="javascript" type="text/javascript">
function acceptDelUrl(){
	return confirm("'. (AreYouShureToDeleteThisPageFromCache).'");
}
function acceptEmptyCache(){
	return confirm("'. (AreYouShureToEmptyAllTheCache).'");
}
</script> ';

?>