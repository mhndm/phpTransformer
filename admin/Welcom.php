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

if (!isset($IsAdmin)) {
    header("location: ../");
}
?>
<?php

global $NickName, $Sitekey, $project, $Note, $conn, $TotalRecords, $Rows, $LastLogin, $LastIp, $CustomHead, $TimeFormat, $Gmt;

include_once("includes/Statistics.php");

global  $UserId , $LastSession;

if (isset($_COOKIE['phpTransformer'])) {
    $LastSession = session_id();
} else {
    $LastSession = '';
}


$CustomHead .='<script src="admin/includes/SpryTabbedPanels.js" type="text/javascript"></script>
				<link href="admin/includes/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
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
                                                    document.getElementById("save").click();
                                return false;
                            }
                            return false;
                        }
                    }
                    return true;
                }
            </script>';


if (isset($_POST['save'])) {
    $Note = PostFilter($_POST['Note']);
    $Query = "UPDATE `admins` SET `Note` = '" . $Note . "' WHERE `admins`.`AdminId` = '" . $AdminId . "'";
    $Recordset = mysqli_query( $conn,$Query) ;
}//end if

ExcuteQuery("SELECT COUNT(*) AS ActiveCount FROM `users` WHERE `Active`=0;");
if ($TotalRecords > 0) {
    $ActiveCount = $Rows['ActiveCount'];
}//end if

ExcuteQuery("SELECT Count(*) as BanClCount FROM `bannerclients` WHERE `AdminOk`=0;");
if ($TotalRecords > 0) {
    $BanClCount = $Rows['BanClCount'];
}//end if

$Vars = array("todo");
$Vals = array("regusers");
$Vals2 = array("adsusers");
//var_dump($LastIp);
$TryLoginLink = AdminCreateLink('', array('todo', 'subdo'), array('faildlogin', 'FaildLogin'));
$welcomMessage = (WelcomAdmin) . ' ' . $NickName . ' <a href="' . $TryLoginLink . '">' . (yourLastLoginat) . '</a> : ' . $LastLogin . ' ' . (FromIp) . ' : ' . $LastIp;
$Note = ' <link rel="stylesheet" href="includes/elrte/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8" /> 
    <link rel="stylesheet" href="includes/elrte/elrte/css/elrte.min.css"  type="text/css" media="screen" charset="utf-8" />
    <link rel="stylesheet" href="includes/elrte/elfinder/css/elfinder.css" type="text/css" media="screen" charset="utf-8" />

    <script src="includes/jquery/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elrte/js/elrte.min.js"                  type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elrte/js/i18n/elrte.'.MiniLang.'.js"          type="text/javascript" charset="utf-8"></script>

    <script src="includes/elrte/elfinder/js/elfinder.min.js"            type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elfinder/js/i18n/elfinder.'.MiniLang.'.js"    type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">
        $().ready(function() {


            $("#elFinder a").delay(800).animate({"background-position" : "0 0"}, 300);
			
            var opts = {
                absoluteURLs: false,
                cssClass : "el-rte",
                lang     : "'.MiniLang.'",
                height   : 250,
                width:500,
                toolbar  : "mini",
                cssfiles : ["includes/elrte/elrte/css/elrte-inner.css"],
                fmOpen : function(callback) {
                    $("<div id=\'myelfinder\' />").elfinder({
                        url : "includes/elrte/elfinder/connectors/connector.php?id=' . $UserId . '&sess=' . $LastSession . '",
                        lang : "'.MiniLang.'",
                        dialog : { width : 900, modal : true, title : "'.Gallery.'" },
                        closeOnEditorCallback : true,
                        editorCallback : callback
                    })
                }
            }
            $(".editor").elrte(opts);
           
        })
    </script>
		<fieldset>
		<legend>' .NoteTodo . ' :</legend><form id="formNote" name="formNote" method="post" action="">
				  <textarea class="editor" name="Note" id="Note" cols="45" rows="8">' . $Note . '</textarea>
					<center> <input class="submit" type="submit" name="save" id="save" value="' . save . '" />
				  </center>
				</form>
		</fieldset>';

$LastProg = new db();
$LastProg = $LastProg->get_var("select `LastProg` from `params`;");
$LastProgVars = array("prog");
$LastProgVals = array($LastProg);

$LastBlock = new db();
$LastBlock = $LastBlock->get_var("select `LastBlock` from `params`;");
$LastBlockVars = array("block");
$LastBlockVals = array($LastBlock);

