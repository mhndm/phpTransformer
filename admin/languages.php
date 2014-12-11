<?php

/*

  Project: phpTransformer.com .
  File Location :  .
  File Name:  .
  Date Created: 00-00-2007.
  Last Modified: 00-00-2007.
  Descriptions: .
  Changes: .
  TODO:  .
  Author: Mohsen Mousawi mhndm@phptransformer.com .

 */
?>
<?php if (!isset($IsAdmin)) {
    header("location: ../");
} ?>
<?php

global $conn, $UseRew, $SqlType, $Recordset, $SqlType, $TotalRecords, $Rows, $ThemeName;
// select or flags ?

$LangCode = "<form onsubmit=\"this.submit.disabled='true'\" action=\"index.php\" method=\"get\">";
$LangCode .= "<select class=\"select\" name=\"newlanguage\" onchange=\"top.location.href=this.options[this.selectedIndex].value\">";
$db_l = new db();
$LngQuery = "SELECT `LangName` FROM `languages` where `Deleted`<>'1';";
$LngRs = $db_l->get_results($LngQuery);

if ($LngRs) {
    foreach ($LngRs as $Lng) {
        $LangName = $Lng->LangName;
        $QrySTR = AdminNewLangLink($Lang, $LangName);
        if (!strpos($QrySTR, "nl")) {
            $QrySTR .= "&nl=1";
        }
        $LangPath = AdminLangLink($QrySTR);
        if ($Lang == $LangName) {
            $LangCode .= "<option style=\"background-image:url(admin/Themes/$ThemeName/images/fastmenu/$LangName.png); background-position:left; background-repeat:no-repeat; padding-left:35px;\" value=\"$LangPath\" selected=\"selected\">$LangName</option>";
        } else {
            $LangCode .= "<option style=\"background-image:url(admin/Themes/$ThemeName/images/fastmenu/$LangName.png); background-position:left; background-repeat:no-repeat; padding-left:35px;\" value=\"$LangPath\">$LangName</option>";
        }
    }
}

$LangCode .= "</select></form>";
?>