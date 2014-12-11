
function FirstStep(ObjectName,ThemeName,UpdateLinkBecauseNoLicense,Link,ObjectLicense,Ref,Lang,autoBackupFolder,UpdateType){
        try{req = new XMLHttpRequest();
	}
	catch(error){
		try{
			req = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(error){
				try{
				req = new ActiveXObject('Msxml2.XMLHTTP');
				}
				catch(error){
				req = null;return false;
				}
			}
	}
        req.onreadystatechange = function()
            {
                    if (req.readyState == 4){
                        if(req.status == 200){
                            var D = req.responseXML.getElementsByTagName("status")[0].firstChild.nodeValue;
                            var X;
                            
                            if(D==1){
                                X =  '<img style="width: 16px; height: 16px;" alt="-" src="admin/Themes/'+ThemeName+'/images/dialog_ok.png">';
                                InnerHTMLAndExecScript('5a','<img alt="X" src="admin/Themes/'+ThemeName+'/images/progress_bar.gif">');
                                var f = req.responseXML.getElementsByTagName("type")[0].firstChild.nodeValue;
                                if(f=='auto'){
                                   var Protocole = req.responseXML.getElementsByTagName("Protocole")[0].firstChild.nodeValue;
                                   var SupportPath = req.responseXML.getElementsByTagName("SupportPath")[0].firstChild.nodeValue;
                                   var MirrorPath = req.responseXML.getElementsByTagName("MirrorPath")[0].firstChild.nodeValue;
                                   var Hash = req.responseXML.getElementsByTagName("Hash")[0].firstChild.nodeValue;

                                   step2(Protocole,SupportPath,MirrorPath,Hash,ThemeName,Lang,autoBackupFolder,UpdateType,ObjectName);

                                }
                                else{
                                    InnerHTMLAndExecScript('5',X);
                                    InnerHTMLAndExecScript('5a','');
                                    InnerHTMLAndExecScript('6',X);
                                    InnerHTMLAndExecScript('7',X);
                                    var Protocole =  req.responseXML.getElementsByTagName("Protocole")[0].firstChild.nodeValue;
                                    var DownPath =  req.responseXML.getElementsByTagName("DownPath")[0].firstChild.nodeValue;
                                    var DownLink = UpdateLinkBecauseNoLicense + ' <a target="_blank" href="' + Protocole + '://' + DownPath + '"> ' + Link + ' </a>';
                                    InnerHTMLAndExecScript('7a',DownLink);
                                    var noIcon = '<img style="width: 16px; height: 16px;" alt="X" src="admin/Themes/'+ThemeName+'/images/dialog_no.png">';
                                    InnerHTMLAndExecScript('8',noIcon);
                                    InnerHTMLAndExecScript('9',noIcon);
                                    InnerHTMLAndExecScript('10',noIcon);
                                    InnerHTMLAndExecScript('11',X);
                                }
                                
                            }else{
                                X = '<img style="width: 16px; height: 16px;" alt="X" src="admin/Themes/'+ThemeName+'/images/dialog_no.png">';
                                InnerHTMLAndExecScript('5',X);
                                InnerHTMLAndExecScript('6',X);
                                InnerHTMLAndExecScript('7',X);
                                InnerHTMLAndExecScript('8',X);
                                InnerHTMLAndExecScript('9',X);
                                InnerHTMLAndExecScript('10',X);
                                InnerHTMLAndExecScript('11',X);
                            }
                            InnerHTMLAndExecScript('1',X);
                            InnerHTMLAndExecScript('2',X);
                            InnerHTMLAndExecScript('3',X);
                            InnerHTMLAndExecScript('4',X);


                            
                        }
                    }
            };
        req.open("POST", 'admin/todo/update/proxy.php');
	req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	req.send("ObjectName="+ObjectName+"&ObjectLicense="+ObjectLicense+"&ref="+Ref);
	http_request = false;
        

}

function step2(Protocole,SupportPath,MirrorPath,Hash,ThemeName,Lang,autoBackupFolder,UpdateType,ObjectName){


      try{req2 = new XMLHttpRequest();
	}
	catch(error){
		try{
			req2 = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(error){
				try{
				req2 = new ActiveXObject('Msxml2.XMLHTTP');
				}
				catch(error){
				req2 = null;return false;
				}
			}
	}
        req2.onreadystatechange = function()
            {
                    if (req2.readyState == 4){
                        if(req2.status == 200){
                            var D = req2.responseXML.getElementsByTagName("FileExist")[0].firstChild.nodeValue;
                            var Y =  '<img style="width: 16px; height: 16px;" alt="-" src="admin/Themes/'+ThemeName+'/images/dialog_ok.png">';
                            var X =  '<img style="width: 16px; height: 16px;" alt="X" src="admin/Themes/'+ThemeName+'/images/dialog_no.png">';
                            if(D==1){
                                InnerHTMLAndExecScript('5',Y);
                                InnerHTMLAndExecScript('6',Y);
                                InnerHTMLAndExecScript('5a','');
                                InnerHTMLAndExecScript('6a','');
                                step3(Protocole,SupportPath,MirrorPath,Hash,ThemeName,Lang,autoBackupFolder,UpdateType,ObjectName);
                                
                            }
                            else{
                                Error = req2.responseXML.getElementsByTagName("Error")[0].firstChild.nodeValue;
                                InnerHTMLAndExecScript('5',X);
                                InnerHTMLAndExecScript('5a',Error);
                                InnerHTMLAndExecScript('6',X);
                                InnerHTMLAndExecScript('7',X);
                                InnerHTMLAndExecScript('8',X);
                                InnerHTMLAndExecScript('9',X);
                                InnerHTMLAndExecScript('10',X);
                                InnerHTMLAndExecScript('11',Y);
                            }
                            

                        }
                    }
            };

        req2.open("POST", 'admin/todo/update/rpc.php');
	req2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	req2.send("FileExist=1&Protocole="+Protocole+"&SupportPath="+SupportPath+"&MirrorPath="+MirrorPath+"&Hash="+Hash+"&ThemeName="+ThemeName+"&Lang="+Lang);
	http_request = false;

}

function step3(Protocole,SupportPath,MirrorPath,Hash,ThemeName,Lang,autoBackupFolder,UpdateType,ObjectName){
       
       InnerHTMLAndExecScript('7a',' <div id="progress" style="margin: 1px; background-color: rgb(0, 0, 153); width: 0%; height: 8px;"></div> <span id="percent"><img alt="X" src="admin/Themes/'+ThemeName+'/images/progress_bar.gif"> </span> <spanid="received"> </span>');

       try{req3 = new XMLHttpRequest();
	}
	catch(error){
		try{
			req3 = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(error){
				try{
				req3 = new ActiveXObject('Msxml2.XMLHTTP');
				}
				catch(error){
				req3 = null;return false;
				}
			}
	}
        req3.onreadystatechange = function()
            {
                    if (req3.readyState == 4){
                        if(req3.status == 200){
                            var D = req3.responseXML.getElementsByTagName("wwwCopyError")[0].firstChild.nodeValue;
                            var Y =  '<img style="width: 16px; height: 16px;" alt="-" src="admin/Themes/'+ThemeName+'/images/dialog_ok.png">';
                            var X =  '<img style="width: 16px; height: 16px;" alt="X" src="admin/Themes/'+ThemeName+'/images/dialog_no.png">';
                            if(D==0){
                                InnerHTMLAndExecScript('5',Y);
                                InnerHTMLAndExecScript('6a','');
                                InnerHTMLAndExecScript('7',Y);
                                InnerHTMLAndExecScript('8',Y);
                                document.getElementById("progress").style.width = "100%";
                                document.getElementById("percent").innerHTML = "100%";
                                InnerHTMLAndExecScript('6a','');
                                step4(Protocole,SupportPath,MirrorPath,Hash,ThemeName,Lang,autoBackupFolder,UpdateType,ObjectName);
                            }
                            else{
                                 InnerHTMLAndExecScript('5',X);
                                 InnerHTMLAndExecScript('6',X);
                                 InnerHTMLAndExecScript('7',X);
                                 InnerHTMLAndExecScript('8',X);
                                 InnerHTMLAndExecScript('9',X);
                                 InnerHTMLAndExecScript('10',X);
                                 InnerHTMLAndExecScript('11',Y);
                            }
                        }
                    }
            };

        req3.open("POST", 'admin/todo/update/rpc.php');
	req3.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	req3.send("wwwCopy=1&Protocole="+Protocole+"&SupportPath="+SupportPath+"&MirrorPath="+MirrorPath+"&Hash="+Hash+"&ThemeName="+ThemeName+"&Lang="+Lang);
	http_request = false;

}


function step4(Protocole,SupportPath,MirrorPath,Hash,ThemeName,Lang,autoBackupFolder,UpdateType,ObjectName){
     InnerHTMLAndExecScript('9a','<img alt="X" src="admin/Themes/'+ThemeName+'/images/progress_bar.gif">');

        try{req4 = new XMLHttpRequest();
	}
	catch(error){
		try{
			req4 = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(error){
				try{
				req4 = new ActiveXObject('Msxml2.XMLHTTP');
				}
				catch(error){
				req4 = null;return false;
				}
			}
	}
        req4.onreadystatechange = function()
            {
                    if (req4.readyState == 4){
                        if(req4.status == 200){
                            var D = req4.responseXML.getElementsByTagName("TrueHash")[0].firstChild.nodeValue;
                            var Y =  '<img style="width: 16px; height: 16px;" alt="-" src="admin/Themes/'+ThemeName+'/images/dialog_ok.png">';
                            var X =  '<img style="width: 16px; height: 16px;" alt="X" src="admin/Themes/'+ThemeName+'/images/dialog_no.png">';
                            if(D==1){
                                
                                InnerHTMLAndExecScript('6a','');
                                step5(Protocole,SupportPath,MirrorPath,Hash,ThemeName,Lang,autoBackupFolder,UpdateType,ObjectName);
                            }
                            else{
                                 Error = req4.responseXML.getElementsByTagName("Error")[0].firstChild.nodeValue;
                                 InnerHTMLAndExecScript('8',X);
                                 InnerHTMLAndExecScript('8a',Error);
                                 InnerHTMLAndExecScript('9',X);
                                 InnerHTMLAndExecScript('10',X);
                                 InnerHTMLAndExecScript('11',Y);
                            }
                        }
                    }
            };

        req4.open("POST", 'admin/todo/update/rpc.php');
	req4.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	req4.send("md5=1&Protocole="+Protocole+"&SupportPath="+SupportPath+"&MirrorPath="+MirrorPath+"&Hash="+Hash+"&ThemeName="+ThemeName+"&Lang="+Lang);
	http_request = false;

}


function step5(Protocole,SupportPath,MirrorPath,Hash,ThemeName,Lang,autoBackupFolder,UpdateType,ObjectName){

        try{req5 = new XMLHttpRequest();
	}
	catch(error){
		try{
			req5 = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(error){
				try{
				req5 = new ActiveXObject('Msxml2.XMLHTTP');
				}
				catch(error){
				req5 = null;return false;
				}
			}
	}
        req5.onreadystatechange = function()
            {
                    if (req5.readyState == 4){
                        if(req5.status == 200){
                            var D = req5.responseXML.getElementsByTagName("backup")[0].firstChild.nodeValue;
                            var Error = req5.responseXML.getElementsByTagName("Error")[0].firstChild.nodeValue;
                            var Y =  '<img style="width: 16px; height: 16px;" alt="-" src="admin/Themes/'+ThemeName+'/images/dialog_ok.png">';
                            var X =  '<img style="width: 16px; height: 16px;" alt="X" src="admin/Themes/'+ThemeName+'/images/dialog_no.png">';
                            if(D==1){
                                InnerHTMLAndExecScript('9',Y);
                                InnerHTMLAndExecScript('8a','');
                                InnerHTMLAndExecScript('9a',autoBackupFolder+' : <a target="_blank" href="admin/includes/webfolder/index.php?action=list&dir='+Error+'&order=name&srt=yes&lang='+Lang+'"<span dir="ltr">'+Error+'</span></a>');
                                step6(Protocole,SupportPath,MirrorPath,Hash,ThemeName,Lang,autoBackupFolder,UpdateType,ObjectName);
                            }
                            else{
                                 
                                 InnerHTMLAndExecScript('9',X);
                                 InnerHTMLAndExecScript('9a',Error);
                                 InnerHTMLAndExecScript('10',X);
                                 InnerHTMLAndExecScript('11',Y);
                            }
                        }
                    }
            };

        req5.open("POST", 'admin/todo/update/rpc.php');
	req5.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	req5.send("backup=1&Protocole="+Protocole+"&SupportPath="+SupportPath+"&MirrorPath="+MirrorPath+"&Hash="+Hash+"&ThemeName="+ThemeName+"&Lang="+Lang+"&UpdateType="+UpdateType);
	http_request = false;
}

function step6(Protocole,SupportPath,MirrorPath,Hash,ThemeName,Lang,autoBackupFolder,UpdateType,ObjectName){
    
     InnerHTMLAndExecScript('10a','<img alt="X" src="admin/Themes/'+ThemeName+'/images/progress_bar.gif">');

        try{req6 = new XMLHttpRequest();
	}
	catch(error){
		try{
			req6 = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(error){
				try{
				req6 = new ActiveXObject('Msxml2.XMLHTTP');
				}
				catch(error){
				req6 = null;return false;
				}
			}
	}
        req6.onreadystatechange = function()
            {
                    if (req6.readyState == 4){
                        if(req6.status == 200){
                            var D = req6.responseXML.getElementsByTagName("unzip")[0].firstChild.nodeValue;
                            var Error = req6.responseXML.getElementsByTagName("Error")[0].firstChild.nodeValue;
                            var Y =  '<img style="width: 16px; height: 16px;" alt="-" src="admin/Themes/'+ThemeName+'/images/dialog_ok.png">';
                            var X =  '<img style="width: 16px; height: 16px;" alt="X" src="admin/Themes/'+ThemeName+'/images/dialog_no.png">';
                            if(D==1){
                                InnerHTMLAndExecScript('10',Y);
                                InnerHTMLAndExecScript('10a','');
                                InnerHTMLAndExecScript('11',Y);
                            }
                            else{
                                 InnerHTMLAndExecScript('10',X);
                                 InnerHTMLAndExecScript('10a',X);
                                 InnerHTMLAndExecScript('11',Y);
                            }
                        }
                    }
            };

        req6.open("POST", 'admin/todo/update/rpc.php');
	req6.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	req6.send("unzip=1&Protocole="+Protocole+"&SupportPath="+SupportPath+"&MirrorPath="+MirrorPath+"&Hash="+Hash+"&ThemeName="+ThemeName+"&Lang="+Lang+"&UpdateType="+UpdateType+"&ObjectName="+ObjectName);
	http_request = false;
}

function ChekForUpdate(ThemeName,Lang){

        try{chek = new XMLHttpRequest();
	}
	catch(error){
		try{
			chek = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(error){
				try{
				chek = new ActiveXObject('Msxml2.XMLHTTP');
				}
				catch(error){
				chek = null;return false;
				}
			}
	}
        chek.onreadystatechange = function()
            {
                    if (chek.readyState == 4){
                        if(chek.status == 200){
                            xmlstring = xmlToString(chek.responseXML);
                            PostUpdate(xmlstring,ThemeName,Lang);
                        }
                    }
            };

        chek.open("POST", 'admin/todo/update/proxy.php');
	chek.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	chek.send("AllObjects=1");
	http_request = false;
}
function PostUpdate(xmlstring,ThemeName,Lang){
        
        try{chek1 = new XMLHttpRequest();
	}
	catch(error){
		try{
			chek1 = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(error){
				try{
				chek1 = new ActiveXObject('Msxml2.XMLHTTP');
				}
				catch(error){
				chek1 = null;return false;
				}
			}
	}
        chek1.onreadystatechange = function()
            {
                    if (chek1.readyState == 4){
                        if(chek1.status == 200){
                            var D = chek1.responseXML.getElementsByTagName("GetAllUpdates")[0].firstChild.nodeValue;
                            var Error = chek1.responseXML.getElementsByTagName("Error")[0].firstChild.nodeValue;
                            var Y =  '<img style="width: 16px; height: 16px;" alt="-" src="admin/Themes/'+ThemeName+'/images/dialog_ok.png">';
                            var X =  '<img style="width: 16px; height: 16px;" alt="X" src="admin/Themes/'+ThemeName+'/images/dialog_no.png">';
                            if(D==1){
                                InnerHTMLAndExecScript('1a',Y);
                                InnerHTMLAndExecScript('2a',Y);
                                InnerHTMLAndExecScript('3a',Y);
                            }
                            else{
                                InnerHTMLAndExecScript('1a',X);
                                InnerHTMLAndExecScript('2a',X);
                                InnerHTMLAndExecScript('3a',X);
                            }
                        }
                    }
            };

        chek1.open("POST", 'admin/todo/update/rpc.php');
	chek1.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	chek1.send('AllObjects='+xmlstring+'&Lang='+Lang);
	http_request = false;
        
}
function xmlToString(thexml){
    if(thexml.xml){
        // MSIE
        xmlString = thexml.xml;
    }else{
        // Gecko
        xmlString = (new XMLSerializer).serializeToString(thexml);
    }
    return xmlString;
}
function InnerHTMLAndExecScript (element, html) {
        var newElement = element.cloneNode(false);
        newElement.innerHTML = html;
        element.parentNode.replaceChild(newElement, element);
   
}


 function InnerHTMLAndExecScript (id, html) {
    if(document.getElementById(id)){

        var newElement =  document.getElementById(id).cloneNode(false);
        newElement.innerHTML = html;
         document.getElementById(id).parentNode.replaceChild(newElement,  document.getElementById(id));


    }
}
