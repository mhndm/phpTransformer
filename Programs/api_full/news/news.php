<?php
if(!function_exists('get_news_by_category'))
    {
        function get_news_by_category($user_infos = array("t" => "","u" => "","l" => ""))
            {
                global $db;
                if(empty($db))
                    $db = new db();

                $limit = 3;
                $for_days = 7;

                $only_urgent = "";
                $user_just_want_urgent_news = 0;        

                if(!isset($user_infos['l']) || empty($user_infos['l']) || !$db->get_var("select LangName from languages where LangName = '".InputFilter($user_infos['l'])."'"))
                        return json_encode(array("s" => '002'));

                $user_language = InputFilter($user_infos['l']);

                $news_by_category_arr = array();

                $user_choice = 0;
                if(isset($user_infos['t']))
                    {
                        $passed_token = InputFilter($user_infos['t']);
                        $user_id = $db->get_var("select UserId from users where app_token = '$passed_token'");
                        if($user_id)
                            {
                                $user_categories_res = $db->get_results("select count(*) from news_subscription where user_id = '$user_id'");
                                if(count($user_categories_res) > 0)
                                    {
                                        $user_choice = 1;
                                        $user_categories_res = $db->get_results("select IdCat as category_id,CatName as category_name from languages as l,catlang as cl,news_subscription as ns where l.IdLang = cl.IdLang and ns.cat_id = cl.IdCat and ns.user_id = '$user_id' and l.LangName = '$user_language'");
                                    }
                                else
                                    {
                                        $user_choice = 0;
                                        $user_categories_res = $db->get_results("select IdCat as category_id,CatName as category_name from catlang as cl,languages as l where l.IdLang = cl.IdLang and l.LangName = '$user_language'");
                                    }
                            }
                        else
                            {
                                return json_encode(array("s" => '003'));
                            }
                    }
                else
                    {
                        $user_id = '20070000000';
                        if(isset($user_infos['u']) && $user_infos['u'] == 1)
                            {
                                $user_just_want_urgent_news = 1;
                                $only_urgent = "and n.urgent = 1";
                            }
                        $user_categories_res = $db->get_results("select IdCat as category_id,CatName as category_name from catlang as cl,languages as l where l.IdLang = cl.IdLang and l.LangName = '$user_language'");
                    }
                if(count($user_categories_res))
                    {
                        foreach($user_categories_res as $category)
                            {
                                $category_id = $category->category_id;
                                $category_name = $category->category_name;
                                if($user_choice === 1)
                                    {
                                        $only_urgent_var = $db->get_var("select only_urgent from news_subscription where user_id = '$user_id' and cat_id = '$category_id'");
                                        if($only_urgent_var === 1)
                                            {
                                                $only_urgent = "and n.urgent = 1";
                                                $user_just_want_urgent_news = 1;
                                            }
                                    }
                                $category_news_count = $db->get_results("select n.IdNews from news as n,newslang as nl,languages as l,newscategoies as nc where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.IdNews = nc.IdNews and n.`Date` > DATE_SUB(NOW(), INTERVAL " . $for_days . " DAY) and n.Active = 1 and n.Deleted != 1 $only_urgent and nc.IdCat = '$category_id' and l.LangName = '$user_language' order by n.IdNews desc,n.Date desc limit 0,$limit");
                                if(count($category_news_count) > 0)
                                    {
                                        $category_news_res = $db->get_results("select n.IdNews as news_id,n.agency as news_agency_name,nl.Tilte as news_title,n.NewsPic as news_pic,n.Date as news_date,n.urgent as news_urgent from news as n,newslang as nl,languages as l,newscategoies as nc where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.IdNews = nc.IdNews and n.`Date` > DATE_SUB(NOW(), INTERVAL " . $for_days . " DAY) and n.Active = 1 and n.Deleted != 1 $only_urgent and nc.IdCat = '$category_id' and l.LangName = '$user_language' order by n.IdNews desc,n.Date desc limit 0,$limit");
                                        $category_ad = '';
                                        $category_ad = get_suitable_ad($user_id);
                                        $news_by_category_arr[] = array("type" => "c","id" => $category_id ,"title" => $category_name,"ad" => $category_ad);
                                        foreach($category_news_res as $news_row)
                                            {
                                                $news_id = $news_row->news_id;
                                                $news_agency_name = $news_row->news_agency_name;
                                                $news_agency_id = $db->get_var("select UserId from users where NickName = '$news_agency_name'");
                                                $news_agency_pic_big = $db->get_var("select UserPic from users where NickName = '$news_agency_name'");
                                                $news_agency_pic = str_replace(array('128'),array('32'),$news_agency_pic_big);
                                                $news_date = $news_row->news_date;
                                                $mobile_news_image = str_replace('.','_320.',$news_row->news_pic);
                                                $news_social_date = socialDateDif(strtotime(date("Y-m-d H:i:s")), strtotime($news_date), true);
                                                if(file_exists("../../uploads/news/pics/".$mobile_news_image))
                                                    {
                                                        $news_image = $mobile_news_image;
                                                    }
                                                else
                                                    {
                                                        $news_image = $news_row->news_pic;
                                                    }
                                                if(mb_strlen($news_row->news_title,"utf8") > 75)
                                                    {
                                                        $news_title = mb_substr($news_row->news_title, 0,75,"utf8")." ...";
                                                    }
                                                else
                                                    {
                                                        $news_title = $news_row->news_title;
                                                    }
                                                $news_by_category_arr[] = array("type" => "n","id" => $news_id,"title" => $news_title,"n_a_i" => $news_agency_id,"n_a_n" => $news_agency_name,"n_a_p" => $news_agency_pic,"n_p" => $news_image ,"n_d" => $news_date,"n_s_d" => $news_social_date,"n_u" => $news_row->news_urgent);
                                            }
                                        //$have_more_news_sql = "select count(*) from news as n,newscategoies as nc where n.IdNews = nc.IdNews and nc.IdCat = '$category_id' and n.`Date` <= '$news_date' and n.Active = 1 and n.Deleted != 1 and n.`IdNews` != '$news_id' $only_urgent order by n.Date desc,n.IdNews desc";
                                        $have_more_news_sql = "select count(*) from news as n,newslang as nl,newscategoies as nc,languages as l where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.IdNews = nc.IdNews and n.Active = 1 and n.Deleted != 1 $only_urgent and nc.IdCat = '$category_id' and l.LangName = '$user_language' and n.`Date` > DATE_SUB(NOW(), INTERVAL " . $for_days . " DAY) order by n.Date desc,n.IdNews desc limit 0,$limit";
                                        $have_more_news = $db->get_var($have_more_news_sql);
                                        if($have_more_news > 0)
                                            {
                                                if($user_choice == 1)
                                                    $news_by_category_arr[] = array("type" => "m","id" => $news_id,"title" => api_get_news_more,"n_u" => $user_just_want_urgent_news,"cat" => 'c_n',"selector" => $category_id,"more_addition" => $category_name);
                                                else
                                                    $news_by_category_arr[] = array("type" => "m","id" => $news_id,"title" => api_get_news_more,"n_u" => 0,"cat" => 'c_n',"selector" => $category_id,"more_addition" => $category_name);
                                            }
                                        else
                                            {
                                                $news_by_category_arr[] = array("type" => "m","id" => "-1","title" => api_get_news_more,"n_u" => 0,"cat" => "c_n","selector" => "","more_addition" => $category_name);
                                            }
                                    }

                            }
                        if(count($news_by_category_arr) > 0)
                            {
                                return json_encode(array("s" => '1',"r" => $news_by_category_arr));
                            }
                        else
                            {
                                return json_encode(array("s" => '005'));
                            }
                    }
                else
                    {
                        return json_encode(array("s" => '004'));
                    }
            }
    }
    