if (is_file('Programs/' . $LastProg . '/thumb.png')) {
    $LastProgThumb = 'Programs/' . $LastProg . '/thumb.png';
} else {
    $LastProgThumb = "images/program.png";
}
if (file_exists('Programs/' . $LastProg . '/admin/Languages/lang-' . $Lang . '.php')) {
    include_once('Programs/' . $LastProg . '/admin/Languages/lang-' . $Lang . '.php');
}
if (!constantDefined($LastProg)) {
    $LastProgNew = $LastProg;
} else {
    $LastProgNew = constant($LastProg);
}

if (is_file("Blocks/" . $LastBlock . "/thumb.png")) {
    $LastBlockThumb = "Blocks/" . $LastBlock . "/thumb.png";
} else {
    $LastBlockThumb = "images/block.png";
}
if (file_exists('Blocks/' . $LastBlock . '/admin/Languages/lang-' . $Lang . '.php')) {
    include_once('Blocks/' . $LastBlock . '/admin/Languages/lang-' . $Lang . '.php');
}
if (!constantDefined($LastBlock)) {
    $LastBlockNew = $LastBlock;
} else {
    $LastBlockNew = constant($LastBlock);
}

// Latest Comments
// News comments
$NewscommentsDB = new db();
$query = " SELECT * FROM `newscomment` AS a INNER JOIN `users` AS b ON a.`UserId` = b.`UserId` order by `CommentDate` desc LIMIT 0 , 5; ";
$Newscomments = $NewscommentsDB->get_results($query);
$TheNewscomments = '';
if ($Newscomments) {
    foreach ($Newscomments as $comment) {

        $NickName = $comment->NickName;
        $UserName = $comment->UserName;
        $FamName = $comment->FamName;
        $IdNews = $comment->IdNews;
        $CommentTitle = subwords($comment->CommentTitle, 0, 100) . '...';
        $theComment = trim($comment->theComment);

        $TheCommentLink = AdminCreateLink('', array('prog', 'subdo', 'IdNews'), array('news', 'NewsCom', $IdNews));
        $TheNewscomments .= ' &nbsp;&nbsp;&nbsp;&nbsp;' . $NickName .
                ' : <span dir="' . DirHtml . '" ><a href="' . $TheCommentLink . '" title="' . strip_tags($CommentTitle) . '" >' . strip_tags($CommentTitle) . '</a><br></span>';
    }
} else {
    $TheNewscomments = ' &nbsp;&nbsp;&nbsp;&nbsp;' . ThereIsNoComments . '<br/>';
}

//Gallery Comments
$GalleryCommnetsDB = new db();
$query = "SELECT *FROM `galleryfav` AS a INNER JOIN `users` AS b
            ON a.`UserId` = b.`UserId`
            order by `Date` desc limit 0,5 ;";
$GalleryCommnets = $GalleryCommnetsDB->get_results($query);
$TheGalleryCommnets = '';
if ($GalleryCommnets) {

    foreach ($GalleryCommnets as $Commnets) {
        $NickName = $Commnets->NickName;
        $UserName = $Commnets->UserName;
        $FamName = $Commnets->FamName;
        $Comment = subwords(strip_tags($Commnets->Comment), 0, 100) . '...';
        $IdMedia = $Commnets->IdMedia;

        $TheCommentLink = AdminCreateLink('', array('prog', 'subdo', 'galid'), array('gallery', 'cmntMedia', $IdMedia));
        $TheGalleryCommnets .= ' &nbsp;&nbsp;&nbsp;&nbsp;' . $NickName .
                ' : <span dir="' . DirHtml . '" ><a href="' . $TheCommentLink . '" title="' . strip_tags($Comment) . '" >' . strip_tags($Comment) . '</a><br></span>';
    }
} else {
    $TheGalleryCommnets = ' &nbsp;&nbsp;&nbsp;&nbsp;' . ThereIsNoComments . '<br/>';
}

$LatestComments = LatestComments . ' : <br>&nbsp;&nbsp;<STRONG>' . TheNewscomments . '</STRONG> : <br>' . $TheNewscomments . '<br>&nbsp;&nbsp;<STRONG>' . TheGalleryCommnets . '</STRONG><br>' . $TheGalleryCommnets;


