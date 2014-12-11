<?php
function convert_into_date($date,$format)
{
    $dateInfo = date_parse_from_format($format, $date);
    $unixTimestamp = mktime($dateInfo['hour'], $dateInfo['minute'], $dateInfo['second'],$dateInfo['month'], $dateInfo['day'], $dateInfo['year'],$dateInfo['is_dst']);
    return $unixTimestamp;
}
session_start();
header('p3p: CP="NOI ADM DEV PSAi COM NAV OUR OTR STP IND DEM"');
require_once 'config.php';
require_once 'connection.php';
require_once 'functions.php';
require_once 'src/facebook.php';

global $scope;

$app_id = $settings['app_id'];
$secret_key = $settings['secret_key'];
$app_url = $settings['app_url'];
$not_mobile_url = $settings['redirect_url'];
$global_container_template = file_get_contents("templates/global.php");
$like_template = file_get_contents("templates/like.php");
$top_menu_template = file_get_contents("templates/top_menu.php");
$standard_like = str_replace(array('{app_url}'), array($app_url), $like_template);
$logout_template = '<div class="display_score_back_to_menu_div"><a href="javascript:location.href=\'logout.php\';">logout</a></div>';
$scope = "user_likes,email,read_friendlists,publish_actions,photo_upload,user_photos,publish_stream,publish_actions,manage_friendlists";

$authorization_url = "http://www.facebook.com/dialog/oauth/?client_id=".$settings['app_id']."&redirect_uri=$not_mobile_url&scope=$scope&state=".md5(time());

$login_message = '';
$custom_head = "";
$like = "";

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array('appId' => $app_id,'secret' => $secret_key));
$signed_request=$facebook->getSignedRequest();

//$facebook->api('/me/feed', 'POST', array('name' => 'test.','caption' => 'caption','description' => 'description','place' => '232092733474164'));

if($signed_request && isset($signed_request['page']['liked']))
    $_SESSION['signed_request'] = $signed_request;
else
    $signed_request = (isset($_SESSION['signed_request']))?$_SESSION['signed_request']:"";

if(isset($signed_request['user']['locale']))
    {
        $lang_arr = explode('_',$signed_request['user']['locale']);
        $lang = $signed_request['user']['locale'];
        $current_lang = $lang_arr[0];
    }
else
    {
        $lang = "en_EN";
        $current_lang = "en";
    }

$_SESSION['lang'] = $lang;
require_once('lang/lang-'.$current_lang.'.php');
$standard_top_menu = str_replace(array('{allpics}','{mypics}','{uploadpic}','{winners}','{invite}'), array(all_pics,my_pics,upload_pic,winners,invite_friends), $top_menu_template);
$top_menu = $standard_top_menu;

if(isset($_GET['winners']))
    {
        $like = "";
        $winner_rs = mysql_query("select * from winners as w ,users as u where u.user_id = w.user order by w.id desc limit 0,1");
        if(is_resource($winner_rs) && mysql_num_rows($winner_rs) > 0)
            {
                $winners_res = mysql_fetch_assoc($winner_rs);
                $winner_id = $winners_res['user'];
                $winner_full_name = $winners_res['user_first_name'] . ' '.$winners_res['user_last_name'];
                $winner_picture = "http://graph.facebook.com/".$winner_id."/picture";
                $template = '<div style="float:right;margin-top: 10px;border: solid 1px #cccccc;padding: 20px;background: #e9e9e9e;">';
                $template .= '<a href="http://www.facebook.com/'.$winner_id.'"><img src="'.$winner_picture.'" /></a><br />'.$winner_full_name.' is the winner</div>';
            }
        else
            {
                $template = '<div style="float:right;margin-top: 10px;border: solid 1px #cccccc;padding: 20px;background: #e9e9e9e;"> Their is no winner at current time</div>';
            }
        $content = $template;
    }
