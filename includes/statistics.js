try{stat = new XMLHttpRequest();
}
catch(error){
        try{
                stat = new ActiveXObject("Microsoft.XMLHTTP");
                }
                catch(error){
                        try{
                        stat = new ActiveXObject('Msxml2.XMLHTTP');
                        }
                        catch(error){
                        stat = null;
                        }
                }
}

stat.open("POST", "includes/putStatistics.php");
stat.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
stat.send("put=1");
http_request = false;