if(!function_exists('get_news_by_date'))
    {
        function get_news_by_date($user_infos = array("t" => "","l" => "","u" => "","m" => "","n" => "","d" => ""))
        {
            global $db;
            if(empty($db))
                $db = new db();

            $limit = 14;
            $for_days = 365;
            $news_counter = 0;
            $only_urgent = "";
            if(isset($user_infos['u']) && $user_infos['u'] == 1)
                $only_urgent = "and n.urgent = 1";

            if(!isset($user_infos['l']) || empty($user_infos['l']) || !$db->get_var("select LangName from languages where LangName = '".InputFilter($user_infos['l'])."'"))
                    return json_encode(array("s" => '002'));

            $news_language = InputFilter($user_infos['l']);

            $latest_news_arr = array();
            if(isset($user_infos['m']))
                {
                    $last_news_id = isset($user_infos['n']) && !empty($user_infos['n'])?InputFilter($user_infos['n']) : "-1";
                    $last_news_date = isset($user_infos['d']) && !empty($user_infos['d'])?InputFilter($user_infos['d']) : "-1";
                    $latest_news_res = $db->get_results("select n.pinned,n.IdNews as news_id,n.agency as news_agency_name,nl.Tilte as news_title,n.NewsPic as news_pic,n.Date as news_date,n.urgent as news_urgent from news as n,newslang as nl,languages as l where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.Active = 1 and n.Deleted != 1 and l.LangName = '$news_language' $only_urgent and n.Date < '$last_news_date' and n.IdNews != '$last_news_id' and n.`Date` > DATE_SUB(NOW(), INTERVAL " . $for_days . " DAY) order by n.IdNews desc,n.`Date` desc limit 0,$limit");
                }
            else
                {
                    $latest_news_res = $db->get_results("select n.pinned,n.IdNews as news_id,n.agency as news_agency_name,nl.Tilte as news_title,n.NewsPic as news_pic,n.Date as news_date,n.urgent as news_urgent from news as n,newslang as nl,languages as l,newscategoies as nc where n.IdNews = nc.IdNews and l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.`Date` > DATE_SUB(NOW(), INTERVAL " . $for_days . " DAY) and n.Active = 1 and n.Deleted != 1 and l.LangName = '$news_language' $only_urgent order by n.pinned desc,n.IdNews Desc,n.Date desc limit 0,$limit");
                    //$latest_news_res = $db->get_results("select n.pinned,n.IdNews as news_id,n.agency as news_agency_name,nl.Tilte as news_title,n.NewsPic as news_pic,n.Date as news_date,n.urgent as news_urgent from news as n,newslang as nl,languages as l,newscategoies as nc where n.IdNews = nc.IdNews and l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.`Date` > DATE_SUB(NOW(), INTERVAL " . $for_days . " DAY) and n.Active = 1 and n.Deleted != 1 and l.LangName = '$news_language' $only_urgent and ((n.pinned = 1 and nc.IdCat != '20140000033') or (n.pinned = 0))
                }
            $latest_news_arr[] = array("type" => "c","id" => '903930' ,"title" => api_last_news);
            if(count($latest_news_res) > 0)
                {
                    foreach($latest_news_res as $news_row)
                        {
                            $news_pinned = $news_row->pinned;
                            $news_id = $news_row->news_id;
                            $news_agency_name = $news_row->news_agency_name;
                            $news_agency_id = $db->get_var("select UserId from users where NickName = '$news_agency_name'");
                            $news_agency_pic_big = $db->get_var("select UserPic from users where NickName = '$news_agency_name'");
                            $news_agency_pic = str_replace(array('128'),array('32'),$news_agency_pic_big);
                            $news_date = $news_row->news_date;
                            $mobile_news_image = str_replace('.','_320.',$news_row->news_pic);
                            $news_social_date = socialDateDif(strtotime(date("Y-m-d H:i:s")), strtotime($news_date), true);
                            if(file_exists("../../uploads/news/pics/".$mobile_news_image))
                                {
                                    $news_image = $mobile_news_image;
                                }
                            else
                                {
                                    $news_image = $news_row->news_pic;
                                }
                            if(mb_strlen($news_row->news_title,"utf8") > 75)
                                {
                                    $news_title = mb_substr($news_row->news_title, 0,75,"utf8")." ...";
                                }
                            else
                                {
                                    $news_title = $news_row->news_title;
                                }
                            $news_title = ($news_pinned == 1) ? "<span style='color:#2a98dc;'>" . api_important . " </span>".$news_title : $news_title;
                            
                            if($news_counter % 10 === 0 && $news_counter > 0)
                                {
                                    $news_ad = '';
                                    $news_ad = get_suitable_ad('');
                                    $latest_news_arr[] = array("type" => "n","id" => $news_id,"title" => $news_title,"n_a_i" => $news_agency_id,"n_a_n" => $news_agency_name,"n_a_p" => $news_agency_pic,"n_p" => $news_image ,"n_d" => $news_date,"n_s_d" => $news_social_date,"n_u" => $news_row->news_urgent,"ad" => $news_ad);
                                }
                            else
                                {
                                    $latest_news_arr[] = array("type" => "n","id" => $news_id,"title" => $news_title,"n_a_i" => $news_agency_id,"n_a_n" => $news_agency_name,"n_a_p" => $news_agency_pic,"n_p" => $news_image ,"n_d" => $news_date,"n_s_d" => $news_social_date,"n_u" => $news_row->news_urgent);
                                }
                            $news_counter ++;
                        }

                    //$have_more_news_sql = "select count(*) from news as n,newscategoies as nc where n.IdNews = nc.IdNews and nc.IdCat = '$category_id' and n.`Date` <= '$news_date' and n.Active = 1 and n.Deleted != 1 and n.`IdNews` != '$news_id' $only_urgent order by n.Date desc,n.IdNews desc";
                    $have_more_news_sql = "select count(*) from news as n,newslang as nl,languages as l where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.Active = 1 and n.Deleted != 1 and l.LangName = '$news_language' $only_urgent and n.`Date` > DATE_SUB(NOW(), INTERVAL " . $for_days . " DAY) order by n.pinned,n.IdNews,n.Date desc limit 0,$limit";
                    $have_more_news = $db->get_var($have_more_news_sql);
                    if($have_more_news > 0)
                        {
                            $latest_news_arr[] = array("type" => "m","id" => $news_id,"title" => api_get_news_more,"n_u" => 0,"cat" => "n_l","selector" => "");
                        }
                    else
                        {
                            $latest_news_arr[] = array("type" => "m","id" => "-1","title" => api_get_news_more,"n_u" => 0,"cat" => "n_l","selector" => "");
                        }
                    return json_encode(array("s" => '1',"r" => $latest_news_arr));
                }
            else
                {
                    return json_encode(array("s" => '005',"r" => $latest_news_arr));
                }
        }
    }
    
