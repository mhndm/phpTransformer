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
    header("location: ../../");
}
?>
<?php

global $TitlePage, $TheNavBar,$Author;
/*
 * 
 */
$NumberOfBriefColums = 1; // 1 or 2 o
/*
 * 
 */

$TitlePage .= ' .:. ' . (news);

$TheNavBar[] = array((news), CreateLink("", array("Prog"), array("news")));

if (isset($_GET['ns'])) {//what we well show in news
    $ns = InputFilter($_GET['ns']);
} else {
    $ns = "breif";
}


switch ($ns) {
    case "pdf":
        $TitlePage .= ' .:.  pdf ';
        include('pdf.php');
        break;
    case "breif":
        $TitlePage .= ' .:. ' . breif;
        if ($NumberOfBriefColums == 1) {
            include('breifone.php');
        } else {
            include('breiftwo.php');
        }
        break;
    case "details":
        if (isset($_GET["idnews"])) {
            $idnews = InputFilter($_GET["idnews"]);
        } else {
            $idnews = '';
        }
        $TheNavBar[] = array(details, CreateLink("", array("Prog", "ns", "idnews"), array("news", "details", $idnews)));
        include('details.php');
        break;
    case "awrites":
        $TitlePage .= ' .:. ' . AuthorWrites;
        $TheNavBar[] = array(AuthorWrites, CreateLink("", array("Prog", "ns", "user"), array("news", "awrites", InputFilter($_GET["user"]))));
        include('AuthorWrites.php');
        break;
    case "catnews":
        $TitlePage .= ' .:. ' . CatNews;
        $TheNavBar[] = array((CatNews), CreateLink("", array("Prog", "ns", "catid"), array("news", "catnews", InputFilter($_GET["catid"]))));
        include('CatNews.php');
        break;
    case "addcmnt":
        $TitlePage .= ' .:. ' . (AddComment);
        $TheNavBar[] = array((details), CreateLink("", array("Prog", "ns", "idnews"), array("news", "details", InputFilter($_GET["idnews"]))));
        $TheNavBar[] = array((AddComment), CreateLink("", array("Prog", "ns", "idnews"), array("news", "addcmnt", InputFilter($_GET["idnews"]))));
        include('AddComment.php');
        break;
    case "archive":
        $TitlePage .= ' .:. ' . (NewsArchive);
        $TheNavBar[] = array((NewsArchive), CreateLink("", array("Prog", "ns"), array("news", "archive")));
        //$TheNavBar[] = array( (AddComment),CreateLink("",array("Prog","ns","idnews"),array("news","addcmnt",InputFilter($_GET["idnews"]))));
        include('newsAchive.php');
        break;
    default :
        $TitlePage .= ' .:. ' . (breif);
        include('breifone.php');
}

?>