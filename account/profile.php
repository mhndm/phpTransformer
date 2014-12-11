<?php

if (!isset($project)) {
    header("location: ../../");
}
?>
<?php

global $ThemeName, $LastLineCode, $member_id;

include_once('Programs/api_full/rating/rate_news.php');

$db = new db();
$max_users_per_page = 33;
$results_page_count_to_navigate_betweenu = 12;
$page = (isset($_GET['page']) && $_GET['page'] >= 1) ? InputFilter($_GET['page']) : 1;

$start = ($page - 1) * $max_users_per_page;
$LastLineCode .= '<script type="text/javascript" src="includes/rate_control/rate_control-jquery.js"></script>';

if (isset($_GET['user'])) {
    $TitlePage .= ' .:. ' . Account . ' .:. ' . user_profile;

    $user_profile = InputFilter($_GET['user']);
    $TheNavBar[] = array(user_profile, CreateLink("", array("Prog", "acnt", "user"), array("account", "profile", $user_profile)));

    $user_profile = $db->get_row("select * from `users` where `NickName`='" . $user_profile . "' ; ");
    if ($user_profile) {

        $UserPic = $user_profile->UserPic;
        $UserName = $user_profile->UserName;
        $FamName = $user_profile->FamName;
        $CellNbr = $user_profile->CellNbr;
        $UserMail = $user_profile->UserMail;
        $Points = $user_profile->Points;
        $Contry = $user_profile->Contry;
        $member_id = $user_profile->UserId;
        $user_nickname = $user_profile->NickName;
        $user_news_link = CreateLink("",array("Prog", "ns", "user"), array("cybernews", "awrites", $user_nickname));
        $user_news_list = '<a href="' . $user_news_link . '" >' . all_user_news . '</a>';
        if (isset($UserId) && !empty($UserId) && $UserId !== '20070000000') {
            $user_rating = '+' . get_user_rate_for_member($member_id, $UserId);
            $rating = get_user_total_rate($member_id);
        } else {
            $user_rating = '';
            $rating = get_user_total_rate($member_id);
        }

        if (is_file("Themes/" . $ThemeName . "/profile.php")) {
            $Theme = get_include_contents("Themes/" . $ThemeName . "/profile.php");
            $Theme = VarTheme('{rating}', $rating, $Theme);
            $Theme = VarTheme('{user_rating}', $user_rating, $Theme);
            echo $Theme = str_replace(array('{img}', '{fullname}', '{CellNbr}', '{UserMail}', '{Points}', '{Contry}', '{user_news_list}'), array('<img src="' . $UserPic . '" />', $UserName . ' ' . $FamName, $CellNbr, $UserMail, $Points, '<img src="images/flags/' . strtolower($Contry) . '.png"/>', $user_news_list), $Theme);
        } else {
            echo '<img src="' . $UserPic . '" /><br/>' . $UserName . ' ' . $FamName;
        }
    }
} else { //get all users list 
    $TitlePage .= ' .:. ' . users_profiles;
    $TheNavBar[] = array(users_profiles, CreateLink("", array("Prog", "acnt", "users"), array("account", "profile", "all")));

    $users_profiles = $db->get_results("select * from `users` where `GroupId`<>'20140000000' and `UserId`<>'200700000-1' and `NickName`<>'Guest' order by `Points` desc limit " . $start . ", " . $max_users_per_page . "; ");
    $number_of_users = $db->get_var(" select count(*) from `users` where `GroupId`<>'20140000000'  and `UserId`<>'200700000-1' and `NickName`<>'Guest' ;");
    if ($users_profiles) {
        foreach ($users_profiles as $user_profile) {
            $UserPic = $user_profile->UserPic;
            $UserName = $user_profile->UserName;
            $FamName = $user_profile->FamName;
            $CellNbr = $user_profile->CellNbr;
            $UserMail = $user_profile->UserMail;
            $Points = $user_profile->Points;
            $Contry = $user_profile->Contry;
            $member_id = $user_profile->UserId;
            $user_nickname = $user_profile->NickName;
            $user_news_link = CreateLink(array("Prog", "ns", "user"), array("cybernews", "awrites", $user_nickname));
            $user_news_list = '<a href="' . $user_news_link . '" >' . all_user_news . '</a>';
            if (isset($UserId) && !empty($UserId) && $UserId !== '20070000000') {
                $user_rating = '+' . get_user_rate_for_member($member_id, $UserId);
                $rating = get_user_total_rate($member_id);
            } else {
                $user_rating = '';
                $rating = get_user_total_rate($member_id);
            }
            if (!is_file($UserPic)) {
                $UserPic = 'images/avatars/default.jpg';
            }
            if (is_file("Themes/" . $ThemeName . "/profile.php")) {
                $Theme = get_include_contents("Themes/" . $ThemeName . "/profile.php");
                $Theme = VarTheme('{rating}', $rating, $Theme);
                $Theme = VarTheme('{user_rating}', $user_rating, $Theme);
                echo $Theme = str_replace(array('{img}', '{fullname}', '{CellNbr}', '{UserMail}', '{Points}', '{Contry}', '{user_news_list}'), array('<img src="' . $UserPic . '" />', $UserName . ' ' . $FamName, $CellNbr, $UserMail, $Points, '<img src="images/flags/' . strtolower($Contry) . '.png"/>', $user_news_list), $Theme);
            } else {
                echo '<img src="' . $UserPic . '" /><br/>' . $UserName . ' ' . $FamName;
            }
        }
        echo paginate_results($max_users_per_page, $results_page_count_to_navigate_betweenu, $number_of_users, $page, array('Prog', 'acnt', 'users'), array('account', 'profile', 'all'));
    }
}
include_once 'rate.php';
?>