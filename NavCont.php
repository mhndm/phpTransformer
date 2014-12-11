<?php
global $TheNavBar,$NavCont ;
$NavSeperator  =  ('<span class="NavSeperator"> » </span>'); 
$TheNavBarCode = "";

for($i=0;$i<count($TheNavBar);$i++){
$TheNavBarCode .= '<a href="'.$TheNavBar[$i][1].'">'.$TheNavBar[$i][0].'</a>'.$NavSeperator;

}//end for

$NavCont = GetPageContent("Themes/$ThemeName/NavCont.php");
$NavCont = VarTheme("{TheNavBar}", $TheNavBarCode,$NavCont);

?>