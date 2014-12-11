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

include_once("Programs/news/admin/Languages/lang-" . $Lang . ".php");

$theList .= SubIconLink("recycle", "DeletedNews") . "<br/>";
$theList .= SubIconLink("recycle", "RecycleNewsCat") . "<br/>";

if (isset($_GET['subdo'])) {
    if ($_GET['subdo'] == "RecycleNews") {
        $theContent = RecycleNews();
    }//end if		
    if ($_GET['subdo'] == "RecycleNewsCat") {
        $theContent = RecycleNewsCat();
    }//end if	
    if ($_GET['subdo'] == "DeletedNews") {
        $theContent = DeletedNews();
    }//end if	
    if ($_GET['subdo'] == "FinDelNews") {
        $theContent = FinDelNews();
    }//end if		
    if ($_GET['subdo'] == "FinDelcatNews") {
        $theContent = FinDelcatNews();
    }//end if		
    if ($_GET['subdo'] == "RecyclecatNews") {
        $theContent = RecyclecatNews();
    }//end if	
}//end if

function FinDelcatNews() {
    global $ThemeName, $TotalRecords, $Rows, $conn, $Recordset, $Lang;
    $FinDelcatNews = '<img src="Programs/news/admin/images/newscom.png" alt=""/><br/>';

    $IdCat = InputFilter($_GET['IdCat']);

    ExcuteQuery("select * from `newscategoies` where `IdCat`='" . $IdCat . "';");
    if ($TotalRecords > 0) {
        $FinDelcatNews .= (ThisCatHaveNews);
    } else {
        mysqli_query($conn, "delete from `catlang` where `IdCat`='" . $IdCat . "';");
        $FinDelcatNews .= (SuccessFinDelNews);
    }//end if
    return $FinDelcatNews;
}

//end function

function RecyclecatNews() {

    $IdCat = InputFilter($_GET['IdCat']);
    $RecycleNews = '<img src="Programs/news/admin/images/newscom.png" alt=""/><br/>';
    mysqli_query($conn, "update `catlang` set `deleted`='0' where `IdCat`='" . $IdCat . "';");
    return $RecycleNews . (SuccessRestorecatNews);
}

//end function

