function ban_From_Server(){
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
	Answer.onreadystatechange = change_when_have_text;
	var to_send_to_PHP = document.getElementById('bantexttitle').value;
	to_send_to_PHP = to_send_to_PHP +"|"+ document.getElementById('bantextdesc1').value;
	to_send_to_PHP = to_send_to_PHP +"|"+ document.getElementById('bantextdesc2').value;
	to_send_to_PHP = to_send_to_PHP +"|"+ document.getElementById('banshowaddress').value;
	to_send_to_PHP = to_send_to_PHP +"|"+ document.getElementById('bantargeturl').value;
        
	Answer.open("POST", "Programs/ads/xml.php");
	Answer.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	Answer.send("data="+to_send_to_PHP);
	http_request = false;
}

function change_when_have_text(){
	if (Answer.readyState == 4){
		if(Answer.status == 200){
			document.getElementById('repbantexttitle').innerHTML =
			Answer.responseXML.getElementsByTagName("bantexttitle")[0].childNodes[0].childNodes[0].data ;
			document.getElementById('repbantextdesc1').innerHTML =
			Answer.responseXML.getElementsByTagName("bantextdesc1")[0].childNodes[0].childNodes[0].data ;
			document.getElementById('repbantextdesc2').innerHTML =
			Answer.responseXML.getElementsByTagName("bantextdesc2")[0].childNodes[0].childNodes[0].data ;
			document.getElementById('repbanshowaddress').innerHTML =
			Answer.responseXML.getElementsByTagName("banshowaddress")[0].childNodes[0].childNodes[0].data ;
		}
	}
}

