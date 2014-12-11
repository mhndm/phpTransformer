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
global $IsAdmin;
if (!isset($IsAdmin)) {
    header("location: ../");
}
?>
<?php
global $ThemeName, $Lang;

include_once("Programs/news/Languages/lang-" . $Lang . ".php");

include_once("Programs/news/admin/Languages/lang-" . $Lang . ".php");

$recycle_news = AdminCreateLink('', array("todo", "subdo"), array("recycle", "DeletedNews"));

$theList = ProgIconLink("news", "addNews")
        . ProgIconLink("news", "allNews")
        . ProgIconLink("news", "NewsCat")
        . ProgIconLink("news", "NewNewsCat")
        . ProgIconLink("news", "read_report")
        . '<br/><a href="' . $recycle_news . '"> '
        . '<img alt="' . DeletedNews . '" src="admin/Themes/' . $ThemeName . '/images/recylce.png" /></a>';

if (isset($_GET['subdo'])) {
    switch ($_GET['subdo']) {
        case "NewNewsCat":
            $theContent = NewNewsCat();
            break;
        case "editNewsCat":
            $theContent = editNewsCat();
            break;
        case "deleteNewsCat":
            $theContent = deleteNewsCat();
            break;
        case "NewsCom":
            $theContent = NewsCom();
            break;
        case "allNews":
            $theContent = allNews();
            break;
        case "NewsCat":
            $theContent = NewsCat();
            break;
        case "addNews":
            $theContent = addNews();
            break;
        case "editNews":
            $theContent = editNews();
            break;
        case "deleteNews":
            $theContent = deleteNews();
            break;
        case "editComment":
            $theContent = editComment();
            break;
        case "deleteComment":
            $theContent = deleteComment();
            break;
        case "read_report":
            $theContent = read_report();
            break;
        default :
            $theContent = allNews();
    }//end switch
} else {
    $theContent = allNews();
}//end if

$News = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$News = VarTheme("{todoImg}", "news.png", $News);
$News = VarTheme("{ThemeName}", $ThemeName, $News);
$News = VarTheme("{List}", $theList, $News);
$News = VarTheme("{Content}", $theContent, $News);

echo $News;

function read_report() {
    $reportMaxNbr = 50;

    $ob = 'id'; // order by
    $ad = 'desc'; // asc desc 
    $ad_inv = 'asc';

    if (isset($_GET['ad'])) {
        if ($_GET['ad'] == 'asc') {
            $ad = 'asc';
            $ad_inv = 'desc';
        }
    }

    if (isset($_GET['ob'])) {
        $ob = InputFilter($_GET['ob']);
        if (!in_array($ob, array("id", "id_news", "nickname", "time_sent", "time_read"))) {
            $ob = "id";
        }
    }

    $results_page_count_to_navigate_betweenu = 12;
    $page = (isset($_GET['page']) && $_GET['page'] >= 1) ? InputFilter($_GET['page']) : 1;
    $start = ($page - 1) * $reportMaxNbr;

    $id_link = AdminCreateLink("", array("prog", "subdo", "ob", "ad", "page"), array("news", "read_report", "id", $ad_inv, $page));
    $id_news_link = AdminCreateLink("", array("prog", "subdo", "ob", "ad", "page"), array("news", "read_report", "id_news", $ad_inv, $page));
    $nickname_link = AdminCreateLink("", array("prog", "subdo", "ob", "ad", "page"), array("news", "read_report", "nickname", $ad_inv, $page));
    $time_sent_link = AdminCreateLink("", array("prog", "subdo", "ob", "ad", "page"), array("news", "read_report", "time_sent", $ad_inv, $page));
    $time_read_link = AdminCreateLink("", array("prog", "subdo", "ob", "ad", "page"), array("news", "read_report", "time_read", $ad_inv, $page));
    $NickName_link = AdminCreateLink("", array("prog", "subdo", "ob", "ad", "page"), array("news", "read_report", "nickname", $ad_inv, $page));

    $db_r = new db();
    $news_report = $db_r->get_results(" SELECT * FROM `news_report` order by `" . $ob . "` " . $ad . "  limit $start,$reportMaxNbr ; ");
    $reportTotalRecords = $db_r->get_var(" SELECT count(*) FROM `news_report`  ; ");

    if ($news_report) {
        $read_report = ' <table cellpadding="4px" cellspacing="2px; "> <tr> '
                . '<td class="td_title"> <strong><a href ="' . $id_link . '" >' . id . '</a></strong> </td>'
                . '<td class="td_title"><strong><a href ="' . $id_news_link . '" >' . id_news . '</a></strong> </td>'
                . '<td class="td_title"> <strong><a href ="' . $NickName_link . '" >' . NickName . '</a></strong></td>'
                . '<td class="td_title"><strong><a href ="' . $time_sent_link . '" >' . time_sent . '</a></strong> </td> '
                . '<td class="td_title"><strong><a href ="' . $time_read_link . '" >' . time_read . '</a></strong> </td>'
                . '</tr>';
        foreach ($news_report as $read) {
            $id = $read->id;
            $id_news = $read->id_news;
            $nickname = $read->nickname;
            $time_sent = $read->time_sent;
            $time_read = $read->time_read;
            $read_report .= '<tr  class="row_tr"> '
                    . '<td  class="td_data"> ' . $id . '</td>'
                    . '<td   class="td_data"> ' . $id_news . '</td>'
                    . '<td   class="td_data"> ' . $nickname . '</td>'
                    . '<td  class="td_data">' . $time_sent . '</td> '
                    . '<td  class="td_data"> ' . $time_read . '</td>'
                    . '</tr>';
        }
        $read_report .= '</table>';
        $read_report.= paginate_results($reportMaxNbr, $results_page_count_to_navigate_betweenu, $reportTotalRecords, $page, array('prog', 'subdo', 'ob', 'ad'), array('news', 'read_report', $ob, $ad), true);
    } else {
        $read_report = no_report_today;
    }

    return $read_report;
}

