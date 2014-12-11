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

if (!isset($project)) {
    header("location: ../");
}
?>
<?php

function InputFilter($InputStr, $AdminFilter = false, $remove_non_utf8=false) {
    global $ExternalLinks;

    if($remove_non_utf8){
    $InputStr = preg_replace('/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]' .
            '|[\x00-\x7F][\x80-\xBF]+' .
            '|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*' .
            '|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})' .
            '|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S', ' ', $InputStr);
    }

    $InputStr = urldecode($InputStr);
    $InputStr = trim($InputStr);
    if ($InputStr != "") {
        //slash bug in php v6
        /*
        if (!get_magic_quotes_gpc()) {
            $InputStr = addslashes($InputStr);
        }//end if
        //*/
        //BAD SCRIPTS
        $BlackListAmin = array("<head", "<body", "<html");

        $BlackList = array("<script", " union ", " select ", "<meta", " cookie", " http-equiv ", "<demon", "<shel", "<head", "<body", "<html", "<iframe",
            "<applet", "<embed", "<frame", "<frameset", "<style", "<layer", "<link", "<ilayer", "<object", "<form", "<input", "<select", "<textarea",
            " javascript", ".location", " onclick", " ondblclick", " onkeydown", " onkeypress", " onkeyup", " onmousedown", " onmousemove",
            " onmouseout", " onmouseover", " onmouseup", " onload", " bgsound", " style");
        // var_dump($AdminFilter);
        if ($AdminFilter) {
            $OutputStr = str_ireplace($BlackListAmin[0], "X" . $BlackListAmin[0] . "X", $InputStr);
            foreach ($BlackListAmin as $i => $value) {
                //$OutputStr = htmlentities($value);
                //$OutputStr = rawurlencode($value);
                $OutputStr = str_ireplace($value, "X" . $value . "X ", $OutputStr);

                //htmlentities
            }// end foreach
        } else {
            $OutputStr = str_ireplace($BlackList[0], "X" . $BlackList[0] . "X", $InputStr);
            foreach ($BlackList as $i => $value) {
                $OutputStr = str_ireplace($value, "X" . $value . "X ", $OutputStr);
            }
        }
        // BAD WORDS FROM DATABBASE
        $BlackListDB = DataBaseBlackList();
        if (count($BlackListDB) > 0) {
            $OutputStrDB = str_ireplace($BlackListDB[0] . ' ', str_repeat("*", strlen($BlackListDB[0])), $InputStr);
            foreach ($BlackListDB as $i => $valueDB) {
                $OutputStr = str_ireplace($valueDB . ' ', str_repeat("*", strlen($valueDB)), $OutputStr);
            }// end foreach
        }//end if
        if ($ExternalLinks == 1) {
            $OutputStr = ReplaceUrl($OutputStr);
        }//end if

        return $OutputStr;
    } else {
        //return "";
    }//end if
}

//end function

function PostFilter($PostStr, $AdminFilter = false, $new_line_char = true, $remove_non_utf8=false) {

    if ($new_line_char) {
        $PostStr = str_replace("&nbsp;&nbsp;", "&nbsp;", $PostStr);
        $PostStr = str_replace("\n", "&nbsp;", $PostStr);
    }

    if (isset($_SERVER['HTTP_REFERER'])) {
        $Ref = $_SERVER['HTTP_REFERER'];
    } else {
        // first page in the browser
        $Ref = $_SERVER['HTTP_HOST'];
        $Ref['host'] = $_SERVER['HTTP_HOST'];
    }//end if
    $Ref = parse_url($Ref);
    $Ref = $Ref['host'];
    $Host = $_SERVER['HTTP_HOST'];
    if ($Ref == $Host) {
        //info from same website, Filter ...
        return InputFilter($PostStr, $AdminFilter, $remove_non_utf8);
    } else {
        //strange sorce  website
        return "";
    }
}

//end function

function DataBaseBlackList() {

    $dbBlackWord = new db();
    $BlackWords = $dbBlackWord->get_results("select * from  `blacklist`; ");
    if (count($BlackWords)) {
        foreach ($BlackWords as $BlackWord) {
            $BlackWord = $BlackWord->BlackWord;
            $DataBaseBlackList[] = $BlackWord;
        }
    } else {
        $DataBaseBlackList = array();
    }//end if

    return $DataBaseBlackList;
}

//end function



/*
  function DataBaseBlackList(){
  global $conn ;
  $Query = "select * from  `blacklist`; ";
  $Recordset = mysqli_query( $conn,$Query) ;
  $TotalRecords = mysqli_num_rows($Recordset);
  if($TotalRecords>0){
  while($Rows = mysqli_fetch_assoc($Recordset)){
  $BlackWord = $Rows['BlackWord'];
  $DataBaseBlackList[] = $BlackWord;

  }//END while
  }
  else{
  $DataBaseBlackList = array();
  }//end if
  return $DataBaseBlackList;
  }//end function

 */

