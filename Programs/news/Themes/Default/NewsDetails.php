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
<!-- NewsDetails start -->
<div class="news_container">
    <div class="news_header">{NewsTitle}
        <div >{SubTitle} </div>
        
    </div>
    
    <div class="news_body">
        {NewsImg} {NewsAllData}
    </div>
</div>
<div class="news_info" >{NewsDate}&nbsp;{AuthorName}&nbsp;{AuthorWrits}&nbsp;<br/>{NewsGroup}</div>
<?php
$Vars[0] = "Prog";
$Vars[1] = "ns";
$Vars[2] = "idnews";
$Vals[0] = "news";
$Vals[1] = "addcmnt";
if (isset($_GET['idnews'])) {
    $IdNews = InputFilter($_GET['idnews']);
} else {
    $IdNews = "";
}//end if
$Vals[2] = $IdNews;
$addCommentLink = CreateLink("", $Vars, $Vals);
?>
<div class="news_share">
    <a href="<?php echo $addCommentLink; ?>" title="{addComment}">
        <img alt="" src="Programs/news/Themes/Default/Images/discuss.gif" border="0" /> 
    </a>

     <a href="#" onclick="print();" title="{PrintPage}" >
        <img alt=" " src="Programs/news/Themes/Default/Images/print.gif" border="0" />
    </a>

    <a href="friendly.php" title="{SavePage}" target="_blank">
        <img alt="" src="Programs/news/Themes/Default/Images/save.gif" border="0" /> 
    </a>

    <?php
    unset($Vars);
    unset($Vals);
    $Vars[0] = 'Prog';
    $Vals[0] = 'tellfriend';
    ?>
    <a href="<?php echo CreateLink('', $Vars, $Vals); ?>" title="{SendPage}">
        <img alt="" src="Programs/news/Themes/Default/Images/tellfriend.gif" border="0" />
    </a>

    <a href="{pdflink}" title="{pdfPage}" target="_blank">
        <img alt="" src="Programs/news/Themes/Default/Images/pdf.gif" border="0" />
    </a>
</div>