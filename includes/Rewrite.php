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
    header("location: ../");
}
?>
<?php

$rwrt = new RewriteClass();
$rwrt->settings['mod_rewrite'] = "Yes"; // Yes For rewrite mode, No for Normal Mode :p
$rwrt->url = $_SERVER['REQUEST_URI'];
if ($rwrt->settings['mod_rewrite']) {
    $rwrt->setupGetVariables();
}
$pieces = explode("/", $rwrt->request_uri());
$lastPiece = sizeof($pieces) - 1;

$_SERVER['QUERY_STRING'] = str_replace("index.php.pt", "", $_SERVER['QUERY_STRING']);
$_SERVER['QUERY_STRING'] = str_replace("index.php_", "", $_SERVER['QUERY_STRING']);
$_SERVER['QUERY_STRING'] = str_replace("index.php", "", $_SERVER['QUERY_STRING']);
$_SERVER['QUERY_STRING'] = str_replace("-.pt", ".pt", $_SERVER['QUERY_STRING']);
$_SERVER['QUERY_STRING'] = str_replace("-.pt", ".pt", $_SERVER['QUERY_STRING']);
$_SERVER['QUERY_STRING'] = str_replace(".pt", "", $pieces[$lastPiece]);
$_SERVER['QUERY_STRING'] = str_replace("-_", "_", $_SERVER['QUERY_STRING']);
$_SERVER['QUERY_STRING'] = str_replace("_-", "_", $_SERVER['QUERY_STRING']);

// rewite class
class RewriteClass {

    function request_uri() {

        if ($_SERVER['REQUEST_URI']) {
            return $_SERVER['REQUEST_URI'];
        }
        //IIS with ISAPI_REWRITE  (XXX untested)
        if ($_SERVER['HTTP_X_REWRITE_URL']) {
            return $_SERVER['HTTP_X_REWRITE_URL'];
        }
        $result = $_SERVER['SCRIPT_NAME'];
        if ($_SERVER['QUERY_STRING']) {
            $result .= '?' . $_SERVER['QUERY_STRING'];
        }
        return $result;
    }

    function setupGetVariables() {

        global $WebiteFolder, $AdminFileName;

        $navString = $this->request_uri(); // Returns "/Mod_rewrite/edit/1/"

         
        $parts = array();
        $navString = str_replace("/" . $WebiteFolder . "/", "", $navString);
        $navString = str_replace("/", "", $navString);
        $navString = str_replace("index.php/", "", $navString);
        $navString = str_replace("index.php.pt", "", $navString);
        $navString = str_replace("index.php_", "", $navString);
        $navString = str_replace("index.php", "", $navString);
        //$navString = str_replace(".pt", "", $navString);
        $navString = str_replace("^{/}", "", $navString);
        $navString = str_replace("/$", "", $navString);

        if (strstr($navString, '.pt')) {
                 //bug fix for strings afet .pt like :Prog-account_acnt-fastsignup_Lang-Arabic_nl-1.pt?V=1
         $pt_pos = strpos( $navString,".pt")+3;
       
         $navString = mb_substr($navString, 0,$pt_pos );
         
            $parts0 = explode('.pt', $navString); // if we use &var=value with the mod rew
            //var_dump($parts);
            $parts1 = explode('&', $parts0[1]);
            $parts2 = explode('_', $parts0[0]);
            //$parts = array_merge ($parts2,$parts1);
            $parts = array_merge($parts1, $parts2);
            //var_dump($parts);
        } else {
            $parts = explode('&', $navString);
        }

        $matches = array();
        if (trim($parts[0]) != '') {
            if ($parts[0][0] == '?') { //homepage with parameters
                return;
            } elseif (($parts[0] == 'index.php') or (substr($parts[0], 0, 10) == 'index.php?')) { //homepage with index.php
                return;
            }
        }
        //var_dump($parts);
        //all deeper parts
        //var_dump($_GET );
        for ($i = 0; $i < sizeof($parts); $i++) {
            $parts[$i] = str_replace($AdminFileName . '?', '', $parts[$i]);
            $a = preg_split("/(.*?)(\?|&)/", $parts[$i]);
            //VAR_DUMP($a);
            if (!empty($a[0])) {
                $k = $i - 1;
                //VAR_DUMP($a);
                if (strstr($a[0], '-')) {
                    $varurl = explode('-', $a[0]);
                } else {
                    $varurl = explode('=', $a[0]);
                }
                //echo $varurl[0].' : '.$varurl[1];

                if (!isset($varurl[1])) {
                    $varurl[1] = "";
                }
                $New_GET[$varurl[0]] = $varurl[1];
            } else {
                
            }
        }

        //var_dump($New_GET);
        if (isset($New_GET)) {
            $_GET = $New_GET;
        }
        // var_dump($_GET);
        //die();
    }

    function MyLink($url, $rew) {
        global $WebsiteUrl;
        if ($rew == "Yes") {
            $url = explode("?", $url);
            $parts = explode('&', $url[1]);
            $result = $WebsiteUrl;

            for ($i = 0; $i < sizeof($parts); $i++) {
                $varurl = explode('=', $parts[$i]);
                if (!isset($varurl[1])) {
                    $varurl[1] = "";
                }
                $result .=$varurl[0] . "-" . $varurl[1];
                if ($i == (sizeof($parts) - 1)) {
                    $result .=".pt";
                } else {
                    $result .="_";
                }
            }//end for
        } else {
            $result = $url;
        }//end if
        return $result;
    }

//end function
}

//end class
?>