if(!function_exists('get_author_news'))
    {
        function get_author_news($author_infos = array("a","l","m","d","n"))
            {
                global $db;
                if(empty($db))
                    $db = new db();

                $limit = 14;
                $news_counter = 0;
                if(!isset($author_infos['l']) || empty($author_infos['l']) || !$db->get_var("select LangName from languages where LangName = '".InputFilter($author_infos['l'])."'"))
                        return json_encode(array("s" => '002'));

                $news_language = InputFilter($author_infos['l']);

                if(!isset($author_infos['a']) || empty($author_infos['a']) || !$db->get_var("select UserId from users where UserId = '" . InputFilter($author_infos['a']) . "'"))
                    return json_encode(array("s" => '003'));


                $author_id = InputFilter($author_infos['a']);

                $author_name = $db->get_var("select concat(UserName,' ',FamName) from users where UserId = '$author_id'");

                $author_news_arr = array();

                if(isset($author_infos['m']))
                    {
                        $last_news_id = isset($author_infos['n']) && !empty($author_infos['n'])?InputFilter($author_infos['n']) : "-1";
                        $last_news_date = isset($author_infos['d']) && !empty($author_infos['d'])?InputFilter($author_infos['d']) : date('Y-m-d H:i:s');
                        $author_news_res = $db->get_results("select n.pinned,n.IdNews as news_id,n.agency as news_agency_name,nl.Tilte as news_title,n.NewsPic as news_pic,n.Date as news_date,n.urgent as news_urgent from news as n,newslang as nl,languages as l where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.Active = 1 and n.Deleted != 1 and n.IdUserName = '$author_id' and l.LangName = '$news_language' and n.Date < '$last_news_date' and n.IdNews != '$last_news_id' order by n.pinned desc,n.Date desc,n.IdNews desc limit 0,$limit");
                    }
                else
                    {
                        $author_news_res = $db->get_results("select n.pinned,n.IdNews as news_id,n.agency as news_agency_name,nl.Tilte as news_title,n.NewsPic as news_pic,n.Date as news_date,n.urgent as news_urgent from news as n,newslang as nl,languages as l where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.Active = 1 and n.Deleted != 1 and n.IdUserName = '$author_id' and l.LangName = '$news_language' order by n.pinned desc,n.Date desc,n.IdNews desc limit 0,$limit");
                        $author_news_arr[] = array("type" => "a","id" => '903930' ,"title" => $author_name);
                    }
                if(count($author_news_res) > 0)
                    {
                        foreach($author_news_res as $news_row)
                            {
                                $user_id = isset($_SESSION['user_id'])?$_SESSION['user_id'] : '20070000000';
                                $news_id = $news_row->news_id;
                                $news_pinned = $news_row->pinned;
                                $news_agency_name = $news_row->news_agency_name;
                                $news_agency_id = $db->get_var("select UserId from users where NickName = '$news_agency_name'");
                                $news_agency_pic_big = $db->get_var("select UserPic from users where NickName = '$news_agency_name'");
                                $news_agency_pic = str_replace(array('128'),array('32'),$news_agency_pic_big);
                                $news_date = $news_row->news_date;
                                $mobile_news_image = str_replace('.','_320.',$news_row->news_pic);
                                $news_social_date = socialDateDif(strtotime(date("Y-m-d H:i:s")), strtotime($news_date), true);
                                $news_title = ($news_pinned == 1) ? "<span style='color:#2a98dc;'>" . api_important . " </span>".$news_row->news_title : $news_row->news_title;
                                if(file_exists("../../uploads/news/pics/".$mobile_news_image))
                                    {
                                        $news_image = $mobile_news_image;
                                    }
                                else
                                    {
                                        $news_image = $news_row->news_pic;
                                    }
                                if($news_counter % 10 === 0 && $news_counter > 0)
                                    {
                                        $news_ad = '';
                                        $news_ad = get_suitable_ad('');
                                        $author_news_arr[] = array("type" => "n","id" => $news_id,"title" => $news_title,"n_a_i" => $news_agency_id,"n_a_n" => $news_agency_name,"n_a_p" => $news_agency_pic,"n_p" => $news_image ,"n_d" => $news_date,"n_s_d" => $news_social_date,"n_u" => $news_row->news_urgent,"ad" => $news_ad);
                                    }
                                else
                                    {
                                        $author_news_arr[] = array("type" => "n","id" => $news_id,"title" => $news_title,"n_a_i" => $news_agency_id,"n_a_n" => $news_agency_name,"n_a_p" => $news_agency_pic,"n_p" => $news_image ,"n_d" => $news_date,"n_s_d" => $news_social_date,"n_u" => $news_row->news_urgent);
                                    }
                                $news_counter ++;
                            }

                        //$have_more_news_sql = "select count(*) from news as n,newscategoies as nc where n.IdNews = nc.IdNews and nc.IdCat = '$category_id' and n.`Date` <= '$news_date' and n.Active = 1 and n.Deleted != 1 and n.`IdNews` != '$news_id' $only_urgent order by n.Date desc,n.IdNews desc";
                        $have_more_news_sql = "select count(*) from news as n,newslang as nl,languages as l where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.Active = 1 and n.Deleted != 1 and n.IdUserName = '$author_id' and l.LangName = '$news_language' and n.Date < '$news_date' and n.IdNews != '$news_id' order by n.Date desc,n.IdNews desc limit 0,$limit";
                        $have_more_news = $db->get_var($have_more_news_sql);
                        if($have_more_news > 0)
                            {
                                $author_news_arr[] = array("type" => "m","id" => $news_id,"title" => api_get_news_more,"n_u" => 0,"cat" => "a_n","selector" => $author_id,"more_addition" => $author_name);
                            }
                        else
                            {
                                $author_news_arr[] = array("type" => "m","id" => "-1","title" => api_get_news_more,"n_u" => 0,"cat" => "a_n","selector" => $author_id);
                            }
                        return json_encode(array("s" => '1',"r" => $author_news_arr));
                    }
                else
                    {
                        $author_news_arr[] = array("type" => "m","id" => "-1","title" => api_get_news_more,"n_u" => 0,"cat" => "a_n","selector" => $author_id);
                        return json_encode(array("s" => '005',"r" => $author_news_arr));
                    }
            }
    }
    
