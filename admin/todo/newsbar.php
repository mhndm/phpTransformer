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

global $ThemeName;
$theList = SubIconLink("newsbar", "AllNewsBar") . "<br/>";
$theList .= SubIconLink("newsbar", "AddNews") . "<br/>";

if (isset($_GET['subdo'])) {
    switch ($_GET['subdo']) {
        case "AllNewsBar":
            $theContent = AllNewsBar();
            break;
        case "AddNews":
            $theContent = AddNews();
            break;
        case "editnews":
            $theContent = editnews();
            break;
        case "delnews":
            $theContent = delnews();
            break;
        default :
    }//end switch
} else {
    $theContent = AllNewsBar();
}//end if	

if (isset($_POST['SubmitSaveMarquee'])) {
    $theContent = SaveEditNews();
}//end if

if (isset($_POST['SubmitSaveNewMarquee'])) {
    $theContent = SaveNewNews();
}//end if

$newsbar = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$newsbar = VarTheme("{todoImg}", "marquee.png", $newsbar);
$newsbar = VarTheme("{ThemeName}", $ThemeName, $newsbar);
$newsbar = VarTheme("{List}", $theList, $newsbar);
$newsbar = VarTheme("{Content}", $theContent, $newsbar);

function SaveNewNews() {

    global $conn, $TotalRecords, $Recordset, $Rows, $Lang;

    $idMarque = GenerateID("marques", "idMarque");
    if (isset($_POST['StartDate'])) {
        $StartDate = PostFilter($_POST['StartDate']);
    } else {
        $StartDate = '';
    }
    if (isset($_POST['EndDate'])) {
        $EndDate = PostFilter($_POST['EndDate']);
    } else {
        $EndDate = '';
    }
    $Link = PostFilter($_POST['Link']);
    $Link = str_replace('&', '%26', $Link); // Bug when url contain & character
    mysqli_query($conn, "insert into `marques` (`idMarque`,`StartDate`,`EndDate`,`Link`) 
				values('" . $idMarque . "','" . $StartDate . "','" . $EndDate . "','" . $Link . "');");

    ExcuteQuery("SELECT `IdLang`,`LangName` FROM `languages`;");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $IdLang = $Rows['IdLang'];
            $LangName = $Rows['LangName'];
            if (isset($_POST[$LangName . 'MarqueeMessage'])) {
                $MarqueeMessage = PostFilter($_POST[$LangName . 'MarqueeMessage']);
                mysqli_query($conn, "insert into `marqlang` (`idmarque`,`idLang`,`Message`) 
							values('" . $idMarque . "','" . $IdLang . "','" . $MarqueeMessage . "');");
            }//end if
            $Rows = mysqli_fetch_assoc($Recordset);
        }//END For
    }//end if

    return (SuccessSaveMarqueeMessage);
}

//end function

