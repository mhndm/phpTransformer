<?php
$project = 'phpTransformer';
if(count($_POST)) {
    include_once("../config.php");
    include_once("../includes/ezsql/ez_sql.php");
    include_once("../includes/InputFilters.php");
    $data = PostFilter($_POST['data']);

    header ("content-type: text/xml");
    echo GetPageContent('http://phptransformer.com/release/Programs/messagecenter/xml.php?data='.$data.'&ref='.$_SERVER['SERVER_NAME']);


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