<?php
//TODO: CACHE DIR , CACHE EXTENTION FILE, ENABLE GZIP COMPRESSION WHEN SAVE
//  login log off
//  white space in source for begin of pages
//  when user not Guest LOGON STOP Cashe system! by session variable
if(isset($_GET['Prog'])){
    $ProgGet = InputFilter($_GET['Prog']);
}
else{
    $ProgGet ='';
}
if($_SESSION['cache'] and isset($ProgGet)){

    // Settings
    $cachedir = 'cache/';

    //$cachetimePage = $TimeCache  ;
    //
    // Seconds to cache files for
    $cacheext = 'cache'; // Extension to give cached files (usually cache, htm, txt)
    $ignore_page = false;
    $ignore_list = array();
    $ignore_prog = array();

    $ignore_list = explode("\n",  $IgnoreList);
    $CachedProgams = new db();
    $ProgName =$CachedProgams->get_results( 'SELECT `ProgramName`,`cached`,`cachetime` FROM `programs`;');
    if($ProgName){
        foreach($ProgName as $Prog){
            //echo $Prog->cached;
            if(!$Prog->cached){
               $ignore_prog[]= $Prog->ProgramName;
            }
        }
    }
    $page = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

     // Requested page
    $cachefile = $cachedir . md5($page) . '.' . $cacheext;

     // Ignore full programs
    for($j=0;$j<count($ignore_prog);$j++){
        if($ProgGet ==$ignore_prog[$j] ){ $ignore_page = TRUE;}
    }
  
    //Ignore some url
    if(!$ignore_page){
         for($k=0; $k< count($ignore_list); $k++ ){
            if($page == trim($ignore_list[$k])){ //we use trim to passe \n 
                $ignore_page = true;
            }
        } 
    }

    $dbtime = new db();
    $TimeProg = $dbtime->get_var("SELECT `cachetime` FROM `programs` WHERE `ProgramName`='".$ProgGet."';");
    if($TimeProg){
        $cachetime = $TimeProg  ; //from params
    }
    else{
        $cachetime = $TimeCache ; //from this prog if not zero
    }
    
    // Cache file to either load or create
    $cachefile_created = ((@file_exists($cachefile)) and ($ignore_page === false)) ? @filemtime($cachefile) : 0; @clearstatcache();

    if (time() - $cachetime < $cachefile_created) {
     //ob_start('ob_gzhandler');
     // @readfile($cachefile);
     //ob_end_flush();
    $file_data = implode("", gzfile($cachefile));
    echo $file_data;
      exit();
    } // If we're still here, we need to generate a cache file
      ob_start();
}
else{
    $ignore_page = true;
}
?>