<script language="javascript" type="text/javascript">
                        document.onkeydown = document.onkeypress = function (evt) {
                            if (!evt && window.event) {
                                evt = window.event;
                            }
                            var keyCode = evt.keyCode ? evt.keyCode :
                                evt.charCode ? evt.charCode : evt.which;
                            if (keyCode) {
                                if (evt.ctrlKey) {
                                    if(keyCode==83){
                                                            document.getElementById("SaveAdminPermissions").click();
                                        return false;
                                    }
                                    return false;
                                }
                            }
                            return true;
                        }
                    </script>
<table style="width: 880px;" border="0" cellpadding="2" cellspacing="2">
      <tr>
        <td style="font-weight: bold;" colspan="5"rowspan="1" ><br />
        {PeopleConst}</td>
      </tr>
      <tr>
        <td style="vertical-align: top;">
            <input {members} name="members" value="members" type="checkbox">&nbsp;{MembersConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {NewUser} name="NewUser" value="NewUser" type="checkbox">{NewUserConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {DeleteUser} name="DeleteUser" value="DeleteUser" type="checkbox">{DeleteUserConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {SearchUser} name="SearchUser" value="SearchUser" type="checkbox">{SearchUserConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {ResetPassword} name="ResetPassword" value="ResetPassword" type="checkbox">{ResetPasswordConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {BanUser} name="BanUser" value="BanUser" type="checkbox">{BanUserConst}
        </td>
        <td style="vertical-align: top;">
            <input name="Groups" {Groups} value="Groups" type="checkbox">{GroupsConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {NewGroup} name="NewGroup" value="NewGroup" type="checkbox">{NewGroupConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {DeleteGroup} name="DeleteGroup" value="DeleteGroup" type="checkbox">{DeleteGroupConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {SwitchGroup} name="SwitchGroup" value="SwitchGroup" type="checkbox">{SwitchGroupConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {UsersGroup} name="UsersGroup" value="UsersGroup" type="checkbox">{UsersGroupConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {ChangeUserGroup} name="ChangeUserGroup" value="ChangeUserGroup" type="checkbox">{ChangeUserGroupConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {EditGroup} name="EditGroup" value="EditGroup" type="checkbox">{EditGroupConst}
        </td>
        <td style="vertical-align: top;">
            <input name="Admins" {Admins} value="Admins" type="checkbox">{AdminsConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {listAdmins} name="listAdmins" value="listAdmins" type="checkbox">{listAdminsConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {adminPerm} name="adminPerm" value="adminPerm" type="checkbox">{adminPermConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {adminDelete} name="adminDelete" value="adminDelete" type="checkbox">{adminDeleteConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {adminNew} name="adminNew" value="adminNew" type="checkbox">{adminNewConst}
        </td>
        <td style="vertical-align: top;">
            <input name="Maillist" {Maillist} value="Maillist" type="checkbox">{MaillistConst}<br>
        </td>
        <td style="vertical-align: top;">
            <input name="Letters" {Letters} value="Letters" type="checkbox">{LettersConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {Newletter} name="Newletter" value="Newletter" type="checkbox">{NewletterConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {Listletter} name="Listletter" value="Listletter" type="checkbox">{ListletterConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {deletel} name="deletel" value="deletel" type="checkbox">{deletelConst}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<input {editl} name="editl" value="editl" type="checkbox">{editlConst}<br>
        </td>
      </tr>

      <tr >
          <td  colspan="5" rowspan="1" style="vertical-align: top;"><strong><br />
            {ControlConst}
        </strong></td>
      </tr>
      <tr>
          <td style="vertical-align: top;">
              <input {BlockControlChek} name="blockscontrol" value="blockscontrol" type="checkbox">{BlockControl}
          </td>
          <td style="vertical-align: top;"><input {ProgramsControlChek} name="programscontrol" value="programscontrol" type="checkbox">{ProgramsControl}</td>
          <td style="vertical-align: top;"><input {ProgramsPermissionsChek} name="programspermisions" value="programspermisions" type="checkbox">{ProgramsPermissions}</td>
          <td style="vertical-align: top;"> <input {BlockPermissionsChek} name="blockspermisions" value="blockspermisions" type="checkbox">{BlockPermissions}</td>
          <td><input {SpecialPermissionChek} name="specialpermision" value="specialpermision" type="checkbox">{SpecialPermission}</td>
      </tr>
      <tr>
          <td style="vertical-align: top;"><input {FirewallChek} name="firewall" value="firewall" type="checkbox"> {Firewall}<br />
              &nbsp;&nbsp;&nbsp;&nbsp;<input {AntifloodChek} name="antiflood" value="antiflood" type="checkbox">{Antiflood}
            <br />
            &nbsp;&nbsp;&nbsp;&nbsp;<input {BlockingChek} name="blocking" value="blocking" type="checkbox">{Blocking}
        </td>
          <td style="vertical-align: top;"><input {LogintriesChek} name="faildlogin" value="faildlogin" type="checkbox">{Logintries}</td>
          <td style="vertical-align: top;"></td>
          <td style="vertical-align: top;"></td>
          <td style="vertical-align: top;"></td>
      </tr>

      <tr>
          <td  colspan="5" rowspan="1" style="vertical-align: top;"><strong><br />
            {ManagmentConst}
        </strong></td>
      </tr>
      <tr>
          <td style="vertical-align: top;">
              <input {OptionsChek} name="options" value="options" type="checkbox">{Options}
          </td>
          <td style="vertical-align: top;">
              <input {WebFolderChek} name="webfolder" value="webfolder" type="checkbox">{WebFolder}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;{Upload} ! iframe
              
          </td>
          <td style="vertical-align: top;">
              <input {ThemesChek} name="themes" value="themes" type="checkbox">{Themes}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {delThemeChek} name="delTheme" value="delTheme" type="checkbox">{delTheme}
          </td>
          <td style="vertical-align: top;">
              <input {LanguagesChek} name="languages" value="languages" type="checkbox">{Languages}
              <br/>
              <input {pluginsChek} name="plugins" value="plugins" type="checkbox">{plugins}
          </td>
          <td  style="vertical-align: top;">
              <input {RobotadministratorChek} name="robotsadmin" value="robotsadmin" type="checkbox">{Robotadministrator}
              <br/> 
              <input {appsstoreChek} name="appsstore" value="appsstore" type="checkbox">{appsstore}
          </td>
      </tr>
      <tr>
          <td style="vertical-align: top;">
              <input {CacheSystemChek} name="cache" value="cache" type="checkbox">{CacheSystem}
        </td>
          <td style="vertical-align: top;">
              <input {SearchEngineOptimizationChek} name="SEO" value="SEO" type="checkbox">{SearchEngineOptimization}</td>
          <td style="vertical-align: top;"><input {CountrieslanguagesChek} name="contieslangs" value="contieslangs" type="checkbox">{Countrieslanguages}</td>
          <td style="vertical-align: top;"></td>
          <td style="vertical-align: top;"></td>
      </tr>

      <tr>
          <td  colspan="5" rowspan="1" style="vertical-align: top;"><strong><br />
            {SupportConst}
        </strong></td>
      </tr>
      <tr>
          <td style="vertical-align: top;">
              <input {InstallerChek} name="installer" value="installer" type="checkbox"> {Installer}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {NewProgramChek} name="newprograms" value="newprograms" type="checkbox">{NewProgram}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {NewBlockChek} name="newblock" value="newblock" type="checkbox">{NewBlock}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {NewThemChek} name="NewTheme" value="NewTheme" type="checkbox">{NewThem}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {AddonsChek} name="Addons" value="Addons" type="checkbox">{Addons}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {UpdateChek} name="Update" value="Update" type="checkbox">{Update}<br>
          </td>
          <td style="vertical-align: top;"><input {BugsandreportChek} name="bugsandreport" value="bugsandreport" type="checkbox">{Bugsandreport}</td>
          <td style="vertical-align: top;">
              <input {ErrorPagesChek} name="Error" value="Error" type="checkbox">{ErrorPages}
          </td>
          <td style="vertical-align: top;">
              <input {databaseChek} name="database" value="database" type="checkbox">{database}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {BackupChek} name="backup" value="backup" type="checkbox">{Backup}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {RestoreChek} name="restore" value="restore" type="checkbox">{Restore}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {OptimizeChek} name="optimize" value="optimize" type="checkbox">{Optimize}<br>
          </td>
          <td  style="vertical-align: top;">
              &nbsp;&nbsp;&nbsp;&nbsp;<input {sendmoduleChek} name="sendmodule" value="sendmodule" type="checkbox">{sendmodule}<br>
            </td>
      </tr>

      <tr>
          <td  colspan="5" rowspan="1" style="vertical-align: top;"><strong><br/>{DataConst}</strong></td>
      </tr>
      <tr>
          <td style="vertical-align: top;">
              <input {NewsbarChek} name="newsbar" value="newsbar" type="checkbox">{Newsbar}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {AddNewsChek} name="AddNews" value="AddNews" type="checkbox">{AddNews}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {editnewsChek} name="editnews" value="editnews" type="checkbox">{editnews}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {delnewsChek} name="delnews" value="delnews" type="checkbox">{delnews}<br>
          </td>
          <td style="vertical-align: top;">
             <input {MenulayersChek} name="layersmenu" value="layersmenu" type="checkbox"> {Menulayers}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {delteMenuChek} name="delteMenu" value="delteMenu" type="checkbox">{delteMenu}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {RootMenuChek} name="RootMenu" value="RootMenu" type="checkbox">{RootMenu}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {SubMenuChek} name="SubMenu" value="SubMenu" type="checkbox">{SubMenu}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {AllElemntsChek} name="AllElemnts" value="AllElemnts" type="checkbox">{AllElemnts}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {AddMenuChek} name="AddMenu" value="AddMenu" type="checkbox">{AddMenu}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {AddElemntsChek} name="AddElemnts" value="AddElemnts" type="checkbox">{AddElemnts}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {editMenuChek} name="editMenu" value="editMenu" type="checkbox">{editMenu}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {ChildsOfMenuChek} name="ChildsOfMenu" value="ChildsOfMenu" type="checkbox">{ChildsOfMenu}<br>

          </td>
          <td style="vertical-align: top;">
             <input {mainmenuChek} name="mainmenu" value="mainmenu" type="checkbox">{Mainmenu}<br>
             &nbsp;&nbsp;&nbsp;&nbsp;<input {DeleteElementChek} name="DeleteElement" value="DeleteElement" type="checkbox">{DeleteElement}<br>
             &nbsp;&nbsp;&nbsp;&nbsp;<input {BrowseMenuChek} name="BrowseMenu" value="BrowseMenu" type="checkbox">{BrowseMenu}<br>
             &nbsp;&nbsp;&nbsp;&nbsp;<input {AddElementChek} name="AddElement" value="AddElement" type="checkbox">{AddElement}<br>
             &nbsp;&nbsp;&nbsp;&nbsp;<input {EditElementChek} name="EditElement" value="EditElement" type="checkbox">{EditElement}<br>
          </td>
          <td style="vertical-align: top;">
              <input {TranslationsChek} name="Translations" value="Translations" type="checkbox">{Translations}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {NewTransChek} name="NewTrans" value="NewTrans" type="checkbox">{NewTrans}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {LisTransChek} name="LisTrans" value="LisTrans" type="checkbox">{LisTrans}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;<input {EditTransChek} name="EditTrans" value="EditTrans" type="checkbox">{EditTrans}<br>
          </td>
          <td style="vertical-align: top;">
              <input {RecyclebinChek} name="recycle" value="recycle" type="checkbox">{Recyclebin}<br>

          </td>
      </tr>
      <tr>
          <td  colspan="5" rowspan="1" style="vertical-align: top;"><strong><br/>{ProgramsControlConst}</strong></td>
      </tr>
        {ProgramsControlTr}
      <tr>
          <td  colspan="5" rowspan="1" style="vertical-align: top;"><strong><br/>{BlocksControlConst}</strong></td>
      </tr>
        {BlocksControlTr}
  </table>
<br/>
  <input name="SaveAdminPermissions" id="SaveAdminPermissions" value="{SaveAdminPermissionsConst}" type="submit">
  <br/>

<script type="text/javascript">
    function checkAll(){
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++){

            if (inputs[i].type == "checkbox" & inputs[i].name!='IsAdam' & inputs[i].name!='Stopped' ){
                inputs[i].checked = true;
            }
        continue;
        }
    }
    
    function uncheckAll(){
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++){
            if (inputs[i].type == "checkbox" & inputs[i].name!='IsAdam' & inputs[i].name!='Stopped'){
                inputs[i].checked = false;
            }
        continue;
        }
    }
    
    function StoppedChek(){
        var Stopped = document.forms["Permissions"].Stopped;
        var IsAdam = document.forms["Permissions"].IsAdam;
        
        if(IsAdam.checked == true & Stopped.checked==true ){
            IsAdam.checked = false;
        }

    }
    
    function IsAdamChek(){
        var Stopped = document.forms["Permissions"].Stopped;
        var IsAdam = document.forms["Permissions"].IsAdam;

        if(IsAdam.checked == true & Stopped.checked==true ){
            Stopped.checked = false;
        }

    }
</script>