function key_From_messagecenter(core,ThemeName,Yes,No,Lang){
    var corename = core;
    try{
        core = new XMLHttpRequest();
    }
    catch(error){
        try{
            core = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(error){
            try{
                core = new ActiveXObject('Msxml2.XMLHTTP');
            }
            catch(error){
                core = null;
                return false;
            }
        }
    }
    core.onreadystatechange = function()
    {
        if (core.readyState == 4){
            if(core.status == 200){
                var key = core.responseXML.getElementsByTagName("key")[0].childNodes[0].childNodes[0].data;                                                       
                if( key == '1'){
                    document.getElementById('msg'+corename).innerHTML = '<img border="0" src="admin/Themes/'+ThemeName+'/images/dialog_ok.png" width="16" height="16" title="" alt="" />\n\
                                        <span style="font-size: x-small;" >'+Yes+'</span>';
                }
                else{
                    document.getElementById('msg'+corename).innerHTML =  '<a target="_blank" href="http://phptransformer.com/release/Prog-getlicense_Lang-'+Lang+'_nl-1.pt">\n\
                                <img border="0" src="admin/Themes/'+ThemeName+'/images/dialog_alert.png" width="16" height="16" title=""  alt="" /><span style="font-size: x-small;" > '+No+' </span></a>';
                }
                                                        
            }
        }
    };
    var to_send_to_PHP = document.getElementById(corename).value;
    core.open("POST", "admin/proxy.php");
    core.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    core.send("data="+to_send_to_PHP);
    http_request = false;
}