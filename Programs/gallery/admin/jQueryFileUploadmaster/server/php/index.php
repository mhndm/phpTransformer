<?php
/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
global $WebsiteUrl;

error_reporting(0);
include_once("../../../../../../config.php");
include_once("../../../../../../includes/ezsql/ez_sql.php");
include_once("../../../../../../includes/Functions.php");
include_once("../../../../../../includes/InputFilters.php");

require('UploadHandler.php');

if(isset($_GET['path'])){
    $path = InputFilter($_GET['path']);
}else{
    $path = '';
}

if(isset($_GET['url'])){
    $url = InputFilter($_GET['url']);
}else{
    $url = '';
}


$upload_handler = new UploadHandler($path,$url,$WebsiteUrl);

?>