function allNews() {
    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang;

    $ob = "date"; // order by
    $ad = 'desc'; // asc desc 
    $ad_inv = 'asc';
    $fv = '';
    $fb = '';
    $filter = "";
    if (isset($_GET['ad'])) {
        if ($_GET['ad'] == 'asc') {
            $ad = 'asc';
            $ad_inv = 'desc';
        }
    }

    if (isset($_GET['ob'])) {
        $ob = InputFilter($_GET['ob']);
        if (in_array($ob, array("pic", "active", "nickname", "date", "hits", "cat", "title"))) {
            switch ($_GET['ob']) {
                case "pic":
                    $orderby = " `news`.`NewsPic` ";
                    break;
                case "active":
                    $orderby = " `news`.`Active` ";
                    break;
                case "nickname":
                    $orderby = " `news`.`IdUserName` ";
                    break;
                case "date":
                    $orderby = " `news`.`Date` ";
                    break;
                case "hits":
                    $orderby = " `news`.`Hits` ";
                    break;
                case "cat":
                    $orderby = " `catlang`.`IdCat` ";
                    break;
                case "title":
                    $orderby = "  `newslang`.`Tilte`  ";
                    break;
                default:
                    $orderby = " `news`.`Date` ";
                    break;
            }
        }
    } else {
        $orderby = " `news`.`Date` ";
    }

    if (isset($_GET['fb'])) { //filter by
        $fb = InputFilter($_GET['fb']);
        if (in_array($fb, array("pic", "active", "nickname", "date", "hits", "cat", "title"))) {

            if (isset($_GET['fv'])) { //filter value
                $fv = InputFilter($_GET['fv']);
                switch ($_GET['fb']) {
                    case "pic":
                        $filter = " and `news`.`NewsPic`='" . $fv . "' ";

                        break;
                    case "active":
                        $filter = " and `news`.`Active`='" . $fv . "'  ";
                        break;
                    case "nickname":
                        $filter = " and `news`.`IdUserName`='" . $fv . "'  ";
                        break;
                    case "date":
                        $filter = " and `news`.`Date`='" . $fv . "'  ";
                        break;
                    case "hits":
                        $filter = " and `news`.`Hits`='" . $fv . "'  ";
                        break;
                    case "cat":
                        $filter = " and `catlang`.`IdCat`='" . $fv . "'  ";
                        break;
                    case "title":
                        $filter = " and  `newslang`.`Tilte`='" . $fv . "'   ";
                        break;
                    default:
                        break;
                }
            }
        }
    }

    $allNews = '';
    $NewsMaxNbr = 50;
    $NbrNews = 0;
    $results_page_count_to_navigate_betweenu = 17;
    $page = (isset($_GET['page']) && $_GET['page'] >= 1) ? InputFilter($_GET['page']) : 1;
    $start = ($page - 1) * $NewsMaxNbr;

    ExcuteQuery("select * from `languages` where `LangName`='" . $Lang . "' and Deleted <> '1';");
    if ($TotalRecords > 0) {
        $IdLang = $Rows['IdLang'];

        ExcuteQuery("select * from `languages`,`news`,`newslang`,`newscategoies`,`catlang`
                        where
                        `languages`.`IdLang` = `newslang`.`IdLang` and
                        `languages`.`IdLang` = `catlang`.`IdLang` and
			`news`.`IdNews`=`newslang`.`IdNews` and `newslang`.`IdLang`='" . $IdLang . "' 
                        and `news`.`IdNews`=`newscategoies`.`IdNews` 
                        and `catlang`.`IdCat` = `newscategoies`.`IdCat`
			and `news`.`Deleted`<>'1' 
                        " . $filter . "
                        order by " . $orderby . " " . $ad . " limit  $start,$NewsMaxNbr; ");

        $db_news_count = new db();
        $NewsTotalRecords = $db_news_count->get_var("select count(*) from `languages`,`news`,`newslang`,`newscategoies`,`catlang`
                        where 
                        `languages`.`IdLang` = `newslang`.`IdLang` and
                        `languages`.`IdLang` = `catlang`.`IdLang` and
			`news`.`IdNews`=`newslang`.`IdNews` and `newslang`.`IdLang`='" . $IdLang . "' 
                        and `news`.`IdNews`=`newscategoies`.`IdNews` 
                        and `catlang`.`IdCat` = `newscategoies`.`IdCat`
			and `news`.`Deleted`<>'1' 
                        " . $filter . ";  ");

        $pic_link = AdminCreateLink("", array("prog", "subdo", "ob", "ad", "page"), array("news", "allNews", "pic", $ad_inv, $page));
        $active_link = AdminCreateLink("", array("prog", "subdo", "ob", "ad", "page"), array("news", "allNews", "active", $ad_inv, $page));
        $nickname_link = AdminCreateLink("", array("prog", "subdo", "ob", "ad", "page"), array("news", "allNews", "nickname", $ad_inv, $page));
        $date_link = AdminCreateLink("", array("prog", "subdo", "ob", "ad", "page"), array("news", "allNews", "date", $ad_inv, $page));
        $hits_link = AdminCreateLink("", array("prog", "subdo", "ob", "ad", "page"), array("news", "allNews", "hits", $ad_inv, $page));
        $cat_link = AdminCreateLink("", array("prog", "subdo", "ob", "ad", "page"), array("news", "allNews", "cat", $ad_inv, $page));
        $title_link = AdminCreateLink("", array("prog", "subdo", "ob", "ad", "page"), array("news", "allNews", "title", $ad_inv, $page));

        if ($TotalRecords > 0) {
            $allNews = '<table style="float:right;" width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td class="td_title" ><strong><a href="' . $pic_link . '" >' . NewsPic . '</a></strong></td>
			<td class="td_title"><strong><a href="' . $title_link . '" >' . Tilte . '</a></strong></td>
			<td  class="td_title"><strong><a href="' . $nickname_link . '" >' . NickName . '</a></strong></td>
			<td class="td_title"><strong><a href="' . $date_link . '" >' . Date . '</a></strong></td>
			<td class="td_title"><strong><a href="' . $active_link . '" >' . Active . '</a></strong></td>
			<td class="td_title"><strong><a href="' . $hits_link . '" >' . Hits . '</a></strong></td>
			<td class="td_title"><strong><a href="' . $cat_link . '" >' . CatNews . '</a></strong></td>
			<td class="td_title">&nbsp;</td><td class="td_title">&nbsp;</td>
			</tr>';

            for ($i = 0; $i < $TotalRecords; $i++) {
                $IdNews = $Rows['IdNews'];
                $IdUserName = $Rows['IdUserName'];
//get user name
                $Q = " SELECT `NickName` FROM `users` where `UserId`='" . $IdUserName . "';";
                $RS = mysqli_query($conn, $Q);
                $Totals = mysqli_num_rows($RS);
                if ($Totals > 0) {
                    $DATA = mysqli_fetch_assoc($RS);
                    $NickName = $DATA['NickName'];
                } else {
                    $NickName = '';
                }
                $NickName = '<a href="' . CreateLink("", array("Prog", "acnt", "user"), array("account", "profile", $NickName)) . '" />' . $NickName . '</a>';
                $Date = $Rows['Date'];
                $Active_yn = $Rows['Active'];
                if ($Active_yn == "1") {
                    $Active = yes;
                } else {
                    $Active = no;
                }//end if
                $Hits = $Rows['Hits'];
                $CatName = $Rows['CatName'];
                $CatName = $Rows['CatName'];
                $Tilte = $Rows['Tilte'];
                $Tilte = mb_substr($Tilte, 0, 50, 'utf-8');
                $IdCat = $Rows['IdCat'];

                $Tilte = '<a href="' . CreateLink("", array("Prog", "ns", "idnews"), array("news", "details", $IdNews)) . '" />' . $Tilte . '</a>';

                $Vars = array("prog", "subdo", "IdNews");
                $Vals = array("news", "NewsCom", $IdNews);
                $NewsCommentaire = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">'
                        . (NewsCommentaire) . '</a>';
                $Vars = array("prog", "subdo", "IdNews");
                $Vals = array("news", "editNews", $IdNews);
                $editNews = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">'
                        . (edit) . '</a>';
                $Vars = array("prog", "subdo", "IdNews");
                $Vals = array("news", "deleteNews", $IdNews);
                $deleteNews = '<a onclick="return AcceptDel();" href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">'
                        . (delete) . '</a>';
                $NewsPic = '<img class="news_pic" '
                        . 'src="uploads/news/pics/' . $Rows['NewsPic'] . '" alt ="' . $Rows['NewsPic'] . '" />';

                $CatName_link = AdminCreateLink("", array("prog", "subdo", "ob", "fb", "fv", "page"), array("news", "allNews", $ob, 'cat', $IdCat, 1));
                $CatName_link = '<a href="' . $CatName_link . '" >' . $CatName . '</a>';

                $Active_link = AdminCreateLink("", array("prog", "subdo", "ob", "fb", "fv", "page"), array("news", "allNews", $ob, 'active', $Active_yn, 1));
                $Active_link = '<a href="' . $Active_link . '" >' . $Active . '</a>';

                $allNews .= '  <tr class="row_tr"><td class="td_data" >'
                        . $NewsPic . '</td><td  class="td_data">'
                        . $Tilte . '</td><td  class="td_data">'
                        . $NickName . '</td><td  class="td_data">'
                        . $Date . '</td><td  class="td_data">'
                        . $Active_link . '</td><td  class="td_data">'
                        . $Hits . '</td><td  class="td_data">'
                        . $CatName_link . '</td><td  class="td_data">'
                        . $NewsCommentaire . '</td><td  class="td_data">'
                        . $deleteNews . ' <br/><br/> '
                        . $editNews . '</td></tr>';
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for

            $allNews .='</table>
                        <script language="javascript" type="text/javascript">
			function AcceptDel(){
			return confirm("' . DidUWantToDeleteNews . '");
			}
			</script>';
        }//end if
    }//end if

    $allNews .= paginate_results($NewsMaxNbr, $results_page_count_to_navigate_betweenu, $NewsTotalRecords, $page, array('prog', 'subdo', 'ob', 'ad', 'fb', 'fv'), array('news', 'allNews', $ob, $ad, $fb, $fv), true);

    return $allNews;
}

//end function

function NewsCom() {

    global $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang;
    $IdNews = InputFilter($_GET['IdNews']);

    ExcuteQuery("select * from `newscomment` where `IdNews`='" . $IdNews . "' order by `CommentDate` desc;");
    if ($TotalRecords > 0) {

        $NewsCom = '<table border="0" cellspacing="2" cellpadding="2">
				  <tr>
				<td><strong>' . (NickName) . '</strong></td>
				<td><strong>' . (Contry) . '</strong></td>
				<td><strong>' . (Date) . '</strong></td>
					 <td><strong>' . (CommentTitle) . '</strong></td>
				<td><strong>' . (theComment) . '</strong></td>
					<td align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
				  </tr>';
        for ($i = 0; $i < $TotalRecords; $i++) {
            $CommentTitle = $Rows['CommentTitle'];
            $UserId = $Rows['UserId'];
            $idComment = $Rows['idComment'];

//get user name
            $Q = " SELECT `NickName` FROM `users` where `UserId`='" . $UserId . "';";
            $RS = mysqli_query($conn, $Q);
            $Totals = mysqli_num_rows($RS);
            if ($Totals > 0) {
                $DATA = mysqli_fetch_assoc($RS);
                $NickName = $DATA['NickName'];
            }//end if

            $cc = '<img src="images/flags/' . $Rows['cc'] . '.png" alt="' . $Rows['cc'] . '"/>';
            $CommentDate = $Rows['CommentDate'];
            $theComment = strip_tags(substr($Rows['theComment'], 0, 50)) . ' ... ';
            $Vars = array("prog", "subdo", "idComment");
            $Vals = array("news", "editComment", $idComment);
            $editCom = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">'
                    . (edit) . '</a>';
            $Vars = array("prog", "subdo", "idComment");
            $Vals = array("news", "deleteComment", $idComment);
            $deleteCom = '<a onclick="return AcceptDel();" href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">'
                    . (delete) . '</a>';
            $NewsCom .= '  <tr>
						<td style="border-bottom:dotted; border-bottom-width:thin">' . $NickName . '</td>
						<td style="border-bottom:dotted; border-bottom-width:thin">' . $cc . '</td>
						<td style="border-bottom:dotted; border-bottom-width:thin">' . $CommentDate . '</td>
							<td style="border-bottom:dotted; border-bottom-width:thin">' . $CommentTitle . '</td>
						<td style="border-bottom:dotted; border-bottom-width:thin">' . $theComment . '</td>
							<td style="border-bottom:dotted; border-bottom-width:thin">'
                    . $deleteCom . '</td>
							<td style="border-bottom:dotted; border-bottom-width:thin">'
                    . $editCom . '</td>
						  </tr>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $NewsCom .='</table>
							<script language="javascript" type="text/javascript">
								function AcceptDel(){
									return confirm("' . (DidUWantToDeleteCom) . '");
								}
							
							</script>';
    } else {
        $NewsCom = (ThisNewsHaventComments);
    }//end if


    return $NewsCom;
}

//end function

function addNews() {

    global $UserId, $LastSession, $NickName, $CustomHead, $WebiteFolder, $ThemeName, $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang, $TinyDir;

    if (!isset($_POST['SubmitNewNews'])) {

        $CustomHead .= '<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
                        <style>
                        .ui-autocomplete-loading {
                        background: white url("admin/Themes/' . $ThemeName . '/images/ui-anim_basic_16x16.gif") right center no-repeat;
                        }
                        </style>';

        $CustomHead .= '
                    <link href="Programs/news/admin/fileupload/client/fineuploader.css" rel="stylesheet" type="text/css"/>
                    
                    <script src="Programs/news/admin/fileupload/client/js/header.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/util.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/button.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/ajax.requester.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/deletefile.ajax.requester.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/handler.base.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/window.receive.message.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/handler.form.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/handler.xhr.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/uploader.basic.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/dnd.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/uploader.php?up=' . UploadNewPicture . '&IdMedia=uploads/news/pics/"></script>
                    <script src="Programs/news/admin/fileupload/client/js/jquery-plugin.js"></script>';

// echo ' xxx '. $WebiteFolder;

        if (trim($WebiteFolder) == "" or $WebiteFolder == "/") {
            $CustomHead .= ' <script src="Programs/news/admin/fileupload/js/uploader.php?path=/Programs/news/admin/fileupload/receiver/index.php?path=uploads/news/pics/"></script>';
        } else {
            $CustomHead .= ' <script src="/' . $WebiteFolder . '/Programs/news/admin/fileupload/js/uploader.php?path=/' . $WebiteFolder . '/Programs/news/admin/fileupload/receiver/index.php?path=uploads/news/pics/"></script>';
        }
        if (isset($_COOKIE['phpTransformer'])) {
            $LastSession = session_id();
        } else {
            $LastSession = '';
        }

        $addNews = '<script language="javascript" type="text/javascript">
            document.onkeydown = document.onkeypress = function (evt) {
            if (!evt && window.event) {
            evt = window.event;
            }
            var keyCode = evt.keyCode ? evt.keyCode :
            evt.charCode ? evt.charCode : evt.which;
            if (keyCode) {
            if (evt.ctrlKey) {
            if(keyCode==83){
            document.getElementById("SubmitNewNews").click();
            return false;
            }
            return false;
            }
            }
            return true;
            }
            </script>

            <script src="Programs/news/Themes/' . $ThemeName . '/SpryValidationTextField.js" type="text/javascript"></script>
	<script src="Programs/news/Themes/' . $ThemeName . '/SpryValidationTextarea.js" type="text/javascript"></script>
	<link href="Programs/news/Themes/' . $ThemeName . '/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
	<link href="Programs/news/Themes/' . $ThemeName . '/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" media="all" href="includes/jscalendar/Style/calendar-Default.css" />
	<script type="text/javascript" src="includes/jscalendar/calendar.js"></script>
	<script type="text/javascript" src="includes/jscalendar/Languages/calendar-Arabic.js"></script>
	<script type="text/javascript" src="includes/jscalendar/calendar-setup.js"></script>
				
        <link rel="stylesheet" href="includes/elrte/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8" /> 
        <link rel="stylesheet" href="includes/elrte/elrte/css/elrte.min.css"  type="text/css" media="screen" charset="utf-8" />
        <link rel="stylesheet" href="includes/elrte/elfinder/css/elfinder.css" type="text/css" media="screen" charset="utf-8" />

        <script src="includes/jquery/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="includes/elrte/elrte/js/elrte.min.js"  type="text/javascript" charset="utf-8"></script>
        <script src="includes/elrte/elrte/js/i18n/elrte.' . MiniLang . '.js"  type="text/javascript" charset="utf-8"></script>

        <script src="includes/elrte/elfinder/js/elfinder.min.js"type="text/javascript" charset="utf-8"></script>
        <script src="includes/elrte/elfinder/js/i18n/elfinder.' . MiniLang . '.js"type="text/javascript" charset="utf-8"></script>

        <script type="text/javascript" charset="utf-8">
        $().ready(function() {


        $("#elFinder a").delay(800).animate({"background-position" : "0 0"}, 300);

        var opts = {
        absoluteURLs: false,
        cssClass : "el-rte",
        lang : "' . MiniLang . '",
        height   : 250,
        toolbar  : "maxi",
        cssfiles : ["includes/elrte/elrte/css/elrte-inner.css"],
        fmOpen : function(callback) {
        $("<div id=\'myelfinder\' />").elfinder({
        url : "includes/elrte/elfinder/connectors/connector.php?id=' . $UserId . '&sess=' . $LastSession . '",
        lang : "' . MiniLang . '",
        dialog : { width : 900, modal : true, title : "' . Gallery . '" },
        closeOnEditorCallback : true,
        editorCallback : callback
        })
        }
        }
        $(".editor").elrte(opts);
        


        })

	</script>
	<form id="form1" name="form1" method="post" action="">';


        $tabs = '<ul class="tabs">';
        $divs = '';
        $DivNewNews = '';

        $query = "select * from `languages` where `Deleted`<> '1' ;";
        ExcuteQuery($query);
        if ($TotalRecords > 0) {
            $j = 3; // number of required input text
//$t = 2 
            $k = 1;
            ; // number of required text area
            for ($i = 0; $i < $TotalRecords; $i++) {

                $IdLang = $Rows['IdLang'];
                $LangName = $Rows['LangName'];

                $tabs .= '<li class="tab' . ($i + 1) . '">
			<a class="tab' . ($i + 1) . ' tab">
				' . $LangName . '	
			</a></li>';

                $DivaddNews = Tilte . ' ' . $LangName . ' :<br/>
					<span id="sprytextfield' . $j++ . '">
					  <label>
					  <input size="35" maxlength="128" class="text" type="text" name="Tilte' . $LangName . '" id="Tilte' . $LangName . '" />
					  </label>
					  <span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span><br/>' .
                        SubTitle . ' ' . $LangName . ' :<br/>
            <label>
            <input size="35" maxlength="35" class="text" type="text" name="SubTitle' . $LangName . '" id="SubTitle' . $LangName . '" />
            </label><br/><span id="sprytextarea' . $k++ . '">' .
                        Breif . ' ' . $LangName . ' : <span class="textareaRequiredMsg">' . Avalueisrequired . '</span><br/>
		<label><textarea class="textarea"  name="Breif' . $LangName . '" id="Breif' . $LangName . '" cols="70" rows="15"></textarea>
            </label>
		 </span><br/><span id="sprytextarea' . $k++ . '">
		' . FullMessage . ' ' . $LangName . ' :<span class="textareaRequiredMsg">' . Avalueisrequired . '</span><br/>
            <label>
            <textarea class="editor" name="FullMessage' . $LangName . '" id="FullMessage' . $LangName . '" cols="70" rows="20">
            </textarea>
            </label>
            </span><br/>' .
                        Note . ' ' . $LangName . ' : <br/>
		<label>
		<input size="75" maxlength="200" class="text" type="text" name="Note' . $LangName . '" id="Note' . $LangName . '" />
		</label> ';

                $divs .= '<!-- tab ' . ($i + 1) . ' -->
			<div class="tab' . ($i + 1) . ' tabsContent">
				<div>' . $DivaddNews . '</div>
			</div><!-- end of t' . ($i + 1) . ' -->';

                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
        }//end if
        $tabs .= '</ul>';

        $addNews .= '<div class="TabsMainContainer">
        <div class="htmltabs">' . $tabs . $divs . '</div></div>
		';

        $addNews .= '<table border="0" cellspacing="1" cellpadding="1">
                <tr><td></td></tr><tr><td>' . Date . ' : 
		<span id="sprytextfield1"><label>
		<input value="' . date("Y-m-d H:i:s") . '" class="text" type="text" style="width:150px" 
                name="newsDate" id="newsDate" /></label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <input type="checkbox" checked="checked" name="SaveNewsBar" id="SaveNewsBar" /> 
                ' . SaveNewsBAR . '&nbsp;
		<span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span>
                ' . to . '<select class="select" name="EndDate">
                <option value="' . date('Y-m-d H:i:s', strtotime("+1 days")) . '" > 1 ' . Day . '</option>
                   <option value="' . date('Y-m-d H:i:s', strtotime("+6 days")) . '" selected="selected" > 6 ' . Day . '</option>
                   <option value="' . date('Y-m-d H:i:s', strtotime("+30 days")) . '" > 30 ' . Day . '</option>
                   <option value="0" > ' . NoDateInterval . '</option>
                </select> 
				' . UserName . ' : 
				<span id="sprytextfield2">
				  <label> <span class="ui-widget">
                                        <input value="' . $NickName . '" size="15" maxlength="15" class="text" type="text" name="IdUserName" id="IdUserName" />
                                  </span>
				  </label><span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span> </td></tr/><tr><td>
                                  &nbsp;&nbsp;';

        $agency = '';

        $addNews .= '<span class="ui-widget">
                     <label for="agency">' . agency . ' : </label>'
                . '<input value="' . $agency . '" size="15" maxlength="15" class="text" type="text" name="agency" id="agency" />'
                . '</span>';

        $addNews .= ' &nbsp;&nbsp;' . Active . ':<label>
				  <select class="select" name="Active" id="Active">
				<option value="1">' . yes . '</option>
				<option value="0">' . no . '</option>
				</select>
				</label>&nbsp;&nbsp;' . NewsCategorie . ':
				<label>
				  <select class="select" name="IdCat" id="IdCat">';
        $query = "select * from `languages` where `LangName`='" . $Lang . "';";
        ExcuteQuery($query);
        if ($TotalRecords > 0) {
            $IdLang = $Rows['IdLang'];
        }//end if
        
        ExcuteQuery("select * from `catlang`"
                . "  where `IdLang`='" . $IdLang . "' and `Deleted`<>'1'  order by `sort` asc ;");
        if ($TotalRecords > 0) {
            for ($i = 0; $i < $TotalRecords; $i++) {
                $IdCat = $Rows['IdCat'];
                $CatName = $Rows['CatName'];
                $addNews .= '<option value="' . $IdCat . '">' . $CatName . '</option>';
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
        }//end if
        $addNews .='</select>';

        $addNews .= '&nbsp;<select class="select" name="urgent" id="urgent">'
                . '<option value="0" > ' . ordinary . '</option> '
                . '<option  value="1"> ' . urgent . ' </option>'
                . '</select> </td></tr><tr><td>';
//get group list
        $db_g = new db();
        $members_g = $db_g->get_results(" select * from `groups` ;");
        if ($members_g) {
            $g_l = '<select id="g_l" name="g_l" class="select"><option value="all" >' . EveryOne . '</option>';
            foreach ($members_g as $g) {
                $GroupId = $g->GroupId;
                $GroupName = $g->GroupName;
                $g_l .= ' <option value="' . $GroupId . '" >' . $GroupName . ' </option>';
            }
            $g_l .= '</select>';
        }


        $addNews .= send_mobile_notification . ' :<input id="dont_send"  value="dont_send" type="radio" name="notification" /><label for="dont_send" >' . dont_send . '</label>'
                . '&nbsp;&nbsp;&nbsp;<input id="user_choise" checked value="user_choise" type="radio" name="notification" /><label for="user_choise" >' . Users_Choises . '</label>'
                . '&nbsp;&nbsp;&nbsp;<input id="user_group" value="user_group" type="radio"  name="notification" /><label for="user_group" >' . group . '</label>:  ' . $g_l;

        $addNews .='<ul id="basicUploadSuccessExample" class="unstyled"></ul>
                    <ul><input value="' . OpenGallery . '" type="button" id="opengallery" class="submit" > </ul>
                    <div id="MiniNewsPic" style="width:200px; height:200px;">
                      <img style="max-width:200px; max-height:200px;" src="uploads/news/pics/newspaper.png" alt="none"/>
                    </div><br/>
                     <input type="hidden" value="newspaper.png" name="NewsPic" id="NewsPic">
                                          <div align="center">
          <input class="submit" type="submit" name="SubmitNewNews" id="SubmitNewNews" value="' . save . '">
           </form>
		</div></td></tr><tr></tr>
            </table>					
            <script type="text/javascript">
            function catcalc(cal) {
		var date = cal.date ;
		var time = date.getTime() ;
            }
			Calendar.setup({
			inputField :"newsDate",   // id of the input field
			ifFormat   :"%Y-%m-%d %H:%M:%S",   // format of the input field
			showsTime  :true,
			timeFormat :"24",
			onUpdate   :catcalc
			});
			

            function OpenModalPopUP(WindowURL){
                window.showModalDialog(WindowURL,"resizable=1");
                window.location.reload();
            }
            
            $(function() {
                $("#agency").autocomplete({
                    source: "Programs/news/admin/users.php",
                    minLength: 3
                });
                 $("#IdUserName").autocomplete({
                    source: "Programs/news/admin/users.php",
                    minLength: 3
                });
               
            });
        

            $("#g_l").on("click",function() {
                $("#user_group").prop("checked", true);
            });
             

            var input = $("#opengallery"),
                opts = { 
                  absoluteURLs: false,
                    cssClass : "el-rte",
                    lang : "' . MiniLang . '",
                    height   : 250,
                    toolbar  : "maxi",
                    cssfiles : ["includes/elrte/elrte/css/elrte-inner.css"],
                    url : "includes/elrte/elfinder/connectors/connector.php?id=' . $UserId . '&sess=' . $LastSession . '",
                   editorCallback : function(url) { 
                        $("#NewsPic").val(url) ;
                        $("#MiniNewsPic").find("img").attr("src",$("#NewsPic").val());
                   },
                   closeOnEditorCallback : true,
                   dialog : { title : "elFinder" }
                };

            input.click(function() {
               $("<div id=\'fileo\' dir=\'ltr\' />").elfinder(opts)
            } );
            
            </script>';

        $addNews .= '<script type="text/javascript">';
        for ($i = 1; $i < $j; $i++) {
            $addNews .='var sprytextfield' . $i . ' = new Spry.Widget.ValidationTextField("sprytextfield' . $i . '");';
        }
        for ($i = 1; $i < $k; $i++) {
            $addNews .='var sprytextarea' . $i . ' = new Spry.Widget.ValidationTextarea("sprytextarea' . $i . '");';
        }
        $addNews .='</script>';
    } else {
        if (!ValidUser(PostFilter($_POST['IdUserName']))) {
            $IdUserName = $_POST['IdUserName'];
            $query = "select `UserId` from `users` where `NickName`='" . $IdUserName . "';";
            ExcuteQuery($query);
            if ($TotalRecords > 0) {
                $IdUserName = $Rows['UserId'];
            }
            $Active = PostFilter($_POST['Active']);
            $NewsPic = PostFilter($_POST['NewsPic']);
            $IdCat = PostFilter($_POST['IdCat']);
            $IdNews = GenerateID("news", "IdNews");
            $newsDate = PostFilter($_POST['newsDate']);
            $agency = PostFilter($_POST['agency']);
            $urgent = PostFilter($_POST['urgent']);

            $active_by = $IdUserName;
            if (strpos($NewsPic, "/") !== false) {
                $original_NewsPic = $NewsPic;

                $NewsPic = explode("/", $NewsPic);
                $NewsPic = end($NewsPic);
                pt_create_thumbs($original_NewsPic, "uploads/news/pics/" . $NewsPic, 200);
            }

            mysqli_query($conn, "insert into `news` (`IdNews`,`IdUserName`,`Date`,`Active`,`Hits`,`NewsPic`,`agency`,`urgent`,`active_by`) 
			values('" . $IdNews . "','" . $IdUserName . "','" . $newsDate . "','" . $Active . "',0,'" . $NewsPic . "' ,'" . $agency . "', '" . $urgent . "','" . $active_by . "');");

            mysqli_query($conn, "insert into `newscategoies` (`IdNews`,`IdCat`) 
			values('" . $IdNews . "','" . $IdCat . "');");

            $query = "select * from `languages` where `Deleted`<>'1' ;";
            ExcuteQuery($query);
            if ($TotalRecords > 0) {
                for ($i = 0; $i < $TotalRecords; $i++) {
                    $IdLang = $Rows['IdLang'];
                    $LangName = $Rows['LangName'];

                    $Tilte = PostFilter($_POST['Tilte' . $LangName]);
                    $Tilte = str_replace(array(":", "/", "\\", "@"), array("", "", "", ""), $Tilte);

                    $SubTitle = PostFilter($_POST['SubTitle' . $LangName]);
                    $Breif = PostFilter($_POST['Breif' . $LangName], true);
                    $Breif = str_replace("<p>", "", $Breif);
                    $Breif = str_replace("</p>", "", $Breif);

                    $FullMessage = PostFilter($_POST['FullMessage' . $LangName], true);
                    $Note = PostFilter($_POST['Note' . $LangName]);
                    mysqli_query($conn, "insert into `newslang`
				(`IdLang`,`IdNews`,`Tilte`,`SubTitle`,`Breif`,`FullMessage`,`Note`) 
				values ('" . $IdLang . "','" . $IdNews . "','" . $Tilte . "','" . $SubTitle . "','" . $Breif . "','" . $FullMessage . "','" . $Note . "');");

                    $Rows = mysqli_fetch_assoc($Recordset);
                    echo '<iframe style="border:none" width="0" height="0" src="Programs/news/admin/GeneratePDF.php?Lang=' . $LangName . '&idnews=' . $IdNews . '"></iframe>';
                }//end for
            }//end if
            $addNews = (SuccessSaveNews);
//add news title to the marque
//echo "SaveNewsBar : " . $_POST['SaveNewsBar'];
            if ($_POST['SaveNewsBar'] == "on") {
                addNewsBAR($IdNews);
            }//end if
        } else {
            $addNews = PostedaddNews();
        }
        if (isset($IdNews)) {
            $NewsUrl = CreateLink('', array('Prog', 'ns', 'idnews'), array('news', 'details', $IdNews));
            $addNews .='
            <script language="javascript" type="text/javascript" src="includes/ping.js"></script>
            <script language="javascript" type="text/javascript">
            pingSE("' . $Tilte . '","' . $NewsUrl . '");
            </script>';
        }

        //send push notifications 

        if (isset($_POST['notification']) && isset($_POST['Active']) && $_POST['Active'] == 1) {
            if ($_POST['notification'] == 'user_choise') {
                //  echo 'select users preferences from table notifications';
                ajax_send_android_notifications('user_choise', $IdCat, $urgent, $Tilte, mb_substr($Breif, 0, 150, 'utf8'), $Tilte, $IdNews);
                // news group id , is urgent
            } elseif ($_POST['notification'] == 'user_group') {
                if ($_POST['g_l'] == 'all') {
                    //     echo 'send to all members';
                    ajax_send_android_notifications('all', $IdCat, $urgent, $Tilte, mb_substr($Breif, 0, 150, 'utf8'), $Tilte, $IdNews);
                } else {
                    //       echo ' get group id to send' . $_POST['g_l'];
                    ajax_send_android_notifications(PostFilter($_POST['g_l']), $IdCat, $urgent, $Tilte, mb_substr($Breif, 50, 150, 'utf8'), $Tilte, $IdNews);
                }
            } else {
                // echo 'dont send';
            }
        }
    }

    return $addNews;
}

function ajax_send_android_notifications($to, $id_news_group, $is_urgent, $title, $message, $ticker, $id_news, $limit = 500) {
    global $android_key, $db;
    if (empty($db))
        $db = new db();

    if ($to == 'all') {
        $total = $db->get_var("select count(*) from users where android_id <> '0' and android_id <> ''");
        //$total = $db->get_var("select count(*) from cclang");
    } else if ($to == 'user_choise')
        $total = $db->get_var("select count(*) from users as u,notification as n where u.UserId = n.id_user and n.id_news_group = '$id_news_group' and n.only_urgent = '$is_urgent' and u.android_id <> '0' and u.android_id <> ''");
    else
        $total = $db->get_var("select count(*) from users where GroupId = '$to'");

    $total = ($total % $limit) == 0 ? ($total / $limit) : floor($total / $limit) + 1;
    ?>
    <script type="text/javascript">
        var notes_count = 0;
        function send_note(data)
        {
            var total = <?php echo $total; ?>;
            var width = ((1 / total) * $('#progress_div').width()) - 1;
            var next_page = data['page'];
            var percentage = (percentage === null) ? Math.floor((next_page / total) * 100) : Math.floor((next_page / total) * 100);
            if (data['more'] == 1)
            {
                var url = "Programs/news/admin/send_notifications.php";
                $('#progress_div').append('<div style="border-right:solid 1px gray;background:#61A0D6;color:white;width:' + (width) + 'px;height:20px;float:left;text-align:center;" />');
                $('#process_percentage_div').html(percentage + '%');
                var data = {'to': '<?php echo $to; ?>', 'id_news_group': '<?php echo $id_news_group; ?>', 'is_urgent': <?php echo $is_urgent; ?>, 'id_news': '<?php echo $id_news; ?>', 'page': next_page, 'limit': '<?php echo $limit; ?>'};
                var request = $.ajax({'url': url, 'data': data, 'dataType': 'json', 'type': 'GET'});
                request.done(send_note);
            }
            else
            {
                $('#progress_div').append('<div style="background:#61A0D6;color:white;width:' + (width) + 'px;height:20px;float:left;text-align:center;" />');
                $('#process_percentage_div').html('100%');
            }
        }

        var url = "Programs/news/admin/send_notifications.php";
        var data = {'to': '<?php echo $to; ?>', 'id_news_group': '<?php echo $id_news_group; ?>', 'is_urgent': '<?php echo $is_urgent; ?>', 'id_news': '<?php echo $id_news; ?>', 'page': 1, 'limit': '<?php echo $limit; ?>'};
        var request = $.ajax({'url': url, 'data': data, 'dataType': 'json', 'type': 'GET'});
        request.done(send_note);
    </script>
    <div style='color:gray;'><?php echo send_mobile_notification; ?> : </div>
    <div id='progress_div' style='clear:both;width:100%;overflow:hidden;border:solid 1px gray;height:20px;'>

    </div>
    <div style='color: red;margin-bottom: 20px;' id='process_percentage_div'>0%</div>
    <?php
}

function send_android_notification($to, $id_news_group, $is_urgent, $title, $message, $ticker, $id_news) {
    global $android_key;
    //$android_id = array();
    $db_n = new db();
    if ($to == 'all') {
        $members = $db_n->get_results(" SELECT * FROM `users` where android_id <> '0' and android_id <> '' ORDER BY `GroupId` ASC ");
    } elseif ($to == "user_choise") {
        $members = $db_n->get_results(" select * from `users`,`notification`"
                . " where `users`.`UserId` = `notification`.`id_user`"
                . " and users.android_id <> '0' and users.android_id <> ''"
                . " and `notification`.`id_news_group`='" . $id_news_group . "' "
                . " and `notification`.`only_urgent`='" . $is_urgent . "' ;");
    } else { //groupid
        $members = $db_n->get_results(" select * from `users` where `GroupId`='" . $to . "';  ");
    }

    $i = 0;
    $j = 0;

    if (count($members) > 0) {
        foreach ($members as $member) {
            $android_id[$j][$i] = $member->android_id;
            $users_id[$j][$i] = $member->UserId;
            if ($i < 999) {
                $i++;
            } else {
                $i = 0;
                $j++;
            }
        }

        //var_dump($android_id);
        $e = 0;
        foreach ($android_id as $registration_ids) {
            //var_dump($registration_ids);
            // $registration_ids = array($android_id);
            // $api_key = $android_key;
            $message_id = substr($id_news, -6, 6);
            $data_message = androidprepare_message($message_id, "false", str_replace(array('&nbsp;'), array(' '), strip_tags($message)), str_replace(array('&nbsp;'), array(' '), strip_tags($title)), str_replace(array('&nbsp;'), array(' '), strip_tags($ticker)), $id_news_group);
            $response = androidsendNotification($android_key, $registration_ids, $data_message);
            //var_dump($response);
            $new_response = json_decode($response);
            if ($new_response->canonical_ids) {
                //$new_code = str_replace(array($registration_ids[]), array($new_response->results[]->registration_id), $current_code);
                $h = 0;
                foreach ($new_response->results as $resp) {
                    //var_dump($resp);
                    if (property_exists($resp, 'registration_id')) {
                        $db_n->query("update users set `android_id` = '" . $resp->registration_id . "' where UserId = '" . $users_id[$e][$h] . "'");
                    }
                    $h++;
                }
            } else {
                //echo('yeahhhhhhh');
            }

            $e++;
        }
    }
}

//end function

function PostedaddNews() {
    global $UserId, $LastSession, $ThemeName, $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang, $TinyDir;

    $IdUserName = PostFilter($_POST['IdUserName']);
    $Active = PostFilter($_POST['Active']);
    $NewsPic = PostFilter($_POST['NewsPic']);
    $IdCat = PostFilter($_POST['IdCat']);
    $newsDate = PostFilter($_POST['newsDate']);
    $agency = PostFilter($_POST['agency']);
    $urgent = PostFilter($_POST['urgent']);

    $PostedaddNews = '<script src="Programs/news/Themes/' . $ThemeName . '/SpryValidationTextField.js" type="text/javascript"></script>
				<script src="Programs/news/Themes/' . $ThemeName . '/SpryValidationTextarea.js" type="text/javascript"></script>
				<link href="Programs/news/Themes/' . $ThemeName . '/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
				<link href="Programs/news/Themes/' . $ThemeName . '/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
				<link rel="stylesheet" type="text/css" media="all" href="includes/jscalendar/Style/calendar-Default.css" />
				<script type="text/javascript" src="includes/jscalendar/calendar.js"></script>
				<script type="text/javascript" src="includes/jscalendar/Languages/calendar-Arabic.js"></script>
				<script type="text/javascript" src="includes/jscalendar/calendar-setup.js"></script>
			
                                    <link rel="stylesheet" href="includes/elrte/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8" /> 
                                    <link rel="stylesheet" href="includes/elrte/elrte/css/elrte.min.css"  type="text/css" media="screen" charset="utf-8" />
                                    <link rel="stylesheet" href="includes/elrte/elfinder/css/elfinder.css" type="text/css" media="screen" charset="utf-8" />

                                    <script src="includes/jquery/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
                                    <script src="includes/elrte/elrte/js/elrte.min.js"  type="text/javascript" charset="utf-8"></script>
                                    <script src="includes/elrte/elrte/js/i18n/elrte.' . MiniLang . '.js"  type="text/javascript" charset="utf-8"></script>

                                    <script src="includes/elrte/elfinder/js/elfinder.min.js"type="text/javascript" charset="utf-8"></script>
                                    <script src="includes/elrte/elfinder/js/i18n/elfinder.' . MiniLang . '.js"type="text/javascript" charset="utf-8"></script>

                                    <script type="text/javascript" charset="utf-8">
                                    $().ready(function() {


                                    $("#elFinder a").delay(800).animate({"background-position" : "0 0"}, 300);

                                    var opts = {
                                    absoluteURLs: false,
                                    cssClass : "el-rte",
                                    lang : "' . MiniLang . '",
                                    height   : 250,
                                    toolbar  : "maxi",
                                    cssfiles : ["includes/elrte/elrte/css/elrte-inner.css"],
                                    fmOpen : function(callback) {
                                    $("<div id=\'myelfinder\' />").elfinder({
                                    url : "includes/elrte/elfinder/connectors/connector.php?id=' . $UserId . '&sess=' . $LastSession . '",
                                    lang : "' . MiniLang . '",
                                    dialog : { width : 900, modal : true, title : "' . Gallery . '" },
                                    closeOnEditorCallback : true,
                                    editorCallback : callback
                                    })
                                    }
                                    }
                                    $(".editor").elrte(opts);

                                    })


				</script>
				';

    $PostedaddNews .= '<strong>' . (NickNameErr) . '<strong/><form id="form1" name="form1" method="post" action="">
				<table border="0" cellspacing="1" cellpadding="1">
				  <tr>
				<td>' . (Date) . '</td>
				<td>
				  <span id="sprytextfield1">
				<label>
				  <input value="' . $newsDate . '" class="text" type="text" name="newsDate" id="newsDate" />
				</label>
				<span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span></td>
				  </tr>
				  <tr>
				<td>' . (UserName) . '</td>
				<td><span id="sprytextfield2">
				  <label>
				  <input value="' . $IdUserName . '" size="15" maxlength="15" class="text" type="text" name="IdUserName" id="IdUserName" />
				  </label>
				  <span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span></td>
				  </tr>
				  <tr>
				<td>' . (Active) . '</td>
				<td><label>
				  <select class="select" name="Active" id="Active">';
    if ($Active == "1") {
        $PostedaddNews .='<option selected="selected" value="1">' . yes . '</option>
				<option value="0">' . no . '</option>';
    } else {
        $PostedaddNews .='<option value="1">' . yes . '</option>
				<option selected="selected" value="0">' . no . '</option>';
    }//end if
    $PostedaddNews .='</select>
				</label></td>
				  </tr>
				  <tr>
				<td>' . (NewsPic) . '</td>
				<td><select class="select"  onchange="changePic();" name="NewsPic" id="NewsPic">';

    $d = dir("uploads/news/pics/");
    while (false !== ($entry = $d->read())) {
        if ($entry != "." and $entry != ".." and is_file($d->path . $entry)) {
            if (strpos(strtolower($entry), ".jpg") or strpos(strtolower($entry), ".gif") or strpos(strtolower($entry), ".png")) {
                if ($entry == $NewsPic) {
                    $PostedaddNews .= '<option selected="selected" value="' . $entry . '">' . $entry . '</option>';
                } else {
                    $PostedaddNews .= '<option value="' . $entry . '">' . $entry . '</option>';
                }//en dif
                $LastPic = $entry;
            }
        }
    }
    $d->close();
    $PostedaddNews .= '</select>
				<span id="MiniNewsPic">
				<img style="max-width:200px; max-height:200px;" src="uploads/news/pics/' . $LastPic . '" alt="' . $LastPic . '"/>
				</span></td>
				  </tr>
				  <tr>
				<td>' . (NewsCategorie) . '</td>
				<td><label>
				  <select class="select" name="IdCat" id="IdCat">';
    $query = "select * from `languages` where `LangName`='" . $Lang . "';";
    ExcuteQuery($query);
    if ($TotalRecords > 0) {
        $IdLang = $Rows['IdLang'];
    }//end if
    ExcuteQuery("select * from `catlang` where `IdLang`='" . $IdLang . "'  order by `sort` asc ;");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $IdCat = $Rows['IdCat'];
            $CatName = $Rows['CatName'];
            $PostedaddNews .= '<option value="' . $IdCat . '">' . $CatName . '</option>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//end if
    $PostedaddNews .='</select>
				</label></td>
				  </tr>';

    $query = "select * from `languages` ;";
    ExcuteQuery($query);
    if ($TotalRecords > 0) {
        $j = 3;
        $k = 1;
        for ($i = 0; $i < $TotalRecords; $i++) {
            $IdLang = $Rows['IdLang'];
            $LangName = $Rows['LangName'];

            $Tilte = PostFilter($_POST['Tilte' . $LangName]);
            $SubTitle = PostFilter($_POST['SubTitle' . $LangName]);
            $Breif = PostFilter($_POST['Breif' . $LangName], true);
            $FullMessage = PostFilter($_POST['FullMessage' . $LangName], true);
            $Note = PostFilter($_POST['Note' . $LangName]);

            $PostedaddNews .= '<tr>
				<td valign="top">' . (Tilte) . ' ' . $LangName . '</td>
				<td valign="top"><span id="sprytextfield' . $j++ . '">
				  <label>
				  <input value="' . $Tilte . '" size="35" maxlength="128" class="text" type="text" name="Tilte' . $LangName . '" id="Tilte' . $LangName . '" />
				  </label>
				  <span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span></td>
				  </tr>
				  <tr>
				<td valign="top">' . (SubTitle) . ' ' . $LangName . '</td>
				<td valign="top"><label>
				  <input value="' . $SubTitle . '" size="35" maxlength="35" class="text" type="text" name="SubTitle' . $LangName . '" id="SubTitle' . $LangName . '" />
				</label></td>
				  </tr>
				  <tr>
				<td valign="top"><span id="sprytextarea' . $k++ . '">' . (Breif) . ' ' . $LangName . '<span class="textareaRequiredMsg">' . Avalueisrequired . '</span></td>
				<td valign="top">
				  <label>
				  <textarea class="textarea"  name="Breif' . $LangName . '" id="Breif' . $LangName . '" cols="70" rows="15">' . $Breif . ' </textarea>
				  </label>
				  </span></td>
				  </tr>
				  <tr>
				<td valign="top"><span id="sprytextarea' . $k++ . '">' . (FullMessage) . ' ' . $LangName . 'span class="textareaRequiredMsg">' . Avalueisrequired . '</span>
</td>
				<td valign="top">
				  <label>
				  <textarea class="editor" name="FullMessage' . $LangName . '" id="FullMessage' . $LangName . '" cols="70" rows="20">
					  ' . $FullMessage . '
					  </textarea>
				  </label>
				  <</span></td>
				  </tr>
				  <tr>
				<td valign="top">' . (Note) . ' ' . $LangName . '</td>
				<td valign="top"><label>
				  <input value="' . $Note . '" size="75" maxlength="200" class="text" type="text" name="Note' . $LangName . '" id="Note' . $LangName . '" />
				</label><br/><br/><hr><br/></td>
				  </tr>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//end if
    if (isset($_POST['SaveNewsBar'])) {
        $SaveNewsBarValue = ' checked="checked" ';
    } else {
        $SaveNewsBarValue = '';
    }//end if
    $PostedaddNews .= '<tr>
				  </tr>
				</table>
				<input type="checkbox" ' . $SaveNewsBarValue . ' name="SaveNewsBar" id="SaveNewsBar" /> ' . (SaveNewsBAR) . '
				<div align="center">
				<input class="submit" type="submit" name="SubmitNewNews" id="SubmitNewNews" value="' . (save) . '">
				</div>
				</form>
				<script language="javascript" type="text/javascript">
					function changePic(){
					document.getElementById("MiniNewsPic").innerHTML= \'<img style="max-width:200px; max-height:200px;" src="uploads/news/pics/\'+document.getElementById(\'NewsPic\').value+\'"/>\'; 
											}
										</script>
				<script type="text/javascript">
				<!--
				';
    for ($i = 1; $i < $j; $i++) {
        $PostedaddNews .='
				var sprytextfield' . $i . ' = new Spry.Widget.ValidationTextField("sprytextfield' . $i . '");
				var sprytextarea' . $i . ' = new Spry.Widget.ValidationTextarea("sprytextarea' . $i . '");';
    }
    $PostedaddNews .='
				//-->
				</script>
				
						<script type="text/javascript">
		function catcalc(cal) {
				 var date = cal.date;
				var time = date.getTime();
		}
		Calendar.setup({
		inputField :"newsDate",   // id of the input field
		ifFormat   :"%Y-%m-%d %H:%M:%S",   // format of the input field
		showsTime  :true,
		timeFormat :"24",
		onUpdate   :catcalc
		});
		</script>
		';
    return $PostedaddNews;
}

//end function

function editNews() {

    global $WebiteFolder, $CustomHead, $UserId, $LastSession, $ThemeName, $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang, $TinyDir;
    if (isset($_COOKIE['phpTransformer'])) {
        $LastSession = session_id();
    } else {
        $LastSession = '';
    }
    if (isset($_GET['IdNews'])) {
        $IdNews = InputFilter($_GET['IdNews']);
    } else {
        $IdNews = '';
    }
    $editNews = '';

    if (isset($_POST['SubmitEditNews'])) {
        $IdUserName = $_POST['IdUserName'];
        $query = "select `UserId` from `users` where `NickName`='" . $IdUserName . "';";
        ExcuteQuery($query);
        if ($TotalRecords > 0) {
            $IdUserName = $Rows['UserId'];
        }
        $Active = PostFilter($_POST['Active']);
        $NewsPic = PostFilter($_POST['NewsPic']);
        $IdCat = PostFilter($_POST['IdCat']);
        $newsDate = PostFilter($_POST['newsDate']);
        $agency = PostFilter($_POST['agency']);
        $urgent = PostFilter($_POST['urgent']);

        $active_by = $IdUserName;


        mysqli_query($conn, "update `news` set
			`IdUserName`='" . $IdUserName . "',
			`Date`='" . $newsDate . "',
			`Active`='" . $Active . "',
			`NewsPic`='" . $NewsPic . "' ,
                         `agency` = '" . $agency . "' ,
                         `urgent` = '" . $urgent . "' ,
                          `active_by` = '" . $active_by . "'
			where `IdNews`='" . $IdNews . "' ;");

        mysqli_query($conn, "update `newscategoies` set `IdCat`='" . $IdCat . "' where `IdNews`='" . $IdNews . "';");

        $query = "select * from `languages`  where `Deleted`<> 1;";
        ExcuteQuery($query);
        if ($TotalRecords > 0) {
            for ($i = 0; $i < $TotalRecords; $i++) {
                $IdLang = $Rows['IdLang'];
                $LangName = $Rows['LangName'];

                $Tilte = PostFilter($_POST['Tilte' . $LangName]);
                $SubTitle = PostFilter($_POST['SubTitle' . $LangName]);
                $Breif = PostFilter($_POST['Breif' . $LangName], true);
                $Breif = str_replace("<p>", "", $Breif);
                $Breif = str_replace("</p>", "", $Breif);

                $FullMessage = PostFilter($_POST['FullMessage' . $LangName], true);
                $Note = PostFilter($_POST['Note' . $LangName]);
                mysqli_query($conn, "UPDATE `newslang` set
								`Tilte`='" . $Tilte . "',
								`SubTitle`='" . $SubTitle . "',
								`Breif`='" . $Breif . "',
								`FullMessage`='" . $FullMessage . "',
								`Note`='" . $Note . "' 
								where `IdLang`='" . $IdLang . "' and `IdNews`='" . $IdNews . "';");

                $Rows = mysqli_fetch_assoc($Recordset);
//delete old file news-20100000000-Arabic.pdf
                if (file_exists('downloads/news/pdf/news-' . $IdNews . '-' . $LangName . '.pdf')) {
//$editNews = 'downloads/news/pdf/news-'.$IdNews.'-'.$LangName.'.pdf';
                    unlink('downloads/news/pdf/news-' . $IdNews . '-' . $LangName . '.pdf');
                }
//generate new
                $editNews .= '<!-- generate pdf document -->
                <iframe style="border:none" width="0" height="0" src="Programs/news/admin/GeneratePDF.php?Lang=' . $LangName . '&idnews=' . $IdNews . '"></iframe>';
            }//end for

            if (isset($_POST['notification']) && isset($_POST['Active']) && $_POST['Active'] == 1) {
                if ($_POST['notification'] == 'user_choise') {
                    //  echo 'select users preferences from table notifications';
                    ajax_send_android_notifications('user_choise', $IdCat, $urgent, $Tilte, mb_substr($Breif, 0, 150, 'utf8'), $Tilte, $IdNews);
                    // news group id , is urgent
                } elseif ($_POST['notification'] == 'user_group') {
                    if ($_POST['g_l'] == 'all') {
                        //     echo 'send to all members';
                        ajax_send_android_notifications('all', $IdCat, $urgent, $Tilte, mb_substr($Breif, 0, 150, 'utf8'), $Tilte, $IdNews);
                    } else {
                        //       echo ' get group id to send' . $_POST['g_l'];
                        ajax_send_android_notifications(PostFilter($_POST['g_l']), $IdCat, $urgent, $Tilte, mb_substr($Breif, 50, 150, 'utf8'), $Tilte, $IdNews);
                    }
                } else {
                    // echo 'dont send';
                }
            }
        }//end if

        $editNews .= SuccessUpdateNews;
    } else {
        $CustomHead .= '<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
                        <style>
                        .ui-autocomplete-loading {
                        background: white url("admin/Themes/' . $ThemeName . '/images/ui-anim_basic_16x16.gif") right center no-repeat;
                        }
                        </style>';

        $CustomHead .= '
                    <link href="Programs/news/admin/fileupload/client/fineuploader.css" rel="stylesheet" type="text/css"/>
                    
                    <script src="Programs/news/admin/fileupload/client/js/header.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/util.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/button.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/ajax.requester.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/deletefile.ajax.requester.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/handler.base.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/window.receive.message.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/handler.form.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/handler.xhr.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/uploader.basic.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/dnd.js"></script>
                    <script src="Programs/news/admin/fileupload/client/js/uploader.php?up=' . UploadNewPicture . '&IdMedia=uploads/news/pics/"></script>
                    <script src="Programs/news/admin/fileupload/client/js/jquery-plugin.js"></script>';
        if (trim($WebiteFolder) == "" or $WebiteFolder == "/") {
            $CustomHead .= ' <script src="Programs/news/admin/fileupload/js/uploader.php?path=/Programs/news/admin/fileupload/receiver/index.php?path=uploads/news/pics/"></script>';
        } else {
            $CustomHead .= ' <script src="/' . $WebiteFolder . '/Programs/news/admin/fileupload/js/uploader.php?path=/' . $WebiteFolder . '/Programs/news/admin/fileupload/receiver/index.php?path=uploads/news/pics/"></script>';
        }

        ExcuteQuery("select * from `news` where `IdNews`='" . $IdNews . "';");
        if ($TotalRecords > 0) {
            $IdUserName = $Rows['IdUserName'];
            $newsDate = $Rows['Date'];
            $Active = $Rows['Active'];
            $Hits = $Rows['Hits'];
            $NewsPic = $Rows['NewsPic'];
            $urgent = $Rows['urgent'];
            $agency = $Rows['agency'];
        }//end if

        ExcuteQuery("select `IdCat` from `newscategoies` where `IdNews`='" . $IdNews . "';");
        if ($TotalRecords > 0) {
            $DBIdCat = $Rows['IdCat'];
        }//end if

        ExcuteQuery("select `NickName` from `users` where `UserId`='" . $IdUserName . "';");
        if ($TotalRecords > 0) {
            $IdUserName = $Rows['NickName'];
        }//end if

        $editNews = '<script language="javascript" type="text/javascript">
                        document.onkeydown = document.onkeypress = function (evt) {
                        if (!evt && window.event) {
                        evt = window.event;
                        }
                        var keyCode = evt.keyCode ? evt.keyCode :
                        evt.charCode ? evt.charCode : evt.which;
                        if (keyCode) {
                        if (evt.ctrlKey) {
                        if(keyCode==83){
                           document.getElementById("SubmitEditNews").click();
                        return false;
                        }
                        return false;
                        }
                        }
                        return true;
                        }
                        </script>
                        <script src="Programs/news/Themes/' . $ThemeName . '/SpryValidationTextField.js" type="text/javascript"></script>
                        <script src="Programs/news/Themes/' . $ThemeName . '/SpryValidationTextarea.js" type="text/javascript"></script>
                        <link href="Programs/news/Themes/' . $ThemeName . '/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
                        <link href="Programs/news/Themes/' . $ThemeName . '/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
                         <link rel="stylesheet" type="text/css" media="all" href="includes/jscalendar/Style/calendar-Default.css" />
                         <script type="text/javascript" src="includes/jscalendar/calendar.js"></script>
                        <script type="text/javascript" src="includes/jscalendar/Languages/calendar-Arabic.js"></script>
                        <script type="text/javascript" src="includes/jscalendar/calendar-setup.js"></script>
                        <link rel="stylesheet" href="includes/elrte/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8" /> 
                        <link rel="stylesheet" href="includes/elrte/elrte/css/elrte.min.css"  type="text/css" media="screen" charset="utf-8" />
                        <link rel="stylesheet" href="includes/elrte/elfinder/css/elfinder.css" type="text/css" media="screen" charset="utf-8" />

                        <script src="includes/jquery/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
                        <script src="includes/elrte/elrte/js/elrte.min.js"  type="text/javascript" charset="utf-8"></script>
                        <script src="includes/elrte/elrte/js/i18n/elrte.' . MiniLang . '.js"  type="text/javascript" charset="utf-8"></script>

                        <script src="includes/elrte/elfinder/js/elfinder.min.js"type="text/javascript" charset="utf-8"></script>
                        <script src="includes/elrte/elfinder/js/i18n/elfinder.' . MiniLang . '.js"type="text/javascript" charset="utf-8"></script>

                        <script type="text/javascript" charset="utf-8">
                        $().ready(function() {


                            $("#elFinder a").delay(800).animate({"background-position" : "0 0"}, 300);

                            var opts = {
                            absoluteURLs: false,
                            cssClass : "el-rte",
                            lang : "' . MiniLang . '",
                            height   : 250,
                            toolbar  : "maxi",
                            cssfiles : ["includes/elrte/elrte/css/elrte-inner.css"],
                            fmOpen : function(callback) {
                            $("<div id=\'myelfinder\' />").elfinder({
                            url : "includes/elrte/elfinder/connectors/connector.php?id=' . $UserId . '&sess=' . $LastSession . '",
                            lang : "' . MiniLang . '",
                            dialog : { width : 900, modal : true, title : "' . Gallery . '" },
                            closeOnEditorCallback : true,
                            editorCallback : callback
                            })
                            }
                            }
                            $(".editor").elrte(opts);

                            })
					</script>
					';


        $editNews .= '<ul id="basicUploadSuccessExample" class="unstyled"></ul>
            <form id="form1" name="form1" method="post" action="">
            <table border="0" cellspacing="1" cellpadding="1">
            <tr>
                <td><span width="200px" heght="200px" id="MiniNewsPic">
               <img style="max-width:200px; max-height:200px;" src="uploads/news/pics/' . $NewsPic . '" alt="' . $NewsPic . '"/>
             </span><br/>
            <input value="' . $NewsPic . '" type="hidden" name="NewsPic" id="NewsPic" >
                                                    </td>
                                                      </tr>';


        $editNews .= '  <tr>
                        <td>' . Date . ' : 
                         <span id="sprytextfield1">
                        <label>
                          <input style="width:150px" value="' . $newsDate . '" class="text" type="text" name="newsDate" id="newsDate" />
                         </label>
                         <span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span>
              &nbsp;&nbsp;  ' . NickName . ' : <span id="sprytextfield2">
                 <label><span class="ui-widget">
                 <input value="' . $IdUserName . '" size="15" maxlength="15" class="text" type="text" name="IdUserName" id="IdUserName" />
                </span></label>
               <span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span>';


        $editNews .= '<span class="ui-widget">
                     <label for="agency"> &nbsp;&nbsp;&nbsp;' . agency . ' : </label>'
                . '<input value="' . $agency . '" size="15" maxlength="15" class="text" type="text" name="agency" id="agency" />'
                . '</span>';

        $editNews .= '  <br/>  &nbsp;&nbsp;  ' . Active . ' : <label> <select class="select" name="Active" id="Active">';


        if ($Active == "1") {
            $editNews .='<option selected="selected" value="1">' . yes . '</option>
					<option value="0">' . no . '</option>';
        } else {
            $editNews .='<option value="1">' . yes . '</option>
					<option selected="selected" value="0">' . no . '</option>';
        }//end if
        $editNews .='</select>
					</label>&nbsp;&nbsp;' . NewsCategorie . ' : <label>
					  <select class="select" name="IdCat" id="IdCat">';
        $query = "select * from `languages` where `LangName`='" . $Lang . "';";
        ExcuteQuery($query);
        if ($TotalRecords > 0) {
            $IdLang = $Rows['IdLang'];
        }//end if
        ExcuteQuery("select * from `catlang` where `IdLang`='" . $IdLang . "'  order by `sort` asc ;");
        if ($TotalRecords > 0) {
            for ($i = 0; $i < $TotalRecords; $i++) {
                $IdCat = $Rows['IdCat'];
                $CatName = $Rows['CatName'];
                if ($DBIdCat == $IdCat) {
                    $editNews .= '<option selected="selected" value="' . $IdCat . '">' . $CatName . '</option>';
                } else {
                    $editNews .= '<option value="' . $IdCat . '">' . $CatName . '</option>';
                }//end if
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
        }//end if
        $editNews .='</select>';

        if ($urgent == "1") {
            $opt_urgt = '<option value="0" > ' . ordinary . '</option> '
                    . '<option selected="selected"  value="1"> ' . urgent . ' </option>';
        } else {
            $opt_urgt = '<option selected="selected" value="0" > ' . ordinary . '</option> '
                    . '<option   value="1"> ' . urgent . ' </option>';
        }//end if

        $editNews .= '&nbsp;<select class="select" name="urgent" id="urgent">' . $opt_urgt . '</select>  

        
        </label></td>
					  </tr><tr>
					  </tr>
					</table>';
        $db_g = new db();
        $members_g = $db_g->get_results(" select * from `groups` ;");
        if ($members_g) {
            $g_l = '<select id="g_l" name="g_l" class="select">' .
                    '<option value="all" >' . EveryOne . '</option>';
            foreach ($members_g as $g) {
                $GroupId = $g->GroupId;
                $GroupName = $g->GroupName;
                $g_l .= ' <option value="' . $GroupId . '" >' . $GroupName . ' </option>';
            }
            $g_l .= '</select>';
        }


        $editNews .= send_mobile_notification . ' :<input id="dont_send"  value="dont_send" type="radio" name="notification" /><label for="dont_send" >' . dont_send . '</label>'
                . '&nbsp;&nbsp;&nbsp;<input id="user_choise" checked value="user_choise" type="radio" name="notification" /><label for="user_choise" >' . Users_Choises . '</label>'
                . '&nbsp;&nbsp;&nbsp;<input id="user_group" value="user_group" type="radio"  name="notification" /><label for="user_group" >' . group . '</label>:  ' . $g_l;

        $tabs = '<ul class="tabs">';
        $divs = '';
        $DivEditNews = '';

        $query = "select * from `languages` where `Deleted`<>'1' ;";
        ExcuteQuery($query);
        if ($TotalRecords > 0) {
            $j = 3;
            $k = 1;
            for ($i = 0; $i < $TotalRecords; $i++) {
                $IdLang = $Rows['IdLang'];
                $LangName = $Rows['LangName'];

                $tabs .= '<li class="tab' . ($i + 1) . '">
			<a class="tab' . ($i + 1) . ' tab">
				' . $LangName . '	
			</a>
                </li>';

                $Q = "select * from `newslang` where `IdNews`='" . $IdNews . "' and `IdLang`='" . $IdLang . "';";
                $RS = mysqli_query($conn, $Q);
                $Totals = mysqli_num_rows($RS);
                if ($Totals > 0) {
                    $DATA = mysqli_fetch_assoc($RS);
                    $Tilte = $DATA['Tilte'];
                    $SubTitle = $DATA['SubTitle'];
                    $Breif = $DATA['Breif'];
                    $FullMessage = $DATA['FullMessage'];
                    $Note = $DATA['Note'];
                }//end if

                $DiveditNews = Tilte . ' ' . $LangName . ' : <br/>
					<span id="sprytextfield' . $j++ . '">
					  <label>
					  <input value="' . $Tilte . '" size="35" maxlength="128" class="text" type="text" name="Tilte' . $LangName . '" id="Tilte' . $LangName . '" />
					  </label>
					  <span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span><br/>
					' . SubTitle . ' ' . $LangName . ' : <br/>
					<label>
					  <input value="' . $SubTitle . '" size="35" maxlength="35" class="text" type="text" name="SubTitle' . $LangName . '" id="SubTitle' . $LangName . '" />
					</label><br/><span id="sprytextarea' . $k++ . '">
					' . Breif . ' ' . $LangName . ' : <span class="textareaRequiredMsg">' . Avalueisrequired . '</span><br/>
					
					  <label>
					  <textarea  class="textarea"  name="Breif' . $LangName . '" id="Breif' . $LangName . '" cols="70" rows="15">' . $Breif . '</textarea>
					  </label>
					  </span><br/>
                                    <span id="sprytextarea' . $k++ . '">
					' . FullMessage . ' ' . $LangName . ' : <span class="textareaRequiredMsg">' . Avalueisrequired . '</span><br/>
					
					  <label>
					  <textarea class="editor" name="FullMessage' . $LangName . '" id="FullMessage' . $LangName . '" cols="70" rows="20">
						  ' . $FullMessage . '
						  </textarea>
					  </label>
					  </span><br/>
					' . Note . ' ' . $LangName . ' : <br/>
					<label>
					  <input value="' . $Note . '" size="75" maxlength="200" class="text" type="text" name="Note' . $LangName . '" id="Note' . $LangName . '" />
					</label>
					  ';
                $divs .= '<!-- tab ' . ($i + 1) . ' -->
			<div class="tab' . ($i + 1) . ' tabsContent">
				<div>' . $DiveditNews . '</div>
			</div><!-- end of t' . ($i + 1) . ' -->';
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
        }//end if

        $editNews .= '<div class="TabsMainContainer">
                        <div class="htmltabs">' . $tabs . $divs . '</div></div>
					<input type="hidden" checked="checked" name="SaveNewsBar" id="SaveNewsBar" /> 

					<div align="center">
					<input class="submit" type="submit" name="SubmitEditNews" id="SubmitEditNews" value="' . (save) . '">
					</div>
					</form>
					<script language="javascript" type="text/javascript">
						function changePic(){
						document.getElementById("MiniNewsPic").innerHTML= \'<img style="max-width:200px; max-height:200px;" src="uploads/news/pics/\'+document.getElementById(\'NewsPic\').value+\'"/>\'; 
												}
											
					
					';


        for ($i = 1; $i < $j; $i++) {
            $editNews .='var sprytextfield' . $i . ' = new Spry.Widget.ValidationTextField("sprytextfield' . $i . '");';
        }
        for ($i = 1; $i < $k; $i++) {
            $editNews .='var sprytextarea' . $i . ' = new Spry.Widget.ValidationTextarea("sprytextarea' . $i . '");';
        }

        $editNews .='
			function catcalc(cal) {
					 var date = cal.date;
					var time = date.getTime();
			}
			Calendar.setup({
			inputField :"newsDate",   // id of the input field
			ifFormat   :"%Y-%m-%d %H:%M:%S",   // format of the input field
			showsTime  :true,
			timeFormat :"24",
			onUpdate   :catcalc
			});

                        $(function() {
                               $("#agency").autocomplete({
                                   source: "Programs/news/admin/users.php",
                                   minLength: 3
                               });
                                $("#IdUserName").autocomplete({
                                   source: "Programs/news/admin/users.php",
                                   minLength: 3
                               });

                           });
            
			</script>
			';
    }


    return $editNews;
}

//end function

function NewsCat() {
    global $ThemeName, $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang;
    $NewsCat = '<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr>
				<td><strong>' . (NewsCat) . '</strong></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				  </tr>';
    $query = "select * from `languages` where `LangName`='" . $Lang . "';";
    ExcuteQuery($query);
    if ($TotalRecords > 0) {
        $IdLang = $Rows['IdLang'];
    }//end if

    $query = "select * from `catlang` where `IdLang`='" . $IdLang . "' and `Deleted`<>'1'  order by `sort` asc ;";
    ExcuteQuery($query);
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $CatName = $Rows['CatName'];
            $IdCat = $Rows['IdCat'];
            $Vars = array("prog", "subdo", "IdCat");
            $Vals = array("news", "editNewsCat", $IdCat);
            $Edit = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">' . (edit) . '</a>';

            $Vars = array("prog", "subdo", "IdCat");
            $Vals = array("news", "deleteNewsCat", $IdCat);
            $Delete = '<a onclick="return AcceptDel();" href="' . AdminCreateLink("", $Vars, $Vals) . '" title="">' . (delete) . '</a>';

            $NewsCat .= '  <tr>
						<td>' . $CatName . '</td>
						<td>' . $Edit . '</td>
						<td>' . $Delete . '</td>
						  </tr>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//end if

    $NewsCat .= '</table>
					<script language="javascript" type="text/javascript">
						function AcceptDel(){
							return confirm("' . (DidUWantToDeleteCatNws) . '");
						}
					
					</script>
					';

    return $NewsCat;
}

//end function

function NewNewsCat() {

    global $ThemeName, $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang;

    if (!isset($_POST['SubmitNewCatNews'])) {
        $NewNewsCat = '
<script language="javascript" type="text/javascript">
document.onkeydown = document.onkeypress = function (evt) {
if (!evt && window.event) {
evt = window.event;
}
var keyCode = evt.keyCode ? evt.keyCode :
evt.charCode ? evt.charCode : evt.which;
if (keyCode) {
if (evt.ctrlKey) {
if(keyCode==83){
					document.getElementById("SubmitNewCatNews").click();
return false;
}
return false;
}
}
return true;
}
</script>
<script src="Programs/news/admin/SpryValidationTextField.js" type="text/javascript"></script>
						<link href="Programs/news/admin/SpryValidationTextField.css" rel="stylesheet" type="text/css">
						<form name="formCat" method="post" action="">
						<table width="100%" border="0" cellspacing="1" cellpadding="1">
						  <tr>
						<td><strong>' . (AddNewNewsCat) . '</strong></td>
						<td>&nbsp;</td>
						  </tr>
						  <tr>';
        $query = "select * from `languages` where `Deleted`<>'1';";
        ExcuteQuery($query);
        if ($TotalRecords > 0) {
            for ($i = 0; $i < $TotalRecords; $i++) {
                $IdLang = $Rows['IdLang'];
                $LangName = $Rows['LangName'];
                $NewNewsCat .= '  <tr>
								<td>' . (NewsCat) . ' ' . $LangName . '</td>
								<td>
								  <span id="sprytextfield' . ($i + 1) . '">
								  <input type="text" name="CatName' . $LangName . '" id="CatName' . $LangName . '">
								<span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span>
								</td>
								  </tr>';
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
        }//end if
        $NewNewsCat .= '  <tr>
				<td colspan="2" align="center">
				  <input class="submit" type="submit" name="SubmitNewCatNews" id="SubmitNewCatNews" value="' . (save) . '">
					</td>
				</tr>
					</table>
					</form>
					<script type="text/javascript">
					<!--
					';
        for ($i = 0; $i < $TotalRecords; $i++) {
            $NewNewsCat .= '
					var sprytextfield' . ($i + 1) . ' = new Spry.Widget.ValidationTextField("sprytextfield' . ($i + 1) . '");
					';
        }//end for
        $NewNewsCat .='
					//-->
					</script>
					';
    } else {
        $IdCat = GenerateID('catlang', 'IdCat');

        $query = "select * from `languages`;";
        ExcuteQuery($query);
        if ($TotalRecords > 0) {
            for ($i = 0; $i < $TotalRecords; $i++) {
                $IdLang = $Rows['IdLang'];
                $LangName = $Rows['LangName'];
                if (isset($_POST['CatName' . $LangName])) {
                    $CatName = $_POST['CatName' . $LangName];
                    mysqli_query($conn, "insert into `catlang` (`IdCat`,`IdLang`,`CatName`) 
								values('" . $IdCat . "' , '" . $IdLang . "' , '" . $CatName . "');");
                }//END IF
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
        }//end if

        $NewNewsCat = (SuccessSaveNewCatNews);
    }//end if
    return $NewNewsCat;
}

//end  function

function editNewsCat() {
    global $ThemeName, $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang;

    $IdCat = $_GET['IdCat'];

    if (!isset($_POST['SubmiteditCatNews'])) {
        $editNewsCat = '<script src="Programs/news/admin/SpryValidationTextField.js" type="text/javascript"></script>
			<link href="Programs/news/admin/SpryValidationTextField.css" rel="stylesheet" type="text/css">
			<form name="formCat" method="post" action="">
			<table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tr>
			<td><strong>' . AddNewNewsCat . '</strong></td>
			<td>&nbsp;</td>
			</tr>
			<tr>';
        $query = "select * from `languages` where `Deleted`<>'1';";
        ExcuteQuery($query);
        if ($TotalRecords > 0) {
            for ($i = 0; $i < $TotalRecords; $i++) {
                $IdLang = $Rows['IdLang'];
                $LangName = $Rows['LangName'];
                $Q = "select * from `catlang` where `IdCat`='" . $IdCat . "' and `IdLang`='" . $IdLang . "'  order by `sort` asc ;";
                $RS = mysqli_query($conn, $Q);
                $Totals = mysqli_num_rows($RS);
                if ($Totals > 0) {
                    $DATA = mysqli_fetch_assoc($RS);
                    $CatName = $DATA['CatName'];

                    $editNewsCat .= '  <tr><td>' . NewsCat . ' ' . $LangName . '</td>
					<td>
					<span id="sprytextfield' . ($i + 1) . '">
					 <input value="' . $CatName . '" type="text" name="CatName' . $LangName . '" id="CatName' . $LangName . '">
					<span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span>
					</td>
					</tr>';
                } else {
                    $editNewsCat .= '  <tr><td>' . NewsCat . ' ' . $LangName . '</td>
					<td>
					<span id="sprytextfield' . ($i + 1) . '">
					 <input value="" type="text" name="CatName' . $LangName . '" id="CatName' . $LangName . '">
					<span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span>
					</td>
					</tr>';
                }
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
        }//end if
        $editNewsCat .= '  <tr>
				<td colspan="2" align="center">
				  <input class="submit" type="submit" name="SubmiteditCatNews" id="SubmiteditCatNews" value="' . (save) . '">
					</td>
				</tr>
					</table>
					</form>
					<script type="text/javascript">
					<!--
					';
        for ($i = 0; $i < $TotalRecords; $i++) {
            $editNewsCat .= '
					var sprytextfield' . ($i + 1) . ' = new Spry.Widget.ValidationTextField("sprytextfield' . ($i + 1) . '");
					';
        }//end for
        $editNewsCat .='
					//-->
					</script>
					';
    } else {
        $query = "select * from `languages`;";
        ExcuteQuery($query);
        if ($TotalRecords > 0) {

            $db = new db();
            for ($i = 0; $i < $TotalRecords; $i++) {
                $IdLang = $Rows['IdLang'];
                $LangName = $Rows['LangName'];
                if (isset($_POST['CatName' . $LangName])) {

                    $CatName = $_POST['CatName' . $LangName];

                    $exst_cat = $db->get_row(" select `IdCat` from `catlang` where `IdCat`= '" . $IdCat . "' and `IdLang`='" . $IdLang . "' ; ");

                    if ($exst_cat) {
                        mysqli_query($conn, "update `catlang` 
				set `CatName`='" . $CatName . "' 
				where `IdCat`='" . $IdCat . "' and `IdLang`='" . $IdLang . "' ;");
                    } else {
                        mysqli_query($conn, "insert into `catlang` (`IdCat`,`IdLang`,`CatName`,`Deleted`,`sort`)
                                values('" . $IdCat . "','" . $IdLang . "','" . $CatName . "','0','0') ");
                    }
                }//END IF
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
        }//end if

        $editNewsCat = (SuccessSaveeditCatNews);
    }//end if
    return $editNewsCat;
}

//end function

function deleteNewsCat() {
    global $conn;
    $IdCat = $_GET['IdCat'];
    mysqli_query($conn, "update `catlang` set `Deleted`='1' where `IdCat`='" . $IdCat . "' ;");
    return (SuccessDeleteNewsCat);
}

//end function

function deleteNews() {
    global $conn, $UserId;
    $IdNews = $_GET['IdNews'];
    mysqli_query($conn, "update `news` set `Deleted`='1' , `del_by`='" . $UserId . "'"
            . " where `IdNews`='" . $IdNews . "' ;");
    mysqli_query($conn, "update `marques` set `Deleted`='1'
             where `IdNews`='" . $IdNews . "' ;");
    return (SuccessDeleteNews);
}

//end function

function editComment() {

    global $ThemeName, $TotalRecords, $Recordset, $Rows, $SqlType, $conn, $Lang;
    $idComment = InputFilter($_GET['idComment']);

    if (!isset($_POST['SubmiteditCom'])) {
        $query = "select * from `newscomment` where `idComment`='" . $idComment . "';";
        ExcuteQuery($query);
        if ($TotalRecords > 0) {
            $CommentTitle = $Rows['CommentTitle'];
            $theComment = $Rows['theComment'];
        } else {
            $CommentTitle = "";
            $theComment = "";
        }//end if
        $editComment = '<script src="Programs/news/Themes/Default/SpryValidationTextarea.js" type="text/javascript"></script>
						<link href="Programs/news/Themes/Default/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
						<script src="Programs/news/Themes/Default/SpryValidationTextField.js" type="text/javascript"></script>
						<link href="Programs/news/Themes/Default/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
						';
        $editComment .= '<form id="formaddCom" name="formaddCom" method="post" action="">
						' . (CommentTitle) . ' 
						<br/>
						<span id="sprytextfield1">
						<input value="' . $CommentTitle . '" type="text" name="CommentTitle" size="65" maxlength="100" />
						<span class="textfieldRequiredMsg">' . Avalueisrequired . '</span></span>
						<br/>
						' . (theComment) . '<span id="sprytextarea1">
						<textarea class="editor" name="theComment" cols="60" rows="15">' . $theComment . '</textarea>
						<span class="textareaRequiredMsg">' . Avalueisrequired . '</span></span>
						<input class="submit" name="SubmiteditCom" type="submit" value="' . (submit) . '" /><br/>
						</form><br/>';
    } else {
        $CommentTitle = PostFilter($_POST['CommentTitle']);
        $theComment = PostFilter($_POST['theComment']);

        mysqli_query($conn, "update `newscomment` 
					set `CommentTitle`='" . $CommentTitle . "',`theComment`='" . $theComment . "' 
					where `idComment`='" . $idComment . "';");
        $editComment = (SuccessSaveEditCom);
    }//end if
    return $editComment;
}

//end function

function deleteComment() {
    global $conn;
    $idComment = InputFilter($_GET['idComment']);
    mysqli_query($conn, "delete from `newscomment` where `idComment`='" . $idComment . "';");
    return (SuccessFinalDeleteCom);
}

//end function

function addNewsBAR($newsID) {

    global $conn, $TotalRecords, $Recordset, $Rows, $Lang, $TimeFormat;

    $idMarque = GenerateID("marques", "idMarque");
//echo 	$idMarque;
    $StartDate = PostFilter($_POST['newsDate']);

    $EndDate = PostFilter($_POST['EndDate']);
//$EndDate = date($TimeFormat, $StartDate + 60 * 60 * 60 * 24 * 365);

    $Vars = array("Prog", "ns", "idnews");
    $Vals = array("news", "details", $newsID);
    $Link = CreateLinkNoLang("", $Vars, $Vals);
    mysqli_query($conn, "insert into `marques` (`idMarque`,`StartDate`,`EndDate`,`Link`,`IdNews`) 
	values('" . $idMarque . "','" . $StartDate . "','" . $EndDate . "','" . $Link . "','" . $newsID . "');");
// change

    ExcuteQuery("SELECT `IdLang`,`LangName` FROM `languages`;");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $IdLang = $Rows['IdLang'];
            $LangName = $Rows['LangName'];
            if (isset($_POST['Tilte' . $LangName])) {
                $MarqueeMessage = PostFilter($_POST['Tilte' . $LangName]);
                mysqli_query($conn, "insert into `marqlang` (`idmarque`,`idLang`,`Message`) 
							values('" . $idMarque . "','" . $IdLang . "','" . $MarqueeMessage . "');");
            }//end if
            $Rows = mysqli_fetch_assoc($Recordset);
        }//END For
    }//end if

    return SuccessSaveMarqueeMessage;
}

function androidsendNotification($apiKey, $registrationIdsArray, $messageData) {
    $headers = array("Content-Type:" . "application/json", "Authorization:" . "key=" . $apiKey);
    $data = array(
        'collapse_key' => 'emedia',
        'delay_while_idle' => true,
        'data' => $messageData,
        'registration_ids' => $registrationIdsArray
    );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

function androidprepare_message($id, $on_going, $message, $title, $ticker, $mid) {
    $message = $message;
    $title = $title;
    $ticker = $ticker;
    $mid = $mid;
    $data_message = array("id" => "$id", "on_going" => $on_going, "message" => $message, "title" => $title, "ticker" => $ticker, "mid" => $mid);
    return $data_message;
}
?>
<script>

    $(document).ready(function()
    {
        $('div.htmltabs div.tabsContent').hide();
        $('div.tab1').show(); // It will show the first tab content when page load, you can set any tab content you want - just put the tab content class e.g. tab4
        $('div.htmltabs ul.tabs li.tab1 a').addClass('tab-current');// We will add the class to the current open tab to style the active state
        $('div.htmltabs ul li a').click(function()
        {
            var thisClass = this.className.slice(0, 4);//"this" is the current anchor where user click and it will get the className from the current anchor and slice the first part as we have two class on the anchor 
            $('div.htmltabs div.tabsContent').hide();// It will hide all the tab content
            $('div.' + thisClass).show(); // It will show the current content of the user selected tab
            $('div.htmltabs ul.tabs li a').removeClass('tab-current');// It will remove the tab-current class from the previous tab to remove the active style
            $(this).addClass('tab-current'); //It will add the tab-current class to the user selected tab
        });


        $('.row_tr:even').addClass('row_tr_odd');
        $('.row_tr:odd').addClass('row_tr_even');


    });
</script>