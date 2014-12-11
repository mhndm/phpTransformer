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

global $NickName, $GuestCanWrite, $PoolTotalRecords, $PoolRows;


if ($NickName == "Guest") {
    // can Guests write in our site ?
    if ($GuestCanWrite == "1") {
        //cheking if this guest already vote py cookie and ip address
        //chek if this guest ip already vote
        //get last pool id
        PoolExcuteQuery('SELECT * FROM `pooltitle` WHERE `lastpol`=1 and `Deleted`<>"1"; ');
        if ($PoolTotalRecords > 0) {
            $Idpt = $PoolRows['Idpt'];
            $multichoice = $PoolRows['multichoice'];
        } else {
            $Idpt = "";
            $multichoice = 0;
        }
        //chek if this ip geust has an record
        PoolExcuteQuery('SELECT * FROM `poolusers` WHERE `UserId` = "20070000000" and `Idpt`="' . $Idpt . '" and `IpPool` = "' . $_SERVER['REMOTE_ADDR'] . '"');
        if ($PoolTotalRecords > 0) {
            $GuestIpPool = 1;
        } else {
            $GuestIpPool = 0;
        }//end if
        // cheking by cookie if this guest vote to this pool
        if (isset($_COOKIE['Idpt'])) {
            $GuestIdpt = $_COOKIE['Idpt'];
        } else {
            $GuestIdpt = "";
        }//end if
        if (($GuestIdpt == $Idpt) or ($GuestIpPool == 1)) {
            PoolResult($Idpt);
        } else {
            //chek if user submit an vote
            if (isset($_POST['poolsubmit'])) {

                AddVote($Idpt, $multichoice);
                PoolResult($Idpt);
            } else {

                PoolForm();
            } //end if
        }//end if
    } else {
        //get last pool id
        PoolExcuteQuery('SELECT * FROM `pooltitle` WHERE `lastpol`=1 and `Deleted`<>1 ');
        if ($PoolTotalRecords > 0) {
            $Idpt = $PoolRows['Idpt'];
            $multichoice = $PoolRows['multichoice'];
        } else {
            $Idpt = "";
        }
        PoolResult($Idpt);
        echo "<strong>" . (SorryGuestsCantsPool) . "</strong><br/>";
        $Vars = array("Prog", "acnt");
        $Vals = array("account", "signup");
        echo '<a href="' . CreateLink("", $Vars, $Vals) . '">' . (ClickHereToSignUp) . '</a>';
    }//end if
} else {
    //registered users
    global $PoolTotalRecords, $PoolRows;
    //get last pool id
    PoolExcuteQuery('SELECT * FROM `pooltitle` WHERE `lastpol`="1" and `Deleted`<>"1" ; ');
    if ($PoolTotalRecords > 0) {
        $Idpt = $PoolRows['Idpt'];
        $multichoice = $PoolRows['multichoice'];
    } else {
        $Idpt = "";
    }
    //chek if this ip geust has an record
    global $UserId;
    PoolExcuteQuery('SELECT * FROM `poolusers` WHERE `UserId` = "' . $UserId . '" and `Idpt`="' . $Idpt . '";');
    if ($PoolTotalRecords > 0) {
        $HasVote = 1;
    } else {
        $HasVote = 0;
    }//end if
    if ($HasVote == 1) {
        PoolResult($Idpt);
    } else {
        //chek if user submit an vote
        if (isset($_POST['poolsubmit'])) {
            AddVote($Idpt, $multichoice);
            PoolResult($Idpt);
        } else {
            PoolForm();
        } //end if
    }//end if
}//end if

