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

global $TheNavBar, $ThemeName, $DirHtml, $Lang, $TinyDir;
$theList = SubIconLink("maillist", "maillist") . "<br/>"
        . SubIconLink("letters", "Newletter") . "<br/>"
        . SubIconLink("letters", "Listletter") . "<br/>"
;

if (isset($_GET['subdo'])) {
    switch ($_GET['subdo']) {
        case "Newletter":
            $theContent = Newletter();
            $TheNavBar[] = array((Newletter), adminCreateLink("", array("todo", "subdo"), array("letters", "Newletter")));
            break;

        default :
            $theContent = Listletter();
    }//end switch
} else {
    $theContent = Listletter();
}//end if

if ($DirHtml == "rtl") {
    $DirHtml = 'right';
} else {
    $DirHtml = 'left';
}//end if
global  $UserId , $LastSession;

if (isset($_COOKIE['phpTransformer'])) {
    $LastSession = session_id();
} else {
    $LastSession = '';
}

$Tiny = ' <link rel="stylesheet" href="includes/elrte/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8" /> 
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
                toolbar  : "maxi",
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
    </script>';
$letters = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$letters = VarTheme("{todoImg}", "letters.png", $letters);
$letters = VarTheme("{ThemeName}", $ThemeName, $letters);
$letters = VarTheme("{List}", $theList, $letters);
$letters = VarTheme("{Content}", $theContent, $letters);
$letters = $Tiny . $letters;

