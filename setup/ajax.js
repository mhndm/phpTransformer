function TestDBCon(Host,Database,User,Pass){
        try{TestConn = new XMLHttpRequest();
	}
	catch(error){
		try{
			TestConn = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(error){
				try{
				TestConn = new ActiveXObject('Msxml2.XMLHTTP');
				}
				catch(error){
				TestConn = null; return false;
				}
			}
	}
        TestConn.onreadystatechange = function()
                                    {
                                            if (TestConn.readyState == 4){
                                                if(TestConn.status == 200){
                                                    var TestCon = TestConn.responseXML.getElementsByTagName("db")[0].childNodes[0].childNodes[0].data;
                                                    if(TestCon==1){
                                                        document.getElementById('TestConDiv').innerHTML =  '<strong>Success Connection </strong>';
                                                    }
                                                    else{
                                                        document.getElementById('TestConDiv').innerHTML =  '<p style="color:#F00"><strong>Failed Connection </strong></p>';
                                                    }
     
                                                }
                                            }
                                    };
        TestConn.open("POST", "xml.php");
	TestConn.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	TestConn.send("Host="+Host+"&Database="+Database+"&User="+User+"&Pass="+Pass);
	http_request = false;
}