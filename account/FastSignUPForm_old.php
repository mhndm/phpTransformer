
<form method="post" name="SignUpForm">
    <table border="0" cellpadding="10" cellspacing="4">
        <tbody>
            <tr>
                <td>
                    <?php
                    echo (NickName);
                    ?>
                </td>
                <td>
                    <input maxlength="15" value="<?php echo $NickName; ?>" class="text" name="NickName" type="text" />
                    
                        <img border="0" title="<?php echo (NickNameInfo); ?>" alt="" style="cursor:help" src="Programs/account/images/info.gif" width="15" height="15"/>
                        <?php
                        echo $NickNameErr;
                        ?>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    echo (UserName)
                    ?>
                </td>
                <td>
                    <input  maxlength="15" class="text" value="<?php echo $UserName; ?>" name="UserName" type="text"/>
                    <?php
                    echo $UserNameErr;
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    echo (FamName);
                    ?>
                </td>
                <td>
                    <input maxlength="15" value="<?php echo $FamName; ?>"  class="text" name="FamName" type="text" />&nbsp;
                    <?php
                    echo $FamNameErr;
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    echo (PassWord);
                    ?>
                </td>
                <td>
                    <input maxlength="1000" value="<?php echo $PassWord; ?>" class="text"  name="PassWord" type="password" id="account_password"/>
                    
                        <img  title="<?php echo (ForcePasswordExample); ?>" border="0" alt="" style="cursor:help"  src="Programs/account/images/info.gif" width="15" height="15"/>
                        <?php
                        echo $PassWordErr;
                        
                        ?>
                        <span id="account_password_force"></span>
                </td>
            </tr>
            <tr>
            <tr>
                <td>
                    <?php
                    echo (UserMail);
                    ?>
                </td>
                <td>
                    <input maxlength="50" class="text"  value="<?php echo $UserMail; ?>"  name="UserMail" type="text" />&nbsp;
                    <?php
                    echo $UserMailErr;
                    ?>
                </td>
            </tr>
        <td dir="<?php echo DirHtml; ?>" style="text-align: center;direction:ltr;" colspan="2" rowspan="1"> <?php
                    require_once('recaptchalib.php');
                    $publickey = "6LdiFb0SAAAAAIFT4dRRJOrT0Y-EpAFUekErpqHG"; // you got this from the signup page
                    echo recaptcha_get_html($publickey);
                    if (isset($CaptchaErr)) {
                        echo $CaptchaErr;
                    }
                    ?> </td>

        </tr>
        <tr>
            <td style="text-align: center;" colspan="2" rowspan="1"><input value="<?php echo (submit) ?>" class="submit" name="SignUp" type="submit"></td>
        </tr>
        </tbody>
    </table>
</form>