function Newletter() {
    global $SqlType;
    if (!isset($_POST['SubmitLetter'])) {
        $Newletter = (note) . ': ' . (UcanUseThisShorts) . ' : ' .
                (UserName) . ' {UserName} ' .
                (SiteUrl) . ' {SiteUrl} ' .
                (SiteName) . ' {SiteName} ' .
                (AdminSign) . ' {AdminSign} ' .
                (Date) . ' {Date} .</br>';
        $Newletter .= '<script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
					<link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
					<script src="admin/includes/SpryValidationTextarea.js" type="text/javascript"></script>
					<link href="admin/includes/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
					<form id="formnewLetter" name="formnewLetter" method="post" action="">
					' . (LetterNameDesc) . ' : 
					<span id="sprytextfield">
					<input name="LetterName" class="text" type="text" size="50" value="" maxlength="100" />
					<span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
					<br/>';
        //showning textarea for each lang
        global $TotalRecords, $Rows, $Recordset;

        $tabs = '<ul class="tabs">';
        $divs = '';
        $DivNewLetter = '';

        ExcuteQuery("SELECT * FROM `languages` where `Deleted`<>1;");
        for ($i = 0; $i < $TotalRecords; $i++) {
            $LangName = $Rows['LangName'];
            $tabs .= '<li class="tab' . ($i + 1) . '">
			<a class="tab' . ($i + 1) . ' tab">
				' . $LangName . '	
			</a>
                        </li>';
            $DivNewLetter = '<fieldset><legend>' . $LangName . ' </legend>
						' . (TitleLetterDesc) . ' ' . $LangName . ' :<br/>
						<span id="sprytextfield' . $i . '">
						<input name="TitleLetter' . $LangName . '" class="text" type="text" value="" maxlength="100" />
						<span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
						<br/>
						' . (BodyLetterDescLang) . ' ' . $LangName . ' :<br/>
						<span id="sprytextarea' . $i . '">
						<textarea name="BodyLetter' . $LangName . '" class="editor" cols="60" rows="20"></textarea>
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
				<div>' . $DivNewLetter . '</div>
			</div><!-- end of t' . ($i + 1) . ' -->';
            
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
         $tabs .= '</ul>';
        $Newletter .='<div class="TabsMainContainer"><div class="htmltabs">' . $tabs . $divs . '</div></div>
            <input name="SubmitLetter" class="submit" type="submit" value="' . (save) . '" />
					</form>
					<script type="text/javascript">
					<!--
					var sprytextfield = new Spry.Widget.ValidationTextField("sprytextfield");
					//-->
					</script>';
    } else {
        //insert letter
        global $TotalRecords, $Rows, $Recordset, $conn;
        $LetterName = PostFilter($_POST['LetterName']);

        $idLetter = GenerateID('letters', 'idLetter');
        $query = "INSERT INTO `letters` ( `idLetter` , `LatterName` ) VALUES ('" . $idLetter . "', '" . $LetterName . "');";

        $Rs = mysqli_query( $conn,$Query) ;

        //insert letter with all messages
        $Query = "SELECT * FROM `languages`";
        $Recs = mysqli_query( $conn,$Query) ;
        while ($data = mysqli_fetch_assoc($Recs)) {
            $LangName = $data['LangName'];
            $IdLang = $data['IdLang'];
            $TitleLetter = PostFilter($_POST['TitleLetter' . $LangName]);
            $BodyLetter = PostFilter($_POST['BodyLetter' . $LangName]);
            //$BodyLetter = ReplaceUrl($BodyLetter);
            $query = "INSERT INTO `letterslang` (`idLetter`,`IdLang`,`TitleLetter`,`BodyLetter`) 
					 values ('" . $idLetter . "','" . $IdLang . "','" . $TitleLetter . "','" . $BodyLetter . "')";

            $Rs = mysqli_query( $conn,$Query) ;

            //$Rows = mysqli_fetch_assoc($Recordset);
        }//end while
        $Newletter = (SuccesInsertNewLetter) . ' <strong>' . $LetterName . '</strong>';
    }//end if
    return $Newletter;
}

//end function

function Listletter() {
    global $TotalRecords, $Rows, $Recordset, $conn, $SqlType;
    if (isset($_GET['subdo'])) {
        if ($_GET['subdo'] != 'editl' and $_GET['subdo'] != 'deletel') {
            $Listletter = '<table border="0" cellspacing="2" cellpadding="2">
						  <tr>
						    <td><strong>' . (LetterNameDesc) . '</strong></td>
						    <td><strong>' . (edit) . '</strong></td>
						    <td><strong>' . (delete) . '</strong></td>
						  </tr>';
            ExcuteQuery("SELECT * FROM `letters` where `Deleted`<>'1' ");
            for ($i = 0; $i < $TotalRecords; $i++) {
                $idLetter = $Rows['idLetter'];
                $LatterName = $Rows['LatterName'];
                $Vars = array('todo', 'subdo', 'letter');
                $Vals = array('letters', 'editl', $idLetter);
                $Varsd = array('todo', 'subdo', 'letter');
                $Valsd = array('letters', 'deletel', $idLetter);
                $Listletter .= '<tr><td>' . $LatterName . '</td><td>
							<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (edit) . ' ' . $LatterName . '" >'
                        . (edit) . '</a></td><td>
							<a onclick="return acceptDel();" href="' . AdminCreateLink("", $Varsd, $Valsd) . '" title="' . (delete) . ' ' . $LatterName . '" >'
                        . (delete) . '</a></td></tr>';
                $Rows = mysqli_fetch_assoc($Recordset);
            }//end for
            $Listletter .= '</table>
			<script language="javascript" type="text/javascript">
						function acceptDel(){
						return confirm("' . (duuwanttodeltethisLetter) . '");
						}
					</script>
			';
        } else {
            // edit or delete letter
            //edit letter
            $idLetter = InputFilter($_GET['letter']);
            if ($_GET['subdo'] == 'editl') {
                $Listletter = editLetter($idLetter);
            }//end if
            elseif ($_GET['subdo'] == 'deletel') {
                //delete  letter
                $query = "UPDATE `letters` SET `Deleted` = '1' WHERE `idLetter`='" . $idLetter . "';";

                $Rs = mysqli_query( $conn,$Query) ;

                $Listletter = (SuccesDeleteLetter);
            } else {
                $Listletter = "";
            }//end if		
        }//end if
    } else {
        $Listletter = '<table border="0" cellspacing="2" cellpadding="2">
						  <tr>
						    <td><strong>' . (LetterNameDesc) . '</strong></td>
						    <td><strong>' . (edit) . '</strong></td>
						    <td><strong>' . (delete) . '</strong></td>
						  </tr>';
        ExcuteQuery("SELECT * FROM `letters` where `Deleted`<>'1' ");
        for ($i = 0; $i < $TotalRecords; $i++) {
            $idLetter = $Rows['idLetter'];
            $LatterName = $Rows['LatterName'];
            $Vars = array('todo', 'subdo', 'letter');
            $Vals = array('letters', 'editl', $idLetter);
            $Varsd = array('todo', 'subdo', 'letter');
            $Valsd = array('letters', 'deletel', $idLetter);
            $Listletter .= '<tr><td>' . $LatterName . '</td><td>
							<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (edit) . ' ' . $LatterName . '" >'
                    . (edit) . '</a></td><td>
							<a href="' . AdminCreateLink("", $Varsd, $Valsd) . '" title="' . (delete) . ' ' . $LatterName . '" >'
                    . (delete) . '</a></td></tr>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $Listletter .= '</table>';
    }//end if
    return $Listletter;
}

//end function

function editLetter($idLetter) {
    global $TheNavBar, $TotalRecords, $Rows, $Recordset, $conn, $SqlType;

    $TheNavBar[] = array((Editletter), adminCreateLink("", array("todo", "subdo"), array("letters", "editLetter")));

    if (!isset($_POST['SubmiteLetter'])) {
        // view letter
        $idLetter = InputFilter($_GET['letter']);
        ExcuteQuery("SELECT * FROM `letters` WHERE `idLetter`='" . $idLetter . "';");
        if ($TotalRecords > 0) {
            $LatterName = $Rows['LatterName'];
        } else {
            $LatterName = "";
        }//end if
        $editLetter = (note) . ': ' . (UcanUseThisShorts) . ' : ' .
                (UserName) . ' {UserName} ' .
                (SiteUrl) . ' {SiteUrl} ' .
                (SiteName) . ' {SiteName} ' .
                (AdminSign) . ' {AdminSign} ' .
                (Date) . ' {Date} .</br>';
        $editLetter .= '<script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
					<link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
					<script src="admin/includes/SpryValidationTextarea.js" type="text/javascript"></script>
					<link href="admin/includes/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
					<form id="formnewLetter" name="formnewLetter" method="post" action="">
					' . (LetterNameDesc) . ' : 
					<span id="sprytextfield">
					<input name="LetterName" class="text" type="text" size="50" value="' . $LatterName . '" maxlength="100" />
					<span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
					<br/>';
                $tabs = '<ul class="tabs">';
        $divs = '';
        $DivNewLetter = '';
        //showning textarea for each lang
        ExcuteQuery("SELECT * FROM `languages` where `Deleted`<>1;");
        for ($i = 0; $i < $TotalRecords; $i++) {
            $LangName = $Rows['LangName'];
            $IdLang = $Rows['IdLang'];
            $query = "SELECT * FROM `letterslang` WHERE `idLetter`='" . $idLetter . "' and `IdLang`='" . $IdLang . "';";

            $tabs .= '<li class="tab' . ($i + 1) . '">
			<a class="tab' . ($i + 1) . ' tab">
				' . $LangName . '	
			</a>
                        </li>';
            
            $Rs = mysqli_query( $conn,$Query) ;
            $Total = mysqli_num_rows($Rs);

            if ($Total > 0) {
                $Rws = mysqli_fetch_assoc($Rs);
                $TitleLetter = $Rws['TitleLetter'];
                $BodyLetter = $Rws['BodyLetter'];
            } else {
                $TitleLetter = "";
                $BodyLetter = "";
            }//end if


            $DivNewLetter= '<fieldset><legend>' . $LangName . ' </legend>
						' . (TitleLetterDesc) . ' ' . $LangName . ' :<br/>
						<span id="sprytextfield' . $i . '">
						<input name="TitleLetter' . $LangName . '" class="text" type="text" value="' . $TitleLetter . '" maxlength="100" />
						<span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
						<br/>
						' . (BodyLetterDescLang) . ' ' . $LangName . ' :<br/>
						<span id="sprytextarea' . $i . '">
						<textarea name="BodyLetter' . $LangName . '" class="editor" cols="60" rows="20">' . $BodyLetter . '</textarea>
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
				<div>' . $DivNewLetter . '</div>
			</div><!-- end of t' . ($i + 1) . ' -->';
            
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $editLetter .='<div class="TabsMainContainer"><div class="htmltabs">' . $tabs . $divs . '</div></div>
            <input name="SubmiteLetter" class="submit" type="submit" value="' . (save) . '" />
					</form>
					<script type="text/javascript">
					<!--
					var sprytextfield = new Spry.Widget.ValidationTextField("sprytextfield");
					//-->
					</script>';
    } else {
        //save  letter
        global $TotalRecords, $Rows, $Recordset, $conn;
        $LetterName = PostFilter($_POST['LetterName']);
        $idLetter = InputFilter($_GET['letter']);
        $query = "UPDATE `letters` SET `LatterName` = '" . $LetterName . "' where `idLetter`='" . $idLetter . "';";

        $Rs = mysqli_query( $conn,$Query) ;

        //insert letter with all messages
        ExcuteQuery("SELECT * FROM `languages` where `Deleted`<>1;");
        for ($i = 0; $i < $TotalRecords; $i++) {
            $LangName = $Rows['LangName'];
            $IdLang = $Rows['IdLang'];
            $TitleLetter = PostFilter($_POST['TitleLetter' . $LangName]);
            $BodyLetter = PostFilter($_POST['BodyLetter' . $LangName], true);
            $query = "update `letterslang` set 
					`TitleLetter`='" . $TitleLetter . "',
					`BodyLetter`='" . $BodyLetter . "' where `idLetter`='" . $idLetter
                    . "' and `IdLang`='" . $IdLang . "';";

            $Rs = mysqli_query( $conn,$Query) ;

            $Rows = mysqli_fetch_assoc($Recordset);
        }
        $editLetter = (SuccesInsertNewLetter) . ' <strong>' . $LetterName . '</strong>';
    }//end if

    return $editLetter;
}


$letters.='<script>
    //This function will run automatically after the page is loaded
    $(document).ready(function() 
    {
        $("div.htmltabs div.tabsContent").hide();//tabsContent class is used to hide all the tabs content in the start
        $("div.tab1").show(); // It will show the first tab content when page load, you can set any tab content you want - just put the tab content class e.g. tab4
        $("div.htmltabs ul.tabs li.tab1 a").addClass("tab-current");// We will add the class to the current open tab to style the active state
        //It will add the click event on all the anchor tag under the htmltabs class to show the tab content when clicking to the tab
        $("div.htmltabs ul li a").click(function()
        {
            var thisClass = this.className.slice(0,4);//"this" is the current anchor where user click and it will get the className from the current anchor and slice the first part as we have two class on the anchor 
            $("div.htmltabs div.tabsContent").hide();// It will hide all the tab content
            $("div." + thisClass).show(); // It will show the current content of the user selected tab
            $("div.htmltabs ul.tabs li a").removeClass("tab-current");// It will remove the tab-current class from the previous tab to remove the active style
            $(this).addClass("tab-current"); //It will add the tab-current class to the user selected tab
        });
    });
</script>';


?>
