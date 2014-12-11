<?php

if(isset($_POST['Host'])) {
    $Host = $_POST['Host'];
}
else {
    $Host ='';
}
if(isset($_POST['Database'])) {
    $Database = $_POST['Database'];
}
else {
    $Database = '';
}
if(isset($_POST['User'])) {
    $User = $_POST['User'];
}
else {
    $User = '';
}
if(isset($_POST['Pass'])) {
    $Pass =$_POST['Pass'];
}
else {
    $Pass = '';
}
$Success = 1;

$conn = mysqli_connect($Host,$User, $Pass) or $Success = 0 ;
mysqli_select_db($conn,$Database) or $Success = 0  ;

header ("content-type: text/xml");
echo "<?xml version='1.0' standalone='yes'?>";
echo '<data>';
echo '<db>';
echo '<res>'.$Success.'</res>';
echo '</db>';
echo '</data>';

?>