function RecycleNewsCat() {

    global $ThemeName, $TotalRecords, $Rows, $conn, $Recordset, $Lang;
    $RecycleNewsCat = '<img src="Programs/news/admin/images/newscom.png" alt=""/><br/>';

    ExcuteQuery("select * from `languages` where `LangName`='" . $Lang . "';");
    if ($TotalRecords > 0) {
        $IdLang = $Rows['IdLang'];
    }//end if
    ExcuteQuery("select * from `catlang` where `IdLang`='" . $IdLang . "'
				 and `Deleted`='1';");
    if ($TotalRecords > 0) {
        $RecycleNewsCat .='<table width="100%" border="0" cellspacing="2" cellpadding="2">
					  <tr>
					    <td><strong>' . (NewsCategorie) . '</strong></td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					  </tr>';
        for ($i = 0; $i < $TotalRecords; $i++) {
            $IdCat = $Rows['IdCat'];
            $CatName = $Rows['CatName'];

            $Vars = array("todo", "subdo", "IdCat");
            $Vals = array("recycle", "FinDelcatNews", $IdCat);
            $DeleteNews = '<a onclick="return acceptDel();" href="'
                    . AdminCreateLink("", $Vars, $Vals) . '" title="">
							' . (FinalDelete) . '</a>';
            $Vars = array("todo", "subdo", "IdCat");
            $Vals = array("recycle", "RecyclecatNews", $IdCat);
            $RestPage = '<a onclick="return acceptRest();" href="'
                    . AdminCreateLink("", $Vars, $Vals) . '" title="">
							' . (RestoreRecycle) . '</a>';

            $RecycleNewsCat .= '  <tr>
							    <td>' . $CatName . '</td>
							    <td> | ' . $RestPage . '</td>
							    <td> | ' . $DeleteNews . '</td>
							  </tr>';

            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    } else {
        $RecycleNewsCat .= (TherIsNoDeletecatNews);
    }//end if
    $RecycleNewsCat .= '</table><script language="javascript" type="text/javascript">
									function acceptDel(){
										return confirm("' . (DidUWantToFinalDelete) . '");
									}
									function acceptRest(){
										return confirm("' . (DidUWantToRestore) . '");
									}								
									</script>';
    return $RecycleNewsCat;
}

//end function

function DeletedNews() {
    global $ThemeName, $conn, $Lang;

    $db = new db();

    $NewsMaxNbr = 25;
    $results_page_count_to_navigate_betweenu = 12;
    $page = (isset($_GET['page']) && $_GET['page'] >= 1) ? InputFilter($_GET['page']) : 1;
    $start = ($page - 1) * $NewsMaxNbr;

    $DeletedNews = '';

    $IdLang = $db->get_var("select * from `languages` where `LangName`='" . $Lang . "';");

    $del_rs = $db->get_results("select * from `newslang`,`news` where `IdLang`='" . $IdLang . "'
				and `newslang`.`IdNews`=`news`.`IdNews` and `Deleted`='1' limit " . $start . "," . $NewsMaxNbr . " ;");
    
    $all_deleted_news = $db->get_var( "select count(*) from `newslang`,`news` where `IdLang`='" . $IdLang . "'
				and `newslang`.`IdNews`=`news`.`IdNews` and `Deleted`='1' ; ");
                                    
    $delete_count = count($del_rs);
    if ($delete_count > 0) {

        $DeletedNews .='<table width="100%" border="0" cellspacing="2" cellpadding="2">
					  <tr>
					    <td class="td_title" ><img style="float:right;" src="Programs/news/admin/images/news.png" alt=""/> <strong>' . (Tilte) . '</strong></td>
					    <td class="td_title" >&nbsp;</td>
					    <td class="td_title" >&nbsp;</td>
					  </tr>';
        foreach ($del_rs as $del_row) {
            $IdNews = $del_row->IdNews;
            $Tilte = mb_substr($del_row->Tilte, 0, 135, 'utf8');
            
            //$Tilte = '<a href="'. CreateLink("", array('Prog','ns','idnews'), array('cybernews','details',$IdNews)).'" >'.$Tilte.'</a>';
            
            $Vars = array("todo", "subdo", "DelNews");
            $Vals = array("recycle", "FinDelNews", $IdNews);
            $DeleteNews = '<a onclick="return acceptDel();" href="'
                    . AdminCreateLink("", $Vars, $Vals) . '" title="">
							' . FinalDelete . '</a>';
            $Vars = array("todo", "subdo", "RestNews");
            $Vals = array("recycle", "RecycleNews", $IdNews);
            $RestPage = '<a onclick="return acceptRest();" href="'
                    . AdminCreateLink("", $Vars, $Vals) . '" title="">
							' . RestoreRecycle . '</a>';

            $DeletedNews .= '  <tr  class="row_tr">
							    <td class="td_data">' . $Tilte . '</td>
							    <td class="td_data">' . $RestPage . '</td>
							    <td class="td_data">' . $DeleteNews . '</td>
							  </tr>';
        }
        $DeletedNews .= '</table>'.paginate_results($NewsMaxNbr, $results_page_count_to_navigate_betweenu, $all_deleted_news, $page, array('todo', 'subdo'), array('recycle', 'DeletedNews'),true);
    } else {
        $DeletedNews .= (TherIsNoDeleteNews);
    }//end if
    $DeletedNews .= '<script language="javascript" type="text/javascript">
									function acceptDel(){
										return confirm("' . (DidUWantToFinalDelete) . '");
									}
									function acceptRest(){
										return confirm("' . (DidUWantToRestore) . '");
									}								
									</script>';

    return $DeletedNews;
}

//end function

function RecycleNews() {
    global $conn;
    $IdNews = InputFilter($_GET['RestNews']);
    $RecycleNews = '<img src="Programs/news/admin/images/news.png" alt=""/><br/>';
    mysqli_query($conn, "update `news` set `deleted`='0' where `IdNews`='" . $IdNews . "';");
    mysqli_query($conn, "update `marques` set `Deleted`='0'
             where `IdNews`='" . $IdNews . "' ;");

    $db = new db();
    $IdUserName = $db->get_var(" SELECT `IdUserName` FROM `news` where `IdNews`='" . $IdNews . "';  ");
    $db->query(" update `users` set `Points` = `Points`+1 where `UserId`='" . $IdUserName . "' ; ");

    return $RecycleNews . (SuccessRestoreNews);
}

//end function

function FinDelNews() {
    global $conn;
    $IdNews = InputFilter($_GET['DelNews']);
    $RecycleNews = '<img src="Programs/news/admin/images/news.png" alt=""/><br/>';
    mysqli_query($conn, "delete from `news` where `IdNews`='" . $IdNews . "';");
    mysqli_query($conn, "delete from `newslang` where `IdNews`='" . $IdNews . "';");
    mysqli_query($conn, "delete from `newscomment` where `IdNews`='" . $IdNews . "';");
    mysqli_query($conn, "delete from `newscategoies` where `IdNews`='" . $IdNews . "';");

    $db = new db();
    $idMarque = $db->get_var(" select `idMarque` from `marques`  where `IdNews`='" . $IdNews . "'");
    $db->query("delete from `marqlang` where `idmarque`='" . $idMarque . "';");
    $db->query("delete from `marques` where `idMarque`='" . $idMarque . "';");

    return $RecycleNews . (SuccessFinDeleteNews);
}

//end function
?>