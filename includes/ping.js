function pingSE(Title, Url){
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
                return true;
            }
        }
    };
    core.open("POST", "includes/ping.php");
    core.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    core.send("Title="+Title+"&Url="+Url);
    http_request = false;
}
