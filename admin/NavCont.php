<?php
global $TheNavBar,$NavCont ;
$NavSeperator  =  (" » ");
$TheNavBarCode = "";

for($i=0;$i<count($TheNavBar);$i++){

    $TheNavBarCode .= '<a href="'.$TheNavBar[$i][1].'">'.$TheNavBar[$i][0].'</a>'.$NavSeperator;

}//end for

$NavCont = GetPageContent("admin/Themes/$ThemeName/NavCont.php");
$NavCont = VarTheme("{TheNavBar}", $TheNavBarCode,$NavCont);

?>