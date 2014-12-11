function poll_From_Server(){
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
       
        Answer.onreadystatechange = stat_result;
        IdLang = document.getElementById('IdLang').value;
        Lang = document.getElementById('Lang').value;
        UserId = document.getElementById('UserId').value;
	Answer.open("POST", "Blocks/Pool/xml.php");
	Answer.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        Answer.send("UserId="+UserId+"&IdLang="+IdLang+"&Lang="+Lang+ChekVals());
         document.getElementById('PollBlock').innerHTML = '<div style="height:50px; text-align:center; margin-top: 50px;"><img src="Blocks/Pool/images/indicator.gif" alt="..." /></div>';
	http_request = false;
        
}
function stat_result(){
	if (Answer.readyState == 4){
		if(Answer.status == 200){
			document.getElementById('PollBlock').innerHTML =
			Answer.responseXML.getElementsByTagName("PollResult")[0].childNodes[0].childNodes[0].data;
		}
	}
}
function ChekVals(){
    var Opt = '&';
      for(i=0; i<document.poolform.elements.length; i++){
          if(document.poolform.elements[i].type=="checkbox"){
              if(document.poolform.elements[i].checked==true){
                  Opt = Opt+document.poolform.elements[i].name+'='+document.poolform.elements[i].value+'&';
            }
        }
        if(document.poolform.elements[i].type=="radio"){
           if(document.poolform.elements[i].checked==true){
                  Opt = Opt+document.poolform.elements[i].name+'='+document.poolform.elements[i].value+'&';
            }
        }
    }
    Opt = Opt+'poolcomment='+document.poolform.poolcomment.value+'&';
    return Opt;
}