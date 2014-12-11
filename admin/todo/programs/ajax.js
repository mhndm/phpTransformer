function stat_From_messagecenter(program,ThemeName,Yes,No,Lang){
    var programname = program;
    try{
        program = new XMLHttpRequest();
    }
    catch(error){
        try{
            program = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(error){
            try{
                program = new ActiveXObject('Msxml2.XMLHTTP');
            }
            catch(error){
                program = null;
                return false;
            }
        }
    }
    program.onreadystatechange = function()
    {
        if (program.readyState == 4){
            if(program.status == 200){
                var key = program.responseXML.getElementsByTagName("key")[0].childNodes[0].childNodes[0].data;
                if( key == '1'){
                    document.getElementById('msg'+programname).innerHTML = 
                    '<img border="0" src="admin/Themes/'+ThemeName+'/images/dialog_ok.png" width="16" height="16" title="" alt="" />'+Yes;
                }
                else{
                    document.getElementById('msg'+programname).innerHTML = 
                    '<a target="_blank" href="http://phptransformer.com/release/Prog-getlicense_Lang-'+Lang+'_nl-1.pt">\n\
                        <img border="0" src="admin/Themes/'+ThemeName+'/images/dialog_no.png" width="16" height="16" title=""  alt="" />\n\
                        '+No+'</a>';
                }
            }
        }
    };
    var to_send_to_PHP = document.getElementById(programname).value;
    program.open("POST", "admin/todo/programs/proxy.php");
    program.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    program.send("data="+to_send_to_PHP);
    http_request = false;
}