$ToDoList = '<fieldset>
            <legend>' . (TodoList) . ' : </legend>
               <table border="0"  align="center" cellpadding="4" cellspacing="4">
                  <tbody>
                    <tr>
                      <td style="text-align: center;"><a href="' . AdminCreateLink("", $LastProgVars, $LastProgVals) . '" title="' . LastProgManage . '">
                        <img width="48" height="48" border=0 src="' . $LastProgThumb . '" /></a></td>
                      <td style="text-align: center;">
                        <a href="' . AdminCreateLink("", $LastBlockVars, $LastBlockVals) . '" title="' . LastBlockManage . '">
                            <img width="48" height="48" border=0 src="' . $LastBlockThumb . '" /></a>
                        </td>
                    </tr>
                    <tr>
                      <td><a href="' . AdminCreateLink("", $LastProgVars, $LastProgVals) . '" title="' . LastProgManage . '">
                       ' . LastProgManage . '<strong> ' . $LastProgNew . ' </a></strong> </td>
                              <td><a href="' . AdminCreateLink("", $LastBlockVars, $LastBlockVals) . '" title="' . LastBlockManage . '">
                       ' . LastBlockManage . '<strong> ' . $LastBlockNew . ' </a></strong> </td>
                    </tr>
                  </tbody>
                </table>
                ' . $LatestComments . '<br>
                   <a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (RegisteredUsersMustHaveOk) . '">
               ' . (RegisteredUsersMustHaveOk) . '<strong>' . $ActiveCount . ' </a></strong>  <br/>

               <a href="' . AdminCreateLink("", $Vars, $Vals2) . '" title="' . (BannersUsersMustHaveOk) . '">
               ' . (BannersUsersMustHaveOk) . '<strong>' . $BanClCount . '  </a></strong>  <br/>
                <br/>
            </fieldset>	  ';


if ($_SERVER['SERVER_PORT'] != 80) {
    $MessageCenterUrl = "https";
} else {
    $MessageCenterUrl = "http";
}
global $License;

$MessageCenterUrl .= '://phptransformer.com/release/?Prog=messagecenter&key=' . $License . '&Lang=' . $Lang;
$handle = @fopen($MessageCenterUrl, "rb");
if ($handle) {
    $MessageCenter = '<fieldset><legend>' . MessagesCenter . '</legend>
		<iframe dir="' . DirHtml . '" width="400px" height="210px" src="' . $MessageCenterUrl . '" style="border:none;display: block;"  marginwidth="0" marginheight="0" vspace="0" hspace="0" frameborder="0" scrolling="auto"></iframe></fieldset>';
} else {
    $MessageCenter = '<fieldset><legend>' . MessagesCenter . '</legend>
                    <div style=" width:400px ; height: 210px"  > phpTransformer </div>
		</fieldset>';
}
$stat = '<img src="admin/Themes/' . $ThemeName . '/images/statistics.png" alt="" /><br/>'
        . (NbrOfRegisteredUsers) . ' <strong>' . NbrOfRegisteredUsers() . "</strong><br />";
$stat .= (NbrOfSessions) . ' <strong>' . NbrOfSessions("Visists") . "</strong><br />";
$stat .= (PagesPerSessions) . ' <strong>' . NbrOfSessions("Pagespervisit") . '</strong><br /><br />
		<form action="" method="post">
		<input class="submit" type="submit" name="ResetStatistics" value="' . (ResetStatistics) . '" onclick="return ShureReset();" />
		</form>
		<br/><br/><br/><br/><br/><br/><br/><br/><br/>';
