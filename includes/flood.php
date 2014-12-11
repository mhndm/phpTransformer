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

global $dbUserPass, $dbPass, $dbUserName, $dbBaseName, $dbHostName;

$protect = new flood_protection(); //call the class
$protect->host = $dbHostName; // MySQl host


$protect->password = $dbUserPass[0][1]; // set the password for MySQL
$protect->username = $dbUserPass[0][0]; // set the username for MySQL

$protect->db = $dbBaseName; // set the MySQL db name
$protect->secs = $FloodSec; //Number or secounds between a request
$CurrentUrl = LangLink($_SERVER['QUERY_STRING']);
if ($protect->check_request(getenv('REMOTE_ADDR'))) { // check the user
    die('<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="refresh" content="15;url=' . $CurrentUrl . '">
            <h2>' . RequestblockPleasewait . '</h2>'); //die there flooding
}//end  if

class flood_protection {

    var $secs; // Number or secounds between a request
    var $keep_secs = 600; // Number of secounds to keep the user registered
    // MySQL config
    // global $dbHostName;
    var $host; // MySQl host
    var $password; // MySQL password
    var $username; // MySQL username
    var $db; // MySQL username
    var $link; // MySQl link

    // function to connect to MySQL

    function db_connect() {
        global $MySqlConnectType;

        $this->link = mysqli_connect($this->host, $this->username, $this->password, $this->db); // connect to MySQL

        if (!$this->link) { // test connection
            return false;
        }
        else{
            return true;
        }
        return false;
    }

    // add user ip address to database
    function register_user($ip) {
        // insert ip and currnt time into database
        $result = mysqli_query($this->link, 'INSERT INTO `floodprotection` (`IP`,`TIME`) VALUES(\' ' . mysqli_real_escape_string($this->link, $ip) . '\', \'' . microtime(true) . '\') ');
        if (!$result) {
            return false;
        }
        return true;
    }

    // check to see if the user is flooding
    function check_request($ip) {
        if (!$this->db_connect()) {
            return false; // if we cannot connect to db then return the user isnt flooding as we don't know
        }
        if ($this->user_in_db($ip)) { // find out if the user is in the db
            $return = $this->user_flooding($ip); // if they are check if there flooding
            $this->update_user($ip); // update there last request
            $this->remove_old_users(); // remove the old users
            $this->close_db(); // close db connection
            return $return; // return if there flooding or not
        } else {
            $this->register_user($ip); // if there not in the db add them
            $this->remove_old_users(); // remove the old users
            $this->close_db(); // close db connection
            return false; // sonce there not in the db there not flooding so return false
        }
    }

    function user_in_db($ip) {
        // query db to see if there in
        $result = mysqli_query($this->link, 'SELECT `TIME` FROM `floodprotection` WHERE `IP` = \' ' . mysqli_real_escape_string($this->link, $ip) . '\' LIMIT 1');
        if (mysqli_num_rows($result) > 0) { // if more than 0 records are returned there in
            return true;
        }
        return false; // other wise return false
    }

    function user_flooding($ip) {
        // query db to see if there flooding
        //echo 'SELECT `TIME` FROM `floodprotection` WHERE `IP` = \' '. mysqli_real_escape_string( $ip, $this -> link ).'\'';
        $result = mysqli_query($this->link, 'SELECT `TIME` FROM `floodprotection` WHERE `IP` = \' ' . mysqli_real_escape_string($this->link, $ip) . '\'');
        if (mysqli_num_rows($result) > 0) { // if more than 0 records are returned there flooding
            $FloodRows = mysqli_fetch_assoc($result);
            $TIME = $FloodRows['TIME'];
            if (($TIME + $this->secs) >= microtime(true)) {
                return true;
            }
        }
        return false; // other wise return false
    }

    function update_user($ip) {
        // query db to update the user last request
        $result = mysqli_query($this->link, 'UPDATE `floodprotection` SET `TIME` = \'' . microtime(true) . '\' WHERE `IP` = \' ' . mysqli_real_escape_string($this->link, $ip) . '\'');
    }

    function remove_old_users() {
        // Query db to remove all the old users
        mysqli_query($this->link, 'DELETE FROM `floodprotection` WHERE `TIME` <= \'' . (microtime(true) - $this->keep_secs) . '\'');
    }

    function close_db() {
        mysqli_close($this->link);
    }

}

?>