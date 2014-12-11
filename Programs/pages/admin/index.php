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
global $UserId, $LastSession, $ThemeName, $Lang, $TinyDir, $DefaulPageNbr;

include_once("Programs/pages/admin/Languages/lang-" . $Lang . ".php");

$theList = ProgIconLink("pages", "NewPage")
        . ProgIconLink("pages", "ListPages");

if (isset($_GET['subdo'])) {
    switch ($_GET['subdo']) {
        case "NewPage":
            $theContent = NewPage();
            break;
        case "ListPages":
            $theContent = ListPages();
            break;

        default :
            $theContent = ListPages();
    }//end switch
} else {
    $theContent = ListPages();
}//end if


if (isset($_COOKIE['phpTransformer'])) {
    $LastSession = session_id();
} else {
    $LastSession = '';
}

$Tiny = '
    <link rel="stylesheet" href="includes/elrte/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8" /> 
    <link rel="stylesheet" href="includes/elrte/elrte/css/elrte.min.css"  type="text/css" media="screen" charset="utf-8" />
    <link rel="stylesheet" href="includes/elrte/elfinder/css/elfinder.css" type="text/css" media="screen" charset="utf-8" />

    <script src="includes/jquery/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elrte/js/elrte.min.js"                  type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elrte/js/i18n/elrte.' . MiniLang . '.js"          type="text/javascript" charset="utf-8"></script>

    <script src="includes/elrte/elfinder/js/elfinder.min.js"            type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elfinder/js/i18n/elfinder.' . MiniLang . '.js"    type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">
        $().ready(function() {
 
            var opts = {
                absoluteURLs: false,
                cssClass : "el-rte",
                lang     : "' . MiniLang . '",
                height   : 250,
                toolbar  : "maxi",
                cssfiles : ["includes/elrte/elrte/css/elrte-inner.css"],
                fmOpen : function(callback) {
                    $("<div  id=\'myelfinder\' />").elfinder({
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
    </script>';
$Pages = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$Pages = VarTheme("{todoImg}", "pages.png", $Pages);
$Pages = VarTheme("{ThemeName}", $ThemeName, $Pages);
$Pages = VarTheme("{List}", $theList, $Pages);
$Pages = VarTheme("{Content}", $theContent, $Pages);
echo $Tiny . $Pages;

function NewPage() {
    global $SqlType, $TotalRecords, $Rows, $Recordset;
    ExcuteQuery("SELECT max(PageNbr) as MaxPageNbr FROM `pages` ");
    if ($TotalRecords > 0) {
        $PageNbr = $Rows['MaxPageNbr'] + 1;
    } else {
        $PageNbr = 0;
    }//end if
    if (!isset($_POST['SubmitPgae'])) {
        $NewPage = '<script language="javascript" type="text/javascript">
                                document.onkeydown = document.onkeypress = function (evt) {
                                    if (!evt && window.event) {
                                        evt = window.event;
                                    }
                                    var keyCode = evt.keyCode ? evt.keyCode :
                                        evt.charCode ? evt.charCode : evt.which;
                                    if (keyCode) {
                                        if (evt.ctrlKey) {
                                            if(keyCode==83){
                                                document.getElementById("SubmitPgae").click();

                                                return false;
                                            }
                                            return false;
                                        }
                                    }
                                    return true;
                                }
                            </script>
                            <script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
					<link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
					<script src="admin/includes/SpryValidationTextarea.js" type="text/javascript"></script>
					<link href="admin/includes/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
					<form id="formnewPgae" name="formnewPgae" method="post" action="">
					' . PgaeNumber . ' : 
					<span id="sprytextfield">
					' . $PageNbr . ' &nbsp;<a target="_blank" href="' . CreateLink("", array("Prog", "pagenbr"), array("pages", $PageNbr)) . '">' . (PageAddress) . '</a>
					<span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
					<br/>';



        $tabs = '<ul class="tabs">';
        $divs = '';
        $DivNewPage = '';
        //showning textarea for each lang
        ExcuteQuery("SELECT * FROM `languages`  where `Deleted`<> 1; ");
        for ($i = 0; $i < $TotalRecords; $i++) {
            $LangName = $Rows['LangName'];
            $tabs .= '<li class="tab' . ($i + 1) . '">
			<a class="tab' . ($i + 1) . ' tab">
				' . $LangName . '	
			</a>
                        </li>';

            $DivNewPage = TitlePgaeDesc . ' ' . $LangName . ' :<br/>
						<span id="sprytextfield' . $i . '">
						<input name="PageTitle' . $LangName . '" class="text" type="text" value="" maxlength="100" />
						<span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
						<br/>
						' . (BodyPgaeDescLang) . ' ' . $LangName . ' :<br/>
						<span id="sprytextarea' . $i . '">
						<textarea name="Content' . $LangName . '" class="editor" cols="60" rows="20"></textarea>
						<span class="textareaRequiredMsg">' . (Avalueisrequired) . '</span></span>
						
						<script type="text/javascript">
						<!--				
						var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield' . $i . '");
						var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea' . $i . '");
						//-->
						</script>';
            $divs .= '<!-- tab ' . ($i + 1) . ' -->
			<div class="tab' . ($i + 1) . ' tabsContent">
				<div>' . $DivNewPage . '</div>
			</div><!-- end of t' . ($i + 1) . ' -->';

            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $tabs .= '</ul>';

        $NewPage .= '<div class="TabsMainContainer"><div class="htmltabs">' . $tabs . $divs . '</div></div>
                            <input checked=checked" name="AddMainMenu" id="AddMainMenu" value="AddMainMenu" type="checkbox">'
                . (AddThisPageTitleToMainMenu) . '<br/>
                                <input name="SubmitPgae" id="SubmitPgae" class="submit" type="submit" value="' . (save) . '" />
					</form>
					<script type="text/javascript">
					<!--
					var sprytextfield = new Spry.Widget.ValidationTextField("sprytextfield");
					//-->
					</script>';
    } else {
        //insert Pgae
        global $TotalRecords, $Rows, $Recordset, $conn;
        $IdPage = GenerateID('pages', 'IdPage');
        $ObjectId = GenerateID('objects', 'ObjectId');
        // pages table
        $query = "INSERT INTO `pages` (`IdPage`,`PageNbr`,`ObjectId`,`Hits`,`Deleted` )
					VALUES ('" . $IdPage . "', '" . $PageNbr . "','" . $ObjectId . "','0','0');";

        $Rs = mysqli_query($conn, $query);

        // objects  table
        $query = "INSERT INTO `objects` ( `ObjectId` , `ObjectName` )
				VALUES ('" . $ObjectId . "', '{PageNumber} " . $PageNbr . "');";

        $Rs = mysqli_query($conn, $query);

        // moderators  table

        $query = "SELECT `GroupId` FROM `groups` ; ";
        $rs = mysqli_query($conn, $query);
        $ttls = mysqli_num_rows($rs);
        if ($ttls > 0) {
            for ($j = 0; $j < $ttls; $j++) {
                $Rws = mysqli_fetch_assoc($rs);
                $GroupId = $Rws['GroupId'];
                if (isset($_POST[$ObjectId . $GroupId])) {
                    $Permission = PostFilter($_POST[$ObjectId . $GroupId]);
                    mysqli_query($conn, "insert into `moderators` (`GroupId`,`ObjectId`,`Permission`)
									values('" . $GroupId . "','" . $ObjectId . "','1')");
                }//end if
            }//end for
        }//end if
        //insert page with all messages
        $Query = "SELECT * FROM `languages`  where `Deleted`<> 1; ";
        $Recs = mysqli_query($conn, $Query);
        while ($data = mysqli_fetch_assoc($Recs)) {
            $LangName = $data['LangName'];
            $IdLang = $data['IdLang'];
            $PageTitle = PostFilter($_POST['PageTitle' . $LangName]);
            $Content = PostFilter($_POST['Content' . $LangName], true);
            $query = "INSERT INTO `pagelang` (`IdPage`,`IdLang`,`PageTitle`,`Content`)
					 values ('" . $IdPage . "','" . $IdLang . "','" . $PageTitle . "','" . $Content . "')";

            $Rs = mysqli_query($conn, $query);
        }//end while
        $NewPage = SuccesInsertNewPage . ' <strong>' . $PageTitle . '</strong>';
        //Add to main Menu
        if (isset($_POST['AddMainMenu'])) {
            //global $TotalRecords,$Recordset,$Rows,$SqlType,$conn,$Lang ;
            // save main table info
            $IdMM = GenerateID('mainmenu', 'IdMM');
            $Link = CreateLink("", array("Prog", "pagenbr"), array("pages", $PageNbr));
            $Target = "";
            ExcuteQuery("SELECT MAX(`Order`) AS Morder FROM `mainmenu`;");
            $Order = $Rows['Morder'] + 1;
            $External = "0";
            mysqli_query($conn, "insert into `mainmenu` (`IdMM`,`Link`,`Target`,`Order`,`External`,`IdPage` ) values(
                                                '" . $IdMM . "','" . $Link . "','" . $Target . "', '" . $Order . "','" . $External . "','" . $IdPage . "');");
            //save lang table info
            $q = "SELECT * from `languages`  where `Deleted`<> 1  ;";
            $Rs = mysqli_query($conn, $q);
            $Totals = mysqli_num_rows($Rs);
            $data = mysqli_fetch_assoc($Rs);
            for ($j = 0; $j < $Totals; $j++) {
                $IdLang = $data['IdLang'];
                $LangName = $data['LangName'];
                $TitleElement = PostFilter($_POST['PageTitle' . $LangName]);
                mysqli_query($conn, "insert into `menlang` (`IdLang`,`idMM`,`TitleElement`)
                                                        values('" . $IdLang . "','" . $IdMM . "','" . $TitleElement . "')");

                $data = mysqli_fetch_assoc($Rs);
            }//End for
        }
        $PageUrl = CreateLink('', array('Prog', 'pagenbr'), array('pages', $PageNbr));
        $Vars = array("prog", "subdo");
        $Vals = array("pages", "ListPages");
        $redirectTO = AdminCreateLink("", $Vars, $Vals);
        $PageTitle = str_replace('"', '', $PageTitle);

        return adminPrintMessageAndRedirect((Pages), $NewPage . '<br/>' . (ElementSuccessSaved), $redirectTO) .
                '<script language="javascript" type="text/javascript" src="includes/ping.js"></script>
                            <script language="javascript" type="text/javascript">
                                    pingSE("' . $PageTitle . '","' . $PageUrl . '");
                            </script>';
    }//end if
    return $NewPage;
}

//end function

function ListPages() {
    global $TotalRecords, $Rows, $Recordset, $conn, $SqlType, $Lang, $ThemeName, $DefaulPageNbr;



    ExcuteQuery("SELECT * FROM `languages` where `LangName`='" . $Lang . "'; ");
    $IdLang = $Rows['IdLang'];

    if (isset($_GET['subdo'])) {
        if ($_GET['subdo'] != 'editpages' and $_GET['subdo'] != 'deletepages') {

            $ListPages = '<table border="0" cellspacing="2" cellpadding="2">
						  <tr>
						    <td style="border-bottom:dotted; border-bottom-width:thin"><strong>'
                    . TitlePgaeDesc . '</strong></td>
							<td style="border-bottom:dotted; border-bottom-width:thin">
							' . PageNbr . '
							</td>
						    <td style="border-bottom:dotted; border-bottom-width:thin"><strong>
							&nbsp;</strong></td>
						    <td style="border-bottom:dotted; border-bottom-width:thin"><strong>
							&nbsp;</strong></td>
						  </tr>';
            ExcuteQuery("SELECT * FROM `pages`, `pagelang`
						where `Deleted`<>'1' 
						and `pages`.`IdPage`=`pagelang`.`IdPage`
						and `pagelang`.`IdLang`='" . $IdLang . "'
                                                 order by `pages`.`PageNbr` desc; ");
            $ChangeHomePage = AdminCreateLink('', array('todo'), array('options'));
            for ($i = 0; $i < $TotalRecords; $i++) {
                $IdPage = $Rows['IdPage'];
                $PageNbr = $Rows['PageNbr'];
                $PageTitle = $Rows['PageTitle'];
                $Vars = array('prog', 'subdo', 'page');
                $Vals = array('pages', 'editpages', $IdPage);
                $Varsd = array('prog', 'subdo', 'page');
                $Valsd = array('pages', 'deletepages', $IdPage);
                //$ListPages .= '<tr>
                if ($DefaulPageNbr == $PageNbr) {
                    $HomePage = '<a href="' . $ChangeHomePage . '" title="' . edit . ' ' . DefaulPageNbr . '" ><img style="border:0px; width:24px; height:24px;" src="admin/Themes/' . $ThemeName . '/images/home.png" alt="H" /></a>';
                } else {
                    $HomePage = '';
                }
                //Prog-pages_pagenbr-3_Lang-Arabic_nl-1.pt
                $page_link = CreateLink("", array("Prog", "pagenbr"), array("pages", $PageNbr));
                $Pages[] = '<tr onmouseover="this.style.background=\'url(admin/Themes/' . $ThemeName . '/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">
							<td style="border-bottom:dotted; border-bottom-width:thin">' . $HomePage . ' <a href="' . $page_link . '" >' . $PageTitle . '</a></td>
							<td style="border-bottom:dotted; border-bottom-width:thin">
							 | ' . $PageNbr . '
							</td>
							<td style="border-bottom:dotted; border-bottom-width:thin"> | 
							<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (edit) . ' ' . $PageTitle . '" >'
                        . (edit) . '</a></td>
							<td style="border-bottom:dotted; border-bottom-width:thin"> | 
							<a onclick="return acceptDel();" href="' . AdminCreateLink("", $Varsd, $Valsd) . '" title="'
                        . (delete) . ' ' . $PageNbr . '" >'
                        . (delete) . '</a></td></tr>';
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
            if (isset($Pages)) {
                $PagesTab = Pagination($Pages, 50, 10); // divid data between pages, and give number for eanch page
                $ListPages .=$PagesTab[0] . '</table> ';
                $ListPages .=$PagesTab[1];
                //$ListPages .=  	Pagination($Pages,$MaxResultPerPage=50,$ShowNaviBar=0); // print content of this page

                $ListPages .= '<script language="javascript" type="text/javascript">
						function acceptDel(){
						return confirm("' . (duuwanttodeltethisPage) . '");
						}
					</script>';
            }
        } else {
            // edit or delete Page
            //edit Page
            $IdPage = InputFilter($_GET['page']);
            //ECHO $IdPage;
            if ($_GET['subdo'] == 'editpages') {
                $ListPages = editPage($IdPage);
            }//end if
            elseif ($_GET['subdo'] == 'deletepages') {
                //delete  Page
                $query = "UPDATE `pages` SET `Deleted` = '1' WHERE `IdPage`='" . $IdPage . "';";
                //ECHO $query;

                $Rs = mysqli_query($conn, $query);

                $ListPages = (SuccesDeletePage);
                $Vars = array("prog", "subdo");
                $Vals = array("pages", "ListPages");
                $redirectTO = AdminCreateLink("", $Vars, $Vals);
                $ListPages = adminPrintMessageAndRedirect((Pages), $ListPages, $redirectTO);
            } else {
                $ListPages = "";
            }//end if
        }//end if
    } else {
        $ListPages = '<table border="0" cellspacing="2" cellpadding="2">
						  <tr >
						    <td style="border-bottom:dotted; border-bottom-width:thin">
							<strong>' . TitlePgaeDesc . '</strong></td>
							<td style="border-bottom:dotted; border-bottom-width:thin">
							' . PageNbr . '
							</td>
						    <td style="border-bottom:dotted; border-bottom-width:thin">
							<strong>&nbsp;</strong></td>
						    <td style="border-bottom:dotted; border-bottom-width:thin">
							<strong>&nbsp;</strong></td>
						  </tr>';
        ExcuteQuery("SELECT * FROM `pages`, `pagelang`
						where `Deleted`<>'1' 
						and `pages`.`IdPage`=`pagelang`.`IdPage`
						and `pagelang`.`IdLang`='" . $IdLang . "'
                                                order by `pages`.`PageNbr` desc
                                    ; ");

        $ChangeHomePage = AdminCreateLink('', array('todo'), array('options'));
        $Pages = array();
        for ($i = 0; $i < $TotalRecords; $i++) {
            $IdPage = $Rows['IdPage'];
            $PageNbr = $Rows['PageNbr'];
            $PageTitle = $Rows['PageTitle'];
            $Vars = array('prog', 'subdo', 'page');
            $Vals = array('pages', 'editpages', $IdPage);
            $Varsd = array('prog', 'subdo', 'page');
            $Valsd = array('pages', 'deletepages', $IdPage);
            if ($DefaulPageNbr == $PageNbr) {

                $HomePage = '<a href="' . $ChangeHomePage . '" title="' . edit . ' ' . DefaulPageNbr . '" ><img border=0 src="admin/Themes/' . $ThemeName . '/images/home.png" alt="H" /></a>';
            } else {
                $HomePage = '';
            }
            //Prog-pages_pagenbr-3_Lang-Arabic_nl-1.pt
            $page_link = CreateLink("", array("Prog", "pagenbr"), array("pages", $PageNbr));
            $Pages[] = '<tr onmouseover="this.style.background=\'url(admin/Themes/Default/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">
							<td style="border-bottom:dotted; border-bottom-width:thin">'
                    . $HomePage . ' <a href="' . $page_link . '" >' . $PageTitle . '</a></td>
							<td style="border-bottom:dotted; border-bottom-width:thin"> | 
							' . $PageNbr . '
							</td>
							<td style="border-bottom:dotted; border-bottom-width:thin"> | 
							<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (edit) . ' ' . $PageTitle . '" >'
                    . (edit) . '</a></td>
							<td style="border-bottom:dotted; border-bottom-width:thin"> | 
							<a onclick="return acceptDel();" href="' . AdminCreateLink("", $Varsd, $Valsd) . '" title="' . (delete) . ' ' . $PageTitle . '" >'
                    . (delete) . '</a></td></tr>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for

        $PagesTab = Pagination($Pages, 50, 10); // divid data between pages, and give number for eanch page
        $ListPages .=$PagesTab[0] . '</table> ';
        $ListPages .=$PagesTab[1];
        $ListPages .= '<script language="javascript" type="text/javascript">
						function acceptDel(){
						return confirm("' . (duuwanttodeltethisPage) . '");
						}
					</script>';
    }//end if

    return $ListPages;
}

//end function

function editPage() {
    global $UseRew, $TotalRecords, $Rows, $Recordset, $conn, $SqlType, $WebsiteUrl;

    if (!isset($_POST['SubmitePage'])) {
        // view Page
        $IdPage = InputFilter($_GET['page']);
        ExcuteQuery("SELECT * FROM `pages` WHERE `IdPage`='" . $IdPage . "';");
        if ($TotalRecords > 0) {
            $PageNbr = $Rows['PageNbr'];
        } else {
            $PageNbr = "";
        }//end if
        $UseRew = FALSE;
        $editPage = (PageNbr) . ' : ' . $PageNbr . '&nbsp;<a target="_blank" href="' . CreateLink("", array("Prog", "pagenbr"), array("pages", $PageNbr)) . '">' . (PageAddress) . '</a></br>';

        //echo $_GET['prog'] = 'pages';

        $editPage .= '<script language="javascript" type="text/javascript">
                                document.onkeydown = document.onkeypress = function (evt) {
                                    if (!evt && window.event) {
                                        evt = window.event;
                                    }
                                    var keyCode = evt.keyCode ? evt.keyCode :
                                        evt.charCode ? evt.charCode : evt.which;
                                    if (keyCode) {
                                        if (evt.ctrlKey) {
                                            if(keyCode==83){
                                                document.getElementById("SubmitePage").click();

                                                return false;
                                            }
                                            return false;
                                        }
                                    }
                                    return true;
                                }
                            </script>
                            <script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
					<link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
					<script src="admin/includes/SpryValidationTextarea.js" type="text/javascript"></script>
					<link href="admin/includes/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
					<form id="formnewPage" name="formnewPage" method="post" action="">
					<br/>';

        $tabs = '<ul class="tabs">';
        $divs = '';
        $DivNewPage = '';

        //showning textarea for each lang
        ExcuteQuery("SELECT * FROM `languages`  where `Deleted`<> 1 ;");
        for ($i = 0; $i < $TotalRecords; $i++) {
            $LangName = $Rows['LangName'];
            $tabs .= '<li class="tab' . ($i + 1) . '">
			<a class="tab' . ($i + 1) . ' tab">
				' . $LangName . '	
			</a>
                        </li>';
            $IdLang = $Rows['IdLang'];
            $query = "SELECT * FROM `pagelang` WHERE `IdPage`='" . $IdPage . "' and `IdLang`='" . $IdLang . "';";

            $Rs = mysqli_query($conn, $query);
            $Total = mysqli_num_rows($Rs);
            if ($Total > 0) {
                $Rws = mysqli_fetch_assoc($Rs);
                $PageTitle = $Rws['PageTitle'];
                $Content = $Rws['Content'];
            } else {
                $PageTitle = "";
                $Content = "";
            }//end if


            $DivEditPage = '<fieldset><legend>' . $LangName . ' </legend>
						' . (PageTitle) . ' ' . $LangName . ' :<br/>
						<span id="sprytextfield' . $i . '">
						<input name="TitlePage' . $LangName . '" class="text" type="text" value="' . $PageTitle . '" maxlength="100" />
						<span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
						<br/>
						' . (BodyPgaeDescLang) . ' ' . $LangName . ' :<br/>
						<span id="sprytextarea' . $i . '">
						<textarea name="BodyPage' . $LangName . '" class="editor" cols="60" rows="10">' . $Content . '</textarea>
						<span class="textareaRequiredMsg">' . (Avalueisrequired) . '</span></span>
						</fieldset>
						<script type="text/javascript">
						<!--				
						var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield' . $i . '");
						var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea' . $i . '");
						//-->
						</script>';
            $divs .= '<!-- tab ' . ($i + 1) . ' -->
			<div class="tab' . ($i + 1) . ' tabsContent">
				<div>' . $DivEditPage . '</div>
			</div><!-- end of t' . ($i + 1) . ' -->';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $tabs .= '</ul>';

        $editPage .='<div class="TabsMainContainer"><div class="htmltabs">' . $tabs . $divs . '</div></div>
        <input name="SubmitePage" id="SubmitePage" class="submit" type="submit" value="' . save . '" />
					</form>
					<script type="text/javascript">
					<!--
					var sprytextfield = new Spry.Widget.ValidationTextField("sprytextfield");
					//-->
					</script>';
    } else {
        //save  Page
        //global $TotalRecords,$Rows,$Recordset,$conn;
        global $PagesRecordset, $SqlType, $PagesTotalRecords, $PagesRows, $Lang;
        $idPage = InputFilter($_GET['page']);
        ExcuteQuery("SELECT * FROM `pages` WHERE `IdPage`='" . $idPage . "';");
        if ($TotalRecords > 0) {
            $PageNbr = $Rows['PageNbr'];
        } else {
            $PageNbr = "";
        }//end if
        //insert Page with all messages
        PagesExcuteQuery("SELECT * FROM `languages`  where `Deleted`<> 1");
        for ($i = 0; $i < $PagesTotalRecords; $i++) {
            $LangName = $PagesRows['LangName'];
            $IdLang = $PagesRows['IdLang'];
            $PageTitle = PostFilter($_POST['TitlePage' . $LangName]);
            $Content = PostFilter($_POST['BodyPage' . $LangName], true);
            // Resloving BUG IF USER ADD NEW LANG , we must chek existence before
            $queryExist = "SELECT * FROM `pagelang` WHERE `IdPage`='" . $idPage . "' and `IdLang`='" . $IdLang . "'";
            $dbPageExistInThisLang = new db();
            $PageExistInThisLang = $dbPageExistInThisLang->get_row($queryExist);
            if ($PageExistInThisLang) {
                $query = "update `pagelang` set
					`PageTitle`='" . $PageTitle . "',
					`Content`='" . $Content . "' where `IdPage`='"
                        . $idPage . "' and `IdLang`='" . $IdLang . "';";
            } else {//insert new lang info
                $query = "INSERT INTO `pagelang`(`IdPage`,`IdLang`,`PageTitle`,`Content`)
                                        VALUES ( '" . $idPage . "',  '" . $IdLang . "', '" . $PageTitle . "', '" . $Content . "' ); ";
            }
            $Rs = mysqli_query($conn, $query);

            $PagesRows = mysqli_fetch_assoc($PagesRecordset);
            //delete cache pages
            //http://pc-it-manager/phptransformer/Prog-pages_Lang-Arabic_nl-1.pt
            //http://pc-it-manager/phptransformer/Prog-pages_pagenbr-10_Lang-Arabic_nl-1.pt
            $PageUrl = 'Prog-pages_pagenbr-' . $PageNbr . '_Lang-' . $LangName . '_nl-1.pt';
            $File = 'cache/' . md5($WebsiteUrl . $PageUrl) . '.cache';
            if (is_file($File)) {
                @unlink($File);
            }
            if ($PageNbr == '1') {
                $PageUrl = 'Prog-pages_Lang-' . $LangName . '_nl-1.pt';
                $File = 'cache/' . md5($WebsiteUrl . $PageUrl) . '.cache';
                if (is_file($File)) {
                    @unlink($File);
                }
            }
        }
        $PageTitle = PostFilter($_POST['TitlePage' . $Lang]);
        $editPage = (SuccesSaveNewPage) . ' <strong>' . $PageTitle . '</strong>';
        $Vars = array("prog", "subdo");
        $Vals = array("pages", "ListPages");
        $redirectTO = AdminCreateLink("", $Vars, $Vals);
        $editPage = adminPrintMessageAndRedirect((Pages), $editPage, $redirectTO);
    }//end if

    return $editPage;
}

//end if

function PagesExcuteQuery($query) {

    global $SqlType;

    global $PagesRecordset, $SqlType, $conn, $PagesTotalRecords, $PagesRows;
    $PagesRecordset = mysqli_query($conn, $query);
    $PagesTotalRecords = mysqli_num_rows($PagesRecordset);
    if ($PagesTotalRecords > 0) {
        $PagesRows = mysqli_fetch_assoc($PagesRecordset);
    }//end if
}

//end function
?>
<script>
    //This function will run automatically after the page is loaded
    $(document).ready(function()
    {
        $('div.htmltabs div.tabsContent').hide();//tabsContent class is used to hide all the tabs content in the start
        $('div.tab1').show(); // It will show the first tab content when page load, you can set any tab content you want - just put the tab content class e.g. tab4
        $('div.htmltabs ul.tabs li.tab1 a').addClass('tab-current');// We will add the class to the current open tab to style the active state
        //It will add the click event on all the anchor tag under the htmltabs class to show the tab content when clicking to the tab
        $('div.htmltabs ul li a').click(function()
        {
            var thisClass = this.className.slice(0, 4);//"this" is the current anchor where user click and it will get the className from the current anchor and slice the first part as we have two class on the anchor 
            $('div.htmltabs div.tabsContent').hide();// It will hide all the tab content
            $('div.' + thisClass).show(); // It will show the current content of the user selected tab
            $('div.htmltabs ul.tabs li a').removeClass('tab-current');// It will remove the tab-current class from the previous tab to remove the active style
            $(this).addClass('tab-current'); //It will add the tab-current class to the user selected tab
        });
    });
</script>