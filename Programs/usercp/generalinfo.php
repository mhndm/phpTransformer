<?php
global $TitlePage;
$TitlePage .= ' .:. ' . generalInfo;
?>
<table border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>&nbsp;</td>
        <td><?php echo (UserName) ?> :</td>
        <td><?php
            global $UserName;
            echo $UserName;
            ?></td>
        <td>
            <a href="<?php
            $Vars = array("Prog", "edtusr");
            $Vals = array("usercp", "UserName");
            echo CreateLink('', $Vars, $Vals);
            ?>" title="<?php echo (edit) . " " . (UserName) ?>" >
                <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">
            </a>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo (ParentName) ?> :</td>
        <td><?php
            global $ParentName;
            echo $ParentName;
            ?></td>
        <td>    	
            <a href="<?php
            $Vars = array("Prog", "edtusr");
            $Vals = array("usercp", "ParentName");
            echo CreateLink('', $Vars, $Vals);
            ?>" title="<?php echo (edit) . " " . (ParentName) ?>" >
                <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">
            </a>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo (FamName) ?> :</td>
        <td><?php
            global $FamName;
            echo $FamName;
            ?></td>
        <td>    	
            <a href="<?php
            $Vars = array("Prog", "edtusr");
            $Vals = array("usercp", "FamName");
            echo CreateLink('', $Vars, $Vals);
            ?>" title="<?php echo (edit) . ' ' . (FamName) ?>" >
                <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">
            </a>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo (NickName) ?> :</td>
        <td><?php
            global $NickName;
            echo $NickName;
            ?></td>
        <td>
            <a href="javascript:void(0)" title="<?php echo (UserCntChangeEmailOrNickName) ?>">
                &nbsp;<img border="0" alt="" style="cursor:help" src="Programs/usercp/images/info.gif" width="15" height="15"/>
            </a>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo (PassWord) ?> :</td>
        <td><?php echo (Hidden) ?></td>
        <td>    	
            <a href="<?php
            $Vars = array("Prog", "edtusr");
            $Vals = array("usercp", "PassWord");
            echo CreateLink('', $Vars, $Vals);
            ?>" title="<?php echo (edit) . ' ' . (PassWord) ?>" >
                <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">
            </a>
            &nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo (BirthDate) ?> :</td>
        <td><?php
            global $BirthDate;
            echo $BirthDate;
            ?></td>
        <td>    	
            <a href="<?php
            $Vars = array("Prog", "edtusr");
            $Vals = array("usercp", "BirthDate");
            echo CreateLink('', $Vars, $Vals);
            ?>" title="<?php echo (edit) . ' ' . (BirthDate) ?>" >
                <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">
            </a>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo (UserMail) ?> :</td>

        <?php
        global $UserMail, $ThemeName;
        $emailAddress = VarTheme('@', '<img src="Themes/' . $ThemeName . '/Images/at.gif" alt="@" border="0"/>', $UserMail);
        ?>
        <td><?php echo $emailAddress; ?></td>
        <td>
            <a href="javascript:void(0)" title="<?php echo (UserCntChangeEmailOrNickName) ?>">
                &nbsp;<img border="0" alt="" style="cursor:help" src="Programs/usercp/images/info.gif" width="15" height="15"/>
            </a>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo (Sex) ?> :</td>
        <td>
            <?php
            global $Sex;
            if ($Sex == 1) {
                echo (Male);
            } else {
                echo (Female);
            }//end if
            ?>
        </td>
        <td>    	
            <a href="<?php
            $Vars = array("Prog", "edtusr");
            $Vals = array("usercp", "Sex");
            echo CreateLink('', $Vars, $Vals);
            ?>" title="<?php echo (edit) . ' ' . (Sex) ?>" >
                <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">
            </a>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo (Hobies) ?> :</td>
        <td><?php
            global $Hobies;
            echo $Hobies;
            ?></td>
        <td>    	<a href="<?php
            $Vars = array("Prog", "edtusr");
            $Vals = array("usercp", "Hobies");
            echo CreateLink('', $Vars, $Vals);
            ?>" title="<?php echo (edit) . ' ' . (Hobies) ?>" >
                <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">
            </a>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo (Job) ?> :</td>
        <td><?php
            global $Job;
            echo $Job;
            ?></td>
        <td>    	<a href="<?php
            $Vars = array("Prog", "edtusr");
            $Vals = array("usercp", "Job");
            echo CreateLink('', $Vars, $Vals);
            ?>" title="<?php echo (edit) . ' ' . (Job) ?>" >
                <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">
            </a>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo (Education) ?> :</td>
        <td><?php
            global $Education;
            echo $Education;
            ?></td>
        <td>    	
            <a href="<?php
            $Vars = array("Prog", "edtusr");
            $Vals = array("usercp", "Education");
            echo CreateLink('', $Vars, $Vals);
            ?>" title="<?php echo (edit) . ' ' . (Education) ?>" >
                <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">
            </a>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo (UserSite) ?> :</td>
        <td><?php
            global $UserSite;
            echo $UserSite;
            ?></td>
        <td>    	
            <a href="<?php
            $Vars = array("Prog", "edtusr");
            $Vals = array("usercp", "UserSite");
            echo CreateLink('', $Vars, $Vals);
            ?>" title="<?php echo (edit) . ' ' . (UserSite) ?>" >
                <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">
            </a>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo (UserSign) ?> :</td>
        <td><?php
            global $UserSign;
            echo $UserSign;
            ?></td>
        <td>    	
            <a href="<?php
            $Vars = array("Prog", "edtusr");
            $Vals = array("usercp", "UserSign");
            echo CreateLink('', $Vars, $Vals);
            ?>" title="<?php echo (edit) . ' ' . (UserSite) ?>" >
                <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">
            </a>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td valign="top"><?php echo UserPic ?> :</td>
        <td><span id="MiniNewsPic" style="width:200px; height:200px;">
                <?php
                global $UserPic, $CustomHead, $WebiteFolder;
                if ($UserPic != "") {
                    echo '<img src="' . $UserPic . '" />';
                } else {
                    echo '<img src="images/avatars/noavatar.gif" />';
                }//end if
                if (!is_dir('uploads/users/' . $NickName)) {
                    mkdir('uploads/users/' . $NickName, 0755, true);
                }
                echo '</span>';
                if ($NickName != "Guest") {

                    echo pt_uploader(
                            $input_hidden_target = "upfiles", $multi_files = 0, $allowed = "images", $div_id = 1, 
                            $path_upload = 'uploads/users/' . $NickName, $path_thumbs = 'uploads/users/' . $NickName, 
                            $thumbs = 
                            array('uploads/users/' . $NickName . '/avatar_32' => 32,
                                'uploads/users/' . $NickName . '/avatar_64' => 64,
                                'uploads/users/' . $NickName . '/avatar_128' => 128,
                                'uploads/users/' . $NickName . '/avatar_256' => 256
                                ), 
                            $amazone_s3 = false, $upload_to_youtube = false, $rename_files = true, $watermark_path = false
                            , $drop_here = drop_here, $choose_pic = choose_pic,
                            'Programs/usercp/ptuploader.js',
                            'usercp',
                            array('MiniNewsPic','UserPic'));

           
                }
                ?>
        </td>
        <td>   <ul id="basicUploadSuccessExample" class="unstyled"></ul> 	
        </td>
    </tr>
</table>
