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

if (!isset($project)) {
    header("location: ../../");
}
?>
<?php

function SqlConnect() {
    global $MySqlConnectType, $dbUserPass, $Recordset, $SqlType, $dbHostName, $dbBaseName, $conn, $TotalRecords, $Rows;

    $conn = @mysqli_connect($dbHostName, $dbUserPass[0][0], $dbUserPass[0][1], $dbBaseName) or die("MySQL Connection Failed");
    mysqli_set_charset($conn, "utf8");
}

?>