function stat_From_messagecenter(block,ThemeName,Yes,No,Lang){
    var blockname = block;
    try{
        block = new XMLHttpRequest();
    }
    catch(error){
        try{
            block = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(error){
            try{
                block = new ActiveXObject('Msxml2.XMLHTTP');
            }
            catch(error){
                block = null;
                return false;
            }
        }
    }
    block.onreadystatechange = function()
    {
        if (block.readyState == 4){
            if(block.status == 200){
                var key = block.responseXML.getElementsByTagName("key")[0].childNodes[0].childNodes[0].data;
                if( key == '1'){
                    document.getElementById('msg'+blockname).innerHTML = '<img border="0" src="admin/Themes/'+ThemeName+'/images/dialog_ok.png" width="16" height="16" title="" alt="" />'+Yes;
                }
                else{
                    document.getElementById('msg'+blockname).innerHTML =  ' <img border="0" src="admin/Themes/'+ThemeName+'/images/dialog_no.png" width="16" height="16" title=""  alt="" /><a target="_blank" href="http://phptransformer.com/release/Prog-getlicense_Lang-'+Lang+'_nl-1.pt">'+No+'</a>';
                }
            }
        }
    };
    var to_send_to_PHP = document.getElementById(blockname).value;
    block.open("POST", "admin/todo/blocks/proxy.php");
    block.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    block.send("data="+to_send_to_PHP);
    http_request = false;
}