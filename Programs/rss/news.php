<?php

/* * *********************************************
 *
 * 	Project: phpTransformer.com .
 * 	Descriptions:	.
 * 	TODO:	 .
 * ***	Author: Mohsen Mousawi mhndm@phptransformer.com +961-3-687150.
 *
 * ********************************************* */
?>
<?php

if (!isset($project)) {
    header("location: ../../");
} // this section to avoid direct hack attack to this file 
?> 
<?php

global $IdLang;
$db = new db();
$news_rs = $db->get_results("select * from languages as l,news as n,newslang as nl,newscategoies as nc "
        . "where l.IdLang = nl.IdLang and n.IdNews = nc.IdNews "
        . "and n.IdNews = nl.IdNews "
        . "and n.Active = '1' "
        . "and n.Deleted <> '1' "
        . "and  l.IdLang = '" . $IdLang . "' "
        . "order by n.Date desc limit 0,  100  ; ");

if ($news_rs) {
    foreach ($news_rs as $news) {
        $Vars = array("Prog", "ns", "idnews");
        $Vals = array("cybernews", "details", $news->IdNews);
        $link = CreateLink("", $Vars, $Vals);
        $Breif = strip_tags($news->Breif);
        $Breif = str_replace(
                array("<", ">"), array("&lt;", "&gt;"), $Breif);
        $Tilte = strip_tags($news->Tilte);
        $Tilte = str_replace(
                array("<", ">"), array("&lt;", "&gt;"), $Tilte);

        echo '<item>
	    <link>' . $link . '</link>
	    <guid>' . $news->IdNews . '</guid>
	    <title>' . $Tilte . '</title>
	    <description>
            &lt;img  alt="" src="' . $WebsiteUrl . 'uploads/news/pics/' . $news->NewsPic . '"/&gt;'
        . ' ' . $Breif . '
            </description>
	    <pubDate>' . $news->Date . '</pubDate>
	    <category>' . $news->CatName . '</category>
		<comments>' . $link . '</comments>
	    </item>';
    }
}
echo '</channel></rss>';
?>