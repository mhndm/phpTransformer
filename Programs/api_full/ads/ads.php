<?php
function get_suitable_ad($user_id,$place = '',$row_number = '')
    {
        global $db;
        if(empty($db))
            $db = new db();
        if(empty($user_id))
            {
                $user_id = '20070000000';
                if(isset($_SESSION['user_token']))
                    {
                        $user_id_var = $db->get_var("select UserId from users where app_token = '".InputFilter($_SESSION['user_token'])."'");
                        if($user_id_var)
                            $user_id = $user_id_var;
                    }
            }

        $news_ad = '';
        $screen_width = isset($_SESSION['screen_width'])?$_SESSION['screen_width'] : '320';
        if($user_id !== '20070000000')
            {
                $news_user_infos_row = $db->get_row("select concat(UserName,' ',FamName) as user_full_name,UserMail as user_email,CellNbr as user_mobile from users where UserId = '$user_id'");
                if($news_user_infos_row)
                    {
                        $user_full_name = $news_user_infos_row->user_full_name;
                        $user_email = $news_user_infos_row->user_email;
                        $user_mobile = $news_user_infos_row->user_mobile;
                        $ad_width = get_suitable_width($screen_width);
                        $news_ad = '<img src="http://www.cyberaman.com/Programs/api_full/my_banners/' . $ad_width .'.png?v=1" style="max-width:98%;margin:0px auto;" onclick="window.open(\'http://www.cyberaman.com/Prog-contactus_Lang-Arabic_nl-1_FullName-'.$user_full_name.'_EmailAddress-' . $user_email .'_TelNumber-' . $user_mobile .'_Question-1_DepartmentToCall-20140000001.pt\',\'_system\');" />';
                        //$news_ad = '<img src="http://www.cyberaman.com/Programs/api_full/admob_banners/468x60.png" />';
                    }
                else
                    {
                        $ad_width = get_suitable_width($screen_width);
                        $news_ad = '<img src="http://www.cyberaman.com/Programs/api_full/my_banners/' . $ad_width .'.png?v=1" style="max-width:98%;margin:0px auto;" onclick="window.open(\'http://www.cyberaman.com/Prog-contactus_Lang-Arabic_nl-1_FullName-'.$user_full_name.'_EmailAddress-' . $user_email .'_TelNumber-' . $user_mobile .'_Question-1_DepartmentToCall-20140000001.pt\',\'_system\');" />';
                    }
            }
        else
            {
                $ad_width = get_suitable_width($screen_width);
                $news_ad = '<img src="http://www.cyberaman.com/Programs/api_full/my_banners/' . $ad_width .'.png?v=1" style="max-width:98%;margin:0px auto;" onclick="window.open(\'http://www.cyberaman.com/Prog-contactus_Lang-Arabic_nl-1_FullName-'.$user_full_name.'_EmailAddress-' . $user_email .'_TelNumber-' . $user_mobile .'_Question-1_DepartmentToCall-20140000001.pt\',\'_system\');" />';
            }
        return $news_ad;
    }
    
function get_suitable_width($screen_width,$screen_height)
    {
        $suitable_width = 0;
        //$screen_width = intval($screen_width);
        if($screen_width < 320)
            {
                $suitable_width = '300';
            }
        else if($screen_width >= 320 && $screen_width <= 360)
            {
                $suitable_width = '320';
            }
        else if($screen_width > 360 && $screen_width <= 468)
            {
                $suitable_width = '360';
            }
        else if($screen_width > 468 && $screen_width <= 728)
            {
                $suitable_width = '468';
            }
        else if($screen_width > 728 && $screen_width <= 800)
            {
                $suitable_width = '728';
            }
        else if($screen_width > 800 && $screen_width <= 1024)
            {
                $suitable_width = '800';
            }
        else if($screen_width > 1024 && $screen_width <= 1280)
            {
                $suitable_width = '1024';
            }
        else if($screen_width > 1280)
            {
                $suitable_width = '1280';
            }
        return $suitable_width;
    }
?>