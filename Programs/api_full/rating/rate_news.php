<?php
function perform_rate_action($action,$rate_infos)
    {
        if($action === 'set')
            {
                return set_rate($rate_infos);
            }
        else
            {
                return get_rate($rate_infos);
            }
    }
//array("t" => "","r" => 0,"m" => '',"n" => '')
function set_rate($rate_infos=array())
    {
        global $db;
        if(empty($db))
            $db = new db();
        
        if(!isset($rate_infos['t']) || empty($rate_infos['t']))
            {
                return json_encode(array('s' => '001'));
            }
        $is_valid_token_var = $db->get_var("select UserId from users where app_token = '".InputFilter($rate_infos['t'])."'");
        if(!$is_valid_token_var)
            {
                return json_encode(array('s' => '002'));
            }
        $user_id = $is_valid_token_var;

        if(!isset($rate_infos['r']) || empty($rate_infos['r']) || $rate_infos['r'] < 0 || $rate_infos['r'] > 5)
            {
                return json_encode(array('s' => '003'));
            }
        $rate_value = $rate_infos['r'];
        $rating_type = '';
        if(isset($rate_infos['m']))
            {
                $is_valid_member_id = $db->get_var("select UserId from users where UserId = '".InputFilter($rate_infos['m'])."'");
                if(!$is_valid_member_id)
                    {
                        return json_encode(array('s' => '004'));
                    }
                $member_id = InputFilter($rate_infos['m']);
                $news_id = '';
                $db->query("delete from news_rating where user_id = '$user_id' and member_id = '$member_id' and news_id != NULL");
                $rating_type = 'm';
            }
        else if(isset($rate_infos['n']))
            {
                $member_id = '';
                if(empty($rate_infos['n']))
                    {
                        return json_encode(array('s' => '005'));
                    }
                $is_valid_news_id_var = $db->get_var("select IdUserName from news where IdNews = '".InputFilter($rate_infos['n'])."'");
                if(!$is_valid_news_id_var)
                    {
                        return json_encode(array('s' => '006'));
                    }
                $member_id = $is_valid_news_id_var;
                $news_id = InputFilter($rate_infos['n']);
                $db->query("delete from news_rating where user_id = '$user_id' and news_id = '$news_id'");
                $rating_type = 'n';
            }
        else
            {
                return json_encode(array('s' => '007'));
            }
        $rate_date = date('Y/m/d H:i:s');
        $db->query("insert into news_rating(`user_id`,`member_id`,`news_id`,`rate_value`,`rate_date`) values ('$user_id','$member_id','$news_id','$rate_value','$rate_date')");
        $returned_array_result = array();
        if(isset($rating_type) && $rating_type === 'n')
            {
                $element_rate = $db->get_var("select (sum(rate_value) / count(*)) from news_rating where news_id = '$news_id'");
            }
        else if(isset($rating_type) && $rating_type === 'm')
            {
                $element_rate = $db->get_var("select (sum(rate_value) / count(*)) from news_rating where member_id = '$member_id'");
            }
        $returned_array_result = (array('r' => $element_rate,'m_r' => $rate_value));
        if($db->dbh->affected_rows > 0)
            {
                $returned_array_result['s'] = '1';
            }
        else
            {
                $returned_array_result['s'] = '008';
            }
        return json_encode($returned_array_result);
    }
//array("t" => "","m" => '',"n" => '')
function get_rate($rate_infos = array())
    {
        global $db;
        if(empty($db))
            $db = new db();
        if(isset($rate_infos['t']))
            {
                $is_valid_token_var = $db->get_var("select UserId from users where app_token = '" . InputFilter($rate_infos['t']) . "'");
                if(!$is_valid_token_var)
                    {
                        return json_encode(array('s' => '001'));
                    }
                $user_id = $is_valid_token_var;
            }
        else
            {
                $user_id = '20070000000';
            }
        if(isset($rate_infos['n']))
            {
                $is_valid_news_id_var = $db->get_var("select IdNews from news where IdNews = '".InputFilter($rate_infos['n'])."'");
                if(!$is_valid_news_id_var)
                    {
                        return json_encode(array("s" => '002'));
                    }
                $news_id = InputFilter($is_valid_news_id_var);
                $news_rate = $db->get_var("select (sum(rate_value) / count(*)) from news_rating where news_id = '$news_id'");
                $my_news_rate = $db->get_var("select rate_value from news_rating where news_id = '$news_id' and user_id = '$user_id'");
                if($news_rate && $news_rate > 0)
                    {
                        return json_encode(array('s' => '1','r' => $news_rate,'m_r' => $my_news_rate));
                    }
                else
                    {
                        return json_encode(array('s' => '1','r' => 0,'m_r' => 0));
                    }
            }
        else if(isset($rate_infos['m']))
            {
                $is_valid_member_id_var = $db->get_var("select UserId from users where UserId = '".InputFilter($rate_infos['m'])."'");
                if(!$is_valid_member_id_var)
                    {
                        return json_encode(array("s" => '003'));
                    }
                $member_id = InputFilter($is_valid_member_id_var);
                $user_rate = $db->get_var("select (sum(rate_value) / count(*)) from news_rating where member_id = '$user_id'");
                $my_user_rate = $db->get_var("select rate_value from news_rating where member_id = '$member_id' and user_id = '$user_id'");
                if($user_rate && $user_rate > 0)
                    {
                        return json_encode(array('s' => '1','r' => $user_rate,'m_r' => $my_user_rate));
                    }
                else
                    {
                        return json_encode(array('s' => '1','r' => 0,'m_r' => 0));
                    }
            }
         else
            {
                return json_encode(array('s' => '004'));
            }
    }

function get_news_total_rate($news_id)
    {
        global $db;
        if(empty($db))
            $db = new db();
        $element_rate = $db->get_var("select (sum(rate_value) / count(*)) from news_rating where news_id = '$news_id'");
        if(!$element_rate)
            $element_rate = 0;
        return $element_rate;
    }
    
function get_user_total_rate($member_id)
    {
        global $db;
        if(empty($db))
            $db = new db();
        $element_rate = $db->get_var("select (sum(rate_value) / count(*)) from news_rating where member_id = '$member_id'");
        if(!$element_rate)
            $element_rate = 0;
        return $element_rate;
    }
    
function get_user_rate_for_news($news_id,$user_id)
    {
        global $db;
        if(empty($db))
            $db = new db();
        $element_rate = $db->get_var("select rate_value from news_rating where news_id = '$news_id' and user_id = '$user_id'");
        if(!$element_rate)
            $element_rate = 0;
        return $element_rate;
    }
    
function get_user_rate_for_member($member_id,$user_id)
    {
        global $db;
        if(empty($db))
            $db = new db();
        $element_rate = $db->get_var("select rate_value from news_rating where member_id = '$member_id' and user_id = '$user_id'");
        if(!$element_rate)
            $element_rate = 0;
        return $element_rate;
    }
?>