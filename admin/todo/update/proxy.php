<?php
$project = 'phpTransformer';
if(count($_POST)) {
    include_once("../../../config.php");
    include_once("../../../includes/ezsql/ez_sql.php");
    include_once("../../../includes/InputFilters.php");

    if(isset($_POST['ObjectName'])) {
        $ObjectName = PostFilter($_POST['ObjectName']);
        $ObjectLicense = PostFilter($_POST['ObjectLicense']);
        $Ref = PostFilter($_POST['ref']);
        $GetUrl = '&ObjectName='.$ObjectName.'&ObjectLicense='.$ObjectLicense.'&ref='.$Ref;
    }
    elseif($_POST['AllObjects']) {
        $AllObjects = PostFilter($_POST['AllObjects']);
        $GetUrl = '&AllObjects='.$AllObjects;
    }
    else {
        $GetUrl ='';
    }

    header ("content-type: text/xml");

    echo GetPageContent('http://phptransformer.com/release/?Prog=update'.$GetUrl);


}

function GetPageContent($PageUrl) { //get page content from url
    if(function_exists('set_time_limit')) {
        @set_time_limit(0);
    }
    if($PageUrl) {
        $handle  = @fopen($PageUrl,"rb");
        $GetPageContent = @stream_get_contents($handle);
        @fclose($handle);
        return $GetPageContent ;
    }//end if
}//end function
?>