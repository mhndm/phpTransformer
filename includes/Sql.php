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
<?php if (!isset($project)) {
    header("location: ../");
} ?>
<?php

function ExcuteQuery($query) {
    global $Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName, $conn, $TotalRecords, $Rows;

    $Recordset = mysqli_query($conn, $query);
    $TotalRecords = mysqli_num_rows($Recordset);
    if ($TotalRecords > 0) {
        $Rows = mysqli_fetch_assoc($Recordset);
    }//end if
    //}//end if
}

//end function

function closeQuery() {
    //extract($GLOBALS);
    global $Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName, $conn, $TotalRecords, $Rows;

    // for Mysql type connection
    //mysqli_free_result($Recordset);
    //mysql_close($conn); 
}

?>