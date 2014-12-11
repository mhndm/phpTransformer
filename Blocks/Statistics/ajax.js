function stat_From_Server(){
	try{ Answer = new XMLHttpRequest();
	}
	catch(error){
		try{
			Answer = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(error){
				try{
				Answer = new ActiveXObject('Msxml2.XMLHTTP');
				}
				catch(error){
				Answer = null; return false;
				}
			}
	}	
	Answer.onreadystatechange = change_when_have_statistics;
	var to_send_to_PHP = document.getElementById('crntusr').value;
	Answer.open("POST", "Blocks/Statistics/xml.php");
	Answer.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	Answer.send("data="+to_send_to_PHP);
	
	http_request = false;
}


function change_when_have_statistics(){
	if (Answer.readyState == 4){
		if(Answer.status == 200){
				var xx = 'members' ;
			document.getElementById(xx).innerHTML =
			Answer.responseXML.getElementsByTagName("members")[0].childNodes[0].childNodes[0].data ;
			document.getElementById('guests').innerHTML =
			Answer.responseXML.getElementsByTagName("guests")[0].childNodes[0].childNodes[0].data ;
			document.getElementById('Contries').innerHTML =
			Answer.responseXML.getElementsByTagName("Contries")[0].childNodes[0].childNodes[0].data;
			document.getElementById('ststpic').innerHTML = "";
		}
	}
}