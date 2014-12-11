<?php
include_once("../../includes.php");
include_once("../../includes/phpmailer/class.phpmailer.php");
include_once("../../includes/checkValidity.php");
include_once("../../Languages/lang-English.php");
include_once("Languages/lang-English.php");
include_once("../../includes/session.php");
include_once("functions.php");

//header('Content-Type: text/html; charset=utf-8');
if (!isset($project)){header("location: ../../");}

$result = parse_request();
$response = parse_response($result);
echo $response;
$response = json_decode($response);
function parse_request()
    {
        $operation = isset($_GET['op']) && !empty($_GET['op'])?InputFilter($_GET['op']) : "";
        switch($operation)
            {
                case 'a':
                {
                    if(isset($_GET['i'])) $result_json = audit_news ($_GET['i']);
                    else $result_json = json_encode(array("s" => '001'));
                    break;
                }    
                case 'd':
                    {
                        if(isset($_GET['i'])) $result_json = get_news_details($_GET['i']);
                        else $result_json = get_news_details(array(""));
                        break;
                    }
                case 'g':
                    {
                        if(isset($_GET['i'])) $result_json = get_news($_GET['i']);
                        else $result_json = get_news(array(""));
                        break;
                    }
                case 'ga':
                    {
                        if(isset($_GET['i'])) $result_json = get_about ($_GET['i']);
                        else $result_json = get_about (array(""));
                        break;
                    }
                case 'gs':
                    {
                        if(isset($_GET['i'])) $result_json = get_settings($_GET['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'gu':
                    {
                        if(isset($_GET['i'])) $result_json = get_unapprooved_news ($_GET['i']);
                        else return array("s" => '001');
                        break;
                    }
                case 'l':
                    {
                        if(isset($_GET['i'])) $result_json = sign_in($_GET['i']);
                        break;
                    }
                case 'm':
                    {
                        if(isset($_GET['i'])) $result_json = get_more_news($_GET['i']);
                        else $result_json = get_more_news(array(""));
                        break;
                    }
                case 's':
                    {
                        if(isset($_GET['i'])) $result_json = sign_up($_GET['i']);
                        break;
                    }
                case 'se':
                    {
                        if(isset($_GET['i'])) $result_json = send_email($_GET['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'sn':
                    {
                        if(isset($_GET['i'])) $result_json = send_news($_GET['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'ss':
                    {
                        if(isset($_GET['infos'])) $result_json = set_settings($_GET['infos']);
                        else $result_json = set_settings(array(""));
                        break;
                    }
            }
        $result = json_decode($result_json);
        return $result;
    }
    
function parse_response($result)
{
    if(is_object($result))
        {
            if(property_exists($result, 't')) return json_encode(array("s" => 1,"t" => $result->t));
            else if(property_exists($result, 'r')) return json_encode(array("s" => 1,"r" => $result->r));
            else if(property_exists($result,'v')) return json_encode(array("s" => $result->s,"v" => $result->v));
            else return json_encode(array("s" => $result->s));
        }
}

/**
 * Register a new user and enter the passed parameters as his infos and return 1 as index s and token as index t on success registration
 * or return status_error as index s on failure
 *  
 * @author Mouhammad Zein Eddine <mohammad@phptransformer.com>
 * @param associative_array $user_infos contain following indexes
    - String 'n' provide a unique nickname for the registered user(actually nickname will be the phone number)
    - String 'p' provide a password to the registered user
    - String 'f' provide the full name of the registered user
    - String 'e' provide the email of registered user
    - String 'u' provide the uuid of movile device
    - String 'a' provide the android google id of mobile device
    - String 'ap' provide the apple notification id of mobile device
 * 
 * @return json return a jsonified array that will present the success of the registration or its failure by the index 's'
 * with the apptoken in case of success by the index 't'
 */
function sign_up($user_infos = array("n" => "","p" => "","f" => "","e" => "","u" => "","a" => "","ap" => ""))
{
    global $db,$GeoIpService,$IpNbr,$AdminRegOk,$AdminMail, $WebSiteName;
    
    if(empty($db)){$db = new db();}
    /*
     * Test if any of the provided infos are empty or not valid infos
     * If their were any invalid or empty infos return jsonified array representing status error 001 and an internal array of 0,1 representing each infos success status
     */
        
    //define jsonified arrays that will be returned in different cases of errors
    $empty_infos_json = json_encode(array("s" => '001'));
    $already_error_json = json_encode(array("s" => '002'));
    $invalid_infos_form_json = json_encode(array("s" => '003'));
    $malformed_error_json = json_encode(array("s" => '004'));
    $unkown_error_json = json_encode(array("s" => '005'));
    
    //create an array that will contain our indexes to prevent sending array with any other infos
    $valid_indexes_arr = array("n","p","f","e","u","a","ap");
    $optional_indexes_arr = array("u","a","ap");
    
    // Propose that all infos are valid
    $infos_validity_arr = array("n" => 1,"p" => 1,"f" => 1,"e" => 1,"u" => 1,"a" => 1,"ap" => 1);
    
    //if the user infos is empty or not a valid array or its count is not equal to our supposed array
    if(empty($user_infos) || !is_array($user_infos) || count($user_infos) <= 0 || count($user_infos) != count($valid_indexes_arr))
        {return($invalid_infos_form_json);}
    
    //test each info validity
    $index = 0;
    foreach($user_infos as $info_name => $info_value)
        {
            if(!in_array($info_name,$valid_indexes_arr) || $valid_indexes_arr[$index] != $info_name)
                {return($malformed_error_json);}
                
            // If it is not valid set the convenable index to 0
            if(!in_array($info_name, $optional_indexes_arr) && (empty($info_value) || strlen(trim($info_value)) == 0))
                {$infos_validity_arr[$info_name] = 0;}
            
            //If tested info is the email field and it is not already detected as invalid infos in the test above
            if($info_name == "e" && $infos_validity_arr[$info_name] == 1)
                {
                    // If it is not valid email set convenable index to 0
                    if(!check_email_address($info_value)){$infos_validity_arr[$info_name] = 0;}
                }
            $index ++;
        }
     // if error infos array contain any 0 in its element return a jsonified array with status 001 and an array of infos statuses
     foreach($infos_validity_arr as $info => $validity)
        {
            if(empty($validity) || $validity == 0)
                {return(json_encode(array("s" => '001',"v" => $infos_validity_arr)));}
        }
    
    /*Select from database for a user that have look like nick_name or email
     *If their were any already registered user with these infos return a jsonified array representing status error 002 as status to tell user to choose another infos
     */
    
    $nick_name = InputFilter($user_infos['n']);
    $email = InputFilter($user_infos['e']);
    
    $already_user_var = $db->get_var("select UserId from users where `NickName` = '$nick_name' or `UserMail` = '$email'");
    if($already_user_var)
        {
            return($already_error_json);
        }
    
    $user_id = GenerateID('users', 'UserId');
    $group_id = '20070000001';
    $time_format = 'Y-m-d H:i:s';
    $full_name_arr = explode(' ',InputFilter($user_infos['f']),2);
    $user_name = $full_name_arr[0];
    $parent_name = "";
    $family_name = count($full_name_arr) > 1?end($full_name_arr):"";
    $birth_date = "";
    $gender = 1;
    $gmt = '+2';//
    $country = strtolower(GetPageContent($GeoIpService . get_client_ip()));
    $phone_number = "";
    $cell_number = $nick_name;
    $password = md5($user_infos['p']);
    $last_login = date("Y-m-d H:i:s");
    $last_ip = get_client_ip();
    $hobies = '';
    $job = '';
    $education = '';
    $pref_lang = 'Arabic';//
    $pref_time = '08:00-16:00';
    $cookie_life = 8640;
    $user_pic = "";//
    $user_site = "";//
    $banned = 0;
    $pref_theme = "Default";
    $user_sign = '';
    $points = 1;
    $active = $AdminRegOk == '1'?'0' : '1';
    $reg_date = date("Y-m-d H:i:s");
    $allow_html = 1;
    $allow_html = "0";
    $allow_bb_code = "0";
    $allow_smiles = "0";
    $allow_avatar = "1";
    $confirm_code = md5(date("Y-m-d") . $user_id . rand(1, 9999999999));
    $mailed = 0;
    $deleted = 0;
    $last_session = 0;
    $android_id = $user_infos['a'];
    $apple_id = $user_infos['ap'];
    $uuid = $user_infos['u'];
    $app_token = md5($nick_name . time().strrev($email));
    
    
    /* Insert provided infos to table users and get the result of insertion operation
     * If result is success then return jsonified array with status error 1 and app_token = md5($nick_name . time().str_rev($email)
     * Else if result is failure then return jsonified array with status error 003 that will tell user that an unkown error has been occured
     */
    
    $register_user_sql = "insert into users(`UserId`,`GroupId`,`TimeFormat`,`UserName`,`NickName`,`ParentName`,`FamName`,`BirthDate`,`Sex`,`GMT`,`Contry`,`PhoneNbr`,`CellNbr`,`PassWord`,`LastLogin`,`LastIP`,`Hobies`,`Job`,`Education`,`PrefLang`,`PrefTime`,`CookieLife`,`UserPic`,`UserMail`,`UserSite`,`Banned`,`PrefThem`,`UserSign`,`Points`,`Active`,`RegDate`,`allowHtml`,`allowBBcode`,`allowSmiles`,`allowAvatar`,`ConfirmCode`,`Mailed`,`Deleted`,`LastSession`,`android_id`,`apple_id`,`uuid`,`app_token`)"
            . "values"
            . "('$user_id','$group_id','$time_format','$user_name','$nick_name','$parent_name','$family_name','$birth_date','$gender','$gmt','$country','','$nick_name','$password','$last_login','$last_ip','$hobies','$job','$education','$pref_lang','$pref_time','$cookie_life','$user_pic','$email','$user_site',0,'$pref_theme','$user_sign','$points','$active','$reg_date','$allow_html','$allow_bb_code','$allow_smiles','$allow_avatar','$confirm_code','$mailed','$deleted','$last_session','$android_id','$apple_id','$uuid','$app_token')";
    
    $register_user_qu = $db->query($register_user_sql);
    
    if($AdminRegOk != "1")
        {
            $url_variables = array("Prog", "acnt", "actvcode", "user");
            $url_values = array("account", "activate", $confirm_code, $nick_name);
            
            $activation_link = CreateLink("", $url_variables, $url_values);
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            
            $from = $AdminMail;
            $from_name = $WebSiteName;
            $add_address[0] = $email;
            $add_address[1] = $nick_name;
            $subject = (api_email_subject_new_user) . $WebSiteName;
            $body = '<div dir="' . (DirHtml) . '" >' . (DearMr) . $user_name . " " . $family_name . "<br/>" . (api_email_body_new_user) . '<br><a href="' . $activation_link . '" target="_blank">' . $activation_link . '<a/>' . "</div>" . (EmailSignature);
            SendEmail($from, $from_name, $add_address, $subject, $body);
            mobile_login($nick_name);
            //LoginAsUser ($nick_name);
        }
    else
        {
            mobile_login($nick_name);
            //LoginAsUser ($nick_name);
        }
    return json_encode(array("s" => 1,"t" => $app_token));
}

/**
 * Login user using user name and password
 * return 1 as index s on success or return status_error as index s on failure
 *  
 * @author Mouhammad Zein Eddine <mohammad@phptransformer.com>
 * @param associative_array $user_infos contain following indexes
    - String 'n' provide a unique nickname for the registered user(actually nickname will be the phone number)
    - String 'p' provide a password to the registered user
 * 
 * @return json return a jsonified array that will present the success of the registration or its failure by the index 's'
 * with the apptoken in case of success by the index 't'
 */
function sign_in($user_infos = array("t" => ""))
{
    global $db;
    
    if(empty($db))
        $db = new db();
        
    $empty_error_json = json_encode(array("s" => '001'));//in case that their were any empty element in the passed array
    $invalid_infos_form_json = json_encode(array("s" => '002'));//in case that array passed is empty or is not array
    $invalid_user_error_json = json_encode(array("s" => '003'));//in case that the provided infos are not valid or user not found
    $malformed_error_json = json_encode(array("s" => '004'));//in case of malformed parameters either not in same order or invalid indexed element used
    
    $valid_indexes_arr = array("t");
    $infos_validity_arr = array("t" => 1);
    
    if(empty($user_infos) || !is_array($user_infos) || count($user_infos) <= 0 || count($user_infos) != count($valid_indexes_arr))
        return($invalid_infos_form_json);
    
    $index = 0;
    foreach($user_infos as $info_name => $info_value)
        {
            if(!in_array($info_name,$valid_indexes_arr) || $valid_indexes_arr[$index] != $info_name)
                return($malformed_error_json);
                
            // If it is not valid set the convenable index to 0
            if(empty($info_value) || strlen(trim($info_value)) == 0)
                $infos_validity_arr[$info_name] = 0;
            $index ++;
        }
    
    foreach($infos_validity_arr as $info => $validity)
        {
            if(empty($validity) || $validity == 0)
                return(json_encode(array("s" => '001',"v" => $infos_validity_arr)));
        }
        
    $user_token = InputFilter($user_infos['t']);
    
    $already_user_row = $db->get_row("select UserMail,NickName,app_token from users where `app_token` = '$user_token'");
    
    if(is_object($already_user_row))
        {
            $old_token = $already_user_row->app_token;
            $new_token = md5($already_user_row->NickName . time().strrev($already_user_row->UserMail));
            $new_token_qu = $db->query("update users set app_token = '$new_token' where app_token = '$old_token'");
            mobile_login($already_user_row->NickName);
            return json_encode(array("s" => 1,"t" => $new_token));
        }
    else
        return $invalid_user_error_json;
}

/**
 * Get last n news order by order using language for each category or for specific category if index c found
 * @param String $o Order of news
 * @param String $l Language of retrieved news
 * @param String $t Token of the user
 * @param String $li count of news each time to get (n news = li news)
 * @param String $c category_id the category we want to get the last n news(if omitted all categories will be fetched)
 * 
 * @return jsonified_array with index s = 1 and index r that contain all news appropriate to our selection if news found
 * or index s = status_error if no news found or user pass an invalid token
 */
function get_news($categories_infos = array('l'=> '','t' => '','o' => '','li' => '','c' => ''))
    {
        global $db;
        if(empty($db))
            {$db = new db();}
        
        $no_news_found_error_json = json_encode(array("s" => '001'));//in case of their were no news
        $invalid_token_error_json = json_encode(array("s" => '002'));//in case of invalid token passed
        $invalid_infos_form_json = json_encode(array("s" => '003'));//in case an invalid array passed to this function as $user_infos
        $malformed_error_json = json_encode(array("s" => '004'));//in case of malformed parameters either not in same order or invalid indexed element used
    
        //create an array that will contains our indexes to prevent sending array with any other infos
        $valid_indexes_arr = array("l","t","o","li","c");
        
        //Create an array that will contains our optional indexes to skip when any of element are empty
        $optional_indexes_arr = array("l","t","o","li","c");
        
        //Create an array that will contains our default values that will be used when any infos is empty
        $default_values_arr = array("l" => 'Arabic',"t" => "","o" => "desc","li" => 5,"c" => "");
    
        // Propose that all infos are valid
        $infos_validity_arr = array("l" => 1,"t" => 1,"o" => 1,"li" => 1,"c" => 1);
    
        //if the user infos is empty or not a valid array or its count is not equal to our supposed array
        if(empty($categories_infos) || !is_array($categories_infos) || count($categories_infos) <= 0 || count($categories_infos) != count($valid_indexes_arr))
            {$categories_infos = $default_values_arr;}
        //test each info validity
        $index = 0;
        foreach($categories_infos as $info_name => $info_value)
            {
                if(!in_array($info_name,$valid_indexes_arr) || $valid_indexes_arr[$index] != $info_name)
                    {return($malformed_error_json);}
                
                // If it is not valid set the convenable index to 0
                if(!in_array($info_name, $optional_indexes_arr) && (empty($info_value) || strlen(trim($info_value)) == 0))
                    {$infos_validity_arr[$info_name] = 0;}
                else
                    {
                        if((empty($info_value) || strlen(trim($info_value)) == 0))
                            {$categories_infos[$info_name] = $default_values_arr[$info_name];}
                    }
                $index ++;
            }
        
        $language = InputFilter($categories_infos['l']);
        $order = InputFilter($categories_infos['o']);
        $limit = InputFilter($categories_infos['li']);
        $cat_id = InputFilter($categories_infos['c']);
        $token = InputFilter($categories_infos['t']);
        
        $user_choice = 0;
        
        if(empty($cat_id))
            {
                if(!empty($token))
                    {
                        $valid_token_var = $db->get_var("select UserId from users where app_token = '$token'");
                        if(!$valid_token_var)
                            {return $invalid_token_error_json;}
                        $all_categories_sql = "select cl.IdCat,cl.CatName,ns.only_urgent from languages as l,catlang as cl,news_subscription as ns where l.IdLang = cl.IdLang and cl.Deleted != 1 and cl.IdCat = ns.cat_id and l.LangName = '$language' order by '$order' asc";
                        $user_choice = 1;
                    }
                else
                    {$all_categories_sql = "select cl.IdCat,cl.CatName from languages as l,catlang as cl where l.IdLang = cl.IdLang and l.LangName = '$language' and cl.Deleted != 1 order by '$order' asc";}
            }
        else
            {$all_categories_sql = "select cl.IdCat,cl.CatName from languages as l,catlang as cl where l.IdLang = cl.IdLang and l.LangName = '$language' and cl.IdCat = '$cat_id' and cl.Deleted != 1 order by '$order' asc";}
        
        $all_categories_rs = $db->get_results($all_categories_sql);
        if($all_categories_rs)
            {
                $result = array("result" => array());
                foreach($all_categories_rs as $category)
                    {
                        $cat_id = $category->IdCat;
                        $only_urgent = "";
                        if($user_choice == 1)
                            {
                                if($category->only_urgent == 1)
                                    {$only_urgent = "and n.urgent = 1";}
                            }

                        $latest_news_sql = "select * from languages as l,news as n,newslang as nl,newscategoies as nc where l.IdLang = nl.IdLang and n.IdNews = nc.IdNews and n.IdNews = nl.IdNews and n.Active = 1 and n.Deleted != 1 and nc.IdCat = '$cat_id' and l.LangName = '$language'" . $only_urgent ." order by n.Date desc limit 0,$limit";

                        $latest_news_rs = $db->get_results($latest_news_sql);
                        $latest_id = "";
                        if($latest_news_rs)
                            {
                                $result["result"][] = array("type" => "category","id" => $category->IdCat ,"title" => $category->CatName);
                                foreach($latest_news_rs as $latest_news)
                                    {
                                        $last_news_date = $latest_news->Date;
                                        $latest_id = $latest_news->IdNews;
                                        $agency_pic_big = $db->get_var("select UserPic from users where NickName = '".$latest_news->agency."'");
                                        $agency_pic = str_replace(array('128'),array('32'),$agency_pic_big);
                                        $result["result"][] = array("type" => "news","id" => $latest_news->IdNews,"pic" => $latest_news->NewsPic ,"title" => $latest_news->Tilte,"date" => $latest_news->Date,"urgent" => $latest_news->urgent,"agency" => $agency_pic);
                                    }
                                $have_more_news_sql = "select count(*) from news as n,newscategoies as nc where n.IdNews = nc.IdNews and nc.IdCat = '$cat_id' and n.`Date` <= '$last_news_date' and n.Active = 1 and n.Deleted != 1 and n.`IdNews` != '$latest_id'" . $only_urgent;
                                $have_more_news_var = $db->get_var($have_more_news_sql);

                                if($have_more_news_var > 0)
                                    {$result["result"][] = array("type" => "more","id" => $latest_id,"cat" => $cat_id,"title" => api_get_news_more);}
                                else
                                    {$result["result"][] = array("type" => "more","id" => -1);}
                            }
                    }
                
                if(count($result['result']) == 0)
                    {return $no_news_found_error_json;}
                else
                    {
                        $result['last_news_id'] = count($result['result']);
                        return json_encode(array("s" => 1,"r" => $result));
                    }
            }
        else
            {return $no_news_found_error_json;}
    }

function get_more_news($categories_infos = array('l'=> '','o' => '','li' => '','c' => '','ld' => '','lid' => ''))
    {
        global $db;
        if(empty($db)){$db = new db();}
    
        $malformed_error_json = json_encode(array("s" => '001'));
        $invalid_infos_form_json = json_encode(array("s" => '002'));
        $invalid_category_error_json = json_encode(array("s" => '003'));
        $no_news_found_error_json = json_encode(array("s" => '004'));
    
        //create an array that will contains our indexes to prevent sending array with any other infos
        $valid_indexes_arr = array("l","o","li","c","ld","lid");
        
        //Create an array that will contains our optional indexes to skip when any of element are empty
        $optional_indexes_arr = array("l","o","li");
        
        //Create an array that will contains our default values that will be used when any infos is empty
        $default_values_arr = array("l" => 'Arabic',"o" => "desc","li" => 5,"c" => "","ld" => "","lid" => "");
    
        // Propose that all infos are valid
        $infos_validity_arr = array("l" => 1,"o" => 1,"li" => 1,"c" => 1,"ld" => 1,"lid" => 1);
    
        //if the user infos is empty or not a valid array or its count is not equal to our supposed array
        if(empty($categories_infos) || !is_array($categories_infos) || count($categories_infos) <= 0)
            {$categories_infos = $default_values_arr;}
            
        //test each info validity
        $index = 0;
        foreach($categories_infos as $info_name => $info_value)
            {
                if(!in_array($info_name,$valid_indexes_arr) || $valid_indexes_arr[$index] != $info_name)
                    {return($malformed_error_json);}

                // If it is not valid set the convenable index to 0
                if(!in_array($info_name, $optional_indexes_arr) && (empty($info_value) || strlen(trim($info_value)) == 0))
                    {$infos_validity_arr[$info_name] = 0;}
                else
                    {
                        if((empty($info_value) || strlen(trim($info_value)) == 0))
                            {$categories_infos[$info_name] = $default_values_arr[$info_name];}
                    }
                $index ++;
            }
    
        foreach($infos_validity_arr as $info => $validity)
            {
                if(empty($validity) || $validity == 0)
                    {return(json_encode(array("s" => '001',"v" => $infos_validity_arr)));}
            }
        
        $language = InputFilter($categories_infos['l']);
        $order = InputFilter($categories_infos['o']);
        $limit = InputFilter($categories_infos['li']);
        $cat_id = InputFilter($categories_infos['c']);
        $last_date = InputFilter($categories_infos['ld']);
        $last_id = InputFilter($categories_infos['lid']);
    
        $last_news_date = "";
    
        $valid_category_row = $db->get_row("select * from languages as l,catlang as cl where l.IdLang = cl.IdLang and l.LangName = '$language' and cl.IdCat = '$cat_id' limit 0,1");
        if($valid_category_row)
            {
                $result = array("result" => array());
                $category_row = $valid_category_row;
                $cat_id = $category_row->IdCat;
                $latest_news_rs = $db->get_results("select * from languages as l,news as n,newslang as nl,newscategoies as nc where l.IdLang = nl.IdLang and n.IdNews = nc.IdNews and n.IdNews = nl.IdNews and n.Active = 1 and n.Deleted != 1 and nc.IdCat = '$cat_id' and l.LangName = '$language' and n.Date <= '$last_date' and n.IdNews != '$last_id' order by n.Date desc limit 0,$limit");
                $latest_id = "";
                if(count($latest_news_rs) > 0)
                    {
                        $result["result"][] = array("type" => "category","id" => $category_row->IdCat ,"title" => $category_row->CatName);
                        foreach($latest_news_rs as $latest_news_row)
                            {
                                $last_news_date = $latest_news_row->Date;
                                $latest_id = $latest_news_row->IdNews;
                                $agency_pic_var = $db->get_var("select UserPic from users where NickName = '".$latest_news_row->agency."'");
                                $agency_pic = str_replace(array('128'),array('32'),$agency_pic_var);
                                $result["result"][] = array("type" => "news","id" => $latest_news_row->IdNews,"pic" => $latest_news_row->NewsPic ,"title" => $latest_news_row->Tilte,"date" => $latest_news_row->Date,"urgent" => $latest_news_row->urgent,"agency" => $agency_pic);
                            }
                        $have_more_news_rs = $db->get_var("select count(*) from news as n,newscategoies as nc where n.IdNews = nc.IdNews and nc.IdCat = '$cat_id' and n.`Date` <= '$last_news_date' and n.`IdNews` != '$latest_id' and n.Active = 1 and n.Deleted != 1");

                        if($have_more_news_rs > 0)
                             $result["result"][] = array("type" => "more","id" => $latest_id,"cat" => $cat_id,"title" => "المزيد");
                        else
                            $result["result"][] = array("type" => "more","id" => -1);
                        $result['last_news_id'] = count($result['result']);
                        return json_encode(array("s" => 1,"r" => $result));
                    }
                else
                    {
                        return $no_news_found_error_json;
                    }
            }
        else
            {
                return $invalid_category_error_json;
            }
}

function get_news_details($news_infos = array("n" => "","l" => ""))
    {
        global $db;
            if(empty($db)){$db = new db();}
        
        $invalid_news_error_json = json_encode(array("s" => '001'));
        $malformed_error_json = json_encode(array("s" => '002'));
        $invalid_language_error_json = json_encode(array("s" => '003'));
        
        $valid_indexes_arr = array("n","l");
        $optional_indexes_arr = array("l");
        $default_values_arr = array("n" => '',"l" => 'Arabic');
        $infos_validity_arr = array("n" => 1,"l" => 1);
    
        $index = 0;
        foreach($news_infos as $info_name => $info_value)
            {
                if(!in_array($info_name,$valid_indexes_arr) || $valid_indexes_arr[$index] != $info_name)
                    {return($malformed_error_json);}

                // If it is not valid set the convenable index to 0
                if(!in_array($info_name, $optional_indexes_arr) && (empty($info_value) || strlen(trim($info_value)) == 0))
                    {$infos_validity_arr[$info_name] = 0;}
                else
                    {
                        if((empty($info_value) || strlen(trim($info_value)) == 0))
                            {$news_infos[$info_name] = $default_values_arr[$info_name];}
                    }
                $index ++;
            }
    
        foreach($infos_validity_arr as $info => $validity)
            {
                if(empty($validity) || $validity == 0)
                    {return(json_encode(array("s" => '001',"v" => $infos_validity_arr)));}
            }
        
        $news_id = InputFilter($news_infos['n']);
        $language = InputFilter($news_infos['l']);
        
        $valid_language_var = $db->get_var("select IdLang from languages where LangName = '$language' and Deleted != 1");
        
        if(!$valid_language_var)
            return $invalid_language_error_json;
        
        $news_details_row = $db->get_row("select * from languages as l,news as n,newslang as nl where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.IdNews = '$news_id' and l.IdLang = '$valid_language_var' and n.Active = 1 and n.Deleted != 1");
        if($news_details_row)
            {
                $result['result'] = array("id" => $news_details_row->IdNews,"pic" => $news_details_row->NewsPic ,"title" => $news_details_row->Tilte,"full" => $news_details_row->FullMessage);
                return json_encode(array("s" => 1,"r" => $result));
            }
        else
            {
                return $invalid_news_error_json;
            }
        
    }

function set_settings($settings_infos = array("t","l","n" => array(),"s" => array()))
{
    global $db;
    
    if(empty($db))
        {$db = new db();}
    
    $malformed_error_json = json_encode(array("s" => '001'));
    $invalid_token_error_json = json_encode(array("s" => '002'));
    $notification_settings_array_contain_invalid_infos = json_encode(array("s" => '003'));
    $display_settings_array_contain_invalid_infos = json_encode(array("s" => '004'));
    
    $valid_indexes_arr = array("t","l","n","s");
    $default_values_arr = array("t" => '',"l" => 'Arabic',"n" => '',"s" => '');
    $infos_validity_arr = array("t" => 1,"l" => 1,"n" => 1,"s" => 1);
    
    $index = 0;
    foreach($settings_infos as $info_name => $info_value)
        {
            if(!in_array($info_name,$valid_indexes_arr) || $valid_indexes_arr[$index] != $info_name)
                {return($malformed_error_json);}

            // If it is not valid set the convenable index to 0
            if(empty($info_value))
                {$infos_validity_arr[$info_name] = 0;}
            else
                {
                    if((empty($info_value)))
                        {$news_infos[$info_name] = $default_values_arr[$info_name];}
                }
            $index ++;
        }

    foreach($infos_validity_arr as $info => $validity)
        {
            if(empty($validity) || $validity == 0)
                {return(json_encode(array("s" => '001',"v" => $infos_validity_arr)));}
        }
    
    $passed_language = InputFilter($settings_infos['l']);
    
    $valid_language = $db->get_var("select * from languages where LangName = '$passed_language'");
    if(!$valid_language)
        $language = 'Arabic';
    else
        $language = $passed_language;
    
    $token = InputFilter($settings_infos['t']);
    
    $valid_user_row = $db->get_row("select * from users where app_token = '$token'");
    if($valid_user_row)
        {
            $update_user_preferred_language = $db->query("update users set PrefLang = '$language' where app_token = '$token'");
            $user_id = $valid_user_row->UserId;
            $notifications_settings_arr = $settings_infos['n'];
            $subscriptions_settings_arr = $settings_infos['s'];
    
            foreach ($notifications_settings_arr as $valid_notification_setting)
                {
                    if(count($valid_notification_setting) != 2 || !isset($valid_notification_setting['u']) || !isset($valid_notification_setting['i']))
                        {return $notification_settings_array_contain_invalid_infos;}
                }
            
            foreach ($subscriptions_settings_arr as $valid_subscription_setting)
                {
                    if(count($valid_subscription_setting) != 2 || !isset($valid_subscription_setting['u']) || !isset($valid_subscription_setting['i']))
                        {return $display_settings_array_contain_invalid_infos;}
                }
                
            foreach ($notifications_settings_arr as $setting)
                {
                    $only_urgent = InputFilter($setting['u']) == 1?1 : 0;
                    $news_group_id = InputFilter($setting['i']);
                    $valid_news_group_id_var = $db->get_var("select * from catlang where IdCat = '$news_group_id'");
                    if(!$valid_news_group_id_var)
                        {$news_group_id = '20100000000';}
                    
                    $already_found_setting_var = $db->get_var("select id from notification where id_user = '$user_id' and id_news_group = '$news_group_id'");
                    
                    if($already_found_setting_var)
                        {$update_setting_qu = $db->query("update notification set only_urgent = '$only_urgent' where id_news_group = '$news_group_id' and id_user = '$user_id'");}
                    else
                        {$insert_setting_qu = $db->query("insert into notification values(NULL,'$user_id','$news_group_id','$only_urgent')");}
                }
                
            foreach ($subscriptions_settings_arr as $setting)
                {
                    $only_urgent = InputFilter($setting['u']) == 1?1 : 0;
                    $news_group_id = InputFilter($setting['i']);
                    $valid_news_group_id_var = $db->get_var("select * from catlang where IdCat = '$news_group_id'");
                    if(!$valid_news_group_id_var)
                        {$news_group_id = '20100000000';}
                    
                    $already_found_setting_var = $db->get_var("select id from news_subscription where user_id = '$user_id' and cat_id = '$news_group_id'");
                    
                    if($already_found_setting_var)
                        {$update_setting_qu = $db->query("update news_subscription set only_urgent = '$only_urgent' where cat_id = '$news_group_id' and user_id = '$user_id'");}
                    else
                        {$insert_setting_qu = $db->query("insert into news_subscription values(NULL,'$user_id','$news_group_id','$only_urgent')");}
                }
        }
    else
        {return $invalid_token_error_json;}
    
}

function get_settings($settings_infos = array("t"))
{
    global $db;
    
    if(empty($db))
        {$db = new db();}
    
    $invalid_infos_error_json = json_encode(array("s" => '001'));
    $malformed_error_json = json_encode(array("s" => '002'));
    $invalid_token_error_json = json_encode(array("s" => '003'));
    
    $valid_indexes_arr = array("t");
    $infos_validity_arr = array("t" => 1);
    
    $index = 0;
    
    if(!is_array($settings_infos) || count($settings_infos) <= 0 || count($settings_infos) > $valid_indexes_arr)
        {return $invalid_infos_error_json;}
    
    foreach($settings_infos as $info_name => $info_value)
        {
            if(!in_array($info_name,$valid_indexes_arr) || $valid_indexes_arr[$index] != $info_name)
                {return($malformed_error_json);}
            $index ++;
        }
        
    $passed_token = InputFilter($settings_infos['t']);
    $valid_token_row = $db->get_row("select * from users where app_token = '$passed_token' limit 0,1");
    
    if($valid_token_row)
        {
            $user_id = $valid_token_row->UserId;
            $language = $valid_token_row->PrefLang;
            $returned_results = array("l" => $language,"n" => array(),"s" => array());
            
            $notifications_settings_res = $db->get_results("select * from notification where id_user = '$user_id'");
            if(count($notifications_settings_res) > 0)
                {
                    foreach($notifications_settings_res as $notification_setting)
                        {
                            $returned_results["n"][]["i"] = $notification_setting->id_news_group;
                            $returned_results["n"][]["u"] = $notification_setting->only_urgent;
                        }
                }
                
            $subscriptions_settings_res = $db->get_results("select * from news_subscription where user_id = '$user_id'");
            if(count($subscriptions_settings_res) > 0)
                {
                    foreach($subscriptions_settings_res as $subscription_setting)
                        {
                            $returned_results["s"][]["i"] = $subscription_setting->cat_id;
                            $returned_results["s"][]["u"] = $subscription_setting->only_urgent;
                        }
                }
            return json_encode($returned_results);
        }
    else
        {return $invalid_token_error_json;}
}

function get_about($page_infos = array("l" => "Arabic"))
{
    $page_not_found_json_error = array("s" => '001');
    
    if(isset($page_infos['l']))
        {
            $passed_language = InputFilter($page_infos['l']);
            $is_valid_language_var = $db->get_var("select IdLang from language where LangName = '$passed_language' and Deleted != 1");
            if($is_valid_language_var)
                $page_language = $is_valid_language_var;
            else
                $page_language = 'Arabic';
        }
    else
        {
            $page_language = 'Arabic';
        }
        
    global $db;
    
    if(empty($db))
        $db = new db();
    
    $about_page_row = $db->get_row("select pl.PageTitle,pl.Content from pages as p,pagelang as pl,languages as l where l.IdLang = pl.IdLang and p.IdPage = pl.IdPage and p.PageNbr = 1 and l.LangName = '$page_language'");
    if($about_page_row)
        {
            return json_encode(array("s" => 1,"r" => array("title" => $about_page_row->PageTitle,"content" => $about_page_row->Content)));
        }
    else
        {
            return json_encode($page_not_found_json_error);
        }
}

function send_news($news_infos = array("t" => "","c" => "","a" => "","ca" => "","l" => "","i" => "","u" => "","ti" => ""))
{
    global $db;
    
    if(empty($db))
        $db = new db();
    
    $invalid_infos_json_error = json_encode(array("s" => '001'));
    $malformed_error_json = json_encode(array("s" => '002'));
    $invalid_token_error_json = json_encode(array("s" => '003'));
    $unsufficient_permissions_error_json = json_encode(array("s" => '004'));
    $invalid_language_error_json = json_encode(array("s" => '005'));
    $empty_content_error_json = json_encode(array("s" => '006'));
    
    $valid_indexes_arr = array("t","l","c","a","ca","i","u","ti");
    $guest_valid_indexes_arr = array("l","c","ca","i","ti");
    
    
    if(!isset($news_infos) || !is_array($news_infos) || count($news_infos) > count($valid_indexes_arr) || count($news_infos) <= 0)
        {return $invalid_infos_json_error;}
    
    $index = 0;
    foreach($news_infos as $info_name => $info_value)
        {
            if(!in_array($info_name,$valid_indexes_arr))
                {return($malformed_error_json);}
            $index ++;
        }
    
    $passed_language = isset($news_infos['l']) && !empty($news_infos['l'])?InputFilter($news_infos['l']):"";
    if(!empty($passed_language))
        {
            $news_language_var = $db->get_var("select IdLang from languages where LangName = '$passed_language' and Deleted != 1");
            if($news_language_var)
                {$news_language = $news_language_var;}
            else
                {return $invalid_language_error_json;}
        }
    else
        {return $invalid_language_error_json;}
    
    $passed_news_body = isset($news_infos['c']) && !empty($news_infos['c'])?$news_infos['c'] : "";
    if(empty($passed_news_body))
        {return $empty_content_error_json;}
    else
        {
            $w_tags_news_body = strip_tags($passed_news_body);
            $news_body = str_replace(array("\n"),array("<line>"),$w_tags_news_body);
        }
    
    if(isset($news_infos['t']))
        {
            $passed_token = InputFilter($news_infos['t']);
            $is_valid_token_row = $db->get_row("select * from users where app_token = '$passed_token'");
            if(!$is_valid_token_row)
                {return $invalid_token_error_json;}
            
            else
                {
                    $user_id = $is_valid_token_row->UserId;
                    $user_nick_name = $is_valid_token_row->NickName;
                    
                    $is_admin_var = $db->get_var("select AdminId from admins where AdminId = '$user_id'");
                    if($is_admin_var)
                        {
                            $news_urgent = isset($news_infos['u']) && !empty($news_infos['u']) && $news_infos['u'] == 1 ? 1 : 0;
                            $passed_agency = isset($news_infos['a']) && !empty($news_infos['a'])?InputFilter($news_infos['a']):$user_nick_name;
                            $is_valid_agency_var = $db->get_var("select NickName from users as u,groups as g where g.GroupId = u.GroupId and (md5(u.NickName) = '" . md5($passed_agency) . "' or u.NickName = '$user_nick_name') and g.GroupName = 'agencies'");
                            $news_agency = $is_valid_agency_var ? $is_valid_agency_var : $user_nick_name;
                        }
                    else
                        {
                            $news_urgent = 0;
                            $news_agency = $user_nick_name;
                        }
                    $news_active = 1;
                }
        }
    else
        {
            $is_guest = 1;
            foreach($news_infos as $info_name => $info_value)
                {
                    if(!in_array($info_name,$guest_valid_indexes_arr))
                        return $unsufficient_permissions_error_json;
                }
            $user_id = '20070000000';
            $news_urgent = 0;
            $news_agency = "Guest";
            $news_active = 0;
        }
    
    
    $news_id = GenerateID('news', 'IdNews');
    $news_date = date('Y-m-d H:i:s',time());
    $year = date('Y',time());
    $month = date('m',time());
    $day = date('d',time());
    $news_hits = 0;
    $news_deleted = 0;
    
    $passed_news_title = isset($news_infos['ti']) && !empty($news_infos['ti']) ? InputFilter($news_infos['ti']) : mb_substr($news_body,0,150,"utf8");    
    $news_title_full = str_replace(array("\n"),array(" "),$passed_news_title);
    $news_title_to_replace = InputFilter($news_title_full);
    $news_title = str_replace(array(":", "/", "\\", "@","#",'"',"'"), array("", "", "", "","","",""),$news_title_to_replace);
    
    $news_subtitle = "";
    
    $news_full_brief = str_replace(array("<line>"),array(" "),$news_body);
    $news_brief = mb_substr($news_full_brief,0,500,"utf8");
    
    $news_full_message_full = str_replace(array("<line>"),array("<br />"),$news_body);
    $news_full_message = InputFilter($news_full_message_full);
    
    $news_note = "";
    
    $passed_category = isset($news_infos['ca']) && !empty($news_infos['ca'])?InputFilter($news_infos['ca']):"";
    $news_category = !empty($news_infos['ca']) && ($db->get_var("select IdCat from catlang as cl,languages as l where l.IdLang = cl.IdLang and cl.IdCat = '$passed_category' and l.LangName = '$news_language'"))?$passed_category : "20100000000";
    
    $passed_news_images = isset($news_infos['i']) && !empty($news_infos['i'])?InputFilter($news_infos['i']) : "";
    if(isset($news_infos['i']) && !empty($news_infos['i']))
        {
            $passed_news_images_arr = explode('||',$passed_news_images);
            foreach($passed_news_images_arr as $passed_news_image)
                {
                    if(file_exists("../../uploads/gallery/Albums/$year/$day-$month-$year/$passed_news_image"))
                        {$news_images_arr[] = $passed_news_image;}
                }
            
            if(isset($news_images_arr) && is_array($news_images_arr) && count($news_images_arr) > 0)
                {$news_image = $news_images_arr[0];}
            else
                {
                    $news_image = 'newspaper.png';
                    $news_images_arr = array();
                }
        }
    else
        {
            $news_image = 'newspaper.png';
            $news_images_arr = array();
        }
    $insert_news_sql = "insert into news(IdNews,IdUserName,Date,Active,Hits,NewsPic,Deleted,urgent,agency) values ('$news_id','$user_id','$news_date','$news_active','$news_hits','$news_image','$news_deleted','$news_urgent','$news_agency')";
    $insert_news_qu = $db->query($insert_news_sql);

    if($db->dbh->affected_rows > 0)
        {
            if($news_urgent == 1)
                {
                    $marquee_message = str_replace(array(":", "/", "\\", "@",'"',"'"), array("", "", "", "","",""),$news_title);
                    $marquee_title_in_link = mb_substr($marquee_message, 0, 40, "utf8");
                    $marquee_id = GenerateID('marques', 'idMarque');
                    $marquee_link = CreateLink('',array('Prog','ns','idnews','title'),array('news','details',$news_id,$marquee_title_in_link));
                    $marquee_start_date = date('Y-m-d H:i:s',time());
                    $marquee_end_date = date('Y-m-d H:i:s', strtotime("$marquee_start_date +30 hours"));
                    $db->query("insert into marques(idMarque,Link,StartDate,EndDate,Deleted) values('$marquee_id','$marquee_link','$marquee_start_date','$marquee_end_date','0')");
                    $db->query("insert into marqlang(idmarque,idLang,Message) values('$marquee_id','$news_language','$marquee_message')");
                }
            $insert_news_category_sql = "insert into `newscategoies` values('$news_id','$news_category')";
            $insert_news_category_qu = $db->query($insert_news_category_sql);
            //$insert_news_category_sql;
            
            $news_full_message .= '<div id="news_desc_images_wrapper_div">';
            if(count($news_images_arr)>0)//If their is any image uploaded
                {
                    $all_images = '<br />';
                    $counter = 0;
                    foreach($news_images_arr as $news_image)
                        {
                            if($counter == 0)
                                {create_news_thumbs("../../uploads/gallery/Albums/$year/$day-$month-$year/".$news_image, "../../uploads/news/pics/".$news_image, 100);}
                            $extension = pathinfo($news_image, PATHINFO_EXTENSION);
                            $media_id = GenerateID("gallery", 'IdMedia');
                            $media_path = "uploads/gallery/Albums/$year/$day-$month-$year/$news_image";
                            $AddDate = $news_date;
                            $MapLocation = "";
                            $MediaRank = "";
                            $MediaType = $extension;
                            $news_caption = InputFilter($news_title);
                            $Desc = "";
                            $Place = "";
                            $Tags = "";
                            $insert_to_gallery_sql = "insert into gallery(IdMedia,Path,AddDate,MapLocation,MediaRank,MediaType) values ('$media_id','$media_path','$AddDate','$MapLocation','$MediaRank','$MediaType')";
                            $insert_to_gallery_qu = $db->query($insert_to_gallery_sql);
                            $insert_into_gallery_lang_sql = "insert into gallerylang(`IdMedia`,`IdLang`,`Caption`,`Desc`,`Place`,`Tags`) values ('$media_id','$news_language','$news_caption','$Desc','$Place','$Tags')";
                            $insert_into_gallery_lang_qu = $db->query($insert_into_gallery_lang_sql);
                            $all_images .= "<div class=\'news_desc_images\'><img src=\'uploads/gallery/Albums/$year/$day-$month-$year/$news_image\' /></div>";
                            $counter++;
                        }
                }
            $news_full_message .= '</div>';
            
            $insert_news_lang_sql = "insert into newslang(IdLang,IdNews,Tilte,SubTitle,Breif,FullMessage,Note) values ('$news_language','$news_id','$news_title','$news_subtitle','$news_brief','$news_full_message','$news_note')";
            $insert_news_lang_qu = $db->query($insert_news_lang_sql);
            
            if($db->dbh->affected_rows > 0)
                {
                    $db->query("update users set points = points + 1 where UserId = '$user_id'");
                    return json_encode(array("s" => '1',"r" => array("id" => $news_id)));
                }
        }
}

function audit_news($news_infos=array("t" => "","i" => "","u" => ""))
{
    global $db;
    if(empty($db))
        $db = new db();
    
    $invalid_infos_error_json = json_encode(array("s" => '001'));
    $invalid_token_error_json = json_encode(array("s" => '002'));
    $unsufficient_privilege_error_json = json_encode(array("s" => '003'));
    $invalid_news_error_json = json_encode(array("s" => '004'));
    
    $valid_indexes_arr = array("t","i","u");
    
    if(!isset($news_infos['t']) || !is_array($news_infos) || count($news_infos) <= 0 || count($news_infos) > count($valid_indexes_arr) || !isset($news_infos['t']) || empty($news_infos['t']) || !isset($news_infos['i']) || empty($news_infos['i']))
        {return $invalid_infos_error_json;}
    
    $passed_token = InputFilter($news_infos['t']);
    $is_valid_token_var = $db->get_var("select UserId from users where app_token = '$passed_token'");
    
    if(!$is_valid_token_var)
        {return $invalid_token_error_json;}
    else
        {
            $user_id = $is_valid_token_var;
            $is_admin_var = $db->get_var("select AdminId from admins where AdminId = '$user_id'");
            if(!$is_admin_var)
                return $unsufficient_privilege_error_json;
            
            $passed_news_id = InputFilter($news_infos['i']);
            $is_valid_unaudited_news_var = $db->get_var("select IdNews from news where IdNews = '$passed_news_id' and Active = 0");
            if(!$is_valid_unaudited_news_var)
                return $invalid_news_error_json;
            
            $news_id = $passed_news_id;
            
            $urgency = isset($news_infos['u']) && in_array(intval($news_infos['u']),array(0,1,2))?intval($news_infos['u']) : 0;
            
            switch($urgency)
                {
                    case 0:
                        $news_user_id_var = $db->get_var("select IdUserName from news where `IdNews` = '$news_id'");
                        $db->query("update news set Deleted = 1,del_by = '$news_user_id_var' where IdNews = '$news_id'");
                        $db->query("update users set points = points - 1 where UserId = '".$news_id."'");
                        return json_encode(array("s" => '1',"r" => '10'));
                        break;
                    case 1:
                        $db->query("update news set Active = 1,active_by = '$user_id' where IdNews = '$news_id'");
                        return json_encode(array("s" => "11","r" => array("i" => $news_id)));
                        break;
                    case 2:
                        $db->query("update news set Active = 1,urgent = 1,active_by = '$user_id' where IdNews = '$news_id'");
                        $marquee_id = GenerateID('marques', 'idMarque');
                        $marquee_start_date = date('Y-m-d H:i:s',time());
                        $marquee_end_date = date('Y-m-d H:i:s', strtotime("$marquee_start_date +30 hours"));
                        $language_news_inserted_in_rs = $db->get_results("select IdLang,Tilte from news as n,newslang as nl where n.IdNews = nl.IdNews and n.IdNews = '$news_id'");
                        foreach($language_news_inserted_in_rs as $language_news_inserted_in_row)
                        {
                            $marquee_message = str_replace(array(":", "/", "\\", "@",'"',"'","#"), array("", "", "", "","","",""),$language_news_inserted_in_row->Tilte);
                            $marquee_title_in_link = mb_substr($marquee_message, 0, 40, "utf8");
                            $marquee_link = CreateLink('',array('Prog','ns','idnews','title'),array('news','details',$news_id,$marquee_title_in_link));
                            $lang_id = $language_news_inserted_in_row->IdLang;
                            $db->query("insert into marques(idMarque,Link,StartDate,EndDate,Deleted) values('$marquee_id','$marquee_link','$marquee_start_date','$marquee_end_date','0')");
                            $db->query("insert into marqlang(idmarque,idLang,Message) values('$marquee_id','$lang_id','$marquee_message')");
                        }
                        return json_encode(array("s" => "12","r" => array("i" => $news_id)));
                        break;
                }
            
        }
}

function get_unapprooved_news($user_infos = array("t" => "","l" => "","li" => ""))
{
    global $db;
    
    if(empty($db))
        $db = new db();
    
    $invalid_infos_error_json = json_encode(array("s" => '001'));
    $invalid_token_error_json = json_encode(array("s" => '002'));
    $invalid_language_error_json = json_encode(array("s" => '003'));
    $no_unapprooved_news_error_json = json_encode(array("s" => '004'));
    
    $valid_indexes_arr = array("t","l","li");
    
    if(!isset($user_infos) || !is_array($user_infos) || count($user_infos) <= 0 || !isset($user_infos['t']) || !isset($user_infos['l']) || count($user_infos) > count($valid_indexes_arr))
        {return$invalid_infos_error_json;}
    
    $passed_token = isset($user_infos['t']) && !empty($user_infos['t'])?InputFilter($user_infos['t']) : "";
    $is_valid_token_var = $db->get_var("select UserId from users where app_token = '$passed_token'");
    
    
    if($is_valid_token_var)
        {
            $passed_language = isset($user_infos['l']) && !empty($user_infos['l']) ? InputFilter($user_infos['l']) : "";
            $is_valid_language_var = $db->get_var("select IdLang from languages where Deleted != 1 and LangName = '$passed_language'");
            if($is_valid_language_var)
                {
                    $lang_id = $is_valid_language_var;
                    $limit = isset($infos['li']) && intval($infos['li']) > 0 && intval($infos['li']) <= 200 ? intval($infos['li']) : 20;
                    $limited_unapprooved_news_res = $db->get_results("select nl.Tilte as news_title,n.IdNews as news_id from languages as l,news as n,newslang as nl where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.Active != 1 and n.Deleted != 1 and l.IdLang = '$lang_id' Order By `Date` desc limit 0,10 ");
                    if(count($limited_unapprooved_news_res) > 0)
                        {
                            $returned_result = array();
                            foreach($limited_unapprooved_news_res as $unapprooved_news_row)
                                {
                                    $returned_result[] = array("i" => $unapprooved_news_row->news_id,"t" => $unapprooved_news_row->news_title);
                                }
                            return json_encode(array("s" => 1,"r" => $returned_result));
                        }
                    else
                        {return $no_unapprooved_news_error_json;}
                }
            else
                {return $invalid_language_error_json;}
        }
    else
        {return $invalid_token_error_json;}
}

function send_email($email_infos=array("t" => "","to" => "","m" => "","ti" => ""))
{
    global $db;
    
    if(empty($db))
        $db = new db();
    
    $invalid_infos_error_json = json_encode(array("s" => '001'));
    $invalid_token_error_json = json_encode(array("s" => '002'));
    $invalid_reciever_error_json = json_encode(array("s" => '003'));
    $empty_message_error_json = json_encode(array("s" => '004'));
    
    if(!isset($email_infos['t']) || !isset($email_infos['to']) || !isset($email_infos['m']))
        return $invalid_infos_error_json;
    
    if(empty($email_infos['to']) || !check_email_address($email_infos['to']))
        return $invalid_reciever_error_json;
    
    $to = InputFilter($email_infos['to']);
    
    if(empty($email_infos['m']))
        return $empty_message_error_json;
    
    $message = InputFilter($email_infos['m']);
    
    $passed_token = InputFilter($email_infos['t']);
    $is_valid_token_row= $db->get_row("select Concat(UserName,' ',FamNAme) as full_name,UserMail as email from users where app_token = '$passed_token'");
    if(!$is_valid_token_row)
        return $invalid_token_error_json;
    
    $email = $is_valid_token_row->email;
    $full_name = $is_valid_token_row->full_name;
    
    $title = isset($email_infos['ti']) && !empty($email_infos['ti'])?InputFilter($email_infos['ti']) : "";
    
    $mail_phpmailer = new PHPMailer();
    
    $mailed = api_send_email($mail_phpmailer, $email,$full_name, $to, $title, $message,"");
    
    if($mailed)
        return json_encode(array("s" => 1));
    else
        return json_encode(array("s" => 0));
}

function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']) && !empty($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']) && !empty($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']) && !empty($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }



function mobile_login($UserNickName)
    {
        global $db,$WebiteFolder, $CacheEnabled, $MainPrograms, $DefaultLang, $Lang, $PrefLang, $ActiveMessage, $UserId, $GroupId, $TimeFormat,
        $UserName, $NickName, $ParentName, $FamName, $BirthDate, $Sex, $Gmt, $Contry, $Rue,
        $AddDetails, $CodePostal, $ZipCode, $PhoneNbr, $CellNbr, $PassWord, $LastLogin, $LastIP,
        $Hobies, $Job, $Education, $PrefLang, $PrefTime, $CookieLife, $UserPic, $UserMail,
        $UserSite, $Banned, $PrefThem, $UserSign, $Points, $Active, $RegDate, $allowHtml,
        $allowBBcode, $allowSmiles, $allowAvatar, $ThemeName, $AdminFileName, $town;
        $UserNickName;
// Get user info
        $query = " select * from `users` where `NickName`='" . $UserNickName . "' ; ";
        if(empty($db))
            $db = new db();
        $LoginAsUser = $db->get_row($query);

        $UserId = $LoginAsUser->UserId;
        $GroupId = $LoginAsUser->GroupId;
        $UserName = $LoginAsUser->UserName;
        $NickName = $LoginAsUser->NickName;
        $FamName = $LoginAsUser->FamName;
        $CellNbr = $LoginAsUser->CellNbr;
        $LastLogin = $LoginAsUser->LastLogin;
        $LastIP = $LoginAsUser->LastIP;
        $PrefTime = $LoginAsUser->PrefTime;
        $CookieLife = $LoginAsUser->CookieLife;
        $UserPic = $LoginAsUser->UserPic;
        $UserMail = $LoginAsUser->UserMail;
        $RegDate = $LoginAsUser->RegDate;
        $app_token = $LoginAsUser->app_token;
        $TimeFormat = $LoginAsUser->TimeFormat;
        $Gmt = $LoginAsUser->Gmt;
        
        if(!isset($_SESSION['NickName']) || $_SESSION['NickName'] == 'Guest')
            $_SESSION['NickName'] = $NickName;
        
        $_SESSION['app_token'] = $app_token;
        if (empty($UserPic))$UserPic = 'images/avatars/noavatar.gif';

        ini_set('session.use_only_cookies', 1);
        $new_name = session_name();

        if ($NickName != 'Guest')
            {
                if (isset($_SESSION['NickName']))
                    {
                        if (!isset($_SESSION['LastLogin']))
                            {
                                $_SESSION['LastLogin'] = true;
                                $Logtimestamp = strtotime(date($TimeFormat));
                                $LogLastLogin = date($TimeFormat, $Logtimestamp + ($Gmt * 60 * 60));
                                $db->query(" update `users` set `LastLogin`='" . $LogLastLogin . "' where `app_token`='" . $app_token . "' ; ");
                            }
                    }
                $db->query(" update `users` set `PrefLang`='" . $Lang . "' where `UserId`='" . $UserId . "' ; ");
                setcookie("LastSession", session_id(), time() + $CookieLife,"/".$WebiteFolder."/");
                $query = "UPDATE `users` SET `LastSession` = '" . session_id() . "' WHERE `app_token` = '" . $app_token . "' ;";
                $db->query($query);
            }
    }

function api_send_email($mail,$from,$full_name,$to,$title="",$message="",$attachments="")
    {
        global $EmailMethode;
        global $SmtpHost, $SMTPusername, $SMTPpassword, $SmtpPort, $SMTPSecure;
        if (strtolower($EmailMethode) == "smtp")
            {
                $mail->IsSMTP();
                $mail->Host = $SmtpHost;
                $mail->Port = $SmtpPort;
                $mail->SMTPAuth = true;     // turn on SMTP authentication
                $mail->Username = $SMTPusername;
                $mail->Password = $SMTPpassword;
                $mail->SMTPSecure = $SMTPSecure;
            }
        else
            {
                $mail->IsSendmail();
            }//end if
        $mail->From = $from;
        $mail->FromName = $full_name;
        if (is_array($to))
            {
                $mail->AddAddress($to[0], $to[1]);
            }
        else
            {
                $mail->AddAddress($to);
            }//end if

        $mail->IsHTML(true);
        $mail->Subject = $title;
        $mail->Body = $message;

        if ($attachments != "")
            {
                if (is_array($attachments))
                    {
                        $mail->AddAttachment($attachments[0], $attachments[1]);  // optional name
                    }
                else
                    {
                        $mail->AddAttachment($attachments);  // optional name
                    }
            }

        if (!$mail->Send())
            {
                return false;
            }
        else
            {
                return true;
            }//end if
}
?>