function ReplaceUrl($StringText) {
    //global $TotalRecords,$Rows,$Conn ;
    //echo $StringText . "<br/>";
    //parse text words
    $AllWords = preg_split("/[\s]+/", $StringText);
    //cheking if it an url
    foreach ($AllWords as $key => $Word) {

        //find link code
        if (strstr($Word, 'href=')) {
            //search for link url
            if (strpos($Word, '"')) {
                $LinkSTart = strpos($Word, '"');
                $LinkEnd = strpos($Word, '"', $LinkSTart + 1);
                $LinkLen = strlen($Word);
                $TheLink = substr($Word, $LinkSTart + 1, $LinkLen - ($LinkSTart + ($LinkLen - $LinkEnd)) - 1);

                //$TheLinkQ  = $TheLink ;// mysqli_real_escape_string($TheLink );
                //	echo $TheLinkQ."<br/>";
                //sheking if is external link
                if (stristr($TheLink, 'http') or stristr($TheLink, 'www') or stristr($TheLink, 'ftp')) {

                    // add new external link to databses
                    //if(stristr($TheLinkQ,'www') and stristr($TheLinkQ,'http')===false){
                    if (stristr($TheLink, 'www') and stristr($TheLink, 'http') === false) {
                        $TheLinkQ = 'http://' . $TheLinkQ;
                    }//end if
                    //$TheLink = mysqli_real_escape_string($TheLink);


                    if (LinkALreadyExist($TheLink)) {

                        $Id = LinkALreadyExist($TheLink);
                        //use old link
                        $Vars = array("Prog", "Id");
                        $Vals = array("exlink", $Id);
                        $NewLink = CreateLink('', $Vars, $Vals);
                        $StringText = str_replace($TheLink, $NewLink, $StringText);
                    } else {

                        $Id = GenerateID('externallinks', 'Id');
                        $TheLinkQ = addslashes($TheLink);
                        $dbNewID = new db();
                        $dbNewID->query("insert into `externallinks` (`Id`,`Link`) values('" . $Id . "','" . $TheLinkQ . "');");

                        //generate new link
                        $Vars = array("Prog", "Id");
                        $Vals = array("exlink", $Id);
                        $NewLink = CreateLink('', $Vars, $Vals);
                        $StringText = str_replace($TheLink, $NewLink, $StringText);
                    }//end if
                }//end if
            }//end if
        }//en if
    }//end for each

    return $StringText;
}

//end function

/*
  function ReplaceUrl($StringText){
  global $TotalRecords,$Rows,$Conn ;
  //echo $StringText . "<br/>";
  //parse text words
  $AllWords = preg_split("/[\s]+/", $StringText);
  //cheking if it an url
  foreach($AllWords as $key=>$Word){
  //find link code
  if(strstr($Word,'href=')){
  //search for link url
  if(strpos($Word,'"')){
  $LinkSTart =  strpos($Word,'"');
  $LinkEnd   =  strpos($Word,'"',$LinkSTart+1);
  $LinkLen   =  strlen($Word);
  $TheLink = substr($Word,$LinkSTart+1,$LinkLen-($LinkSTart+($LinkLen-$LinkEnd))-1);
  $TheLinkQ  = mysqli_real_escape_string($TheLink );

  //	echo $TheLinkQ."<br/>";
  //sheking if is external link
  if(stristr($TheLink,'http') or stristr($TheLink,'www') or stristr($TheLink,'ftp')){
  // add new external link to databses
  if(stristr($TheLinkQ,'www') and stristr($TheLinkQ,'http')===false){
  $TheLinkQ = 'http://'.$TheLinkQ;
  }//end if
  if(LinkALreadyExist($TheLinkQ)){
  $Id = LinkALreadyExist($TheLinkQ);
  //use old link
  $Vars = array("Prog","Id");
  $Vals = array("exlink",$Id);
  $NewLink = CreateLink('',$Vars,$Vals);
  $StringText = str_replace($TheLink, $NewLink,$StringText );
  }
  else{
  $Id = GenerateID('externallinks','Id');
  mysqli_query($conn,"insert into `externallinks` (`Id`,`Link`) values('".$Id."','".$TheLinkQ."');")  ;

  //generate new link
  $Vars = array("Prog","Id");
  $Vals = array("exlink",$Id);
  $NewLink = CreateLink('',$Vars,$Vals);
  $StringText = str_replace($TheLink, $NewLink,$StringText );
  }//end if

  }//end if
  }//end if
  }//en if
  }//end for each
  return $StringText;
  }//end function
 */

function LinkALreadyExist($Link) {
    //global $TotalRecords,$Rows,$Conn ;

    $Link = addslashes($Link);

    $dbLink = new db();
    $Link = $dbLink->get_row("select * from `externallinks` where `Link`='" . $Link . "';");
    if ($Link) {
        return $Link->Id;
    } else {
        return false;
    }//end if
}

//end function
?>