if(!function_exists('get_category_news'))
    {
        /* Functions that will handler any retrieveing news process */
        //Note : All news function below use same parameters and return same type of values so we will introduce just first funcion

        /**
         * 
         * This function will fetch news for a specific category
         * @param Array $category_infos may contains following indexes :
         *      - c : Id of the category we want to fetch its news
         *      - l : Language name we want to fetch news by
         *      - t : User token to detect if the user settings allow the display of current category or not
         *      - d : Last news date fetched in this category (This is used to fetch more news inside this category)
         *      - m : if is set so we tell script that we are fetching more news of this category
         *      - n : Last news id fetched in this category to know from where we want to fetch more news (This is used to fetch more news inside this category)
         * @return Json_object contain following properties :
         *      - s : String Status ('002' -> Invalid language name
         *                    '003' -> Invalid category id
         *                    '004' -> Invalid token
         *                    '1' -> News found)
         *      - r : Array of arrays each sub array is an array that contains news infos , infos are represented as following indexes
         *                    - type : String The type of current entry (m -> more entry,n -> news entry)
         *                    - id : news id
         *                    - title : when a more entry represented this will be the constant api_get_news_more else it will  be news title
         *                    - n_u : The urgency of news
         *                    - cat : The category of news process ('c_n' -> Category news)
         *                    - selector : The id what we will select for more news with
         *                    - more_addition : Is the label we want to use after the more title
         *                    - n_a_i : Id of the agency of news(news entry)
         *                    - n_a_n : Name of the agency of news(news entry)
         *                    - n_a_p : Picture of agency of news(news entry)
         *                    - n_p : picture path of news(news entry)
         *                    - n_d : Date of news(news entry)
         *                    - n_s_d : Social date of news(news entry)
         */
        function get_category_news($category_infos = array("c" => "","l" => "","t" => "","d" => "","m" => "","n" => ""))
            {
                global $db;
                if(empty($db))
                    $db = new db();

                $limit = 11;
                $news_counter = 0;
                if(!isset($category_infos['l']) || empty($category_infos['l']) || !$db->get_var("select LangName from languages where LangName = '".InputFilter($category_infos['l'])."'"))
                        return json_encode(array("s" => '002'));

                $category_language = InputFilter($category_infos['l']);

                if(!isset($category_infos['c']) || empty($category_infos['c']) || !$db->get_var("select cl.CatName from catlang as cl,languages as l where l.IdLang = cl.IdLang and cl.IdCat = '" . InputFilter($category_infos['c']) . "' and l.LangName = '$category_language'"))
                    return json_encode(array("s" => '003'));

                $only_urgent = "";
                $user_choice = 0;

                $category_id = InputFilter($category_infos['c']);

                if(isset($category_infos['t']) && !empty($category_infos['t']))
                    {
                        $user_id = $db->get_var("select UserId from users where app_token = '".InputFilter($category_infos['t'])."'");
                        if(!$user_id)
                            return json_encode(array("s" => '004'));

                        $user_choice = 1;
                        $user_want_just_urgent_news = $db->get_var("select only_urgent from news_subscription where user_id = '$user_id' and cat_id = '$category_id'");
                        if($user_want_just_urgent_news && $user_want_just_urgent_news == 1)
                            {
                                $only_urgent = "and n.urgent = 1";
                            }
                    }
                else
                    {
                        $user_id = isset($_SESSION['user_id'])?$_SESSION['user_id'] : '20070000000';
                    }
                $category_name = $db->get_var("select cl.CatName from catlang as cl,languages as l where l.IdLang = cl.IdLang and cl.IdCat = '" . InputFilter($category_id) . "' and l.LangName = '$category_language'");
                $category_news_arr = array();
                if(isset($category_infos['m']))
                    {
                        $last_news_id = isset($category_infos['n']) && !empty($category_infos['n'])?InputFilter($category_infos['n']) : "-1";
                        $last_news_date = isset($category_infos['d']) && !empty($category_infos['d'])?InputFilter($category_infos['d']) : date('Y-m-d H:i:s');

                        $category_news_res = $db->get_results("select n.pinned,n.IdNews as news_id,n.agency as news_agency_name,nl.Tilte as news_title,n.NewsPic as news_pic,n.Date as news_date,n.urgent as news_urgent from news as n,newslang as nl,newscategoies as nc,languages as l where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.IdNews = nc.IdNews and n.Active = 1 and n.Deleted != 1 $only_urgent and nc.IdCat = '$category_id' and l.LangName = '$category_language' and n.Date < '$last_news_date' and n.IdNews != '$last_news_id' order by n.pinned desc,n.Date desc,n.IdNews desc limit 0,$limit");
                    }
                else
                    {
                        $category_news_res = $db->get_results("select n.pinned,n.IdNews as news_id,n.agency as news_agency_name,nl.Tilte as news_title,n.NewsPic as news_pic,n.Date as news_date,n.urgent as news_urgent from news as n,newslang as nl,newscategoies as nc,languages as l where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.IdNews = nc.IdNews and n.Active = 1 and n.Deleted != 1 $only_urgent and nc.IdCat = '$category_id' and l.LangName = '$category_language' order by n.pinned desc,n.Date desc,n.IdNews desc limit 0,$limit");
                        $category_news_arr[] = array("type" => "c","id" => '903930' ,"title" => $category_name);
                    }
                if(count($category_news_res) > 0)
                    {
                        foreach($category_news_res as $news_row)
                            {
                                $news_pinned = $news_row->pinned;
                                $news_id = $news_row->news_id;
                                $news_agency_name = $news_row->news_agency_name;
                                $news_agency_id = $db->get_var("select UserId from users where NickName = '$news_agency_name'");
                                $news_agency_pic_big = $db->get_var("select UserPic from users where NickName = '$news_agency_name'");
                                $news_agency_pic = str_replace(array('128'),array('32'),$news_agency_pic_big);
                                $news_date = $news_row->news_date;
                                $mobile_news_image = str_replace('.','_320.',$news_row->news_pic);
                                $news_social_date = socialDateDif(strtotime(date("Y-m-d H:i:s")), strtotime($news_date), true);
                                $news_title = ($news_pinned == 1) ? "<span style='color:#2a98dc;'>" . api_important . " </span>".$news_row->news_title : $news_row->news_title;
                                if(file_exists("../../uploads/news/pics/".$mobile_news_image))
                                    {
                                        $news_image = $mobile_news_image;
                                    }
                                else
                                    {
                                        $news_image = $news_row->news_pic;
                                    }
                                if($news_counter % 10 === 0 && $news_counter > 0)
                                    {
                                        $news_ad = '';
                                        $news_ad = get_suitable_ad($user_id);
                                        $category_news_arr[] = array("type" => "n","id" => $news_id,"title" => $news_title,"n_a_i" => $news_agency_id,"n_a_n" => $news_agency_name,"n_a_p" => $news_agency_pic,"n_p" => $news_image ,"n_d" => $news_date,"n_s_d" => $news_social_date,"n_u" => $news_row->news_urgent,"ad" => $news_ad);
                                    }
                                else
                                    {
                                        $category_news_arr[] = array("type" => "n","id" => $news_id,"title" => $news_title,"n_a_i" => $news_agency_id,"n_a_n" => $news_agency_name,"n_a_p" => $news_agency_pic,"n_p" => $news_image ,"n_d" => $news_date,"n_s_d" => $news_social_date,"n_u" => $news_row->news_urgent);
                                    }
                                $news_counter++;
                            }

                        //$have_more_news_sql = "select count(*) from news as n,newscategoies as nc where n.IdNews = nc.IdNews and nc.IdCat = '$category_id' and n.`Date` <= '$news_date' and n.Active = 1 and n.Deleted != 1 and n.`IdNews` != '$news_id' $only_urgent order by n.Date desc,n.IdNews desc";
                        $have_more_news_sql = "select count(*) from news as n,newslang as nl,newscategoies as nc,languages as l where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.IdNews = nc.IdNews and n.Active = 1 and n.Deleted != 1 $only_urgent and nc.IdCat = '$category_id' and l.LangName = '$category_language' order by n.Date desc,n.IdNews desc limit 0,$limit";
                        $have_more_news = $db->get_var($have_more_news_sql);
                        if($have_more_news > 0)
                            {
                                if($user_choice == 1)
                                    $category_news_arr[] = array("type" => "m","id" => $news_id,"title" => api_get_news_more,"n_u" => $user_want_just_urgent_news,"cat" => 'c_n',"selector" => $category_id,"more_addition" => $category_name);
                                else
                                    $category_news_arr[] = array("type" => "m","id" => $news_id,"title" => api_get_news_more,"n_u" => 0,"cat" => 'c_n',"selector" => $category_id,"more_addition" => $category_name);
                            }
                        else
                            {
                                $category_news_arr[] = array("type" => "m","id" => "-1","title" => api_get_news_more,"n_u" => 0,"cat" => "c_n","selector" => "","more_addition" => $category_name);
                            }
                        return json_encode(array("s" => '1',"r" => $category_news_arr));
                    }
                else
                    {
                        $more_arr = array("type" => "m","id" => "-1","title" => api_get_news_more,"n_u" => 0,"cat" => "c_n","selector" => "","more_addition" => $category_name);
                        return json_encode(array("s" => '1',"r" => $more_arr));
                    }
            }
    }
    
