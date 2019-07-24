var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject(){
	var xmlHttp;
	
	if(window.ActiveXObject){
		try{
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e){
			xmlHttp = false;
		}
	}else{
		try{
			xmlHttp = new XMLHttpRequest();
		}catch(e){
			xmlHttp = false;
		}
	}
	
	if(!xmlHttp)
		alert("Can't create the object");
	else
		return xmlHttp;
}

function process(){
	if(xmlHttp.readyState == 0 || xmlHttp.readyState == 4){
		id_number = encodeURIComponent(document.getElementById("id").value);

		xmlHttp.open("GET", "login_ajax.php?id_number=" + id_number, true);					
		xmlHttp.onreadystatechange = handleServerResponse;				
		xmlHttp.send();
	}else{
		setTimeout('process()', 1250);
	}
}

function handleServerResponse(){
	if(xmlHttp.readyState == 4){
		if(xmlHttp.status == 200){
			document.getElementById("user_check").innerHTML = xmlHttp.responseText;
			setTimeout('process()', 1250);
		}else{
			alert("Something went Wrong");
		}
	}
}