else
    {
        $user_infos = get_user_status($signed_request, $facebook);
        list($my_infos,$url,$redirection_url,$user_status,$login_message)=$user_infos;
                
        if ($user_status != "not_liker")
            {
                if($user_status == "authorized")
                    {
                        $custom_head .= '<script type="text/javascript" src="js/fb_functions.js"></script>';
                        $user_id = $my_infos['id'];
                        if(isset($_GET['mypics']))
                            {
                                $like = "";
                                $custom_head .= '<script type="text/javascript" src="jquery/pictures.js"></script>';
                                $custom_head .= '<link rel="stylesheet" href="styles/pictures-'.$current_lang.'.css" />';
                                $results_per_page = 10;
                                $page = (isset($_GET['page']) && intval($_GET['page']) > 1)?intval($_GET['page']) : 1;
                                $start = ($page-1)*$results_per_page;
                                $pagination = "";
                                $all_pictures_count_res = mysql_fetch_assoc(mysql_query("select count(*) as c from codes as co,user_codes as uc where co.code_id = uc.code_id and uc.user_id = '$user_id' and co.code_image != '' and co.code_active = 1"));
                                $all_pictures_count = $all_pictures_count_res['c'];
                                if($all_pictures_count > $results_per_page)
                                    $pagination = paginate_results("index.php",$results_per_page,5,$all_pictures_count,$page,$url_variables = array('mypics'),$url_values = array('mypics'));
                                else
                                    $pagination = '';
                                $pictures_template = file_get_contents("templates/pictures.php");
                                $all_pictures = get_my_pictures($user_id,$page,$results_per_page);
                                $content = str_replace(array("{all_pictures}","{pagination}"),array($all_pictures,$pagination),$pictures_template);
                            }
                        else if(isset($_GET['upload']))
                            {
                                $custom_head .= '<script src="plugins/mini_uploader/assets/js/jquery.knob.js"></script>';
                                $custom_head .= '<script src="plugins/mini_uploader/assets/js/jquery.ui.widget.js"></script>';
                                $custom_head .= '<script src="plugins/mini_uploader/assets/js/jquery.iframe-transport.js"></script>';
                                $custom_head .= '<script src="plugins/mini_uploader/assets/js/jquery.fileupload.js"></script>';
                                $custom_head .= '<script src="plugins/mini_uploader/assets/js/script.js"></script>';
                                $custom_head .= '<link rel="stylesheet" href="styles/uploader-'.$current_lang.'.css" />';
                                $custom_head .= '<script type="text/javascript" src="jquery/uploader.js?v=2"></script>'."\n";
                                $like = "";
                                $uploader_template = file_get_contents("templates/upload.php");
                                $content = str_replace(array('{upload_message}','{choose_pic}','{activate}','{code}','{bon}'),array(upload_message,choose_pic,activate,code,bon),$uploader_template);
                            }
                        else
                            {
                                $custom_head .= '<script type="text/javascript" src="jquery/pictures.js"></script>';
                                $custom_head .= '<link rel="stylesheet" href="styles/pictures-'.$current_lang.'.css" />';
                                $results_per_page = 10;
                                $page = (isset($_GET['page']) && intval($_GET['page']) > 1)?intval($_GET['page']) : 1;
                                $start = ($page-1)*$results_per_page;
                                $pagination = "";
                                $all_pictures_count_res = mysql_fetch_assoc(mysql_query("select count(*) as c from codes as co,user_codes as uc where co.code_id = uc.code_id and co.code_image != '' and co.code_active = 1"));
                                $all_pictures_count = $all_pictures_count_res['c'];
                                if($all_pictures_count > $results_per_page)
                                    $pagination = paginate_results("index.php",$results_per_page,5,$all_pictures_count,$page,$url_variables = array('allpics'),$url_values = array('allpics'));
                                else
                                    $pagination = '';
                                $pictures_template = file_get_contents("templates/pictures.php");
                                $all_pictures = get_all_pictures($user_id,0,$page,$results_per_page);
                                $last_valid_round = mysql_query("select * from rounds where active = 1 order by id desc limit 0,1");
                                if(mysql_num_rows($last_valid_round)>0)
                                {
                                    $last_valid_round_res = mysql_fetch_array($last_valid_round);
                                    $current_date = date_format(new DateTime("now",new DateTimeZone('Asia/Beirut')),'Y-m-d H:i:s');
                                    $active_from_date = date($last_valid_round_res['from_dt'],convert_into_date($last_valid_round_res['from_dt'],'Y-m-d H:i:s'));
                                    $active_to_date = date($last_valid_round_res['to_dt'],convert_into_date($last_valid_round_res['to_dt'],'Y-m-d H:i:s'));
                                    $active_next_date = date($last_valid_round_res['next_dt'],convert_into_date($last_valid_round_res['next_dt'],'Y-m-d H:i:s'));

                                    date_default_timezone_set('Asia/Beirut');

                                    $currrent_current_date = date('Y-m-d H:i:s');
                                    if(strtotime($active_from_date) > strtotime($current_date))
                                    {
                                        $to_date = date_format(new DateTime($active_from_date), 'Y/m/d H:i:s');
                                        $counter_message = game_expired_try_in_next_round;
                                        $login_comment = "";
                                    }
                                    else if(strtotime($active_to_date) < strtotime($current_date))
                                    {
                                        if(strtotime($active_next_date) > strtotime($current_date))
                                            {   
                                                $counter_message = game_expired_try_in_next_round;
                                                $to_date = date_format(new DateTime($active_next_date), 'Y/m/d H:i:s');
                                                $login_comment = "";
                                            }
                                        else 
                                            {
                                                $counter_message = game_expired_their_is_no_game;
                                                $to_date = '2020/12/12 01:01:01';
                                                $login_comment = "";
                                            }
                                    }
                                    else if(strtotime($active_next_date) < strtotime($current_date))
                                    {
                                        $counter_message = game_expired_their_is_no_game;
                                        $to_date = '2020/12/12 01:01:01';
                                        $login_comment = "";
                                    }
                                    else
                                    {
                                        $counter_message = game_valid_for;
                                        $login_comment = "//";
                                        $to_date = date_format(new DateTime($active_to_date), 'Y/m/d H:i:s');
                                    }
                                }
                                else
                                    {
                                        $counter_message = their_is_no_game;
                                        $to_date = '2020/12/12 01:01:01';
                                        $login_comment = "";
                                    }
                                $template = str_replace(array("{all_pictures}",'{pagination}'),array($all_pictures,$pagination),$pictures_template);
                                $content = str_replace(array("{grabbed_user_id}"),array($user_id),$template);
                            }
                    }
                else if($user_status == 'winner')
                    {
                        $content = "<div>You are already a winner you cannot play with us another time </div>";
                    }
                else
                    {
                        $custom_head .= '<script type="text/javascript">top.location.href="'.$authorization_url.'";</script>';
                        $like = $standard_like;
                        
                        $template = file_get_contents('templates/logged_out_user.php');
                        $content = str_replace(array("{login_message}","{additional_content}"),array('',''),$template);
                    }
            }
        else
            {
                $custom_head .= '<link rel="stylesheet" href="styles/logged_out.css?v=3" />';
                $like = $standard_like;
                $top_menu = "";
                
                $template = file_get_contents('templates/logged_out_user.php');
                $content = str_replace(array("{login_message}","{additional_content}"),array($login_message,''),$template);
            }
    }
    
    $top_menu = str_replace(array('{modify_data}','{logout}'),array('',''),$top_menu);
    $global_container = str_replace(array('{custom_head}','{content}','{lang}','{current_lang}','{app_id}','{like}','{app_url}','{top_menu}'), array($custom_head,$content,$lang,$current_lang,$app_id,$like,$app_url,$top_menu), $global_container_template);
    echo $global_container;
?>