function AddVote($Idpt, $multichoice) {
// multi choisse ?
    global $UserId, $PoolTotalRecords, $PoolRows, $PoolRecordset;
    if ($multichoice == "1") {
        //chekbox values
        //echo $UserId;
        PoolExcuteQuery('SELECT `idpc` FROM `poolchoices` WHERE `idpt`="' . $Idpt . '"');
        if ($PoolTotalRecords > 0) {
            for ($i = 0; $i < $PoolTotalRecords; $i++) {
                $idpc = $PoolRows['idpc'];
                if (isset($_POST['Choise' . $idpc])) {
                    $$idpc = PostFilter($_POST['Choise' . $idpc]);
                    //echo $$idpc."<br/>";
                    if (isset($_POST['poolcomment'])) {
                        $Comment = PostFilter($_POST['poolcomment']);
                    } else {
                        $Comment = "";
                    }//end if
                    //insert new vote


                    $INSERTquery = "INSERT INTO `poolusers` ( `UserId` , `Idpt` , `idpc` , `IpPool` , `Comment` )
									VALUES ('" . $UserId . "', '" . $Idpt . "', '" . $idpc . "', '" . $_SERVER['REMOTE_ADDR'] . "', '" . $Comment . "');";
                    global $conn;
                    $INSERTRecordset = mysqli_query($conn,$INSERTquery);

                    if ($UserId == "20070000000") {
                        setcookie("Idpt", $Idpt, time() + 31104000);
                    }//end if
                }// end if
                $PoolRows = mysqli_fetch_assoc($PoolRecordset);
            } //end for
        } //end if
    } else {
        //radio values
        if (isset($_POST['choise'])) {
            $idpc = PostFilter($_POST['choise']);
            //echo $$idpc."<br/>";
            if (isset($_POST['poolcomment'])) {
                $Comment = PostFilter($_POST['poolcomment']);
            } else {
                $Comment = "";
            }//end if
            //insert new vote

            $INSERTquery = "INSERT INTO `poolusers` ( `UserId` , `Idpt` , `idpc` , `IpPool` , `Comment` )
							VALUES ('" . $UserId . "', '" . $Idpt . "', '" . $idpc . "', '" . $_SERVER['REMOTE_ADDR'] . "', '" . $Comment . "');";
            global $conn;
            $INSERTRecordset = mysqli_query($conn,$INSERTquery);

            if ($UserId == "20070000000") {
                setcookie("Idpt", $Idpt, time() + 31104000);
            }//end if
        }// end if
        //} //end if
    }//end if
}

//end function