$Statistics = '<fieldset dir="' . DirHtml . '">
			<legend>' . (LatestStatistics) . ' : </legend>
			 <div id="TabbedPanelsStat" class="TabbedPanels">
				<ul class="TabbedPanelsTabGroup">
				<li class="TabbedPanelsTab" tabindex="0">' . (GuestsStatistics) . '</li>
			    <li class="TabbedPanelsTab" tabindex="0">' . (contrie) . '</li>
			    <li class="TabbedPanelsTab" tabindex="0">' . (Language) . '</li>
				<li class="TabbedPanelsTab" tabindex="0">' . (Progam) . '</li>
				<li class="TabbedPanelsTab" tabindex="0">' . (Pages) . '</li>
				<li class="TabbedPanelsTab" tabindex="0">' . (OperatingSystems) . '</li>
				<li class="TabbedPanelsTab" tabindex="0">' . (Browsers) . '</li>
				<li class="TabbedPanelsTab" tabindex="0">' . (Screens) . '</li>
				<li class="TabbedPanelsTab" tabindex="0">' . (Themes) . '</li>
			  </ul>
			  <div class="TabbedPanelsContentGroup">
				<div class="TabbedPanelsContent">' . $stat . '</div>
			    <div class="TabbedPanelsContent">' . CountiresOfUsers(930, 300) . '</div>
			    <div class="TabbedPanelsContent">' . LanguageOfUsers(930, 300) . '</div>
				<div class="TabbedPanelsContent">' . ProgramsMustView(930, 300) . '</div>
				<div class="TabbedPanelsContent">' . PagesMustViewed(930, 300) . '</div>
				<div class="TabbedPanelsContent">' . BrowsersAndOperatingSystems("OpSys", 930, 300) . '</div>
				<div class="TabbedPanelsContent">' . BrowsersAndOperatingSystems("Browser", 930, 300) . '</div>
				<div class="TabbedPanelsContent">' . Screen(930, 300) . '</div>
				<div class="TabbedPanelsContent">' . ThemesStatistics(930, 300) . '</div>
			  </div>
			 </div>
			</fieldset>';
$Statistics .='<script type="text/javascript">
			<!--
			var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanelsStat");
			function ShureReset(){
				return confirm("' . (DidUWantResetAllStatistics) . '");
			}
			//-->
			</script>';

$Icons = get_include_contents("admin/Themes/$ThemeName/Icons.php");
$Icons = VarTheme("{Theme}", $ThemeName, $Icons);
$Icons = VarTheme("{Users}", (Users), $Icons);

