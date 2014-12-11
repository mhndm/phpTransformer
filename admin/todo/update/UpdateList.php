<?php

/*

  Project: phpTransformer.com .
  File Location :  .
  File Name:  .
  Date Created: 00-00-2007.
  Last Modified: 00-00-2007.
  Descriptions: .
  Changes: .
  TODO:  .
  Author: Mohsen Mousawi mhndm@phptransformer.com .

 */
?>
<?php if (!isset($IsAdmin)) {
    header("location: ../");
} ?>
<?php

global $License, $Version, $xmlstr;
;
$Update = '<strong>' . autoUpdateMessageAllert . '</strong>';

//the core
$UpdateAvailbe = IfUpdateAvailbe();
$NumberOfUpdate = $UpdateAvailbe['Number'];
if (isset($UpdateAvailbe['Core'][0])) {
    $NewVersion = $UpdateAvailbe['Core'][0];
}
else{
    $NewVersion =false;
}
if (isset($UpdateAvailbe['Core'][1])) {
    $NewDesc = $UpdateAvailbe['Core'][1];
}
$OldVersion = $Version['core'];

if ($NewVersion) {
    $Update .= '<table width="950" border="0" cellpadding="2" cellspacing="2">
                <tr style="background-image:url(admin/Themes/' . $ThemeName . '/images/tr_back.gif);">
                            <td height="30" ><strong>' . phpTransformerUpdates . '</strong></td><td ></td>
                         </tr><tr> <td>
                ' . YourVersionIs . ' ' . $OldVersion . ' , ' . TheNewVersionNumberIs . ' ' . $NewVersion . '<br/>
                    ' . WeRecommendThatYouUpdateTheCoreBeforeAnyUpdates . '</td>';
    $Update .= '<td width="150"><form method="post" name="update">
                <input name="License" value="' . $License . '" type="hidden">
                <input class="submit" name="Update" value="' . UpdateNow . '" type="submit"></form>
                </td></tr></table>';
} else {
    $dbLastChekUpdate = new db();
    $LastChekUpdate = $dbLastChekUpdate->get_var("select `LastChekUpdate` from `params` ;");
    $Update .= '<table width="950" border="0" cellpadding="2" cellspacing="2"><tr><td>';
    $Update .= YouHaveTheLatestVersion . ' ( ' . YourVersionIs . ' ' . $OldVersion . ' ) ';
    $Update .= LastChekUpdate . ' ' . $LastChekUpdate . ' ' . DoChekUpdateNow . '</td><td  width="150">
                <form method="post" name="update" ><input name="todo" value="Update" type="hidden">
             <input class="submit" name="chekUpdate" value="' . chekUpdate . '" type="submit"></form></td></tr></table>';
}

//programs
$Update .= '<table width="950" border="0" cellpadding="2" cellspacing="2">
                <tr style="background-image:url(admin/Themes/' . $ThemeName . '/images/tr_back.gif);">
                    <td height="30" ><strong>' . ProgramsUpdates . '</strong></td><td ></td>
                 </tr>';
$ProgramsUpdate = $UpdateAvailbe['Programs'];
if (count($ProgramsUpdate)) {
    foreach ($ProgramsUpdate as $ProgramUpName) {
        $Name = $ProgramUpName[0];
        $NewVersion = $ProgramUpName[1];
        $License = $ProgramUpName[2];
        $Desc = $ProgramUpName[3];
        if (is_file('Programs/' . $Name . '/admin/desc.php')) {
            include_once 'Programs/' . $Name . '/admin/desc.php';
            $Vxml = new SimpleXMLElement($xmlstr);
            $OldVersion = $Vxml->Version;
        } else {
            $OldVersion = $Version['core'];
        }
        //include lang file
        $LangFile = 'Programs/' . $Name . '/admin/Languages/lang-' . $Lang . '.php';
        if (is_file($LangFile)) {
            include_once($LangFile);
        }
        $Update .= '<tr >
                <td><strong>' . constant($Name) . '</strong><br/>' . YouUseTheVersion . ' ' . $OldVersion . ' ' . UpdateToNewVersion . ' ' . $NewVersion
                . ' <br/>' . $Desc . '</td> <td width="150" >
                 <form method="post" name="update">
                 <input class="submit" name="UpdateProg" value="' . UpdateNow . '" type="submit">
                     <input name="ProgramName" value="' . $Name . '" type="hidden">
                     <input name="ProgramLicense" value="' . $License . '" type="hidden">
                     </form></td></tr>';
    }
    $Update .= '</table>';
} else {
    $Update .= '<tr ><td>' . NoUpdatesFound . '</td><td width="150"></td></tr>';
}
//Blocks
$Update .= '<table width="950" border="0" cellpadding="2" cellspacing="2">
                <tr style="background-image:url(admin/Themes/' . $ThemeName . '/images/tr_back.gif);">
                    <td height="30" ><strong>' . BlocksUpdates . '</strong></td><td ></td>
                 </tr>';
