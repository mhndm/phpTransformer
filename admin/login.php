<?php
/*

  Project         : phpTransformer.
  File Location   :  .
  File Name       :  .
  Date Created    : 00-00-2007.
  Last Modified   : 00-00-2007.
  Descriptions    : .
  Changes         : .
  TODO            :  .
  Author          :  .

*/
?>
<?php  if (!isset($IsAdmin)){header("location: ../");} ?>
<?php

global  $CustomHead,$ProgCont;
$CustomHead .= '<script src="admin/Themes/'.$ThemeName.'/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <link href="admin/Themes/'.$ThemeName.'/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
    <!--
    function MM_setTextOfTextfield(objId,x,newText) { //v9.0
      with (document){ if (getElementById){
        var obj = getElementById(objId);} if (obj) obj.value = newText;
      }
    }
    //-->
    </script>
    ';
$Login = get_include_contents("admin/Themes/".$ThemeName."/login.php");
$Login = VarTheme("{ImgSrc}", "admin/Themes/".$ThemeName."/images/kle.png",$Login);
$Login = VarTheme("Avalueisrequired",  Avalueisrequired,$Login);
$Login = VarTheme("{UserName}",  UserName,$Login);
$Login = VarTheme("{Password}",  Password,$Login);
$Login = VarTheme("login",  login,$Login);

?>