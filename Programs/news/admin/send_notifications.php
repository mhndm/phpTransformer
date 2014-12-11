<?php
include_once("../../../includes.php");
sleep(1);

global $db,$UserId,$GroupId,$WebiteFolder;

if(empty($db))
    {
        $db = new db();
    }
    
if(!isset($_COOKIE['LastSeesion']))
    {
        if(isset($_COOKIE['phpTransformer']))
            {
                session_name('phpTransformer');
                @session_start();

                if(isset($_SESSION['Login' . $WebsiteUrl]))
                    {
                        if(isset($_SESSION['UserId']))
                            {
                                $is_really_admin = $db->get_var("select * from admins where AdminId = '".$_SESSION['UserId']."'");
                                if($is_really_admin)
                                    {
                                        $IsAdmin = 1;
                                    }
                            }
                    }
            }
    }

if (!isset($IsAdmin))
    {
        header("location: ../");
    }

global $android_key;

function androidsendNotification($apiKey, $registrationIdsArray, $messageData)
    {
        $headers = array("Content-Type:" . "application/json", "Authorization:" . "key=" . $apiKey);
        $data = array(
            'collapse_key' => 'emedia',
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

function androidprepare_message($id, $on_going, $message, $title, $ticker, $mid)
    {
        $message = $message;
        $title = $title;
        $ticker = $ticker;
        $mid = $mid;
        $data_message = array("id" => "$id", "on_going" => $on_going, "message" => $message, "title" => $title, "ticker" => $ticker, "mid" => $mid);
        return $data_message;
    }
    
$page = InputFilter($_GET['page']);
$id_news_group = InputFilter($_GET['id_news_group']);
$id_news = InputFilter($_GET['id_news']);
$is_urgent = InputFilter($_GET['is_urgent']);
$limit = InputFilter($_GET['limit']);
$start = ($page - 1) * $limit;

if($_GET['to'] == 'all')
    {
        $to = 'all';        
        $paginated_users = $db->get_results("select * from users where android_id <> '0' and android_id <> '' limit $start,$limit");
        $more_users = $db->get_var("select count(*) from users where android_id <> '0' and android_id <> '' limit " . ($start + ($limit - 1)) . ",$limit");
        //$paginated_users = $db->get_results("select * from cclang limit $start,40");
    }
else if($_GET['to'] == 'user_choise')
    {
        $to = 'user_choise';
        if($is_urgent)
            {
                $paginated_users = $db->get_results("select * from users as u,notification as n where u.UserId = n.id_user and n.id_news_group = '$id_news_group' and u.android_id <> '0' and u.android_id <> ''");
                $more_users = $db->get_var("select count(*) from users as u,notification as n where u.UserId = n.id_user and n.id_news_group = '$id_news_group' and u.android_id <> '0' and u.android_id <> '' limit " . ($start + ($limit - 1)) . ",$limit");
            }
        else
            {
                $paginated_users = $db->get_results("select * from users as u,notification as n where u.UserId = n.id_user and n.id_news_group = '$id_news_group' and n.only_urgent <> '1' and u.android_id <> '0' and u.android_id <> ''");
                $more_users = $db->get_var("select count(*) from users as u,notification as n where u.UserId = n.id_user and n.id_news_group = '$id_news_group' and n.only_urgent <> '1' and u.android_id <> '0' and u.android_id <> '' limit " . ($start + ($limit - 1)) . ",$limit");
            }
    }
else
    {
        $to = $_GET['to'];
        $paginated_users = $db->get_results("select * from users where GroupId = '$to' and android_id <> '0' and android_id <> ''");
        $more_users = $db->get_var("select count(*) from users where GroupId = '$to' and android_id <> '0' and android_id <> '' and android_id <> '0' and android_id <> '' limit " . ($start + ($limit - 1)) . ",$limit");
    }
    
if(count($paginated_users) > 0)
    {
        send_android_notifications_to_those_users($paginated_users,$id_news,$id_news_group,$is_urgent);    
        //$more_users = $db->get_results("select * from cclang limit " . ($start + $limit) . ",$limit");
        if($more_users > 0)
            {
                echo json_encode(array("is_urgent" => $is_urgent,"page" => $_GET['page'] + 1,"more" => 1));
            }
        else{
                echo json_encode(array("is_urgent" => $is_urgent,"page" => $_GET['page'],"more" => 0));
            }
    }
else
    {
        echo json_encode(array("is_urgent" => $is_urgent,"page" => $_GET['page'],"more" => 0));
    }
    
function send_android_notifications_to_those_users($paginated_users,$id_news,$id_news_group,$is_urgent)
    {
        global $android_key,$db;
        
        $i = 0;
        $j = 0;
        $e = 0;
        
        $message_id = substr($id_news,-6,6);
        $languages = $db->get_results("select * from languages where Deleted <> 1");
        foreach($languages as $language)
            {
                $lang_id = $language->IdLang;
                $message_infos = $db->get_row("select Tilte,Breif from newslang where IdNews = '$id_news' and IdLang = '$lang_id'");
                if($message_infos)
                    {
                        $title = $message_infos->Tilte;
                        $full_message = $message_infos->Breif;
                        $message = mb_substr($full_message, 0, 150,'utf8');
                        $ticker = $title;
                        $android_id = array();
                        $users_id = array();
                        foreach ($paginated_users as $member)
                            {
                                if($member->PrefLang == $language->LangName)
                                    {
                                        $android_id[] = $member->android_id;
                                        $users_id[] = $member->UserId;
                                    }
                            }
                        if(count($android_id) > 0 && count($users_id) > 0)
                            {
                                $data_message = androidprepare_message($message_id, "false", str_replace(array('&nbsp;'),array(' '),strip_tags($message)), str_replace(array('&nbsp;'),array(' '),strip_tags($title)), str_replace(array('&nbsp;'),array(' '),strip_tags($ticker)), $id_news_group);
                                $response = androidsendNotification($android_key, $android_id, $data_message);
                                $new_response = json_decode($response);
                                //var_dump($new_response);
                                if ($new_response->canonical_ids)
                                    {
                                        $h = 0;
                                        foreach($new_response->results as $resp)
                                            {
                                                if(property_exists($resp, 'registration_id'))
                                                    {
                                                        $db->query("update users set `android_id` = '".$resp->registration_id."' where UserId = '".$users_id[$h]."'");
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
?>