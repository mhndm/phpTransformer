
function get_From_Server(){
	
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
	Answer.onreadystatechange = change_when_have_info;
	var password_to_send_to_PHP = document.getElementById('password').value;	
	Answer.open("POST", "Programs/account/xml.php");
	Answer.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	Answer.send("password="+password_to_send_to_PHP);
	
	var $img_loading = "Programs/account/images/indicator.gif"; 
	$img_loading = "<img alt='...' width=32 height=16 src='"+$img_loading+"' /> ";
	document.getElementById('ChangePic').style.display="block";
	document.getElementById('ChangePic').innerHTML = $img_loading;
	http_request = false; 
}
	
function change_when_have_info(){
	if (Answer.readyState == 4){
		if(Answer.status == 200){
		if (Answer.responseXML.getElementsByTagName("answer")[0].childNodes[0].childNodes[0].data == "easy"){
			document.getElementById('easy').innerHTML = '<hr style="height: 4px; color: orange;">';
			document.getElementById('medium').innerHTML = '&nbsp;';
			document.getElementById('strong').innerHTML = '&nbsp;';
		}
		if (Answer.responseXML.getElementsByTagName("answer")[0].childNodes[0].childNodes[0].data == "medium"){
			document.getElementById('easy').innerHTML = '&nbsp;';
			document.getElementById('medium').innerHTML = '<hr style="height: 4px; color: orange;">';
			document.getElementById('strong').innerHTML = '&nbsp;';
		}
		if (Answer.responseXML.getElementsByTagName("answer")[0].childNodes[0].childNodes[0].data == "strong"){
			document.getElementById('easy').innerHTML = '&nbsp;';
			document.getElementById('medium').innerHTML = '&nbsp;';
			document.getElementById('strong').innerHTML = '<hr style="height: 4px; color: orange;">';
		}
		document.getElementById('ChangePic').innerHTML = '';
		}
	}
}