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
<?php if (!isset($project)) {
    header("location: ");
} ?>
<?php
$dbProg = new db();
$MainProgLicense = $dbProg->get_var("SELECT `License` FROM `programs` where `ProgramName` = '".$MainPrograms ."'; ");

if (isset($_GET['Prog'])) {
    $Program = InputFilter($_GET['Prog']);
    SqlConnect();
    //echo $Program."<br>";
    /*
	ExcuteQuery("SELECT * FROM `programs` where `ProgramName`='".$Program."' and `Deleted`<>'1' ;");
    */

    $dbPrograms = new db();
    $ProgramsRow = $dbPrograms->get_row("SELECT * FROM `programs` where `ProgramName`='".$Program."' and `Deleted`<>'1' ;");

    if ($ProgramsRow) {//program name exist in the table
        $ProgramName 	= $ProgramsRow->ProgramName;
        $ObjectId		= $ProgramsRow->ObjectId;
        $Permission		= $ProgramsRow->Permission;
        $License		= $ProgramsRow->License;
        //closeQuery();
        $ObjectName = "program".$Program;
        //if(!ValidLicense($License,$ObjectName)){
        //	$ProgCont = "";
        //}
        //else{
        if($Permission=="1" and ContPermission($GroupId,$ObjectId)) {// u have permission to view this program  
            //loading lang file
            if(file_exists("Programs/$Program/Languages/lang-".$Lang.".pt.php")) {
                $filename="Programs/$Program/Languages/lang-".$Lang.".pt.php";//custom translation
            }
            else {
                $filename="Programs/$Program/Languages/lang-".$Lang.".php";
            }
            //echo $filename;
            if (file_exists($filename)) {
                include_once("$filename");
            }
            //loading program
            $ProgCont = get_include_contents("Programs/$Program/index.php");
        }
        else {  //u dont have permission
                $ProgCont = ThisPageDontExistOrYouDontHavePermission;
        }//end if
        //}//en dif
    }
    else { //this program not exist  ,we wel redirect u to main program
/*
            $ObjectName = "program".$MainPrograms;
            //if(!ValidLicense($MainProgLicense,$ObjectName)){
            //	$ProgCont ="";
            //}
            //else{
            //loading lang file
            if(file_exists("Programs/$MainPrograms/Languages/lang-".$Lang.".pt.php")) {
                $filename="Programs/$MainPrograms/Languages/lang-".$Lang.".pt.php";
            }
            else {
                $filename="Programs/$MainPrograms/Languages/lang-".$Lang.".php";
            }
            if (file_exists($filename)) {
                include_once("$filename");
            }
            //loading program
            $ProgCont = get_include_contents("Programs/$MainPrograms/index.php");
            //}//end if
*/
        $ProgCont = ThisPageDontExistOrYouDontHavePermission;
    }//end if
}
else {// get is null , calling main program
    $ObjectName = "program".$MainPrograms;
    //if(!ValidLicense($MainProgLicense,$ObjectName)){
    //	$ProgCont ="";
    //}
    //else{
    //loading lang file
    if(file_exists("Programs/$MainPrograms/Languages/lang-".$Lang.".pt.php")) {
        $filename="Programs/$MainPrograms/Languages/lang-".$Lang.".pt.php";
    }
    else {
        $filename="Programs/$MainPrograms/Languages/lang-".$Lang.".php";
    }
    if (file_exists($filename)) {
        include_once("$filename");
    }
    //loading program
    $ProgCont=get_include_contents("Programs/$MainPrograms/index.php");
    //}//end if
}//end if


// show or hide containers from programs table fro this program
//SqlConnect();
//if($Program!=""){
$programsDB = new db();

if(isset($Program)) {
    //echo "SELECT * FROM Programs where ProgramName ='".$Program."';";
    //ExcuteQuery("SELECT * FROM `programs` where ProgramName ='".$Program."';");
    $ProgramsRow = $programsDB->get_row("SELECT * FROM `programs` where ProgramName ='".$Program."';");
}
else {
    //echo "SELECT * FROM Programs where ProgramName ='".$MainPrograms."';";
    //ExcuteQuery("SELECT * FROM `programs` where ProgramName ='".$MainPrograms."';");
    $ProgramsRow = $programsDB->get_row("SELECT * FROM `programs` where ProgramName ='".$MainPrograms."';");
}

//$Rows = mysqli_fetch_assoc($Recordset);
//echo $TotalRecords;
if (count($ProgramsRow)) {
    //this programexist
    //options in params to view or hide containers dominet programs preferences
    if($ViewTopCont) {
        $ViewTopCont		= $ProgramsRow->ViewTopCont;
    }
    if($ViewMarqueeCont) {
        $ViewMarqueeCont	= $ProgramsRow->ViewMarqueeCont;
    }
    if($ViewMenuCont) {
        $ViewMenuCont		= $ProgramsRow->ViewMenuCont;
    }
    if($ViewMainCont) {
        $ViewMainCont		= $ProgramsRow->ViewMainCont;
    }
    if($ViewSecCont) {
        $ViewSecCont		= $ProgramsRow->ViewSecCont;
    }
    if($ViewFootCont) {
        $ViewFootCont		= $ProgramsRow->ViewFootCont;
    }
    if($ViewProgCont) {
        $ViewProgCont		= $ProgramsRow->ViewProgCont;
    }
}//end if
//closeQuery();

//ADD ONE NOTE+1
if(isset($Program)) {
    $programsDB->query('UPDATE `programs` SET `Hits` = `Hits`+1  WHERE `ProgramName` = "' . $Program . '";');
}
else {
    $programsDB->query('UPDATE `programs` SET `Hits` = `Hits`+1  WHERE `ProgramName` = "' . $MainPrograms . '";');
}//end if

//$Recordset = mysqli_query( $conn,$Query) ;	

$ProgCont=trim($ProgCont);
if($ProgCont=="") {
    $ProgCont="&nbsp;";
}

//transforme links to the current rew config
$AllLinks = StripLinks($ProgCont);

for($i=0; $i<count($AllLinks);$i++) {
    $ProgCont = str_replace($AllLinks[$i], echoLink($AllLinks[$i]), $ProgCont);

}//end while


?>