function loadStates(url, change){
        var xmlhttp = null;
        if(typeof XMLHttpRequest != 'undefined'){
            xmlhttp = new XMLHttpRequest();
        }else if(typeof ActiveXObject != 'undefined'){
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }else 
            throw new Error('You browser doesn\'t support ajax');
        xmlhttp.open('GET', url, true);  
        xmlhttp.onreadystatechange = function (){
            if(xmlhttp.readyState == 4)
                insertStates(xmlhttp, change);
        };
        xmlhttp.send(null);
        
    }
    
function insertStates(xhr, change){
    if(xhr.status == 200){
    	try {
        	document.getElementById(change).innerHTML = xhr.responseText;  ////
    	} catch(err) {
    		//document.getElementById(change).innerHTML = xhr.responseText;
		}
    }else 
        throw new Error('Server has encountered an error\n'+
                         'Error code = '+xhr.status);
}
