<?php
global $default_language,$current_version,$critical_update;
$default_language = "Arabic";
$current_version = 30;
$critical_update = true;
header("Access-Control-Allow-Origin: *");
include_once("../../includes.php");
include_once("../../includes/phpmailer/class.phpmailer.php");
include_once("../../includes/checkValidity.php");
include_once("../../languages/lang-$default_language.php");
include_once("Languages/lang-$default_language.php");
include_once("../../includes/session.php");
include_once("functions.php");
include_once("rating/rate_news.php");
include_once("ads/ads.php");
include_once("news/news.php");
global $method;

if(isset($_REQUEST['method']) && in_array($_REQUEST['method'],array('GET','POST')))
    {
        $method = ($_REQUEST['method']) === 'GET' ? $_GET : $_POST;
    }
else
    {
        $method = $_POST;
    }

//header('Content-Type: text/html; charset=utf-8');
if (!isset($project)){header("location: ../../");}

$result = parse_request();
$response = parse_response($result);
echo $response;
$response = json_decode($response);
function parse_request()
    {
        global $method,$default_language,$current_version,$critical_update;
        $operation = isset($method['op']) && !empty($method['op'])?InputFilter($method['op']) : "";
        switch($operation)
            {
                case 'a'://Audit a news
                    {
                        if(isset($method['i'])) $result_json = audit_news($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'e_n'://Edit news
                    {
                        if(isset($method['i'])) $result_json = edit_news($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'c'://Contact us
                    {
                        if(isset($method['i'])) $result_json = contact_us($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'g'://Get news
                    {
                        if(isset($method['i'])) $result_json = get_news($method['i']);
                        else $result_json = get_news(array(""));
                        break;
                    }
                case 'ga'://Get about
                    {
                        if(isset($method['i'])) $result_json = get_about ($method['i']);
                        else $result_json = get_about (array(""));
                        break;
                    }
                case 'g_a_a'://get all agencies
                    {
                        if(isset($method['i'])) $result_json = get_all_agencies($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'g_a_c'://Get all categories
                    {
                        $result_json = get_all_categories();
                        break;
                    }
                case 'g_a_d'://Get all departments
                    {
                        if(isset($method['i'])) $result_json = get_all_departments($method['i']);
                        else $result_json = get_all_departments (array("l" => $default_language));
                        break;
                    }
                case 'g_l_r'://Get last reporters
                    {
                        $result_json = get_last_reporters();
                        break;
                    }
                case 'g_a_n'://get author news
                    {
                        if(isset($method['i'])) $result_json = get_author_news($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'g_c_n'://Get news for a category
                    {
                        if(isset($method['i'])) $result_json = get_category_news($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'g_n_b_c'://Get news by category
                    {
                        if(isset($method['i'])) $result_json = get_news_by_category($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'g_n_l'://Get news by date
                    {
                        if(isset($method['i'])) $result_json = get_news_by_date($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'g_n_d'://Get details for a news
                    {
                        if(isset($method['i'])) $result_json = get_news_details($method['i']);
                        else $result_json = json_encode(array("s" => '000'));
                        break;
                    }
                case 'g_n_i'://Get infos for a specific a news
                    {
                        if(isset($method['i'])) $result_json = get_news_infos($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'g_v':
                    {
                        if(isset($method['i'])) $result_json = get_app_version($method['i']);
                        else $result_json = json_encode(array("ver" => $current_version,"req" => $critical_update));
                        break;
                    }
                case 'g_u_i'://Get infos for a specific user
                    {
                        if(isset($method['i'])) $result_json = get_user_infos($method['i']);
                        else $result_json = json_encode(array("s" => '1',"i" => "-1"));
                        break;
                    }
                case 'g_s':// get settings for a user
                    {
                        if(isset($method['i'])) $result_json = get_settings($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'g_u'://Get unapprooved news
                    {
                        if(isset($method['i'])) $result_json = get_unapprooved_news ($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'g_u_r_c':
                    {
                        if(isset($method['i'])) $result_json = get_user_rss_channels($method['i']);
                        else $result_json = json_encode(array("s" => '0001'));
                        break;
                    }    
                case 'l'://Login in with a user name and password or an app_token
                    {
                        if(isset($method['i'])) $result_json = sign_in($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'm'://Get more news in a specific category
                    {
                        if(isset($method['i'])) $result_json = get_more_news($method['i']);
                        else $result_json = get_more_news(array(""));
                        break;
                    }
                case 'r'://Rating action
                    {
                        $sub_action = isset($method['a']) && in_array($method['a'],array('set','get'))?$method['a'] : '';
                        if(!empty($sub_action))
                            {
                                if(isset($method['i']))
                                    {
                                        $result_json = perform_rate_action($sub_action,$method['i']);
                                    }
                                else
                                    {
                                        $result_json = json_encode(array('s' => '0001'));
                                    }
                            }
                        else
                            {
                                $result_json = json_encode(array('s' => '000'));
                            }
                        break;
                    }
                case 'n'://Notify users for news has been published or admins for news to be audited
                    {
                        if(isset($method['i'])) $result_json = notify($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }   
                case 's'://Signup a new user
                    {
                        if(isset($method['i'])) $result_json = sign_up($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 's_n'://Insert a news then return a token which is the id of a session array that will care news infos
                    {
                        if(isset($method['i'])) $result_json = send_news($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 's_n_i'://Set a new android or apple id for a specific user
                    {
                        if(isset($method['i'])) $result_json = set_user_google_registration_id($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 's_u_i'://Update infos for a specific users
                    {
                        if(isset($method['i'])) $result_json = set_user_infos($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 's_p_n'://Send a private notification for a specific device
                    {
                        if(isset($method['i'])) $result_json = send_private_notification($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }    
                case 's_s'://Update settings for a specific user
                    {
                        if(isset($method['i'])) $result_json = set_settings($method['i']);
                        else $result_json = set_settings(array(""));
                        break;
                    }
                case 'v'://Return boolean value to tell if a passed token is valid or not
                    {
                        if(isset($method['i'])) $result_json = is_valid_token($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                case 'vu'://Return boolean value to tell if a passed user name is valid or not
                    {
                        if(isset($method['i'])) $result_json = is_valid_user_name($method['i']);
                        else $result_json = json_encode(array("s" => '001'));
                        break;
                    }
                default :
                    {
                        $result_json = json_encode(array("s" => '000'));
                        break;
                    }
            }
        $result = json_decode($result_json);
        return $result;
    }
    
function parse_response($result)
{
    /*
     * global $db;
    if(!empty($db))
        mysqli_close($db->dbh);
     */
    if(is_object($result))
        {
            $returned_array = array();
            foreach(get_object_vars($result) as $property_name => $property_value)
                {
                    $returned_array[$property_name] = $property_value;
                }
            return json_encode($returned_array);
        }
}

function get_app_version($user_infos = array("w" => 0,"h" => 0))
    {
        @session_start();
        global $current_version,$critical_update;
        $_SESSION['screen_width'] = isset($user_infos['w'])?$user_infos['w'] : 0;
        $_SESSION['screen_height'] = isset($user_infos['h'])?$user_infos['h'] : 0;
        return json_encode(array("ver" => $current_version,"req" => $critical_update,"w" => $_SESSION['screen_width'],"h" => $_SESSION['screen_height']));
    }
    
/**
 * Function may be used to get all categories in a specific language
 * @param String l Is the language name we want to fetch categories in
 * @return Json_Object contains 2 properties
 *      s : Status of operation (All times is found)
 *      r : Array of Json_Object that represent agencies each object contain 2 indexes i and n
 *          index i point to the category id
 *          index n point to the category name
 */
function get_all_categories($categories_infos = array("l"))
    {
        global $default_language;
        if(isset($categories_infos['l']))
            {
                $passed_language = InputFilter($categories_infos['l']);
                $language = $db->get_var("select IdLang from languages where LangName = '$passed_language'") ? $passed_language : $default_language;
            }
        else
            {
                $language = $default_language;
            }
            
        global $db;
        if(empty($db))
            $db = new db();
        
        $all_categories_res = $db->get_results("select IdCat as cat_id,CatName as cat_name from languages as l,catlang as cl where l.IdLang = cl.IdLang and l.LangName = '$language' and cl.IdCat != '20140000000' order by `sort`");
        if(count($all_categories_res) > 0)
            {
                $all_categories = array("s" => '1',"r" => array());
                $index = 0;
                foreach($all_categories_res as $category_row)
                    {
                        $all_categories['r'][$index] = array("i" => $category_row->cat_id,"n" => $category_row->cat_name);
                        $index ++;
                    }
                return json_encode($all_categories);
            }
        else
            {
                return json_encode(array("s" => '001'));
            }
    }

/**
 * Function may be used to get all agencies
 * @param String t The token of current user (to specify if is admin or not)
 * @return Json_Object contains 2 properties
 *      s : Status of operation (All times is found)
 *      r : Array of Json_Object that represent agencies each object contain 2 indexes i and n
 *          index i point to the agency id
 *          index n point to the agency name
*/
function get_all_agencies($user_infos = array("t"))
    {      
        if(!isset($user_infos['t']))
            {
                return json_encode(array('s' => '001'));
            }
            
        global $db;
        if(empty($db))
            $db = new db();
        
        $passed_token = InputFilter($user_infos['t']);
        
        $is_valid_token_row = $db->get_row("select UserId,concat(UserName,' ',FamName) as full_name,NickName from users where app_token = '$passed_token'");
        
        if(!$is_valid_token_row)
            {
                return json_encode(array('s' => '002'));
            }
        
        $user_id = $is_valid_token_row->UserId;
        
        $is_admin_var = $db->get_var("select AdminId from admins where AdminId = '$user_id'");
        
        if(!$is_admin_var)
            {
                return json_encode(array('s' => '003'));
            }
        
        $all_agencies = array("s" => '1',"r" => array());
        
        $all_agencies['r'][0] = array("i" => $is_valid_token_row->NickName,"n" => $is_valid_token_row->full_name);
        
        $all_agencies_res = $db->get_results("select concat(UserName,' ',FamName) as full_name,NickName from users as u,groups as g where g.GroupId = u.GroupId and g.GroupName = 'agencies' ORDER BY FIELD(UserId, '20140000018')desc ;");
        if(count($all_agencies_res) > 0)
            {
                $index = 1;
                foreach($all_agencies_res as $agency_row)
                    {
                        $all_agencies['r'][$index] = array("i" => $agency_row->NickName,"n" => $agency_row->full_name);
                        $index ++;
                    }
                return json_encode($all_agencies);
            }
        else
            {
                return json_encode($all_agencies);
            }
    }
    
/** Function that will validate passed token and return a json object
* @param t : Token to validate
* @param u : Generate new token and update it on users table(optional)
* @param g : Gather user infos and return infos in index i(optiona)
* @return Json_Object contains 2 properties 
*       s : which contains validation status (All times is found)
*       t : which contains token in the case of token validity
*/
function is_valid_token($user_infos = array("t","u","g"))
    {
        global $db;
        if(empty($db))
            $db = new db();
        
        if(!isset($user_infos['t']))
            return(json_encode(array("s" => '001')));
        else
            {
                $passed_token = InputFilter($user_infos['t']);
                $is_valid_token_row = $db->get_row("select CellNbr as cell_number,Contry as user_country,app_token,UserId as user_id,NickName as nick_name,UserPic as user_pic,Points as user_points,UserMail as email,concat(UserName,' ',FamName) as full_name from users where app_token = '$passed_token'");
                if($is_valid_token_row)
                    {
                        $user_id = $is_valid_token_row->user_id;
                        $nick_name = $is_valid_token_row->nick_name;
                        $email = $is_valid_token_row->email;
                        $old_token = $is_valid_token_row->app_token;
                        $is_admin_var = $db->get_var("select AdminId from admins where AdminId = '$user_id'");
                        $is_admin = $is_admin_var ? '1' : '0';
                        if(isset($user_infos['g']))
                            {
                                $cell_number = $is_valid_token_row->cell_number;
                                $full_name = $is_valid_token_row->full_name;
                                $user_pic = $is_valid_token_row->user_pic;
                                $user_points = $is_valid_token_row->user_points;
                                $user_country = $is_valid_token_row->user_country;
                                $infos_arr = array("c" => $cell_number,"co" => $user_country,"e" => $email,"f" => $full_name,"i" => $user_id,"n" => $nick_name,"p" => $user_pic,"pt" => $user_points);
                            }
                        else
                            {
                                $infos_arr = "-1";
                            }
                        if(isset($user_infos['u']))
                            {
                                $new_token = md5($nick_name . time().strrev($email));
                                $new_token_qu = $db->query("update users set app_token = '$new_token' where UserId = '$user_id'");
                                $_SESSION['user_token'] = $new_token;
                                return(json_encode(array("s" => '1',"t" => $new_token,"u" => $user_id,"p" => $is_admin,"i" => $infos_arr)));
                            }
                        else
                            {
                                $_SESSION['user_token'] = $old_token;
                                return(json_encode(array("s" => '1',"t" => $old_token,"u" => $user_id,"p" => $is_admin,"i" => $infos_arr)));
                            }
                    }
                else
                    return(json_encode(array("s" => '002')));
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
    - String 'g' provide a gender to the registered user
    - String 'c' provide a country to the registered user
    - String 'f' provide the full name of the registered user
    - String 'e' provide the email of registered user
    - String 'ph' provide the cell number of the registered user
    - String 'u' provide the uuid of movile device
    - String 'a' provide the android google id of mobile device
    - String 'ap' provide the apple notification id of mobile device
 * 
 * @return json return a jsonified array that will present the success of the registration or its failure by the index 's'
 * with the apptoken in case of success by the index 't'
 */
function sign_up($user_infos = array("n" => "","p" => "","g" => "","c" => "","f" => "","e" => "","ph" => "","u" => "","a" => "","ap" => ""))
{
    global $db,$GeoIpService,$IpNbr,$AdminRegOk,$AdminMail, $WebSiteName,$default_language;
    
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
    $valid_indexes_arr = array("n","p","g","c","f","e","ph","u","a","ap");
    $optional_indexes_arr = array("g","u","a","ap");
    
    // Propose that all infos are valid
    $infos_validity_arr = array("n" => 1,"p" => 1,"g" => 1,"c" => 1,"f" => 1,"e" => 1,"ph" => 1,"u" => 1,"a" => 1,"ap" => 1);
    
    //if the user infos is empty or not a valid array or its count is not equal to our supposed array
    if(empty($user_infos) || !is_array($user_infos) || count($user_infos) <= 0 || count($user_infos) > count($valid_indexes_arr))
        {return($invalid_infos_form_json);}
    
    //test each info validity
    $index = 0;
    foreach($user_infos as $info_name => $info_value)
        {
            if(!in_array($info_name,$valid_indexes_arr))
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
    global $nick_name;
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
    $gmt = '+2';//
    $gender = $user_infos['g'] == 1?1 : 0;
    $country = isset($user_infos['c'])?InputFilter($user_infos['c']) : get_country();
    $phone_number = "";
    $cell_number = $user_infos['ph'];
    $password = md5($user_infos['p']);
    $last_login = date("Y-m-d H:i:s");
    $last_ip = get_client_ip();
    $hobies = '';
    $job = '';
    $education = '';
    $pref_lang = $default_language;//
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
            . "('$user_id','$group_id','$time_format','$user_name','$nick_name','$parent_name','$family_name','$birth_date','$gender','$gmt','$country','','$cell_number','$password','$last_login','$last_ip','$hobies','$job','$education','$pref_lang','$pref_time','$cookie_life','$user_pic','$email','$user_site',0,'$pref_theme','$user_sign','$points','$active','$reg_date','$allow_html','$allow_bb_code','$allow_smiles','$allow_avatar','$confirm_code','$mailed','$deleted','$last_session','$android_id','$apple_id','$uuid','$app_token')";
    
    $register_user_qu = $db->query($register_user_sql);
    
    if($AdminRegOk != "1")
        {
            //mkdir('../../uploads/users/'.$nick_name."/",0755,true);
            $url_variables = array("Prog", "acnt", "actvcode", "user");
            $url_values = array("account", "activate", $confirm_code, $nick_name);
            
            $activation_link = "";//CreateLink("", $url_variables, $url_values);
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
    if(file_exists("../../uploads/users/".$uuid."/"))
        {
            @rename("../../uploads/users/".$uuid."/", "../../uploads/users/".$nick_name);
        }
    $user_pictures = glob("../../uploads/users/$nick_name/avatar*");
    if(is_array($user_pictures))
        {
            global $current_extension;
            $current_extension = "";
            array_walk($user_pictures, function ($user_picture)
                                            {
                                                global $db,$nick_name;
                                                $extension_arr = explode('.',$user_picture);
                                                if(is_array($extension_arr) && count($extension_arr) > 1)
                                                    $current_extension = end($extension_arr);
                                                else
                                                    $current_extension = $extension_arr[0];
                                                $db->query("update users set UserPic = 'uploads/users/".$nick_name."/avatar_128.".$current_extension."' where NickName = '$nick_name'");
                                                return 0;
                                            });
        }
    $all_categories_res = $db->get_results("select IdCat from catlang");
    foreach($all_categories_res as $category_row)
        {
            $category_id = $category_row->IdCat;
            $db->query("insert into notification(id_user,id_news_group,only_urgent) values('$user_id','$category_id','0')");
        }
    $is_already_registered_with_notification = $db->get_var("select Id from cyberapp where uuid = '$uuid'");
    if($is_already_registered_with_notification)
        {
            $db->query("delete from cyberapp where Id = '$is_already_registered_with_notification'");
        }
    return json_encode(array("s" => 1,"t" => $app_token));
}

/**
 * Login user using user name and password
 * return 1 as index s on success or return status_error as index s on failure
 *  
 * @author Mouhammad Zein Eddine <mohammad@phptransformer.com>
 * @param associative_array $user_infos contain following indexes
    - String 't' provide token for already registered used (in case a token is passed user name and password will not validated and just the token will)
    - String 'u' provide a unique nickname for the registered user
    - String 'p' provide a password to the registered user
    - String 'd' provide device id to the registered user
 * 
 * @return Json_Object that will contain following property
 *              - String 's' represent the status of login process (invalid nickname - invalid token ....) as status number
 *         And may contain following property
 *              - String 't' represent the token of user logged in
 *              - String 'p' represent the type of user ('1' = admin,'0' = User)
 *              - Json_object 'i' represent user infos retrieved using the function get_user_infos @see get_user_infos
 */
function sign_in($user_infos = array("t" => "","u" => "","p" => "","d" => ""))
{
    global $db;
    
    if(empty($db))
        $db = new db();
        
    $empty_error_json = json_encode(array("s" => '001'));//in case that their were any empty element in the passed array
    $invalid_infos_form_json = json_encode(array("s" => '002'));//in case that array passed is empty or is not array
    $invalid_user_error_json = json_encode(array("s" => '003'));//in case that the provided infos are not valid or user not found
    $malformed_error_json = json_encode(array("s" => '004'));//in case of malformed parameters either not in same order or invalid indexed element used
    
    $valid_indexes_arr = array("t","u","p","d");
    $infos_validity_arr = array("t" => 1,"u" => 1,"p" => 1,"d" => 1);
    
    if(empty($user_infos) || !is_array($user_infos) || count($user_infos) <= 0 || count($user_infos) > count($valid_indexes_arr))
        return($invalid_infos_form_json);
    
    $index = 0;
    foreach($user_infos as $info_name => $info_value)
        {
            if(!in_array($info_name,$valid_indexes_arr))
                return($malformed_error_json);
                
            // If it is not valid set the convenable index to 0
            $index ++;
        }
    if(!isset($user_infos['t']))
        {
            if(!isset($user_infos['u']) || !isset($user_infos['p']) || !isset($user_infos['d']))
                {
                    return json_encode(array("s" => '001',"v" => array("t" => '-1',"u" => "0","p" => "0","d" => "0")));
                }
        }
        
    if(isset($user_infos['t']))
        {
            $passed_device_id = InputFilter($user_infos['d']);
            $user_token = InputFilter($user_infos['t']);
            $already_user_row = $db->get_row("select UserId,UserMail,NickName,app_token from users where `app_token` = '$user_token' and uuid = '$passed_device_id'");
        }
    else if(isset($user_infos['u']) && isset($user_infos['p']) && isset($user_infos['d']))
        {
            $passed_device_id = InputFilter($user_infos['d']);
            $passed_nick_name = InputFilter($user_infos['u']);
            $passed_password = md5(InputFilter($user_infos['p']));
            $already_user_row = $db->get_row("select UserId,UserMail,NickName,app_token from users where NickName = '$passed_nick_name' and Password = '$passed_password'");
        }
    else
        {
            return $malformed_error_json;
        }
    if(is_object($already_user_row))
        {
            $user_id = $already_user_row->UserId;
            $old_token = $already_user_row->app_token;
            $new_token = md5($already_user_row->NickName . time().strrev($already_user_row->UserMail));
            $new_token_qu = $db->query("update users set app_token = '$new_token',uuid = '$passed_device_id' where UserId = '$user_id'");
            $db->query("delete from cyberapp where uuid = '$passed_device_id'");
            $privilege_var = $db->get_var("select AdminId from admins where AdminId = '$user_id'");
            $privilege = $privilege_var ? '1' : '0';
            
            $infos_arr = get_user_infos(array("t" => $new_token));
            /*$is_valid_token_row = $db->get_row("select CellNbr as cell_number,Contry as user_country,app_token,UserId as user_id,NickName as nick_name,UserPic as user_pic,Points as user_points,UserMail as email,concat(UserName,' ',FamName) as full_name from users where app_token = '$new_token'");
            $nick_name = $is_valid_token_row->nick_name;
            $email = $is_valid_token_row->email;
            $cell_number = $is_valid_token_row->cell_number;
            $full_name = $is_valid_token_row->full_name;
            $user_pic = $is_valid_token_row->user_pic;
            $user_points = $is_valid_token_row->user_points;
            $user_country = $is_valid_token_row->user_country;
            $infos_arr = array("c" => $cell_number,"co" => $user_country,"e" => $email,"f" => $full_name,"i" => $user_id,"n" => $nick_name,"p" => $user_pic,"pt" => $user_points);*/
            
            mobile_login($already_user_row->NickName);
            
            return json_encode(array("s" => '1',"t" => $new_token,"p" => $privilege,"i" => $infos_arr));
        }
    else
        return $invalid_user_error_json;
}

/**
 * This function is called from inside another api function and not called directly by an api call
 * This function will  return an array that represent infos of specific news
 * @param type $results_res This is the reult object to fetch that represent infos for a specific news
 * @param type $language Language to fetch news infos in
 * @return type An array that represent the infos of news
 */
function retrieve_news_in_list_details($results_res,$language)
    {
        global $db;
        if(empty($db))
            $db = new db();
        $news = $results_res;
        $news_id = $news->IdNews;
        $news_sql = "select * from languages as l,news as n,newslang as nl where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and l.LangName = '$language' and n.IdNews = '$news_id'";
        $news_row = $db->get_row($news_sql);
        $news_is_urgent = $news_row->urgent;
        $news_date = $news->Date;
        $news_agency = $news->agency;
        $news_author_id = $news->IdUserName;
        $news_author_name = $db->get_var("select concat(UserName,' ',FamName) from users where UserId = '$news_author_id'");
        $news_pic = $news_row->NewsPic;
        $news_title = $news_row->Tilte;

        $latest_id = $news_id;
        $last_news_date = $news_date;

        $social_date = socialDateDif(strtotime(date("Y-m-d H:i:s")), strtotime($news_date), true);

        $agency_pic_big = $db->get_var("select UserPic from users where NickName = '".$news_agency."'");
        $agency_pic = str_replace(array('128'),array('32'),$agency_pic_big);

        $author_pic_big = $db->get_var("select UserPic from users where NickName = '".$news_author_id."'");
        $author_pic = str_replace(array('128'),array('32'),$author_pic_big);

        $mobile_news_pic = str_replace('.','_320.',$news_pic);
        if(file_exists("../../uploads/news/pics/".$mobile_news_pic))
            {
                $news_pic = $mobile_news_pic;
            }
        return(array("latest_id" => $latest_id,"last_news_date" => $last_news_date,"details" =>  array("type" => "news","id" => $news_id,"pic" => $news_pic ,"title" => $news_title,"date" => $news_date,"social_date" => $social_date,"urgent" => $news_is_urgent,"agency" => $agency_pic,"agency_name" => $news_agency,"author" => $author_pic,"author_id" => $news_author_id,"author_name" => $news_author_name)));
    }
    

/**
 * @deprecated since version 1.0.1
 * Get last n news order by order using language for each category or for specific category if index c found
 * @param String $l Language of retrieved news
 * @param String $t Token of the user
 * @param String $o Order of news
 * @param String $li count of news each time to get (n news = li news)
 * @param String $c category_id the category we want to get the last n news(if omitted all categories will be fetched)
 * @param String $ln get last news or by categories
 * @param String $u urgent news only or all news
 * @param String $a author_id the id of an author we want to fetch all news related to them
 * 
 * @return jsonified_array with index s = 1 and index r that contain all news appropriate to our selection if news found
 * or index s = status_error if no news found or user pass an invalid token
 */
function get_news($categories_infos = array('l'=> '','t' => '','o' => '','li' => '','c' => '','ln' => '','u' => '','a' => ''))
    {
        global $db,$default_language;
        if(empty($db))
            {$db = new db();}
        
        $no_news_found_error_json = json_encode(array("s" => '001'));//in case of their were no news
        $invalid_token_error_json = json_encode(array("s" => '002'));//in case of invalid token passed
        $invalid_infos_form_json = json_encode(array("s" => '003'));//in case an invalid array passed to this function as $user_infos
        $malformed_error_json = json_encode(array("s" => '004'));//in case of malformed parameters either not in same order or invalid indexed element used
    
        //create an array that will contains our indexes to prevent sending array with any other infos
        $valid_indexes_arr = array("l","t","o","li","c","ln","u","a");
        
        //Create an array that will contains our optional indexes to skip when any of element are empty
        $optional_indexes_arr = array("l","t","o","li","c","ln","u","a");
        
        //Create an array that will contains our default values that will be used when any infos is empty
        $default_values_arr = array("l" => $default_language,"t" => "","o" => "desc","li" => 5,"c" => "","ln" => 1,"u" => 0,"a" => "");
    
        // Propose that all infos are valid
        $infos_validity_arr = array("l" => 1,"t" => 1,"o" => 1,"li" => 1,"c" => 1,"ln" => 1,"u" => 1,"a" => 1);
    
        //if the user infos is empty or not a valid array or its count is not equal to our supposed array
        if(empty($categories_infos) || !is_array($categories_infos) || count($categories_infos) <= 0 || count($categories_infos) > count($valid_indexes_arr))
            {
                $categories_infos = $default_values_arr;
            }
        //test each info validity
        $index = 0;
        foreach($categories_infos as $info_name => $info_value)
            {
                if(!in_array($info_name,$valid_indexes_arr))
                    {
                        return($malformed_error_json);
                    }
                
                // If it is not valid set the convenable index to 0
                if(!in_array($info_name, $optional_indexes_arr) && (empty($info_value) || strlen(trim($info_value)) == 0))
                    {
                        $infos_validity_arr[$info_name] = 0;
                    }
                else
                    {
                        if((empty($info_value) || strlen(trim($info_value)) == 0))
                            {
                                $categories_infos[$info_name] = $default_values_arr[$info_name];
                            }
                    }
                $index ++;
            }
        
        $language = isset($categories_infos['l']) && ($db->get_var("select LangName from languages where LangName = '".InputFilter($categories_infos['l'])."'"))? InputFilter($categories_infos['l']) : $default_language;
        $order = isset($categories_infos['o']) && in_array(InputFilter($categories_infos['o']),array('asc','desc'))? InputFilter($categories_infos['o']) : 'desc';
        $cat_id = isset($categories_infos['c']) && !empty($categories_infos['c']) && ($db->get_var("select IdCat from catlang where IdCat = '".InputFilter($categories_infos['c']."'")))? InputFilter($categories_infos['c']) : "";// Get news for specific category or for all categories
        $token = isset($categories_infos['t']) ? InputFilter($categories_infos['t']) : "";// Token of user to know if we want to get news suitable to user settings or all news
        $last_news = isset($categories_infos['ln']) && $categories_infos['ln'] == '1' ? 1 : 0;// Get news by last news
        $just_urgent_news = isset($categories_infos['u']) && $categories_infos['u'] == '1' ? 1 : 0;// Get just urgent news
        // If not empty so we are getting news for a specific author
        $author_news = isset($categories_infos['a']) && !empty($categories_infos['a']) && ($db->get_var("select UserId from users where UserId = '".InputFilter($categories_infos['a'])."'")) ? InputFilter($categories_infos['a']) : "";
        $limit = ($last_news == 1)?10 : (!empty($cat_id)?10 : 3);// count of news we want to retrieve each time
        $user_choice = 0;
        $for_days = 4;
        $urgent_sql = "";

        if($last_news == 1)// Get last news
            {
                if($just_urgent_news == 1)//Just get urgent news
                    {
                        $urgent_sql = " and n.urgent = 1";
                    }
                $categories_to_fetch_sql = "select * from news as n,newslang as nl,languages as l where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.Active = 1 and n.Deleted != 1 and  n.`Date` > DATE_SUB(NOW(), INTERVAL " . $for_days . " DAY) $urgent_sql order by n.IdNews desc,n.`Date` desc limit 0,$limit";
            }
        else if(!empty($author_news))// Get news for specific author
            {
                if($just_urgent_news == 1)//Just get urgent news
                    {
                        $urgent_sql = " and n.urgent = 1";
                    }
                $categories_to_fetch_sql = "select * from news as n,newslang as nl,languages as l where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.Active = 1 and n.Deleted != 1 and n.IdUserName = '$author_news'$urgent_sql order by n.IdNews desc,n.`Date` desc limit 0,$limit";
            }
        else if(!empty($cat_id))// Get news for specific category
            {
                if($token == "")
                    {
                        if($just_urgent_news == 1)
                            {
                                $urgent_sql = " and n.urgent = 1";
                            }
                    }
                else
                    {
                        $is_valid_token_var = $db->get_var("select UserId from users where app_token = '$token'");
                        if($is_valid_token_var)
                            {
                                $is_subscribed_cat_var = $db->get_row("select only_urgent from news_subscription where user_id = '$is_valid_token_var' and cat_id = '$cat_id'");
                                if($is_subscribed_cat_var)
                                    {
                                        if($is_subscribed_cat_var === 1)
                                            {
                                                $urgent_sql = " and n.urgent = 1";
                                            }
                                    }
                                else
                                    {
                                        if($just_urgent_news == 1)
                                            {
                                                $urgent_sql = " and n.urgent = 1";
                                            }
                                    }
                            }
                        else
                            {
                                if($just_urgent_news == 1)
                                    {
                                        $urgent_sql = " and n.urgent = 1";
                                    }
                            }
                    }
                $categories_to_fetch_sql = "select cl.IdCat,cl.CatName from languages as l,catlang as cl where l.IdLang = cl.IdLang and l.LangName = '$language' and cl.IdCat = '$cat_id' and cl.Deleted != 1 order by cl.`sort` $order";
            }
        else// Get all news sorted by category
            {
                if(!empty($token))//If their were any token validate token if is valid get categories due user settings
                    {
                        // Query to select all categories
                        $categories_to_fetch_sql = "select cl.IdCat,cl.CatName from languages as l,catlang as cl where l.IdLang = cl.IdLang and l.LangName = '$language' and cl.Deleted != 1 order by cl.`sort` $order";
                        // Validate token
                        $valid_token_var = $db->get_var("select UserId from users where app_token = '$token'");
                        // If is valid token so switch query to a query that will get categories due user settings
                        if($valid_token_var)
                            {
                                // Query to select categories that user is subscribed to
                                $user_categories_sql = "select cl.IdCat,cl.CatName,ns.only_urgent from languages as l,catlang as cl,news_subscription as ns where l.IdLang = cl.IdLang and cl.Deleted != 1 and cl.IdCat = ns.cat_id and l.LangName = '$language' and ns.user_id ='$valid_token_var' order by cl.`sort` $order";
                                // Calculate the count of categories selected
                                $count_of_user_categories_var = $db->get_var("select count(*) from languages as l,catlang as cl,news_subscription as ns where l.IdLang = cl.IdLang and cl.Deleted != 1 and cl.IdCat = ns.cat_id and l.LangName = '$language' and ns.user_id ='$valid_token_var' order by cl.`sort` $order");
                                if($count_of_user_categories_var > 0)
                                    {
                                        $user_choice = 1;
                                        $categories_to_fetch_sql = $user_categories_sql;
                                    }
                                else
                                    {
                                        if($just_urgent_news == 1)
                                            {
                                                $urgent_sql = " and n.urgent = 1";
                                            }
                                    }
                            }
                        else
                            {
                                if($just_urgent_news == 1)
                                    {
                                        $urgent_sql = " and n.urgent = 1";
                                    }
                            }
                    }
                else// If no token is found so get all categories
                    {
                        if($just_urgent_news == 1)
                            {
                                $urgent_sql = " and n.urgent = 1";
                            }
                        // Query to select all categories
                        $categories_to_fetch_sql = "select cl.IdCat,cl.CatName from languages as l,catlang as cl where l.IdLang = cl.IdLang and l.LangName = '$language' and cl.Deleted != 1 order by cl.`sort` $order";
                    }
            }
        
        $results_res = $db->get_results($categories_to_fetch_sql);
        
        if($results_res && count($results_res) > 0)
            {
                $result = array("result" => array());
                $latest_id = "";
                
                if($last_news == 1 || !empty($author_news))//Retrieve news details for last news or for author news or specific category
                    {
                        if($last_news == 1)
                            $result["result"][] = array("type" => "category","id" => '903930' ,"title" => api_last_news);
                        else
                            {
                                $author_name_var = $db->get_var("select concat(UserName,' ',FamName) as full_name from users where UserId = '$author_news'");
                                $result["result"][] = array("type" => "category","id" => '903930' ,"title" => api_author_news . $author_name_var);
                            }
                        foreach($results_res as $news)
                            {
                                $news_array = retrieve_news_in_list_details($news,$language);
                                $latest_id = $news_array['latest_id'];
                                $last_news_date = $news_array['last_news_date'];
                                $result["result"][] = $news_array['details'];
                            }
                            
                        if(!empty($author_news))// Query to calculate if their were any more news for the same author to fetch in next request from the server
                            $have_more_news_sql = "select count(*) from news as n where n.`Date` <= '$last_news_date' and n.Active = 1 and n.Deleted != 1 and n.`IdNews` != '$latest_id' and n.IdUserName = '$author_news'" . $urgent_sql ." order by n.Date Desc,n.IdNews desc";
                        else if(!empty($cat_id))// Query to calculate if their were any more news in same category to fetch in next request from the server
                            $have_more_news_sql = "select count(*) from news as n,newscategoies as nc where n.IdNews = nc.IdNews and nc.IdCat = '$cat_id' and n.`Date` <= '$last_news_date' and n.Active = 1 and n.Deleted != 1 and n.`IdNews` != '$latest_id'" . $urgent_sql ." order by n.Date desc,n.IdNews desc";
                        else// Query to calculate if their were any more last news to fetch in next request from the server
                            $have_more_news_sql = "select count(*) from news as n where n.`Date` <= '$last_news_date' and n.Active = 1 and n.Deleted != 1 and n.`IdNews` != '$latest_id'" . $urgent_sql ." order by n.Date Desc,n.IdNews desc";
                        
                        $have_more_news_var = $db->get_var($have_more_news_sql);
                        
                        if($have_more_news_var > 0)
                            {
                                if(!empty($author_news))
                                    $result["result"][] = array("type" => "more","id" => $latest_id,"author" => $author_news,"title" => api_get_news_more,"urgent" => $just_urgent_news);
                                else if(!empty($cat_id))
                                    $result["result"][] = array("type" => "more","id" => $latest_id,"cat" => $cat_id,"title" => api_get_news_more,"urgent" => $just_urgent_news);
                                else
                                    $result["result"][] = array("type" => "more","id" => $latest_id,"cat" => 'all',"title" => api_get_news_more,"urgent" => $just_urgent_news);
                            }
                        else
                            {
                                $result["result"][] = array("type" => "more","id" => -1);
                            }
                    }
                else
                    {
                        foreach($results_res as $category)
                            {
                                $cat_id = $category->IdCat;
                                if($user_choice == 1)
                                    {
                                        if($category->only_urgent == 1)
                                            {
                                                $urgent_sql = " and n.urgent = 1";
                                            }
                                    }
                                    
                                $news_sql = "select * from languages as l,news as n,newslang as nl,newscategoies as nc where l.IdLang = nl.IdLang and n.IdNews = nc.IdNews and n.IdNews = nl.IdNews and n.Active = 1 and n.Deleted != 1 and nc.IdCat = '$cat_id' and l.LangName = '$language'" . $urgent_sql ." order by n.Date desc,n.IdNews desc limit 0,$limit";

                                $news_res = $db->get_results($news_sql);
                                $latest_id = "";
                                if($news_res && count($news_res) > 0)
                                    {
                                        $result["result"][] = array("type" => "category","id" => $category->IdCat ,"title" => $category->CatName);
                                        foreach($news_res as $news)
                                            {
                                                $news_array = retrieve_news_in_list_details($news,$language);
                                                $latest_id = $news_array['latest_id'];
                                                $last_news_date = $news_array['last_news_date'];
                                                $result["result"][] = $news_array['details'];
                                            }
                                        $have_more_news_sql = "select count(*) from news as n,newscategoies as nc where n.IdNews = nc.IdNews and nc.IdCat = '$cat_id' and n.`Date` <= '$last_news_date' and n.Active = 1 and n.Deleted != 1 and n.`IdNews` != '$latest_id'" . $urgent_sql ." order by n.Date desc,n.IdNews desc";
                                        $have_more_news_var = $db->get_var($have_more_news_sql);

                                        if($have_more_news_var > 0)
                                            {
                                                if($user_choice == 1)
                                                    $result["result"][] = array("type" => "more","id" => $latest_id,"cat" => $cat_id,"title" => api_get_news_more,"urgent" => $category->only_urgent);
                                                else
                                                    $result["result"][] = array("type" => "more","id" => $latest_id,"cat" => $cat_id,"title" => api_get_news_more,"urgent" => $just_urgent_news);
                                            }
                                        else
                                            {$result["result"][] = array("type" => "more","id" => -1);}
                                    }
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
        {
            return $no_news_found_error_json;
        }
    }

/**
 * @deprecated since version 1.0.1
 * This function was used to retrieve more news for a specific category will specific limit after a speicif news where date is less than a specific date
 * @param type $categories_infos
 * @return type
 */
function get_more_news($categories_infos = array('l'=> '','o' => '','li' => '','c' => '','ld' => '','lid' => '','t' => '','u' => '','ln' => '','a' => ''))
    {
        global $db,$default_language;
        if(empty($db)){$db = new db();}
    
        $malformed_error_json = json_encode(array("s" => '001'));
        $invalid_infos_form_json = json_encode(array("s" => '002'));
        $invalid_category_error_json = json_encode(array("s" => '003'));
        $no_news_found_error_json = json_encode(array("s" => '004'));
    
        //create an array that will contains our indexes to prevent sending array with any other infos
        $valid_indexes_arr = array("l","o","li","c","ld","lid","t","u","ln","a");
        
        //Create an array that will contains our optional indexes to skip when any of element are empty
        $optional_indexes_arr = array("l","o","li","t","u","ln","a");
        
        //Create an array that will contains our default values that will be used when any infos is empty
        $default_values_arr = array("l" => $default_language,"o" => "desc","li" => 5,"c" => "","ld" => "","lid" => "","t" => "","u" => "","ln" => 0,"a" => "");
    
        // Propose that all infos are valid
        $infos_validity_arr = array("l" => 1,"o" => 1,"li" => 1,"c" => 1,"ld" => 1,"lid" => 1,"t" => 1,"u" => 1,"ln" => 1,"a" => 1);
    
        //if the user infos is empty or not a valid array or its count is not equal to our supposed array
        if(empty($categories_infos) || !is_array($categories_infos) || count($categories_infos) <= 0)
            {
                $categories_infos = $default_values_arr;
            }
            
        //test each info validity
        $index = 0;
        foreach($categories_infos as $info_name => $info_value)
            {
                if(!in_array($info_name,$valid_indexes_arr))
                    {
                        return($malformed_error_json);
                    }

                // If it is not valid set the convenable index to 0
                if(!in_array($info_name, $optional_indexes_arr) && (empty($info_value) || strlen(trim($info_value)) == 0))
                    {
                        $infos_validity_arr[$info_name] = 0;
                    }
                else
                    {
                        if((empty($info_value) || strlen(trim($info_value)) == 0))
                            {
                                $categories_infos[$info_name] = $default_values_arr[$info_name];
                            }
                    }
                $index ++;
            }
        
        $language = isset($categories_infos['l']) && ($db->get_var("select LangName from languages where LangName = '".InputFilter($categories_infos['l'])."'"))? InputFilter($categories_infos['l']) : $default_language;
        $order = isset($categories_infos['o']) && in_array(InputFilter($categories_infos['o']),array('asc','desc'))? InputFilter($categories_infos['o']) : 'desc';
        $cat_id = isset($categories_infos['c']) && !empty($categories_infos['c']) && ($db->get_var("select IdCat from catlang where IdCat = '".InputFilter($categories_infos['c']."'")))? InputFilter($categories_infos['c']) : "";// Get news for specific category or for all categories
        $token = isset($categories_infos['t']) ? InputFilter($categories_infos['t']) : "";// Token of user to know if we want to get news suitable to user settings or all news
        $last_news = isset($categories_infos['ln']) && $categories_infos['ln'] == '1' ? 1 : 0;// Get news by last news
        $just_urgent_news = isset($categories_infos['u']) && $categories_infos['u'] == '1' ? 1 : 0;// Get just urgent news
        // If not empty so we are getting news for a specific author
        $author_news = isset($categories_infos['a']) && !empty($categories_infos['a']) && ($db->get_var("select UserId from users where UserId = '".InputFilter($categories_infos['a'])."'")) ? InputFilter($categories_infos['a']) : "";
        $author_name = "";
        if(!empty($author_news))
        {
            $author_name = $db->get_var("select concat(UserName,' ',FamName) as full_name from users where UserId = '$author_news'");
        }
        $limit = ($last_news == 1)?10 : (!empty($cat_id)?10 : 3);// count of news we want to retrieve each time
        $user_choice = 0;
        $for_days = 4;
        $urgent_sql = "";
        $last_date = InputFilter($categories_infos['ld']);
        $last_id = InputFilter($categories_infos['lid']);
        
        $last_news_date = "";
        $latest_id = "";
        $is_valid_token_var = $db->get_var("select UserId from users where app_token = '$token'");
        if($last_news == 1 || !empty($author_news))
            {
                if($just_urgent_news == 1)
                    $urgent_sql = " and n.urgent = 1";
                $valid_category_row = true;
            }
        else if(!empty($cat_id))
            {
                if($is_valid_token_var)
                    {
                        $is_subscribed_var = $db->get_var("select only_urgent from news_subscription where user_id = '$is_valid_token_var' and cat_id = '$cat_id'");
                        if($is_subscribed_var)
                            {
                                if($is_subscribed_var == 1)
                                    {
                                        $urgent_sql = " and n.urgent = 1";
                                    }
                            }
                        else
                            {
                                if($just_urgent_news == 1)
                                    {
                                        $urgent_sql = " and n.urgent = 1";
                                    }
                            }
                    }
                $valid_category_row = $db->get_row("select * from languages as l,catlang as cl where l.IdLang = cl.IdLang and l.LangName = '$language' and cl.IdCat = '$cat_id' limit 0,1");
            }
        
        if($valid_category_row)
            {
                $result = array("result" => array());
                if($last_news == 1)
                    {
                        $news_res = $db->get_results("select * from languages as l,news as n,newslang as nl where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.Active = 1 and n.Deleted != 1 and l.LangName = '$language' and n.Date <= '$last_date' and n.IdNews != '$last_id' and n.IdNews < $last_id$urgent_sql order by n.Date desc,n.IdNews desc limit 0,$limit");
                    }
                else if(!empty($author_news))
                    {
                        $news_res = $db->get_results("select * from languages as l,news as n,newslang as nl where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.Active = 1 and n.Deleted != 1 and l.LangName = '$language' and n.Date <= '$last_date' and n.IdNews != '$last_id' and n.IdNews < $last_id and n.IdUserName = '$author_news'$urgent_sql order by n.Date desc,n.IdNews desc limit 0,$limit");
                    }
                else
                    {
                        $category_row = $valid_category_row;
                        $cat_id = $category_row->IdCat;
                        $news_res = $db->get_results("select * from languages as l,news as n,newslang as nl,newscategoies as nc where l.IdLang = nl.IdLang and n.IdNews = nc.IdNews and n.IdNews = nl.IdNews and n.Active = 1 and n.Deleted != 1 and nc.IdCat = '$cat_id' and l.LangName = '$language' and n.Date <= '$last_date' and n.IdNews != '$last_id'$urgent_sql order by n.Date desc,n.IdNews desc limit 0,$limit");
                    }

                if(count($news_res) > 0)
                    {
                        if(!empty($author_news))
                            {
                                $result["result"][] = array("type" => "category","id" => $author_news ,"title" => $author_name);
                            }
                        else if(!empty($cat_id))
                            {
                                $result["result"][] = array("type" => "category","id" => $cat_id ,"title" => $category_row->CatName);
                            }
                        else
                            {
                                $result["result"][] = array("type" => "category","id" => $category_row->IdCat ,"title" => $category_row->CatName);
                            }
                            
                        
                        foreach($news_res as $news)
                            {
                                $news_array = retrieve_news_in_list_details($news_res,$language);
                                $latest_id = $news_array['latest_id'];
                                $last_news_date = $news_array['last_news_date'];
                                $result["result"][] = $news_array['details'];
                            }
                            
                        if($last_news == 1)
                            $have_more_news_rs = $db->get_var("select count(*) from news as n where n.`Date` <= '$last_news_date' and n.`IdNews` != '$latest_id' and n.Active = 1 and n.Deleted != 1$urgent_sql order by n.Date desc,n.IdNews desc");
                        else if(!empty($author_news))
                            $have_more_news_rs = $db->get_var("select count(*) from news as n where n.`Date` <= '$last_news_date' and n.`IdNews` != '$latest_id' and n.Active = 1 and n.Deleted != 1 and n.IdUserName = '$author_news'$urgent_sql order by n.Date desc,n.IdNews desc");
                        else if(!empty($cat_id))
                            {
                                if($is_valid_token_var)
                                    {
                                        $is_subscribed_var = $db->get_var("select only_urgent from news_subscription where user_id = '$is_valid_token_var' and cat_id = '$cat_id'");
                                        if($is_subscribed_var == 1)
                                            {
                                                $urgent_sql = " and n.urgent = 1";
                                            }
                                        else
                                            {
                                                if($just_urgent_news == 1)
                                                    $urgent_sql = " and n.urgent = 1";
                                            }
                                    }
                                else
                                    {
                                        if($just_urgent_news == 1)
                                            $urgent_sql = " and n.urgent = 1";
                                    }
                                $have_more_news_rs = $db->get_var("select count(*) from news as n,newscategoies as nc where n.IdNews = nc.IdNews and nc.IdCat = '$cat_id' and n.`Date` <= '$last_news_date' and n.`IdNews` != '$latest_id' and n.Active = 1 and n.Deleted != 1$urgent_sql order by n.Date desc,n.IdNews desc");
                            }
                        else
                            $have_more_news_rs = $db->get_var("select count(*) from news as n,newscategoies as nc where n.IdNews = nc.IdNews and nc.IdCat = '$cat_id' and n.`Date` <= '$last_news_date' and n.`IdNews` != '$latest_id' and n.Active = 1 and n.Deleted != 1$urgent_sql order by n.Date desc,n.IdNews desc");

                        if($have_more_news_rs > 0)
                            {
                                if(!empty($author_news))
                                    $result["result"][] = array("type" => "more","id" => $latest_id,"author" => $author_news,"title" => api_get_news_more,"urgent" => $just_urgent_news);
                                else if(!empty($cat_id))
                                    $result["result"][] = array("type" => "more","id" => $latest_id,"cat" => $cat_id,"title" => api_get_news_more,"urgent" => $just_urgent_news);
                                else
                                    $result["result"][] = array("type" => "more","id" => $latest_id,"cat" => 'all',"title" => api_get_news_more,"urgent" => $just_urgent_news);
                                
                            }
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

/**
 * This function will set user news setting
 * @global db $db
 * @param type $settings_infos This is an array that will contain following indexes
 * t : user token
 * d : new display settings
 * d_u : new display just urgent settings
 * n : new notification settings
 * n_u : new notify just urgent settings
 * @return Json_object that may contain 1 property
 *      - s : String status of process 
 *              (Success = '1',
 *               invalid_token = '002',
 *               Invalid notification settings = '003',
 *               Invalid display settings = '004')
 */
function set_settings($settings_infos = array("t","d","d_u","n","n_u"))
{
    global $db;
    
    if(empty($db))
        {$db = new db();}
    
    $malformed_error_json = json_encode(array("s" => '001'));
    $invalid_token_error_json = json_encode(array("s" => '002'));
    $notification_settings_array_contain_invalid_infos = json_encode(array("s" => '003'));
    $display_settings_array_contain_invalid_infos = json_encode(array("s" => '004'));
    
    $valid_indexes_arr = array("t","d","d_u","n","n_u");
    $default_values_arr = array("t" => '',"d" => '',"d_u" => '',"n" => '',"n_u" => '');
    $infos_validity_arr = array("t" => 1,"d" => 1,"d_u" => 1,"n" => 1,"n_u" => 1);
    
    $index = 0;
    foreach($settings_infos as $info_name => $info_value)
        {
            if(!in_array($info_name,$valid_indexes_arr))
                {return($malformed_error_json);}

            // If it is not valid set the convenable index to 0
            $index ++;
        }
    
    //$passed_language = InputFilter($settings_infos['l']);
    
    //$valid_language = $db->get_var("select * from languages where LangName = '$passed_language'");
    //if(!$valid_language)
        //$language = 'Arabic';
    //else
        //$language = $passed_language;
    
    $token = InputFilter($settings_infos['t']);
    
    $valid_user_row = $db->get_row("select UserId,PrefLang from users where app_token = '$token'");
    if($valid_user_row)
        {
            $user_id = $valid_user_row->UserId;
            $language = $valid_user_row->PrefLang;
            
            $display_arr = explode('||',$settings_infos['d']);
            $display_urgent_arr = explode('||',$settings_infos['d_u']);
            $notify_arr = explode('||',$settings_infos['n']);
            $notify_urgent_arr = explode('||',$settings_infos['n_u']);
            
            $db->query("delete from news_subscription where user_id = '$user_id'");
            
            if(count($display_arr) > 0)
                {
                    foreach($display_arr as $category)
                        {
                            $is_valid_category_var = $db->get_var("select IdCat from catlang as cl,languages as l where l.IdLang = cl.IdLang and cl.IdCat = '$category' and l.LangName = '$language'");
                            if($is_valid_category_var)
                                {
                                    $db->query("insert into news_subscription(user_id,cat_id,only_urgent) values ('$user_id','$category',0)");
                                }
                        }
                }
                
            if(count($display_urgent_arr) > 0)
                {
                    foreach($display_urgent_arr as $category)
                        {
                            $is_valid_category_var = $db->get_var("select IdCat from catlang as cl,languages as l where l.IdLang = cl.IdLang and cl.IdCat = '$category' and l.LangName = '$language'");
                            if($is_valid_category_var)
                                {
                                    $db->query("update news_subscription set only_urgent=1 where user_id = '$user_id' and cat_id = '$category'");
                                }
                        }
                }
            
            $db->query("delete from notification where id_user = '$user_id'");
            if(count($notify_arr) > 0)
                {
                    foreach($notify_arr as $category)
                        {
                            $is_valid_category_var = $db->get_var("select IdCat from catlang as cl,languages as l where l.IdLang = cl.IdLang and cl.IdCat = '$category' and l.LangName = '$language'");
                            if($is_valid_category_var)
                                {
                                    $db->query("insert into notification(id_user,id_news_group,only_urgent) values ('$user_id','$category',0)");
                                }
                        }
                }
            
            if(count($notify_urgent_arr) > 0)
                {
                    foreach($notify_urgent_arr as $category)
                        {
                            $is_valid_category_var = $db->get_var("select IdCat from catlang as cl,languages as l where l.IdLang = cl.IdLang and cl.IdCat = '$category' and l.LangName = '$language'");
                            if($is_valid_category_var)
                                {
                                    $is_alread_found_var = $db->get_var("select id from notification where id_user = '$user_id' and id_news_group = '$category'");
                                    if($is_alread_found_var)
                                        $db->query("update notification set only_urgent=1 where id_user = '$user_id' and id_news_group = '$category'");
                                    else
                                        $db->query("insert into notification(id_user,id_news_group,only_urgent) values ('$user_id','$category',1)");
                                }
                        }
                }
            
            return json_encode(array("s" => '1'));
        }
    else
        {return $invalid_token_error_json;}
    
}

/**
 * This function will get display and notification settings for a specific user
 * @param t : User token to get his settings
 * @return json_object that will contain following properties
 *      - s : String is the status of the process ( Invalid token = '003',invalid parameters = '001')
 *      - ca : Array of json object each object represent a category setting
 *      - l : Language
 */
function get_settings($settings_infos = array("t"))
{
    global $db;
    
    if(empty($db))
        {$db = new db();}
    
    $invalid_infos_error_json = json_encode(array("s" => '001'));
    $malformed_error_json = json_encode(array("s" => '002'));
    $invalid_token_error_json = json_encode(array("s" => '003'));
    
    $valid_indexes_arr = array("t");
    
    $index = 0;
    
    if(!is_array($settings_infos) || count($settings_infos) <= 0 || count($settings_infos) > $valid_indexes_arr)
        {return $invalid_infos_error_json;}
    
    foreach($settings_infos as $info_name => $info_value)
        {
            if(!in_array($info_name,$valid_indexes_arr))
                {return($malformed_error_json);}
            $index ++;
        }
        
    $passed_token = InputFilter($settings_infos['t']);
    $valid_token_row = $db->get_row("select * from users where app_token = '$passed_token' limit 0,1");
    
    if($valid_token_row)
        {
            $user_id = $valid_token_row->UserId;
            $language = $valid_token_row->PrefLang;
            $returned_results = array("s" => '1',"ca" => array(),"l" => $language);
            
            $all_categories_res = $db->get_results("select cl.IdCat,cl.CatName from catlang as cl,languages as l where l.IdLang = cl.IdLang and l.LangName = '$language'");
            if(count($all_categories_res) > 0)
                {
                    $index = 0;
                    foreach($all_categories_res as $category_row)
                        {
                            $cat_id = $category_row->IdCat;
                            $cat_name = $category_row->CatName;
                            $notifications_settings_row = $db->get_row("select * from notification where id_user = '$user_id' and id_news_group = '$cat_id'");
                            $subscriptions_settings_row = $db->get_row("select * from news_subscription where user_id = '$user_id' and cat_id = '$cat_id'");
                            
                            $returned_results["ca"][$index]["i"] = $cat_id;
                            $returned_results["ca"][$index]["n"] = $cat_name;
                            if($notifications_settings_row)
                                {
                                    $returned_results["ca"][$index]["n_s"] = 1;
                                    $returned_results["ca"][$index]["n_u"] = $notifications_settings_row->only_urgent;
                                }
                            
                            if($subscriptions_settings_row)
                                {
                                    $returned_results["ca"][$index]["d_s"] = 1;
                                    $returned_results["ca"][$index]["d_u"] = $subscriptions_settings_row->only_urgent;
                                }
                            $index ++;
                        }
                }
            return json_encode($returned_results);
        }
    else
        {return $invalid_token_error_json;}
}

/**
 * 
 * @deprecated since version 1.0.1
 * This function must return the about details for a specific website
 * @param 'l' : The language name we want to get the about page in
 * @return 'r' : Object that will contain page infos (title , details)
 */
function get_about($page_infos = array("l" => "Arabic"))
{
    global $default_language;
    $page_not_found_json_error = array("s" => '001');
    
    if(isset($page_infos['l']))
        {
            $passed_language = InputFilter($page_infos['l']);
            $is_valid_language_var = $db->get_var("select IdLang from language where LangName = '$passed_language' and Deleted != 1");
            if($is_valid_language_var)
                $page_language = $is_valid_language_var;
            else
                $page_language = $default_language;
        }
    else
        {
            $page_language = $default_language;
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

/**
 * This function is used to insert a new news to the database
 * @param Array $news_infos contains following indexes :
 *      - t : Token of the user send this news
 *      - l : Language of this news
 *      - c : Content of this news
 *      - a : Agency of this news
 *      - ca : Category of this news
 *      - i : Images must be attached with this news (String separated by ',' for each image)
 *      - v : Videos must be attached with this news (String separated by ',' for each video)
 *      - u : Is this news urgent
 *      - ti : The title of this news
 *      - lo : Location of this news
 *      - uu : UUID of device from where sended this news (For mobile applications)
 * @return a Json_Object that will contain following properties : 
 *      - s : Status of sending news (Succeed = '1' , invalid token = '003',invalid passed parameters = '001',unsufficient privileges = '004')
 *      - r : Json object that will contain following properties :
 *              id : News id
 *              no : Notification type that script call this function now if it is must notify all users or just admin (Mobile application)
 *              to : Token where the data of this news is carried (In this way we prevent sending notification directly by sending news id but buy saving news infos in a session and return this session as identificator of this news)
 */
function send_news($news_infos = array("t" => "","l" => "","c" => "","a" => "","ca" => "","i" => "","v" => "","u" => "","ti" => "","lo" => "","uu" => ""))
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
    
    $valid_indexes_arr = array("t","l","c","a","ca","i","v","u","ti","lo","uu");
    $guest_valid_indexes_arr = array("l","c","ca","i","v","ti","lo","uu");
    
    $news_location = isset($news_infos['lo'])?InputFilter($news_infos['lo']) : "0,0";
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
    
    $points_to_add = 0;
    $passed_news_body = isset($news_infos['c']) && !empty($news_infos['c'])?$news_infos['c'] : "";
    if(empty($passed_news_body))
        {return $empty_content_error_json;}
    else
        {
            $points_to_add ++;
            $w_tags_news_body = strip_tags($passed_news_body);
            /*preg_replace('/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]'.
            '|[\x00-\x7F][\x80-\xBF]+'.
            '|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*'.
            '|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})'.
            '|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S',
            '', $news_content);*/
            $news_body = str_replace(array("\n"),array("<line>"),$w_tags_news_body);
        }
    
    $notify = 1;
    $notification_token = "";
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
                    $uuid = $is_valid_token_row->uuid;
                    $is_admin_var = $db->get_var("select AdminId from admins where AdminId = '$user_id'");
                    if($is_admin_var)
                        {
                            $notify = 1;
                            $notification_token = md5(time().time().rand(0,999));
                            $news_urgent = isset($news_infos['u']) && !empty($news_infos['u']) && $news_infos['u'] == 1 ? 1 : 0;
                            $passed_agency = isset($news_infos['a']) && !empty($news_infos['a'])?InputFilter($news_infos['a']):$user_nick_name;
                            $is_valid_agency_var = $db->get_var("select NickName from users as u,groups as g where g.GroupId = u.GroupId and (md5(u.NickName) = '" . md5($passed_agency) . "' or u.NickName = '$user_nick_name') and g.GroupName = 'agencies'");
                            $news_agency = $is_valid_agency_var ? $is_valid_agency_var : $user_nick_name;
                            $news_active = 1;
                        }
                    else
                        {
                            $notify = 2;
                            $notification_token = md5(time().time().rand(4000,9999));
                            $news_urgent = 0;
                            $news_agency = $user_nick_name;
                            $news_active = 0;
                        }
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
            $notify = 2;
            $notification_token = md5(time().time().rand(4000,9999));
            $user_id = '20070000000';
            $news_urgent = 0;
            $news_agency = "Guest";
            $news_active = 0;
            $uuid = isset($news_infos['uu']) && $db->get_var("select uuid from cyberapp where uuid = '".InputFilter($news_infos['uu'])."'")?InputFilter($news_infos['uu']) : "";
        }
    
    
    $news_id = GenerateID('news', 'IdNews');
    $news_date = date('Y-m-d H:i:s',time());
    $year = date('Y',time());
    $month = date('m',time());
    $day = date('d',time());
    $news_hits = 0;
    $news_deleted = 0;
    
    $passed_news_title = isset($news_infos['ti']) && !empty($news_infos['ti']) ? str_replace(array("\n"),array(" "),$news_infos['ti']) : str_replace(array("<line>"), array(" "), $news_body);    
    //$news_title_full = str_replace(array("<line>"),array(" "),$passed_news_title);
    $news_title_to_replace = InputFilter($passed_news_title);
    $news_title = str_replace(array(":", "/", "\\", "@","#",'"',"'"), array("", " ", " ", "","","",""),$news_title_to_replace);
    
    $is_duplicated_news = $db->get_var("select Tilte from newslang where Tilte = '$news_title' and IdLang = '$news_language_var'");
    if($is_duplicated_news)
        {
            return $empty_content_error_json;
        }
    $news_subtitle = "";
    
    $news_full_brief = str_replace(array("<line>"),array(" "),$news_body);
    $news_brief = mb_substr($news_full_brief,0,500,"utf8");
    
    $news_full_message_full = str_replace(array("<line>"),array("<br />"),$news_body);
    $news_full_message = InputFilter($news_full_message_full);
    
    $news_note = "";
    
    $passed_category = isset($news_infos['ca']) && !empty($news_infos['ca'])?InputFilter($news_infos['ca']):"";
    $news_category = !empty($news_infos['ca']) && ($db->get_var("select IdCat from catlang as cl where cl.IdCat = '$passed_category' and cl.IdLang = '$news_language'"))?$passed_category : "20100000000";
    
    $passed_news_images = isset($news_infos['i']) && !empty($news_infos['i'])?InputFilter($news_infos['i']) : "";
    $passed_news_videos = isset($news_infos['v']) && !empty($news_infos['v'])?InputFilter($news_infos['v']) : "";
    if(isset($news_infos['i']) && !empty($news_infos['i']))
        {
            $passed_news_images_arr = explode('||',$passed_news_images);
            foreach($passed_news_images_arr as $passed_news_image)
                {
                    if(file_exists("../../uploads/gallery/Albums/$year/$day-$month-$year/$passed_news_image"))
                        {$news_images_arr[] = $passed_news_image;}
                }
            
            if(isset($news_images_arr) && is_array($news_images_arr) && count($news_images_arr) > 0)
                {
                    $news_image = $news_images_arr[0];
                    if($news_agency !== 'Guest')
                        {
                            $points_to_add += 2;
                        }
                }
            else
                {
                    $news_image = 'newspaper.png';
                    $news_images_arr = array();
                }
        }
    else
        {
            $rand_name = rand(1, 5);
            if ($news_urgent == 1 && is_file("../../uploads/news/pics/" . $news_category . "/" . $rand_name . ".jpg"))
                {
                    $news_image = $news_category . "/" . $rand_name . ".jpg";
                }
            else
                {
                    $news_image = 'newspaper.png';
                }
            $news_images_arr = array();
        }
    
    if(isset($news_infos['v']) && !empty($news_infos['v']))
        {
            $news_videos_array = explode('||', InputFilter($news_infos['v']));
            if($news_agency !== 'Guest')
                {
                    $points_to_add += 3;
                }
        }
    else
        {
            $news_videos_array = array();
        }
    $insert_news_sql = "insert into news(IdNews,IdUserName,Date,Active,Hits,NewsPic,Deleted,urgent,agency,location,uuid,news_points) values ('$news_id','$user_id','$news_date','$news_active','$news_hits','$news_image','$news_deleted','$news_urgent','$news_agency','$news_location','$uuid',$points_to_add)";
    $insert_news_qu = $db->query($insert_news_sql);

    if($db->dbh->affected_rows > 0)
        {
            if($news_urgent == 1)
                {
                    $marquee_message = str_replace(array(":", "/", "\\", "@", '"', "'", "#"), array("", " ", " ", "", "", "", ""), $news_title);
                    $marquee_title_in_link = mb_substr($marquee_message, 0, 40, "utf8");
                    $marquee_id = GenerateID('marques', 'idMarque');
                    $marquee_link = CreateLink('',array('Prog','ns','idnews','title'),array('cybernews','details',$news_id,$marquee_title_in_link));
                    $marquee_start_date = date('Y-m-d H:i:s',time());
                    $marquee_end_date = date('Y-m-d H:i:s', strtotime("$marquee_start_date +30 hours"));
                    $db->query("insert into marques(idMarque,Link,StartDate,EndDate,Deleted) values('$marquee_id','$marquee_link','$marquee_start_date','$marquee_end_date','0')");
                    $db->query("insert into marqlang(idmarque,idLang,Message) values('$marquee_id','$news_language','$marquee_message')");
                }
            $insert_news_category_sql = "insert into `newscategoies` values('$news_id','$news_category')";
            $insert_news_category_qu = $db->query($insert_news_category_sql);
            //$insert_news_category_sql;
            
            $news_full_message .= '<div id="news_desc_images_wrapper_div">';
            $all_images = '<br />';
            if(count($news_images_arr)>0)//If their is any image uploaded
                {
                    $counter = 0;
                    foreach($news_images_arr as $news_image_row)
                        {
                            if($counter === 0)
                                {
                                    create_news_thumbs("../../uploads/gallery/Albums/$year/$day-$month-$year/" . $news_image_row, "../../uploads/news/pics/" . $news_image_row, 100);
                                    $mobile_news_image = str_replace('.', '_320.', $news_image_row);
                                    create_news_thumbs("../../uploads/gallery/Albums/$year/$day-$month-$year/" . $news_image_row, "../../uploads/news/pics/" . $mobile_news_image, 320);
                                }
                            $extension = pathinfo($news_image_row, PATHINFO_EXTENSION);
                            $media_id = GenerateID("gallery", 'IdMedia');
                            $media_path = "uploads/gallery/Albums/$year/$day-$month-$year/$news_image_row";
                            $addition_date = $news_date;
                            $media_location = "";
                            $media_rank = "";
                            $media_type = $extension;
                            $news_caption = InputFilter($news_title);
                            $Desc = "";
                            $Place = "";
                            $Tags = "";
                            $insert_to_gallery_sql = "insert into gallery(IdMedia,Path,AddDate,MapLocation,MediaRank,MediaType) values ('$media_id','$media_path','$addition_date','$media_location','$media_rank','$media_type')";
                            $insert_to_gallery_qu = $db->query($insert_to_gallery_sql);
                            $insert_into_gallery_lang_sql = "insert into gallerylang(`IdMedia`,`IdLang`,`Caption`,`Desc`,`Place`,`Tags`) values ('$media_id','$news_language','$news_caption','$Desc','$Place','$Tags')";
                            $insert_into_gallery_lang_qu = $db->query($insert_into_gallery_lang_sql);
                            $all_images .= "<div class='news_desc_images'><img src='uploads/gallery/Albums/$year/$day-$month-$year/$news_image_row' /></div>";
                            $counter++;
                        }
                }
            else
                {
                    if (is_file("../../uploads/gallery/Albums/$news_category/$rand_name.jpg") && $news_urgent === 1)
                        {
                            $all_images .= "<div class='news_desc_images'><img src='uploads/gallery/Albums/$news_category/$rand_name.jpg' /></div>";
                        }
                }
            $all_videos = '<br />';
            if (count($news_videos_array) > 0)
                {//If their is any video uploaded
                    foreach ($news_videos_array as $news_video)
                        {
                            $IdMedia = GenerateID("gallery", 'IdMedia');
                            $Path = "uploads/gallery/Albums/$year/$day-$month-$year/$news_video";
                            $AddDate = $news_date;
                            $MapLocation = "";
                            $MediaRank = "";
                            $MediaType = "youtube";
                            $Caption = InputFilter($news_title);
                            $Desc = "";
                            $Place = "";
                            $Tags = "";
                            $insert_to_gallery_sql = "insert into gallery(IdMedia,Path,AddDate,MapLocation,MediaRank,MediaType) values ('$IdMedia','$Path','$AddDate','$MapLocation','$MediaRank','$MediaType')";
                            $insert_to_gallery_qu = $db->query($insert_to_gallery_sql);
                            $insert_into_gallery_lang_sql = "insert into gallerylang(`IdMedia`,`IdLang`,`Caption`,`Desc`,`Place`,`Tags`) values ('$IdMedia','$news_language','$Caption','$Desc','$Place','$Tags')";
                            $insert_into_gallery_lang_qu = $db->query($insert_into_gallery_lang_sql);
                            $all_videos .= '<div class="news_desc_videos">'
                                            . '<iframe width="420" height="315" src="//www.youtube.com/embed/' . $news_video . '" frameborder="0" allowfullscreen></iframe>'
                                         . '</div>';
                        }
                }
            $news_full_message .= $all_images.$all_videos.'</div>';
            str_replace(array('src=\"//', 'src=\'//', 'src=//'), array('src="http://', 'src=\'http://', 'src=http://'), $news_full_message);
            if($notify === 1)
                {
                    $news_title = str_replace(array('{','}'),array('<','>'),$news_title);
                    $news_title = mysqli_real_escape_string($db->dbh,$news_title);
                    
                    $news_subtitle = str_replace(array('{','}'),array('<','>'),$news_subtitle);
                    $news_subtitle = mysqli_real_escape_string($db->dbh,$news_subtitle);
                    
                    $news_brief = str_replace(array('{','}'),array('<','>'),$news_brief);
                    $news_brief = mysqli_real_escape_string($db->dbh,$news_brief);
                    
                    $news_full_message = str_replace(array('{','}'),array('<','>'),$news_full_message);
                    $news_full_message = mysqli_real_escape_string($db->dbh,$news_full_message);
                    
                    $news_full_message = str_replace(array('clickX','<aX'),array('click','<a'),$news_full_message);
                    //$news_full_message = addslashes($news_full_message);
                    $insert_news_lang_sql = "insert into newslang(IdLang,IdNews,Tilte,SubTitle,Breif,FullMessage,Note) values ('$news_language','$news_id','$news_title','$news_subtitle','$news_brief','$news_full_message','$news_note')";
                }
            else
                {
                    $news_title = mysqli_real_escape_string($db->dbh,$news_title);
                    $news_subtitle = mysqli_real_escape_string($db->dbh,$news_subtitle);
                    $news_brief = mysqli_real_escape_string($db->dbh,$news_brief);
                    $news_full_message = mysqli_real_escape_string($db->dbh,$news_full_message);
                    $insert_news_lang_sql = "insert into newslang(IdLang,IdNews,Tilte,SubTitle,Breif,FullMessage,Note) values ('$news_language','$news_id','$news_title','$news_subtitle','$news_brief','$news_full_message','$news_note')";
                }
            //file_put_contents("write_query.sql",$insert_news_lang_sql."\n",FILE_APPEND);
            $insert_news_lang_qu = $db->query($insert_news_lang_sql);
            
            if($db->dbh->affected_rows > 0)
                {
                    $db->query("update users set points = points + $points_to_add where UserId = '$user_id'");
                    //file_put_contents("write_query.sql","update users set points = points + $points_to_add where UserId = '$user_id'"."\n",FILE_APPEND);
                }
            if(!empty($notification_token))
                {
                    $_SESSION['notification'][$notification_token]['token']= $notification_token;
                    $_SESSION['notification'][$notification_token]['news_id'] = $news_id;
                    $_SESSION['notification'][$notification_token]['type'] = $notify;
                }
            return json_encode(array("s" => '1',"r" => array("id" => $news_id,"no" => $notify,"to" => $notification_token)));
        }
}

/**
 * Function used to audit a specific news
 * @param Array $news_infos that will contain following indexes :
 *          - t : String Token of user (A user or a guest cannot audit a news)
 *          - i : News id to be audited
 *          - u : String The type of auditing for this news ('0' -> Delete news,'1' -> Normal news,'2' -> Urgent news)
 *          - l_i : Last news id found in the page where unapprooved news are listed to know whic news we must return after auditing current news
 *          
 * @return JsonObject that may conatins following properties :
 *          - s : String Status of auditing process (10 -> Deleted , 11 -> News is published as normal news,12 News is published as urgent)
 *          - r : Object that contains following properties
 *          -       i : News id
 *          -       no : Notification type
 *          -       to : Session token care news infos
 *          - l_n : The id of news must be retrieved after auditing current news
 */
function audit_news($news_infos=array("t" => "","i" => "","u" => "","l_i" => ""))
{
    global $db,$default_language;
    if(empty($db))
        $db = new db();
    
    $invalid_infos_error_json = json_encode(array("s" => '001'));
    $invalid_token_error_json = json_encode(array("s" => '002'));
    $unsufficient_privilege_error_json = json_encode(array("s" => '003'));
    $invalid_news_error_json = json_encode(array("s" => '004'));
    
    $valid_indexes_arr = array("t","i","u","l_i");
    
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
            
            $news_id = $is_valid_unaudited_news_var;
            
            $news_points_var = $db->get_var("select news_points from news where IdNews = '$passed_news_id'");
            $news_points = $news_points_var;
            $last_news_row = $db->get_row("select IdNews,`Date` from news where IdNews = '".InputFilter($news_infos['l_i'])."' and Active = 0");
            
            if($last_news_row)
                {
                    $last_news_id = $last_news_row->IdNews;
                    $last_news_date = $last_news_row->Date;
                }
            else
                {
                    $last_news_id = '-1';
                    $last_news_date = "-1";
                }
            
            $urgency = isset($news_infos['u']) && in_array(intval($news_infos['u']),array(0,1,2))?intval($news_infos['u']) : 0;
            $last_news_row = $db->get_row("select nl.Tilte as news_title,n.IdNews as news_id from languages as l,news as n,newslang as nl where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.Active != 1 and n.Deleted != 1 and l.LangName = '$default_language' and n.Date >= '$last_news_date' and n.IdNews != '$last_news_id' Order By n.`Date` asc");
            if($last_news_row)
                {
                    $returned_result = array("i" => $last_news_row->news_id,"t" => $last_news_row->news_title);
                }
            else
                {
                    $returned_result = "-1";
                }
            switch($urgency)
                {
                    case '0':
                        $news_user_id_var = $db->get_var("select IdUserName from news where `IdNews` = '$news_id'");
                        $db->query("update news set Deleted = 1,del_by = '$user_id' where IdNews = '$news_id'");
                        $db->query("update users set points = points - $news_points where UserId = '".$news_user_id_var."'");
                        return json_encode(array("s" => '1',"r" => '10',"l_n" => $returned_result));
                        break;
                    case '1':
                        $db->query("update news set Active = 1,active_by = '$user_id' where IdNews = '$news_id'");
                        $notify = 1;
                        $notification_token = md5(time().time().rand(0,999));
                        if(!empty($notification_token))
                            {
                                $_SESSION['notification'][$notification_token]['token']= $notification_token;
                                $_SESSION['notification'][$notification_token]['news_id'] = $news_id;
                                $_SESSION['notification'][$notification_token]['type'] = $notify;
                            }
                        return json_encode(array("s" => '11',"r" => array("i" => $news_id,"no" => $notify,"to" => $notification_token),"l_n" => $returned_result));
                        break;
                    case '2':
                        $db->query("update news set Active = 1,urgent = 1,active_by = '$user_id' where IdNews = '$news_id'");
                        $notify = 1;
                        $notification_token = md5(time().time().rand(0,999));
                        if(!empty($notification_token))
                            {
                                $_SESSION['notification'][$notification_token]['token']= $notification_token;
                                $_SESSION['notification'][$notification_token]['news_id'] = $news_id;
                                $_SESSION['notification'][$notification_token]['type'] = $notify;
                            }
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
                        return json_encode(array("s" => '12',"r" => array("i" => $news_id,"no" => $notify,"to" => $notification_token),"l_n" => $returned_result));
                        break;
                    default :
                        return $invalid_news_error_json;
                        break;
                }
            
        }
}

/**
 * This function will get last $limit unapprooved news as array of json_object
 * @param type $user_infos array with 3 indexes
 * t : token of user
 * l : language of news we want to fetch
 * li : limit of news we want to retrieve
 * @return json_object that may contains following properties :
 *      - s : process status
 *      - r : An array with 2 indexes
 *           - i : Id of unapprooved news
 *           - t : Title of unapprooved news
 */
     
function get_unapprooved_news($user_infos = array("t" => "","l" => "","li" => ""))
{
    global $db,$default_language;
    
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
    $is_valid_token_var = $db->get_var("select UserId from users,admins where users.UserId = admins.AdminId and users.app_token = '$passed_token'");
    
    
    if($is_valid_token_var)
        {
            $passed_language = isset($user_infos['l']) && !empty($user_infos['l']) ? InputFilter($user_infos['l']) : $default_language;
            $is_valid_language_var = $db->get_var("select IdLang from languages where Deleted != 1 and LangName = '$passed_language'");
            if($is_valid_language_var)
                {
                    $lang_id = $is_valid_language_var;
                    $limit = isset($infos['li']) && intval($infos['li']) > 0 && intval($infos['li']) <= 200 ? intval($infos['li']) : 20;
                    $limited_unapprooved_news_res = $db->get_results("select nl.Tilte as news_title,n.IdNews as news_id from languages as l,news as n,newslang as nl where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.Active != 1 and n.Deleted != 1 and l.IdLang = '$lang_id' Order By `Date` asc limit 0,$limit");
                    if(count($limited_unapprooved_news_res) > 0)
                        {
                            $returned_result = array();
                            $index = 0;
                            $permissions = array("u" => 0,"d" => 0);
                            $can_update_news_var = $db->get_var("select perm from adminperm where AdminID = '$is_valid_token_var' and varValue = 'editNews' and constName = 'prog' and varName = 'subdo'");
                            if($can_update_news_var)
                                $permissions['u'] = 1;
                            
                            $can_delete_news_var = $db->get_var("select perm from adminperm where AdminID = '$is_valid_token_var' and varValue = 'deleteNews' and constName = 'prog' and varName = 'subdo'");
                            if($can_delete_news_var)
                                $permissions['d'] = 1;
                            
                            foreach($limited_unapprooved_news_res as $unapprooved_news_row)
                                {
                                    $returned_result[$index] = array("i" => $unapprooved_news_row->news_id,"t" => $unapprooved_news_row->news_title);
                                    $index ++;
                                }
                            return json_encode(array("s" => 1,"r" => $returned_result,"p" => $permissions));
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

/** This function will invoke send email function to send a contact us email
        @param $email_infos Array with folloaing indexes :
 *          - c : Used for a captcha image (Used for non mobile applications)
 *          - d : Department id to contact
 *          - e : Email of sender
 *          - f : Full name of the sender
 *          - l : Language to know the name of department due the language used
 *          - m : Message to send
 *          - r : String reason (Type of feedback : complaint,question,suggestion)
 *          - t : Token of a user (If token is passed suitable user infos are retrieved from database)
 *      @return Json_Object that may contains following properties
 *          - s : Status of process (
 *                                      '001' -> Invalid parameters,
 *                                      '002' -> Invalid token,
 *                                      '003' -> Invalid send (Email provided not a valid email),
 *                                      '004' -> Empty message is passed)
 *          - n1 : Int A random number (used for mobile application as captcha @deprecated since version 1.0.1)
 *          - n2 : Int A second random number (used for mobile application as captch @deprecated since version 1.0.1)
 *          - e : String Admin email
*/
function contact_us($email_infos = array("c" => "","d"=>"","e"=>"","f"=>"","l" => "","m"=>"","r" => "","t"=>""))
    {
        global $db,$AdminMail;
        
        if(empty($db))
            $db = new db();
        
        if(empty($AdminMail))
            $AdminMail = $db->get_var("select AdminMail from admins where IsAdam = '1'");
        
        $invalid_infos_error_json = json_encode(array("s" => '001'));
        $invalid_token_error_json = json_encode(array("s" => '002'));
        $invalid_sender_error_json = json_encode(array("s" => '003'));
        $empty_message_error_json = json_encode(array("s" => '004'));
        if((!isset($email_infos['t']) && (!isset($email_infos['f']) || !isset($email_infos['e']))) || !isset($email_infos['m']))
            return $invalid_infos_error_json;
        
        /*if(isset($_SESSION['n1']) && isset($_SESSION['n2']))
            {
                if($email_infos['c'] != $_SESSION['n1'] + $_SESSION['n2'])
                    {
                        file_put_contents("cal.txt",$email_infos['c'] . "must = " . $_SESSION['n1']. ' + ' .$_SESSION['n1']. "=" . $_SESSION['n1'] + $_SESSION['n2'] ."\n",FILE_APPEND);
                        unset($_SESSION['n1']);
                        unset($_SESSION['n2']);
                        $number1 = rand(0,10);
                        $_SESSION['n1'] = $number1;
                        $number2 = rand(0,10);
                        $_SESSION['n2'] = $number2;
                        return  json_encode(array("s" => '006',"n1" => $number1,"n2" => $number2));
                    }
            }*/
        $passed_token = InputFilter($email_infos['t']);
        if(!empty($passed_token))
            {
                $is_valid_token_row= $db->get_row("select Concat(UserName,' ',FamNAme) as full_name,UserMail as email,CellNbr,Contry from users where app_token = '$passed_token'");
                if(!$is_valid_token_row)
                    {
                        return $invalid_token_error_json;
                    }
                $email = $is_valid_token_row->email;
                $full_name = $is_valid_token_row->full_name;
                $tel_number = $is_valid_token_row->CellNbr;
                $country = $is_valid_token_row->Contry;
            }
        else
            {
                if(empty($email_infos['e']) || !check_email_address(InputFilter($email_infos['e'])))
                    return $invalid_sender_error_json;
                $email = InputFilter($email_infos['e']);
                $full_name = !empty($email_infos['f'])?InputFilter($email_infos['f']) : api_visitor;
                $tel_number = "";
                $country = "";
            }
        $reason = (isset($email_infos['r']) && !empty($email_infos['r']) && in_array(InputFilter($email_infos['r']), array('question','complaint','suggestion')))?InputFilter($email_infos['r']) : "complaint";
        $passed_language = (isset($email_infos['l']) && !empty($email_infos['l'])) && $db->get_var("select LangName from languages where LangName = '" . InputFilter($email_infos['l']) ."'")?InputFilter($email_infos['l']) : "";
        $passed_department = (isset($email_infos['d']) && !empty($email_infos['d']))?InputFilter($email_infos['d']) : "";
        $is_valid_department_row = $db->get_row("SELECT c.`DepEmail`,cl.`DepName` FROM `contactus` as c , `contactuslang` as cl,`languages` as l where l.IdLang = cl.IdLang and `c`.`IdDep` = `cl`.`IdDep` and `c`.`IdDep`='$passed_department' and l.LangName = '$passed_language'");
        if($is_valid_department_row)
            {
                $department_name = $is_valid_department_row->DepName;
                $department_email = $is_valid_department_row->DepEmail;
            }
        else
            {
                $department_name = $passed_department;
                $department_email = $AdminMail;
            }
    
        $title = isset($email_infos['ti']) && !empty($email_infos['ti'])?InputFilter($email_infos['ti'])." ".$email : api_message_from_administration." ".$email;
        $message = InputFilter($email_infos['m']);
        $from = $email;
        $from_name = $full_name;
        $add_address[0] = $email;
        $add_address[1] = $department_name;
        $subject = "";
        $street = "";
        $city = "";
        $body = "TelNumber : ".$tel_number."<br/> Street :".$street."<br/> City :".$city."<br/> Contry :".$country."<br/> TypeOfFeedback :".$reason."<br/> Message :".$message;
        $mail_phpmailer = new PHPMailer();
        ob_start();
        $mailed = api_send_email($mail_phpmailer, $email,$full_name, $department_email, $title, $message,"");
        $output = ob_get_clean();
        //file_put_contents("output.txt",$output ."\n" ,FILE_APPEND);
        //unset($_SESSION['n1']);
        //unset($_SESSION['n2']);
        $number1 = rand(0,10);
        //$_SESSION['n1'] = $number1;
        $number2 = rand(0,10);
        //$_SESSION['n2'] = $number2;
        if($mailed)
            {
                return json_encode(array("s" => '1',"n1" => $number1,"n2" => $number2,"e" => $AdminMail));
            }
        else
            {
                return json_encode(array("s" => '005',"n1" => $number1,"n2" => $number2,"e" => $AdminMail));
            }
    }

/**
 * @deprecated since version 1.0.1
 * This function will send email from a specific user to a specific reciever (sender must be user and is defined by token)
 */
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

//This function will get client IP
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


//This function will do a mobile login for a user name
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
                $query = "UPDATE `users` SET `LastSession` = '" . session_id() . "' WHERE `UserId` = '" . $UserId . "' ;";
                $db->query($query);
            }
    }

/**
 * Function to update registration id for a specific user using passed token (mobile application)
 * 
 * @param Array $user_infos contains following indexes :
 *          - t : String User token
 *          - id : String notification id (android id or apple id)
 *          - ty : Char Type of id (a -> Android , app -> Apple)
 *          - u  : String UUID of device
 * 
 * @return Json_Object Contains following properties :
 *          - s : String The status of update process (
 *                                                      '001' -> Lack infos ,
 *                                                      '002' -> Invalid token,
 *                                                      '1' -> Update succeed)
 */
function set_user_google_registration_id($user_infos = array('t' => '','id' => '','ty' => 'a','u' => ''))
    {
        if(!isset($user_infos) || (!isset($user_infos['t']) && !isset($user_infos['u'])))
            return json_encode(array('s' => '001'));
        
        global $db;
        if(empty($db))
            $db = new db();
        
        if(isset($user_infos['t']))
            {
                $passed_token = InputFilter($user_infos['t']);
                $is_valid_token_var = $db->get_var("select UserId from users where app_token = '$passed_token'");
                if(!$is_valid_token_var)
                    return json_encode(array('s' => '002'));
        
                $passed_notifications_registration_id = $user_infos['id'];
        
                if($user_infos['ty'] == 'ap')
                    $notifications_query = "update users set apple_id = '$passed_notifications_registration_id' where UserId = '$is_valid_token_var'";
                else
                    $notifications_query = "update users set android_id = '$passed_notifications_registration_id' where UserId = '$is_valid_token_var'";
                $db->query($notifications_query);
            }
        else if(isset($user_infos['u']))
            {
                $passed_uuid = InputFilter($user_infos['u']);
                $is_valid_uuid_var = $db->get_var("select uuid from cyberapp where uuid = '$passed_uuid'");
                $passed_notifications_registration_id = $user_infos['id'];
                if($is_valid_uuid_var)
                    {
                        if($user_infos['ty'] == 'ap')
                            $notifications_query = "update cyberapp set apple_id = '$passed_notifications_registration_id' where uuid = '$is_valid_uuid_var'";
                        else
                            $notifications_query = "update cyberapp set android_id = '$passed_notifications_registration_id' where uuid = '$is_valid_uuid_var'";
                    }
                else
                    {
                        if($user_infos['ty'] == 'ap')
                            $notifications_query = "insert into cyberapp(android_id,apple_id,uuid)values('','$passed_notifications_registration_id','$passed_uuid')";
                        else
                            $notifications_query = "insert into cyberapp(android_id,apple_id,uuid)values('$passed_notifications_registration_id','','$passed_uuid')";
                    }
                $db->query($notifications_query);
            }
            
        //echo $notifications_query;
        return json_encode(array('s' => '1'));
    }

/**
 * 
 * @global type $EmailMethode
 * @global type $SmtpHost
 * @global type $SMTPusername
 * @global type $SMTPpassword
 * @global type $SmtpPort
 * @global type $SMTPSecure
 * @param type $mail PHPMAILER Object
 * @param type $from Tell who is the sender of this email
 * @param type $full_name Tell the full name of the sender of this email
 * @param type $to Tell the email of the reciever of this mail
 * @param type $title Tell the tile of this email
 * @param type $message Tell the message content of this email
 * @param type $attachments Tell attachments of email
 * @return boolean Return boolean values to indicate the status of the email sending process
 */
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
        $mail->From = $SMTPusername;
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

/**
 * This function will validate a user name if is found in our database
 * 
 * @param $user_infos Array Contains following indexes :
 *          - u : String User name (Nick name) to validate
 * @return Json_Object contains following properties :
 *      s : String status of validation (
 *                                       '002' : No username is passed,
 *                                       '003' : User name is not found in our database,
 *                                       '1' : User name is valid)
 */
function is_valid_user_name($user_infos = array("u" => ''))
{
    if(!isset($user_infos['u']))
        {
            return json_encode(array('s' => '002'));
        }
    else
        {
            global $db;
            if(empty($db))
                {
                    $db = new db();
                    $passed_user_name = InputFilter($user_infos['u']);
                    $is_valid_user_name = $db->get_var("select * from users where NickName = '".$passed_user_name."'");
                    if($is_valid_user_name)
                        {
                            return json_encode(array('s' => '1'));
                        }
                    else
                        {
                            return json_encode(array('s' => '003'));
                        }
                }
        }
}

//Get the country of visitor as plain text
function get_country()
{
    $ip_address = get_client_ip();
    $ip_infos_json = file_get_contents("http://freegeoip.net/json/".$ip_address);
    $ip_infos_arr = json_decode($ip_infos_json);
    return $ip_infos_arr->country_code;
}

/** This function will fetch all departments have a specific language passing an associative array that may contains following indexes
 * @param String $l This will be the language name which we want to fetch infos for(If is not valid '$default_language is used')
 * 
 * @return json_object that might have following properties :
 * 
 * $s : Contains process result ('0' => No department suitable to passed language exists or '1' => Depratments infos found and property r exists
 * 
 * $r : Contain departments infos as json object of multiple json objects (Each department have its suitable object)
 *      Each department object have following properties : (i => Department Id , n => Department Name)
 * 
 * $n1 : Contain a random captcha code(Saved in session)
 * 
 * $n2 : Contain a random captcha code(Saved in session)
 */
function get_all_departments($infos = array("l" => ""))
    {
        global $db,$default_language;
        if(empty($db))
            $db = new db();
        $language = !isset($user_infos['l']) || !$db->get_var("select LangName from languages where LangName = '".InputFilter($infos['l'])."'")?$default_language : InputFilter($infos['l']);
        
        $number1 = rand(0,10);
        // $_SESSION['n1'] = $number1;
        $number2 = rand(0,10);
        //$_SESSION['n2'] = $number2;
        $all_departments_res = $db->get_results("select c.IdDep,cl.DepName from contactus as c,contactuslang as cl,languages as l where l.IdLang = cl.IdLang and c.IdDep = cl.IdDep and l.LangName = '$language'");
        if(count($all_departments_res) > 0)
            {
                $all_departments = array("s" => '1',"r" => array());//"n1" => $number1,"n2" => $number2
                $index = 0;
                foreach($all_departments_res as $department_row)
                    {
                        $all_departments['r'][$index] = array("i" => $department_row->IdDep,"n" => $department_row->DepName);
                        $index ++;
                    }
            }
        else
            {
                $all_departments = array("s" => '0');//"n1" => $number1,"n2" => $number2
            }
        return json_encode($all_departments);
    }

/** 
 * Function to get infos for a specific user passing an associative array which may contains following indexes
 * @global db $db
 * @param String $t : Token of user we want to get their infos(If present $i have no value)
 * @param String $i : Id of user we want to get their infos(If present $t have no value)
 * @param Boolean $j : Tell function if we want to return result as json object (Function direct call as an api call) or as an array (Function locally call from another api function)
 * 
 * @return json_object that may contain following properties :
 * 
 * $s : This property may have two type of values : 
 *          one is '-1' if user is not valid (token , user id passed are not valid)
 *          second is '1' if user is valid and a propert i must exists
 * 
 * $i : This property will exist just when user token or id is valid and it will contains user infos
 * @author Mohammad Zein Eddine <mohammad@phptransformer.com>
 */
function get_user_infos($user_infos = array("t" => "","i" => "","j" => ""))
    {
        global $db;
        if(empty($db))
            $db = new db();

        $token = isset($user_infos['t'])?InputFilter($user_infos['t']) : "";
        $id = isset($user_infos['i'])?InputFilter($user_infos['i']) : "";

        if(!empty($token))
            $is_valid_user_row = $db->get_row("select CellNbr as cell_number,Contry as user_country,app_token,UserId as user_id,NickName as nick_name,UserPic as user_pic,Points as user_points,UserMail as email,concat(UserName,' ',FamName) as full_name from users where app_token = '$token'");
        else if(!empty($id))
            $is_valid_user_row = $db->get_row("select CellNbr as cell_number,Contry as user_country,app_token,UserId as user_id,NickName as nick_name,UserPic as user_pic,Points as user_points,UserMail as email,concat(UserName,' ',FamName) as full_name from users where UserId = '$id'");
        else
            {
                $is_valid_user_row = false;
            }
        if($is_valid_user_row)
            {
                $member_id = $is_valid_user_row->user_id;//Id of the user visited
                $member_total_rate = get_user_total_rate($member_id);//Get total rate for visited user user
                $rater_id = -1;
                $member_user_rate = 0;
                if(isset($user_infos['u']))
                    {
                        $rater_id_var = $db->get_var("select UserId from users where UserId = '". InputFilter($user_infos['u']."'"));//Validate the rater id if is for valid user
                        if($rater_id_var)
                            {
                                $rater_id = $rater_id_var;
                                $member_user_rate = get_user_rate_for_member($member_id,$rater_id);
                            }
                    }
                $user_id = $member_id;
                $nick_name = $is_valid_user_row->nick_name;
                $email = $is_valid_user_row->email;
                $cell_number = $is_valid_user_row->cell_number;
                $full_name = $is_valid_user_row->full_name;
                $user_pic = $is_valid_user_row->user_pic;
                $user_points = $is_valid_user_row->user_points;
                $user_country = $is_valid_user_row->user_country;
                $infos_arr = array("c" => $cell_number,"co" => $user_country,"e" => $email,"f" => $full_name,"i" => $user_id,"n" => $nick_name,"p" => $user_pic,"pt" => $user_points,"rate" => $member_total_rate,"user_rate" => $member_user_rate);
            }
        else
            {
                $infos_arr = "-1";
            }
            
        if(isset($user_infos['j']))
            return json_encode(array("s" => '1',"i" => $infos_arr));
        else
            return $infos_arr;
    }

/** Function to update user infos passing an array that contains following indexes :
 * @param String $t Token of user we want to update their infos
 * @param String $n New NickName we want to set for user
 * @param String $e New email we want to set for user
 * @param String $p New password we want to set for user
 * @param String $c New country we want to set for user
 * @return json_object indicating process result
 * 
 * Properties may object have :
 *
 * $s : Contain the status of the operation('001' => [lack_infos] , '002' => [invalid_token],'003' => [No update needed],'1' => [update_succeed]
 * 
 * $i : Is a json object that will contain new user infos (this object is generated via get_user_infos() function @see get_user_infos())
 * 
 * $v : Is a json object that will contain infos validity test to have more infos which value has been updated and which value have not
        (eg : new nick_name may is not valid while new email it is so email will be updated while nick_name will not be so the $v object will be {n => 3,e => 1})
 * @author Mohammad Zein Eddine <mohammad@phptransformer.com>
*/
function set_user_infos($user_infos = array("t" => "","n" => "","e" => "","p" => "","c" => ""))
    {
        global $db;
        if(empty($db))
            $db = new db();

        $passed_token = isset($user_infos['t'])?InputFilter($user_infos['t']):"";
        if(!empty($passed_token))
        {
            $is_valid_token_row = $db->get_row("select CellNbr,concat(UserName,' ',FamName) as full_nameContry,UserId,NickName,UserMail,Password from users where app_token = '$passed_token'");
            if($is_valid_token_row)
                {
                    $new_full_name_bool = isset($user_infos['n']) && !empty($user_infos['n']) && $user_infos['n'] != $is_valid_token_row->full_name? '1' : 0;
                    $new_phone_bool = isset($user_infos['ph']) && !empty($user_infos['ph']) && is_numeric($user_infos['ph']) && $user_infos['ph'] != $is_valid_token_row->CellNbr? '1' : 0;
                    $new_email_bool = isset($user_infos['e']) && !empty($user_infos['e']) && $user_infos['e'] != $is_valid_token_row->UserMail? '1' : 0;
                    $new_password_bool = isset($user_infos['p']) && !empty($user_infos['p']) && $user_infos['p'] != $is_valid_token_row->Password? '1' : 0;
                    $new_country_bool = isset($user_infos['c']) && !empty($user_infos['c']) && $user_infos['c'] != $is_valid_token_row->Contry? '1' : 0;
                    if((isset($user_infos['ph']) && !$new_phone_bool) && !$new_full_name_bool && !$new_email_bool && !$new_password_bool && !$new_country_bool)
                        {
                            return json_encode(array("s"=>'003'));
                        }
                    else
                        {
                            $full_name_arr = explode(' ',$user_infos['n'],2);
                            $user_name = $full_name_arr[0];
                            $family_name = count($full_name_arr)> 0 && !empty($full_name_arr[1])?$full_name_arr[1] : '';
                            //$is_found_nickname_var = $db->get_var("select NickName from users where NickName = '".$user_infos['n']."'");
                            $new_full_name_sql = $new_full_name_bool ? "UserName = '".$user_name."',FamName = '".$family_name."'," : "";
                            if(empty($new_full_name_sql))
                                {
                                    if($new_full_name_bool === 0)
                                        $new_full_name_bool = 2;
                                    else
                                        $new_full_name_bool = 3;
                                }
                            
                            $new_phone_sql = $new_phone_bool ? "CellNbr = '".$user_infos['ph']."'," : "";
                            if(empty($new_phone_sql))
                                {
                                    if($new_phone_bool === 0)
                                        $new_phone_bool = 2;
                                    else
                                        $new_phone_bool = 3;
                                }
                                
                            $is_found_email_var = !$db->get_var("select UserMail from users where UserMail = '".$user_infos['e']."'");
                            $new_email_sql = $new_email_bool && !$is_found_email_var && check_email_address($user_infos['e'])?"UserMail = '".$user_infos['e']."'," : "";
                            if(empty($new_email_sql))
                                {
                                    if($new_email_bool === 0)
                                        $new_email_bool = 2;
                                    else
                                        $new_email_bool = 3;
                                }

                            $new_password_sql = $new_password_bool ? "Password = '".md5($user_infos['p'])."'," : "";
                            if(empty($new_password_sql))
                                {
                                    if($new_password_bool === 0)
                                        $new_password_bool = 2;
                                    else
                                        $new_password_bool = 3;
                                }

                            $new_country_sql = $new_country_bool ? "Contry = '".$user_infos['c']."'," : "";
                            if(empty($new_country_sql))
                                {
                                    if($new_country_bool === 0)
                                        $new_country_bool = 2;
                                    else
                                        $new_country_bool = 3;
                                }
                            if(!empty($new_full_name_sql) || !empty($new_phone_sql) || !empty($new_email_sql) || !empty($new_password_sql) || !empty($new_country_sql))
                                {
                                    $news_sql = "update users set ".$new_full_name_sql.$new_phone_sql.$new_email_sql.$new_password_sql.$new_country_sql;
                                    //echo $news_sql;
                                    $news_sql = substr($news_sql,0,strlen($news_sql) - 1)." where app_token = '$passed_token'";
                                    $db->query($news_sql);
                                }
                            return json_encode(array("s" => '1',"i" => get_user_infos(array("t" => $passed_token)),"v" => array("e" => $new_email_bool,"n" => $new_full_name_bool,"p" => $new_password_bool,"c" => $new_country_bool,"ph" => $new_phone_bool)));
                        }
                }
            else
                {
                    return json_encode(array("s" => '002'));
                }
        }
        else
        {
            return json_encode(array("s" => '001'));
        }
    }

/** Function to get last 10 reporters having higher values of points as json object
 * @return json_object The returned object may will contain following properties :
 * 
 * $s : Contain operation result status ('0' => No reporters found , '1' => Reporters found and their were a property r)
 * 
 * $r : Is a json object that contains multiple json object each reporter is an object in this global object
 *      reporter object may contains following properties :
 * 
 *      $f : Reporter full name
 * 
 *      $i : Reporter user id
 * 
 *      $n : Reporter nick name
 * 
 *      $p : Reporter user pic path
 * 
 *      $pt : Reporter points
 */
function get_last_reporters()
    {
        global $db;
        if(empty($db))
            $db = new db();

        $result = array("s"=>"","r" => array());
        $last_reporters_sql = "select u.UserId as user_id,u.UserPic as user_pic,u.NickName as user_nickname,concat(u.UserName,' ',u.FamName) as user_full_name,u.Points as user_points from users as u,groups as g where u.NickName != 'admin' and u.NickName != 'Guest' and g.GroupId = u.GroupId and g.GroupName != 'agencies' Order By Points desc limit 0,10";
        $last_reporters_res = $db->get_results($last_reporters_sql);
        if(count($last_reporters_res) > 0)
            {
                $result["s"] = '1';
                $index = 0;
                foreach($last_reporters_res as $reporter_row)
                    {
                        if(!isset($reporter_row->user_pic) || empty($reporter_row->user_pic) || !file_exists("../../".$reporter_row->user_pic))
                            $reporter_pic = "images/avatars/default.jpg";
                        else
                            $reporter_pic = $reporter_row->user_pic;
                        $reporter_total_rate = get_user_total_rate($reporter_row->user_id);
                        $result["r"][$index] = array("f" => $reporter_row->user_full_name,"i" => $reporter_row->user_id,"n" => $reporter_row->user_nickname,"p" => $reporter_pic,"pt" => $reporter_row->user_points,"rate" => $reporter_total_rate);
                        $index++;
                    }
            }
        else
            {
                $result["s"] = '0';
            }
        return json_encode($result);
    }

//This function will send notification suitable to a passed token is token is a token that will point to a session array that contains the news id and type
function notify($notification_infos = array("t"))
    {   
        @session_start();
        global $db;
        if(empty($db))
            $db = new db();
        
        //var_dump($_SESSION);
        if(isset($notification_infos['t']) && isset($_SESSION['notification'][$notification_infos['t']]['token']))
            {
                $notification_token = $_SESSION['notification'][$notification_infos['t']]['token'];
                $news_id = $_SESSION['notification'][$notification_token]['news_id'];
                $type = $_SESSION['notification'][$notification_token]['type'];
                
                $is_urgent_var = $db->get_var("select urgent from news where IdNews = '$news_id'");
                if($is_urgent_var && $is_urgent_var == 1)
                    $is_urgent = 1;
                else
                    $is_urgent = 0;
                if($type == 2)//notify admins
                    {
                        $android_admins = $db->get_results("select UserId,android_id,apple_id,uuid,PrefLang from users,admins where users.UserId = admins.AdminId and users.android_id <> '0' and users.android_id <> '' limit 0,990");
                        if($android_admins && is_array($android_admins) && count($android_admins) > 0)
                            {
                                api_send_android_notifications_to_those_users($android_admins, $news_id, $news_id, 1,array("e" => 1));
                            }
                        $apple_admins = $db->get_results("select UserId,android_id,apple_id,uuid,PrefLang from users,admins where users.UserId = admins.AdminId and users.apple_id <> '0' and users.apple_id <> '' limit 0,990");
                        if(count($apple_admins) > 0)
                            {
                                $fp = apple_ssl_connect();
                                if(!empty($fp))
                                    {
                                        foreach($apple_admins as $apple_admin)
                                            {
                                            api_applesendNotification($fp,$apple_user_row, $news_id,$news_id,1, array("e" => 1));
                                            }
                                        fclose($fp);
                                    }
                            }
                    }
                else
                    {
                        $android_users_count_var = $db->get_var("select count(*) from users where android_id <> '0' and android_id <> ''");
                        if($is_urgent === 1)
                            $android_guest_count_var = $db->get_var("select count(*) from cyberapp where android_id <> '0' and android_id <> ''");
                        if($android_users_count_var && $android_users_count_var > 0 || ($is_urgent === 1 && $android_guest_count_var && $android_guest_count_var > 0))
                            {
                                if($is_urgent === 1)
                                    $all_android_ids = $android_users_count_var + $android_guest_count_var;
                                else
                                    $all_android_ids = $android_users_count_var;
                                
                                $android_pages = round(($all_android_ids / 500));
                                for($counter = 0;$counter <= $android_pages;$counter ++)
                                    {
                                        $start = $counter * 500;
                                        if($is_urgent === 1)
                                            {
                                                $paginated_users = $db->get_results("select UserId,android_id,apple_id,uuid,PrefLang from users where android_id <> '0' and android_id <> '' 
                                                                                        UNION
                                                                                    select id,android_id,apple_id,uuid,PrefLang from cyberapp where android_id <> '0' and android_id <> '' limit $start,500");
                                            }
                                        else
                                            {
                                                $paginated_users = $db->get_results("select UserId,android_id,apple_id,uuid,PrefLang from users where android_id <> '0' and android_id <> '' limit $start,500");
                                            }
                                        if($paginated_users && is_array($paginated_users) && count($paginated_users > 0))
                                            {
                                                api_send_android_notifications_to_those_users($paginated_users, $news_id, $news_id, $is_urgent,array("s" => 1));
                                            }
                                    }
                            }
                        
                        $apple_users_count_var = $db->get_var("select count(*) from users where apple_id <> '0' and apple_id <> ''");
                        if($is_urgent === 1)
                            $apple_guest_count_var = $db->get_var("select count(*) from cyberapp where apple_id <> '0' and apple_id <> ''");
                        
                        if($apple_users_count_var && $apple_users_count_var > 0 || ($is_urgent === 1 && $apple_guest_count_var && $apple_guest_count_var > 0))
                            {
                                //$apple_pages = round(($all_apple_ids / 500));
                                if($is_urgent === 1)
                                    {
                                        $paginated_users = $db->get_results("select UserId,android_id,apple_id,uuid,PrefLang from users where apple_id <> '0' and apple_id <> '' 
                                                                                        UNION
                                                                                    select id,android_id,apple_id,uuid,PrefLang from cyberapp where apple_id <> '0' and apple_id <> ''");
                                    }
                                else
                                    {
                                        $paginated_users = $db->get_results("select UserId,android_id,apple_id,uuid,PrefLang from users where apple_id <> '0' and apple_id <> ''");
                                    }
                                $fp = apple_ssl_connect();
                                if(count($paginated_users))
                                    {
                                        if(!empty($fp))
                                            {
                                                foreach($paginated_users as $apple_user_row)
                                                    {
                                                        api_applesendNotification($fp,$apple_user_row, $news_id,$news_id,$is_urgent, array("s" => 1));
                                                    }
                                                fclose($fp);
                                            }
                                    }
                            }
                        
                    }
                unset($_SESSION['notification'][$notification_infos['t']]);
                if($type === 1)
                    {
                        ping_news($news_id);
                    }
                return json_encode(array("s" => '1'));
            }
        else
            {
                return json_encode(array("s" => '002',"t" => "invalid token"));
            }
    }

// Function to send notification to android devices
function api_androidsendNotification($apiKey, $registrationIdsArray, $messageData)
    {
        $headers = array("Content-Type:" . "application/json", "Authorization:" . "key=" . $apiKey);
        $data = array(
            'collapse_key' => 'cyberaman',
            'delay_while_idle' => true,
            'data' => $messageData,
            'registration_ids' => $registrationIdsArray
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

//This function will prepare notification message for android devices
//$note_data is used to send additional infos in notification
function api_androidprepare_message($id, $on_going, $message, $title, $ticker, $mid,$note_data)
    {
        $id = $id;
        $on_going = $on_going;
        $message = $message;
        $title = $title;
        $ticker = $ticker;
        $mid = $mid;
        $data_message = array("id" => "$id", "on_going" => $on_going, "message" => $message, "title" => $title, "ticker" => $ticker, "mid" => $mid,"data" => $note_data);
        return $data_message;
    }

//This function will send notification to android users
function api_send_android_notifications_to_those_users($paginated_users, $id_news, $id_news_group, $is_urgent,$note_data)
    {
        global $android_key, $db;
        if (empty($db))
            $db = new db();

        $i = 0;
        $j = 0;
        $e = 0;

        $message_id = substr($id_news, -6, 6);
        $languages = $db->get_results("select * from languages where Deleted <> 1");
        $category_id = $db->get_var("select cl.IdCat from catlang as cl,newscategoies as nc where cl.IdCat = nc.IdCat and nc.IdNews = '$id_news'");
        foreach ($languages as $language)
            {
                $lang_id = $language->IdLang;
                $message_infos = $db->get_row("select Tilte,Breif from newslang where IdNews = '$id_news' and IdLang = '$lang_id'");
                if ($message_infos)
                    {
                        $title = $message_infos->Tilte;
                        $full_message = $message_infos->Breif;
                        $message = mb_substr($full_message, 0, 150, 'utf8');
                        $ticker = $title;
                        $android_id = array();
                        $users_id = array();
                        foreach ($paginated_users as $member)
                            {
                                if($member->PrefLang == $language->LangName)
                                    {
                                        $is_user_var = $db->get_var("select UserId from users where UserId = '".$member->UserId."'");
                                        $is_guest_var = $db->get_var("select Id from cyberapp where Id = '".$member->UserId."'");
                                        $user_type = $is_user_var ? "users" : "cyberapp";
                                        if(isset($note_data['e']))
                                            {
                                                $android_id[] = $member->android_id;
                                                $users_type[] = $user_type;
                                            }
                                        else
                                            {
                                                if($is_guest_var)
                                                    {
                                                        if($is_urgent === 1)
                                                            {
                                                                $android_id[] = $member->android_id;
                                                                $users_type[] = $user_type;
                                                            }
                                                    }
                                                else if($is_user_var)
                                                    {
                                                        $is_subscribed_row = $db->get_row("select only_urgent from notification where id_news_group = '$category_id' and id_user = '".$member->UserId ."'");
                                                        if($is_subscribed_row)
                                                            {
                                                                if($is_urgent == 0)
                                                                    {
                                                                        if($is_subscribed_row->only_urgent == 0)
                                                                            {
                                                                                $android_id[] = $member->android_id;
                                                                                $users_type[] = $user_type;
                                                                            }
                                                                    }
                                                                else
                                                                    {
                                                                        $android_id[] = $member->android_id;
                                                                        $users_type[] = $user_type;
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                        if (count($android_id) > 0)
                            {
                                if(isset($note_data['e']))
                                    {
                                        $ticker = api_for_auditing.$ticker;
                                        $title = api_for_auditing . $title;
                                    }
                                $data_message = api_androidprepare_message($message_id, "false", str_replace(array('&nbsp;'), array(' '), strip_tags($message)), str_replace(array('&nbsp;'), array(' '), strip_tags($title)), str_replace(array('&nbsp;'), array(' '), strip_tags($ticker)), $id_news_group,$note_data);
                                $response = api_androidsendNotification($android_key, $android_id, $data_message);
                                $new_response = json_decode($response);
                                if ($new_response->canonical_ids)
                                    {
                                        $h = 0;
                                        foreach ($new_response->results as $resp)
                                            {
                                                if (property_exists($resp, 'registration_id'))
                                                    {
                                                        $db->query("update " . $users_type[$h] ." set `android_id` = '" . $resp->registration_id . "' where android_id = '" . $android_id[$h] . "'");
                                                    }
                                                $h++;
                                            }
                                    }
                                else
                                    {
                                        //echo('yeahhhhhhh');
                                    }
                            }
                    }
            }
    }

/* open an ssl connection with apple server using a specific certificate */
function apple_ssl_connect()
    {
        $passphrase = 'F0mac2k44';//private key used when creating this certificate
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'c2k.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        $fp = stream_socket_client(
            'ssl://gateway.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp)
            {
                return 0;
            }
        else
            {
                return $fp;
                //file_put_contents("visible.txt","connected",FILE_APPEND);
            }
    }

/**
 * 
 * @global db $db
 * @param stream_socket_client $fp : an ssl socket this is usually returned from an apple_connection @see apple_ssl_connect
 * @param db_row $user_row : Is the object that will contain infos of the user we want to send notification to him
 * @param String $news_id : The id of the news we want to send in notification
 * @param String $news_id : The id of the news we want to send in notification
 * @param int $is_urgent : Represent if this news is urgent or not to know if this user must get this infos or not
 * @param Array $data : Additional data to send with notification
 */
function api_applesendNotification($fp,$user_row,$news_id,$news_id,$is_urgent,$data)
    {
        global $db;
        if(empty($db))
            $db = new db();
        
        $send = 0;
        $languages = $db->get_results("select * from languages where Deleted <> 1");
        $category_id = $db->get_var("select cl.IdCat from catlang as cl,newscategoies as nc where cl.IdCat = nc.IdCat and nc.IdNews = '$news_id'");
        foreach ($languages as $language)
            {
                $lang_id = $language->IdLang;
                $message_infos = $db->get_row("select Tilte,Breif from newslang where IdNews = '$news_id' and IdLang = '$lang_id'");
                if ($message_infos)
                    {
                        $title = $message_infos->Tilte;
                        $full_message = $message_infos->Breif;
                        $message = mb_substr($full_message, 0, 150, 'utf8');
                        $ticker = $title;
                        if($user_row->PrefLang == $language->LangName)
                            {
                                $is_user_var = $db->get_var("select UserId from users where UserId = '".$user_row->UserId."'");
                                $is_guest_var = $db->get_var("select Id from cyberapp where Id = '".$user_row->UserId."'");
                                if(isset($note_data['e']))
                                    {
                                        $send = 1;
                                    }
                                else
                                    {
                                        if($is_guest_var)
                                            {
                                                if($is_urgent === 1)
                                                    {
                                                        $send = 1;
                                                    }
                                            }
                                        else if($is_user_var)
                                            {
                                                $is_subscribed_row = $db->get_row("select only_urgent from notification where id_news_group = '$category_id' and id_user = '".$member->UserId ."'");
                                                if($is_subscribed_row)
                                                    {
                                                        if($is_urgent == 0)
                                                            {
                                                                if($is_subscribed_row->only_urgent == 0)
                                                                    {
                                                                        $send = 1;
                                                                    }
                                                            }
                                                        else
                                                            {
                                                                $send = 1;
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }
        if($send === 1)
            {
                $deviceToken = $user_row->apple_id;
                $badge = 1;
                $body['aps'] = array(
                                        'alert' => array("body" => $title,"loc-args" => $news_id),
                                        'badge' => $badge,
                                        'sound' => 'newMessage.wav',
                                        "newsid" => $news_id,
                                        "message" => $title
                                    );
                if(isset($data['e']))
                    $body['aps']['e'] = 1;
                else
                    $body['aps']['s'] = 1;
                
                $payload = json_encode($body);
                $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
                $result = fwrite($fp, $msg, strlen($msg));
                /*if (!$result)
                    file_put_contents("could_not_sent.txt","Not sended : " . PHP_EOL,FILE_APPEND);
                else
                    file_put_contents("sent.txt" , 'notification sent!' . PHP_EOL,FILE_APPEND);*/
            }
    }
    
/** 
 * 
 * @param Array $news_info contains following indexes :
 *          - i : Id of news
 *          - l : Language we want to fetch news details in
 * @return Json_object that may contains following properties :
 *          - s : String Status of process ('002' -> No news with passed id and passed language,'1' -> News details found)
 *          - r : Array contains the news details in the following indexes :
 *                  - i : News id
 *                  - t : News title
 *                  - c : News full message
 *                  - ca : News category
 */
function get_news_infos($news_info = array("i" => "","l" => ""))
    {
        global $db,$default_language;
        if(empty($db))
            $db = new db();
        
        $is_language_var = $db->get_var("select LangName from languages where LangName = '".InputFilter($news_info['l'])."'");
        if($is_language_var)
            {
                $news_language = $is_language_var;
            }
        else
            {
                $news_language = $default_language;
            }
        
        $is_valid_news_row = $db->get_row("select nl.Tilte as news_title,nl.FullMessage as news_full_message,n.IdNews as news_id,nc.IdCat "
                                            . "from news as n,newslang as nl,languages as l,newscategoies as nc where "
                                            . "l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.IdNews = nc.IdNews and "
                                            . "n.IdNews = '".InputFilter($news_info['i'])."' and l.LangName = '$news_language'");
        
        if($is_valid_news_row)
            {
                return json_encode(array("s" => '1',"r" => array("i" => $is_valid_news_row->news_id,"t" => $is_valid_news_row->news_title,"c" => $is_valid_news_row->news_full_message,"ca" => $is_valid_news_row->IdCat)));
            }
        else
            {
                return json_encode(array("s" => '002'));
            }
    }
    
//This function will send news and return notification token to use when sending notifications see @send_news
function edit_news($news_infos = array("t" => "","id" => "","l" => "","c" => "","a" => "","ca" => "","i" => "","v" => "","u" => "","ti" => ""))
    {
        global $db;
    
        if(empty($db))
            $db = new db();
    
        $user_id = $db->get_var("select UserId from users as u,admins as a where u.UserId = a.AdminId and u.app_token = '".InputFilter($news_infos['t'])."'");
    
        if(!isset($news_infos['t']) || empty($news_infos['t']) || !$user_id)
            return json_encode(array("s" => '002'));
    
        $news_language = $db->get_var("select IdLang from languages where LangName = '".InputFilter($news_infos['l'])."' and Deleted != 1");
        if(!isset($news_infos['l']) || empty($news_infos['l']) || !$news_language)
            return json_encode(array("s" => '003'));
    
        $news_id = $db->get_var("select n.IdNews from news as n,newslang as nl where n.IdNews = nl.IdNews and nl.IdNews = '".InputFilter($news_infos['id'])."' and nl.IdLang = '$news_language' and n.Deleted != 1");
        if(!isset($news_infos['id']) || empty($news_infos['id']) || !$news_id)
            return json_encode(array("s" => '004'));
    
        $news_infos_row = $db->get_row("select nl.Tilte,nl.FullMessage,n.agency,n.urgent,n.NewsPic,n.Date from news as n,newslang as nl where n.IdNews = nl.IdNews and nl.IdLang ='$news_language' and n.IdNews = '$news_id'");
        if($news_infos_row)
            {
                $news_old_content = $news_infos_row->FullMessage;
                $news_old_title = $news_infos_row->Tilte;
                $news_old_urgent = $news_infos_row->urgent;
                $news_old_agency = $news_infos_row->agency;
                $news_old_category = $db->get_var("select cl.IdCat from catlang as cl,newscategoies as nc where cl.IdCat = nc.IdCat and cl.IdLang = '$news_language' and nc.IdNews = '$news_id'");
                $news_old_picture = $news_infos_row->NewsPic;
                $news_old_date = $news_infos_row->Date;
            
                $news_new_content = isset($news_infos['c']) && !empty($news_infos['c']) ? InputFilter($news_infos['c']) : $news_old_content;
                $news_new_content= str_replace(array("\n"),array("<line>"),$news_new_content);
            
                $news_new_title = isset($news_infos['ti']) && !empty($news_infos['ti']) ? InputFilter($news_infos['ti']) : $news_old_title;
                $news_new_title = str_replace(array(":", "/", "\\", "@","#",'"',"'","\n","<line>"), array("", " ", " ", "","","",""," "," "),$news_new_title);
                
                $news_new_urgent = isset($news_infos['u']) && !empty($news_infos['u']) && $news_infos['u'] == 1? 1 : $news_old_urgent;
                $news_new_agency = isset($news_infos['a']) && !empty($news_infos['a']) && $db->get_var("select NickName from users as u,groups as g where g.GroupId = u.GroupId and (md5(u.NickName) = '" . md5(InputFilter($news_infos['a'])) . "') and g.GroupName = 'agencies'") ? InputFilter($news_infos['a']) : $news_old_agency;
                $news_new_category = isset($news_infos['ca']) && !empty($news_infos['ca']) ? InputFilter($news_infos['ca']) : $news_old_category;
            
                $news_new_brief = str_replace(array("<line>"),array(" "),$news_new_content);
                $news_new_brief = mb_substr($news_new_brief,0,500,"utf8");
                
                $news_new_full_message = str_replace(array("<line>"),array("<br />"),$news_new_content);
                
                /*preg_replace('/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]'.
                '|[\x00-\x7F][\x80-\xBF]+'.
                '|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*'.
                '|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})'.
                '|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S',
                '', $news_content);*/
            
                $notify = 1;
                $notification_token = md5(time().time().rand(0,999));
                $news_active = 1;
                $news_deleted = 0;
            
                if(isset($news_infos['i']) && !empty($news_infos['i']))
                    {
                        $passed_news_images = InputFilter($news_infos['i']);
                        $passed_news_images_arr = explode('||',$passed_news_images);
                        foreach($passed_news_images_arr as $passed_news_image)
                            {
                                if(file_exists("../../uploads/gallery/Albums/$year/$day-$month-$year/$passed_news_image"))
                                    {
                                        $news_images_arr[] = $passed_news_image;
                                    }
                            }

                        if(empty($news_old_picture))
                            {
                                if(isset($news_images_arr) && is_array($news_images_arr) && count($news_images_arr) > 0)
                                    {
                                        $news_new_picture = $news_images_arr[0];
                                    }
                                else
                                    {
                                        $news_new_picture = 'newspaper.png';
                                        $news_images_arr = array();
                                    }
                            }
                        else
                            {
                                $news_new_picture = $news_old_picture;
                            }
                    }
                else
                    {
                        if(empty($news_old_picture))
                            {
                                $rand_name = rand(1, 5);
                                if (is_file("../../uploads/news/pics/" . $news_new_category . "/" . $rand_name . ".jpg"))
                                    {
                                        $news_new_picture = $news_new_category . "/" . $rand_name . ".jpg";
                                    }
                                else
                                    {
                                        $news_new_picture = 'newspaper.png';
                                    }
                                $news_images_arr = array();
                            }
                        else
                            {
                                $news_new_picture = $news_old_picture;
                                $news_images_arr = array();
                            }
                    }

            if(isset($news_infos['v']) && !empty($news_infos['v']))
                {
                    $passed_news_videos = InputFilter($news_infos['v']);
                    $news_videos_array = explode('||', $passed_news_videos);
                }
            else
                {
                    $news_videos_array = array();
                }       
    
            $update_news_sql = "update news set Active = $news_active,NewsPic = '$news_new_picture',Deleted = $news_deleted,urgent = $news_new_urgent,agency = '$news_new_agency' where IdNews = '$news_id'";
            $update_news_qu = $db->query($update_news_sql);
            if($db->dbh->affected_rows > 0)
                {
                    if($news_new_urgent === 1)
                        {
                            $marquee_message = str_replace(array(":", "/", "\\", "@", '"', "'", "#"), array("", "", "", "", "", "", ""), $news_new_title);
                            $marquee_title_in_link = mb_substr($marquee_message, 0, 40, "utf8");
                            $marquee_id = GenerateID('marques', 'idMarque');
                            $marquee_link = CreateLink('',array('Prog','ns','idnews','title'),array('cybernews','details',$news_id,$marquee_title_in_link));
                            $marquee_start_date = date('Y-m-d H:i:s',time());
                            $marquee_end_date = date('Y-m-d H:i:s', strtotime("$marquee_start_date +30 hours"));
                            $db->query("insert into marques(idMarque,Link,StartDate,EndDate,Deleted) values('$marquee_id','$marquee_link','$marquee_start_date','$marquee_end_date','0')");
                            $db->query("insert into marqlang(idmarque,idLang,Message) values('$marquee_id','$news_language','$marquee_message')");
                        }
                    if($news_new_category != $news_old_category)
                        {
                            $db->query("delete from newscategoies where IdCat = '$news_old_category' and IdNews = '$news_id'");
                            $insert_news_category_sql = "insert into `newscategoies` values('$news_id','$news_new_category')";
                            $insert_news_category_qu = $db->query($insert_news_category_sql);
                        }
                    //$insert_news_category_sql;

                    $news_new_full_message .= '<div id="news_desc_images_wrapper_div">';
                    $all_images = '<br />';
                    if(count($news_images_arr)>0)//If their is any image uploaded
                        {
                            $counter = 0;
                            foreach($news_images_arr as $news_image_row)
                                {
                                    if($counter === 0 && empty($news_old_picture))
                                        {
                                            create_news_thumbs("../../uploads/gallery/Albums/$year/$day-$month-$year/" . $news_image_row, "../../uploads/news/pics/" . $news_image_row, 100);
                                            $mobile_news_image = str_replace('.', '_320.', $news_image_row);
                                            create_news_thumbs("../../uploads/gallery/Albums/$year/$day-$month-$year/" . $news_image_row, "../../uploads/news/pics/" . $mobile_news_image, 320);
                                        }
                                    $extension = pathinfo($news_image_row, PATHINFO_EXTENSION);
                                    $media_id = GenerateID("gallery", 'IdMedia');
                                    $media_path = "uploads/gallery/Albums/$year/$day-$month-$year/$news_image_row";
                                    $addition_date = $news_old_date;
                                    $media_location = "";
                                    $media_rank = "";
                                    $media_type = $extension;
                                    $news_caption = InputFilter($news_new_title);
                                    $Desc = "";
                                    $Place = "";
                                    $Tags = "";
                                    $insert_to_gallery_sql = "insert into gallery(IdMedia,Path,AddDate,MapLocation,MediaRank,MediaType) values ('$media_id','$media_path','$addition_date','$media_location','$media_rank','$media_type')";
                                    $insert_to_gallery_qu = $db->query($insert_to_gallery_sql);
                                    $insert_into_gallery_lang_sql = "insert into gallerylang(`IdMedia`,`IdLang`,`Caption`,`Desc`,`Place`,`Tags`) values ('$media_id','$news_language','$news_caption','$Desc','$Place','$Tags')";
                                    $insert_into_gallery_lang_qu = $db->query($insert_into_gallery_lang_sql);
                                    $all_images .= "<div class=\'news_desc_images\'><img src=\'uploads/gallery/Albums/$year/$day-$month-$year/$news_image_row\' /></div>";
                                    $counter++;
                                }
                        }
                    else
                        {
                            if(empty($news_old_picture))
                                {
                                    if (is_file("../../uploads/gallery/Albums/$news_category/$rand_name.jpg"))
                                        {
                                            $all_images .= "<div class=\'news_desc_images\'><img src=\'uploads/gallery/Albums/$news_category/$rand_name.jpg \' /></div>";
                                        }
                                }
                        }
                        
                    $all_videos = '<br />';
                    
                    if (count($news_videos_array) > 0)
                        {//If their is any video uploaded
                            foreach ($news_videos_array as $news_video)
                                {
                                    $IdMedia = GenerateID("gallery", 'IdMedia');
                                    $Path = "uploads/gallery/Albums/$year/$day-$month-$year/$news_video";
                                    $AddDate = $news_old_date;
                                    $MapLocation = "";
                                    $MediaRank = "";
                                    $MediaType = "youtube";
                                    $Caption = InputFilter($news_new_title);
                                    $Desc = "";
                                    $Place = "";
                                    $Tags = "";
                                    $insert_to_gallery_sql = "insert into gallery(IdMedia,Path,AddDate,MapLocation,MediaRank,MediaType) values ('$IdMedia','$Path','$AddDate','$MapLocation','$MediaRank','$MediaType')";
                                    $insert_to_gallery_qu = $db->query($insert_to_gallery_sql);
                                    $insert_into_gallery_lang_sql = "insert into gallerylang(`IdMedia`,`IdLang`,`Caption`,`Desc`,`Place`,`Tags`) values ('$IdMedia','$news_language','$Caption','$Desc','$Place','$Tags')";
                                    $insert_into_gallery_lang_qu = $db->query($insert_into_gallery_lang_sql);
                                    $all_videos .= '<div class="news_desc_videos">'
                                                    . '<iframe width="420" height="315" src="//www.youtube.com/embed/' . $news_video . '" frameborder="0" allowfullscreen></iframe>'
                                                 . '</div>';
                                }
                        }
                        
                    $news_new_full_message .= $all_images.$all_videos.'</div>';
                    str_replace(array('src=\"//', 'src=\'//', 'src=//'), array('src="http://', 'src=\'http://', 'src=http://'), $news_new_full_message);
            
                    $update_news_lang_sql = "update newslang set Tilte = '$news_new_title',Breif = '$news_new_brief',FullMessage = '$news_new_full_message' where IdNews = '$news_id'";
                     $update_news_lang_qu = $db->query($update_news_lang_sql);
            
                    if(!empty($notification_token))
                        {
                            $_SESSION['notification'][$notification_token]['token']= $notification_token;
                            $_SESSION['notification'][$notification_token]['news_id'] = $news_id;
                            $_SESSION['notification'][$notification_token]['type'] = $notify;
                        }
                    return json_encode(array("s" => '1',"r" => array("id" => $news_id,"no" => $notify,"to" => $notification_token)));
                }
        }
    else
        {
            return json_encode(array("s" => '005'));
        }
}

function ping_news($news_id)
    {
        global $db,$default_language;
        if(empty($db))
            $db = new db();
        
        ob_start();
        $title = $db->get_var("select nl.Tilte from newslang,languages where l.IdLang = nl.IdLang and l.LangName = '$default_language' and nl.IdNews = '$news_id'");
        $ping_title = str_replace(array(":", "/", "\\", "@", '"', "'", "#"), array("", "", "", "", "", "", ""), $title);
        $ping_title_in_link = mb_substr($ping_title, 0, 40, "utf8");
        $url = CreateLink('',array('Prog','ns','idnews','title'),array('cybernews','details',$news_id,$ping_title_in_link));
        $_POST['Title'] = $ping_title_in_link;
        $_POST['Url'] = $url;
        include_once('../../includes/ping.php');
        ob_clean();
    }

/**
 * 
 * @global db $db
 * @global type $android_key
 * @param Array $notification_infos contain following indexes
 *          - t : String user token
 *          - u : Device uuid where we want to send our message
 *          - m : Message
 * @return type
 */
function send_private_notification($notification_infos = array("t" => "","u" => "","m"))
    {
        global $db,$android_key;
        if(empty($db))
            $db = new db();
        
        if(!isset($notification_infos['t']) || !$db->get_var("select AdminId from admins,users where users.UserId = admins.AdminId and users.app_token = '".InputFilter($notification_infos['t'])."'"))
            {
                return json_encode(array("s" => '002'));
            }
        
        if(!isset($notification_infos['u']) || (!$db->get_var("select uuid from cyberapp where uuid = '".InputFilter($notification_infos['u'])."'") && !$db->get_var("select uuid from users where uuid = '".InputFilter($notification_infos['u'])."'")))
            {
                return json_encode(array("s" => '003'));
            }
            
        if(!isset($notification_infos['m']) || empty($notification_infos['m']))
            {
                return json_enocde(array("s" => '004'));
            }
        
        $uuid = InputFilter($notification_infos['u']);
        $message = InputFilter($notification_infos['m']);
        $android_notification_id = "";
        $apple_notification_id = "";
        
        $android_notification_id = $db->get_var("select android_id from users where uuid = '$uuid'");
        if(!$android_notification_id)
            {
                $android_notification_id = $db->get_var("select android_id from cyberapp where uuid = '$uuid'");
                if(!$android_notification_id)
                    {
                        $apple_notification_id = $db->get_var("select apple_id from users where uuid = '$uuid'");
                        if(!$apple_notification_id)
                            {
                                $apple_notification_id = $db->get_var("select apple_id from cyberapp where uuid = '$uuid'");
                            }
                    }
            }
        if($android_notification_id)
            {
                $android_id = array($android_notification_id);
                $data_message = api_androidprepare_message('1', "false", str_replace(array('&nbsp;'), array(' '), strip_tags($message)), api_message_from_administration, $message, '1',array("m" => 1));
                $response = api_androidsendNotification($android_key, $android_id, $data_message);
                $decoded_response = json_decode($response);
                if($decoded_response->success == 1)
                    return json_encode(array("s" => '1'));
                else
                    return json_encode(array("s" => '005'));
            }
        else if($apple_notification_id)
            {
                $fp = apple_ssl_connect();
                if(!empty($f))
                    {
                        $deviceToken = $apple_notification_id;
                        $badge = 1;
                        $body['aps'] = array(
                                                'alert' => array("body" => $message),
                                                'badge' => $badge,
                                                'sound' => 'newMessage.wav',
                                                "message" => $message
                                            );
                        $body['aps']['m'] = 1;

                        $payload = json_encode($body);
                        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
                        $result = fwrite($fp, $msg, strlen($msg));
                        fclose($f);
                         return json_encode(array("s" => '1'));
                    }
                else
                    return json_encode(array("s" => '005'));
                
            }
    }

//Function to get news from rss channels that are specialized for an admin user
function get_user_rss_channels($user_infos = array("t" => ""))
    {
        global $db;
        if(empty($db))
            $db = new db();
        $user_token = isset($user_infos['t']) ? InputFilter($user_infos['t']):'';
        if(empty($user_token))
            return json_enocde(array("s" => '001'));
        $is_valid_user_token_var = $db->get_var("select UserId from users where app_token = '$user_token'");
        if(!$is_valid_user_token_var)
            return json_encode(array("s" => '002'));
        $user_id = $is_valid_user_token_var;
        $is_valid_user_id_var = $db->get_var("select AdminId from admins where AdminId = '$user_id'");
        if(!$is_valid_user_id_var)
            {
                return json_encode(array("s" => '003'));
            }
        $user_rss_channels_res = $db->get_results("select * from news_rss_channels where user_id = '$user_id'");
        $user_rss_news = array();
        if(count($user_rss_channels_res) > 0)
            {
                foreach($user_rss_channels_res as $user_channel_row)
                    {
                        $user_channel_id = $user_channel_row->channel_id;
                        $user_channel_name = $user_channel_row->channel_name;
                        $user_channel_infos_row = $db->get_row("select concat(UserName,' ',FamName) as user_name,UserPic as user_pic from users where UserId = '$user_channel_id'");
                        $user_channel_caption = $user_channel_infos_row->user_name;
                        $user_channel_pic = $user_channel_infos_row->user_pic;
                        $user_channel_link = $user_channel_row->channel_link;
                        $xmlstr = GetPageContent($user_channel_link);
                        $xmlData = simplexml_load_string($xmlstr);
                        if($xmlData)
                            {
                                $user_rss_news["$user_channel_id"] = array("c_i" => $user_channel_id,"c_n" => $user_channel_name,"c_c" => $user_channel_caption,"c_l" => $user_channel_link,"c_p" => $user_channel_pic,"c_n_s" => array());
                                foreach ($xmlData->channel->item as $news)
                                    {
                                        $counter = 0;
                                        if($news)
                                            {
                                                //echo($news->title);
                                                $news_title = $news->title . '';
                                                $news_description = str_replace("'", '"', $news->description . '');
                                                if ($news_description == "")
                                                    {
                                                        $news_description = $news_title;
                                                    }
                                                $news_link = $news->link . '';
                                                
                                                $news_already_exist = $db->get_row("select * from `newslang` where `IdLang`='20070000001' and `Tilte` like '%" . mb_substr($news_title, 0, 250) . "%' ");
                                                if(!$news_already_exist)
                                                    {
                                                        //$news_description .= "\n{br/}{div style='cursor:pointer; float:right;padding:10px;0px;10px;0px;' } {a onclick='window.open(\"".$news_link."\",\"_system\");'} ���� ����� �� ������ {/a} {/div}";
                                                        $user_rss_news["$user_channel_id"]["c_n_s"][] = array('t' => $news_title,'d' => $news_description,'l' => $news_link);
                                                        $counter ++;
                                                    }
                                            }
                                    }
                            }
                    }
                //var_dump($user_rss_news);
                if(count($user_rss_news) > 0)
                    {
                        $user_rss_result = array("s" => '1',"r" => $user_rss_news);
                        return json_encode($user_rss_result);
                    }
                else
                    {
                        return json_encode(array('s' => '005'));
                    }
            }
        else
            {
                $user_rss_news['-1'] = array("c_i" => '0',"c_n" => api_no_channel_to_follow,"c_c" => api_no_channel_to_follow,"c_l" => '',"c_p" => 'Programs/api_full/check.png',"c_n_s" => '');
                $user_rss_result = array("s" => '1',"r" => $user_rss_news);
                return json_encode($user_rss_result);
            }
    }
    
function xml2array( $xmlObject)
{
    $out = array();
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

    return $out;
}
?>