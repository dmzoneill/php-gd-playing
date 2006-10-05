// JavaScript Document


// you would call this with a html hyperlink
// ie <a href="#" onclick="loadurl('mypage.html(variable)','divname(variable)')"></a>

function loadurl(dest) { 
try { 
// making the connection, its s oM$, could have used fopen
xmlhttp = window.XMLHttpRequest?new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP"); 
} 
catch (e) { 
 // whatever you want to do with error
} 
// the state will trigger the triigeroutput fucntion below
xmlhttp.onreadystatechange = triggeredoutput; 
xmlhttp.open("GET", dest, true); 
xmlhttp.send(null); 
} 



function triggeredoutput() { 
if ((xmlhttp.readyState == 1)) { 
document.getElementById("status").innerHTML = "Passing your information to the image renderer"; 
} 
if ((xmlhttp.readyState == 2)) { 
document.getElementById("status").innerHTML = "Server is rendering image";
} 
if ((xmlhttp.readyState == 3)) { 
document.getElementById("status").innerHTML = "Image is on route!";
} 
if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) { 
	document.getElementById("status").innerHTML = "Showing Image"; 
	document.getElementById("output").innerHTML = xmlhttp.responseText; 
} 
}

