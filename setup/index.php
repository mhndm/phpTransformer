<?php
error_reporting(E_ERROR);
session_name("phpTransformerSetup"); // change the session name from PHPSESSID
$new_name = session_name();
@session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../favicon.ico" />
        <link rel="icon" href="../animated_favicon.gif" type="image/gif" />

        <title>phpTransformer Setup</title>
        <style type="text/css"> 
            <!-- 
            body{font:100% Verdana,Arial,Helvetica,sans-serif;background:#666;margin:0;padding:0;text-align:center;}.twoColElsLtHdr #container{width:900px;background:#fff;margin:0 auto;border:1px solid #000;text-align:left}.twoColElsLtHdr #header{background:#61A0D6;padding:0 10px}.twoColElsLtHdr #header h1{margin:0;padding:10px 0}.twoColElsLtHdr #sidebar1{float:left;width:13em;background:#002f68;padding:15px 0}.twoColElsLtHdr #sidebar1 h3,.twoColElsLtHdr #sidebar1 p{margin-left:10px;margin-right:10px}.twoColElsLtHdr #mainContent{margin:0 1em 0 13em}.twoColElsLtHdr #footer{padding:0 10px;background:#ddd}.twoColElsLtHdr #footer p{margin:0;padding:10px 0}.fltrt{float:right;margin-left:8px}.fltlft{float:left;margin-right:8px}.clearfloat{clear:both;height:0;font-size:1px;line-height:0}.style1{color:#002f68}.style2{font-size:small}a{color:#064379; text-decoration: none;}
            --> 
        </style>
    </head>

    <body class="twoColElsLtHdr">

        <div id="container">
            <div id="header">
                <h1 class="style1"><img src="images/phpTransformer.png" alt="phpTransformer" longdesc="http://phptransformer.com" /></h1>
            </div>
            <?php
            if (!isset($_GET['tkn'])) {
                ?>
                <div id="sidebar1" style=" background:#ffffff;">
                    <?php include_once("sidebar.php") ?>
                </div>
                <div id="mainContent">
                    <?php include("mainContent.php") ?>
                </div> 

                <?php
            } else {
                 include_once("auto.php");
            }
            ?>

            <div id="footer">
                <p class="style2">
                    <a href="http://phptransformer.com" title="phpTransfomer" target="_blank">phpTransfomer</a>
                    Version 2014.2 ( Mayadeen )
                    <a href="http://www.gnu.org/licenses/agpl-3.0-standalone.html" target="_blank">some rights reserved</a></p>
            </div>
        </div>
    </body>
</html>