function editnews() {

    global $CustomHead, $TotalRecords, $Recordset, $Rows, $Lang, $conn;

    $CustomHead .='<script language="javascript" type="text/javascript">
                            document.onkeydown = document.onkeypress = function (evt) {
                                if (!evt && window.event) {
                                    evt = window.event;
                                }
                                var keyCode = evt.keyCode ? evt.keyCode :
                                    evt.charCode ? evt.charCode : evt.which;
                                if (keyCode) {
                                    if (evt.ctrlKey) {
                                        if(keyCode==83){
                                            document.getElementById("SubmitSaveMarquee").click();
                                            return false;
                                        }
                                        return false;
                                    }
                                }
                                return true;
                            }
                        </script>
                        ';
    $editnews = '<link rel="stylesheet" type="text/css" media="all" href="includes/jscalendar/Style/calendar-Default.css" />
				<script type="text/javascript" src="includes/jscalendar/calendar.js"></script>
				<script type="text/javascript" src="includes/jscalendar/Languages/calendar-Arabic.js"></script>
				<script type="text/javascript" src="includes/jscalendar/calendar-setup.js"></script>
				
				<script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
				<link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
    $idMarque = InputFilter($_GET['idMarque']);
    ExcuteQuery("SELECT `Link`,`StartDate`,`EndDate` FROM `marques` WHERE `idMarque`='" . $idMarque . "';");
    if ($TotalRecords > 0) {
        $Link = $Rows['Link'];
        $Link = str_replace('%26', '&', $Link); // Bug when url contain & character
        $StartDate = $Rows['StartDate'];
        $EndDate = $Rows['EndDate'];
    }//END IF

    $editnews .= '<form name="formMarquee" method="post" action="">
				  <table border="0" cellspacing="1" cellpadding="0">
				    <tr>
				      <td>' . (StartDate) . '</td>
				      <td>
					  <span id="sprytextfield1">
					  <input class="text" name="StartDate" value="' . $StartDate . '" type="text" id="StartDate" maxlength="20">
					  <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
					  </td>
				    </tr>
				    <tr>
				      <td>' . (EndDate) . '</td>
				      <td>
					  <span id="sprytextfield2">
					  <input class="text" name="EndDate" value="' . $EndDate . '" type="text" id="EndDate" maxlength="20">
					  <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
					  </td>
				    </tr>
                                    <tr><td>&nbsp;</td><td><input onclick="NoStartOrEndDate();" name="NoDateInterval" id="NoDateInterval" type="checkbox"  />' . NoDateInterval . '</td></tr>
				    <tr>
				      <td>' . (Link) . '</td>
				      <td>
					<span id="sprytextfield3">
				        <input class="text"  dir="ltr" name="Link" value="' . $Link . '" type="text" id="Link" maxlength="256">
				     <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
					 </td>
				    </tr>';
    ExcuteQuery("SELECT `IdLang`,`LangName` FROM `languages`;");
    if ($TotalRecords > 0) {
        $j = 4;
        for ($i = 0; $i < $TotalRecords; $i++) {
            $IdLang = $Rows['IdLang'];
            $LangName = $Rows['LangName'];
            $Query = "SELECT `Message` FROM `marqlang` WHERE `idLang`='" . $IdLang . "' and `idmarque`='" . $idMarque . "';";
            $RS = mysqli_query($conn, $Query);
            $TotalS = mysqli_num_rows($RS);
            if ($TotalS > 0) {
                $DATA = mysqli_fetch_assoc($RS);
                $Message = $DATA['Message'];
                $editnews .= '<tr>
								    <td>' . (MarqueeMessage) . ' ' . $LangName . '</td>
								    <td>
									<span id="sprytextfield' . $j++ . '">
								        <input class="text" name="' . $LangName . 'MarqueeMessage" value="' . $Message . '" type="text" id="' . $LangName . 'MarqueeMessage" style="width:600px" maxlength="125">
								    <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
									</td>
								  </tr>';
                $DATA = mysqli_fetch_assoc($RS);
            }//end if
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//end if
    $editnews .= '</table>
					  <br/><input class="submit" name="SubmitSaveMarquee" id="SubmitSaveMarquee" type="submit" value="' . (save) . '">
					</form>
				<script type="text/javascript">
			    function catcalc(cal) {
			        var date = cal.date;
			        var time = date.getTime();
			    }
			    Calendar.setup({
			        inputField     :    "StartDate",   // id of the input field
			        ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
			        showsTime      :    true,
			        timeFormat     :    "24",
			        onUpdate       :    catcalc
			    });
				Calendar.setup({
			        inputField     :    "EndDate",   // id of the input field
			        ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
			        showsTime      :    true,
			        timeFormat     :    "24",
			        onUpdate       :    catcalc
			    });
			</script>	
			<script type="text/javascript">
			<!--
			var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
			var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
			var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");';
    for ($i = 4; $i <= $j; $i++) {
        $editnews.= 'var sprytextfield' . $i . ' = new Spry.Widget.ValidationTextField("sprytextfield' . $i . '");';
    }//end if
    $editnews.= '
				//-->
				</script>
                            <script type="text/javascript">
                            function NoStartOrEndDate(){
                                if(document.forms["formMarquee"].NoDateInterval.checked){
                                    document.forms["formMarquee"].StartDate.value="0000-00-00 00:00:00";
                                    document.forms["formMarquee"].EndDate.value="0000-00-00 00:00:00";
                                    document.forms["formMarquee"].StartDate.disabled =true;
                                    document.forms["formMarquee"].EndDate.disabled =true;
                                }
                                else{
                                    document.forms["formMarquee"].StartDate.value="";
                                    document.forms["formMarquee"].EndDate.value="";
                                    document.forms["formMarquee"].StartDate.disabled =false;
                                    document.forms["formMarquee"].EndDate.disabled =false;
                                }

                                }
                         </script>
				';
    return $editnews;
}

//end function

function SaveEditNews() {

    global $conn, $TotalRecords, $Recordset, $Rows, $Lang;

    $idMarque = InputFilter($_GET['idMarque']);

    if (isset($_POST['StartDate'])) {
        $StartDate = PostFilter($_POST['StartDate']);
    } else {
        $StartDate = 0;
    }

    if (isset($_POST['EndDate'])) {
        $EndDate = PostFilter($_POST['EndDate']);
    } else {
        $EndDate = 0;
    }

    $Link = PostFilter($_POST['Link']);
    $Link = str_replace('&', '%26', $Link); // Bug when url contain & character
    mysqli_query($conn, "update `marques` set
				`StartDate`='" . $StartDate . "',
				`EndDate`='" . $EndDate . "',
				`Link`='" . $Link . "' where `idMarque`='" . $idMarque . "';");
    ExcuteQuery("SELECT `IdLang`,`LangName` FROM `languages`;");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $IdLang = $Rows['IdLang'];
            $LangName = $Rows['LangName'];
            if (isset($_POST[$LangName . 'MarqueeMessage'])) {
                $MarqueeMessage = PostFilter($_POST[$LangName . 'MarqueeMessage']);
                mysqli_query($conn, "update `marqlang` set `Message`='" . $MarqueeMessage . "' 
							where `idmarque`='" . $idMarque . "' and `idLang`='" . $IdLang . "';");
            }//end if
            $Rows = mysqli_fetch_assoc($Recordset);
        }//END For
    }//end if

    return (SuccessSaveMarqueeMessage);
}

//end function

function AddNews() {
    global $CustomHead, $TotalRecords, $Recordset, $Rows, $Lang, $conn;
    $CustomHead .='<script language="javascript" type="text/javascript">
                            document.onkeydown = document.onkeypress = function (evt) {
                                if (!evt && window.event) {
                                    evt = window.event;
                                }
                                var keyCode = evt.keyCode ? evt.keyCode :
                                    evt.charCode ? evt.charCode : evt.which;
                                if (keyCode) {
                                    if (evt.ctrlKey) {
                                        if(keyCode==83){
                                            document.getElementById("SubmitSaveNewMarquee").click();
                                            return false;
                                        }
                                        return false;
                                    }
                                }
                                return true;
                            }
                        </script>
                        ';
    $editnews = '<link rel="stylesheet" type="text/css" media="all" href="includes/jscalendar/Style/calendar-Default.css" />
				<script type="text/javascript" src="includes/jscalendar/calendar.js"></script>
				<script type="text/javascript" src="includes/jscalendar/Languages/calendar-Arabic.js"></script>
				<script type="text/javascript" src="includes/jscalendar/calendar-setup.js"></script>
				
				<script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
				<link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
				
				';

    $editnews .= '<form name="formMarquee" method="post" action="">
				  <table border="0" cellspacing="1" cellpadding="0">
				    <tr>
				      <td>' . (StartDate) . '</td>
				      <td>
					  <span id="sprytextfield1">
					  <input class="text" name="StartDate" value="" type="text" id="StartDate" maxlength="20">
					  <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
					  </td>
				    </tr>
				    <tr>
				      <td>' . (EndDate) . '</td>
				      <td>
					  <span id="sprytextfield2">
					  <input class="text" name="EndDate" value="" type="text" id="EndDate" maxlength="20">
					  <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
					  </td>
				    </tr>
                                    <tr><td>&nbsp;</td><td><input onclick="NoStartOrEndDate();" name="NoDateInterval" id="NoDateInterval" type="checkbox"  />' . NoDateInterval . '</td></tr>
				    <tr>
				      <td>' . (Link) . '</td>
				      <td>
					  <span id="sprytextfield3">
				        <input class="text" style="width:600px" dir="ltr" name="Link" value="" type="text" id="Link" maxlength="256">
				      <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
					 </td>
				    </tr>';
    ExcuteQuery("SELECT `IdLang`,`LangName` FROM `languages` where `Deleted`<>'1';");
    if ($TotalRecords > 0) {
        $j = 4;
        for ($i = 0; $i < $TotalRecords; $i++) {
            $IdLang = $Rows['IdLang'];
            $LangName = $Rows['LangName'];
            $editnews .= '<tr>
						<td>' . (MarqueeMessage) . ' ' . $LangName . '</td>
						<td>
						<span id="sprytextfield' . $j++ . '">
						<input class="text" name="' . $LangName . 'MarqueeMessage" value="" type="text" id="' . $LangName . 'MarqueeMessage" style="width:600px" maxlength="125">
						<span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
						</td>
						</tr>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//end if
    $editnews .= '</table>
					  <br/><input  class="submit" id="SubmitSaveNewMarquee" name="SubmitSaveNewMarquee" type="submit" value="' . (save) . '">
					</form>
				<script type="text/javascript">
			    function catcalc(cal) {
			        var date = cal.date;
			        var time = date.getTime();
			    }
			    Calendar.setup({
			        inputField     :    "StartDate",   // id of the input field
			        ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
			        showsTime      :    true,
			        timeFormat     :    "24",
			        onUpdate       :    catcalc
			    });
				Calendar.setup({
			        inputField     :    "EndDate",   // id of the input field
			        ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
			        showsTime      :    true,
			        timeFormat     :    "24",
			        onUpdate       :    catcalc
			    });
			</script>
			
			<script type="text/javascript">
			<!--
			var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
			var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
			var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");';
    for ($i = 4; $i <= $j; $i++) {
        $editnews.= 'var sprytextfield' . $i . ' = new Spry.Widget.ValidationTextField("sprytextfield' . $i . '");';
    }//end if
    $editnews.= '
				//-->
				</script>
                         <script type="text/javascript">
                            function NoStartOrEndDate(){
                                if(document.forms["formMarquee"].NoDateInterval.checked){
                                    document.forms["formMarquee"].StartDate.value="0000-00-00 00:00:00";
                                    document.forms["formMarquee"].EndDate.value="0000-00-00 00:00:00";
                                    document.forms["formMarquee"].StartDate.disabled =true;
                                    document.forms["formMarquee"].EndDate.disabled =true;
                                }
                                else{
                                    document.forms["formMarquee"].StartDate.value="";
                                    document.forms["formMarquee"].EndDate.value="";
                                    document.forms["formMarquee"].StartDate.disabled =false;
                                    document.forms["formMarquee"].EndDate.disabled =false;
                                }

                                }
                         </script>
				';

    return $editnews;
}

//end function

function delnews() {

    global $conn, $TotalRecords, $Recordset, $Rows, $Lang;
    $idMarque = InputFilter($_GET['idMarque']);
    mysqli_query($conn, "update `marques` set `deleted`='1' where `idMarque`='" . $idMarque . "';");
    return (SuccessDeleteMarque);
}

//end function

function AllNewsBar() {
    global $conn, $TotalRecords, $Recordset, $Rows, $Lang;

    $NewsMaxNbr = 50;
    $results_page_count_to_navigate_betweenu = 12;
    $page = (isset($_GET['page']) && $_GET['page'] >= 1) ? InputFilter($_GET['page']) : 1;
    $start = ($page - 1) * $NewsMaxNbr;

    ExcuteQuery("SELECT `IdLang` FROM `languages` WHERE `LangName`='" . $Lang . "';");
    if ($TotalRecords > 0) {
        $idLang = $Rows['IdLang']; // get id lang
    }

    $AllNews = '';
    $Q = "SELECT `marques`.`idMarque`, `marques`.`Link`, `marques`.`StartDate`, `marques`.`EndDate` ,`marqlang`.`Message`
			FROM `marques`, `marqlang`
			WHERE `marques`.`idMarque`=`marqlang`.`idMarque`
			and `marqlang`.`idLang`='" . $idLang . "'
			and `deleted`<>'1' 
                        order by `idMarque` desc limit " . $start . "," . $NewsMaxNbr . ";";

    $db_news_count = new db();
    $NewsTotalRecords = $db_news_count->get_var(" SELECT count(*)
			FROM `marques`, `marqlang`
			WHERE `marques`.`idMarque`=`marqlang`.`idMarque`
			and `marqlang`.`idLang`='" . $idLang . "'
			and `deleted`<>'1' ; ");

    ExcuteQuery($Q);
    if ($TotalRecords > 0) {
        $AllNews .='<table border="0" cellspacing="2" cellpadding="2">
					  <tr >
					    <td  class="td_title" >' . MarqueeMessage . ' </td>
					    <td  class="td_title" >' . StartDate . ' </td>
					    <td  class="td_title" >' . EndDate . '</td>
					    <td  class="td_title" >&nbsp;</td>
					    <td  class="td_title" >&nbsp;</td>
					  </tr>';
        for ($i = 0; $i < $TotalRecords; $i++) {
            $idMarque = $Rows['idMarque'];
            $Message = subwords($Rows['Message'], 0, 75);
            $Link = subwords($Rows['Link'], 0, 40);
            $StartDate = $Rows['StartDate'];
            $EndDate = $Rows['EndDate'];
            $Vars = array("todo", "subdo", "idMarque");
            $Vals = array("newsbar", "editnews", $idMarque);
            $EditNews = '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (edit) . ' ' . $Message . '" >'
                    . (edit) . '</a>';
            $Vars = array("todo", "subdo", "idMarque");
            $Vals = array("newsbar", "delnews", $idMarque);
            $DeleteNews = '<a onclick="return acceptDel();" href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . (delete) . ' ' . $Message . '" >'
                    . (delete) . '</a>';
            //$DeleteNews = 'DeleteNews';
            $AllNews .= ' <tr class="row_tr" >
			 <td  class="td_data" > <a href="' . $Link . '" >' . $Message . '</a></td>
                                    <td  class="td_data">  ' . $StartDate . '</td><td  class="td_data">  '
                    . $EndDate . '</td> <td  class="td_data" >  '
                    . $EditNews . '</td><td  class="td_data" >  '
                    . $DeleteNews . '</td></tr>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
        $AllNews .= '</table>
		<script language="javascript" type="text/javascript">
					function acceptDel(){
						return confirm("' . (DidUwantToDeleteThisMarqueNews) . '");
					}
                                          $(".row_tr:even").addClass("row_tr_odd");
                                          $(".row_tr:odd").addClass("row_tr_even");

					</script>';
        $AllNews .= paginate_results($NewsMaxNbr, $results_page_count_to_navigate_betweenu, $NewsTotalRecords, $page, array('todo'), array('newsbar'), true);
    }
    return $AllNews;
}

//end function
?>