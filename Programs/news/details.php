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
    header("location: ../../");
}
?>
<?php

global $GroupId, $NickName, $ThemeName, $Lang, $TotalRecords, $Rows, $Recordset, $conn, $ConvertAt, $Author;

if (isset($_GET['idnews'])) {
    $IdNews = InputFilter($_GET['idnews']);
    // get idLang
    SqlConnect();
    ExcuteQuery('SELECT `IdLang` FROM `languages` WHERE `LangName`="' . $Lang . '";');
    if ($TotalRecords > 0) {
       // echo $GroupId;
        $IdLang = $Rows['IdLang'];
        if($GroupId=="200700000-1") {
            $active_sql = ' ';
        } else {
            $active_sql = ' and `Active`="1"  ';
        }
        //GET NEWS DATE 
        ExcuteQuery('SELECT * FROM `news` WHERE `IdNews`="' . $IdNews . '" '
                . ' and `Deleted`<> "1" ' . $active_sql . ';');

        $news_exist = $TotalRecords;
        if ($TotalRecords > 0) {
            $Date = $Rows['Date'];
        } else {
            $Date = Date('Y-m-d');
        }//end if
        // get news in this lang
        ExcuteQuery('SELECT * FROM `newslang` WHERE `IdLang`="' . $IdLang . '" '
                . 'and `IdNews`="' . $IdNews . '";');

        if ($news_exist > 0) {
            // UPDATEstatistics info  $IdNews
            $UpdateQwery = "UPDATE `news` SET `Hits` = `Hits`+1 "
                    . "WHERE  `news`.`IdNews` = '" . $IdNews . "' ";
            $Rec = mysqli_query($conn, $UpdateQwery);

            // insert into report
            if ($NickName != "Guest" and $NickName != "") {
                $db_rep = new db();
                $news_report = $db_rep->get_row(" select * from `news_report` where "
                        . "`id_news` ='" . $IdNews . "' and `nickname`='" . $NickName . "' ; ");
                if ($news_report) {
                    $db_rep->query(" update `news_report` set `time_read`='" . date("Y-m-d H:i:s") . "' "
                            . "where `nickname`='" . $NickName . "' ; ");
                } else {
                    $db_rep->query(" INSERT INTO `news_report` (`id`, `id_news`, `nickname`, `time_sent`, `time_read`) "
                            . "VALUES (NULL, '" . $IdNews . "', '" . $NickName . "', '', '" . date("Y-m-d H:i:s") . "'); ");
                }
            }

            $Tilte = $Rows['Tilte'];
            $SubTitle = $Rows['SubTitle'];
            $Breif = $Rows['Breif'];
            $FullMessage = $Rows['FullMessage'];
            $Note = $Rows['Note'];
            //get news image
            ExcuteQuery('SELECT * FROM `news` WHERE `IdNews`="' . $IdNews . '";');
            if ($TotalRecords > 0) {
                $IdUserName = $Rows['IdUserName'];
                $NewsPic = $Rows['NewsPic'];
                $IdUserName = $Rows['IdUserName'];
            }//end if
            //get author name 
            ExcuteQuery('SELECT * FROM `users` WHERE `UserId`="' . $IdUserName . '";');
            if ($TotalRecords > 0) {
                $UserName = $Rows['UserName'];
                $FamName = $Rows['FamName'];
                $ParentName = $Rows['ParentName'];
                $NickName = $Rows['NickName'];
            } else {
                $UserName = "";
                $FamName = "";
                $ParentName = "";
                $NickName = "";
            }//end if
            //get group id for this news
            ExcuteQuery('SELECT `IdCat` FROM `newscategoies` WHERE `IdNews`="' . $IdNews . '";');
            if ($TotalRecords > 0) {
                $IdCat = $Rows['IdCat'];
            }//end if
            //get group name
            ExcuteQuery('SELECT `CatName` FROM `catlang` WHERE `IdCat`="' . $IdCat . '" and `IdLang`="' . $IdLang . '";');
            if ($TotalRecords > 0) {
                $CatName = $Rows['CatName'];
            }//end if
            if (is_file('Programs/news/Themes/' . $ThemeName . '/NewsDetails.php')) {
                $Theme = get_include_contents('Programs/news/Themes/' . $ThemeName . '/NewsDetails.php');
            } else {
                $Theme = get_include_contents('Programs/news/Themes/Default/NewsDetails.php');
            }//end if
            $NewsTitle = $Tilte;
            $TitlePage .= ' .:. ' . $NewsTitle;
            // $NewsData = $Breif;
            $NewsData = "";
            $NewsAllData = $FullMessage;
            $AuthorName = (AuthorName) . " : " . $UserName . ' ' . $FamName;
            //for meta 
            $Author = $UserName . ' ' . $FamName;
            $AuthorWrits = (AllAuthorWrits);
            $addComment = (addComment);
            $PrintPage = (PrintPage);
            $SavePage = (SavePage);
            $SendPage = (SendPage);
            $NewsImg = '<img  alt="' . $NewsTitle . '"  src="uploads/news/pics/' . $NewsPic . '"/>';
            $Theme = VarTheme('{ThemeName}', $ThemeName, $Theme);
            $Theme = VarTheme('{NewsDate}', $Date, $Theme);
            $Theme = VarTheme('{SubTitle}', $SubTitle, $Theme);

            $Vars = array("Prog", "ns", "idnews", "title");
            $Vals = array("news", "details", $IdNews, str_replace(" ", "_", subwords($Tilte, 0, 35)));
            $LinkNewsId = CreateLink("", $Vars, $Vals);
            $NewsTitle = VarTheme('{NewsTitle}', '<a href="' . $LinkNewsId . '" title="' . $NewsTitle . '" >' . $NewsTitle . '</a>', $Theme);

            $NewsData = VarTheme('{NewsData}', $NewsData, $NewsTitle);
            $NewsAllData = VarTheme('{NewsAllData}', $NewsAllData, $NewsData);
            $AuthorName = VarTheme('{AuthorName}', $AuthorName, $NewsAllData);
            $Vars = array("Prog", "ns", "user");
            $Vals = array("news", "awrites", $NickName);
            $LinkId = CreateLink("", $Vars, $Vals);
            $AuthorWrits = '<a href="' . $LinkId . '" title="' . $AuthorWrits . '">' . $AuthorWrits . '</a>';
            $AuthorWrits = VarTheme('{AuthorWrits}', $AuthorWrits, $AuthorName);
            $Vars = array("Prog", "ns", "catid");
            $Vals = array("news", "catnews", $IdCat);
            $LinkId = CreateLink("", $Vars, $Vals);
            $NewsGroup = (CategorieInSameCat) . ' : <a href="' . $LinkId . '" title="' . $CatName . '">' . $CatName . '</a>';
            $NewsGroup = VarTheme('{NewsGroup}', $NewsGroup, $AuthorWrits);
            $addComment = VarTheme('{addComment}', $addComment, $NewsGroup);
            $PrintPage = VarTheme('{PrintPage}', $PrintPage, $addComment);
            $SavePage = VarTheme('{SavePage}', $SavePage, $PrintPage);
            $SendPage = VarTheme('{SendPage}', $SendPage, $SavePage);
            $NewsImg = VarTheme('{NewsImg}', $NewsImg, $SendPage);
            $pdfPage = (pdfPage);
            $pdfPage = VarTheme('{pdfPage}', $pdfPage, $NewsImg);
            $Vars = array("Prog", "ns", "idnews");
            $Vals = array("news", "pdf", $IdNews);
            $pdflink = CreateLink("", $Vars, $Vals);
            $pdfPage = VarTheme('{pdflink}', $pdflink, $pdfPage);
            echo $pdfPage;
            // CommentTitle 
            ExcuteQuery('SELECT * FROM `newscomment` WHERE `IdNews`="' . $IdNews . '" order by `CommentDate` desc;');
            if ($TotalRecords > 0) {
                $comments = '';
                for ($i = 0; $i < $TotalRecords; $i++) {

                    $CommentTitle = $Rows['CommentTitle'];
                    $UserId = $Rows['UserId'];
                    //get NickName for this userid
                    $NickNameRecordset = mysqli_query($conn, 'SELECT * FROM `users` WHERE `UserId`="' . $UserId . '";');
                    $NickNameTotalRecords = mysqli_num_rows($NickNameRecordset);
                    if ($NickNameTotalRecords > 0) {
                        $NickNameRows = mysqli_fetch_assoc($NickNameRecordset);
                        $NickName = $NickNameRows['NickName'];
                        $UserName = $NickNameRows['UserName'];
                        $FamName = $NickNameRows['FamName'];
                        $UserName = $UserName . ' ' . $FamName;
                        $UserMail = $NickNameRows['UserMail'];
                        $user_pic = $NickNameRows['UserPic'];
                    }//end if
                    $cc = $Rows['cc'];
                    // get country name for this country code
                    $ccRecordset = mysqli_query($conn, 'SELECT `Contry` FROM `cclang` WHERE `cc`="' . $cc . '";');
                    $ccTotalRecords = mysqli_num_rows($ccRecordset);
                    if ($ccTotalRecords > 0) {
                        $ccRows = mysqli_fetch_assoc($ccRecordset);
                        $Contry = $ccRows['Contry'];
                    } else {
                        $Contry = "";
                    }//end if
                    $CommentDate = $Rows['CommentDate'];
                    $theComment = $Rows['theComment'];
                    if (is_file('Programs/news/Themes/' . $ThemeName . '/NewsComments.php')) {
                        $CommentCode = get_include_contents('Programs/news/Themes/' . $ThemeName . '/NewsComments.php');
                    } else {
                        $CommentCode = get_include_contents('Programs/news/Themes/Default/NewsComments.php');
                    }//end if
                    $CommentCode = VarTheme('{ThemeName}', $ThemeName, $CommentCode);
                    $CN = VarTheme('{CN}', $i + 1, $CommentCode);
                    $CommentTitle = VarTheme('{CommentTitle}', $CommentTitle, $CN);
                    $Authorcom = VarTheme('{Author}', (Author), $CommentTitle);
                    $ContryN = VarTheme('{Contry}', (Contry), $Authorcom);
                    $email = VarTheme('{email}', (email), $ContryN);
                    $Date = VarTheme('{Date}', (Date), $email);
                    if ($NickName == 'Guest') {
                        $UserName = ' &nbsp; ';
                        $user_pic = 'images/avatars/default.jpg';
                    }
                    $AuthorName = VarTheme('{AuthorName}', $UserName, $Date);
                    $ContryName = VarTheme('{ContryName}', $Contry, $AuthorName);
                    if ($ConvertAt == "1") {
                        $emailAddress = VarTheme('{emailAddress}', $UserMail, $ContryName);
                        $emailAddress = VarTheme('@', '<img src="Themes/' . $ThemeName . '/Images/at.gif" alt="@" border="0"/>', $emailAddress);
                    } else {
                        $emailAddress = VarTheme('{emailAddress}', $UserMail, $ContryName);
                    }
                    $CommentDate = VarTheme('{CommentDate}', $CommentDate, $emailAddress);
                    $theComment = VarTheme('{theComment}', $theComment, $CommentDate);


                    $reply = CreateLink("", array("Prog", "ns", "idnews"), array("news", "addcmnt", $IdNews));
                    $theComment = VarTheme('{reply}', '<a href="' . $reply . '" >' . reply . '</a>', $theComment);


                    $theComment = VarTheme('{user_pic}', '<img src="' . $user_pic . '" />', $theComment);

                    $comments .= $theComment;
                    $Rows = mysqli_fetch_assoc($Recordset);
                }//end for
                echo '<div  class="news_comments" >' . $comments . '</div>';
            }//end if
        } else {
            echo WrongNewsId;
        }//end if
    } else {
        echo WrongLangName;
    }//end if
} else {
    echo NoIdNewsSelected;
}//end if
?>