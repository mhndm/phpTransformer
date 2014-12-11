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
<form method="post" action="">
    <table style="width: 400px">
        <tr>
            <td colspan="2"><strong><?php echo SendThisPageToFriend; ?></strong></td>
        </tr>
        <tr>
            <td> <?php echo FriendName; ?> : &nbsp;</td>
            <td>
                <input class="text" name="FriendName" maxlength="50" type="text" style="width: 249px" /></td>
        </tr>
        <tr>
            <td><?php echo FriendEmail; ?> :&nbsp;</td>
            <td>
                <input class="text" name="FriendEmail" maxlength="50" type="text" style="width: 248px" /></td>
        </tr>
        <tr>
            <td colspan="2"><?php echo FriendTextMessage; ?> : 
                <textarea name="FriendTextMessage" class="editor" style="width: 564px; height: 191px;"><?php echo FriendSampleMessage; ?></textarea>
                <br/>
                <?php
                echo InputCode . '&nbsp; <img src="images/captcha.php" alt=""/> &nbsp;' . here . ' <input name="CodePic" type="text" size="12" maxlength="35" class="text" />';
                ?>
                <input class="submit" name="SubmitToFriend" type="submit" value="<?php echo submit; ?>" /></td>
            </div>
        </tr>
    </table>
    <br />
    <br>
    <br>
</form>

