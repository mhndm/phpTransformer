<?php
$first_number = rand(1, 10);
$_SESSION['first_number'] = $first_number;
$second_number = rand(1, 10);
$_SESSION['second_number'] = $second_number;
$answer = $first_number + $second_number;
$_SESSION['op_result'] = $answer;
?>
<form method="post" name="SignUpForm">
    <table border="0" cellpadding="10" cellspacing="4">
        <tbody>
            <tr>
                <td>
                    <?php
                    echo $NickNameErr;
                    echo NickName;
                    ?>
                    <img border="0" title="<?php echo (NickNameInfo); ?>" alt="" style="cursor:help" src="Programs/account/images/info.gif" width="15" height="15"/>

                </td>
                <td>

                    <input maxlength="15" value="<?php echo $NickName; ?>" class="text" name="NickName" type="text" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    echo $UserNameErr;
                    echo UserName;
                    ?>
                </td>
                <td>
                    <input  maxlength="15" class="text" value="<?php echo $UserName; ?>" name="UserName" type="text"/>

                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    echo $FamNameErr;

                    echo (FamName);
                    ?>
                </td>
                <td>
                    <input maxlength="15" value="<?php echo $FamName; ?>"  class="text" name="FamName" type="text" />&nbsp;

                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    echo $PassWordErr;
                    echo PassWord;
                    ?>
                    <img  title="<?php echo (ForcePasswordExample); ?>" border="0" alt="" style="cursor:help"  src="Programs/account/images/info.gif" width="15" height="15"/>

                </td>
                <td>
                    <input maxlength="1000" value="<?php echo $PassWord; ?>" class="text"  name="PassWord" type="password" id="account_password"/>


                    <span id="account_password_force"></span>
                </td>
            </tr>
            <tr>
            <tr>
                <td>
                    <?php
                    echo $UserMailErr;
                    echo UserMail;
                    ?>
                </td>
                <td>
                    <input maxlength="50" class="text"  value="<?php echo $UserMail; ?>"  name="UserMail" type="text" />&nbsp;

                </td>
            </tr>
        <td rowspan="1"> 
            <?php
            if (isset($CaptchaErr)) {
                echo $CaptchaErr;
            }
            ?>
            <img src="Programs/account/Themes/Default/ptcaptcha.php?s=<?php echo session_id(); ?>" />  = 
             
        </td>
        <td><input type="text" name="pt_recaptcha_response_field" placeholder="<?php echo ""; ?>" />  </td>
        </tr>
        <tr>
            <td style="text-align: center;" colspan="2" rowspan="1"><input value="<?php echo (submit) ?>" class="submit" name="SignUp" type="submit"></td>
        </tr>
        </tbody>
    </table>
</form>