function PoolResult($Idpt) {

    global $ThemeName, $PoolTotalRecords, $PoolRows, $PoolRecordset, $conn, $Lang;

    if ($Idpt == '') {
        echo (NoPoolToday) . "<br/>";
        $Vars = array("Prog");
        $Vals = array("pool");
        echo '<a href="' . CreateLink("", $Vars, $Vals) . '">' . (UcanViewOldPools) . '</a>';
    }
    PoolExcuteQuery('SELECT `IdLang` FROM `languages` WHERE `LangName` ="' . $Lang . '";');
    if ($PoolTotalRecords > 0) {
        $IdLang = $PoolRows['IdLang'];
    }//end if

    PoolExcuteQuery('SELECT `Title` FROM `poollangtitles` WHERE
	`IdLang` ="' . $IdLang . '" and `Idpt`="' . $Idpt . '"');
    if ($PoolTotalRecords > 0) {
        $Title = $PoolRows['Title'];
    } else {
        $Title = ' ';
    }//end if
    echo '<div><div class="poll_title" >' . $Title . "<br/></div>";
    PoolExcuteQuery('SELECT * FROM `poolusers` WHERE `Idpt` = "' . $Idpt . '"');
    //if($PoolTotalRecords >0){
    $SumOfAll = $PoolTotalRecords;
    //}
    //else{
    //	$SumOfAll =1;
    //}//end if
    PoolExcuteQuery('SELECT `idpc` FROM `poolchoices` WHERE `idpt`="' . $Idpt . '";');
    if ($PoolTotalRecords > 0) {
        for ($i = 0; $i < $PoolTotalRecords; $i++) {
            $idpc = $PoolRows['idpc'];
            // get the sum of itch option

            $ChoiseQuery = 'SELECT `Choise` FROM `poollangchoices` WHERE `IdLang` ="' . $IdLang . '" and `idpc` ="' . $idpc . '" and `idpt`="' . $Idpt . '"';
            $ChoiseRecordset = mysqli_query($conn,$ChoiseQuery);
            $ChoiseTotalRecords = mysqli_num_rows($ChoiseRecordset);
            $ChoiseRows = mysqli_fetch_assoc($ChoiseRecordset);
            if ($ChoiseTotalRecords > 0) {
                $Choise = $ChoiseRows['Choise'];
                // echo ."&nbsp;";
            }else{
                $Choise ='';
            }

            $idpcquery = 'SELECT COUNT(*) as Ttl  FROM `poolusers` WHERE `Idpt` ="' . $Idpt . '" AND `idpc` ="' . $idpc . '";';
            $idpcRecordset = mysqli_query($conn,$idpcquery);
            $idpcTotalRecords = mysqli_num_rows($idpcRecordset);
            $idpcRows = mysqli_fetch_assoc($idpcRecordset);
            $Ttl = $idpcRows['Ttl'];

            if ($SumOfAll < 1) {

                echo '<div class="poll_choise"  >0% ' . $Choise . '<br />
                            <div class="poll_percentage" style=" width:0%;"></div> 
                      </div>';
            } else {
                echo '<div class="poll_choise" >' . round($Ttl / $SumOfAll * 100, 1) . "% " . $Choise . '<br />
                            <div class="poll_percentage" style="width:' . round($Ttl / $SumOfAll * 100, 1) . '%;"></div> 
                      </div>';
            }

            $PoolRows = mysqli_fetch_assoc($PoolRecordset);
        }
        echo SumOfVoices . " : " . $SumOfAll;
    }// End if
    echo "</div>";
}

//end function

function PoolForm() {

    // get id for current language
    global $Lang, $PoolTotalRecords, $PoolRows, $PoolRecordset, $IdLang, $Idpt, $multichoice;
    PoolExcuteQuery('SELECT `IdLang` FROM `languages` WHERE `LangName` ="' . $Lang . '";');
    if ($PoolTotalRecords > 0) {
        $IdLang = $PoolRows['IdLang'];
    }//end if
    // get last pool in this language
    PoolExcuteQuery('SELECT * FROM `pooltitle` WHERE `published` = "1" and `lastpol` = "1"');
    if ($PoolTotalRecords > 0) {
        $Idpt = $PoolRows['Idpt'];
        $multichoice = $PoolRows['multichoice'];
        if ($PoolRows['poolstart'] != '0000-00-00 00:00:00' or $PoolRows['poolstart'] != '0000-00-00 00:00:00') {
            if ($PoolRows['poolstart'] <= strtotime(date('Y-m-j G:i:s')) and $PoolRows['poolend'] >= strtotime(date('Y-m-j G:i:s'))) {
                //show the pool form
                ShowPoolForm($Idpt, $multichoice);
            } else {
                //show old statistics
                echo (NoPoolToday) . "<br/>";
                $Vars = array("Prog");
                $Vals = array("pool");
                echo '<a href="' . CreateLink("", $Vars, $Vals) . '">' . (UcanViewOldPools) . '</a>';
            }
        } else {
            //show the pool form
            ShowPoolForm($Idpt, $multichoice);
        }
    } else {
        //show old statistics
        echo (NoPoolToday) . "<br/>";
        $Vars = array("Prog");
        $Vals = array("pool");
        echo '<a href="' . CreateLink("", $Vars, $Vals) . '">' . (UcanViewOldPools) . '</a>';
    }//end if
}

//end function 

function ShowPoolForm($Idpt, $multichoice) {

    global $IdLang, $Lang, $PoolTotalRecords, $PoolRows, $PoolRecordset, $UserId; //$Idpt,$multichoice;
    // get title in this language
    //echo "IdLang : ".$IdLang." Idpt ".$Idpt." multichoice ".$multichoice;
    PoolExcuteQuery('SELECT `Title` FROM `poollangtitles` WHERE
	`IdLang` ="' . $IdLang . '" and `Idpt`="' . $Idpt . '"');
    if ($PoolTotalRecords > 0) {
        $Title = $PoolRows['Title'];
    } else {
        $Title = '';
    }
    echo '<script language="javascript" type="text/javascript" src="Blocks/Pool/ajax.js"></script>';
    echo '<div class="poll_title"> '. $Title . "</div>";

    PoolExcuteQuery("SELECT `poolchoices`.`idpc` , `Choise`, `cheked` FROM `poollangchoices`,`poolchoices`
				WHERE
				`poollangchoices`.`Idpt` = `poolchoices`.`Idpt`
				and
				`poollangchoices`.`Idpc` = `poolchoices`.`Idpc`
				and
				`poollangchoices`.`IdLang`='" . $IdLang . "'
				and
				`poolchoices`.`Idpt`= '" . $Idpt . "';");

    if ($PoolTotalRecords > 0) {
        echo '<form name="poolform" id="poolform" action="" method="post">
            <input name="TitlePool" type="hidden" value="' . $Idpt . '" />';
        for ($i = 0; $i < $PoolTotalRecords; $i++) {
            $Choise = $PoolRows['Choise'];
            $cheked = $PoolRows['cheked'];
            $idpc = $PoolRows['idpc'];
            //$toJava .= 'pool_From_Server('.$idpc.');';
            if ($multichoice == "1") {
                if ($cheked == "1") {
                    echo '<br/><input class="myClass" type="checkbox" value="' . $idpc . '" name="Choise' . $idpc . '" id="Choise' . $idpc . '" checked="checked" /><label for="Choise' . $idpc . '" > ' . $Choise . "</label>";
                } else {
                    echo '<br/><input  class="myClass" type="checkbox" value="' . $idpc . '" name="Choise' . $idpc . '"  id="Choise' . $idpc . '"  /><label for="Choise' . $idpc . '" > ' . $Choise . "</label>";
                }
            } else {
                if ($cheked == "1") {
                    echo '<br/><input  class="myClass" type="radio" value="' . $idpc . '" name="choise"  id="Choise' . $idpc . '"  data-color="green" /><label for="Choise' . $idpc . '" > ' . $Choise . "</label>";
                } else {
                    echo '<br/><input  class="myClass" type="radio" value="' . $idpc . '" name="choise"  id="Choise' . $idpc . '" checked="checked" /><label for="Choise' . $idpc . '" >' . $Choise . "</label>";
                }
            } //end if
            $PoolRows = mysqli_fetch_assoc($PoolRecordset);
        } //end for
        echo '<br/>' . PoolComment .
        '<br/><input class="text" name="poolcomment" type="text" id="poolcomment" size="12" maxlength="100" /><center>
             <input name="IdLang" type="hidden" id="IdLang" value="' . $IdLang . '" />
             <input name="Lang" type="hidden" id="Lang" value="' . $Lang . '" />
             <input name="UserId" type="hidden" id="UserId" value="' . $UserId . '" />
            <input onclick="poll_From_Server();" type="button" class="submit" name="poolsubmit" id="poolsubmit" value="' . (submit) . '" /></center></form><br/>';
    }//end if
}

//end function

function PoolExcuteQuery($query) {
    global $PoolRecordset, $SqlType, $conn, $PoolTotalRecords, $PoolRows;
    $PoolRecordset = mysqli_query($conn,$query);
    $PoolTotalRecords = mysqli_num_rows($PoolRecordset);
    if ($PoolTotalRecords > 0) {
        $PoolRows = mysqli_fetch_assoc($PoolRecordset);
    }//end if
}

//end function
?>