$Vars = array("todo");
$Vals = array("members");
$Members = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (Members) . '">' . (Members) . '</a>';
$Icons = VarTheme("{Members}", $Members, $Icons);
$Icons = VarTheme("{MembersPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("groups");
$Groups = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (Groups) . '">' . (Groups) . '</a>';
$Icons = VarTheme("{Groups}", $Groups, $Icons);
$Icons = VarTheme("{GroupsPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("maillist");
$MailList = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (MailList) . '">' . (MailList) . '</a>';
$Icons = VarTheme("{MailList}", $MailList, $Icons);
$Icons = VarTheme("{MailListPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("letters");
$Letters = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (Letters) . '">' . (Letters) . '</a>';
$Icons = VarTheme("{Letters}", $Letters, $Icons);
$Icons = VarTheme("{LettersPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("programscontrol");
$ProgramsControl = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (ProgramsControl) . '">' . (ProgramsControl) . '</a>';
$Icons = VarTheme("{ProgramsControl}", $ProgramsControl, $Icons);
$Icons = VarTheme("{ProgramscontrolPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);


$Icons = VarTheme("{Programs}", (Programs), $Icons);

$Vars = array("todo");
$Vals = array("newprograms");
$NewPrograms = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (NewPrograms) . '">' . (NewPrograms) . '</a>';
$Icons = VarTheme("{NewPrograms}", $NewPrograms, $Icons);
$Icons = VarTheme("{NewProgramsPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("programspermisions");
$ProgramsPermisions = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (ProgramsPermisions) . '">' . (ProgramsPermisions) . '</a>';
$Icons = VarTheme("{ProgramsPermisions}", $ProgramsPermisions, $Icons);
$Icons = VarTheme("{ProgramsPermisionsPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("programs");
$ProgramManagment = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (ProgramManagment) . '">' . (ProgramManagment) . '</a>';
$Icons = VarTheme("{ProgramManagment}", $ProgramManagment, $Icons);
$Icons = VarTheme("{ProgramManagmentPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Icons = VarTheme("{Blocks}", (Blocks), $Icons);

$Vars = array("todo");
$Vals = array("blockscontrol");
$BlocksControl = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (BlocksControl) . '">' . (BlocksControl) . '</a>';
$Icons = VarTheme("{BlocksControl}", $BlocksControl, $Icons);
$Icons = VarTheme("{BlocksControlPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("newblock");
$NewBlock = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (NewBlock) . '">' . (NewBlock) . '</a>';
$Icons = VarTheme("{NewBlock}", $NewBlock, $Icons);
$Icons = VarTheme("{NewBlockPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("blockspermisions");
$BlocksPermisions = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (BlocksPermisions) . '">' . (BlocksPermisions) . '</a>';
$Icons = VarTheme("{BlocksPermisions}", $BlocksPermisions, $Icons);
$Icons = VarTheme("{BlocksPermisionsPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("blocksmanagment");
$BlocksManagment = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (BlocksManagment) . '">' . (BlocksManagment) . '</a>';
$Icons = VarTheme("{BlocksManagment}", $BlocksManagment, $Icons);
$Icons = VarTheme("{BlocksManagmentPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Icons = VarTheme("{Support}", (Support), $Icons);

$Vars = array("todo");
$Vals = array("database");
$Backup = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (DataBase) . '">' . (DataBase) . '</a>';
$Icons = VarTheme("{Backup}", $Backup, $Icons);
$Icons = VarTheme("{BackupPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);
$Icons = VarTheme("{DataBase}", $Backup, $Icons);

$Vars = array("todo");
$Vals = array("restore");
$Restore = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (Restore) . '">' . (Restore) . '</a>';
$Icons = VarTheme("{Restore}", $Restore, $Icons);
$Icons = VarTheme("{RestorePiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("optimize");
$Optimize = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (Optimize) . '">' . (Optimize) . '</a>';
$Icons = VarTheme("{Optimize}", $Optimize, $Icons);
$Icons = VarTheme("{OptimizePiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo", "page");
$Vals = array("bugsandreport", "1");
$BugsandReport = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (BugsandReport) . '">' . (BugsandReport) . '</a>';
$Icons = VarTheme("{BugsandReport}", $BugsandReport, $Icons);
$Icons = VarTheme("{BugsPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);


$Icons = VarTheme("{Protection}", (Protection), $Icons);
$Vars = array("todo");
$Vals = array("antiflood");
$AntiFlood = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (AntiFlood) . '">' . (AntiFlood) . '</a>';
$Icons = VarTheme("{AntiFlood}", $AntiFlood, $Icons);
$Icons = VarTheme("{AntiFloodPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("blocking");
$Blocking = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (Blocking) . '">' . (Blocking) . '</a>';
$Icons = VarTheme("{Blocking}", $Blocking, $Icons);
$Icons = VarTheme("{BlockingPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("specialpermision");
$SpecialPermision = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (SpecialPermision) . '">' . (SpecialPermision) . '</a>';
$Icons = VarTheme("{SpecialPermision}", $SpecialPermision, $Icons);
$Icons = VarTheme("{SpecialPermisionPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo", "page");
$Vals = array("faildlogin", "1");
$FaildLogin = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (FaildLogin) . '">' . (FaildLogin) . '</a>';
$Icons = VarTheme("{FaildLogin}", $FaildLogin, $Icons);
$Icons = VarTheme("{FaildLoginPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Icons = VarTheme("{Managment}", (Managment), $Icons);

$Vars = array("todo");
$Vals = array("languages");
$Languages = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (Languages) . '">' . (Languages) . '</a>';
$Icons = VarTheme("{Languages}", $Languages, $Icons);
$Icons = VarTheme("{LanguagesPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("contieslangs");
$ContiesLangs = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (ContiesLangs) . '">' . (ContiesLangs) . '</a>';
$Icons = VarTheme("{ContiesLangs}", $ContiesLangs, $Icons);
$Icons = VarTheme("{ContiesLangsPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("themes");
$Themes = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (Themes) . '">' . (Themes) . '</a>';
$Icons = VarTheme("{Themes}", $Themes, $Icons);
$Icons = VarTheme("{ThemesPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("layersmenu");
$LayersMenu = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (LayersMenu) . '">' . (LayersMenu) . '</a>';
$Icons = VarTheme("{LayersMenu}", $LayersMenu, $Icons);
$Icons = VarTheme("{LayersMenuPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("prog");
$Vals = array("gallery");
$Gallery = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . Gallery . '">' . Gallery . '</a>';
$Icons = VarTheme("{Gallery}", $Gallery, $Icons);
$Icons = VarTheme("{GalleryPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("prog");
$Vals = array("news");
$News = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . News . '">' . News . '</a>';
$Icons = VarTheme("{News}", $News, $Icons);
$Icons = VarTheme("{NewsPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);


$Vars = array("todo");
$Vals = array("mainmenu");
$MainMenu = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (MainMenu) . '">' . (MainMenu) . '</a>';
$Icons = VarTheme("{MainMenu}", $MainMenu, $Icons);
$Icons = VarTheme("{MainMenuPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("newsbar");
$NewsBar = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (NewsBar) . '">' . (NewsBar) . '</a>';
$Icons = VarTheme("{NewsBar}", $NewsBar, $Icons);
$Icons = VarTheme("{NewsBarPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("robotsadmin");
$RobotsAdmin = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (RobotsAdmin) . '">' . (RobotsAdmin) . '</a>';
$Icons = VarTheme("{RobotsAdmin}", $RobotsAdmin, $Icons);
$Icons = VarTheme("{RobotsAdminlink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Icons = VarTheme("{System}", (System), $Icons);

$Vars = array("todo");
$Vals = array("options");
$Options = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (Options) . '">' . (Options) . '</a>';
$Icons = VarTheme("{Options}", $Options, $Icons);
$Icons = VarTheme("{OptionsPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("recycle");
$Recycle = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (Recycle) . '">' . (Recycle) . '</a>';
$Icons = VarTheme("{Recycle}", $Recycle, $Icons);
$Icons = VarTheme("{RecyclePiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("prog");
$Vals = array("pages");
$Pages = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (Pages) . '">' . (Pages) . '</a>';
$Icons = VarTheme("{Pages}", $Pages, $Icons);
$Icons = VarTheme("{PagesPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("SEO");
$SEO = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (SEO) . '">' . (SEO) . '</a>';
$Icons = VarTheme("{SEO}", $SEO, $Icons);
$Icons = VarTheme("{SEOPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("Error");
$Error = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (Error) . '">' . (Error) . '</a>';
$Icons = VarTheme("{Error}", $Error, $Icons);
$Icons = VarTheme("{ErrorPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("cache");
$cache = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (CacheSystem) . '">' . (CacheSystem) . '</a>';
$Icons = VarTheme("{cache}", $cache, $Icons);
$Icons = VarTheme("{cachelink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("Translations");
$Translations = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (Translations) . '">' . (Translations) . '</a>';
$Icons = VarTheme("{Translations}", $Translations, $Icons);
$Icons = VarTheme("{Translationslink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("webfolder");
$webfolder = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (webfolder) . '">' . (webfolder) . '</a>';
$Icons = VarTheme("{webfolder}", $webfolder, $Icons);
$Icons = VarTheme("{webfolderlink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("Update");
$webfolder = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (Update) . '">' . (Update) . '</a>';
$Icons = VarTheme("{Update}", $webfolder, $Icons);
$Icons = VarTheme("{Updatelink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("admins");
$webfolder = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . Admins . '">' . Admins . '</a>';
$Icons = VarTheme("{Admins}", $webfolder, $Icons);
$Icons = VarTheme("{AdminsPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("sendmodule");
$SendYouModulelink = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . SendYouModule . '">' . SendYouModule . '</a>';
$Icons = VarTheme("{SendYouModule}", $SendYouModulelink, $Icons);
$Icons = VarTheme("{SendYouModulePiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("setup");
$Setuplink = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . Setup . '">' . Setup . '</a>';
$Icons = VarTheme("{Setup}", $Setuplink, $Icons);
$Icons = VarTheme("{Setuplink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("plugins");
$Pluginslink = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . Plugins . '">' . Plugins . '</a>';
$Icons = VarTheme("{Plugins}", $Pluginslink, $Icons);
$Icons = VarTheme("{PluginsPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("plugins");
$Pluginslink = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . Plugins . '">' . Plugins . '</a>';
$Icons = VarTheme("{Plugins}", $Pluginslink, $Icons);
$Icons = VarTheme("{PluginsPiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Vars = array("todo");
$Vals = array("appsstore");
$AppsStorelink = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . AppsStore . '">' . AppsStore . '</a>';
$Icons = VarTheme("{AppsStore}", $AppsStorelink, $Icons);
$Icons = VarTheme("{StorePiclink}", AdminCreateLink("", $Vars, $Vals), $Icons);

$Icons = VarTheme("{Informations}", Informations, $Icons);
$Icons = VarTheme("{SoftwareCenter}", SoftwareCenter, $Icons);


$welcom = get_include_contents("admin/Themes/$ThemeName/welcom.php");
$welcom = VarTheme("{MessageCenter}", $MessageCenter, $welcom);
$welcom = VarTheme("{welcomMessage}", $welcomMessage, $welcom);
$welcom = VarTheme("{Icons}", $Icons, $welcom);
$welcom = VarTheme("{Note}", $Note, $welcom);
$welcom = VarTheme("{ToDoList}", $ToDoList, $welcom);
$welcom = VarTheme("{Statistics}", $Statistics, $welcom);
?>