$BlocksUpdate = $UpdateAvailbe['Blocks'];
if (count($BlocksUpdate)) {
    foreach ($BlocksUpdate as $BlockUpName) {
        $Name = $BlockUpName[0];
        $NewVersion = $BlockUpName[1];
        $License = $BlockUpName[2];
        $Desc = $BlockUpName[3];
        if (is_file('Blocks/' . $Name . '/admin/desc.php')) {
            include_once 'Blocks/' . $Name . '/admin/desc.php';
            $Vxml = new SimpleXMLElement($xmlstr);
            $OldVersion = $Vxml->Version;
        } else {
            $OldVersion = $Version['core'];
        }
        //include lang file
        $LangFile = 'Blocks/' . $Name . '/admin/Languages/lang-' . $Lang . '.php';
        if (is_file($LangFile)) {
            include_once($LangFile);
        }
        $Update .= '<tr >
                <td><strong>' . constant($Name) . '</strong><br/>' . YouUseTheVersion . ' ' . $OldVersion . ' ' . UpdateToNewVersion . ' ' . $NewVersion
                . ' <br/>' . $Desc . '</td> <td width="150" >
                 <form method="post" name="update">
                 <input class="submit" name="UpdateBlock" value="' . UpdateNow . '" type="submit">
                     <input name="BlockName" value="' . $Name . '" type="hidden">
                     <input name="BlockLicense" value="' . $License . '" type="hidden">
                     </form></td></tr>';
    }
} else {
    $Update .= '<tr ><td>' . NoUpdatesFound . '</td><td width="150"></td></tr>';
}
$Update .= '</table>';

//Themes
$Update .= '<table width="950" border="0" cellpadding="2" cellspacing="2">
                <tr style="background-image:url(admin/Themes/' . $ThemeName . '/images/tr_back.gif);">
                    <td height="30" ><strong>' . ThemesUpdates . '</strong></td><td ></td>
                 </tr>';
$ThemesUpdate = $UpdateAvailbe['Themes'];
if (count($ThemesUpdate)) {
    foreach ($ThemesUpdate as $ThemeUpName) {
        $Name = $ThemeUpName[0];
        $NewVersion = $ThemeUpName[1];
        $License = $ThemeUpName[2];
        $Desc = $ThemeUpName[3];
        if (is_file('Themes/' . $Name . '/desc.php')) {
            include_once 'Themes/' . $Name . '/admin/desc.php';
            $Vxml = new SimpleXMLElement($xmlstr);
            $OldVersion = $Vxml->Version;
        } else {
            $OldVersion = $Version['core'];
        }
        $Update .= '<tr >
                    <td><strong>' . $Name . '</strong><br/>' . YouUseTheVersion . ' ' . $OldVersion . ' ' . UpdateToNewVersion . ' ' . $NewVersion
                . ' <br/>' . $Desc . '</td> <td width="150" >
                     <form method="post" name="update">
                     <input class="submit" name="UpdateTheme" value="' . UpdateNow . '" type="submit">
                         <input name="ThemeName" value="' . $Name . '" type="hidden">
                         <input name="ThemeLicense" value="' . $License . '" type="hidden">
                         </form></td></tr>';
    }
} else {
    $Update .= '<tr ><td>' . NoUpdatesFound . '</td><td width="150"></td></tr>';
}
$Update .= '</table>';
?>