if(!function_exists('get_news_details'))
    {
        /**
        * This function will get details for a specific news
        * @global db $db
        * @param type $news_infos This is an array that may contains following indexes :
        *      n : news id
        *      l : new language
        *      t : Token of user (To know if this user can view this news event if it is not published yet (In case that this user is in the admin group))
        * @return json_object an object that may contains two properties :
        *      s : String status of result (invalid language passed,invalid news passed , no news in this language)
        *      r : An array that will contain news details
        */
       function get_news_details($news_infos = array("n" => "","l" => "","t" => ""))
           {
               global $db;
                   if(empty($db)){$db = new db();}

               $invalid_news_error_json = json_encode(array("s" => '001'));
               $malformed_error_json = json_encode(array("s" => '002'));
               $invalid_language_error_json = json_encode(array("s" => '003'));

               if(!isset($news_infos['l']) || !$db->get_var("select LangName from languages where LangName = '".InputFilter($news_infos['l'])."'"))
                   return $invalid_language_error_json;

               $news_language = InputFilter ($news_infos['l']);

               if(!isset($news_infos['n']) || !$db->get_var("select nl.IdNews from newslang as nl,languages as l where l.IdLang = nl.IdLang and nl.IdNews = '".InputFilter($news_infos['n'])."' and l.LangName = '$news_language'"))
                   return $invalid_news_error_json;

               $news_id = InputFilter($news_infos['n']);

               $passed_token = isset($news_infos['t']) && !empty($news_infos['t'])?InputFilter($news_infos['t']) : "";
               if(empty($passed_token) || (!empty($passed_token) && !$db->get_var("select AdminId from admins,users where users.UserId = admins.AdminId and users.app_token = '$passed_token'")))
                   {
                       $is_admin = '0';
                       $news_details_row = $db->get_row("select n.uuid,n.IdUserName as news_author_id,n.IdNews as news_id,n.NewsPic as news_pic,nl.Tilte as news_title,FullMessage as news_full,n.Date as news_date,n.agency as news_agency from languages as l,news as n,newslang as nl where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.IdNews = '$news_id' and l.LangName = '$news_language' and n.Active = 1 and n.Deleted != 1");
                   }
               else
                   {
                       $is_admin = '1';
                       $news_details_row = $db->get_row("select n.uuid,n.IdUserName as news_author_id,n.IdNews as news_id,n.NewsPic as news_pic,nl.Tilte as news_title,FullMessage as news_full,n.Date as news_date,n.agency as news_agency from languages as l,news as n,newslang as nl where l.IdLang = nl.IdLang and n.IdNews = nl.IdNews and n.IdNews = '$news_id' and l.LangName = '$news_language' and n.Deleted != 1");
                   }
               $user_id = $db->get_var("select UserId from users where app_token = '" . InputFilter($passed_token) ."'");
               if($news_details_row)
                   {
                       $news_total_rate = get_news_total_rate($news_id);
                       $news_user_rate = get_user_rate_for_news($news_id,$user_id);
                       $news_author_id = $news_details_row->news_author_id;
                       $news_author_name = $db->get_var("select concat(UserName,' ',FamName) from users where UserId = '$news_author_id'");
                       $news_author_pic_big = $db->get_var("select UserPic from users where UserId = '$news_author_id'");
                       $news_author_pic = str_replace(array('128'),array('32'),$news_author_pic_big);
                       $news_agency_name = $news_details_row->news_agency;
                       $news_agency_id = $db->get_var("select UserId from users where NickName ='$news_agency_name'");
                       $news_agency_pic_big = $db->get_var("select UserPic from users where NickName = '$news_agency_name'");
                       $news_agency_pic = str_replace(array('128'),array('32'),$news_agency_pic_big);
                       $news_category_row = $db->get_row("select cl.IdCat as news_category_id,cl.CatName as news_category_name from newscategoies as nc,catlang as cl,languages as l where l.IdLang = cl.IdLang and cl.IdCat = nc.IdCat and l.LangName = '$news_language' and nc.IdNews = '$news_id'");
                       if($news_category_row)
                           {
                               $news_category_id = $news_category_row->news_category_id;
                               $news_category_name = $news_category_row->news_category_name;
                           }
                       else
                           {
                               $news_category_id = "20140000000";
                               $news_category_name = api_unkown_category;
                           }
                       $news_date = socialDateDif(strtotime(date("Y-m-d H:i:s")), strtotime($news_details_row->news_date), true);
                       $news_user_uuid = $is_admin ? $news_details_row->uuid : "";
                       if(mb_strlen($news_details_row->news_title,"utf8") > 100)
                           {
                               $news_title = mb_substr($news_details_row->news_title, 0,100,"utf8");
                           }
                       else
                           {
                               $news_title = $news_details_row->news_title;
                           }
                       $news_ad = '';
                       $news_ad = get_suitable_ad($user_id);
                       $result = array("n_i" => $news_details_row->news_id,"n_p" => $news_details_row->news_pic ,"n_t" => $news_title,"n_f" => $news_details_row->news_full,"n_d" => $news_date,"n_a_i" => $news_agency_id,"n_a_n" => $news_agency_name,"n_a_p" => $news_agency_pic,"n_au_i" => $news_author_id,"n_au_n" => $news_author_name,"n_au_p" => $news_author_pic,"n_c_i" => $news_category_id,"n_c_n" => $news_category_name,"n_u_u" => $news_user_uuid,"ad" => $news_ad,"rate" => $news_total_rate,"user_rate" => $news_user_rate);
                       $db->query("update news set Hits = Hits + 1 where IdNews = '$news_id'");
                       return json_encode(array("s" => '1',"r" => $result));
                   }
               else
                   {
                       return $invalid_news_error_json;
                   }

           }
    }
    